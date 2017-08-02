@extends('layouts.app')

@section('content')
@include('grid.separator',['size'=>1])
<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
<thead>
    <tr style="width:100%;">
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">{{$event->user->morphname()}}'s lesson with you
       </th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
    </tr>
</thead>
  <tbody>
   <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Lesson with {{$event->pro->firstname}} {{$event->pro->lastname}}</td>
      <td class="mdl-data-table__cell--non-numeric">Lesson Cost of ${{$event->price}}</td>
      <td class="mdl-data-table__cell--non-numeric"><b>Location: </b><br>{{$event->location or ''}} <br><b>Address: </b>{{$event->address}}</td>
      <td class="mdl-data-table__cell--non-numeric">Length of Lesson: {{$event->length}} hour</td>
    </tr>
   
     <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Time and Date of Lesson:</td>
      <td style="white-space:normal;" class="mdl-data-table__cell--non-numeric">{{ Carbon\Carbon::parse($event->start)->toDayDateTimeString()}}</td>
      <td style="white-space:normal;" class="mdl-data-table__cell--non-numeric"></td>
      <td style="white-space:normal;" class="mdl-data-table__cell--non-numeric"></td>
      </tr>
     <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Notes sent from {{$event->user->firstname}} {{$event->user->lastname}}</td>
      <td class="mdl-data-table__cell--non-numeric">
      {{$event->notes}}
      </td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
    </tr>
  </tbody>
</table>

<style type="text/css">
  .mdl-data-table__cell--non-numeric{
    white-space: normal;
    width: 25%;
  }
  .alternative_times{
    display: none;
  }
</style>
@endsection
