<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Event;
use Carbon\Carbon;
use App\Credit;
use Auth;
use App\User;
class NewEventController extends Controller
{
    public function view(Event $e){
      if($e->is_camp&&$e->camp)
             return redirect('/camp/edit/'.$e->camp->id);
    	return view('events.event',['e'=>$e]);
    }

    public function cancel_student(Event $e, Request $r){
      if($r->narrative){
        $e->narrative = $r->narrative;
        $e->save();
      }
    	// $start = Carbon::parse($e->start);
    	// $now = Carbon::now('America/Toronto');
    	// $hours = $start->diffInHours($now);
    	// if($hours > 24){
    	// 	//gives back credit for lesson
    	// 	$this->issue_credit($e);
    	// }
     //  $e->title = $e->title." -cancelled";
     //  $e->status = 'cancelled';
     //  $e->active = 0;
     //  $e->cancelled = 1;
     //  $e->save();
      $e->cancel();
      if($e->pro->id)return redirect("/locker/".$e->pro->id);
      return redirect('locker');
    }
    protected function issue_credit(Event $e){
      $cred = new Credit;
      $cred->option()->associate($e->option);
      $cred->pro()->associate($e->pro);
      $cred->user()->associate($e->user);
      $cred->cart()->associate($e->cart);
      $cred->save();
    }


    public function create(Request $r){
      //?_token=Fwak1Uxy4tmcZk3QZFtejECnz9j3M9arsRHXYbqW&start=3%3A30+AM+on+Wednesday%2C+May+24&is_from_calendar=1&title=&location=&student_email=&notes=
      $temp = New Event;
      if($r->start){
      $start = Carbon::createFromFormat('g:i A \\o\\n l\\, F j',$r->start,'America/Toronto');
      $temp->length = 60;
      $temp->date = $start->format('Y-m-d');
      $temp->time = $start->format('H:i:s');
      $temp->student_email = $r->student_email;
      $temp->notes = $r->notes;
      $temp->title = $r->title;
      $temp->location = $r->location;
      }
      return view('events.newevents.create',['temp'=>$temp]);
    }
    public function create_save(Request $r){
      $e = new Event;
      if($r->title)$e->title = $r->title;
      if($r->location)$e->location = $r->location;
      if($r->address)$e->address = $r->address;
      if($r->address)$e->location = $r->address;
      if($r->notes)$e->notes = $r->notes;
      if($r->student_email)$e->student_email = $r->student_email;
      if($r->minutes)$e->length = $r->minutes;
      else $e->length = 60;
      $e->user()->associate(Auth::user());
      $e->set_datetime($r->date,$r->time);
      $e->save();
      $e->email_student();
      return redirect($e->find_on_calendar());
    }
    public function edit(Event $e){
      if($e->is_camp&&$e->camp)
             return redirect('/camp/edit/'.$e->camp->id);
      $temp = New Event;
      if($e->start){
      $start = Carbon::createFromFormat('Y-m-d H:i:s',$e->start,'America/Toronto');
      $end = Carbon::createFromFormat('Y-m-d H:i:s',$e->end,'America/Toronto');
      $temp->length = $start->diffInMinutes($end);
      $temp->date = $start->format('Y-m-d');
      $temp->time = $start->format('H:i:s');
      }
      return view('events.newevents.edit',['temp'=>$temp,'e'=>$e]);
    }

    public function edit_save(Event $e, Request $r){
      if($r->title)$e->title = $r->title;
      if($r->location)$e->location = $r->location;
      if($r->address)$e->address = $r->address;
      if($r->address)$e->location = $r->address;
      if($r->notes)$e->notes = $r->notes;
      if($r->student_email)$e->student_email = $r->student_email;
      if($r->minutes)$e->length = $r->minutes;
      else $e->length = 60;
      $e->user()->associate(Auth::user());
      $e->set_datetime($r->date,$r->time);
      $e->save();
      $e->email_student();
      return redirect($e->find_on_calendar());
    }
    public function delete_event(Event $e){
      if($e->is_camp&&$e->camp)
             return redirect('/camp/edit/'.$e->camp->id);
      $url = $e->find_on_calendar();
      if(!$e) return back();
      $e->active = 0;
      $e->save();
      return redirect($url);
    }
    public function forward(User $pro, Event $e){
      return redirect(url('/event/'.$e->id));
    }
    public function freeup(Event $e){
      if(!$e || $e->denied == 0)return back();
      if(!$e->pro || $e->pro->id != Auth::user()->id)return back();
      $e->active = 0;
      $e->deleted = 1;
      $e->save();
      return redirect($e->find_on_calendar());
    }
}
