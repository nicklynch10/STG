<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Event;

class LessonCancelledByStudent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $event;
    protected $pro;
    protected $user;
    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->user = $event->user;
        $this->pro = $event->pro;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
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
                    ->line($this->user->morphname().' has cancelled their lesson for '. $this->event->get_datetime_format())
                    ->line('Reasoning for cancellation: '. $this->event->narrative)
                    ->line($this->user->morphname()."'s account has been credited")
                    ->action('Go To Swing Tips Golf', 'https://swingtipsgolf.com/login')
                    ->line('Thank you for using Swing Tips Golf.');
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
        'pro_id'=> $this->pro->id,
        'user_id'=>$this->user->id,
        'other_id'=>$this->pro->id,
        'event_id'=>$this->event->id,
        'message'=>$this->user->morphname().' has cancelled their lesson for '.$this->event->get_datetime_format(),
        'url'=>'/locker/'
        ];
    }
}
