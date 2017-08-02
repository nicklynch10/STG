<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\User;
use Auth;
use App\Error;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/locker');
    }
    public function welcome()
    {
        return view('home.welcome.welcome');
    }

    public function about(){
        return view('home.new.about_tabs');
    }
     public function how(){
        return view('home.howto.howto');
    }
    public function contact(){
        return view('home.contact');
    }

    public function demo(Request $r){
        try {
            Mail::send('mail.demorequest', ['r' => $r], function ($m){
                    $m->from('info@swingtipsgolf.com', 'Your Application');
                    $m->to('ahoch@swingtipsgolf.com', "Andrew")->subject('Demo Request');
                });
        } catch (\Exception $e) {
            return 'Caught exception: '.  $e->getMessage();
        }
        return redirect('/demo');
    }
    public function demorequested(){
        return view('home.new.demorequested');
    }
}
