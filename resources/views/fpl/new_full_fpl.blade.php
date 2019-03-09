@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<style>
    form.uppercase{
        text-transform: uppercase;
    }
    .flydate-left .ui-datepicker-trigger {
        right: 10px;
        height: 21px;
        top: 6px;

    }
    #date_of_flight {
        border-radius:4px;
    }

    .cust_label {
        text-align: center;
        font-size: 13px;
        font-weight: normal;
        display: block;
        margin-bottom: 1px;
    }
    .novalue {
        margin-bottom: 1px;
    }
    .equipment, .credit, .nocredit, .color_checkbox {
        margin-top:25px;
    }
    .wtcat dd ul, .transmode dd ul {
        top:59px;
        z-index:999;
    }

    @media only screen and (min-width : 320px) and (max-width : 767px) {
        .container-fluid {
            margin-top: 56px;
        }
        .transmode, #equipment {
            height: 42px;
            line-height: 1;
        }
        .transmode dd ul {
            width: 105px;
            top:42px;
            z-index: 999;
        }

        .xs-w96 {
            width: 96% !important;
        }

        .plan-row .dep-station {
            width: 96%;
        }
        .places {
            width: 50%;
            float: left;
        }
        .alternate-xs-1 {
            width: 50%;
            margin-top: -30px;
            padding-left: 15px;
            padding-right: 15px;
        }
        .alternate-xs-2 {
            width: 50%;
            margin-left: 20px;
            float: left;
            padding-right: 12px;
        }
        .slcol, .slcols {
            width: 50%;
            float: left;
        }
        .routecol {
            width: 100%;
        }
        .optname:first-child,.optname:nth-child(2),.optname:nth-child(3),.optname:nth-child(4) {
            width: 50%;
            float: left;
        }
        .optname:nth-child(2) {
            padding-left: 5px;
            padding-right: 12px;
        }
        .optname:nth-child(4) {
            padding-left: 5px;
            padding-right: 20px;
        }
        .altstation {
            width: 100%;
            margin-left: 20px;
        }
        .xs-p-l-30 {
            padding-left: 30px;
        }
        .xs-p-lr-30 {
            padding-left: 30px;
            padding-right: 30px;
        }
        .ff-nation {
            width: 20%;
            float: left;
        }
        .nationality-right {
            padding-left: 5px;
        }
        .plan-row .operator-left {
            width: 80%;
            margin-left: 22px;
            margin-bottom: 20px;
        }
        .plan-row .pbn-left {
            width: 83%;
            margin-left: 13px;
        }
        .xs-nav {
            width:84% !important;
            margin-left:18px;
        }
        .xs-reg {
            width:80% !important;
            margin-left:30px;
        }
        .fir-left {
            width: 80% !important;
            margin-left: 22px;
            margin-bottom: 20px;
        }
        .per-width, .code-width {
            width:33.33%;
            float: left;
        }
        .takeoff_altn_width,.route_altn_width {
            width: 50%;
            margin-top: 15px;
            float: left;
        }
        .equipment, .credit {
            width: 30%;
            float: left;
        }
        .nocredit {
            width: 36%;
            float: left;
        }
        .dinghies {
            width: 91%;
        }
    }
    @media only screen and (min-width : 768px) and (max-width : 1024px) {

        .plan-row .plan-row-left {
            width: 96%;
        }
        .places {
            width: 33.3333%;
            float: left;
        }
        .plan-row .dep-time {
            width: 33.33%;
        }
        .plan-row .newtime {
            width: 33.33%;
            float: left;
        }
        .alternate {
            width: 33.33%;
        }

        .slcol, .slcols {
            width: 25%;
            float: left;
        }

        .routecol {
            width: 50%;
            float: left;
        }

        .plan-row .speed-in-left, .plan-row .level-in-left {
            width: 45%;
        }

        .plan-row .speed-in-right,.plan-row .level-in-right {
            width: 45%;
        }
        .places-1, .padsix , .alternate-1{
            width: 25%;
            float: left;
            padding-left:15px;
            padding-right: 15px;
        }
        .plan-row .col-time {
            width: 45%;
        }

        .optname {
            width:18%;
            float: left;
            padding-left: 15px;
            padding-right: 0;
        }
        .altstation {
            width: 24%;
            float: left;
            padding-left: 15px;
            padding-right: 5px;
        }
        .ff-nation {
            width: 11.9%;
        }
        .sm-p-r-0 {
            padding-right: 0;
        }
        .sm-p-r-10 {
            padding-right: 10px;
        }
        .sm-p-r-15 {
            padding-right: 15px !important;
        }

        .sm-p-l-0 {
            padding-left: 0;
        }

        .sm-p-l-10 {
            padding-left: 10px;
        }
        .sm-p-r-20 {
            padding-right: 20px;
        }

        .per-width, .code-width {
            width:16.5%;
            float: left;
        }
        .takeoff_altn_width, .route_altn_width {
            width: 25%;
            float: left;
            padding-left: 5px;
            padding-right: 10px;
        }
        .equipment, .credit, .nocredit {
            width: 14.5%;
            float: left;
        }
        .dinghies {
            width: 96%;
        }
        .plan-row .remarkleft {
            width: 98%;
        }
    }
    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
        .operator_box {
            width: 25%;
        }
        .equipment, .credit, .nocredit {
            width: 12%;
            margin-top: 0;
        }
        .equipment .form-group, .credit .form-group, .nocredit .form-group {
            margin-bottom: 0;
        }
        .equipment label, .credit label {
            float: none;
            margin-left:10px;
        }
        .plan-row .dep-time {
            width: 44.33%;
        }
    }
</style>
<div class="page">
    <!--<main>-->
    @include('includes.new_header',[])
    <div class="container">
        <?php
        $is_reg_edit = "1";
        if (isset($aircraft_callsign) && isset($registration)) {
            if (substr($aircraft_callsign, 0, 5) == $registration) {
                $is_reg_edit = "";
            }
        }
        ?>
        <section>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 plan-form planned-form lessrightpad">
                            <div class="flight-plan">
                                <h4>FULL ICAO Flight Plan</h4>
                                <form data-toggle="validator" onsubmit="return validform()" id="new_fpl" name="new_fpl" method="post" action="{{url('/fpl/new_plan')}}">
                                    <input type="hidden" name="utcdate" id="utcdate" value="{{date("d-M-Y")}}" />
                                    <input type="hidden" name="gmt_time" id="gmt_time" value="{{gmdate("H:i",strtotime('0 hour +30 minutes'))}}" />
                                    <input type="hidden" name="default_fpl_date" id="default_fpl_date" value="{{date('ymd')}}" />
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 flight-row">
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <div class="plan-row">
                                                        <div class="plan-row-left xs-w96">
                                                            <label class="cust_label">Call Sign</label>
                                                            <div class="form-group">
                                                                @if(Input::get('_cs'))
                                                                <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alpha_numeric" data-cs="{{Input::get('_cs')}}" readonly placeholder="Call Sign" name="aircraft_callsign" id="aircraft_callsign"  required data-toggle="popover" data-placement="top" value="{{Input::get('_cs')}}"  maxlength="7" minlength="5" tabindex="1">
                                                                @elseif(isset($aircraft_callsign) && isset($is_myaccount))
                                                                <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alpha_numeric" data-cs="{{$aircraft_callsign}}" readonly placeholder="Call Sign" name="aircraft_callsign" id="aircraft_callsign"  required data-toggle="popover" data-placement="top" value="{{$aircraft_callsign}}"  maxlength="7" minlength="5" tabindex="1">
                                                                @else
                                                                <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alpha_numeric" placeholder="Call Sign" name="aircraft_callsign" id="aircraft_callsign"  required data-toggle="popover" data-placement="top" value="{{ (isset($aircraft_callsign)) ?  $aircraft_callsign : '' }}"  maxlength="7" minlength="5" tabindex="1">
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-4 col-md-4">
                                                    <div class="plan-row">
                                                        <div class="plan-row-left xs-w96">
                                                            <label class="cust_label">Flight Rule</label>
                                                            <div class="form-group">
                                                                <dl id="rules" class="form-control flrules" required data-toggle="popover" data-placement="top">
                                                                    <dt><a href="#"><span id="flight_rules_value">{{(isset($flight_rules) && $flight_rules!='') ? $flight_rules : 'Flight Rule' }}</span></a></dt>
                                                                    <dd>
                                                                        <ul>
                                                                            <li class="flight_rules"><a>I</a></li>
                                                                            <li class="flight_rules"><a>V</a></li>
                                                                            <li class="flight_rules"><a>Y</a></li>
                                                                            <li class="flight_rules"><a>Z</a></li>
                                                                        </ul>
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-4 col-md-4 sm-p-r-20">
                                                    <div class="plan-row">
                                                        <div class="plan-row-left ">
                                                            <label class="cust_label">Flight Type</label>
                                                            <div class="form-group">
                                                                @if((isset($flight_type) && $flight_type!='' && isset($is_myaccount)))
                                                                <!-- <dl id="types" style="background: #eee" class="form-control fltypes" required data-toggle="popover" data-placement="top">
                                                                    <div id="flight_type_value" style="text-align: center">{{(isset($flight_type) && $flight_type!='') ? $flight_type : 'Flight Type' }}</div>
                                                                </dl> -->
                                                                <dl id="types" class="form-control fltypes" required data-toggle="popover" data-placement="top">
                                                                    <dt><a><span id="flight_type_value">{{(isset($flight_type) && $flight_type!='') ? $flight_type : 'Flight Type' }}</span></a></dt>
                                                                    <dd>
                                                                        <ul>
                                                                            <li class="flight_type"><a>G</a></li>
                                                                            <li class="flight_type"><a>N</a></li>
                                                                            <li class="flight_type"><a>S</a></li>
                                                                            <li class="flight_type"><a>M</a></li>
                                                                        </ul>
                                                                    </dd>
                                                                </dl>
                                                                @else
                                                                <dl id="types" class="form-control fltypes" required data-toggle="popover" data-placement="top">
                                                                    <dt><a><span id="flight_type_value">{{(isset($flight_type) && $flight_type!='') ? $flight_type : 'Flight Type' }}</span></a></dt>
                                                                    <dd>
                                                                        <ul>
                                                                            <li class="flight_type"><a>G</a></li>
                                                                            <li class="flight_type"><a>N</a></li>
                                                                            <li class="flight_type"><a>S</a></li>
                                                                            <li class="flight_type"><a>M</a></li>
                                                                        </ul>
                                                                    </dd>
                                                                </dl>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-2">
                                            <div class="plan-row">
                                                <div class="plan-row-left xs-w96">
                                                    <label class="cust_label">Aircraft Type</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alpha_numeric" placeholder="Aircraft Type" {{(isset($aircraft_type) && isset($is_myaccount))? 'readonly=readonly' :'' }} value="{{isset($aircraft_type)? $aircraft_type :'' }}" name="aircraft_type" id="aircraft_type"  required data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="3" tabindex="4">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-2">
                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Weight Category</label>
                                                    <div class="form-group">
                                                        @if((isset($weight_category) && $weight_category!='' && isset($is_myaccount)))
                                                        <span id="weight" style="background: #eee" class="wtcat form-control" required>
                                                            <div type="text" id="weight_category_value" style="text-align: center;" >{{$weight_category}}</div>
                                                        </span>
                                                        @else
                                                        <dl id="weight" class="wtcat form-control" required data-toggle="popover" data-placement="top">
                                                            <dt><a><span id="weight_category_value">{{(isset($weight_category) && $weight_category!='') ? $weight_category : 'Weight'}}</span></a></dt>
                                                            <dd>
                                                                <ul>
                                                                    <li class="weight_category"><a>L</a></li>
                                                                    <li class="weight_category"><a>M</a></li>
                                                                    <li class="weight_category"><a>H</a></li>
                                                                </ul>
                                                            </dd>
                                                        </dl>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-5">
                                            <div class="plan-row">
                                                <div class="plan-row-left equip-box">
                                                    <label class="cust_label">Equipments</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class route_allowed_chars" placeholder="Equipments" value="{{(isset($equipment)) ? $equipment: ''}}" name="equipment" id="equipment"  required data-toggle="popover" data-placement="bottom"  maxlength="32" minlength="1" tabindex="6">
                                                    </div>
                                                </div>
                                                <div class="plan-row-right equip-box-right"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-3">
                                            <div class="plan-row">
                                                <div class="plan-row-left trans-box">
                                                    <label class="cust_label">Transponder Mode</label>
                                                    <div class="form-group">
                                                        <dl id="mode" class="transmode form-control" required data-toggle="popover" data-placement="top">
                                                            <dt><a><span id="transponder_value">{{(isset($transponder) && $transponder!='') ? $transponder : 'Transponder Mode' }}</span></a></dt>
                                                            <dd>
                                                                <ul>
                                                                    <li class="transponder"><a>A</a></li>
                                                                    <li class="transponder"><a>C</a></li>
                                                                    <li class="transponder"><a>E</a></li>
                                                                    <li class="transponder"><a>H</a></li>
                                                                    <li class="transponder"><a>L</a></li>
                                                                    <li class="transponder"><a>N</a></li>
                                                                    <li class="transponder"><a>S</a></li>
                                                                </ul>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        .oc-time-box1, .oc-time-box2, .oc-time-box3, .oc-time-box4   {
                                            width: 250px;
                                            min-height: 100px;
                                            position: absolute;

                                            z-index: 9999;
                                            background: #eee;
                                            border-radius: 5px;
                                            left: 103px;
                                            bottom: 42px;
                                            text-align: center;
                                        }

                                        .oc-time-box1>div>p, .oc-time-box2>div>p,  .oc-time-box3>div>p, .oc-time-box4>div>p  {
                                            font-size: 12px;
                                            font-weight: bold;
                                        }
                                        .oc-time-box2 {
                                            bottom: 70px;
                                            left:120px;
                                        }

                                        .oc-time-day {
                                            text-align: center;
                                            background: #f1292b;
                                            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
                                            background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
                                            background: -moz-linear-gradient(top, #f1292b, #f37858);
                                            color: #fff;
                                            border-radius: 5px 5px 0 0;
                                            margin-bottom: 5px;
                                        }
                                        .oc-time-box1, .oc-time-box2, .oc-time-box3, .oc-time-box4  {
                                            display: none;
                                        }

                                    </style>
                                    <script>
                                        $(function () {
                                            $(".oc-time-hover1").mouseover(function () {
                                                $(".oc-time-box1").show();
                                            });
                                            $(".oc-time-hover1").mouseleave(function () {
                                                $(".oc-time-box1").hide();
                                            });
                                            $(".oc-time-hover2").mouseover(function () {
                                                $(".oc-time-box2").show();
                                            });
                                            $(".oc-time-hover2").mouseleave(function () {
                                                $(".oc-time-box2").hide();
                                            });
                                            $(".oc-time-hover3").mouseover(function () {
                                                $(".oc-time-box3").show();
                                            });
                                            $(".oc-time-hover3").mouseleave(function () {
                                                $(".oc-time-box3").hide();
                                            });
                                            $(".oc-time-hover4").mouseover(function () {
                                                $(".oc-time-box4").show();
                                            });
                                            $(".oc-time-hover4").mouseleave(function () {
                                                $(".oc-time-box4").hide();
                                            });
                                        });

                                    </script>
                                    <div class="row">
                                        <hr class="divider">
                                        <div class="flight-time">
                                            <div class="col-xs-6 col-sm-4 col-md-2 places">

                                                <div class="plan-row">
                                                    <div class="plan-row-left dep-station">
                                                        <label class="cust_label">Departure</label>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                @if(isset($departure_aerodrome) && isset($is_myaccount))
                                                                <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets check_watch_hour" name="departure_aerodrome" id="departure_aerodrome" value="{{(isset($departure_aerodrome)) ? $departure_aerodrome: ''}}"  readonly="readonly" placeholder="Departure"  required data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4" tabindex="5">
                                                                @else
                                                                <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets check_watch_hour" name="departure_aerodrome" id="departure_aerodrome" value="{{(isset($departure_aerodrome)) ? $departure_aerodrome: ''}}"  placeholder="Departure"  required data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4" tabindex="5">
                                                                @endif
                                                                <p class="input-group-addon calendar-addon oc-time-hover1"> <span class="glyphicon glyphicon-time"></span></p> 
                                                                @if(isset($departure_aerodrome) && isset($date_of_flight))
                                                                <div class="oc-time-box1" style="box-shadow: 0 0 3px 1px #000">
                                                                    <?php
                                                                    echo App\myfolder\myFunction::watch_hours_tooltip($departure_aerodrome, $date_of_flight);
                                                                    ?>
                                                                </div>
                                                                @endif
                                                                <div class="watch_hour_box1"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-4 col-md-2 padtwo" style="float:left">
                                                <div class="dept-time">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 less">
                                                            <div class="plan-row">
                                                                <label for="depart-time" class="flytime">Departure Time</label>
                                                                <div class="plan-row-left dep-time">
                                                                    @if((isset($departure_time_hours) && $departure_time_hours!='' && isset($is_myaccount)))
                                                                    <dl id="hour" style="background:#eee" class="dropdown depart_hrs form-control validation_class_click"  required data-toggle = "popover"  data-placement="top">
                                                                        <div id="dep_time_hours" style="text-align: center">{{$departure_time_hours}}</div>
                                                                    </dl>
                                                                    @else
                                                                    <dl id="hour" class="dropdown depart_hrs form-control validation_class_click"  required data-toggle = "popover"  data-placement="top">
                                                                        <dt><a><span id="dep_time_hours" style="">{{(isset($departure_time_hours) && $departure_time_hours !='') ? $departure_time_hours : 'Hr' }}</span></a></dt>
                                                                        <dd>
                                                                            <ul>
                                                                                @for ($i = 00; $i <= 23; $i++)
                                                                                <li class="departure_time_hours"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                                @endfor
                                                                            </ul>
                                                                        </dd>
                                                                    </dl>
                                                                    @endif
                                                                </div>
                                                                <div class="plan-row-left dep-time">
                                                                    @if((isset($departure_time_minutes) && $departure_time_minutes!='' && isset($is_myaccount)))
                                                                    <dl id="mins" style="background:#eee" class="dropdowns depart_mins form-control validation_class_click"  required data-toggle = "popover"  data-placement="top">
                                                                        <div id="dep_time_minutes" style="text-align: center">{{$departure_time_minutes}}</div>
                                                                    </dl>
                                                                    @else
                                                                    <dl id="mins" class="dropdowns depart_mins form-control validation_class_click" required data-toggle = "popover"  data-placement="top">
                                                                        <dt><a><span id="dep_time_minutes" style="">{{(isset($departure_time_minutes) && $departure_time_minutes!='') ? $departure_time_minutes : 'Min' }}</span></a></dt>
                                                                        <dd>
                                                                            <ul>
                                                                                @for ($i = 00; $i <= 55; $i+=5)
                                                                                <li class="departure_time_minutes"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                                @endfor
                                                                            </ul>
                                                                        </dd>
                                                                    </dl>
                                                                    @endif
                                                                </div>
                                                                <div class="plan-row-right dep-tooltip"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                                            </div>
                                                            <div id="newtimeTM" class="newtime"> </div>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-2 alternate morepad alternate-xs-1">

                                                <div class="plan-row">
                                                    <div class="plan-row-left flydate-left">
                                                        <label class="cust_label">Date Of Flight</label>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                @if(isset($date_of_flight))
                                                                <input type="text" autocomplete="off" readonly  required data-toggle="popover" data-placement="bottom"  maxlength="6" minlength="6" class="form-control text-center font-bold validation_class"  name="date_of_flight" value="{{(isset($date_of_flight))? $date_of_flight: date('d-M-Y') }}" id="date_of_flight" placeholder="Date of Flight" tabindex="5" style="background-color: #eee;">
                                                                @else
                                                                <input type="text" autocomplete="off" readonly  required data-toggle="popover" data-placement="bottom"  maxlength="6" minlength="6" class="form-control text-center font-bold validation_class datepicker pointer"  name="date_of_flight" value="{{(isset($date_of_flight))? $date_of_flight: date('d-M-Y') }}" id="date_of_flight" placeholder="Date of Flight" tabindex="5" style=" padding-right:45px;background-color: white;">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="plan-row-right flydate-right"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 slcol">

                                            <div class="plan-row">
                                                <div class="plan-row-left col-time speed-in-left">
                                                    <label class="novalue">speed</label>
                                                    <div class="form-group">
                                                        <dl id="setspeed" class="speed speed-dpdown form-control" required data-toggle="popover" data-placement="top" >
                                                            <dt><a><span id="crushing_speed_indication_value">{{(isset($crushing_speed_indication) && $crushing_speed_indication !='') ? $crushing_speed_indication : '---'}}</span></a></dt>
                                                            <dd>
                                                                <ul>
                                                                    <li class="crushing_speed_indication"><a><span>K</span></a></li>
                                                                    <li class="crushing_speed_indication"><a><span>M</span></a></li>
                                                                    <li class="crushing_speed_indication"><a><span>N</span></a></li>
                                                                </ul>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="plan-row-left col-time speed-in-right">
                                                    <label class="cust_label">Speed</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numbers validation_class" placeholder="Speed" id="crushing_speed" name="crushing_speed" value="{{(isset($crushing_speed)) ? $crushing_speed:''}}" required data-toggle="popover" data-placement="bottom" >
                                                    </div>
                                                </div>
                                                <div class="plan-row-right slright"> <span class="glyphicon glyphicon-question-sign question"></span> </div>

                                            </div>
                                        </div>
                                        <div class="col-md-2 slcols">
                                            <div class="plan-row">
                                                <div class="plan-row-left col-time level-in-left">
                                                    <label class="novalue">speed</label>
                                                    <div class="form-group">
                                                        <dl id="setspeedvalue" class="level level-dpdown form-control" required data-toggle="popover" data-placement="top" >
                                                            <dt><a><span id="flight_level_indication_value">{{(isset($flight_level_indication) && $flight_level_indication !='') ? $flight_level_indication : '---'}}</span></a></dt>
                                                            <dd>
                                                                <ul>
                                                                    <li class="flight_level_indication"><a><span>F</span></a></li>
                                                                    <li class="flight_level_indication"><a><span>A</span></a></li>
                                                                </ul>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="plan-row-left col-time level-in-right">
                                                    <label class="cust_label">Level</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numbers validation_class" placeholder="Level" id="flight_level" name="flight_level" value="{{(isset($flight_level) && $flight_level !='') ? $flight_level : ''}}" required data-toggle="popover" data-placement="bottom" minlength="3" maxlength="3">
                                                    </div>
                                                </div>
                                                <div class="plan-row-right slright"> <span class="glyphicon glyphicon-question-sign question"></span> </div>

                                            </div>
                                        </div>
                                        <div class="col-md-7 routecol">
                                            <div class="plan-row">
                                                <div class="plan-row-left route-left">
                                                    <label class="cust_label">Route</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class route_allowed_chars" name="route" id="route" value="{{(isset($route))? $route: ''}}" placeholder="Route"  required data-toggle="popover" data-placement="bottom"  maxlength="250" minlength="2">
                                                    </div>
                                                </div>
                                                <div class="plan-row-right route-right"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 places places-1">

                                            <div class="plan-row">
                                                <div class="plan-row-left dest-station">
                                                    <label class="cust_label">Destination</label>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            @if(isset($destination_aerodrome) && isset($is_myaccount))
                                                            <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets check_watch_hour" name="destination_aerodrome" id="destination_aerodrome" value="{{(isset($destination_aerodrome))? $destination_aerodrome:''}}" readonly="readonly"  placeholder="Destination" tabindex="5"  required data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4">
                                                            @else
                                                            <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets check_watch_hour" name="destination_aerodrome" id="destination_aerodrome" value="{{(isset($destination_aerodrome))? $destination_aerodrome:''}}" placeholder="Destination" tabindex="5"  required data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4">
                                                            @endif
                                                            <span class="input-group-addon calendar-addon oc-time-hover2"> <span class="glyphicon glyphicon-time"></span> </span> </div>
                                                        @if(isset($destination_aerodrome) && isset($date_of_flight))
                                                        <div class="oc-time-box2" style="box-shadow: 0 0 3px 1px #000">
                                                            <?php
                                                            echo App\myfolder\myFunction::watch_hours_tooltip($destination_aerodrome, $date_of_flight);
                                                            ?>
                                                        </div>
                                                        @endif
                                                        <div class="watch_hour_box2"></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-2 padsix">
                                            <label for="novalue" class="flytime">Total Flying Time</label>
                                            <div class="plan-row">
                                                <div class="plan-row-left col-time">
                                                    <div class="form-group">
                                                        <dl id="total_hour" class="tt-hrs form-control validation_class_click" required data-toggle="popover" data-placement="top">
                                                            <dt><a><span id="total_time_hours">{{(isset($total_flying_hours) && $total_flying_hours !='') ? $total_flying_hours : 'Hr' }}</span></a></dt>

                                                            <dd>
                                                                <ul>
                                                                    @for($i=00;$i<=07;$i++)
                                                                    <li class="total_flying_hours"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                    @endfor
                                                                </ul>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="plan-row-left col-time">
                                                    <dl id="total_mins" class="tt-mins form-control validation_class_click" required data-toggle="popover" data-placement="top">
                                                        <dt><a><span id="total_time_minutes">{{(isset($total_flying_minutes) && $total_flying_minutes !='') ? $total_flying_minutes : 'Min' }}</span></a></dt>
                                                        <dd>
                                                            <ul>
                                                                @for($i=00;$i<=59;$i++)
                                                                <li class="total_flying_minutes"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                @endfor
                                                            </ul>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="plan-row-right tft-right"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 alternate morepad alternate-1 alternate-xs-1">

                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Alternate 1</label>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets check_watch_hour" name="first_alternate_aerodrome" id="first_alternate_aerodrome" value="{{(isset($first_alternate_aerodrome))? $first_alternate_aerodrome:''}}" placeholder="ALTERNATE 1"  required data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4" tabindex="5">
                                                            <span class="input-group-addon calendar-addon oc-time-hover3"> <span class="glyphicon glyphicon-time"></span> </span> 
                                                            @if(isset($first_alternate_aerodrome) && isset($date_of_flight))
                                                            <div class="oc-time-box3" style="box-shadow: 0 0 3px 1px #000">
                                                                <?php
                                                                echo App\myfolder\myFunction::watch_hours_tooltip($first_alternate_aerodrome, $date_of_flight);
                                                                ?>
                                                            </div>
                                                            @endif
                                                            <div class="watch_hour_box3"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="plan-row-right alt-tooltip"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 alternate padten alternate-1 alternate-xs-2">

                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Alternate 2</label>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets check_watch_hour" name="second_alternate_aerodrome" id="second_alternate_aerodrome" value="{{(isset($second_alternate_aerodrome)) ? $second_alternate_aerodrome: ''}}" placeholder="ALTERNATE 2" data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4" tabindex="5">
                                                            <span class="input-group-addon calendar-addon oc-time-hover4"> <span class="glyphicon glyphicon-time"></span> </span> 
                                                            @if(isset($second_alternate_aerodrome) && isset($date_of_flight))
                                                            <div class="oc-time-box4">
                                                                <?php
                                                                echo App\myfolder\myFunction::watch_hours_tooltip($second_alternate_aerodrome, $date_of_flight);
                                                                ?>
                                                            </div>
                                                            @endif
                                                            <div class="watch_hour_box4"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 optname">
                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Dep Station</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class operator" {{(isset($departure_station) && $departure_station!='' && !isset($is_myaccount)) ? '':"readonly='readonly'"}}  name="departure_station" value="{{(isset($departure_station)) ? $departure_station:''}}" id="departure_station" placeholder="Dep Station" data-toggle="popover" data-placement="bottom"  maxlength="25" minlength="3">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-2 noleftpad optname">
                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Dep Lat-Long</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alpha_numeric"  {{(isset($departure_latlong) && $departure_latlong!='' && !isset($is_myaccount)) ? '':"readonly='readonly'"}} name="departure_latlong" id="departure_latlong" value="{{(isset($departure_latlong)) ? $departure_latlong:''}}"  placeholder="Dep Lat-Long" data-toggle="popover" data-placement="bottom"  maxlength="15" minlength="9">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-2 optname">
                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Dest Station</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class operator" {{(isset($destination_station) && $destination_station!='' && !isset($is_myaccount)) ? '':"readonly='readonly'"}} name="destination_station" id="destination_station"  value="{{(isset($destination_station)) ? $destination_station:''  }}" placeholder="Dest Station" data-toggle="popover" data-placement="bottom"   maxlength="25" minlength="3">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-2 optname padten">
                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Dest Lat-Long</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alpha_numeric" {{(isset($destination_latlong) && $destination_latlong !='' && !isset($is_myaccount)) ? '':"readonly='readonly'"}} name="destination_latlong" id="destination_latlong" value="{{(isset($destination_latlong)) ? $destination_latlong:''  }}" placeholder="Dest Lat-Long" data-toggle="popover" data-placement="bottom"  maxlength="15" minlength="9">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4 noleftpad altstation">
                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Alternate Station</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class pilot_in_command" {{(isset($alternate_station) && $alternate_station !='') ? '':"readonly='readonly'"}} name="alternate_station" id="alternate_station" value="{{(isset($alternate_station))? $alternate_station: ''}}" placeholder="Alternate Station" data-toggle="popover" data-placement="bottom"  maxlength="40" minlength="3">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <hr class="divider">
                                        <div class="flight-time">
                                            <div class="col-sm-3 col-md-3 xs-p-l-30">
                                                <div class="plan-row">
                                                    <div class="plan-row-left">
                                                        <label class="cust_label">Pilot In Command</label>
                                                        <div class="form-group">
                                                            <input type="text" autocomplete="off" placeholder="Pilot in Command" data-url="{{url("")}}"  name="pilot_in_command" id="pilot_in_command" value="{{(isset($pilot_in_command))? $pilot_in_command: ''}}" class="form-control text-center font-bold text_uppercase validation_class pilot_in_command"  required data-toggle="popover" data-placement="top"  maxlength="25" minlength="2">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 noleftpad xs-p-l-30">
                                                <div class="plan-row">
                                                    <div class="plan-row-left">
                                                        <label class="cust_label">Mobile No</label>
                                                        <div class="form-group">
                                                            <input type="text" autocomplete="off" name="mobile_number" id="mobile_number" value="{{(isset($mobile_number)) ? $mobile_number: ''}}" placeholder="Mobile No" class="form-control text-center font-bold text_uppercase validation_class numbers"  required data-toggle="popover" data-placement="top"  maxlength="10" minlength="10">
                                                        </div>
                                                    </div>
                                                    <div class="plan-row-right"> <span class="glyphicon glyphicon-question-sign question"></span></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 noleftpad xs-p-l-30">
                                                <div class="plan-row">
                                                    <div class="plan-row-left">
                                                        <label class="cust_label">Co Pilot</label>
                                                        <div class="form-group">
                                                            <input type="text" autocomplete="off" name="copilot" id="copilot"   value="{{(isset($copilot)) ? $copilot: ''}}"     placeholder="Co Pilot" class="form-control text-center font-bold text_uppercase validation_class pilot_in_command"  required data-toggle="popover" data-placement="top"  maxlength="25" minlength="2">
                                                        </div>
                                                    </div>
                                                    <div class="plan-row-right"> <span class="glyphicon glyphicon-question-sign question"></span></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3 noleftpad sm-p-r-20 xs-p-l-30">
                                                <div class="plan-row">
                                                    <div class="plan-row-left">
                                                        <label class="cust_label">Cabin Crew</label>
                                                        <div class="form-group">
                                                            <input type="text" autocomplete="off" name="cabincrew" id="cabincrew"  value="{{(isset($cabincrew)) ? $cabincrew: ''}}"   placeholder="Cabin Crew" class="form-control text-center font-bold text_uppercase validation_class pilot_in_command" data-toggle="popover" data-placement="bottom"  maxlength="25" minlength="2">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-3 col-md-2">
                                            <label for="endurance" class="flytime">Endurance</label>
                                            <div class="plan-row">
                                                <div class="plan-row-left col-time end-left">
                                                    <div class="form-group">
                                                        <dl id="endurhours" class="endhrs form-control validation_class_click"  required data-toggle="popover" data-placement="top">
                                                            <dt><a><span id="endurance_time_hours">{{(isset($endurance_hours) && $endurance_hours!='') ? $endurance_hours : 'Hr' }}</span></a></dt>
                                                            <dd>
                                                                <ul>
                                                                    @if(isset($endurance_hours))<li>{{ $endurance_hours }}</li>@endif
                                                                    @for($i=00; $i<=9; $i++)
                                                                    <li class="endurance_hours"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                    @endfor
                                                                </ul>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="plan-row-left col-time">
                                                    <div class="form-group">
                                                        <dl id="endurmins" class="endmin form-control validation_class_click" required data-toggle="popover" data-placement="top">
                                                            <dt><a><span id="endurance_time_minutes">{{(isset($endurance_minutes) && $endurance_minutes!='') ? $endurance_minutes : 'Min' }}</span></a></dt>
                                                            <dd>
                                                                <ul>
                                                                    @if(isset($endurance_minutes))<li>{{ $endurance_minutes }}</li>@endif
                                                                    @for($i=00;$i<=59;$i++)
                                                                    <li class="endurance_minutes"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                    @endfor

                                                                </ul>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="plan-row-right end-right"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-1 col-md-1 nation ff-nation">
                                            <label class="novalue" for="novalue"></label>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="natinality-left">
                                                        <input type="radio" class="indian" name="indian" id="indian" checked="checked" value="YES" {{(isset($foreigner)) ? (($foreigner=='YES') ? '' : "checked='checked'"): "checked='checked'"}}>
                                                    </div>
                                                    <div class="nationality-right">
                                                        Indians
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1 col-md-1 nation ff-nation">
                                            <label class="novalue" for="novalue"></label>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="natinality-left">
                                                        <input type="radio" class="indian" name="indian" id="foreigner" value="NO" {{(isset($foreigner)) ? (($foreigner=='YES') ? "checked='checked'" : ''): ""}}>
                                                    </div>
                                                    <div class="nationality-right">
                                                        Foreigner
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-3 col-md-4 padten sm-p-r-0 xs-p-lr-30">

                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Foreigner Nationality</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" {{(isset($foreigner)) ? (($foreigner=='YES') ? "" : "readonly='readonly'"): "readonly='readonly'"}} name="foreigner_nationality" id="foreigner_nationality" value="{{(isset($foreigner)) ? (($foreigner=='YES') ? $foreigner_nationality : ''): ""}}" placeholder="Foreigner Nationality" class="form-control text-center font-bold text_uppercase validation_class pilot_in_command" data-toggle="popover" data-placement="bottom"  maxlength="50" minlength="3">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-4 padleight sm-p-r-10 operator_box">

                                            <div class="plan-row">
                                                <div class="plan-row-left operator-left">
                                                    <label class="cust_label">Operator</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" placeholder="Operator" name="operator" id="operator" {{ (isset($is_myaccount)) ? "readonly='readonly'" : "" }}  value="{{(isset($operator)) ? $operator: ''}}" class="form-control auto_operator text-center font-bold text_uppercase validation_class operator"  required data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="3">
                                                    </div>
                                                </div>
                                                <div class="plan-row-right operator-right"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-4">
                                            <div class="plan-row">
                                                <div class="plan-row-left pbn-left">
                                                    <label class="cust_label">PBN</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class  alpha_numeric" readonly name="pbn" id="pbn" value="{{(isset($pbn)) ? $pbn: ''}}"  placeholder="PBN" data-toggle="popover" data-placement="bottom"  maxlength="20" minlength="2">
                                                    </div>
                                                </div>
                                                <div class="plan-row-right pbn-right"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-2 adjpad sm-p-l-0  sm-p-r-15">
                                            <div class="plan-row">
                                                <div class="plan-row-left xs-nav">
                                                    <label class="cust_label">NAV</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class operator" name="nav" id="nav1" value="{{(isset($nav)) ? $nav: ''}}" placeholder="NAV" data-toggle="popover" data-placement="bottom"  maxlength="16" minlength="1">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-2 adjpad noleftpad sm-p-l-0  sm-p-r-15">
                                            <div class="plan-row">
                                                <div class="plan-row-left xs-reg">
                                                    <label class="cust_label">Registration</label>
                                                    <div class="form-group">
                                                        @if(isset($registration) && isset($is_myaccount))
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alpha_numeric" name="registration" id="registration" {{($is_reg_edit != '') ? "" : "readonly='readonly'"}}  value="{{(isset($registration)) ? $registration: ''}}"  placeholder="Registration"  required data-toggle="popover" data-placement="bottom"  maxlength="7" minlength="5">
                                                        @else
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alpha_numeric" name="registration" id="registration"  value="{{(isset($registration)) ? $registration: ''}}"  placeholder="Registration"  required data-toggle="popover" data-placement="bottom"  maxlength="7" minlength="5">
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-4 adjseven sm-p-l-0 sm-p-r-20">
                                            <div class="plan-row">
                                                <div class="plan-row-left fir-left">
                                                    <label class="cust_label">Fir Crossing Time</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class" name="fir_crossing_time" id="fir_crossing_time" value="{{(isset($fir_crossing_time)) ? $fir_crossing_time: ''}}" {{(isset($fir_crossing_time)) ? '' : 'readonly="readonly"'}}  placeholder="FIR Crossing Time" data-toggle="popover" data-placement="bottom"  maxlength="75" minlength="8">
                                                    </div>
                                                </div>
                                                <div class="plan-row-right fir-right"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1 per-width">
                                            <div class="plan-row">

                                                <div class="plan-row-left per-left-width">
                                                    <label class="cust_label">SEL</label>
                                                    <input type="text" autocomplete="off" name="sel" id="sel" value="{{(isset($sel))? $sel:''}}" placeholder="SEL" class="form-control text-center font-bold text_uppercase validation_class alphabets" data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-2 code-width">
                                            <div class="plan-row">
                                                <div class="plan-row-left code-left-width">
                                                    <label class="cust_label">CODE</label>
                                                    <input type="text" autocomplete="off" name="code" id="code" value="{{(isset($code))? $code:''}}"  placeholder="Code" class="form-control text-center font-bold text_uppercase validation_class alpha_numeric " data-toggle="popover" data-placement="bottom"  maxlength="6" minlength="6">
                                                </div>
                                                <div class="plan-row-right code-right-width"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 per-width">
                                            <div class="plan-row">
                                                <div class="plan-row-left per-left-width">
                                                    <label class="cust_label">PER</label>
                                                    <input type="text" autocomplete="off" name="per" id="per" value="{{(isset($per))? $per:''}}" placeholder="PER" class="form-control text-center font-bold text_uppercase validation_class alphabets" data-toggle="popover" data-placement="bottom"  maxlength="1" minlength="1">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-2 takeoff_altn_width">
                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Take Off Altn</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets" placeholder="Take Off Altn" name="take_off_altn" id="take_off_altn" value="{{(isset($take_off_altn))? $take_off_altn:''}}" data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-2 padseven route_altn_width sm-p-r-15">
                                            <div class="plan-row">
                                                <div class="plan-row-left">
                                                    <label class="cust_label">Route Altn</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets" placeholder="Route Altn" name="route_altn" id="route_altn" value="{{(isset($route_altn))? $route_altn:''}}"  data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-1 equipment">
                                            <div class="form-group">
                                                <input type="checkbox" value="tcas" name="tcas" id="tcas" {{(isset($tcas)) ? (($tcas=='YES') ? 'checked="checked"' : '' ): '' }}><label for="tcas">TCAS</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1 credit">
                                            <div class="form-group">
                                                <input type="radio"  value="YES" name="credit" id="credit" {{(isset($credit)) ? (($credit=='YES') ? 'checked="checked"' : '') : '' }}><label for="credit" class="credit_color">Credit</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1 nocredit">
                                            <div class="form-group">
                                                <input type="radio"  value="NO" name="credit" id="nocredit" {{(isset($credit)) ? (($credit=='NO') ? 'checked="checked"' : '') : '' }}><label for="nocredit" class="credit_color">No Credit</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="plan-row">
                                                <div class="plan-row-left remarkleft">
                                                    <label class="cust_label">Remarks</label>
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class route_allowed_chars" name="remarks" id="remarks"  value="{{(isset($remarks))? $remarks:''}}" placeholder="Remarks" data-toggle="popover" data-placement="bottom"  maxlength="250" minlength="3">
                                                    </div>
                                                </div>
                                                <div class="plan-row-right remarkright"> <span class="glyphicon glyphicon-question-sign question"></span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <hr class="divider">
                                        <div class="suppl-row">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-sm-4 col-md-4">
                                                        <div class="text-center margin-bottom-3">TICK AVAILABLE EQUIPMENTS</div>
                                                        <div class="addlinfo emergency_border">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>Emergency Radio <span class="glyphicon glyphicon-question-sign question"></span></h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="centalign">
                                                                    <div class="col-xs-4 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox"  class="emergency_checkbox" name="emergency_uhf" {{(isset($emergency_uhf)) ? (($emergency_uhf=='YES') ? 'checked="checked"' : '') : '' }} value="uhf" id="emergency_uhf">
                                                                        </div>
                                                                        <div class="addlinfo-right"> UHF </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="col-xs-4 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox"  class="emergency_checkbox" {{(isset($emergency_vhf)) ? (($emergency_vhf=='YES') ? 'checked="checked"' : '') : '' }} name="emergency_vhf" value="vhf" id="emergency_vhf">
                                                                        </div>
                                                                        <div class="addlinfo-right"> VHF </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="col-xs-4 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox" class="emergency_checkbox" {{(isset($emergency_elba)) ? (($emergency_elba=='YES') ? 'checked="checked"' : '') : '' }} name="emergency_elba" value="elba" id="emergency_elba">
                                                                        </div>
                                                                        <div class="addlinfo-right"> ELBA </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">&nbsp;</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-sm-4 col-md-4">
                                                        <div class="text-center margin-bottom-3">TICK AVAILABLE EQUIPMENTS</div>
                                                        <div class="addlinfo survival_border">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>Survival Equipment <span class="glyphicon glyphicon-question-sign question"></span></h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="centalign">
                                                                    <div class="col-xs-6 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox" name="polar" class="survival_checkbox" {{(isset($polar)) ? ($polar=='YES') ? 'checked="checked"' : '' : '' }}  id="polar" value="polar">
                                                                        </div>
                                                                        <div class="addlinfo-right"> Polar </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox" name="desert" id="desert" class="survival_checkbox" {{(isset($desert)) ? ($desert=='YES') ? 'checked="checked"' : '' : '' }} value="desert">
                                                                        </div>
                                                                        <div class="addlinfo-right"> Desert </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="centalign">
                                                                    <div class="col-xs-6 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox" name="maritime" id="maritime" class="survival_checkbox" {{(isset($maritime)) ? ($maritime=='YES') ? 'checked="checked"' : '' : '' }} value="maritime">
                                                                        </div>
                                                                        <div class="addlinfo-right"> Maritime </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox" name="jungle" id="jungle" class="survival_checkbox" {{(isset($jungle)) ? ($jungle=='YES') ? 'checked="checked"' : '' : '' }} value="jungle">
                                                                        </div>
                                                                        <div class="addlinfo-right"> Jungle </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4">
                                                        <div class="text-center margin-bottom-3">TICK AVAILABLE EQUIPMENTS</div>
                                                        <div class="addlinfo jackets_border">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>Jackets <span class="glyphicon glyphicon-question-sign question"></span></h5>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="centalign">
                                                                    <div class="col-xs-6 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox" name="light" class="jackets_checkbox" {{(isset($light)) ? ($light=='YES') ? 'checked="checked"' : '' : '' }} id="light" value="light">
                                                                        </div>
                                                                        <div class="addlinfo-right"> Light </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox" name="floures" id="floures" class="jackets_checkbox" {{(isset($floures)) ? (($floures=='YES') ? 'checked="checked"' : '') : '' }} value="floures">
                                                                        </div>
                                                                        <div class="addlinfo-right"> Floures </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="centalign">
                                                                    <div class="col-xs-6 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox" name="jacket_uhf" id="jacket_uhf" class="jackets_checkbox" {{(isset($jacket_uhf)) ? ($jacket_uhf=='YES') ? 'checked="checked"' : '' : '' }} value="jacket_uhf">
                                                                        </div>
                                                                        <div class="addlinfo-right"> UHF </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-4">
                                                                        <div class="addlinfo-left">
                                                                            <input type="checkbox" name="jacket_vhf" id="jacket_vhf" class="jackets_checkbox" {{(isset($jacket_vhf)) ? ($jacket_vhf=='YES') ? 'checked="checked"' : '' : '' }} value="jacket_vhf">
                                                                        </div>
                                                                        <div class="addlinfo-right"> VHF </div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-11 dinghies">
                                                    <div class="addlinfo">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>Dinghies <span class="glyphicon glyphicon-question-sign question"></span></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-6 col-sm-2 col-md-2">
                                                                <label class="cust_label">Number</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off" name="number" id="number" value="{{(isset($number))? $number:''}}" placeholder="Number" class="form-control text-center font-bold validation_class text_uppercase numbers" data-toggle="popover" data-placement="bottom"  maxlength="2" minlength="2">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-2 col-md-2">
                                                                <label class="cust_label">Capacity</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off" name="capacity" value="{{(isset($capacity))? $capacity:''}}" {{(isset($number)) ?  '' : 'readonly="readonly"' }} id="capacity" placeholder="Capacity" class="form-control text-center font-bold text_uppercase validation_class numbers" data-toggle="popover" data-placement="bottom"  maxlength="2" minlength="2">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-1 col-md-1 textalign sm-p-l-0 color_checkbox">
                                                                <div class="addlinfo-left">
                                                                    <input type="checkbox" {{(isset($capacity)) ? '' : 'readonly="readonly"' }}  name="cover" {{(isset($cover)) ? (($cover=='YES') ? 'checked="checked"' : '') : '' }} id="cover" value="cover">
                                                                </div>
                                                                <div class="addlinfo-right"> Cover </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-2 col-md-2">
                                                                <label class="cust_label">Color</label>
                                                                <div class="form-group remove_has_error">
                                                                    <input type="text" name="color" autocomplete="off" {{(isset($cover)) ? (($cover=='YES') ? '' : 'readonly="readonly"') : 'readonly="readonly"' }} id="color" value="{{(isset($color))? $color:''}}"  minlength="3" maxlength="20" placeholder="color" class="form-control text-center font-bold text_uppercase validation_class">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-5 col-md-5 sm-p-r-20">
                                                                <label class="cust_label">Aircraft Color Marking</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off" required name="aircraft_color" id="aircraft_color" value="{{(isset($aircraft_color))? $aircraft_color:''}}" minlength="3" maxlength="35" placeholder="Aircraft Color Marking" class="form-control text-center font-bold text_uppercase validation_class">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <input type="hidden" name="is_process_click" id="is_process_click" value="" />
                                        <input type="hidden" name="is_new_plan" id="is_new_plan" value="1" />
                                        <input type="hidden" name="is_myaccount" id="is_myaccount" value="{{(isset($is_myaccount)) ? $is_myaccount : '' }}" />
                                        <input type="hidden" name="is_id" id="is_id" value="{{(isset($is_id)) ? $is_id : '' }}" />
                                        <input type="hidden" name="remarks1" id="remarks1" value="" />
                                        <input type="hidden" name="is_fir_crossing" id="is_fir_crossing" value="" />
                                        <input type="hidden" name="route1" id="route1" value="" />
                                        <input type="hidden" required name="flight_rules" id="flight_rules" value="{{(isset($flight_rules)) ? $flight_rules : '' }}" />
                                        <input type="hidden" required name="flight_type" id="flight_type" value="{{(isset($flight_type)) ? $flight_type : '' }}" />
                                        <input type="hidden" required name="weight_category" id="weight_category" value="{{(isset($weight_category)) ? $weight_category : '' }}" />
                                        <input type="hidden" required name="transponder" id="transponder" value="{{(isset($transponder) && $transponder !='') ? $transponder : 'N' }}" />
                                        <input type="hidden" required name="departure_time_hours" id="departure_time_hours" value="{{(isset($departure_time_hours)) ? $departure_time_hours : '' }}" />
                                        <input type="hidden" required name="departure_time_minutes" id="departure_time_minutes" value="{{(isset($departure_time_minutes)) ? $departure_time_minutes : '' }}" />
                                        <input type="hidden" name="crushing_speed_indication" id="crushing_speed_indication" value="{{(isset($crushing_speed_indication)) ? $crushing_speed_indication : ''  }}" />
                                        <input type="hidden" name="flight_level_indication" id="flight_level_indication" value="{{(isset($flight_level_indication)) ? $flight_level_indication : ''  }}" />
                                        <input type="hidden" name="total_flying_hours" id="total_flying_hours" value="{{(isset($total_flying_hours)) ? $total_flying_hours : ''  }}" />
                                        <input type="hidden" name="total_flying_minutes" id="total_flying_minutes" value="{{(isset($total_flying_minutes)) ? $total_flying_minutes : ''  }}" />
                                        <input type="hidden" name="endurance_hours" id="endurance_hours" value="{{(isset($endurance_hours)) ? $endurance_hours : ''  }}" />
                                        <input type="hidden" name="endurance_minutes" id="endurance_minutes" value="{{(isset($endurance_minutes)) ? $endurance_minutes : ''  }}" />
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <input type="hidden" name="is_app" id="is_app" value="0" />
                                        <input type="hidden" name="is_web" value="1">
                                        <input type="hidden" name="change_fpl_myaccount" id="change_fpl_myaccount" value="">
                                        <input type="hidden" name="email" id="email" value="{{Auth::user()->email}}">
                                        <input type="hidden" name="user_mobile" id="user_mobile" value="{{Auth::user()->mobile_number}}" />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group text-center">
                                                @if(isset($is_myaccount) && $is_myaccount!='')
                                                <!--<a data-toggle="modal" href="#confirm_change_plan"  class="btn btn-primary submit-btn">Process</a>-->
                                                <div class="newbtnv1 b-radius-5">
                                                    <input id="process" name="flag" data-name="New" type="button" value="Process" class="btn btn_appearance change_fpl_myaccount">
                                                </div>
                                                @else
                                                <div class="newbtnv1 b-radius-5">
                                                    <input id="process" name="flag" data-name="New" type="submit" value="Process" class="btn btn_appearance">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @include('includes.confirm_change_plan',[])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--</div>-->
            <!--</div>-->
        </section>
    </div>
    @include('includes.new_footer',[])
</div>
<script>
    $(function () {
        $(".auto_operator").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/new_fpl/auto_operator",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $("#operator").css("border", "lightgrey solid 1px !important");
//                if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
//                    
//                } else {
//                    $("#operator").css("border", "lightgrey solid 1px !important");
//                }
            }
        });
    });
</script>
@stop