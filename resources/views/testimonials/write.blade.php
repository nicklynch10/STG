
@extends('layouts.app_nogrid')

@section('content')
<form style="width:100%" method="POST">
<div style="width:90%" class="mdl-grid">
{{ csrf_field() }}
@include('grid.separator',['size'=>1])
        @include('grid.top',["title"=>"Write Testimonial for ".$pro->firstname, "size"=>10])
        <input type="hidden" name='pro_id' value="{{$pro->id}}"></input>
        <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input"  id="title" type="text" name='title'></input>
         <label class="mdl-textfield__label" for="title">Title your testimonial</label>
      </div>
      <br>
        <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" rows= "15" id="sample1" name="description" ></textarea>
    <label class="mdl-textfield__label" for="sample1">Your testimonial...</label>
  </div>
        @include('grid.bottom_submit',['button_name'=>"Submit Review"])
        @include('grid.separator',['size'=>1])
</div>
</form>
<style type="text/css">
  .mdl-card__supporting-text{
    width: 98%;
  }
  textarea,.mdl-textfield{
    width: 100%;
  }
</style>
@stop
