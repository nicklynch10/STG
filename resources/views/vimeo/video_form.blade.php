@include('vimeo.upload',['vid'=>$vid])
<form method="POST" id="title_form" action="{{url('/video/title/'.$vid->id)}}">
	{{ csrf_field() }}
	<div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input type='text' name="title" value="{{$vid->title or Carbon\Carbon::now()->format('F j, Y')}}" class="mdl-textfield__input" id='title'><label class="mdl-textfield__label" for="title">Video Title...</label></div>
	<br>
	<div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><textarea name="desc" class="mdl-textfield__input" id='desc' style="min-height: 150px; width: 100%;"></textarea><label class="mdl-textfield__label" for="desc">Video Description...</label></div>
</form>
<script type="text/javascript">
	if($("#title_form").length){
	$('.upload_button').on('click',function(e){
		e.preventDefault();
		if($('.upload_input').val()){
		$('.user_warning').text('Uploading... Please do not leave the page.');

		//$('.loading_image').show();

		var overlay = $("<div style='width:100%; height: 100%; top: 0; z-index: 100; position: absolute; background: lightgray; opacity: 0; text-align: center; font-size: large; padding-top: 25%; font-weight: bold;'></div>");
		var overlay2 = $('<div style="width: 350px; position: absolute;top:0%;left:0%;z-index: 90; font-size:30px; font-weight:800; width:100%;height:100%; opacity:.75; text-align:center; line-height:35px; background: white;"><img class="loading_image" style="margin-top:100px;" src="{{Storage::disk('s3')->url('stock/loading2.gif')}}"><br> <div style="padding:25px;">Please do not close the page or disconnect from the internet. This may take several minutes depending on the video size.</div></div>');
		$("body").append(overlay);
		$("body").append(overlay2);
		$.post( $( "#title_form" ).attr('action'), $( "#title_form" ).serialize())
		.done(function(data){
			console.log(data);
			$('.upload_form').trigger('submit');
		});
		}else{
			$('.user_warning').text('Video Not Found');
		}
	});
}
</script>