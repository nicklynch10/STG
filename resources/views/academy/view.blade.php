
<?php
 $pro = $academy;
 $is_me = false;
 $is_pro = false;
if($academy->is_in(Auth::user()))$is_me = true;
  ?>
@extends('layouts.app_nogrid')
@section('content')
@include('dashboard.scripts')
<div class="mdl-grid">
<div style="background-size:cover;background-image: url('{{$pro->cover or $pro->propic}}'); width:calc(100% + 20px); height:400px;background-position: center; margin: -5px -7px;" class="cover">
</div>
  <div style="margin-top:-300px;" class="mdl-cell--4-col fix_grid" >
    <div class="mdl-cell--12-col mdl-grid">
      <figure style="margin: 0px;">
        <img class="mdl-shadow--4dp mdl-color--white-100 is-casting-shadow propic" style="width:500px" src="{{$pro->propic or $pro->cover}}">
      </figure>
    </div>
    @include('grid.top',["title"=>$pro->morphname(), "size"=>12])
    {{$pro->city}}, {{$pro->state}}<br>
    Golf {{ucfirst($pro->type)}}
    <hr>
    {{$pro->bio}}
    <br><br>
    <b>Years of Experience:</b> {{$pro->yoe}}<br>
    <b>Signed up for Swing Tips Golf:</b> {{$pro->created_at->diffForHumans()}}<br>
      @if(isset($pro->website))
      <a target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{$pro->website}}">{{$pro->morphname()}}'s Website</a><br>
      @endif
   
    @include('grid.bottom')
    @if($is_me)
    @include('grid.top',["title"=>"Actions", "size"=>12])
    <a href="/academy/edit/{{$pro->id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
  Edit {{$pro->morphname()}}
  </a><br><br>
    <form  enctype="multipart/form-data" role="form" method="POST" action="{{ url('/academy/upload/'.$pro->id) }}">
  {{ csrf_field() }}
  
  <input class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="file" name="pic" accept="image/*">
  <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
  Upload Profile Picture
  </button>
</form>
<hr>
<form  enctype="multipart/form-data" role="form" method="POST" action="{{ url('/academy/upload/'.$pro->id) }}">
  {{ csrf_field() }}
  <input class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="file" name="cover" accept="image/*">
  <button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
  Upload Cover Photo
  </button>
</form>
    @include('grid.bottom')
    @include('grid.top',['title'=>'Add a Member to '.$pro->morphname(), 'size'=>12])
    <form method="POST" action="/academy/member/new/{{$pro->id}}">
    {{ csrf_field() }}
    <select style="width: 95%;" name="member" class="add_pro">
      @foreach(App\User::all()->where('pro', '1') as $p)
      @if(!$academy->is_in($p))
      <option value="{{$p->id}}">{{$p->morphname()}}</option>
      @endif
      @endforeach
    </select><br><br>
    <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit">Add Member to {{$pro->morphname()}}</button>
    </form>
    @include('grid.bottom')
    @endif
  </div>{{--  end column 2 --}}
  <div style="height:100%; margin-top:-100px;" class="mdl-grid mdl-cell--8-col">
  <div style="font-size:40px; line-height:40px; text-shadow: black 2px 2px 3px; color: white; font-weight:800; margin:5px;">
    {{$pro->morphname()}}
    </div>
    <div style="background:white; text-shadow: black 1px 0px 0px;" class="mdl-cell mdl-cell--12-col mdl-shadow--2dp mdl-cell--top actions_bar">
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" style="background-color:rgba(158,158,158,.2)" data-div="members" >Golf Pros</a>
      @if($pro->website)
      <a class="div_change mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="website" >Website</a>
      @endif
      @if($pro->type == 'course' && (int)Auth::user()->course_id != (int)$pro->id)
        <a href="{{url('/academy/primary/'.$pro->id)}}" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-green-500">Make This Golf Course My Primary Course</a>
      @endif
    </div>
    <!-- Now we get to the profile stuff -->
    <div class="switch members mdl-grid">
    @foreach($pro->users as $u)
    @include('grid.top', ['size'=>4])
    <div style="display:flex; width:100%;">
              <img src="{{$u->propic}}" style="width:150px; height:100%; ">
              <div  style="margin-left:10px;">
              <a style="font-size:18px;" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect mdl-color-text--light-blue-500" href="{{url('locker/'.$u->id)}}">
              {{$u->morphname()}}</a><br>
              {{$u->city}}, {{$u->state}}<br>
              @if($u->course)
               <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/academy/{{$u->course->id}}">{{$u->course->morphname()}}</a>
               @endif
              </div>
            </div>

    @include('grid.bottom')
    @endforeach
    </div>{{--  end switch --}}
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
$('.switch').hide();
$('.members').show();

$('.div_change').on('click', function(event) {
event.preventDefault();
 self = $(this);
var div = self.data('div');
$('.div_change').css('background-color', 'white');
self.css('background-color', 'rgba(158,158,158,.2)');
$('.switch').css('display', 'none');
  $('.'+div).slideDown(300,function(){
     $('html, body').animate({
          scrollTop: self.position().top
        }, 300);
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

$('.add_pro').select2();
</script>
<style type="text/css">
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
</style>

@endsection