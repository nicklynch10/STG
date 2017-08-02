<form  enctype="multipart/form-data" role="form" method="POST" action="{{ url('/sendupload') }}" style="display: none;">
	{{ csrf_field() }}
	
	<input class="mdl-button upload_propic mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="file" name="pic" accept="image/*">
	<button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
	Upload Profile Picture
	</button>
	
</form>
{{-- <hr> --}}
<form  enctype="multipart/form-data" role="form" method="POST" action="{{ url('/sendupload') }}" style="display: none;">
	{{ csrf_field() }}
	<input class="mdl-button mdl-button--colored upload_cover mdl-js-button mdl-js-ripple-effect" type="file" name="cover" accept="image/*">
	<button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
	Upload Cover Photo
	</button>
	
</form>