<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.common_layout')
        <!-- <script type="text/javascript" src="{{url('app/new_temp/js/notifytabs.js')}}"></script> -->
        <script type="text/javascript" src="{{url('app/new_temp/js/flightplan.js')}}"></script>
        <script src="{{url('app/new_temp/js/device.min.js')}}"></script>
        <script src="{{url('app/js/common/common.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/fpl/new_quick_fpl.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/validation/validator.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/fpl/datatables.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/navlog/moment.min.js')}}"></script>
        <script src="{{url('app/js/fpl/fpl_changes.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/navlog/jquery.redirect.js')}}"></script>
        <script src="{{url('app/js/navlog/jquery.growl.js')}}"></script>

        <link rel="stylesheet" href="{{url('app/new_temp/css/style.css')}}">
        <link rel="stylesheet" href="{{url('app/new_temp/css/camera.css')}}"/>
        <link rel="stylesheet" href="{{url('app/new_temp/css/search.css')}}"/>
        <link rel="stylesheet" href="{{url('app/new_temp/css/inmailform.css')}}">
        <link rel="stylesheet" href="{{url('app/new_temp/css/new_fileplan.css')}}"/>
        <link rel="stylesheet" href="{{url('app/css/common/common.css')}}"/>
        <link rel="stylesheet" href="{{url('app/css/home/footer.css')}}" />
        <link rel="stylesheet" href="{{url('app/css/home/header.css')}}" />
        <link rel="stylesheet" href="{{url('app/css/navlog/jquery.growl.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{url('app/css/flightplan_changes.css')}}">
        @stack('css')
        @stack('js')
        <script src="{{url('app/plugins/vue.js')}}"></script>
        <script src="{{url('app/js/common/vue-resource.min.js')}}"></script>

    </head>
    <body>
         <div> 
            @yield('content')
            @include('includes.logout',[])
            @include('includes.notification',[])
            @include('includes.logout_v',[])
         </div> 
    </body>
</html>
