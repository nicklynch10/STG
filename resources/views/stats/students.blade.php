
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
	<td><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{url('pro/track/')}}">Go To Pros</a></td>
	</tr>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Name</th>
      <th>Swing Tips Spent</th>
      <th>Lessons Spent</th>
      <th>Camps Spent</th>
      <th>Fees Spent(Earned)</th>
    </tr>
  </thead>
  <tbody>
	<tr>
	<td style="font-weight: bold;">All Students</td>
	<td>${{$total_swingtips}}</td>
	<td>${{$total_lessons}}</td>
	<td>${{$total_camps}}</td>
  <td>${{$total_fees}}</td>
	</tr>
	@foreach ($students as $student)
    <tr>
	<td>
  <a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="{{url('student/track/'.$student->id)}}">{{$student->morphname()}}</a></td>
	<td>${{$student->swingtips_spent}}</td>
	<td>${{$student->lessons_spent}}</td>
	<td>${{$student->camps_spent}}</td>
  <td>${{$student->fees()}}</td>
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