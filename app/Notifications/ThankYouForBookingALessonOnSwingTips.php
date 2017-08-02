<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Event;

class ThankYouForBookingALessonOnSwingTips extends Notification
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
                    ->line('Thank you for your request of a lesson with '.$this->pro->morphname().' for '.$this->event->get_datetime_format())
                     ->line('You will recieve confirmation when your lesson is confirmed by '.$this->pro->morphname())
                    ->action('View Lesson', 'https://swingtipsgolf.com/login')
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
        'message'=>'Thank you for requesting a lesson with '.$this->pro->morphname().' for '.$this->event->get_datetime_format(),
        'url'=>"/event/".$this->event->id
        ];
    }
}
