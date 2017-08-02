<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;
use App\Notifications\EnrolledInCampPro;
use App\Notifications\EnrolledInCampStudent;
class Camp extends Model
{
    //
    public function user(){
    	return $this->belongsTo("App\User");
    }
    public function users(){
    	return $this->belongsToMany("App\User");
    }
    public function events(){
    	return $this->hasMany("App\Event");
    }

    public function send(Cart $cart){
        $user = Auth::user();
        if(!$this->users->contains($user->id))
            $this->users()->attach($user);

        $temp_time = Carbon::parse($this->start_date." ". $this->start_time);
        $e = new Event;
        $e->start = $this->start;
        $e->display_start = $this->display_start;
        $temp_end = $temp_time->addMinutes($this->minutes);
        $e->end = $temp_end->format('Y-m-d H:i:s');
        $e->display_end = $temp_end->format('g:i A \\o\\n l\\, F j');
        $e->user()->associate(Auth::user());
        $e->active = 1;
        $e->camp()->associate($this);
        $e->is_camp = 1;
        $e->title = $this->title;
        $e->notes = "Note: deleting this event will not unenroll you from the camp.";
        $e->save();

        $user->notify(new EnrolledInCampStudent($this));
        $this->user->notify(new EnrolledInCampPro($this,$user));
        
        $this->enrolled = (int)$this->enrolled + 1;
        $this->save();
        
        $client = new Client;
        $client->add_to_clientlist($this->user);
        
    }
}
