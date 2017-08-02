<?php
$u = Auth::user();
?>
<div class="mdl-card__title mdl-color-text--red-400 special_accent mdl-cell--12-col">
    <h2 class="mdl-card__title-text">Pending Swing Tips</h2>
  </div>
@if($u->pro)
<br> Please complete Swing Tips in no more than 3 business days.
@endif
@if($u->pro)
@if(count($u->hires_pro)>0)
      @foreach($u->hires_pro as $h)
      @if($h->sent && $h->replied == 0)
            @include('grid.top',['title'=>'Swing Tip with '.$h->user->morphname(),'size'=>12])
            @include('users.user_icon', ['other'=>$h->user])<br>
            {{substr($h->user->bio, 0, 200)}}...
            @include('grid.bottom',['button_name'=>'View Swing Tip', 'button_dir'=>url('response/'.$h->id)])
      @endif
      @endforeach
      <div class="mdl-card__title mdl-color-text--red-400 special_accent mdl-cell--12-col">
    <h2 class="mdl-card__title-text">Completed Swing Tips</h2>
       </div>
      @foreach($u->hires_pro->sortByDesc('created_at')->take(10) as $h)
      @if($h->sent && $h->replied)
            @include('grid.top',['title'=>'Swing Tip with '.$h->user->morphname(),'size'=>12])
            @include('users.user_icon', ['other'=>$h->user])<br>
            {{substr($h->user->bio, 0, 200)}}...
            @include('grid.bottom',['button_name'=>'View Swing Tip', 'button_dir'=>url('response/done/'.$h->id)])
      @endif
      @endforeach
@endif
@else
@if(count($u->hires)>0)
      @foreach($u->hires as $h)
      @if($h->sent && $h->replied == 0)
            @include('grid.top',['title'=>'Swing Tip with '.$h->pro->morphname(),'size'=>12])
            @include('users.user_icon', ['other'=>$h->pro])<br>
            {{substr($h->pro->bio, 0, 200)}}...
            @include('grid.bottom',['button_name'=>'View Swing Tip', 'button_dir'=>url('response/done/'.$h->id)])
      @endif
      @endforeach
      <div class="mdl-card__title mdl-color-text--red-400 special_accent mdl-cell--12-col">
    <h2 class="mdl-card__title-text">Completed Swing Tips</h2>
       </div>
      @foreach($u->hires_pro as $h)
      @if($h->sent && $h->replied)
            @include('grid.top',['title'=>'Swing Tip with '.$h->pro->morphname(),'size'=>12])
            @include('users.user_icon', ['other'=>$h->pro])<br>
            {{substr($h->user->bio, 0, 200)}}...
            @include('grid.bottom',['button_name'=>'View Swing Tip', 'button_dir'=>url('response/done/'.$h->id)])
      @endif
      @endforeach
@endif
@endif