@extends('layouts.app')

@section('content')
<div class="mdl-cell mdl-cell--1-col"></div>
<div class="mdl-cell mdl-cell--10-col">
	<div class="mdl-shadow--2dp" style="padding: 10px; margin:10px; background: white;">
	<div class="mdl-grid" style="width: 100%;">
	<img src="{{url($client->propic)}}" class="mdl-cell mdl-cell--5-col" style="width:300px; height:100%; padding: 20px;">
		<div class="mdl-cell mdl-cell--7-col" style="padding: 5px; text-align: center;">
			<div class="mdl-color-text--light-blue-500" style="text-align: center; font-size: 27px; line-height: 45px;"> Send Lesson Video to {{$client->morphname()}}
			</div>
		@include('vimeo.video_form',['vid'=>$vid])
	</div>
	</div>
</div>
</div>
@endsection