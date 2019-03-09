<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EFLIGHT | Trip Support</title>
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>Flight Plan - Eflight - Flight Planning</title>
        <title>Flight Planning</title>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no"/>
        <link rel="icon" href="{{url('app/new_temp/images/favicon/favicon.ico')}}" type="image/x-icon">
        <link rel="stylesheet" href="{{url('app/css/sweet-alert.css')}}" />
        <link rel="stylesheet" href="{{url('app/new_temp/css/bootstrap.min.css')}}">
        
        <style type="text/css" class="init"></style>
        <link rel="stylesheet" type="text/css" href="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.css')}}">

        <script src="{{url('app/js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/sweet-alert.js')}}"></script>
        <script src="{{url('app/js/jquery.sweet-alert.init.js')}}"></script>
        <script type="text/javascript" src="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.js')}}"></script>

        <script>
var base_url = {!! json_encode(url('/')) !!};
        </script>

        <link rel="stylesheet"  href="{{url('app/css/home/header.css')}}" />
        <link  rel="stylesheet" href="{{url('app/css/home/footer.css')}}" />
        <link  rel="stylesheet" href="{{url('app/css/ops/admin_common.css')}}" />
        <link  rel="stylesheet" href="{{url('app/css/ops/info.css')}}" />
        <link  rel="stylesheet" href="{{url('app/css/ops/users.css')}}" />
        <link  rel="stylesheet" href="{{url('app/css/ops/pilots.css')}}" />
        <link  rel="stylesheet" href="{{url('app/css/ops/handlers.css')}}" />
        <link rel="stylesheet" href="{{url('app/css/navlog/jquery.growl.css')}}" />
        
        <script src="{{url('app/plugins/vue.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js" ></script>
        <script src="{{url('app/js/validation/validator.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/home/header.js')}}"></script>
        <script src="{{url('app/js/home/footer.js')}}"></script>
        <!-- <script src="{{url('app/js/home/index.js')}}"></script> -->
        <script src="{{url('app/js/validation/validator.js')}}" type="text/javascript"></script>
        <script src="{{url('app/js/ops/admin_common.js')}}"></script>
        <script src="{{url('app/js/ops/pilots.js')}}"></script>
        <script src="{{url('app/js/ops/info.js')}}"></script>
        <script src="{{url('app/js/ops/handlers.js')}}"></script>
        <script src="{{url('app/js/navlog/jquery.growl.js')}}"></script>
        
        <link rel="stylesheet" type="text/css" href="{{url('app/plugins/datatables/media/css/jquery.dataTables.min.css')}}">
        <script type="text/javascript" language="javascript" src="{{url('app/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>



        <!--[if lt IE 9]>
        <html class="lt-ie9">
        <script src="{{url('app/js/html5shiv.js')}}"></script>
        <![endif]-->
    </head>
    <body>
        <div>
            @yield('content')

            @include('includes.login',[])
            @include('includes.logout_v',[])
             <script src="{{url('app/js/ops/users.js')}}"></script>
        </div>
    </body>
</html>
