<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Video;
use App\User;
class SharedVideoWithYou extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $vid;
    protected $user;
    protected $pro;
    public function __construct(Video $vid, User $user)
    {
        $this->vid = $vid;
        $this->user = $user;
        $this->pro = $vid->user;
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
                    ->line($this->pro->morphname().' has shared a lesson with you')
                    ->action('View Video', 'https://swingtipsgolf.com/login')
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
        'user_id'=> $this->user->id,
        'pro_id'=> $this->pro->id,
        'other_id'=>$this->pro->id,
        'vid_id'=> $this->vid->id,
        'message'=>$this->pro->morphname().' has shared a lesson with you',
        'url'=>'/video/'.$this->vid->id
        ];
    }
}
