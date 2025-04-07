<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecializationType;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    // --> index
    // عرض جميع الطلاب
    public function index()
    {
        return view('panel.admin.student.index');
    }

    // --> create
    // عرض صفحة إضافة طالب جديد
    public function create()
    {
        $specializationTypes = SpecializationType::all();
        return view('panel.admin.student.create', compact('specializationTypes'));
    }


    // --> store
    // تخزين طالب جديد في قاعدة البيانات
    public function store(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validatedData = $request->validate([
            'first_name_ar' => 'required|string|max:255',
            'first_name_en' => 'required|string|max:255',
            'father_name_ar' => 'required|string|max:255',
            'father_name_en' => 'required|string|max:255',
            'grandfather_name_ar' => 'required|string|max:255',
            'grandfather_name_en' => 'required|string|max:255',
            'last_name_ar' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone_number' => 'required|string|max:20',
            'study_type' => 'required|in:msc,phd',
            'start_date' => 'required|date',
            'admission_channel' => 'required|in:private,public',
            'academic_stage' => 'required|in:preparatory,research',
            'status' => 'required|in:active,suspended,pending_review',
            'specialization_type_id' => 'required|exists:specialization_types,id',
            'notes' => 'nullable|string',
        ]);

        // تحويل start_date إلى كائن Carbon
        $start_date = Carbon::parse($request->start_date);

        // حساب تاريخ انتهاء الدراسة بناءً على نوع الدراسة
        if ($request->study_type == 'msc') {
            $validatedData['study_end_date'] = $start_date->addYears(2);
        } elseif ($request->study_type == 'phd') {
            $validatedData['study_end_date'] = $start_date->addYears(3);
        }

        // إضافة البيانات الإضافية
        $validatedData['department_id'] = Auth::user()->department_id;
        $validatedData['author_id'] = Auth::id();
        $validatedData['editor_id'] = Auth::id();

        // إنشاء الطالب
        $student = Student::create($validatedData);

        // تطبيق منطق تعليق الطالب أو تفعيله
        if ($request->status == 'suspended') {
            // حساب المدة المتبقية عند تعليق الطالب
            $remainingDays = now()->diffInDays($student->study_end_date, false);
            $student->remaining_study_days = max($remainingDays, 0);
            $student->study_end_date = null; // إيقاف العد
            $student->save();
        } elseif ($request->status == 'active') {
            // استئناف العد عند تفعيل الطالب
            if ($student->remaining_study_days) {
                $student->study_end_date = now()->addDays($student->remaining_study_days);
                $student->remaining_study_days = null; // إعادة تعيين الأيام المتبقية
                $student->save();
            }
        }

        // التحقق من حالة الطالب بعد الإنشاء
        $this->checkStudyStatus($student);

        return redirect()->route('admin.students.index')->with('success', __("Student created successfully!"));
    }


    // --> show
    public function show(string $id)
    {
        $user = Auth::user();

        // البحث عن الطالب باستخدام `find` والتحقق من department_id
        $student = Student::where('department_id', $user->department_id)
            ->find($id);

        // إذا لم يتم العثور على الطالب، قم بإرجاع رد 404
        if (!$student) {
            abort(404, __("The student does not exist."));
        }

        // إرجاع عرض التعديل مع بيانات الطالب
        return view('panel.admin.student.show', compact('student'));
    }


    // --> edit
    // عرض صفحة تعديل بيانات طالب
    public function edit($id)
    {
        $user = Auth::user();

        // البحث عن الطالب باستخدام `find` والتحقق من department_id
        $student = Student::where('department_id', $user->department_id)
            ->find($id);

        // إذا لم يتم العثور على الطالب، قم بإرجاع رد 404
        if (!$student) {
            abort(404, __("The student does not exist."));
        }

        // إرجاع عرض التعديل مع بيانات الطالب
        $specializationTypes = SpecializationType::all();
        $hasPostGraduation = $student->postGraduationStep()->exists();

        return view('panel.admin.student.edit', [
            'student' => $student,
            'specializationTypes' => $specializationTypes,
            'hasPostGraduation' => $hasPostGraduation,
        ]);
    }


    // --> update
    // تحديث بيانات الطالب
    public function update(Request $request, Student $student)
    {
        // (A) التحقق من صحة المدخلات:
        $validatedData = $request->validate([
            'first_name_ar' => 'required|string|max:255',
            'first_name_en' => 'required|string|max:255',
            'father_name_ar' => 'required|string|max:255',
            'father_name_en' => 'required|string|max:255',
            'grandfather_name_ar' => 'required|string|max:255',
            'grandfather_name_en' => 'required|string|max:255',
            'last_name_ar' => 'required|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone_number' => 'required|string|max:15',
            'start_date' => 'required|date',
            'study_type' => 'required|in:msc,phd',
            'admission_channel' => 'required|in:private,public',
            'academic_stage' => 'required|in:preparatory,research',
            'status' => 'required|in:active,suspended,pending_review,graduate,fail,pending_review_pg',
            'specialization_type_id' => 'required|exists:specialization_types,id',
            'first_extension_date' => 'nullable|string',
            'second_extension_date' => 'nullable|string',
        ]);

        // (B) القيم الأصلية (من قاعدة البيانات)
        $oldStart = Carbon::parse($student->start_date);
        $oldEnd = $student->study_end_date ? Carbon::parse($student->study_end_date) : null;
        $oldRem = $student->remaining_study_days; // قد يكون null
        $oldStatus = $student->status;

        // (C) قراءة القيم الجديدة
        $newStart = Carbon::parse($validatedData['start_date']);  // تم التحقق من أنها date
        $newStatus = $validatedData['status']; // الحالة الجديدة

        // حدد حالات post_graduation
        $postGraduationStatuses = ['graduate', 'fail', 'pending_review_pg'];
        $isPostGraduationStatus = in_array($newStatus, $postGraduationStatuses);

        // (D) إنشاء متغيرات نهائية "وسيطة"
        $finalStart = $oldStart;
        $finalStudyEnd = $oldEnd;
        $finalRemaining = $oldRem;

        // (E) حساب المدة الأصلية بين تاريخ البداية والنهاية (إن وجِدَت):
        if ($oldEnd) {
            $originalDuration = $oldStart->diffInDays($oldEnd);
        } else {
            $originalDuration = $oldRem ?? 0;
        }

        // (F) إذا قام المستخدم بتغيير start_date
        if ($newStart->toDateString() !== $oldStart->toDateString()) {
            $finalStart = $newStart;

            // لو الطالب كان "غير موقوف" سابقًا
            if ($oldStatus !== 'suspended') {
                // ابقِ المنطق كما هو: finalStudyEnd = newStart + originalDuration
                $finalStudyEnd = $newStart->copy()->endOfDay()->addDays($originalDuration);

            } else {
                // الطالب كان موقوف
                return redirect()->back()->withErrors(__('It is not possible to modify the student start date if it is suspended'));
            }
        }

        // قبل كتلة (G) أو في مكان أعلى مناسب
        if ($oldStatus === 'suspended') {
            if ($request->has('first_extension_date') && $request->first_extension_date) {
                return redirect()->back()->withErrors([
                    'first_extension_date' => __("Cannot add extension to a suspended student.")
                ]);
            }
            if ($request->has('second_extension_date') && $request->second_extension_date) {
                return redirect()->back()->withErrors([
                    'second_extension_date' => __("Cannot add extension to a suspended student.")
                ]);
            }
        }

        // (G) التمديد الأول
        if ($request->has('first_extension_date') && $request->first_extension_date) {
            if ($finalStudyEnd) {
                // سجل تاريخ القديم في first_extension_date
                $validatedData['first_extension_date'] = $finalStudyEnd->toDateString();
                // ضف 6 شهور
                $finalStudyEnd = $finalStudyEnd->copy()->addMonths(6);
            }
            // لو كان الطالب موقوف، من المنطقي ألا نمدد تاريخ النهاية
        }

        // (H) التمديد الثاني
        if ($request->has('second_extension_date') && $request->second_extension_date) {
            if (!$student->first_extension_date) {
                return redirect()->back()->withErrors([
                    'second_extension_date' => __("The second extension cannot be added before the first extension is added.")
                ]);
            }
            if ($finalStudyEnd) {
                $validatedData['second_extension_date'] = $finalStudyEnd->toDateString();
                $finalStudyEnd = $finalStudyEnd->copy()->addMonths(6);
            }
        }

        // (I) منطق تعليق الطالب أو تفعيله
        if ($newStatus === 'suspended' && $oldStatus !== 'suspended') {
            // نحسب الأيام المتبقية من finalStudyEnd (لو لم تكن null)
            if ($finalStudyEnd) {
                $remainingDays = now()->endOfDay()->diffInDays($finalStudyEnd->endOfDay(), false);
                $finalRemaining = $remainingDays > 0 ? $remainingDays : 0;
            }
            // نجعل finalStudyEnd = null
            $finalStudyEnd = null;
        } elseif ($newStatus === 'active' && $oldStatus === 'suspended') {
            // استئناف العد إذا كان لديه أيام متبقية
            if (!is_null($finalRemaining) && $finalRemaining > 0) {
                $finalStudyEnd = now()->endOfDay()->addDays($finalRemaining);
                $finalRemaining = null; // تم استهلاك الأيام
            } else {
                return redirect()->back()->withErrors(['status' => __("Cannot activate student, no remaining days.")]);
            }
        }

        // (J) تعبئة $validatedData بالقيم النهائية:
        $validatedData['start_date'] = $finalStart->toDateString();
        $validatedData['study_end_date'] = $finalStudyEnd ? $finalStudyEnd->toDateString() : null;
        $validatedData['remaining_study_days'] = $finalRemaining;

        // في حال كانت الحالة تخص التخرج
        if ($isPostGraduationStatus) {
            // تأكد من وجود سجل post_graduation_steps
            $pgStep = $student->postGraduationStep;

            if ($pgStep) {
                $pgStep->update([
                    'post_graduation_status' => $newStatus === 'pending_review_pg' ? 'pending_review' : $newStatus,
                ]);
            } else {
                return redirect()->back()->with('error', __('No post graduation steps record.'));
            }

            // نحذف الحقل من البيانات حتى لا يحدث تضارب عند تحديث الطالب
            unset($validatedData['status']);
        } else {
            // الحالة عادية، نخزنها في جدول students
            $validatedData['status'] = $newStatus;
        }


        $validatedData['editor_id'] = Auth::id();

        // (K) التحديث الفعلي
        $student->update($validatedData);

        return redirect()->back()->with('success', __('Student updated successfully!'));
    }

    public function checkStudyStatus(Student $student)
    {
        // التحقق من أن الطالب ليس معلقًا وأن تاريخ انتهاء الدراسة قد انتهى
        if ($student->status != 'suspended' && $student->study_end_date && now()->greaterThanOrEqualTo($student->study_end_date)) {
            $student->status = 'pending_review';
            $student->save();
        }
    }


    // --> destroy
    // حذف طالب
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', __('Student deleted successfully!'));
    }
}
