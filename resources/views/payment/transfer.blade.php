@extends('layouts.app_nogrid')
@section('content')
<div style="background: black;">
<div class="last_home_div">
<div>Transfer to PayPal</div>
<br>

<form action="/payout" method="post" class="request_demo_form" style="width: 100%;">
	{{ csrf_field() }}
	<hr>
	<div class="input">
		<div class="input_label">Re-Enter Your PayPal Email</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="email" name="paypal_email" id="paypal_email" required>
			<label class="mdl-textfield__label" for="paypal_email">PayPal Email...</label>
		</div>
	</div>{{-- end .input --}}
	<hr>
	<div class="input">
		<div class="input_label">Enter your Swing Tips Account Password</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="password" name="password" id="password" required>
			<label class="mdl-textfield__label" for="password">Password</label>
		</div>
	</div>{{-- end .input --}}
	<hr>
	<div style="width: 80%; margin: auto;">By confirming the following you agree that the PayPal Email you enter above is a valid email to submit the payment to and Swing Tips Golf is not liable if the email submitted here is not the correct account. In order to continue you must re-enter both you PayPal email and your account password. Submitting this form will trigger the transfer to your PayPal account.</div>
	<div class="input">
		<div class="input_label">Confirm Transfer</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
  			<input type="checkbox" id="checkbox-1" name="confirm" class="mdl-checkbox__input" required>
			</label>
		</div>
	</div>{{-- end .input --}}
	<hr>

<br><br>
	<div style="width: 100%; text-align: center;">
		<button style="width:auto;" class="center-button submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" type="submit">Submit Payout</button>
	</div>
</form> 
</div>
@include('home.welcome.style')
@endsection