<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class StatsController extends Controller
{
    //
    public function pros(){
    	$pros = User::all()->where('pro',1);
        $total = 0;
        $total_swingtips = 0;
        $total_camps = 0;
        $total_lessons = 0;
        $total_fees = 0;
        foreach ($pros as $pro) {
           $total_swingtips += $pro->swingtips_recieved;
            $total_lessons += $pro->lessons_recieved;
            $total_camps += $pro->camps_recieved;
            $total_fees += $pro->fees();
        }
        $total = $total_swingtips + $total_camps + $total_lessons+$total_fees;
        //to go live make this exclusive
        return view('stats.pros', ['pros'=>$pros,'total_swingtips'=>$total_swingtips,'total_camps'=>$total_camps, 'total_lessons'=>$total_lessons, 'total'=>$total, 'total_fees'=>$total_fees]);


    }

    public function students(){
    	$students = User::all()->where('pro',0);
    	$total = 0;
        $total_swingtips = 0;
        $total_camps = 0;
        $total_lessons = 0;
        $total_fees = 0;
        foreach ($students as $student) {
           $total_swingtips += $student->swingtips_spent;
            $total_lessons += $student->lessons_spent;
            $total_camps += $student->camps_spent;
            $total_fees += $student->fees();
        }
        $total = $total_swingtips + $total_camps + $total_lessons+$total_fees;

        return view('stats.students', ['students'=>$students,'total_swingtips'=>$total_swingtips,'total_camps'=>$total_camps, 'total_lessons'=>$total_lessons, 'total'=>$total, 'total_fees'=>$total_fees]);
    }


     public function student(User $user){
        if(!$user)return back();
        if($user->pro){
             return view('stats.pro',['user'=>$user]);
        }

        return view('stats.student',['user'=>$user]);
     }
}
