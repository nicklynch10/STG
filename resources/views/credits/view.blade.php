@extends('layouts.app')

@section('content')

You have {{count(Auth::user()->credits->where('pro_id',(string)$pro->id)->where('active','1'))}} lesson credits for {{$pro->morphname()}}

@include('grid.separator', ['size'=>12])

@foreach(Auth::user()->credits->where('pro_id',(string)$pro->id)->where('active','1') as $c)
<?php $o = $c->option; ?>
<div class="mdl-cell mdl-cell--6-col mdl-cell--top mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<div class="mdl-card__title">
	<h2 class="mdl-card__title-text mdl-color-text--light-blue-500 " style="font-size:19px;">{{$o->title}}</h2>
	</div>
  <div>
  	<div class="mdl-card__supporting-text option_text">
    {{$o->description}}<hr>
    <span class="attr">Price:</span> Using Previously Purchased Credit,<br>
    <span class="attr">Amount of lessons:</span> 1,<br>
    <span class="attr">Maximum amount people in each lesson:</span> {{$o->people}},<br>
    <span class="attr">Duration of Lesson:</span> {{$o->minutes}} Minutes<br>
    </div>
  <div class="mdl-card__actions mdl-card--border">
 	 <form style="width:100%;" action="{{url('/credit/use/'.$c->id)}}" action="GET">
 	 <input type="hidden" name="option" value="{{$o->id}}">
 	 <input type="hidden" name="credit" value="{{$c->id}}">
    <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      <i class="material-icons">golf_course</i> Book this Lesson using Credit
    </button>
    </form>
  </div>
  </div>
</div>      
@endforeach
          

	<style type="text/css">
	.attr{
		font-size: 18px;
		font-weight: 400;

	}
	.option_text{
		font-size: 18px;
	}
	</style>

	@endsection