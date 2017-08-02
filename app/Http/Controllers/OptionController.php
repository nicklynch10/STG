<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Option;
use App\User;
use App\Cart;
use Auth;
use App\Client;
use Mail;

class OptionController extends Controller
{
    //
    public function edit($option = false){
    	$user = Auth::user();
    	if($option){
    		$option = Option::find((int)$option);
    	}else{
    		$option = new Option;
    	}

    	return view('options.make',compact('option','user'));

    }

    public function save(Request $r, $option = false){
    	$user = Auth::user();
    	if($option){
    		$option = Option::find((int)$option);
    	}else{
    		$option = new Option;
    	}
    	$option = $this->set_option($r,$option);
    	$option->user()->associate($user);
    	$option->save();
    	return redirect('/locker');
    }
    protected function set_option($r,$o){
    	if($r->title)$o->title = $r->title;
    	if($r->description)$o->description = $r->description;
    	if($r->price)$o->price = (int)$r->price;
    	if($r->quantity)$o->quantity = (int)$r->quantity;
    	if($r->people)$o->people=(int)$r->people;
    	if($r->minutes)$o->minutes = (int)$r->minutes;
        if($r->location)$o->location = $r->location;
    	return $o;
    }

    public function view(User $pro){
        return view('options.view', ['user'=>Auth::user(),'pro'=>$pro]);
    }
    public function set(Request $r, $pro){//sets the session
         //$value = session('option');
    $user = Auth::user();
    $pro = User::find((int)$pro);
    $option = Option::find((int)$r->option);

    $cart = new Cart;
    $cart->set_cart($option);
   
    // Store a piece of data in the session...
    session(['option' => (int)$option->id]);
    session(['credit' => -1]);
    //return session('option');

    if($option->people && $option->people>1){
        return redirect('option/tag/'.$option->id);
    }
    return redirect('calendar/'.$pro->id);
    }

    public function reset(Cart $cart){
        if((int)$cart->user->id != (int)Auth::user()->id)return back();

        session(['option' => (int)$cart->option->id]);
        session(['cart' => (int)$cart->id]);
        session(['credit' => -1]);
        return redirect('calendar/'.$cart->option->user->id);
    }

    public function delete(Option $option){
        if($option->user && $option->user->id == Auth::user()->id){
            $option->active = 0;
            $option->save();
        }
        return redirect('/locker');
    }


    public function tag(Option $o){
    if(!session('option')) return redirect('/locker/'.$o->user->id);
    $option = Option::find((int)session('option'));
    if(!$o || $option->id != $o->id)return redirect('/locker/');
    if($o->people && $o->people>1){
        $users = User::all()->where('pro',0);
        return view('options.tag', ['o'=>$o, 'users'=>$users]);
    }else{
        return redirect('calendar/'.$o->user->id);
    }
    }

    public function tagdone(Option $o, Request $r){
        if(!$o||!session('option'))return redirect('/locker/');
        $option = Option::find((int)session('option'));
        if(!$o || $option->id != $o->id)return redirect('/locker/');

        $tagged = collect([]);
        $taggedemails = collect([]);
        for($i=0;$i<20;$i++){
            $temp = "tag".$i;
            $temp2 = 'otheremail'.$i;
            $tempuser = User::find((int)$r->$temp);
            $tempuseremail = $r->$temp2;
            if(isset($tempuser)){
                $tagged->push($tempuser);
            }else if(isset($tempuseremail)){
               $taggedemails->push($tempuseremail);
            }
        }

        foreach ($tagged as $u) {
            if($o && $o->user){
                $client = new Client;
                $client->add_to_clientlist($o->user);
            }
        }

        foreach ($taggedemails as $em) {
                $user = Auth::user();
            try {
                Mail::send('mail.signup', ['pro'=>$o->user, 'other'=>Auth::user()], function ($m) use ($o,$em) {
                        $m->from('info@swingtipsgolf.com', "Swing Tips Golf: ".$o->user->morphname());
                        $m->to($em)->subject('You have been tagged! Sign up for Swing Tips Golf');
                    });
            } catch (\Exception $e) {
                //return 'Caught exception: '.  $e->getMessage();
            }
        }
        return redirect('calendar/'.$o->user->id);
    }

}
