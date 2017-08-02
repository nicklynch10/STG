
@extends('layouts.app_nogrid')
@section('content')
@include('dashboard.scripts')
<?php $max_file_size = '50mb'; ?>
<form style="width:100%" method="POST" class="hireform" action="{{url('/response/send/'.$hire->id)}}">
{{ csrf_field() }}
<div style="width:90%" class="mdl-grid">
  @include('grid.top',["title"=>"Define your typical miss?"])

        {{$hire->field1}}
        <br>
        {{$hire->field2}}

        @include('grid.bottom')


		
    @include('grid.top',["title"=>"Anything specific you would like to work on?","size"=>"6"])
    {{$hire->field3  or ""}}
    @include('grid.bottom')
                
        		 			
                    @foreach($videos as $key=>$video)
                    @if($video->user_id == $other->id)
                    @include('grid.video_format',['video'=>$video])
                    @endif
                    @endforeach
                  
         


           @include('grid.top',["title"=>"Analysis of Game"])
  <div style="width: 100%;" class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" name="field4" type="text" rows= "15" id="sample2" >{{$hire->field4}}</textarea>
    <label class="mdl-textfield__label" for="sample2">Details about {{$user->firstname}}'s game...</label>
    Give some details on what you saw.
  </div>
  @include('grid.bottom')


@include('grid.top',["title"=>"How to Improve"])
  <div style="width: 100%;" class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input" name="field5" type="text" rows= "15" id="sample2" >{{$hire->field5}}</textarea>
    <label class="mdl-textfield__label" for="sample2">Help {{$user->firstname}} improve...</label>
    Based on the information given, give any way to can improve.
  </div>
  @include('grid.bottom')
                    <?php $vid_count = 0; ?>
                    @foreach($videos as $key=>$video)
                    @if($video->user_id != $other->id)
                    <?php $vid_count++; ?>
                    @include('grid.video_format',['video'=>$video])
                    @endif
                    @endforeach

@if($vid_count == 0)
 @include('hire.upload', ['title'=>'Upload Response Video', 'max'=>$max_file_size]) 
 @endif
             @include('grid.separator',['size'=>'12'])
             @include('grid.separator',['size'=>'3'])
            <a style="width:200px; height: 45px; margin:10px;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent save_info">
            Save Information!
          </a> <button style="width:200px; height: 45px; margin:10px" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-color--green-400">
            Reply to {{$hire->user->firstname}}!
          </button>
          <a style="width:200px; height: 45px; margin:10px" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent mdl-color--red-400 delete_form">
            Delete Hire Form
          </a>
            </div>
      </form>

              <script type="text/javascript">
                

var uploader = new plupload.Uploader({
  browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
  url: '{{url("/back/back_video_upload.php")}}',
  chunk_size: '200kb',
    max_retries: 3,
    multipart_params: {
  user_id: "{{ $user->id }}",
max_file_size: "{{$max_file_size}}"
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
    live_save(function(){
    var video_bio = $('.bio_textarea').val();
   //video_bio = addslashes(video_bio);
    var custom_name = $('.custom_name').val();
    //custom_name = addslashes(custom_name);
$.get("/video_uploaded", {fileName: file.name,custom_name:custom_name,video_bio:video_bio,other_id:{{$other->id}},hire_id:{{$hire->id}}}, function(data, textStatus, xhr) {
  //optional stuff to do after success 
  $('.bio_textarea').val("");
  $('.custom_name').val("");
  console.log(data);
  $('form').attr('action', '');
  //$('form').attr('method', 'GET');
  $('form').trigger('submit');


});
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


function live_save(callback){
    $.post(window.location, $('.hireform').serializeArray(), function(data, textStatus, xhr) {
      /*optional stuff to do after success */
      tooltip("Information Saved");
      console.log(data);
      if(typeof callback =='function') callback();
    });
}


$('.save_info').on('click', function(){
  live_save();
});
$('.delete_form').on('click', function(){
  window.location = '{{url('/home')}}';
});
$('textarea').on('change', live_save);
              </script>     
              @include('hire.style')      
@stop
