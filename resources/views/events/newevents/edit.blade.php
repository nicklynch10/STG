@extends('layouts.app')
@section('content')

<form class="mdl-cell mdl-cell--12-col mdl-shadow--2dp mdl-color--white" method="POST" action="{{url('/newevent/edit/'.$e->id.'/save')}}">
 {{ csrf_field() }}
	<div style="text-align: center;">
	<div style="font-size:25px; line-height: 35px; width: 100%; " class="mdl-color-text--light-blue-300">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%; min-width: 270px; width: 50%; ">

        <input class="mdl-textfield__input"  value='{{$e->title or "Event"}}' type="text" name="title" id="title" style="height: 50px;font-size: 35px; text-align: center;">
        <label class="mdl-textfield__label" for="title">Event Title...</label>
      </div>

	</div>
	<div class="attr">When:
	
	</div> 
	<div class="row">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="min-width: 270px; width: 50%; ">
        <input class="mdl-textfield__input" type="date" name="date" id="date" style="text-align: center;" required 
        @if($temp->date) value="{{$temp->date}}" @endif>
        <label class="mdl-textfield__label" for="date">Event Date...</label>
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="min-width: 270px; width: 50%; ">
        <input class="mdl-textfield__input" type="time" name="time" id="time" style="text-align: center;" required
         @if($temp->time) value="{{$temp->time}}" @endif>
        <label class="mdl-textfield__label" for="time">Event Time...</label>
      </div>
       <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="min-width: 270px; width: 50%; ">
        <input class="mdl-textfield__input" type="number" min="0" name="minutes" id="minutes" style="text-align: center;" required
         @if($temp->length) value="{{$temp->length}}" @endif>
        <label class="mdl-textfield__label" for="minutes">Duration in Minutes...</label>
      </div>
	</div>
	<div class="attr" >Where:

	</div> 
	<div class="row">
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="min-width: 270px; width: 50%; ">
        <input class="mdl-textfield__input"  value="{{$e->location}}" type="text" name="location" id="location" style="text-align: center;">
        <label class="mdl-textfield__label" for="location">Event Location...</label>
      </div>
	</div>
	<div class="attr">Student Email (if applicable):
		
	</div>
	 <div class="row">
	 	<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="min-width: 270px; width: 50%; ">
        <input class="mdl-textfield__input" type="email" name="student_email" id="student_email" style="text-align: center;" 
        value="{{$e->student_email}}">
        <label class="mdl-textfield__label" for="student_email">Student Email...</label>
      </div>
	 </div>
	 <div class="attr">Notes:
	 </div>
	 <div class="row">
	 	<div style="min-width: 270px; width: 50%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:110px;" class="mdl-textfield__input" name="notes" id="notes" >{{$e->notes}}</textarea>
    <label class="mdl-textfield__label" for="notes">Notes...</label>
  </div>


	 </div>
	<hr>

<div class="button_container mdl-cell--12-col">
	<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--yellow-300 event_button"> Save </button>

	<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-400 event_button" href="{{url('/newevent/delete/'.$e->id)}}"> Delete Event </a>

</div>
</div>
</form>

<style type="text/css">
	.attr{
		font-weight: 300;
		font-size:23px;
		padding: 5px;
		color: #4fc3f7 !important;
	}
	.row{
		padding: 5px; font-size: 16px;
	}
	.button_container>.mdl-button{
		height: 50px;
    	width: 200px;
    	text-align: center;
    	line-height: 50px;
    	margin: 15px;
    	font-size: 22px;
	}
</style>
@endsection