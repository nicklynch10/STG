<!-- requires user and other -->
<div style="display:flex;">
<img class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow" style="max-width:100%; max-height: 80px" src="{{$other->propic}}">
<div style="padding: 5px;">
<a class="mdl-button mdl-js-button mdl-js-ripple-effect name_button" href='{{url("/locker/".$other->id)}}'>{{$other->morphname()}}</a>
<br>
</div>
</div>