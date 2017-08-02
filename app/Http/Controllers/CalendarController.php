<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Event;
use App\User;
use Auth;
use App\Notifications;
use App\Client;
use Carbon\Carbon;
use App\Option;
use App\RepeatingEvent;
use App\Cart;
use App\Unavailable;
use App\Credit;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaggedInLesson;

class CalendarController extends Controller
{
     public function calendar(){
      return redirect('/calendar/'.Auth::user()->id);
    }

     public function calendar_other( Request $request,User $pro, $page = 0 , $prev = 0){
       // return Auth::user()->events_pro;
      if($page != 0 && $prev != 0 && $page == $prev)return redirect('/calendar/'.$pro->id);
      $option = false;
      if(session('option')){
        $option = Option::find((int)session('option'));
        if(!isset($option))$option = false;
      }
      $cart = false;
       if(session('cart')){
        $cart = Cart::find((int)session('cart'));
        if(!isset($cart))$cart = false;
      }
      $credit = false;
       if(session('credit')){
        $credit = Credit::find((int)session('credit'));
        if(!isset($credit))$credit = false;
      }
      $user = Auth::user();
      $is_me = false;
      if($pro->id == $user->id)$is_me = true;
     if(Carbon::now('America/Toronto')->dayOfWeek == 0) $thisweek = Carbon::now('America/Toronto')->startOfDay();
     else $thisweek = Carbon::now('America/Toronto')->previous(Carbon::SUNDAY);
      if($page != 0) $thisweek->addDays(($page)*7);
      if($prev != 0) $thisweek->addDays(($prev)*-7);
      $nextweek = new Carbon($thisweek);
      $nextweek->addDays(7);
      $lastweek = new Carbon($thisweek);
      $lastweek->addDays(-7);
      //return $this->find_available_days($pro);
      if($request->month_view)$month_view = true;
      else $month_view = false;
      return view('calendar.calendar', ['user'=>$user, 'is_me'=>$is_me, 'pro'=>$pro, 'page'=>$page, 'prev'=>$prev, 'thisweek'=>$thisweek, 'lastweek'=>$lastweek, 'nextweek'=>$nextweek, 'month_view'=>$month_view,'option'=>$option, 'cart'=>$cart, 'credit'=>$credit]);
    }

    public function save(Request $request, $event=false, $pro=false){
    	$user = Auth::user();
    	if($event){
    		$event = Event::find((int)$event);
    	}else{
    		$event = new Event;
    	}
    	$event = $event->set_event($request);
        if(!$event->user)$event->user()->associate($user);
        if($user->id != (int)$pro && $pro){
    	if(!$event->pro)$event->pro()->associate(User::find((int)$pro));
        }
    	if($request->interval && $request->interval != '0'){
            $this->process_repeats($request,$event);
        }else{
            if($event->is_lesson == 1){
                $p = User::find((int)$request->pro);
                if(!isset($event->pro)) $event->pro()->associate($p);
                $event->active = 0;
                $is_redirect = $this->update_cart($event);
                $event->save();
                if($is_redirect == 'redirect')return redirect('/cart');
            }
            $event->save();
    	}
        $event->email_student();
        if($request->last_page)return redirect($request->last_page);
        if(isset($event->pro) && isset($event->id))return redirect($event->find_on_calendar($event->pro));
        if(isset($event->id))return redirect($event->find_on_calendar());
    	return redirect('/calendar/');

    }
    public function delete(Event $event){
        if(!$event) return back();
        if($event->is_camp&&$event->camp)
             return redirect('/camp/edit/'.$event->camp->id);
         
    	$event->active = 0;
    	$event->save();
        return back();
    	return redirect('/calendar/');
    }
    public function edit(Request $request, $pro=false,$event=false){
        
    	$user = Auth::user();
    	if($event){
    		$event = Event::find((int)$event);
            if($event->is_camp&&$event->camp)return redirect('/camp/edit/'.$event->camp->id);
    	}else{
    		$event = new Event;
    	}
        $is_lesson = false;
        if($request->is_lesson == '1')$is_lesson = true;

        if($pro)$pro = User::find((int)$pro);
        elseif($request->$pro)$pro = User::find((int)$request->pro);
        else $pro = $user;

    	$event = $event->set_event($request);
    	return view('schedule.make', ['pro'=>$pro, 'user'=>$user, 'event'=>$event, 'is_lesson'=>$is_lesson]);

    }

    public function lesson(Request $request){

    	$pro = User::find((int)$request->pro);
    	$user = Auth::user();
        $event = new Event;
        $event = $event->set_event($request);
        $event->user()->associate($user);
        $event->pro()->associate($pro);
        if(!$event->is_credit){
        $event->save();
        }else if($event->is_credit){
            $credit = Credit::find((int)session('credit'));
            if($credit->active && !$credit->requested){
                 $event = new Event;
                 $event = $event->set_event($request);
                 $event->user()->associate($user);
                 $event->pro()->associate($pro);
                 $event->save();
                 $credit->event()->associate($event);
                 $credit->requested = 1;
                 $credit->active = 0;
                 $credit->save();
                 $event->cart()->associate($credit->cart);
                 $event->save();
                 $event->send();
            }
        if(!$event->id)return back();
        return view('cart.credit_booked',['e'=>$event]);
        }
        $is_redirect = $this->update_cart($event);
        if($is_redirect == 'redirect')return redirect('/cart');
        return back();
    }
    public function repeat(Event $event){
    	return $event;
    }
    public function copy_event($event, $day1,$day1_end, $rp){
    $e = new Event;
	$e->title = $event->title;
	$e->notes = $event->notes;
	$e->address = $event->address;
	$e->location = $event->location;
	$e->is_lesson = $event->is_lesson;
	$e->user()->associate($event->user);
	$e->start = $day1->format('Y-m-d H:i:s');
	$e->end = $day1_end->format('Y-m-d H:i:s');
	$e->display_start = Carbon::createFromFormat('Y-m-d H:i:s',$e->start,'America/Toronto')->format('g:i A \\o\\n l\\, F j');
	$e->display_end = Carbon::createFromFormat('Y-m-d H:i:s',$e->end,'America/Toronto')->format('g:i A \\o\\n l\\, F j');
    $e->repeating_event()->associate($rp);
	$e->save();
	return $e;
    }

    public function delete_repeating(RepeatingEvent $rp){
        $user = Auth::user();
        $events = $rp->events;
        foreach ($events as $key => $event) {
            if($event->user->id != $user->id)return redirect('/calendar');
            $event->active = 0;
            $event->save();
        }
        return redirect('/calendar');
    }

    protected function update_cart($event){
        //where to put the reamining code...
        if($event->cart){
        $event->cart->remaining = ((int)$event->cart->remaining) - 1;
        $event->cart->save();
        }
        if($event->cart && (int)$event->cart->remaining == 0){
            return 'redirect';
        }
        if($event->cart && (int)$event->cart->remaining < 0){
            $cart = new Cart;
            $option = Option::find((int)session('option'));
            $cart->set_cart($option);
            $cart->remaining = ((int)$cart->remaining) - 1;
            $cart->save();
        }
        return back();
    }

    protected function process_repeats($request, $event){
            $user = Auth::user();
            //means that this is a repeating event
            $rp = new RepeatingEvent;
            $rp->interval = $request->interval;
            $rp->offset = (int)$request->offset;
            $rp->amount = (int)$request->amount;
            $rp->start = $event->start;
            $rp->days = '';
            $rp->user()->associate($user);
            $rp->save();
            $day1 = Carbon::parse($event->start);
            $day1_end = Carbon::parse($event->end);
            $dur = $day1->diffInHours($day1_end);
            switch($request->interval){
                case 'daily':
                $request->daily = 1;
                for($i = 0;$i<$rp->amount;$i++){
                    $this->copy_event($event, $day1,$day1_end, $rp);
                    $day1->addDays($rp->offset);
                    $day1_end->addDays($rp->offset);
                }
                break;
                case 'weekly':
                $request->weekly = 1;
                if($request->sunday) $rp->days.='0';
                if($request->monday) $rp->days.='1';
                if($request->tuesday) $rp->days.='2';
                if($request->wednesday) $rp->days.='3';
                if($request->thursday)$rp->days.='4';
                if($request->friday)$rp->days.='5';
                if($request->saturday)$rp->days.='6';
                for($i = 0;$i<$rp->amount;$i++){
                    $this->copy_event($event, $day1,$day1_end, $rp);
                    $day1->addWeeks($rp->offset);
                    $day1_end->addWeeks($rp->offset);
                }
                break;
                case 'monthly':
                $request->monthly = 1;
                for($i = 0;$i<$rp->amount;$i++){
                    $this->copy_event($event, $day1,$day1_end, $rp);
                    $day1->addMonths($rp->offset);
                    $day1_end->addMonths($rp->offset);
                }
                break;
            }
            
        
    }

    public function set_defaults(){
        if(Carbon::now('America/Toronto')->dayOfWeek == 0) $thisweek = Carbon::now('America/Toronto')->startOfDay();
     else $thisweek = Carbon::now('America/Toronto')->previous(Carbon::SUNDAY);

        return view('calendar.set_defaults',['thisweek'=>$thisweek, 'is_me'=>true]);
    }

    public function save_defaults(Request $r){
        $u = new Unavailable;
        for($i=0;$i<7;$i++){
            for($e=0;$e<48;$e++){
                $str = $i.'|||'.$e;
                $u->$str = (int)$r->$str;
            }
        }
        $user = Auth::user();
        if($user->unavailable)$user->unavailable->delete();
        $u->user()->associate($user);
        $u->save();
        //return back();
        return redirect('/calendar');
    }


    public function find_event(Event $e){
        return redirect($e->find_on_calendar());
    }

    public function cancel(Event $e){
    if($e->is_lesson && $e->pro && $e->pro->id != Auth::user()->id)return "Not valid";
    if(!$e->is_lesson && $e->user->id != Auth::user()->id)return "not valid";
    $start = Carbon::createFromFormat('Y-m-d H:i:s',$e->start,'America/Toronto');
    $now = Carbon::now('America/Toronto');
    if($now>$start)return "Event has passed";
        $e->cancel();
        return back();
    }
    public function cancelRequest(Event $e){
    if(!$e->is_lesson || $e->user->id != Auth::user()->id)return "not valid";
        $e->deleted = 1;
        $e->active = 0;
        $e->cart->remaining = $e->cart->remaining + 1;
        $e->cart->save();
        $e->save();
        return back();
    }
}
