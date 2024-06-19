<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Attendance;

class DepartureNotification extends Notification
{
    use Queueable;
    public $attendance;

    /**
     * Create a new notification instance.
     */
    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $childName = $this->attendance->child->name;
        $notes = $this->attendance->notes;

        return (new MailMessage)
            ->subject('مغادرة ' . $childName . ' من حضانة ' . config('app.name'))
            ->line('تم تسجيل مغادرة ' . $childName . ' من الحضانة في ' . $this->attendance->departure_time . '.')
            ->line('ملاحظات: ' . $notes)
            ->action('عرض الحضور', url('/attendance/tracking')); 

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $childName = $this->attendance->child->name;
        $notes      = $this->attendance->notes;
        return [
            'type' => 'تنبيه بالمغادرة',
            'message' => 'تم تسجيل مغادرة ' . $childName . ' من الحضانة في ' . $this->attendance->departure_time . '.',
            'notes' => $notes,
            
        ];
    }
}
