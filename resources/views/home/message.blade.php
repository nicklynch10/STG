@extends('layouts.app')

@section('content')
                     
				
				<div class="mdl-cell mdl-cell--12-col mdl-cell--top mdl-shadow--2dp mdl-color--white is-casting-shadow">
					<div class="mdl-card__title">
				    <h2 class="mdl-card__title-text">{{$message or "Sorry, you cannot complete your action. Please try again or contact customer service."}}</h2>
				  	</div>
				</div>


@endsection
