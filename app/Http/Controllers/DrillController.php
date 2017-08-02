<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vimeo;
use Auth;
use Carbon\Carbon;
use App\Hire;
class DrillController extends Controller
{
    public function upload(){
    	if(Auth::user()->pro != 1)return "Not a pro";
    	$vid = new Vimeo;
    	$vid->set();
    	$vid->type = 'drill';
    	$vid->title = "Drill ".Carbon::now()->format('F j, Y');
    	$vid->redirect = "/locker";
      	$vid->pro()->associate(Auth::user());
      	$vid->save();

      	return view('vimeo.drills.upload',['vid'=>$vid]);
    }

    public function hireupload(Hire $hire){
      if(Auth::user()->pro != 1)return "Not a pro";
      $vid = new Vimeo;
      $vid->set();
      $vid->type = 'drill';
      $vid->title = "Drill ".Carbon::now()->format('F j, Y');
      $vid->redirect = "/response/".$hire->id;
        $vid->pro()->associate(Auth::user());
        $vid->save();

      return view('vimeo.drills.upload',['vid'=>$vid]);
    }

    public function edit_save(Vimeo $vid, Request $r){
      if($r->title)$vid->title = $r->title;
      if($r->description)$vid->description = $r->description;
      $vid->save();
      return back();
    }

    public function delete(Vimeo $vid){
      if($vid->user&&$vid->user->id == Auth::user()->id && $vid->type=="drill"){
        $vid->active = 0;
        $vid->save();
      }
      return redirect('/locker');
    }
}
