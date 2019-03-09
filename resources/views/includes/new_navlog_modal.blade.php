<!-- cancel modal-->
<div class="modal fade" id="navlog_cancel_plan"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" role="document">
        <header class="popupHeader">
            <span class="header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>   
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;">
                <div class="row">
                    <div class="col-md-12"> 
                        <p class="model_font"><span id="modal_message" class="modal_message"></span></p>    
                    </div>
                </div>
                <div class="row" style="text-align:center;margin-top:20px">
                    <form action="#" id="" >
                       
                            <div class="col-md-12">
                                <button type="button" class="btn_secondary navlog_cancel_plan newbtnv1 modal_btn_navlog"  data-url="{{url('navlog_cancel')}}">Yes</button>
                            </div>
                       
                    </form>
                </div>      
            </div>
        </section>
    </div>
</div>
<!-- cancel modal-->
<!-- pending cancel modal-->
<div class="modal fade" id="navlogpending_cancel_plan"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" role="document">
        <header class="popupHeader">
            <span class="header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>   
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;">
                <div class="row">
                    <div class="col-md-12"> 
                        <p class="model_font"><span id="modal_message" class="modal_message"></span></p>    
                    </div>
                </div>
                <div class="row" style="text-align:center;margin-top:20px">
                    <form action="#" id="" >
                            <div class="col-md-12">
                                <button type="button" class="btn btn_secondary navlogpending_cancel_plan newbtnv1"  data-url="{{url('navlog_cancel')}}">Yes</button>
                            </div>
                    </form>
                </div>      
            </div>
        </section>
    </div>
</div>
<!-- pending cancel modal-->


        
     <!-- button -->
        <a href="#popup" style="display:none;" class="btn btn-custom waves-effect waves-light m-r-5 m-b-10" data-animation="fadein" data-plugin="custommodal"
            data-overlaySpeed="200" data-overlayColor="#36404a">Fade in</a>
     <!-- button -->     
                    
     <!-- Modal -->
        <div id="popup" class="modal-demo">
            <button type="button" class="close" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title">CANCEL PLAN</h4>
            <div class="custom-modal-text">
                Do you wish to Cancel VTSSF: VOBL >> VIDP Plan?
            </div>
            <div class="newbtnv1 b-radius-5" style="margin-bottom: 10px;">
                <input type="submit" class="btn btn_appearance" name="" value="Yes">
            </div>
        </div>
     <!-- Modal -->



<!-- preview modal-->
<div class="modal fade" id="navlog_preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container prvplan" role="document">
        <header class="popupHeader">
            <span class="header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>
        <section class="popupBody">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="modal_message"></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- preview modal-->
<!-- navlog_info modal-->
<div class="modal fade" id="navlog_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container prvplan" role="document">
        <header class="popupHeader">
            <span class="navlog_header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>
        <section class="popupBody">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="navlog_modal_message"></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- navlog_info modal-->

<!-- Table values modal-->
<div class="modal fade" id="tableview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog tableviewwidth" role="document">
        <div class="tableviewclass">
            <header class="popupHeader">
                <span class="header_title"></span>
                <span class="modal_close" data-dismiss="modal">
                    <i class="fa fa-times-circle"></i>
                </span>
            </header>
            <section class="popupBody">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="modal_message"></p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- Table values modal-->

<!-- cinform revise modal-->
<div class="modal fade" id="cnfrevise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" role="document">
        <header class="popupHeader">
            <span class="header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;">
                <p class="model_font"><span class="modal_message"></span></p>           
            </div>
            <div class="modal-footer" style="text-align:center;">
                <div class="row">
                   
                        <div class="col-md-12 ">            
                            <button type="button" data-url ="{{url('navlog_revice_time')}}" class="modal_btn_navlog navlog_confirm_revise newbtnv1" data-value="" id="confirm_revise">Yes</button>
                        </div>
                   
                </div>
            </div>  
        </section>
    </div>
</div>
<!-- cinform revise modal-->

<!-- send fic adc modal-->
<div class="modal fade" id="sendficadc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
    <div class="modal-dialog modal-container" role="document">
        <header class="popupHeader">
            <span class="header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;">
                <div class="row">
                    <div class="col-md-12">
                        <p class="model_font"><span class="modal_message"></span></p></div>
                </div>
                <div class="row" style="text-align:center;margin-top:10px">
                
                        <div class="col-md-12">
                            <button type="button" class="navlog_change_ficadc newbtnv1 modal_btn_navlog" data-value="" data-url="{{url('change_fic_adc')}}">Yes</button>
                        </div>
                    
                </div>
            </div>

        </section>
    </div>
</div>
<!-- send fic adc modal-->

<!-- change plan modal-->
<div class="modal fade" id="changeplan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" role="document">
        <header class="popupHeader" style="text-align: center;">
            <span class="header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>
        <section class="popupBody">                 
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="model_font chng-conf"><span class="modal_message"></span> </p></div>
                </div>
                        <div class="row" style="text-align: center;margin-top: 10px">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id" value="" />
                                    <button class="edit_navlog_plan modal_btn_navlog newbtnv1" type="button" >Yes</button>
                                </div>
                        </div>
            </div>      
        </section>  
    </div>
</div>

<!-- alert validation modal-->
<div class="modal fade" id="alert_validation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container prvplan" role="document">
        <header class="popupHeader">
            <span class="header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>
        <section class="popupBody">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="modal_message"></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- alert validation modal-->

<!-- change plan modal-->
<div class="modal fade" id="change_fpl_plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" role="document">
        <header class="popupHeader" style="text-align: center;">
            <span class="header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>
        <section class="popupBody">                 
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="model_font chng-conf"><span class="modal_message"></span> </p></div>
                </div>
                <div class="row">   
                    <div class="col-md-12">
                        <form  id="" method="post" >
                            <div class="row">
                                <div class="confrow">
                                    <div class="col-md-3 yesedit">
                                        <input type="hidden" name="id" id="fpl_id" value="" />
                                        <input type="hidden" name="encodedid" id="encodedid" value="" />
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <button class="btn process edit_full_plan newbtn_blackv1" type="button">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>      
        </section>  
    </div>
</div>
<!-- change plan modal-->