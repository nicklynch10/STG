<style type="text/css">
.fake_body{
  height: 100vh;
  background-repeat: no-repeat;
  background-position: 50% 50%;
  background-size: cover;
  margin-top: -5px;
  opacity: .1;
  display: none;
}
.center-button{
    width:150px;
    height: 50px;
    line-height: 50px;
    font-size: 18px;
     font-family: 'Lato';
     font-weight: 600;
    text-transform: none;
    background: #4CAF50;
    /*opacity: .9;*/
        color: white;
        text-shadow: 1px 1px black;

    
}

.fancy-text{
    color:black;
    font-size:105px;
    width: 100%;
    text-align: center;
    padding-top: 200px;
    padding-top: 10%;
    text-shadow: 1px 1px 2px white, -1px -1px 1px black;
    line-height: 100px;
}
.fancy-text2{
    color:white;
    font-size:55px;
    width: 100%;
    text-align: center;
    padding-top: 250px;
    text-shadow: 2px 2px 1px black,3px 3px 3px black, -1px -1px 1px white;
    line-height: 55px;
}
.arrow_down_div{
width: 100%;
position: absolute;
top: 90%;
text-align: center;
color: white;
}
.arrow_down_div>div{
border-radius: 50%;
cursor:pointer;

}
.arrow_down_div>div:hover{
  background:rgba(76,175,80,.3);
}


/*addedd from old*/

.home_div{
  padding: 0px;
  width: 100%;
  min-height: 400px;
  background: white;
  display: flex;
}
.sub_title{
width: 100%;
font-size: 50px;
line-height: 50px;
padding-top: 25px;
font-weight: 300;
text-align: center;
}
.home_div>.sub_content{
  padding: 50px;
/*width: 30%;*/
font-size: 20px;
font-weight: 300;
line-height: 25px;
}
.home_div>.sub_content>ul
,.sub_content,.home_div>.sub_content>ul>li>ul{
  font-size: 20px;
font-weight: 300;
line-height: 25px;
}

.home_div_2{
  background-image: url('{{Storage::disk('s3')->url('stock/stock1.jpg')}}');
  background-repeat: no-repeat;
  background-position: 50% 70%;
  background-size: cover;
}
.home_div_4{
  background-image: url('{{Storage::disk('s3')->url('stock/stock5.jpg')}}');
  background-repeat: no-repeat;
  background-position: 50% 70%;
  background-size: cover;
}
.home_div_6{
  background-image: url('{{Storage::disk('s3')->url('stock/stock7.jpg')}}');
  background-repeat: no-repeat;
  background-position: 50% 70%;
  background-size: cover;
}
.home_div_7{
  background-image: url('{{Storage::disk('s3')->url('stock/stock3.jpg')}}');
  background-repeat: no-repeat;
  background-position: 50% 70%;
  background-size: cover;
}
.last_home_div{
  background:#EEEEEE;
  text-align: center;
  padding-bottom: 25px;
  padding-top:25px;
}
.last_home_div>div{
  font-size: 60px;
  text-shadow: 1px 1px 1px white;
  font-weight: 300;
  line-height: 60px;
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
          .mdl-layout__content{
            background: white;
          }

@media all and (max-width: 768px) {
    .home_div {
        display: block;
        width: 100%;
    }
    .home_div>.sub_content{
      width: auto;
      padding-top:0px;
    }
    .home_div>.sub_title{
      width: auto;
      text-align: center;
      vertical-align: center;
    }
    .above_help_card{
      display: block;
    }
    .above_help_card>div{
      width: 100%;
    }
    .center-button{
      height: auto;
      line-height: auto;
      /*padding: 5px 20px;*/
    }
    .mobile_center{
      margin:auto !important;
      text-align: center !important;

    }



}
</style>
<script type="text/javascript">
  $('.arrow_down').on('click', function(event) {
   $('.mdl-layout__content').animate({
          scrollTop: $('.home_div_1').position().top +  $('.mdl-layout__content').scrollTop()
        }, 1100);
    /* Act on the event */
  });

  $('.demo_button').on('click', function(event) {
   $('.mdl-layout__content').animate({
          scrollTop: $('.last_home_div').position().top +  $('.mdl-layout__content').scrollTop()
        }, 1100);
    /* Act on the event */
  });
  // setInterval(function(){
  //   console.log('hey');
  // },500);
</script>
<style type="text/css">
.fake_body[index="0"]{
  background-image: url('{{Storage::disk('s3')->url('stock/stock6.jpg')}}');
  opacity: 1;
  display: block;
}
.fake_body[index="1"]{
  background-image: url('{{Storage::disk('s3')->url('stock/stock3.jpg')}}');
}
.fake_body[index="2"]{
  background-image: url("{{Storage::disk('s3')->url('stock/stock1.jpg')}}");
}
.fake_body[index="3"]{
  background-image: url("{{Storage::disk('s3')->url('stock/stock8.jpg')}}");
}
</style>
<script>


var imgcounter = 1;
var imgs = 3;
var allowSlideShow = true;
$('.fake_body').attr('current', 0);
$('.fake_body[index="0"]').attr('current', 1);


$('.arrow_right').on('click', forwardSlide);
$('.arrow_left').on('click', lastSlide);


  $(function() {
   setInterval(function(){
    if(allowSlideShow)nextSlide();
  },8000);
 });  
  function nextSlide(){
    $('.fake_body[current=1]').animate({
     opacity: .02
    }, 800,"linear",onComplete);
  }
   function onComplete(){
    $('.fake_body[index="'+imgcounter+'"]').animate({
     opacity: 1
    }, 1000);
    console.log(imgcounter);
    $('.fake_body').hide();
    $('.fake_body[index="'+imgcounter+'"]').show();
    $('.fake_body').attr('current', 0);
    $('.fake_body[index="'+imgcounter+'"]').attr('current', 1);
    imgcounter++;
    if(imgcounter>imgs)imgcounter = 0;
   }
   function forwardSlide(){
    allowSlideShow = false;
    console.log(imgcounter);
    $('.fake_body').hide();
    $('.fake_body[index="'+imgcounter+'"]').show();
    $('.fake_body[index="'+imgcounter+'"]').css('opacity', 1);
    $('.fake_body').attr('current', 0);
    $('.fake_body[index="'+imgcounter+'"]').attr('current', 1);
    imgcounter++;
    if(imgcounter>imgs)imgcounter = 0;
   }
   function lastSlide(){
    imgcounter--;
    if(imgcounter<0)imgcounter = 3;
    imgcounter--;
    if(imgcounter<0)imgcounter = 3;
    forwardSlide();
   }
</script>

<style type="text/css">
      .input{
        width: 80%;
        margin:auto;
        display: flex;
      }
      .mdl-textfield{
        width: 70%;
        margin-left: auto;
      }
      .input_label{
        font-size: 25px;
        margin: 20px;
        line-height: 25px;
        max-width:300px;
      }
      @media all and (max-width: 768px) {
     .input{
        width: 100%;
        display: block;
      }
      .input_label{
        margin: auto;
      }

      .image_icon{
        display: block;
        margin: auto !important;
      }
      .center_mobile{
        text-align: center;
        display: block;

      }
      .fancy-text2{
        padding-top: 50px;
      }
      .mobile_hide{
        display: none;
      }
}

.graphicdiv{
   background-size:contain;
    height: 300px;
     background-repeat: no-repeat;
      background-position: 50% 50%;
}
     </style>    