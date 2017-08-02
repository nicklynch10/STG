<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepeatingEvent extends Model
{
	protected $table = 'repeating_events';

    public function events(){
        return $this->hasMany('App\Event');
    }
    public function user(){
    	return $this->belongsTo("App\User");
    }
}
