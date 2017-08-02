
<div class="mdl-cell mdl-cell--12-col">
<div class="mdl-shadow--2dp mdl-grid" style="background: white; width:100%;">
<div class="step_box mdl-cell mdl-cell--2-col" index="1">Step 1
<div class="substep">Send in the Face-on (FO) of your swing</div>
</div>
<div class="step_box mdl-cell mdl-cell--2-col" index="2">Step 2
<div class="substep">Send in the Down-the-Line (DL) view of your swing</div>
</div>
<div class="step_box mdl-cell mdl-cell--2-col" index="3">Step 3
<div class="substep">Review questions about your swing</div>
</div>
<div class="step_box mdl-cell mdl-cell--2-col" index="4">Step 4
<div class="substep">Confirm Swing tip</div>
</div>
</div>
</div>
<style>
.active_step{
	font-size:38px !important;
	color: #03a9f4 !important;
	padding-top: 10px;
	padding-bottom: 10px;
}
.step_box{
	text-align: center;
	font-size:15px;
	line-height: 32px;
	border-right: 1px black solid;
}
.substep{
	font-size: 11px;
	text-align: center;
	color: black;
	line-height: 18px;
	margin-top: 2px;
}
.active_step>.substep{
	font-size: 19px !important;
	line-height: 22px;
}



@media all and (max-width: 768px) {
   .step_box{
	border-right: 0px black solid !important;
}
}
</style>

<script type="text/javascript">
	var step = parseInt('{{$step or 1}}');
	var currentstep = $('.step_box[index='+step+']')
	.addClass('active_step')
	.addClass('mdl-cell--6-col');
</script>