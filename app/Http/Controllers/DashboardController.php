<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use App\Watch;
use App\Rating;
use App\Playlist;
use App\Academy;
class DashboardController extends Controller
{

	 public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $user = Auth::user();
    	$pros = User::all()->where('pro',1);
    	return view('dashboard.dashboard2', ['pros'=>$pros,'user'=>$user,'is_acad'=>false]);
    }

    public function watchlist(){
     $user = Auth::user();
        $watch = $user->watches;
        $pros = array();
        foreach($watch as $watch){
            //return $watch->pro_id;
           $temp = $watch->pro;
           if($temp){
            array_push($pros,$temp);
            }
        }
       
        return view('dashboard.dashboard2', ['pros'=>$pros,'user'=>$user,'is_acad'=>false]);
    }

    public function academy(){
        $user = Auth::user();
        $pros = Academy::all();
        return view('dashboard.dashboard2', ['pros'=>$pros,'user'=>$user,'is_acad'=>true]);
    }


}
