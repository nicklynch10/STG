<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Watch;
use Auth;

class WatchController extends Controller
{
    public function add($request){

    	$watch = new Watch;
    	$user = Auth::user();
     	$watch->pro_id = $request;
     	$watch->user_id = $user->id;
     	$watch->save();
     	return back();
     	
    }
}
