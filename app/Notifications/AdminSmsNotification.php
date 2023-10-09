<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\HtmlString;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminSmsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $status_msg;
    private $student;
    private $phone;
    private $exam_info;

    /**
     * Create a new notification instance.
     */
    public function __construct($notification_data)
    {
        $this->status_msg = $notification_data['status_msg'];
        $this->student = $notification_data['student'];
        $this->phone = $notification_data['phone'];
        $this->exam_info = $notification_data['exam_info'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $student_name = $this->student['student'];
        $class = $this->student['class'];
        $father_name = $this->student['father'];
        $subject = $this->exam_info['subject'];
        $exam_name = $this->exam_info['exam_name'];

        return (new MailMessage)
            ->subject('SMS Notification')
            ->greeting('Dear ' . $notifiable->name . ',')
            ->line('Something wrong happen. SMS vendor send a message - ' . $this->status_msg)
            ->line(new HtmlString(
                'Student Name: <b>' . $student_name . '</b><br>' .
                'Class: ' . $class . '<br>' .
                'Phone: <b>' . $this->phone . '</b><br>' .
                'Father Name: ' . $father_name . '<br>' .
                'Subject: ' . $subject . '<br>' .
                'Exam Name: ' . $exam_name
            ))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
