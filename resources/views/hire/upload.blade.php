<?php if(!isset($title)) $title = "Upload Video" ?>
<?php if(!isset($max)) $max = "500mb" ?>
@include('grid.top',["title"=>$title, "size"=>6])
 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="custom_name mdl-textfield__input" type="text" id="custom_name">
    <label class="mdl-textfield__label" for="custom_name">Name of Video:</label>
  </div>
   <div style="width: 100%;" class="mdl-textfield mdl-js-textfield">
    <textarea class="mdl-textfield__input bio_textarea" name="vid" type="text" rows= "8" id="desc" ></textarea>
    <label class="mdl-textfield__label" for="desc">Video description...</label>
  </div>
 
<ul id="filelist"></ul>
<br />
<div id="container">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="browse" href="javascript:;">Browse...</a>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="start-upload" href="javascript:;">Start Upload</a>
</div>
<br />
Video can not be larger than {{$max}}<br>
<pre id="console"></pre>   
@include('grid.bottom')