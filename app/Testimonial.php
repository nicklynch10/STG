<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    
	protected $table = "testimonials";

	protected $fillable = [
        'user_id','pro_id', 'title', 'description',
    ];


     public function user(){
    	return $this->belongsTo("App\User");
    }
     public function pro(){
    	return $this->belongsTo("App\User", 'pro_id');
    }
}
