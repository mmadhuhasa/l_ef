<div id="editbox" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-container">
        <header class="popupHeader"> <span class="header_title">EDIT PLAN</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
        <section class="popupBody editbody">  
            <div class="user_login">
                <div class="row">
                    <div class="col-md-12">   
                        <p class="model_font">Do you wish to Edit {{(isset($aircraft_callsign))? $aircraft_callsign.' '.$departure_aerodrome.' to '.$destination_aerodrome : ''  }} Plan ?</p>            
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 yesedit">                                            
			<button   type="submit" name="flag"  value="Edit" class="btn newbtn file-btn remove_dis">Yes</button>
		    </div>  
                </div>
            </div>
        </section>
    </div>
</div>
<div id="alert" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-container">
        <header class="popupHeader"> <span class="header_title">Alert</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
        <section class="popupBody editbody">  
            <div class="user_login">
                <div class="row">
                    <div class="col-md-12">   
                        <p class="model_font" id="alert_msg"></p>            
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>