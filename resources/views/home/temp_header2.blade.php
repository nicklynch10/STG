
<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Introducing Lollipop, a sweet new take on Android.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Android</title>

    <!-- Page styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.min.css">
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

      <div class="android-header mdl-layout__header mdl-layout__header--waterfall mdl-color--light-blue-300">
        <div class="mdl-layout__header-row">
          <span class="android-title mdl-layout-title">
            <a style="text-shadow:0px 0px 1px white; font-size: 40px;" class="mdl-navigation__link  custom_title" href="{{url('/welcome')}}">Swing Tips Golf</a>
          </span>
          <!-- Add spacer, to align navigation to the right in desktop -->
          <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/about') }}">About</a>
        <span class="vr">|</span>
        <a class="mdl-navigation__link mdl-color-text--primary custom_link" href="{{ url('/how') }}">How to Use</a>
        <span class="vr">|</span>
          <div class="android-header-spacer mdl-layout-spacer"></div>
        
          <!-- Navigation -->
          <div class="android-navigation-container">
            <nav class="android-navigation mdl-navigation">
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
          </div>
         
           <ul  class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
            for="demo-menu-lower-right">
          <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/watchlist') }}">Watchlist</a></li>
          <li ><a class="mdl-menu__item" style="text-decoration:none; color:black;" href="{{ url('/logout') }}">Logout</a></li>
        </ul>
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

        </div>
      </div>

      <div class="android-drawer mdl-layout__drawer">
        <span class="mdl-layout-title">
          Swing Tips Golf<br>
          
         @if(Auth::check())
            <span>{{Auth::user()->morphname()}}</span>
            @else
            <span>Not Logged In</span>
            @endif
        </span>
        <nav class="mdl-navigation demo-navigation">
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

      <div class="android-content mdl-layout__content">
       
          <div class="android-card-container mdl-grid">
           <div style="height: 2500px; background:blue;">ddd</div>

            
          </div>

      </div>
    </div>
    <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>

    <style type="text/css">
      
      /**
 * Copyright 2015 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

body {
  margin: 0;
}

/* Disable ugly boxes around images in IE10 */
a img{
  border: 0px;
}

::-moz-selection {
  background-color: #6ab344;
  color: #fff;
}

::selection {
  background-color: #6ab344;
  color: #fff;
}

.android-search-box .mdl-textfield__input {
  color: rgba(0, 0, 0, 0.87);
}

.android-header .mdl-menu__container {
  z-index: 50;
  margin: 0 !important;
}


.mdl-textfield--expandable {
  width: auto;
}

.android-fab {
  position: absolute;
  right: 20%;
  bottom: -26px;
  z-index: 3;
  background: #64ffda !important;
  color: black !important;
}

.android-mobile-title {
  display: none !important;
}


.android-logo-image {
  height: 28px;
  width: 140px;
}


.android-header {
  overflow: visible;
  background-color: white;
}

  .android-header .material-icons {
    color: #767777 !important;
  }

  .android-header .mdl-layout__drawer-button {
    background: transparent;
    color: #767777;
  }

  .android-header .mdl-navigation__link {
    color: #757575;
    font-weight: 700;
    font-size: 14px;
  }

  .android-navigation-container {
    /* Simple hack to make the overflow happen to the left instead... */
    direction: rtl;
    -webkit-order: 1;
        -ms-flex-order: 1;
            order: 1;
    width: 500px;
    transition: opacity 0.2s cubic-bezier(0.4, 0, 0.2, 1),
        width 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .android-navigation {
    /* ... and now make sure the content is actually LTR */
    direction: ltr;
    -webkit-justify-content: flex-end;
        -ms-flex-pack: end;
            justify-content: flex-end;
    width: 800px;
  }

  .android-search-box.is-focused + .android-navigation-container {
    opacity: 0;
    width: 100px;
  }


  .android-navigation .mdl-navigation__link {
    display: inline-block;
    height: 60px;
    line-height: 68px;
    background-color: transparent !important;
    border-bottom: 4px solid transparent;
  }

    .android-navigation .mdl-navigation__link:hover {
      border-bottom: 4px solid #8bc34a;
    }

  .android-search-box {
    -webkit-order: 2;
        -ms-flex-order: 2;
            order: 2;
    margin-left: 16px;
    margin-right: 16px;
  }

  .android-more-button {
    -webkit-order: 3;
        -ms-flex-order: 3;
            order: 3;
  }


.android-drawer {
  border-right: none;
}

  .android-drawer-separator {
    height: 1px;
    background-color: #dcdcdc;
    margin: 8px 0;
  }

  .android-drawer .mdl-navigation__link.mdl-navigation__link {
    font-size: 14px;
    color: #757575;
  }

  .android-drawer span.mdl-navigation__link.mdl-navigation__link {
    color: #8bc34a;
  }

  .android-drawer .mdl-layout-title {
    position: relative;
    background: #6ab344;
    height: 160px;
  }

    .android-drawer .android-logo-image {
      position: absolute;
      bottom: 16px;
    }

.android-be-together-section {
  position: relative;
  height: 800px;
  width: auto;
  background-color: #f3f3f3;
  background: url('images/slide01.jpg') center 30% no-repeat;
  background-size: cover;
}

.logo-font {
  font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif;
  line-height: 1;
  color: #767777;
  font-weight: 500;
}

.android-slogan {
  font-size: 60px;
  padding-top: 160px;
}

.android-sub-slogan {
  font-size: 21px;
  padding-top: 24px;
}

.android-create-character {
  font-size: 21px;
  padding-top: 400px;
}

  .android-create-character a {
    text-decoration: none;
    color: #767777;
    font-weight: 300;
  }

.android-screen-section {
  position: relative;
  padding-top: 60px;
  padding-bottom: 80px;
}

.android-screens {
  text-align: right;
  width: 100%;
  white-space: nowrap;
  overflow-x: auto;
}

.android-screen {
  text-align: center;
}

.android-screen .android-link {
  margin-top: 16px;
  display: block;
  z-index: 2;
}

.android-image-link {
  text-decoration: none;
}

.android-wear {
  display: inline-block;
  width: 160px;
  margin-right: 32px;
}

  .android-wear .android-screen-image {
    width: 40%;
    z-index: 1;
  }


.android-phone {
  display: inline-block;
  width: 64px;
  margin-right: 48px;
}

  .android-phone .android-screen-image {
    width: 100%;
    z-index: 1;
  }


.android-tablet {
  display: inline-block;
  width: 110px;
  margin-right: 64px;
}

  .android-tablet .android-screen-image {
    width: 100%;
    z-index: 1;
  }

  .android-tablet .android-link {
    display: block;
    z-index: 2;
  }


.android-tv {
  display: inline-block;
  width: 300px;
  margin-right: 80px;
}

  .android-tv .android-screen-image {
    width: 100%;
    z-index: 1;
  }


.android-auto {
  display: inline-block;
  width: 300px;
  overflow: hidden;
}

  .android-auto .android-screen-image {
    display: block;
    height: 300px;
    z-index: 1;
  }


.android-wear-section {
  position: relative;
  background: url('images/wear.png') center top no-repeat;
  background-size: cover;
  height: 800px;
}

.android-wear-band {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: center;
  background-color: #37474f;
}

.android-wear-band-text {
  max-width: 800px;
  margin-left: 25%;
  padding: 24px;
  text-align: left;
  color: white;
}

  .android-wear-band-text p {
    padding-top: 8px;
  }

.android-link {
  text-decoration: none;
  color: #8bc34a !important;
}

  .android-link:hover {
    color: #7cb342 !important;
  }

  .android-link .material-icons {
    position: relative;
    top: -1px;
    vertical-align: middle;
  }

.android-alt-link {
  text-decoration: none;
  color: #64ffda !important;
  font-size: 16px;
}

  .android-alt-link:hover {
    color: #00bfa5 !important;
  }

  .android-alt-link .material-icons {
    position: relative;
    top: 6px;
  }

.android-customized-section {
  text-align: center;
}

.android-customized-section-text {
  max-width: 500px;
  margin-left: auto;
  margin-right: auto;
  padding: 80px 16px 0 16px;
}

  .android-customized-section-text p {
    padding-top: 16px;
  }

.android-customized-section-image {
  background: url('images/devices.jpg') center top no-repeat;
  background-size: cover;
  height: 400px;
}

.android-more-section {
  padding: 80px 0;
  max-width: 1044px;
  margin-left: auto;
  margin-right: auto;
}

  .android-more-section .android-section-title {
    margin-left: 12px;
    padding-bottom: 24px;
  }

.android-card-container {
}

  .android-card-container .mdl-card__media {
    overflow: hidden;
    background: transparent;
  }

    .android-card-container .mdl-card__media img {
      width: 100%;
    }

  .android-card-container .mdl-card__title {
    background: transparent;
    height: auto;
  }

  .android-card-container .mdl-card__title-text {
    color: black;
    height: auto;
  }

  .android-card-container .mdl-card__supporting-text {
    height: auto;
    color: black;
    padding-bottom: 56px;
  }

  .android-card-container .mdl-card__actions {
    position: absolute;
    bottom: 0;
  }

  .android-card-container .mdl-card__actions a {
    border-top: none;
    font-size: 16px;
  }

.android-footer {
  background-color: #fafafa;
  position: relative;
}

  .android-footer a:hover {
    color: #8bc34a;
  }

  .android-footer .mdl-mega-footer--top-section::after {
    border-bottom: none;
  }

  .android-footer .mdl-mega-footer--middle-section::after {
    border-bottom: none;
  }

  .android-footer .mdl-mega-footer--bottom-section {
    position: relative;
  }

  .android-footer .mdl-mega-footer--bottom-section a {
    margin-right: 2em;
  }

  .android-footer .mdl-mega-footer--right-section a .material-icons {
    position: relative;
    top: 6px;
  }


.android-link-menu:hover {
  cursor: pointer;
}


/**** Mobile layout ****/
@media (max-width: 900px) {
  .android-navigation-container {
    display: none;
  }

  .android-title {
    display: none !important;
  }

  .android-mobile-title {
    display: block !important;
    position: absolute;
    left: calc(50% - 70px);
    top: 12px;
    transition: opacity 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }

  /* WebViews in iOS 9 break the "~" operator, and WebViews in OS X 10.10 break
     consecutive "+" operators in some cases. Therefore, we need to use both
     here to cover all the bases. */
  .android.android-search-box.is-focused ~ .android-mobile-title,
  .android-search-box.is-focused + .android-navigation-container + .android-mobile-title {
    opacity: 0;
  }

  .android-more-button {
    display: none;
  }

  .android-search-box.is-focused {
    width: calc(100% - 48px);
  }

  .android-search-box .mdl-textfield__expandable-holder {
    width: 100%;
  }

  .android-be-together-section {
    height: 350px;
  }

  .android-slogan {
    font-size: 26px;
    margin: 0 16px;
    padding-top: 24px;
  }

  .android-sub-slogan {
    font-size: 16px;
    margin: 0 16px;
    padding-top: 8px;
  }

  .android-create-character {
    padding-top: 200px;
    font-size: 16px;
  }

  .android-create-character img {
    height: 12px;
  }

  .android-fab {
    display: none;
  }

  .android-wear-band-text {
    margin-left: 0;
    padding: 16px;
  }

  .android-footer .mdl-mega-footer--bottom-section {
    display: none;
  }
}

    </style>
  </body>
</html>
