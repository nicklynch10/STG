@extends('layouts.app')
@section('content')

<?php $med = $hire->dtl; ?>
<?php $med2 = $hire->fv; ?>
<figure class="mdl-cell mdl-cell--6-col mdl-cell--top">
	<div id="big_vid" class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image">
	</div>
</figure>
<figure class="mdl-cell mdl-cell--6-col mdl-cell--top">
	<div id="big_vid2" class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image">
	</div>
</figure>

@include('grid.top',['size'=>12,'title'=>$med->title."    &   ".$med2->title,'class'=>'helper', 'class3'=>'align-center'])
<div class="mobile_hide" style="display:flex;">
	<img class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow" style="max-width:100%; max-height: 100px" src="/{{$hire->user->propic}}">
	<div style="padding: 5px;">
		<a class="mdl-button mdl-js-button mdl-js-ripple-effect name_button" href='{{url("/locker/".$hire->user->id)}}'>{{$hire->user->morphname()}}</a>
		<br>
	</div>
</div>
<div style="width: 100%;" class="mdl-grid">
	<div class="mdl-cell--6-col" style="text-align: center;">{{$med->description}}</div>
	<div class="mdl-cell--6-col" style="text-align: center;">{{$med2->description}}</div>
	<div class="mdl-cell--6-col" style="text-align: center;">
	<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{$med->download_link_hd}}" download="swingtipsdownload.mp4">Download "{{$med->title}}" in Original Quality <span class="mdl-badge material-icons">file_download</span></a>
	<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{$med->download_link_sd}}" download="swingtipsdownload.mp4">Download "{{$med->title}}" in Standard Quality <span class="mdl-badge material-icons">file_download</span></a>
</div>
	<div class="mdl-cell--6-col" style="text-align: center;">
		<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{$med2->download_link_hd}}" download="swingtipsdownload.mp4">Download "{{$med2->title}}" in Original Quality <span class="mdl-badge material-icons">file_download</span></a>
<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{$med2->download_link_sd}}" download="swingtipsdownload.mp4">Download "{{$med2->title}}" in Standard Quality <span class="mdl-badge material-icons">file_download</span></a>
	</div>
</div>

</div>
</div>
</div>
<div class="mdl-cell mdl-cell--12-col">
<div class="mdl-shadow--2dp mdl-color--white mdl-grid" style="padding: 20px;">
<div class="mdl-cell mdl-cell--12-col" style="text-align: center; padding-bottom: 20px;">
	<div class="mdl-color-text--light-blue-300" style="font-size: 35px;">Swing Tip Questions</div>
	<br>
	<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="/student/info/{{$hire->user->id}}" style="font-size: 22px;">All of {{$hire->user->morphname()}}'s Swing Information</a>
</div>
<?php
$question_index = 0;
?>
<div class="mdl-cell mdl-cell--12-col" style="border-bottom: 1px #4fc3f7 solid;">
	<div class="qtitle">
		What club type are you using in your Swing Tip Video?
	</div>
	<div class="qanswer">{{$hire->hireclub}}</div>
	</div>

	
	@for($i=0;$i<3;$i++)
	<?php $tempfield = 'hireinfo'.$i; ?>
	{{-- @if(isset($hire->$tempfield)) --}}
	<?php $tempquestion = 'hireinfoquestion'.$question_index; ?>
	<div class="mdl-cell mdl-cell--12-col" style="border-bottom: 1px #4fc3f7 solid;">
	<div class="qtitle">
		{{$hire->$tempquestion}}
	</div>
	<div class="qanswer">{{$hire->$tempfield}}</div>
	</div>
	<?php $question_index++; ?>
	<hr>
	{{-- @endif --}}
	@endfor

	@for($i=7;$i<14;$i++)
	<?php $tempfield = 'specific'.$i; ?>
	{{-- @if(isset($hire->$tempfield)) --}}
	<?php $tempquestion = 'hireinfoquestion'.$question_index; ?>
	<div class="mdl-cell mdl-cell--12-col" style="border-bottom: 1px #4fc3f7 solid;">
	<div class="qtitle">
		{{$hire->$tempquestion}}
	</div>
	<div class="qanswer">{{$hire->$tempfield}}</div>
	</div>
	<?php $question_index++; ?>
	<hr>
	{{-- @endif --}}
	@endfor
</div>
</div>

{{-- This is the response part! --}}

@if($hire->vimeo && $hire->vimeo->active)
<span class="vid_text">
		Video is being processed and may take time depending on the video size. You may continue with your submission and the video will send. Otherwise, refreshing the page will allow you to check if your video has been processed yet.</span>
<figure class="mdl-cell mdl-cell--12-col mdl-cell--top">
	<div id="big_vid3" class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image">
	</div>
</figure>
@include('grid.top',['size'=>12,'title'=>$hire->vimeo->title,'class'=>'helper', 'class3'=>'align-center'])
{{$hire->vimeo->description}}
@include('grid.bottom')
@else
<div class="mdl-cell mdl-cell--12-col" style=" padding-top:20px; padding-bottom: 20px; margin-top: 10px; background: white;">
	<div class="mdl-color-text--light-blue-300" style="font-size: 40px;text-align: center;">Swing Tip Response</div>
	<div style="padding: 10px; margin:10px;">
	@include('vimeo.video_form',['vid'=>$vid]);
	</div>
</div>
@endif
<form method="post" action="{{url('/hire/respond/'.$hire->id)}}" style="width: 100%;">
    {{ csrf_field() }}

<div class="mdl-cell mdl-cell--12-col" style=" padding-top:20px; padding-bottom: 20px; margin-top: 10px; background: white;">
	<div class="mdl-color-text--light-blue-300" style="font-size: 40px;text-align: center;">Attach Drills</div>
	<div style="padding: 10px; margin:10px;">
	<a href="/hire/drill/upload/{{$hire->id}}" class="mdl-button mdl-js-button mdl-js-ripple-effect"><span class="mdl-badge material-icons">file_upload</span>Upload Drill</a>
	<div style="display: flex;">
	@if(Auth::user()->vimeos && Auth::user()->vimeos->where('active', 1) && count(Auth::user()->vimeos->where('active', 1)->where('type','drill')))
	@foreach(Auth::user()->vimeos->where('active', 1)->where('type','drill') as $v)
	
	<a class="mdl-button mdl-js-button mdl-js-ripple-effect drillattach" index="{{$v->id}}" style="margin-right:40px;"><span class="mdl-badge material-icons">attach_file</span>{{$v->title}}</a>
	<input type="hidden" class="drillinput" name="drill{{$v->id}}" value="0">
	
	@endforeach
	@else
	You have no drills. If you would like to send drills, attach drills then return to this page.
	@endif
	</div>
	</div>
</div>
<div class="mdl-cell mdl-cell--12-col" style=" padding-top:20px; padding-bottom: 20px; margin-top: 10px; background: white; text-align: center;">
@if($hire->vimeo && $hire->vimeo->active)
<button type="submit" style="font-size: 28px; line-height: 28px;" class="mdl-button mdl-js-button mdl-js-ripple-effect send_response">Submit Response to {{$hire->user->morphname()}}</button>
@else
<div style="font-size: 28px; line-height: 28px;">You must upload a Swing Tip response video to continue submission</div>
@endif
</div>
<div class="mdl-cell mdl-cell--12-col" style=" padding-top:20px; padding-bottom: 20px; margin-top: 10px; background: white; text-align: center;">
<a href="{{url('/hire/decline/'.$hire->id)}}" style="font-size: 20px; line-height: auto; " class="mdl-button mdl-js-button mdl-js-ripple-effect send_response">Decline this Swing Tip?</a>

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
	.qtitle{
		font-weight: 500;
		font-size: 20px;
		padding: 5px;
	}
	.qanswer{
		font-size: 18px;
		padding: 10px;
	}
	.inputselected{
		background: #4fc3f7 !important;
	}
	.vid_text{
		color:white; font-size: 20px;
	}
	</style>
	<script type="text/javascript">
	var pct = 100;
	while($('.big_image').height()> 900){
	pct -= 1;
	$('.big_image').width(pct+'%');
	}
	$('.drillattach').on('click', function(event) {
		var self = $(this);
		var input = self.siblings('.drillinput').first();
		if(input.val() == '0'){
			input.val(1);
			self.addClass('inputselected')
		}else{
			input.val(0);
			self.removeClass('inputselected')
		}
		console.log('attached');
		/* Act on the event */
	});
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

    var options2 = {
        id: "{{$med2->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 500
    };
    var player2 = new Vimeo.Player('big_vid2', options2);

    @if($hire->vimeo->active)
    var options3 = {
        id: "{{$hire->vimeo->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 650
    };
    var player3 = new Vimeo.Player('big_vid3', options3);
    @endif

    var intval = setInterval(function(){
if(player3 && player3.element.height){
$('.vid_text').hide();
clearInterval(intval);
}
}, 10000);
	</script>
	@endsection