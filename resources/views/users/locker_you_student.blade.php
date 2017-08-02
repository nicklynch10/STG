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

                    @include('grid.bottom')

                    
                   

                   	@include('grid.separator',['size'=>12])
                      	  <div id='jqxTabs' class="mdl-cell mdl-cell--12-col mdl-cell--top mdl-shadow--2dp mdl-color--white-100 is-casting-shadow">
            <ul>
                <li style="margin-left: 30px;">My Media</li>
                <li>My Pros</li>
                <li>My Notifications</li>
                <li>Purchased Prerecorded Lessons</li>
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
             <div class="tab-bg"><!-- notif tab -->
            <div style="width:98%" class="mdl-grid">
            @foreach($user->playlists as $playlist)
           <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect"href="{{url('playlist/view/'.$playlist->id)}}">{{$playlist->title}}</a>
              @endforeach
            </div> <!-- end notif tab -->
           
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
