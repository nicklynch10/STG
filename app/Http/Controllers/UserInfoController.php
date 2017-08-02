<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use App\Notifications\PasswordReset;
class UserInfoController extends Controller
{
    //

    public function edit(){
    	return view('userinfo.edit');
    }
    public function store(Request $r){
    	$user = Auth::user();
    	for($i=0;$i<20;$i++){
    		$tempfield = 'field'.$i;
    		if($r->$tempfield){
    			$user->$tempfield = $r->$tempfield;
    		}
    	}
    	$user->save();
    	return redirect('/locker');
    }
    public function view($user = false){
    	if(!$user)$user = Auth::user();
    	else $user = User::find((int)$user);
    	return view('userinfo.view',['user'=>$user]);
    }

     public function account(){
        $post = '/account/save';
        $info = collect([]);
        //$info->push(['fieldname','type of input', 'required?'])
        $info->push(['firstname',1,"First Name",1]);
        $info->push(['lastname',1,"Last Name",1]);
        $info->push(['bio',0,"Bio",1]);
        if(!Auth::user()->pro){
        $info->push(['handicap',2,"Handicap",0]);
        }
        $info->push(['age',2,"Age",0]);
        $info->push(['paypal_email',4,"PayPal Email (This is required for transfers to be made from Swing Tips Golf to your PayPal Account)",0]);
        $info->push(['paypal_email_confirmation',4,"PayPal Email Confirmation (only required if you change your PayPal email",0]);
        if(Auth::user()->pro){
        $info->push(['experience',0,"Experience as a pro",0]);
        $info->push(['yoe',2,"Years of Experience",1]);
        $info->push(['website',1,"Website URL",0]);
        $info->push(['accepts_swingtips',3,"Would you like to accept online lessons(SwingTips)?",1]);
        $info->push(['software',1,"Software Used to Analyze Swings",0]);
        $info->push(['swingtip_price',2,"Swing Tip Lesson Price",0]);
        //$info->push(['accepts_lessons',3,"Would you like to allow online lesson booking?",1]);
        }
        return view('userinfo.account', ['info'=>$info,'post'=>$post]);
    }
    public function account_store(Request $r){
        
        $user = Auth::user();
        $user->firstname = $r->firstname;
        $user->lastname = $r->lastname;
        $user->bio = $r->bio;
        $user->handicap = $r->handicap;
        $user->age = $r->age;
        if($r->paypal_email &&$r->paypal_email_confirmation){
            if($r->paypal_email == $r->paypal_email_confirmation){
                $user->paypal_email = $r->paypal_email;
            }
        }
        if($user->pro){
        $user->experience = $r->experience;
        $user->yoe = $r->yoe;
        $user->website = $r->website;
        $user->accepts_swingtips = $r->accepts_swingtips;
        $user->accepts_lessons = $r->accepts_lessons;
        $user->software = $r->software;
        $user->swingtip_price = $r->swingtip_price;
        }
        $user->save();

        return redirect('/locker');
    }
     public function address(){
        return view('userinfo.address');
    }

    public function address_store(Request $request){
        $user = Auth::user();
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;
        if($request->lat_lng){
        $user->lat = explode('|||||',$request->lat_lng)[0];
        $user->lng = explode('|||||',$request->lat_lng)[1];
        }
        $user->save();
        //return back();
        return redirect('/locker');
    }

     public function password(){//this uses the framework created for account for password
        $post = '/password/save';
        $info = collect([]);
        $info->push(['email',4,"Email",1]);
        $info->push(['old_password',5,"Old Password",1]);
        $info->push(['new_password',5,"New Password",1]);
        $info->push(['new_password_confirmation',5,"New Password Confirmation",1]);
        return view('userinfo.account',['info'=>$info, 'post'=>$post]);
    }
    public function password_store(Request $r){
        $user = Auth::user();
        if($r->old_password && $r->new_password && $r->new_password_confirmation){
            if($r->new_password == $r->new_password_confirmation 
                && strlen($r->new_password) > 5){
                if(Auth::attempt(['email' => $r->email, 'password' => $r->old_password])){
                    $user->password = bcrypt($r->new_password);
                    $user->save();
                    $user->notify(new PasswordReset);
                    return redirect('/locker');

                }
            }
        }
        return back();
    }
//////////////////////////////////////////////////
    //1/22/17
    public function shortgame(){
        return view('userinfo.shortgame');
    }
    public function shortgame_save(Request $r){
        $user = Auth::user();
        $user->shortgame0 = $r->shortgame0;
        $user->shortgame1 = $r->shortgame1;
        $user->shortgame2 = $r->shortgame2;
        $user->shortgame3 = $r->shortgame3;
        $user->save();
        if(isset($r->redirect))return redirect($r->redirect);
        return redirect('/locker');
    }
    public function general(){
        return view('userinfo.general');
    }
    public function general_save(Request $r){
        $user = Auth::user();
        for($i=0;$i<20;$i++){
            $temp = 'general'.$i;
            if($r->$temp)$user->$temp = $r->$temp;
        }
        $user->save();
        if(isset($r->redirect))return redirect($r->redirect);
        return redirect('/locker');
    }
    public function specific(){
        return view('userinfo.specific');
    }
    public function specific_save(Request $r){
        $user = Auth::user();
        for($i=0;$i<20;$i++){
            $temp = 'specific'.$i;
            if($r->$temp)$user->$temp = $r->$temp;
        }
        $user->save();
        if(isset($r->redirect))return redirect($r->redirect);
        return redirect('/locker');
    }

    public function student(User $user){
        if(!$user)return back();
         if($user->id == Auth::user()->id|| (Auth::user()->clients_pro && Auth::user()->clients_pro->contains($user->id))){
        return view('userinfo.view.all', ['student'=>$user]);
        }
        return back();
    }

    public function accountmenu(){
        return view('userinfo.menu');
    }
}
