<?php

namespace App\Console\Commands;

use App\Models\PostGraduationStep;
use App\Models\Student;
use App\Models\User;
use App\Notifications\StudentPostGraduation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class CheckStudentsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:check-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update students status daily';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $updatedCount = 0;

        // استخدام cursor() بدلاً من get() لتحسين الأداء
        $students = Student::where('status', 'active')->whereNotNull('study_end_date')->cursor();

        foreach ($students as $student) {
            try {
                if ($this->checkStudyStatus($student)) {
                    $updatedCount++;
                }
            } catch (\Exception $e) {
                Log::error('Error updating student ID: ' . $student->id . ' - ' . $e->getMessage());
            }
        }

        $this->info("✅ Case check for {$updatedCount} of students successfully in " . now());
    }

    // ---------------------
    /**
     * تحقق وتحديث حالة الطالب.
     *
     * @param Student $student
     * @return bool
     */
    private function checkStudyStatus(Student $student): bool
    {
        // التحقق من أن الطالب ليس معلقًا وأن تاريخ انتهاء الدراسة قد انتهى
        if ($student->status !== 'suspended' && now()->greaterThanOrEqualTo($student->study_end_date)) {
            $student->update(['status' => 'pending_review']);

            // إنشاء سجل PostGraduationStep للطالب
            $this->moveToPostGraduation($student);

            return true;
        }
        return false;
    }

    /**
     * إنشاء سجل PostGraduationStep للطالب.
     *
     * @param Student $student
     */
    private function moveToPostGraduation(Student $student)
    {
        try {
            // التحقق من وجود سجل PostGraduationStep للطالب
            $exists = PostGraduationStep::where('student_id', $student->id)->exists();

            if (!$exists) {
                // إنشاء سجل جديد
                $PostGraduationStep = PostGraduationStep::create([
                    'student_id' => $student->id,
                    'post_graduation_status' => 'pending_review', // الحالة الافتراضية
                ]);

                // إرسال الإشعارات
                $this->sendNotifications($student, $PostGraduationStep);

                Log::info('PostGraduationStep created for student ID: ' . $student->id);
            } else {
                Log::info('PostGraduationStep already exists for student ID: ' . $student->id);
            }
        } catch (\Exception $e) {
            Log::error('Error creating PostGraduationStep for student ID: ' . $student->id . ' - ' . $e->getMessage());
        }
    }

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
}
