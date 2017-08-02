@extends('layouts.app')
@section('content')
<?php $med = $hire->vimeo; ?>
<figure class="mdl-cell mdl-cell--12-col mdl-cell--top">
	<div id="big_vid" class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image">
	</div>
</figure>

@include('grid.top',['size'=>12,'title'=>$med->title,'class'=>'helper', 'class3'=>'align-center'])
<div style="float: right;">
<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{$med->download_link_hd}}" download="swingtipsdownload.mp4">Download in Original Quality</a>
<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{$med->download_link_sd}}" download="swingtipsdownload.mp4">Download in Standard Quality</a>
</div>
<div class="mobile_hide" style="display:flex;">
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
<div class="mdl-cell mdl-cell--12-col">
<div style="background: white; padding: 5px;" class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col" style="font-size: 28px; padding: 10px; text-align: center;">Drills Suggested</div>
	@foreach($hire->drills as $d)
	<div class="mdl-cell mdl-cell--6-col">
	<div id="big_vid{{$d->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image">
	</div>
	</div>
	@endforeach
</div>
</div>

		
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

	<script type="text/javascript">
	var options = {
        id: "{{$med->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 500
    };
    var player = new Vimeo.Player('big_vid', options);
	</script>
	<script type="text/javascript">
		
		@foreach($hire->drills as $d)
	var options{{$d->id}} = {
        id: "{{$d->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 400
    };
    var player{{$d->id}} = new Vimeo.Player('big_vid{{$d->id}}', options{{$d->id}});
	@endforeach
	</script>
	@endsection