@extends('layouts.app_nogrid')
@section('content')
<div style="background: black;">
<div class="last_home_div">
<div>Request a Demo</div>
<br>
@include('home.new.requestdemo')
</div>

<footer class="mdl-mini-footer" style="background:white;">
        <div  class="mdl-color-text--grey-900" style="text-align: center; width:100%; font-weight:300; font-size: 16px;" >Swing Tips Golf &copy; 2017</div> 
        </footer>
@include('home.welcome.style')
@endsection