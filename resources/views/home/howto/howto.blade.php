@extends('layouts.app')
@section('content')
<?php
$med = App\Vimeo::all()[10];
?>
{{-- <figure class="mdl-cell mdl-cell--12-col mdl-cell--top">
    <div id="big_vid" class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow big_image">
        Please Wait...
    </div>
</figure> --}}
<span style="font-size: 75px; height:500px; color: white; padding: 20px; text-align: center;">Coming Soon...</span>
<div class="mdl-cell mdl-cell--12-col mdl-cell--top">
    <div style="width: 100%;" class="mdl-card mdl-shadow--2dp mdl-color--white is-casting-shadow">
        <div class="mdl-card__title mdl-color-text--red-400 special_accent">
            <h2 class="mdl-card__title-text">How to Use Swing Tips Golf</h2>
        </div>
        <div class="mdl-card__supporting-text display-1 mdl-grid" style="width: 100%;">
        <div class="mdl-cell mdl-cell--6-col mdl-cell--top">
        <div class="subtitle">Students</div>
        <button index="1" class="header_button mdl-button mdl-js-button mdl-js-ripple-effect">How to Make Swing Tips or Online Lessons</button>
        <br>
        <button index="2" class="header_button mdl-button mdl-js-button mdl-js-ripple-effect">How to Book an In Person Lesson Online</button>
        <br>
        <button index="3" class="header_button mdl-button mdl-js-button mdl-js-ripple-effect">How to Enroll in a Camp</button>
        <br>
        </div>
         <div class="mdl-cell mdl-cell--6-col mdl-cell--top helpbox">
         <div class="subtitle">Coaches</div>
        <button index="4" class="header_button mdl-button mdl-js-button mdl-js-ripple-effect">How to Accept Swing Tips or Online Lessons</button>
        <br>
        <button index="5" class="header_button mdl-button mdl-js-button mdl-js-ripple-effect">How to Accept an In Person Lesson Online</button>
        <br>
        <button index="6" class="header_button mdl-button mdl-js-button mdl-js-ripple-effect">How to Create a Camp</button>
        <br>
        <button index="7" class="header_button mdl-button mdl-js-button mdl-js-ripple-effect">How to Create a Drill and Send it to Students</button>
        <br>
        <button index="8" class="header_button mdl-button mdl-js-button mdl-js-ripple-effect">How to Share a Drill or Lesson with a Student</button>
        <br>
        </div>
        </div>  
        </div>
    </div>


    {{-- HEADER ABOVE ALL THE INFO BELOW --}}
    
<div index="1" class="header_content mdl-cell mdl-cell--12-col">
<div class="header_title">How to Make Swing Tips or Online Lessons</div>
 @include('home.howto.how1')
</div>
<div index="2" class="header_content mdl-cell mdl-cell--12-col">
<div class="header_title">How to Book an In Person Lesson Online</div>
{{-- @include('home.howto.how2') --}}
</div>

<div index="3" class="header_content mdl-cell mdl-cell--12-col">
<div class="header_title">How to Enroll in a Camp</div>
{{-- @include('home.howto.how3') --}}
</div>

<div index="4" class="header_content mdl-cell mdl-cell--12-col">
<div class="header_title">How to Accept Swing Tips or Online Lessons</div>
{{-- @include('home.howto.how4') --}}
</div>

<div index="5" class="header_content mdl-cell mdl-cell--12-col">
<div class="header_title">How to Accept an In Person Lesson Online</div>
{{-- @include('home.howto.how5') --}}
</div>

<div index="6" class="header_content mdl-cell mdl-cell--12-col">
<div class="header_title">How to Create a Camp</div>
{{-- @include('home.howto.how6') --}}
</div>

<div index="7" class="header_content mdl-cell mdl-cell--12-col">
<div class="header_title">How to Book an In Person Lesson Online</div>
{{-- @include('home.howto.how7') --}}
</div>
<div index="8" class="header_content mdl-cell mdl-cell--12-col">
<div class="header_title">How to Create a Drill and Send it to Students</div>
{{-- @include('home.howto.how8') --}}
</div>

<script type="text/javascript">
$('.header_content').addClass('mdl-shadow--2dp');



    $('.header_button').on('click', function(event) {
        $('.header_content').hide();
        var $this = $(this);
        $('.header_selected').removeClass('header_selected');
        $this.addClass('header_selected');
        var index = $this.attr('index');
        var div = $('.header_content[index='+index+']');
        div.show();
         $('.mdl-layout__content').animate({
          scrollTop: div.offset().top + $('.mdl-layout__content').scrollTop() - $('.mdl-layout__content').offset().top
        }, 1100);
        /* Act on the event */
    });
</script>

<style type="text/css">
    .header_content{
        display: none;
        background: white;
        border-radius: 1px;
        min-height: 700px;
    }
    .header_title{
        padding: 10px;
        font-size: 28px;
        color: #03A9F4;
        line-height: 32px;
    }
    .header_selected{
        background: #03A9F4;
    }
</style>

















    <style type="text/css">
    .custom_text{
    padding: 0px;
    width: auto;
    }
    .custom_li{
    padding-bottom: 3px;
    padding-top: 3px;
    }
    .align-center{
    margin:auto;
    }
    .helper2{
    display: none;
    }
    .banner{
    min-height: 25px;
    }
    .hide{
    display: none;
    }
    body{
    background: #212121;
    }
    .fix_width{
    width:23%;
    }
    </style>
    <script type="text/javascript">
    var pct = 100;
    while($('.big_image').height()> 900){
    pct -= 1;
    $('.big_image').width(pct+'%');
    }
    
    </script>
    <script type="text/javascript">
    var options = {
    id: "{{$med->vim_id}}",
    title: false,
    byline:false,
    color: '4fc3f7',
    height: 500
    };
    var player = new Vimeo.Player('big_vid', options);
    </script>

<style type="text/css">
    .subtitle{
        font-size: 25px;
        text-shadow: 1px 1px 1px white;
        line-height: 30px;
    }
</style>

    @endsection