<div class="notify-bg"></div>
<header>
    <div class="container-fluid">
        <div class="header-top">
            <div class="brand">
                <h1 class="brand_name">
                    <a href="{{url('fpl')}}"><img src="{{url('app/new_temp/images/logo-web.png')}}" alt="Eflight" class="img-responsive"></a>
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

        <nav class="nav stuck_container" id="stuck_container">
            <ul class="sf-menu" data-type="navbar">
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('about-us')}}">About Us</a>
                </li>
                <li class="active">
                    <a href="">Services</a>
                    <ul>
                        <li>
                            <a href="#">ONLINE FPL</a>
                        </li>
                        <li>
                            <a>FDTL</a>
                        </li>
                        <li><a>NAV LOG</a>              
                        </li>
                        <li>
                            <a>LOAD TRIM</a>
                        </li>

                        <li>
                            <a href="{{url('/notams')}}">NOTAMS</a>
                        </li>
                        <li>
                            <a href="weather">WEATHER</a>
                        </li>
                        <li>
                            <a>LICENSE REMINDERS</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a>Trip Support</a>
                </li>

                <li>
                    <a>Airports</a>
                </li>
                <li>
		    <a href="{{url('/contact-us')}}">Contacts</a>
                </li>
            </ul>
            <div class="sform time">
                <div id="timeTM"></div>
            </div>
            @if (Auth::check()) 
	    <?php
	    $web_notify_obj = App\models\WebNotificationsModel::getInstance();
	    $notification_count = count($web_notify_obj->get_notifications('1'));
	    ?>	    
            <div class="notification-block">
                <div>
                    <div class="sform notfications">
                        <a  class="user"><i class="fa fa-bell" aria-hidden="true"></i></a><span class="number"><sup><span id="notify_count">{{$notification_count}}</span></sup></span>
                    </div>
                </div>
                <div class="notif-content-block">
                    <div class="notify-pointer" style="right:12%;"></div>
                    <div class="notification-content">                        
                        <div id="notifymaintabs" class="notifyTabbedPanels">
                            <ul class="resp-tabs-list TabbedPanelsTabGroup">
                                <li class="TabbedPanelsTab" tabindex="0">New FPL</li>
                                <li class="TabbedPanelsTab" tabindex="0">cancel</li>
                                <li class="TabbedPanelsTab" tabindex="0">delay</li>
                                <li class="TabbedPanelsTab" tabindex="0">change</li>
                            </ul>

			    <?php
			    $web_notify_obj = App\models\WebNotificationsModel::getInstance();
			    $fpl_notifications = $web_notify_obj->get_notifications('', '1');
			    $fpl_notifications2 = $web_notify_obj->get_notifications('', '2');
			    $fpl_notifications3 = $web_notify_obj->get_notifications('', '3');
			    $fpl_notifications4 = $web_notify_obj->get_notifications('', '4');
			    ?>

                            <div class="resp-tabs-container TabbedPanelsContentGroup">
                                <div  id="new_fpl_notify" class="resp-tab-content TabbedPanelsContent">
				    <ul>					
					@foreach($fpl_notifications as $fpl_notifications)
					@if($fpl_notifications->viewed_user_id != 0)
					<li>{{$fpl_notifications->subject}}</li>
					@else
					<li class="fpl_notify_click" id="{{$fpl_notifications->id}}" style="font-weight:bold;color:black;cursor: pointer">{{$fpl_notifications->subject}}</li>
					@endif
					@endforeach
				    </ul>
                                </div>
                                <div class="resp-tab-content TabbedPanelsContent">
                                    <div id="cancel_fpl_notify">
					<ul>					
					    @foreach($fpl_notifications2 as $fpl_notifications)
					    @if($fpl_notifications->viewed_user_id != 0)
					    <li>{{$fpl_notifications->subject}}</li>
					    @else
					    <li class="fpl_notify_click" id="{{$fpl_notifications->id}}" style="font-weight:bold;color:black;cursor: pointer">{{$fpl_notifications->subject}}</li>
					    @endif
					    @endforeach
					</ul>
				    </div>
                                </div> 
                                <div class="resp-tab-content TabbedPanelsContent">
				    <div id="delay_fpl_notify">
					<ul>					
					    @foreach($fpl_notifications3 as $fpl_notifications)
					    @if($fpl_notifications->viewed_user_id != 0)
					    <li>{{$fpl_notifications->subject}}</li>
					    @else
					    <li class="fpl_notify_click" id="{{$fpl_notifications->id}}" style="font-weight:bold;color:black;cursor: pointer">{{$fpl_notifications->subject}}</li>
					    @endif
					    @endforeach
					</ul>
				    </div>		
                                </div>
                                <div class="resp-tab-content TabbedPanelsContent">
                                    <ul>
                                        <li>TESTA &gt; VOBG &gt; VOPC Filed successfully4</li>
                                        <li>TESTA1 &gt; VOPC &gt; VOBG Filed successfully</li>
                                        <li>TESTA &gt; VOBG &gt; VOPC Filed successfully</li>
                                        <li>TESTA &gt; VOPC &gt; VOBG Filed successfully</li>
                                        <li>TESTA &gt; VOBG &gt; VOPC Filed successfully</li>
                                        <li>TESTA &gt; VOPC &gt; VOBG Filed successfully</li>
                                        <li>TESTA &gt; VOBG &gt; VOPC Filed successfully</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            var notifymaintabs = new Spry.Widget.TabbedPanels("notifymaintabs");
                        </script>
                    </div>
                </div>
            </div>
            @endif

            <div class="sform">
                @if (Auth::check()) 
                <a data-toggle="modal" data-target="#logoutbox" class="user"><img class="img-responsive" alt="user-login" src="{{url('app/new_temp/images/user.png')}}"></a>
                @else
                <a data-toggle="modal" data-target="#popupbox" class="user"><img class="img-responsive" alt="user-login" src="{{url('app/new_temp/images/user.png')}}"></a>
                @endif
            </div>
        </nav>
    </div>
</header>
