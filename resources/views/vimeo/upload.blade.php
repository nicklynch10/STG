
<form method="POST" class="upload_form" action="{{$vid->upload_link}}?redirect={{url($vid->redirect)}}|||||{{$vid->user->id}}|||||{{$vid->ticket_id}}|||||{{$vid->id}}" enctype="multipart/form-data">
<div class="user_warning"></div>
<input class="mdl-button mdl-js-button mdl-js-ripple-effect upload_input" type="file" name="file_data" required>
<button class="upload_button mdl-button mdl-js-button mdl-js-ripple-effect" style="font-size: 20px; line-height: 20px;">Submit Video</button>
</form>