<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Notifications extends Model
{
     protected $table = "notifications";

     protected $fillable = [
        'user_id','other_id','completed','checked','message',
    ];

    public function user(){
    	return $this->belongsTo("App\User");
    }
    public function other(){
    	return $this->belongsTo("App\User", 'other_id');
    }
    public function get_title(){
        return $this->other->firstname." ".$this->other->lastname." ".$this->message;
    }
     public function hire(){
        return $this->belongsTo("App\Hire");
    }
     public function response(){
        return $this->belongsTo("App\Hire", 'response_id');
    }
     public function event(){
        return $this->belongsTo("App\Event");
    }
    public function event_response(){
        return $this->belongsTo("App\Event", 'event_response_id');
    }
     public function testimonial(){
        return $this->belongsTo("App\Testimonial");
    }
     public function rating(){
        return $this->belongsTo("App\Hire", 'rating_id');//this is a hire!!!!!
    }
     public function playlist(){
        return $this->belongsTo("App\Testimonial");
    }
    public function findType(){
        if(isset($this->hire))return 'hire';
        if(isset($this->response))return 'response';
        if(isset($this->event))return 'event';
        if(isset($this->event_response))return 'event_response';
        if(isset($this->testimonial))return 'testimonial';
        if(isset($this->rating))return 'rating';
        if(isset($this->playlist))return 'playlist';
        return 'not set';
    }
    public function set_information(){
        if($this->link && $this->title){
            $this->save();
            return 'preset';
        }
        switch ($this->findType()) {
            case 'response':
                $this->link = '/response/'.$this->response->id;
                $this->title = $this->response->user->morphname()." has hired you for a swing tip. Reply to ".$this->response->user->firstname;
                break;
             case 'hire':
                $this->link = '/response/done/'.$this->hire->id;
                $this->title = "View ".$this->hire->pro->firstname."'s response!";
                break;
             case 'event':
                $this->link = '/event/alternatives/'.$this->event->id;
                $this->title = $this->event->user->morphname()." has requested a lesson with you, respond to this lesson request!";
                break;
                case 'event_response':
                break;
             case 'testimonial':
                $this->link = '/testimonials/'.$this->user->id;
                $this->title = "View your testimonials!";
                break;
             case 'rating':
                $this->link = '/rate/'.$this->rating->id;
                $this->title = "Rate ".$this->rating->pro->firstname." now!";
                break;
             case 'playlist':
                $this->link = '/playlist/'.$this->playlist->id;
                $this->title = 'Someone has purchased your prerecorded lesson playlist '.$this->playlist->title;
                break;
             case 'event':
                $this->link = 'event/'.$event->id;
                $this->title = $event->user->morphname().' has requested a lesson with you. Go to event';
        }
        $this->save();
    }

    public function set($type,$thing,$user = false,$other = false){
        if(!$user)$user = Auth::user();
        if(!$other)$other = Auth::user();
        $this->user()->associate($user);
        $this->other()->associate($other);
        $this->$type()->associate($thing);
        $this->set_information();
        return $this;
    }
}
