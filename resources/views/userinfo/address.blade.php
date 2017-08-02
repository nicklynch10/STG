@extends('layouts.app')

@section('content')


<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col">
<form method="post" id="mainform" action="{{url('/address/save')}}" style="width: 100%;">
{{ csrf_field() }}
<input type='hidden' class='lat_lng_option' name='lat_lng'>
  <div style="margin:  20px 50px; ">
    <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{Auth::user()->morphname()}}'s Address</div>
    <div style="width: 50%;">
      Please fill out the following correctly.
      @if(Auth::user()->pro)
      Please use an address you would like Swing Tips to use. If you only have lessons at one place use that address. If you are flexible where you have lessons, use a home location.
      @else
      Please use an address you would like Swing Tips to use. If you usually have lessons after work or in an area other than your home use that address. If you are flexible where you have lessons, use a home location.
      @endif
    </div>
    <hr>
                <div style="display:flex; width: 100%;">
                    <div style="width:49%;">
                    <div style="width: 100%; font-size: 18px; font-weight: 400;">
                    @if(Auth::user()->pro)Address where lessons may take place
                    @else Address where you would like lessons near
                    @endif
                    </div>
                    
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input  class="mdl-textfield__input"  value="{{Auth::user()->address}}" type="text" name="address" id="address" required>
                                <label class="mdl-textfield__label" for="address">Address</label>
                         </div>
                      </div>
                      <div style="width: 49%;">
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input  class="mdl-textfield__input searcher"  value="{{Auth::user()->city}}" type="text" name="city" id="city" required>
                                 <label class="mdl-textfield__label" for="city">City</label>
                         </div>
                    </div>
                    </div>


                    <div style="width: 100%; margin-top: 30px">
                    <div style="width: 100%; font-size: 18px; font-weight: 400;">State</div>
                <select style="width:300px;" required id='state' class="searcher" name="state">
<option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA" selected>Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>
</select>  
                      </div>

                      <div style="margin-top: 30px;">
                      <div style="width: 100%; font-size: 18px; font-weight: 400;">Zip Code</div>
                         <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input searcher"  value="{{Auth::user()->zip}}" type="text" name="zip" id="zip" required>
                                 <label class="mdl-textfield__label" for="address">Zip Code</label>
                         </div>
                    </div>
  </div>
  <hr>
  <div class="input append_address">
  &nbsp;
</div>
<hr>
  <div style="margin: 20px 80px; width: 100%;">
  <a class="btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-color--light-blue-300 form_submit" >Save Address Information</a>
  </div>
</form>
</div>
{{Auth::user()->state}}
<style type="text/css">
  .paper{
    margin: auto;
    margin-top: 25px;
    background: white;
  }
</style>
<script type="text/javascript">
  $('#state').val('{{Auth::user()->state}}');
  $('#state').select2();
  $('#state').trigger('change');
</script>

 <script>
    var lat;
    var lng;
      function initService(query, form) {
        console.log("h");
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
        $('.form_submit').on('click',function(e){
          e.preventDefault();
          var address = $('#address').val();
          var city = $('#city').val();
          var zip = $('#zip').val();
          var state = $('#state').val();
          var val = address+' '+city+' '+state+' '+zip+' usa';
          initService(val, $('#mainform'));
        });
      });
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqXaqZGf1niS-niV4YPXt9CiAwRZCAxQ&libraries=places"
        async defer></script>
@endsection