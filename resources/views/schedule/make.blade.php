@extends('layouts.app')

@section('content')
@include('grid.separator',['size'=>1])
<form class="mdl-cell mdl-cell--10-col" method="POST" 
@if($is_lesson)
action="{{url('calendar/save/'.$event->id.'/')}}"
@else
action="{{url('event/save/'.$event->id.'/')}}"
@endif
>
 {{ csrf_field() }}
<input type="hidden" id='start_datetime' name="start" value="">
<input type="hidden" id='end_datetime' name="end" value="">
<input type="hidden" name="last_page" value="{{ URL::previous() }}">
<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
<thead>
    <tr style="width:100%;">
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">Event Details
       </th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
    </tr>
</thead>
  <tbody>
  <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Title of Event</td>
      <td class="mdl-data-table__cell--non-numeric"> 
      
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

        <input class="mdl-textfield__input"  value="{{$event->title}}" type="text" name="title" id="title" @if($event->is_lesson) readonly="readonly" @endif>
        <label class="mdl-textfield__label" for="title">Event Title...</label>
      </div>
      </td>
      <td class="mdl-data-table__cell--non-numeric"></td>
      <td class="mdl-data-table__cell--non-numeric"></td>
    </tr>
   <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Event Address</td>
      <td class="mdl-data-table__cell--non-numeric">
       <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input"  value="{{$event->address}}" type="text" name="address" id="address" @if($event->is_lesson) readonly="readonly" @endif>
        <label class="mdl-textfield__label" for="address">Event Address...</label>
      </div>
      </td>
       <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
       <td class="mdl-data-table__cell--non-numeric">
       <div style="width:100%;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <textarea style="width:100%; min-height:110px;" class="mdl-textfield__input" value="{{$event->notes}}" name="notes" type="text" id="notes" >{{$event->notes}}</textarea>
    <label class="mdl-textfield__label" for="notes">Notes...</label>
  </div>
      </td>
    </tr>
    <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Date of Lesson:</td>
      <td class="mdl-data-table__cell--non-numeric">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <?php 
        $date = '';
        $time = '';
        $diffInHours = 1;
        $end_time = '';
        if(isset($event->start)){
        $start = Carbon\Carbon::parse($event->start, 'America/Toronto');
        $date = $start->toDateString();
        $time = $start->toTimeString();
          if(isset($event->end)){
          $end = Carbon\Carbon::parse($event->end, 'America/Toronto');
          $diffInHours = $start->diffInHours($end);
          }else{
          $end = new Carbon\Carbon($start);
          $end->addHours(1);
          }
        $end_time = $end->toTimeString();
        }


        ?>
        <input class="mdl-textfield__input" value="{{$date}}" type="date" name="date" id="date" required @if($event->is_lesson && $event->pro) readonly="readonly" @endif>
        <label class="mdl-textfield__label" for="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of lesson...</label>
      </div>
      <td class="mdl-data-table__cell--non-numeric">Time of Lesson:</td>
      <td class="mdl-data-table__cell--non-numeric">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" step="1800" value="{{$time}}" type="time" name="start_time" id="start_time" required @if($event->is_lesson && $event->pro) readonly="readonly" @endif>
        <label class="mdl-textfield__label" for="start_time">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start of Event...</label>
      </div>
       to 
       <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" step="1800" value="{{$end_time}}" type="time" name="end_time" id="end_time" required @if($event->is_lesson && $event->pro) readonly="readonly" @endif>
        <label class="mdl-textfield__label" for="end_time">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End of Event...</label>
      </div>
    </tr>
      @if($event->is_lesson)
    <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Price of Lesson</td>
      <td class="mdl-data-table__cell--non-numeric" style="font-size:19px;"> 
      ${{$event->price}}
      <input type="hidden" name="price" value="{{$event->price}}">
      <input type="hidden" name="lesson_price" value="{{$event->price}}">
      <input type="hidden" name="is_lesson" value="1">
      <input type="hidden" name="pro" value="{{$pro->id}}">
      </td>
      <td class="mdl-data-table__cell--non-numeric"></td>
      <td class="mdl-data-table__cell--non-numeric"></td>
    </tr>
    @endif
    @if(!$event->repeating_event && !$event->is_lesson)
    <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Repeat Event</td>
      <td class="mdl-data-table__cell--non-numeric"> 
      <select id="interval" name="interval">
      <option value="0" selected="true">Do not repeat</option>
        <option value="daily">Daily</option>
        <option value="weekly" >Weekly</option>
        <option value="monthly">Monthly</option>
      </select>
      </td>
      <td class="mdl-data-table__cell--non-numeric">
      </td>
      <td class="mdl-data-table__cell--non-numeric">
      </td>
    </tr>
    <tr class="repeat_form" style="width:100%;">
     {{--  <td class="mdl-data-table__cell--non-numeric">Repeat Event</td>
      <td class="mdl-data-table__cell--non-numeric day_list_inputs" style="display:none;"> 
      <table>
      <tr><td>Sundays</td><td><input type="checkbox" name="sunday"></td></tr>
      <tr><td>Mondays</td><td><input type="checkbox" name="monday"></td></tr>
      <tr><td>Tuesdays</td><td><input type="checkbox" name="tuesday"></td></tr>
      <tr><td>Wednesdays</td><td><input type="checkbox" name="wednesday"></td></tr>
      <tr><td>Thursdays</td><td><input type="checkbox" name="thursday"></td></tr>
      <tr><td>Fridays</td><td><input type="checkbox" name="friday"></td></tr>
      <tr><td>Saturdays</td><td><input type="checkbox" name="saturday"></td></tr>
      </table>
      </td> --}}
      <td class="mdl-data-table__cell--non-numeric">
        Repeat Every
      </td>
      <td class="mdl-data-table__cell--non-numeric">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input"  value="1" type="number" min="1" name="offset" id="offset" required>
        <label class="mdl-textfield__label" for="offset">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Repeat Every...</label>
      </div>
       <span class="interval_unit" >Weeks</span>
      </td>
       <td class="mdl-data-table__cell--non-numeric">Repeat for </td>
      <td class="mdl-data-table__cell--non-numeric"> 
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input"  value="1" type="number" min="1" name="amount" id="amount" required>
        <label class="mdl-textfield__label" for="amount">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Repeat for...</label>
      </div>
       <span class="" >Events</span>
      </td>
    </tr>
    @endif
    <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric"> <button class="submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" type="submit">@if($event->is_lesson)Save Lesson @else Save Event @endif </button></td>
      <td class="mdl-data-table__cell--non-numeric">
       @if($event->id && !$event->is_lesson)
       <input type="hidden" name="interval" value="0">
      <button class="delete_event btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" type="submit">Delete This Event</button>
       @endif
       @if($event->is_lesson == 1 && $event->status == 'pending' && $event->user_id == $user->id&&$event->is_alternative==1)
      <a class="btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" href="/alternative/{{$event->id}}/confirm">Confirm This Lesson</a>
       @endif
      </td>
      <td class="mdl-data-table__cell--non-numeric">
         @if($event->repeating_event)
        <input type="hidden" name="interval" value="0">
        <button class="delete_repeats btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" type="submit">
        Delete All {{$event->repeating_event->amount}} Events</button>
        @endif
        @if($event->is_lesson == 1 && $event->status == 'pending' && $event->user_id == $user->id&&$event->is_alternative==1)
      <a class="btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" href="/alternative/{{$event->id}}/deny">Deny This Lesson</a>
       @endif
      </td>
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
  input[type="text"]:disabled {
    color: #0277BD !important;
  }
</style>
<script type="text/javascript">
  var allow_submit = false;
  var length = 1;
  var time = false;
  var date = false;
  var end_date = false;
  var now = new Date();
  var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  $('.repeat_form').css('display', 'none');
  $('#interval').on('change', function(e){
    var $this = $(this);
    console.log($this.val());
    switch($this.val()){
      case 'daily':
      $('.interval_unit').text('Days');
      $('.day_list_inputs').css('display', 'none');
      $('.repeat_form').css('display', 'table-row');
      break;
      case 'weekly':
      $('.interval_unit').text('Weeks');
      $('.day_list_inputs').css('display', 'table-cell');
      $('.repeat_form').css('display', 'table-row');
      break;
      case 'monthly':
      $('.interval_unit').text('Months');
      $('.day_list_inputs').css('display', 'none');
      $('.repeat_form').css('display', 'table-row');
      break;
      default:
      $('.repeat_form').css('display', 'none');
    }
  });
  @if($event->repeating_event)
  $('.delete_repeats').on('click', function(event) {
    event.preventDefault();
    var $this = $(this);
    var form = $this.closest('form');
    form.attr('action', '/repeating/delete/{{$event->repeating_event->id}}');
    /* Act on the event */
    form.trigger('submit')

  });
  @endif
  @if($event->id)
$('.delete_event').on('click', function(event) {
    event.preventDefault();
    var $this = $(this);
    var form = $this.closest('form');
    form.attr('action', '/event/delete/{{$event->id}}');
    /* Act on the event */
    form.trigger('submit')

  });

  @endif
  function hideAndChange(){

  }
</script>
@endsection
