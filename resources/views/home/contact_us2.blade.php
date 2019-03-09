@extends('layouts.v_contactus_layout',array('1'=>'1'))
@section('content')
<div class="page" id="app">
    <style>
        .fa-spinner:hover{color: grey !important}
        .fa-spinner{color: #f1292b !important}
        /*===================================================================
                            Contact Us Page
    Author : Vivek Akkisani
    ===================================================================*/
        .cu-p-lr-0 {
            padding-left: 0px;
            padding-right: 0;
        }
        .contact-us-page {
            margin: 15px auto;
        }
        .contact-us-page h2 {
            font-size: 20px;
            line-height: normal;
            font-weight: bold;
            border-bottom: 1px dotted #999;
            padding-bottom: 5px;
            letter-spacing: 1px;

        }
        .cu-left {
            padding:0px;
        }
        .cu-contact-head {
            margin-bottom: 20px;
        }
        .cu-address {
            font-size: 13px;
            padding-left: 24px;
            color: #000000;
            position: relative;
            width: 54%;
            float: left;
            border-right: 1px solid #ccc;
        }
        .cu-address:before {
            content: '\f015';
            font-family: 'FontAwesome';
            font-size: 18px;
            position: absolute;
            top: -4px;
            left: 0;
            color: #999;
        }
        .cu-address-head {
            font-weight: bold;
	    color:#f1292b;
        }
        .cu-m-icon {
            color: #000000;
            font-size: 18px;
        }
        .cu-phone {
            position: relative;
            padding-left: 20px;
            font-size: 13px;
            color: #000000;
        }
        .cu-phone a{
            font-size:13px;
        }
        .cu-phone:before {
            content: '\f10b';
            font-family: 'FontAwesome';
            font-size: 22px;
            position: absolute;
            top: 1px;
            left: 1px;
            color: #000000;
            color: #999;
        }
        .cu-email {
            position: relative;
            padding-left: 20px;
            margin-top: 0px;
            font-size: 13px;
        }
        .cu-email a {
            color: #f1292b;
            font-size:13px;
            text-decoration:underline;
        }
        .cu-email a:hover {
            color: #f1292b;
        }
        .cu-email:before {
            content: '\f0e0';
            font-family: 'FontAwesome';
            font-size: 14px;
            position: absolute;
            top: 1px;
            left: 0px;
            color: #000000;
            color: #999;
        }
        .cu-contact-form form {
            width: 100%;
            float:left;
        }
        .cu-contact-form {
            padding-left:10px;
            width: 100%;
            float: left;
        }

        .cu-contact-form  h2{
            margin-bottom: 20px;
            /*margin-left: 20px;*/
        }
        .cu-mes-box {
            resize: none;
            min-height: 168px;
        }
        .cu-contact-form .form-group {
            width: 80%;
            float: left;
            position: relative;
        }
        .cu-input-boxes {
            border-radius: 0;
            border: none;
            border-bottom: 1px solid #b1b1b1;
            box-shadow: none;
        }
        .cu-error  {
            font-size: 10px;
            font-weight: normal;
            color: #f1292b;
            position: absolute;
            top: 0px;
            right: 5px;          
        }
        .cu-send-btn {
            /*            background: #f1292b;
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
                        background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
                        background: -moz-linear-gradient(top, #f1292b, #f37858);*/
            width: 66px;
            height: 32px;
            padding: 0;
            text-transform: none;
            font-weight: 500;
            font-size: 14px;
            margin-top: 15px;
            border:none;
        }
        #cu-success, #cu-error {
            display: none;
        }
        /*        .cu-map {
                    padding: 50px 10px 10px;
                }*/
        .cu-contact-form ::-webkit-input-placeholder { color: #b2b2b2 !important; text-align: left; text-transform: none; font-size: 14px; }
        .cu-contact-form :-moz-placeholder { color: #b2b2b2 !important; text-align: left; text-transform: none; font-size: 14px; }
        .cu-contact-form ::-moz-placeholder { color: #b2b2b2 !important; text-align: left; text-transform: none; font-size: 14px; }
        .cu-contact-form :-ms-input-placeholder { color: #b2b2b2 !important; text-align: left; text-transform: none; font-size: 14px; } 
        .cu-contact-form input[type=text]:focus, .cu-mes-box:focus {

            box-shadow: none;
        }
        #map {
            height:268px;
            background:#ccc;
            display:inline-flex;
            width: 100%;
        }
        .cu-bg-white {
            background: #ffffff;
            box-shadow: 0px 0px 3px 1px #999999;
        }

        div.dynamiclabel
        { 
            display: block;
            position: relative;
        }

        div.dynamiclabel label{ 
            position: absolute;
            color:#fff;
            font-size:11px;
            font-weight:normal;
            background: #333;
            border: 1px solid #333;
            border-radius: 2px;
            -webkit-border-radius:2px;
            -moz-border-radius:2px;
            -khtml-border-radius:2px;
            padding: 8px 7px;
            -webkit-backface-visibility: hidden;
            top: 10px;           
            -moz-transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            -webkit-transition: all 0.4s ease-in-out; 
            -o-transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            opacity: 0;
            z-index: -1;
            line-height: 0px;
        }


        div.dynamiclabel > *:focus{ 
            border-color:#f1292b;
        }
        div.dynamiclabel > *:focus + label{ 
            opacity: 1;
            z-index:100;
            top: -15px; 
        }
        [placeholder]:focus::-webkit-input-placeholder {
            transition: opacity 1s 1s ease; 
            opacity: 0;
        }
        @media (min-width:1200px) {
            .container {
                width: 1000px;
            }
        }
        .alert{
            padding: 5px !important;
        }
        .alert-success {
            font-size: 12px;
            background: #fff;
            color: #ff0000;
            border:none;
        }
        .cu-send-btn {
            margin-top: 0;
        }
        .has-error .form-control{
            border-color: #f1292b !important
        }

	#contact_us_form input[type='text'],#contact_us_form textarea{
	    text-transform: uppercase
	}
	#contact_us_form .email {
	    text-transform:lowercase !important;
	}

    </style>
    <script type="text/javascript">
        $(function () {
            $('.alpha_numeric').on('keypress', function (e) {
                var regex = new RegExp("^[a-zA-Z0-9]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });
        })
    </script>
    @include('includes.v_header',[])
    <section class="contact-us-page">
        <div class="container cu-bg-white">
            <div class="row">
                <div class="col-md-6">
                    <div class="cu-left">
                        <h2 class="cu-contact-head">Contact Us</h2>
                        <address class="cu-address">
                            <span class="cu-address-head">EFLIGHT</span><br>
                            <span>AGR Plaza, L-150,</span><br>
                            <span>5th Main, 6th Sector,</span><br>
                            <span>HSR Layout, Bangalore-560102</span>
                        </address>
                        <div style="float:left;width: 46%;padding-left: 10px;"> <p class="cu-phone"><a href="tel:+919449485515">+91 9449485515 <span style="font-weight:normal">(Support)</span> </a> <br><a href="tel:+919886454717">+91 9886454717 <span style="font-weight:normal">(Sales)</span></a> </p>
                            <p class="cu-email"><a href="mailto:info@eflight.aero">info@eflight.aero</a></p>        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="cu-map" style="
                         padding-bottom: 10px;
                         ">

                        <div id="map" style="
                             border: 1px solid #ccc;
                             ">
                            <iframe class="contactmap" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="{{url('app/map.html')}}" style="
                                    width: 100%;
                                    "></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cu-contact-form">
                        <h2>Write to Us</h2>
                        <form data-toggle="validator" @submit="vue_contact" onsubmit="return contact_validation()" action="{{url('/contact-us')}}" method="POST" id="contact_us_form" role="form" method="post"  autocomplete="off" novalidate="novalidate">
                            <div class="form-group">
                                <div class="col-sm-7 col-md-12 cu-p-lr-0 dynamiclabel">
                                    <input type="text" name="name" id="c_name" v-model="name" @focus="vue_name"  required="required" minlength="2" maxlength="20" placeholder="NAME" class="c_name form-control cu-input-boxes alpha_numeric text_uppercase">
                                    <label>Name</label>
                                    <div for="name" class="cu-error hidden" v-show="!name">Please Enter Your Name !</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-7 col-md-12 cu-p-lr-0 dynamiclabel">
                                    <input type="text" name="mobile_number" id="c_mobile_number" v-model="mobile_number" @focus="vue_mobile" value="" minlength="10" maxlength="10" required="" placeholder="MOBILE NUMBER" class="mobile_number mobile_val numeric form-control cu-input-boxes">
                                    <label>Mobile</label>
                                    <div for="mobile_number" v-show="!valid_mobile" class="cu-error hidden">Please enter your valid Mobile Number !</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-7 col-md-12 cu-p-lr-0 dynamiclabel">
                                    <input type="text" name="email" id="c_email" v-model="email" required=""  @focus="vue_email" minlength="8" maxlength="35" placeholder="EMAIL" class="email form-control cu-input-boxes">
                                    <label>Email</label>
                                    <div for="email" class="cu-error hidden" v-show="!valid_email">Please Enter valid your Email Address !</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-7 col-md-12 cu-p-lr-0 dynamiclabel">
                                    <textarea name="message" v-model="message" id="c_message" @focus="vue_message" required="required" minlength="2" placeholder="MESSAGE" maxlength="500" class="message form-control cu-mes-box cu-input-boxes alpha_numeric"></textarea>
                                    <label>Message</label>
                                    <div for="message" class="cu-error hidden" v-show="!message">Please Leave your Message !</div>
                                </div>
                            </div>
                            <div class="form-group" style=" margin-bottom: 0px;">
                                <button type="submit" name="" id="" class="newbtnv1 cu-send-btn">SEND</button>
                                @if(Session::get('success'))
                                <span class='alert alert-success'>
                                    <button type="button" class="close" data-dismiss="alert" data-dismiss="alert">x</button>
                                    {{Session::get('success')}}
                                </span>
                                @endif
                            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <input type="hidden" name="page" value="contact_us" />
                        </form>

                        <div id="cu-success">
                            <span class="green textcenter">
                                <p>Thank You for writing to us.<br> One of our Trip Support Specialist will get in touch shortly</p>
                            </span>
                        </div>
                        <div id="cu-error">
                            <span>
                                <p>Something went wrong, try refreshing and submit the form again.</p>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @include('includes.v_footer',[])
</div>
<script>
    new Vue({
        el: "#app",
        data: {
            name: '',
            mobile_number: '',
            email: '',
            message: '',
        },
        methods: {
            vue_contact: function (e) {
                var validation = true;

                if (this.name == '') {
//                    $("#name").next().next().removeClass("hidden");
                    validation = false;
                }
                if (this.mobile_number == '') {
//                    $("[name='mobile_number']").next().next().removeClass("hidden");
                    validation = false;
                }
                if (this.email == '') {
//                    $("[name='email']").next().next().removeClass("hidden");
                    validation = false;
                }
                if (this.message == '') {
//                    $("[name='message']").next().next().next().removeClass("hidden");
                    validation = false;
                }
                if (!validation) {
                    e.preventDefault();
                }
            },
            vue_name: function (e) {
                $(".c_name").css('border-color', '#f1292b');
            },
            vue_mobile: function (e) {
                $(".mobile_number").css('border', '#f1292b !important');
            },
            vue_email: function (e) {
                $(".email").css('border', '#f1292b !important');
            },
            vue_message: function (e) {
                $(".message").css('border', '#f1292b !important');
            },
        },
        computed: {
            valid_mobile: function () {
                if (this.mobile_number.length == 10) {
                    $("form#contact_us_form[name='mobile_number']").css('border-color', 'lightgrey');
                    return true;
                } else {
                    $("form#contact_us_form[name='mobile_number']").css('border-color', 'red');
                    return false;
                }
            },
            valid_email: function () {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(this.email);
            }
        },
    });
    function contact_validation() {
        var name = $("#c_name").val();
        var mobile_number = $("#c_mobile_number").val();
        var email = $("#c_email").val();
        var message = $("#c_message").val();
        var data_url = base_url + "/contact-us";
        var validation = true;
        if (name == '') {
            $("form#contact_us_form[name='name']").css('border-color', 'red');
            validation = false;
        } else {
            $("form#contact_us_form[name='name']").css('border-color', 'lightgrey');
        }
        if (email == '') {
            $("form#contact_us_form[name='email']").css('border-color', 'red');
            validation = false;
        } else {
            $("form#contact_us_form[name='email']").css('border-color', 'lightgrey');
        }

        if (message == '') {
            $("form#contact_us_form[name='message']").css('border-color', 'red');
            validation = false;
        } else {
            $("form#contact_us_form[name='message']").css('border-color', 'lightgrey');
        }
        if (!validation) {
            return false;

        }
//        if (validation) {	  
//            var data = {
//                name: 'name', 'email': email, 'mobile_number': mobile_number, 'message': message, 'page': 'contact_us'
//            }
//            $.ajax({
//                url: data_url,
//                type: 'POST',
//                data: data,
//                cache: false,
//                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
//                success: function (data, textStatus, jqXHR) {
//                    if (data.error == 1) {
//                        $("#error_message_forgot").html('<span style="color: #f1292b;">' + data.error_message + '</span>')
//                        $("#success_message_forgot").html('')
//                        return false;
//                    } else {
//                        $("#success_message_forgot").html('<span style="color: green;">' + data.success + '</span>')
//                        $("#error_message_forgot").html('')
//                    }
//                },
//                error: function (jqXHR, textStatus, errorThrown) {
//                    console.log(errorThrown)
//                    return false;
//                }
//
//            });
//        }


    }
</script>
@stop