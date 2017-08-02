<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Hire;
use App\Rating;
use App\Notifications;
use Auth;
class RatingController extends Controller
{
    public function rate(Hire $hire){
    	$user = $hire->user;
    	$pro = $hire->pro;
    	return view('rating.rate');
    }

    public function save(Request $request, Hire $hire){
        $user = Auth::user();
    	$rating = new Rating;
    	$rating->user_id = $hire->user_id;
    	$rating->pro_id = $hire->pro_id;
    	$rating->rating = $request->rating;
    	$rating->description = $request->description;
    	$rating->hire_id = $hire->id;
    	$rating->save();
        $hire->hire_done();

    	return redirect(url('/ratingSent'));
    }

     public function sent(){

    	return redirect(url('/home'));
    }
}
