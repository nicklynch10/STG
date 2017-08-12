<div class="month_title">{{$thisweek->format('F Y')}}</div>
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