@if(!$is_me && $is_pro)
<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/testimonial/'.$pro->id)}}">Write a Testimonial</a>
@include('grid.separator',['size'=>12])
@endif

@if($is_pro)
@foreach($pro->testimonials_pro->where('active',1) as $test)
@include('grid.top',['title'=>$test->title,'size'=>6])
{{$test->description}}
<hr>
<div style="width:100%; display:flex;">
<img src="{{$test->user->propic}}" style="width:100px; height:100%;">
<div>
<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/locker/'.$test->user->id)}}">{{$test->user->morphname()}}</a><br>
{{$test->user->city}}, {{$test->user->state}}<br>
Handicap: {{$test->user->handicap}}<br>
{{$test->user->course}}
</div>
</div>
@if($test->user&&$test->user->id == Auth::user()->id)
<hr>
<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/testimonial/delete/'.$test->id)}}">Delete Testimonial</a>
@endif
@include('grid.bottom')
@endforeach
@else
@if($is_me)
<div class="explanation">
This is where you can find the testimonials that you have written about the coaches you have worked with through Swing Tips Golf. These Testimonials are viewable to the public through the coaches profile.
</div>
@endif
@foreach($pro->testimonials as $test)
@include('grid.top',['title'=>$test->title,'size'=>6])
{{$test->description}}
<hr>
<div style="width:100%; display:flex;">
<img src="{{$test->pro->propic}}" style="width:100px; height:100%;">
<div>
<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/locker/'.$test->pro->id)}}">{{$test->pro->morphname()}}</a>
{{$test->user->city}}, {{$test->user->state}}<br>
{{$test->user->course}}
</div>
</div>
@include('grid.bottom')
@endforeach

@endif