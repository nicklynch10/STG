<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Camp;
use App\User;
use App\Event;
use Auth;
use Carbon\Carbon;
use App\Cart;
class CampController extends Controller
{

    public function edit($camp = false){
    	$user = Auth::user();
         $can_edit = true;
    	if($camp){
    		$camp = Camp::find((int)$camp);
            if($camp->enrolled != 0)$can_edit = false;
    	}else{
    		$camp = new Camp;
    	}

    	return view('camp.create',compact('camp','user','can_edit'));

    }

    public function save(Request $r, $camp = false){
    	$user = Auth::user();
        $is_new_camp = true;
        $can_edit = true;
    	if($camp){
            $is_new_camp = false;
    		$camp = Camp::find((int)$camp);
            if($camp->enrolled != 0)$can_edit = false;
    	}else{
    		$camp = new Camp;
    	}
    	if($r->title)$camp->title = $r->title;
    	if($r->description)$camp->description = $r->description;
    	if($r->price)$camp->price = (int)$r->price;
    	if($r->minutes)$camp->minutes = (int)$r->minutes;
    	if($r->start_time)$camp->start_time = $r->start_time;
    	if($r->start_date)$camp->start_date = $r->start_date;
        if($r->max)$camp->max = (int)$r->max;
    	$temp_time = Carbon::parse($camp->start_date." ". $camp->start_time);
    	$camp->start = $temp_time->format('Y-m-d H:i:s');
    	$camp->display_start = $temp_time->format('g:i A \\o\\n l\\, F j');
    	$camp->user()->associate($user);
    	$camp->save();
    	//now that the camp is created we need to make an event
        if($is_new_camp){
    	$e = new Event;
        }else{
        $e = $camp->events->first();
        }
    	$e->start = $camp->start;
    	$e->display_start = $camp->display_start;
    	$temp_time->addMinutes($camp->minutes);
    	$e->end = $temp_time->format('Y-m-d H:i:s');
    	$e->display_end = $temp_time->format('g:i A \\o\\n l\\, F j');
    	$e->user()->associate(Auth::user());
    	$e->active = 1;
    	$e->is_camp = 1;
    	$e->camp()->associate($camp);
    	$e->title = $camp->title;
    	$e->save();
    	return redirect(url($e->find_on_calendar()));
    }

    public function view(User $pro){
        return view('options.view', ['user'=>Auth::user(),'pro'=>$pro]);
    }

    public function delete(Camp $camp){
        if($camp && $camp->enrolled == 0){
            $camp->active = 0;
            $camp->save();
            foreach ($camp->events as $e) {
                $e->active = 0;
                $e->save();
            }
            return view('home.message',['message'=>" Camp Sucessfully deleted"]);
        }
        return view('home.message',['message'=>"Since, 1 or more people are enrolled you may not delete the camp at this time."]);
    }
    public function enroll(Camp $camp){
    $c = $camp;
    $user = Auth::user();
    if($user->carts){
        foreach ($user->carts as $cart) {
            //camp enrollemnt is already in the cart
            if($cart->camp && $cart->active == 1 && $cart->camp->id == $camp->id)
                 return redirect('/cart');

        }
    }
      if($c->users->contains($user->id)) return redirect('/cart');
      $cart = new Cart;
      $cart->set_cart_camp($c);
      return redirect('/cart');
    }
    public function unenroll(Camp $camp){
        //is able to unenroll you but the event stays there.
        //doenst refund money or anything either.
    $c = $camp;
    $user = Auth::user();
    if(!$c->users->contains($user->id)) return back();
    foreach ($c->users as $u) {
        if($u->id == $user->id){
            foreach ($c->events as $e) {
                if($e->user->id == Auth::user()->id){
                    $e->active = 0;
                    $e->save();
                }
            }
            $u->pivot->delete();

            return view('home.message',['message'=>"You have sucessfully unenrolled."]);
        }
    }
    }

}
