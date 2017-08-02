@extends('layouts.app')

@section('content')
<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col">
<form method="post" action="{{url($post)}}" style="width: 100%;">
{{ csrf_field() }}
  <div style="margin:  20px 50px; ">
    <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{Auth::user()->morphname()}}'s Account Info </div>
    <div style="width: 50%;">
      Please fill out the following correctly
    </div>
    
    <hr>
    <?php foreach ($info as $key=>$q) {  
      $fieldname = $q[0];
      $title = $q[2];
      ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">{{$title}}</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
  @if($q[1]==0)
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <textarea style="width:100%; min-height:60px;" class="mdl-textfield__input" name="{{$fieldname}}" id="{{$fieldname}}" required>{{Auth::user()->$fieldname}}</textarea>
    <label class="mdl-textfield__label" for="{{$fieldname}}">{{$title}}?</label>
      </div>
  @elseif($q[1]==1 || $q[1]==2 || $q[1]==4 || $q[1]==5)
        <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <input
       @if($q[1]==1) type="text" @elseif($q[1]==2) type="number" step="any" @elseif($q[1]==4) type="email"  @elseif($q[1]==5) type="password"  @endif
       style="width:100%;" class="mdl-textfield__input" name="{{$fieldname}}" id="{{$fieldname}}" 
       value="{{Auth::user()->$fieldname}}"
       @if($q[3]) required @endif
       ></input>
    <label class="mdl-textfield__label" for="{{$fieldname}}">{{$title}}?</label>
      </div>
  @elseif($q[1]==3)
  <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
      <select style="width:250px;" class="mdl-textfield__input" name="{{$fieldname}}" id="{{$fieldname}}" required>
         <option value="1">Yes</option>
         <option value="0">No</option>
       </select>
      </div>
@endif
  </div>
      </div>
    <?php } ?>
  </div>
  <hr>
  <div style="margin: 20px 80px; width: 100%;">
  <button class="btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-color--light-blue-300" >Save Account Information</button>
  </div>
</form>
</div>
<style type="text/css">
  .paper{
    margin: auto;
    margin-top: 25px;
    background: white;
  }
</style>
<script type="text/javascript">
  $('select[name=accepts_swingtips]').val('{{Auth::user()->accepts_swingtips}}');
  $('select[name=accepts_lessons]').val('{{Auth::user()->accepts_lessons}}');
  $('select.mdl-textfield__input').select2();
  $('select.mdl-textfield__input').trigger('change');

  if($('#accepts_swingtips').length>0){
    var $as = $('#accepts_swingtips');
    console.log($as);
    if(!$as.val()||$as.val() == "0"){
      if($('#software').length>0){
        $('#software').parent().parent().parent().hide();
      }
       if($('#swingtip_price').length>0){
        $('#swingtip_price').parent().parent().parent().hide();
      }
    }
    $as.on('change', function(event) {
      if(!$as.val()||$as.val() == "0"){
      if($('#software').length>0){
        $('#software').parent().parent().parent().hide();
      }
      if($('#swingtip_price').length>0){
        $('#swingtip_price').parent().parent().parent().hide();
      }
    }else{
      $('#software').parent().parent().parent().show();
      $('#swingtip_price').parent().parent().parent().show();
    }
    });



  }


</script>
@endsection
