<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Video;
use Auth;
use App\Watch;
use App\Client as Client2;
use App\Hire;
use App\Notifications;
use App\Testimonial;
use App\Rating;
use App\Playlist;
class UserController extends Controller
{
	//controls everytihng with users
     public function __construct()
    {
        //$this->middleware('auth');
    }

    public function me(){
            $user = Auth::user();
             if($user->pro == 0){
              $clients = Client2::all()->where('user_id',(string)$user->id);
              foreach ($clients as $key => $client) {
            $client->hires = Hire::all()->where('user_id',(string)$user->id)->where('user_id',(string)$client->user_id);
            $client->user = User::find((int)$client->user_id);
            $client->videos_pro = Video::all()->where('pro_id',(string)$user->id)->where('other_id',(string)$client->user_id);
            $client->videos_other = Video::all()->where('pro_id',(string)$client->user_id)->where('other_id',(string)$user->id);
            }
            }else{
              $clients = Client2::all()->where('pro_id',(string)$user->id);
              foreach ($clients as $key => $client) {
            $client->hires = Hire::all()->where('pro_id',(string)$user->id)->where('user_id',(string)$client->user_id);
            $client->user = User::find((int)$client->user_id);
            $client->videos_pro = Video::all()->where('user_id',(string)$user->id)->where('other_id',(string)$client->user_id);
            $client->videos_other = Video::all()->where('user_id',(string)$client->user_id)->where('other_id',(string)$user->id);
            }
            }
        $videos = Video::all()->where('user_id',(string)$user->id)->where('other_id','-1');
        $testimonials = Testimonial::all()->where('pro_id',(string)$user->id);
        $ratings = Rating::all()->where('pro_id',(string)$user->id);
        $total = 0;
        $track = 0;
        foreach ($ratings as $rating) {
            $total += (int)$rating->rating;
            $track+= 1;
        }
        if($track>0){
            $ratings->avg = $total/$track;
        }else{
            $ratings->avg = "N/A";
        }
        $playlists = Playlist::all()->where('user_id',(string)$user->id);
            if($user->pro == 0){
    	       return view('users.locker_you_student', ['user'=>$user,'clients'=>$clients, 'notifications'=>[], 'videos'=>$videos,'testimonials'=>$testimonials,'ratings'=>$ratings, 'playlists'=>$playlists]);
            }else{
               return view('users.locker_you_pro', ['user'=>$user,'clients'=>$clients, 'notifications'=>[], 'videos'=>$videos,'testimonials'=>$testimonials,'ratings'=>$ratings, 'playlists'=>$playlists]);
            }
    }

     public function other(User $pro){
                 $user = Auth::user();
                $watching = Watch::all()->where('user_id',(string)$user->id)->where("pro_id", (string)$pro->id)->first();
                 $pro->watching = $watching;
                 $pro->user = $user;
                $videos = Video::all()->where('user_id',(string)$pro->id)->where('other_id','-1');
                $videos_pro = Video::all()->where('user_id',(string)$pro->id)->where('other_id',(string)$user->id);
                $videos_other = Video::all()->where('user_id',(string)$user->id)->where('other_id',(string)$pro->id);
                $testimonials = Testimonial::all()->where('pro_id',(string)$pro->id);
                $hires = Hire::all()->where('pro_id',(string)$pro->id)->where('user_id',(string)$user->id);
                $ratings = Rating::all()->where('pro_id',(string)$pro->id);
                $total = 0;
                $track = 0;
                foreach ($ratings as $rating) {
                    $total += (int)$rating->rating;
                    $track+= 1;
                }
                if($track>0){
                    $ratings->avg = $total/$track;
                }else{
                    $ratings->avg = "N/A";
                }
                $playlists = Playlist::all()->where('user_id',(string)$pro->id);
                $clients = Client2::all()->where('pro_id',(string)$pro->id);
                foreach ($clients as $key => $client) {
            $client->user = User::find((int)$client->user_id);
                     }
    		return view('users.locker_other', ['pro'=>$pro, 'user'=>$user, 'videos'=>$videos, 'videos_other'=>$videos_other, 'videos_pro'=>$videos_pro,'testimonials'=>$testimonials,'hires'=>$hires, 'ratings'=>$ratings,'playlists'=>$playlists, 'clients'=>$clients]);
    }
    public function edit(){
        $user = Auth::user();
        return view('users.edit', ['user'=>$user]);
    }
    public function save(Request $request){ 
        $user = Auth::user();
        $user->update($request->all());
        return redirect('/locker');
    }

    public function locker($pro = false){
        if($pro)$pro = User::find((int)$pro);
        else $pro = Auth::user();
        return view('locker.locker', compact('pro'));
    }

    public function next(){
        return view('auth.choose');
    }

}
