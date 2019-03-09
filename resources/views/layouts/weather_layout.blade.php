<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>Flight Plan - Eflight - Flight Planning</title>           
        <title>Flight Planning</title>        
        <link rel="stylesheet" type="text/css" href="{{url('app/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('app/css/weather.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('app/css/responsive.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('app/css/weather-naresh.css')}}">
        <!--javascript plugins-->  
        <script src="{{url('app/js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>              
        <!--Bootstrap plugins--> 
        <script src="{{url('app/js/bootstrap.min.js')}}" type="text/javascript"></script>        





        <script src="{{url('app/js/fpl/jquery.homemenu.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/fpl/common.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/fpl/flightplan.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/fpl/jquery.mCustomScrollbar.concat.min.js')}}" type="text/javascript"></script>

        <!--Custom Javascript-->
        <!--<script src="{{url('app/js/fpl/fpl_changes.js')}}" type="text/javascript"></script>-->
        <script src="{{url('app/js/fpl/validation_changes.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/validation/validator.js')}}" type="text/javascript"></script>
      <!--<script type="text/javascript" src="{{url('app/js/app/autotab.js')}}"></script>-->

        <!--Custom Plug-ins-->      


        <!--auto tab-->
        <!--<script type="text/javascript" src="{{url('app/plugins/autotab/jquery.autotab.min.js')}}"></script>-->
        <!--auto tab-->

        <!--boot box-->
        <!--<script type="text/javascript" src="{{url('app/plugins/bootbox.min.js')}}"></script>-->
        <!--boot box-->


        <!--Autocompelte-->               
        <!--   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">       
         <script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
        <link rel="stylesheet" type="text/css" href="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.css')}}">
        <script type="text/javascript" src="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.js')}}"></script>
        <!--Autocompelte-->

        <link rel="stylesheet" type="text/css" href="{{url('app/css/token-input.css')}}">
        <!--<link rel="stylesheet" type="text/css" href="{{url('app/css/token-input-facebook.css')}}">-->
        <script src="{{url('app/js/jquery.tokeninput.js')}}" type="text/javascript"></script>

        <!--        Validation Plug-ins -->
        <!--    <link rel="stylesheet" href="{{url('app/validation/dist/css/formValidation.css')}}"/>      
            <script type="text/javascript" src="{{url('app/validation/dist/js/formValidation.js')}}"></script>
            <script type="text/javascript" src="{{url('app/validation/dist/js/framework/bootstrap.js')}}"></script>
            <script type="text/javascript" src="{{url('app/js/validation/validation.js')}}"></script>-->
        <!--        Validation Plug-ins -->
        <script>
var base_url = {!! json_encode(url('/')) !!};
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
});
        </script>
        <!-- Fpl changes -->

        <link rel="stylesheet" type="text/css" href="{{url('app/css/flightplan_changes.css')}}">
    </head>
    <body>
        <div>
            @yield('content')
        </div>       
    </body>
</html>
