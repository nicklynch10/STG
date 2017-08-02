<?php

namespace App\Http\Controllers;
use App\Notifications\HiredForSwingTip;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hire;
use Auth;

use App\Notifications;

use App\User;
use Carbon\Carbon;

class NotificationsController extends Controller
{
    public function index(){
    	$user = Auth::user();
    	$notifications = $user->notifications->sortByDesc('created_at');
        $actions = collect([]);
        // foreach($user->hires->where('viewed',"0")->where('sent','1') as $hire){
        //     $actions->push($hire);
        // }
       
       

        foreach($user->events as $event){
             $year = explode('-',$event->end)[0];
             $month = explode('-', $event->end)[1];
             $day = (int)explode(' ', explode('-',$event->end)[2])[0];
             //return Carbon::createFromDate($year,$month,$day, 'America/Toronto')->addDays(1);
            if(Carbon::today() < Carbon::createFromDate($year,$month,$day)->addDays(1)){
            $actions->push($event);
            }
        }
        $actions = $actions->sortBy('updated_at');
    	return view('notifications.notifications', ['notifications'=>$notifications, 'user'=>$user, 'actions'=>$actions]);
    }
    public function end(Notifications $note){
    	$note->completed = '1';
    	$note->save();
    	return back();
    }

    public function check(Notifications $note){
        $note->checked = 1;
        $note->save();
        $type = $note->findType();
        return $note;
    }
    public function forward(Notifications $note){
        $note->checked = 1;
        $note->save();
        return redirect($note->link);
    }

    ///////////////////////////////////////////////////////////////////
    public function trigger(){
        Auth::user()->notify(new HiredForSwingTip(Hire::first()));
        return Auth::user()->notifications;
    }

    public function read_all(){
        Auth::user()->unreadNotifications->markAsRead();
    }
}
