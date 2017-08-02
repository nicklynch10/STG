@extends('layouts.app')

@section('content')
<div class="mdl-cell mdl-cell--12-col mdl-color--white">
<div style="height:100px; background:#E0E0E0; text-align:center; display:block; font-size:40px; line-height:50px;" class="div_row">
     Thank You For Your Booking!
</div>
@include('events.view',['e'=>$e])
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
