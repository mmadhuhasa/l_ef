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
<div id="confirm_change_plan" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-container">
        <header class="popupHeader"> <span class="header_title">Change PLAN</span>
         <span class="modal_close" data-dismiss="modal"><i class="icon-remove"></i></span> </header>
        <section class="popupBody editbody">
            <div class="user_login">
                <div class="row">
                 <span class="fpl_loader"></span>
            <p id="" style="width:98%;text-align: center">
            <span id="progress_bar"></span> <span id="percentage2"></span>
            </p>
                    <div class="col-md-12">
                        <p class="model_font fpl_modal_text">Are you sure to Change Plan details for {{(isset($aircraft_callsign))? $aircraft_callsign.' '.$departure_aerodrome.' to '.$destination_aerodrome : ''  }} Plan ?</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 yesedit fpl_modal_text">
                        <button  type="button" name="flag" data-name="New" value="Process" class="onclick_change_plan_modal btn btn-primary file-btn">Yes</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>