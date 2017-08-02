<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/locker';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $request)
    {
        return Validator::make($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed',
             'bio' => 'max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    /////////////////////////////////////////
    public function apply()
    {
        return view('auth.apply');
    }

     public function register_save(Request $request)
    {   
        ///this one is used!!!!! 3/22/17
        $this->validate($request,[
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed'
          ]);
        if(!$request->email) return "invalid";
        if(!$request->password) return "invalid";
        if(!$request->firstname) return "invalid";
        if(!$request->lastname) return "invalid";
        if(count(User::all()->where('email',$request->email))>0) return "invalid";
        if(!$request->password_confirmation) return "invalid";
        if($request->password != $request->password_confirmation)return "invalid";

          $user = $this->set_user($request);
          $user->save();
          Auth::login($user);
          if(session('prosignup'))return redirect('/locker/'.session('prosignup'));
          return redirect('/locker');
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
        $user->phone = $request->phone;

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

    public function applySent(Request $request)
    {//this is used for pros
      $temp = Validator::make($request->all(),[
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|confirmed',
          ]);
        if($temp->fails()){
          return redirect('/apply')->withErrors($temp)->withInput();
        }else{
        $user = $this->set_user($request);
        $user->why = $request->why;
        $user->experience = $request->experience;
        $user->yoe = $request->yoe;
        $user->website = $request->website;
        $user->approved = 0;
        $user->requested = 1;
        $user->file = "url/to/resume";
        $user->pro = 1;
        $user->save();
        Auth::login($user);
        return view('auth.choose');
        }
        
        // if(!$request->email) return "invalid";
        // if(count(User::all()->where('email',$request->email))>0) return "invalid";
        // if(!$request->password) return "invalid";
        // if(!$request->firstname) return "invalid";
        // if(!$request->lastname) return "invalid";
        // if(!$request->password_confirmation) return "invalid";
        // if($request->password != $request->password_confirmation)return "invalid";
        
    }
    public function prosignup(User $user){
      if(!$user)return redirect('/home');
      session(['prosignup' => $user->id]);
      return redirect('/register');
    }



}
