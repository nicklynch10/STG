@extends('layouts.app')
@section('content')
<div class="app">
	<div class="side">
	<div class="under_side">
		<div class="month mdl-shadow--2dp">
		<?php
	$month_year = $thisweek->format('F Y');
	$day1 = Carbon\Carbon::parse('first day of '.$month_year, 'America/Toronto');
	$day1_day = $day1->dayOfWeek;
	$current_week = $thisweek->weekOfYear;
	$current_month = $day1->month;
	?>
			@include('calendar.minimonth',['thisweek'=>$thisweek])
		</div>
		<div class="tasklist mdl-shadow--2dp" style="max-height: 520px; overflow-y: scroll;">
			@include('calendar.upcoming',['thisweek'=>$thisweek])
		</div>
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
				{{-- <button  id="week_button" class="mdl-button mdl-js-button mdl-js-ripple-effect">
				Week
				</button> --}}
				{{-- <button id="month_button" class="mdl-button mdl-js-button mdl-js-ripple-effect">
				Month
				</button> --}}
				<div class="page_change">
				@if($is_me)
				<a id="unavailable_button" href="{{url('/calendar/defaults')}}" class="mdl-button mdl-js-button mdl-js-ripple-effect week_change">
				<i class="icon material-icons">event_busy</i>
						Set Unavailable Times
					</a>
				@endif
				@if(!$is_me)
				<a id="unavailable_button" href="{{url('/locker/'.$pro->id)}}" class="mdl-button mdl-js-button mdl-js-ripple-effect week_change">
				<i class="icon material-icons">account_circle</i>
						Return to {{$pro->morphname()}}'s Locker
					</a>
				@endif
					<a href="{{url('/calendar/'.$pro->id.'/'.$page.'/'.((int)$prev+1))}}" class="mdl-button mdl-js-button mdl-js-ripple-effect week_change">

						<i class="icon material-icons">arrow_back</i>
						<span class="more_date_info">
						{{$lastweek->format('F j')}}
						to
						{{$lastweek->addDays(6)->format('F j')}}
						</span>
					</a>
					<a href="{{url('/calendar/'.$pro->id.'/'.((int)$page+1).'/'.$prev)}}" class="mdl-button mdl-js-button mdl-js-ripple-effect week_change">
					<span class="more_date_info">
					{{$nextweek->format('F j')}}
						to
					{{$nextweek->addDays(6)->format('F j')}}
					</span>
						
						<?php $nextweek->addDays(-6); ?>
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
			@include('calendar.new.week',['thisweek'=>$thisweek, 'pro'=>$pro])
		</div>
		<script type="text/javascript">
		var now = new Date("{{Carbon\Carbon::now('America/Toronto')}}");
		var first_seventh = $('.under_seventh[index=0]');
		var og_offset; 
		var og_offset2;
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

			og_offset = $('.day_title').offset().top;
			$('.mdl-layout__content').scroll(function(event) {
				console.log($('.mdl-layout__content').scrollTop());
			if($('.mdl-layout__content').scrollTop()>og_offset - 75){
				$('.day_title').css('position', 'absolute');
				$('.day_title').css('top', 68+ $('.mdl-layout__content').scrollTop()-og_offset);
				first_seventh.css('margin-top', '40px');
			}else{
				$('.day_title').css('top', 0);
				$('.day_title').css('position', 'relative');
				first_seventh.css('margin-top', '0px');
			}
			});
			$('.side').css('min-width', $('.side').width());
			og_offset2 = $('.under_side').offset().top;
			var og_width2 = $('.side').width()
			$('.mdl-layout__content').scroll(function(event) {
			if($('.mdl-layout__content').scrollTop()>og_offset2-75){
				$('.under_side').css('position', 'absolute');
				$('.under_side').css('top', $('.mdl-layout__content').scrollTop());
				$('.under_side').width(og_width2);
			}else{
				$('.under_side').css('top', 0);
				$('.under_side').css('position', 'relative');
			}
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
				if(!$is_me){
				foreach ($pro->events_pro->where('active','0')->where('user_id',(string)Auth::user()->id)->where('deleted', 0) as $ev) {
					$collect2->push($ev);
				}
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
		@for($i=0;$i<96;$i++)
		@if(($start->hour*4) == $i)
		@if($start->minute > 5)
		<?php $i++; ?>
		@endif
		@for($q=0;$q<($diff/15);$q++)
		var got_under = find_under_seventh(got,{{$i+$q}});
		@if($q == 0)
		@if($is_me || $event->user->id == Auth::user()->id)
		got_under.html("{{substr($event->title,0,15)}}");
		@endif
		@endif
		@if($q == 1)
		@if($is_me  || $event->user->id == Auth::user()->id)
		got_under.html("{{Carbon\Carbon::parse($event->start)->format("g:i A")}} to {{Carbon\Carbon::parse($event->end)->format("g:i A")}}");
		@endif
		@endif
		@if($event->is_lesson == 1)
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
		got_under.data('event', {!!$event!!});
		got_under.data('event_end', '{{Carbon\Carbon::parse($event->end)->format("g:i A")}}');
		
		got_under.data('type','event');
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
		var narrative = false;
		<?php
		$now3 = Carbon\Carbon::now('America/Toronto');
		if(isset($event->start)){
		$etime3 =  Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$event->start,'America/Toronto');
		}
		?>
		switch($this.data('type')){
		case 'event':
		@if(isset($event->start))
		var event = $this.data('event');
		info.push(['When: ', "{{$event->get_datetime_format()}}"]);
		@endif
		@if($is_me)
		title = event.title;
		if(event.location)info.push(['Location: ', event.location]);
		if(event.address)info.push(['Address: ', event.address]);
		if(event.notes)info.push(['Notes: ',event.notes]);
		if(event.is_lesson == 1 && event.status == 'pending' && event.pro_id == {{$user->id}}&&event.is_alternative!=1){
			@if(isset($event)&&$event&& $now3<$etime3)
		@if(isset($event)&&$event&& $event->requested_at)
		<?php
		$req_at = Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$event->requested_at,'America/Toronto');
		$now2 = Carbon\Carbon::now('America/Toronto');
		$hours2 = 72 - $now2->diffInHours($req_at);
		?>
		info.push(['<br>This lesson was requested at {{$req_at->format("g:i A \\o\\n l\\, F j\\, Y")}}, you have {{$hours2}} hours to respond to this request','']);
		@endif
		console.log('is lesson');
		info.push(['<br>Please provide reasoning if lesson is denied','']);
		action = '/event/'+event.id+'/deny';
		var tt = '<textarea style="width:100%; min-height:50px;" class="mdl-textfield__input" name="narrative" id="narrative" required></textarea>';
		info.push([tt,'']);
		
		buttons.push(['Confirm Lesson','/event/'+event.id+'/confirm',2]);
		buttons.push(['Deny Lesson',1, 1]);
		@endif
		buttons.push(['View Event','/event/'+event.id]);
		}else{
		if(event.is_lesson == 1){
		buttons.push(['View Event',"/event/"+event.id]);
		}else{
		@if(isset($event)&&$event&& $now3>$etime3)
		buttons.push(['Edit Event',"/newevent/"+event.id]);
		@endif
		}
		if(event.is_lesson != 1){
		buttons.push(['Delete Event','/event/delete/'+event.id]);
		}else if(event.denied == 0){
		@if(isset($event)&&$event&&$now3>$etime3)
		info.push(["{{$now3}}",'']);
		info.push(['Cancelling a lesson wil credit a students account','']);
		info.push(['<br>Please provide reasoning for any cancellation','']);
		action = "{{url('/lesson/cancel/')}}/"+event.id;
		var tt = '<textarea style="width:100%; min-height:50px;" class="mdl-textfield__input" name="narrative" id="narrative" required></textarea>';
		buttons.push(['Cancel Lesson',1,1]);
		info.push([tt,'']);
		//buttons.push(['Cancel Lesson','/event/cancel/'+event.id]);
		@endif
		}else if(event.denied == 1){
			@if(isset($event)&&$event&& $now3>$etime3)
		buttons.push(['Free up time','/newevent/freeup/'+event.id]);
		@endif
		}
		}
		@else
		title = "Busy";
		@endif
		if(event.active == 0){
			buttons.push(['Cancel Request','/event/cancel/request/'+event.id]);
		}
		break;
		default:
		$this.addClass('selected');
		@if($is_me)
		var minutes = 60;
		@else
		var minutes = {{(float)$option->minutes}};
		@endif
		
		var fake_next = $this;
		for(var d=1;d<(minutes)/15;d++){
		fake_next = fake_next.next('.under_seventh');
		fake_next.addClass('selected');
		}
		
		if($this.data('time')){
		info.push(['When: ', $this.data('time')]);
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
		info.push(['<br>Email of Student: ', '<input type="text" placeholder="Student Email" name="student_email">']);
		buttons.push(['Create event',true,true]);
		buttons.push(['Edit event',"/newevent", 2]);
		notes = true;
		var narrative = false;
		@else
		if(click_now < now)return;
		if($this.hasClass('unavailable'))return;
		//here is where it corrects for time overlaps
		var $selected = $('.selected');
		for(var ty = 0; ty<$selected.length;ty++){
			//console.log($($selected[ty]));
			if($($selected[ty]).hasClass('event'))return;
			if($($selected[ty]).hasClass('unavailable'))return;
		}
		@if($option && ($cart||$credit))
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
		@if($cart)
		info.push(['Remaining Lessons to Book: ', '{{$cart->remaining}}']);
		@endif
		@if($credit)
		info.push(['Amount of Lessons', '1']);
		info.push(['This lesson is booked using credit, therefore the title may not represent the correct quantity of the lesson.<br>', '']);
		info.push(['A request here spends your credit.<br>', '']);
		@endif
		info.push(['<b>24 Hour Cancellation Policy</b><br>', '']);
		buttons.push(['Request Lesson',1,1]);
		//buttons.push(['Edit Request',"/event/edit/{{$pro->id}}", 2]);
		notes = true;
		var narrative = false;
		@endif
		@endif
		
		}
		append.parent().append(create_grid(title, action,info,buttons,notes, narrative));
		var $popup = $('.popup');
		if($this.attr('index') && parseInt($this.attr('index'))>34){
		$popup.css('top', $this.position().top - $popup.height() - 20);
		}else{
		$popup.css('top', $this.position().top + 50);
		}
		if($this.parent().attr('index') && parseInt($this.parent().attr('index'))>4){
		$popup.css('left', -1*$popup.width() + $this.width());
		}

		if($(window).width() < 768){
			console.log($('body').scrollTop());
			$popup.css('top', $('.mdl-layout__content').scrollTop());	
			$popup.css('left', -1*$this.offset().left + 50);	
		}
		$('.close_grid').on('click', function(event) {
		event.preventDefault();
		$popup.remove();
		$('.under_seventh').removeClass('selected');
		$('.event_click').removeClass('selected');
		$('body').removeClass('selected');
		});
		$('.more_info_click').off('click');
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
	//javascript mobile fixes
		if($(window).width() < 768){
			og_offset += 9;
			$('#redo_icon').trigger('click');
		} 
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
		function create_grid(title, action, array, buttons, notes, narrative){
		var grid = '<div style="width:400;" class="popup mdl-card mdl-shadow--2dp mdl-color--white-100 is-casting-shadow"> <div class="mdl-card__title mdl-color-text--red-400"> <h2 class="mdl-card__title-text " style="margin-right: 30px;">';
			grid += title;//title
		grid += '</h2> </div> <div class="mdl-card__supporting-text display-1">';
		grid += '<form action=';
			grid += '"'+action+'" ';//form action
			grid += ' method="post">';
			grid += '{{ csrf_field() }}';
			for(var i=0;i<array.length;i++){
				if(array[i]&&array[i][0]&&array[i][1]){
				grid +=  '<div> <span class="minititle">'+array[i][0]+'</span>';
				grid += '<span style="float:right; line-height:20px; font-size:16px">'+array[i][1]+'</span></div>';
				}else if(array[i]&&(array[i][0]||array[i][1])){
				grid += '<span>'+array[i][1]+array[i][0]+'</span>';
				}
				}
				if(notes){
				grid += '<textarea class="mdl-textfield__input mdl-textfield--floating-label" style="height:55px;" name="notes" placeholder="Notes here..."></textarea>';
				}
				grid +='<hr>';
				for(var i=0;i<buttons.length;i++){
				if(buttons[i][2] == 1){//meaning the type is submit
				grid += '<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button"> '+buttons[i][0]+' </button>';
				}else if(buttons[i][2] == 2){

				grid += '<a href="'+buttons[i][1]+'"';
				if(buttons[i][0] == "Deny Lesson"){
					grid += 'class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button more_info_click deny_button"> '+buttons[i][0]+' </a>';	
				}else{
					 grid += 'class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button more_info_click"> '+buttons[i][0]+' </a>';
				}
				

				}else{
				grid += '<a href="'+buttons[i][1]+'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button"> '+buttons[i][0]+' </a>';
				}
				
				}
				if(narrative){
					  grid += '<textarea class="mdl-textfield__input" style="height:55px;" id="narrative" name="narrative" placeholder="Please provide a response if denying a lesson"></textarea>';
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
	<script type="text/javascript">
		
	</script>
	@include('calendar.new.style')
	
	<div class="mdl-shadow--2dp legend">
		<div class="pending">Pending Lesson Request</div>
		<div class="confirmed">Confirmed Lesson</div>
		<div class="unavailable">Unavailable Time</div>
		<div class="event">Any Event</div>
	</div>
	@endsection