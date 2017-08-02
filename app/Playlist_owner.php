<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist_owner extends Model
{
    protected $table = "playlist_owners";
    
    public function user(){
    	return $this->belongsTo("App\User");
    }

    public function playlist(){
    	return $this->belongsTo("App\Playlist");
    }
}
