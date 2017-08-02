@extends('layouts.app')

@section('content')
@include('grid.separator',['size'=>1])
<form class="mdl-cell mdl-cell--10-col" method="POST" action="{{url('event/confirm/'.$event->id)}}">
 {{ csrf_field() }}
<input type="hidden" id='start_datetime' name="start" value="">
<input type="hidden" id='end_datetime' name="end" value="">
<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
<thead>
    <tr style="width:100%;">
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">{{$event->user->morphname()}} requested for a lesson with you
       </th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
    </tr>
</thead>
  <tbody>
   <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Lesson with {{$event->pro->morphname()}}</td>
      <td class="mdl-data-table__cell--non-numeric">Lesson Cost of ${{$event->price}}</td>
      <td class="mdl-data-table__cell--non-numeric"><b>Location: </b>{{$event->address}}</td>
      <td class="mdl-data-table__cell--non-numeric">Length of Lesson: {{$event->length}} Minutes</td>
    </tr>
   
     <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Time and Date of Lesson:</td>
      <td style="white-space:normal;" class="mdl-data-table__cell--non-numeric">{{ Carbon\Carbon::parse($event->start)->toDayDateTimeString()}}</td>
      <td style="white-space:normal;" class="mdl-data-table__cell--non-numeric"></td>
      <td style="white-space:normal;" class="mdl-data-table__cell--non-numeric"></td>
      </tr>
     <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Notes sent from {{$event->user->morphname()}}</td>
      <td class="mdl-data-table__cell--non-numeric">
      {{$event->notes or "No Notes Sent"}}
      </td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
    </tr>
    <tr>
    <td class="mdl-data-table__cell--non-numeric">Would you like to accept this lesson?</td>
    <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
    <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
    <td><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="respond_yes">
    <input type='radio' name="accept" class="mdl-radio__button day_input no_alternatives yes_to_lesson" value="1" id='respond_yes' selected><span class="mdl-radio__label">Yes</span></label>
    &nbsp;&nbsp;&nbsp;&nbsp; 
    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="respond_no"><input type='radio' name="accept" class="mdl-radio__button day_input no_alternatives" value="0" id='respond_no'><span class="mdl-radio__label">No</span></label>
     &nbsp;&nbsp;&nbsp;&nbsp; 
    </td>
     <tr style="width:100%;">
     <td class="mdl-data-table__cell--non-numeric">Notes to Send Back to {{$event->user->morphname()}}</td>
      <td class="mdl-data-table__cell--non-numeric">
     <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:150px;" class="mdl-textfield__input" name="narrative" type="text" id="narrative" ></textarea>
    <label class="mdl-textfield__label" for="narrative">Please provide a response when denying a lesson</label>
  </div>
      </td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
    </tr>
    <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric"> <button class="submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" type="submit">Send back to {{$event->user->firstname}}</button></td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
    </tr>
  </tbody>
</table>
</form>
<style type="text/css">
  .mdl-data-table__cell--non-numeric{
    white-space: normal;
    width: 25%;
  }
  .alternative_times{
    display: none;
  }
</style>
<script type="text/javascript">
  $('.yes_to_lesson').trigger('click');
</script>
@endsection
