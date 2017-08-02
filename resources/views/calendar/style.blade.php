<style type="text/css">
		.mdl-grid{
			width: 100% !important;
			margin: 0px;
			padding: 0px;
		}
		.seventh{
			width: 14.2% !important;
			border-right: black 1px solid;
			height: 1240px;
			position: relative;
		}
		.under_seventh{
			width: 100%;
			height:24.1px;
			border-bottom: black 1px solid;
			text-overflow: ellipsis;
			text-align: center;
			white-space: nowrap;
			overflow: hidden;
			background-color: rgba(79,195,247,.2);
		}
		.under_seventh:nth-child(even){
			border-bottom: black 1px dashed;
		}
		.times{
			width:6.5%;
			height: 1240px;
		}
		.time_header{
			font-size: 18px;
			text-align: center;
			width: 100%;
			height: 40px;
		}
		.time{
			height: 49.18px;
			border-bottom: black 1px solid;
			border-left: black 1px solid;
			text-align:center;
		}
		.time:last-child{
			border-bottom: black 0px solid;
		}
		.seventh:first-of-type{
			border-left: black 1px solid;
		}
		.day{
			font-size: 21px;
			text-align: center;
			width: 100%;
			height: 40px;
		}
		.week{
			width: 93.3%;
			display: flex;
		}
		body{
			/*background-color: #e1f5fe !important;*/
		}
		.dash{
			width: 99.8%;
			/*height: 100px;*/
			padding-bottom: 20px;
		}

		.create_event{
			min-height: 285px;
			width: 500px;
			position: absolute;
			z-index: 1000;
		}
		.tri{
			
			height: 15px;
			width:15px;
			position: absolute;
			margin-top: 275px;
			margin-left:150px;
			z-index: 999;
			background: white;
			transform: rotate(45deg);
			box-shadow: 4px 4px 4px -3px #616161;
		}
		.minititle{
			font-size: 20px;
			line-height: 20px;
			margin-right: 2px;
		}
		.mdl-textfield__input{
			font-family: 'Lato';
			font-weight: 400;
			color: black;
		}
		.page_change{
			margin:10px;
			float: right;
			}
		.event_button{
			margin:5px;
		}
		.pending,.event.pending {
			@if($is_me)
			background: rgba(253,216,53,.7);
			@else
			background-color: rgba(239,83,80,.3);
			background: rgba(253,216,53,.7);
			@endif
			box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);
		}
		.denied,.event.denied {
			background: rgba(255,138,128,.5);
			box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);
		}
		.confirmed,.event.confirmed {
			background: rgba(0, 200, 83,.8);
				box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);
		}
		.alternative,.event.alternative {
			background:rgba(255,196,0,.5);
			box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);
		}
		.popup{
			position: absolute;
		}
		.selected,.event.selected{
				background: rgb(178,255,89);
				background-color: rgba(64,196,255,.8) !important;
		}

		.event{
			@if($is_me)
			background: rgba(105,240,174,.5);
			@else
			background-color: rgba(239,83,80,.3);
			@endif
			box-shadow: 0 1px 1px 0px rgba(0,0,0,.15);
			cursor: pointer;
		}
		.under_seventh:hover{
			background-color: rgba(158,158,158,.5);
		}
		.content{
			width:100%;
		}
		.side{
			min-width: 180px;
			margin-right: 20px;
		}
		.month{
			width:100%;
			margin:10px;
			height: 180px;
			background: white;
		}
		.app{
			display: flex;
			width:100%;

		}
		.calendar{
			display: flex;
		}
		.small_week{
			height: 100%;
			width: 13.5%;
		}
		.small_day{
			width: 100%;
			height: 16%;
			text-align:center;
			cursor: pointer;
			display: block;
			color:#616161;
			text-decoration: none;
		}
		.small_day:hover{
			background: rgba(79, 195, 247,.3);
		}
		.day_letter{
			width: 100%;
			height: 16%;
			text-align:center;
		}
		.month_head{
			width: 100%;
			height: 25px;
			display: flex;
		}
		.month_days{
			display: flex;
		}
		.month_head>div{
			width:13.5%;
			text-align: center;
		}
		.month_title{
			text-align: center;
			font-size: 25px;
			margin-bottom: 10px;
			margin-top: 2px;
		}
		.different_month{
			background: rgba(8,8,8,.1);
		}
		.same_month{
			background: rgba(256,256,256,.2);
		}
		.thisweek{
			background: #B3E5FC;
			background: rgba(179, 229, 256, .2);
		}
		.thisday{
			background: #B3E5FC;
		}
		.tasklist{
			width: 100%;
			margin:10px;
			min-height:200px;
			background: white;
		}
		.dash_title{
			text-align: center;
	font-size: 30px;
	margin-top: 20px;
		}
		.month_view{
			width: 99.8%;
		}
		.month_view_head{
			width: 100%;
			height: 50px;
			display: flex;
		}
		.month_view_head>div{
			width: 15%;
			text-align: center;
			font-size: 23px;
			background: white;
			border-bottom: 1px black solid;
			border-right:1px black solid;
		}
		.month_view_days{
			display: flex;
			width:100%;
		}
		.month_view_week{
			width: 15%;
			height:1500px;
		}
		.dash_header{
			width: 100%;
		}
		.month_view_small_day{
			border-bottom:1px #757575 solid;
			border-right:1px #757575 solid;
		}
		.legend{
		display: flex;
	width: 100%;
	margin:auto;
	margin-top: 10px;
	margin-bottom:10px;
	background: white;
	min-height: 50px;
		}
		.legend>div{
			font-size: 18px;
			width: 20%;
			padding: 15px;
		}
		.legend>div:first-of-type{
			margin-left:10%;
		}
		.legend>div:last-of-type{
			margin-right:10%;
		}

		.unavailable{
			background-color: rgba(239,83,80,.3);
		}
		.day_title{
		}
		.less_day_info{
			display: none;
		}

@media all and (max-width: 768px) {
 /*.side{
 	display: none;
 }*/
 .week{
 	width: auto;
 	width: 100%;
 }
 .times {
    width: auto;
}
.under_seventh{
	min-width: 50px;
}

.more_date_info{
	display: none;
}
.less_day_info{
	display: block;
}
#month_button,#unavailable_button,#week_button{
	display: none;
}
.week_change{
	padding: 0px;
	background: #C5E1A5;
}
.legend>div{
    margin: 0px !important;
}
}


	</style>