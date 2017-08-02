@extends('layouts.app')
@section('content')
<figure class="mdl-cell mdl-cell--12-col mdl-cell--top">
	{{-- <video class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image video-js" data-setup="{}" style="width: 100%;" controls>
		<source src="{{ url($med->url)}}" type="video/mp4">
		Your browser does not support the video tag.
	</video> --}}
	<div id="big_vid" class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image">
		Please Wait...
	</div>
</figure>

@include('grid.top',['size'=>12,'title'=>$med->title,'class'=>'helper', 'class3'=>'align-center'])
<div style="float: right;">
<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{$med->download_link_hd}}" download="swingtipsdownload.mp4">Download in Original Quality</a>
<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{$med->download_link_sd}}" download="swingtipsdownload.mp4">Download in Standard Quality</a>
<br>
@if(!Auth::user()->pro)
@if($med->user->id == Auth::user()->id &&(!Auth::user()->dtl || Auth::user()->dtl->id != $med->id))
<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{url('/public/dtl/'.$med->id)}}">Make this video your public DTL swing</a>
@endif
@if($med->user->id == Auth::user()->id &&(!Auth::user()->fv || Auth::user()->fv->id != $med->id))
<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{url('/public/fv/'.$med->id)}}">Make this video your public FV swing</a>
@endif
@endif
</div>
<div class="mobile_hide" style="display:flex;">
	<img class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow" style="max-width:100%; max-height: 100px" src="{{$med->user->propic}}">
	<div style="padding: 5px;">
		<a class="mdl-button mdl-js-button mdl-js-ripple-effect name_button" href='{{url("/locker/".$med->user->id)}}'>{{$med->user->morphname()}}</a>
		<br>
	</div>
</div>
@if(!$med->description && !$med->title)
No information provided.
@endif
{{$med->description}}

@if($med->user&&$med->user->id == Auth::user()->id && $med->type=="drill")
<br>
<button class="mdl-button mdl-js-button mdl-js-ripple-effect edit_drill_button" >Edit Drill</button>
<a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="/drill/delete/{{$med->id}}">Delete Drill</a>
<form method="POST" class="edit_drill_form" action="{{url('/drill/save/'.$med->id)}}" style="text-align: center; width: 100%;">
	{{ csrf_field() }}
	  <div style="width:100%;">
                    <div style="font-size: 24px;">Title of Drill</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{$med->title}}" type="text"  name="title" id="title">
                                <label class="mdl-textfield__label" for="title">Drill Title</label>
                         </div>
                         </div>
                         <div style="width:100%;">
                    <div style="font-size: 24px;">Description of Drill</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 80%;">
                                <textarea class="mdl-textfield__input" name="description" id="description">
                                {{$med->description}}
                                </textarea>
                                <label class="mdl-textfield__label" for="description">Drill Description</label>
                         </div>
                         </div>
                         <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect" >Save Drill</button>
</form>

@endif
</div>
</div>
</div>

		
	<style type="text/css">
	.custom_text{
	padding: 0px;
	width: auto;
	}
	.custom_li{
	padding-bottom: 3px;
	padding-top: 3px;
	}
	.align-center{
	margin:auto;
	}
	.helper2{
	display: none;
	}
	.banner{
	min-height: 25px;
	}
	.hide{
	display: none;
	}
	body{
	background: #212121;
	}
	.fix_width{
	width:23%;
	}
	</style>
	<script type="text/javascript">
	var pct = 100;
	while($('.big_image').height()> 900){
	pct -= 1;
	$('.big_image').width(pct+'%');
	}
	
	</script>

	<script type="text/javascript">
	var options = {
        id: "{{$med->vim_id}}",
        title: false,
        byline:false,
        color: '4fc3f7',
        height: 500
    };
    var player = new Vimeo.Player('big_vid', options);
	</script>
	<script type="text/javascript">
	$('.edit_drill_form').hide();
		if($('.edit_drill_button').length>0){
			$('.edit_drill_button').on('click', function(event) {
				$('.edit_drill_form').show();
				$('.edit_drill_button').hide();
			});
		}
	</script>
	@endsection