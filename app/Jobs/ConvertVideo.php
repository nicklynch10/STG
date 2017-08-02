<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Video;
use App\User;
class ConvertVideo implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $video;
    protected $seth;
    
    public function __construct(Video $video)
    {
        $this->video = $video;
        // $this->seth = User::all()->where('firstname', 'Seth')->first();
        // $this->seth->city = "coverted video through...11";
        // $this->seth->save();


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    // $this->seth->state = "a video got here and changed this state...";
    // $this->seth->save();
    // $this->video->title.='-here-';
    // $this->video->save();
    // $this->video->set();
    // $this->seth->state = "a video got here and changed this state and was converted";
    // $this->seth->save();
    // works ---  /tmp/ffmpeg2/ffmpeg -h
    }
    public function failed(Exception $exception)
    {
    //$this->seth->state = "Video Got here meaning some type of failure".$exception;
   // $this->seth->save();
    }
}
