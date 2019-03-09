<style>
    .v_notification {
        position: absolute;
        top: 15px;
        right: 85px;
    }
    @media screen and (min-width:767px) and (max-width:992px) {
        .v_notification {
            position: absolute;
            top: 15px;
            right: 60px;
        }
    }
    .time {font-family:inherit;}
    .v_notification:before {
        content:"\f0f3";
        font-family: 'FontAwesome';
        color:#fff;
        cursor: pointer;
    }
    .v_notify_content {
        position: absolute;
        top:40px;
        right:-30px;
        width:425px;
        background: #fff;
        border:1px solid #333;
        box-shadow:0 0 1px 1px #999;
        border-radius: 8px;
        z-index:9999;
    }
    .v_notify_content_sub {
        overflow-y: scroll;
        height:300px;
    }
    .triangle_shape {
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #ffffff;
        position: absolute;
        top: -10px;
        right:25px;
    }
    .v_notify_count {
        position: absolute;
        width: 13px;
        height: 13px;
        background: #fff;
        top: -2px;
        right: -8px;
        box-shadow: 0px 0px 0px 2px #f04446;
        border-radius: 50%;
        font-size: 9px;
        text-align: center;
        font-weight: bold;
        line-height: 1.5;
        border: 0;
    }

    .upl_triangle_shape {
        width: 0;
        height: 0;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #eeeeee;
        position: absolute;
        top: -7px;
        right:16px;
    }

    .v_notify_heading {
        height: 35px;
        border-radius: 10px 10px 0 0;
        margin-left:5px;
        margin-right:5px;
    }
    .v_notify_previous, .v_notify_next {
        font-size: 12px;
        background: #333;
        color: #fff;
        border-radius: 50%;
        padding: 4px 8px;
    }
    .v_notify_previous:hover,.v_notify_previous:focus, .v_notify_next:hover, .v_notify_next:focus {
        text-decoration: none;
        color: #333;
        background: #eee;
    }
    .notify_cancel {
        color: #ff0000;
    }
    .notify_change {
        color: #555;
    }
    .notify_delay {
        color: #548235;
    }
    .notify_newfpl {
        color: #000000;
    }
    .br-b-10 {
        border-radius: 0 0 10px 10px;
    }
    .notify-bg-v{
        background:rgba(0,0,0,.6);
        position: absolute;
        width: 100%;
        display:block;
        height:100%;
        z-index:9000;
        display: none;
    }
    .user_profile_logout {
        width:225px;
        position: absolute;
        top:48px;
        right:10px;
        background: #fff;
        border:1px solid #999;
        border-radius:5px;
        z-index:9999;
        box-shadow: 0 0 1px 1px #333;
        display:none;
    }
    .upl_1, .upl_2 {
        padding: 4px 10px;
        font-size: 13px;
        border-bottom: 1px solid #eae7e7;
        text-transform: uppercase;
    }
    .upl_1:hover {
        border-radius: 4px 4px 0 0;
    }
    .upl_4 {
        background: #F26232;
        background: -moz-linear-gradient(top, #f37758 0%, #f1292c 100%);
        background: -webkit-linear-gradient(top, #f37758 0%, #f1292c 100%);
        background: -o-linear-gradient(top, #f37758 0%, #f1292c 100%);
        background: -ms-linear-gradient(top, #f37758 0%, #f1292c 100%);
        background: linear-gradient(to bottom, #f37758 0%, #f1292c 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f37758', endColorstr='#f1292c', GradientType=0 );
        color: #fff;
        border-radius: 0 0 4px 4px;
        text-align: center;
        text-transform: uppercase;
    }
    .upl_4:hover {
        background: #333;
        cursor: pointer;
    }
    .upl_4 a {
        text-decoration: none;
        color:#fff;
        display: block;
        padding:5px;
        font-size: 14px;
    }
    .upl_4 a:hover {
        color:#fff;
    }
    .upl_1 {
        font-weight: bold;
        background: #eee;
        border-radius: 4px 4px 0 0;
    }
    .red_btn_skew {
        min-width: 62px; /*popoutbox YES button*/
        transition: all 0.25s ease;
        overflow: hidden;
        position: relative;
        display: inline-block;
        margin-bottom: 0;
        color: #fff;
        font-size: 14px;
        line-height: 20px;
        font-weight: 300;
        text-transform: uppercase;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        border: none;
        background: #f37758;
        background: -moz-linear-gradient(top, #f37758 0%, #f1292c 100%);
        background: -webkit-linear-gradient(top, #f37758 0%, #f1292c 100%);
        background: -o-linear-gradient(top, #f37758 0%, #f1292c 100%);
        background: -ms-linear-gradient(top, #f37758 0%, #f1292c 100%);
        background: linear-gradient(to bottom, #f37758 0%, #f1292c 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f37758', endColorstr='#f1292c', GradientType=0 );
        z-index: 3;
        border-radius: 4px;
        text-decoration: none;
    }
    .red_btn_skew:hover:before, .black_btn_skew:hover:before {
        visibility: visible;
        width: 200%;
        left: -46%;
    }

    .red_btn_skew:before {
        -webkit-transition: all 0.35s ease;
        -moz-transition: all 0.35s ease;
        -o-transition: all 0.35s ease;
        transition: all 0.35s ease;
        -webkit-transform: skew(45deg,0);
        -moz-transform: skew(45deg,0);
        -ms-transform: skewX(45deg) skewY(0);
        -o-transform: skew(45deg,0);
        transform: skew(45deg,0);
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
        color:#fff;
    }

    .black_btn_skew {
        transition: all 0.25s ease;
        overflow: hidden;
        position: relative;
        display: inline-block;
        margin-bottom: 0;
        color: #fff ;
        font-size: 14px;
        line-height: 20px;
        font-weight: 300;
        text-transform: uppercase;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        border: none;
        background: #333;
        z-index: 3;
        border-radius: 4px;
    }
    .black_btn_skew:before {
        -webkit-transition: all 0.35s ease;
        -moz-transition: all 0.35s ease;
        -o-transition: all 0.35s ease;
        transition: all 0.35s ease;
        -webkit-transform: skew(45deg,0);
        -moz-transform: skew(45deg,0);
        -ms-transform: skewX(45deg) skewY(0);
        -o-transform: skew(45deg,0);
        transform: skew(45deg,0);
        -webkit-backface-visibility: hidden;
        content: '';
        position: absolute;
        visibility: hidden;
        top: 0;
        left: 50%;
        width: 0;
        height: 100%;
        background: #F26232;
        background: linear-gradient(to top, #fa9b5b, #F26232);
        background: #f1292b;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
        background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
        background: -moz-linear-gradient(top, #f37858, #f1292b);
        z-index: -1;
        color:#fff;
    }
    .actbtns a:hover, .actbtns a:active, .actbtns a:visited {
        color: #fff;
        text-decoration: none;
    }
    .modal-container {
        z-index: 999999;
    }
    @media (max-width: 767px) {
        header .nav {
            position: static;
        }
        .user_profile_logout {
            top: 64px;
        }
    }
    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
        .user_profile_logout {
            top: 64px;
            right:6px;
        }
    }
</style>
<script>
    $(document).ready(function () {
        $(".v_notification").click(function () {
            $(".v_notify_content").fadeIn();
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height', $(document).height());
        });
        $(".notify-bg-v").click(function () {
            $(".v_notify_content").fadeOut();
            $(".notify-bg-v").fadeOut();
        });
        $('.loggedin').click(function () {
            $('.user_profile_logout').fadeIn();
            $(".notify-bg-v").fadeIn();
        });
        $(".notify-bg-v").click(function () {
            $(".user_profile_logout").fadeOut();
            $(".notify-bg-v").fadeOut();
        });
        $('.upl_4').click(function () {
            $(".notify-bg-v").fadeOut();
        });
        $('#logoutbox').click(function () {
            $('.user_profile_logout').fadeOut();
        });
        $('.sform').on('click', function (argument) {
            $('.notify-bg-v').css('height', $(document).height());
        });
    });
    $(function () {
        var str = location.href.toLowerCase();
        $('.navigation li a').each(function () {
            if (str.indexOf(this.href.toLowerCase()) > -1) {
                $("li.highlight").removeClass("highlight");
                $(this).parent().addClass("highlight");
            }
        });
        $('.services_ul li a').each(function () {
            if (str.indexOf(this.href.toLowerCase()) > -1) {
                $(".services").addClass("highlight");
            }
        });
    });
</script>
<div class="notify-bg-v"></div>
<header>
    <div class="container-fluid">
        <div class="header-top">
            <div class="brand">
                <h1 class="brand_name">
                    <a href="{{url('/')}}"><img src="{{url('media/images/header/logo-web.png')}}" alt="Eflight" class="img-responsive"></a>
                </h1>
            </div>
            <div class="contact-info">
                <dl class="phone">
                    <dd><a href="callto:+919449485515">+91 94494 85515 <span class="uppercase">(support)</span></a></dd>
                    <dd><a href="callto:+919886454717">+91 98864 54717 <span class="uppercase">(sales)</span></a> </dd>
                </dl>
                <dl class="address">
                    <dd>L-150, 5th Main, 6th Sector <br>
                        HSR Layout, Bengaluru<br>
                        <a href="mailto:info@eflight.aero">info@eflight.aero</a>
                    </dd>
                </dl>
            </div>
        </div>
        <nav class="nav">
            <ul class="navigation sf-menu" data-type="navbar">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('about-us')}}">About Us</a></li>
                <!--<li><a href="#">Services</a>
                      <ul>
                          <li><a href="{{url('/fpl')}}">ONLINE FPL</a></li>
                          <li><a href="#">FDTL</a></li>
                          <li><a href="#">NAV LOG</a></li>
                          <li><a href="{{url('/lnt')}}">LOAD TRIM</a></li>
                          <li><a href="#">NOTAMS</a></li>
                          <li><a href="{{url('/weather')}}">WEATHER</a></li>
                          <li><a href="#">LICENSE REMINDERS</a></li>
                      </ul>
                  </li>-->
                <li><a class="services" href="#">Services</a>
                    <ul class="services_ul">
                        <li>
                            @if (Auth::check())
                            <a href="{{url('/fpl')}}">ONLINE FPL</a>   
                            @else
                            <a href="#" id="signbox" data-toggle="modal" data-target="#popupbox" class="user a-login" style="cursor: pointer;">ONLINE FPL</a>  
                            @endif
                        </li>
                        <li>
                            @if (Auth::check())
                            <a href="{{url('/notams')}}">NOTAMS</a>   
                            @else
                            <a href="#" id="signbox" data-toggle="modal" data-target="#popupbox" class="user a-login" style="cursor: pointer;">NOTAMS</a>  
                            @endif
                        </li>
                        <li>
                            @if (Auth::check())
                            <a href="#">WEATHER</a>   
                            @else
                            <a href="#" id="signbox" data-toggle="modal" data-target="#popupbox" class="user a-login" style="cursor: pointer;">WEATHER</a>  
                            @endif
                        </li>  
                         <li><a href="{{url('/lr')}}">LICENSE REMINDERS</a></li>
                        <li><a href="#">FDTL</a></li>
                        <li>
                            @if (Auth::check())
                            <a href="{{url('/navlog')}}">NAV LOG</a>
                            @else
                            <a href="#" id="signbox" data-toggle="modal" data-target="#popupbox" class="user a-login" style="cursor: pointer;">NAV LOG</a>  
                            @endif
                        </li>
                        <li>
                            @if (Auth::check())
                            <a href="#">LOAD TRIM</a>   
                            @else
                            <a href="#" id="signbox" data-toggle="modal" data-target="#popupbox" class="user a-login" style="cursor: pointer;">LOAD TRIM</a>  
                            @endif
                        </li>
                        <li><a href="#">PILOT LOGBOOK</a></li>
                       
                    </ul>
                </li>    

                <li><a href="{{url('/trip-support')}}">Trip Support</a></li>
                <li><a href="#">Airports</a></li>
                <li><a href="{{url('/contact-us')}}">Contact Us</a></li>
            </ul>
            <div class="sform time">
                <div id="timeTM"></div>
            </div>
          
            @if (Auth::check())
            @if (Auth::user()->id == 89)
            <div class='v_notification'>
                <p class="v_notify_count">1</p>
                <div class="v_notify_content" style="display:none;">
                    <div class="triangle_shape"></div>

                    <div class="row v_notify_heading">
                        <div class="col-md-6 noleftpad"><a class="v_notify_previous" href="#">Previous</a></div>
                        <div class="col-md-6 text-right"><a class="v_notify_next" href="#">Next</a></div>
                    </div>
                    <div class="v_notify_content_sub">
                        <style>
                            .notify_table {
                                width: 99%;
                                font-size: 12px;
                                border:1px solid #000;
                                margin:0 auto;
                            }
                            .notify_table th, .notify_table td {
                                text-align: center;
                                border:1px solid #000;
                            }
                            .notify_table th {
                                background: #F26232;
                                background: linear-gradient(to top, #fa9b5b, #F26232);
                                background: #f1292b;
                                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
                                background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
                                background: -moz-linear-gradient(top, #f1292b, #f37858);
                                color: #fff;
                                font-weight: normal;
                            }
                            .notify_table td {
                                font-weight: bold;
                                cursor: pointer;
                            }
                            .notify_table tr:nth-child(odd) {
                                background: #eee;
                            }
                        </style>
                        <table class="notify_table">
                            <tr>
                                <th>SL</th>
                                <th>TYPE</th>
                                <th>CALL SIGN</th>
                                <th>FROM</th>
                                <th>TO</th>
                                <th>TIME</th>
                                <th>BY</th>
                            </tr>
                            <?php for ($i = 1; $i <= 5; $i++) {
                                ?>
                                <tr class="notify_cancel">
                                    <td>1</td>
                                    <td>CANCEL</td>
                                    <td>TESTA</td>
                                    <td>VOBG</td>
                                    <td>VOPC</td>
                                    <td>30-SEP</td>
                                    <td>ANAND</td>
                                </tr>
                                <tr class="notify_change">
                                    <td>2</td>
                                    <td>CHANGE</td>
                                    <td>TESTA</td>
                                    <td>VOBG</td>
                                    <td>VOPC</td>
                                    <td>30-SEP</td>
                                    <td>ANAND</td>
                                </tr>
                                <tr class="notify_delay">
                                    <td>3</td>
                                    <td>DELAY</td>
                                    <td>TESTA</td>
                                    <td>VOBG</td>
                                    <td>VOPC</td>
                                    <td>30-SEP</td>
                                    <td>ANAND</td>
                                </tr>
                                <tr class="notify_newfpl">
                                    <td>4</td>
                                    <td>NEW FPL</td>
                                    <td>TESTA</td>
                                    <td>VOBG</td>
                                    <td>VOPC</td>
                                    <td>30-SEP</td>
                                    <td>ANAND</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>    
                    </div>
                </div>
            </div>
            @endif
            @endif
            <div class="user_profile_logout">
                @if (Auth::check())
                <div class="upl_triangle_shape"></div>
                <div class="upl_1">{{Auth::user()->name}} 
                    <a href="#" class="user loggedin" style="
                       display: inline-block;
                       float: right;
                       "><img class="img-responsive" alt="user-login" src="{{url('/media/images/header/user1.png')}}"></a></div>
                <div class="upl_2">{{Auth::user()->operator}}</div>
                <div class="upl_4"><a data-toggle="modal" data-target="#logoutbox" class="user">Log out</a></div>
                @else
                <a id="signbox" data-toggle="modal" data-target="#popupbox" class="user a-login"><img class="img-responsive" alt="user-login" src="{{url('media/images/header/user.png')}}"></a>
                @endif
            </div>
            <div class="sform">
                @if (Auth::check())
                <a  class="user loggedin"><img class="img-responsive" alt="user-login" src="{{url('media/images/header/user.png')}}"></a>
                @else
                <a id="signbox" data-toggle="modal" data-target="#popupbox" class="user a-login"><img class="img-responsive" alt="user-login" src="{{url('media/images/header/user.png')}}"></a>
                @endif
            </div>
            <!--  <div class="sform">
                 @if (Auth::check())
                 <a data-toggle="modal" data-target="#logoutbox" class="user"><img class="img-responsive" alt="user-login" src="{{url('media/images/header/user.png')}}"></a>
                 @else
                 <a id="signbox" data-toggle="modal" data-target="#popupbox" class="user a-login"><img class="img-responsive" alt="user-login" src="{{url('media/images/header/user.png')}}"></a>
                 @endif
             </div> -->
        </nav>
    </div>
</header>