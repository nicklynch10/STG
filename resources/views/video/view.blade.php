@extends('layouts.app')
@section('content')
<figure class="mdl-cell mdl-cell--12-col mdl-cell--top">
	<video class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image video-js" data-setup="{}" style="width: 100%;" controls>
		<source src="{{ url($med->url)}}" type="video/mp4">
		Your browser does not support the video tag.
	</video>
</figure>

@include('grid.top',['size'=>12,'title'=>$med->title,'class'=>'helper', 'class3'=>'align-center'])
<div style="display:flex;">
	<img class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow" style="max-width:100%; max-height: 100px" src="/{{$med->user->propic}}">
	<div style="padding: 5px;">
		<a class="mdl-button mdl-js-button mdl-js-ripple-effect name_button" href='{{url("/locker/".$med->user->id)}}'>{{$med->user->morphname()}}</a>
		<br>
	</div>
</div>
@if(!$med->description && !$med->title)
No information provided.
@endif
{{$med->description}}
</div>
</div>
</div>
<div class="mdl-cell mdl-cell--9-col mdl-cell--top helper2">

		
	<style type="text/css">
	.custom_text{
	padding: 0px;
	width: auto;
	}
	.custom_li{
	padding-bottom: 3px;
	padding-top: 3px;
	}
	.align-center{
	margin:auto;
	}
	.helper2{
	display: none;
	}
	.banner{
	min-height: 25px;
	}
	.hide{
	display: none;
	}
	body{
	background: #212121;
	}
	.fix_width{
	width:23%;
	}
	</style>
	<script type="text/javascript">
	var pct = 100;
	while($('.big_image').height()> 900){
	pct -= 1;
	$('.big_image').width(pct+'%');
	}
	
	</script>
	@endsection