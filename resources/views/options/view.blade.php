@extends('layouts.app')

@section('content')
                     
				
<div class="mdl-cell mdl-cell--12-col mdl-cell--top mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<div class="mdl-card__title">
	<h2 class="mdl-card__title-text">{{$pro->full_name()}}'s Lesson Options</h2>
	</div>
</div>       
@foreach($pro->options as $o)
<div class="mdl-cell mdl-cell--6-col mdl-cell--top mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<div class="mdl-card__title">
	<h2 class="mdl-card__title-text">{{$o->title}}</h2>
	</div>
  <div>
  	<div class="mdl-card__supporting-text option_text">
    {{$o->description}}<hr>
    <span class="attr">Price:</span> ${{$o->price}},<br>
    <span class="attr">Amount of lessons:</span> {{$o->quantity}},<br>
    <span class="attr">Maximum amount people in each lesson:</span> {{$o->people}},<br>
    <span class="attr">Duration of Lesson:</span> {{$o->minutes}} Minutes<br>
    <?php
    $current = false;
    foreach ($user->carts as $c) {
      if($c->option&&(int)$c->option->id == (int)$o->id && (int)$c->remaining > 0){
        $current = $c;
        $current->id;
        }
    }
    ?>
      @if($current)
      You have {{$current->remaining}} lessons remaining
      @endif
    </div>
  <div class="mdl-card__actions mdl-card--border">
 	 <form style="width:100%;" action="/option/set/{{$pro->id}}" action="GET">
 	 <input type="hidden" name="option" value="{{$o->id}}">
   @if($current)
    <a href="/option/reset/{{$current->id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Book a Lesson from your {{$current->remaining}} remaining lessons
    </a>
    @else
    <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Book a Lesson with this Lesson Option
    </button>
    @endif
    </form>
  </div>
  </div>
</div>      
@endforeach
          

	<style type="text/css">
	.attr{
		font-size: 20px;
		font-weight: 400;

	}
	.option_text{
		font-size: 18px;
	}
	</style>
@endsection
