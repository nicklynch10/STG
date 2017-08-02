@extends('layouts.app')

@section('content')
<?php
$questions = collect([]);
$questions->push("Do you have a pre-shot routine? If so, explain it in detail.");
$questions->push("What are your current swing thoughts or what are you working on now?");
$questions->push("What is your least favorite club and why?");
$questions->push("What is your most favorite club and why?");
$questions->push("From what distance do you hit a 7-Iron?");
$questions->push("Where do most of your bad drives go?");
$questions->push("Do you tend to hit the ball high or do you hit it low?");
$questions->push("When you are hitting it poorly where does the ball tend to go?");
$questions->push("Where do you feel the ball hitting the face, center, toe or heel?");
$questions->push("What is your preferred ball flight, other than straight?");
$questions->push("Do you take divots and if so describe them?");
$questions->push("What do you think you’re doing incorrectly and why?");

?>
<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--10-col">
  <div style="margin:  20px 50px; ">
    <div class="mdl-color-text--light-blue-300" style="font-size: 35px; text-align: center; line-height: 60px;"> {{$user->morphname()}}'s Info </div>
    <div style="width: 50%;">
      The purpose of this information is for pros to learn about how you play. This allows them to know how best to help. Please fill all questions out the best you can for the best results.
    </div>
    
    <hr>
    <?php foreach ($questions as $key=>$q) {  
      $fieldname = 'field'.$key;
      ?>
      <div style="display: block;">
        <div style="width: 100%; font-size: 18px; font-weight: 400;">{{$q}}</div>
        <div style="width: calc(100% - 50px); margin-left:50px;">
    <div style="width:100%; min-height:60px;">{{$user->$fieldname}}</div>
  </div>
      </div>
    <?php } ?>
  </div>
</div>
<style type="text/css">
  .paper{
    margin: auto;
    background: white;
  }
</style>
@endsection
