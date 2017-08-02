			
                   <div class="mdl-cell mdl-cell--{{$size or "6"}}-col mdl-cell--top">
<div style="width: 100%;" class="mdl-card mdl-shadow--2dp mdl-color--white-100 is-casting-shadow">
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text mdl-color-text--red-400">{{$video->title or ""}}</h2>
  </div>
  <div style="
  text-align: center;
  max-width: 100%;
  " class="full">
      <?php
    $rand = rand(1,1000000);
    ?>
      @if($video->converted == 1)
          <video style="max-width:100%;max-height:650px; margin:auto;" controls poster="{{$video->cover}}" preload="none">
                      <source src="{{ url($video->url)}}" type="video/mp4">
                      <source src="{{ url($video->url)}}" type="video/ogg">
                    Your browser does not support the video tag.
         </video>
    @else
    <span>This video has not been processed, and it may be distorted or displayed incorrectly, please allow up to 2 hours for it to process.</span><br>
    <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500 display_video_buttom{{$rand}}" style="width:auto; margin:auto;">Display Video Anyway</a>
    <br>
     <video style="display:none; max-width:100%;max-height:650px; margin:auto;" class="display_video{{$rand}}" controls poster="{{url($video->cover) or '/nothing'}}" preload="none">
                      <source src="{{ url($video->url)}}" type="video/mp4">
                      <source src="{{ url($video->url)}}" type="video/ogg">
                    Your browser does not support the video tag.
         </video>
         <script type="text/javascript">
           $('.display_video_buttom{{$rand}}').on('click', function(event) {
             event.preventDefault();
             $('.display_video{{$rand}}').show();
             $(this).remove();
           });
         </script>
    @endif
    </div>
         <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" style="width:auto; margin:auto;" href="{{url($video->url)}}" download> Download This Video</a>
    <div class="mdl-card__supporting-text display-1">
    {{$video->description}}
    </div>
</div>
</div>
