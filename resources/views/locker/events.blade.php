
<div style="background:white; text-shadow: black 1px 0px 0px;" class="mdl-cell mdl-cell--12-col mdl-shadow--2dp mdl-cell--top actions_bar2">
	<a class="div_change3 mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="upcomingevents" style="background-color:rgba(158,158,158,.2)">Upcoming Events</a>
	<a class="div_change3 mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-blue-500" data-div="pendingswingtips" >Pending Swing Tips</a>
</div>



<div class="switch3 upcomingevents mdl-grid">
<div class="explanation">
This is where you can see your upcoming In Person Lessons and be able to find out if they are pending, a coach has confirmed the lesson, or has denied the lesson request with reasoning (this credits back your account).
</div>
@include('events.events')
</div>
<div class="switch3 pendingswingtips mdl-grid">
<div class="explanation">
This is where you can see all pending and completed Swing Tip Lessons.
</div>
@include('notifications.swingtips')
</div>



<script type="text/javascript">
$('.switch3').hide();
$('.upcomingevents').show()
	$('.div_change3').on('click', function(event) {
event.preventDefault();
var div = $(this).data('div');
$('.div_change3').css('background-color', 'white');
$(this).css('background-color', 'rgba(158,158,158,.2)');
$('.switch3').css('display', 'none');
$('.'+div).slideDown(300);
});

</script>

<style type="text/css">
	.div_change3{
		font-size: 22px;
	}
</style>