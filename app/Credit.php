<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    public function user(){
    	return $this->belongsTo("App\User");
    }
    public function option(){
    	return $this->belongsTo("App\Option");
    }
    public function pro(){
    	return $this->belongsTo("App\User", 'pro_id');
    }
    public function event(){
    	return $this->belongsTo("App\Event");
    }
    public function payment(){
    	return $this->belongsTo("App\Payment");
    }
    public function cart(){
    	return $this->belongsTo("App\Cart");
    }
    public function deny(Event $e){
    	$user = Auth::user();
    	$e->active = 0;
    	$e->save();
    	$this->event()->associate($e);
    	$this->user()->associate($user);
    	$this->option()->associate($e->option);
    	$this->quantity = 1;
    	$this->save();
    }
}
