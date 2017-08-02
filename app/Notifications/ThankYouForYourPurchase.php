<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Event;
use App\Payment;
class ThankYouForYourPurchase extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $payment;
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
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
        $str_123x = ['','','','','','','','','','','','','','','','','','','',''];
        $price = 0;
        foreach ($this->payment->carts as $i=>$c) {
            $str_123x[$i] = "$".$c->price.": ".$c->title;
            $price += $c->price;
        }
        $price = round($price,2); 
        return (new MailMessage)
                   ->greeting('Hello '.$notifiable->morphname().",")
                    ->line('Thank you for purchase!')
                    ->line('Date of Purchase: '. $this->payment->created_at->format('g:i A \\o\\n l\\, F j'))
                    ->line('Your Purchases are as follows:')
                    ->line($str_123x[0])
                    ->line($str_123x[1])
                    ->line($str_123x[2])
                    ->line($str_123x[3])
                    ->line($str_123x[4])
                    ->line($str_123x[5])
                    ->line($str_123x[6])
                    ->line($str_123x[7])
                    ->line($str_123x[8])
                    ->line($str_123x[9])
                    ->line($str_123x[10])
                    ->line($str_123x[11])
                    ->line($str_123x[12])
                    ->line($str_123x[13])
                    ->line("Fee: $".($this->payment->payment_amount-$price))
                    ->line("Total Price: $".$this->payment->payment_amount)
                    ->action('View Purchase', 'https://swingtipsgolf.com/login')
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
        'user_id'=>$this->payment->user->id,
        'other_id'=>$this->payment->user->id,
        'message'=>'Thank you for your purchase',
        'url'=>'/paid/'.$this->payment->id
        ];
    }
}
