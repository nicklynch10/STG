@extends('layouts.app_nogrid')
@section('content')
<div style="background: black;">
<div class="fake_body" index="0">
@include('home.welcome.slide0')
@include('home.welcome.slidenav')
</div>
<div class="fake_body" index="1">
@include('home.welcome.slide1')
@include('home.welcome.slidenav')
</div>
<div class="fake_body" index="2">
@include('home.welcome.slide2')
@include('home.welcome.slidenav')
</div>
<div class="fake_body" index="3">
@include('home.welcome.slide3')
@include('home.welcome.slidenav')
</div>
</div>
<div style="min-height: auto;" class="home_div home_div_1">
<div class="sub_content" style="width: 100%; padding:10px;">

<div class="graphicdiv" style="background-image: url('{{Storage::disk('s3')->url('stock/graphic1_crop.svg')}}');">
{{-- <img src="{{Storage::disk('s3')->url('stock/graphic1_crop.png')}}"> --}}
</div>
</div>
</div>
<div class="home_div home_div_7"></div> 
<div style="" class="home_div home_div_1">
<div class="sub_content" style="width: 100%; padding:10px;">
<ul class="mdl-list">
  <li class="mdl-list__item center_mobile" style="margin-bottom: 50px;">
  <img style="width: 80px; margin: 0px 80px;" src="{{Storage::disk('s3')->url('stock/golf_icon.png')}}" class="image_icon">
    <span style="font-size: 40px; font-weight: 300; font-family: 'Lato';">
    Participate in the best experience possible whether you are a student or a teacher of the game of golf.
</span>
  </li>
  <li class="mdl-list__item center_mobile">
  <img style="width: 80px; margin: 0px 80px;" class="image_icon" src="{{Storage::disk('s3')->url('stock/tool_icon.png')}}">
    <span style="font-size: 40px; font-weight: 300; font-family: 'Lato';">
    Use the industry leading tools you need to either improve your game, or expand your business. 
  </span>
  </li>
</ul>
</div>
</div>


<div class="home_div home_div_2"></div> 
<div class="home_div home_div_3">
<div class="sub_content" style="width: 100%; padding:10px;">
<div class="sub_title">Swing Tips</div>
<ul class="mdl-list">
  <li class="mdl-list__item center_mobile" style="margin-bottom: 50px;">
  <img style="width: 80px; margin: 0px 80px;" src="{{Storage::disk('s3')->url('stock/smartphone.png')}}" class="image_icon">
    <span style="font-size: 40px; font-weight: 300; font-family: 'Lato';">
   Utilize the latest swing analyzation software using only a smartphone. 
</span>
  </li>
  <li class="mdl-list__item center_mobile">
  <img style="width: 80px; margin: 0px 80px;" class="image_icon" src="{{Storage::disk('s3')->url('stock/home.png')}}">
    <span style="font-size: 40px; font-weight: 300; font-family: 'Lato';">
    Send videos of your swing to be analyzed for a fraction of the price using Swing Tips or Online Instruction.
  </span>
  </li>
</ul> 
<div style="text-align: center;">
  <a href="{{url('/about')}}" class="center-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Learn More
</a>
</div>
</div>
</div>
<div class="home_div home_div_4"></div> 
<div class="home_div home_div_3">
<div class="sub_content" style="width: 100%; padding:10px;">
<div class="sub_title">Student</div>
<ul class="mdl-list">
  <li class="mdl-list__item center_mobile" style="margin-bottom: 50px;">
  <img style="width: 80px; margin: 0px 80px;" src="{{Storage::disk('s3')->url('stock/calendar.png')}}" class="image_icon">
    <span style="font-size: 40px; font-weight: 300; font-family: 'Lato';">
   Schedule lessons with your favorite coach with ease. 
</span>
  </li>
  <li class="mdl-list__item center_mobile">
  <img style="width: 80px; margin: 0px 80px;" class="image_icon" src="{{Storage::disk('s3')->url('stock/video.png')}}">
    <span style="font-size: 40px; font-weight: 300; font-family: 'Lato';">
    Save all your lesson videos in an organized way to view on any device without using any storage.
  </span>
  </li>
</ul> 
<div style="text-align: center;">
  <a href="{{url('/about')}}" class="center-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Learn How
</a>
</div>
</div>
</div>
<div class="home_div home_div_6"></div> 
<div class="home_div home_div_3" style="width: 100%; padding:10px;">
<div class="sub_content">
<div class="sub_title">Golf Instructor</div>
<ul class="mdl-list">
  <li class="mdl-list__item center_mobile" style="margin-bottom: 50px;">
  <img style="width: 80px; margin: 0px 80px;" src="{{Storage::disk('s3')->url('stock/ok.png')}}" class="image_icon">
    <span style="font-size: 40px; font-weight: 300; font-family: 'Lato';">
   All Payment is up front so no more "no shows".
</span>
  </li>
  <li class="mdl-list__item center_mobile">
  <img style="width: 80px; margin: 0px 80px;" class="image_icon" src="{{Storage::disk('s3')->url('stock/star.png')}}">
    <span style="font-size: 40px; font-weight: 300; font-family: 'Lato';">
    Review a student's swing and what you last talked about before their next lesson. 
  </span>
  </li>
</ul> 
<div style="text-align: center;">
  <a href="{{url('/about')}}" class="center-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Learn More
</a>
</div>
</div>
</div>
<div class="last_home_div">
<div>Learn Even More?</div>
<br>
<div style="width: 100%; text-align: center;">
    <a style="width:auto;" href="{{url('/request/demo')}}" class="center-button submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50">Request Demo</a>
  </div>
</div>

<footer class="mdl-mini-footer" style="background:white;">
        <div  class="mdl-color-text--grey-900" style="text-align: center; width:100%; font-weight:300; font-size: 16px;" >Swing Tips Golf &copy; 2017</div> 
        </footer>
@include('home.welcome.style')
@endsection