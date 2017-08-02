<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    public function __construct(){
        $this->percentfee = 0.005;
        $this->flatfee = 0;
        $this->squaredfee = 0;
        //note that there is also a squared fee applyed to the whole cart
        //squaredfee (for now)- 0.0000847458 
    }
     public function user(){
    	return $this->belongsTo("App\User");
    }
     public function pro(){
    	return $this->belongsTo("App\User", 'pro_id');
    }
    public function option(){
    	return $this->belongsTo("App\Option");
    }
    public function events(){
    	return $this->hasMany("App\Event");
    }
    public function hire(){
        return $this->belongsTo("App\Hire");
    }
    public function playlist(){
        return $this->belongsTo("App\Playlist");
    }
    public function payment(){
        return $this->belongsTo("App\Payment");
    }
    public function camp(){
        return $this->belongsTo("App\Camp");
    }
    public function set_cart($option){
    $user = Auth::user();
    $this->option()->associate($option);
    $this->user()->associate($user);
    $this->pro()->associate($option->user);
    $this->remaining = (int)$option->quantity;
    $this->title = $option->title;
    $this->description = $option->description;
    $this->price = $option->price;
    $this->save();
    session(['cart' => (int)$this->id]);
    return $this;
    }
    public function set_cart_hire($hire){
    $user = Auth::user();
    $this->percentfee = .12;
    $this->hire()->associate($hire);
    $this->user()->associate($user);
    $this->pro()->associate($hire->pro);
    $this->remaining = 0;
    $this->title = "Swing Tip with ".$hire->pro->morphname();
    $this->description = "A Swing Tip is another word for Online Instruction. This is a process where a student submits two videos of their swing to a Coach or Pro at different angles. Then the coach is able to respond wth a voiced over video of them analzing the students swing using the Swing Analysis software of their choice. The coach can also tag students in drills that they have uploaded that can help the students with improving their game. The goal is to create an experience that is comparable to an In Person Lesson.";
    $hire->price = $this->pro->swingtip_price;
    $hire->in_cart = 1;
    $hire->save();
    $this->price = $hire->price;
    $this->save();
    return $this;
    }

    public function set_cart_playlist($playlist){
    $user = Auth::user();
    $in_cart = (count(Cart::all()->where('playlist_id',(string)$playlist->id)->where('user_id',(string)$user->id)->where('active','1'))>0);
    if($in_cart)return $this;
    $this->playlist()->associate($playlist);
    $this->user()->associate($user);
    $this->pro()->associate($playlist->user);
    $this->remaining = 0;
    $this->title = $playlist->title;
    $this->description = $playlist->description;
    $this->price = $playlist->price;
    $this->save();
    return $this;
    }
    public function find_type(){
        if($this->hire)return 'hire';
        if($this->playlist)return 'playlist';
        if($this->option)return 'option';
        if($this->camp)return 'camp';
        return 'not hire';
    }
    public function paid(){
        $this->paid = 1;
        $this->save();
        $type = $this->find_type();
        $this->$type->send($this);
        //got rid of this transaction fee 7/23/17
        //$transaction_fee = .029;
        //$fee = round($this->price*$transaction_fee,2);
        if($this->find_type() == 'hire'){
             $pb = $this->pro->pending_balance;
             $this->pro->pending_balance = $this->price + $pb;
             $this->pro->swingtips_recieved += $this->price;
             $this->user->swingtips_spent += $this->price;
        }else if($this->find_type() == 'camp'){
             $b = $this->pro->balance;
             $this->pro->balance = $this->price + $b;
             $this->pro->camps_recieved += $this->price;
             $this->user->camps_spent += $this->price;
        }else{
             $b = $this->pro->balance;
             $this->pro->balance = $this->price + $b;
             $this->pro->lessons_recieved += $this->price;
             $this->user->lessons_spent += $this->price;
        }
        $this->pro->save();
        $this->user->save();
    }

    public function remove(){
        if($this->find_type() == 'option'){
            $this->remaining = 0;
            $this->save();
            //means a lesson and it needs to be removed in full.
            foreach ($this->option->events as $e) {
                $e->active = 0;
                $e->deleted = 1;
                $e->save();
            }
        }else if($this->find_type() == 'hire'){
            $this->hire->in_cart = 0;
            $this->hire->save();
        }
    }

    public function set_cart_camp($camp){
    
    $user = Auth::user();
    $this->camp()->associate($camp);
    $this->user()->associate($user);
    $this->pro()->associate($camp->user);
    $this->title = "Camp Enrollment: ".$camp->title. " with ". $camp->user->morphname();
    $this->description = $camp->description;
    $this->price = $camp->price;
    $this->save();
    return $this;
    }
}
