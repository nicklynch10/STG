@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.min.css" media="screen" />

<link type="text/css" rel="stylesheet" href="http://datamine.tech/golf/plupload-2.1.8/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://datamine.tech/golf/plupload-2.1.8/js/plupload.full.min.js"></script>
<script type="text/javascript" src="http://datamine.tech/golf/plupload-2.1.8/js/jquery.ui.plupload/jquery.ui.plupload.min.js"></script>
<br>
<div style="width:90%" class="mdl-grid">
@include('grid.top',['title'=>"Who do you want to see this video:"])

  <select class="other_id">
    <option value="-1" default>Everyone</option>
    @foreach($clients as $client)
    <option value="{{$client->user->id}}">
    {{$client->user->firstname." ".$client->user->lastname }}
    </option>
    @endforeach
  </select>
@include('grid.bottom')
@include('hire.upload')
</div>
              <script type="text/javascript">
              	

var uploader = new plupload.Uploader({
  browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
  url: '../back/back_video_upload.php',
  chunk_size: '200kb',
    max_retries: 3,
    multipart_params: {
  user_id: "{{ $user->id }}"
}
});
 
uploader.init();
 
uploader.bind('FilesAdded', function(up, files) {
  var html = '';
  plupload.each(files, function(file) {
    html += '<li id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
  });
  document.getElementById('filelist').innerHTML += html;
});
 
uploader.bind('UploadProgress', function(up, file) {
  document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
});
 
uploader.bind('Error', function(up, err) {
  document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
});

uploader.bind('FileUploaded', function(up, file, info) {
    $('#' + file.id + " .tick").show();
    //printObject(info);
    var video_bio = $('.bio_textarea').val();
   //video_bio = addslashes(video_bio);
    var custom_name = $('.custom_name').val();
    var select_val = $('.other_id').val();
    //custom_name = addslashes(custom_name);
$.get('video_uploaded', {fileName: file.name,custom_name:custom_name,video_bio:video_bio, other_id:select_val, hire_id:'-1'}, function(data, textStatus, xhr) {
  //optional stuff to do after success 
  $('.bio_textarea').val("");
  $('.custom_name').val("");
  console.log(data);

});
    var response = jQuery.parseJSON(info.response);
    console.log(response);
    //alert(response.error.message);

});

uploader.bind('ChunkUploaded', function(up, file, info) {
     // do some chunk related stuff
     console.log(info);
});
 
document.getElementById('start-upload').onclick = function() {
  uploader.start();
};
              </script>    
              <style type="text/css">
              select {
                font-family: inherit;
                background-color: transparent;
                padding: 0;
                font-size: 20px;
                color: black;
                border: none;
                border-bottom: 1px solid black;
              }
</style>     
@endsection
