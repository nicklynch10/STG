@if($is_pro)
@foreach($pro->clients_pro as $key=>$client)
<div class="mdl-cell mdl-cell--4-col mdl-cell--top">
  <div style="width: 100%;" class="mdl-card mdl-shadow--2dp mdl-color--white-100 is-casting-shadow">
    <div class="mdl-card__title">
      <div  class="mdl-grid" style="width:100%;">
        <img src="{{$client->user->propic}}" class="mdl-cell--12-col" style="height: 100%;">
        <br>
        <div style="" class="mdl-cell--12-col">
          <a style="font-size:20px;width: 100%;height: auto; line-height: 22px;" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect mdl-color-text--light-blue-500" href="{{url('locker/'.$client->user->id)}}">
        {{$client->user->morphname()}}</a><br>
        <div style="text-align: center;">
        {{$client->user->city}}, {{$client->user->state}}<br>
        Handicap: {{$client->user->handicap}}<br>
        
        @if($client->user->course)
        <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" style="font-size:18px; width: 100%;height: auto; line-height: 20px;" href="{{url('academy/'.$client->user->course->id)}}">{{$client->user->course->morphname()}}</a><br>
        @endif
        </div>
        </div>
      </div>
    </div>
    <div class="mdl-card__supporting-text display-1">
      @if($is_me)
<a style="margin: auto;" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('video/send/'.$client->user->id)}}">Send {{$client->user->morphname()}} a Lesson Video<i class="material-icons">forward</i></a>
<br><br>
 <div style="width: 100%; font-size: 20px; text-align: center;">Swing Tips</div>
      <ul class="mdl-list" style="margin-top: 0px;">
        @foreach($client->user->hires->where('pro_id', (string)$pro->id)->where('sent', '1') as $key2=>$hire)
        @if(!$hire->declined&&!$hire->failed)
        <?php 
        $sent_at = Carbon\Carbon::parse($hire->sent_at);
        $now = Carbon\Carbon::now();
        ?>
        <li class="mdl-list__item"  style="padding-top: 0px; width: 100%; text-align: center; display: block;">
          <span class="mdl-list__item-primary-content" style="text-align: center; width: 100%;">
            <a style="height:auto; line-height: 25px; margin: auto;@if(!$hire->replied)background:rgba(255,0,0,.3);@endif" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('response/done/'.$hire->id)}}">Pending: {{$sent_at->format('F j, Y')}}
            @if(!$hire->replied)
             <br>{{$sent_at->addDays(3)->diffInHours($now)}} left hours to reply
            @endif
            </a>
          </span>
        </li>
        @endif
        @endforeach
      </ul>

<div style="width: 100%; font-size: 20px; text-align: center;">In Person Lessons</div>
@if(Auth::user()->vimeos && Auth::user()->vimeos->where('type','client'))
@foreach(Auth::user()->vimeos->where('type','client') as $d)
@if($d->active && $d->student &&$d->student->id == $client->user->id)
<a href="video/{{$d->id}}" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect">
{{$d->title}}
  </a>
  @endif
@endforeach
@endif



      @endif


      @include('grid.bottom')
      @endforeach
      @else
      @if($is_me)
      <div class="explanation">
      This is where you can find coaches that you have worked with in the past and lessons that you have completed with them for future reference.
      </div>
      @endif
      @foreach($pro->clients as $key=>$client)
      <div class="mdl-cell mdl-cell--4-col mdl-cell--top">
        <div style="width: 100%;" class="mdl-card mdl-shadow--2dp mdl-color--white-100 is-casting-shadow">
          
          <div class="mdl-card__title">
            <div class="mdl-grid" style="width: 100%;">
              <img src="{{$client->pro->propic}}" class="mdl-cell--12-col" style="height: 100%;">
              <div class="mdl-cell--12-col">
              <a style="font-size:20px;width: 100%;height: auto; line-height: 22px;" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect mdl-color-text--light-blue-500" href="{{url('locker/'.$client->pro->id)}}">
              {{$client->pro->morphname()}}</a><br>
              <div style="text-align: center;">
              {{$client->pro->city}}, {{$client->pro->state}}<br>
              </div>
            {{--   @if($client->pro->course)
        <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="{{url('academy/'.$client->pro->course->id)}}">{{$client->pro->course->morphname()}}</a><br>
        @endif --}}

              </div>
              
            </div>
          </div>
          <div class="mdl-card__supporting-text display-1">
            @if($is_me)
            <div style="width: 100%; font-size: 20px; text-align: center;">Swing Tips</div>
            <ul class="mdl-list" style="margin-top: 0px;">
              @foreach($client->pro->hires_pro->where('user_id', (string)$pro->id)->where('sent', "1") as $key2=>$hire)
              <?php 
        $sent_at = Carbon\Carbon::parse($hire->sent_at);
        $now = Carbon\Carbon::now();
        ?>
              <li class="mdl-list__item" style="padding-top: 0px;">
                <span class="mdl-list__item-primary-content">
                  <a style="height:auto; line-height: 25px;" class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" 
                  @if(!$hire->replied)>Pending: {{$sent_at->format('F j, Y')}}<br>
                  {{$sent_at->addDays(3)->diffInHours($now)}} hours left to reply
                  @else
                    href="{{url('response/done/'.$hire->id)}}">{{$sent_at->format('F j, Y')}}
                  @endif
                  </a>
                  <br>

                </span>
              </li>
              @endforeach
            </ul>
            @endif
            @include('grid.bottom')
            @endforeach
            @endif