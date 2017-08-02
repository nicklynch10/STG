@extends('layouts.app')
@section('content')
<form class="naming" style="width:100%">
	@include('grid.top', ['title'=>$playlist->title, 'size'=>12])
	<div class="mdl-grid">
	<div class="mdl-cell--4-col">
		@foreach($playlist->videos as $k=>$x)
		<div style="width:100%; padding-bottom:10px; border-bottom:1px lightblue solid;">
		{{$k+1}}: {{$x->title}}<br>
		{{$x->description}}
		</div>
		@endforeach
		</div>

		<div class="mdl-cell--4-col">
		  {{count($videos)}} videos shown of {{count($playlist->videos)}}<br>
			@if($is_preview)
			This is only a preview of the first two videos to view all the videos you must purchase the playlist from {{$pro->firstname}} for ${{$playlist->price or "15"}}
			@else
			You have purchased this playlist
			@endif
			<hr>
			{{$playlist->description}}
		</div>
		<div style="font-size:15px;text-align:center;" class="mdl-cell--4-col">
			<div style="font-size:20px;text-align:center; padding-bottom:2px;" class="mdl-color-text--light-blue-500">Video Navigation</div>
			<b>  Video #<span class="vid_num_replace">1</span> shown of {{count($videos)}}</b><br>
			<br><br>
			<div style="text-align:left;padding-left:5px;position: absolute;
    bottom: 5px;">
			<i style="margin-left:-5px;" class="material-icons icon_back">arrow_back</i> 
			@foreach($videos as $key=>$video)
			<a class="vid_num" style="padding:5px; font-size:18px;" href="#{{$key+1}}">{{$key+1}}</a>
			@endforeach
			<i  class="material-icons icon_forward">arrow_forward</i> 
			</div>
		</div>
	</div>
	@if($is_preview)
	@include('grid.bottom',['button_name'=>"Buy Playlist", 'button_dir'=>'/playlist/pay/'.$playlist->id])
	@else
	@include('grid.bottom')
	@endif
</form>
@foreach($videos as $key=>$video)

		<figure style="text-align:center;" class="mdl-cell mdl-cell--12-col mdl-cell--top playlist_fig video_{{$key+1}}">
			<video id="video_{{$key+1}}" class="mdl-shadow--2dp playlist_vid" style="margin:auto; max-width:100%;" controls>
				<source src="{{ url($video->url)}}" type="video/mp4">
				<source src="{{ url($video->url)}}" type="video/ogg">
				Your browser does not support the video tag.
			</video>
			<figcaption style="text-align:center;color: white;
    font-size: 18px;">
			<div class="mdl-color-text--light-blue-500" style="font-size:27px; text-shadow:0px 0px 1px white; padding-top:10px;">{{$video->title or ("Prerecorded Video ".$key)}}</div>
			{{$video->description}}
			</figcaption>
		</figure>
@endforeach

<script type="text/javascript">
	var top_num = 1;
	var vids = document.getElementsByClassName('playlist_vid');
	show_vid(top_num);



	function show_vid(num){
		top_num = num;
	$('.playlist_fig').hide();
	for(var i=0;i<vids.length;i++)vids[i].pause();
	$('.video_'+num).slideDown();
	$('.vid_num').removeClass('num_selected');
	$($('.vid_num')[num-1]).addClass('num_selected');
	$('.icon_back, .icon_forward').show();
	if(num==1)$('.icon_back').hide();
	if(num==vids.length)$('.icon_forward').hide();
	$('.vid_num_replace').text(num);
	//document.getElementById('video_'+num).play();
	}

	$('.vid_num').on('click', function(){
		top_num = parseInt($(this).text());
		show_vid(top_num);
	});
	$('.icon_forward').on('click', function() {
		show_vid(top_num+1);
	});
	$('.icon_back').on('click', function() {
		show_vid(top_num-1);
	});


	var width_pct = 100;
	$('.playlist_vid').css('width', '100%');
	while($('.playlist_vid').height()>$(window).height()-230 && width_pct>1){
		$('.playlist_vid').css('width', width_pct+'%');
		width_pct--;
	}
	
	
</script>
<style type="text/css">
	.num_selected{
		color:#9F0192;
	}
	.icon_back, .icon_forward{
		cursor: pointer;
		padding:5px;
		font-size:18px;
	}
	body{
	background: #212121;
	}
</style>
@endsection