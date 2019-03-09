<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Apple devices fullscreen -->
        <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="_token" content="{{ csrf_token() }}" />
        <meta name="Title" content="Flight Planning">
        <meta name="robots" content="noindex,nofollow">
        <meta name="description" content="Flight Planning" />
        <title>Flight Planning</title>

        <!--css styles-->
	<!--        <link rel="stylesheet" type="text/css" href="{{url('app/css/bootstrap-theme.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app/css/bootstrap-theme.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app/css/bootstrap.css')}}">-->
        <link rel="stylesheet" type="text/css" href="{{url('app/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('app/css/font-awesome.css')}}">
        <!--<link rel="stylesheet" type="text/css" href="{{url('app/css/gulp_less_changes.css')}}">-->

        <!--javascript plugins-->
        <script src="{{url('app/js/bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/npm.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/gulp_changes.js')}}" type="text/javascript"></script>

        <!-- Ananth changes -->
	<link rel="stylesheet" type="text/css" href="{{url('app/css/ananth/style.css')}}">
        <script src="{{url('app/js/ananth/jquery.homemenu.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/ananth/common.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/ananth/flightplan.js')}}" type="text/javascript"></script>
        <!-- Ananth changes -->
    </head>
    <body>
        <div>
            @yield('content')
        </div>       
    </body>
</html>
