@extends('layouts.app')
@section('content')
<form  enctype="multipart/form-data" style="width:40%; background:white; min-height:300px; padding:20px;" role="form" method="POST" action="{{ url('/sendupload') }}">
	{{ csrf_field() }}
	
	<input class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="file" name="pic" accept="image/*">
	
	<button type="submit" class="btn btn-primary mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
	Upload Profile Picture
	</button>
	
</form>
<hr>
<form  enctype="multipart/form-data" class="mdl-shadow--2dp" style="width:40%; background:white; min-height:300px; padding:20px;" role="form" method="POST" action="{{ url('/sendupload') }}">
	{{ csrf_field() }}
	
	<input class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="file" name="cover" accept="image/*">
	
	<button type="submit" class="btn btn-primary mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
	Upload Cover Photo
	</button>
	
</form>

@endsection