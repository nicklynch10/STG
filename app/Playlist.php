<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Notifications\PurchasePlaylist;
class Playlist extends Model
{

	 protected $fillable = [
        'user_id','title', 'description', 'free1', 'free2','free3',
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function videos(){
    	return $this->hasMany('App\Video');
    }
     public function playlist_owners(){
        return $this->hasMany('App\Playlist_owner');
    }
     public function cart(){
        return $this->hasOne('App\Cart');
    }
    public function send(Cart $cart){
      $user = Auth::user();
      $playlist_owner = new Playlist_owner;
      $playlist_owner->user()->associate($user);
      $playlist_owner->playlist()->associate($this);
      $playlist_owner->save();

      $this->user->notify(new PurchasePlaylist($this, $playlist_owner));

      $client = new Client;
      $client->add_to_clientlist($this->user);
    }
}
