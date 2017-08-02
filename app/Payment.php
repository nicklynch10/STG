<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\ThankYouForYourPurchase;
class Payment extends Model
{
    public function user(){
    	return $this->belongsTo("App\User");
    }
    public function carts(){
    	return $this->hasMany("App\Cart");
    }

    public function set(){
    	$user = $this->user;
    	if(!$user)return false;
    	foreach ($user->carts->where('paid',"0")->where('active',"1") as $c) {
    		$c->payment()->associate($this);
            $c->paid = 1;
    		$c->save();
    		$c->paid();
    		
    	}
        $this->user->notify(new ThankYouForYourPurchase($this));

    }

    ////////////////////////////////////////////////////////////////


}
