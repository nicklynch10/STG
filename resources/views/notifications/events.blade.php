<?php
$u = Auth::user();
$ev = collect([]);
foreach ($u->events as $e) {
	$ev->push($e);
}
foreach ($u->events_pro as $e) {
	$ev->push($e);
}
?>
@foreach($ev->sortBy('start') as $e)
<div class="mdl-cell--12-col ">
<div class="mdl-shadow--2dp mdl-color--white" style="background:white; padding:15px; margin-bottom: 20px;">
		
	<div class="mdl-card__title mdl-color-text--red-400 special_accent mdl-cell--12-col">
    <h2 class="mdl-card__title-text">{{$e->title}}</h2>
       </div>
	<div>
		{{(\Carbon\Carbon::parse($e->start)->diffForHumans())}}
		<hr>
		{{$e->display_start}} 
	</div>
	<div>
		<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/event/{{$e->id}}">View Event</a>
	</div>
</div>
</div>

@endforeach