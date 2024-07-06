<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Classes\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreateNotification extends Notification
{
    use Queueable;
    public $password;

    /**
     * Create a new notification instance.
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSms(object $notifiable): SmsMessage
    {
        return (new SmsMessage())
        ->to('88'.$notifiable->mobile)
        ->line('Congratulation!! Your User Id Create Successfully')
        ->line('User Id:'. $notifiable->unique_id)
        ->line('Password:'. $this->password)
        // ->line('Your Password Is:')
        ->line(config('app.name'));
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
