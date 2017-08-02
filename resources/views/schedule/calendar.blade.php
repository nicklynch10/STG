@extends('layouts.app')

@section('content')
<div class="dash mdl-color--white mdl-shadow--2dp">
	<div class="page_change">
		<a href="{{url('/calendar/'.$pro->id.'/'.$page.'/'.((int)$prev+1))}}" class="mdl-button mdl-js-button mdl-js-ripple-effect">
		<i class="icon material-icons">arrow_back</i>
 {{$lastweek->format('F j')}}
 to 
 {{$lastweek->addDays(6)->format('F j')}}
		</a>
			<a href="{{url('/calendar/'.$pro->id.'/'.((int)$page+1).'/'.$prev)}}" class="mdl-button mdl-js-button mdl-js-ripple-effect">

 {{$nextweek->format('F j')}}
 to 
 {{$nextweek->addDays(6)->format('F j')}}
 <?php $nextweek->addDays(-6) ?>
 <i class="icon material-icons">arrow_forward</i>
		</a>
	</div>
	@if($is_me)
	<div style="display:flex;">
	<div style="padding:3px;">
		Upcoming Events:
	</div>
	<div>
	@foreach($pro->events_pro->where('confirmed','1')->take(5) as $e)
	<a href="{{url('/event/'.$e->id)}}" class="mdl-button mdl-js-button mdl-js-ripple-effect">
	{{$e->title}}
	</a>
	@endforeach
	</div>
</div>
@endif
</div>

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
			<div index="{{$e}}" class="under_seventh"> 

   			</div>
   		@endfor
    </div>
@endfor
</div>
 <script type="text/javascript">
 var creating = false;
 var grid = '<div style="width:400;" class="create_event mdl-card mdl-shadow--2dp mdl-color--white-100 is-casting-shadow"> <div class="mdl-card__title mdl-color-text--red-400"> <h2 class="mdl-card__title-text">';
 @if($is_me)
 grid += 'Tag as busy during this time'
 @else
 grid += 'Lesson with {{$pro->firstname}} {{$pro->lastname}}'
 @endif
 grid += '</h2> </div> <div class="mdl-card__supporting-text display-1">';
 	grid += '<form action="/calendar/{{$pro->id}}/save" class="create_form" method="post">';
 	grid += '{{ csrf_field() }}';
 	grid +=  '<div style="display:flex;"> <div class="minititle">When: </div>';
 	grid += '<div class="add_time"> &nbsp;</div></div>';
 	@if(!$is_me)
 	grid +=  '<div style="display:flex;"> <div class="minititle">Where: </div>';
 	grid += '<div class="location"> {{$pro->location}}, {{$pro->address}}</div></div>';
 	grid +=  '<div style="display:flex;"> <div class="minititle">Price: </div>';
 	grid += '<div class="lesson_price"> ${{$pro->lesson_price}}</div></div>';
 	@endif
 	grid += '<textarea class="mdl-textfield__input" style="height:55px;" name="notes" placeholder="Notes here..."></textarea>';
 	@if(!$is_me)
 	grid += '<a href="#" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button edit_lesson"> Edit Lesson </a>';
 	@endif
 	@if($is_me)
	grid += '<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--light-blue-300 event_button"> Tag as Busy </button>';
 	@else
 	grid += '<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--light-blue-300 event_button"> Create Lesson </button>';
 	@endif
 	grid += '</form>';
 	grid += '<div class="mdl-card__menu"> <a id="close_grid" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"><i class="icon material-icons">close</i></a> </div>';
 	grid += '</div></div>';
 	grid += '<div class="tri"></div>';
 	grid += '</div>';
 	



  $('.seventh').on('click', function(e){
  	if($(e.target).closest('.create_event').hasClass('create_event')) return;
  	if($(e.target).closest('.under_seventh').hasClass('event')) return; 
  	if($(e.target).closest('.view_event').hasClass('view_event')) return;  
  	if($(e.target).closest('.under_seventh').hasClass('pending')) return;
  	if($(e.target).closest('.under_seventh').hasClass('unavailable')) return;  
  	if($(e.target).hasClass('day')) return;
  	if($(e.target).siblings('.day').hasClass('before')) return;
  	if($(e.target).siblings('.day').hasClass('today')) return;
 		$('.view_event').remove();
		$('.create_event').remove();
 		$('.tri').remove();
 		var $this = $(this);
 		var event = $(grid);
 		var top = e.clientY - $this.offset().top + $(window).scrollTop() -285;
 		var mouse = e.clientY+ $(window).scrollTop() - $('.time_header').position().top - 40;
 		var mouse2 = (mouse);
 		mouse = mouse/5;
 		mouse2 = mouse2/5;
 		mouse = toTimeFormat(round5(mouse)/10);
 		mouse2 = toTimeFormat((round5(mouse2)/10)+1);
 		event.css('top', top +'px');
 		var overlap = -1*(400 - $this.width())/4;
 		event.css('left', overlap+'px');
 		$(this).append(event);
 		$('.add_time').text(" "+ mouse + " - "+ mouse2 +" on " +$this.data('date'));
 		$('.create_form').append('<input type="hidden" name="start" value="'+mouse +' on ' +$this.data('date')+'" >');
 		$('.create_form').append('<input type="hidden" name="end" value="'+mouse2 +' on ' +$this.data('date')+'" >');
 		@if($is_me)
 		$('.create_form').append('<input type="hidden" name="status" value="busy" >');
 		$('.create_form').prepend('<input style="width:95%" type="text" name="title" placeholder="Name of event..." ><br>');
 		@else
 		$('.create_form').append('<input type="hidden" name="status" value="pending" >');
 		$('.create_form').append('<input type="hidden" name="title" value="Lesson Pending with {{$user->firstname}} {{$user->lastname}}" >');
 		@endif
 		$('.edit_lesson').attr('href','/event/new/{{$pro->id}}?date='+mouse+' on '+$this.data('date'));
 		$('#close_grid').on('click',function(){
 		$('.create_event').remove();
 		$('.tri').remove();
 		});
 	});
  jQuery(document).ready(function($) {
  		var times = $('div.time');
  		for(var t =0;t<times.length;t++){
  			var time = $(times[t]);
  			time.text(toTimeFormat(parseInt(time.text())));
  		}


var sevens = $('.seventh');
  		//phpbelow
@foreach($pro->events_pro->where('denied',"0") as $event)
<?php
$start = Carbon\Carbon::parse($event->start, 'America/Toronto');
$find = $start->hour*2;
$index = $start->dayOfWeek;
$size = 2;
if($start->minute == 30)$find++;
?>
@if($start->between($lastweek, $nextweek))
var got = find_seventh({{$index}});
var got_under = find_under_seventh(got,{{$find}});
@if($is_me)
got_under.text("{{$event->title}}");
got_under.data('other', {!!$event->user!!});
got_under.data('event', {!!$event!!});
got_under.next('.under_seventh').data('other', {!!$event->user!!});
got_under.next('.under_seventh').data('event', {!!$event!!});
@else
got_under.text("{{$event->status}}");
@endif
@if($event->confirmed == '1')
got_under.addClass('confirmed');
got_under.next('.under_seventh').addClass('confirmed');
@else
got_under.addClass('pending');
got_under.next('.under_seventh').addClass('pending');
@endif
got_under.next('.under_seventh').addClass('event');
got_under.addClass('event');
@endif
@endforeach
@foreach($unavailable[0] as $day)
find_seventh({{$day}}).children('.under_seventh').addClass('unavailable');
@endforeach
@foreach($unavailable[1] as $key=>$morning)
var temp = find_seventh({{$unavailable[3][$key]}});
var until = find_under_seventh(temp, {{(int)explode(':',$morning)[0]*2}});
until.prevAll().addClass('unavailable');
@endforeach
@foreach($unavailable[2] as $key=>$night)
var temp = find_seventh({{$unavailable[3][$key]}});
var until = find_under_seventh(temp, {{(int)explode(':',$night)[0]*2}});
until.nextAll().addClass('unavailable');
@endforeach
//edn php
@if($is_me)
$('.event').on('click', function(e){
if($(e.target).closest('.view_event').hasClass('view_event')) return; 
$('.view_event').remove();
$('.create_event').remove();
$('.tri').remove();
	var $this = $(this);
	var event = $this.data('event');
	var other = $this.data('other');
	console.log(event);
var grid2 = '<div style="width:500; height: 300px;" class="view_event mdl-card mdl-shadow--2dp mdl-color--white-100 is-casting-shadow"> <div class="mdl-card__title mdl-color-text--red-400"> <h2 class="mdl-card__title-text" style="margin-right:40px;">';
 	grid2 += event.title;
 	grid2 += '</h2> </div> <div class="mdl-card__supporting-text display-1">';
 	grid2 +=  '<div style="display:flex;"> <div class="minititle">When: </div>';
 	grid2 += '<div class="add_time"> '+event.display_start+' for 1 hour</div></div>';
 	grid2 +=  '<div style="display:flex;"> <div class="minititle">Where: </div>';
 	grid2 += '<div class="location"> '+event.location+', '+event.address+'</div></div>';
 	grid2 +=  '<div style="display:flex;"> <div class="minititle">Price: </div>';
 	grid2 += '<div class="lesson_price"> $'+event.price+'</div></div>';
 	grid2 += '<div style="height:55px;">&nbsp;'+event.notes+'</div>';
 	if(event.confirmed != "1"){
	grid2 += '<a href="/event/'+event.id+'/confirm" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--green-300 event_button"> Confirm Lesson </a>';
	grid2 += '<a href="/event/'+event.id+'/deny" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--red-300 event_button"> Deny Lesson </a>';
	grid2 += '<a href="/event/alternatives/'+event.id+'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--light-blue-300 event_button">View Event</a></div>';
	}else{
	grid2 += '<a href="/event/'+event.id+'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--light-blue-300 event_button"> View Lesson </a>';
	}
 	grid2 += '<div class="mdl-card__menu"> <a id="close_grid2" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"><i class="icon material-icons">close</i></a> </div>';
 	grid2 += '</div></div>';
 	grid2 += '</div>';
 	$this.prepend(grid2);
 	$('.view_event').css('position', 'absolute');
 	$('.view_event').css('margin-top', '-325px');
 	$('.view_event').css('margin-left', '-200px');

 	$('#close_grid2').on('click',function(e){
 		$('.view_event').remove();
 		$('.tri').remove();
 		});
 	
});
@endif
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
 	.pending{
 		background: #B9F6CA;
 		background: #00E676;
 	}
 	.unavailable{
 		background: #757575;
 		/*background: #FFEBEE;
 		background: #EF9A9A;*/
 	}
 	.confirmed{
 		background: #80D8FF;	
 	}
 	
 </style>
@endsection
