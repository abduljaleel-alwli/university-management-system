<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StudyEndNotification;

class SendStudyEndNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:send-study-end-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to admins 3 months before student study end date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // الحصول على الطلاب الذين تبقى على انتهاء دراستهم 3 أشهر
        $students = Student::where('status', 'active')
            ->where('study_end_date', '<=', Carbon::now()->addMonths(3))
            ->where('study_end_date', '>', Carbon::now())
            ->get();

        foreach ($students as $student) {
            // التحقق مما إذا كان هناك إشعار سابق ومتى تم إرساله
            $shouldSendNotification = false;

            if ($student->last_notification_sent_at === null) {
                // لم يتم إرسال أي إشعار من قبل، فيجب الإرسال
                $shouldSendNotification = true;
            } else {
                // إذا كان قد تم إرساله من قبل ولكن مر عليه 30 يومًا
                if (Carbon::parse($student->last_notification_sent_at)->diffInDays(Carbon::now()) >= 30) {
                    $shouldSendNotification = true;
                }
            }

            if ($shouldSendNotification) {
                // الحصول على Super Admins (بدون التحقق من department_id)
                $superAdmins = User::role('super-admin')->get();

                // الحصول على Admins المسؤولين عن قسم الطالب
                $admins = User::role('admin')
                    ->where('department_id', $student->department_id)
                    ->get();

                // دمج Super Admins و Admins في مجموعة واحدة
                $recipients = $superAdmins->merge($admins);

                // إرسال الإشعار
                Notification::send($recipients, new StudyEndNotification($student));

                // تحديث تاريخ آخر إشعار
                $student->last_notification_sent_at = Carbon::now();
                $student->save();
            }
        }

        $this->info('Notifications were sent successfully.');
    }

}
