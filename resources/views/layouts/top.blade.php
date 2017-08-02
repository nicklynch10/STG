 <!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
 <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

      <div class="android-header mdl-layout__header mdl-layout__header--waterfall mdl-color--light-blue-300">
        <div class="mdl-layout__header-row">
          <span class="android-title mdl-layout-title">
            <a style="text-shadow:2px 1px 1px black; color:white; font-size: 35px; line-height: 28px;" class="mdl-navigation__link  custom_title" href="{{url('/welcome')}}">
            Swing Tips Golf
            <div style="font-size: 17px; text-align: center;">
            perfect the experience
            </div>
            </a>

          </span>
          <!-- Add spacer, to align navigation to the right in desktop -->
           <select class="js-example-basic-multiple js-states custom_select" id="id_label_multiple" multiple="multiple" style="display: none;">
@if(!Auth::check())
<option value="{{url('/register')}}" >Sign up for Swing Tips Golf</option>
<option value="{{url('/apply')}}" >Become a Swing Tips Golf Pro</option>
@else
@foreach(App\User::all() as $obj)
  <option value="{{url('/locker/'.$obj->id)}}" >{{$obj->morphname()}}</option>
@endforeach
@endif
</select>
         
          <div class="android-header-spacer mdl-layout-spacer"></div>
        
          <!-- Navigation -->
          <div class="android-navigation-container">
            <nav class="android-navigation mdl-navigation">
             <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/about') }}">About</a>
        <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/how') }}">How to Use</a>
        <span class="vr">|</span>
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
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/dashboard') }}">Find a Coach</a> <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/locker') }}">Locker</a>
           <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/cart') }}"> <span class="mdl-badge material-icons" data-badge="{{count(Auth::user()->carts->where('active','1')->where('paid','0'))}}">shopping_cart</span></a>
        <span class="vr">|</span>
        <button style="margin-right:10px;" id="demo-menu-lower-right"
        class="mdl-button mdl-js-button mdl-button--icon">
        <i style="color:black;" class="material-icons">more_vert</i>
        </button>
        @else
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/apply') }}">Create Pro Account</a> <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/register') }}">Create Student Account</a> <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/login') }}">Login</a> <span class="vr">|</span>
        @endif
            </nav>
          </div>
         
           <ul  class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
            for="demo-menu-lower-right">
          <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/watchlist') }}">Watchlist</a></li>
          <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/contact') }}">Contact Us</a></li>
           <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/account/menu') }}">My Account</a></li>
          <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/logout') }}">Logout</a></li>
        </ul>
        @if(Auth::check())
<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
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
    @foreach($temp_col->take(5) as $t)
     <li style="min-width:350px;"><a class="mdl-menu__item" style="text-decoration:none; color:black;@if(!$t->read_at)font-weight: bold;@endif" href="{{url($t->data['url'])}}">
    {{--  <img src="{{url($t->other->propic)}}" style="width:40px;"> --}}
      {{$t->data['message']}}
      <div style="float:right; margin-right:20px;">
      <i style="margin-top: 50%;" class="material-icons">arrow_forward</i>
      </div>
     </a></li>
    @endforeach
  <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/notifications') }}">View all Notifications</a></li>
</ul>
  @endif

        </div>
      </div>
      <div class="android-drawer mdl-layout__drawer">

        <header style="font-family: 'Lato' !important; font-weight: 300;" class="demo-drawer-header mdl-layout-title">
        <span class="mdl-layout-title" style="text-align: center;">
            <a style="text-shadow:2px 1px 1px black; color:white; font-size: 30px; line-height: 20px;" class="custom_title mdl-navigation__link " href="{{url('/welcome')}}">
            Swing Tips Golf
            <div style="font-size: 15px; text-align: center;">
            perfect the experience
            </div>
            </a>

          </span>
           
          <div style="font-size:17px;">
         @if(Auth::check())
            <span>{{Auth::user()->morphname()}}</span>
            @else
            <span>Not Logged In</span>
            @endif
            </div>
            </header>
        <nav class="mdl-navigation demo-navigation">
         @if(Auth::check())
          <a class="mdl-navigation__link" href="{{url('/locker')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">person</i>Locker</a>
          @if(Auth::check()&&!Auth::user()->pro)
          <a class="mdl-navigation__link" href="{{url('/dashboard')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Find a Coach</a>
          @endif
           <a class="mdl-navigation__link" href="{{url('/notifications')}}">
        @if(count(Auth::user()->unreadNotifications) > 0)
        <i class="mdl-badge mdl-color-text--blue-grey-400 material-icons" data-badge="{{count(Auth::user()->unreadNotifications)}}" role="presentation">notifications_active</i>
        @else
        <i class="mdl-badge mdl-color-text--blue-grey-400 material-icons" data-badge="{{count(Auth::user()->unreadNotifications)}}" role="presentation">notifications_none</i>
        @endif Notifications &amp; Upcoming Events</a>
          @if(Auth::user()->pro)
          <a class="mdl-navigation__link" href="{{url('/calendar')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">event_available</i>Calendar</a>
          @endif
          <a class="mdl-navigation__link" href="{{url('/cart')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation mdl-badge" data-badge="{{count(Auth::user()->carts->where('active','1')->where('paid','0'))}}">shopping_cart</i>Cart</a>
          @endif
          <a class="mdl-navigation__link" href="{{url('/how')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i>How to Use</a>
          <a class="mdl-navigation__link" href="{{url('/about')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>About</a>

          @if(Auth::check())
            <a class="mdl-navigation__link" href="{{url('/logout')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">undo</i>Logout</a>
          @else
           <a class="mdl-navigation__link" href="{{url('/login')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">redo</i>Login</a>
           <a class="mdl-navigation__link" href="{{url('/register')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">person</i>Create Student Account</a>
           <a class="mdl-navigation__link" href="{{url('/apply')}}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">golf_course</i>Create Pro Account</a>
          @endif
        </nav>
      </div>
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

  $('.select2-search__field').on('change', function(event) {
     console.log('change');
     /* Act on the event */
   });
</script>
<style type="text/css">
  .mdl-navigation__link{
    text-shadow: 1px 0px 2px white;
    font-size:18px;
  }
  .vr{
    font-weight:700;
    color: white;
    display: none;
    text-shadow: 1px 1px 1px black;
  }
  .select2-search__field{
    font-family: "Lato";
  }
</style>
      <div style="margin-top:-3px;" class="android-content mdl-layout__content">
       