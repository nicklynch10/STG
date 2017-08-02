<?php

namespace App;

use App\Cart;
use App\Notifications\LessonRequest;
use App\Notifications\ThankYouForBookingALessonOnSwingTips;
use App\Option;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Client;
use App\Mail\TaggedInLesson;
use App\Credit;
use App\Notifications\LessonCancelledByPro;
use App\Notifications\LessonCancelledByStudent;


class Event extends Model
{
     public function user(){
    	return $this->belongsTo("App\User");
    }
     public function pro(){
    	return $this->belongsTo("App\User", 'pro_id');
    }
      public function notifications(){
    	return $this->hasMany("App\Notifications");
    }
     public function repeating_event(){
    	return $this->belongsTo("App\RepeatingEvent", 'repeating_event_id');
    }
     public function option(){
        return $this->belongsTo("App\Option");
    }
    public function cart(){
        return $this->belongsTo("App\Cart");
    }
    public function credit(){
        return $this->hasOne("App\Credit");
    }
    public function camp(){
        return $this->belongsTo("App\Camp");
    }
    public function set_event($array){
        if($array->title)$this->title = $array->title;
        if($array->location)$this->location = $array->location;
        if($array->address)$this->address = $array->address;
        if($array->address)$this->location = $array->address;
        if($array->notes)$this->notes = $array->notes;
        if($array->price)$this->price = $array->price;
        if($array->student_email)$this->student_email = $array->student_email;
        if($array->is_month_event){
            $parse_string = $array->date." ".$array->time;
            $start = Carbon::parse($parse_string,  'America/Toronto');
            $end = new Carbon($start);
            if($array->duration && ((int)((float)$array->duration*10))%10 !=0)$end->addMinutes(30);
            if(!$array->duration)$array->duration=1;
            $end->addHours(floor((int)($array->duration)));
        }else if($array->is_from_calendar && $array->start){
            $start = Carbon::createFromFormat('g:i A \\o\\n l\\, F j', $array->start,  'America/Toronto');
        }else if(!isset($this->start)){
            $parse_string = $array->date." ".$array->start_time;
            $parse_string_end = $array->date." ".$array->end_time;
            $start = Carbon::parse($parse_string, 'America/Toronto');
            $end = Carbon::parse($parse_string_end, 'America/Toronto');
        }
        if(!isset($end) && isset($start)){
            $end = new Carbon($start);
            if(session('option') && $array->is_lesson == '1'){
                $option = Option::find((int)session('option'));
                if($option){
                    $end->addMinutes($option->minutes);
                    $this->option()->associate($option);
                    $this->price = $option->price." for ".$option->quantity." Lesson(s)";
                    $p = $option->user;
                    $address = $p->address.', '.$p->city.', '.$p->state.', '.$p->zip;
                    $this->address = $address;
                    $this->active = 0;
                    if($this->option&&$this->option->location)$this->location = $this->option->location;

                }else{
                     $end->addHours(1);
                }
            }else{
                $end->addHours(1);
            }
        }
        if(isset($start)) $this->start = $start->format('Y-m-d H:i:s');
        if(isset($end))$this->end = $end->format('Y-m-d H:i:s');
        if(isset($this->start))$this->display_start = Carbon::createFromFormat('Y-m-d H:i:s',$this->start,'America/Toronto')->format('g:i A \\o\\n l\\, F j');
        if(isset($this->end))$this->display_end = Carbon::createFromFormat('Y-m-d H:i:s',$this->end,'America/Toronto')->format('g:i A \\o\\n l\\, F j');
        if($array->is_lesson == '1'){
             $this->active = 0;
            $this->is_lesson = 1;
            if(!$this->cart){

            $cart = Cart::find((int)session('cart'));
            if(isset($cart)){
                $this->cart()->associate($cart);
            }else{
                $this->is_credit = 1;
            }

            }

        }
        return $this;
    }
    public function send(){
        if($this->active == '1')return;
        $this->requested_at = Carbon::now('America/Toronto')->format('Y-m-d H:i:s');
       $this->active = 1;
       $this->save();
       $this->pro->notify(new LessonRequest($this));
       $this->user->notify(new ThankYouForBookingALessonOnSwingTips($this));
        $client = new Client;
        if($client->add_to_clientlist($this->pro))$client->save();
    }

    public function find_on_calendar($user = false){
    if(!$user)$user = Auth::user();
    if(!$user||!$user->id)return "/calendar";
    else if($user && !isset($user->id))$user = User::find((int)$user);
    $now = Carbon::now('America/Toronto');
    if($now->dayOfWeek == 0) $now = $now->startOfDay();
    else $now = $now->previous(Carbon::SUNDAY); 
    $lesson = Carbon::createFromFormat('Y-m-d H:i:s',$this->start,'America/Toronto');
    $diff = $now->diffInDays($lesson);
    $weeks = 0;
    if($now < $lesson){
        //this means the lesson is in the future
        $weeks = 1;
        while($diff > $weeks*7)$weeks++;

    }else{
        $nweeks = 1;
        while($diff > $nweeks*7)$nweeks++;
    }
    if($weeks == 1)return url('/calendar/'.$user->id);
    elseif($weeks == 0)return url('/calendar/'.$user->id.'/0/'.$nweeks);
    else return url('/calendar/'.$user->id.'/'.($weeks-1).'/0');
    }

    public function cancel(){
        if($this->cancelled)return false;
        $is_ok = false;
        if($this->user->id == Auth::user()->id) $is_ok = true;
        if($this->pro && $this->pro->id == Auth::user()->id) $is_ok = true;
        if(!$is_ok) return false;

        $this->cancelled = 1;
        $this->active = 0;
        $this->status = 'cancelled';
        $this->title = $this->user->morphname()."'s lesson with ".$this->pro->morphname()." -cancelled";
        $this->save();

      if($this->pro->id == Auth::user()->id){
      $this->user->notify(new LessonCancelledByPro($this));
      }else if($this->user->id == Auth::user()->id){
      $this->pro->notify(new LessonCancelledByStudent($this));
      }
      $start = Carbon::parse($this->start);
      $now = Carbon::now('America/Toronto');
      $hours = $start->diffInHours($now);
      if(!Auth::user()->pro &&$now<$start&&$hours<24)return true;
      $cred = new Credit;
      $cred->option()->associate($this->option);
      $cred->pro()->associate($this->pro);
      $cred->event()->associate($this);
      $cred->user()->associate($this->user);
      $cred->cart()->associate($this->cart);
      $cred->save();
      return true;

    }
    public function set_datetime($date, $time){
        $parse_string = $date." ".$time;
        $start = Carbon::parse($parse_string,  'America/Toronto');
        $this->start = $start->format('Y-m-d H:i:s');
        $this->display_start = Carbon::createFromFormat('Y-m-d H:i:s',$this->start,'America/Toronto')->format('g:i A \\o\\n l\\, F j');
        $end = $start;
        if($this->length)$end->addMinutes(floor((int)$this->length));
        else $end->addMinutes(60);
        $this->end = $end->format('Y-m-d H:i:s');
        $this->display_end = Carbon::createFromFormat('Y-m-d H:i:s',$this->end,'America/Toronto')->format('g:i A \\o\\n l\\, F j');
    }
    public function email_student(){
        if(!$this->student_email || $this->student_emailed)return;
        Mail::to($this->student_email)->send(new TaggedInLesson($this));
        $this->student_emailed = 1;
        $this->save();
    }

    public function get_minutes(){
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$this->start,'America/Toronto');
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$this->end,'America/Toronto');
        return $start->diffInMinutes($end);
    }
    public function get_datetime_format(){
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$this->start,'America/Toronto');
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$this->end,'America/Toronto');
        return $start->format('g:i')." - ".$end->format('g:i A')." on ".$start->format('l\\, F j\\, Y');
    }
}
