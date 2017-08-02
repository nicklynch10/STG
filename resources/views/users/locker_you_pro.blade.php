@extends('layouts.app')

@section('content')
@include('dashboard.scripts')

                    
                    <figure class="mdl-cell mdl-cell--8-col mdl-cell--top">
                      <img class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow" style="max-width:100%; max-height: 700px" src="{{ $user->propic }}">
                      <figcaption><a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href="{{url('/upload')}}">Upload new picture</a></figcaption>
                    </figure>
                   

                    @include('grid.top',["title"=>$user->firstname." ".$user->lastname, "size"=>4])
                      
                      <b>Name:</b> {{$user->firstname." ".$user->lastname}}<br>
                      <b>Email:</b> {{$user->email}}<br>
                      <b>Rate:</b> {{$user->rate}}<br>
                      <b>Rating:</b> 5 Stars<br>
                      <b>Years of Experience:</b> {{$user->yoe}}<br>
                      {{$user->bio}}
                      <hr>
                      <b>In Person Lessons:</b> {{$user->day_render('personal_lessons', $user->personal_lessons)}}<br>
                      <b>Lesson Price:</b>${{$user->lesson_price}}<br>
                      <b>Sunday:</b>{{$user->day_render('sunday', $user->personal_lessons)}}<br>
                      <b>Monday:</b>{{$user->day_render('monday', $user->personal_lessons)}}<br>
                      <b>Tuesday:</b>{{$user->day_render('tuesday', $user->personal_lessons)}}<br>
                      <b>Wednesday:</b>{{$user->day_render('wednesday', $user->personal_lessons)}}<br>
                      <b>Thursday</b>{{$user->day_render('thursday', $user->personal_lessons)}}<br>
                      <b>Friday:</b>{{$user->day_render('friday', $user->personal_lessons)}}<br>
                      <b>Saturday:</b>{{$user->day_render('saturday', $user->personal_lessons)}}<br>

                       <div class="mdl-card__menu">
                      <a href="/locker/edit" id="edit_tooltip" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                        <i class="icon material-icons">edit</i>
                      </a>
                   </div>
                   </div>
                   </div>
                   </div>

<div class="mdl-tooltip mdl-tooltip--large" for="edit_tooltip">
Edit Your Information
</div>
                   

                   	@include('grid.separator',['size'=>12])
                      	  <div id='jqxTabs' class="mdl-cell mdl-cell--12-col mdl-cell--top mdl-shadow--2dp mdl-color--white-100 is-casting-shadow">
            <ul>
                <li style="margin-left: 30px;">My Media</li>
                <li>My Prerecorded Lessons</li>
                <li>My Clients</li>
                <li>My Notifications</li>
                <li>My Testimonials</li>
                <li>My Ratings</li>
                <li>My Lesson Options</li>
            </ul>
            <div>
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/video')}}">Upload Video</a>
            
               <div id='jqxTabs2'>
            <ul>
            <li>Public</li>
             @foreach($clients as $key=>$client)
                <li>{{$client->user->lastname}}</li>
              @endforeach
            </ul>
             <div class="tab-bg">
                <div style="width:98%" class="mdl-grid">
                @foreach($videos as $video)
                @include('grid.video_format',['video'=>$video,"size"=>4])
                @endforeach
                </div>
             </div>
            @foreach($clients as $key=>$client)
                <div class="tab-bg">
                <div style="width:98%" class="mdl-grid">
                @foreach($client->videos_other as $video)
                @include('grid.video_format',['video'=>$video,"size"=>4])
                @endforeach
                </div>
                <hr>
                 <div style="width:98%" class="mdl-grid">
                @foreach($client->videos_pro as $video)
                 @include('grid.video_format',['video'=>$video,"size"=>4])
                @endforeach
                </div>
                </div>
              @endforeach
        </div>   
            </div>   
            <div><!--  playlist tab -->
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/'.$user->id.'/new_playlist')}}">New Prerecorded lessons playlist</a>
                @foreach($playlists as $key=>$playlist)
                  <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/'.$user->id.'/'.$playlist->id.'/manage_playlist')}}">{{$playlist->title or "Prerecorded Lesson Set-".$key}}</a>
                @endforeach
            </div><!-- playlist tab -->
            <div class="tab-bg"> <!-- this is the clients tab -->
            <div style="width:98%" class="mdl-grid">
            @foreach($clients as $key=>$client)
            @include('grid.top',['title'=>$client->user->firstname." ".$client->user->lastname, 'size'=>4])
            <ul class="mdl-list">
               @foreach($client->hires as $key2=>$hire)
              <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                  <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect"href="{{url('response/done/'.$hire->id)}}">Response {{$key2+1}} <i class="material-icons">forward</i></a>
                </span>
              </li>
               @endforeach
               </ul>
               @include('grid.bottom')
               @endforeach
               </div>
            </div> <!-- end clients tab -->
            <div class="tab-bg"><!-- notif tab -->
            <div style="width:98%" class="mdl-grid">
            @foreach($notifications as $note)
               @include('grid.grid',['title'=>$note->grid_title,'button_name'=>$note->grid_button_name,'button_dir'=>url($note->grid_button_dir), 'display'=>$note->grid_display])
               @endforeach
               </div>
            </div> <!-- end notif tab -->
            <div class="tab-bg"><!-- testimonials -->
            <div style="width:98%" class="mdl-grid">
            @foreach($testimonials as $test)
            @include('grid.separator',['size'=>1])
            @include('grid.grid',['title'=>$test->title, 'display'=>$test->description, 'size'=>10])
            @include('grid.separator',['size'=>1])
            @endforeach
            </div>
            </div><!-- testimonials -->
            <div class="tab-bg"> <!-- rating -->
            <br>
            <b>Average Rating:</b>
            {{$ratings->avg}} Stars
            <hr>
             <table class="mdl-data-table mdl-js-data-table rate-table">
            <thead>
              <tr>
                <th style="width:15%">Rating</th>
                <th style="width:85%" class="mdl-data-table__cell--non-numeric">Description</th>
              </tr>
            </thead>
            <tbody>
               @foreach($ratings as $rating)

          <tr>
            <td style="width:15%">{{$rating->rating}} Stars</td>
            <td style="width:85%" class="mdl-data-table__cell--non-numeric">{{$rating->description}}</td>
          </tr>
               @endforeach

              </tbody>
            </table>  
            </div> <!-- rating -->
            <div class="tab-bg"><!-- settings tab -->
                 <div style="width:98%" class="mdl-grid">
                  <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('option/edit/')}}">New Lesson Option<i class="material-icons">golf_course</i></a>
                  @foreach($user->options->where('active',"1") as $o)
                  <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('option/edit/'.$o->id)}}">{{$o->title}}<i class="material-icons">golf_course</i></a>
                  @endforeach
                 


                 </div>
            </div> <!-- end settings tab -->
        </div>   
                    

            <script type="text/javascript">
           
        $(document).ready(function () {
            // Create jqxTabs.
            $('#jqxTabs').jqxTabs({ 
            	width: '100%',
              position: 'top',
              animationType: 'fade',
              theme:'light'
          });
            $('#jqxTabs2').jqxTabs({ 
              width: '98%',
              position: 'top',
              animationType: 'fade',
              theme:'light'
          });

            });
    </script>
 
    <style type="text/css">
    #jqxTabs{
    	height: 100%;
    	min-height: 800px;
    }
    #jqxTabs,#jqxTabs2, .tab-bg{
    	background: #F5F5F5;
      
    }
    .rate-table{
      width: 99%;
    }

    </style>

@endsection
