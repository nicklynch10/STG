<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body>
 <div class="demo-layout mdl-layout mdl-js-layout  mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--light-blue-300 mdl-color-text--grey-600 ">
        <div class="mdl-layout__header-row">
           <span style="" class="mdl-layout-title"> 
      <a style="text-shadow:0px 0px 1px white; font-size: 40px;" class="mdl-navigation__link  custom_title" href="{{url('/welcome')}}">Swing Tips Golf</a>
      </span>
      <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/about') }}">About</a>
        <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/how') }}">How to Use</a>
        <span class="vr">|</span>

          <div class="mdl-layout-spacer"></div>
          <nav style="height:auto;" class="mdl-navigation mdl-color-text--grey-50 custom_nav">

<select class="js-example-basic-multiple js-states custom_select" id="id_label_multiple" multiple="multiple">
@foreach(App\User::all() as $obj)
  <option value="{{url('/locker/'.$obj->id)}}" >{{$obj->morphname()}}</option>
@endforeach
</select>
        @if (Auth::check())
        <a id='notifications_hover' style="cursor:pointer;" class="mdl-navigation__link mdl-color-text--primary custom_link notifications">
        @if(count(Auth::user()->unreadNotifications) > 0)
        <span class="mdl-badge material-icons count_icon" data-badge="{{count(Auth::user()->unreadNotifications)}}">notifications_active</span>
        <span style="display:none" class="mdl-badge material-icons no_notifications">notifications_none</span>
        @else
        <span class="mdl-badge material-icons">notifications_none</span>
        @endif
        </a>
         <span class="vr">|</span>
         @if(Auth::user()->pro)
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/calendar') }}">Calendar</a>
        <span class="vr">|</span>
        @endif
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/dashboard') }}">Pro Dashboard</a> <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/locker') }}">Locker</a>
           <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/cart') }}"> <span class="mdl-badge material-icons" data-badge="{{count(Auth::user()->carts->where('active','1')->where('paid','0'))}}">shopping_cart</span></a>
        <span class="vr">|</span>
        <button style="margin-right:10px;" id="demo-menu-lower-right"
        class="mdl-button mdl-js-button mdl-button--icon">
        <i style="color:black;" class="material-icons">more_vert</i>
        </button>
        @else
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/apply') }}">Become a Swing Tips Golf Pro</a> <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/register') }}">Create Account</a> <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/login') }}">Login</a> <span class="vr">|</span>
        @endif
      </nav>
          <ul  class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
            for="demo-menu-lower-right">
          <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/watchlist') }}">Watchlist</a></li>
          <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/logout') }}">Logout</a></li>
        </ul>
        </div>
      </header>









      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          Swing Tips Golf
          <div class="demo-avatar-dropdown">
            @if(Auth::check())
            <span>{{Auth::user()->morphname()}}</span>
            @else
            <span>Not Logged In</span>
            @endif
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <li class="mdl-menu__item">hello@example.com</li>
              <li class="mdl-menu__item">info@example.com</li>
              <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
        @if(Auth::check())
          <a class="mdl-navigation__link" href="{{url('/locker')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">person</i>Locker</a>
          <a class="mdl-navigation__link" href="{{url('/dashboard')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Dashboard</a>
           <a class="mdl-navigation__link" href="{{url('/notifications')}}">
        @if(count(Auth::user()->unreadNotifications) > 0)
        <i class="mdl-badge mdl-color-text--blue-grey-400 material-icons" data-badge="{{count(Auth::user()->unreadNotifications)}}" role="presentation">notifications_active</i>
        @else
        <i class="mdl-badge mdl-color-text--blue-grey-400 material-icons" data-badge="{{count(Auth::user()->unreadNotifications)}}" role="presentation">notifications_none</i>
        @endif Notifications <br> Upcoming Events</a>
          @if(Auth::user()->pro || true)
          <a class="mdl-navigation__link" href="{{url('/calendar')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">event_available</i>Calendar</a>
          @endif
          <a class="mdl-navigation__link" href="{{url('/cart')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Cart</a>
          @endif
          <a class="mdl-navigation__link" href="{{url('/how')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i>How to Use</a>
          <a class="mdl-navigation__link" href="{{url('/about')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>About</a>

          @if(Auth::check())
            <a class="mdl-navigation__link" href="{{url('/logout')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">undo</i>Logout</a>
          @else
           <a class="mdl-navigation__link" href="{{url('/login')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">redo</i>Login</a>
          @endif
        </nav>
      </div>
     
    </div>
    <!-- Right aligned menu below button -->
   @if(Auth::check())
<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
    for="notifications_hover">
    <?php
    
    $temp_col = collect([]);
    foreach(Auth::user()->unreadNotifications->sortByDesc('updated_at') as $a){
      $temp_col->push($a);
    }
    foreach(Auth::user()->Notifications->sortByDesc('updated_at')->take(10) as $a){
      if($a->read_at)$temp_col->push($a);
    }
    ?>
    @foreach($temp_col->take(8) as $t)
     <li style="min-width:350px;"><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{url($t->data['url'])}}">
    {{--  <img src="{{url($t->other->propic)}}" style="width:40px;"> --}}
      {{$t->data['message']}}
      <div style="float:right; margin-right:20px;">
      <i style="margin-top: 50%;" class="material-icons">arrow_forward</i>
      </div>
     </a></li>
    @endforeach
  <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/notifications') }}">View All Notifications and Pending Requests</a></li>
</ul>
  @endif

<ul  class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
    for="demo-menu-lower-right">
  <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/watchlist') }}">Watchlist</a></li>
  <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/logout') }}">Logout</a></li>
</ul>
  <style type="text/css">

  /*below is my css above in head is other*/
 .mdl-navigation__link{
      font-weight: 400 !important;
     font-family: "Lato" !important;
     font-size: 16px;
      }
.custom_title{

  font-size: 22px;
  font-weight: 300 !important;
  font-family: "Great Vibes", "Lato" !important;
}
.custom_head{
  background: #1CD26E;
  overflow: hidden;
}
.vr{
  font-size: 2.8em;
  font-weight: 300 !important;
  font-family: "Lato" !important;
 
  cursor: default;
}
  body{
     font-family: 'Lato' !important;
     font-weight: 300;
     background: #F5F5F5;
  }
  .mdl-card__title-text, .mdl-button{
     font-family: 'Lato';
     text-transform: none;
  }
  .special_primary{
    color: #4CAF50 !important;
  }
  .special_accent{
    color: #03A9F4 !important;
  }
  .special_third{
    background: #4CAF50 !important;
    color:white !important;

  }
  .head_input{
    height: 27px;
    min-width: 300px;
    width: 50%;
    max-width: 500px;
    font-size: 20px;
    font-family: 'Lato';
    font-weight: 300;
    background: white;
    border-radius: 100px;
  }
  .custom_link{
    height: 48px;
  color:black !important;
  /*border-bottom: black 1px solid;*/
}
.custom_link:hover{
background: rgba(0,0,0,.1);
}
.vr{
  font-size: 2.8em;
  font-weight: 100 !important;
  font-family: "Lato" !important;
  cursor: default;
} 
.main-search{
  font-weight: 300;

}
.custom_icon{
  font-size: 15px;
}
.search_button{
  box-shadow: none;
  font-size: 20px;
}
.custom_select{
  height: 30px;
    min-width: 150px;
    width: 400px;
    max-width: 500px;
    font-size: 19px;
    line-height: 19px;
    font-family: 'Lato';
   
    /*font-weight: 300 !important;
    background: white;
    border-radius: 8px;
     -moz-appearance: window;
    -webkit-appearance: none;*/
}
.select2-selection, .select2-selection--multiple{
border-radius: 10px !important;
}
.mdl-menu__container{
position: fixed;
z-index: 125;
}

@media all and (max-width: 768px) {
    .above_header {
        display: none;
    }
}
    </style>
<script type="text/javascript">
  $('.notifications_hover').on('mouseenter', function(event) {
    console.log('in');
  });
   $('.notifications_hover').on('mouseleave', function(event) {
    console.log('out');
  });

   $('#notifications_hover').on('click', function(event) {
    $('.count_icon').hide();
    $('.no_notifications').show();
     $.post('/notification/read_all', {_token: "{{csrf_token()}}"}, function(data, textStatus, xhr) {
       console.log('read all');
     });
   });
</script>
<main style="margin-top:64px;" class="nickMain mdl-layout__content mdl-color--grey-100">