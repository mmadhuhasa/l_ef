@extends('layouts.check_quick_plan_layout',array('1'=>'1'))

@section('content')
<div class="page" id="quick_app">
    <style>
        .new_fpl_heading,.search_heading {
            margin-bottom:20px;text-align: center;padding: 7px 0;font-weight: 600;font-size: 15px;color:#fff;
            font-family:'pt_sansregular', sans-serif;background: #a6a6a6;
            background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
        }
        .search_heading {margin-bottom:5px;text-transform: uppercase; padding: 15px 0px 15px 0px;}
        .mainwrapper{
            width:1000px;
            margin:0 auto;
        }
        .subwrapper{
            box-shadow: 3px 3px 12px 0px #999;
            padding-left: 0;
            padding-right: 0;
            margin-top:20px;
            margin-bottom: 30px;
            background: white;
        }
        .columnrow{
            box-shadow: 0 6px 8px 0px #a7a7a7;
            margin: 0;
        }
        .failedimg_wrapper{
            padding-left: 0; 
        }
        .imagefailed{
            margin-left:20px;
        }
        .sorry{
            color:#000;
            font-weight: bold;
            font-size: 23px;
            margin-top:26px;
            margin-bottom: 8px;
            text-align: center
        }
        .verify_wrapper{
            font-style: italic;
            font-size: 14px;
            font-weight: bold;
        }
        .info_failed_wrapper{
            padding-right: 0; 
        }
        .amount{
            color: #f1292b;
            font-style: normal;
        }
        .order_number{
            font-style: normal;
            text-decoration: underline;
            color: #0000ff;
        }
        .amount_words{
            margin-right: 5px; 
        }
        .or_wrapper{
            font-style: italic;
            font-weight:bold;
            margin:8px 0px 8px 0px;
            font-size: 14px;
        }
        .wrongcard_wrapper{
            font-style: italic;
            font-weight:bold;
            font-size: 14px; 
        }
        .ifyouhave_any{
            margin:45px 0px 5px 0px;
        }
        .contact_us{
            font-size: 13px;
            margin-left: 10%;
            color: #777;
            font-style: italic;
        }
        .clickhere{
            text-decoration: underline;
            color: #0000ff;
        }
        .emailed{
            font-style: italic;
            font-size: 14px;
            color: #777;
            font-weight: bold;
        }
        .order_wrapper{
            color:#000;
            font-weight:bold;
            font-size:15px;
            margin-top: 15px;
        }
        .amountpaid_wrapper{
            font-size: 15px;
            font-weight: bold;
            margin: 2px 0px 2px 0px;
        }
        .amount_paid{
            color:#f1292b;
        }
        .towards_wrapper{
            font-size: 15px;
            font-weight: bold;
            color:#4c4c4c;
        }
        .amountpaid_success_words{
            color: #4c4c4c; 
        }
        .towards_span{
            color:#000;
        }
        .logbtn.focus, .logbtn:focus, .logbtn:hover {
            background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b))
        }
        /*saicharan css starts here*/
        .mainrow{
            margin-bottom: 10px;  
        }
        .maincontainer{
            background: #fff;
            box-shadow: 1px 1px 8px 1px #afafaf;
            border-radius: 5px;
            width:425px;
        }
        .welcomep{
            text-align:center;
            font-weight:bold;
        }
        .selectservices{
            color:#696969;
            font-style:italic;
            font-size:14px;
            text-align: center;
        }
        .selectwrapper{
            margin-top:7%;
        }
        .welcomewrapper{
            margin-top: 15px; 
        }
        /*check box starts here*/
        .checkbox {
            padding-left: 20px;
        }
        .checkbox label {
            display: inline-block;
            padding-left: 5px;
            position: relative;
            line-height: 18px;
            font-size: 13px;
        }
        .checkbox label:hover{
            color:#f1292b;
            font-weight:bold;
            font-size: 15px;
        }
        .checkbox label::before {
            -o-transition: 0.3s ease-in-out;
            -webkit-transition: 0.3s ease-in-out;
            border-radius: 2px;
            border: 2px solid #cccccc;
            content: "";
            display: inline-block;
            height: 16px;
            left: 0;
            margin-left: -20px;
            position: absolute;
            transition: 0.3s ease-in-out;
            width: 16px;
            outline: none !important;
        }
        .checkbox label::after {
            color: #555555;
            display: inline-block;
            font-size: 10px;
            height: 16px;
            left:1px;
            margin-left: -20px;
            padding-left: 2px;
            position: absolute;
            top: 0;
            width: 16px;
        }
        .checkbox input[type="checkbox"] {
            cursor: pointer;
            opacity: 0;
            z-index: 1;
            outline: none !important;
        }
        .checkbox input[type="checkbox"]:disabled + label {
            opacity: 0.65;
        }
        .checkbox input[type="checkbox"]:focus + label::before {
            outline-offset: -2px;
            outline: none;
        }
        .checkbox input[type="checkbox"]:checked + label::after {
            content: "\f00c";
            font-family: 'FontAwesome';
        }
        .checkbox input[type="checkbox"]:disabled + label::before {
            background-color: #eeeeee;
            cursor: not-allowed;
        }
        .checkbox.checkbox-circle label::before {
            border-radius: 50%;
        }
        .checkbox.checkbox-circle label::after {
            padding-left: 2px;
        }
        .checkbox.checkbox-circle.checkbox-inline label::after {
            padding-left: 3px;
        }
        .checkbox.checkbox-inline {
            margin-top: 0;
        }
        .checkbox.checkbox-inline label::after {
            left: 1px;
        }
        .checkbox.checkbox-single label {
            height: 17px;
        }
        .checkbox-custom input[type="checkbox"]:checked + label::before {
            background-color: #f1292b;
            border-color: #f1292b;
        }
        .checkbox-custom input[type="checkbox"]:checked + label::after {
            color: #ffffff;
        }
        .checkbox-primary input[type="checkbox"]:checked + label::before {
            background-color: #4667cc;
            border-color: #4667cc;
        }
        .checkbox-primary input[type="checkbox"]:checked + label::after {
            color: #ffffff;
        }
        /*check box ends here*/
        .handlingwrapper{
            padding-left:0;
        }
        .btnstyleotp{
            width: 95px;
            font-weight: bold;
        }
        .lastwrapper{
            margin: 12px 0px 0px 0px;
            padding-left:0px;
        }
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
            background-color: #eee;
            opacity: 1;
            cursor: not-allowed;
        }
        .checkbox, .radio{
            margin-bottom:0px;
        }
        .otpwrapper{
            text-align:center;
            margin-top:0px;
        }
        .otptext{
            color: #696969;
            font-style: italic;
            font-size: 14px;
            font-weight: bold; 
        }
        /*saicharan css ends here*/
        /*tooltip*/
        .tooltip_cancel_position, .tooltip_fpl_position1,.tooltip_fpl_position2, .tooltip_fpl_position, .tooltip_info_position, .tooltip_revise_position,.tooltip_change_position,.tooltip_revise_dbl_position, .tooltip_dept_position, .tooltip_dest_position, .tooltip_pdf_position, .tooltip_notam_position, .tooltip_wx_position, .tooltip_revise_dbl_position_valid, .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year, .tooltip_wx, .tooltip_tripkit  {
            position: absolute;top: -25px;left: 45px;padding: 3px 11px;color: #eee;border-radius: 4px;visibility: hidden;font-size: 10px;font-weight: normal;
            box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20}
        .tooltip_cancel:hover .tooltip_cancel_position, .tooltip_revise_valid:hover .tooltip_tri_shape_valid, .tooltip_revise_valid:hover .tooltip_revise_dbl_position_valid, .tooltip_cancel:hover .tooltip_fpl_position1, .tooltip_cancel:hover .tooltip_fpl_position2 ,.tooltip_cancel:hover .tooltip_fpl_position, .tooltip_cancel:hover .tooltip_info_position,.tooltip_cancel:hover .tooltip_revise_position,.tooltip_cancel:hover .tooltip_change_position, .tooltip_revise_dbl:hover .tooltip_revise_dbl_position, .tooltip_cancel:hover .tooltip_dept_position, .tooltip_cancel:hover .tooltip_dest_position, .tooltip_cancel:hover .tooltip_pdf_position, .tooltip_cancel:hover .tooltip_notam_position, .tooltip_cancel:hover .tooltip_wx_position, .tooltip_revise_dbl:hover .tooltip_tri_shape, .stats_fixed_wing:hover .tooltip_fixed_wing, .stats_heli:hover .tooltip_heli,.stats_month:hover .tooltip_month, .stats_year:hover .tooltip_year,.stats_wx:hover .tooltip_wx, .stats_tripkit:hover .tooltip_tripkit {
            visibility: visible;
        }
        .tooltip_revise_dbl:hover .tooltip_tri_shape_valid, .tooltip_revise_dbl:hover .tooltip_revise_dbl_position_valid{visibility: hidden;}
        .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year, .tooltip_wx, .tooltip_tripkit {top:-31px;left:-22px;font-size: 12px;text-transform: uppercase;}
        .tooltip_tri_shape, .tooltip_tri_shape1, .tooltip_tri_shape2, .tooltip_tri_shape3, .tooltip_tri_shape4, .tooltip_tri_shape5, .tooltip_tri_shape6, .tooltip_tri_shape7, .tooltip_tri_shape8, .tooltip_tri_shape9, .tooltip_tri_shape10, .tooltip_tri_shape11, .tooltip_tri_shape12, .tooltip_tri_shape_valid, .tooltip_trishape_01, .tooltip_trishape_02, .tooltip_trishape_03, .tooltip_trishape_04, .tooltip_trishape_05, .tooltip_trishape_06 {
            width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-top: 6px solid #333;position: absolute;top: -5px;right: 21px;z-index: 99999;visibility: hidden;}
        .tooltip_tri_shape3 {right:18px;}
        .tooltip_cancel:hover .tooltip_tri_shape1, .tooltip_cancel:hover .tooltip_tri_shape2,.tooltip_cancel:hover .tooltip_tri_shape3, .tooltip_cancel:hover .tooltip_tri_shape4, .tooltip_cancel:hover .tooltip_tri_shape5, .tooltip_cancel:hover .tooltip_tri_shape6, .tooltip_cancel:hover .tooltip_tri_shape7, .tooltip_cancel:hover .tooltip_tri_shape8, .tooltip_cancel:hover .tooltip_tri_shape9, .tooltip_cancel:hover .tooltip_tri_shape10, .tooltip_cancel:hover .tooltip_tri_shape11, .tooltip_cancel:hover .tooltip_tri_shape12, .stats_fixed_wing:hover .tooltip_trishape_01, .stats_heli:hover .tooltip_trishape_02,.stats_month:hover .tooltip_trishape_03, .stats_year:hover .tooltip_trishape_04,.stats_wx:hover .tooltip_trishape_05, .stats_tripkit:hover .tooltip_trishape_06  {
            visibility: visible;
        }
        .tooltip_trishape_01, .tooltip_trishape_02, .tooltip_trishape_03, .tooltip_trishape_04, .tooltip_trishape_05, .tooltip_trishape_06 {
            right:57px;
        }
        /*tooltip*/
        #timer{
            color:#f1292b;
        }
        /*loader*/
        .overlay {
            background: #e9e9e9;
            display: none;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0.5;
            z-index: 1000;
        }
        .img_loader{
            position: fixed;left: 50%;top:50%; 
        }
        /*loader*/
    </style>
    @include('includes.new_header',[])
    <!--loader-->
    <div class="overlay">
        <img class="img_loader" src="../media/images/loader.gif"/>
    </div> 
    <!--loader-->
    <div class="row mainrow">
        <div class="container maincontainer">
            <div class="col-md-12 welcomewrapper">
                <p class="welcomep">WELCOME TO BILL PAYMENT</p>
            </div>
            <div class="col-md-12 selectwrapper">
                <p class="selectservices">Please select services for which payment is to be processed</p>
            </div>
            <div class="col-md-12">
                <div class="col-md-1" style="width: 15%;"></div>
                <div class="col-md-3">
                    <div class="checkbox checkbox-custom checkbox-circle m-b-15">
                        <input id="fuelcheck" data-value="fuel" class="billpaychecks" type="checkbox">
                        <label for="fuelcheck" class="fuelcheck" for="checkbox01" >FUEL</label>
                    </div> 
                </div>
                <div class="col-md-3 handlingwrapper">
                    <div class="checkbox checkbox-custom checkbox-circle m-b-15">
                        <input id="handlingcheck" data-value="handling" id="checkbox08"  class="billpaychecks" type="checkbox">
                        <label for="handlingcheck" class="handlingcheck" for="checkbox08">HANDLING</label>
                    </div> 
                </div>
                <div class="col-md-3">
                    <div class="checkbox checkbox-custom checkbox-circle m-b-15">
                        <input id="hotelcheck" data-value="hotel" class="billpaychecks" type="checkbox">
                        <label for="hotelcheck" class="hotelcheck" for="checkbox08">HOTEL</label>
                    </div> 
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-1" style="width:30%;"></div>
                <div class="col-md-3">
                    <div class="checkbox checkbox-custom checkbox-circle m-b-15">
                        <input id="cabcheck" data-value="cab" class="billpaychecks" type="checkbox">
                        <label for="cabcheck" class="cabcheck" for="checkbox08">CAB</label>
                    </div> 
                </div>
                <div class="col-md-3 handlingwrapper">
                    <div class="checkbox checkbox-custom checkbox-circle m-b-15">
                        <input id="misccheck"  data-value="misc" class="billpaychecks" type="checkbox">
                        <label for="misccheck" class="misccheck" for="checkbox08">MISC</label>
                    </div> 
                </div>
                <div class="col-md-1" style="width: 15%;"></div>
            </div>
            <div class="col-md-12 lastwrapper">
                <div class="col-md-4">
                    <div class="newbtnv1 b-radius-5">
                        <input disabled="disabled" id="send_otp" style="cursor:not-allowed" type="submit" @click="send_otp" class="btn btn_appearance btnstyleotp" value="SEND OTP" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group stats_month">
                        <input  id="otp"  type="text" value="" maxlength="6" class="text-center font-bold form-control" placeholder="ENTER OTP" disabled="" maxlength="6">
                        <div style="display:none" id="otp_popup"><span  class="tooltip_month Thismonthtotalplans_body">Please enter correct OTP</span>
                            <span class="tooltip_trishape_03 Thismonthtotalplans_shape"></span></div>
                            <div style="display:none" id="valid_popup"><span  class="tooltip_month Thismonthtotalplans_body">ENTERED OTP IS EXPIRED</span>
                            <span class="tooltip_trishape_03 Thismonthtotalplans_shape"></span></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="newbtn_black b-radius-5">
                        <input type="submit" @click="otp_login" id="otp_login" class="btn btn_appearance btnstyleotp" value="LOG IN" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-12 otpwrapper">
                <span class="success"></span>
                <span class="otptext" style="display: none">
                    OTP send to registered email address and will expire in <span style="color: #f1292b" id="timer"></span> seconds.
                </span>
            </div>

        </div>
    </div>
    @include('includes.new_footer',[])
</div>
<script>
    $("#otp").keyup(function () {
        var otp = $(this).val().length;
        if (otp == 6)
            $("#otp_login").removeAttr("disabled");
    });
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
    new Vue({
        el: "#quick_app",
        data: {
        },
        methods: {
            send_otp: function (e) {
                $('.overlay').css('height',$(document).height());
                $(".overlay").show();
                e.preventDefault();
                var data_url = base_url + "/billing/send_otp";
                var formdata = $("#send_otp").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                console.log(data);
                $("#send_otp").attr("disabled", "disabled").css("cursor", "not-allowed");
                // $(".success").html('<span><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        //$(".overlay").hide();   
                        setTimeout(function () {
                            $(".overlay").hide();
                            $(".success").html('');
                            $("#timer").text(300);
                            $(".otptext").show();
                            $("#otp").removeAttr('disabled');
                            $("#otp").removeAttr('readonly');
                            var str = setInterval(timer, 1000);
                            function timer() {
                                var timer = $("#timer").text();
                                timer = parseInt(timer);
                                timer = timer - 1;
                                $("#timer").text(timer);
                                if (timer <= 0) {
                                    $(".otptext").hide();
                                    $("#send_otp").removeAttr("disabled").css("cursor", "pointer");
                                    clearInterval(str);
                                }
                            }
                        }, 1000);
                    }
                });
            },
            otp_login: function (e) {
                $('.overlay').css('height',$(document).height());
                $(".overlay").show();
                var otp = $("#otp").val();
                var data_url = base_url + "/billing/check_otp";
                var data = {'otp': otp};
                if (otp.length < 6) {

                    $(".overlay").hide();
                    return false;
                }
                // $(".success").html('<span><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    console.log('data.body ', data.body);
                    var fuelcheck = $("#fuelcheck").is(":checked");
                    var handlingcheck = $("#handlingcheck").is(":checked");
                    var hotelcheck = $("#hotelcheck").is(":checked");
                    var cabcheck = $("#cabcheck").is(":checked");
                    var misccheck = $("#misccheck").is(":checked");

                    if (data.body) {
                        if (!data.body.is_otp_valid || !data.body.is_valid) {
                            console.log("data.body ",data.body)
                            if (data.body.is_otp_valid && !data.body.is_valid) {
                                $("#valid_popup").show();
                                 $("#otp_popup").hide();
                            } else {
                                $("#otp_popup").show();
                                $("#valid_popup").hide();
                            }
                            $("#otp").css("border", "#f1292b solid 1px");

                            setTimeout(function () {
                                $(".overlay").hide();
//                             $(".success").html('<span style="color:red">WRONG OTP ENTERED</span>');
                            }, 1000);
                            // $(".success").html('<span style="color:red">WRONG OTP ENTERED</span>');
                        } else {
                            $("#otp").css("border", "lightgrey solid 1px");
                            var url = base_url + "/billing/process?fuel=" + fuelcheck + '&handling=' + handlingcheck + '&hotel=' + hotelcheck + '&cab=' + cabcheck + '&misc=' + misccheck;
                            // $(".overlay").hide();
                            setTimeout(function () {
                                $(".overlay").hide();
//                                window.location = url;
                                var data = {
                                    "_token": $('meta[name="_token"]').attr('content'),
                                    "fuel": fuelcheck,
                                    "handling": handlingcheck,
                                    "hotel": hotelcheck,
                                    "cab": cabcheck,
                                    "misc": misccheck,
                                };
                                $.redirect(base_url + '/billing/process', data, 'POST');
                            }, 1000);

                        }
                    }
                });
            }
        }
    });
    function hidemsg() {
        setTimeout(function () {

            $(".overlay").hide();
        }, 2000);
    }
    $(function () {
        $(".billpaychecks").on('click', function () {
            var data_value = $(this).attr("data-value");
            var checks = $('#' + data_value + "check").is(":checked");
            var checks_count = $(":checkbox:checked").length;

            if (checks_count > 0) {
                $("#send_otp").removeAttr("disabled").css("cursor", "pointer");
            } else {
                $("#send_otp").attr("disabled", "disabled").css("cursor", "not-allowed");
            }
            if (checks) {
                $('.' + data_value + "check").css("color", "#f1292b").css("font-weight", "bold");
            } else {
                $('.' + data_value + "check").css("color", "#000").css("font-weight", "normal");
            }
        });

        $("#otp").on('keyup', function () {
            var otp = $("#otp").val();
            console.log('hhh ', otp)
            if (otp.length < 6) {
                $("#otp").css("border", "#f1292b solid 1px");
            } else {
                $("#otp").css("border", "lightgrey solid 1px");
            }
        });


    })

</script>
@stop