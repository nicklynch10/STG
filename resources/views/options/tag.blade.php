@extends('layouts.app')
@section('content')
<div class="mdl-cell mdl-cell--1-col"></div>
<div class="mdl-cell mdl-cell--10-col">
	<div class="mdl-shadow--2dp" style="padding: 10px; margin:10px; background: white;">
	<div class="mdl-grid" style="width: 100%;">
	<img src="{{url($o->user->propic)}}" class="mdl-cell mdl-cell--5-col" style="max-width:300px; height:100%; padding: 20px;">
		<div class="mdl-cell mdl-cell--7-col" style="padding: 5px; text-align: center;">
			<div class="mdl-color-text--light-blue-500" style="text-align: center; font-size: 27px; line-height: 45px;"> 
			(Optional)
			<br>
			Tag anyone else that is included in this lesson, or input their email.
			</div>
			<br>
			<br>
			<form action="/option/tag/done/{{$o->id}}" method="POST">
			{{ csrf_field() }}
			@for($i=0;$i<($o->people-1);$i++)
			
			<div class="mdl-grid">
			<select name="tag{{$i}}" style="min-width:100px;" class="searchselect mdl-cell mdl-cell--6-col" index="{{$i}}">
			<option value="-1">Student Does not have a Swing Tips Golf Account</option>
			@foreach($users as $u)
				<option value="{{$u->id}}">{{$u->morphname()}}</option>
			@endforeach
			</select>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--6-col" id="otheremaildiv{{$i}}">
                                <input  class="mdl-textfield__input" type="email" name="otheremail{{$i}}" id="otheremail{{$i}}">
                                <label class="mdl-textfield__label" for="otheremail{{$i}}">Email of Student</label>
                         </div>
			</div>
			
			@endfor
			<br>
			<button type="submit" style="font-size: 25px; line-height: 26px; padding: 10px 10px;" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-cell--6-col">
      Book your Lesson(s)!
    		</button>
			</form>
		<br>
	</div>
	</div>
</div>
</div>
<div class="mdl-cell mdl-cell--1-col"></div>
<script type="text/javascript">
	$('.searchselect').select2();
	$('.searchselect').on('change', function(event) {
		var $this = $(this);
		var index = $this.attr('index');
		if($this.val() != "-1")$('#otheremaildiv'+index).hide();
		else $('#otheremaildiv'+index).show();
	});
</script>
@endsection