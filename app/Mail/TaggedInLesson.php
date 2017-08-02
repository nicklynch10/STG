<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Event;
class TaggedInLesson extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $event = false;
    protected $pro = false;
    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->pro = $event->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.taggedinlesson',['event'=>$this->event,'pro'=>$this->pro]);
    }
}
