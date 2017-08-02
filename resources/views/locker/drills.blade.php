
<div style="background:white; text-shadow: black 1px 0px 0px;" class="mdl-cell mdl-cell--12-col mdl-shadow--2dp mdl-cell--top actions_bar2">
	<a class="div_change2 mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="analyzed" style="background-color:rgba(158,158,158,.2)">Swing Tips</a>
    <a class="div_change2 mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--red-500" data-div="drills" >Drills</a>
	@if(Auth::user()->pro)
	<a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--green-500" href="{{url("/drill/upload")}}" style="font-size: 22px;">Upload a Drill</a>
	@endif
	<a class="div_change2 mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="client" >@if(Auth::user()->pro)Sent to Students @else In Person Lessons @endif</a>
	@if(!Auth::user()->pro)
	<a class="div_change2 mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--red-500" data-div="submitted" >Submitted</a>
	<a class="div_change2 mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--green-500" data-div="public">Public</a>
	@endif

</div>




@if(Auth::user()->pro)

<div class="switch2 analyzed mdl-grid">
@foreach(Auth::user()->hires_pro as $h)
@if($h->vimeo && $h->vimeo->active)
<a href="video/{{$h->vimeo->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vid{{$h->vimeo->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500"> {{$h->user->morphname()}} --- {{$h->vimeo->title}} --- Go to Video</span>
	</div>
</a>
<script type="text/javascript">
	var options{{$h->vimeo->id}} = {
        id: "{{$h->vimeo->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 300
    };
    var player{{$h->vimeo->id}} = new Vimeo.Player('big_vid{{$h->vimeo->id}}', options{{$h->vimeo->id}});
</script>
@endif
@endforeach
</div>{{--  end switch --}}
<div class="switch2 client mdl-grid">
@if(Auth::user()->vimeos && Auth::user()->vimeos->where('type','client'))
@foreach(Auth::user()->vimeos->where('type','client') as $d)
@if($d->active)
<a href="video/{{$d->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vid{{$d->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow big_image">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500"> Go to Video</span>
	</div>
	</a>
	<script type="text/javascript">
		var options{{$d->id}} = {
        id: "{{$d->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 400
    };
    var player{{$d->id}} = new Vimeo.Player('big_vid{{$d->id}}', options{{$d->id}});
	</script>
	@endif
@endforeach
@endif
</div>{{--  end switch --}}
<div class="switch2 drills mdl-grid">
@if(Auth::user()->vimeos && Auth::user()->vimeos->where('type','drill'))
@foreach(Auth::user()->vimeos->where('type','drill') as $d)
@if($d->active)
<a href="video/{{$d->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vid{{$d->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow big_image">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500">{{$d->title}} | {{$d->created_at->format('F j, Y')}}</span>
	</div>
	</a>
	<script type="text/javascript">
		var options{{$d->id}} = {
        id: "{{$d->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 400
    };
    var player{{$d->id}} = new Vimeo.Player('big_vid{{$d->id}}', options{{$d->id}});
	</script>
	@endif
@endforeach
@endif
</div>{{--  end switch --}}








{{-- ////////end of pro///////////////////////////////////////////////////////////////////////////////////// --}}










@else
<div class="switch2 analyzed mdl-grid">
<div class="explanation">This is where you can find responses from coaches to Swing Tips or online lessons that you have submitted</div>
@foreach(Auth::user()->hires as $h)
@if($h->vimeo && $h->vimeo->active)
<a href="video/{{$h->vimeo->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vid{{$h->vimeo->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500">{{$h->pro->morphname()}}: {{$h->vimeo->title}} | {{$h->vimeo->created_at->format('F j, Y')}}</span>
	</div>
</a>
<script type="text/javascript">
	var options{{$h->vimeo->id}} = {
        id: "{{$h->vimeo->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 300
    };
    var player{{$h->vimeo->id}} = new Vimeo.Player('big_vid{{$h->vimeo->id}}', options{{$h->vimeo->id}});
</script>
@endif
@endforeach
</div>{{--  end switch --}}
<div class="switch2 submitted mdl-grid">
@if($is_me)
<div class="explanation">This is where you can find the raw footage that you have submitted through the Swing Tip process. As a student you can set a FO (Face On) video and DTL (Down-the-Line) video as pubic that is viewable to all other users and coaches. This will be displayed in the Public tab. Learn how the proper way to record these videos in the <a class="mdl-js-ripple-effect mdl-color-text--light-blue-500 explanation" href="{{url("/how")}}" style="font-weight: 300; text-decoration: none;">How To Use page</a></div>
@endif

@foreach(Auth::user()->hires->where('sent', 1) as $h)
@if($h->fv && $h->fv->active)
<a href="video/{{$h->fv->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vid{{$h->fv->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500"> Go to Front View Video</span>
	</div>
</a>
<script type="text/javascript">
	var options{{$h->fv->id}} = {
        id: "{{$h->fv->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 300
    };
    var player{{$h->fv->id}} = new Vimeo.Player('big_vid{{$h->fv->id}}', options{{$h->fv->id}});
</script>
@endif
@if($h->dtl && $h->dtl->active)
<a href="video/{{$h->dtl->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vid{{$h->dtl->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500"> Go to Down the Line Video</span>
	</div>
</a>
<script type="text/javascript">
	var options{{$h->dtl->id}} = {
        id: "{{$h->dtl->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 300
    };
    var player{{$h->dtl->id}} = new Vimeo.Player('big_vid{{$h->dtl->id}}', options{{$h->dtl->id}});
</script>
@endif
@endforeach
</div>{{--  end switch --}}
<div class="switch2 drills mdl-grid">
<div class="explanation">This is where you will find drills that your coach has tagged you in that can help you to improve your swing</div>
@foreach(Auth::user()->hires as $h)
@if($h->drills && count($h->drills)>0)
@foreach($h->drills as $d)
@if($d->active)
<a href="video/{{$h->dtl->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vid{{$d->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500">{{$d->title}} | {{$d->created_at->format('F j, Y')}}</span>
	</div>
</a>
<script type="text/javascript">
	var options{{$d->id}} = {
        id: "{{$d->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 300
    };
    var player{{$d->id}} = new Vimeo.Player('big_vid{{$d->id}}', options{{$d->id}});
</script>
@endif
@endforeach
@endif
@endforeach
</div>{{--  end switch --}}
<div class="switch2 client mdl-grid">
<div class="explanation">This is where you can find the Video Analysis of your swing from your In Person Lessons with your coach for your future reference</div>
@if(Auth::user()->vimeos_student && Auth::user()->vimeos_student->where('type','client'))
@foreach(Auth::user()->vimeos_student->where('type','client') as $d)
@if($d->active)
<a href="video/{{$d->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vid{{$d->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow big_image">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500">{{$d->title}} | {{$d->created_at->format('F j, Y')}}</span>
	</div>
	</a>
	<script type="text/javascript">
		var options{{$d->id}} = {
        id: "{{$d->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 400
    };
    var player{{$d->id}} = new Vimeo.Player('big_vid{{$d->id}}', options{{$d->id}});
	</script>
	@endif
@endforeach
@endif
</div>{{--  end switch --}}
<div class="switch2 public mdl-grid">
<div class="explanation">These are the two videos of your FO (Face On) video and DTL (Down-the-Line) video that is pubic to all other users and coaches. Don't be afraid to show off your swing! Learn how the proper way to record these videos in the <a class="mdl-js-ripple-effect mdl-color-text--light-blue-500 explanation" href="{{url("/how")}}" style="font-weight: 300; text-decoration: none;">How To Use page</a></div>
@if(Auth::user()->fv && Auth::user()->fv->id)
<a href="video/{{Auth::user()->fv->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vidx{{Auth::user()->fv->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500"> Go to Front View Video</span>
	</div>
</a>
<script type="text/javascript">
	var optionsx{{Auth::user()->fv->id}} = {
        id: "{{Auth::user()->fv->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 300
    };
    var playerx{{Auth::user()->fv->id}} = new Vimeo.Player('big_vidx{{Auth::user()->fv->id}}', optionsx{{Auth::user()->fv->id}});
</script>
@endif

@if(Auth::user()->dtl && Auth::user()->dtl->id)
<a href="video/{{Auth::user()->dtl->id}}" class="mdl-cell mdl-cell--6-col">
	<div id="big_vidy{{Auth::user()->dtl->id}}" style="padding:10px;" class="mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500"> Go to Public Down the Line Video</span>
	</div>
</a>
<script type="text/javascript">
	var optionsy{{Auth::user()->dtl->id}} = {
        id: "{{Auth::user()->dtl->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 300
    };
    var playery{{Auth::user()->dtl->id}} = new Vimeo.Player('big_vidy{{Auth::user()->dtl->id}}', optionsy{{Auth::user()->dtl->id}});
</script>
@endif
</div>{{--  end switch --}}
@endif
<style type="text/css">
	.div_change2{
		font-size: 22px;
	}
	.switch2{
		width: 100%;
	}
</style>
<script type="text/javascript">
$('.switch2').hide();
$('.analyzed').show()
	$('.div_change2').on('click', function(event) {
event.preventDefault();
var div = $(this).data('div');
$('.div_change2').css('background-color', 'white');
$(this).css('background-color', 'rgba(158,158,158,.2)');
$('.switch2').css('display', 'none');
$('.'+div).slideDown(300);
});

</script>