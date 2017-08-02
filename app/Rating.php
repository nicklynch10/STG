<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{


	protected $table = "ratings";

	protected $fillable = [
        'user_id','pro_id', 'type', 'rating', 'description', 'hire_id',
    ];


    public function hire(){
        return $this->belongsTo('App\Hire');
    }
     public function user(){
    	return $this->belongsTo("App\User");
    }
     public function pro(){
    	return $this->belongsTo("App\User", 'pro_id');
    }
}
