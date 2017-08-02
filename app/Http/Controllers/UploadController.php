<?php

namespace App\Http\Controllers;

use App\Academy;
use App\Cart;
use App\Client;
use App\Http\Requests;
use App\Jobs\ConvertVideo;
use App\Playlist;
use App\Playlist_owner;
use App\User;
use App\Video;
use Auth;
use Aws\S3\S3Client;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Request;
use URL;

class UploadController extends Controller
{

      public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function upload_sent(){

    if(Input::file())
        {
            $is_propic = true;
            $image = Input::file('pic');
            if(!isset($image)){
             $is_propic = false;
             $image = Input::file('cover');
            }
         //    $filename  = time() . '.' . $image->getClientOriginalExtension();
         //    $path = 'uploads';
        	// $image->move($path, $filename);//sucessfully moves file to public...
         $name = $image->store('imgs','s3');
        	$user = Auth::user();
        	if($is_propic)$user->propic = Storage::disk('s3')->url($name);
          else $user->cover = Storage::disk('s3')->url($name);
        	$user->save();
         }
            return redirect('/locker');     
    }

    public function upload(){
          return view('users.newpic');
    }

    public function video(){
    	$user = Auth::user();
        $clients = Client::all()->where('pro_id',(string)$user->id);
            foreach ($clients as $key => $client) {
            $client->user = User::find((int)$client->user_id);
            }
    	return view('users.upload_video',['user'=>$user,'url'=>"", 'clients'=>$clients]);

    }

    public function video_uploaded(){

		  $video = new Video;
     	$user = Auth::user();
     	$request = Request::all();
     	$video->user_id = $user['id'];
     	$video->url = "videos/".$user['id']."-".$request['fileName'];
     	$video->title = $request['custom_name'];
     	$video->description = $request['video_bio'];
      $video->fileName = $request['fileName'];
     	$video->type1 = '0';
        $video->type2 = '0';
        $video->type3 = '0';
        if(isset($request['other_id'])&& isset($request['hire_id'])){
        $video->other_id = $request['other_id'];
        $video->hire_id = $request['hire_id'];
        }
        if(isset($request['playlist_id'])){
          $video->playlist_id = $request['playlist_id'];
        }
        $video->save();
        

        if(isset($request['other_id']) && $request['other_id'] != '-1' && $request['hire_id']=='-1'){
          //this means a pro uploaded them a video
        // $notification = new Notifications;
        // $notification->user_id = $video->other_id;
        // $notification->other_id = $user->id;
        // $notification->message = "has shared a video with you";
        // $notification->type = 4;
        // $notification->u_id = $video->id;
        // $notification->save();
        }
        set_time_limit (5000);
        $video->to_aws();
        $job = (new ConvertVideo($video));
        dispatch($job);
    	return $request;
    }

    public function forward(){
      $pro = Auth::user();
      $playlist = new Playlist;
      $playlist->user()->associate($pro);
      $playlist->save();
      return redirect(url("/playlist/manage/".$playlist->id));

    }
    public function manage_playlist(Playlist $playlist){
      $user = Auth::user();
      if((int)$user->id != (int)$playlist->user->id)return back();
      return view('playlists.manage',['user'=>$user,'url'=>"", 'playlist'=>$playlist]);
    }
    public function save_playlist(Playlist $playlist){
      $request = Request::instance();
      $playlist->title = $request->name;
      $playlist->description = $request->description;
      $playlist->price = $request->price;
      $active = 0;
      if($request->publish=='on') $active = 1;
      $playlist->active = $active;
      if($request->title||$request->description||$active)$playlist->save();
      return $request->name;
    }
    public function preview(Playlist $playlist){

        $user = Auth::user();
        $has_access = Playlist_owner::all()->where('playlist_id',(string)$playlist->id)->where('user_id',(string)$user->id)->count();
        if($has_access > 0){
          $videos = $playlist->videos;
          $is_preview = false;
        }else{
          $videos = $playlist->videos->take(2);
          $is_preview = true;
        }
      
       return view('playlists.preview',['user'=>$user,'pro'=>$playlist->user, 'url'=>"", 'playlist'=>$playlist, 'videos'=>$videos, 'is_preview'=>$is_preview]);
    }
    public function pay(Playlist $playlist){
      $user = Auth::user();
      $c = new Cart;
      $c->set_cart_playlist($playlist);
      return redirect('/cart');
      // $user = Auth::user();
      // $playlist_owner = new Playlist_owner;
      // $playlist_owner->user_id = $user->id;
      // $playlist_owner->playlist_id = $playlist->id;
      // $playlist_owner->save();
      //return back();
    }
    public function playlist_delete(Playlist $playlist){
      $playlist->delete();
      return redirect(url('/locker'));
    } 
    public function video_view(Video $vid){
      return view('video.view',['med'=>$vid]);
    }

    public function academy(Request $r, Academy $acad){
       if(Input::file())
        {
            $is_propic = true;
            $image = Input::file('pic');
            if(!isset($image)){
             $is_propic = false;
             $image = Input::file('cover');
            }
          $name = $image->store('imgs','s3');
          if($is_propic)$acad->propic = Storage::disk('s3')->url($name);
          else $acad->cover = Storage::disk('s3')->url($name);
          $acad->save();

         }

            return redirect('/academy/'.$acad->id);     
    }

    public function test(){

   //$t = Video::all()->where('id',1)->first();
  // $file = Storage::url("C:/Users/Nick/Google Drive/Datamine/v2/public/videos/golf.mp4");
    //   return Carbon::now();
    // $f = new File('videos/1.mp4');
    //  return Storage::disk('s3')->putFileAs('videos', $f, 'test.'.$f->guessExtension(), 'public');
  //return Storage::putFile('videos', $f, 'public');
    // $name = $file->store('imgs','s3');
     //$this->url = Storage::disk('s3')->url($name);
    }
}