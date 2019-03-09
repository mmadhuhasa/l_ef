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
	<script src="{{url('app/js/jquery-1.11.3.min.js')}}"></script>		       	
	<script src="{{url('app/js/bootstrap.min.js')}}"></script>

	<script src="{{url('app/js/home/header.js')}}"></script>
	<script src="{{url('app/js/home/footer.js')}}"></script>
	<script src="{{url('app/js/home/index.js')}}"></script>
	<script src="{{url('app/js/validation/validator.js')}}" type="text/javascript"></script>	

	<link rel="stylesheet"  href="{{url('app/css/home/header.css')}}" />
	<link  rel="stylesheet" href="{{url('app/css/home/footer.css')}}" />	
	<script src="{{url('app/plugins/vue.js')}}"></script>

	<!--[if lt IE 9]>
	<html class="lt-ie9">
	<script src="{{url('app/js/html5shiv.js')}}"></script>
	<![endif]-->
    </head>
    <body>
        <div>
            @yield('content')
	    @include('includes.content-popup',[]) 
	    @include('includes.notam-popup',[])    
	    @include('includes.login',[])	
	    @include('includes.logout_v',[])	
        </div>       
    </body>
</html>
