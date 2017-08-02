<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use App\Hire;
class ResponseForSwingTip extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $hire;
    protected $vimeo;
    public function __construct(Hire $hire)
    {
        $this->hire = $hire;
        $this->vimeo = $hire->vimeo;
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
                    ->line($this->hire->pro->morphname().' has replied to your Swing Tip request')
                    ->action('View Response', 'https://swingtipsgolf.com/login')
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
            //
            'message'=>$this->hire->pro->morphname().' has replied to your Swing Tip request',
            'hire_id'=>$this->hire->id,
            'other_id'=>$this->hire->pro->id,
            'url'=>'/response/done/'.$this->hire->id
        ];
    }
}
