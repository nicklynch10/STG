@extends('layouts.app')

@section('content')

@include('grid.top',["title"=>"Swing Tip Response Sent", "size"=>12])
    <div style="font-size: 30px;">Thank you!</div><br><br>
    Your Swing Tip Response has been sent!<br>
    Your current account balance is now ${{Auth::user()->balance}}<br><br>
    We hope you enjoyed your experience at Swing Tips Golf.
@endsection