<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use App\Hire;
class HiredForSwingTip extends Notification
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
        return ['mail','database'];
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
                    ->line($this->hire->user->morphname().' has hired you for a Swing Tip, please respond within 3 days!')
                    ->action('View Swing Tip', 'https://swingtipsgolf.com/login')
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
        'hire_id'=>$this->hire->id,
        'message'=>$this->hire->user->morphname().' has hired you for a Swing Tip',
        'other_id'=>$this->hire->user->id,
        'url'=>'/response/'.$this->hire->id
        ];
    }
}
