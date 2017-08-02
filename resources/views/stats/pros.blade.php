
@extends('layouts.app')

@section('content')
<div class="paper mdl-shadow--2dp mdl-cell mdl-cell--11-col">
<table class="mdl-data-table mdl-js-data-table" style="width: 100%;">
  <thead>
  <tr>
	<td style="font-weight: bold;">Total Revenue</td>
	<td>${{$total}}</td>
	<td>&nbsp;</td>
  <td>&nbsp;</td>
	<td><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{url('student/track/')}}">Go To Students</a></td>
	</tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Name</th>
      <th>Swing Tips Recieved</th>
      <th>Lessons Recieved</th>
      <th>Camps Recieved</th>
      <th>Fees Earned</th>
    </tr>
  </thead>
  <tbody>
	<tr>
	<td style="font-weight: bold;">All Pros</td>
	<td>${{$total_swingtips}}</td>
	<td>${{$total_lessons}}</td>
	<td>${{$total_camps}}</td>
  <td>${{$total_fees}}</td>
	</tr>
	@foreach ($pros as $pro)
    <tr>
	<td><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{url('pro/track/'.$pro->id)}}">{{$pro->morphname()}}</a></td>
	<td>${{$pro->swingtips_recieved}}</td>
	<td>${{$pro->lessons_recieved}}</td>
	<td>${{$pro->camps_recieved}}</td>
  <td>${{$pro->fees()}}</td>
	</tr>
    @endforeach


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