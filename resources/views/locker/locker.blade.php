

   @extends('layouts.app_nogrid')
@section('content')
@include('dashboard.scripts')
<?php
$is_me = false;
$is_pro = false;
if(Auth::user()->id == $pro->id){
	$is_me = true;
}
if($pro->pro == 1){
	$is_pro = true;
}
?>
<div class="mdl-grid">
<a style="background-size:cover;background-image: url('{{$pro->cover or $pro->propic}}'); width:calc(100% + 20px); height:400px;background-position: center; margin: -5px -7px; cursor: pointer;" class="cover" id="cover">
</a>
  <div style="margin-top:-300px;" class="mdl-cell--4-col fix_grid" >
    <div class="mdl-cell--12-col mdl-grid">
      <a style="margin: 0px; cursor: pointer;">
        <img class="mdl-shadow--4dp mdl-color--white-100 is-casting-shadow propic" style="width:500px" src="{{$pro->propic or $pro->cover}}" id="propic">
      </a>
    </div>
    @include('grid.top',["title"=>$pro->morphname(), "size"=>12])
    {{$pro->city}}, {{$pro->state}}<br>
    {{-- @if($pro->course_id)
    <b>Primary Course: </b>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/academy/{{$pro->course_id}}">{{$pro->course->morphname()}}</a>
    @endif --}}
    @if($is_pro || $is_me || (Auth::user()->clients_pro && Auth::user()->clients_pro->contains($pro->id)))
    Email: {{$pro->email}}<br>
    @if($pro->phone)Phone: {{$pro->phone}}<br>@endif
    @endif
    <hr>
    {{$pro->bio}}
    <br><br>
    @if(!$is_pro)
    <b>Handicap:</b> {{$pro->handicap}}<br>
    @endif
    @if($pro->pro)
    <b>Years of Experience:</b> {{$pro->yoe}}<br>
    <b>Signed up for Swing Tips Golf:</b> {{$pro->created_at->diffForHumans()}}<br>
    <b>Experience:</b> {{$pro->experience}}<br><br>
    @foreach($pro->academies as $a)
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/academy/{{$a->id}}">{{$a->morphname()}}</a>
      @endforeach
      @if($is_me)
      <br>
       <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/academy/new">Create a New Golf Institution</a><br><span style="font-size:14px;">This could be a Golf Course, Academy, Driving Range, ect.</span>
      @endif
      <br>
      @if(isset($pro->website))
      <a target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{$pro->website}}">{{$pro->morphname()}}'s Website</a><br>
      @endif
    @endif
    @if($is_me)
    <hr>
    <b>Swing Tips Golf Balance:</b> {{$pro->balance}}<br>
    @if($is_pro)
    <b>Pending Balance:</b> {{$pro->pending_balance}}<br>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect payout_button" href="javascript:AlertIt()">Transfer to PayPal</a>
    @endif
    @endif
    @include('grid.bottom')
    @if(!$is_me && $is_pro)
      @include('grid.top',["title"=>"Actions", "size"=>12])
                     @if(!isset($pro->watching))
                     <form role="form" method="POST" action="{{url('/locker/'.$pro->id)}}">
                     {{ csrf_field() }}

                     <input type="hidden" name="user" value="{{$pro->id}}"></input>
                     <button class="mdl-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50 mdl-js-button mdl-js-ripple-effect" type="submit">Add to Watchlist</button>
                     </form>
                     <hr>
                     @else
                     User is on watchlist
                     <hr>
                     @endif
                     <a class="mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color--light-blue-500 mdl-color-text--grey-50" href="{{url('/hire/pro/'.$pro->id)}}">Hire For Swing Tip</a>
                     <hr>
                     <a class="mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color--yellow-500" href="{{url('/options/'.$pro->id)}}">Hire For In Person Lesson</a>
                      @include('grid.bottom')
    @endif
    @if($is_me)
    {{-- @include('grid.top',["title"=>"Actions", "size"=>12]) --}}
    @include('locker.upload_pics')
    {{-- <hr>
    <div style="text-align:center; width:100%;">
     <b>Data Used: </b> {{round(((float)$pro->data)/10**9,4)}} GB of {{$pro->alotted}} GB
     </div>
    @include('grid.bottom') --}}

     @include('grid.top',["title"=>"My Account", "size"=>12])
     @if(!$is_pro)
      <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" href="{{url('/shortgame')}}">Edit Shortgame Information</a>

     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--green-500" href="{{url('/specific')}}">Edit Specific Swing Information</a>


      <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-green-500" href="{{url('/general')}}">Edit General Swing Information</a>

      <br>
     @endif
     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-800" href="{{url('/account')}}">Edit Account Information</a>
     <br>
     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-800" href="{{url('/address/')}}">Edit Address Information</a>
     <br>
     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-800" href="{{url('/password/')}}">Change Account Password</a>
     <br>
     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-800" href="{{url('/next')}}">Next Steps</a>

     @include('grid.bottom')
    @endif
  </div>{{--  end column 2 --}}
  <div style="height:100%; margin-top:-100px;" class="mdl-grid mdl-cell--8-col">
  <div class="big_name" style="font-size:40px; line-height:40px; text-shadow: black 2px 2px 3px; color: white; font-weight:800; margin:5px;">
    {{$pro->morphname()}}
    </div>

    <div style="background:white; text-shadow: black 1px 0px 0px;" class="mdl-cell mdl-cell--12-col mdl-shadow--2dp mdl-cell--top actions_bar">

    @if($pro->pro)
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" style="background-color:rgba(158,158,158,.2)" data-div="options" >Lesson Options</a>
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-green-500" data-div="camps" >Camps</a>
      {{-- <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="playlists" >Prerecorded Lessons</a> --}}
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--red-500" data-div="media" >Videos</a>
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="clients" >Client List</a>
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--green-500"  data-div="ratings" >SwingTip Ratings</a>
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--blue-500" data-div="testimonials" >Testimonials</a>
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--red-500" data-div="website">Website</a>
    @else
    @if($is_me)
       <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--red-500" data-div="events" style="background-color:rgba(158,158,158,.2)">Events</a>
    @endif
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--green-500" data-div="media" >Videos</a>
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="clients">Pros &amp; Lessons</a>
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--red-500" data-div="testimonials" >Testimonials</a>
      @if($is_me || (Auth::user()->clients_pro && Auth::user()->clients_pro->contains($pro->id)))
      <a class="div_change  mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--blue-500" data-div="golfgame">Golf Game Information</a>
      @endif
    @endif

    </div>
    <!-- Now we get to the profile stuff -->
    <div class="switch options mdl-grid">
     @include('locker.options', compact('pro','is_pro','is_me'))
    </div>{{--  end switch --}}
    <div class="switch playlists mdl-grid">
    @include('locker.playlists', compact('pro','is_pro','is_me'))
    </div>{{--  end switch --}}
    <div class="switch clients mdl-grid">
       @include('locker.clients', compact('pro','is_pro','is_me'))
    </div>{{--  end switch --}}
    <div class="switch ratings mdl-grid">
      @include('locker.ratings', compact('pro','is_pro','is_me'))
    </div>
    <div class="switch testimonials mdl-grid">
      @include('locker.testimonials', compact('pro','is_pro','is_me'))
    </div>
    <div class="switch camps mdl-grid">
      @include('locker.camps', compact('pro','is_pro','is_me'))
    </div>
    <div class="switch golfgame mdl-grid">
     @include('userinfo.view.allinfoinclude', ['student'=>$pro])
    </div>{{--  end switch --}}
    @if(!Auth::user()->pro)
    <div class="switch events mdl-grid">
      @include('locker.events', compact('pro','is_pro','is_me'))
    </div>
    @endif
     <div class="switch media mdl-grid">

      @if($is_me)
      @include('locker.drills', compact('pro','is_pro','is_me'))
      @elseif(Auth::user()->pro)
      <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('video/send/'.$pro->id)}}">Send {{$pro->morphname()}} a Lesson Video<i class="material-icons">forward</i></a>
      @endif
    </div>
    <div class="switch website mdl-grid">
    <?php
    $website = false;
    if(isset($pro->website)){
      $website = $pro->website;
      $has_http = strrpos($website,"http://");
      if($has_http === false)$website ="http://".$website;
    }
    ?>
      @if($website)
        @if($is_me)
        Please make sure the website is inputed correctly,<br>
        iframe does not support https sites.<br>
        @endif
      <iframe class="mdl-shadow--2dp" style="width:100%; height:1000px;" src="{{$website}}">
          Your browser does not support IFrames
      </iframe>
      @endif
    </div>{{--  end switch --}}
  </div>{{--  end column 2 --}}
</div>{{--  end biggest div --}}
</div>
<script type="text/javascript">
var self;
$('.switch').css('display', 'none');
@if($is_pro)
$('.options').show();
@elseif($is_me)
$('.events').show();
@else
$('.media').show();
@endif
$('.div_change').on('click', function(event) {
event.preventDefault();
 self = $(this);
var div = self.data('div');
$('.div_change').css('background-color', 'white');
self.css('background-color', 'rgba(158,158,158,.2)');
$('.switch').css('display', 'none');
  $('.'+div).slideDown(300,function(){
     // $('html, body').animate({
     //      scrollTop: self.position().top -80
     //    }, 300);
  });
});
var pp_height = $('.propic').height();
var pp_width = $('.propic').width();
var pp_ratio = pp_height/pp_width;
var pp_new_height = ($('.fix_grid').width() *pp_ratio);
var pp_percent = $('.fix_grid').width()/$(window).width();

$('.propic').css('width', Math.floor(pp_percent*100)+"vw");
//$('.propic').css('display', 'block');
//$('.fix_grid').width($('.propic').width()+10);
</script>
<style type="text/css">

.explanation{
  font-size: 20px;
}
.note_link{
float: right;
padding-right: 25px;
}
.mdl-button--raised:hover{
  box-shadow: none;
}
.banner{
min-height: 25px;
}
.hide{
display: none;
}
.switch{
width: 100%;
}
body{
 /* background: #757575;*/
  overflow-x: hidden;
}
.actions_bar{
    min-height: 80px;
    line-height: 80px;
    background: white;
}
.actions_bar>a{
  height:50px;
  line-height: 50px;
  font-size: 18px;
}

@media all and (max-width: 768px) {
  .big_name{
    display: none;
  }
    
}

<style type="text/css">
  .piclink{
    -webkit-transition: all .5s ease; /* Safari and Chrome */
    -moz-transition: all .5s ease; /* Firefox */
    -ms-transition: all .5s ease; /* IE 9 */
    -o-transition: all .5s ease; /* Opera */
    transition: all .5s ease;
}

.piclink:hover {
  z-index: 40;
    -webkit-transform:scale(1.5); /* Safari and Chrome */
    -moz-transform:scale(1.5); /* Firefox */
    -ms-transform:scale(1.5); /* IE 9 */
    -o-transform:scale(1.5); /* Opera */
     transform:scale(1.5);
}
</style>
</style>
<script type="text/javascript">
function AlertIt() {
@if(!Auth::user()->paypal_email)
var answer = confirm ('Please input your paypal account email into your account information to continue');
if (answer) window.location="{{url('/account')}}";
@else
window.location="{{url('/transfer')}}";
@endif
}
</script>
<script type="text/javascript">
$('.piclink').hover(function() {
  $(this).find('figcaption').first().css('display', 'flex');
  if($(this).find('video').get(0))
  $(this).find('video').get(0).play();
}, function() {
  /* Stuff to do when the mouse leaves the element */
   $(this).find('figcaption').first().css('display', 'none');
   if($(this).find('video').get(0))
   $(this).find('video').get(0).pause();
});

$('.custom_image_scroll').each(function(index, el) {
    //$($(this)[0]).css('max-height', $(window).height()/2+'px');
    
});


@if($is_me)
$('#cover').on('click', function() {
  $('.upload_cover').trigger('click');
  $('.upload_cover').on('change', function(event) {
    $(this).closest('form').trigger('submit');
    $('.upload_cover').off('change');
  });
});
$('#propic').on('click', function() {
  $('.upload_propic').trigger('click');
  $('.upload_propic').on('change', function(event) {
    $(this).closest('form').trigger('submit');
    $('.upload_propic').off('change');
  });
});

@endif
</script>    
<!-- Large Tooltip -->
@if($is_me)
<div class="mdl-tooltip mdl-tooltip--large" for="propic" 
 style="will-change:inherit; margin-top: -100px;" >
Change Profile Picture
</div>
<div class="mdl-tooltip mdl-tooltip--top mdl-tooltip--large" for="cover" style="will-change:inherit; margin-top: 100px;" >
Change Cover Photo
</div>
@endif
@endsection