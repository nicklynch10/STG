@if($is_pro)
@if($is_me)
<div style="width:100%;">
<a style="font-size:20px; margin:auto;" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/playlist/new')}}">New Prerecorded Lessons Playlist</a>
</div>
@endif
@foreach($pro->playlists as $key=>$playlist)
<div style="margin-bottom:25px; margin-right:10px; margin-left:-5px;" class="mdl-cell--6-col mdl-card mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<div class="mdl-card__title" style=" width:100%;">
		<a style="font-size:20px; margin:auto;" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" 
		@if($is_me)
		href="{{url('/playlist/manage/'.$playlist->id)}}">Manage 
		@else
		href="{{url('/playlist/'.$playlist->id)}}">Preview 
		@endif
		{{$playlist->title or "Prerecorded Lesson Set-".$key}}</a>
	</div>
	<div class="mdl-grid mdl-card__supporting-text"> 
		<div style="width:100%; text-align:center; padding-bottom:20px;">
		{{$playlist->description}}
		</div>
		@foreach($playlist->videos->take(2) as $v)
		<figure class="mdl-cell--6-col piclink" style="padding:0px;margin:0px;">
		<video style="width:90%; padding-bottom:20px;">
                      <source src="{{ url($v->url)}}" type="video/mp4">
                      <source src="{{ url($v->url)}}" type="video/ogg">
                    Your browser does not support the video tag.
        </video>
        </figure>
		@endforeach
	</div>
</div>
@endforeach

@elseif(!$is_pro && $is_me)
{{$pro->playlists_owners}}
@foreach($pro->playlist_owners as $key=>$o)
<?php $playlist = $o->playlist; ?>
<div style="margin-bottom:25px;" class="mdl-cell--6-col mdl-card mdl-shadow--2dp mdl-color--white is-casting-shadow">
	<div class="mdl-card__title" style=" width:100%;">
		<a style="font-size:20px; margin:auto;" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/playlist/'.$playlist->id)}}">
		View {{$playlist->title or "Prerecorded Lesson Set-".$key}}</a>
	</div>
	<div class="mdl-grid mdl-card__supporting-text"> 
		@foreach($playlist->videos->take(2) as $v)
		<div class="mdl-cell--6-col">
		<video style="width:90%; padding-bottom:20px;" preload="none" controls>
                      <source src="{{ url($v->url)}}" type="video/mp4">
                      <source src="{{ url($v->url)}}" type="video/ogg">
                    Your browser does not support the video tag.
        </video>
        </div>
		@endforeach
	</div>
</div>
@endforeach



@endif