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
	<link rel="stylesheet" type="text/css" href="{{url('app/plugins/datatables/media/css/jquery.dataTables.min.css')}}">	
	<style type="text/css" class="init"></style>	
	<script type="text/javascript" language="javascript" src="{{url('app/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>		
	<link rel="stylesheet" type="text/css" href="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.css')}}">
	<script>
var base_url = {!! json_encode(url('/')) !!};
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

	<script type="text/javascript" src="{{url('app/new_temp/js/notifytabs.js')}}"></script>
	<script type="text/javascript" src="{{url('app/new_temp/js/flightplan.js')}}"></script>	

	<script src="{{url('app/plugins/vue.js')}}" ></script>
	<script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js" ></script>

	<script src="{{url('app/js/ops/info.js')}}" type="text/javascript"></script>	
	<script src="{{url('app/js/common/common.js')}}" type="text/javascript"></script>
	<script src="{{url('app/js/bootstrap.min.js')}}" type="text/javascript"></script>    
	<link rel="stylesheet" type="text/css" href="{{url('app/css/ops/info.css')}}">
    </head>
    <body>
        <div>
            @yield('content')	 
	    @include('includes.logout',[])	
	    @include('includes.notification',[])	
        </div>       
    </body>
</html>
