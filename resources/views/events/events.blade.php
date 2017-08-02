
<?php 
$collect = collect([]);
foreach (Auth::user()->events->where('active',1)->where('deleted',0) as $e) {
  $collect->push($e);
}
foreach (Auth::user()->events_pro->where('active',1)->where('deleted',0) as $e) {
  $collect->push($e);
}
$collect = $collect->sortBy('start');
?>
@foreach($collect->sortBy('start')->take(10) as $e)
@include('events.view',['e'=>$e])
@endforeach

