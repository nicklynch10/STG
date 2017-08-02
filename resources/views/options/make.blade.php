@extends('layouts.app')

@section('content')
                     
				
				<div class="mdl-cell mdl-cell--12-col mdl-cell--top mdl-shadow--2dp mdl-color--white is-casting-shadow">
					<div class="mdl-card__title">
				    <h2 class="mdl-card__title-text">Edit Your Lesson Option</h2>
				  	</div>
				  	<form 
				  	@if($option->id)
				  	action="/option/save/{{$option->id}}"
				  	@else
				  	action="/option/save"
				  	@endif
				  	 method="POST" style="width: 100%;">
				  	 {{ csrf_field() }}
				  	<div class="input">
				  	<div class="input_label">Option Title</div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$option->title}}" type="text" name="title" id="title" required>
			        			<label class="mdl-textfield__label" for="title">Example "Two 30 Minute Lessons"</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Option Description</div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<textarea style="height:100px;" class="mdl-textfield__input" name="description" id="description">{{$option->description}}</textarea>
			        			<label class="mdl-textfield__label" for="description">Option Description...</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Lesson Option Duration in Minutes</div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$option->minutes}}" min="5" max="720" type="number" name="minutes" id="minutes" required>
			        			<label class="mdl-textfield__label" for="minutes">Example "30"</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Maximum Amount of People included in Lesson Option <br> <span style="font-size:15px;"> If the lesson is a solo lesson specify "1"</span></div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$option->people}}" min="1" max="100" type="number" name="people" id="people" required>
			        			<label class="mdl-textfield__label" for="people">Example "1"</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Amount of Lessons in Package</div>
				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$option->quantity}}" min="1" max="100" type="number" name="quantity" id="quantity" required>
			        			<label class="mdl-textfield__label" for="quantity">Example "2"</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Price of Lesson Option ($)
				  	<br> <span style="font-size:15px;"> This includes the amount of lessons specified above, not for each individual. Please be aware that a 2.9% transaction fee will be charged on this price.</span>
				  	</div>

				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$option->price}}" min="0" type="number" name="price" id="price" required>
			        			<label class="mdl-textfield__label" for="price">Price of Lesson Options...</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>
				  	<div class="input">
				  	<div class="input_label">Location of Lesson
				  	<br> <span style="font-size:15px;">This is the location you typically hold the lesson. If you are flexible, please indicate that here.</span>
				  	</div>

				  		 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			        			<input class="mdl-textfield__input"  value="{{$option->location}}" type="text" name="location" id="location" required>
			        			<label class="mdl-textfield__label" for="location">Location of Lesson...</label>
			     		 </div>
				  	</div>{{-- end .input --}}
				  	<hr>

				  	<div class="input">
				  	<button style="margin:20px;" class="submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" type="submit">Save Lesson Option</button>
				  	@if($option->id)
				  	<a style="margin:20px;" href="/option/delete/{{$option->id}}" class="submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-color--red-A200 mdl-color-text--grey-50" >Delete Lesson Option</a>
				  	@else
				  	<a style="margin:20px;" href="/locker" class="submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-color--red-A200 mdl-color-text--grey-50" >Cancel Lesson Option</a>
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
