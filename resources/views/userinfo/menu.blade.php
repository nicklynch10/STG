@extends('layouts.app')

@section('content')

@include('grid.top',["title"=>"My Account", "size"=>12])
     @if(!Auth::user()->pro)
      <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" href="{{url('/shortgame')}}">Edit Shortgame Information</a>

     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--green-500" href="{{url('/specific')}}">Edit Specific Swing Information</a>


      <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-green-500" href="{{url('/general')}}">Edit General Swing Information</a>

  
     @endif
     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-800" href="{{url('/account')}}">Edit Account Information</a>
 
     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-800" href="{{url('/address/')}}">Edit Address Information</a>

     <a class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-800" href="{{url('/password/')}}">Change Account Password</a>

     @include('grid.bottom')
@endsection