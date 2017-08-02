               @extends('layouts.app')

@section('content')
<div class="mdl-cell mdl-cell--12-col mdl-color--light-blue-50 mdl-card mdl-shadow--2dp">
<div class="mdl-card__title mdl-color-text--red-400 special_accent">
    <h2 class="mdl-card__title-text">Edit your&nbsp; <span class="type_name">Golf Institution </span></h2>
  </div>
                    <form role="form" class="mdl-card__supporting-text" method="POST" style="width:100%" action="{{ url('/academy/save/'.$academy->id) }}">
                        {{ csrf_field() }}
                         <div class="input" style="display:flex;">
                    <div>
                    <div class="input_label">Type of Golf Institution</div>
                         <select style="width:80%" id="type" name="type">
                            <option value="academy">Golf Academy</option>
                            <option value="course">Golf Course</option>
                            <option value="range">Golf Range</option>
                            <option value="other">Other</option>
                         </select>
                         </div>
                         
                    </div>
                    <div class="input" style="display:flex;">
                    <div>
                    <div class="input_label">Name of <span class="type_name">Golf Institution</span></div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ $academy->name }}" type="text" name="name" id="name" required>
                                <label class="mdl-textfield__label" for="name"> Name</label>
                         </div>
                         </div>
                         
                    </div>
                     <div class="input">
                    <div class="input_label">Email Address for <span class="type_name">Golf Institution</span> (required)</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ $academy->email }}" type="email" name="email" id="email" required>
                                <label class="mdl-textfield__label" for="email">Email Address</label>
                         </div>
                    </div>{{-- end .input --}}
                    <div class="input">
                    <div class="input_label"><span class="type_name">Golf Institution Bio</span></div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <textarea class="mdl-textfield__input"  name="bio" id="bio">@if($academy->bio){{$academy->bio}}@endif</textarea>
                                <label class="mdl-textfield__label" for="bio">Something about your academy</label>
                         </div>
                    </div>{{-- end .input --}}

                    <div class="input">
                    <div class="input_label"><span class="type_name">Golf Institution</span> Website</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ $academy->website }}" type="text" name="website" id="website">
                                <label class="mdl-textfield__label" for="website">Please add a link to your academies website</label>
                         </div>
                    </div>{{-- end .input --}}

                    <div class="input">
                    <div class="input_label">Years Open as a <span class="type_name">Golf Institution</span></div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input"  value="{{ $academy->yoe }}" type="number" min="0" name="yoe" id="yoe">
                                <label class="mdl-textfield__label" for="yoe">years open</label>
                         </div>
                    </div>{{-- end .input --}}
                   
                    <div class="input" style="display:flex;">
                    <div>
                    <div class="input_label address_title">
                    Address of <span class="type_name">Golf Institution</span> (or location used for lessons)
                    </div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input  class="mdl-textfield__input searcher"  value="{{ $academy->address }}" type="text" name="address" id="address" required>
                                <label class="mdl-textfield__label" for="address">Address</label>
                         </div>
                      </div>
                      <div>
                    <div class="input_label">City</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input  class="mdl-textfield__input searcher"  value="{{ $academy->city }}" type="text" name="city" id="city" required>
                                 <label class="mdl-textfield__label" for="address">City</label>
                         </div>
                    </div>{{-- end .input --}}
                    </div>
                     
                    <div class="input" style="display:flex;">
                    <div>
                    <div  class="input_label">State</div>
                <select style="width:300px;" required id='state' class="searcher" name="state">
<option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA" selected>Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
</select>        
</div>
</div>
<div class="input">
                    <div class="input_label">Zip Code</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input  class="mdl-textfield__input searcher"  value="{{ $academy->zip }}" type="text" name="zip" id="zip" required>
                                 <label class="mdl-textfield__label" for="address">Zip Code</label>
                         </div>
                    </div>{{-- end .input --}}
<div class="input append_address">

</div>
<input type='hidden' class='lat_lng_option' name='lat_lng'>
<input type='hidden' class='lat' name='lat'>
<input type='hidden' class='lng' name='lng'>

 <div class="input">
                <button type="submit" style="margin:auto;" class="mdl-button mdl-js-button mdl-button--raised mdl-color--green-400 mdl-color-text--grey-50 form_submit">
                    Save <span class="type_name">Golf Institution</span>!
                </button>
            </div>
                    </form>
                </div>
              

                                      <script>
    var lat;
    var lng;
      function initService(query, form) {
        var displaySuggestions = function(predictions, status) {
          if (status != google.maps.places.PlacesServiceStatus.OK) {
            console.log("not ok");
            return;
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
                $('.lat').val(lat);
                $('.lng').val(lng);
                $('.lat_lng_option').data('description',prediction.description);
                $('.append_address').text(prediction.description);
                form.trigger('submit');
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
        $('#state, #type').select2();
        $('#state').val('{{$academy->state}}');
        $('#type').val('{{$academy->type}}');
        $('#type').on('change', function(event) {
          var tv = $(this).val();
          if(tv != 'other')$('.type_name').text($('#type option:selected').text());
        });
        $('.form_submit').on('click',function(e){
          e.preventDefault();
          var address = $('#address').val();
          var city = $('#city').val();
          var zip = $('#zip').val();
          var state = $('#state').val();
          var val = address+' '+city+' '+state+' '+zip+' usa';
          initService(val, $(this).closest('form'));
        });
      });
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqXaqZGf1niS-niV4YPXt9CiAwRZCAxQ&libraries=places"
        async defer></script>



<style type="text/css">
    .input{
        width: 60%;
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

@endsection