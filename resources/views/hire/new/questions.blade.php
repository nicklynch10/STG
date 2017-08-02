@extends('layouts.app')
@section('content')
<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col">
  <form method="post" action="{{url('/hire/questions/save/'.$hire->id)}}" style="width: 100%;">
    {{ csrf_field() }}
    @if(isset($redirect))
    <input type="hidden" name="redirect" value="{{$redirect}}">
    @endif
    <div style="margin:  20px 50px; ">
      <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{Auth::user()->morphname()}}'s Swing Tip Questions </div>
      <div style="">
        The purpose of this information is for pros to learn about how you play. This allows them to know how best to help. Please fill all questions out the best you can for the best results.
      </div>
      <hr>
      <div class="mdl-color-text--red-700" style=" font-size: 20px; line-height: 23px;">
        <b style="color:black;">Please Note:</b> The pro also has access to your General Information, Specific Information and Short Game information. Please make sure they are up to date before continuing.
      </div>
      <hr>


      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What club type are you using in your Swing Tip Video?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="hireclub" id="hireclub">
              <option value="Driver">Driver</option>
              <option value="Woods">Wood</option>
              <option value="Hybrids">Hybrid</option>
              <option value="Long Irons (2-5)">Long Iron (2-5)</option>
              <option value="Mid Irons (6-9)">Mid Iron (6-9)</option>
              <option value="Wedges">Wedge</option>
              <option value="Putter">Putter</option>
            </select>
          </div>
        </div>
      </div>


      {{--  Begin question --}}
      <?php $current = 0;
      $field = 'hireinfo'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What are your current swing thoughts or what are you working on now?</div>
        <input type="hidden" name="hireinfoquestion{{$current}}" value="What are your current swing thoughts or what are you working on now?">
        <div style="width: calc(100% - 10px); margin-left:10px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="hireinfo{{$current}}" id="hireinfo{{$current}}">{{$hire->$field}}</textarea required>
    <label class="mdl-textfield__label" for="hireinfo{{$current}}">example: I am trying to keep my head down and slow down my tempo
</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 1;
      $field = 'hireinfo'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What do you think you’re doing incorrectly and why?</div>
        <input type="hidden" name="hireinfoquestion{{$current}}" value="What do you think you’re doing incorrectly and why?">
        <div style="width: calc(100% - 10px); margin-left:10px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="hireinfo{{$current}}" id="hireinfo{{$current}}">{{$hire->$field}}</textarea required>
    <label class="mdl-textfield__label" for="hireinfo{{$current}}">example: I keep picking my head up and dubbing the ball. When I hit the ball well I tend to come across the ball causing it to slice a lot.
</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 2;
      $field = 'hireinfo'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What would you like to correct in today’s lesson?</div>
        <input type="hidden" name="hireinfoquestion{{$current}}" value="What would you like to correct in today’s lesson?">
        <div style="width: calc(100% - 10px); margin-left:10px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="hireinfo{{$current}}" id="hireinfo{{$current}}">{{$hire->$field}}</textarea required>
    <label class="mdl-textfield__label" for="hireinfo{{$current}}">example: I want to fix my slice and have better ball striking.

</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{-- separator from old and new questions!--}}
{{--  Begin question --}}
      <?php $current = 7;// note this skipped to 7
      $field = 'specific'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">From what distance do you hit a 7-Iron? in yards. </div>
        <input type="hidden" name="hireinfoquestion{{$current-4}}" value="From what distance do you hit a 7-Iron? in yards. ">
        <div style="width: calc(100% - 10px); margin-left:10px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input type="number" style="width:250px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}" value="{{Auth::user()->$field}}" required></input>
    <label class="mdl-textfield__label" for="specific{{$current}}">Please enter a number in yards here 

</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 8;
      $field = 'specific'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">How far can you hit your driver? in yards. </div>
        <input type="hidden" name="hireinfoquestion{{$current-4}}" value="How far can you hit your driver? in yards. ">
        <div style="width: calc(100% - 10px); margin-left:10px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input type="number" style="width:250px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}" value="{{Auth::user()->$field}}" required></input>
    <label class="mdl-textfield__label" for="specific{{$current}}">Please enter a number in yards here 

</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 9; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Do you typically take divots?</div>
         <input type="hidden" name="hireinfoquestion{{$current-4}}" value="Do you typically take divots?">
        <div style="width: calc(100% - 10px); margin-left:10px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="specific{{$current}}" id="specific{{$current}}">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select required>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 10; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;"> Do you tend to hit the ball high or do you hit it low?</div>
        <input type="hidden" name="hireinfoquestion{{$current-4}}" value=" Do you tend to hit the ball high or do you hit it low?">
        <div style="width: calc(100% - 10px); margin-left:10px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="specific{{$current}}" id="specific{{$current}}">
              <option value="High">High</option>
              <option value="Low">Low</option>
            </select required>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 11; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;"> Define your typical miss</div>
        <input type="hidden" name="hireinfoquestion{{$current-4}}" value=" Define your typical miss">
        <div style="width: calc(100% - 10px); margin-left:10px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="specific{{$current}}" id="specific{{$current}}">
              <option value="Pull">Pull</option>
              <option value="Block(push)">Block(push)</option>
              <option value="Hook">Hook</option>
              <option value="Slice">Slice</option>
              <option value="Shank">Shank</option>
              <option value="Dub">Dub</option>
              <option value="Sky">Sky</option>
              <option value="Chunk">Chunk</option>
              <option value="Skull">Skull</option>
            </select required>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 12; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Where do you feel the ball hitting the face typically?</div>
        <input type="hidden" name="hireinfoquestion{{$current-4}}" value="Where do you feel the ball hitting the face typically?">
        <div style="width: calc(100% - 10px); margin-left:10px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="specific{{$current}}" id="specific{{$current}}">
              <option value="Center">Center</option>
              <option value="Toe">Toe</option>
              <option value="Heel">Heel</option>
              <option value="None">None</option>
            </select required>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 13; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What is your preferred ball flight, other than straight?</div>
        <input type="hidden" name="hireinfoquestion{{$current-4}}" value="What is your preferred ball flight, other than straight?">
        <div style="width: calc(100% - 10px); margin-left:10px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="specific{{$current}}" id="specific{{$current}}">
              <option value="Draw">Draw</option>
              <option value="Cut">Cut</option>
            </select required>
          </div>
        </div>
      </div>
      {{--  End question --}}
    </div>
    <hr>
    <div style="margin: 20px 80px; width: 100%;">
      <button class="btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-color--light-blue-300" >Save and Continue</button>
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
@for($i=0;$i<20;$i++)
<?php $tempname = 'specific'.$i; ?>
var sel = $('select#specific{{$i}}');
if(sel.length > 0){
  sel.val("{{Auth::user()->$tempname}}");
  if(!sel.val())sel.val($("select#specific{{$i}} option:first").val());
  sel.trigger('change');
}
@endfor
</script>

@include('hire.new.steps',['step'=>3])
@endsection