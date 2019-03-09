<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>Flight Plan - Eflight - Flight Planning</title>           
        <title>Flight Planning</title>        
        <link rel="stylesheet" type="text/css" href="{{url('app/css/bootstrap.min.css')}}">       

        <!--javascript plugins-->  
        <script src="{{url('app/js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>              
        <!--Bootstrap plugins--> 
        <script src="{{url('app/js/bootstrap.min.js')}}" type="text/javascript"></script>        


        <!-- Fpl changes -->
        <link rel="stylesheet" type="text/css" href="{{url('app/css/login.css')}}">

        <script>
var base_url = {!! json_encode(url('/')) !!};
        </script>
        <!-- Fpl changes -->
    </head>
    <body>
        <div>
            @yield('content')
        </div>       
    </body>
</html>
