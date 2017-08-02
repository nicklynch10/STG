<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Hire;
class SwingTipDeclined extends Notification
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
                    ->line($this->pro->morphname().' declined your Swing Tip request. Your money has been returned to your account.')
                    ->line('Reasoning: '.$this->hire->issue_reason)
                    ->line('Further Response Provided: '.$this->hire->declined_reason)
                    ->action('Go To Swing Tips Golf', 'https://swingtipsgolf.com/login')
                    ->line('We apologize for the inconvenience')
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
        'message'=>$this->pro->morphname().' declined your Swing Tip request. Your money has been returned to your account.',
        'url'=>'/locker'
        ];
    }
}
