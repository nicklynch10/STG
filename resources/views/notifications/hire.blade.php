
<!-- only requires a notification -->
<!-- only requires a notification -->
@include('grid.top', ['title'=>$note->data['message'], 'size'=>12])
<?php
if(isset($note->data['hire_id'])){
$id = (int)($note->data['other_id']);
if(isset($id))$other = App\User::find($id);
}
?>
@if(isset($other))
@include('users.user_icon', ['other'=>$other])<br>
@endif
@if(isset($note->data['event_id']))
<?php
$e = App\Event::find((int)$note->data['event_id']);
if($e &&$e->narrative){
	echo "<b>Reasoning:</b> ".$e->narrative;
}
?>
@endif
@if(isset($note->data['hire_id']) && $note->data['hire_id'])
<?php 
$tid = (int)$note->data['hire_id'];
$hire = App\Hire::find($tid);
?>
@if($hire&&$hire->id&&$hire->created_at)
This Swing Tip was requested at {{$hire->created_at->format('g:i A \\o\\n l\\, F j\\, Y')}}.
<br>
@if($hire->replied == 0)
<?php
$end = $hire->created_at->addHours(85);
?>
You must respond before {{$end->diffForHumans()}}.
@endif
@endif
@endif
@include('grid.bottom',['button_name'=>'Go Now', 'button_dir'=>$note->data['url']])