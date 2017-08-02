@extends('layouts.app')
@section('content')
<?php $med = $hire->dtl; ?>
<?php $med2 = $hire->fv; ?>

<figure class="mdl-cell mdl-cell--6-col mdl-cell--top">
	<div id="big_vid" class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image">
		<span class="vid_text">
		Video is being processed and may take time depending on the video size. You may continue with your submission and the video will send. Otherwise, refreshing the page will allow you to check if your video has been processed yet.</span>
	</div>
</figure>
<figure class="mdl-cell mdl-cell--6-col mdl-cell--top">
	<div id="big_vid2" class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image">
		{{-- <span class="vid_text">Video is being processed. Please Wait.</span> --}}
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
</div>

</div>
</div>
</div>
<div class="mdl-cell mdl-cell--12-col">
<div class="mdl-shadow--2dp mdl-color--white mdl-grid" style="padding: 20px;">
<div class="mdl-cell mdl-cell--12-col" style="text-align: center; padding-bottom: 20px;">
	<div class="mdl-color-text--light-blue-300" style="font-size: 30px;">Swing Tip Questions</div>
</div>
<?php
$question_index = 0;
?>

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
	<hr>
	{{-- @endif --}}
	<?php $question_index++; ?>
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
	<hr>
	<?php $question_index++; ?>
	{{-- @endif --}}
	@endfor
	<br>
	<hr>
	<a class="mdl-button mdl-js-button mdl-js-ripple-effect" style="font-size: 20px; line-height: auto;" href='{{url("/hire/questions/".$hire->id)}}'>Edit Answers</a>
	<a class="mdl-button mdl-js-button mdl-js-ripple-effect" style="font-size: 20px; line-height: auto;" href='{{url("/hire/resubmit/dtl/".$hire->id)}}'>Resubmit Down-the-Line (DL) View Video</a>
	<a class="mdl-button mdl-js-button mdl-js-ripple-effect" style="font-size: 20px; line-height: auto;" href='{{url("/hire/resubmit/front/".$hire->id)}}'>Resubmit Face-on (FO) View Video</a>
</div>
</div>

<div class="mdl-cell mdl-cell--12-col" style="text-align: center; padding-bottom: 20px;">
<div  class="mdl-shadow--2dp" style="padding:20px; background: white;">
	<a class="mdl-button mdl-js-button mdl-js-ripple-effect" style="font-size: 40px; line-height: 40px" href='{{url("/hire/confirmed/".$hire->id)}}'>Add to Cart</a>
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
	.qtitle{
		font-weight: 500;
		font-size: 20px;
		padding: 5px;
	}
	.qanswer{
		font-size: 18px;
		padding: 10px;
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
var intval = setInterval(function(){
if(player2.element.height && player.element.height){
$('.vid_text').hide();
clearInterval(intval);
}
}, 1000);
	</script>
	@endsection