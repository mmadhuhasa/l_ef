



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



            @if (Auth::check()) 
            @if (Auth::user()->is_admin) 
	    <?php
	    $web_notify_obj = App\models\WebNotificationsModel::getInstance();
	    $notification_count = count($web_notify_obj->get_notifications('1'));
	    ?>	    

            @endif
            @endif
            <div class="sform">
                @if (Auth::check()) 
                <a data-toggle="modal" data-target="#logoutbox" class="user"><img class="img-responsive" alt="user-login" src="{{url('media/images/header/user.png')}}"></a>
                @else
                <a id="signbox" data-toggle="modal" data-target="#popupbox" class="user a-login"><img class="img-responsive" alt="user-login" src="{{url('media/images/header/user.png')}}"></a>
                @endif
            </div>



        </nav>
    </div>
</header>