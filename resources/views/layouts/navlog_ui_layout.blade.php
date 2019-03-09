<!DOCTYPE html>
<html lang="en">

<head>
    <title>EFLIGHT | Trip Support</title>
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>Flight Plan - Eflight - Flight Planning</title>
    <title>Flight Planning</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no" />
    <link rel="icon" href="{{url('app/new_temp/images/favicon/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{url('app/new_temp/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('app/plugins/datatables/media/css/jquery.dataTables.min.css')}}">
    <style type="text/css" class="init"></style>
    <link rel="stylesheet" type="text/css" href="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.css')}}">
    <script src="{{url('app/js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="{{url('app/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.js')}}"></script>
    <script>
    var base_url = {!!json_encode(url('/')) !!};
    </script>
    <link rel="stylesheet" href="{{url('app/css/home/header.css')}}" />
    <link rel="stylesheet" href="{{url('app/css/home/footer.css')}}" />
    <script src="{{url('app/js/validation/validator.js')}}" type="text/javascript"></script>
    <script src="{{url('app/js/home/header.js')}}"></script>
    <script src="{{url('app/js/home/footer.js')}}"></script>
    <script src="{{url('app/js/validation/validator.js')}}" type="text/javascript"></script>
    <script src="{{url('app/js/ops/pilots.js')}}"></script>
    <script src="{{url('app/js/ops/info.js')}}"></script>
    <script src="{{url('app/js/ops/handlers.js')}}"></script>
    <link src="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('app/css/navlog/search.css')}}" />
    <link rel="stylesheet" href="{{url('app/css/navlog/inmailform.css')}}" />
    <link rel="stylesheet" href="{{url('app/css/navlog/animate.css')}}">
    <link rel="stylesheet" href="{{url('app/css/navlog/navlog.css')}}">
    <link rel="stylesheet" href="{{url('app/css/navlog/jquery-ui.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('app/css/navlog/common.css')}}">
    <link rel="stylesheet" href="{{url('app/css/navlog/check.css')}}" />
    <script src="{{url('app/js/navlog/jquery.js')}}"></script>
    <script src="{{url('app/js/navlog/jquery-migrate-1.2.1.js')}}"></script>
    <script src="{{url('app/js/navlog/jquery-ui.min.js')}}"></script>
    <script src="{{url('app/js/navlog/bootstrap.min.js')}}"></script>
    <script src="{{url('app/js/navlog/angular.min.js')}}"></script>
    <script src="{{url('app/js/navlog/moment.min.js')}}"></script>
    <script src="{{url('app/js/navlog/jquery.redirect.js')}}"></script>
    <script src="{{url('app/js/navlog/navlog.js')}}"></script>
    <script>
    $(function() {
        $("#datepicker").datepicker();
        $("#datepicker").change(function() {
            $("#datepicker").val(moment($("#datepicker").val(), 'MM-DD-YYYY').format('YYMMDD'))
        });
    });
    </script>
    <!--[if lt IE 9]>
        <html class="lt-ie9">
        <script src="{{url('app/js/html5shiv.js')}}"></script>
        <![endif]-->
</head>

<body id="body">
    <div>
        @yield('content')
        @include('includes.login',[]) 
        @include('includes.logout_v',[])
        <script src="{{url('app/js/ops/users.js')}}"></script>
    </div>
</body>

</html>
