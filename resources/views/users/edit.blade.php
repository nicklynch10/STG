@extends('layouts.app')

@section('content')

                        @include('grid.separator', ['size'=>3])
                         <form class="mdl-cell mdl-cell--6-col large_form" role="form" method="POST" action="{{url('/locker/save')}}">
                        {{ csrf_field() }}
            <table style="width:100%" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
            <tr><td>Edit Your Information</td><td></td></tr>
            </thead>
            <tbody>
            <tr>
            <td class="mdl-data-table__cell--non-numeric">First Name</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input type='text' value="{{$user->firstname}}" name="firstname" class="mdl-textfield__input" id='firstname'><label class="mdl-textfield__label" for="firstname">first name...</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Last Name</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input type='text' value="{{$user->lastname}}" name="lastname" class="mdl-textfield__input" id='lastname'><label class="mdl-textfield__label" for="lastname">last name...</label></div></td></tr>
            <tr>
            <td class="mdl-data-table__cell--non-numeric">About Yourself</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><textarea style="height:120px;" name="bio" class="mdl-textfield__input" id='bio'>{{$user->bio}}</textarea><label class="mdl-textfield__label" for="bio">about yourself...</label></div></td></tr>
            <tr>
            <td class="mdl-data-table__cell--non-numeric">Rate For Swing Tip Online</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input type='text' value="{{$user->rate}}" name="rate" class="mdl-textfield__input" id='rate'><label class="mdl-textfield__label" for="rate">Rate here...</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Years of Experience</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input type='number' value="{{$user->yoe}}" name="yoe" class="mdl-textfield__input" id='yoe'><label class="mdl-textfield__label" for="yoe">Years of Experience...</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Address</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input type='text' value="{{$user->address}}" name="address" class="mdl-textfield__input" id='address'><label class="mdl-textfield__label" for="address">address...</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Location of Lessons</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input type='text' value="{{$user->location}}" name="location" class="mdl-textfield__input" id='location'><label class="mdl-textfield__label" for="location">location...</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">In Person Lesson Price</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input type='number' value="{{$user->lesson_price}}" name="lesson_price" class="mdl-textfield__input" id='lesson_price'><label class="mdl-textfield__label" for="lesson_price">Lesson Price</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Book Personal Lessons on Swing Tips</td><td><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="personal_lessons_on"><input type='radio' name="personal_lessons" class="mdl-radio__button day_input" value="1" id='personal_lessons_on'><span class="mdl-radio__label">Yes</span></label>&nbsp;&nbsp;&nbsp;&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="personal_lessons_off"><input type='radio' name="personal_lessons" class="mdl-radio__button" value="0" id='personal_lessons_off'><span class="mdl-radio__label">No</span></label></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Available on Monday</td><td><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="monday_on"><input type='radio' name="monday" class="mdl-radio__button day_input" value="1" id='monday_on'><span class="mdl-radio__label">Yes</span></label>&nbsp;&nbsp;&nbsp;&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="monday_off"><input type='radio' name="monday" class="mdl-radio__button day_input" value="0" id='monday_off'><span class="mdl-radio__label">No</span></label></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Monday Start Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->monday_start}}" name="monday_start" class="mdl-textfield__input" id='monday_start'><label class="mdl-textfield__label" for="monday_start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monday Start Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Monday Finish Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->monday_finish}}" name="monday_finish" class="mdl-textfield__input" id='monday_finish'><label class="mdl-textfield__label" for="monday_finish">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monday Finish Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Available on Tuesday</td><td><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="tuesday_on"><input type='radio' name="tuesday" class="mdl-radio__button day_input" value="1" id='tuesday_on'><span class="mdl-radio__label">Yes</span></label>&nbsp;&nbsp;&nbsp;&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="tuesday_off"><input type='radio' name="tuesday" class="mdl-radio__button day_input" value="0" id='tuesday_off'><span class="mdl-radio__label">No</span></label></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Tuesday Start Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->tuesday_start}}" name="tuesday_start" class="mdl-textfield__input" id='tuesday_start'><label class="mdl-textfield__label" for="tuesday_start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tuesday Start Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Tuesday Finish Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->tuesday_finish}}" name="tuesday_finish" class="mdl-textfield__input" id='tuesday_finish'><label class="mdl-textfield__label" for="tuesday_finish">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tuesday Finish Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Available on Wednesday</td><td><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="wednesday_on"><input type='radio' name="wednesday" class="mdl-radio__button day_input" value="1" id='wednesday_on'><span class="mdl-radio__label">Yes</span></label>&nbsp;&nbsp;&nbsp;&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="wednesday_off"><input type='radio' name="wednesday" class="mdl-radio__button day_input" value="0" id='wednesday_off'><span class="mdl-radio__label">No</span></label></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Wednesday Start Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->wednesday_start}}" name="wednesday_start" class="mdl-textfield__input" id='wednesday_start'><label class="mdl-textfield__label" for="wednesday_start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wednesday Start Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Wednesday Finish Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->wednesday_finish}}" name="wednesday_finish" class="mdl-textfield__input" id='wednesday_finish'><label class="mdl-textfield__label" for="wednesday_finish">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wednesday Finish Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Available on Thursday</td><td><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="thursday_on"><input type='radio' name="thursday" class="mdl-radio__button day_input" value="1" id='thursday_on'><span class="mdl-radio__label">Yes</span></label>&nbsp;&nbsp;&nbsp;&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="thursday_off"><input type='radio' name="thursday" class="mdl-radio__button day_input" value="0" id='thursday_off'><span class="mdl-radio__label">No</span></label></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Thursday Start Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->thursday_start}}" name="thursday_start" class="mdl-textfield__input" id='thursday_start'><label class="mdl-textfield__label" for="thursday_start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thursday Start Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Thursday Finish Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->thursday_finish}}" name="thursday_finish" class="mdl-textfield__input" id='thursday_finish'><label class="mdl-textfield__label" for="thursday_finish">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thursday Finish Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Available on Friday</td><td><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="friday_on"><input step="1800" type='radio' name="friday" class="mdl-radio__button day_input" value="1" id='friday_on'><span class="mdl-radio__label">Yes</span></label>&nbsp;&nbsp;&nbsp;&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="friday_off"><input step="1800" type='radio' name="friday" class="mdl-radio__button day_input" value="0" id='friday_off'><span class="mdl-radio__label">No</span></label></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Friday Start Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->friday_start}}" name="friday_start" class="mdl-textfield__input" id='friday_start'><label class="mdl-textfield__label" for="friday_start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Friday Start Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Friday Finish Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->friday_finish}}" name="friday_finish" class="mdl-textfield__input" id='friday_finish'><label class="mdl-textfield__label" for="friday_finish">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Friday Finish Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Available on Saturday</td><td><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="saturday_on"><input type='radio' name="saturday" class="mdl-radio__button day_input" value="1" id='saturday_on'><span class="mdl-radio__label">Yes</span></label>&nbsp;&nbsp;&nbsp;&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="saturday_off"><input type='radio' name="saturday" class="mdl-radio__button day_input" value="0" id='saturday_off'><span class="mdl-radio__label">No</span></label></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Saturday Start Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->saturday_start}}" name="saturday_start" class="mdl-textfield__input" id='saturday_start'><label class="mdl-textfield__label" for="saturday_start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saturday Start Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Saturday Finish Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->saturday_finish}}" name="saturday_finish" class="mdl-textfield__input" id='saturday_finish'><label class="mdl-textfield__label" for="saturday_finish">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saturday Finish Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Available on Sunday</td><td><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sunday_on"><input type='radio' name="sunday" class="mdl-radio__button day_input" value="1" id='sunday_on'><span class="mdl-radio__label">Yes</span></label>&nbsp;&nbsp;&nbsp;&nbsp; <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="sunday_off"><input type='radio' name="sunday" class="mdl-radio__button day_input" value="0" id='sunday_off'><span class="mdl-radio__label">No</span></label></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Sunday Start Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->sunday_start}}" name="sunday_start" class="mdl-textfield__input" id='sunday_start'><label class="mdl-textfield__label" for="sunday_start">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sunday Start Time</label></div></td></tr><tr>
            <td class="mdl-data-table__cell--non-numeric">Sunday Finish Time</td><td><div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input step="1800" type='time' value="{{$user->sunday_finish}}" name="sunday_finish" class="mdl-textfield__input" id='sunday_finish'><label class="mdl-textfield__label" for="sunday_finish">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sunday Finish Time</label></div></td></tr>
            
            <tr><td><button class="submit_button mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-button--raised mdl-button--colored mdl-color--light-blue-500" type="submit">Submit Info</button></td><td></td></tr>
            </tbody>
            </table>
                              </form>
                             <script type="text/javascript">
                              var isTime = true;
                              var isDone = false;
                            setInterval(function(){
                              isTime = true;
                             }, 10000)
                               $('input').on('change', function(event) {
                                 event.preventDefault();
                                 if(isTime &&isDone){
                                 $.post('/locker/save', $('.large_form').serializeArray(), function(data, textStatus, xhr) {
                                   tooltip("Information Updated");
                                    isTime = false;
                                 });
                               }
                               });
                               $('.day_input').on('change', function(event) {
                                 var $this = $(this);
                                 console.log($this.val());
                                  var tr = $this.parent().parent().parent();
                                 if(parseInt($this.val())==0){
                                tr.next('tr').css('display', 'none');
                                 tr.next('tr').next('tr').css('display', 'none');
                               }else{
                                 tr.next('tr').css('display', 'table-row');
                                 tr.next('tr').next('tr').css('display', 'table-row');
                               }
                               });

                               function makeInputCorrect(name, value){
                                $('input[type=radio]').map(function(index, elem) {
                                  var $this = $(this);
                                  if($this.attr('name') == name){
                                    if(parseInt($this.val())==parseInt(value)){
                                     // console.log(parseInt($this.val()) + '--'+ parseInt(value));
                                      $this.prop('checked', true);
                                      $this.parent().addClass('is-checked');
                                      $this.parent().next('label').removeClass('is-checked');
                                      $this.parent().prev('label').removeClass('is-checked');
                                      $this.trigger('change');
                                    }
                                  }
                                });
                               }

                               @if(isset($user->sunday)) makeInputCorrect('sunday',{{$user->sunday}}); @endif
                               @if(isset($user->monday)) makeInputCorrect('monday',{{$user->monday}}); @endif
                               @if(isset($user->tuesday)) makeInputCorrect('tuesday',{{$user->tuesday}}); @endif
                               @if(isset($user->wednesday)) makeInputCorrect('wednesday',{{$user->wednesday}}); @endif
                               @if(isset($user->thursday)) makeInputCorrect('thursday',{{$user->thursday}}); @endif
                               @if(isset($user->friday)) makeInputCorrect('friday',{{$user->friday}}); @endif
                               @if(isset($user->saturday)) makeInputCorrect('saturday',{{$user->saturday}}); @endif
                               @if(isset($user->personal_lessons)) makeInputCorrect('personal_lessons',{{$user->personal_lessons}}); @endif
                               isDone = true;
                             </script>


 @endsection