@extends('layouts.backend_layout2',array('1'=>'1'))
@push('js')
<script src="{{url('app/js/sweet-alert.js')}}"></script>
<script src="{{url('app/js/jquery.sweet-alert.init.js')}}"></script>
@endpush
@push('css')
<link rel="stylesheet" href="{{url('app/css/sweet-alert.css')}}" />
@endpush
@section('content')
<link rel="stylesheet" href="{{url('app/new_temp/css/animate.css')}}">
<style>
    .textarea_updateuser {
        margin-top: 20px;
        margin-bottom:20px;
        resize: none;
        border-radius: 4px;
        border: 1px solid #555555;
        color:#888888;
        font-size:13px;
    }
    textarea:focus {
        border:red solid 1px ;
        box-shadow:none !important;
    }
    .form-control:focus {
        border-color: #f1292b;
    }
    .updateusers_heading {
        text-transform: uppercase;
        text-align: center;
        padding: 5px 0;
        font-weight: bold;
        color:#fff;
        background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9f9f9', endColorstr='#f9f9f9', GradientType=1 );
    }
    form#create_user_form{
        text-transform: uppercase;
    }
    .success{
        margin: 0 0 10px;
        width: 100%;
        text-align: center;
        color: #f1292b;
    }
    #create_user_form input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        font-size: 12px;
    }
    #create_user_form input::-moz-placeholder { /* Firefox 19+ */
        font-size: 12px;
    }
    #create_user_form input:-ms-input-placeholder { /* IE 10+ */
        font-size: 12px;
    }
    #create_user_form input:-moz-placeholder { /* Firefox 18- */
        font-size: 12px;
    }
    #create_user_form .form-control {
        font-size:13px;
        font-weight: bold;
    }
    #create_user_form .checkbox-inline {
        font-size:13px;
    }
    .checkbox-inline, .radio-inline {
        position: relative;
        display: inline-block;
        padding-left:36px;
        margin-bottom: 0;
        font-weight: 400;
        vertical-align: middle;
        cursor: pointer;
    }
    .checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
        margin-top: 0;
        margin-left: 18px;
    }
    .cust-container-v {
        padding-bottom: 0px;
    }
    /*@media (min-width:1200px) {
        #create_user_form .checkbox-inline+.checkbox-inline {
            margin-left: 40px;
        }
    }*/
    .cust-container-v{
        width:850px;
    }
    .hover_fpl:hover{
        color: #f1292b;
        font-weight: bold;
        font-size: 14px;
    }
    /*dropdown hpbp*/
    .dropdown2 dd, .dropdown2 dt, .dropdown2 ul { 
        margin:0px; 
        padding:0px; 
    }
    dl {
        margin-top: 0;
        margin-bottom: 0px;
    }
    .dropdown2 dd { position:relative; }
    .dropdown2 a, .dropdown2 a:visited { color:#000; text-decoration:none; outline:none;}
    .dropdown2 a:hover {
        color: #fff;
    }
    .cust-container-v{
        box-shadow: 0 0 3px 1px #8d8d8d;   
    }
    .dropdown2 dt a:hover { color:#000;}
    .dropdown2 dt a {display:block;border:1px solid #999;background: #fff url(../../media/images/arrow.png) no-repeat scroll right center;}
    .dropdown2 dt a span {cursor:pointer;font-size:13px;color: #999;font-weight: normal;padding-left: 10px;}
    .dropdown2 dd ul {z-index:3;background:#fff none repeat scroll 0 0; color:#C5C0B0; display:none;border: 2px solid #ccc;
                      left:0px; padding:0px 0px; position:absolute; top:2px;list-style:none;text-align:center;width: 252px;}
    .dropdown2 span.value { display:none;}
    .dropdown2 dd ul li a { display:block;font-size: 13px;text-align: left;padding-left: 8px;}
    .dropdown2 dd ul li a:hover { background:-webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));}
    /*.flightdate,.checkin_flightdate,.checkout_flightdate*/
    .white_bg{
        background-color: white !important;
    }  
    /*dropdown hpbp*/
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
    .btn:active:focus, .btn:focus{
        outline:none;
        color: #fff;
    }
    /*loader*/
    /*sweet-alert*/
    .sweet-alert p {
        font-size: 14px;
        line-height: 22px;
    }
    .sweet-alert .icon.success .placeholder {
        border: 4px solid rgba(62, 200, 69, 0.3);
    }
    .sweet-alert .icon.success .line {
        background-color: #3ec845;
    }
    .sweet-alert .icon.warning {
        border-color: #fbca35;
    }
    .sweet-alert .icon.info {
        border-color: #45b0e2;
    }
    .sweet-alert .btn-warning:focus,
    .sweet-alert .btn-info:focus,
    .sweet-alert .btn-success:focus,
    .sweet-alert .btn-danger:focus,
    .sweet-alert .btn-default:focus {
        box-shadow: none;
    }
    /*sweet-alert*/
    /*button shadow effect*/
    .btn-success {
        transition: all 0.25s ease;
        overflow: hidden;
        position: relative;
        display: inline-block;
        margin-bottom: 0;
        color: #fff;
        font-weight: 300;
        text-transform: uppercase;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        border: none;
        background: #F26232;
        background: linear-gradient(to top, #fa9b5b, #F26232);
        background: #f1292b;     
        background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
        background: -moz-linear-gradient(top, #f37858, #f1292b);
        z-index: 3;
        border-radius:6px;

    }
    .btn-success:hover:before {
        visibility: visible;
        width: 200%;
        left: -46%;
    }
    .btn-success:before {
        -webkit-transition: all 0.35s ease;
        -moz-transition: all 0.35s ease;
        -o-transition: all 0.35s ease;
        transition: all 0.35s ease;
        -webkit-transform: skew(45deg, 0);
        -moz-transform: skew(45deg, 0);
        -ms-transform: skewX(45deg) skewY(0);
        -o-transform: skew(45deg, 0);
        transform: skew(45deg, 0);
        -webkit-backface-visibility: hidden;
        content: '';
        position: absolute;
        visibility: hidden;
        top: 0;
        left: 50%;
        width: 0;
        height: 100%;
        background: #333;
        z-index: -1;
        color: #fff;
    }
    .btn-success:hover {
        color: #ffffff;
    }
    .popover {
        width: 250px;
        background-color: #333;
        border: #eeeeee solid 2px;
        font-family: 'pt_sansregular';
        margin-top: 0px;
        text-align: center;
        color: white;
    }
    .popover-content{
        padding:2px;
    }
    /*button shadow effect*/
    .sweet-alert h2{
        color: #777;
        font-size: 15px;
        margin-bottom: 25px;
    }
    .sweet-alert p {
        font-size: 22px;
        line-height: 22px;
        color: #000;
        font-weight: bold;
        margin-bottom: 30px;
    }
    .sweet-alert .icon.success{
        margin-bottom: 30px;   
    }
    .btn-default{
        float: left;
        margin-left: 25px; 
    }
    .btn-success{
        float: right;
        margin-right: 25px;     
    }
    .growl.growl-small {
        width: 189px;
    }
</style>
<div id="page" class="app">
    @include('includes.v_header',[])
    <div class="overlay">
        <img class="img_loader" src="{{url('media/images/loader.gif')}}"/>
    </div>
    <section>
        <div class="container cust-container-v">
            <div class="row">
                <div class="col-md-12 p-lr-0">
                    <p class="updateusers_heading">CREATE NEW USER</p>
                    <p class="success"><p id="success_msg" class="success animated  zoomIn custdelay hide" style="text-align: center;color:red">New user created successfully</p></p>
                </div>
            </div>
            <form data-toggle="validator" id="create_user_form"  name="create_user_form" @submit="add_users">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control text_uppercase alphabets_numeric_with_space" @keyup="v_name" autocomplete="off" v-model="name" id="name" name="name" placeholder="DISPLAY NAME"  data-toggle="popover" data-placement="top" maxlength="25">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" autocomplete="off" @keyup="v_email" id="email" v-model="email" name="email" placeholder="email" data-toggle="popover" data-placement="top" @blur="b_email" maxlength="50">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text"  class="form-control numeric" autocomplete="off" @keyup="v_mobile_number" v-model="user_mobile_number" id="user_mobile_number" minlength="10" maxlength="10" name="user_mobile_number" placeholder="mobile number" data-toggle="popover" data-placement="top">
                    </div>
                    <div class="col-md-4">
                        <!--<select name="user_role_select" id="user_role_select"  v-model="user_role" class="form-control">
                            <option selected disabled>--SELECT ROLE--</option>
                            <option value="4">USER</option>
                            <option value="3">OPERATOR ADMIN</option>
                            <option value="2">EFLIGHT OPS</option>                                       
                        </select>-->
                        <dl id="sample" class="dropdown2" data-toggle="popover" data-placement="top" data-toggle="popover" data-placement="top">
                            <dt><a style="padding:5px 0px 5px 0px;border-radius:4px;" href="javascript:void(0)" id="sample_agency"><span id="user_roles_value">SELECT ROLE</span></a></dt>
                            <dd>
                                <ul>
                                    <li class="user_roles"><a href="javascript:void(0)" value="4">USER</a></li>
                                    <li class="user_roles"><a href="javascript:void(0)" value="3">OPERATOR ADMIN</a></li>
                                    <li class="user_roles"><a href="javascript:void(0)" value="2">EFLIGHT OPS</a></li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text"  readonly="readonly"  class="form-control auto_email" autocomplete="off"  v-model="v_operator_email" id="operator_email" name="operator_email" placeholder="OPERATOR ADMIN EMAIL" data-toggle="popover" data-placement="top" maxlength="50">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text"  class="form-control text_uppercase auto_operator alphabets_numeric_with_space" autocomplete="off" @keyup="v_operator"  v-model="operator" id="operator" name="operator" placeholder="OPERATOR NAME" data-toggle="popover" data-placement="top" maxlength="50">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="password"  name="inputpassword" @keyup="v_password" id="inputpassword" autocomplete="off" class="form-control" v-model="inputpassword" placeholder="Password" maxlength="15" data-toggle="popover" data-placement="top">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="password"  name="confirm_password" @keyup="v_password_confirm" autocomplete="off" id="confirm_password" v-model="confirm_password" class="form-control" placeholder="Confirm Password" data-match="#inputpassword" data-match-error="Whoops, these don't match" maxlength="15" data-toggle="popover" data-placement="top"/>
                    </div>
                    <div class="col-md-2 form-group" style="padding-right:0;">
                        <input type="text"  name="total_crew" autocomplete="off" id="total_crew"  @keyup="v_crew" class="form-control numeric" placeholder="TOTAL CREW" disabled data-toggle="popover" v-model="total_crew" data-placement="top" maxlength="2" />
                    </div>
                    <div class="col-md-2">
                        <button style="width:106px;margin-left:6px;font-size: 15px;" id="create_user" type="submit" class="btn newbtnv1 form-control">CREATE</button>
                    </div>
                    <div class="col-md-4 form-group">
                        <textarea  required="" class="form-control text_uppercase alphabets_with_comma" autocomplete="off" v-model="user_callsigns" id="user_callsigns" placeholder="CALL SIGNS" @keyup="v_user_callsigns" @keypress="kp_user_callsigns"
                                   name="user_callsigns" data-toggle="popover" data-placement="top" ></textarea>
                    </div>
                    <div class="col-md-8" style="padding-top:10px;padding-bottom:4px;display: flex;">
                        <div class="">  
                            <label class="checkbox-inline hover_fpl" style="padding-left:22px;"><input name="is_fpl" id="is_fpl" v-model="is_fpl" type="checkbox" value=""><span>FPL</span></label>
                        </div>
                        <div class=""> 
                            <label class="checkbox-inline hover_fpl"><input name="is_notams" id="is_notams" v-model="is_notams" type="checkbox" value=""><span>NOTAMS</span></label>
                        </div>
                        <div class=""> 
                            <label class="checkbox-inline hover_fpl"><input name="is_weather" id="is_weather" v-model="is_weather" type="checkbox" value=""><span>WX</span></label>
                        </div>
                        <div class=""> 
                            <label class="checkbox-inline hover_fpl"><input name="is_lr" id="is_lr" type="checkbox" v-model="is_lr" value=""><span>LR</span></label>
                        </div>
                        <div class=""> 
                            <label class="checkbox-inline hover_fpl"><input name="is_fdtl" id="is_fdtl" v-model="is_fdtl" type="checkbox" value=""><span>FDTL</span></label>
                        </div>
                        <div class=""> 
                            <label class="checkbox-inline hover_fpl"><input name="is_navlog" id="is_navlog" v-model="is_navlog" type="checkbox" value=""><span>NAV LOG</span></label>
                        </div>
                        <div class=""> 
                            <label class="checkbox-inline hover_fpl"><input name="is_lnt" id="is_lnt" v-model="is_lnt" type="checkbox" value=""><span>L&T</span></label>
                        </div>
                        <div class=""> 
                            <label class="checkbox-inline hover_fpl"><input name="is_billing" id="is_billing" type="checkbox" value=""><span>Billing</span></label>
                        </div>
                    </div>
                    <div class="">
                        <input type="hidden" v-model="url" name="url" id="url" value="{{url('')}}">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                    </div>
                </div>
                <input type="hidden" name="user_role_id" id="user_role_id" />
            </form>
        </div>
    </section>
    @include('includes.v_footer',[])
</div>
<script>
$(document).ready(function () {

    $(document).on("keypress", ".alphabets_numeric_with_space", function (e) {
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode >= 48 && e.charCode <= 57) || (e.charCode > 96 && e.charCode < 123) || (e.charCode == 0) || (e.charCode == 32))
            return true;
        else
            return false;
    });
    $(document).on("keypress", ".alphabets_with_comma", function (e) {
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode == 0))
            return true;
        else
            return false;
    });
    $(".dropdown2 dt a").click(function () {
        $(".dropdown2 dd ul").toggle();
    });
    $(".dropdown2 dd ul li a").click(function () {
        var text = $(this).html();
        $(".dropdown2 dt a span").html("<b>" + text + "</b>");
        $(".dropdown2 dd ul").hide();
        $("#sample").popover('destroy');
        $("#sample_agency").css('border', '1px solid #999');
        if (text == 'OPERATOR ADMIN')
            $('#total_crew').attr("disabled", false);
        else {
            $('#total_crew').val('');
            $('#total_crew').attr("disabled", true);
        }
    });
    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }
    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdown2")) {
            $(".dropdown2 dd ul").hide();
        }
    });
    $(".user_roles").on('click', function () {
        var user_roles_value = $("#user_roles_value").text();
        if (user_roles_value == "USER") {
            user_roles_value = 4;
            $("#operator_email").removeAttr('readonly');
        } else if (user_roles_value == "OPERATOR ADMIN") {
            user_roles_value = 3;
            $("#operator_email").val('');
            $("#operator_email").attr('readonly', 'readonly');
        } else {
            user_roles_value = 2;
            $("#operator_email").val('');
            $("#operator_email").attr('readonly', 'readonly');
        }
        $("#user_role_id").val(user_roles_value);
    });

});
Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
new Vue({
    el: '.app',
    data: {
        name: '',
        user_mobile_number: '',
        email: '',
        v_operator_email: '',
        operator: '',
        inputpassword: '',
        url: '',
        v1_user: '',
        user_callsigns: '',
        confirm_password: '',
        total_crew: '',
        is_fpl: true,
        is_fdtl: false,
        is_navlog: false,
        is_lnt: false,
        is_runway: true,
        is_notams: true,
        is_weather: true,
        is_lr: true,
        user_role: "3",
        no: 5,
    },
    methods: {
        add_users: function (e) {

            var bool = true;
            var user_role_id = $("#user_role_id").val()
            e.preventDefault();
            if ($("#name").val() == "" || $("#name").val().length < 2)
            {
                $("#name").attr('data-content', 'Min. 2 & Max. 25 character allowed');
                $("#name").popover({trigger: 'hover'});
                $("#name").css('border', 'red solid 1px');
                bool = false;
            }
            if ($("#email").val() == "" || $("#email").val().length < 2)
            {
                $("#email").attr('data-content', 'Please enter valid email address');
                $("#email").popover({trigger: 'hover'});
                $("#email").css('border', 'red solid 1px');
                bool = false;
            } else
            {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                var validate_mail = emailReg.test($("#email").val());
                if (validate_mail == false) {
                    $("#email").attr('data-content', 'Please enter valid email address');
                    $("#email").popover({trigger: 'hover'});
                    $("#email").css('border', 'red solid 1px');
                    bool = false;
                }
            }

            if ($("#operator").val() == "" || $("#operator").val().length < 2)
            {
                $("#operator").attr('data-content', 'Min. 2 & Max. 50 character  allowed');
                $("#operator").popover({trigger: 'hover'});
                $("#operator").css('border', 'red solid 1px');
                bool = false;
            }
            if ($("#user_roles_value").text() == "SELECT ROLE")
            {
                $("#sample").attr('data-content', 'SELECT ROLE');
                $("#sample").popover({trigger: 'hover'});
                $("#sample_agency").css('border', 'red solid 1px');
                bool = false;
            } else if ($("#user_roles_value").text() == "OPERATOR ADMIN")
            {
                if ($("#total_crew").val() == "")
                {
                    $("#total_crew").attr('data-content', 'Min. 1 & Max. 2 digit  allowed');
                    $("#total_crew").popover({trigger: 'hover'});
                    $("#total_crew").css('border', 'red solid 1px');
                    bool = false;
                }

            }
            if ($("#inputpassword").val() == "" || $("#inputpassword").val().length < 6)
            {
                $("#inputpassword").attr('data-content', 'Min. 6 & Max. 15 character allowed');
                $("#inputpassword").popover({trigger: 'hover'});
                $("#inputpassword").css('border', 'red solid 1px');
                bool = false;
            }
            if ($("#confirm_password").val() == "" || $("#confirm_password").val().length < 6)
            {
                $("#confirm_password").attr('data-content', 'Min. 6 & Max. 15 character allowed');
                $("#confirm_password").popover({trigger: 'hover'});
                $("#confirm_password").css('border', 'red solid 1px');
                bool = false;
            } else if (($("#confirm_password").val() != $("#inputpassword").val()) && ($("#inputpassword").val().length >= 6) && ($("#confirm_password").val().length >= 6))
            {
                $("#confirm_password").attr('data-content', 'Password Not matched');
                $("#confirm_password").popover({trigger: 'hover'});
                $("#confirm_password").css('border', 'red solid 1px');
                bool = false;
            } else if (($("#confirm_password").val() == $("#inputpassword").val()) && ($("#inputpassword").val().length >= 6) && ($("#confirm_password").val().length >= 6))
            {
                $("#confirm_password").popover('destroy');
                $("#confirm_password").css('border', 'lightgrey solid 1px');
            }
            if (($("#user_callsigns").val() == "" || $("#user_callsigns").val().length < 5) && user_role_id != "2")
            {
                $("#user_callsigns").attr('data-content', 'Min. 5 character allowed');
                $("#user_callsigns").popover({trigger: 'hover'});
                $("#user_callsigns").css('border', 'red solid 1px');
                bool = false;
            } else if (user_role_id != "2")
            {
                var user_callsigns_split = $("#user_callsigns").val().replace(/\s/g, "").split(',');
                $.each(user_callsigns_split, function (key, val) {
                    if (val.length != 5) {
                        bool = false;
                        $("#user_callsigns").attr('data-content', 'Invalid Callsign');
                        $("#user_callsigns").popover({trigger: 'hover'});
                        $("#user_callsigns").css('border', 'red solid 1px');
                        bool = false;
                    }
                });
            }
        
            
             var userdata = $("#create_user_form").serializeArray();
                            var udata = {};
                            $(userdata).each(function (index, obj) {
                                udata[obj.name] = obj.value;
                            });
            
            $.get(base_url + "/Admin/get_user_data", udata, function (resp) {
               console.log(resp.count);
                if ($("#user_mobile_number").val() == "" || $("#user_mobile_number").val().length < 10)
                  {
                      $("#user_mobile_number").attr('data-content', 'Min. & Max. 10 digit allowed');
                      $("#user_mobile_number").popover({trigger: 'hover'});
                      $("#user_mobile_number").css('border', 'red solid 1px');
                      bool = false;
                  }else if(resp.result){
                      $("#user_mobile_number").attr('data-content', 'Mobile Number already exist');
                      $("#user_mobile_number").popover({trigger: 'hover'});
                      $("#user_mobile_number").css('border', 'red solid 1px');
                      bool = false;
                  }
                if (bool == false)
                return bool;
            
                
                            
            swal({
                title: "USER DETAILS ENTERED CORRECTLY",
                text: "DO YOU WISH TO PROCEED ?",
                type: "warning",
                showCancelButton: true,
                type: "success",
                        confirmButtonText: 'CREATE',
                confirmButtonClass: 'btn-success waves-effect waves-light',
                cancelButtonText: "CANCEL",
                closeOnConfirm: true,
                closeOnCancel: true
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $(".overlay").show();
                            var formdata = $("#create_user_form").serializeArray();
                            var data = {};
                            $(formdata).each(function (index, obj) {
                                data[obj.name] = obj.value;
                            });
                            var is_fpl = $("#is_fpl").is(":checked");
                            var is_fdtl = $("#is_fdtl").is(":checked");
                            var is_navlog = $("#is_navlog").is(":checked");
                            var is_lnt = $("#is_lnt").is(":checked");
                            var is_runway = $("#is_runway").is(":checked");
                            var is_notams = $("#is_notams").is(":checked");
                            var is_weather = $("#is_weather").is(":checked");
                            var is_lr = $("#is_lr").is(":checked");
                            var is_billing = $("#is_billing").is(":checked");
                            

                            var url = $("#url").val();
                            data['is_fpl'] = (is_fpl) ? 1 : 0;
                            data['is_fdtl'] = (is_fdtl) ? 1 : 0;
                            data['is_navlog'] = (is_navlog) ? 1 : 0;
                            data['is_lnt'] = (is_lnt) ? 1 : 0;
                            data['is_runway'] = (is_runway) ? 1 : 0;
                            data['is_notams'] = (is_notams) ? 1 : 0;
                            data['is_weather'] = (is_weather) ? 1 : 0;
                            data['is_lr'] = (is_lr) ? 1 : 0;
                            data['is_billing'] = (is_billing) ? 1 : 0;
                            var cv = this;
                            console.log("data ", data)
                            $.post(url + "/Admin/add_users", data, function (resp) {
                                cv.name = '';
                                cv.email = '';
                                cv.user_mobile_number = '';
                                cv.v_operator_email = '';
                                cv.operator = '';
                                cv.user_callsigns = '';
                                cv.inputpassword = '';
                                cv.confirm_password = '';
                                cv.user_role = "";
                                
                                $("#user_roles_value").text("SELECT ROLE");
                                $("#user_role_id").val("");

                                $("#name").val("");
                                $("#email").val("");
                                $("#user_mobile_number").val("");
                                $("#operator_email").val("");
                                $("#operator").val("");
                                $("#user_callsigns").val("");
                                $("#inputpassword").val("");
                                $("#confirm_password").val("");
                                $("#total_crew").val("");
                                // $(".overlay").hide(); 
                                setTimeout(function () {
                                    $(".overlay").hide();
                                    if (resp.success == "success") {
                                        $.growl({title: '', location: 'tc', size: 'large', message: 'New user created successfully'});
                                    } else {
                                        $.growl({title: '', location: 'tc', size: 'small', message: 'Some thing went wrong!'});
                                    }
                                }, 2000);
                            })
                        }
                    });
            
            });
            
        },
        v_name: function (e) {
            if (this.name != '' && this.name.length >= 2) {
                $("#name").popover('destroy');
                $("#name").css('border', 'lightgrey solid 1px');

            } else {
                $("#name").attr('data-content', 'Min. 2 & Max. 25 character allowed');
                $("#name").popover({trigger: 'hover'});
                $("#name").css('border', 'red solid 1px');
            }
        },
        v_email: function (e) {
            if (this.email != '' && this.email.length >= 2) {    //pending
                $("#email").popover('destroy');
                $("#email").css('border', 'lightgrey solid 1px')
            } else {
                $("#email").attr('data-content', 'Please enter valid email address');
                $("#email").popover({trigger: 'hover'});
                $("#email").css('border', 'red solid 1px')
            }
        },
        v_mobile_number: function (e) {
            if (this.user_mobile_number != '' && this.user_mobile_number.length == 10) {
                $("#user_mobile_number").popover('destroy');
                $("#user_mobile_number").css('border', 'lightgrey solid 1px');
            } else {
                $("#user_mobile_number").attr('data-content', 'Min. & Max. 10 digit allowed');
                $("#user_mobile_number").popover({trigger: 'hover'});
                $("#user_mobile_number").css('border', 'red solid 1px')
            }
        },
        v_operator: function (e) {
            if (this.operator != '' && this.operator.length >= 2) {
                $("#operator").popover('destroy');
                $("#operator").css('border', 'lightgrey solid 1px')
            } else {
                $("#operator").attr('data-content', 'Min. 2 & Max. 50 character allowed');
                $("#operator").popover({trigger: 'hover'});
                $("#operator").css('border', 'red solid 1px')
            }
        },
        v_user_callsigns: function (e) {
            if (this.user_callsigns != '' && this.user_callsigns.length >= 5) {
                $("#user_callsigns").popover('destroy');
                $("#user_callsigns").css('border', 'lightgrey solid 1px ')
            } else {
                $("#user_callsigns").attr('data-content', 'Min. 5 character allowed');
                $("#user_callsigns").css('border', 'red solid 1px');
                $("#user_callsigns").popover({trigger: 'hover'});

            }
        },
        kp_user_callsigns: function (e) {
            if (this.user_callsigns.length == 0)
                this.no = 5;
            if (this.user_callsigns.length % this.no == 0) {
                if (this.user_callsigns.length != 0)
                {
                    this.no = this.no + 6;
                    this.user_callsigns = this.user_callsigns + ",";
                    console.log(this.user_callsigns)
                    $("#user_callsigns").val(this.user_callsigns);
                }
            }
        },
        v_password: function (e) {
            if (this.inputpassword != '' && this.inputpassword.length >= 6) {
                $("#inputpassword").popover('destroy');
                $("#inputpassword").css('border', 'lightgrey solid 1px')
            } else {
                $("#inputpassword").attr('data-content', 'Min. 6 & Max. 15 character allowed');
                $("#inputpassword").popover({trigger: 'hover'});
                $("#inputpassword").css('border', 'red solid 1px')
            }
        },
        v_password_confirm: function (e) {
            if (this.confirm_password != '' && this.confirm_password.length >= 6) {
                $("#confirm_password").popover('destroy');
                $("#confirm_password").css('border', 'lightgrey solid 1px')
            } else {
                $("#confirm_password").attr('data-content', 'Min. 6 & Max. 15 character allowed');
                $("#confirm_password").popover({trigger: 'hover'});
                $("#confirm_password").css('border', 'red solid 1px')
            }
        },
        v_crew: function (e) {
            if (this.total_crew != '' && this.total_crew.length >= 1) {
                $("#total_crew").popover('destroy');
                $("#total_crew").css('border', 'lightgrey solid 1px');
            } else {
                $("#total_crew").attr('data-content', 'Min. 1 & Max. 2 digit allowed');
                $("#total_crew").popover({trigger: 'hover'});
                $("#total_crew").css('border', 'red solid 1px');
            }
        },
        b_email: function (e) {
            if (this.email.length > 1)
            {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                var validate_mail = emailReg.test(this.email);
                if (validate_mail == false) {
                    $("#email").attr('data-content', 'Please enter valid email address');
                    $("#email").popover({trigger: 'hover'});
                    $("#email").css('border', 'red solid 1px')
                    bool = false;
                }
            }
        }

    }
});
$(function () {
    $(".auto_operator").autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                type: "GET",
                url: base_url + "/Admin/user/auto_operator",
                dataType: "json",
                data: {
                    term: request.term
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {

            } else {

            }
        }
    });

    $(".auto_email").autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                type: "GET",
                url: base_url + "/Admin/user/auto_email",
                dataType: "json",
                data: {
                    term: request.term
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {

            } else {

            }
        }
    });

//        $("#user_role_select").on('change', function () {
//            var value = $(this).val();
//            if (value != 4) {
//                $("#operator_email").attr('readonly', 'readonly');
//            } else {
//                $("#operator_email").removeAttr('readonly');
//            }
//        })
})
</script>
@stop