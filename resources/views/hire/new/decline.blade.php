@extends('layouts.app')
@section('content')

@include('grid.top',['size'=>12,'title'=>"Decline Swing Tip",'class'=>'helper', 'class3'=>'align-center'])
<div style="color: red;">To decline a Swing Tip you must provide reasoning to the student.</div>
<div>Declining this Swing Tip will refund the student, this will not reflect in your ratings.</div>
<hr>
<form method="post" action="{{url('/hire/decline/save/'.$hire->id)}}" style="width: 100%;">
    {{ csrf_field() }}
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
  <input type="radio" id="option-1" class="mdl-radio__button" name="options" value="Swing video(s) were not filmed correctly, please submit another Swing Tip with new videos." checked>
  <span class="mdl-radio__label">Swing video(s) were not filmed correctly, please submit another Swing Tip with new videos.</span>
</label><br>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
  <input type="radio" id="option-2" class="mdl-radio__button" name="options" value="Not available to complete this Swing Tip in the time requested.">
  <span class="mdl-radio__label">Not available to complete this Swing Tip in the time requested.</span>
</label><br>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
  <input type="radio" id="option-3" class="mdl-radio__button" name="options" value="Videos did not appear on the site.">
  <span class="mdl-radio__label">Video(s) did not play or appear on the web.</span>
</label><br>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
  <input type="radio" id="option-4" class="mdl-radio__button" name="options" value="Other technical issue.">
  <span class="mdl-radio__label">Other technical issue.</span>
</label><br>
<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-5">
  <input type="radio" id="option-5" class="mdl-radio__button" name="options" value="Other non-technical issue.">
  <span class="mdl-radio__label">Other non-technical issue.</span>
</label>
<br>
<hr>
<div>Please provide additional reasoning.
<br>
If you would like the student to resubmit with new videos, please state any suggestions here.
</div>
<div class="mdl-textfield mdl-js-textfield" style="width: 80%;">
  <textarea class="mdl-textfield__input" style="width:100%;" type="text" rows="5"
   id="decline_reasoning" required="true" name="decline_reasoning"></textarea>
  <label class="mdl-textfield__label" for="decline_reasoning">Additional reasoning for declining this Swing Tip.</label>
</div>
<br><br>
<button class="btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-color--light-blue-300" >Decline Swing Tip</button>
</form>
@include('grid.bottom')
@endsection