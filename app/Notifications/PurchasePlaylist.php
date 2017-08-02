<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Playlist;
use App\Playlist_owner;
class PurchasePlaylist extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $playlist;
    protected $p_owner;
    protected $user;
    protected $pro;
    public function __construct(Playlist $playlist, Playlist_owner $p_owner)
    {
     $this->playlist = $playlist; 
     $this->p_owner = $p_owner;
     $this->user = $this->p_owner->user; 
     $this->pro = $playlist->user;
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
                    ->line($this->user->morphname().' has purchased your prerecorded playlist '. $this->playlist->title)
                    ->action('View Prerecorded Playlist', 'https://swingtipsgolf.com/login')
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
        'playlist_id'=> $this->playlist->id,
        'p_owner_id'=>$this->p_owner->id,
        'user_id'=>$this->user->id,
        'pro_id'=>$this->pro->id,
        'other_id'=>$this->user->id,
        'message'=>$this->user->morphname().' has purchased your prerecorded playlist '. $this->playlist->title,
        'url'=>'/playlist/manage/'.$this->playlist->id
        ];
    }
}
