
@extends('layouts.app')

@section('content')
<div style="width:100%;">
@if($is_acad)
<a class="mdl-button mdl-js-button mdl-js-ripple-effect top_button mdl-shadow--2dp" href="/dashboard">View by Pro <i class='material-icons'>group</i></a>
@else
<a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-shadow--2dp top_button" href="/dashboard/academy">View by Academy <i class='material-icons'>school</i></a>
@endif
</div>
<br><br>
<div style="font-size: 22px;">Find a coach that you would to work with. Check out their profiles to see their lesson options, camps they are running, reviews, client list, testimonials and more! Sort the list by any category you want. If you already know your coach, you can also search them in the search bar. If you have already worked with them through Swing Tips Golf, you can find them under the Pro's &amp; Lessons tab in your Locker as well. </div>
<div class="mdl-cell--12-col">
	<div style="padding-bottom:10px;" class="mdl-shadow--4dp mdl-color--white above_pros">
	<div style="margin:20px;padding:5px;display:flex;font-size:18px;min-height:100px;background-color:#FAFAFA;" class="title_box"> 
	<i style="display:none;" class="material-icons arrow_down">arrow_drop_down</i>
	<i style="display:none;" class="material-icons arrow_up">arrow_drop_up</i>
	@if(!$is_acad)
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_name" data-type="name" style="width:25%; text-align:center;">Pros</div>
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_yoe" data-type="yoe" style="width:10%; text-align:center;"> Years of Experience</div>
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_rating" data-type="rating" style="width:10%; text-align:center;">Average Rating<br><span style="font-size:14px;">(Out of 5)</span></div>
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_academy" data-type="academy" style="width:25%; text-align:center;">Academy</div>
	@else
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_name" data-type="name" style="width:25%; text-align:center;">Academy</div>
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_yoe" data-type="yoe" style="width:10%; text-align:center;"> Years as an Academy</div>
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_rating" data-type="rating" style="width:10%; text-align:center;">Average Rating<br><span style="font-size:14px;">(Out of 5)</span></div>
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_pros" data-type="pros" style="width:25%; text-align:center;">Pros</div>
	@endif
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_city" data-type="city" style="width:15%; text-align:center;">Location</div>
	<div class="sort mdl-button mdl-js-button mdl-js-ripple-effect sort_distance" data-type="distance" style="width:14%; text-align:center;">Distance<br><span style="font-size:14px;">miles</span></div>
	</div>
	<?php $pro_count = 0; ?>
    <div class="sort_select_div" style="margin: 20px; padding: 10px; display: none;">
    Sort by
        <select class="sort_select">
            <option value="sort_name" selected>Name</option>
            <option value="sort_yoe">Years of Experience</option>
            <option value="sort_rating">Average Rating</option>
            <option value="sort_city">Location</option>
            <option value="sort_distance">Distance</option>
        </select>
    </div>
	@foreach($pros as $pro)
    <div class="mobile_row" id="mobile_row_{{$pro_count}}" style="display: none;">
         <a style="font-size:22px; margin-left:0px; padding-left: 0px;" 
         class="mdl-button mdl-js-button mdl-js-ripple-effect" 
         @if(!$is_acad) href="/locker/{{$pro->id}}"
         @else href="/academy/{{$pro->id}}"
         @endif
        > 
     {{$pro->morphname()}}
          <img style="max-height:50px;" src="{{$pro->propic}}">
          </a>
          <div class="mobile_attr"><span style="font-weight: 400;">Years of Experience: </span> {{$pro->yoe}}</div>
          <div class="mobile_attr"><span style="font-weight: 400;">Average Rating: </span> {{$pro->avg_rating()}}</div>
          <div class="mobile_attr"><span style="font-weight: 400;">Location: </span> {{$pro->city}}, {{$pro->state}}</div>
          <div class="mobile_attr"><span style="font-weight: 400;">Distance: </span> <span id="mobile_row_distance_{{$pro_count}}">N/A</span></div>
          
      </div>
	<div class="pro_row" index="{{$pro_count}}" id="pro_row_{{$pro_count}}"
	 data-city="{{$pro->city}}, {{$pro->state}}"
	 data-yoe="{{$pro->yoe}}"
	 data-name="{{$pro->morphname()}}"
	 @if($pro->avg_rating() == 'N/A')
	 data-rating="0"
	 @else
	 data-rating="{{$pro->avg_rating()}}"
	 @endif
	 @if(!$is_acad&&$pro->academy)
	 data-academy="{{$pro->academy->morphname()}}"
	 @elseif($is_acad)
	 data-pros="{{count($pro->users)}}"
	 @else
	 data-academy="zzzzzz"
	 @endif
	  style="margin:20px;border-bottom:1px grey solid;min-height:120px; display:flex;">

	<div style="width:25%;">
	<a style="height:175px;" class=" mdl-button mdl-js-button mdl-js-ripple-effect mdl-grid"
     @if(!$is_acad) href="/locker/{{$pro->id}}"
     @else href="/academy/{{$pro->id}}"
     @endif
     >
     <div class="mdl-cell--6-col" >
     <img style="height: 100px;" src="{{$pro->propic}}"><br>
      <span style="font-size:20px; padding:5px;">{{$pro->morphname()}}</span>
     </div>
  <?php
  $bio = $pro->bio;
  if(strlen($bio)>220)$bio = substr($bio,0,220).'...';
  ?>
  <div class="mdl-cell--6-col" style="line-height: 17px;">{{$bio}}</div>
	</a>
	</div>
	<div style="width:10%; text-align:center;font-size:17px;">{{$pro->yoe}} Years</div>
	<div style="width:10%; text-align:center;font-size:17px;">{{$pro->avg_rating()}} Stars</div>
	<div style="width:25%; text-align:center;font-size:17px;">
	@if(!$is_acad&&count($pro->academies)>0)
    @foreach($pro->academies as $u)
        <a style="height:100px;" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-cell--4-col" href="/academy/{{$u->id}}">
    <img style="height:70px;" src="{{$u->propic}}"><br>
    <span style="font-size:17px; padding:5px;">{{$u->morphname()}}</span>
    </a>
        @endforeach
	</a>
	@elseif($is_acad)
		<div style="width:100%;" class="mdl-grid">
		@foreach($pro->users as $u)
		<a style="height:100px;" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-cell--4-col" href="/locker/{{$u->id}}">
	<img style="height:70px;" src="{{$u->propic}}"><br>
	<span style="font-size:17px; padding:5px;">{{$u->morphname()}}</span>
	</a>
		@endforeach
		</div>
	@else
	Not in an Academy
	@endif
	</div>
	<div style="width:15%; text-align:center;font-size:17px;">{{$pro->city}}, {{$pro->state}}</div>
	
	<div style="width:14%; text-align:center;font-size:17px;" class="pro_distance pro_distance_{{$pro_count}}">N/A</div>
	</div>
	<?php $pro_count++; ?>
	@endforeach
	</div>
</div>

<script type="text/javascript">
var distances = [];
var destinations = [];
var num = 0;
 function findDistance(origin, destinations2) {
        var geocoder = new google.maps.Geocoder;
        var service = new google.maps.DistanceMatrixService;
        service.getDistanceMatrix({
          origins: origin,
          destinations: destinations2,
          travelMode: google.maps.TravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.IMPERIAL,
          avoidHighways: false,
          avoidTolls: false
        }, function(response2, status) {
          response = response2.rows[0].elements;
          console.log(response);
          for(var i = 0;i<response.length;i++){
            if(response[i] && response[i].distance && response[i].distance.text){

            distances[i+num] = (response[i].distance.text);
            var dist = distances[i+num];
            var mobile_dist = distances[i+num];
            if(response[i].duration&&response[i].duration.text)
            	dist += '<br><br>'+response[i].duration.text;
                mobile_dist += ', '+ response[i].duration.text;
            console.log(dist);
            $('.pro_distance_'+(i+num)).first().html(dist);
            $('#mobile_row_distance_'+(i+num)).html(mobile_dist);
            $('#pro_row_'+(i+num)).data('distance', response[i].distance.value)
        }else{
            distances[i+num] = 'N/A';
            $('#pro_row_'+(i+num)).data('distance', '99999999');
          }
        }
        if(num+24 < destinations.length){
        	num+= 24;
        findDistance(origin, destinations.splice(num,num+24));
        }
        });
      }

		@foreach($pros as $p)
		var lat_lng = {lat:parseFloat('{{$p->lat}}'),lng:parseFloat('{{$p->lng}}')};
		    destinations.push(lat_lng);
		@endforeach
     
      function start(){
      	var user_lat_lng = {lat:parseFloat('{{$user->lat}}'),lng:parseFloat('{{$user->lng}}')};
            var subDestinations = destinations.slice(0,25);
            findDistance([user_lat_lng], subDestinations, 0);
      }

      </script>

      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjqXaqZGf1niS-niV4YPXt9CiAwRZCAxQ&callback=start"
    async defer></script>

    <script type="text/javascript">

    	$('.sort').on('click', function(event) {
    		var rows = $('.pro_row');
    		var sort_array = [];
    		var self = $(this);
    		
    		for (var i = 0; i < rows.length; i++) {
    			var attr = $(rows[i]).data(self.data('type'));
    			if(parseInt(attr) > 0) attr = parseInt(attr);
    			var t = {}
    			t['prop']=attr;
    			t['index']=parseInt($(rows[i]).attr('index'));
    			sort_array.push(t);
    		}
    		bubbleSort(sort_array);

    		$('.arrow_down').hide();
    		$('.arrow_up').hide();
    		if(self.find('.arrow_down').length>0){
    			$('.arrow_up').show();
    			$('.above_pros').append($('.arrow_down'));
    			self.append($('.arrow_up'));
    		for (var i = sort_array.length - 1; i >= 0; i--) {
    			$('.above_pros').append($('#pro_row_'+sort_array[i].index));
                $('.above_pros').append($('#mobile_row_'+sort_array[i].index));
    		}
    		}else{
    			for (var i = 0; i < sort_array.length; i++) {
    			$('.above_pros').append($('#pro_row_'+sort_array[i].index));
                $('.above_pros').append($('#mobile_row_'+sort_array[i].index));
    		}
    			$('.arrow_down').show();
    			$('.above_pros').append($('.arrow_up'));
    			self.append($('.arrow_down'));
    		}
    	});

        $('.sort_select').on('change', function(event) {
            console.log("hehe");
            var val = $(this).val();
            $('.'+val).trigger('click');
        });
        $('.sort_select').select2();
 
function bubbleSort(a)
{
    var swapped;
    do {
        swapped = false;
        for (var i=0; i < a.length-1; i++) {
            if (a[i].prop > a[i+1].prop) {
                var temp = {index:a[i].index,prop:a[i].prop};
                a[i] = {index:a[i+1].index,prop:a[i+1].prop};
                a[i+1] = temp;
                swapped = true;
            }
        }
    } while (swapped);
}

    </script>
    <style type="text/css">
    .arrow_down,.arrow_up{
    	display: none;
    	font-size: 30px;
    	color:blue;
    }
    .sort{
    	cursor: pointer;
    	font-size: 22px;
    	height: auto;
    }
    .top_button{
    	 float:right;
    	 font-size:25px;
    	 color:#8BC34A;
    	 background-color:white;
    	 text-shadow: 1px 1px 1px #E0E0E0;
    	 margin-right:16px;
    }
    .top_button:hover{
    	background-color: rgba(0,0,0,.05);
    	text-shadow:none;
    }
    @media all and (max-width: 768px) {
        .title_box{
            display: none !important;
        }
        .pro_row{
            display: none !important;
        }
        .mobile_row{
            padding: 5px;
             padding-top: 10px;
             margin-top: 15px;
             border-bottom:1px grey solid;
             min-height:50px;
             display: block !important;
        }
        .sort_select_div{
            display: block !important;
        }
    }
    </style>
@endsection