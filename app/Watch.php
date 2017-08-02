<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    protected $fillable = [
        'user_id','pro_id'
    ];

     public function user(){
    	return $this->belongsTo("App\User");
    }
     public function pro(){
        return $this->belongsTo("App\User", 'pro_id');
    }
}
