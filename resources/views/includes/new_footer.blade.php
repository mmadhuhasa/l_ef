<!--========================================================
                              FOOTER
    =========================================================-->
<style>
     input {
      outline:none;
     }
    .border_red{
       border-color: red !important;
    }
    #captcha_text{
           display: block;
            width: 100%;
            margin: 0;
            -webkit-appearance: none;
            outline: none;
            font-size: 14px;
             padding: 2px 5px; 
            line-height: 20px;
            color: #666;
            background: transparent;
            border: none;
          /*border-bottom: 1px solid #C6C6C5;*/
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
          /*color: #ffffff !important;*/
            font-weight: normal;
            width: 75px;
          /*color: black;*/
            border: 1px solid #C6C6C5;
    }
    @media only screen and (min-width : 320px) and (max-width : 767px) {
        .f_c_message {
            margin-bottom:10px !important;
        }
        .btn_send_f01{
            position: absolute;
            top: -27px;
            right: -17px;
        }
        .xs-p-l-0 {
            padding-left: 0;
        }
        .footersection_tablet_align{
            text-align:center;
        }
        footer h4 {
        margin-bottom: 10px;
        }
        address {
        margin-bottom: 10px;
        }
        .footer_phone_sec {
        margin-top: 10px!important;
        margin-bottom: 10px!important;
        }
        .footer_plane {
        display: block!important;
        }
        .footer_plane {
        left:0px!important;
        }
    }

    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
        .email_main_box {
            width: 76%;
        }  
    }
    .footer_tick_box {
        margin-top: 12px;
    }
    .footer_phone_sec {
        margin-top: 29px;
        margin-bottom: 30px;
    }
    .footer_tick_box_label {
        display: inline !important;
        vertical-align: 2px;
        font-weight: normal;
        padding-left: 4px;
    }
    .footer_plane{
    position: absolute;
    left: -90px;
    top: -1em;
    opacity: 0.4;
    }
    @media screen and (max-width:479px) {
     .footer_plane{
         display:none;
     }   
    }
    @media screen and (max-width:767px) {
     .footer_plane{
         display:none;
     }   
    }
</style>

<footer>
    <section class="well-6 bg-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img id="footerBg" class="footer_plane" src="{{url('media/images/footer/airplane_edited.png')}}" alt="Plane" width="337" height="264">
                    <div class="col-md-3 col-sm-12 footersection_tablet_align footer-section" style="padding-left:0">
                        <h4>Get in Touch</h4>
                        <div class="contact-info2">
                            <address>L-150, 5th Main, 6th Sector <br>
                                HSR Layout, Bengaluru&nbsp;</address>

                            <dl class="footer_phone_sec">
                                <dt><i class="fa fa-phone" style="color:#ffffff;" aria-hidden="true"></i></dt>
                                <dd><a href="callto:#">+91 94494 85515 <span>(Support)</span></a></dd>
                                <dd><span style="padding-left:15px;"><a href="callto:#">+91 98864 54717 <span>(Sales)</span></a></span></dd>
                            </dl>

                            <dl class="">
                                <dt><i class="fa fa-envelope" style="color:#ffffff;" aria-hidden="true"></i></dt>
                                <dd style="margin-left:6px;color:#fff"><a href="mailto:info@eflight.aero">info@eflight.aero</a></dd>
                            </dl>
                        </div>
                        <div class="social-stat">
                            <ul class="inline-list">
                                <li><a href="#" data-toggle="tooltip" title="twitter" class="fa fa-twitter"></a></li>
                                <li><a href="#" data-toggle="tooltip" title="facebook" class="fa fa-facebook"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6 footer-section">
                        <h4>Menu</h4>
                        <ul class="footer-menu">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="{{url('/about-us')}}" target="_blank">About Us </a></li>
                            <li><a>Services</a></li>
                            <li><a href="{{url('/trip-support')}}">Trip Support</a></li>
                            <li><a>Airports</a></li>
                            <li><a href="{{url('/contact-us')}}" target="_blank">Contact Us</a></li>
                        </ul>

                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <h4>Services</h4>
                        <ul class="footer-menu services_menu" style="text-transform:uppercase;">
                            <li><a>Online FPL</a></li>
                            <li><a>Notams</a></li>
                            <li><a>Weather</a></li>
                            <li><a>FDTL</a></li>
                            <li><a>Nav Log</a></li>
                            <li><a>Load Trim</a></li>
                        </ul>
                    </div>
<!--                     <div class="col-md-5 col-sm-9 col-xs-12 footer-section-right norightpad" id="f_app">
                        <h4>Contact us</h4>
                        <div id="mysuccess" class="successmsg"></div>
                        <form class='mailform' id="contact_form"  method="post" data-url="{{url('/contact-us')}}">
                            <fieldset>
                                <div class="col-md-6 xs-m-t-0 xs-p-lr-0">
                                    <label data-add-placeholder="">
                                        <input id="f_c_name" @focus="f_vue_name" @keyup="f_vue_name2" type="text"
                                               name="name"
                                               placeholder="Name" v-model="v_name"
                                               data-constraints="@LettersOnly @NotEmpty" class="f_c_name" autocomplete="off" />
                                    </label>
                                </div>
                                <div class="col-md-6 norightpad sm-p-r-15 xs-p-lr-0">
                                    <label data-add-placeholder="">
                                        <input type="text" @focus="f_vue_mobile" @keyup="f_vue_mobile2"
                                               name="mobile_number" v-model="v_mobile_number"
                                               placeholder="Mobile" id="f_c_mobile_number"
                                               data-constraints="@Phone @NotEmpty" minlength="10" maxlength="10" class="f_c_mobile_number numeric" autocomplete="off"/>
                                    </label>
                                </div>
                                <div class="col-md-12 col-sm-12 sm-m-t-13 xs-p-lr-0 email_main_box norightpad" style="margin-top:10px;">
                                    <label data-add-placeholder="">
                                        <input type="text" @focus="f_vue_email" @keyup="f_vue_email2"
                                               name="email" id="f_c_email" v-model="v_email"
                                               placeholder="Email"
                                               data-constraints="@Email @NotEmpty" class="f_c_email" autocomplete="off"/>
                                    </label>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-12 norightpad sm-p-r-15 xs-p-lr-0">
                                    <label data-add-placeholder="" class="textarea">
                                        <textarea name="message" id="f_c_message" @focus="f_vue_message" @keyup="f_vue_message2"
                                                  placeholder="Message" v-model="v_message" @keyup="f_vue_message2"
                                                  data-constraints="@NotEmpty" class="f_c_message" autocomplete="off"></textarea>
                                    </label>
                                </div>
                                <div class="col-md-12 xs-p-l-0">
                                    <div class="col-sm-3 noleftpad footer_tick_box">
                                        <span style="color: white">ENTER TEXT</span><br/>
                                        <span id="captcha" style="color: white;margin-left: 15px;"></span>
                                    </div>
                                    <div class="col-sm-7 noleftpad footer_tick_box">
                                        
                                        <input type="text" id="captcha_text" name="captcha_text" class="special_symbols"  autocomplete="off" maxlength="6"> 
                                   
                                    </div>
                                    <div class="col-md-2 col-sm-2 noleftpad sm-p-l-15">
                                        <button class="btn footer-send btn_send_f01 newbtn" style="margin-top:10px;" type="submit" style="bottom:0" id="contact_us_btn">Send</button>
                                    </div>
                                </div>
                                <div>
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                </div>
                            </fieldset>
                        </form>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <section class="well-7 copy-row">
        <div class="container">
            <div class="copyright">
                © <span id="copyright-year"></span> <span class="uppercase">EFLIGHT </span>(<span style="color:#8ec63f;font-weight:bold">GHAGANE AVIATION</span>) </span>
            </div>
        </div>
    </section>
</footer>     
<script>
    //console.log("ramesh sir");
    console.log("check");
    $('[data-toggle="tooltip"]').tooltip(); 
    $('#f_c_name,#f_c_mobile_number,#f_c_email,#f_c_message,#captcha_text').on("cut copy paste",function(e) {
          e.preventDefault();
       });
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    $(document).on("keypress",".special_symbols",function(e){
         if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) ||(e.charCode==0))
         return true;
         else
         return false; 
    });
    $(document).on('keyup', "#f_c_email", function () {
       var email = $(this).val();
       if(isEmail(email)){
         $(".f_c_email").css('border-color', 'lightgrey');   
       }else{
            $(".f_c_email").css('border-color', 'red');
       }
    });
    /*function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
        $("#captcha").text(result)    
    }
    randomString(6,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    $("#captcha_text").keyup(function(){
       $(this).removeClass('border_red');
    });
    $("#contact_form").on('submit', function (e) {
        e.preventDefault();
        var data_url = $('form[id="contact_form"]').attr('data-url');
        var datastring = $('form[id="contact_form"]').serialize();

        var name = $("#f_c_name").val();
        var mobile_number = $("#f_c_mobile_number").val();
        var email = $("#f_c_email").val();
        var message = $("#f_c_message").val();
        var captcha_text = $("#captcha_text").val();
        if(captcha_text!=$("#captcha").text()){
            $("#captcha_text").addClass('border_red');
            return false;
        }
        if(name.length>1 && mobile_number.length>=10 && isEmail(email) && message.length>=2 && captcha_text==$("#captcha").text())
            $("#contact_us_btn").prop('disabled',true)

        if (name != '' && mobile_number != '' && email != '' && message != '') {
            $("#mysuccess").html("<span class='p-l-20'><a><i class='fa fa-spinner fa-spin'> </i></a> Processing ...</span>")
        }
        $.ajax({
            type: 'POST',
            url: data_url,
            data: datastring,
            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg"><span style="color:#f1292b;font-size:15px"><b>' + data.success + '</b></span></div>');
                $("[name=name]").val('');
                $("[name=email]").val('');
                $("[name=mobile_number]").val('');
                $("[name=message]").val('');
                $("[name=captcha_text]").val('');
                randomString(6,'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                setTimeout(function () {
                    $("#mysuccess").hide();
                    location.reload();
                },1000);

            },
            error: function (data, textStatus, jqXHR) {
                console.log(data);
            }
        })
    });
    new Vue({
        el: "#f_app",
        data: {
            v_name: '',
            v_email: '',
            v_mobile_number: '',
            v_message: ''
        },
        methods: {
            f_vue_name: function (e) {
                $(".f_c_name").css('border-color', '#f1292b');
            },
            f_vue_mobile: function (e) {
                $(".f_c_mobile_number").css('border-color', '#f1292b');
            },
            f_vue_email: function (e) {
                $(".f_c_email").css('border-color', '#f1292b');
            },
            f_vue_message: function (e) {
                $(".f_c_message").css('border-color', '#f1292b');
            },
            f_vue_name2: function (e) {
                if (this.v_name.length <= 1) {
                    $(".f_c_name").css("border-color", "#f1292b")
                } else {
                    $(".f_c_name").css("border-color", "lightgrey")
                }
            },
            f_vue_mobile2: function (e) {
                if (this.v_mobile_number.length == 10) {
                    $(".f_c_mobile_number").css('border-color', 'lightgrey');
                    return true;
                } else {
                    $(".f_c_mobile_number").css('border-color', 'red');
                    return false;
                }
            },
            f_vue_email2: function (e) {
                if (this.v_email.length >= 8) {
                    $(".f_c_email").css('border-color', 'lightgrey');
                    return true;
                } else {
                    $(".f_c_email").css('border-color', 'red');
                    return false;
                }
            },
            f_vue_message2: function (e) {
                if (this.v_message.length >= 2) {
                    $(".f_c_message").css('border-color', 'lightgrey');
                    return true;
                } else {
                    $(".f_c_message").css('border-color', 'red');
                    return false;
                }
            },
        },
        commuted: {
        }

    })*/
</script>