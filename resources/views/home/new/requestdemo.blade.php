
<form action="/demo" method="post" class="request_demo_form" style="width: 100%;">
	{{ csrf_field() }}
	{{-- <div class="input">
		<div class="input_label">Student or Coach</div>
		<div class="mdl-textfield">
		<select name="accounttype" id="accounttype" style="width: 300px;">
			<option value="coach" selected>Coach</option>
			<option value="student">Student</option>
		</select>
		</div>
	</div> --}}
	<input type="hidden" name="accounttype" value="coach">
	<hr>
	<div class="input">
		<div class="input_label">Full Name</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="name" id="name" required>
			<label class="mdl-textfield__label" for="name">First and Last Name...</label>
		</div>
	</div>{{-- end .input --}}
	<hr>
	<div class="input">
		<div class="input_label">Course/Academy</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="text" name="academy" id="academy" required>
			<label class="mdl-textfield__label" for="academy">Name of Course or Academy</label>
		</div>
	</div>{{-- end .input --}}
	<hr>
	<div class="input">
		<div class="input_label">Phone Number</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="number" name="phone" id="phone" required>
			<label class="mdl-textfield__label" for="phone">Phone Number</label>
		</div>
	</div>{{-- end .input --}}
	<hr>
	<div class="input">
		<div class="input_label">Email Address</div>
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="email" name="email" id="email" required>
			<label class="mdl-textfield__label" for="email">Email Address...</label>
		</div>
	</div>{{-- end .input --}}

	<hr>
	<div class="input">
		<div class="input_label">State</div>
		<div class="mdl-textfield">
 <select style="width:300px;" required id='state' class="searcher" name="state">
<option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA" selected>Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
</select> 
</div>
	</div>{{-- end .input --}}
<br><br>
	<div style="width: 100%; text-align: center;">
		<button style="width:auto;" class="center-button submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" type="submit">Request Demo</button>
	</div>
</form> 
<script type="text/javascript">
	$('#accounttype, #state').select2();
</script>

