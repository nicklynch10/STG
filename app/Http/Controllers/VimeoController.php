<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vimeo;
use GuzzleHttp\Client;
use App\User;
use Auth;
use App\Notifications;
use App\Notifications\RecievedLessonVideo;
class VimeoController extends Controller
{
	protected $client_id = '85d491aab0a7130d03dfacbb36908d4c5a594cd7';
	protected $client_secret = 'bVaMZNM+K3OPtOGrLYurNb/YunCaAbdv6D1BzDw/nIbU8tKCWXXEzBiQrvCQyB5q0izKiQUG4xa86DUOP0B3uD9QOydwcLhdteTG+tLxlnPuNBleYZyCEkXgJ+weo+Dq';
	protected $auth_key = '44f10dd8ae006a99b148227b97752204';

    public function exchange(){
    	$vid = new Vimeo;
    	$vid->set();
    	return view('vimeo.upload',['vid'=>$vid]);
    }
    public function ajax_set(Request $r, Vimeo $vid){
        if((int)Auth::user()->id != $vid->user->id)return "no sir";
        $vid->title = $r->title;
        $vid->description = $r->desc;
        $vid->save();
        return $vid;
    }
    public function video_processed(Request $r){
        //takes a string with ||||| in between from r
    	// sets up the video and moves to next url
    	$split = explode("|||||",$r->redirect);
        if(!$split || !$split[0])return redirect('/locker');
    	$redirect = $split[0];
    	$user_id = $split[1];
    	$ticket_id = $split[2];
    	$vid_id = $split[3];

    	$vid = Vimeo::find((int)$vid_id);
    	$vid->url = $r->video_uri;
        $vid->active = 1;
        if(explode('/videos/',$vid->url) && isset(explode('/videos/',$vid->url)[1]))
            $vid->vim_id = explode('/videos/',$vid->url)[1];
    	$vid->save();
    	return redirect($redirect."?vid=".$vid->id);
    }

    public function send_video(User $client){
        $vid = new Vimeo;
        $vid->set();
        $vid->type = 'client';
        $vid->redirect = "/video/recieve/".$vid->id;
        $vid->student()->associate($client);
        $vid->save();
        return view('vimeo.send_video',['vid'=>$vid,'client'=>$client]);
    }
    public function receive_video(Request $r){
        if(!$r->vid)return redirect('/locker');
        $vid = Vimeo::find((int)$r->vid);
        if(!$vid)return redirect('/locker');
        $student = User::find((int)$vid->student->id);
        $student->notify(new RecievedLessonVideo($vid));
        return redirect('/locker');
    }
    public function view(Vimeo $vid){
        $vid->play();
        return view('vimeo.view',['med'=>$vid]);
    }

    public function public_fv(Vimeo $vid){
        Auth::user()->fv()->associate($vid);
        Auth::user()->save();
        return back();
    }
    public function public_dtl(Vimeo $vid){
        Auth::user()->dtl()->associate($vid);
        Auth::user()->save();
        return back();
    }
}
