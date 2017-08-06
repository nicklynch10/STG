@extends('layouts.app')

@section('content')
@include('grid.separator',["size"=>1])
<div class="mdl-cell mdl-cell--10-col mdl-color--white mdl-card mdl-shadow--2dp">
<div class="mdl-card__title mdl-color-text--red-400 special_accent">
    <h2 class="mdl-card__title-text">Next Steps</h2><br>
  </div>
   <div style="width: 80%; margin: 15px;">
You may return to this page anytime by going to your locker and clicking "Next Steps".
</div>
  @if(Auth::check()&&Auth::user()->pro)
<a class="mdl-button mdl-js-button button_block mdl-color-text--light-green-500" href="{{url('/account')}}">
Input PayPal information to Accept Payment from Swing Tips Golf.
<br>
<i class="material-icons">account_balance</i>
</a> 
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--light-blue-500" href="https://www.paypal.com/welcome/signup">
Don't have a PayPal Account? Sign up for one here.
<br>
<i class="material-icons">build</i>
</a> 
<div style="width: 80%; margin: auto;">
Swing Tips Golf uses the technology PayPal provides to securely accept payments and transfer money to coaches without storing any bank account information.
</div>
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--red-500" href="{{url('/calendar/defaults')}}">
Set Your unavailable Times for Lessons
<br>
<i class="material-icons">query_builder</i>
</a> 
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--light-green-500" href="{{url('/academy/new')}}">Register an Academy, Golf Course, Golf Range and More
<br>
<i class="material-icons">golf_course</i>
</a>
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--blue-500" href="{{url('/dashboard/academy')}}">Find an Existing Academy
<br>
<i class="material-icons">school</i>
</a> 
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--green-500" href="{{url('/locker')}}">Finish and Go to Locker
<br>
<i class="material-icons">assignment_ind</i>
</a>   





@else



<a class="mdl-button mdl-js-button button_block mdl-color-text--light-green-500" href="{{url('/dashboard')}}">
Find a Coach
<br>
<i class="material-icons">account_circle</i>
</a> 
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--light-blue-500" href="{{url('/how')}}">
Learn How to Use
<br>
<i class="material-icons">build</i>
</a> 
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--red-500" href="{{url('/shortgame')}}">
Edit Shortgame Information
<br>
<i class="material-icons">query_builder</i>
</a> 
<div style="width: 80%; margin: auto;">
It is highly recommended before submitting a Swing Tip (online lesson) that you fill in your Shortgame Information, Specific Swing Information and General Swing Information.
</div>
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--light-green-500" href="{{url('/specific')}}">Edit Specific Swing Information
<br>
<i class="material-icons">golf_course</i>
</a>
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--blue-500" href="{{url('/general')}}">
Edit General Swing Information
<br>
<i class="material-icons">school</i>
</a> 
<hr>
<a class="mdl-button mdl-js-button button_block mdl-color-text--green-500" href="{{url('/locker')}}">
Finish and Go to Locker
<br>
<i class="material-icons">assignment_ind</i>
</a>   
@endif


</div>
<style type="text/css">
	
.button_block{
width:100%; text-align:center; font-size:30px;
height: auto;
margin:30px 0px;
padding:15px 0px;
}
</style>
@endsection
