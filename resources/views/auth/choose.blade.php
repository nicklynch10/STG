@extends('layouts.app')

@section('content')
@include('grid.separator',["size"=>1])
<div class="mdl-cell mdl-cell--10-col mdl-color--white mdl-card mdl-shadow--2dp">
<div class="mdl-card__title mdl-color-text--red-400 special_accent">
    <h2 class="mdl-card__title-text">Next Steps</h2>
  </div>
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
