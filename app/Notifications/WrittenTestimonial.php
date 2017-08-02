<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Testimonial;
class WrittenTestimonial extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    protected $pro;
    protected $testimonial;
    public function __construct(Testimonial $testimonial)
    {
        $this->testimonial = $testimonial;
        $this->pro = $testimonial->pro;
        $this->user = $testimonial->user;
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
                    ->line($this->user->morphname().' has written a testimonial about you')
                    ->action('View Testimonial', 'https://swingtipsgolf.com/login')
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
        'testimonial_id'=> $this->testimonial->id,
        'user_id'=> $this->user->id,
        'pro_id'=> $this->pro->id,
        'other_id'=>$this->user->id,
        'message'=>$this->user->morphname().' has written a testimonial about you',
        'url'=>'/locker'
        ];
    }
}
