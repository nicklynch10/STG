@extends('layouts.app')

@section('content')
                     
				
				<div class="mdl-cell mdl-cell--12-col mdl-cell--top mdl-shadow--2dp mdl-color--white is-casting-shadow">
					<div class="mdl-card__title">
				    <h2 class="mdl-card__title-text">Edit Your Camp</h2>
				  	</div>
				  	<form 
				  	@if($camp->id)
				  	action="/camp/save/{{$camp->id}}" 
				  	@else
				  	action="/camp/save"
				  	@endif
				  	method="post" style="width: 100%;">
				  	 {{ csrf_field() }}
				  	<div class="input">
				  	<div class="input_label">Camp Title</div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$camp->title}}" type="text" name="title" id="title" required>
			        			<label class="mdl-textfield__label" for="title">Example "Workshop to teach the basics of golf."</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Camp Description</div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<textarea style="height:100px;" class="mdl-textfield__input" name="description" id="description">{{$camp->description}}</textarea>
			        			<label class="mdl-textfield__label" for="description">Camp Description...</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	@if(!$can_edit)
				  	<div style="text-align: center; font-size:20px;">Since students are already enrolled you may not edit the price, date, time or duration of the camp.</div>
				  	@endif
				  	<div class="input">
				  	<div class="input_label">Camp Date and Time</div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input type="date" value="{{$camp->start_date}}" name="start_date" min="{{\Carbon\Carbon::today()->toDateString()}}" id="start_date" required

			        			@if(!$can_edit) readonly @endif>
			        			<br><br>
			        			<input type="time" value="{{$camp->start_time}}" name="start_time" id="start_time" required
			        			@if(!$can_edit) readonly @endif>
			        			<br>
			        			<div>Example "6/12/2021" <br> "2:00pm"</div>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Camp Duration in Minutes</div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$camp->minutes}}" min="5" max="720" type="number" name="minutes" id="minutes" required
			        			@if(!$can_edit) readonly @endif>
			        			<label class="mdl-textfield__label" for="minutes">Example "90"</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Price of Camp ($)</div>

				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$camp->price}}" min="0" type="number" name="price" id="price" required
			        			@if(!$can_edit) readonly @endif>
			        			<label class="mdl-textfield__label" for="price">Price of Camp...</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Maximum Amount of People Allowed to Enroll</div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$camp->max}}" min="1" max="1000" type="number" name="max" id="max" required>
			        			<label class="mdl-textfield__label" for="max">Example "15"</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">

				  	<button style="margin:20px;" class="submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" type="submit">Save Camp</button>
				  	@if($camp->id)
				  	<a style="margin:20px;" href="/camp/delete/{{$camp->id}}" class="submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-color--red-A200 mdl-color-text--grey-50" type="submit">Delete Camp</a>
				  	@else
				  	<a style="margin:20px;" href="/locker/" class="submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-color--red-A200 mdl-color-text--grey-50">Cancel Camp</a>
				  	@endif
				  	</div>
				  	</form>
				</div>


<script type="text/javascript">
	
</script>
				
     <style type="text/css">
     	.input{
     		width: 80%;
     		margin:auto;
     		min-height:100px;
     		display: flex;
     	}
     	.mdl-textfield{
     		width: 70%;
     		margin-left: auto;
     	}
     	.input_label{
     		font-size: 25px;
     		margin: 20px;
     		line-height: 25px;
     		max-width:300px;
     	}
     </style>             
          
@endsection
