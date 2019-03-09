@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('js')
<script src="{{url('app/js/sweet-alert.js')}}"></script>
<script src="{{url('app/js/jquery.sweet-alert.init.js')}}"></script>
@endpush
@push('css')
<link rel="stylesheet" href="{{url('app/css/sweet-alert.css')}}" />
@endpush
@section('content')
<div class="page" id="quick_app">
    <style>
        h2 {
            font-size: 20px;
            line-height: 25px;
            font-weight: bold;
        }
        #fuelpricelist_previous,#fuelpricelist_next  {
            display: none ;
        }
        *{
            -moz-box-sizing: border-box !important;
        }
        .disable {
            pointer-events: none;

        }
        .desk-plan>thead>tr>th, .desk-plan>tbody>tr>td {
            text-align: center !important;
        }
        .desk-view {
            margin: 0 0;
        }

        #qucik_responce .popover{
            background: transparent;
        }
        .table.dataTable.no-footer{
            border-collapse: separate ;
            border-top: 1px solid #111;
            border-right: 1px solid #111;
            border-bottom: none;
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
        .p-lr-5 {padding-left: 5px;padding-right: 5px;}
        .oc-time-box1, .oc-time-box2, .oc-time-box3, .oc-time-box4   {width: 250px;min-height: 100px;position: absolute;z-index: 9999;background: #eee;border-radius: 5px;left: 103px;bottom: 0px;text-align: center;}
        .ui-widget-content {z-index:999999;}
        .oc-time-box1>div>p, .oc-time-box2>div>p,  .oc-time-box3>div>p, .oc-time-box4>div>p  {font-size: 12px;font-weight: bold;color: #000;}
        .oc-time-box2 {bottom: 70px;left:120px;}
        .oc-time-day {text-align: center;background: #f1292b;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));background: -moz-linear-gradient(top, #f1292b, #f37858);color: #fff;border-radius: 5px 5px 0 0;margin-bottom: 5px;}
        .atc-view .popover {background: #333;border:0;box-shadow: none;}
        .cust_box_shadow {box-shadow: 3px 3px 12px 0px #999;margin-left: 0px;margin-right: 0px;}
        #v_toTop {position: fixed;bottom: 20px;right: 20px;display: none;background: url('media/images/home/totop.png') no-repeat;width: 28px;height: 28px;cursor: pointer;z-index: 999999;}
        #v_toTop:hover {background: url('media/images/home/totop2.png') no-repeat;width: 28px;height: 28px;cursor: pointer;}
        .glassy {position:relative;}
        .stat_icons {position: absolute;top:8px;z-index: 999;    width: 46%;left: 14px;}
        .glassy-img {position:absolute;top:13px;z-index: 999;width: 100%;}
        .ui-tooltip {width: 200px;background-color: #333;border: #eeeeee solid 2px;font-family: 'pt_sansregular';margin-top: 0px;text-align: center;color: white;padding-top: 5px;padding-bottom: 5px;}
        .glassy-img1 {float: left;margin-bottom: 2px;}
        .desk-view {border:none;}
        .desk-view .popover {background: #333;border:0;}
        .fic-adc ::-webkit-input-placeholder {font-weight: bold;}
        .fic-adc :-moz-placeholder { /* Firefox 18- */
            font-weight: bold
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
        .tooltip_cancel, .tooltip_revise_dbl, .tooltip_revise_valid {position: relative;}
        .tooltip_cancel_position, .tooltip_fpl_position1,.tooltip_fpl_position2, .tooltip_fpl_position, .tooltip_info_position, .tooltip_revise_position,.tooltip_change_position,.tooltip_revise_dbl_position, .tooltip_dept_position, .tooltip_dest_position, .tooltip_pdf_position, .tooltip_notam_position, .tooltip_wx_position, .tooltip_revise_dbl_position_valid, .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year, .tooltip_wx, .tooltip_tripkit  {
            position: absolute;top: -25px;left: 45px;padding: 3px 11px;color: #eee;border-radius: 4px;visibility: hidden;font-size: 10px;font-weight: normal;
            box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20}
        .tooltip_cancel:hover .tooltip_cancel_position, .tooltip_revise_valid:hover .tooltip_tri_shape_valid, .tooltip_revise_valid:hover .tooltip_revise_dbl_position_valid, .tooltip_cancel:hover .tooltip_fpl_position1, .tooltip_cancel:hover .tooltip_fpl_position2 ,.tooltip_cancel:hover .tooltip_fpl_position, .tooltip_cancel:hover .tooltip_info_position,.tooltip_cancel:hover .tooltip_revise_position,.tooltip_cancel:hover .tooltip_change_position, .tooltip_revise_dbl:hover .tooltip_revise_dbl_position, .tooltip_cancel:hover .tooltip_dept_position, .tooltip_cancel:hover .tooltip_dest_position, .tooltip_cancel:hover .tooltip_pdf_position, .tooltip_cancel:hover .tooltip_notam_position, .tooltip_cancel:hover .tooltip_wx_position, .tooltip_revise_dbl:hover .tooltip_tri_shape, .stats_fixed_wing:hover .tooltip_fixed_wing, .stats_heli:hover .tooltip_heli,.stats_month:hover .tooltip_month, .stats_year:hover .tooltip_year,.stats_wx:hover .tooltip_wx, .stats_tripkit:hover .tooltip_tripkit {
            visibility: visible;
        }
        .tooltip_revise_dbl:hover .tooltip_tri_shape_valid, .tooltip_revise_dbl:hover .tooltip_revise_dbl_position_valid{visibility: hidden;}
        .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year, .tooltip_wx, .tooltip_tripkit {top:-31px;left:22px;font-size: 12px;text-transform: uppercase;}

        .tooltip_fpl_position {left: 41px;width: 81px;}
        .tooltip_fpl_position1 {left:0;}
        .tooltip_info_position  {left: 35px;}
        .tooltip_revise_position {left: 45px;width: 78px;}
        .tooltip_change_position {left:0px;width: 79px;}
        .tooltip_revise_dbl_position_valid {left:0;}
        .tooltip_revise_dbl_position {width:175px;z-index: 9999;left: 15px;top:-25px;}
        .tooltip_pdf_position, .tooltip_notam_position, .tooltip_wx_position {left:-70px;}
        .tooltip_pdf_position {left:-38px;}
        .carousel-inner > .item > a > img, .carousel-inner > .item > img, .img-responsive, .thumbnail a > img, .thumbnail > img{
            max-width: 112%!important; 
        }
        .tooltip_tri_shape1 {right:5px;}
        .tooltip_tri_shape2 {right:5px;}
        .tooltip_tri_shape3 {right:18px;}
        .tooltip_tri_shape4, .tooltip_tri_shape5 {right:65px;}
        .tooltip_tri_shape6 {right:48px;}
        .tooltip_tri_shape12 {right:34px;}
        .tooltip_tri_shape8, .tooltip_tri_shape9, .tooltip_tri_shape10, .tooltip_tri_shape11 {left:5px;}

        .tooltip_cancel:hover .tooltip_tri_shape1, .tooltip_cancel:hover .tooltip_tri_shape2,.tooltip_cancel:hover .tooltip_tri_shape3, .tooltip_cancel:hover .tooltip_tri_shape4, .tooltip_cancel:hover .tooltip_tri_shape5, .tooltip_cancel:hover .tooltip_tri_shape6, .tooltip_cancel:hover .tooltip_tri_shape7, .tooltip_cancel:hover .tooltip_tri_shape8, .tooltip_cancel:hover .tooltip_tri_shape9, .tooltip_cancel:hover .tooltip_tri_shape10, .tooltip_cancel:hover .tooltip_tri_shape11, .tooltip_cancel:hover .tooltip_tri_shape12, .stats_fixed_wing:hover .tooltip_trishape_01, .stats_heli:hover .tooltip_trishape_02,.stats_month:hover .tooltip_trishape_03, .stats_year:hover .tooltip_trishape_04,.stats_wx:hover .tooltip_trishape_05, .stats_tripkit:hover .tooltip_trishape_06  {
            visibility: visible;
        }
        .tooltip_trishape_01, .tooltip_trishape_02, .tooltip_trishape_03, .tooltip_trishape_04, .tooltip_trishape_05, .tooltip_trishape_06 {
            right:29px;
        }
        .new_fpl_heading,.search_heading {margin-bottom: 30px;text-align: center;padding: 7px 0;font-weight: 600;font-size: 15px;color:#fff;
                                          font-family:'pt_sansregular', sans-serif;background: #a6a6a6;
                                          background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                          background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                          background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                          background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                          background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
                                          filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
        }
        .search_heading {margin-bottom:12px;text-transform: uppercase;}
        .dof_label {position: absolute;top:-24px;left:0px;font-size: 13px;color: #222;}
        .plan_check_label{position: absolute;top:-24px;left:17px;font-size: 13px;color: #222;}
        .fpl_search_from_label, .fpl_search_to_label {position: absolute;top:-20px;left:38%;font-size: 13px;color:#222;}
        .form-row .deskview {width: 54%;}
        .form-row .deskprocess {width: 43%;}
        .search-band {padding-top:0px;}
        #process {width: 88px;}
        .form-row .form-search-row-right .ui-datepicker-trigger {height: 21px;top:6px;}
        .one_main_table_td .ui-datepicker-trigger {display:none;}
        .from_dp_pos .ui-datepicker-trigger {right: 9px;height: 23.5px;top: 5px;display:none;}
        .form-row .deskview .ui-datepicker-trigger {right: 10px;height: 21px;top: 6px;}
        #date_of_flight {font-size: 13px; font-weight: normal;color: #222;background: white;text-align:left;padding-left:5px;border-radius:4px;}
       .q_filter {
            width: 100%;
            margin: 0px auto;
        }
        .q_filter .depstatns, .q_filter .destatns {width:21%;}
        .from_to_adj_width {width:26%;margin-right:28px;}
       
        .from_dp_pos {width: 100%;}
        .from_widthv {width:41% !important;}
        #from_date {text-align: center;font-size: 14px;font-weight: normal;color: #222;border-right: 0;border-radius: 4px 0px 0px 4px !important;}
        #to_date {padding-left: 5px;font-size:14px;font-weight: normal;color: #222;text-align: left;width:137%;border-radius: 0px 4px 4px 0px;}
        .to_widthv {width: 58%;}
        .top {margin-bottom: 10px;width: 100%;float: left;}
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            background: #333;color: #fff !important;}
        .dataTables_wrapper .dataTables_paginate .previous {background: #333 !important;color: #fff !important;}
        .dataTables_wrapper .dataTables_paginate .next {background: #333 !important;color: #fff !important;}
        .fic-adc .send {width: 21%;}
        .desk-plan {border-collapse: collapse !important;}
        .desk-plan>thead {background: #F26232;background: linear-gradient(to top, #fa9b5b, #F26232);background: #f1292b;
                          filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
                          background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
                          background: -moz-linear-gradient(top, #f1292b, #f37858);border-top:1px solid #333333;}
        .desk-plan>tbody>tr>td {font-size: 14px;font-weight:bold;}
        .dataTables_wrapper {margin-left:5px;margin-right:5px;}
        .desk-plan tr:nth-child(odd) td{background: #ffffff;}
        .desk-plan tr:nth-child(even) td{background: #eeeeee;}
        .desk-plan tr:hover:nth-child(odd) td,.desk-plan tr:hover:nth-child(even) td {background: #fff;}
        .desk-plan>thead>tr>th, .desk-plan>tbody>tr>td {padding:4px 1px 4px 1px;border:1px solid #333;text-transform: uppercase;}
        .dataTables_wrapper .dataTables_paginate .paginate_button {padding:1px 8px;}
        .dataTables_wrapper .dataTables_paginate .paginate_button {margin-left:10px;}
        .dataTables_wrapper .dataTables_paginate{
            padding-top:1em; 
        }
        /*        New changes to datatables*/
        .table>thead:first-child>tr:first-child>th.thdpt, .table>thead:first-child>tr:first-child>th.thdof, .table>thead:first-child>tr:first-child>th.thpdf, .table>thead:first-child>tr:first-child>th.thnotam,  .table>thead:first-child>tr:first-child>th.thchange  {
            padding-left:0;
            padding-right: 0;
        }
        .table>thead:first-child>tr:first-child>th.thchange{
            width:98px!important;
        }
        .table>thead:first-child>tr:first-child>th.fuelwidth{
            width:144px!important;
        }
        .table>thead:first-child>tr:first-child>th.pobwidth{
            width:117px!important;
        }
        .table>thead:first-child>tr:first-child>th.thdpt{
            width:110px!important;
        }
        .depart-time .time-icon{
            padding: 2px 8px;
        }
        .table>thead:first-child>tr:first-child>th.thficadc{
            width: 354px !important;
        }
        .table>thead:first-child>tr:first-child>th.thfrom{
            width: 75px !important;
        }
        .table>thead:first-child>tr:first-child>th.thto{
            width: 75px !important;
        }
        .weather{
            width: 18%;
        }
        .flmodify img{
            width: 18%;
        }
        .form-row .form-search-row-right{
            width:107%;
            float:none;
        }
        .desk-plan>thead>tr>th {font-size:13px;color: #ffffff;font-weight:bold;}
        .desk-plan>thead>tr>th:nth-child(9), .desk-plan>thead>tr>th:nth-child(10), .desk-plan>thead>tr>th:nth-child(11) {letter-spacing: -0.7px;}
        /*        End of new changes to datatables*/
        /*        Start of Stats Section tooltips*/
        .stats_day_sec, .stats_month_sec, .stats_total_sec {position: relative;}
        .day_stats_tooltip, .month_stats_tooltip, .total_stats_tooltip {text-align: center;display: none;position: absolute;background: #333;border-radius: 5px; color: #fff;font-size: 13px;padding: 3px 5px;}
        .day_stats_tooltip, .month_stats_tooltip, .total_stats_tooltip {top:-35px;left:20px;}
        .day_stats_tooltip, .total_stats_tooltip {width:200px;}
        .month_stats_tooltip {width:225px;}
        .stats_day_sec:hover .day_stats_tooltip, .stats_month_sec:hover .month_stats_tooltip, .stats_total_sec:hover .total_stats_tooltip  {display: block;}
        /*        End of Stats Section tooltips*/
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
            .month_stats_tooltip {
                left:5px;
            }
            .total_stats_tooltip {
                left:-100%;
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
            .tooltip_wx_count {
                top: -29px;
                right: -11px;
            }
            .stat_icons {width: 100%; top:14px;}
            .stats_fixed_wing, .stats_heli, .stats_month, .stats_year, .stats_wx, .stats_tripkit {width: 14.5%;}
            .tooltip_trishape_01, .tooltip_trishape_02, .tooltip_trishape_03, .tooltip_trishape_04, .tooltip_trishape_05, .tooltip_trishape_06 {right:15px;}
            .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year  {left:5px;}
            .tooltip_wx, .tooltip_tripkit {left: -80px;}

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
            .tooltip_trishape_01, .tooltip_trishape_02, .tooltip_trishape_03, .tooltip_trishape_04, .tooltip_trishape_05, .tooltip_trishape_06 {right:24px;}
            .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year, .tooltip_wx, .tooltip_tripkit {left:15px;}
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
            border-radius: 2px;
            -webkit-border-radius:2px;
            -moz-border-radius:2px;
            -khtml-border-radius:2px;
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
        .table-hover>tbody>tr {
            position: relative;
        }
        .table-hover>tbody>tr:hover .weather, .table>tbody>tr.active:hover .weather, .table-hover>tbody>tr:hover .notams, .table>tbody>tr.active:hover .notams, .table-hover>tbody>tr:hover .fildate, .table>tbody>tr.active:hover .fildate {visibility: visible !important;}
        .fuelbtn {
            padding: 6px;
            text-align: center;
            background: url(../media/images/fuelbtn.png) no-repeat center center;
            padding: 6px;
            border: none;
            font-weight: normal;
            text-indent: -9999px;
            box-shadow: none;
            width:34px;
        }
        .fic-adc .fuelsend {width: 28%;float: left}
        .desk-plan .form-control{height: 32px;border: none!important;}
        .pob{
            width:45px!important;
        }
        .no_of_flight{
            color: #333;
            font-weight: bold;
            position: absolute;
            margin-left: 99px;
            top: 352px;
            font-size: 15px;
        }
        .total_flying_hours{
            color: #333;
            font-weight: bold;
            position: absolute;
            margin-left: 99px;
            top: 375px;
            font-size: 15px;
        }
        .fuel_burn{
            color: #333;
            font-weight: bold;
            position: absolute;
            margin-left: 333px;
            top: 353px;
            font-size: 15px;
            z-index: 999
        }
        .cost_rupee{
            color: #333;
            font-weight: bold;
            position: absolute;
            margin-left: 333px;
            top: 374px;
            font-size: 15px;
        }
        .popover {
            width: 220px;
            background-color: #333;
            font-size: 12px;
            border: #eeeeee solid 2px;
            font-family: 'pt_sansregular';   
            margin-top: 0px;
            text-align: left;
            color: white
        }
        .city_price{
            width:118px;
        }
        .slno_price{
            width:30px;
        }
        .one_price_pagination{
            padding: 4px 8px;
            background: #f1292b;
            font-size: 12px;
            color: #f1f1f1 !important;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            margin-right:14px;
        }
        .two_price_pagination{
            margin-right:14px;
        }
        .three_price_pagination{
            margin-right:14px;
        }
        .style_plus_price{
            box-shadow:none!important;
            background:none!important;
            color:#f1292b!important;
        }
        .style_plus_wrapper{
            padding-left: 0px;
            margin-top: 6px; 
        }
        .tooltip_rel {position: relative;}
        .tooltip_rel .fa {cursor:pointer; font-size:18px;}
        .tooltip_cust {
            position: absolute;
            top: -28px;
            left:-15px;
            padding: 1px 11px;
            color: #fff;
            border-radius: 4px;
            visibility: hidden;
            font-size: 11px;
            text-transform: capitalize;
            font-weight: normal;
            box-shadow: 0 0 1px 1px #ccc;
            background: #333333;
            z-index: 999999;
            white-space: nowrap;
            text-align: center;
        }
        .tooltip_tri_shape1, .tooltip_tri_shape2, .tooltip_tri_shape3 {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #333;
            position: absolute;
            top: -6px;
            right:8px;
            z-index: 99999;
            visibility: hidden;
        }
        .tooltip_rel:hover .tooltip_cust{visibility: visible;}
        .tooltip_rel {
            position: relative;
            display: inline;
        }
        .tooltip_edit_position {
            position: absolute;top: -28px;left:-50px;padding: 3px 11px;color: #fff;border-radius: 4px;visibility: hidden;font-size: 11px;font-weight: normal;
            box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20; text-transform: uppercase;
        }
        .tooltip_rel:hover .tooltip_edit_position, .tooltip_rel:hover .tooltip_tri_shape1, .tooltip_rel:hover .tooltip_tri_shape2, .tooltip_rel:hover .tooltip_tri_shape3{visibility: visible;}
        .pencil_fuel_price:hover{
            color: red;
        }
        .edit_license, .viewhistory{
            visibility: hidden;
            margin-right:5px;
        }
        .table-hover>tbody>tr:hover .edit_license {
            visibility:visible;
        }
        .Add_row_fuel, .viewhistory{
            visibility: hidden;
        }
        .table-hover>tbody>tr:hover .Add_row_fuel {
            visibility:visible;
        }
        .table-hover>tbody>tr:hover .viewhistory {
            visibility:visible;
        }
        .modal-footer{
            text-align: center; 
        }
        .modal-title{
            text-align:center;
            font-size:16px;
            color: #fff;
        }
        .modal-title_addprice{
            text-align:center;
            font-size:14px;
            color: #fff;
        }
        .modal-header {
            padding: 6px 5px 6px 5px;
            border-bottom: none;
            background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
            font-weight: bold;
        }
        .close_style_addairport{
            position: absolute;
            right: -5px;
            top: -10px;
            cursor: pointer;
            color: #ffffff;
            font-size: 26px;
            border-radius: 50%;
            background: #f1292b; 
        }
        .popover.top {
            margin-top: -10px;
            width: 187px;
            border: none;
            text-align: center;
        }
        .popover-content {
            padding:4px 0px;
        }
        .popover.top>.arrow:after{
            border-top-color: #000; 
        }
       
.fpl_sec {
    margin: 10px 0px 0px 0px;
    background: #ffffff;
    padding: 0 0 10px;
    box-shadow: 0 3px 3px 1px #999999;
}
.tablewrapper{
    box-shadow: 0 3px 3px 1px #999999;
   /* padding-top: 30px;*/
    padding-bottom:15px;
}
.slno_handler{
    width:4%;
}
.flightdate_handler{
   width:11%; 
}
.operator_handler{
    width:21%;  
}
.callsign_handler{
   width:10%;  
}
.from_handler{
  width:7%;   
}
.to_handler{
  width:7%;   
}
.deptime_handler{
   width:9%;   
}
.arrtime_handler{
   width:9%;   
}
.handling_handler{
   width:22%;  
}
.a:focus, a:hover{
  text-decoration: none;
}
.modal-body {
  position: relative;
  padding: 15px 0px;
}
.newbtnv1{
  line-height: 17px;  
}
.addhandler_model{
  width:800px;   
}
.pright5{
padding-right:5px;
}
.pleft5{
padding-left:5px;    
}
.handler_data{
    padding-left:5px;
    padding-right:5px;
    width:21%;
}
.operator_data{
    width:22%;
    padding-right:5px;
}
.callsign_data{
   padding-left:5px;
   padding-right:5px;
   width:11%; 
}
.orderedairport_data{
   padding-left:5px;
   width:19%;
   padding-right: 10px;
}
.dof .flightdate1 {
    width: 50%;
    padding-left: 10px;
    line-height: 30px;
}
.dof .delete {
    float: right;
    width:50%;
    cursor: pointer;
}
.search_heading{
  margin-bottom: 25px;  
}
.pleft0{
padding-left:0;
}
.pright0{
padding-right:0;
}
.border_radius{
border-right: 0;
border-radius: 4px 0px 0px 4px;    
}
.borderradius_left{
border-radius: 0px 0px 0px 0px;   
}
.dynamiclabel label{
position: absolute;
font-size: 10px;
color: #f1292b;
font-weight: bold;
top: -2px;
left: 23px;
}
/*focus out on ui-menu*/
.ui-menu .ui-menu-item:hover{
    background:-webkit-gradient(linear, left top, left bottom, from(#f37858 ), to(#f1292b ))!important;
    color:#fff;
}
.ui-menu .ui-menu-item{
    background:#fff;
    color:#000;
    border-bottom:0;
    border-top:0;
}
/*focus out on ui-menu*/
.from_control1{
width: 100%;
height: 34px;
text-align: center;
font-size: 14px;
border: 1px solid #999;
border-radius: 4px 0px 0px 4px;
background:#fff;
border-right: 0;
}
.form-control1:focus{
border: 1px solid #f1292b;  
}
.eye_image{
display:inline-block;
vertical-align: bottom;
cursor: pointer;
margin-left:2px;
}
.address_enter:focus{
    border:1px solid #f1292b;
}
textarea {
   resize: none;
}
/*#handler_info_previous, #handler_info_next,#historylist_previous,#historylist_next {
    display: none;
}*/
.fpl_cancel{
    color: red !important;
}
.flightdate1 {
    float: left;
    width: 75%;
    font-size: 13px;
    text-align: left;
    display: inline-block;
    font-weight: bold;
    white-space: nowrap;
}
.datepicker_class{
   padding-left: 0px;  
}
#to_date::-webkit-input-placeholder {  
 text-align:left;
 padding-left:30px; 
}
.ui-datepicker-close {
    margin-left: 76% !important;
    margin-bottom: 1%;
}
.ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary {
    margin-left: 1%;
}
.overlay {
    background: #e9e9e9;
    display: none;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    opacity: 0.5;
    z-index: 1000;
}
.img_loader{
   position: fixed;left: 50%;top:50%; 
}
.handler_ordered{
    color: green
}
.growl.growl-medium {
    text-align:center;
 }
.popupHeader {
            font-size: 14px;
 }
 .alertmessage_validation {
     text-align: center;
     font-size: 18px;
 }
 .test[style] {
    padding-right:0;
}
.test.modal-open {
    overflow: auto;
}
.airport_autocomplete{
    font-size: 12px;
}
/*.btn-primary {
    color: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858)) !important;
    background-color: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858)) !important;
    border-color: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858)) !important;
}*/
</style>
    @include('includes.new_header',[])
    <div class="overlay">
        <img class="img_loader" src="{{url('media/images/loader.gif')}}"/>
    </div> 
    <script type="text/javascript" src="{{url('app/js/BuroRaDer.DateRangePicker.js')}}"></script>
    <main>
        <div class="container" style="margin-bottom: 10px;">
            <div class="fpl_sec">
                <div class="row">
                        <div class="col-md-12">
                            <p class="search_heading">HANDLING DATA</p>
                        </div>
                        <form method="post" action="{{url('handlingorder')}}">
                        {{ csrf_field() }}
                        <div class="col-md-12 q_filter">
                                <div class="col-sm-3 operator_data">
                                    <div class="form-group">
                                        <input type="text" class="form-control text_uppercase alphabets_numbers_with_space font-bold" id="s_operator" name="s_operator" style="text-align:center;" placeholder="operator" maxlength="3" @if(isset($s_operator))value="{{$s_operator}}" @endif autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-3 handler_data">
                                    <div class="form-group">
                                        <input type="text" class="form-control text_uppercase font-bold alphabets_with_space" id="handler" name="handler" style="text-align:center;" placeholder="handler" maxlength="3" @if(isset($handler))value="{{$handler}}" @endif autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-2 callsign_data">
                                    <div class="form-group">
                                        <input type="text" class="form-control text_uppercase special_symbols font-bold" id="s_callsign" name="s_callsign" maxlength="3" style="text-align:center;" placeholder="callsign" @if(isset($s_callsign))value="{{$s_callsign}}" @endif autocomplete="off"> 
                                    </div>
                                </div>
                                <div class="col-sm-3 orderedairport_data">
                                    <div class="form-group">
                                        <input type="text" class="form-control text_uppercase alphabets font-bold" id="s_ordered" name="s_ordered" style="text-align:center;" placeholder="ordered airport" maxlength="3" @if(isset($s_ordered))value="{{$s_ordered}}" @endif autocomplete="off">
                                    </div>
                                </div>
                                
                                <div class="col-sm-6 col-md-3 datepicker_class">
                                    <div class="form-row">
                                        <div class="form-search-row-left from_widthv">
                                            <div class="form-group">
                                                <div class="input-group from_dp_pos">
                                                    <input type="text"  autocomplete="off" class="form-control font-bold from_date1 pointer fpl_from_box" placeholder="FROM" name="from_date"  id="from_date" minlength="6" maxlength="6" tabindex="5" readonly data-date-range-end="#to_date" @if(isset($from_date))value="{{$from_date}}" @endif autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-search-row-right to_widthv">
                                            <div class="form-group">
                                                <div class="input-group xs-m-r-0">
                                                    <input type="text" autocomplete="off" class="form-control font-bold to_date1 pointer fpl_to_box" placeholder="TO" name="to_date" id="to_date" minlength="6" maxlength="6" tabindex="5" readonly data-date-range-start="#from_date" @if(isset($to_date))value="{{$to_date}}" @endif autocomplete="off">
                                                    <div class="input-group-addon search-addon">
                                                        <button id="second" type="submit" name="flag" value="search" class="btn newbtnv1"><span class="glyphicon glyphicon-search"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>       
                                </div>
                        </div>     
                     </form>
                </div> <!--row close here-->                
        </div>
        <div class="col-md-12 tablewrapper">
        <table class="fuel_info table table-hover table-responsive desk-plan" id="handler_info">
                <thead>
                    <tr>
                        <th class="slno_handler two_main_th">NO</th>
                        <th class="flightdate_handler two_main_th">FLIGHT DATE</th>
                        <th class="operator_handler two_main_th">OPERATOR</th>
                        <th class="callsign_handler two_main_th">CALLSIGN</th>
                        <th class="from_handler two_main_th">FROM</th>
                        <th class="to_handler two_main_th">TO</th>
                        <th class="deptime_handler two_main_th">DEP. TIME</th>
                        <th class="arrtime_handler two_main_th">ARR. TIME</th>
                        <th class="handling_handler two_main_th">HANDLER</th>
                    </tr>
                </thead>
                <tbody class="main_table">
                  @foreach($handling_data as $data)
                   <tr  @if($data['plan_status']=='2') class="fpl_cancel" @elseif($data['handling_ordered']=='1') class="handler_ordered") @endif>
                        <td>{{$data['sr']}}</td>
                        <td>
                            <div class="dof">
                               <span class="flightdate1">{{$data['display_date_of_flight']}}</span>
                               <div class="tooltip_cancel">
                                 <span class="delete">
                                 <img src="{{url('media/ananth/images/icon_ramp.png')}}"  class="order" modal-type="cancel" alt="" data-handlerid="{{$data['handler_id']}}" data-handlingordered="{{$data['handling_ordered']}}" data-basicrate="{{$data['basic_rate']}}" data-royalty="{{$data['royalty']}}" data-total="{{$data['total']}}" data-city="{{$data['city']}}" data-aero="{{$data['aero']}}" data-tax="{{$data['tax']}}" data-currentdate="{{$data['current_date']}}" data-flightdate="{{$data['date_of_flight']}}" data-planstatus="{{$data['plan_status']}}" data-fplid="{{$data['fpl_id']}}" id="order_image_{{$data['fpl_id']}}"/>
                                 </span>
                                 <span class="tooltip_cancel_position">ORDER HANDLER</span>
                                 <div class="tooltip_tri_shape1" style="right:19px;"></div>
                               </div>
                            </div>
                        </td>
                        <td>{{$data['operator']}}</td>
                        <td>{{$data['aircraft_callsign']}}</td>
                        <td>@if($data['departure_aerodrome']=='ZZZZ') {{$data['departure_station']}} @else {{$data['departure_aerodrome']}} @endif</td>
                        <td>@if($data['destination_aerodrome']=='ZZZZ') {{$data['destination_station']}} @else {{$data['destination_aerodrome']}} @endif</td>
                        <td>{{$data['departure_time_hours']."".$data['departure_time_minutes']}}</td>
                        <td>{{$data['arrival_time']}}</td>
                        <td>
                        <span style="cursor:text;">{{$data['handlername']}}</span>
                        <span class="tooltip_cancel">
                            <img src="{{url('media/ananth/images/preview.png')}}" style="" class="img-responsive eye_image handler_info" data-handlerid="{{$data['handler_id']}}" data-handler="{{$data['handlername']}}"/>
                            <span class="tooltip_cancel_position" style="left:-35px;">ORDER HANDLER</span>
                            <div class="tooltip_tri_shape1" style="right:6px;"></div>
                        </span> 
                        </td>
                    </tr>                 
                  @endforeach      
                </tbody>
        </table>
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="orderhandler" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog addhandler_model">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal_close close_style_addairport" ><i class="fa fa-times-circle" id="handler_info_close"></i></span>
                <h4 class="modal-title">HANDLER INFO</h4>
            </div>  
               <form action="{{url('handler_info')}}" id="handler_info_form">
                <div class="modal-body">
                  <div class="col-md-6" style="padding-right:0;">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets_with_space form-control modtooltip ui-autocomplete-input" placeholder="HANDLER NAME"  id="handler_names" name="handler_names" autocomplete="off" data-placement="top" style=";text-transform: uppercase;" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12" style="margin-bottom:15px;">
                      <textarea id="address" name="address" disabled class="form-control edit_info text_uppercase font-bold" style="width:100%;height: 99px;" rows="4" cols="50" placeholder="ADDRESS AND GST NUMBER" autocomplete="off" data-placement="top" maxlength="50"></textarea>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets form-control modtooltip ui-autocomplete-input" placeholder="LIST OF AIRPORTS" name="airportlist" id="airportlist"autocomplete="off" data-placement="top" disabled>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets form-control modtooltip ui-autocomplete-input" placeholder="CALL SIGN"  name="callsignlist" id="callsignlist" autocomplete="off" data-placement="top" disabled>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-6" style="padding-left:0px;">
                    <div class="col-sm-6 pright5">
                        <div class="form-group" style="margin-bottom:4px;">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets_with_space  form-control modtooltip ui-autocomplete-input edit_info contact_name" placeholder="CONTACT NAME" id="contact_name1" name="contact_name1" autocomplete="off" data-placement="top" disabled maxlength="25">
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group" style="margin-bottom:4px;">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets_with_space  form-control modtooltip ui-autocomplete-input edit_info designation" placeholder="DESIGNATION"  id="designation1" name="designation1" autocomplete="off" data-placement="top" disabled maxlength="25">
                        </div>
                    </div>
                    <div class="col-sm-6 pright5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase numbers form-control modtooltip ui-autocomplete-input edit_info mobile" placeholder="MOBILE NUMBER"  id="mobile1" name="mobile1" autocomplete="off" data-placement="top" disabled maxlength="10">
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase form-control modtooltip ui-autocomplete-input edit_info email_info" placeholder="EMAIL"  id="email1" name="email1" autocomplete="off" data-placement="top" disabled maxlength="50"> 
                        </div>
                    </div>
                    <div class="col-sm-6 pright5">
                        <div class="form-group" style="margin-bottom:4px;">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase  alphabets_with_space  form-control modtooltip ui-autocomplete-input edit_info contact_name" placeholder="CONTACT NAME"  id="contact_name2" name="contact_name2" autocomplete="off" data-placement="top" disabled maxlength="25">
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group" style="margin-bottom:4px;">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets_with_space form-control modtooltip ui-autocomplete-input edit_info designation" placeholder="DESIGNATION"  id="designation2" name="designation2" autocomplete="off" data-placement="top" disabled maxlength="25">
                        </div>
                    </div>
                    <div class="col-sm-6 pright5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase numbers form-control modtooltip ui-autocomplete-input edit_info mobile" placeholder="MOBILE NUMBER"  id="mobile2" name="mobile2" autocomplete="off" data-placement="top" disabled maxlength="10" data-toggle="popover">
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase form-control modtooltip ui-autocomplete-input edit_info email_info" placeholder="EMAIL"  id="email2" name="email2" autocomplete="off" data-placement="top" disabled maxlength="50">
                        </div>
                    </div>
                    <div class="col-sm-6 pright5">
                        <div class="form-group" style="margin-bottom:4px;">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets_with_space form-control modtooltip ui-autocomplete-input edit_info contact_name" placeholder="CONTACT NAME"  id="contact_name3" name="contact_name3" autocomplete="off" data-placement="top" disabled maxlength="25">
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group" style="margin-bottom:4px;">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets_with_space form-control modtooltip ui-autocomplete-input edit_info designation" placeholder="DESIGNATION"  id="designation3" name="designation3" autocomplete="off" data-placement="top" disabled maxlength="25">
                        </div>
                    </div>
                    <div class="col-sm-6 pright5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase numbers form-control modtooltip ui-autocomplete-input edit_info mobile" placeholder="MOBILE NUMBER"  id="mobile3" name="mobile3" autocomplete="off" data-placement="top" disabled maxlength="10">
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase form-control modtooltip ui-autocomplete-input edit_info email_info" placeholder="EMAIL"  id="email3" name="email3" autocomplete="off" data-placement="top" disabled maxlength="50">
                        </div>
                    </div>
                 </div>
                </div>
                <div class="modal-footer" style="padding:0px 0px 10px 0px;">
                    
                      <div class="col-sm-12" id="edit_div">
                            <button type="submit" class="btn  newbtnv1" style="width:60px;" id="handler_info_btn">EDIT</button>
                      </div>
                     <div id="close_div" style="display: none">
                       <div class="col-sm-4" style="text-align: right;padding-right: 0;">
                          <button type="button" class="btn  newbtn_black" style="width:60px;" id="close_div_yes">YES</button>
                       </div>
                       <div class="col-sm-4">
                           <p style="font-weight: bold;color: #f1292b;">ARE YOU SURE TO EXIT WITHOUT SAVING?</p>
                      </div>
                      <div class="col-sm-4" style="text-align: left;padding-left: 0;">
                       <button type="button" class="btn  newbtnv1" style="width:60px;" id="close_div_no">NO</button>
                     </div>
                   </div>
                </div>
              </form>  
        </div>
    </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="handler_order_modal" role="dialog">
    <div class="modal-dialog addhandler_model">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                <h4 class="modal-title"><span id="aero_code_title"></span><span style="margin-left:5px;">HANDLING ORDER</span></h4>
            </div>
              <form id="handler_order" action="{{url('handlingorder/post')}}" method="post">

                <input type="hidden" id="fpl_id">
                <input type="hidden" id="handlerid">
                <div class="modal-body">
                    <div class="col-sm-2 pright0">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="border_radius auto_operator text-center font-bold text_uppercase alphabets form-control modtooltip ui-autocomplete-input" placeholder=""  name="basic_rate" autocomplete="off" data-placement="top" id="basic_rate" maxlength="3" readonly>
                            <label style="left:38px;">BASIC</label>
                        </div>
                    </div>
                    <div class="col-sm-2 pleft0 pright0">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="borderradius_left auto_operator text-center font-bold text_uppercase special_symbols form-control modtooltip ui-autocomplete-input" placeholder=""  name="royalty" autocomplete="off" data-placement="top" id="royalty" maxlength="7" disabled>
                            <label>ROYALTY</label>
                        </div>
                    </div>
                    <div class="col-sm-2 pleft0">
                        <div class="form-group dynamiclabel">
                            <input type="text" style="border-left: 0;border-radius: 0px 4px 4px 0px;" class="auto_operator text-center font-bold text_uppercase special_symbols form-control modtooltip ui-autocomplete-input" placeholder=""  name="tax" autocomplete="off" data-placement="top" id="tax" maxlength="7" disabled>
                            <label>TAX</label>
                        </div>
                    </div>
                    <div class="col-sm-2 pleft0 pright0" style="width:12%;">
                        <div class="form-group">
                            <input type="text" style="border-right: 0;border-radius: 4px 0px 0px 4px;" class="auto_operator text-center font-bold text_uppercase special_symbols form-control modtooltip ui-autocomplete-input"  name="handler_aero" autocomplete="off" data-placement="top" id="handler_aero" maxlength="7" readonly>
                        </div>
                    </div>
                    <div class="col-sm-4 pleft0" style="width:38%;">
                        <div class="form-group">
                            <input type="text" style="border-radius: 0px 4px 4px 0px;" class="auto_operator text-center font-bold text_uppercase special_symbols form-control modtooltip ui-autocomplete-input" name="city" autocomplete="off" data-placement="top" id="city1" maxlength="7" readonly>
                        </div>
                    </div>
                    <div class="col-sm-2" style="padding-right:0;width:17%;">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase special_symbols form-control modtooltip ui-autocomplete-input" placeholder="TOTAL"  name="callsign" autocomplete="off" data-placement="top" id="total" maxlength="7" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8" style="padding-right:5px;width:66%;">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase special_symbols1 form-control modtooltip ui-autocomplete-input" placeholder="REMARKS"  id="remarks" name="handler_name" autocomplete="off" data-placement="top" style=";text-transform: uppercase;" maxlength="125">
                        </div>
                    </div>
                    <div class="col-sm-2" style="padding-left:12px;">
                        <button type="submit" class="btn  newbtnv1" id="add_handler_btn">ORDER</button>
                    </div>
                </div>
                </form>
                <div class="col-sm-12" style="padding:0;border-bottom:1px solid #f1292b;">  
                </div>
                <div class="col-sm-12" style="padding-top:10px;">
                    <table class="fuel_info table table-hover table-responsive desk-plan" id="historylist" style="width: 100%">
                            <thead style="background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%)!important;}">
                                <tr>
                                    <th class="slno_handler two_main_th">SL</th>
                                    <!-- <th class="flightdate_handler two_main_th">FUEL</th> -->
                                    <th class="operator_handler two_main_th">DATE AND TIME (IST)</th>
                                    <th class="callsign_handler two_main_th">BY</th>
                                </tr>
                            </thead>
                    </table>
                </div>
                <div class="modal-footer" style="padding:0px 0px 10px 0px;">                 
                </div>
            
        </div>
    </div>
</div>
<!-- Modal -->
<!-- alert validation modal-->
<div class="modal fade" id="handling_alert_validation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container prvplan" role="document">
        <header class="popupHeader">
            <span class="header_title"></span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>
        <section class="popupBody">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="modal_message alertmessage_validation"></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- alert validation modal-->
<div id='v_toTop'><span></span></div>
@include('includes.new_footer',[])
</div>
<script>
$(document).on("focusin","#s_operator,#handler,#s_callsign,#s_ordered",function(e){ 
     if($(this).val().length>=3){
       $(this).select();
     }  
 });
function errorPopover(id, message) {
      $(id).css({"border-color": "red"});
      $(id).attr('data-content', message);   
      $(id).popover( {trigger : 'hover'}); 
  }
  function closePopover(id) {
      $(id).popover('destroy');
      $(id).removeClass('border_red');
      $(id).css({"border-color": "#a6a6a6"});
      $(this).next().css('display','none');
  } 
$( function() {
    $("#from_date").datepicker({  
   dateFormat: 'dd-M-yy',
   showMonthAfterYear: true,
   closeText: 'Clear',
   showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
   onSelect: function(selectedDate) 
   { 
       closePopover("#"+$(this).attr('id'));
      if($("#to_date").val()!="")
      {
       $(".notify-bg-v").fadeOut();
       }
   }
 });
 $("#to_date").datepicker({ 
       showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
 });  
 $(document).ready(function () {
    
    $('#handler_order_modal,#handling_alert_validation,#orderhandler').on('show.bs.modal', function (e) {
     $('body').addClass('test');
    });

    $(document).on("keypress",".alphabets_with_space",function(e){
            if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
            return true;
            else
            return false; 
    });
    $(document).on("keypress",".special_symbols",function(e){
           if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) ||(e.charCode==0))
           return true;
           else
           return false; 
    });
    $(document).on("keypress",".alphabets_numbers_with_space",function(e){
            if ((e.charCode >= 48 && e.charCode <= 57) || (e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
            return true;
            else
            return false; 
    });
    $(document).on("keypress",".numbers",function(e){   
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
          return false;
            else
          return true;    
    });
    $(document).on("keypress",".special_symbols1",function(e){
        if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) || (e.charCode==32) ||(e.charCode==0) ||(e.charCode==47) ||(e.charCode==32))
           return true;
           else
           return false; 
    }); 
    $('#from_date').focusin(function(){  
        if($(this).val()=="")
            $(this).addClass('focusin');
            else
            $(this).removeClass('focusin');  
        });
    $('#from_date').focusout(function(){  
            $(this).removeClass('focusin');  
        });
        $("#from_date").click(function() {  
        $(this).focus();
        });
        $("#to_date").bind("click focus", function() {
        $($(this).data("date-range-start")).click();
        });
    $('[data-toggle="popover"]').popover();
    $("#from_date, #to_date,#date_of_flight,.ui-datepicker-trigger").click(function () {
        $(".notify-bg-v").fadeIn();
        $('.notify-bg-v').css('height', $(document).height());
    }); 
});
    $('#handler_info').DataTable( {
                destroy: true,   
               "pageLength":20,
               "lengthChange": false,
               "aaSorting": [],
               "searching": false,
               "bInfo" : false,
               "dom": '<"top"flp<"clear">>',
               "aoColumns":[
               {"bSortable": false},
               {"bSortable": false},
               {"bSortable": false},
               {"bSortable": false},
               {"bSortable": false},
               {"bSortable": false},
               {"bSortable": false},
               {"bSortable": false},   
               {"bSortable": false},   
                ],
       });
    $(document).on("click",".order",function(e){ 
        var handlerid=$(this).attr('data-handlerid');
        var basic=$(this).attr('data-basicrate');
        $("#basic_rate").val(basic);
        var royalty=$(this).attr('data-royalty');
        $("#royalty").val(royalty);
        var total=$(this).attr('data-total');
         $("#total").val(total);
        var tax=$(this).attr('data-tax');
        $("#tax").val(tax);
        var city=$(this).attr('data-city');
        $("#city1").val(city);
        var aero=$(this).attr('data-aero');
        $("#handler_aero").val(aero);
        $("#aero_code_title").html(aero);
        var fplid=$(this).attr('data-fplid');
        $("#fpl_id").val(fplid);
        var handler_id=$(this).attr('data-handlerid');
        $("#handlerid").val(handler_id);
        var current_date=parseInt($(this).attr('data-currentdate'));
        var flight_date=parseInt($(this).attr('data-flightdate'));
        var planstatus=parseInt($(this).attr('data-planstatus'));
        var handlingordered=parseInt($(this).attr('data-handlingordered'));
        console.log(handlerid);
        if(handlerid!=''){
            orderedviewhistory(fplid);
            $("#handler_order_modal").modal('show');
            if(current_date>flight_date || planstatus==2 ||handlingordered>0){
                $("#add_handler_btn").prop('disabled', true);
            }  
        }
        else 
           swal({confirmButtonClass: "newbtnv1", title:"HANDLER SERVICE NOT AVIALABLE AT THIS AIRPORT. PLEASE CONTACT US FOR MORE INFO."});  

    });
    $("#handler_order").submit(function(event){
        event.preventDefault();
        $("#handler_order_modal").modal('hide');
        $(".overlay").show();
        $.ajax({
               context : this,  
               type: "POST",  
               url: $(this).attr('action'),
               headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
               dataType:"json",
               data:{fplid:$("#fpl_id").val(),remarks:$("#remarks").val(),handler_id:$("#handlerid").val()},
               success: function(result) 
               {
                   setTimeout(function () {
                       $(".overlay").hide();
                       if(result.success==true){
                          $('#remarks').val(''); 
                          $.growl({title: '', location: 'tc', size: 'medium', message: 'ORDER PLACED SUCCESSFULLY!'});

                          $('#order_image_'+$("#fpl_id").val()).attr('data-handlingordered',1)
                          $(".overlay").hide();
                       }
                   },1500);
               }
        });  
    });
    function orderedviewhistory(fplid)
            {

              $('#historylist').DataTable( {
                         destroy: true,   
                        "serverSide": true,
                        // "pageLength":10,
                        "bPaginate": false,
                        "lengthChange": false,
                        "aaSorting": [],
                        "searching": false,
                        "bInfo" : false,
                        "dom": '<"top"flp<"clear">>',
                        "aoColumns":[
                        {"bSortable": false},
                        {"bSortable": false},
                        {"bSortable": false},  
                    ],
                     "ajax":"/vieworderedhistory?fplid="+fplid,
                });
            }
       $(document).on("click",".handler_info",function(e){  
            var handler=$(this).attr('data-handler');
            if(handler=='')
            { 
                swal({confirmButtonClass: "newbtnv1", title:"HANDLER SERVICE NOT AVIALABLE AT THIS AIRPORT. PLEASE CONTACT US FOR MORE INFO."});  
                return false;
            }
            $(".edit_info").val('');
            $("#handler_info_btn").text('EDIT')
            $(".edit_info").prop('disabled', true);
            $.ajax({
                   context : this,    
                   url: '/handler_info',
                   //headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                   dataType:"json",
                   data:{handler:handler},
                   success: function(result) 
                   {
                       if(result.success==true)
                       {
                          var callsignlist='';
                          var airport_list='';
                          $.each(result.data.callsignlist,function(key,callsign){
                             callsignlist+=callsign;
                             if(result.data.callsignlist.length!=key+1)
                              callsignlist+=' , ';
                          });
                          $.each(result.data.airport_list,function(key,airport){
                             airport_list+=airport;
                             if(result.data.airport_list.length!=key+1)
                              airport_list+=' , ';
                          });
                           $("#callsignlist").val(callsignlist);
                           $("#airportlist").val(airport_list);
                           $("#handler_names").val(result.data.handler);
                           $("#contact_name1").val(result.data.handlerinfo.contact_name1);
                           $("#contact_name2").val(result.data.handlerinfo.contact_name2);
                           $("#contact_name3").val(result.data.handlerinfo.contact_name3);
                           $("#designation1").val(result.data.handlerinfo.designation1);
                           $("#designation2").val(result.data.handlerinfo.designation2);
                           $("#designation3").val(result.data.handlerinfo.designation3);
                           $("#email1").val(result.data.handlerinfo.email1);
                           $("#email2").val(result.data.handlerinfo.email2);
                           $("#email3").val(result.data.handlerinfo.email3);
                           $("#mobile1").val(result.data.handlerinfo.mobile1);
                           $("#mobile2").val(result.data.handlerinfo.mobile2);
                           $("#mobile3").val(result.data.handlerinfo.mobile3);
                           $("#address").val(result.data.handlerinfo.address);
                       }
                   }
            });  
            $("#orderhandler").modal('show');

       });    
       $(".contact_name,.designation,#s_operator,#handler").keyup(function(){
          if($(this).val().length>1 ||$(this).val()=='' )
            closePopover("#"+$(this).attr('id'));
       });
       $("#address").keyup(function(){
          if($(this).val().length>1)
            closePopover("#"+$(this).attr('id'));
       });
       $("#s_callsign").keyup(function(){
          if($(this).val().length>=5)
            closePopover("#"+$(this).attr('id'));
       });
        $("#s_ordered").keyup(function(){
          if($(this).val().length==4)
            closePopover("#"+$(this).attr('id'));
       });
       $(".mobile").keyup(function(){
          if($(this).val().length==10 ||$(this).val()=='' )
            closePopover("#"+$(this).attr('id'));
       });
       $(".email_info").blur(function(){
          if($(this).val()=="" || validateEmail($(this).val()))
            closePopover("#"+$(this).attr('id'));
       });
       $("#handler_info_form").submit(function(event){
              event.preventDefault();
              var btn=$("#handler_info_btn").text();
              if(btn=="EDIT"){
                    $("#handler_info_btn").text('SAVE')
                    $(".edit_info").prop('disabled', false);
              }
              else
              {
                 var bool=true;
                 var contact_name1=$("#contact_name1").val();
                 var contact_name2=$("#contact_name2").val();
                 var contact_name3=$("#contact_name3").val();
                 var designation1=$("#designation1").val();
                 var designation2=$("#designation2").val();
                 var designation3=$("#designation3").val();
                 var mobile1=$("#mobile1").val();
                 var mobile2=$("#mobile2").val();
                 var mobile3=$("#mobile3").val();
                 var email1=$("#email1").val();
                 var email2=$("#email2").val();
                 var email3=$("#email3").val();
                 var address=$("#address").val();
                 if(address.length<2){
                    errorPopover("#address",'Min. 2 & Max. 50 Characters, only Alphabets allowed');
                    bool=false;
                  }  

                 if(contact_name1.length<2){
                    errorPopover("#contact_name1",'Min. 2 & Max. 25 Characters, only Alphabets allowed');
                    bool=false;
                  }  
                 if(contact_name2!='' && contact_name2.length<2){
                    errorPopover("#contact_name2",'Min. 2 & Max. 25 Characters, only Alphabets allowed');
                    bool=false;
                  }  
                 if(contact_name3!='' && contact_name3.length<2){
                    errorPopover("#contact_name3",'Min. 2 & Max. 25 Characters, only Alphabets allowed');
                    bool=false;
                 }
                 if(designation1.length<2){
                    errorPopover("#designation1",'Min. 2 & Max. 25 Characters, only Alphabets allowed');
                    bool=false;
                 }
                 if(designation2!='' && designation2.length<2){
                    errorPopover("#designation2",'Min. 2 & Max. 25 Characters, only Alphabets allowed');
                    bool=false;
                 }
                 if(designation3!='' && designation3.length<2){
                    errorPopover("#designation3",'Min. 2 & Max. 25 Characters, only Alphabets allowed');
                    bool=false;
                 }
                 if(mobile1.length<10){
                    errorPopover("#mobile1",'Min. & Max. 10 Digits');
                    bool=false;
                 }  
                 if(mobile2!='' && mobile2.length<10){
                    errorPopover("#mobile2",'Min. & Max. 10 Digits');
                    bool=false;
                 }   
                 if(mobile3!='' && mobile3.length<10){
                    errorPopover("#mobile3",'Min. & Max. 10 Digits');
                    bool=false;
                 }   
                 if (!validateEmail(email1)){
                    errorPopover("#email1",'Invalid Email Address');
                    bool=false;
                 }   
                 if (email2.length>0 && !validateEmail(email2)){
                    errorPopover("#email2",'Invalid Email Address');
                    bool=false;
                 }   
                 if (email3.length>0 && !validateEmail(email3)){
                    errorPopover("#email3",'Invalid Email Address');
                    bool=false;
                 }
                 if(contact_name1.length>=2 && contact_name2.length>=2 && (contact_name1==contact_name2))
                 {
                    errorPopover("#contact_name2",'Contact Names should be unique');
                    bool=false;
                 }  
                 if(contact_name2.length>=2 && contact_name3.length>=2 && (contact_name2==contact_name3))
                 {
                    errorPopover("#contact_name3",'Contact Names should be unique');
                    bool=false;
                 }  
                 if(contact_name1.length>=2 && contact_name3.length>=2 && (contact_name1==contact_name3))
                 {
                    errorPopover("#contact_name3",'Contact Names should be unique');
                    bool=false;
                 }  
                 if(mobile1.length==10 && mobile2.length==10 && (mobile1==mobile2))
                 {
                    errorPopover("#mobile2",'Mobile No should be unique');
                    bool=false;
                 }  
                 if(mobile2.length==10 && mobile3.length==10 && (mobile2==mobile3))
                 {
                    errorPopover("#mobile3",'Mobile No should be unique');
                    bool=false;
                 }  
                 if(mobile3.length==10 && mobile1.length==10 && (mobile3==mobile1))
                 {
                    errorPopover("#mobile3",'Mobile No should be unique');
                    bool=false;
                 }
                 if(designation1.length>=2 && designation2.length>=2 && (designation1==designation2))
                 {
                    errorPopover("#designation2",'Designations should be unique');
                    bool=false;
                 }  
                 if(designation2.length>=2 && designation3.length>=2 && (designation2==designation3))
                 {
                    errorPopover("#designation3",'Designations should be unique');
                    bool=false;
                 }  
                 if(designation3.length>=2 && designation1.length>=2 && (designation3==designation1))
                 {
                    errorPopover("#designation3",'Designations should be unique');
                    bool=false;
                 }  
                 if(email1.length>=2 && email2.length>=2 && (email1==email2))
                 {
                    errorPopover("#email2",'Emails should be unique');
                    bool=false;
                 }  
                 if(email2.length>=2 && email3.length>=2 && (email2==email3))
                 {
                    errorPopover("#email3",'Emails should be unique');
                    bool=false;
                 }  
                 if(email3.length>=2 && email1.length>=2 && (email3==email1))
                 {
                    errorPopover("#email3",'Emails should be unique');
                    bool=false;
                 }
                  if(bool==false)
                    return bool;
                    closePopover('#email1');
                    closePopover('#email2');
                    closePopover('#email3');
                    closePopover('#designation1');
                    closePopover('#designation2');
                    closePopover('#designation3');  
                    closePopover('#mobile1');
                    closePopover('#mobile2');
                    closePopover('#mobile3');  
                    closePopover('#contact_name1');
                    closePopover('#contact_name2');
                    closePopover('#contact_name3');  
                      
                    $("#orderhandler").modal('hide');
                    $("#handler_info_btn").text('EDIT');
                    $('.overlay').css('height',0);
                    $('.overlay').css('height', $(document).height());
                    $(".overlay").show();
                  $.ajax({
                         context : this,  
                         type: "POST",  
                         url: $(this).attr('action'),
                         headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                         dataType:"json",
                         data:$("#handler_info_form").serialize(),
                         success: function(result) 
                         {
                             setTimeout(function () {
                                 $(".overlay").hide();
                                 if(result.success==true){
                                    $('#remarks').val(''); 
                                    $.growl({title: '', location: 'tc', size: 'medium', message: 'HANDLER INFO UPDATED SUCCESSFULLY!'});
                                    $(".overlay").hide();
                                    $(".edit_info").prop('disabled', true);

                                 }
                             }, 3000);
                              
                         }
                  });  
              }
       });
       function validateEmail(sEmail) {
           var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
           if (filter.test(sEmail)) {
               return true;
           }
           else {
               return false;
           }
       }
       $("#second").click(function(){
            if ($("#s_operator").val()=='' && $("#handler").val() =='' && $("#s_ordered").val()=='' && $("#s_callsign").val() =='' && $("#from_date").val() =='' && $("#to_date").val() =='' ) {
                     $("#handling_alert_validation").modal();
                     $(".modal_message").html("Please enter any one field");
                     $(".header_title").html('Validation Fail Message')
                     return false;
            }
       });
       $.ajax({
        url: '/handling/autosuggest_handler',
        dataType:"json",  
        success: function(result)
        {
            $("#handler").autocomplete({
                source: result,
                selectFirst: true,
                minLength: 3,
                select: function (event, ui) 
                {
                    $("#handler").css('border','1px solid #999');
                    closePopover("#handler");
                }
            });
        }});
       $.ajax({
        url: '/handling/autosuggest_callsign',
        dataType:"json",  
        success: function(result)
        {
            $("#s_callsign").autocomplete({
                source: result,
                selectFirst: true,
                minLength: 3,
                select: function (event, ui) 
                {
                    $("#s_callsign").css('border','1px solid #999');
                    closePopover("#s_callsign");
                }
            });
        }});
       $.ajax({
        url: '/handling/autosuggest_operator',
        dataType:"json",  
        success: function(result)
        {
            $("#s_operator").autocomplete({
                source: result,
                selectFirst: true,
                minLength: 2,
                select: function (event, ui) 
                {
                    $("#s_operator").css('border','1px solid #999');
                    closePopover("#s_operator");
                }
            }).autocomplete("widget" ).addClass("airport_autocomplete");
        }});
       $.ajax({
       url: '/fpl/fuelprice/autosuggest',
       dataType:"json",  
       success: function(result)
       {
           $("#s_ordered" ).autocomplete({
               source: result,
               selectFirst: true,
               minLength: 3,
               select: function (event, ui) 
               {
                   $("#s_ordered").css('border','1px solid #999');
                   closePopover("#airport_code");
               }
           }).autocomplete("widget" ).addClass("airport_autocomplete");
       }});
  });
$("#handler_info_close").click(function(){
    // swal({
    //   title: "Are you sure?",
    //   type: "warning",
    //   showCancelButton: true,
    //   cancelButtonClass: "newbtn_blackv1",
    //   confirmButtonClass: "newbtnv1",
    //   confirmButtonText: "Yes",
    // },
    // function(){
    //    $("#orderhandler").modal('hide');
    // });
    if($("#contact_name1").prop('disabled')==true)
     {
       $("#orderhandler").modal('hide');
     }
    else
    {    
        $("#edit_div").css('display','none');
        $("#close_div").css('display','block');
    }
});
$("#close_div_no").click(function(){
     $('#close_div').css('display','none');
     $('#edit_div').css('display','block');
});
$("#close_div_yes").click(function(){
  $("#orderhandler").modal('hide');
  $('#close_div').css('display','none');
  $('#edit_div').css('display','block');
});
</script>
@stop