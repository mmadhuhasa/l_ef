<title>EFLIGHT | Trip Support</title>
<meta name="_token" content="{{ csrf_token() }}" />
<title>Flight Plan - Eflight - Flight Planning</title>           
<title>Flight Planning</title>        
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no"/>
<link rel="icon" href="{{url('app/new_temp/images/favicon/favicon.ico')}}" type="image/x-icon">

<link rel="stylesheet" href="{{url('app/new_temp/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('app/plugins/datatables/media/css/jquery.dataTables.min.css')}}">	
<style type="text/css" class="init"></style>
<link rel="stylesheet" type="text/css" href="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.css')}}">

<script src="{{url('app/js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>  	
<script type="text/javascript" language="javascript" src="{{url('app/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>	
<script src="{{url('app/js/bootstrap.min.js')}}" type="text/javascript"></script>        
<script src="{{url('app/new_temp/js/jquery-migrate-1.2.1.js')}}"></script>
<script type="text/javascript" src="{{url('app/plugins/jquery-ui-1.11.4.custom/jquery-ui.js')}}"></script>	
<!--<script type="text/javascript" src="{{url('app/plugins/bootstrap.js')}}"></script>-->
<script>
var base_url = {!! json_encode(url('/')) !!};
</script>
<script src="{{url('app/new_temp/js/script.js')}}"></script>
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