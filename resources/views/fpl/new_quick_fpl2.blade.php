@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<div class="page">
    <style>
        table.dataTable thead .sorting,
        table.dataTable thead .sorting_asc,
        table.dataTable thead .sorting_desc {
            background : none;
        }
        .p-lr-0 {
            padding-left:0;
            padding-right:0;
        }
        .p-r-9 {
            padding-right:9px;
        }
        .m-l-7 {
            margin-left:7px;
        }
        .tooltip_cancel {
            position: relative;
        }
        .tooltip_cancel_position,.tooltip_fpl_position, .tooltip_info_position, .tooltip_revise_position,.tooltip_change_position {
            position: absolute;
            top: -25px;
            left: 45px;
            padding: 3px 11px;
            color: #eee;
            border-radius: 4px;
            visibility: hidden;
            font-size: 10px;
            font-weight: normal;
            box-shadow: 0 0 1px 1px #ccc;
            background: #333333;
	    /*   background: linear-gradient(to top, #fa9b5b, #F26232);
	       filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#c35033');
	       background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#c35033));
	       background: -moz-linear-gradient(top, #f1292b, #c35033);*/
        }
        .tooltip_cancel:hover .tooltip_cancel_position,.tooltip_cancel:hover .tooltip_fpl_position, .tooltip_cancel:hover .tooltip_info_position,.tooltip_cancel:hover .tooltip_revise_position,.tooltip_cancel:hover .tooltip_change_position  {
            visibility: visible;
        }

        .tooltip_fpl_position {
            left: 41px;
            width: 81px;
        }
        .tooltip_info_position  {
            left: 35px;
        }
        .tooltip_revise_position {
            left: 54px;
            width: 78px;
        }

        .tooltip_change_position {
            left: -15px;
            width: 79px;
        }
        .new_fpl_heading,.search_heading {
            margin-bottom: 30px;
            text-align: center;
            padding: 7px 0;
            font-weight: 600;
            font-size: 15px;
            color:#fff;
            font-family:'pt_sansregular', sans-serif;
            background: #a6a6a6;
            background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
        }
        .search_heading {
            margin-bottom: 30px;
            text-transform: uppercase;
        }
        .dof_label {
            position: absolute;
            top:-24px;
            left:0px;
            font-size: 13px;
            color: #222;
        }
        .plan_check_label{
	    position: absolute;
            top:-24px;
            left:17px;
            font-size: 13px;
            color: #222;
        }
        .fpl_search_from_label, .fpl_search_to_label {
            position: absolute;
            top:-20px;
            left:26%;
            font-size: 13px;
            color:#222;
        }
        .form-row .deskview {
            width: 40%;
        }
        .form-row .deskprocess {
            width: 58%;
        }
        .search-band {
            padding-top:0px;
        }

        #process {
            width: 120px;
        }
        .form-row .form-search-row-right .ui-datepicker-trigger {
            height: 21px;
            top:6px;
        }
        .from_dp_pos .ui-datepicker-trigger {
            right: 9px;
            height: 23.5px;
            top: 5px;
        }

        .form-row .deskview .ui-datepicker-trigger {
            right: 10px;
            height: 21px;
            top: 6px;
        }
        #date_of_flight {
            font-size: 13px;
            font-weight: normal;
            color: #222;
            background: white;
            text-align:left;
            padding-left:5px;
            border-radius:4px;

        }
        .q_filter {
            width: 100%;
            float:left;
            padding-left: 10px;
            padding-right: 10px;
            box-shadow: 0 6px 8px 0px #a7a7a7;
        }
        .q_filter .depstatns, .q_filter .destatns {
            width:25%;


        }
        .from_to_adj_width {
            width:25%;
            padding-right: 15px;

        }
        .from_dp_pos {
            width: 100%;
        }
        .from_widthv {
            width: 40% !important;
        }
        #from_date {
            text-align: left;
            font-size: 13px;
            font-weight: normal;
            color: #222;
        }
        #to_date {
            padding-left: 5px;
            font-size:13px;
            font-weight: normal;
            color: #222;
            text-align: left;
            width: 151%;
            border-radius: 5px;
        }
        .to_widthv {
            width: 58% !important;
        }
        .top {
            margin-top:10px;
            margin-bottom: 10px;
            width: 100%;
            float: left;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            background: #eeeeee;
        }

        .fic-adc .send {
            width: 21%;
            padding-left: 5px;
            padding-right: 7px;
        }
        .desk-plan {
            border-collapse: collapse !important;
        }
        .desk-plan>thead {
            background: #F26232;
            background: linear-gradient(to top, #fa9b5b, #F26232);
            background: #f1292b;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
            background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
            background: -moz-linear-gradient(top, #f1292b, #f37858);
            border-top:1px solid #333333;
        }
        .desk-plan>tbody>tr>td {
            font-size: 13px;
        }
        .dataTables_wrapper {
            margin-left:25px;
            margin-right:25px;
        }
        .desk-plan tr:nth-child(odd) td{
            background: #ffffff;
        }
        .desk-plan tr:nth-child(even) td{
            background: #eeeeee;
        }
        .desk-plan tr:hover:nth-child(odd) td,.desk-plan tr:hover:nth-child(even) td {
            background: #999;
        }
        .desk-plan>thead>tr>th, .desk-plan>tbody>tr>td {
            padding:5px;
            border:1px solid #333;
            text-transform: uppercase;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding:1px 8px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            margin-left:10px;
        }
        @media only screen and (min-width : 320px) and (max-width : 767px) {
            .form-row .deskprocess {
                width: 49%;
            }
            .form-row .search-time-left {
                width: 23%;
            }
            .form-row .deskview {
                width: 49%;
            }
            .xs-p-lr-5 {
                padding-left: 5px;
                padding-right: 5px;
            }
            .xs-m-r-0 {
                margin-right:0;
            }
            .q_filter .depstatns, .q_filter .destatns {
                width: 100%;
            }
            .destatns {
                margin-bottom: 25px;
            }
            .from_widthv {
                width: 34% !important;
            }
            .fpl_from_box {
                width: 120px;
            }
            .fpl_to_box {
                width: 100px;
                margin-left: -10px;
            }
            .desk-view {
                width: 95%;
                margin: 0 auto;
                border-radius: 0px;
                overflow-x: scroll;
            }
            .fpl_deptime_label {
                margin-top: -15px;
            }
            label.timedpt {
                width: 50%;
                margin-top: 11px;
            }
            .sm-m-t-25 {
                margin-top:25px;
            }
            .dof_label {
                top:-19px;
                left:23%;
            }
            .from_to_adj_width {
                width: 100%;
            }

            .xs-p-l-10 {
                padding-left: 10px;
            }
            .desk-view {
                overflow-x: scroll;
            }

            .desk-plan {
                width: 1000px !important;
            }

            .plan-form {
                margin: 15px;
                width: 90%;
            }
            .success-note {
                width: 100%;
                margin:0 auto;
            }
            .buttons {
                width: 100%;
                margin:0;
            }
            .supplementary, .fdtl-info, .atc_after_process {
                border-right: none;
            }
            #process {
                width: 135px;
            }
            .from_widthv {
                width:33%;
            }
            #to_date {
                width:110%;
            }
            #date_of_flight {
                padding-left: 31px;
            }
            .xs-m-t-25 {
                margin-top: 25px;
            }

        }

        @media only screen and (min-width : 768px) and (max-width : 1024px) {
            .container {
                padding-left: 0px;
                padding-right:0px;
            }
            .q_filter .depstatns, .q_filter .destatns {
                width: 50%;
            }
            .q_filter .depstatns, .q_filter .destatns {

            }
            .q_filter {
                width: 100%;
            }

            .desk-view {
                width: 95%;
                margin: 0 auto;
                border-radius: 0px;
            }
            .fpl_deptime_label {
                margin-top:-20px;
            }
            .md-m-t-7 {
                margin-top: 7px;
            }
            .form-row .deskview {
                width: 49%;
            }
            .from_to_adj_width {
                width: 50%;
            }
            .desk-view {
                overflow-x: scroll;
            }
            .form-row .deskprocess {
                width: 49%;
            }
            .from_widthv {
                width: 40%;
            }
            .desk-plan {
                width: 1000px !important;
            }
            .supplementary, .fdtl-info, .atc_after_process {
                border-right: none;
            }
            #date_of_flight {
                padding-left: 50px;
            }
            #from_date {
                padding-left: 33px;
            }
            #to_date {
                padding-left: 40px;
                width:127%;
                border-radius:5px;
            }
            #process {
                width: 165px;
            }
            .depstatns {
                margin-bottom:10px;
            }
            .dof_label {
                top:-20px;
                left:30%;
            }
        }

	.animated {
	    animation-duration: 2s;
	}
	.animated.custdelay {
	    animation-iteration-count: 3;
	    -webkit-animation-iteration-count: 3;
	}

    </style>
    @include('includes.new_header',[])
    <main>
        <div class="container">
            <div class="bg-white">
                <div class=" fpl_sec">
                    <!--<div class="page_section">-->
                    <form data-toggle="validator"  onsubmit="return validform()" method="POST" role="form" name="fpl" id="quick_fpl" action="{{url('fpl')}}">
                        <div class="search-band">
                            <!--<div class="container cust-container">-->
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="new_fpl_heading">NEW FPL</p>
                                </div>
                                <div class="col-md-12">

                                    <div class="search">
                                        <div class="row m-t-15">
                                            <div class="col-sm-6 col-md-3">
                                                <!--  <label class="novalue" for="novalue">&nbsp;</label> -->
                                                <div class="form-group">
                                                    @if(Session::get('aircraft_callsign'))
                                                    <input required type="text" required="required" data-toggle ="popover" data-placement="bottom"   minlength="5" maxlength="5" autocomplete="off" data-url="{{url('/fpl/get_callsign_details')}}" readonly='readonly' value="{{Session::get('aircraft_callsign')}}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip departure_aerodrome_autocomplete get_plan_status"  placeholder="Call Sign" id="aircraft_callsign" name="aircraft_callsign" tabindex="1">
                                                    @else
                                                    <input required type="text" data-toggle ="popover" data-placement="bottom"   minlength="5" maxlength="5" autocomplete="off" data-url="{{url('/fpl/get_callsign_details')}}" {{(isset($aircraft_callsign)) ?  "readonly='readonly'": ""}} value="{{ (isset($aircraft_callsign)) ?  $aircraft_callsign: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip departure_aerodrome_autocomplete get_plan_status"  placeholder="Call Sign" id="aircraft_callsign" name="aircraft_callsign" tabindex="1">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <!-- <label class="novalue" for="novalue">&nbsp;</label> -->
                                                <div class="form-row">
                                                    <div class="form-search-row-left">
							<span class="plan_check_label font-bold" style="color: #333" id="get_plan_status"></span> 
<!--                                                       <span class="plan_check_label" id="get_plan_status"></span> -->
                                                        <div class="form-group">
                                                            @if(Session::get('destination_aerodrome'))
                                                            <input required="required"  type="text" data-toggle = "popover"  data-placement="bottom"   minlength="4" maxlength="4"  name="departure_aerodrome" autocomplete="off" id="departure_aerodrome" readonly='readonly' value="{{Session::get('destination_aerodrome')}}" class="alphabets text-center font-bold text_uppercase validation_class form-control get_plan_status"  placeholder="From"  tabindex="2">
                                                            @else
                                                            <input required="required" type="text" data-toggle = "popover"  data-placement="bottom"   minlength="4" maxlength="4"  name="departure_aerodrome" autocomplete="off" id="departure_aerodrome" {{ (isset($departure_aerodrome)) ?  "readonly='readonly'": "" }} value="{{ (isset($departure_aerodrome)) ?  $departure_aerodrome: "" }}" class="alphabets redirect text-center font-bold text_uppercase validation_class form-control get_plan_status"  placeholder="From" data-redirect-url="{{url('fpl?page=new_full_fpl')}}" data-url="{{url('fpl/check_callsign_exist')}}" tabindex="2">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-search-row-right">
                                                        <div class="form-group">
                                                            <input required="required"  type="text" data-toggle = "popover"  data-placement="bottom"   minlength="4" maxlength="4" class="alphabets text-center font-bold text_uppercase validation_class form-control get_plan_status" autocomplete="off"  {{ (isset($destination_aerodrome)) ?  "readonly='readonly'": "" }} placeholder="To" value="{{ (isset($destination_aerodrome)) ?  $destination_aerodrome: "" }}" name="destination_aerodrome" id="destination_aerodrome" tabindex="3" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 fpl_deptime_label">
                                                <label for="depart-time" class="flytime timedpt">Departure Time</label>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="form-time-left search-time-left">
                                                            @if(isset($departure_time_hours))
                                                            <dl  id="hour" class="dropdown form-control validation_class_click disabled_color"   data-toggle = "popover"  data-placement="top">
                                                                <dt><a>
                                                                        <span style="font-size: 13px;text-align: center" class="dept_time_hours_text disabled_color"  readonly>{{$departure_time_hours}}</span>
                                                                    </a>
                                                                </dt>
                                                            </dl>
                                                            @else
                                                            <dl id="hour" class="dropdown form-control validation_class_click"   data-toggle = "popover"  data-placement="top">
                                                                <dt><a>
                                                                        <span id="dep_time_hours" readonly>Hr</span>
                                                                    </a>
                                                                </dt>
                                                                <dd>
                                                                    <ul>
                                                                        @for ($i = 00; $i <= 23; $i++)
                                                                        <li class="departure_time_hours" data-url="{{url('/fpl/get_callsign_details2')}}"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                        @endfor
                                                                    </ul>
                                                                </dd>
                                                            </dl>
                                                            @endif
                                                        </div>
                                                        <div class="form-time-left search-time-left">
                                                            @if(isset($departure_time_minutes))
                                                            <dl id="mins" class="dropdowns form-control validation_class_click disabled_color"  data-toggle = "popover"  data-placement="top">
                                                                <dt><a>
                                                                        <span style="font-size: 13px;text-align: center" class="dept_time_hours_text disabled_color">{{$departure_time_minutes}}</span>
                                                                    </a>
                                                                </dt>
                                                            </dl>
                                                            @else
                                                            <dl id="mins" class="dropdowns form-control validation_class_click"  data-toggle = "popover"  data-placement="top">
                                                                <dt><a>
                                                                        <span id="dep_time_minutes" >Min</span>
                                                                    </a>
                                                                </dt>
                                                                <dd>
                                                                    <ul>
                                                                        @for ($i = 00; $i <= 55; $i+=5)
                                                                        <li class="departure_time_minutes" data-url="{{url('/fpl/get_callsign_details2')}}"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                        @endfor
                                                                    </ul>
                                                                </dd>
                                                            </dl>
                                                            @endif
                                                        </div>
                                                        <div class="form-time-right search-time-right">
                                                            <div id="newtimeTM" class="newtime"> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3 md-m-t-7 xs-m-t-25">
                                                <!-- <label class="novalue" for="novalue">&nbsp;</label> -->
                                                <div class="form-row">
                                                    <div class="form-search-row-left deskview">
                                                        <div class="form-group">
                                                            <div class="input-group" style="width:100%">
                                                                @if(isset($date_of_flight))
                                                                <input type="text" autocomplete="off" data-url="{{url('/fpl/get_callsign_details2')}}" value="{{$date_of_flight}}" readonly='readonly' style="background: #eee; text-align:center;width: 132px" class="form-control text-center font-bold" placeholder="Date of Flight" name="date_of_flight" id="date_of_flight" minlength="6" maxlength="6" tabindex="5" readonly="readonly">
                                                                @elseif(Session::get('date_of_flight'))
                                                                <input type="text" autocomplete="off" data-url="{{url('/fpl/get_callsign_details2')}}" value="{{Session::get('date_of_flight')}}" readonly='readonly' style="background: white; text-align:left;" class="form-control text-center font-bold datepicker pointer" placeholder="Date of Flight" name="date_of_flight" id="date_of_flight" minlength="6" maxlength="6" tabindex="5" readonly="readonly">
                                                                @else
                                                                <input type="text" autocomplete="off" data-url="{{url('/fpl/get_callsign_details2')}}" value="{{ date('ymd') }}"  class="form-control text-center font-bold datepicker pointer"placeholder="Date of Flight" name="date_of_flight" id="date_of_flight" minlength="6" maxlength="6" tabindex="5" readonly>
                                                                @endif
                                                                <span class="dof_label">Date of Flight</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-search-row-right processbtn deskprocess">
                                                        <div class="form-group">
                                                            @if(isset($is_process) || isset($is_new_plan))
                                                            <a data-toggle="modal" href="#resetbox" class="btn newbtnv1"  tabindex="14" style="line-height: 19px;right: -50px">Reset</a>
                                                            @elseif(Session::get('is_plan_filed'))
                                                            <a style="width:100%" data-toggle="modal" id="reset" href="#resetbox" class=" btn newbtnv1"  tabindex="14">Reset</a>
                                                            <div class="newbtnv1 b-radius-5">
                                                                <input  type="submit" class="btn btn_appearance hidden" name="flag" data-name="Process" value="Process" id="process"  data-url="{{url('/fpl/process_quick_plan')}}" tabindex="14">
                                                            </div>
                                                            @else
                                                            <div class="newbtnv1 b-radius-5">
                                                                <input type="submit" class="btn btn_appearance" name="flag" data-name="Process" value="Process" id="process"  data-url="{{url('/fpl/process_quick_plan')}}" tabindex="14" />
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(isset($pilot_in_command))
                                                    <input required="required" type="text" data-toggle = "popover"   data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command" style="background: #eee" readonly='readonly' value="{{$pilot_in_command}}" placeholder="Pilot Name" name="pilot_in_command"  id="pilot_in_command" tabindex="6">
                                                    @elseif(Session::get('pilot_in_command'))
                                                    <input required="required" type="text" data-toggle = "popover"   data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command" value="{{Session::get('pilot_in_command')}}" placeholder="Pilot Name" name="pilot_in_command"  id="pilot_in_command" tabindex="6">
                                                    @else
                                                    <input required="required" type="text" data-toggle = "popover"   data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command" value="{{ (isset($pilot_in_command)) ?  $pilot_in_command: "" }}" placeholder="Pilot Name" name="pilot_in_command"  id="pilot_in_command" tabindex="6">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(Session::get('mobile_number'))
                                                    <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="10" maxlength="11" autocomplete="off" class="numeric validation_class text-center font-bold form-control"   value="{{Session::get('mobile_number')}}" placeholder="Mobile Number" name="mobile_number"  id="mobile_number" tabindex="7">
                                                    @elseif(isset($mobile_number))
                                                    <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="10" maxlength="11" autocomplete="off" class="numeric validation_class text-center font-bold form-control" readonly='readonly' value="{{ (isset($mobile_number)) ?  $mobile_number: "" }}" placeholder="Mobile Number" name="mobile_number"  id="mobile_number" tabindex="7">
                                                    @else
                                                    <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="10" maxlength="11" autocomplete="off" class="numeric validation_class text-center font-bold form-control" value="{{ (isset($mobile_number)) ?  $mobile_number: "" }}" placeholder="Mobile Number" name="mobile_number"  id="mobile_number" tabindex="7">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(Session::get('copilot'))
                                                    <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command" value="{{Session::get('copilot')}}" placeholder="Co Pilot Name" name="copilot"  id="copilot" tabindex="8">
                                                    @elseif(isset($copilot))
                                                    <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command" readonly='readonly' value="{{ (isset($copilot)) ?  $copilot: "" }}" placeholder="Co Pilot Name" name="copilot"  id="copilot" tabindex="8">
                                                    @else
                                                    <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command"  value="{{ (isset($copilot)) ?  $copilot: "" }}" placeholder="Co Pilot Name" name="copilot"  id="copilot" tabindex="8">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(Session::get('cabincrew'))
                                                    <input type="text" data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class form-control pilot_in_command" value="{{Session::get('cabincrew')}}" placeholder="Cabin Name" name="cabincrew"  id="cabincrew" tabindex="9">
                                                    @else
                                                    <input type="text"  data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class form-control pilot_in_command" {{ (isset($cabincrew)) ?  "readonly='readonly'": "" }} value="{{ (isset($cabincrew)) ?  $cabincrew: "" }}" placeholder="Cabin Name" name="cabincrew"  id="cabincrew" tabindex="9">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(Session::get('destination_station'))
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ Session::get('destination_station')}}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control get_plan_status" id="departure_station" name="departure_station" placeholder="Dep. Station" tabindex="10">
                                                    @else
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ (isset($departure_station)) ?  $departure_station: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="departure_station" name="departure_station" placeholder="Dep. Station" tabindex="10">
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(Session::get('destination_latlong'))
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="11" maxlength="15" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ Session::get('destination_latlong') }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="departure_latlong" name="departure_latlong" placeholder="Dep. Lat-Long" tabindex="11">
                                                    @else
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="11" maxlength="15" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ (isset($departure_latlong)) ?  $departure_latlong: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="departure_latlong" name="departure_latlong" placeholder="Dep. Lat-Long" tabindex="11">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(0)
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ Session::get('destination_station') }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="destination_station" name="destination_station" placeholder="Dest. Name" tabindex="12">
                                                    @else
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ (isset($destination_station)) ?  $destination_station: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control get_plan_status" id="destination_station" name="destination_station" placeholder="Dest. Name" tabindex="12">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(0)
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="9" maxlength="15" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}' value="{{ Session::get('destination_latlong') }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="destination_latlong" name="destination_latlong" placeholder="Dest. Lat-Long" tabindex="13">
                                                    @else
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="9" maxlength="15" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}' value="{{ (isset($destination_latlong)) ?  $destination_latlong: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="destination_latlong" name="destination_latlong" placeholder="Dest. Lat-Long" tabindex="13">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 p-lr-0">
					    <div class="form-group">
						@if(isset($remarks))
						<input type="text" autocomplete="off" readonly="readonly" class="form-control text-center font-bold text_uppercase validation_class route_allowed_chars" name="remarks" id="remarks" value="{{ (isset($remarks)) ?  $remarks: "" }}" placeholder="Remarks" data-toggle="popover" data-placement="bottom" maxlength="150" minlength="3" data-original-title="" title="">
						@else
						<input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class route_allowed_chars" name="remarks" id="remarks" value="" placeholder="Remarks" data-toggle="popover" data-placement="bottom" maxlength="150" minlength="3" data-original-title="" title="">
						@endif
					    </div>
					</div>
                                        <div class="row mobileprocess">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a href="#" class="btn btn__secondary"><span>Process</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--input hidden fields-->
                                    <input type="hidden" name="email" id="email" value="{{Auth::user()->email}}" />
				    <input type="hidden" name="is_myaccount" id="is_myaccount" value="{{(isset($is_myaccount)) ? $is_myaccount : '' }}" />
                                    <input type="hidden" name="environment" id="environment" value="{{env('APP_ENV')}}" />
                                    <input type="hidden" name="total_time_after_flying" id="total_time_after_flying" value="" />
                                    <input type="hidden" name="total_flying_time_format1" id="total_flying_time_format1" value="" />
                                    <input type="hidden" name="total_flying_time_format2" id="total_flying_time_format2" value="" />
                                    <input type="hidden" name="is_app" id="is_app" value="0" />
                                    <input type="hidden" name="is_web" value="1">
                                    <input type="hidden" name="is_new_plan" id="is_new_plan" value="{{(isset($is_new_plan)) ? $is_new_plan : ''  }}">
                                    @include('includes.hidden_fields',[])
                                    <!--input hidden fields-->
                                </div>
                            </div>
                            <!--</div>-->
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="success">
                                    <div class="success-note">
                                        <div class="success-left animated infinite zoomIn custdelay">
                                            <div id="mysuccess">
                                                @if(Session::get('success'))
                                                <div class="success-left animated infinite zoomIn custdelay">
                                                    <!--<p>FLIGHT PLAN SUCCESSFULLY SUBMITTED</p>-->
                                                    <span class="success-font">{{Session::get('success')}}</span>
                                                    @if(Session::get('is_plan_filed'))
                                                    <p><span>{{Session::get('aircraft_callsign')}}</span>&nbsp; &nbsp; <span>{{Session::get('departure_aerodrome')}}</span> &nbsp;&gt;&gt;&nbsp;
                                                        <span>{{Session::get('destination_aerodrome')}}</span>
                                                        <a style="padding-left: 19px" href="{{url('fpl/file_plan/'.Session::get('id'))}}">
                                                            <img src="{{url('media/pdf/pdf.png')}}" class="" alt="pdf">
                                                        </a>
                                                    </p>
                                                    @endif
                                                </div>


                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Beginning of Edit And FILE Confirmation Modal Box -->
                        @include('includes.edit_modal',[])
                        @include('includes.file_modal',[])
                        @include('includes.reset_modal',[])
                        <!-- End of Edit And FILE Confirmation Modal Box -->
                    </form>
                    <section>

			<?php $border_dashed = "" ?>
                        @if(isset($is_process) || isset($is_new_plan))
			<?php $border_dashed = "atc_after_process" ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12 plan-form">
                                        <div class="row">
                                            <div class="col-md-12 box shadow-effect">
                                                <div class="row">
                                                    <div class="col-md-6 atc-section  {{$border_dashed}}">
                                                        <div class="atc-view">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>ATC FPL</h5>
                                                                    <span id="qucik_responce">
                                                                        {!! (isset($fpl_info)) ?  str_ireplace('<br>', "<span class='clearfix'></span>", $fpl_info) : ' <div id="fpl_view" style="height: 200px;display:none;"></div>' !!}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @if(isset($is_process) || isset($is_new_plan))
                                                                <div class="buttons">
                                                                    <div class="row">
                                                                        <div class="col-xs-offset-1 col-xs-5 col-sm-offset-3 col-sm-3 col-md-offset-3 col-md-3 btn-align">
                                                                            <!--<input  data-toggle="modal" class="btn newbtn_black" data-target="#editbox"     type="button"  value="Edit" >-->
                                                                            <button data-toggle="modal" class="btn newbtn_black" style="height:36px;" data-target="#editbox"  {{(isset($is_process) || isset($is_new_plan)) ? '' : 'disabled="disabled"'}} >Edit</button>
                                                                        </div>
                                                                        <div class="col-xs-5 col-sm-2 col-md-4 btn-align file-cnf">
                                                                            <!--<input data-toggle="modal" data-target="#confbox" type="button"  id="file" {{(isset($is_process) || isset($is_new_plan))? '' : 'disabled="disabled"'}} class="btn btn-primary file-btn" name="flag" value="File">-->
                                                                            <!--<input  type="button"   value="File">-->
                                                                            <button id="file"  name="flag" data-url="{{url('new_fpl/get_auto_num_details')}}" class="btn newbtnv1 file-btn file_the_process" style="height:36px;">File</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(isset($is_process) || isset($is_new_plan))
                                                    <div class="col-md-6">
                                                        <div class="fdtl-info">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>FDTL</h5>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    @else

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 plan-form btmmargin">
                                        <div class="row">
                                            <div class="col-md-12 box shadow-effect">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12 supplementary supplementary-height">
                                                                <h5><b style="font-size: 16px;">Supplementary info</b></h5>
                                                                <span id="supplementary">
                                                                    {!! (isset($supplementary_info)) ? str_ireplace('<br>', "<span class='clearfix'></span>", $supplementary_info) : '' !!}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="notam-notes">
                                                            <h5><b style="font-size: 16px;">NOTAMs</b></h5>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 plan-form btmmargin">
                                        <div class="row">
                                            <div class="col-md-12 box shadow-effect">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12 supplementary station-height">
                                                                <!--                                <div class="station_info">
                                                                                                                                    <ul>
                                                                                                                                        <li><h5>Pondicherry (VOPC)</h5></li>
                                                                                                                                        <li>ARP: 1157N07948E</li>
                                                                                                                                        <li>Elevation: 134Feet</li>
                                                                                                                                    </ul>
                                                                                                                                </div>
                                                                                                                                <div class="stat-desc">
                                                                                                                                    <span class="stat-head">Status :</span> <span class="stat-status">AAI Domestic Airport</span>
                                                                                                                                </div>
                                                                                                                                <div class="stat-desc">
                                                                                                                                    <span class="stat-head">Runways :</span> <span class="stat-status">07/25</span>
                                                                                                                                    <span class="stat-head">Length:</span> <span class="stat-status">4500 Feet</span>
                                                                                                                                </div>
                                                                                                                                <div class="stat-desc">
                                                                                                                                    <span class="stat-head">FRI Sunrise :</span> <span class="stat-status">5:45</span>
                                                                                                                                    <span class="stat-head">Sunset:</span> <span class="stat-status">18:31</span>
                                                                                                                                </div>
                                                                                                                                <div class="stat-desc">
                                                                                                                                    <span class="stat-head">Sat Sunrise:</span> <span class="stat-status">5:45</span>
                                                                                                                                    <span class="stat-head">Sunset:</span> <span class="stat-status">18:31</span>
                                                                                                                                </div>-->

                                                                {!! (isset($get_dept_sunrise_sunset_info)) ? $get_dept_sunrise_sunset_info : '' !!}

                                                                <div class="stat-desc">
<!--                                    <span class="stat-head">Watch Hours (in UTC):</span> FRI = 0330 to 0830,   SAT = Closed     -->
                                                                    {!!(isset($get_dept_watch_hours_info)) ? $get_dept_watch_hours_info : ''!!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="notam-notes">
                                                            {!! (isset($get_dest_sunrise_sunset_info)) ? $get_dest_sunrise_sunset_info : '' !!}
                                                            <div class="stat-desc">
                                                                {!!(isset($get_dest_watch_hours_info)) ? $get_dest_watch_hours_info : ''!!}
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @else
                        <div class="row">
			    <div class="col-md-12">
                                <p class="search_heading">Search Account</p>
                            </div>
                            <div class="col-md-12" style="width:100%;float:left">
                                <div class="q_filter">
                                    <!--<form name="search" id="search" method="post" action="{{url('/fpl')}}">-->
                                    <form data-url="{{url('/new_fpl/get_filter_data')}}" name="search" id="fpl_search" method="post" action="#">
                                        <div class="col-sm-6 col-md-3 xs-p-lr-5">
                                            <div class="form-group">
                                                <input type="text" data-toggle ="popover" data-placement="bottom"  minlength="5" maxlength="7" autocomplete="off"   class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip"  placeholder="Call Sign" id="aircraft_callsign2" name="aircraft_callsign2" tabindex="1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6  col-md-3 depstatns xs-p-lr-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control text_uppercase alphabets font-bold stations" id="departure_aerodrome2" minlength="4" maxlength="4"  name="departure_aerodrome2" placeholder="Dep AeroDrome">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 destatns xs-p-lr-5">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control destination text_uppercase alphabets font-bold stations" id="destination_aerodrome2" minlength="4" maxlength="4"  name="destination_aerodrome2" placeholder="Dest AeroDrome">
                                                    <div class="input-group-addon search-addon">
                                                        <button id="first" type="submit" name="flag" value="search" class="btn newbtnv1"><span class="glyphicon glyphicon-search"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 xs-p-lr-5 from_to_adj_width">
                                            <div class="form-row">
                                                <div class="form-search-row-left from_widthv">
                                                    <div class="form-group">
                                                        <div class="input-group from_dp_pos">
                                                            <input type="text"  autocomplete="off" class="form-control font-bold from_date pointer fpl_from_box" placeholder="FROM" name="from_date" id="from_date" minlength="6" maxlength="6" tabindex="5" readonly style="border-radius:4px;
                                                                   ">
                                                            <span class="fpl_search_from_label">FROM</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-search-row-right to_widthv">
                                                    <div class="form-group">
                                                        <div class="input-group xs-m-r-0">
                                                            <input type="text" autocomplete="off" class="form-control font-bold to_date pointer fpl_to_box" placeholder="TO" name="to_date" id="to_date" minlength="6" maxlength="6" tabindex="5" readonly>
                                                            <span class="fpl_search_to_label">TO</span>
                                                            <div class="input-group-addon search-addon">
                                                                <button id="second" type="submit" name="flag" value="search" class="btn newbtnv1"><span class="glyphicon glyphicon-search"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <input type="hidden" name="url" id="url" value="{{url('')}}">
                                                <input type="hidden" name="date_of_flight2" id="date_of_flight2" value="{{date('ymd')}}" />
                                                <input type='hidden' name='current_time' id='current_time' value="{{date('Hi')}}" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <form id="" name="">
                            <div id="result">
                                <div class="desk-view">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:18px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
                                            <table class="fpl_info table table-hover table-responsive desk-plan">
                                                <thead>
                                                    <tr>
                                                        <th class="slno">Sl</th>
                                                        <th class="dof thdof">Flight Date</th>
                                                        <th class="calsign thcalsign">Call Sign</th>
                                                        <th class="from thfrom">From</th>
                                                        <th class="to thto">To</th>
                                                        <th class="dpt thdpt">Departure Time</th>
                                                        <th class="ficadc thficadc">FIC-ADC</th>
                                                        <th class="pdf thpdf">FPL</th>
                                                        <th class="weather thnotam">NOTAM</th>
                                                        <th class="weather thweather">Weather</th>
                                                        <th class="fildate thchange">Change</th>
                                                    </tr>
                                                </thead>
                                                @include('includes.new_myaccount_modals')
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
                                <!--<div id="api"></div>-->
                            </div>
                        </form>
                        @endif
                        <!--</div>-->
                    </section>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </main>
    @include('includes.new_footer',[])
</div>
@stop