
@if($is_me && $is_pro) 
<a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('option/edit/')}}">New Lesson Option<i class="material-icons">golf_course</i></a>
@endif
@if(!$is_me &&$is_pro)
<div style="font-weight: 400; font-size:19px;">
You have {{count(Auth::user()->credits->where('pro_id',(string)$pro->id)->where('active','1'))}} lesson credits for {{$pro->morphname()}}
@if(count(Auth::user()->credits->where('pro_id',(string)$pro->id)->where('active','1')) > 0)
<br>
<a style="font-size:22px;" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('/credit/'.$pro->id)}}">Book Lessons using Credit</a>
@endif
</div>
@endif
<div class="mdl-cell mdl-cell--12-col"></div>
@if($pro->accepts_swingtips)
@include('grid.separator', ['size'=>12])
<div style="background:white; min-height:250px;" class="mdl-cell mdl-cell--6-col mdl-shadow--2dp mdl-cell--top">
	<div class="mdl-card__supporting-text">
	@if(!$is_me && $is_pro) 
		<a style="font-size:19px;" class="mdl-color-text--light-blue-500 mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" 
		href="{{url('/hire/pro/'.$pro->id)}}">
		Hire For Swing Tip<i class="material-icons">video</i></a>
	@elseif($is_me && $is_pro)
	<div style="font-size:19px;" class="mdl-color-text--light-blue-500 " 
		href="{{url('/hire/pro/'.$pro->id)}}">
		Hire For Swing Tip<i class="material-icons">video</i></div>
	@endif
		
		<hr>
		<span style="font-size: 18px; font-weight: 400;">
		A Swing Tip is another word for Online Instruction. This is a process where a student submits two videos of their swing to a Coach or Pro at different angles. Then the coach is able to respond wth a voiced over video of them analzing the students swing using the Swing Analysis software of their choice. The coach can also tag students in drills that they have uploaded that can help the students with improving their game. The goal is to create an experience that is comparable to an In Person Lesson. The coach has 72 hours to respond or you get fully refunded.
		</span><br><br>
		<span class="attr">Price:</span><span style="font-size: 18px;">${{$pro->swingtip_price}}</span>
	</div>
	@if($is_me && $is_pro)
	<a href="{{url('/account')}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Edit Price</a>
	@endif
</div>
@endif
{{-- @foreach($pro->options->where('active',"1") as $o)
<div style="background:white; min-height:250px;" class="mdl-cell mdl-cell--6-col mdl-shadow--2dp mdl-cell--top">
	<div class="mdl-card__supporting-text">
		<a style="font-size:19px;" class="mdl-color-text--light-blue-500 mdl-button mdl-js-button
			mdl-button--accent mdl-js-ripple-effect"
			@if($is_me && $is_pro) href="{{url('option/edit/'.$o->id)}}"
			@elseif(!$is_me && $is_pro) href="{{url('options/'.$pro->id)}}"
			@endif
		>{{$o->title}}<i class="material-icons">golf_course</i></a>
		<hr>
		<b>Cost: </b>${{$o->price}}<br>
		{{$o->description}}
	</div>
</div>
@endforeach

 --}}
@foreach($pro->options as $o)
@if($o->active)
<div class="mdl-cell mdl-cell--6-col mdl-cell--top mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<div class="mdl-card__title">
	<h2 class="mdl-card__title-text mdl-color-text--light-blue-500 " style="font-size:19px;">{{$o->title}}</h2>
	</div>
  <div>
  	<div class="mdl-card__supporting-text option_text">
    {{$o->description}}<hr>
    <span class="attr">Price:</span> ${{$o->price}},<br>
    <span class="attr">Amount of lessons:</span> {{$o->quantity}},<br>
    {{-- <span class="attr">Location:</span> {{Auth::user()->address}},<br> --}}
    <span class="attr">Maximum amount people in each lesson:</span> {{$o->people}},<br>
    <span class="attr">Duration of Lesson:</span> {{$o->minutes}} Minutes,<br>
    <span class="attr">Location of Lesson:</span> {{$o->location}}
    <?php
    $current = false;
    foreach (Auth::user()->carts as $c) {
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
	@if($is_me && $is_pro) 
 	 <a style="font-size:17px;" class="mdl-color-text--light-blue-500 mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('option/edit/'.$o->id)}}"
		>
		Edit {{$o->title}}
		<i class="material-icons">golf_course</i></a>
	@else
   @if($current)
    <a href="/option/reset/{{$current->id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      <i class="material-icons">golf_course</i> Book a Lesson from your {{$current->remaining}} remaining lessons
    </a>
    @else
    <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      <i class="material-icons">golf_course</i> Book a Lesson with this Lesson Option
    </button>
    @endif
    @endif
    </form>
  </div>
  </div>
</div>      
@endif
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