<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailSubject;
    public $emailMessage;
    public $emailLink; // إضافة الرابط

    public function __construct($subject, $message, $link = null)
    {
        $this->emailSubject = $subject;
        $this->emailMessage = $message;
        $this->emailLink = $link; // تعيين الرابط
    }

    public function build()
    {
        return $this->markdown('emails.student-notification')
                    ->with([
                        'subject' => $this->emailSubject,
                        'message' => $this->emailMessage,
                        'link' => $this->emailLink, // تمرير الرابط إلى الـ view
                    ])
                    ->subject($this->emailSubject);
    }
}
