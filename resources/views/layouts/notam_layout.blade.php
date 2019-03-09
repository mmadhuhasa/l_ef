<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EFLIGHT | Trip Support</title>
        <meta name="_token" content="{{ csrf_token() }}" />                  
        <title>Flight Planning</title>        
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no"/>
        <link rel="icon" href="{{url('app/new_temp/images/favicon/favicon.ico')}}" type="image/x-icon">
        <link rel="stylesheet" href="{{url('app/new_temp/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('app/css/notams/multipleDatePicker.css')}}"><link>

        <!--javascript and Bootstrap plugins-->  
        <script src="{{url('app/js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>  
         <style type="text/css">
            .fakeloader{
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0px;
                left: 0px;
                bottom: 0;
                right: 0;
                background-color: #eee;
                z-index: 999999;
                display: flex;
                align-items: center;
                font-size: 3em; 
            }
    </style>
    
        <link rel="stylesheet" type="text/css" href="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('app/css/notam-tabs.css')}}"><link>

        <link rel="stylesheet" type="text/css" href="{{url('app/css/elusive-icons.css')}}"><link>
        
        
        <script>
var base_url = {!! json_encode(url('/')) !!}
;
        </script>


        <script src="{{url('app/new_temp/js/jquery-migrate-1.2.1.js')}}"></script>
        <script src="{{url('app/new_temp/js/script.js')}}"></script>	
        <script type="text/javascript" src="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.js')}}"></script>    	
       
        <!--[if lt IE 9]>
        <html class="lt-ie9">
        <div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://windows.microsoft.com/en-US/internet-explorer/..">
                <img src="{{url('app/new_temp/images/ie8-panel/warning_bar_0000_us.jpg')}}" border="0" height="42" width="820"
                     alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
            </a>
        </div>
        <script src="{{url('app/new_temp/js/html5shiv.js')}}"></script>
        <![endif]-->
        
        <script src="{{url('app/new_temp/js/device.min.js')}}"></script>	     		
        <link rel="stylesheet" href="{{url('app/new_temp/css/style.css')}}">
        <link rel="stylesheet" href="{{url('app/new_temp/css/camera.css')}}"/>
        <link rel="stylesheet" href="{{url('app/new_temp/css/search.css')}}"/>
        <link rel="stylesheet" href="{{url('app/new_temp/css/inmailform.css')}}">
        <link rel="stylesheet" href="{{url('app/new_temp/css/new_fileplan.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{url('app/css/common/common.css')}}">
        <script type="text/javascript" src="{{url('app/new_temp/js/notifytabs.js')}}"></script>
        <script src="{{url('app/js/navlog/angular.min.js')}}"></script>
        <script src="{{url('app/js/navlog/moment.min.js')}}"></script>
        <script src="{{url('app/js/navlog/jquery.redirect.js')}}"></script>
        <script src="{{url('app/js/notams/multipleDatePicker.js')}}"></script>
        <script src="{{url('app/js/notams/notams.js')}}"></script>
        <script src="{{url('app/js/navlog/navlog.js')}}"></script>
        <script src="{{url('app/js/bootstrap.min.js')}}" type="text/javascript"></script>
        @stack('notamcss')
        @stack('watchhourcss')
        @stack('uploadnotamcss')
        @stack('supervisefiles')
    </head>
    <body id="body">
        <div>
            @yield('content')	 
            @include('includes.logout',[])	
            @include('includes.notification',[])	
        </div>       
    </body>
   
</html>
