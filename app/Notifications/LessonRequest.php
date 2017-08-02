<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Event;
class LessonRequest extends Notification
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
                    ->line($this->user->morphname().' has requested a lesson with you for '.$this->event->get_datetime_format())
                    ->action('Respond To Request', 'https://swingtipsgolf.com/login')
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
        'other_id'=>$this->user->id,
        'message'=>$this->user->morphname().' has requested a lesson with you on '.$this->event->display_start,
        'url'=>$this->event->find_on_calendar($this->pro)
        ];
    }
}
