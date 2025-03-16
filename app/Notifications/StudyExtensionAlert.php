<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudyExtensionAlert extends Notification
{
    use Queueable;

    protected $student;
    protected $message;

    public function __construct($student, $message = null)
    {
        $this->student = $student;
        $this->message = $message ?: __("Remaining Days For Student: :student_name Is Less Than 90 Days", ['student_name' => $student->first_name]);
        // $this->message = $message ?: "Remaining Days For Student: {$student->first_name} Is Less Than 90 Days";
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'student_id' => $this->student->id,
            'student_name' => $this->student->first_name . ' ' . $this->student->last_name,
        ];
    }
}
