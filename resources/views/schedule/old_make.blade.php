@extends('layouts.app')

@section('content')
@include('grid.separator',['size'=>1])
<form class="mdl-cell mdl-cell--10-col" method="POST" action="{{url('event/send/'.$pro->id)}}">
 {{ csrf_field() }}
<input type="hidden" id='start_datetime' name="start" value="">
<input type="hidden" id='end_datetime' name="end" value="">
<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
<thead>
    <tr style="width:100%;">
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">Fill in the information below to set up a lesson
       </th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
    </tr>
</thead>
  <tbody>
   <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Lesson with {{$pro->firstname}} {{$pro->lastname}}</td>
      <td class="mdl-data-table__cell--non-numeric">Lesson Cost of ${{$pro->lesson_price}}</td>
      <td class="mdl-data-table__cell--non-numeric"><b>Location: </b><br>{{$pro->location or ''}} <br><b>Address: </b>{{$pro->address}}</td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
    </tr>
    <tr style="width:100%;">
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">
       {{$pro->firstname}}'s Availability</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
      <th style="width:25%" class="mdl-data-table__cell--non-numeric">&nbsp;</th>
    </tr>
    <tr style="width:100%;">
      @if($pro->monday)<td class="mdl-data-table__cell--non-numeric">Mondays from  {{$pro->proper_time($pro->monday_start)}} to {{$pro->proper_time($pro->monday_finish)}}</td>
      @else
      <td class="mdl-data-table__cell--non-numeric">Not Available on Mondays</td>
      @endif
      @if($pro->tuesday)<td class="mdl-data-table__cell--non-numeric">Tuesdays from {{$pro->proper_time($pro->tuesday_start)}} to {{$pro->proper_time($pro->tuesday_finish)}}</td>
      @else
      <td class="mdl-data-table__cell--non-numeric">Not Available on Tuesdays</td>
      @endif
      @if($pro->wednesday)<td class="mdl-data-table__cell--non-numeric">Wednesdays from {{$pro->proper_time($pro->wednesday_start)}} to {{$pro->proper_time($pro->wednesday_finish)}}</td>
      @else
      <td class="mdl-data-table__cell--non-numeric">Not Available on Wednesdays</td>
      @endif
     @if($pro->thursday)<td class="mdl-data-table__cell--non-numeric">Thursdays from {{$pro->proper_time($pro->thursday_start)}} to {{$pro->proper_time($pro->thursday_finish)}}</td>
      @else
      <td class="mdl-data-table__cell--non-numeric">Not Available on Thursdays</td>
      @endif
    </tr>
    <tr style="width:100%;">
      @if($pro->friday)<td class="mdl-data-table__cell--non-numeric">Fridays from  {{$pro->proper_time($pro->friday_start)}} to {{$pro->proper_time($pro->friday_finish)}}</td>
      @else
      <td class="mdl-data-table__cell--non-numeric">Not Available on Fridays</td>
      @endif
      @if($pro->saturday)<td class="mdl-data-table__cell--non-numeric">Saturdays from {{$pro->proper_time($pro->saturday_start)}} to {{$pro->proper_time($pro->saturday_finish)}}</td>
      @else
      <td class="mdl-data-table__cell--non-numeric">Not Available on Saturdays</td>
      @endif
      @if($pro->sunday)<td class="mdl-data-table__cell--non-numeric">Sundays from {{$pro->proper_time($pro->sunday_start)}} to {{$pro->proper_time($pro->sunday_finish)}}</td>
      @else
      <td class="mdl-data-table__cell--non-numeric">Not Available on Sundays</td>
      @endif
     <td></td>
    </tr>
    <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Length of Lesson
       </td>
      <td class="mdl-data-table__cell--non-numeric">
        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
      <input type="radio" id="option-1" class="mdl-radio__button" name="length" value="1" checked>
      <span class="mdl-radio__label">1 Hour</span>
    </label>
      </td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
    </tr>
    <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Date of Lesson:</td>
      <td class="mdl-data-table__cell--non-numeric">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" value="{{Carbon\Carbon::parse($event->start, 'America/Toronto')->toDateString()}}" type="date" name="date" id="date">
        <label class="mdl-textfield__label" for="date">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of lesson...</label>
      </div>
      <td class="mdl-data-table__cell--non-numeric">Time of Lesson:</td>
      <td class="mdl-data-table__cell--non-numeric">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" step="1800" value="{{Carbon\Carbon::parse($event->start, 'America/Toronto')->toTimeString()}}" type="time" name="start_time" id="time">
        <label class="mdl-textfield__label" for="time">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time of Lesson...</label>
      </div>
    </tr>
     <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric"><b>Time and Date of Lesson:</b></td>
      <td style="white-space:normal;" class="mdl-data-table__cell--non-numeric">
      <span class="time_replace">&nbsp;</span></td>
      <td style="white-space:normal;" class="mdl-data-table__cell--non-numeric"></td>
      <td style="white-space:normal;" class="mdl-data-table__cell--non-numeric">
        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
        <input type="checkbox" value="on" name="approve" id="checkbox-2" class="mdl-checkbox__input">
        <span class="mdl-checkbox__label">This information is correct</span>
      </label>
      </tr>
     <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric">Notes you would like to say to {{$pro->firstname}}(optional)</td>
      <td class="mdl-data-table__cell--non-numeric">
      <div style="width:100%;" class="mdl-textfield mdl-js-textfield">
    <textarea style="width:100%; min-height:110px;" class="mdl-textfield__input" name="notes" type="text" id="notes" ></textarea>
    <label class="mdl-textfield__label" for="notes">Notes here...</label>
  </div></td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
      <td class="mdl-data-table__cell--non-numeric">&nbsp;</td>
    </tr>
    <tr style="width:100%;">
      <td class="mdl-data-table__cell--non-numeric"> <button class="submit_button btn btn-primary mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50" type="submit">Request lesson with {{$pro->firstname}}</button></td>
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
</style>
<script type="text/javascript">
  var allow_submit = false;
  var length = 1;
  var time = false;
  var date = false;
  var end_date = false;
  var now = new Date();
  var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  var available = [{{$pro->sunday}},{{$pro->monday}},{{$pro->tuesday}},{{$pro->wednesday}},{{$pro->thursday}},{{$pro->friday}},{{$pro->saturday}}];
  var available_times = [
      [parseInt(('{{$pro->sunday_start}}').split(":")[0]),parseInt(('{{$pro->sunday_finish}}').split(':')[0])],
      [parseInt(('{{$pro->monday_start}}').split(":")[0]),parseInt(('{{$pro->monday_finish}}').split(':')[0])],
      [parseInt(('{{$pro->tuesay_start}}').split(":")[0]),parseInt(('{{$pro->tuesay_finish}}').split(':')[0])],
      [parseInt(('{{$pro->wednesday_start}}').split(":")[0]),parseInt(('{{$pro->wednesday_finish}}').split(':')[0])],
      [parseInt(('{{$pro->thursday_start}}').split(":")[0]),parseInt(('{{$pro->thursday_finish}}').split(':')[0])],
      [parseInt(('{{$pro->friday_start}}').split(":")[0]),parseInt(('{{$pro->friday_finish}}').split(':')[0])],
      [parseInt(('{{$pro->saturday_start}}').split(":")[0]),parseInt(('{{$pro->saturday_finish}}').split(':')[0])]
                   
  ]
  $('input').on('change', function(e){
    var type = $(this).attr('type');
    switch(type){
      case 'radio':
      length = parseInt($(this).val());
      refresh_summary();
      break;
      case 'checkbox':
      if($(this).prop('checked'))allow_submit = true;
      else allow_submit = false;
      break;
      case 'date':
      date = $(this).val();
      console.log(date);
      date = new Date(this.valueAsDate);
      date.setDate(date.getDate() + 1);
      console.log(date);
      refresh_summary();
      break;
      case 'time':
      time = $(this).val();
      refresh_summary();
      break;
    }
  });
  function refresh_summary(){
    if(date && time){
      date.setHours(time.split(':')[0]);
      date.setMinutes(time.split(':')[1]);
      var display = weekdays[date.getDay()]+" "+date.getMonth()+'/'+date.getDate()+'/'+date.getFullYear();
      var hours = date.getHours();
      var dayTime = 'am';
      var after = date.getHours() + length;
      var dayTimeAfter = 'am';
      if(hours > 12){
        hours = hours - 12;
        dayTime = 'pm';
      }
      if(after > 12){
        after = after - 12;
        dayTimeAfter = 'pm';
      }
      end_date = new Date(date);
      end_date.setHours(date.getHours()+length);
      
      $('#start_datetime').val(toMysqlFormat(date));
      $('#end_datetime').val(toMysqlFormat(end_date));
      display += '<br> from '+ hours+':'+date.getMinutes()+' '+ dayTime+ ' to ';
      display += after + ':'+ date.getMinutes()+' '+dayTimeAfter;

    $('.time_replace').html(display);
    console.log("date  " +date);
      console.log(end_date);
    }
  }

  $('form').on('submit', function(e){
    var day = available_times[date.getDay()];
    var day_start = day[0];
    var day_end = day[1];
     if (!date||date < now) {
        tooltip("Date of lesson must be in the future");
        e.preventDefault();
      } else if(!allow_submit){
      e.preventDefault();
      tooltip("You must confirm the information");
      } else if(!available[date.getDay()]){
      e.preventDefault();
      tooltip("{{$pro->firstname}} is not available this day.");
      } else if(day_start>date.getHours() || day_end < end_date.getHours()){//to be added will check if times correct see available_times
      e.preventDefault();
      tooltip("{{$pro->firstname}} is not available during this time.");
      }
   
  });
</script>
@endsection
