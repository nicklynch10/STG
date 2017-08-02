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
	<?php
	$start = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$e->start,'America/Toronto');
	$now = Carbon\Carbon::now('America/Toronto');
	?>
@if($start>$now)
<div class="button_container mdl-cell--12-col">
	@if($e->is_lesson && $e->active == 1 && $e->status != 'pending' && !$e->denied)
	<div style="font-size:20px; line-height: 28px;" class="mdl-color-text--red-500">You must provide reasoning when cancelling a lesson</div>
	@if($is_pro)
	<div style="font-weight: 500;">Cancellation of a lesson will not refund their money, instead they will recieve a lesson credit with you.</div>
	@endif
	@if(!$is_pro)
	<span style="font-weight: 500;">You must cancel 24 hours prior to the lesson to receive lesson credit.</span>
	<div style="font-weight: 500;">Cancellation of a lesson will not refund your money, you will recieve a lesson credit for {{$e->pro->morphname()}}</div>
	@endif
	<br>
	<form action="{{url('/lesson/cancel/'.$e->id)}}">
	<div style="width: 100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:50px;" class="mdl-textfield__input" name="narrative" id="narrative" required></textarea>
    <label class="mdl-textfield__label" for="narrative">Reasoning for Cancellation...</label>
  </div>

		<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-400 event_button"> Cancel Lesson </button>
	</form>
	@endif

	@if($e->is_lesson && $e->status == 'pending' && $e->pro_id == Auth::user()->id && $e->is_alternative!=1)
	<div style="font-size:20px; line-height: 28px;" class="mdl-color-text--red-500">You must provide reasoning when denying a lesson</div>
	<div style="font-size:17px;">
	<?php
	$req_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$e->requested_at,'America/Toronto');
	$now = Carbon\Carbon::now('America/Toronto');
	$hours = 72 - $now->diffInHours($req_at);
	?>
	This lesson was requested at {{$req_at->format("g:i A \\o\\n l\\, F j\\, Y")}}, you have {{$hours}} hours to respond to this request
	</div>
	<br>
	<form action="{{url('/event/'.$e->id.'/deny')}}">
	<div style="width: 100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:50px;" class="mdl-textfield__input" name="narrative" id="narrative" required></textarea>
    <label class="mdl-textfield__label" for="narrative">Reasoning for Lesson Denial...</label>
  </div>
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button" href="{{url('/event/'.$e->id.'/confirm')}}"> Confirm Lesson </a>
	<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-400 event_button" href=""> Deny Lesson </button>
	</form>
	@endif

	@if(!$e->is_lesson)
	@if((!$e->is_camp && !$e->camp) || ($e->camp && $e->camp->user->id == Auth::user()->id))
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--yellow-300 event_button" href="{{url('/event/edit/'.Auth::user()->id.'/'.$e->id)}}"> Edit Event</a>
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-400 event_button" href="{{url('/event/delete/'.$e->id)}}"> Delete Event </a>
	@endif
	@endif

	@if($e->is_lesson && $e->denied && $e->active && $e->pro && $e->pro->id == Auth::user()->id)
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--yellow-300 event_button" href="{{url('/newevent/freeup/'.$e->id)}}"> Free up calendar time</a>
	@endif

	@if($e->camp&&$e->camp->user->id != Auth::user()->id &&$e->camp->users->contains(Auth::user()->id))
     <div style="font-weight: bold; font-size:17px;">Camp Enrollment is non refundable</div>
	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--yellow-300 event_button" href="{{url('/camp/unenroll/'.$e->camp->id)}}">Unenroll in this Camp</a>
	@endif
</div>
</div>
</div>
@endif
<style type="text/css">
	.attr{
		font-weight: 400; font-size:18px;padding: 5px;
	}
	.row{
		padding: 5px; font-size: 16px;
	}
</style>