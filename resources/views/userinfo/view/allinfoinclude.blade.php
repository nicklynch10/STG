
<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col userinfoform">
  <form method="post" action="{{url('/general/save')}}" style="width: 100%;">
    {{ csrf_field() }}
    @if(isset($redirect))
    <input type="hidden" name="redirect" value="{{$redirect}}">
    @endif
    <div style="margin:  20px 50px; ">
      <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{$student->morphname()}}'s General Info </div>
      <div style="width: 50%;">
      @if($student->id == Auth::user()->id)
       Please fill out this information about your golf game and keep it up to date. This willl enable your coach to make the best use of your time/money by figuring out the most effective ways to improve your game.
       <br><br>
       Edit This Information using the following forms:<br>
        <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" href="{{url('/shortgame')}}">Edit Shortgame Information</a>

     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--green-500" href="{{url('/specific')}}">Edit Specific Swing Information</a>


      <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--red-500" href="{{url('/general')}}">Edit General Swing Information</a>
      @else
        The purpose of this information is to get to know the client your working with.
      @endif
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="general{{$current}}" id="general{{$current}}">{{$student->$field}}</textarea>
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="general{{$current}}" id="general{{$current}}">{{$student->$field}}</textarea>
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="general{{$current}}" id="general{{$current}}">{{$student->$field}}</textarea>
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="general{{$current}}" id="general{{$current}}">{{$student->$field}}</textarea>
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
  $('select#general{{$i}}').val("{{$student->$tempname}}");
  $('select#general{{$i}}').trigger('change');
}
@endfor
</script>

{{-- //////////////////////////////shortgame below////////////////////////////////////////////// --}}






<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col userinfoform" style="margin-top: 20px;">
  <form method="post" action="{{url('/shortgame/save')}}" style="width: 100%;">
    {{ csrf_field() }}
    @if(isset($redirect))
    <input type="hidden" name="redirect" value="{{$redirect}}">
    @endif
    <div style="margin:  20px 50px; ">
      <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{$student->morphname()}}'s Short Game Info </div>
      <div style="width: 50%;">
       
      </div>
      <hr>
      {{--  Begin question --}}
      <?php $current = 0; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">Rate your Short Game</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="shortgame{{$current}}" id="shortgame{{$current}}">
              @for($i=1;$i<11;$i++)
              <option value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 1; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What’s your favorite short game club?
</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="shortgame{{$current}}" id="shortgame{{$current}}">
              <option value="Pitching Wedge">Pitching Wedge</option>
              <option value="Gap Wedge">Gap Wedge</option>
              <option value="Sand Wedge">Sand Wedge</option>
              <option value="Lob Wedge">Lob Wedge</option>
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 2; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">What’s your favorite wedge distance?
</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="shortgame{{$current}}" id="shortgame{{$current}}">
              @for($i=1;$i<20;$i++)
              <option value="{{$i*10}}">{{$i*10}}</option>
              @endfor
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
      {{--  Begin question --}}
      <?php $current = 3; ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">How many times on average do you 3-putt per 18 holes?
</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
          <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select name="shortgame{{$current}}" id="shortgame{{$current}}">
              @for($i=1;$i<10;$i++)
              <option value="{{$i*2}}">{{$i*2}}</option>
              @endfor
            </select>
          </div>
        </div>
      </div>
      {{--  End question --}}
    </div>
    <hr>
    
  </form>
</div>
<style type="text/css">
.paper{
margin: auto;
background: white;
}
select{
  min-width: 150px;
}
</style>
<script type="text/javascript">
  @for($i=0;$i<20;$i++)
<?php $tempname = 'shortgame'.$i; ?>
if($('select#shortgame{{$i}}').length > 0){
  $('select#shortgame{{$i}}').val("{{$student->$tempname}}");
  $('select#shortgame{{$i}}').trigger('change');
}
@endfor
</script>


























<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col userinfoform" style="margin-top: 20px;">
  <form method="post" action="{{url('/specific/save')}}" style="width: 100%;">
    {{ csrf_field() }}
    @if(isset($redirect))
    <input type="hidden" name="redirect" value="{{$redirect}}">
    @endif
    <div style="margin:  20px 50px; ">
      <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{$student->morphname()}}'s Specific Info </div>
      <div style="width: 50%;">
       
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{$student->$field}}</textarea>
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{$student->$field}}</textarea>
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{$student->$field}}</textarea>
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{$student->$field}}</textarea>
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{$student->$field}}</textarea>
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
    <input type="number" style="width:250px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}" value="{{$student->$field}}"></input>
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
    <input type="number" style="width:250px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}" value="{{$student->$field}}"></input>
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
    <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="specific{{$current}}" id="specific{{$current}}">{{$student->$field}}</textarea>
    <label class="mdl-textfield__label" for="specific{{$current}}"> example: I would like to imp
 

</label>
  </div>
  </div>
      </div>
      {{--  End question --}}
    </div>
    <hr>
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
  
@for($i=0;$i<20;$i++)
<?php $tempname = 'specific'.$i; ?>
if($('select#specific{{$i}}').length > 0){
  $('select#specific{{$i}}').val("{{$student->$tempname}}");
  $('select#specific{{$i}}').trigger('change');
}
@endfor
</script>


<script type="text/javascript">
  $('.userinfoform').find('input').attr('readonly',1);
  $('.userinfoform').find('textarea').attr('readonly',1);

  $('.userinfoform').find('select').map(function(sel){
$(this).parent().html($(this).val())
  });
  $('.userinfoform').find('textarea').map(function(sel){
$(this).parent().html($(this).val())
  });
  $('.userinfoform').find('input').map(function(sel) {
    $(this).siblings('label').hide();
  });

</script>