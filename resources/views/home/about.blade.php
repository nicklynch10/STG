@extends('layouts.app_nogrid')
@section('content')
<div style="width:100%; padding: 0px;" class="mdl-grid">
    <div class="title  mdl-shadow--2dp">
        <div class="under_title" style="">
            About Swing Tips Golf
        </div>
        <div style="width:90%;" class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col">
                <div style="width:100%;" class="mdl-card mdl-shadow--2dp">
                    <div style="background:#8BC34A;" class="mdl-card__title mdl-color-text--white">
                        <h2 class="mdl-card__title-text">What is Swing Tips Golf?</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!
                    </div>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col">
                <div style="width:100%;" class="mdl-card mdl-shadow--2dp">
                    <div style="background:#F44336;" class="mdl-card__title mdl-color-text--white">
                        <h2 class="mdl-card__title-text">Next Generation of Golf Instruction</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!
                    </div>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col img2 mdl-shadow--2dp">
                <div style="background:#039BE5;" class="mdl-card__title mdl-color-text--white">
                    <h2 class="mdl-card__title-text">
                    Find the Right Pro
                    </h2>
                </div>
                
            </div>
            <div class="mdl-cell mdl-cell--6-col">
                <div style="width:100%;" class="mdl-card mdl-shadow--2dp">
                    <div style="background:#4FC3F7;" class="mdl-card__title mdl-color-text--white">
                        <h2 class="mdl-card__title-text">What Can Swing Tips Golf Do For Me?</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!
                        <hr>
                        <ul style="font-size: 20px;">
                            <li>Idea 1</li>
                            <li>Idea 1</li>
                            <li>Idea 1</li>
                            <li>Idea 1</li>
                            <li>Idea 1</li>
                            <li>Idea 1</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col img3 mdl-shadow--2dp">
                <div style="background:#FF9800;" class="mdl-card__title mdl-color-text--white">
                    <h2 class="mdl-card__title-text">
                    Learn Valuable Techniques from Professionals
                    </h2>
                </div>
                </div>
                <div class="mdl-cell mdl-cell--6-col">
                <div style="width:100%;" class="mdl-card mdl-shadow--2dp">
                    <div style="background:#009688;" class="mdl-card__title mdl-color-text--white">
                        <h2 class="mdl-card__title-text">Why Swing Tips Golf Was Started</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!
                        <hr>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!

                    </div>
                </div>
            </div>

                <div class="mdl-cell mdl-cell--12-col">
                <div style="width:100%; min-height: auto; background: #FAFAFA;" class="mdl-card mdl-shadow--2dp">
                    <div style="display: flex; width: 100%;">
                    <div style="width:33%; text-align:center;">
                    <div style="margin-left:10px; margin-top:10px; font-size: 19px; line-height: 21px; width: 100%; text-align: left;">
                    Already have an account?
                    </div>
                        <a style="text-decoration: none;" href="{{url('login')}}">
                        <div class="endlink" >Login</div>
                            </a>
                   </div>
                   <div style="width:33%; text-align:center;">
                    <div style="margin-left:10px; margin-top:10px; font-size: 19px; line-height: 21px; width: 100%;">Don't Have an Account?</div>
                        <a style="text-decoration: none;" href="{{url('register')}}">
                        <div class="endlink" >Create An Account</div>
                            </a>
                   </div>
                   <div style="width:34%; text-align:center;">
                    <div style="margin-right:20px; margin-top:10px; font-size: 19px; line-height: 21px; width: 100%; text-align: right;">Or are you a Golf Pro?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        <a style="text-decoration: none;" href="{{url('apply')}}">
                        <div class="endlink"  style="line-height: 75px;">Become a Swing Tip Golf Pro</div>
                            </a>
                   </div>
                    </div>
                </div>
            </div>
            </div>
            
        </div>
        <style type="text/css">
        .under_title{
        font-size: 80px;
        width: 100%;
        font-weight: 200;
        text-shadow: 1px 1px 1px black;
        text-align: center;
        padding-bottom:50px;
        padding-top:20px;
        line-height: 80px;
        color: white;
        }
        .title{
        background-image: url('/imgs/kid.jpg');
        background-position: center;
        background-size: cover;
        width: 100%;
        height: 2000px;
        border-top: 1px black solid;
        }
        .img2{
        background-image: url('/imgs/seth_cover.jpg');
        background-position: center;
        background-size: cover;
        height: 500px;
        }
        .img3{
        background-image: url('/imgs/eric_cover.jpg');
        background-position: center;
        background-size: cover;
        height: 500px;
        }
        .subtitle{
        width: 100%;
        text-align: center;
        font-size:30px;
        font-weight: 200;
        text-shadow: 1px 1px 3px black, 1px 1px 1px black;
        color:white;
        line-height: 60px;
        background: rgba(3,169,244,1);
        border-bottom:1px black solid;
        }
        .mdl-card__supporting-text{
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
        </style>

        
    </div>
  @endsection