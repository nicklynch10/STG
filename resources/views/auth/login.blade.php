@extends('layouts.app')

@section('content')
       <div style="width: 100%; margin-top: 150px; margin-top:10%;" class="mdl-grid">        
    <div class="mdl-cell mdl-cell--3-col mdl-cell--top"></div>                <div class="mdl-cell mdl-cell--6-col mdl-cell--top  ">

    <div style="width: 100%;" class="mdl-card mdl-shadow--4dp mdl-color--white is-casting-shadow">
    
  <div class="mdl-card__title mdl-color--light-green-400 special_accent">

    <h2 style="color:black;" class="mdl-card__title-text">Login to Swing Tips Golf </h2>
  </div>
  <div class="mdl-card__supporting-text display-1">
                 
                    <form class="form-horizontal" role="form" method="POST" action="{{url('/login')}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input type="email" name="email" value="" class="custom_name mdl-textfield__input" type="text" id="custom_name">
                                <label class="mdl-textfield__label" for="custom_name">Email</label>
                              </div>

                                                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="custom_name mdl-textfield__input" name="password" type="password" id="custom_name2">
                        <label class="mdl-textfield__label" for="custom_name2">Password</label>
                      </div>


                                                            </div>
                        </div>


                        </div>
  <div class="mdl-card__actions mdl-card--border" style="text-align: center;">
    <button style="font-size:30px; line-height: 30px;" type="Submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Login
    </button>
    <hr>
    <a href="{{url('/register')}}" style="font-size:20px;" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Create Student Account
    </a>
    <hr>
     <a href="{{url('/apply')}}" style="font-size:20px;" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Create Pro Account
    </a>
  </div>
</div>
</div>
                        <div class="mdl-cell mdl-cell--3-col mdl-cell--top"></div>                    </form>

               
  <style type="text/css">
    
    body{
      background-image: url(/imgs/bluesky.jpg);
      background-size: cover;
    }
  </style>
  </div>      
@endsection


   
        
