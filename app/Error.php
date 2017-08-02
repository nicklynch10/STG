<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    public function user(){
    	return $this->belongsTo("App\User");
    }
}
