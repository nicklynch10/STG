
@extends('layouts.app_nogrid')

@section('content')
      <main class="mdl-layout__content" style="padding-top: 0px; width: 100%;">
        <div class="demo-blog__posts mdl-grid">
          <div class="mdl-card coffee-pic mdl-cell mdl-cell--12-col" style="min-height: 100px;">
            <div class="mdl-color-text--grey-50" style="padding: 0px 0px;">
              <h3 class="bigtitle">About Swing Tips Golf</h3>
            </div>
          </div>
    </div>
    </main>

   <div style="background:white; margin:auto; min-height: 60px; margin-bottom: 10px; line-height: 60px;" class="mdl-cell mdl-cell--10-col mdl-shadow--2dp mdl-cell--top">
    <a class="about_tab_button mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500 company_button" data-div="company">Company</a>
    <a class="about_tab_button mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="swingtip" style="line-height: 30px !important; width: 24% !important;min-width: 200px !important;">What is a Swing Tip or Online Instruction?</a>
    <a class="about_tab_button mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="students">Students</a>
    <a class="about_tab_button mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="pros" style="width: 24% !important;">Golf Instructors</a>
    </div>

    <div class="mdl-cell--10-col about_div company">
<div style="padding: 15px; font-size: 20px; line-height: 35px;">
    <div style="font-weight: 500; text-align: center; width: 100%;">
    Swing Tips Golf is a top choice among golfers and golf instructors.
    <br>
    We are located in Boston, MA and were founded in 2016. 
    </div>
    <hr>
Our Goal: <br>
<ul style="font-size: 20px; line-height: 35px;">
<li>Provide golf coaches with the software they need to expand their business, all while supplying students with the best experience possible.</li>
<li>Create a marketplace for students to find the best coaches in their area based on reviews and testimonials.</li>
<li>Choose the next generation of golf instruction software.</li>
<li>Participate in the best experience possible whether you are a student or teacher of the game using Swing Tips Golf’s platform.</li>
</ul>
</div>
    </div>


    <div class="mdl-cell--10-col about_div swingtip">
    <div style="padding: 35px;">
    <ul style="font-size: 25px; font-weight: 300; line-height: 30px;">
    <li>This is the process of a student sending in two videos of their swing, Down-the-Line (DL) and Face-On (FO), for a golf instructor to analyze.</li>
    <li>Using the swing analysis software of their choice, golf instructors can analyze the student’s swing and send back a video of them breaking down the swing with voice over capabilities and suggestions for improvement. </li>
    <li>Coaches are also encouraged to send videos of drills that the student can use to help with their suggestions for improvement. 
    </li>
    </ul>
    </div>
    <div>Image 1</div>
    <div>Image 2</div>
<br><br>
<div style="width: 100%; text-align: center;">
     <a href="{{url('/howto')}}" class="center-button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
  Learn More
</a>
</div>
<br>
    </div>

    <div class="mdl-grid mdl-cell--10-col about_div students">
    <div style="padding: 35px;">
    <ul style="font-size: 25px; font-weight: 300; line-height: 30px;">
    <li>Find a highly rated golf coach near you based on reviews and testimonials, whether you are a beginner or a scratch golfer. 
    </li>
<li>Book lessons in real time</li>
<li>Send videos of your swing to be analyzed for a fraction of the price using Swing Tips or online instruction</li>
<li style="font-weight: 500;">Secure checkout</li>
<li>Access videos from lessons and Swing Tips at any time, on any device, without bogging down your device.</li>
<li>Share your swing with other students, coaches, and through social media.</li>
</ul>
</div>

    </div>
    <div class="mdl-grid mdl-cell--10-col about_div pros">
    <div style="padding: 35px;">
    <ul style="font-size: 25px; font-weight: 300; line-height: 30px;">
<li>Market your brand.</li>
<li>Automate administration processes
<ul style="font-size: 25px; font-weight: 300; line-height: 30px;">
<li>Keep a real time calendar or schedule that students can access at any time and book lessons by request. </li>
<li>Use PayPal to utilize a secure checkout, as well as enforcing a 24 hour cancellation policy.
<ul style="font-size: 25px; font-weight: 300; line-height: 30px;"><li>Minimize the amount of “No Shows”</li></ul>
</li>
</ul>
</li>

<li>Customize your lessons packages and programs</li>
<li>Utilize online instruction or Swing Tips to give lessons at any time, any place. </li>
<li>Share videos from lessons with your students and store them in the cloud. These video’s are accessible and viewable at any time on any device by you or the student. </li>
<li>Display or Market your current clients. </li>
<li>Display publically your reviews and testimonials
<ul><li style="font-size: 25px; font-weight: 300; line-height: 30px;">Proof that you are a valued coach in the area</li></ul>
</li>

</ul>
</div>

    </div>


<style type="text/css">
      .input{
        width: 80%;
        margin:auto;
        min-height:100px;
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
      .midul{
        font-size: 20px;
        line-height: 30px;
      }
      @media all and (max-width: 768px) {
     .input{
        width: 100%;
        display: block;
        text-align: center;
      }
      .input_label{
        margin: auto;
      }
      .mdl-card__supporting-text{
        padding:10px 0px !important;
        width: 100% !important;
      }
      .midul{
        font-size: 18px;
        line-height: 27px;
      }
}

.about_div{
  margin-top:100px;
background: white;
margin: auto;
min-height: 100px;
padding: 0px;
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
body::before {
    background-size: cover;
    background-attachment: fixed;
    content: '';
    will-change: transform;
    z-index: -1;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    position: fixed;
}
body::before {
    background-image: url('{{Storage::disk('s3')->url('stock/stock7.jpg')}}');
  }

h3{
  font-family: 'Lato' !important;
}

.bigtitle{
  line-height: 80px;
   font-size: 70px;
   text-shadow: 3px 3px 1px black !important;
   text-align: center;
   width: 100%;
   font-weight: 300;
   font-family: 'Lato';
}

.slideshow{
  background: background-image: url('{{Storage::disk('s3')->url('stock/stock7.jpg')}}');
  height: 500px; 
  width:100%;
}


.demo-blog .coffee-pic .mdl-card__media, .coffee-pic{
  background-image: url('{{Storage::disk('s3')->url('stock/stock1.jpg')}}');
  background: rgba(0,0,0,.2) !important;
  background: radial-gradient(ellipse, rgba(0,0,0,.3), rgba(0,0,0,.4),rgba(0,0,0,.3),rgba(0,0,0,.01), rgba(0,0,0,0)) !important;
  width: 100%;

}


.about_tab_button{
  padding: 0px !important;
  margin: 0px !important;
min-width: 100px !important;
font-size: 25px !important;
 line-height: 60px !important;
  height: 60px !important;
   width: 25% !important;
}
</style> 


     <script type="text/javascript">
$('.about_div').css('display', 'none');
$('.company_button').css('background-color', 'rgba(158,158,158,.2)');
$('.company').show();
$('.about_tab_button').on('click', function(event) {
event.preventDefault();
 self = $(this);
var div = self.data('div');
$('.about_tab_button').css('background-color', 'white');
self.css('background-color', 'rgba(158,158,158,.2)');
$('.about_div').css('display', 'none');
  $('.'+div).slideDown(300,function(){
  });
});
     </script> 
@endsection