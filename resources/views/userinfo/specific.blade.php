@extends('layouts.app')
@section('content')
<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col">
  <form method="post" action="{{url('/specific/save')}}" style="width: 100%;">
    {{ csrf_field() }}
    @if(isset($redirect))
    <input type="hidden" name="redirect" value="{{$redirect}}">
    @endif
    <div style="margin:  20px 50px; ">
      <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{Auth::user()->morphname()}}'s Specific Info </div>
      <div style="width: 50%;">
        The purpose of this information is for pros to learn about how you play. This allows them to know how best to help. Please fill all questions out the best you can for the best results.
      </div>
      <hr>
      {{--  Begin question --}}
      <?php $current = 0;
      $field = 'specific'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What do you think are your strengths and weaknesses?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="specific{{$current}}"> example: I am a great iron player with an average short game but I struggle with my accuracy off the tee with my driver. I tend to slice the ball a lot. 
</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 1;
      $field = 'specific'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;"> Do you have a pre-shot routine? If so, explain it in detail.</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="specific{{$current}}">example: I typically take 2 practice swings, step behind the ball, and imagine the shot I want to hit, step up to the ball and adjust my stance, then swing.

</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 2;
      $field = 'specific'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Which shot gives you the most difficulty? </div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="specific{{$current}}">example. I find it impossible to draw the ball and keep it low and out of the wind. I also can’t figure out how to do a flop shot in short game situations. 

</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
    {{--  Begin question --}}
      <?php $current = 3; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What is your least favorite club(s)?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select multiple  name="specific{{$current}}" id="specific{{$current}}">
              <option value="Driver">Driver</option>
              <option value="Woods">Woods</option>
              <option value="Hybrids">Hybrids</option>
              <option value="Long Irons (2-5)">Long Irons (2-5)</option>
              <option value="Mid Irons (6-9)">Mid Irons (6-9)</option>
              <option value="Wedges">Wedges</option>
              <option value="Putter">Putter</option>
              
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
       {{--  Begin question --}}
      <?php $current = 4;
      $field = 'specific'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Why are the above club(s) your least favorite? </div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="specific{{$current}}">Why are the above club(s) your least favorite? 

</label>
  </div>
  </div>
      </div>
      {{--  End question --}}

      {{--  Begin question --}}
      <?php $current = 5; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What is your favorite club(s)?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select multiple name="specific{{$current}}" id="specific{{$current}}">
              <option value="Driver">Driver</option>
              <option value="Woods">Woods</option>
              <option value="Hybrids">Hybrids</option>
              <option value="Long Irons (2-5)">Long Irons (2-5)</option>
              <option value="Mid Irons (6-9)">Mid Irons (6-9)</option>
              <option value="Wedges">Wedges</option>
              <option value="Putter">Putter</option>
              
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
       {{--  Begin question --}}
      <?php $current = 6;
      $field = 'specific'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Why are the above club(s) your favorite? </div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="specific{{$current}}">Why are the above club(s) your favorite? 

</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
{{--  Begin question --}}
      <?php $current = 7;
      $field = 'specific'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">From what distance do you hit a 7-Iron? in yards. </div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input type="number" style="width:250px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}" value="{{Auth::user()->$field}}"></input>
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
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input type="number" style="width:250px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}" value="{{Auth::user()->$field}}"></input>
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
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="specific{{$current}}" id="specific{{$current}}">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 10; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;"> Do you tend to hit the ball high or do you hit it low?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="specific{{$current}}" id="specific{{$current}}">
              <option value="High">High</option>
              <option value="Low">Low</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 11; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;"> Define your typical miss</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
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
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 12; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Where do you feel the ball hitting the face typically?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="specific{{$current}}" id="specific{{$current}}">
              <option value="Center">Center</option>
              <option value="Toe">Toe</option>
              <option value="Heel">Heel</option>
              <option value="None">None</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 13; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What is your preferred ball flight, other than straight?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="specific{{$current}}" id="specific{{$current}}">
              <option value="Draw">Draw</option>
              <option value="Cut">Cut</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 14;
      $field = 'specific'.$current;
       ?>
     <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">  What are your short term goals and what are your long term goals?</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{Auth::user()->$field}}</textarea>
    <label class="mdl-textfield__label" for="specific{{$current}}"> example: I would like to imp
 

</label>
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
  
@for($i=0;$i<20;$i++)
<?php $tempname = 'specific'.$i; ?>
if($('select#specific{{$i}}').length > 0){
  $('select#specific{{$i}}').val("{{Auth::user()->$tempname}}");
  $('select#specific{{$i}}').trigger('change');
}
@endfor
</script>
@endsection