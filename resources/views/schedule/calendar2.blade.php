@extends('layouts.app')

@section('content')
<div class="app">
<div class="side">
	<div class="month mdl-shadow--2dp">
	<div class="month_title">{{$thisweek->format('F Y')}}</div>
	<?php
	$month_year = $thisweek->format('F Y');
	$day1 = Carbon\Carbon::parse('first day of '.$month_year, 'America/Toronto');
	$day1_day = $day1->dayOfWeek;
	$current_week = $thisweek->weekOfYear;
	$current_month = $day1->month;
	?>
	<div class="month_head">
		<div>S</div>
		<div>M</div>
		<div>T</div>
		<div>W</div>
		<div>T</div>
		<div>F</div>
		<div>S</div>
	</div>
	<div class="month_days">
		@for($i=0;$i<7;$i++)
		<div class="small_week">
			@for($t=0;$t<6;$t++)
			<?php
			$temp_day1 = new Carbon\Carbon($day1);
			$temp_day1->addDays($i-$day1_day+ 7*$t);
			$addClass = "same_month";
			if($current_month != $temp_day1->month)$addClass = "different_month";
			$temp_thisweek = new Carbon\Carbon($thisweek);
			$temp_thisweek_end = new Carbon\Carbon($thisweek);
			if($temp_day1->between($temp_thisweek , $temp_thisweek_end->addDays(6)))$addClass = "thisweek";
			if($temp_day1->dayOfYear == Carbon\Carbon::now('America/Toronto')->dayOfYear)$addClass = "thisday";
			$thisweek_copy = new Carbon\Carbon($thisweek);
			$weeksback = 0;
			$weeksforward = 0;
			if(Carbon\Carbon::now('America/Toronto')->dayOfWeek == 0) $temp_last_sunday = Carbon\Carbon::now('America/Toronto')->startOfDay();
     		else $temp_last_sunday = Carbon\Carbon::now('America/Toronto')->previous(Carbon\Carbon::SUNDAY);
			if($temp_day1>$temp_last_sunday){
			$weeksforward = ceil($temp_day1->diffInDays($temp_last_sunday)/7) - 1;
			}else{
			$weeksback = ceil($temp_day1->diffInDays($temp_last_sunday)/7);
			}
			?>
			<a class="small_day {{$addClass}}" href="/calendar/{{$pro->id}}/{{$weeksforward}}/{{$weeksback}}" data-date="{{$temp_day1}}">
				{{$temp_day1->day}}
				</a>
			@endfor
		</div>
		@endfor
	</div>
	</div>
	<div class="tasklist mdl-shadow--2dp">
		 <h2 class="mdl-card__title-text">Your Upcoming Events</h2>
		 <?php
		 $temp_today = Carbon\Carbon::now('America/Toronto');
		 $maxnum = 0;
		 $collect = collect([]);
		foreach($pro->events->where('active',"1")->sortBy('start') as $ev){
		 	if($ev->end >$temp_today){
		 		$collect->push($ev);
		 	}
		}
		foreach($pro->events_pro->where('active',"1")->where('denied',"0")->sortBy('start') as $ev){
		 	if($ev->end >$temp_today){
		 		$collect->push($ev);
		 	}
		}

		 ?>

		 @foreach($collect->sortBy('start')->take(10) as $ev)
		 <a style="height:45px; line-height:15px; width:80%;"

		 @if($ev->is_lesson == 1)
			@if($ev->denied == 1)
			class="mdl-button mdl-js-button mdl-js-ripple-effect denied"
			@elseif($ev->is_alternative == 1&&$ev->confirmed == 0)
			class="mdl-button mdl-js-button mdl-js-ripple-effect alternative"
			@elseif($ev->confirmed == 0)
			class="mdl-button mdl-js-button mdl-js-ripple-effect pending"
			@else
			class="mdl-button mdl-js-button mdl-js-ripple-effect confirmed"
			@endif
		@else
		class="mdl-button mdl-js-button mdl-js-ripple-effect event"
		@endif
		   href="/event/edit/{{$user->id}}/{{$ev->id}}">
				<span style="font-size:15px;">{{$ev->title}}</span><br>
				<span style="font-size:12px;">{{$ev->display_start}}</span>
		 </a>
		 <br>
		 <br>
		 @endforeach
	</div>
</div>
<div class="content">
<div class="dash mdl-color--white mdl-shadow--2dp">
<div class="dash_header">
<button id="undo_icon" class="mdl-button mdl-js-button mdl-js-ripple-effect panel">
		<i class="icon material-icons">undo</i>
</button>
<button id="redo_icon" style="display:none" class="mdl-button mdl-js-button mdl-js-ripple-effect panel">
		<i class="icon material-icons">redo</i>
</button>

<div class="mdl-tooltip icon_tooltip" for="redo_icon">
Show Panel
</div>
<div class="mdl-tooltip icon_tooltip" for="undo_icon">
Hide Panel
</div>

<button  id="week_button" class="mdl-button mdl-js-button mdl-js-ripple-effect">
		Week
</button>
<button id="month_button" class="mdl-button mdl-js-button mdl-js-ripple-effect">
		Month
</button>




	<div class="page_change">
		<a href="{{url('/calendar/'.$pro->id.'/'.$page.'/'.((int)$prev+1))}}" class="mdl-button mdl-js-button mdl-js-ripple-effect week_change">
		<i class="icon material-icons">arrow_back</i>
 {{$lastweek->format('F j')}}
 to 
 {{$lastweek->addDays(6)->format('F j')}}
		</a>
			<a href="{{url('/calendar/'.$pro->id.'/'.((int)$page+1).'/'.$prev)}}" class="mdl-button mdl-js-button mdl-js-ripple-effect week_change">

 {{$nextweek->format('F j')}}
 to 
 {{$nextweek->addDays(6)->format('F j')}}
 <?php $nextweek->addDays(-6) ?>
 <i class="icon material-icons">arrow_forward</i>
		</a>
<?php
$lastmonth = new Carbon\Carbon($thisweek);
$lastmonth->addMonths(-1);
$lastmonth = Carbon\Carbon::parse('first day of '.$lastmonth->format('F Y'));
$nextmonth = new Carbon\Carbon($thisweek);
$nextmonth->addMonths(1);
$nextmonth = Carbon\Carbon::parse('first day of '.$nextmonth->format('F Y'));
$weeks_from_last_month = $lastmonth->diffInWeeks($thisweek);
$weeks_until_next_month = $nextmonth->diffInWeeks($thisweek)+1;


?>
		<a style="display:none;" href="{{url('/calendar/'.$pro->id.'/'.$page.'/'.((int)$prev+$weeks_from_last_month))}}?month_view=1" class="mdl-button mdl-js-button mdl-js-ripple-effect month_change">
		<i class="icon material-icons">arrow_back</i>
 {{$lastmonth->format('F Y')}}
		</a>

			<a style="display:none;" href="{{url('/calendar/'.$pro->id.'/'.((int)$page+$weeks_until_next_month).'/'.$prev)}}?month_view=1" class="mdl-button mdl-js-button mdl-js-ripple-effect month_change">

 
 {{$nextmonth->format('F Y')}}
 <i class="icon material-icons">arrow_forward</i>
		</a>
</div>



	</div>
<div class="dash_title" style="line-height:25px;">
<?php
$thisweek_dash = new Carbon\Carbon($thisweek);
?>
@if(!$is_me)
<span>{{$pro->firstname." ".$pro->lastname}}'s Calendar ---</span>
@else
@endif
{{$thisweek_dash->format('F jS')}} to {{$thisweek_dash->addDays(6)->format('F jS Y')}} 

</div>


</div>

<div style="display:none;" class="month_view mdl-shadow--2dp">
	<?php
	$month_year = $thisweek->format('F Y');
	$day1 = Carbon\Carbon::parse('first day of '.$month_year, 'America/Toronto');
	$day1_day = $day1->dayOfWeek;
	$current_week = $thisweek->weekOfYear;
	$current_month = $day1->month;
	?>
	<div class="month_view_head">
		<div>Sunday</div>
		<div>Monday</div>
		<div>Tuesday</div>
		<div>Wednesday</div>
		<div>Thursday</div>
		<div>Friday</div>
		<div>Saturday</div>
	</div>
	<div class="month_view_days">
		@for($i=0;$i<7;$i++)
		<div class="month_view_week">
			@for($t=0;$t<6;$t++)
			<?php
			$temp_day1 = new Carbon\Carbon($day1);
			$temp_day1->addDays($i-$day1_day+ 7*$t);
			if(!isset($first_day_of_month))$first_day_of_month = $temp_day1;
			$last_day_of_month = $temp_day1;
			$addClass = "same_month";
			if($current_month != $temp_day1->month)$addClass = "different_month";
			$temp_thisweek = new Carbon\Carbon($thisweek);
			$temp_thisweek_end = new Carbon\Carbon($thisweek);
			if($temp_day1->between($temp_thisweek , $temp_thisweek_end->addDays(6)))$addClass = "thisweek";
			if($temp_day1->dayOfYear == Carbon\Carbon::now('America/Toronto')->dayOfYear)$addClass = "thisday";
			$thisweek_copy = new Carbon\Carbon($thisweek);
			$weeksback = 0;
			$weeksforward = 0;
			$temp_last_sunday = Carbon\Carbon::now('America/Toronto')->previous(Carbon\Carbon::SUNDAY);
			if($temp_day1>$temp_last_sunday){
			$weeksforward = ceil($temp_day1->diffInDays($temp_last_sunday)/7) - 1;
			}else{
			$weeksback = ceil($temp_day1->diffInDays($temp_last_sunday)/7);
			}
			?>
			<div class="month_view_small_day event_click small_day {{$addClass}}" data-day="{{$temp_day1->dayOfYear}}" data-date="{{$temp_day1->format('F d Y')}}">
				{{$temp_day1->format("F d")}}
				<div class="month_view_events">
					
				</div>
				</div>
			@endfor
		</div>
		@endfor
	</div>
</div>

<div class="calendar">
<div class="times mdl-color--white mdl-shadow--2dp">
	<div class="time_header mdl-shadow--2dp">Times</div> 
	@for($i=0;$i<24;$i++)
	<div class="time">
	{{$i}}
	</div> 
	@endfor
</div>
<div class="week">
@for($t=0;$t<7;$t++)
	<?php $temp = new Carbon\Carbon($thisweek) ?>
	<?php $temp2 = new Carbon\Carbon($thisweek) ?>
	<?php $temp3 = Carbon\Carbon::now('America/Toronto') ?>
	<?php $is_today = $temp2->addDays($t)->toDateString() == $temp3->toDateString() ?>
	<?php $temp->addDays($t) ?>
   <div  index="{{$t}}" class="seventh mdl-color--light-grey-100" data-date="{{$temp->format('l\\, F j')}}"> 
   	@if($is_today)
   	<div class="day today mdl-shadow--3dp mdl-color--light-blue-100" data-date="{{$temp->format('l\\, F j')}}">
   	@elseif($temp->lt($temp3))
   	<div class="day before mdl-shadow--2dp mdl-color--white" >
   	@else 
   	<div class="day after mdl-shadow--2dp mdl-color--white" >
   	@endif
{{ $temp->format('l\\, F j')}}
   			</div>  
		@for($e=0;$e<48;$e++)
		<?php 
		if($e%2==0){
		$under_temp = Carbon\Carbon::parse($temp)->addHours($e/2);
		}else{
		$under_temp = Carbon\Carbon::parse($temp)->addHours($e/2)->addMinutes(30);
		}
		
		?>
			<div index="{{$e}}" data-datetime='{{$under_temp}}'
			data-time="{{$under_temp->format('g:i A \\o\\n l\\, F j')}}" 
			@if($is_me)
			data-end={{$under_temp->addMinutes(60)->format('g:iA')}}
			@else
			data-end={{$under_temp->addMinutes((int)$option->minutes)->format('g:iA')}}
			@endif
			class="under_seventh event_click"> 
   			</div>
   		@endfor
    </div>
@endfor
</div>
</div>
</div>

</div>

 <script type="text/javascript">


var now = new Date("{{Carbon\Carbon::now('America/Toronto')}}");
  jQuery(document).ready(function($) {

  		$('.panel').on('click', function(event) {
  			$('.side').toggle();
  			$('.panel').toggle();
  		});
  		$('#month_button').on('click',function(){
  			$('.month_view').css('display', 'block');
  			$('.calendar').css('display', 'none');
  			$('.month_change').css('display', 'inline-block');
  			$('.week_change').css('display', 'none');
  		});
  		$('#week_button').on('click',function(){
  			$('.month_view').css('display', 'none');
  			$('.calendar').css('display', 'flex');
  			$('.month_change').css('display', 'none');
  			$('.week_change').css('display', 'inline-block');
  		});
  		@if($month_view)
  		$('#month_button').trigger('click');
  		@endif

  		var times = $('div.time');
  		for(var t =0;t<times.length;t++){
  			var time = $(times[t]);
  			time.text(toTimeFormat(parseInt(time.text())));
  		}


var sevens = $('.seventh');
  		//phpbelow
 <?php
  		 $collect2 = collect([]);
		foreach($pro->events->where('active',"1")->sortBy('start') as $ev){
		 	
		 		$collect2->push($ev);
		 	
		}
		foreach($pro->events_pro->where('active',"1")->sortBy('start') as $ev){
		 	
		 		$collect2->push($ev);
		 	
		}
?>
@foreach($collect2->sortBy('start') as $event)
<?php
$start = Carbon\Carbon::parse($event->start, 'America/Toronto');
$end = Carbon\Carbon::parse($event->end, 'America/Toronto');
$index = $start->dayOfWeek;
$end_of_lastweek = new Carbon\Carbon($lastweek);
$end_of_lastweek->addDays(1);
$diff = $start->diffInMinutes($end);
?>
@if($start->between($end_of_lastweek, $nextweek))
var got = find_seventh({{$index}});
@for($i=0;$i<48;$i++)
	@if(($start->hour*2) == $i)
	@if($start->minute > 5)
	<?php $i++; ?>
	@endif
		@for($q=0;$q<($diff/30);$q++)
		var got_under = find_under_seventh(got,{{$i+$q}});
		@if($q == 0)
			@if($is_me)
			got_under.html("{{$event->title}}");
			@else
			got_under.html("Busy");
			@endif
		@endif
		@if($q == 1)
		got_under.html("{{Carbon\Carbon::parse($event->start)->format("g:i A")}} to {{Carbon\Carbon::parse($event->end)->format("g:i A")}}");
		@endif
		got_under.data('event', {!!$event!!});
		got_under.data('event_end', '{{Carbon\Carbon::parse($event->end)->format("g:i A")}}');
		
		got_under.data('type','event');
		@if($event->is_lesson == 1 && $is_me)
			@if($event->denied == 1)
			got_under.addClass('denied');
			@elseif($event->is_alternative == 1&&$event->confirmed == 0)
			got_under.addClass('alternative');
			@elseif($event->confirmed == 0)
			got_under.addClass('pending');
			@else
			got_under.addClass('confirmed');
			@endif
		@endif
		got_under.addClass('event');
		@endfor
	@endif
@endfor
@endif
@endforeach

@foreach($collect2->sortBy('start') as $event)
<?php
$start = Carbon\Carbon::parse($event->start, 'America/Toronto');
$index = $start->dayOfWeek;
$end = Carbon\Carbon::parse($event->end, 'America/Toronto');
?>
@if($start->between($first_day_of_month, $last_day_of_month))

var event = find_month_day({{$start->dayOfYear}});
 event.data('event', {!!$event!!});
 event.data('type', "event");
 event.data('event_end', '{{Carbon\Carbon::parse($event->end)->format("g:i A")}}');
 event.addClass('event_click');
 event.addClass('month_button');
 	@if($event->is_lesson == 1 && $is_me)
			@if($event->denied == 1)
			event.addClass('denied');
			@elseif($event->is_alternative == 1&&$event->confirmed == 0)
			event.addClass('alternative');
			@elseif($event->confirmed == 0)
			event.addClass('pending');
			@else
			event.addClass('confirmed');
			@endif
	@else
	event.addClass('event');
	@endif
	 @if($is_me)
event.html("{{$event->title or 'Busy'}}, {{$start->format('g:i A')}}-{{$end->format('g:i A')}}");
	@else
event.html("Busy, {{$start->format('g:i A')}}-{{$end->format('g:i A')}}");
	@endif
@endif
@endforeach
//edn php

$('.event_click').on('click', function(e){
eTarget = $(e.target);
var $this = $(this);
var append = $this;
if($this.data('datetime')){
var click_now = new Date($this.data('datetime'));
}else if($this.data('date')){
var click_now = new Date($this.data('date'));
}

if(eTarget.closest('.month_button').length > 0){
	$this = eTarget.closest('.month_button');
	append = $this.parent();
}
$('.popup').remove();
$('.under_seventh').removeClass('selected');
$('.event_click').removeClass('selected');
$('body').removeClass('selected');
console.log('under_seventh clicked');

var title = false;
var action = false;
var info = [];
var buttons = [];
var notes = false;
switch($this.data('type')){
case 'event':
var event = $this.data('event');
info.push(['When: ', event.display_start +' - '+$this.data('event_end')]);
@if($is_me)
title = event.title;
if(event.location)info.push(['Location: ', event.location]);
if(event.address)info.push(['Address: ', event.address]);
if(event.notes)info.push(['Notes: ',event.notes]);
if(event.is_lesson == 1 && event.status == 'pending' && event.pro_id == {{$user->id}}&&event.is_alternative!=1){
	console.log('is lesson');
	//info.push(['Price: ',"$"+event.price+" per hour"]);
	buttons.push(['Confirm Lesson','/event/'+event.id+'/confirm']);
	buttons.push(['Deny Lesson','/event/'+event.id+'/deny']);
	buttons.push(['View Event','/event/alternatives/'+event.id]);
}else if(event.is_lesson == 1 && event.status == 'pending' && event.user_id == {{$user->id}}&&event.is_alternative==1){
//info.push(['Price: ',"$"+event.price+" per hour"]);
buttons.push(['Confirm Lesson','/alternative/'+event.id+'/confirm']);
buttons.push(['Deny Lesson','/alternative/'+event.id+'/deny']);
buttons.push(['View Details',"/event/edit/{{$pro->id}}/"+event.id]);

}else{
buttons.push(['Edit event',"/event/edit/{{$pro->id}}/"+event.id]);
	if(event.is_lesson != 1){
	buttons.push(['Delete Event','/event/delete/'+event.id]);
	}
}
@else
title = "Busy";
@endif
break;
default:

	$this.addClass('selected');
	@if($is_me)
	var minutes = 60;
	@else
	var minutes = {{(float)$option->minutes}};
	@endif
	
	var fake_next = $this;
	for(var d=1;d<(minutes)/30;d++){
	fake_next = fake_next.next('.under_seventh');
	fake_next.addClass('selected');
	}
	
	if($this.data('time')){
	info.push(['When: ', $this.data('time')+ ' - '+$this.data('end')]);
	info.push(['', '<input type="hidden" name="start" value="'+$this.data('time')+'">']);
	}
	if($this.data('date')){
		@if(!$is_me)
		if(click_now < now)return;
		@endif
	info.push(['', '<input type="hidden" value="'+$this.data('date')+'" name="date" >']);
	info.push(['', '<input type="hidden" value="1" name="is_month_event" >']);
	info.push(['Date: ', $this.data('date')]);
	info.push(['Start: ', '<input type="time" step="1800" name="time" required>']);
	var select = '<select name="duration" required>';
	select +='<option value=".5">30 Minutes</option>';
	select +='<option value="1" selected>1 Hour</option>';
	select +='<option value="1.5">1 Hour 30 Minutes</option>';
	select +='<option value="2">2 Hours</option>';
	select +='<option value="2.5">2 Hours 30 Minutes</option>';
	select +='<option value="3">3 Hours</option>';
	select +='<option value="3.5">3 Hours 30 Minutes</option>';
	select +='<option value="4">4 Hours</option>';
	select +='</select>';
	@if($option)
	info.push(['', '<input type="hidden" value="{{((float)$option->minutes)/60}}" name="duration" >']);
	info.push(['Duration: ', '{{$option->minutes}} Minutes']);
	info.push(['Lesson Option: ', '{{$option->title}}']);
	info.push(['', '<input type="hidden" value="{{$option->id}}" name="option">']);
	@else
	info.push(['Duration: ', select]);
	@endif
	
	}
	info.push(['', '<input type="hidden" value="1" name="is_from_calendar">']);
@if($is_me)
	title = "Event";
	action = '/calendar/save';
	info.push(['Title: ', '<input type="text" placeholder="event name..." name="title">']);
	info.push(['Where: ', '<input type="text" placeholder="where..." name="location">']);
	info.push(['Email of Student: ', '<input type="text" placeholder="Student Email" name="student_email">']);
	buttons.push(['Create event',true,true]);
	buttons.push(['Edit event',"/event/edit", 2]);
	notes = true;
@else
	if(click_now < now)return;
	@if($option && $cart)
	title = "Request Lesson with {{$pro->firstname}} {{$pro->lastname}}";
	action = '/calendar/lesson';
	info.push(['', '<input type="hidden" value="{{$user->firstname}} {{$user->lastname}}\'s lesson with {{$pro->firstname}} {{$pro->lastname}}" name="title">']);
	info.push(['', '<input type="hidden" value="1" name="is_lesson">']);
	info.push(['', '<input type="hidden" value="{{$pro->id}}" name="pro">']);
	info.push(['', '<input type="hidden" value="{{$pro->location}}" name="location">']);
	info.push(['', '<input type="hidden" value="{{$pro->address}}" name="address">']);
	//info.push(['', '<input type="hidden" value="{{$option->price}}" name="lesson_price">']);
	info.push(['', '<input type="hidden" value="{{$option->id}}" name="option">']);
	info.push(['Where: ', '{{$pro->location}} at {{$pro->address}}']);
	//info.push(['Price: ', '${{$option->price}}']);
	info.push(['Lesson Option: ', '{{$option->title}}']);
	info.push(['Remaining Lessons to Book: ', '{{$cart->remaining}}']);
	buttons.push(['Request Lesson',1,1]);
	buttons.push(['Edit Request',"/event/edit/{{$pro->id}}", 2]);
	notes = true;
	@endif
@endif
	
}


append.parent().append(create_grid(title, action,info,buttons,notes));
var $popup = $('.popup');
if($this.attr('index') && parseInt($this.attr('index'))>7){
$popup.css('top', $this.position().top - $popup.height() - 20);
}else{
	$popup.css('top', $this.position().top + 50);
}
if($this.parent().attr('index') && parseInt($this.parent().attr('index'))>4){
	$popup.css('left', -1*$popup.width() + $this.width());
}
$('.close_grid').on('click', function(event) {
	event.preventDefault();
	$popup.remove();
	$('.under_seventh').removeClass('selected');
	$('.event_click').removeClass('selected');
	$('body').removeClass('selected');
});
$('.more_info_click').on('click', function(e){
  			e.preventDefault();
  			console.log('edit event click');
  			var self = $(this);
  			var old_href = self.attr('href');
  			var close_form = self.closest('form');
  			close_form.attr('action', old_href);
  			close_form.attr('method',"GET");
  			close_form.trigger('submit');
  		});
});

  });

  function find_seventh(index){
  	var sevens = $('.seventh');
  	for(var i = 0;i<sevens.length;i++){
	var temp = $(sevens[i]);
		if(parseInt(temp.attr('index'))==index){
		return temp;
		}
	}

  }

  function find_under_seventh(seventh, index){
  		var childs = $(seventh).children('.under_seventh');
		for(var t =0;t<childs.length;t++){
			var temp2 = $(childs[t]);
			if(parseInt(temp2.attr('index'))==index){
				return temp2;
			}
		}
  }
  function create_grid(title, action, array, buttons, notes){
  	var grid = '<div style="width:400;" class="popup mdl-card mdl-shadow--2dp mdl-color--white-100 is-casting-shadow"> <div class="mdl-card__title mdl-color-text--red-400"> <h2 class="mdl-card__title-text " style="margin-right: 30px;">';
 	grid += title;//title
 	grid += '</h2> </div> <div class="mdl-card__supporting-text display-1">';
 	grid += '<form action=';
 	grid += '"'+action+'" ';//form action
 	grid += ' method="post">';
 	grid += '{{ csrf_field() }}';
 	for(var i=0;i<array.length;i++){
 		if(array[i]){
 	grid +=  '<div style="display:flex;"> <div class="minititle">'+array[i][0]+'</div>';
 	grid += '<div>'+array[i][1]+'</div></div>';
 		}
 	}
 	if(notes){
 	grid += '<textarea class="mdl-textfield__input" style="height:55px;" name="notes" placeholder="Notes here..."></textarea>';
 	}
 	grid +='<hr>';
 	for(var i=0;i<buttons.length;i++){
 		if(buttons[i][2] == 1){//meaning the type is submit
 		grid += '<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button"> '+buttons[i][0]+' </button>';
 		}else if(buttons[i][2] == 2){
 		grid += '<a href="'+buttons[i][1]+'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button more_info_click"> '+buttons[i][0]+' </a>';
 		}else{
 			grid += '<a href="'+buttons[i][1]+'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button"> '+buttons[i][0]+' </a>';
 		}
 	
 	}
 	grid += '</form>';
 	grid += '<div class="mdl-card__menu"> <a id="close_grid" class="close_grid mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"><i class="icon material-icons">close</i></a> </div>';
 	grid += '</div></div>';
 	//grid += '<div class="tri"></div>';
 	grid += '</div>';
 	return grid;
  }

  function find_month_day(day_from_year){
  	  var month_days = $('.month_view_small_day');

  	for(var i =0;i<month_days.length;i++){
  		var current = $(month_days[i]);
  		if(parseInt(current.data('day')) == day_from_year){
  			var event = $("<a style='line-height: 15px; text-overflow:ellipsis; height:16px; width:78%;overflow: hidden; white-space: nowrap; margin-top:3px;' class='month_event mdl-button mdl-js-button mdl-js-ripple-effect month_button'>Busy</a>");
  			current.append(event);
  			return event;
  		}
  	}
  	
  }
 </script>

 <style type="text/css">
 	.mdl-grid{
 		width: 100% !important;
 		margin: 0px;
 		padding: 0px;
 	}
 	.seventh{
 		width: 14.2% !important;
 		border-right: black 1px solid;
 		height: 1240px;
 		position: relative;
 	}
 	.under_seventh{
 		width: 100%;
 		height:24.1px;
 		border-bottom: black 1px solid;
 		text-overflow: ellipsis;
 		text-align: center;
 		 white-space: nowrap;
 		 overflow: hidden;
 		 background-color: rgba(227,242,253,.5);
 	}
 	.under_seventh:nth-child(even){
 		border-bottom: black 1px dashed;
 	}
 	.times{
 		width:6.5%;
 		height: 1240px;

 	}
 	.time_header{
 		font-size: 18px;
 		text-align: center;
 		width: 100%;
 		height: 40px;
 	}
 	.time{
 		height: 49px;
 		border-top: black 1px solid;
 		border-left: black 1px solid;
 		text-align:center;
 	}
 	.seventh:first-of-type{
 		border-left: black 1px solid;
 	}
 	.day{
 		font-size: 21px;
 		text-align: center;
 		width: 100%;
 		height: 40px; 
 	}
 	.week{
 		width: 93.3%;
 		display: flex;
 	}
 	body{
 		/*background-color: #e1f5fe !important;*/
 	}
 	.dash{
 		width: 99.8%;
 		height: 100px;

 	}
 	.create_event{
 		min-height: 285px;
 		width: 500px;
 		position: absolute;
 		z-index: 1000;
 	}
 	.tri{
 		 
 		 height: 15px;
 		 width:15px;
 		 position: absolute;
 		 margin-top: 275px;
 		 margin-left:150px;
 		 z-index: 999;
 		 background: white;
 		 transform: rotate(45deg);
 		 box-shadow: 4px 4px 4px -3px #616161;

 	}
 	.minititle{
 		font-size: 17px;
 		margin-right: 2px;
 	}
 	.mdl-textfield__input{
 		font-family: 'Lato';
 		font-weight: 400;
 		color: black;
 	}
 	.page_change{
 		margin:10px;
 		float: right;
 	} 	
 	.event_button{
 		margin:5px;
 	}
 	.pending,.event.pending {
 		background: rgba(64,196,255,.5);
 		box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);
 	}
 	.denied,.event.denied {
 		background: rgba(255,138,128,.5);
 		box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);
 	}
 	.confirmed,.event.confirmed {
 		background: rgba(178,255,89,.5);
 		box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);	
 	}
 	.alternative,.event.alternative {
 		background:rgba(255,196,0,.5);
 		box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);
 	}
 	.popup{
 		position: absolute;
 	}
 	.selected,.event.selected{
 		background: rgba(128,216,255,.5);	

 	}
 	.event{
 		background: rgba(105,240,174,.5);
  		box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);
  		cursor: pointer;
 	}
 	.under_seventh:hover{
 		background-color: rgba(158,158,158,.2);
 	}
 	.content{
 		width:100%;
 	}
 	.side{
 		min-width: 180px;
 		margin-right: 20px;
 	}
 	.month{
 		width:100%;
 		margin:10px;
 		height: 180px;
 		background: white;
 	}
 	.app{
 		display: flex;
 		width:100%;
 	}
 	.calendar{
 		display: flex;
 	}
 	.small_week{
 		height: 100%;
 		width: 13.5%;
 	}
 	.small_day{
 		width: 100%;
 		height: 16%;
 		text-align:center;
 		cursor: pointer;
 		display: block;
 		color:#616161;
 		text-decoration: none;
 	}
 	.small_day:hover{
 		background: rgba(79, 195, 247,.3);
 	}
 	.day_letter{
 		width: 100%;
 		height: 16%;
 		text-align:center;
 	}
 	.month_head{
 		width: 100%;
 		height: 25px;
 		display: flex;
 	}
 	.month_days{
 		display: flex;
 	}
 	.month_head>div{
 		width:13.5%;
 		text-align: center;
 	}
 	.month_title{
 		text-align: center;
 		font-size: 25px;
 		margin-bottom: 10px;
 		margin-top: 2px;
 	}
 	.different_month{
 		background: rgba(8,8,8,.1);
 	}
 	.same_month{
 		background: rgba(256,256,256,.2);
 	}
 	.thisweek{
 		background: #B3E5FC;
 		background: rgba(179, 229, 256, .2);
 	}
 	.thisday{
 		background: #B3E5FC;
 	}
 	.tasklist{
 		width: 100%;
 		margin:10px;
 		min-height:500px;
 		background: white;
 	}
 	.dash_title{
 		text-align: center;
    font-size: 30px;
    margin-top: 20px;
 	}
 	.month_view{
 		width: 99.8%;
 	}
 	.month_view_head{
 		width: 100%;
 		height: 50px;
 		display: flex;
 	}
 	.month_view_head>div{
 		width: 15%;
 		text-align: center;
 		font-size: 23px;
 		background: white;
 		border-bottom: 1px black solid;
 		border-right:1px black solid;
 	}
 	.month_view_days{
 		display: flex;
 		width:100%;
 	}
 	.month_view_week{
 		width: 15%;
 		height:1500px;
 	}
 	.dash_header{
 		width: 100%;
 	}
 	.month_view_small_day{
 		border-bottom:1px #757575 solid;
 		border-right:1px #757575 solid;
 	}
 	.legend{
 	display: flex;
    width: 100%;
    margin:auto;
    margin-top: 10px;
    margin-bottom:10px;
    background: white;
    min-height: 50px;
 	}
 	.legend>div{
 		font-size: 18px;
 		width: 20%;
 		padding: 15px;
 	}
 	.legend>div:first-of-type{
 		margin-left:10%;
 	}
 	.legend>div:last-of-type{
 		margin-right:10%;
 	}
 </style>
 @if($is_me)
<div class="mdl-shadow--2dp legend">
	<div class="pending">Pending Lesson Request</div>
	<div class="confirmed">Confirmed Lesson</div>
	<div class="alternative">Alternative Lesson Request</div>
	<div class="event">Any Event</div>
</div>
@endif
@endsection
