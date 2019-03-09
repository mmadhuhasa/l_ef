<!DOCTYPE html>
<html lang="en">
    <head>
	@include('includes.common_layout')
	<!-- <script type="text/javascript" src="{{url('app/new_temp/js/notifytabs.js')}}"></script> -->
	<script type="text/javascript" src="{{url('app/new_temp/js/flightplan.js')}}"></script>
	<script src="{{url('app/js/common/common.js')}}" type="text/javascript"></script>
	<script src="{{url('app/js/loadandtrim/'.$aircraft_callsign.'.js')}}" type="text/javascript"></script>

	<script src="{{url('app/new_temp/js/device.min.js')}}"></script>
	<link rel="stylesheet" href="{{url('app/new_temp/css/style.css')}}">
	<link rel="stylesheet" href="{{url('app/new_temp/css/camera.css')}}"/>
	<link rel="stylesheet" href="{{url('app/new_temp/css/search.css')}}"/>
	<link rel="stylesheet" href="{{url('app/new_temp/css/inmailform.css')}}">
	<link rel="stylesheet" href="{{url('app/new_temp/css/new_fileplan.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{url('app/css/common/common.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('app/css/loadandtrim/loadandtrim.css')}}">
	 <script src="{{url('app/plugins/vue.js')}}" ></script>
        <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js" ></script>

    </head>
    <body>
        <div>
            @yield('content')
	    @include('includes.logout',[])
	    @include('includes.notification',[])
        </div>
    </body>
</html>
