@extends('layouts.app')
@section('content')
<div class="mdl-cell--1-col"></div>
<div class="mdl-shadow--2dp mdl-cell mdl-cell--10-col mdl-color--white">
<div class="mdl-color-text--light-blue-300" style="text-align: center; font-size: 35px; padding: 10px;">Upload a Drill for your Student(s)</div>
	<div style="padding:20px; margin:10px;">
	@include('vimeo.video_form',['vid'=>$vid]);
	</div>
</div>
<div class="mdl-cell--1-col"></div>
@endsection