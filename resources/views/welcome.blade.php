@extends('layouts.app_nogrid')
@section('content')
<body>
<div class="fake_body">
&nbsp;
<div>

<div class="fancy-text">
Next Generation of Golf Instruction
</div>
<div class="big-logo"></div>
<div style="width: 100%; text-align: center; margin-top: 200px; margin-top: 10%;">
@if(Auth::check())
<a href="{{url('/home')}}" class="center-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Get Started
</a>
@else
<a href="{{url('/login')}}" class="center-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Get Started
</a>
@endif
</div>
</div>
<div class="arrow_down">
  
  <div style="font-size:50px; color:white;" class="material-icons">keyboard_arrow_down</div>
</div>
</div>

<div style="" class="home_div home_div_1">
<div class="sub_title">Why Swing Tips Golf?</div>
<div class="sub_content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!</div>
</div>
<div class="home_div home_div_2"></div> 
<div class="home_div home_div_3">
<div class="sub_title">How can Swing Tips Golf help?</div>
<div class="sub_content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!<br>
<ul class="mdl-list">
  <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae</li><br>
  <li>Lorem ipsum dolor</li>
  <ul>
    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae</li>
  </ul>
  <li>Lorem ipsum dolor sit amet</li>
  <ul>
    <li>Lorem ipsum dolor sit amet</li>
    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!</li>
    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet</li>
  </ul>
</ul>
</div>
</div>
<div class="home_div home_div_4"></div> 
<div class="home_div home_div_3">
<div class="sub_title">Who should use Swing Tips Golf?</div>
<div class="sub_content">
<ul class="mdl-list">
  <li>Golf Pros</li>
  <ul>
    <li>Lorem ipsum dolor sit amet, consectetur</li>
    <li>Feature 2...</li>
  </ul>
  <li>Golfers</li>
  <ul>
    <li>Why1</li>
    <li>why2</li>
    <li>why3</li>
    <li>why4</li>
  </ul>
  <li>Anyone!</li>
  <ul>
    <li>Why 1</li>
    <li>why 2</li>
    <li>why 3</li>
    <li>why 4.</li>
  </ul>
</ul>
</div>
</div>
<div class="home_div home_div_6"></div> 
<div class="home_div home_div_3">
<div class="sub_title">How does Swing Tips Golf work?</div>
<div class="sub_content">
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!<br><br>
Lorem ipsum dolor sit amet
<br><br>
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!
<br>
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!
<br>
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!</div>
</div>
<div class="last_home_div">
<div>Swing Tips Golf</div>
</div>
<div class="mdl-cell mdl-cell--12-col">
                <div style="width:100%; min-height: auto; background: #FAFAFA;" class="mdl-card mdl-shadow--2dp">
                    <div class="above_help_card">
                    <div class="help_card_section">
                    <div style="margin-left:10px; margin-top:10px; font-size: 19px; line-height: 21px; width: 100%; text-align: left;">
                    Already have an account?
                    </div>
                        <a style="text-decoration: none;" href="{{url('login')}}">
                        <div class="endlink" >Login</div>
                            </a>
                   </div>
                   <div class="help_card_section">
                    <div style="margin-left:10px; margin-top:10px; font-size: 19px; line-height: 21px; width: 100%;">Don't Have an Account?</div>
                        <a style="text-decoration: none;" href="{{url('register')}}">
                        <div class="endlink" >Create An Account</div>
                            </a>
                   </div>
                   <div class="help_card_section">
                    <div style="margin-right:20px; margin-top:10px; font-size: 19px; line-height: 21px; width: 100%; text-align: right;">Or are you a Golf Pro?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        <a style="text-decoration: none;" href="{{url('apply')}}">
                        <div class="endlink"  style="line-height: 75px;">Become a SwingTip Golf Pro</div>
                            </a>
                   </div>
                    </div>
                </div>
            </div>
<footer class="mdl-mini-footer" style="background:transparent;">
        <div  class="mdl-color-text--grey-900" style="text-align: center; width:100%; font-weight:300; font-size: 16px;" >Swing Tips Golf &copy; 2016</div> 
        </footer>
<style type="text/css">
.fake_body{
 background-image: url('/imgs/golf_sunset.png');
 height: 100vh;
  background-repeat: no-repeat;
  background-position: 50% 50%;
  background-size: cover;
  margin-top: -5px;
}
.center-button{
    width:14%;
    height: 50px;

    font-size: 18px;
     font-family: 'Lato';
     font-weight: 300;
    text-transform: none;
    background: #4CAF50;
        color: white;
        text-shadow: 1px 1px black;

    
}

.fancy-text{
    font-size:75px;
    width: 100%;
    text-align: center;
    margin-top: 200px;
    margin-top:10%;
    text-shadow: 1px 1px #BDBDBD, -1px -1px 1px black;
    line-height: 80px;


}
/*.mdl-layout-title{
    font-size:40px;
    font-family: 'Lato';
    font-weight: 300;
    color:white;
}*/
/*.mdl-navigation__link{
    font-size:20px;
    font-family: 'Lato';
    font-weight: 400;
    color:white !important;
}*/
.arrow_down{
width: 100%;
margin-top: 270px;
margin-top: 13%;
text-align: center;
color: white;
}
.arrow_down>div{
border-radius: 50%;
cursor:pointer;
}
.arrow_down>div:hover{
  background:rgba(76,175,80,.3);
}


/*addedd from old*/

.home_div{
  padding: 0px;
  width: 100%;
  min-height: 500px;
  background: white;
  display: flex;
}
.home_div>.sub_title{
width: 30%;
font-size: 50px;
line-height: 50px;
padding: 50px;
font-weight: 300;
}
.home_div>.sub_content{
  padding: 50px;
width: 30%;
font-size: 20px;
font-weight: 300;
line-height: 25px;
}
.home_div_2{
   background-image: url('/imgs/kid.jpg');
  background-repeat: no-repeat;
  background-position: 50% 70%;
  background-size: cover;
}
.home_div_4{
  background-image: url('/imgs/vesper_cover.jpg');
  background-repeat: no-repeat;
  background-position: 50% 70%;
  background-size: cover;
}
.home_div_6{
  background-image: url('/imgs/golf_sunset.png');
  background-repeat: no-repeat;
  background-position: 50% 70%;
  background-size: cover;
}
.last_home_div{
  background:#C5E1A5;
  text-align: center;
  padding-bottom: 25px;
  padding-top:25px;
}
.last_home_div>div{
  font-size: 70px;
  text-shadow: 1px 1px 1px white;
  font-weight: 200;
  line-height: 70px;
}
.bottom_button{
   margin-top: 50px;
    width:14%;
    height:50px;
    font-size: 18px;
     font-family: 'Lato';
     font-weight: 300;
    text-transform: none;
    background: #4FC3F7;
    color: black;
    text-shadow: 1px 1px white;
}
.mdl-list>li{
font-size: 20px;
}
.endlink{
            width: 100%;
            text-align: center;
            line-height: 150px;
            font-size: 50px;
            text-decoration: none;
            color: black;
            font-weight:200;
            text-shadow:0px 0px #B3E5FC;
        }
        .endlink:hover{
            background: #E1F5FE;

        }
        .above_help_card{
      display: flex;
      width: 100%;
         }
         .help_card_section{
          width:33%; text-align:center;
          }

@media all and (max-width: 768px) {
    .home_div {
        display: block;
        width: 100%;
    }
    .home_div>.sub_content{
      width: 60%;
    }
    .home_div>.sub_title{
      width: 60%;
    }
    .above_help_card{
      display: block;
    }
    .above_help_card>div{
      width: 100%;
    }
    .center-button{
      height: auto;
      line-height: 20px;
      padding: 5px 20px;
    }
    .mdl-navigation{
      display: none;
    }
}
</style>
<script type="text/javascript">
  $('.arrow_down').on('click', function(event) {
   $('.mdl-layout__content').animate({
          scrollTop: $('.home_div_1').position().top
        }, 1100);
    /* Act on the event */
  });
  // setInterval(function(){
  //   console.log('hey');
  // },500);
</script>

@endsection