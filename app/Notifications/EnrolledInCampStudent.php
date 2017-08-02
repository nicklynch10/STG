<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Camp;

class EnrolledInCampStudent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $camp;
    public function __construct(Camp $camp)
    {
        $this->camp = $camp;
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
                    ->line("You have enrolled in ".$this->camp->user->morphname()."'s camp, ".$this->camp->title." for ". $this->camp->display_start. " for ".$this->camp->minutes." minutes")
                    ->action('Go to Swing Tips Golf', 'https://swingtipsgolf.com/login')
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
            'message'=>"You have enrolled in ".$this->camp->user->morphname()."'s camp, ".$this->camp->title." for ". $this->camp->display_start. " for ".$this->camp->minutes." minutes",
            'camp_id'=>$this->camp->id,
            'other_id'=>$this->camp->user->id,
            'url'=>'/locker/'.$this->camp->user->id
        ];
    }
}
