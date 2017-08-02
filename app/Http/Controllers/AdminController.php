<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Auth;

class AdminController extends Controller
{
    
    public function approve_pros(){

    	$user = Auth::user();
    	if($user->id == 1){
    		$users = User::all()->where('pro','1')->where('approved','0');
    	return view('admin.approve',['users'=>$users]);
    	}
    	return "no Access";
    	
    }
    public function approve(User $pro){
    	$pro->approved = 1;
    	$pro->save();
    	return back();

    }
    public function deny(User $pro){
    	$pro->approved = 0;
    	$pro->pro = 0;
    	$pro->save();
    	return back();
    }
}
