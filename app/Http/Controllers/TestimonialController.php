<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\User;
use App\Hire;
use App\Rating;
use Auth;
use App\Testimonial;
use App\Notifications;
use App\Notifications\WrittenTestimonial;
class TestimonialController extends Controller
{
     public function write($pro){
     	$pro = User::find((int)$pro);
    	$user = Auth::user();
    	return view('testimonials.write', ['pro'=>$pro]);
    }

    public function save(Request $request){
    	$pro = User::find((int)$request->pro_id);
    	$user = Auth::user();
    	$testimonial = new Testimonial;
    	$testimonial->user_id = $user->id;
    	$testimonial->pro_id = $pro->id;
    	$testimonial->description = $request->description;
    	$testimonial->title = $request->title;
    	$testimonial->save();
        $testimonial->pro->notify(new WrittenTestimonial($testimonial));
    	return redirect(url('/testimonialSent'));
    }

     public function sent(){

    	return redirect('/locker');
    }

    public function view(User $pro){

        $all = Testimonial::all()->where('pro_id',$pro->id);
        return $all;
    }

    public function delete(Testimonial $t){
        $user = Auth::user();
        if($t->user&&$t->user->id == $user->id){
        $t->active = 0;
        $t->save();
        }
        return back();
    }
}
