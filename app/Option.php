<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\ThankYouForBookingALessonOnSwingTips;
use Auth;
class Option extends Model
{
    public function user(){
    	return $this->belongsTo("App\User");
    }
    public function events(){
    	return $this->hasMany("App\Event");
    }
     public function carts(){//this used to be cart and hasone
        return $this->hasMany('App\Cart');
    }
    public function credits(){
        return $this->hasMany("App\Credit");
    }
    public function send(Cart $cart){
    	foreach ($cart->events as $e)$e->send();
        if($cart->remaining > 0){
            //this means credit should be issued
            for($i = 0;$i<$cart->remaining;$i++){
                $cred = new Credit;
                $cred->option()->associate($this);
                $cred->pro()->associate($this->user);
                $cred->user()->associate(Auth::user());
                $cred->payment()->associate($cart->payment);
                $cred->cart()->associate($cart);
                $cred->save();
            }
            $cart->remaining = 0;
            $cart->save();
        }
    
    }
    
}
