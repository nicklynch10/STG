@extends('layouts.app')

@section('content')

<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.min.css" media="screen" />

<link type="text/css" rel="stylesheet" href="http://datamine.tech/golf/plupload-2.1.8/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://datamine.tech/golf/plupload-2.1.8/js/plupload.full.min.js"></script>
<script type="text/javascript" src="http://datamine.tech/golf/plupload-2.1.8/js/jquery.ui.plupload/jquery.ui.plupload.min.js"></script>
<br>
<form class="naming" style="width:50%">
@include('grid.top', ['title'=>"Playlist Information", 'size'=>12])
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input form_item" type="text" value="{{$playlist->title}}" name="playlist_name" id="playlist_name">
    <label class="mdl-textfield__label" for="playlist_name">Name of Playlist:</label>
  </div>
   <div style="width: 100%;" class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input form_item" name="playlist_des" type="text" rows= "8" id="playlist_des" >{{$playlist->description}}</textarea>
    <label class="mdl-textfield__label" for="playlist_des">Playlist description...</label>
  </div>
  <br>
  Publish this Playlist:
  @if($playlist->active)
  <input class="form_item" type="checkbox" id="playlist_publish" name="publish" checked>
  @else
  <input class="form_item" type="checkbox" id="playlist_publish" name="publish">
  @endif
  <br>
  <br>
  Price of this Playlist:
  <select class="form_item" id="playlist_price" name="price">
    <option value="10">$10</option>
    <option value="20">$20</option>
    <option value="30">$30</option>
    <option value="40">$40</option>
    <option value="50">$50</option>
    <option value="60">$60</option>
    <option value="70">$70</option>
    <option value="80">$80</option>
    <option value="90">$90</option>
    <option value="100">$100</option>
    <option value="110">$110</option>
    <option value="120">$120</option>
    <option value="130">$130</option>
    <option value="140">$140</option>
    <option value="150">$150</option>
    <option value="160">$160</option>
    <option value="170">$170</option>
    <option value="180">$180</option>
    <option value="190">$190</option>
    <option value="200">$200</option>
  </select>
  <br>
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <button type="Submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Save Information
    </button>
     <a href="/playlist/delete/{{$playlist->id}}" class="mdl-button mdl-color-text--red-500 mdl-js-button mdl-js-ripple-effect">
      Delete Prerecorded Lesson Playlist
    </a>
  </div>
</div>
</div>

  </form>
@include('hire.upload')
@foreach($playlist->videos as $video)
@include('grid.video_format')
@endforeach

              <script type="text/javascript">
              function saveData(e){
            var name = $('#playlist_name').val();
            var des = $('#playlist_des').val();
            var publish = $('#playlist_publish').val();
            var price = $('#playlist_price').val();
            e.preventDefault();
            $.get('/playlist/save/{{$playlist->id}}', {name:name,description:des,price:price,publish:publish}, function(data, textStatus, xhr) {
             console.log(data);
             var snackbarContainer = document.querySelector('#snackbar');
             snackbarContainer.MaterialSnackbar.showSnackbar({message:"Information Saved."});
            });
          };
         $(function() {
          $('.naming').on('submit',saveData);
          $('.form_item').on('change', saveData);
           var children = $('#playlist_price').children('option');
           for(var i = 0;i<children.length;i++){
            if($(children[i]).val() == "{{$playlist->price}}"){
                $(children[i]).attr('selected', true);
            }
           }

         });     	

var uploader = new plupload.Uploader({
  browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
  url: '/back/back_video_upload.php',
  chunk_size: '200kb',
    max_retries: 3,
    multipart_params: {
  user_id: "{{ $user->id }}"
},
max_file_size: "500mb"
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
$.get('/video_uploaded', {fileName: file.name,custom_name:custom_name,video_bio:video_bio, playlist_id:'{{$playlist->id}}'}, function(data, textStatus, xhr) {
  //optional stuff to do after success 
  $('.bio_textarea').val("");
  $('.custom_name').val("");
  console.log(data);
  location.reload();

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
