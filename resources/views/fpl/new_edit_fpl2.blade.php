@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<style type="text/css">
    .speed-right {
        position: relative;
    }
    .form-row .speed-left dl, .cust-flytime dl {
        margin-bottom: 0;
    }
    .endurance label {
        margin-bottom: 5px;
    }


    #route1 {
        margin-bottom :40px;
    }

    .cust-col .form-group, .custom-col .form-group, .cust-flytime .form-group {
        margin-bottom: 0;
    }


    .nation {
        margin-top:15px;
    }
    .forwidth {
        width:36.5%;
    }

    .altwidth:nth-child(3) {
        margin-right:0;
    }

    .remarks_box {
        width: 89%;
    }
    .process_box {
        margin-top:25px;
    }

    .frwidth {
        width: 17.4%;
        padding-left: 10px;
        font-weight: bold;
    }
    .frwidth .form-group {
        width:100%;
        float: left;
    }
    .flight_rules_text {
        font-size: 13px;
        font-weight: normal;
        float: left;
        margin-top: 5px;
    }
    .flrules {
        width: 40%;
        float: right;
    }
    .flrules dd ul {
        width: 50px;
    }
    .cust_label {
        text-align: center;
        font-size: 13px;
        font-weight: normal;
        display: block;
    }




    @media only screen and (min-width : 320px) and (max-width : 767px) {
        .container-fluid {
            margin-top: 56px;
        }
        .custom-col,.cust-flytime,.custom-col-route,.altwidth {
            float: left;
            width: 50%;
            padding-left:5px;
            padding-right:5px;
        }
        .planned-form {
            padding: 0;
        }

        .nation, .forwidth, .endurance, .firtime, .fremark, .mod-remark {
            float: left;
        }

        .custom-col-route {
            width: 95%;
            margin-top: -40px;
        }
        .altwidth {
            width: 50%;
            margin-right: 0 !important;
        }
        .altwidth:nth-child(3) {
            width: 50%;
        }

        .nation {
            width: 50%;
            padding-left: 15px;
        }
        .forwidth {
            width: 100%;
            padding-left:5px;
            padding-right:5px;
        }
        .route_box {
            width: 100%;
            float:left;
            padding-left:5px;
            padding-right:5px;
        }
        .nation {
            margin-top:0;
        }
        .endurance  {
            width: 50%;
            padding-left: 5px;
            padding-right: 0;
        }

        .frwidth {
            float:left;
            width: 50%;

            padding-right:5px;
        }

        .frwidth .form-group {
            float: left;
            margin-bottom: 0;
            width:100%;
        }

        .fir_box, .alt_helipad_box {
            padding-left:5px;
            padding-right:5px;
        }
        .fir_box .form-group {
            margin-bottom: 10px;
        }
        .firtime {
            width: 50%;
        }
        .fremark {
            width: 100%;
        }
        .mod-remark {
            width: 95%;

        }



        .remarks_box {
            width:100%;
            padding-left: 5px;
            padding-right:5px;
        }
        .process_box {
            float: right;
            padding-right: 5px;
            margin-top:0;
        }
    }
    @media only screen and (min-width : 768px) and (max-width : 1024px) {
        .custom-col,.cust-flytime,.custom-col-route,.altwidth {
            float: left;
            width: 26%;
        }

        .nation, .forwidth, .endurance, .firtime, .fremark, .mod-remark {
            float: left;
        }

        .custom-col-route {
            width: 38%;
        }
        .altwidth {
            width: 33.33%;
            margin-right: 0 !important;

        }
        .nation {
            width: 20%;
            padding-left: 15px;
        }
        .route_box {
            margin-bottom:0;
        }
        .forwidth {
            width: 100%;
        }

        .endurance  {
            width: 28%;
        }
        .firtime {
            width: 30%;
        }
        .frwidth {
            width: 33.3%;
            float: left;
            margin-left: 34px;
            padding-left: 40px;
        }




        .frwidth .form-group {
            float:left;
            margin-bottom: 0;
            width: 100%;
        }
        .flrules dd ul {
            width: 63px;
        }
        .fremark {
            width: 50%;
        }
        .mod-remark {
            width: 85%;
            margin-right: 10px;
        }
        .remarks_box {
            width: 84%;
            float: left;
        }
        .process_box {
            float:right;
        }

    }
    @media only screen and (min-width: 1200px) {
        .page_section,.cust-container  {
            width:1000px;
        }

    }


</style>


<div class="page">  
    <main>
        @include('includes.new_header',[])
        <form data-toggle="validator" onsubmit="return validform()" id="edit_fpl" method="post" action="{{url('fpl/edit_process')}}">
            <div class="page_section">
                <div class="search-band">
                    <div class="container cust-container">
                        <div class="row">
                            <div class="col-md-12">				
                                <div class="search">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3">
                                            <label class="novalue" for="novalue">&nbsp;</label>
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" {{(isset($aircraft_callsign)) ?  "readonly='readonly'": ""}} placeholder="Call Sign" value="{{ (isset($aircraft_callsign)) ? $aircraft_callsign : ""}}" name="aircraft_callsign" id="aircraft_callsign" tabindex="1">
                                            </div></div>
                                        <div class="col-sm-3 col-md-3">
                                            <label class="novalue" for="novalue">&nbsp;</label>
                                            <div class="form-row">
                                                <div class="form-search-row-left">
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" {{ (isset($departure_aerodrome)) ?  "readonly='readonly'": "" }} placeholder="From" value="{{ (isset($departure_aerodrome)) ? $departure_aerodrome : ""}}" name="departure_aerodrome" id="departure_aerodrome" tabindex="2">
                                                    </div>
                                                </div>
                                                <div class="form-search-row-right">
                                                    <div class="form-group">
                                                        <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" placeholder="To" {{ (isset($destination_aerodrome)) ?  "readonly='readonly'": "" }} value="{{ (isset($destination_aerodrome)) ? $destination_aerodrome : ""}}" name="destination_aerodrome" id="destination_aerodrome" tabindex="3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <label for="depart-time" class="flytime timedpt">Departure Time</label>
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="form-time-left search-time-left">
                                                        <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" placeholder="To" {{ (isset($departure_time_hours)) ?  "readonly='readonly'": "" }} value="{{ (isset($departure_time_hours)) ? $departure_time_hours : ""}}" name="departure_time_hours" id="departure_time_hours" tabindex="3">
                                                    </div>
                                                    <div class="form-time-left search-time-left">
                                                        <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" {{ (isset($departure_time_hours)) ?  "readonly='readonly'": "" }} value="{{ (isset($departure_time_minutes)) ? $departure_time_minutes : ""}}" name="departure_time_minutes" placeholder="Hr" id="departure_time_minutes"  minlength="2" tabindex="3">
                                                    </div>
                                                    <div class="form-time-right search-time-right">
                                                        <div id="newtimeTM" class="newtime"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <label class="novalue" for="novalue">&nbsp;</label>
                                            <div class="form-row">
                                                <div class="form-search-row-left deskview">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            @if(isset($date_of_flight))
                                                            <input type="text" autocomplete="off" value="{{$date_of_flight}}" readonly='readonly' style="background: #eee; text-align:center;width: 132px" class="form-control text-center font-bold" placeholder="Date of Flight" name="date_of_flight" id="date_of_flight" minlength="6" maxlength="6" tabindex="5" readonly="readonly">
                                                            @else
                                                            <input type="text" autocomplete="off" value="{{ date('ymd')}}"  style="background: white; text-align:center;width: 132px" class="form-control text-center font-bold datepicker pointer" placeholder="Date of Flight" name="date_of_flight" id="date_of_flight" minlength="6" maxlength="6" tabindex="5" readonly>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-search-row-right processbtn deskprocess">
                                                    <div class="form-group">
                                                        @if(isset($is_process))
                                                        <a data-toggle="modal" href="#resetbox"  class="btn newbtnv1"  tabindex="14">Reset</a>
                                                        @else							
                                                        <button type="submit" disabled="disabled" class="btn newbtn"   value="Process"  tabindex="14">Process</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" {{ (isset($pilot_in_command)) ?  "readonly='readonly'": "" }} value="{{ (isset($pilot_in_command)) ? $pilot_in_command : ""}}" name="pilot_in_command" id="pilot_in_command" placeholder="Pilot Name" tabindex="6">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" {{ (isset($mobile_number)) ?  "readonly='readonly'": "" }} value="{{ (isset($mobile_number)) ? $mobile_number : ""}}" name="mobile_number" id="mobile_number" placeholder="Mobile Number" tabindex="7">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" {{ (isset($copilot)) ?  "readonly='readonly'": "" }} value="{{ (isset($copilot)) ? $copilot : ""}}" name="copilot" id="copilot" placeholder="Co Pilot Name" tabindex="8">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" {{ (isset($cabincrew)) ?  "readonly='readonly'": "" }} value="{{ (isset($cabincrew)) ? $cabincrew : ""}}" name="cabincrew" id="cabincrew" placeholder="Cabin Name" tabindex="9">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" readonly  value="{{ (isset($departure_station)) ? $departure_station : ""}}" name="departure_station" id="departure_station" placeholder="Dep. Station" tabindex="10">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" readonly  value="{{ (isset($departure_latlong)) ? $departure_latlong : ""}}" name="departure_latlong" id="departure_latlong" placeholder="Dep. Lat-Long" tabindex="11">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" readonly  value="{{ (isset($destination_station)) ? $destination_station : ""}}" name="destination_station" id="destination_station" placeholder="Dest. Name" tabindex="12">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control" readonly  value="{{ (isset($destination_latlong)) ? $destination_latlong : ""}}" name="destination_latlong" id="destination_latlong" placeholder="Dest. Lat-Long" tabindex="13">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    </div>
                                    <div class="row mobileprocess">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                             <!--  <input type="button" class="form-control process" value="Process" tabindex="14" data-toggle="modal" data-target="#confbox"> -->
                                                <a href="#" class="btn btn__secondary"><span>Process</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>				
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="container cust-container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12 plan-form planned-form">
                                        <div class="edit-flight-plan">			
                                            <div class="row field-group">
                                                <div class="col-md-12">
                                                    <div class="field-rows">
                                                        <div class="row">
                                                            <div class="col-md-3 custom-col">
                                                                <div class="form-group">

                                                                    <div class="form-row">
                                                                        <div class="form-time-left speed-left">
                                                                            <label for="novalue" class="novalue">&nbsp;</label>
                                                                            <dl id="setspeed" class="speed form-control" required data-toggle="popover" data-placement="top" >
                                                                                <dt><a><span id="crushing_speed_indication_value">{{(isset($crushing_speed_indication) && $crushing_speed_indication != '') ? $crushing_speed_indication : '---'}}</span></a></dt>
                                                                                <dd>
                                                                                    <ul>
                                                                                        <li class="crushing_speed_indication"><a><span>K</span></a></li>
                                                                                        <li class="crushing_speed_indication"><a><span>M</span></a></li>
                                                                                        <li class="crushing_speed_indication"><a><span>N</span></a></li>
                                                                                    </ul>
                                                                                </dd>
                                                                            </dl>

                                                                        </div>
                                                                        <div class="form-time-left speed-right">

                                                                            <label class="cust_label">Speed</label>
                                                                            <input type="text" required data-toggle="popover" data-placement="top"  maxlength="4" minlength="3" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control numeric" value="{{ (isset($crushing_speed)) ? $crushing_speed : ""}}"  id="crushing_speed" name="crushing_speed">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 custom-col">
                                                                <div class="form-group">

                                                                    <div class="form-row">
                                                                        <div class="form-time-left speed-left">
                                                                            <label for="novalue" class="novalue">&nbsp;</label>
                                                                            <dl id="setspeedvalue" class="level form-control" required data-toggle="popover" data-placement="top" >
                                                                                <dt><a><span id="flight_level_indication_value">{{(isset($flight_level_indication) && $flight_level_indication != '') ? $flight_level_indication : '---'}}</span></a></dt>
                                                                                <dd>
                                                                                    <ul>
                                                                                        <li class="flight_level_indication"><a><span>F</span></a></li>
                                                                                        <li class="flight_level_indication"><a><span>A</span></a></li>
                                                                                    </ul>
                                                                                </dd>
                                                                            </dl>
                                                                        </div>
                                                                        <div class="form-time-left speed-right">
                                                                            <label class="cust_label">Level</label>
                                                                            <input type="text" required data-toggle="popover" data-placement="top"  maxlength="3" minlength="3" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control numeric" value="{{ (isset($flight_level)) ? $flight_level : ""}}"  id="flight_level" name="flight_level">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>                          
                                                            <div class="col-md-2 cust-flytime">
                                                                <div class="form-group">

                                                                    <label class="cust_label">Flying Time</label>
                                                                    <div class="form-row">
                                                                        <div class="form-time-left search-time-left">
                                                                            <dl id="total_hour" class="modhrs form-control validation_class_click" required data-toggle="popover" data-placement="top">
                                                                                <dt><a><span id="total_time_hours">{{(isset($total_flying_hours) && $total_flying_hours != '') ? $total_flying_hours : 'Hr'}}</span></a></dt>

                                                                                <dd>
                                                                                    <ul>
                                                                                        @for($i=00;$i<=07;$i++)
                                                                                        <li class="total_flying_hours"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                                        @endfor
                                                                                    </ul>
                                                                                </dd>
                                                                            </dl>

                                                                        </div>  

                                                                        <div class="form-time-left search-time-right">
                                                                            <dl id="total_mins" class="modmin form-control validation_class_click" required data-toggle="popover" data-placement="top">
                                                                                <dt><a><span id="total_time_minutes">{{(isset($total_flying_minutes) && $total_flying_minutes != '') ? $total_flying_minutes : 'Min'}}</span></a></dt>
                                                                                <dd>
                                                                                    <ul>
                                                                                        @for($i=00;$i<=59;$i++)
                                                                                        <li class="total_flying_minutes"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                                        @endfor
                                                                                    </ul>
                                                                                </dd>
                                                                            </dl>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1 nation">

                                                                <div class="form-row">
                                                                    <div class="natinality-left">
                                                                        <input type="radio" class="indian" name="indian" id="indian"  value="YES" {{(isset($foreigner)) ? (($foreigner=='YES') ? '' : "checked='checked'"): "checked='checked'"}} >
                                                                    </div>
                                                                    <div class="nationality-right">
                                                                        Indians
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="natinality-left">
                                                                        <input type="radio" class="indian" name="indian" id="foreigner" value="NO" {{(isset($foreigner)) ? (($foreigner=='YES') ? "checked='checked'" : ''): ""}}>
                                                                    </div>
                                                                    <div class="nationality-right">
                                                                        Foreigner
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-3 forwidth">
                                                                <label class="cust_label">Foreigner Nationality</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off"  data-toggle="popover" data-placement="top" {{(isset($foreigner)) ? (($foreigner=='YES') ? "" : "readonly='readonly'"): "readonly='readonly'"}}    maxlength="50" minlength="3" value="{{(isset($foreigner)) ? (($foreigner == 'YES') ? $foreigner_nationality : '') : ""}}" name="foreigner_nationality" id="foreigner_nationality" class="text-center font-bold text_uppercase validation_class form-control pilot_in_command">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 route_box">
                                                                <label class="cust_label">Route</label>
                                                                <div class="form-group">

                                                                    <input type="text" data-toggle="popover" data-placement="top" autocomplete="off" class="text-center font-bold text_uppercase validation_class form-control route_allowed_chars" value="{{ (isset($route)) ? (($route) ? substr($route, 0, 50) : "") : ""}}" required="required" name="route" id="route" minlength="2" maxlength="50" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--							<div class="row">
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="form-group">
                                                                                                                            <input type="text" autocomplete="off" data-toggle="popover" data-placement="bottom"  maxlength="100" {{ (isset($route) && strlen($route)<50 ) ? 'readonly="readonly"' :  ''}} minlength="1" class="text-center font-bold text_uppercase validation_class form-control route_allowed_chars" value="{{ (isset($route)) ?  substr($route,50) : '' }}" name="route1" id="route1" placeholder="Route">
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>-->
                                                        <div class="row">
                                                            <div class="col-md-2 altwidth">
                                                                <label class="cust_label">Alternate 1</label>
                                                                <div class="form-group">

                                                                    <input type="text" autocomplete="off" required data-toggle="popover" data-placement="top"  maxlength="4" minlength="4" class="text-center font-bold text_uppercase validation_class form-control alphabets" value="{{ (isset($first_alternate_aerodrome)) ? $first_alternate_aerodrome : ""}}" name="first_alternate_aerodrome" id="first_alternate_aerodrome">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 altwidth">
                                                                <label class="cust_label">Alternate 2</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off" data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4" class="text-center font-bold text_uppercase validation_class form-control alphabets" value="{{ (isset($second_alternate_aerodrome)) ? $second_alternate_aerodrome : ""}}" name="second_alternate_aerodrome" id="second_alternate_aerodrome">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 altwidth">
                                                                <label class="cust_label">Take off Altn</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off" data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4" class="text-center font-bold text_uppercase validation_class form-control alphabets" value="{{ (isset($take_off_altn)) ? $take_off_altn : ""}}" name="take_off_altn" id="take_off_altn">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 altwidth">
                                                                <label class="cust_label">Route Altn</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets" placeholder="" name="route_altn" id="route_altn" value="{{(isset($route_altn))? $route_altn:''}}"  data-toggle="popover" data-placement="bottom"  maxlength="4" minlength="4">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 endurance">
                                                                <label class="cust_label">Endurance</label>
                                                                <div class="form-group">
                                                                    <div class="form-row">
                                                                        <div class="form-time-left end-left">
                                                                            <dl id="endurhours" class="endhrs form-control validation_class_click"  required data-toggle="popover" data-placement="top">
                                                                                <dt><a><span id="endurance_time_hours">{{(isset($endurance_hours) && $endurance_hours != '') ? $endurance_hours : 'Hr'}}</span></a></dt>
                                                                                <dd>
                                                                                    <ul>
                                                                                        @for($i=00; $i<=9; $i++)
                                                                                        <li class="endurance_hours"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                                        @endfor
                                                                                    </ul>
                                                                                </dd>
                                                                        </div>
                                                                        <div class="form-time-left end-right">
                                                                            <dl id="endurmins" class="endmin form-control validation_class_click" required data-toggle="popover" data-placement="top">
                                                                                <dt><a><span id="endurance_time_minutes">{{(isset($endurance_minutes) && $endurance_minutes != '') ? $endurance_minutes : 'Min'}}</span></a></dt>
                                                                                <dd>
                                                                                    <ul>
                                                                                        @for($i=00;$i<=59;$i++)
                                                                                        <li class="endurance_minutes"><a>{{$i < 10 ? '0'.$i : $i}}</a></li>
                                                                                        @endfor
                                                                                    </ul>
                                                                                </dd>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 frwidth">
                                                                <label class="novalue">novalue</label>
                                                                <div class="form-group">
                                                                    <span class="flight_rules_text">Flight Rules</span>
                                                                    <dl id="rules" class="form-control flrules" required data-toggle="popover" data-placement="top">
                                                                        <dt><a><span id="flight_rules_value">{{(isset($flight_rules) && $flight_rules!='') ? $flight_rules : '---' }}</span></a></dt>
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
                                                        <div class="row">
                                                            <div class="col-md-6 alt_helipad_box">
                                                                <label class="cust_label">Alternate ZZZZ Place/ Helipad Name</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class alphabets" {{(isset($alternate_station) && $alternate_station !='' && !isset($is_myaccount)) ? '':"readonly='readonly'"}} name="alternate_station" id="alternate_station" value="{{(isset($alternate_station))? $alternate_station: ''}}" placeholder="" data-toggle="popover" data-placement="bottom"  maxlength="25" minlength="3">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 fir_box">
                                                                <label class="cust_label">FIR Crossing Time</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off"  data-toggle="popover" data-placement="top"  maxlength="75" minlength="8" value="{{ (isset($fir_crossing_time)) ? $fir_crossing_time : ""}}" class="text-center font-bold text_uppercase validation_class form-control" name="fir_crossing_time" id="fir_crossing_time">
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-10 remarks_box">
                                                                <label class=" cust_label">Remarks</label>
                                                                <div class="form-group">
                                                                    <input type="text" autocomplete="off"  data-toggle="popover" data-placement="top" value="{{ (isset($remarks) && $remarks != '') ? (($remarks) ? substr($remarks, 0, 50) : "") : ""}}"  maxlength="50" minlength="2" class="text-center font-bold text_uppercase validation_class form-control route_allowed_chars" name="remarks" id="remarks">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1 process_box">
                                                                <div class="form-group">
                                                                    <div class="newbtnv1 b-radius-5">

                                                                        <!--<input class="text-center font-bold text_uppercase validation_class form-control process newbtn">-->
                                                                        <input type="submit" id="process" name="flag" data-name="Edit" data-url="{{url('fpl/edit_process')}}" value="Process" class="btn btn_appearance">

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
                            </div>
                        </div>
                    </div>
            </div>
            </section>
            <!--input hidden fields-->
            <div class="row">	
                <input type="hidden" name="is_process_click" id="is_process_click" value="{{(isset($is_process)) ? $is_process : ''}}" />
                <input type="hidden" name="is_myaccount" id="is_myaccount" value="{{(isset($is_myaccount)) ? $is_myaccount : ''}}" />
                <!--<input type="hidden" name="route_altn" id="route_altn" value="{{(isset($route_altn)) ? $route_altn : ''}}" />-->
                <input type="hidden" name="crushing_speed_indication" id="crushing_speed_indication" value="{{(isset($crushing_speed_indication)) ? $crushing_speed_indication : ''}}" />
                <input type="hidden" name="flight_level_indication" id="flight_level_indication" value="{{(isset($flight_level_indication)) ? $flight_level_indication : ''}}" />
                <input type="hidden" name="total_flying_hours" id="total_flying_hours" value="{{(isset($total_flying_hours)) ? $total_flying_hours : ''}}" />
                <input type="hidden" name="total_flying_minutes" id="total_flying_minutes" value="{{(isset($total_flying_minutes)) ? $total_flying_minutes : ''}}" />
                <input type="hidden" name="endurance_hours" id="endurance_hours" value="{{(isset($endurance_hours)) ? $endurance_hours : ''}}" />
                <input type="hidden" name="endurance_minutes" id="endurance_minutes" value="{{(isset($endurance_minutes)) ? $endurance_minutes : ''}}" />
                <input type="hidden" name="is_edit_plan" id="is_edit_plan" value="1" />
                <input type="hidden" name="flight_rules" id="flight_rules" value="{{(isset($flight_rules)) ? $flight_rules : ''}}" />
                <input type="hidden" name="flight_type" id="flight_type" value="{{(isset($flight_type)) ? $flight_type : ''}}" />
                <input type="hidden" name="aircraft_type" id="aircraft_type" value="{{(isset($aircraft_type)) ? $aircraft_type : ''}}" />
                <input type="hidden" name="weight_category" id="weight_category" value="{{(isset($weight_category)) ? $weight_category : ''}}" />
                <input type="hidden" name="equipment" id="equipment" value="{{(isset($equipment)) ? $equipment : ''}}" />
                <input type="hidden" name="transponder" id="transponder" value="{{(isset($transponder)) ? $transponder : ''}}" />
                <!--<input type="hidden" name="alternate_station" id="alternate_station" value="{{(isset($alternate_station)) ? $alternate_station : ''}}" />-->
                <input type="hidden" name="registration" id="registration" value="{{(isset($registration)) ? $registration : ''}}" />
                <input type="hidden" name="operator" id="operator" value="{{(isset($operator)) ? $operator : ''}}" />
                <input type="hidden" name="sel" id="sel" value="{{(isset($sel)) ? $sel : ''}}" />
                <input type="hidden" name="pbn" id="pbn" value="{{(isset($pbn)) ? $pbn : ''}}" />
                <input type="hidden" name="nav" id="nav" value="{{(isset($nav)) ? $nav : ''}}" />
                <input type="hidden" name="code" id="code" value="{{(isset($code)) ? $code : ''}}" />
                <input type="hidden" name="per" id="per" value="{{(isset($per)) ? $per : ''}}" />
                <input type="hidden" name="tcas" id="tcas" value="{{(isset($tcas)) ? $tcas : ''}}" />
                <input type="hidden" name="credit" id="credit" value="{{(isset($credit)) ? $credit : ''}}" />
                <input type="hidden" name="emergency_uhf" id="emergency_uhf" value="{{(isset($emergency_uhf)) ? $emergency_uhf : ''}}" />
                <input type="hidden" name="emergency_vhf" id="emergency_vhf" value="{{(isset($emergency_vhf)) ? $emergency_vhf : ''}}" />
                <input type="hidden" name="emergency_elba" id="emergency_elba" value="{{(isset($emergency_elba)) ? $emergency_elba : ''}}" />
                <input type="hidden" name="polar" id="polar" value="{{(isset($polar)) ? $polar : ''}}" />
                <input type="hidden" name="desert" id="desert" value="{{(isset($desert)) ? $desert : ''}}" />
                <input type="hidden" name="maritime" id="maritime" value="{{(isset($maritime)) ? $maritime : ''}}" />
                <input type="hidden" name="jungle" id="jungle" value="{{(isset($jungle)) ? $jungle : ''}}" />
                <input type="hidden" name="light" id="light" value="{{(isset($light)) ? $light : ''}}" />
                <input type="hidden" name="floures" id="floures" value="{{(isset($floures)) ? $floures : ''}}" />
                <input type="hidden" name="jacket_uhf" id="jacket_uhf" value="{{(isset($jacket_uhf)) ? $jacket_uhf : ''}}" />
                <input type="hidden" name="jacket_vhf" id="jacket_vhf" value="{{(isset($jacket_vhf)) ? $jacket_vhf : ''}}" />
                <input type="hidden" name="number" id="number" value="{{(isset($number)) ? $number : ''}}" />
                <input type="hidden" name="capacity" id="capacity" value="{{(isset($capacity)) ? $capacity : ''}}" />
                <input type="hidden" name="cover" id="cover" value="{{(isset($cover)) ? $cover : ''}}" />
                <input type="hidden" name="color" id="color" value="{{(isset($color)) ? $color : ''}}" />
                <input type="hidden" name="aircraft_color" id="aircraft_color" value="{{(isset($aircraft_color)) ? $aircraft_color : ''}}" />
                <input type="hidden" name="filing_date" id="filing_date" value="{{(isset($filing_date)) ? $filing_date : ''}}" />
                <input type="hidden" name="filed_date" id="filed_date" value="{{(isset($filed_date)) ? $filed_date : ''}}" />
                <input type="hidden" name="is_app" id="is_app" value="0" />
                <input type="hidden" name="is_web" value="1">
                <input type="hidden" name="is_new_plan" id="is_new_plan" value="{{(isset($is_new_plan)) ? $is_new_plan : ''}}">
		<input type="hidden" name="remarks1" id="remarks1" value="{{(isset($remarks)) ? substr($remarks,50) : ''  }}" />
		<input type="hidden" name="route1" id="route1" value="{{(isset($remarks)) ? substr($remarks,50) : ''  }}" />
            </div>
            @include('includes.reset_modal',[])
            </div> 
        </form>
    </main>

    @include('includes.new_footer',[])
</div>
@stop