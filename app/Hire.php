<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications;
use App\Client;
use App\Notifications\HiredForSwingTip;
use Carbon\Carbon;
class Hire extends Model
{
     

    protected $table = "hires";

    protected $fillable = [
        'user_id','pro_id','field1','field2','field3','field4','field5','field6', 'video1','video2', 'video3', 'video4', 'video5', 'video6',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    

     public function videos(){
        return $this->hasMany('App\Video');
    }
    public function vimeos(){
        return $this->hasMany('App\Vimeo');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function pro(){
        return $this->belongsTo('App\User', 'pro_id');
    }
    public function notification_hire(){
        return $this->hasOne('App\Notifications', 'hire_id');
    }
    public function notification_response(){
        return $this->hasOne('App\Notifications', 'response_id');
    }
    public function notification_rating(){
        return $this->hasOne('App\Notifications', 'rating_id');
    }
    public function cart(){
        return $this->hasOne('App\Cart');
    }
    public function vimeo(){
        return $this->belongsTo('App\Vimeo');
    }
    public function dtl(){
        return $this->belongsTo('App\Vimeo');
    }
    public function fv(){
        return $this->belongsTo('App\Vimeo');
    }
    public function hire_done(){
        $pb = $this->pro->pending_balance;
        $this->pro->pending_balance = $pb - $this->price;
        $balance = $this->pro->balance;
        $this->pro->balance = $balance + $this->price;
        $this->pro->save();
    }
    public function hire_refund(){
          $pro = $this->pro;
          $user = $this->user;
          $this->failed = 1;
          $this->replied = 1;
          $this->save(); 
          $transaction_fee = 0;
          $fee = round($this->cart->price*$transaction_fee,2);
          $pro->pending_balance = $pro->pending_balance - $this->cart->price + $fee;
          if($pro->pending_balance<0)$pro->pending_balance = 0;
          $pro->save();
          $user->balance = $user->balance + $this->cart->price;
          $user->save();
    }

    public function send(Cart $cart){
        $this->sent = 1;
        $this->price = $this->cart->price;
        $this->sent_at = Carbon::now();
        $this->save();
        
        $this->pro->notify(new HiredForSwingTip($this));
        $this->save();
        
        $client = new Client;
        $client->add_to_clientlist($this->pro);
        
    }
     public function drills(){
        return  $this->belongsToMany('App\Vimeo', 'drill_hire', 'hire_id', 'drill_id');
    }
}
