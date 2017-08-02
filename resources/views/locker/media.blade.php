<?php 
$vids = collect([]);
foreach($pro->hires as $hire){
	foreach ($hire->videos as $v) {
		$vids->push($v);
	}
}

foreach($pro->hires_pro as $hire){
	foreach ($hire->videos as $v) {
		$vids->push($v);
	}
}


if($is_me && $is_pro){
$vids = $pro->videos;
}elseif(!$is_me && $is_pro){
$vids = $pro->videos->where('public', '1');
foreach ($pro->hires_pro as $h) {
	if((int)$h->user->id == (int)Auth::user()->id){
		foreach ($h->videos as $v) {
		 	if($v->user->id == $pro->id)$vids->push($v);
		}
	}
}
}elseif($is_me && !$is_pro){
$vids = $pro->videos;
foreach ($pro->hires as $h) {
	foreach ($h->videos as $v) {
		if((int)$v->user->id != (int)Auth::user()->id)$vids->push($v);
	}
}
}
$vids->sortByDesc('updated_at');
?>


<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{url("/drill/upload")}}" >Upload a Drill</a>

@foreach($vids as $key=>$vid)
<a id='vid{{$key}}' href="{{url('video/'.$vid->id)}}" class="mdl-cell mdl-cell--4-col mdl-cell--top piclink ">
	<figure class="picfigure custom_image_scroll">
		<video class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow" preload='none' poster="{{$vid->cover}}" style="max-width:100%; max-height: 400px">
			<source src="{{ url($vid->url)}}" type="video/mp4">
			<source src="{{ url($vid->url)}}" type="video/ogg">
			Your browser does not support the video tag.
		</video>
	</figure>
</a>
@if($vid->title)
<div class="mdl-tooltip" for="vid{{$key}}">
	{{$vid->title}}
</div>
@endif
@endforeach
