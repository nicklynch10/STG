<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Hire;
class NoResponsePro extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $hire;
    protected $pro;
    protected $user;
    public function __construct(Hire $h)
    {
        $this->hire = $h;
        $this->pro = $h->pro;
        $this->user = $h->user;

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
                    ->line('You did not reply to '.$this->user->morphname()."'s SwingTip request in time. Your money is no longer in your pending balance.")
                    ->action('View Lesson', 'https://swingtipsgolf.com/login')
                    ->line('Please respond to any swing tip requests within 3 days.')
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
        'other_id'=>$this->pro->id,
        'hire_id'=>$this->hire->id,
        'message'=>'You did not reply to '.$this->user->morphname()."'s SwingTip request in time. Your money is no longer in your pending balance.",
        'url'=>'/locker'
        ];
    }
}
