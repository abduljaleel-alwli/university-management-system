<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('panel.admin.student.create');
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
            'specialization_type' => 'required|in:graduation_project,pure_sciences,teaching_methods',
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
            abort(404, 'The student does not exist.');
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
            abort(404, 'The student does not exist.');
        }

        // إرجاع عرض التعديل مع بيانات الطالب
        return view('panel.admin.student.edit', compact('student'));
    }


    // --> update
    // تحديث بيانات الطالب
    public function update(Request $request, Student $student)
    {
        // dd($request->first_extension_date);
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
            'study_type' => 'required|in:msc,phd',
            'admission_channel' => 'required|in:private,public',
            'academic_stage' => 'required|in:preparatory,research',
            'status' => 'required|in:active,suspended,pending_review',
            'specialization_type' => 'required|in:graduation_project,pure_sciences,teaching_methods',
            'first_extension_date' => 'nullable|string',
            'second_extension_date' => 'nullable|string',
        ]);

        // التحقق من إضافة التمديد الأول
        if ($request->has('first_extension_date') && $request->first_extension_date) {
            $validatedData['first_extension_date'] = $student->study_end_date;
            $validatedData['study_end_date'] = Carbon::parse($student->study_end_date)->addMonths(6);
        }

        // التحقق من إضافة التمديد الثاني
        if ($request->has('second_extension_date') && $request->second_extension_date) {
            if (!$student->first_extension_date) {
                return redirect()->back()->withErrors(['second_extension_date' => __("The second extension cannot be added before the first extension is added.")]);
            }
            $validatedData['second_extension_date'] = $student->study_end_date;
            $validatedData['study_end_date'] = Carbon::parse($student->study_end_date)->addMonths(6);
        }

        if ($request->status == 'suspended' && $student->status != 'suspended') {
            // حساب المدة المتبقية عند تعليق الطالب
            $remainingDays = now()->diffInDays($student->study_end_date, false);
            $student->remaining_study_days = max($remainingDays, 0);
            $validatedData['study_end_date'] = null; // إيقاف العد
        } elseif ($request->status == 'active' && $student->status == 'suspended') {
            // استئناف العد عند تفعيل الطالب
            if ($student->remaining_study_days) {
                $validatedData['study_end_date'] = now()->addDays($student->remaining_study_days);
            }
        }

        $validatedData['editor_id'] = Auth::id();

        // تحديث بيانات الطالب
        $student->update($validatedData);

        // التحقق من حالة الطالب بعد التحديث
        // $this->checkStudyStatus($student);

        return redirect()->route('admin.students.index')->with('success', __('Student updated successfully!'));
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
