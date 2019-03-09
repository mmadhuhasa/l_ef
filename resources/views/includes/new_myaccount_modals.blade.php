<!-- cancel modal-->
<div class="modal fade" id="cancel_plan"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" role="document">
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
                        <p class="model_font"><span id="modal_message" class="modal_message"></span></p>	
                    </div>
                </div>
                <div class="row">
                    <form action="#" id="" >
                        <div class="confrow">
                            <div class="col-md-3 yesedit">
                                <button type="button" class="process btn btn_secondary cancel_plan newbtn_blackv1"  data-url="{{url('new_fpl/fpl_cancel')}}">Yes</button>
                            </div>
                        </div>
                    </form>
                </div>		
            </div>

        </section>
    </div>
</div>
<!-- cancel modal-->

<!-- preview modal-->
<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
            <div class="modal-body">
                <p class="model_font"><span class="modal_message"></span></p>			
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="confrow">
                        <div class="col-md-3 yesedit">			  
                            <button type="button" data-url ="{{url('new_fpl/revice_time')}}" class="btn process confirm_revise newbtn_blackv1" data-value="" id="confirm_revise">Yes</button>
                        </div>
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
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="model_font"><span class="modal_message"></span></p></div>
                </div>
                <div class="row">
                    <div class="confrow">
                        <div class="col-md-3 yesedit">
                            <button type="button" class="btn process change_ficadc newbtn_blackv1" data-value="" data-url="{{url('new_fpl/change_fic_adc')}}">Yes</button>
                        </div>
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
                <div class="row">	
                    <div class="col-md-12">
                        <form  id="" method="post" >
                            <div class="row">
                                <div class="confrow">
                                    <div class="col-md-3 yesedit">
                                        <input type="hidden" name="id" id="id" value="" />
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

<!--Fdtl Popup-->
<div id="fdtl_popup_modal" class="modal fade fdtl_modal" style="display:none;">
    <div class="modal-dialog modal-container">
        <header class="popupHeader"> 
            <span class="header_title" id="fdtl_text"></span>
            <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
        </header>
        <section class="popupBody editbody">
            <div class="" id="fdtl_app">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="fdtl_success"></div>
                        <form id="fdtl_popup_form" name="fdtl_popup_form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group dynamiclabel">
                                        <input type="text" id="chocks_on" onkeyup="this.value = time_minmax(this.value, 0, 2359)" name="chocks_on" maxlength="4" class="numeric form-control" placeholder="chocks on">
                                        <label>CHOCKS ON</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group dynamiclabel">
                                        <input type="text" id="landing_time" onkeyup="this.value = time_minmax(this.value, 0, 2359)" name="landing_time" maxlength="4" class="numeric form-control" placeholder="landing time">
                                        <label>LANDING TIME</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group dynamiclabel">
                                        <input type="text" id="chocks_off" onkeyup="this.value = time_minmax(this.value, 0, 2359)" name="chocks_off" maxlength="4" class="numeric form-control" placeholder="chocks off">
                                        <label>CHOCKS OFF</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group dynamiclabel">
                                        <input type="text" id="airborne_time" name="airborne_time" onkeyup="this.value = time_minmax(this.value, 0, 2359)" maxlength="4" class="numeric form-control" placeholder="airborne time">
                                        <label>AIRBORNE TIME</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 p-l-0">
                                <button type="button" class="btn newbtn_blackv1">Edit</button>
                            </div>
                            <div class="col-md-offset-6 col-md-3">
                                <button type="button" @click="fdtl_info" class="btn newbtnv1">Save</button>
                            </div>

                            <div>
                                <input type="hidden" id="fdtl_departure_aerodrome" name="fdtl_departure_aerodrome" />
                                <input type="hidden" id="fdtl_destination_aerodrome" name="fdtl_destination_aerodrome" />
                                <input type="hidden" id="fdtl_aircraft_callsign" name="fdtl_aircraft_callsign" />
                                <input type="hidden" id="fdtl_date_of_flight" name="fdtl_date_of_flight" />
                                <input type="hidden" id="fdtl_id" name="fdtl_id" />
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>

<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
    new Vue({
        el: "#fdtl_app",
        data: {aircraft_callsign: ''},
        methods: {
            fdtl_info: function (e) {
                e.preventDefault();
                var data_url = base_url + "/api/fpl/fdtlpopup";

                console.log('HIIII', data_url)

                var formdata = $("form#fdtl_popup_form").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });

                $(".fdtl_success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Please wait ...</span>');

                this.$http.post(data_url, data).then(function (data) {
                    if (data.body.STATUS_CODE == 0) {
                        $(".fdtl_success").html('<p class="" style="text-align: center;color:red">' + data.body.STATUS_DESC + '</p>');
                    }
                    if (data.body.STATUS_CODE == 1) {
                        $(".fdtl_success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:green">' + data.body.STATUS_DESC + '</p>');
                    }
                })
            },
        }
    });
</script>

