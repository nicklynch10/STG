<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Credit;
use App\Event;
use App\Option;
use Auth;
class CreditController extends Controller
{
    public function book(User $pro){
    	return view('credits.view',['pro'=>$pro]);
    }
    public function use(Credit $c){
    	if((int)$c->user->id != Auth::user()->id)return back();
    	if($c->active != 1)return 'already used';
    	session(['credit' => (int)$c->id]);
    	session(['option' => (int)$c->option->id]);
        session(['cart' => -1]);
        return redirect('/calendar/'.$c->pro->id);
    }

}
