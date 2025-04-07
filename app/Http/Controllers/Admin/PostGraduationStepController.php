<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\StudentNotificationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\PostGraduationStep;
use App\Models\Student;
use App\Models\User;
use App\Notifications\StudentPostGraduation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostGraduationStepController extends Controller
{


    private $subject;
    private $message;
    private $link;

    public function __construct()
    {
        $this->subject = __("Post-Graduation Discussion Notification");
        $this->message = __("Graduation discussion has been created for you, Please visit the university office on date");
        $this->link = null;
    }

    // --> عرض جميع الطلاب في مراحل ما بعد الدراسة.
    public function index()
    {
        $user = Auth::user();

        // إذا كان المستخدم Super Admin، يعرض كل البيانات
        if ($user->hasRole('super-admin')) {
            $steps = PostGraduationStep::with('student')->paginate(10);
        }
        // إذا كان المستخدم Admin، يعرض فقط بيانات القسم الذي يشرف عليه
        elseif ($user->hasRole('admin')) {
            $steps = PostGraduationStep::whereHas('student', function ($query) use ($user) {
                $query->where('department_id', $user->department_id);
            })->with('student')->paginate(10);
        }
        // منع الوصول للمستخدمين غير المصرح لهم
        else {
            abort(403, __("You are not authorized"));
        }

        return view('panel.admin.post-graduation.index', compact('steps'));
    }


    // --> عرض تفاصيل طالب معين في مراحل ما بعد الدراسة.
    public function show($id)
    {
        $user = Auth::user();
        $PostGraduationStep = PostGraduationStep::findOrFail($id);

        // السماح لـ Super Admin أو Admin مسؤول عن نفس القسم فقط بعرض البيانات
        if (
            $user->hasRole('super-admin') ||
            ($user->hasRole('admin') && $PostGraduationStep->student->department_id === $user->department_id)
        ) {
            return view('panel.admin.post-graduation.show', compact('PostGraduationStep'));
        }

        abort(403, __("You are not authorized"));
    }

    // السماح بالتحديث فقط لمسؤولي الأقسام
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'discussion_date' => 'nullable|date',
            'committee_decision' => 'nullable|string',
            'clearance' => 'nullable|boolean',
            'sent_to_college' => 'nullable|boolean',
            'sent_to_ministry' => 'nullable|boolean',
            'archived' => 'nullable|boolean',
            'post_graduation_status' => 'required|in:graduate,fail,pending_review',
        ]);

        // التحقق من أن المستخدم admin
        if (!Auth::user()->hasRole('admin')) {
            return response()->json(['error' => __("You are not authorized")], 403);
        }

        $student = Student::findOrFail($request->student_id);

        if ($student->status !== 'suspended') {
            $student->update(['status' => 'pending_review']);
        }else{
            return response()->json(['error' => __("You are not authorized")], 403);
        }

        // التأكد أن الطالب ينتمي إلى نفس القسم الخاص بالمسؤول
        if (Auth::user()->department_id !== $student->department_id) {
            return response()->json(['error' => __("You are not authorized")], 403);
        }

        // التحقق مما إذا كان هناك سجل سابق لهذا الطالب
        if (PostGraduationStep::where('student_id', $request->student_id)->exists()) {
            return response()->json(['error' => __('Post-graduation step already exists for this student.')], 409);
        }

        // إنشاء مرحلة ما بعد التخرج
        $postGraduationStep = PostGraduationStep::create([
            'student_id' => $request->student_id,
            'discussion_date' => $request->discussion_date,
            'committee_decision' => $request->committee_decision,
            'clearance' => $request->clearance ?? false,
            'sent_to_college' => $request->sent_to_college ?? false,
            'sent_to_ministry' => $request->sent_to_ministry ?? false,
            'archived' => $request->archived ?? false,
            'post_graduation_status' => $request->post_graduation_status,
        ]);

        // إرسال الإشعارات
        $this->sendNotifications($student, $postGraduationStep);
        $this->sendEmail($student->id, $postGraduationStep);

        return response()->json([
            'success' => __('Post-graduation step added successfully.'),
            'message_2' => __('Send email successfully!.'),
            'type'=> 'post_graduation',
            'post_graduation_step' => $postGraduationStep
        ]);
    }

    // --> تحديث بيانات مرحلة ما بعد الدراسة للطالب.
    public function update(Request $request, PostGraduationStep $step)
    {
        $user = Auth::user();

        // السماح فقط لـ Admin مسؤول عن القسم بالتحديث، ومنع Super Admin من التعديل
        if (!$user->hasRole('admin') || $step->student->department_id !== $user->department_id) {
            abort(403, __("You are not authorized"));
        }

        $validated = $request->validate([
            'discussion_date' => 'nullable|date',
            'committee_decision' => 'nullable|string',
            'clearance' => 'boolean',
            'sent_to_college' => 'boolean',
            'sent_to_ministry' => 'boolean',
            'archived' => 'boolean',
            'post_graduation_status' => 'required|in:graduate,fail,pending_review',
        ]);

        // تحديث بيانات الطالب
        $step->update($validated);

        // تحديث حالة الطالب بناءً على قرار اللجنة
        if ($request->post_graduation_status === 'graduate') {
            $step->student->status = 'graduate';
        } elseif ($request->post_graduation_status === 'fail') {
            $step->student->status = 'fail';
        }

        $step->student->save();

        return redirect()->route('post_graduation_steps.index')->with('success', __('Student data updated successfully.'));
    }


    // --> حذف السجل (في حالة الحاجة).
    public function destroy($id)
    {
        $postGraduation = PostGraduationStep::findOrFail($id);

        $user = Auth::user();
        $student = $postGraduation->student;

        // السماح فقط لـ Admin مسؤول عن نفس القسم بالحذف، ومنع Super Admin من الحذف
        if (!$user->hasRole('admin') || $student->department_id !== $user->department_id) {
            abort(403, __("You are not authorized"));
        }

        $postGraduation->delete();

        return redirect()->route('admin.post-graduation.index')->with('success', __('Record deleted successfully.'));
    }

    // --> إرسال إشعار للطلاب بعد التخرج.
    private function sendNotifications(Student $student, PostGraduationStep $PostGraduationStep)
    {
        // الحصول على super admins
        $superAdmins = User::role('super-admin')->get();

        // الحصول على admins المسؤولين عن قسم الطالب
        $admins = User::role('admin')
            ->where('department_id', $student->department_id)
            ->get();

        // دمج super admins و admins في مجموعة واحدة
        $recipients = $superAdmins->merge($admins);

        // إرسال الإشعار
        Notification::send($recipients, new StudentPostGraduation($student, $PostGraduationStep));
    }

    // --> إرسال بريد إلكتروني للطلاب.
    public  function sendEmail($student_id, $postGraduationStep)
    {
        $student = Student::find($student_id);
        $this->message = $this->message . ': ' . $postGraduationStep->discussion_date;

        if ($student) {
            Mail::to($student->email)->send(new StudentNotificationMail($this->subject, $this->message, $this->link ?? null));

            return response()->json([
                'success' => __('Email sent successfully!'),
                'type'=> 'email',
                'post_graduation_step' => $postGraduationStep
            ]);
        } else {
            return response()->json([
                'error' => __('An error occurred while sending mail.'),
                'post_graduation_step' => $postGraduationStep
            ]);
        }
        
    }

}
