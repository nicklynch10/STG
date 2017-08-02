<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Camp;
use App\User;
class EnrolledInCampPro extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $camp;
    protected $user;
    public function __construct(Camp $camp, User $user)
    {
        $this->camp = $camp;
        $this->user = $user;
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
                    ->line($this->user->morphname()." has enrolled in your camp ".$this->camp->title." for ". $this->camp->display_start. " for ".$this->camp->minutes." minutes")
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
            'message'=>$this->user->morphname()." has enrolled in your camp ".$this->camp->title." for ". $this->camp->display_start." for ".$this->camp->minutes." minutes",
            'camp_id'=>$this->camp->id,
            'other_id'=>$this->user->id,
            'url'=>'/locker'
        ];
    }
}
