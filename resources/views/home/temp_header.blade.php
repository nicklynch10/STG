 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.min.css">
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <div class="demo-layout mdl-layout mdl-js-layout  mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600 ">
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
            <span>hello@example.com</span>
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
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i>Trash</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">report</i>Spam</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Forums</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i>Updates</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_offer</i>Promos</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Purchases</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Social</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
      </div>
     
    </div>
      <div>Temp body</div>
    <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <style type="text/css">
      
.demo-avatar {
  width: 48px;
  height: 48px;
  border-radius: 24px;
}
.demo-layout .demo-header .mdl-textfield {
  padding-top: 27px;
}
.demo-layout .mdl-layout__header .mdl-layout__drawer-button {
  color: rgba(0, 0, 0, 0.54);
}
.mdl-layout__drawer .avatar {
  margin-bottom: 16px;
}
.demo-drawer {
  border: none;
}
/* iOS Safari specific workaround */
.demo-drawer .mdl-menu__container {
  z-index: -1;
}
.demo-drawer .demo-navigation {
  z-index: -2;
}
/* END iOS Safari specific workaround */
.demo-drawer .mdl-menu .mdl-menu__item {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}
.demo-drawer-header {
  box-sizing: border-box;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-pack: end;
  -webkit-justify-content: flex-end;
      -ms-flex-pack: end;
          justify-content: flex-end;
  padding: 16px;
  height: 151px;
}
.demo-avatar-dropdown {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  position: relative;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -webkit-flex-direction: row;
      -ms-flex-direction: row;
          flex-direction: row;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  width: 100%;
}

.demo-navigation {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1;
}
.demo-layout .demo-navigation .mdl-navigation__link {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -webkit-flex-direction: row;
      -ms-flex-direction: row;
          flex-direction: row;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
  /*color: rgba(255, 255, 255, 0.56);*/
  color:white;
  font-weight: 500;
}
.demo-layout .demo-navigation .mdl-navigation__link:hover {
  background-color: #00BCD4;
  color: #37474F;
}
.demo-navigation .mdl-navigation__link .material-icons {
  font-size: 24px;
  /*color: rgba(255, 255, 255, 0.56);*/
  color:white;
  margin-right: 32px;
}

.demo-content {
  max-width: 1080px;
}

.demo-charts {
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}
.demo-chart:nth-child(1) {
  color: #ACEC00;
}
.demo-chart:nth-child(2) {
  color: #00BBD6;
}
.demo-chart:nth-child(3) {
  color: #BA65C9;
}
.demo-chart:nth-child(4) {
  color: #EF3C79;
}
.demo-graphs {
  padding: 16px 32px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-align: stretch;
  -webkit-align-items: stretch;
      -ms-flex-align: stretch;
          align-items: stretch;
}
/* TODO: Find a proper solution to have the graphs
 * not float around outside their container in IE10/11.
 * Using a browserhacks.com solution for now.
 */
_:-ms-input-placeholder, :root .demo-graphs {
  min-height: 664px;
}
_:-ms-input-placeholder, :root .demo-graph {
  max-height: 300px;
}
/* TODO end */
.demo-graph:nth-child(1) {
  color: #00b9d8;
}
.demo-graph:nth-child(2) {
  color: #d9006e;
}

.demo-cards {
  -webkit-box-align: start;
  -webkit-align-items: flex-start;
      -ms-flex-align: start;
          align-items: flex-start;
  -webkit-align-content: flex-start;
      -ms-flex-line-pack: start;
          align-content: flex-start;
}
.demo-cards .demo-separator {
  height: 32px;
}
.demo-cards .mdl-card__title.mdl-card__title {
  color: white;
  font-size: 24px;
  font-weight: 400;
}
.demo-cards ul {
  padding: 0;
}
.demo-cards h3 {
  font-size: 1em;
}
.demo-updates .mdl-card__title {
  min-height: 200px;
  background-image: url('images/dog.png');
  background-position: 90% 100%;
  background-repeat: no-repeat;
}
.demo-cards .mdl-card__actions a {
  color: #00BCD4;
  text-decoration: none;
}

.demo-options h3 {
  margin: 0;
}
.demo-options .mdl-checkbox__box-outline {
  border-color: rgba(255, 255, 255, 0.89);
}
.demo-options ul {
  margin: 0;
  list-style-type: none;
}
.demo-options li {
  margin: 4px 0;
}
.demo-options .material-icons {
  color: rgba(255, 255, 255, 0.89);
}
.demo-options .mdl-card__actions {
  height: 64px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  box-sizing: border-box;
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}

    </style>
    <div style="height: 1500px; background: red;">fjfj</div>
  </body>
   
</html>
