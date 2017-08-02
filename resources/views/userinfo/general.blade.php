@extends('layouts.app')
@section('content')
<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col">
  <form method="post" action="{{url('/general/save')}}" style="width: 100%;">
    {{ csrf_field() }}
    @if(isset($redirect))
    <input type="hidden" name="redirect" value="{{$redirect}}">
    @endif
    <div style="margin:  20px 50px; ">
      <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{Auth::user()->morphname()}}'s General Info </div>
      <div style="width: 50%;">
        The purpose of this information is for pros to learn about how you play. This allows them to know how best to help. Please fill all questions out the best you can for the best results.
      </div>
      <hr>
      {{--  Begin question --}}
      <?php $current = 0; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">How long have you been playing golf for?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="general{{$current}}" id="general{{$current}}">
              <option value="New">New</option>
              <option value="6 months">6 months</option>
              <option value="1 year">1 year</option>
              <option value="3 year">3 year</option>
              <option value="5 years">5 years</option>
              <option value="10+ years">10+ years</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 1; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Left or right handed?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="general{{$current}}" id="general{{$current}}">
              <option value="Left">Left</option>
              <option value="Right">Right</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 2;
      $field = 'general'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Do you have any physical limitations?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="general{{$current}}" id="general{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="general{{$current}}">example: I had back surgery therefore limiting my flexibility</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 3; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Have you ever taken lessons before?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="general{{$current}}" id="general{{$current}}">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 4;
      $field = 'general'.$current;
       ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;"> If yes: How many?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="general{{$current}}" id="general{{$current}}">
              <option value="1">1</option>
              <option value="3">3</option>
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="20+">20+</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 5;
$field = 'general'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Who did you take the lessons from?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="general{{$current}}" id="general{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="general{{$current}}">Who did you take the lessons from?</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 6;
$field = 'general'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What did you specifically work on with your other instructor(s)?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="general{{$current}}" id="general{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="general{{$current}}">What did you specifically work on with your other instructor(s)?</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php
       $current = 7; 
       $field = 'general'.$current;
      ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Why are you no longer working with that instructor?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="general{{$current}}" id="general{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="general{{$current}}">Why are you no longer working with that instructor?</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 8; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">How often do you practice, and/or play during the season?
</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="general{{$current}}" id="general{{$current}}">
              <option value="once a week">once a week</option>
              <option value="3 times a week">3 times a week</option>
              <option value="5 times a week">5 times a week</option>
              <option value="once a month">once a month</option>
              <option value="5 times a year">5 times a year</option>
              <option value="once a year">once a year</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 9; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Do you play competitively or recreationally?
</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="general{{$current}}" id="general{{$current}}">
              <option value="Competitively">Competitively</option>
              <option value="Recreationally">Recreationally</option>
            </select>

          </div>
        </div>
      </div>
      {{--  End question --}}
    </div>
    <hr>
    <div style="margin: 20px 80px; width: 100%;">
      <button class="btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-color--light-blue-300" >Save This Information</button>
    </div>
  </form>
</div>
<style type="text/css">
.paper{
margin: auto;
background: white;
}
select{
  min-width: 250px;
}
</style>
<script type="text/javascript">
  $('select').select2();
  $('#general3').on('change', function(event) {
    if($(this).val() == "No"){
      $('#general4,#general5,#general6,#general7').parent().parent().parent().css('display', 'none');
    }else{
      $('#general4,#general5,#general6,#general7').parent().parent().parent().css('display', 'block');
    }
  });
@for($i=0;$i<20;$i++)
<?php $tempname = 'general'.$i; ?>
if($('select#general{{$i}}').length > 0){
  $('select#general{{$i}}').val("{{Auth::user()->$tempname}}");
  $('select#general{{$i}}').trigger('change');
}
@endfor
</script>
@endsection