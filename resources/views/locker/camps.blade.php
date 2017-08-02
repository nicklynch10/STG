
@if($is_me && $is_pro) 
<a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('camp/edit/')}}">Create New Camp<i class="material-icons">golf_course</i></a>
@endif
<div class="mdl-cell mdl-cell--12-col">&nbsp;</div>
@foreach($pro->camps as $o)
@if($o && $o->start&&$o->active && \Carbon\Carbon::now('America/Vancouver') < \Carbon\Carbon::parse($o->start))
<div class="mdl-cell mdl-cell--6-col mdl-cell--top mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<div class="mdl-card__title">
	<h2 class="mdl-card__title-text mdl-color-text--light-blue-500 " style="font-size:19px;">{{$o->title}}</h2>
	</div>
  <div>
  	<div class="mdl-card__supporting-text option_text">

    {{$o->description}}<hr>
    <span class="attr">Price:</span> ${{$o->price}},<br>
    <span class="attr">Date and Time:</span> {{$o->display_start}},<br>
    <span class="attr">Duration:</span> {{$o->minutes}} minutes, ({{round(((int)$o->minutes)/60,2)}} hours)<br>
    <span class="attr">Amount of people currently enrolled:</span> {{$o->enrolled}}<br>

    <br>
    <div style="font-weight: bold;">Camp Enrollment is non refundable</div>
    </div>
  <div class="mdl-card__actions mdl-card--border">
 	
 	 <input type="hidden" name="option" value="{{$o->id}}">
	@if($is_me && $is_pro) 
 	 <a style="font-size:17px;" class="mdl-color-text--light-blue-500 mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('/camp/edit/'.$o->id)}}"
		>
		Edit {{$o->title}}
		<i class="material-icons">golf_course</i></a>
	@elseif($o->users->contains(Auth::user()->id))
	You are enrolled in this camp.<br>
	@else
    <a href="/camp/enroll/{{$o->id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      <i class="material-icons">golf_course</i> Enroll in Camp
    </a>
    @endif
    
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