<style type="text/css">
    /*    #progress_bar{
	    background-color:#f1292b;	
	}*/
    .ui-widget-content{
	border:none;
    }
    #progress_bar .ui-widget-header {
	background: repeating-linear-gradient( 45deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) 10px, rgba(0, 0, 0, 0.3) 10px, rgba(0, 0, 0, 0.3) 20px );
	height: 15px;
	/*width: 100% !important;*/
    }
    /*    .ui-progressbar-value {
		background: url(http://www.netanimations.net/Animated-fighter-plane-fly-by.gif) no-repeat;
		border:none;
	    }
	    .ui-progressbar {
		height: 20px
	    }*/
    /*.ui-autocomplete-loading { background:url("http://www.gifs.cc/aircraft/harrier-jet-animated-1.gif") no-repeat right center }*/
</style>
<div id="confbox" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-container">
<!--	<header class="popupHeader"> <span class="header_title">FILING PLAN</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>-->
	<section class="popupBody editbody">

	    <div class="user_login">
		<div class="row">
		    <span class="fpl_loader"></span>
		    <p id="" style="width:98%;text-align: center;margin:0;">
			<span id="progress_bar"></span> <span id="percentage2"></span>
		    </p>
		    <div class="col-md-12">  
			<?php
			if (isset($aircraft_callsign)) {
			    if ($departure_aerodrome == 'ZZZZ') {
				$departure_aerodrome = $departure_station;
			    }
			    if ($destination_aerodrome == 'ZZZZ') {
				$destination_aerodrome = $destination_station;
			    }
			}
			?>
			<p id="fpl_modal_text" class="fpl_modal_text" style="font-weight: bold;font-size: 13px;">Do you wish to File {{(isset($aircraft_callsign))? $aircraft_callsign.' '.$departure_aerodrome.' to '.$destination_aerodrome : ''  }} Plan ?</p>
		    </div>
		</div>
		<div class="row">		  
		    <div class="col-md-3 yesedit fpl_modal_text">                       
			<!--<button type="submit"  class="btn newbtn file-btn remove_dis" name="flag" value="File">Yes</button>-->
			<button type="button"  class="btn newbtnv1 file-btn remove_dis file_the_plan" name="flag" value="File">Yes</button>
		    </div>  
		</div>
	    </div>
	</section>
    </div>
</div>

<div id="auto_cancel_alert" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-container">
	<header class="popupHeader"> <span class="header_title">FILE PLAN</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
	<section class="popupBody editbody">

	    <div class="user_login">
		<div class="row">
		    <div class="col-md-12">   
			<p style="font-weight: bold;font-size: 13px;color: #F1292b">FLIGHT PLAN ALREADY EXISTS FOR SAME DATE & TIME, DO YOU WISH TO CANCEL OLD PLAN & PROCESS THIS NEW PLAN ?</p>
		    </div>
		</div>
		<div class="row">
		    <div class="col-md-3 yesedit">                       
			<button type="submit"  class="btn newbtn file-btn remove_dis newbtnv1" name="flag" value="File">Yes</button>
		    </div>  
		</div>
	    </div>
	</section>
    </div>
</div>