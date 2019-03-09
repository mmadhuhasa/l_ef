<style>
    .v_notification {
        position: absolute;
        top: 15px;
        right: 85px;
    }
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
        width:300px;
        background: #fff;
        border:1px solid #333;
        box-shadow:0 0 1px 1px #999;
        border-radius: 8px;
        z-index:9999;
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
    .upl_triangle_shape {
        width: 0;
        height: 0;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #333333;
        position: absolute;
        top: -8px;
        right:16px;
    }

    .v_notify_heading {
        height: 40px;
        border-radius: 10px 10px 0 0;


    }
    .notify_p {
        width: 100%;
        background: rgba(247,247,247,1);
        background: -moz-linear-gradient(top, rgba(247,247,247,1) 0%, rgba(240,240,240,1) 50%, rgba(247,247,247,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(247,247,247,1)), color-stop(50%, rgba(240,240,240,1)), color-stop(100%, rgba(247,247,247,1)));
        background: -webkit-linear-gradient(top, rgba(247,247,247,1) 0%, rgba(240,240,240,1) 50%, rgba(247,247,247,1) 100%);
        background: -o-linear-gradient(top, rgba(247,247,247,1) 0%, rgba(240,240,240,1) 50%, rgba(247,247,247,1) 100%);
        background: -ms-linear-gradient(top, rgba(247,247,247,1) 0%, rgba(240,240,240,1) 50%, rgba(247,247,247,1) 100%);
        background: linear-gradient(to bottom, rgba(247,247,247,1) 0%, rgba(240,240,240,1) 50%, rgba(247,247,247,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f7f7', endColorstr='#f7f7f7', GradientType=0 );
        padding: 5px 10px;
        margin-bottom: 0;
        border-bottom:1px solid #ddd;
        font-size: 13px;
        font-weight: bold;
        text-transform: uppercase;
        height: 30px;
    }

    .notify_cancel {
        color: #ff0000;
    }
    .notify_change {
        color: #7030a0;
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
    .notify_p span {
        margin-right:10px;
        cursor: pointer
    }
    .notify-bg-v{
        background:rgba(0,0,0,.8);
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
</style>

<script>
    $(document).ready(function () {
        $(".v_notification").click(function () {
            $(".v_notify_content").fadeIn();
            $(".notify-bg-v").fadeIn();
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
            <div class="header_contact-info">
                <dl class="header_phone">
                    <dd><a href="callto:+919449485515">+91 94494 85515 <span class="sup_sal_text">(support)</span></a></dd>
                    <dd><a href="callto:+919886454717">+91 98864 54717 <span class="sup_sal_text">(sales)</span></a> </dd>
                </dl>
                <dl class="header_address">
                    <dd>L-150, 5th Main, 6th Sector <br>
                        HSR Layout, Bengaluru<br>
                        <a href="mailto:info@eflight.aero">info@eflight.aero</a>
                    </dd>
                </dl>
            </div>
        </div>
        <nav class="nav">
            <ul class="navigation header-left-menu" data-type="navbar">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('about-us')}}">About Us</a></li>
                <li class="services_dropdown"><a href="#" class="header-menu-with-ul">Services</a>
                    <ul class="services_submenu">
                        <li><a href="{{url('/fpl')}}">ONLINE FPL</a></li>
                        <li><a href="#">FDTL</a></li>
                        <li><a href="#">NAV LOG</a></li>
                        <li><a href="{{url('/lnt')}}">LOAD TRIM</a></li>
                        <li><a href="#">NOTAMS</a></li>
                        <li><a href="{{url('/weather')}}">WEATHER</a></li>
                        <li><a href="#">LICENSE REMINDERS</a></li>
                    </ul>
                </li>
                <li><a href="#">Trip Support</a></li>
                <li><a href="#">Airports</a></li>
                <li><a href="{{url('/contact-us2')}}">Contact Us</a></li>
            </ul>
            <div class="sform time">
                <div id="timeTM"></div>
            </div>
	      @if (0)
            <div class='v_notification'>
                <div class="v_notify_content" style="display:none;">
                    <div class="triangle_shape"></div>
                    <div class="v_notify_heading"></div>
                    <div  class="notify_p notify_cancel"><span>cancel</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                    <div  class="notify_p notify_change"><span>change</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                    <div  class="notify_p notify_delay"><span>delay</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                    <div  class="notify_p notify_newfpl"><span>NEW FPL</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                    <div  class="notify_p notify_cancel"><span>cancel</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                    <div  class="notify_p notify_change"><span>change</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                    <div  class="notify_p notify_delay"><span>delay</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                    <div  class="notify_p notify_newfpl"><span>NEW FPL</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                    <div  class="notify_p notify_newfpl"><span>NEW FPL</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                    <div  class="notify_p br-b-10"><span>NEW FPL</span><span> testx</span><span>vobg-vopc</span><span>1400z</span><span>30-sep</span></div>
                </div>
            </div>
	      @endif
            <div class="user_profile_logout">
                @if (Auth::check())
                <div class="upl_triangle_shape"></div>
                <div class="upl_1">{{Auth::user()->name}}</div>
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



        </nav>
    </div>
</header>
<!--data-toggle="modal" data-target="#logoutbox" -->