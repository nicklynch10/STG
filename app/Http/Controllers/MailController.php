<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use App\User;
use Auth;
use App\Error;
class MailController extends Controller
{
    public function mail2(){//not used!!

    	$user = Auth::user();
    	
try {
    Mail::send('mail.welcome', ['user' => $user, 'pro'=>$user], function ($m) use ($user) {
            $m->from('info@swingtipsgolf.com', 'Swing Tips Golf');
            $m->to($user->email, $user->name)->subject('Your Reminder!');

        });
} catch (\Exception $e) {
    return 'Caught exception: '.  $e->getMessage();
}
    }

    public function mail(){
    	return Error::all();
    }
}
