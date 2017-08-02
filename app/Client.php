<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Client;
use Auth;

class Client extends Model
{

	protected $table = "clients";

    protected $fillable = [
        'user_id','pro_id'
    ];

    public function user(){
    	return $this->belongsTo("App\User");
    }
     public function pro(){
        return $this->belongsTo("App\User", 'pro_id');
    }

    public function add_to_clientlist(User $pro){
        $user = Auth::user();
        foreach ($pro->clients_pro()->get() as $w) {
            if(!$w->user||(int)$w->user->id == (int)$user->id)return false;
        }
        $this->pro()->associate($pro);
        $this->user()->associate($user);
        $this->save();
        return true;

    }
}
