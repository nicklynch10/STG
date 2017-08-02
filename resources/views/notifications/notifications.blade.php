@extends('layouts.app')

@section('content')
<div style="text-align:center;" class="mdl-cell mdl-cell--12-col">
<span style="font-size:25px;" >Notifications</span>
</div>
{{-- <div style="flex-flow: column wrap;" class="mdl-cell mdl-cell--4-col mdl-grid">
@include('notifications.swingtips')
</div> 1st colum
<div style="flex-flow: column wrap;" class="mdl-cell mdl-cell--4-col mdl-grid">
@include('events.events')

</div> 2nd colum  --}}
<div class="mdl-cell mdl-cell--2-col mdl-grid">
</div>
<div style="flex-flow: column wrap;" class="mdl-cell mdl-cell--8-col mdl-grid">
      @foreach($notifications->take(10) as $notification)
      @include('notifications.hire', ['note'=>$notification, 'user'=>$user])
      @endforeach
</div> <!-- 3rd colum -->
<div class="mdl-cell mdl-cell--2-col mdl-grid">
</div>




  <style type="text/css">
      </style>
  	
@endsection

