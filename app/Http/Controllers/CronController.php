<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Event;
use App\Hire;
use App\Video;
use Carbon\Carbon;
use App\Notifications\NoResponsePro;
use App\Notifications\NoResponse;
use App\Notifications\HireRemind;
use App\Notifications\LessonRemindPro;
use App\Notifications\LessonRemind;
class CronController extends Controller
{

	protected $hires = false;
	protected $now = false;
	protected $events = false;
    public function cron(Request $r){

    	// $seth = User::all()->where('firstname', 'Seth')->first();
    	// $seth->bio .= rand(0,100);
    	// $seth->save();

        //pre vimeo this was live
        // $cmd1 = '/tmp/ffmpeg -h';
        // exec($cmd1, $o);
        // print_r($o);
        // if($o){
        //     echo 'in o';
        // }else{
        //     echo 'not in o';
        // }

    	$this->hires = Hire::all()->where('sent', 1)->where('replied', 0)->where('declined', 0);
    	$this->now = Carbon::now('America/Toronto');
    	$this->events = Event::all()->where('active','1')->where('is_lesson', 1);
    	//yes it does get here sucessfully
    	$this->process_hires();
    	$this->process_reminders();
    	//$this->process_videos();

    }
    protected function process_hires(){
    	//when this goes live change to diffInHours!!!!!!!
    	$hour_limit = 80;
    	foreach ($this->hires as $h) {
            $sent_at = Carbon::parse($h->sent_at);
    		$hours = $this->now->diffInHours($sent_at);
    		if($hours < $hour_limit){
    			$h->hire_refund();
    			$pro->notify(new NoResponsePro($h));
    			$user->notify(new NoResponse($h));
    		}
    	}
    }
    protected function process_reminders(){

    	$hour_limit = 48;
    	foreach ($this->hires->where('reminder_set', 0) as $h) {
            $sent_at = Carbon::parse($h->sent_at);
    		$hours = $this->now->diffInHours($sent_at);
    		if($hours < $hour_limit){
    			$pro = $h->pro;
    			$user = $h->user;
    			$h->reminder_set = 1;
    			$h->save();
    			$pro->notify(new HireRemind($h));
    		}
    	}

    	foreach ($this->events->where('reminder_set', 0) as $e) {
    		//change to diffin
    		$reminder_hours = 48;
    		$start = Carbon::createFromFormat('Y-m-d H:i:s',$e->start,'America/Toronto');
    		if($start->diffInHours($this->now) < $reminder_hours){
    			$pro = $e->pro;
    			$user = $e->user;
    			$e->reminder_set = 1;
    			$e->save();
    			$pro->notify(new LessonRemindPro($e));
    			$user->notify(new LessonRemind($e));
    		}
    		if($start < $this->now){
    			$e->past_date = 1;
    			$e->save();
    		}
    	}
    }

    protected function process_videos(){
    	echo $vids = Video::all()->where('converted',0)->where('in_aws',1);
    	foreach ($vids as $v) {
    		$v->to_mp4();
    	}
    	
    }

    public function diff(Event $e){
    	echo $e;
    	return $e->find_on_calendar();
    }
}
