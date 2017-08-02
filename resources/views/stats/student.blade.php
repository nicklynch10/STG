
@extends('layouts.app')

@section('content')
<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--11-col">
<table class="mdl-data-table mdl-js-data-table" style="width: 100%;">
  <thead>
  <tr>
	<td style="font-weight: bold;">Total Expenditure</td>
	<td>${{($user->swingtips_recieved +$user->lessons_recieved +$user->camps_recieved)}}</td> 
	<td>&nbsp;</td>
  <td>&nbsp;</td>
	<td><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{url('student/track/')}}">Go To Students</a></td>
	</tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th>Swing Tips Spent</th>
      <th>Lessons Spent</th>
      <th>Camps Spent</th>
      <th>Fees Paid</th>
    </tr>
  </thead>
  <tbody>
	<tr>
	<td style="font-weight: bold;">{{$user->morphname()}}</td>
	<td>${{$user->swingtips_spent}}</td>
	<td>${{$user->lessons_spent}}</td>
	<td>${{$user->camps_spent}}</td>
  <td>${{$user->fees()}}</td>
	</tr>
  <tr>
      <th class="mdl-data-table__cell--non-numeric">Pro Name</th>
      <th>Purchase Title</th>
      <th>Purchase Date</th>
      <th>Price of Purchase</th>
    </tr>
  @if($user->carts_pro)
	@foreach ($user->carts->where('paid', 1) as $c)
    <tr>
	<td><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{url('pro/track/'.$c->pro->id)}}">{{$c->pro->morphname()}}</a></td>
	<td>{{$c->title}}</td>
	<td>{{$c->updated_at}}</td>
	<td>{{$c->price}}</td>
  <td>{{$c->price*$c->percentfee + $c->flatfee}}</td>
	</tr>
    @endforeach
@endif
  </tbody>
</table>

</div>
<style type="text/css">
  .paper{
    margin: auto;
    margin-top: 25px;
    background: white;
  }
</style>
@endsection