@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/app/css/navlog/common.css')}}">

<script type="text/javascript">
	$(function () {
            // Datepicker code
            $(".datepicker").datepicker({
                showOn: 'both',
                buttonImage: base_url + '/media/ananth/images/calender-icon1.png',
                buttonImageOnly: true,
                // minDate: min_date,
                // maxDate: max_date,
                showOtherMonths: true,
                selectOtherMonths: true,
                showAnim: "slide",
                dateFormat: 'yy-mm-dd',

            });
            $(".datepicker").datepicker("option", "dateFormat", "ymmdd");
            $(".datepicker").datepicker("setDate", new Date());
	})

</script>
<style type="text/css">
    .notam-strip{
        width: 100%;
        margin: 7px 0px;
        padding: 7px 7px;
        border: 1px solid #d5d5d5;
        float: left;
        border-radius: 5px;
        font-size: 12px;
        font-family: monospace;
        background: #fff;
        margin-right: 0;
    }
    .to-date{
        text-align: right;
    }
    .margin-0{
        margin: 0;
    }
    .margin-b-5{
        margin-bottom: 5px;
    }
    .p-l-0 {
    padding-left:0;
	}
	.p-r-0 {
	    padding-right:0;
	}
	.p-lr-0 {
	    padding-left:0;
	    padding-right:0;
	}
    .desc{
        text-align: justify;
        font-weight: bold;
        font-size: 13px;
        line-height: 1.2;
        margin-top:5px !important; 
    }
    .time-strip{
        margin-top: 5px !important;
    }
    .container-notam{
        background: #fff;
        margin-bottom: 15px;
        width: 825px !important;
    }
    .aerodrome_name{
        padding: 4px;
        background:-webkit-gradient(linear, 0% 100%, 0% 0%, from(rgb(123, 122, 122)), color-stop(0.5, rgb(4, 4, 4)), to(rgb(167, 164, 164)));
        border-radius: 5px;
        clear: both;
        color: #fff;
        font-weight: bold;
    	font-size: 14px;

    }
    .qline{
        margin-left: 10px;
        font-size: 13px;
        float: right;
    }
    .col{
        width: 21%;
    }
    .p-lr-15{
        padding-left: 15px;
        padding-right: 15px;
    }
    .p-l-3{
        padding-left: 3px;
    }
    .p-r-3{
        padding-right: 3px;
    }
    #notam input{
    	height: 33px;
    }
    #notam input:focus{
        border: 1px solid #f1292b ;
    }
    .form-control{
        border: 1px solid #999 ;
        border-radius: 4px !important;
    }
   
    .input-group-addon{
        /*position: absolute;*/
        top: 0px;
        right: 0;
    }
    .p-t-10{
        padding-top: 10px;
    }
    .search-btn{
	    width: 40px;
	    height: 33px;
		transition: all 0.25s ease;
	    overflow: hidden;
	    display: inline-block;
	    margin-bottom: 0;
	    color: #fff;
	    font-size: 14px;
	    line-height: 20px;
	    font-weight: 300;
	    text-transform: uppercase;
	    text-align: center;
	    vertical-align: middle;
	    cursor: pointer;
	    border: none;
	    background: #F26232;
	    background: linear-gradient(to top, #fa9b5b, #F26232);
	    background: #f1292b;
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
	    background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
	    background: -moz-linear-gradient(top, #f37858, #f1292b);
	    z-index: 1;
	    border-radius: 0 4px 4px 0;
    }
    .search-btn:hover:before {
	    visibility: visible;
	    width: 200%;
	    left: -46%;
	}
	.search-btn:before {
	    -webkit-transition: all 0.35s ease;
	    -moz-transition: all 0.35s ease;
	    -o-transition: all 0.35s ease;
	    transition: all 0.35s ease;
	    -webkit-transform: skew(45deg,0);
	    -moz-transform: skew(45deg,0);
	    -ms-transform: skewX(45deg) skewY(0);
	    -o-transform: skew(45deg,0);
	    transform: skew(45deg,0);
	    -webkit-backface-visibility: hidden;
	    content: '';
	    position: absolute;
	    visibility: hidden;
	    top: 0;
	    left: 50%;
	    width: 0;
	    height: 100%;
	    background: #333;
	    z-index: -1;
	    color:#fff;
	}
	.search-btn:hover{
    	box-shadow: none !important;
	}
    ::-webkit-input-placeholder {
	    text-align:left;   
	    font-size: 11px;
	    text-transform:uppercase; 
	    color:#666 !important;
	}

	:-moz-placeholder { /* Firefox 18- */
	    text-align:left;  
	    font-size: 11px;
	    text-transform:uppercase; 
	    color:#666 !important;
	}

	::-moz-placeholder {  /* Firefox 19+ */
	    text-align:left;  
	    font-size: 11px;
	    text-transform:uppercase; 
	    color:#666 !important;
	}

	:-ms-input-placeholder {  
	    text-align:left;   
	    font-size: 11px;
	    text-transform:uppercase;
	    color:#666 !important;
	}
    #from-date-block .ui-datepicker-trigger {
        right: 20px;
    }
    #from-date-block .datepicker{
        text-align: left;
        padding-left: 11px;
    } 
    #end-date-block .datepicker{
        text-align: left;
        padding-left: 7px; 
    } 

	.ui-datepicker-trigger {
	    right: 5px;
	    height: 21px;
	    top: 6px;
	    position: absolute;
	    z-index: 2;
	    cursor: pointer;
	}
	.notam-input-with-searchbtn{
		border-radius: 4px 0px 0px 4px !important;
	}
    .popover-content {
         font-family: 'pt_sansregular';
    }

    .popover {
        width: 250px;
        background-color: #333;
        border: #eeeeee solid 2px;
        font-family: 'pt_sansregular';
        margin-top: 0px;
        text-align: center;
        color: white
    }
</style>
<div class="page">
    @include('includes.new_fpl_header',[])
    <main>
        <section class="bg-1 welcome infopage" ng-app="navlog" ng-controller="notamsFilterCtrl">
            <div class="container container-notam" id="notam">
                <div class="row">
                    <div class="wheather_sec p-t-10">
                    	<div class="row">
	                    	<div class="col-md-6 p-r-0">
	                    		<div class="col-md-10 p-r-0"><input type="text" class="form-control notam-input-with-searchbtn" ng-model="notamsFilter.airportcode" id="airportcode" placeholder="Enter Airport or FIR ICAO Codes" data-toggle="popover" data-placement="top" maxlength="34"></div><div class="col-md-2 p-l-0"><button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button></div>
	                    	</div>
	                    	<div class="col-md-6 p-l-0">
	                    		<div class="col-md-7 p-lr-0">
		                    		<div class="col-md-5 p-l-0" id="from-date-block"><input type="text" class="form-control datepicker" ng-model="notamsFilter.fromdate" id="fromdate"></div>
		                    		<div class="col-md-4 p-lr-0" id="end-date-block"><input type="text" class="form-control notam-input-with-searchbtn datepicker" ng-model="notamsFilter.todate" style="text-align:left; padding-left:5px;" id="todate"></div>
		                    		<button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button>
	                    		</div>
	                    		<div class="col-md-5 p-lr-0">
		                    		<div class="col-md-4 p-lr-0 p-r-3"><input type="text" class="form-control" ng-model="notamsFilter.startTime" id="startTime" data-toggle="popover" data-placement="top" maxlength="4"></div>
		                    		<div class="col-md-4 p-lr-0 p-l-3"><input type="text" class="form-control notam-input-with-searchbtn " ng-model="notamsFilter.endTime" id="endTime" data-toggle="popover" data-placement="top" maxlength="4"></div>
		                    		<button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button>
	                    		</div>	
	                    	</div>
                    	</div>
                    	<div class="row" style="margin-top:10px;">
	                    	<div class="col-md-6">
	                    		<div class="col-md-6 p-r-0">
		                    		<div class="col-md-9 p-lr-0"><input type="text" class="form-control notam-input-with-searchbtn" placeholder="Search Notam number" ng-model="notamsFilter.notamNumber" id="notamNumber" data-toggle="popover" data-placement="top"></div>
		                    		<button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button>
	                    		</div>
								<div class="col-md-6 p-lr-0" style="margin-left: -4px;">
		                    		<div class="col-md-9 p-lr-0"><input type="text" class="form-control notam-input-with-searchbtn" placeholder="Check Route Notams"  ng-model="notamsFilter.routeNotams" id="routeNotams" data-toggle="popover" data-placement="top"></div>
		                    		<button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button>
	                    		</div>
	                    			
	                    	</div>
	                    	<div class="col-md-6 p-lr-0">
	                    		<div class="col-md-10 p-lr-0"><input type="text" class="form-control notam-input-with-searchbtn" placeholder="Search Notam Category"  ng-model="notamsFilter.notamCategory" id="notamCategory" data-toggle="popover" data-placement="top"></div><div class="col-xs-2 p-l-0"><button class="btn search-btn" ng-click="filterNotams()"><span class="glyphicon glyphicon-search"></span></button></div>
	                    	</div>
                    	</div>
                    </div>
                </div>
                <div class="row">
                    <div class="wheather_sec p-t-10">
                        @if(isset($notams_array) && isset($airport))		    
                        <div class="p-l-15 p-10 aerodrome_name">
                            {{$airport}}  <span class="p-l-25">{{count($notams_array)}} NOTAMS </span>
                            <a href="{{url('notams/download/'.$aero_code)}}"><img style="display: inline-block;width: 18px;" src="{{url('media/ananth/images/pdf.png')}}" class="img-responsive" alt="pdf"></a>
                        </div> 
                        @endif

                        <div class="p-lr-15">
                            @if(isset($notams_array))
                            @foreach ($notams_array as $key) 
                            <div class="notam-strip" ng-repeat="item in responseData.notams_array">
                                <div  class="row col-sm-6 margin-0 p-l-0" >
                                	<div class="p-l-0 col-sm-1" ng-bind="item.notam_no">
                                		{!! $key['notam_no'] !!} 
                                	</div>
                                	 <div class="col-sm-10 p-r-0 margin-0">
	                                    <span class="col-sm-6 to-date p-lr-0">	FROM: {!! $key['e_start_date_formatted'] !!}</span> 
	                                    @if($key['e_end_date_formatted']=='31-Dec-9999')
	                                    <span class="col-sm-6 to-date p-lr-0">  TO: PERMANENT </span>
	                                    @else
	                                    <span class="col-sm-6 to-date p-lr-0">  TO: {!! $key['e_end_date_formatted'] !!}</span>
	                                    @endif
                                	</div>
                                </div>  
                                <div class="row col-sm-6 p-r-0 margin-0">
                                	<span class="qline">@if($key['notam_Qline1'] || $key['notam_Qline2']) CATEGORY: @else &nbsp; @endif @if($key['notam_Qline1']!='XX'){!! $key['notam_Qline1'] !!}@endif @if($key['notam_Qline2']!='XX'){!! $key['notam_Qline2'] !!}@endif </span>
                                </div>
                                <div class="row margin-0 desc"> {!! $key['description'] !!} </div>  

                                <!-- <div class="row margin-0 margin-b-5">TIME  : {!! $key['e_start_time_formatted'] !!} - {!! $key['e_end_time_formatted'] !!} UTC  ({!! $key['e_start_time_formatted_ist'] !!} - {!! $key['e_end_time_formatted_ist'] !!} IST) </div>   -->
                                <div class="row margin-0 margin-b-5 time-strip">@if($key['time']) TIME: {!! $key['time'] !!} @else &nbsp; @endif  </div>  
                            </div>
                            @endforeach
                            @endif
                        </div>		
                    </div>
                </div>
              
            </div>
        </section>
    </main>   


    @include('includes.new_footer',[])
</div>
@stop