<style type="text/css">
.ui-widget-content{
border:none;
}
#progress_bar .ui-widget-header {
background: repeating-linear-gradient( 45deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) 10px, rgba(0, 0, 0, 0.3) 10px, rgba(0, 0, 0, 0.3) 20px );
height: 15px;
/*width: 100% !important;*/
}
.modal-body{
padding:15px 15px;
text-align: center;
font-size: 14px;
}
#notam-pg-box .modal-container{
/*background: none;*/
box-shadow: none;
}
.modal-backdrop.in {
opacity: 0.4;
}
.modal-footer{
text-align: center; 
}
.modal-dialog{
width:270px; 
}
.modal-title{
text-align:center;
font-size:16px;
color: #fff;
}
.modal-title_addprice{
text-align:center;
font-size:14px;
color: #fff;
}
.modal-header {
padding: 6px 5px 6px 5px;
border-bottom: none;
background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
font-weight: bold;
}
.close_style_addairport{
position: absolute;
right: -5px;
top: -10px;
cursor: pointer;
color: #ffffff;
font-size: 26px;
border-radius: 50%;
background: #f1292b; 
}
</style>
<div id="watchhours" class="modal fade" style="display:none;" >
    <div class="modal-dialog modal-container">
	<header class="popupHeader"> <span class="header_title">ALERT</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>

	<section class="popupBody modal-body">

	    <div class="user_login">
		<div class="row">
		    <span class="fpl_loader"></span>
		    <p style="width:98%;text-align: center;padding:15px;font-size:16px;" id="msg">
		    
		    </p>
		</div>
	    </div>
	</section>
    </div>
</div>
<div id="watchhours_message" class="modal fade" style="display:none;" >
    <div class="modal-dialog modal-container">
    <header class="popupHeader"> <span class="header_title">ALERT</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>

    <section class="popupBody modal-body">

        <div class="user_login">
        <div class="row">
            <span class="fpl_loader"></span>
            <p style="width:98%;text-align: center;padding:15px;font-size:16px;">
            <span style="font-weight: bold">
                 SEARCH UPTO MAX 5 AIRPORTS WATCH HOURS
            </span>
            </p>
        </div>
        </div>
    </section>
    </div>
</div>
<div class="modal fade" id="AddAirport"  role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                    <h4 class="modal-title">ADD AIRPORT</h4>
                </div>
                <form method="POST" id="add-airport" action="{{url('watchhours/add-airport')}}">
                    <div class="modal-body">
                        <div class="col-sm-12" style="padding-right:0px;">
                            <div class="form-group">
                                <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets form-control modtooltip ui-autocomplete-input" placeholder="AIRPORT CODE"  id="code" name="code" autocomplete="off" data-placement="top" maxlength="4" data-toggle="popover">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="col-sm-12" style="padding-right:0px;">
                            <div class="form-group">
                                <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets form-control modtooltip ui-autocomplete-input" placeholder="CITY NAME"  id="name" name="name" autocomplete="off" data-placement="top" maxlength="15" data-toggle="popover">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding:0px 0px 10px 0px;">
                        <div class="col-sm-9"><button type="submit" class="btn  newbtnv1" style="width:100px;left:35px;">ADD</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Notams -->
    <div id="deleteNotam" class="modal fade in" style=" padding-right: 17px;">
       <div class="modal-dialog modal-container">
            <header class="popupHeader"> 
                <span class="header_title">Delete</span>
                <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> 
            </header>
            <section class="popupBody">
                <div class="user_login">
                     <h5>ARE YOU SURE TO DELETE <span id="deleteNotam_name"></span>  WATCH HOURS?</h5>
                    <div class="action_btns">
                        <div class="row">
                            <div class="col-md-3 yesedit">
                               <a href="#" watch-id=""  class="delete_watch_confirm btn newbtn_black">Yes</a>
                            </div>  
                        </div>
                    </div>
                </div>
        </section>
        </div>
    </div>

    
    <!-- Edit Notams -->
    <div id="editNotams" class="modal fade in" style=" padding-right: 17px;">
       <div class="modal-dialog modal-container">
            <header class="popupHeader"> 
                <span class="header_title">Edit</span>
                <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> 
            </header>
            <section class="popupBody"> 
                <div class="user_login">
                    <h5>ARE YOU SURE <span id="editNotams_name"></span> WATCH HOURS TO BE EDITED?</h5>
                    <div class="action_btns">
                        <div class="row">
                            <div class="col-md-4 yesedit">
                               <a href="javascript:void(0)" data-id="" target="_blank" ng-click="edit(1)" class="addDataId edit_watchhours btn newbtn_black">Yes</a>
                            </div>  
                        </div>
                    </div>
                </div>
        </section>
        </div>
    </div>
  <!-- Modal -->
  <div class="modal fade" id="ViewHistory" role="dialog">
      <div class="modal-dialog modal-lg" style="width:650px;">
          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                  <h4 class="modal-title">HISTORY</h4>
              </div>
              <div class="modal-body" style="padding-left:30px;padding-right:30px;padding-top: 0px;">
                  <table class="watchhours_info history_fuel table table-hover table-responsive desk-plan" id="watchhours_info" style="width: 100%">
                      <thead style="background: #333;">
                          <tr>
                              <th style="width:20px !important;border-left: 1px solid #000;">Sl</th>
                              <th style="width:35px !important;">ACTIONS</th>
                              <th style="width:90px !important;">DATE AND TIME</th>
                              <th style="width:60px !important;">BY</th>
                          </tr>
                      </thead>
                      <tbody id="watchhours_info_tbody">
                           
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->

  <div id="notams_info" class="modal fade" style="display:none;" >
     <div class="modal-dialog modal-container" style="width:650px;">
          <header class="popupHeader"> 
              <span class="header_title"><span id="notams_aero"></span> WATCH HOURS NOTAMS </span> 
              <span class="modal_close" data-dismiss="modal">
                  <i class="fa fa-times-circle"></i>
              </span> 
          </header>
          <section class="popupBody modal-body" id="notams_msg">
             
          </section>
      </div>
  </div>
