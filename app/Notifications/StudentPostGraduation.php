<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentPostGraduation extends Notification
{
    use Queueable;

    protected $student;
    protected $postGraduation;

    public function __construct($student, $postGraduation)
    {
        $this->student = $student;
        $this->postGraduation = $postGraduation;
    }

    public function via($notifiable)
    {
        return ['database']; // يمكنك إضافة 'mail' إذا كنت تريد إرسال بريد إلكتروني
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'post-graduation',
            'message' => 'A graduation discussion has been created for the student please complete the procedure',
            'student_id' => $this->student->id,
            'graduation-url' => '/panel/post-graduation/' . $this->postGraduation->id,
            'graduation-super-url' => '/panel/post-graduation/super/' . $this->postGraduation->id,
            'students-url' => '/panel/students/' . $this->student->id,
            'students-super-url' => '/panel/students/super/' . $this->student->id,
        ];
    }
}
