<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


use App\Http\Requests;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Array $request)
    {
        return Validator::make($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed',
            'bio' => 'max:255',
             //'lat_lng'=> 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function register_save(Request $request)
    {   //not used
          $user = $this->set_user($request);
          $user->save();
          return redirect('/locker');
    }

     public function choose()
    {
        return view('auth.choose');
    }

    public function apply()
    {
        return view('auth.apply');
    }
    public function applySent(Request $request)
    {//not used
        $user = $this->set_user($request);
        $user->why = $request->why;
        $user->experience = $request->experience;
        $user->yoe = $request->yoe;
        $user->website = $request->website;
        $user->approved = 0;
        $user->requested = 1;
        $user->file = "url/to/resume";
        $user->save();
        return redirect('/locker/'.$user->id);
    }

    protected function set_user($request){
        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->password = bcrypt($request->password);
        $user->bio = $request->bio;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->handicap = $request->handicap;

        //address stuff
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;
        if($request->lat_lng){
        $user->lat = explode('|||||',$request->lat_lng)[0];
        $user->lng = explode('|||||',$request->lat_lng)[1];
        }
        //find and adds reference
        $reference = User::find((int)$request->reference_id);
        if($reference)$user->reference()->associate($reference);
        //pics
        $user->propic = "imgs/golf_sunset.png";
        $user->cover = "imgs/golf_sunset.png";
        $user->pro = 0;
        return $user;
    }


}
