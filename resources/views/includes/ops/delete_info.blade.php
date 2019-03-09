<div id="delete_info_modal" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-container">
	<header class="popupHeader"> <span class="header_title">DELETE INFO</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
	<section class="popupBody editbody">
	    <div class="user_login">
		<div class="row">
		    <div class="col-md-12">  
                        <p id="fpl_modal_text" class="fpl_modal_text" style="font-weight: bold;font-size: 13px;text-align: center">Do you wish to delete <span class="aircraft"> {{(isset($aircraft_callsign))? $aircraft_callsign : ''  }} </span> info ?</p>
		    </div>
		</div>
		<div class="row">		  
                    <div class="col-md-12 yesedit fpl_modal_text" style="text-align: center">                       
                        <button type="button" data-url="info"  class="btn newbtnv1 file-btn delete_info_confirm" data-value="" name="flag" value="File">Yes</button>
		    </div>  
		</div>
	    </div>
	</section>
    </div>
</div>