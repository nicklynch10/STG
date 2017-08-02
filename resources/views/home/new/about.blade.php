
@extends('layouts.app_nogrid')
@include('home.new.style')
@section('content')
    <div class="demo-blog mdl-layout mdl-js-layout has-drawer is-upgraded">

      <main class="mdl-layout__content" style="padding-top: 0px;">
        <div class="demo-blog__posts mdl-grid">
          <div class="mdl-card coffee-pic mdl-cell mdl-cell--12-col">
            <div class="mdl-card__media mdl-color-text--grey-50" style="padding: 100px 0px;">
              <h3 class="bigtitle">About Swing Tips Golf
           {{--  <div style="font-size: 32px; text-shadow:2px 2px 1px black; text-align: center;">
            perfect the experience
            </div> --}}</h3>
            </div>
          </div>
          <div class="mdl-card on-the-road-again mdl-cell mdl-cell--12-col">
            <div class="mdl-card__media mdl-color-text--grey-50">
              <h3><a href="entry.html">The Company</a></h3>
            </div>
            <div class="mdl-color-text--grey-600 mdl-card__supporting-text">
<ul class="midul">
<li>Swing Tips Golf is a top choice among golfers and golf instructors</li>
<li>Our goal is to provide golf coaches with the software they need to expand their business, while supplying students with the best experience possible with a focus on online instruction.</li>
<li>Choose the next generation of golf instruction software</li>
<li>Participate in the best experience possible whether you are a student or teacher of the game using Swing Tips Golf’s platform. 
<ul class="midul">
<li>A graphic with Experience powered by:
<ul class="midul">
  <li>Swing Tips - Online Instruction</li>
<li>Real Time Scheduling & Secure Payment</li>
<li>Video Sharing & Storing Capabilities</li>
</ul>
</li>
</ul>
</li>
</ul>
            </div>
            <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">
              <div class="material-icons">golf_course</div>
              <div>
                <strong>Swing Tips Golf</strong>
              </div>
            </div>
          </div>
          <div class="mdl-card amazing mdl-cell mdl-cell--12-col">
            <div class="mdl-card__title mdl-color-text--grey-50">
              <h3 class="quote"><a href="entry.html">The Next Generation of Golf Instruction</a></h3>
            </div>
            <div class="mdl-card__supporting-text mdl-color-text--grey-600">
              <ul class="midul">
  <li> Swing Tip’s golf instruction platform allows you to participate in the best experience possible whether you are a student or a teacher of the game of golf.
  </li>
  <li> 
Swing Tips Golf focuses on giving you the tools you need to improve your game, or expand your business. 
</li>
</ul>
            </div>
          </div>
          <div class="mdl-card shopping mdl-cell mdl-cell--12-col" >
            <div class="mdl-card__media mdl-color-text--grey-50" style="background-image: url('{{Storage::disk('s3')->url('stock/stock6.jpg')}}');">
              <h3><a href="entry.html">Student</a></h3>
            </div>
            <div class="mdl-card__supporting-text mdl-color-text--grey-600">
              <ul class="midul">
  <li>Find a highly rated golf coach near you based on reviews and testimonials, whether you are a beginner or a scratch golfer. </li>
<li>Book lessons in real time</li>
<li>Send videos of your swing to be analyzed for a fraction of the price using Swing Tips or online instruction</li>
<li>Secure checkout using PayPal</li>
<li>Access videos from lessons and Swing Tips at any time, on any device, without bogging down your device.</li>
<li>Share your swing with other students, coaches, and through social media.</li>
</ul>
            </div>
          </div>
          <div class="mdl-card shopping mdl-cell mdl-cell--12-col"> 
            <div class="mdl-card__media mdl-color-text--grey-50" style="background-image: url('{{Storage::disk('s3')->url('stock/stock3.jpg')}}');">
              <h3>Golf Instructor</h3>
            </div>
            <div class="mdl-card__supporting-text mdl-color-text--grey-600">
              <ul class="midul">
<li >Market your brand.</li>
<li >Automate administration processes
<ul class="midul">
<li >Keep a real time calendar or schedule that students can access at any time and book lessons by request. </li>
<li >Use PayPal to utilize a secure checkout, as well as enforcing a 24 hour cancellation policy.
<li >Minimize the amount of “No Shows”</li>
</ul>
</li>


<li >Customize your lessons packages and programs</li>
<li>Utilize online instruction or Swing Tips to give lessons at any time, any place. </li>
<li>Share videos from lessons with your students and store them in the cloud. These video’s are accessible and viewable at any time on any device by you or the student. </li>
<li>Display or Market your current clients. </li>
<li>Display or Market your reviews and testimonials
<ul class="midul">
<li>Proof that you are a valued coach in the area</li>
</ul>
</li>
</ul>
</ul>
            </div>
          </div>
       <div class="mdl-card shopping mdl-cell mdl-cell--12-col">
            <div class="mdl-card__media mdl-color-text--grey-50" style="background-image: url('{{Storage::disk('s3')->url('stock/stock5.jpg')}}');">
              <h3><a href="entry.html">Request a Demo</a></h3>
            </div>
            <div class="mdl-card__supporting-text mdl-color-text--grey-600">
              @include('home.new.requestdemo')
            </div>
          </div>
        </div>
        <footer class="mdl-mini-footer" style="background:white;">
        <div  class="mdl-color-text--grey-900" style="text-align: center; width:100%; font-weight:300; font-size: 16px;" >Swing Tips Golf &copy; 2017</div> 
        </footer>
      </main>
      <div class="mdl-layout__obfuscator"></div>
    </div>
  </body>
  <script>
    Array.prototype.forEach.call(document.querySelectorAll('.mdl-card__media'), function(el) {
      var link = el.querySelector('a');
      if(!link) {
        return;
      }
      var target = link.getAttribute('href');
      if(!target) {
        return;
      }
      el.addEventListener('click', function() {
        location.href = target;
      });
    });
  </script>

  <style type="text/css">
  	/*.android-header{
  		display: none !important;
  	}*/
  </style>

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
     </style>    
@endsection