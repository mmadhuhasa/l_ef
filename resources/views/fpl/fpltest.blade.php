@extends('layouts.fdtl_test',array('1'=>'1'))
@section('content')
<script>
    $("#date_of_flight").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: 0, showOtherMonths: true, selectOtherMonths: true,
        showAnim: "slide",
        dateFormat: 'yy-mm-dd',
        onSelect: function () {
            $(".notify-bg-v").fadeOut();
        }
    });
    $("#date_of_flight").datepicker("option", "dateFormat", "dd-M-yy");
</script>
<style>
    .dropdown dd ul{
        width: 118px; 
    }
    .dropdown dd ul, .dropdowns dd ul, .speed dd ul, .level dd ul, .modhrs dd ul, .modmin dd ul, .nationality dd ul, .endhrs dd ul, .endmin dd ul, .flrules dd ul, .fltypes dd ul, .wtcat dd ul, .transmode dd ul, .tt-hrs dd ul, .tt-mins dd ul, .crfacility dd ul{
        height: 135px;
        overflow-y: hidden;
    }
    .dropdown dd ul li a:hover, .dropdowns dd ul li a:hover, .speed dd ul li a:hover, .level dd ul li a:hover, .modhrs dd ul li a:hover, .modmin dd ul li a:hover, .endhrs dd ul li a:hover, .endmin dd ul li a:hover, .nationality dd ul li a:hover, .flrules dd ul li a:hover, .fltypes dd ul li a:hover, .wtcat dd ul li a:hover, .transmode dd ul li a:hover, .tt-hrs dd ul li a:hover, .tt-mins dd ul li a:hover, .crfacility dd ul li a:hover{
        color: #fff;
    }
    .ui-datepicker-trigger{
        right: 10px;
        height: 21px;
        top: 6px;  
    }
    .notify-bg-v {
        background: rgba(0, 0, 0, 0.6)!important;
    }
    .table-responsive {
        margin: auto;
        width:340px;
        padding-top:10px;
    }
    .table {
        margin-bottom: 10px;
    }
    .panel-heading{
        padding:0px;
    }
    .align_center{
        text-align:center;
    }
    .panel-default>.panel-heading{
        cursor:pointer;
    }
    a:focus, a:hover {
        color: #000;
        text-decoration: none;
    }
    .table-bordered{
        border-width: 3px;
        border-style: ridge;
        border-color: grey;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        padding: 5px;
        font-size: 14px;
    }
    .form-row .form-search-row-left{
        width: 48%;

    }
    *{
        -moz-box-sizing: border-box !important;
    }

    .desk-plan > thead > tr > th, .desk-plan > tbody > tr > td{
        border-right:1px black!important;
        border-top:1px black!important;

    }
    .view_the_notams{
        cursor: pointer;
        padding-left: 4px;
        width: 100px;
    }
    .view_the_notams .notam-count{
        text-decoration: underline;
    }
    .view_the_notams .aerodrome-name-notams{
        width: 46px;
        display: inline-block;
    }

    .fic-adc ::-moz-placeholder {  /* Firefox 19+ */
        font-weight: bold
    }
    .fic-adc :-ms-input-placeholder {  
        font-weight: bold
    }
    form.uppercase{text-transform: uppercase;}
    .report_head {text-transform: uppercase;background: #a6a6a6;background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);            background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                  background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                  background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                  background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                  text-align: center;padding: 7px 0;font-weight: 600;font-size: 15px;color: #fff;margin-bottom: 15px;}
    .stats_boxes p:last-child {font-weight: bold;}
    .stats_sec {margin-top:20px !important; box-shadow:1px 3px 12px 2px #999; padding-bottom: 15px; width: 100%;margin: 0 auto;}
    .stats_box1 {background : #8BC43F;}
    .stats_box2 {background: #F86C32;}
    .stats_box3 {background: #68C1DD;}
    .stats_box4 {background: #BA68C8;}
    .stats_boxes {height:70px;width: 80%;margin:0 auto;text-align: center;padding-top: 15px;border-radius: 4px;}

    .desk-plan .form-control[disabled],.desk-plan .form-control[readonly],.desk-plan fieldset[disabled] .form-control {background: #999;}
    .p-lr-0 {padding-left:0;padding-right:0;}
    .p-r-9 {padding-right:9px;}
    .m-l-7 {margin-left:7px;}

    .new_fpl_heading,.search_heading {margin-bottom:15px;text-align: center;padding: 7px 0;font-weight: 600;font-size: 15px;color:#fff;
                                      font-family:'pt_sansregular', sans-serif;background: #a6a6a6;
                                      background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                      background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                      background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                      background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                      background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
    }
    .search_heading {margin-bottom: 30px;text-transform: uppercase;}
    .dof_label {position: absolute;top:-24px;left:0px;font-size: 13px;color: #222;}
    .plan_check_label{position: absolute;top:-24px;left:17px;font-size: 13px;color: #222;}
    .fpl_search_from_label, .fpl_search_to_label {position: absolute;top:-20px;left:26%;font-size: 13px;color:#222;}
    .form-row .deskview {width: 54%;}
    .form-row .deskprocess {width: 43%;}
    .search-band {padding-top:0px;}
    #process {width: 88px;}

    .form-row .form-search-row-right .ui-datepicker-trigger {height: 21px;top:6px;}
    .from_dp_pos .ui-datepicker-trigger {right: 9px;height: 23.5px;top: 5px;}
    .form-row .deskview .ui-datepicker-trigger {right: 10px;height: 21px;top: 6px;}
    #date_of_flight {font-size: 13px; font-weight: normal;color: #222;background: white;text-align:left;padding-left:5px;border-radius:4px;}
    .q_filter {width: 100%;float:left; padding-left: 10px;padding-right: 10px;}
    .q_filter .depstatns, .q_filter .destatns {width:21%;}
    .from_to_adj_width {width:31.5%;}
    .from_dp_pos {width: 100%;}
    .from_widthv {width: 42% !important;}
    #from_date {text-align: left;font-size: 13px;font-weight: normal;color: #222;}
    #to_date {padding-left: 5px;font-size:13px;font-weight: normal;color: #222;text-align: left;width: 137%;border-radius: 5px;}
    .to_widthv {width: 58%;}


    .fic-adc .send {width: 21%;}
    .desk-plan {border-collapse: collapse !important;}
    .desk-plan>thead {background: #F26232;background: linear-gradient(to top, #fa9b5b, #F26232);background: #f1292b;
                      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
                      background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
                      background: -moz-linear-gradient(top, #f1292b, #f37858);border-top:1px solid #333333;}
    .desk-plan>tbody>tr>td {font-size: 14px;}

    .desk-plan tr:nth-child(odd) td{background: #ffffff;}
    .desk-plan tr:nth-child(even) td{background: #eeeeee;}
    .desk-plan tr:hover:nth-child(odd) td,.desk-plan tr:hover:nth-child(even) td {background: #ccc;}
    .desk-plan>thead>tr>th, .desk-plan>tbody>tr>td {padding:5px;border:1px solid #333;text-transform: uppercase;}



    .desk-plan>thead>tr>th {font-size: 14px;color: #ffffff;}
    .desk-plan>thead>tr>th:nth-child(9), .desk-plan>tbody>tr>td:nth-child(9) {border-right:0;}
    .desk-plan>thead>tr>th:nth-child(10), .desk-plan>tbody>tr>td:nth-child(10) {border-left:0;border-right:0;}
    .desk-plan>thead>tr>th:nth-child(11), .desk-plan>tbody>tr>td:nth-child(11) {border-left:0;}
    .desk-plan>thead>tr>th:nth-child(9), .desk-plan>thead>tr>th:nth-child(10), .desk-plan>thead>tr>th:nth-child(11) {letter-spacing: -0.7px;}

    .glassy-img {
        width: 50%;
    }
    /*        Start of Count_btns Styles*/
    .count_btns_sec {width: 21.8%;position: absolute;left: 27%;top: 19px;z-index: 9;}
    .count_btns {width: 100%; font-size: 12px; border-radius: 19px;background: #333 !important;color:#fff !important; height: 26px;line-height: 4px; margin-top: 10px; color: #000; font-weight: bold;}
    .count_btns:hover, .count_btns:focus {color: #fff !important;}
    .count_btns:before {background: #999;}

    /*         End of Count_btns Styles*/

    .stats_fixed_wing, .stats_heli, .stats_month, .stats_year, .stats_wx, .stats_tripkit {width: 15.5%;display: inline-block;text-align: center;position: relative;cursor:pointer;}
    .fixed_wing_count, .heli_count, .month_count, .year_count, .wx_count, .tripkit_count {color:#333;font-size: 12px;margin-top:2px;font-weight: bold;}
    .fixed_wing_count:hover, .heli_count:hover, .month_count:hover, .year_count:hover, .wx_count:hover, .tripkit_count:hover {color:#f1292b;}
    .stats_fixed_wing img, .stats_heli img, .stats_month img, .stats_year img, .stats_wx img, .stats_tripkit img {transition: 0.3s all;height: 42px;}
    .stats_fixed_wing:hover img, .stats_heli:hover img, .stats_month:hover img, .stats_year:hover img, .stats_wx:hover img, .stats_tripkit:hover img {transform: scale(1.1);transition: 0.3s all;}
    .stats_fixed_wing:hover p, .stats_heli:hover p, .stats_month:hover p, .stats_year:hover p, .stats_wx:hover p, .stats_tripkit:hover p {color:#f1292b;}
    .dof .flightdate, .calsign .csgn, .depart-time .mod-time .alt-time {font-size: 14px;}
    @media (min-width: 1024px) {
        .glassy-img {width: 24%; margin-left: 15px;}
        #fpl_search .form-row .form-search-row-right {width: 54%;}
    }

    @media only screen and (min-width : 320px) and (max-width : 767px) {
        .container-fluid {
            margin-top: 56px;
        }

        .glassy {
            height:70px;
        }
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
            width: 41% !important;
        }
        .to_widthv {
            width: 49%;
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
        .xs-p-r-10 {
            padding-right: 10px;
        }
        .xs-p-l-5 {
            padding-left: 5px;
        }
        .xs-p-r-5 {
            padding-right: 5px;
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
            width:147%;
        }
        #date_of_flight {
            padding-left: 31px;
        }
        .xs-m-t-25 {
            margin-top: 25px;
        }
        .count_btns_sec {
            width: 54%;
            left: 45%;
            top: 14px;
        }
        .count_btns {
            font-size: 10px;
        }
        .glassy-img {
            width: 45%;
        }
    }
    @media only screen and (min-width : 768px) and (max-width : 1024px) {
        .container {
            padding-left: 0px;
            padding-right:0px;
        }
        .glassy {
            height:14px;
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
        .glassy-img {
            width: 21%;
            left: 10px;
        }
        .count_btns_sec {
            width: 26.4%;
            left:22%;
        }
        .stat_icons {width: 48%;left: 16px;}

    }

    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
        #process {
            width: 100px;
        }
        .dof_label {
            left:15%;
        }
        #date_of_flight {
            padding-left: 20px; 
        }
        .q_filter .depstatns, .q_filter .destatns, .from_to_adj_width {
            width:25%;
        }
        #from_date {
            padding-left: 5px;
        }
        #to_date {
            padding-left: 5px;
            width: 152%;
        }
        .desk-plan {
            width:1200px !important;
        }
    }

    .animated {
        animation-duration: 2s;
    }
    .animated.custdelay {
        animation-iteration-count: 3;
        -webkit-animation-iteration-count: 3;
    }

    .background-white{
        background: #fff !important;
    }
    /*        START OF FDTL MODAL PLACEHOLDER STYLES*/
    .fdtl_modal .popupHeader {
        font-size: 14px;
    }
    .fdtl_modal div.dynamiclabel
    { 
        display: block;
        position: relative;
        text-align: left;
    }

    .fdtl_modal div.dynamiclabel label{
        position: absolute;
        color:red;
        font-size:11px;
        font-weight:normal;
        background: transparent;
        /*            border: 1px solid #333;*/
        border-radius: 2px;
        -webkit-border-radius:2px;
        -moz-border-radius:2px;
        -khtml-border-radius:2px;
        -webkit-backface-visibility: hidden;
        top: 10px;           
        -moz-transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        -webkit-transition: all 0.4s ease-in-out; 
        -o-transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        opacity: 0;
        z-index: -1;
        line-height: 0px;
        white-space: nowrap;
    }
    .fdtl_modal div.dynamiclabel > *:focus{
        border-color:#f1292b;
    }
    .fdtl_modal div.dynamiclabel > *:focus + label{
        opacity: 1;
        z-index:100;
        top: 0px;
    }
    .fdtl_modal div.dynamiclabel [placeholder]::-webkit-input-placeholder {
        text-align: left;
    }
    .fdtl_modal div.dynamiclabel [placeholder]:focus::-webkit-input-placeholder {
        transition: opacity 0.5s 0.5s ease; 
        opacity: 0;
    }
    .fdtl_modal div.dynamiclabel .form-control {
        border:none;
        border-radius: 0;
        box-shadow: none;
        border-bottom: 1px solid #999;
        padding-left:0;
        text-align: left;
    }
    .fdtl_modal div.dynamiclabel .form-control:focus {
        border-bottom: 1px solid #ff0000;
    }
    /*        END OF FDTL MODAL PLACEHOLDER STYLES*/
    .table-hover>tbody>tr:nth-child(2n+1){
        background: #fff;
    }
    .table-hover>tbody>tr:hover, .table>tbody>tr.active:hover{
        background: #f9f9f9;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .uppercase{
        text-transform: uppercase;
    }
</style>
@include('includes.new_header',[])

<div class="wrapper_main" id="faqAccordion" style="min-height:294px;margin-top: 15px;">
    @for ($j = 1; $j <= 6; $j++)
    <?php
    if ($j == 1) {
        $process_value = 'PROCESS';
        $in = "in";
    } else {
        $process_value = 'EDIT';
         $in = "";
    }
    ?>
    <div class="row panel panel-default" style="width:1000px;margin:auto;">
        <div class="col-md-12 panel-heading accordion-toggle collapsed question-toggle" style="background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);box-shadow: 3px 3px 12px 0px #999;" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question{{$j}}">
            <p href="#" style="margin-bottom:0px;" class="new_fpl_heading">FIXED WING DOMESTIC FLIGHT # {{$j}}</p>
        </div>
        <div id="question{{$j}}" class="col-md-12 panel-collapse collapse {{$in}}" style="background:#fff;box-shadow: 3px 3px 12px 0px #999;">
            <div class="col-md-12" style="padding-top:15px;">
                <div class="col-sm-6 col-md-3" style="width:14%;padding-right: 5px;">
                    <div class="form-group">
                        <input required type="text" data-toggle ="popover" data-placement="bottom"   minlength="5" maxlength="7" autocomplete="off" data-url="{{url('/fpl/get_callsign_details')}}" {{(isset($aircraft_callsign)) ?  "readonly='readonly'": ""}} value="{{ (isset($aircraft_callsign)) ?  $aircraft_callsign: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip departure_aerodrome_autocomplete get_plan_status"  placeholder="Call Sign" id="aircraft_callsign" name="aircraft_callsign" tabindex="1">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3" style="width:13%;padding-left:0px;padding-right: 5px;">
                    <!--  <label class="novalue" for="novalue">&nbsp;</label> -->
                    <div class="form-group">
                        <dl id="hour" class="dropdown form-control validation_class_click"   data-toggle = "popover"  data-placement="top">
                            <dt><a>
                                    <span id="No_of_flights" readonly>No. of Flights</span>
                                </a>
                            </dt>
                            <dd>
                                <ul>
                                    @for ($i = 1; $i <= 6; $i++)
                                    <li class="departure_time_hours" data-url="{{url('/fpl/get_callsign_details2')}}"><a>{{$i}}</a></li>
                                    @endfor
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3" style="width:13%;padding-left: 0px;padding-right:5px;">
                    <div class="form-search-row-left deskview">
                        <div class="form-group">
                            <div class="input-group" style="width:100%">
                                <input type="text" autocomplete="off" data-url="{{url('/fpl/get_callsign_details2')}}" value="{{ date('d-M-Y') }}"  class="form-control text-center font-bold datepicker pointer"placeholder="Date of Flight" name="date_of_flight" id="date_of_flight" minlength="6" maxlength="6" tabindex="5" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3" style="width:19%;padding-left:0px;padding-right: 5px;">
                    <div class="form-row">
                        <div class="form-search-row-left">
                            <span class="plan_check_label font-bold" style="color: #333" id="get_plan_status"></span> 
                            <div class="form-group">
                                <input required="required" type="text" data-toggle = "popover"  data-placement="bottom"   minlength="4" maxlength="4"  name="departure_aerodrome" autocomplete="off" id="departure_aerodrome" {{ (isset($departure_aerodrome)) ?  "readonly='readonly'": "" }} value="{{ (isset($departure_aerodrome)) ?  $departure_aerodrome: "" }}" class="alphabets redirect text-center font-bold text_uppercase validation_class form-control get_plan_status"  placeholder="From" data-redirect-url="{{url('fpl?page=new_full_fpl')}}" data-url="{{url('fpl/check_callsign_exist')}}" tabindex="2">
                            </div>
                        </div>
                        <div class="form-search-row-right">
                            <div class="form-group">
                                <input required="required"  type="text" data-toggle = "popover"  data-placement="bottom"   minlength="4" maxlength="4" class="alphabets text-center font-bold text_uppercase validation_class form-control get_plan_status" autocomplete="off"  {{ (isset($destination_aerodrome)) ?  "readonly='readonly'": "" }} placeholder="To" value="{{ (isset($destination_aerodrome)) ?  $destination_aerodrome: "" }}" name="destination_aerodrome" id="destination_aerodrome" tabindex="3" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3" style="width:24%;padding-left:0px;padding-right:0px;">
                    <!-- <label class="novalue" for="novalue">&nbsp;</label> -->
                    <div class="form-row">
                        <div class="form-search-row-left">
                            <span class="plan_check_label font-bold" style="color: #333" id="get_plan_status"></span> 
                            <div class="form-group">
                                <input required="required" type="text" data-toggle = "popover"  data-placement="bottom"   minlength="4" maxlength="4"  name="departure_aerodrome" autocomplete="off" id="departure_aerodrome" {{ (isset($departure_aerodrome)) ?  "readonly='readonly'": "" }} value="{{ (isset($departure_aerodrome)) ?  $departure_aerodrome: "" }}" class="alphabets redirect text-center font-bold text_uppercase validation_class form-control get_plan_status"  placeholder="DEP. TIME (IST)" data-redirect-url="{{url('fpl?page=new_full_fpl')}}" data-url="{{url('fpl/check_callsign_exist')}}" tabindex="2">
                            </div>
                        </div>
                        <div class="form-search-row-right">
                            <div class="form-group">
                                <input required="required"  type="text" data-toggle = "popover"  data-placement="bottom"   minlength="4" maxlength="4" class="alphabets text-center font-bold text_uppercase validation_class form-control get_plan_status" autocomplete="off"  {{ (isset($destination_aerodrome)) ?  "readonly='readonly'": "" }} placeholder="FLYING TIME" value="{{ (isset($destination_aerodrome)) ?  $destination_aerodrome: "" }}" name="destination_aerodrome" id="destination_aerodrome" tabindex="3" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 md-m-t-7 xs-m-t-25" style="width:4%;padding-left:0px;">
                    <!-- <label class="novalue" for="novalue">&nbsp;</label> -->
                    <div class="form-row">
                        <div class="form-search-row-right processbtn deskprocess">
                            <div class="form-group">
                                <div class="newbtnv1 b-radius-5">
                                    <input type="submit" class="btn btn_appearance" name="flag" data-name="Process" value="{{$process_value}}" id="process"  data-url="{{url('/fpl/process_quick_plan')}}" tabindex="14" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button"  style="    margin-left: 74px;margin-top: 2px;" class="btn btn-warning btn-circle newbtnv1 "><i style="font-size: 16px;line-height: 1.15;" class="glyphicon glyphicon-remove"></i></button>
                <div class="col-md-12" style="padding:0;">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <input required="required" type="text" data-toggle = "popover"   data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command" value="{{ (isset($pilot_in_command)) ?  $pilot_in_command: "" }}" placeholder="Pilot Name" name="pilot_in_command"  id="pilot_in_command" tabindex="6">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command"  value="{{ (isset($copilot)) ?  $copilot: "" }}" placeholder="Co Pilot Name" name="copilot"  id="copilot" tabindex="8">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="10" maxlength="25" autocomplete="off" class="text_uppercase validation_class text-center font-bold form-control" value="{{ (isset($mobile_number)) ?  $mobile_number: "" }}" placeholder="Cabin Crew 1" name="mobile_number"  id="mobile_number" tabindex="7">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <input type="text"  data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class form-control pilot_in_command" {{ (isset($cabincrew)) ?  "readonly='readonly'": "" }} value="{{ (isset($cabincrew)) ?  $cabincrew: "" }}" placeholder="Cabin Crew 2" name="cabincrew"  id="cabincrew" tabindex="9">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group" style="margin-bottom:0px;">
                            <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url="{{url('fpl/station_latlong')}}"  value="{{ (isset($departure_station)) ?  $departure_station: "" }}" class="operator text-center font-bold text_uppercase validation_class form-control" id="departure_station" name="departure_station" placeholder="Dep. ZZZZ Place Name" tabindex="10">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group" style="margin-bottom:0px;">
                            <input type="text" data-toggle = "popover"  data-placement="top" minlength="11" maxlength="15" readonly autocomplete="off" data-url="{{url('fpl/station_latlong')}}"  value="{{ (isset($departure_latlong)) ?  $departure_latlong: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="departure_latlong" name="departure_latlong" placeholder="Dep. ZZZZ Lat-Long" tabindex="11">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group" style="margin-bottom:0px;">
                            <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url='{{url("fpl/station_latlong")}}'  value="{{ (isset($destination_station)) ?  $destination_station: "" }}" class="operator text-center font-bold text_uppercase validation_class form-control get_plan_status" id="destination_station" name="destination_station" placeholder="Dest. ZZZZ Place Name" tabindex="12">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group" style="margin-bottom:0px;">
                            <input type="text" data-toggle = "popover"  data-placement="top" minlength="9" maxlength="15" readonly autocomplete="off" data-url='{{url("fpl/station_latlong")}}' value="{{ (isset($destination_latlong)) ?  $destination_latlong: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="destination_latlong" name="destination_latlong" placeholder="Dest. ZZZZ Lat-Long" tabindex="13">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top:25px;">
                        <div style="position: absolute;left:422px;margin-top:2px;">
                            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="DAY FLIGHT">
                                <img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/sun1.png')}}"/></a>
                        </div>
                        <div style="position: absolute;left:506px;margin-top:2px;">
                            <a data-toggle="tooltip" data-placement="top" title="" data-original-title="NIGHT FLIGHT"><img href="#" style="width:40px;margin-top:3px;" src="{{url('media/images/fdtl/moon1.png')}}"/>
                            </a>
                        </div>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="DAY FLIGHT" class="red-tooltip" style="position: absolute;left:440px;top:-16px;color:#f6913d;font-weight: bold;font-size:15px;">0</a>
                        <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="NIGHT FLIGHT" class="red-tooltip" style="position: absolute;left:522px;top:-16px;color:#a0a0a0;font-weight: bold;font-size:15px;;">0</a>				
                    </div>
                    <div class="col-md-12" style="display:none;">
                        <img style="width:30px;margin-top:5px;float:left;margin-left:32%;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>
                        <h2 style="font-size:16px;color:#000;margin-left:5px;float:left;margin-top:0px;">FIXED WING <span style="margin-left:5px;">DOMESTIC FLIGHT # 1</span></h2>
                    </div>
                    <div class="col-md-12" style="margin-top:40px;">
                        <img style="width:30px;position: absolute;left: 470px;top: -31px;" src="{{url('media/images/fdtl/thumbs-up.png')}}"/>               
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="border-color:#f1292b;">
                            <tbody>
                                <tr>
                                    <td class="align_center">SPLIT DUTY</td>
                                    <td class="align_center"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="SPLIT DUTY">NA</a></td>
                                    <td class="align_center">WOCL</span></td>
                                    <td class="align_center"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="WOCL">NA</a></td>
                                </tr>
                                <tr>
                                    <td class="align_center">REPORT TIME</td>
                                    <td class="align_center"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="REPORT TIME">NA</a></td>
                                    <td class="align_center">DUTY END TIME</span></td>
                                    <td class="align_center"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="REPORT TIME">NA</a></td>
                                </tr>
                                <tr>
                                    <td class="align_center">FLIGHT TIME</td>
                                    <td class="align_center"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT TIME">NA</a></td>
                                    <td class="align_center">FLIGHT DUTY PERIOD</td>
                                    <td class="align_center"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="FLIGHT DUTY PERIOD">NA</a></td>
                                </tr>
                                <tr>
                                    <td class="align_center" style="background:#e9e9e9;font-weight: bold;">TOTAL FT</td>
                                    <td class="align_center" style="background:#e9e9e9;font-weight: bold;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="TOTAL FT">NA</a></td>
                                    <td class="align_center" style="background:#e9e9e9;font-weight: bold;">TOTAL FDP</td>
                                    <td class="align_center" style="background:#e9e9e9;font-weight: bold;"><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="TOTAL FDP">NA</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--end of .table-responsive-->  
                </div>
            </div>
<<<<<<< HEAD
            <!--end of .table-responsive-->  
         </div>
      </div>
   </div>
  </div>
 
   <!--search account-->
	<div class="row cust_box_shadow" style="width: 1000px;margin: auto;box-shadow: 3px 3px 12px 0px #999;background:#fff;height:450px;">
			<div class="col-md-12 p-lr-0">
				<p style="background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));" class="search_heading" >Search FDTL</p>
			</div>
			<div class="col-md-12 p-lr-0" style="width:100%;float:left">
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
						<div class="col-sm-6 col-md-3 xs-p-lr-5 from_to_adj_width" style="width:30%;">
							<div class="form-row">
								<div class="form-search-row-left from_widthv">
									<div class="form-group">
										<div class="input-group from_dp_pos">
											<input type="text"  autocomplete="off" class="form-control font-bold from_date pointer fpl_from_box" placeholder="FROM" name="from_date" id="from_date" minlength="6" maxlength="6" tabindex="5" readonly style="border-radius:4px;
												   "  value="{{ date('d-M-Y') }}" >
											<span class="fpl_search_from_label">From</span>
										</div>

									</div>
								</div>
								<div class="form-search-row-right to_widthv">
									<div class="form-group">
										<div class="input-group xs-m-r-0">
											<input type="text" autocomplete="off" class="form-control font-bold to_date pointer fpl_to_box" placeholder="TO" name="to_date" id="to_date" minlength="6" maxlength="6" tabindex="5" readonly  value="{{ date('d-M-Y') }}" >
											<span class="fpl_search_to_label">To</span>
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
								<input type="hidden" name="date_of_flight2" id="date_of_flight2" value="{{date('d-M-Y')}}" />
								<input type="hidden" name="default_fpl_date" id="default_fpl_date" value="{{date('ymd')}}" />
								<input type='hidden' name='current_time' id='current_time' value="{{date('Hi')}}" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    <!--search account ends here-->
 
    <!--table search starts here-->
=======
        </div>
    </div>
    @endfor
>>>>>>> 98947e854658588d4bd5526be627697030873078

    <!--search account-->
    <div class="row cust_box_shadow" style="width: 1000px;margin: auto;box-shadow: 3px 3px 12px 0px #999;background:#fff;height:450px;">
        <div class="col-md-12 p-lr-0">
            <p style="background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));" class="search_heading" >Search FDTL</p>
        </div>
        <div class="col-md-12 p-lr-0" style="width:100%;float:left">
            <div class="q_filter">
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
                    <div class="col-sm-6 col-md-3 xs-p-lr-5 from_to_adj_width" style="width:30%;">
                        <div class="form-row">
                            <div class="form-search-row-left from_widthv">
                                <div class="form-group">
                                    <div class="input-group from_dp_pos">
                                        <input type="text"  autocomplete="off" class="form-control font-bold from_date pointer fpl_from_box" placeholder="FROM" name="from_date" id="from_date" minlength="6" maxlength="6" tabindex="5" readonly style="border-radius:4px;
                                               ">
                                        <span class="fpl_search_from_label">From</span>
                                    </div>

                                </div>
                            </div>
                            <div class="form-search-row-right to_widthv">
                                <div class="form-group">
                                    <div class="input-group xs-m-r-0">
                                        <input type="text" autocomplete="off" class="form-control font-bold to_date pointer fpl_to_box" placeholder="TO" name="to_date" id="to_date" minlength="6" maxlength="6" tabindex="5" readonly>
                                        <span class="fpl_search_to_label">To</span>
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
                            <input type="hidden" name="date_of_flight2" id="date_of_flight2" value="{{date('d-M-Y')}}" />
                            <input type="hidden" name="default_fpl_date" id="default_fpl_date" value="{{date('ymd')}}" />
                            <input type='hidden' name='current_time' id='current_time' value="{{date('Hi')}}" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--search account ends here-->

    <!--table search starts here-->

<<<<<<< HEAD
<script>
    $(document).ready(function () {
	$(".date_of_flight").datepicker({showOn: 'both',"dateFormat":"dd-M-yy", buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: 0, showOtherMonths: true, selectOtherMonths: true,
        showAnim: "slide",
        dateFormat: 'dd-M-yy',
        onSelect: function() {
            $(".notify-bg-v").fadeOut();
             $("#departure_aerodrome1").focus();
        }
    });
    $("#to_date,#from_date").datepicker({showOn: 'both',"dateFormat":"dd-M-yy", buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: 0, showOtherMonths: true, selectOtherMonths: true,
        showAnim: "slide",
        //dateFormat: 'dd-M-yy',
        setDate: new Date() ,
        onSelect: function() {
            $(".notify-bg-v").fadeOut();
        }
    });
    $(".alphabets_with_space").on('keypress', function (e) 
     {
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
        return true;
        else
        return false; 
     });
    $(".alphabets").on('keypress', function (e) 
     {
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0))
        return true;
        else
        return false; 
     }); 
	$("#last_close_button").click(function(){
		$("#modelfordelete").show();
		var id =$(this).attr(id);
		alert(id);
	});
	$("#delete_main_row").click(function(){
		alert("I am in");
		
	});
    $("#date_of_flight,.ui-datepicker-trigger").click(function () {
         $(".notify-bg-v").fadeIn();
         $('.notify-bg-v').css('height', $(document).height());
     });

    $(window).scroll(function () {
        if ($(this).scrollTop()) {
            $('#v_toTop').fadeIn();
        } else {
            $('#v_toTop').fadeOut();
        }
    });

$("#dep_time").keyup(function(event)
  {
    var dep_time_length=$(this).val().length;
    if(dep_time_length==2 && event.keyCode!=8)
    {
      var dep_time=$(this).val().substring(0,2)+':';
       $(this).val(dep_time);
       $(this).focus();
    }
     if(dep_time_length==5)
     {
      $("#flytime").focus();
     }
  });
$("#destination_aerodrome1").keyup(function(){
    var destination_aerodrome1=$(this).val().length;
    if(destination_aerodrome1==4)
     { 
      $("#dep_time").focus();
     }
  });
$("#departure_aerodrome1").keyup(function(){
    var departure_aerodrome1=$(this).val().length;
    if(departure_aerodrome1==4)
     { 
      $("#destination_aerodrome1").focus();
     }
  });
=======
    <!--<div class="row" style="width:1000px;margin:auto;">
            <div class="col-md-12">
                    <table class="fpl_info table table-hover table-responsive desk-plan">
                            <thead>
                                    <tr>
                                            <th class="slno">Sl</th>
                                            <th class="dof thdof">Flight Date</th>
                                            <th class="calsign thcalsign">Call Sign</th>
                                            <th class="dpt thdpt">Dep. Time</th>
                                            <th class="ficadc thficadc">FIC-ADC</th>
                                            <th class="from thfrom">From</th>
                                            <th class="to thto">To</th>
                                            <th class="fildate thchange">Change</th>
                                            <th class="pdf thpdf">FPL</th>
                                            <th class="weather thnotam">NOTAM</th>                                
                                            <th class="weather thweather">Wx</th>

                                    </tr>
                            </thead>
                    </table>
            </div>
    </div>-->
>>>>>>> 98947e854658588d4bd5526be627697030873078



    <!--table search ends here-->

</div>

<div id="modelfordelete" class="modal fade in" style="padding-right: 17px; display: none;">
    <div class="modal-dialog modal-deleteLicense" style="border: 1px solid #949494;border-radius: 8px 0px 0px 0px;">
        <header class="popupHeader"> <span class="header_title"><span class="del_lic_heading">Delete</span></span>
            <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span></header>
        <section class="popupBody" style="background: white;">
            <div class="row">
                <form id="delete_license_form">
                    <p style="text-align: center;color: green;font-weight: bold"><span class="delete_license_success" style="display: none;"></span></p>
                    <div class="remove_del">
                        <p style="text-align:center;font-weight:bold;margin-bottom:10px;">Are you sure want to delete this rows?</p>
                        <div class="col-md-offset-5 col-md-3 col-xs-offset-2 col-xs-3">
                            <button class="btn newbtnv1 delete_license_confirm" id="delete_main_row" data-value="731">YES</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div> <!--model-->

@include('includes.new_footer',[])
<script>
    $(document).ready(function () {
        $(".date_of_flight").datepicker({showOn: 'both', "dateFormat": "dd-M-yy", buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: 0, showOtherMonths: true, selectOtherMonths: true,
            showAnim: "slide",
            dateFormat: 'dd-M-yy',
                    onSelect: function () {
                        $(".notify-bg-v").fadeOut();
                    }
        });
        $("#to_date,#from_date").datepicker({showOn: 'both', "dateFormat": "dd-M-yy", buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: 0, showOtherMonths: true, selectOtherMonths: true,
            showAnim: "slide",
            //dateFormat: 'dd-M-yy',
            setDate: new Date(),
            onSelect: function () {
                $(".notify-bg-v").fadeOut();
            }
        });
        $(".alphabets_with_space").on('keypress', function (e)
        {
            if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode == 0) || (e.charCode == 32))
                return true;
            else
                return false;
        });
        $(".alphabets").on('keypress', function (e)
        {
            if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode == 0))
                return true;
            else
                return false;
        });
        $("#last_close_button").click(function () {
            $("#modelfordelete").show();
            var id = $(this).attr(id);
            alert(id);
        });
        $("#delete_main_row").click(function () {
            alert("I am in");

        });
        $("#date_of_flight,.ui-datepicker-trigger").click(function () {
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height', $(document).height());
        });

        $(window).scroll(function () {
            if ($(this).scrollTop()) {
                $('#v_toTop').fadeIn();
            } else {
                $('#v_toTop').fadeOut();
            }
        });
        $("#no_of_flight").change(function () {
            //alert("kavitha")
        });
        $("#dep_time").keyup(function (event)
        {
            var dep_time_length = $(this).val().length;
            if (dep_time_length == 2 && event.keyCode != 8)
            {
                var dep_time = $(this).val().substring(0, 2) + ':';
                $(this).val(dep_time);
                $(this).focus();
            }
            if (departure_aerodrome_length == 5)
            {
                $("#flytime").focus();
            }
        });
        $("#destination_aerodrome1").keyup(function () {
            var destination_aerodrome1 = $(this).val().length;
            if (destination_aerodrome1 == 4)
            {
                $("#dep_time").focus();
            }
        });
        $("#departure_aerodrome1").keyup(function () {
            var departure_aerodrome1 = $(this).val().length;
            if (departure_aerodrome1 == 4)
            {
                $("#destination_aerodrome1").focus();
            }
        });

        $(".numbers").on('keypress', function (e)
        {
            if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96) || (e.charCode >= 123 && e.charCode <= 127))
                return false;
            else
                return true;
        });
        $("#flytime").keyup(function (event)
        {

            var departure_aerodrome_length = $(this).val().length;
            if (departure_aerodrome_length == 2 && event.keyCode != 8)
            {
                var departure_aerodrome = $(this).val().substring(0, 2) + ':';
                $(this).val(departure_aerodrome);
                $(this).focus();
            }
        });

        $("#v_toTop").click(function () {
            //1 second of animation time
            //html works for FFX but not Chrome
            //body works for Chrome but not FFX
            //This strange selector seems to work universally
            $("html, body").animate({scrollTop: 0}, 500);
        });
    });
</script>
@stop