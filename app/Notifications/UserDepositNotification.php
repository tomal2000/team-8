<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Classes\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserDepositNotification extends Notification
{
    use Queueable;
    public $transaction;

    /**
     * Create a new notification instance.
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
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
                    ->line('Dear '.$notifiable->first_name.', your A/C '.$notifiable->unique_id.' credited ('. $this->transaction->narration.') by '. $this->transaction->principal_amount.'. Fee TK '. $this->transaction->fee.'. at '. $this->transaction->transaction_at.' Balance Tk '. $this->transaction->remain_balance.'.')
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
