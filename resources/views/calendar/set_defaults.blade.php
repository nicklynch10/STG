@extends('layouts.app')
@section('content')
<form method="post" action="/calendar/defaults/save" style="width:100%; background-color:white;">
 {{ csrf_field() }}
<button style="font-size:22px;" class="mdl-button mdl-js-button mdl-button--colored mdl-color-text--green-500" type="submit">Save Unavailable Times</button>
<a style="font-size:22px;" class="clear_times mdl-button mdl-js-button mdl-button--colored mdl-color-text--light-blue-500">Clear All Unavailable Times</a>
<a style="font-size:22px;" class="mdl-button mdl-js-button mdl-button--colored mdl-color-text--red-500" href="/calendar">Cancel</a>
<div style="width:100%; text-align:center;font-size:27px; padding-top:20px; padding-bottom: 20px; background-color:white;">Click and drag to select times you will never accept lessons. Click again to make it available.
<br>
<span style="font-size:15px;">Being very accurate with this allows clients to be more confident about which times they choose when they request a lesson with you.</span>
</div>
<div style="width:100%; display:flex;">

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
   <div index="{{$t}}" class="seventh mdl-color--light-grey-100" data-date="{{$temp->format('l')}}"> 
   	<div class="day after mdl-shadow--2dp mdl-color--white" >
{{ $temp->format('l')}}
   			</div>  
		@for($e=0;$e<48;$e++)
		<?php 
		if($e%2==0){
		$under_temp = Carbon\Carbon::parse($temp)->addHours($e/2);
		}else{
		$under_temp = Carbon\Carbon::parse($temp)->addHours($e/2)->addMinutes(30);
		}
		$un_str = $t.'|||'.$e;
		?>
			@if(!Auth::user()->unavailable||!(int)Auth::user()->unavailable->$un_str)
			<div index="{{$e}}" data-datetime='{{$under_temp}}'
			data-time="{{$under_temp->format('g:i A \\o\\n l\\, F j')}}"
			class="under_seventh event_click"> 
			<input class="input_under_seventh" type="hidden" name="{{$t.'|||'.$e}}" value="0">
   			</div>
   			@else
   			<div index="{{$e}}" data-datetime='{{$under_temp}}'
			data-time="{{$under_temp->format('g:i A \\o\\n l\\, F j')}}"
			class="under_seventh event_click unavailable"> 
			<input class="input_under_seventh" type="hidden" name="{{$t.'|||'.$e}}" value="1">
   			</div>
   			@endif
   		@endfor
    </div>
@endfor
</div>
</div>
</div>
</div>
<div style="width:100%; text-align:center; margin-top:25px;">
<button style="font-size:22px;" class="mdl-button mdl-js-button mdl-button--colored mdl-color-text--green-500" type="submit">Save Unavailable Times</button>
<a style="font-size:22px;" class="clear_times mdl-button mdl-js-button mdl-button--colored mdl-color-text--light-blue-500">Clear All Unavailable Times</a>
<a style="font-size:22px;" class="mdl-button mdl-js-button mdl-button--colored mdl-color-text--red-500" href="/calendar">Cancel</a>
</div>
</form>
@include('calendar.style')

<script type="text/javascript">
				var times = $('div.time');
				for(var t =0;t<times.length;t++){
					var time = $(times[t]);
					time.text(toTimeFormat(parseInt(time.text())));
				}
				var unavailable = $('.unavailable');
				var drag = false;
				var add = true;
				var remove = false;
				$('.under_seventh').on('click', function(event) {
					var $this = $(this);
					toggleUnavailable($this);
				});

				$('body').on('mousedown', function(event) {
					event.preventDefault();
					drag = true;
					});
				$('body').on('mouseup', function(event) {
					event.preventDefault();
					drag = false;
					});

				$('.under_seventh').mousemove(function(event) {
					var self = $(this);
					if(drag && add){
						addUnavailable(self);
					}
				});

		function toggleUnavailable(self){
			var i = self.find('input.input_under_seventh');
			if(!self.hasClass('unavailable')){
			self.addClass('unavailable');
			i.val('1');
			}else{
			self.removeClass('unavailable');
			i.val('0');
			}
		}
		function addUnavailable(self){
			if(!self.hasClass('unavailable')){
			var i = self.find('input.input_under_seventh');
			self.addClass('unavailable');
			i.val('1');
			}
		}
		$('.clear_times').on('click', function(event) {
			event.preventDefault();
			var un = $('.unavailable');
			for(var i=0;i<un.length;i++){
				var un_un = $(un[i]);
				un_un.find('input.input_under_seventh').first().val('0');
			}
			un.removeClass('unavailable');
		});	
				

</script>
<style type="text/css">
	.unavailable{
		cursor:row-resize;
		background-color: #E57373;
	}
	.unavailable:hover{
		background-color:#E57373;
	}
</style>
@endsection