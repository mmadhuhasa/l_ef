<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>Eflight - India's No 1 Full Trip Support Company</title>
        <title>Flight Planning</title>
	<link rel="icon" href="app/new_temp/images/favicon/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="{{url('app/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('app/new_temp/css/inmailform.css')}}"/>
	<link rel="stylesheet" href="{{url('app/new_temp/css/camera.css')}}"/>
	<link rel="stylesheet" href="{{url('app/new_temp/css/search.css')}}"/>
	<link rel="stylesheet" href="{{url('app/new_temp/css/flexslider.css')}}"/>
	<link rel="stylesheet" href="{{url('app/new_temp/css/style.css')}}">
	<link rel="stylesheet" href="{{url('app/css/common/common.css')}}">
<!--	<link rel="stylesheet" href="{{('app/css/home/footer.css')}}" />
	<link rel="stylesheet" href="{{('app/css/home/header.css')}}" />-->

	<script src="{{url('app/new_temp/js/jquery.js')}}"></script>
	<script src="{{url('app/new_temp/js/bootstrap.min.js')}}"></script>

	<script>
var base_url = {!! json_encode(url('/')) !!};
	</script>

	<script src="{{url('app/new_temp/js/jquery-migrate-1.2.1.js')}}"></script>
	<script src="{{url('app/new_temp/js/jquery.flexslider.js')}}"></script>
	<script src="{{url('app/new_temp/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{url('app/new_temp/js/script.js')}}"></script>
	<script src="{{url('app/new_temp/js/jquery.carouFredSel.js')}}"></script>
	<script src="{{url('app/new_temp/js/home.js')}}"></script>
<!--	<script src="{{url('app/js/common/common.js')}}"></script>-->
	<script src="{{url('app/js/validation/validator.js')}}" type="text/javascript"></script>
        <script src="{{url('app/plugins/vue.js')}}"></script>


	<!--[if lt IE 9]>
	<html class="lt-ie9">
	<div style=' clear: both; text-align:center; position: relative;'>
	    <a href="http://windows.microsoft.com/en-US/internet-explorer/..">
		<img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820"
		     alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
	    </a>
	</div>
	<script src="{{url('app/new_temp/js/html5shiv.js')}}"></script>
	<![endif]-->
	<!-- <script type="text/javascript" src="{{url('app/new_temp/js/notifytabs.js')}}"></script> -->
	<script type="text/javascript" src="{{url('app/new_temp/js/flightplan.js')}}"></script>
	<script src="{{url('app/new_temp/js/device.min.js')}}"></script>
	<script src="{{url('app/js/home/index.js')}}"></script>
	<script src="{{url('app/js/home/footer.js')}}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    @stack('css')
    @stack('js') 
    </head>
    <body>
        <div>
            @yield('content')
	    @include('includes.content-popup',[])
	    @include('includes.notam-popup',[])
	    @include('includes.login',[])
	    @include('includes.logout',[])
        </div>
    </body>
</html>
