<?php

namespace App\Http\Controllers;

use App\Client;
use App\Event;
use App\Http\Requests;
use App\Notifications;
use App\Notifications\LessonApproved;
use App\Notifications\LessonDenied;
use App\Notifications\LessonRequest;
use App\User;
use Auth;
use Carbon\Carbon;
use App\Credit;
use Illuminate\Http\Request;
class EventController extends Controller
{
    
    public function make(User $pro, Request $request)
    { 
      $datetime = Carbon::createFromFormat('g:i A \\o\\n l\\, F j', $request->date,  'America/Toronto');
            if($pro->personal_lessons != 0){
                if($pro->monday&&(!$pro->monday_start || !$pro->monday_finish))$pro->monday = 0;
                if($pro->tuesday&&(!$pro->tuesday_start || !$pro->tuesday_finish))$pro->tuesday = 0;
                if($pro->wednesday&&(!$pro->wednesday_start || !$pro->wednesday_finish))$pro->wednesday = 0;
                if($pro->thursday&&(!$pro->thursday_start || !$pro->thursday_finish))$pro->thursday = 0;
                if($pro->friday&&(!$pro->friday_start || !$pro->friday_finish))$pro->friday = 0;
                if($pro->saturday&&(!$pro->saturday_start || !$pro->saturday_finish))$pro->saturday = 0;
                if($pro->sunday&&(!$pro->sunday_start || !$pro->sunday_finish)) $pro->sunday = 0;
                $pro->save();
         return view('schedule.make', ['pro'=>$pro, 'user'=>Auth::user(), 'datetime'=>$datetime]);
            }
            return redirect('/home');
    }
    public function send(Request $request, User $pro){
        $user = Auth::user();
    	$event = new Event;
      $datetime = Carbon::parse($request->date." ".$request->start_time, 'America/Toronto');
    	$event->start = $datetime->format('Y-m-d H:i:s');
      $event->display_start = $datetime->format('g:i A \\o\\n l\\, F j');
    	$event->end = $datetime->addHours(1)->format('Y-m-d H:i:s');
      $event->display_end = $datetime->format('g:i A \\o\\n l\\, F j');
    	$event->notes = $request->notes;
      $event->title = "Lesson Pending with ".$user->firstname." ".$user->lastname;
      $event->status = 'pending';
    	$event->length = 1;
    	$event->user()->associate(Auth::user());
    	$event->pro()->associate($pro);
    	$event->address = $pro->address;
    	$event->location = $pro->location;
    	$event->price = $pro->lesson_price;
    	$event->save();
      //$pro->notify(new LessonRequest($event));
        // $note = new Notifications;
        // $note->event()->associate($event);
        // $note->message = 'has requested an in person lesson';
        // $note->user()->associate($pro);
        // $note->other()->associate($user);
        // $note->save();
        $client = new Client;
        $client->add_to_clientlist($pro);
        $client->save();
    	return redirect('event/sent');
    }
    public function view(Event $event){
        $user = Auth::user();
        //$n = Notifications::all()->where('user_id',(string)Auth::user()->id)->where('event_response_id',(string)$event->id)->first();
        return view('schedule.view', ['event'=>$event, 'user'=>$user]);
    	return $event;
    }




    public function confirm(Event $event, Request $request){
              $r = $request;
              if($r->narrative)$event->narrative = $r->narrative;
               switch ($request->accept) {
             case '1':
                      $this->confirm_event($event);
                       break;
             case '2':
            // $this->set_alternative($r->date1, $r->start_time1,$event);
            // $this->set_alternative($r->date2, $r->start_time2,$event);
            // $this->set_alternative($r->date3, $r->start_time3,$event);
            $this->deny_event($event);
                      
                      break;
             default:
                       $this->deny_event($event);
                       break;
               }
                return redirect('/calendar');
    }


      protected function make_alternative($event){
        $e = new Event;
        $e->title = $event->user->full_name()."'s lesson with ". $event->pro->full_name()." -alternative";
        $e->location = $event->location;
        $e->address = $event->address;
        $e->notes = $event->notes;
        $e->price = $event->price;
        $e->pro()->associate($event->pro);
        $e->user()->associate($event->user);
        $e->cart()->associate($event->cart);
        $e->option()->associate($event->cart->option);
        $e->is_lesson = 1;
        $e->is_alternative = 1;
        return $e;
      }
      protected function set_datetime($event, $start, $end){
      if(isset($start)) $event->start = $start->format('Y-m-d H:i:s');
      if(isset($end))$event->end = $end->format('Y-m-d H:i:s');
      if(isset($event->start))$event->display_start = Carbon::createFromFormat('Y-m-d H:i:s',$event->start,'America/Toronto')->format('g:i A \\o\\n l\\, F j');
      if(isset($event->end))$event->display_end = Carbon::createFromFormat('Y-m-d H:i:s',$event->end,'America/Toronto')->format('g:i A \\o\\n l\\, F j');
      return $event;
      }
      protected function set_alternative($date,$start_time, $original_event){//
        if($date&&$start_time&&$original_event){
              $e = $this->make_alternative($original_event);//copies the old event
              $parse_string = $date." ".$start_time;
              $start = Carbon::parse($parse_string,  'America/Toronto');
              $end = new Carbon($start);
              $end->addMinutes((int)$e->cart->option->minutes);
              $e = $this->set_datetime($e,$start,$end);
              $e->save();
              return $e;
             }
             return false;
      }



    public function sent(){
                return view('schedule.generic', ['title'=>"Your request has been sent!", 'description'=> ""]);;
    }
    public function done(Event $event){
                return view('schedule.generic', ['title'=>"Your lesson with".$event->pro->firstname, 'description'=> "Date & Time: ".Carbon::parse($event->start)->toDayDateTimeString()]);;
    }

    public function calendar(){
      return redirect('/calendar/'.Auth::user()->id);
    }
    public function pro_save(User $pro, Request $request){
      $user = Auth::user();
      $start = Carbon::createFromFormat('g:i A \\o\\n l\\, F j', $request->start,  'America/Toronto');
      $end = Carbon::createFromFormat('g:i A \\o\\n l\\, F j', $request->end,  'America/Toronto');
      $event = new Event;
      $event->start = $start->format('Y-m-d H:i:s');
      $event->end = $end->format('Y-m-d H:i:s');
      $event->length = $start->diffInHours($end);
      $event->notes = $request->notes;
      $event->pro()->associate($pro);
      $event->user()->associate($user);
      $event->price = $pro->lesson_price;
      $event->location = $pro->location;
      $event->address = $pro->address;
      $event->title = $request->title;
      if(!isset($event->title) ||$event->title=="")$event->title = "Tagged as Busy";
      $event->status = $request->status;
      $event->display_start = $request->start;
      $event->display_end = $request->start;
      if($event->status == 'busy')$event->confirmed = 1;
      $event->save();
      return back();
    }

    public function calendar_other(User $pro, $page = 0 , $prev = 0){
      if($page != 0 && $prev != 0 && $page == $prev)return redirect('/calendar/'.$pro->id);
      $user = Auth::user();
      $is_me = false;
      if($pro->id == $user->id)$is_me = true;

      $thisweek = Carbon::now('America/Toronto')->previous(Carbon::SUNDAY)->addDays(($page)*7);
      if($prev != 0) $thisweek->addDays(($prev)*-7);
      $nextweek = new Carbon($thisweek);
      $nextweek->addDays(7);
      $lastweek = new Carbon($thisweek);
      $lastweek->addDays(-7);
      //return $this->find_available_days($pro);
      return view('schedule.calendar2', ['user'=>$user, 'is_me'=>$is_me, 'pro'=>$pro, 'page'=>$page, 'prev'=>$prev, 'thisweek'=>$thisweek, 'lastweek'=>$lastweek, 'nextweek'=>$nextweek, 'unavailable'=>$this->find_available_days($pro)]);
    }



    public function deny_cal(Request $r, Event $event){
      $user = Auth::user();
      if($r->narrative){
        $event->narrative = $r->narrative;
        $event->save();
      }
      if($event->pro->id != $user->id)return back();
      $this->deny_event($event);
      return back(); 
    }
    public function confirm_cal(Request $r, Event $event){
     $user = Auth::user();
     if($r->narrative){
      $event->narrative = $r->narrative;
      $event->save();
    }
      if($event->pro->id != $user->id)return back();
      $this->confirm_event($event);
      return back(); 
    }

    public function alternatives(Event $event){
      $user = Auth::user();
      if($event->pro->id != $user->id)return back();
      return view('schedule.reply', ['event'=>$event, 'user'=>$user]);

    }
public function find_available_days(User $pro){
      $days = array();
      $day_find = array();
      $hours_start = array();
      $hours_finish = array();
if(!$pro->sunday || !$pro->sunday_start || !$pro->sunday_finish){
  array_push($days,0);
}else{
array_push($day_find,0);
array_push($hours_start, $pro->sunday_start);
array_push($hours_finish,$pro->sunday_finish);
}
if(!$pro->monday || !$pro->monday_start || !$pro->monday_finish){
  array_push($days,1);
}else{
array_push($day_find,1);
array_push($hours_start, $pro->monday_start);
array_push($hours_finish,$pro->monday_finish);
}
if(!$pro->tuesday || !$pro->tuesday_start || !$pro->tuesday_finish){
  array_push($days,2);
}else{
array_push($day_find,2);
array_push($hours_start, $pro->tuesday_start);
array_push($hours_finish,$pro->tuesday_finish);
} 
if(!$pro->wednesday || !$pro->wednesday_start || !$pro->wednesday_finish){
  array_push($days,3);
}else{
array_push($day_find,3);
array_push($hours_start, $pro->wednesday_start);
array_push($hours_finish,$pro->wednesday_finish);
} 
if(!$pro->thursday || !$pro->thursday_start || !$pro->thursday_finish){
  array_push($days,4);
}else{
array_push($day_find,4);
array_push($hours_start, $pro->thursday_start);
array_push($hours_finish,$pro->thursday_finish);
} 
if(!$pro->friday || !$pro->friday_start || !$pro->friday_finish){
  array_push($days,5);
}else{
array_push($day_find,5);
array_push($hours_start, $pro->friday_start);
array_push($hours_finish,$pro->friday_finish);
} 
if(!$pro->saturday || !$pro->saturday_start || !$pro->saturday_finish){
  array_push($days,6);
}else{
array_push($day_find,6);
array_push($hours_start, $pro->saturday_start);
array_push($hours_finish,$pro->saturday_finish);
} 
return array($days, $hours_start, $hours_finish, $day_find);
    }

    public function change_available(Request $request){
     $user = Auth::user();
     $time = Carbon::createFromFormat('g:i A \\o\\n l\\, F j', $request->time,  'America/Toronto');
     $event = new Event;
     $event->passive = 1;
     $event->start = $time->format('Y-m-d H:i:s');
     $event->end = $time->addMinutes(30)->format('Y-m-d H:i:s');
     $event->pro()->associate($user);
     $event->user()->associate($user);

    }
    protected function confirm_event($event){
      if(!$event->pro)return;
      if($event->pro->id != Auth::user()->id)return;
      $start = Carbon::createFromFormat('Y-m-d H:i:s',$event->start,'America/Toronto');
    $now = Carbon::now('America/Toronto');
    if($now>$start)return "Event has passed";
      $event->confirmed = 1;
      $event->title = $event->user->firstname." ".$event->user->lastname."'s lesson with ".$event->pro->firstname." ".$event->pro->lastname. " -confirmed";
      $event->status = 'confirmed';
      $event->save();
      
      // $n = new Notifications;
      // $n->set('event_response',$event,$event->user);
      // $n->link = '/event/'.$event->id;
      // $n->title = Auth::user()->morphname().' has confirmed your lesson request. View the event';
      // $n->save();
      $event->user->notify(new LessonApproved($event));
      return $event;
    }
    protected function deny_event($event){
      if(!$event->pro)return;
      if($event->pro->id != Auth::user()->id)return;
      $start = Carbon::createFromFormat('Y-m-d H:i:s',$event->start,'America/Toronto');
    $now = Carbon::now('America/Toronto');
    if($now>$start)return "Event has passed";
        $event->denied = 1;
       $event->title = $event->user->firstname." ".$event->user->lastname."'s lesson with ".$event->pro->firstname." ".$event->pro->lastname. " -denied";
      $event->status = 'denied';
      $event->save();

      $cred = new Credit;
      $cred->option()->associate($event->option);
      $cred->pro()->associate($event->pro);
      $cred->user()->associate($event->user);
      $cred->cart()->associate($event->cart);
      $cred->save();
      // $cart = $event->cart;
      // $cart->remaining = ((int)$cart->remaining) + 1;
      // $cart->save();

      $event->user->notify(new LessonDenied($event));
      return $event;
    }

    public function alternative_confirm(Event $event){
       $user = Auth::user();
      if($event->user->id != $user->id)return back();
      $this->confirm_event($event);
      $event->cart->remaining = (int)$event->cart->remaining - 1;
      $event->cart->save();
      return back();
    }
     public function alternative_deny(Event $event){
      $user = Auth::user();
      if($event->user->id != $user->id)return back();
      $this->deny_event($event);
      return back();
    }
}
