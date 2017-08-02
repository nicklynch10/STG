<?php 
$is_pro = false;
if(Auth::user()->pro) $is_pro = true;
?>

<div class="mdl-cell mdl-cell--12-col mdl-shadow--2dp mdl-color--white">
	<div style="margin:10px; text-align: center;">
	<div style="font-size:25px; line-height: 35px;" class="mdl-color-text--light-blue-300">{{$e->title or "Event"}}</div>
	<div style="font-weight: 500; font-size:18px;">{{ Carbon\Carbon::parse($e->start)->format('l, F j \\f\\r\\o\\m g:i A ')}} to {{ Carbon\Carbon::parse($e->end)->format('g:i A')}} </div>
	<div style="font-style: italic;">{{(\Carbon\Carbon::parse($e->start)->diffForHumans())}}</div>
	@if($e->location || $e->address)
	<div class="attr" >Where:</div> 
	<div class="row">{{$e->location}} at {{$e->address}}</div>
	@endif
	@if($e->is_lesson)
	<div class="attr">Lesson Type:</div>
	<div class="row">{{$e->option->title}} </div>
	@endif
	@if($e->notes)
	<div class="attr">Notes:</div>
	 <div class="row">{{$e->notes}}</div>
	@endif
	@if($e->student_email)
	<div class="attr">Student Email:</div>
	 <div class="row">{{$e->student_email}}</div>
	 @endif
	<hr>

<div class="button_container mdl-cell--12-col">
	@if($e->is_lesson && $e->active == 1 && $e->status != 'pending')
	@if($is_pro)
	Cancelling a lesson will credit the student
	@endif
	@if(!$is_pro)
	To receive lesson credit, you must cancel 48 hours prior to the lesson
	@endif
	<br>
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-400 event_button" href="{{url('/lesson/cancel')}}"> Cancel Lesson </a>
	@endif

	@if($e->is_lesson && $e->status == 'pending' && $e->pro_id == Auth::user()->id && $e->is_alternative!=1)
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button" href="{{url('/event/'.$e->id.'/confirm')}}"> Confirm Lesson </a>
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-400 event_button" href="{{url('/event/'.$e->id.'/deny')}}"> Deny Lesson </a>
	@endif

	@if(!$e->is_lesson &&!($e->is_camp || $e->camp))
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--yellow-300 event_button" href="{{url('/event/edit/'.Auth::user()->id.'/'.$e->id)}}"> Edit Event</a>
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-400 event_button" href="{{url('/event/delete/'.$e->id)}}"> Delete Event </a>

	@endif
</div>
</div>
</div>

<style type="text/css">
	.attr{
		font-weight: 400; font-size:18px;padding: 5px;
	}
	.row{
		padding: 5px; font-size: 16px;
	}
</style>