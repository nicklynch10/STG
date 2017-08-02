@extends('layouts.app')

@section('content')
<div class="mdl-cell mdl-cell--12-col mdl-shadow--2dp mdl-color--white">
<div style="height:100px; background:#E0E0E0; text-align:center; display:block; font-size:40px; line-height:50px;" class="div_row">
     Thank You For Your Purchase!
</div>
<?php 
  $price = 0;
  $fee = 0;
  $squaredfee = 0;
  $contains_swingtip = false;
 ?>
@foreach($p->carts as $cart)
<div class="div_row mdl-grid">
  <div class="mdl-cell--6-col pro_box" style="padding-top:10px; padding-bottom: 10px;">
  <a style="font-size:25px; min-height:125px;" class="mdl-button mdl-js-button mdl-js-ripple-effect" href="/locker/{{$cart->pro->id}}">
    <img style="height:90px;" src="{{url($cart->pro->propic)}}"><br>
      {{$cart->pro->full_name()}}</a>
  </div>
  <div class="mdl-cell--6-col">
  <div style="line-height: 22px; font-size: 20px;">{{$cart->title}}</div>
  <br>
  <span style="font-size:15px;">{{$cart->description}}</span>
  </div>
   <div class="above_price_div mdl-cell--6-col" style="min-width:64px; font-size:14px; padding-top:10px; padding-bottom: 10px;">
  <?php 
  $price += ($cart->price);
  $fee += $cart->price*$cart->percentfee + $cart->flatfee;
  $squaredfee = $cart->squaredfee;
  if($cart->type = 'swingtip')$contains_swingtip = true;
  ?>
  s
  <div class="price_div">${{($cart->price)}}</div>
  </div>
  <div  class="mdl-cell--6-col" style="font-size:13px; text-align:center; background:rgba(204,255,144,.7); padding-top:10px; padding-bottom: 10px;">
  @if($cart->hire)
    <a style="line-height:14px; height:30px;" class="mdl-button mdl-js-button mdl-js-ripple-effect" href="/response/done/{{$cart->hire->id}}">Swing Tip with {{$cart->pro->morphname()}}</a>
  @elseif($cart->playlist)
   <a style="line-height:14px; height:30px;" class="mdl-button mdl-js-button mdl-js-ripple-effect" href="/playlist/{{$cart->playlist->id}}">{{$cart->playlist->title}}</a>

  @else
     @foreach($cart->events as $e)
     <?php
     $start = Carbon\Carbon::parse($e->start);
     $end = Carbon\Carbon::parse($e->end);
     ?>
        <a style="line-height:14px; height:30px;" class="mdl-button mdl-js-button mdl-js-ripple-effect" href="/event/edit/{{$user->id}}/{{$e->id}}">{{$e->title}} <br>
        {{$start->format('l \o\n F jS Y')}} from {{$start->format('g:i A')}} to {{$end->format('g:i A')}}
        </a>
     @endforeach
   
     <br>
     Remaining Lessons (During Purchase): {{$cart->remaining}}<br>
     @endif
  </div>
</div>

@endforeach

<?php

$fee = $fee + (($price*$price*$squaredfee));

if($contains_swingtip && $fee < 5.00)$fee = 5.00;
$fee = round($fee,2);
$price = round($price,2) + $fee;
$price = round($price,2);
$fee = number_format($fee,2);
$price = number_format($price,2);



?>
<div class="mdl-grid" style="border-bottom: 1px #757575 solid;">
<div class="mdl-cell--6-col total_price" ><span style="font-size: 25px; margin-left:15px;">${{$fee}}</span></div>

<div class="mdl-cell--6-col" style="font-size: 25px; text-align: center;">Service Fee</div>
</div>

<div style="height:100px; background:white; display:flex; font-size:25px; line-height:50px; text-align:center;" class="mdl-grid">
<div class="mdl-cell--6-col total_price" ><span style="font-size: 25px; margin-left:15px;">${{$price}}</span></div>
@if($price > 0)

@endif
</div>
</div>
<style type="text/css">
  .div_row{
    border-bottom: 1px #757575 solid;
    text-align: center;
  }
  .div_row>div{
    font-size:25px;

    /*padding: 15px;*/
    /*text-align: center;*/
    
  }
  .total_price{
    text-align: left;
  }
  .above_price_div{
    position: relative;
  }
  .price_div{
    margin-left:15px;
    font-size: 25px;
    text-align: left;
  }
  @media all and (max-width: 768px) {
   .total_price{
    text-align: center !important;
  }
}
</style>
@endsection
