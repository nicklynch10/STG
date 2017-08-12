 <h2 class="mdl-card__title-text">Your Upcoming Events</h2>
		 <?php
		 $temp_today = Carbon\Carbon::now('America/Toronto');
		 $maxnum = 0;
		 $collect = collect([]);
		foreach(Auth::user()->events->where('active',"1")->where('denied',"0")->sortBy('start') as $ev){
		 	if($ev->end>$temp_today){
		 		$collect->push($ev);
		 	}
		}
		foreach(Auth::user()->events_pro->where('active',"1")->where('denied',"0")->sortBy('start') as $ev){
		 	if($ev->end>$temp_today){
		 		$collect->push($ev);
		 	}
		}

		 ?>

		 @foreach($collect->sortBy('start')->take(40) as $ev)
		 <a style="min-height:45px; height: 100%; line-height:15px; width:80%; max-width:230px; margin-bottom:10px; padding-bottom: 3px;"

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
		   href="/event/{{$ev->id}}"
		   >
				<span style="font-size:15px;">{{$ev->title}}</span><br>
				<span style="font-size:12px;">{{$ev->get_datetime_format()}}</span>
		 </a>
		 <br>
		 @endforeach