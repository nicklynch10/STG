<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Event;
class LessonDenied extends Notification
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
                    ->error()
                    ->greeting('Hello '.$notifiable->morphname().",")
                    ->line($this->pro->morphname().' has denied your lesson request for '.$this->event->get_datetime_format())
                    ->line('Reasoning Provided by '.$this->pro->firstname.': '.$this->event->narrative)
                    ->action('Book Another Time', 'https://swingtipsgolf.com/login')
                    ->line('You have been credited for this lesson. Please return to '.$this->pro->morphname()."'s locker to choose another time.")
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
        'pro_id'=> $this->pro->id,
        'user_id'=>$this->user->id,
        'event_id'=>$this->event->id,
        'other_id'=>$this->pro->id,
        'message'=>$this->pro->morphname().' has denied your lesson request for '.$this->event->get_datetime_format(),
        'url'=>'/locker/'.$this->pro->id
        ];
    }
}
