                    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif               
                    <div class="input" style="display:block;">
                    <div>
                    <div class="input_label">First Name</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('firstname') }}" type="text" name="firstname" id="firstname" required>
                                <label class="mdl-textfield__label" for="firstname">First Name</label>
                         </div>
                         </div>
                         <div>
                    <div class="input_label">Last Name</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('lastname') }}" type="text" name="lastname" id="lastname" required>
                                <label class="mdl-textfield__label" for="lastname">Last Name</label>
                         </div>
                    </div>{{-- end .input --}}
                    </div>
                     <div class="input">
                    <div class="input_label">Email Address</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('email') }}" type="email" name="email" id="email" required>
                                <label class="mdl-textfield__label" for="email">Email Address</label>
                         </div>
                    </div>{{-- end .input --}}

                     <div class="input">
                    <div class="input_label">Password</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('password') }}" type="password" name="password" id="password" required>
                                <label class="mdl-textfield__label" for="password">Password</label>
                         </div>
                    </div>{{-- end .input --}}

                     <div class="input">
                    <div class="input_label">Password Confirmation</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('password_confirmation') }}" type="password" name="password_confirmation" id="password_confirmation" required>
                                <label class="mdl-textfield__label" for="password_confirmation">Confirm Password</label>
                         </div>
                    </div>{{-- end .input --}}
                     <div class="input">
                    <div class="input_label phone">Phone Number (optional)</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('phone') }}" type="number" name="phone" id="phone" >
                                <label class="mdl-textfield__label" for="phone">Phone Number...</label>
                         </div>
                    </div>{{-- end .input --}}

                    <div class="input handicap onlynonpro" style="display:block;">
                    <div>
                    <div class="input_label">Estimation of your Handicap</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('handicap') }}" type="number" name="handicap" step="any" id="handicap">
                                <label class="mdl-textfield__label" for="handicap">Handicap</label>
                         </div>
                         </div>
                         <div>
                    <div class="input_label">Your Age</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ old('age') }}" type="number" min="1" max="120" name="age" id="age" >
                                <label class="mdl-textfield__label" for="age">Age</label>
                         </div>
                    </div>{{-- end .input --}}
                    </div>

                    <div class="input">
                    <div class="input_label">User Bio</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                         @if(old('bio'))
                         <textarea class="mdl-textfield__input"  name="bio" id="bio">{{old('bio')}}</textarea>
                         @else
                        <textarea class="mdl-textfield__input"  name="bio" id="bio"></textarea>
                         @endif
                                <label class="mdl-textfield__label" for="bio">Something about yourself</label>
                         </div>
                    </div>{{-- end .input --}}
                   {{--  <div class="input">
                    <div  class="input_label">Tag a Reference if you have one</div>
                    <select style="" id='reference_id' class="reference_id" name="reference_id">
                    <option value="" selected>No Reference</option>
                    @foreach(App\User::all() as $u)
                    <option value="{{$u->id}}">{{$u->morphname()}}</option>
                    @endforeach
                    </select>
                    </div> --}}

                    {{-- <div class="input">
                    <div  class="input_label">Golf Course</div>
                    <select style="" id='course_id' class="course_id" name="course_id">
                    <option value="" selected>Not Listed</option>
                    @foreach(App\Academy::all()->where('type','course'); as $u)
                    <option value="{{$u->id}}">{{$u->morphname()}}</option>
                    @endforeach
                    </select>
                    </div>  --}}
                    {{-- end input --}}
                   
                    <div class="input" style="display:block;">
                    <div>
                    <div class="input_label address_title">
                    Address Where Lessons Take Place
                    </div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input  class="mdl-textfield__input searcher"  value="{{ old('address') }}" type="text" name="address" id="address" required>
                                <label class="mdl-textfield__label" for="address">Address</label>
                         </div>
                      </div>
                      <div>
                    <div class="input_label">City</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input  class="mdl-textfield__input searcher"  value="{{ old('city') }}" type="text" name="city" id="city" required>
                                 <label class="mdl-textfield__label" for="address">City</label>
                         </div>
                    </div>{{-- end .input --}}
                    </div>
                     
                    <div class="input" style="display:block;">
                    <div>
                    <div  class="input_label">State</div>
                <select style="" required id='state' class="searcher" name="state">
<option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA" selected>Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
</select>        
</div>
</div>
<div class="input">
                    <div class="input_label">Zip Code</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input  class="mdl-textfield__input searcher"  value="{{ old('zip') }}" type="text" name="zip" id="zip" required>
                                 <label class="mdl-textfield__label" for="address">Zip Code</label>
                         </div>
                    </div>{{-- end .input --}}
<div class="input append_address">

</div>
<input type='hidden' class='lat_lng_option' name='lat_lng'>
    {{--  lat+"|||||"+lng     --}}                
                          
                      
                        <script>
    var lat;
    var lng;
      function initService(query, form) {
        var displaySuggestions = function(predictions, status) {
          if (status != google.maps.places.PlacesServiceStatus.OK) {
            console.log("not ok");
            //alert("Your address was not found. Please enter a valid address, if it continues not to find your address, please enter a different nearby address.");
          }
          predictions.forEach(function(prediction) {
            lat = false;
            lng = false;
            geocoder.geocode({'address': prediction.description}, function(results, status) {
              if (status === google.maps.GeocoderStatus.OK) {
              lat = results[0].geometry.location.lat();
              lng = results[0].geometry.location.lng();
              if(lat&&lng){
                $('.lat_lng_option').val(lat+"|||||"+lng);
                $('.lat_lng_option').data('description',prediction.description);
                //$('.append_address').text(prediction.description);
                //form.trigger('submit');
          }
        }//end if status
            });
          });
        };
        var geocoder = new google.maps.Geocoder();
        var service = new google.maps.places.AutocompleteService();
        service.getQueryPredictions({ input: query }, displaySuggestions);
      }
      jQuery(document).ready(function($) {
        $('#state, #reference_id, #course_id').select2();
        $('#city, #zip, #state').on('focusout',function(e){
          //e.preventDefault();
          var address = $('#address').val();
          var city = $('#city').val();
          var zip = $('#zip').val();
          var state = $('#state').val();
          var val = city+' '+state+' '+zip+' usa';
          initService(val, $(this).closest('form'));
        });
      });
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqXaqZGf1niS-niV4YPXt9CiAwRZCAxQ&libraries=places"
        async defer></script>



<style type="text/css">
    .input{
        margin:auto;
        background: white;
        padding: 20px;
        box-shadow: 0px 1px 1px black;
    }
    .input>div{
      width: 100%;
    }

    .mdl-textfield__input{
        width: 100%;
    }
    textarea{
      min-height:200px;
    }
</style>