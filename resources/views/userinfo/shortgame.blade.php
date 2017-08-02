@extends('layouts.app')
@section('content')
<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col">
  <form method="post" action="{{url('/shortgame/save')}}" style="width: 100%;">
    {{ csrf_field() }}
    @if(isset($redirect))
    <input type="hidden" name="redirect" value="{{$redirect}}">
    @endif
    <div style="margin:  20px 50px; ">
      <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{Auth::user()->morphname()}}'s Short Game Info </div>
      <div style="width: 50%;">
        The purpose of this information is for pros to learn about how you play. This allows them to know how best to help. Please fill all questions out the best you can for the best results.
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
  min-width: 150px;
}
</style>
<script type="text/javascript">
  $('select').select2();
  @for($i=0;$i<20;$i++)
<?php $tempname = 'shortgame'.$i; ?>
if($('select#shortgame{{$i}}').length > 0){
  $('select#shortgame{{$i}}').val("{{Auth::user()->$tempname}}");
  $('select#shortgame{{$i}}').trigger('change');
}
@endfor
</script>
@endsection