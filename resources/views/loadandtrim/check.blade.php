@extends('layouts.lnt_layout',array('aircraft_callsign'=>'check'))
@section('content')

<style>
    .tdf-sec {
	border:20px solid #bbb;
	height: 600px;
	border-radius: 4px;
	margin-top: 15px;
	margin-bottom: 15px;
	padding: 0;
	background: #ffffff ;
    }
    .tdf-form {
	padding: 15px;
    }

    .tdf-form input[type=text] {
	border-radius: 5px;
	border:1px solid #ccc;
	height: 32px;
	margin-left: 3px;
	margin-right:3px;
	width: 27.5%;
	vertical-align: middle;
	font-size: 13px;
	padding: 0px 3px;
    }

    .tdf-form input[type=text]:focus {
	outline-color: #ff0000 ;
	border:none;
    }

    .tdf-check-button {
	margin-top:0;
	height: 30px;
	background: #F26232 ;
	background: linear-gradient(to top, #F26232 , #fa9b5b );
	background: #f1292b ;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858 ', endColorstr='#f1292b ');
	background: -webkit-gradient(linear, left top, left bottom, from(#f37858 ), to(#f1292b ));
	background: -moz-linear-gradient(top, #f37858 ,#f1292b );
	margin-left: 3px;
	font-size: 14px;
	line-height: 1;
	border:none;
    }

    .tdf-check-button:hover {
	color: #333;
    }

    .tdf-bg-grey {
	background: #eeeeee ;
    }
</style>



<div class="page">  
    @include('includes.new_header',[])
    <section>
	<div class="container">
	    <div class="row">
		<div class="col-md-offset-2 col-md-8 tdf-sec">
		    <div class="tdf-bg-grey">
			<form class="tdf-form">
			    <input type="text" class="formgroup" name="" placeholder="AIRCRAFT TYPE">
			    <input type="text" class="formgroup" name="" placeholder="FROM">
			    <input type="text" class="formgroup" name="" placeholder="TO">
			    <input type="button" class="btn btn-default tdf-check-button" value="CHECK">
			</form>
		    </div>
		</div>
	    </div>
	</div>
    </section>

    @include('includes.new_footer',[])
</div>
@stop