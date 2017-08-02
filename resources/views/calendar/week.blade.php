
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
	<?php $temp = new Carbon\Carbon($thisweek); ?>
	<?php $temp2 = new Carbon\Carbon($thisweek); ?>
	<?php $temp3 = Carbon\Carbon::now('America/Toronto'); ?>
	<?php $is_today = $temp2->addDays($t)->toDateString() == $temp3->toDateString(); ?>
	<?php $temp->addDays($t); ?>
   <div  index="{{$t}}" class="seventh mdl-color--light-grey-100" data-date="{{$temp->format('l\\, F j')}}"> 
   	@if($is_today)
   	<div class="day today mdl-shadow--3dp mdl-color--light-blue-100 day_title" 
   	data-date="{{$temp->format('l\\, F j')}}">
   	@elseif($temp->lt($temp3))
   	<div class="day before mdl-shadow--2dp mdl-color--white day_title" >
   	@else 
   	<div class="day after mdl-shadow--2dp mdl-color--white day_title" >
   	@endif
   	<span class="more_date_info">{{ $temp->format('l\\, F jS')}} </span>
   	<span class="less_day_info">{{ $temp->format('j')}}<br>{{ substr($temp->format('l'),0,3)}}</span>
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
			<?php $un_str = $t.'|||'.$e; ?>
			@if($pro->unavailable&&(int)$pro->unavailable->$un_str)
			class="under_seventh event_click  unavailable"
			@else
			class="under_seventh event_click"
			@endif
			> 
   			</div>


   		@endfor
    </div>
@endfor
</div>
</div>
</div>