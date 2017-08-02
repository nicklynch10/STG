<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Academy;
use Auth;
use App\User;

class AcademyController extends Controller
{
    public function view(Academy $academy){
    	return view('academy.view', ['academy'=>$academy]);

    }
    public function make($academy = false){
    	if($academy){
    		$a = Academy::find((int)$academy);
    	}else{
    		$a = new Academy;
    	}
    	return view('academy.make',['academy'=>$a]);
    }
    public function save(Request $r, $academy = false){
    	if($academy){
    		$a = Academy::find((int)$academy);
    		$a->update($r->all());
    	}else{
    		$a = Academy::create($r->all());
    		Auth::user()->academies()->attach($a);
            Auth::user()->save();
    	}
    	$a->save();
    	return redirect('academy/'.$a->id);
    }
    public function destroy(Academy $academy){
    	if($academy->users()->all()->contains(Auth::user()))
    		$academy->delete();
    	return redirect('/locker');
    }
    public function add(Request $r, Academy $acad){
        if(!$acad->is_in(Auth::user()))return back();
        $other = User::find((int)$r->member);
        $other->academies()->attach($acad);
        $other->save();
        return back();
    }
    public function primary(Academy $acad){
        $user = Auth::user();
        $user->course()->associate($acad);
        $user->save();
        return back();
    }

}
