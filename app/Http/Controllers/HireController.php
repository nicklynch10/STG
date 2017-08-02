<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Client;
use App\Hire;
use App\Http\Requests;
use App\Notifications;
use App\Notifications\RateSwingTip;
use App\Notifications\ResponseForSwingTip;
use App\Notifications\SwingTipDeclined;
use App\User;
use App\Video;
use Auth;
use Illuminate\Http\Request;
use App\Vimeo;
use Illuminate\Auth\Middleware\Authenticate;

class HireController extends Controller
{


    public function hire(User $pro){
      $user = Auth::user();
      $hire = new Hire;
      $hire->user()->associate($user);
      $hire->pro()->associate($pro);
    	$hire->save();
      return redirect('/hire/front/'.$hire->id);
    	//return view('hire.hire',['pro'=>$pro,'user'=>$user,'hire'=>$hire]);
    }

    public function hire_again(Hire $hire, Request $request){
      
       $pro = $hire->pro;
       $user = Auth::user();
       if(isset($request->field1))$hire->field1 = $request->field1;
       if(isset($request->field2))$hire->field2 = $request->field2;
       if(isset($request->field3))$hire->field3 = $request->field3;
       if(isset($request->field6))$hire->field6 = $request->field6;
       $hire->save();
       
       return view('hire.hire',['pro'=>$pro,'user'=>$user,'hire'=>$hire, 'request'=>$request]);
     
    }

    public function sendHire(Hire $hire, Request $request){
      if($hire->sent)return redirect("/response/done/".$hire->id);
    	$user = Auth::user();
      $pro = $hire->pro;
    	$hire->field1 = $request->field1;
    	$hire->field2 = $request->field2;
    	$hire->field3 = $request->field3;
    	$hire->field4 = $request->field4;
    	$hire->field5 = $request->field5;
    	$hire->field6 = $request->field6;
    	$hire->save();
      $cart = new Cart;
      $cart->set_cart_hire($hire);
    	return redirect('/cart');
    }
     public function hireSent(){
    	return view("hire.hireSent");
    }
     public function response(Hire $hire, Request $request){
       $user = $hire->pro;
       if($user->id != Auth::user()->id)return "no access";
       if($hire->failed||$hire->declined)return view('hire.new.failed');
       if($hire->replied)return redirect("/response/done/".$hire->id);
       if($hire->vimeo && $hire->vimeo->active){
        $vid = $hire->vimeo;
        }else{
        $vid = new Vimeo;
        $vid->set();
        $vid->title = "Swing Tip Response";
        $vid->type = 'response';
        $vid->redirect = "/response/".$hire->id;
        $vid->student()->associate($hire->user);
        $vid->pro()->associate(Auth::user());
        $vid->save();
        $hire->vimeo()->associate($vid);
        $hire->vimeo_set = 1;
        $hire->save();
        }
      //note that this resets the video upload for vimeo each time it refreshes
      return view("hire.new.response",['hire'=>$hire, 'vid'=>$vid]);
    }
     public function sendResponse(Request $request,Hire $hire){
       
        $hire->field4 = $request->field4;
        $hire->field5 = $request->field5;
        $hire->replied = 1;
        $hire->save();
        $hire->hire_done();
        

        $hire->user->notify(new ResponseForSwingTip($hire));
        $hire->user->notify(new RateSwingTip($hire));
        // $notification = new Notifications;
        // $notification->set('rating',$hire,$hire->user,$hire->pro);
        // $notification = new Notifications;
        // $notification->set('hire',$hire,$hire->user,$hire->pro);
        return redirect(url('/response/sent'));
    }
    public function responseSent(){
        return view("hire.hireSent");
    }

    public function show(Hire $hire){
      if(!$hire->replied)return back();
      if(Auth::user()->id == $hire->user->id){
        $hire->viewed = 1;
        $hire->save();
       }

        return view("hire.new.final", ['hire'=>$hire]);
    }

    ///////////////////////////////////////////////////////////////////////////////////
    //new as of 1/22/17
    public function upload_front(Hire $hire){
      $user = Auth::user();
      $vid = new Vimeo;
      $vid->set();
      $vid->type = 'swingtip';
      $vid->title = "Face-on (FO) View";
      $vid->redirect = "/hire/dtl/".$hire->id;
      $vid->hire()->associate($hire);
      $vid->student()->associate($user);
      $vid->pro()->associate($hire->pro);
      $vid->save();
      $hire->fv()->associate($vid);
      $hire->save();
      return view('hire.new.videos',['vid'=>$vid,'pro'=>$hire->pro,'step'=>1]);
    }

    public function upload_dtl(Hire $hire){
      $user = Auth::user();
      $vid = new Vimeo;
      $vid->set();
      $vid->type = 'swingtip';
      $vid->title = "Down-the-Line (DL) View";
      $vid->redirect = "/hire/questions/".$hire->id;
      $vid->hire()->associate($hire);
      $vid->student()->associate($user);
      $vid->pro()->associate($hire->pro);
      $vid->save();
      $hire->dtl()->associate($vid);
      $hire->save();
     return view('hire.new.videos',['vid'=>$vid,'pro'=>$hire->pro,'step'=>2]);
    }

    public function resubmit_upload_front(Hire $hire){
      $user = Auth::user();
      $vid = new Vimeo;
      $vid->set();
      $vid->type = 'swingtip';
      $vid->title = "Face-on (FO) View";
      $vid->redirect = "/hire/confirm/".$hire->id;
      $vid->hire()->associate($hire);
      $vid->student()->associate($user);
      $vid->pro()->associate($hire->pro);
      $vid->save();
      $hire->fv()->associate($vid);
      $hire->save();
      return view('hire.new.videos',['vid'=>$vid,'pro'=>$hire->pro,'step'=>1, 'other'=>"The previously uploaded Face-on (FO) view video has been removed, please resubmit your Face-on (FO) view video here."]);
    }

    public function resubmit_upload_dtl(Hire $hire){
      $user = Auth::user();
      $vid = new Vimeo;
      $vid->set();
      $vid->type = 'swingtip';
      $vid->title = "Down-the-Line (DL) View";
      $vid->redirect = "/hire/confirm/".$hire->id;
      $vid->hire()->associate($hire);
      $vid->student()->associate($user);
      $vid->pro()->associate($hire->pro);
      $vid->save();
      $hire->dtl()->associate($vid);
      $hire->save();
     return view('hire.new.videos',['vid'=>$vid,'pro'=>$hire->pro,'step'=>2,'other'=>"The previously uploaded Down-the-Line (DL) view video has been removed, please resubmit your Down-the-Line (DL) view video here."]);
    }



    public function questions(Hire $hire){

      return view('hire.new.questions',['hire'=>$hire]);
    }
    public function questions_save(Request $r,Hire $hire){
      $user = Auth::user();

      if($r->hireclub)$hire->hireclub = $r->hireclub;
        for($i=0;$i<20;$i++){
            $temp = 'specific'.$i;
            if($r->$temp)$hire->$temp = $r->$temp;
            if($r->$temp)$user->$temp = $r->$temp;
        }
      
        for($i=0;$i<20;$i++){
            $temp = 'hireinfo'.$i;
            if($r->$temp)$hire->$temp = $r->$temp;
        }
        for($i=0;$i<20;$i++){
            $temp = 'hireinfoquestion'.$i;
            if($r->$temp)$hire->$temp = $r->$temp;
        }
        $hire->save();
        $user->save();
      return redirect('hire/confirm/'.$hire->id);
    }

    public function confirm(Hire $hire){
      if(isset($hire->fv))$hire->fv->play();
      if(isset($hire->dtl))$hire->dtl->play();
      if(isset($hire->vimeo))$hire->vimeo->play();
      return view('hire.new.confirm',['hire'=>$hire]);
    }

    public function confirmed(Hire $hire){
      if($hire->user->id != Auth::user()->id)return "not valid...";
      if($hire->in_cart) return redirect('/cart');
      $cart = new Cart;
      $cart->set_cart_hire($hire);
      return redirect('/cart');

    }

    public function recieve(Vimeo $vid){
        $hire = $vid->response;
      if(!isset($hire))return "Hire not set";
        $hire->replied = 1;
        $hire->save();
        $hire->hire_done();
        $hire->user->notify(new ResponseForSwingTip($hire));
        $hire->user->notify(new RateSwingTip($hire));

        return redirect(url('/response/sent'));
    }

    public function respond(Hire $hire, Request $r){
      $user = Auth::user();
      if(!$hire->vimeo)return back();
      if($user->vimeos && $user->vimeos->where('type','drill')){
        foreach ($user->vimeos->where('type','drill') as $v) {
          $temp = 'drill'.$v->id;
            if($r->$temp && !$hire->drills->contains($v->id)){
              $drill = Vimeo::find((int)$v->id);
              $hire->drills()->attach($drill);
            }
        }
      }
      //this saves the drills
      //below submits the response
       $hire->replied = 1;
        $hire->save();
        $hire->hire_done();
        
        $hire->user->notify(new RateSwingTip($hire));
        $hire->user->notify(new ResponseForSwingTip($hire));
        return redirect(url('/response/sent'));

    }

    public function decline(Hire $hire){
      if(!$hire->id||$hire->replied||!$hire->sent||$hire->declined||$hire->failed)return back();
      if($hire->pro->id != Auth::user()->id)return back();
      return view('hire.new.decline',['hire'=>$hire]);
    }

    public function decline_save(Hire $hire, Request $r){
      if(!$hire->id||$hire->replied||!$hire->sent||$hire->declined||$hire->failed)return back();
      if($hire->pro->id != Auth::user()->id)return back();
      $hire->declined = 1;
      $hire->declined_reason = $r->decline_reasoning;
      $hire->issue_reason = $r->options;
      $hire->save();
      $hire->user->notify(new SwingTipDeclined($hire));
      $hire->hire_refund();
      return view('hire.new.decline_save');
    }
}
