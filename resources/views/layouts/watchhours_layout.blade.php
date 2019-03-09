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
        <!--javascript and Bootstrap plugins-->  
        <script src="{{url('app/js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>  
        <link rel="stylesheet" type="text/css" href="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.css')}}">
        <script>
            var base_url = {!! json_encode(url('/')) !!};
        </script>
        <script src="{{url('app/new_temp/js/jquery-migrate-1.2.1.js')}}"></script>
        <script src="{{url('app/new_temp/js/script.js')}}"></script>	
        <script type="text/javascript" src="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.js')}}"></script>    	
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
        <script src="{{url('app/js/bootstrap.min.js')}}" type="text/javascript"></script>
        @stack('watchhourcss')
    </head>
    <body id="body">
        <div>
            @yield('content')	 
            @include('includes.logout',[])	
            @include('includes.notification',[])	
        </div>       
    </body>
   
</html>
