@extends('layouts.app')
@section('content')
<div class="mdl-cell mdl-cell--1-col"></div>
<div class="mdl-cell mdl-cell--10-col">
	<div class="mdl-shadow--2dp" style="padding: 10px; margin:10px; background: white;">
	<div class="mdl-grid" style="width: 100%;">
	<img src="{{url($pro->propic)}}" class="mdl-cell mdl-cell--5-col" style="max-width:300px; height:100%; padding: 20px;">
		<div class="mdl-cell mdl-cell--7-col" style="padding: 5px; text-align: center;">
			<div class="mdl-color-text--light-blue-500" style="text-align: center; font-size: 27px; line-height: 45px;"> 
			Send your swing to {{$pro->morphname()}}
			</div>
			<span style="font-size: 15px;">Please use slow motion video when possible.</span><br>
			@if(isset($other)&&$other)
			<span style="font-size: 15px;">{{$other or ""}}</span><br>
			@endif
			<br>
			<br>
		@include('vimeo.video_form',['vid'=>$vid])
		<br>
	</div>
	</div>
</div>
</div>
<div class="mdl-cell mdl-cell--1-col"></div>
<? if(!isset($step)) $step = 1; ?>
@include('hire.new.steps',['step'=>$step])
@endsection