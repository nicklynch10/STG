<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Cart;
use Auth;
use App\Playlist;
class CartController extends Controller
{
    public function view(){
    	$user = Auth::user();
        foreach ($user->carts->where('active','1')->where('paid','1') as $c) {
            if($c->remaining > 0)$c->paid();
        }
    	return view('cart.view', ['user'=>$user]);
    	return $user->carts;
    }
    public function checkout(){
    	$user = Auth::user();
        foreach ($user->carts->where('active','1')->where('paid','0') as $c) {
            $c->paid();
        }
        return back();

    }
    public function account(){
        $user = Auth::user();
        return view('account.view');
    }
    public function remove(Cart $cart){
        $user = Auth::user();
        if((int)$cart->user->id != (int)$user->id)return back();
        if($cart->paid)return back();
        $cart->active = 0;
        $cart->remove();
        $cart->save();
        return back();
    }
}
