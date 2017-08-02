@extends('layouts.app')

@section('content')
@include('dashboard.scripts')
                     
                    <figure class="mdl-cell mdl-cell--6-col mdl-cell--top">
                      <img class="mdl-shadow--2dp mdl-color--white-100 is-casting-shadow" style="max-width:100%; max-height: 700px" src="{{ url($pro->propic) }}">
                    </figure>
                   

                    @include('grid.top',["title"=>$pro->firstname." ".$pro->lastname, "size"=>4])
                      
                      <b>Name:</b> {{$pro->firstname." ".$pro->lastname}}<br>
                      <b>Email:</b> {{$pro->email}}<br>
                      <b>Rate:</b> {{$pro->rate}}<br>
                      <b>Rating:</b> {{$ratings->avg}} Stars<br>
                      <b>Years of Experience:</b> {{$pro->yoe}}<br>
                      {{$pro->bio}}
                       <hr>
                      {{-- <b>In Person Lessons:</b> {{$pro->day_render('personal_lessons', $pro->personal_lessons)}}<br>
                      <b>Lesson Price:</b>${{$pro->lesson_price}}<br>
                      <b>Sunday:</b>{{$pro->day_render('sunday', $pro->personal_lessons)}}<br>
                      <b>Monday:</b>{{$pro->day_render('monday', $pro->personal_lessons)}}<br>
                      <b>Tuesday:</b>{{$pro->day_render('tuesday', $pro->personal_lessons)}}<br>
                      <b>Wednesday:</b>{{$pro->day_render('wednesday', $pro->personal_lessons)}}<br>
                      <b>Thursday</b>{{$pro->day_render('thursday', $pro->personal_lessons)}}<br>
                      <b>Friday:</b>{{$pro->day_render('friday', $pro->personal_lessons)}}<br>
                      <b>Saturday:</b>{{$pro->day_render('saturday', $pro->personal_lessons)}}<br> --}}                    @include('grid.bottom')

                    
                    
                     @include('grid.top',["title"=>"Operations", "size"=>2])
                     @if(!isset($pro->watching))
                     <form role="form" method="POST" action="{{url('/locker/'.$pro->id)}}">
                     {{ csrf_field() }}

                     <input type="hidden" name="user" value="{{$pro->id}}"></input>
                     <button class="mdl-button mdl-button--raised mdl-button--colored mdl-color-text--grey-50 mdl-js-button mdl-js-ripple-effect" type="submit">Add to Watchlist</button>
                     </form>
                     <hr>
                     @else
                     User is on watchlist
                     <hr>
                     @endif
                     <a class="mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color--light-blue-500 mdl-color-text--grey-50" href="{{url('/hire/pro/'.$pro->id)}}">Hire For Swing Tip</a>
                     <hr>
                     <a class="mdl-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color--yellow-500" href="{{url('/options/'.$pro->id)}}">Hire For In Person Lesson</a>
                      @include('grid.bottom')
                        <div id='jqxTabs' class="mdl-cell mdl-cell--12-col mdl-cell--top mdl-shadow--2dp mdl-color--white-100 is-casting-shadow">
            <ul>
                <li style="margin-left: 30px;">{{$pro->firstname}}'s Media</li>
                <li>Your History with {{$pro->firstname}}</li>
                <li>My Notifications</li>
                <li>{{$pro->firstname}}'s Clients</li>
                <li>{{$pro->firstname}}'s Testimonials</li>
                <li>{{$pro->firstname}}'s Ratings</li>
                <li>{{$pro->firstname}}'s Prerecorded Lessons</li>
            </ul>
            <div>
               <div id='jqxTabs2'>
            <ul>
            <li>Public</li>
            <li>Your shared media</li>
            </ul>
             <div class="tab-bg">
                <div style="width:98%" class="mdl-grid">
                @foreach($videos as $video)
                @include('grid.video_format',['video'=>$video,"size"=>4])
                @endforeach
                </div>
             </div>
           
                <div class="tab-bg">
                <div style="width:98%" class="mdl-grid">
                @foreach($videos_other as $video)
                @include('grid.video_format',['video'=>$video,"size"=>4])
                @endforeach
                </div>
                <hr>
                 <div style="width:98%" class="mdl-grid">
                @foreach($videos_pro as $video)
                 @include('grid.video_format',['video'=>$video,"size"=>4])
                @endforeach
                </div>
                </div>
        </div>   
            </div>   
            <div class="tab-bg"> <!-- this is the clients tab -->
            @include('grid.separator',['size'=>1])
            @include('grid.top',['title'=>"History", 'size'=>10])
            <ul class="mdl-list">
               @foreach($hires as $key2=>$hire)
              <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                  <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect"href="{{url('response/done/'.$hire->id)}}">Response {{$key2+1}} <i class="material-icons">forward</i></a>
                </span>
              </li>
               @endforeach
               </ul>
               @include('grid.bottom')
               @include('grid.separator',['size'=>1])
            </div> <!-- end clients tab -->
            <div class="tab-bg"><!-- notif tab -->
            
            </div> <!-- end notif tab -->
            <div class="tab-bg"><!-- clients tab -->
            
            <ul class="mdl-list">
            @foreach($clients as $key=>$client)
           
            
              
              <li class="mdl-list__item">
                <span class="mdl-list__item-primary-content">
                  <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect"href="{{url('locker/'.$client->user_id)}}">{{$client->user->firstname." ".$client->user->lastname }}<i class="material-icons">forward</i></a>
                </span>
              </li>
               
               @endforeach
               </ul>
              
            </div> <!-- end clients tab -->
            <div class="tab-bg"><!-- testimonials -->
             <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/testimonial/'.$pro->id)}}">Write a Testimonial</a>
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
            <div class="tab-bg"> <!-- playlists -->
            @foreach($user->playlists as $key=>$play)
              <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{url('/'.$pro->id.'/'.$play->id.'/view')}}">{{$play->title or "Playlist".$key}}</a>
            @endforeach
            </div>
                
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

