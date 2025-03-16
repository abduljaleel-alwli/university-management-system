<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudyEndNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database']; // يمكنك إضافة المزيد من القنوات مثل Slack
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject('إشعار انتهاء مدة الدراسة')
    //         ->line('تنتهي مدة دراسة الطالب ' . $this->student->first_name . $this->student->last_name . ' بعد 3 أشهر.')
    //         ->action('عرض الطالب', url('/admin/students/' . $this->student->id))
    //         ->line('شكرًا لاستخدامك نظامنا!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'student-end-date',
            'student_id' => $this->student->id,
            'message' => __("The student study period ends after 3 months."),
            'url' => '/panel/students/' . $this->student->id,
            'super-url' => '/panel/students/super/' . $this->student->id,
        ];
    }
}
