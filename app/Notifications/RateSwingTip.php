<?php

namespace App\Notifications;

use App\Hire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RateSwingTip extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $hire;
    public function __construct(Hire $hire)
    {
        $this->hire = $hire;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                  ->greeting('Hello '.$notifiable->morphname().",")
                    ->line('Please Rate '.$this->hire->pro->morphname()."'s Swing Tip Response")
                    ->action('Rate '.$this->hire->pro->morphname(), 'https://swingtipsgolf.com/login')
                    ->line('Thank you for using Swing Tips Golf');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message'=>'Please Rate '.$this->hire->pro->morphname()."'s Swing Tip Response",
            'hire_id'=>$this->hire->id,
            'other_id'=>$this->hire->pro->id,
            'url'=>'/rate/'.$this->hire->id
        ];
    }
}
