<?php

namespace App\Jobs;

use App\Models\Student;
use App\Models\User;
use App\Notifications\StudyExtensionAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Notification;

class CheckStudentsEndDate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // الحصول على الطلاب الذين تبقى على انتهاء دراستهم 3 أشهر
        $students = Student::whereDate('study_end_date', '=', Carbon::now()->addMonths(3)->toDateString())->get();

        foreach ($students as $student) {
            // جلب جميع الإداريين (Admin و Super Admin)
            $admins = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Admin', 'super-admin']);
            })->get();

            // إرسال الإشعار إليهم
            FacadesNotification::send($admins, new StudyExtensionAlert($student));
        }
    }
}

