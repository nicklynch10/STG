
@extends('layouts.app_nogrid')

@section('content')
<form style="width:100%" method="POST">
<div style="width:90%" class="mdl-grid">
{{ csrf_field() }}
        @include('grid.top',["title"=>"Rate your response"])
        <input type="radio" name='rating' value="1">1 Star</input>
       <input type="radio" name='rating' value="2">2 Stars</input>
       <input type="radio" name='rating' value="3">3 Stars</input>
       <input type="radio" name='rating' value="4">4 Stars</input>
       <input type="radio" name='rating' value="5">5 Stars</input>

        <div class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" type="text" rows= "3" id="sample1" name="description" ></textarea>
    <label class="mdl-textfield__label" for="sample1">Anything else to say...</label>
  </div>
        @include('grid.bottom_submit',['button_name'=>"Submit Review"])
</div>
</form>
@stop
