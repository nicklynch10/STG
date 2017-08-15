
<div class="fancy-text2">
Golf Instruction Collaboration Platform
</div>
<div style="width: 100%; text-align: center; margin-top: 50px;">
@if(Auth::check())
<a href="{{url('/home')}}" class="center-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Get Started
</a>
@else
<a href="{{url('/login')}}" class="center-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Get Started
</a>
@endif
</div>