@extends('layouts.check_navlog_layout')
@push('css')
<link href="{{url('app/css/components.css')}}" rel="stylesheet">
<link href="{{url('app/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{url('app/css/sweet-alert.css')}}" />
@endpush
@push('js')
<script src="{{url('app/js/sweet-alert.js')}}"></script>
<script src="{{url('app/js/jquery.sweet-alert.init.js')}}"></script>
@endpush

@section('content')
<style>
  .modal_btn_navlog{
    width: 65px;
    height: 34px;
    color: #fff !important;
  }
    *{
        -moz-box-sizing: border-box !important;
    }
    .pending{
           background: -webkit-gradient(linear, left top, left bottom, from(#00acff), to(#4283a2)) !important;
       }
       .cancelled{
           background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858)) !important;
       }
       .completed{
           background: -webkit-gradient(linear, left top, left bottom, from(#00c853), to(#10ae52)) !important;
       }
   /* .ui-datepicker-calendar td.ui-datepicker-today a {
        border-color: #F1292b;
        background: #F1292b;
        text-align: center;
        color: beige;
    }    */
    .dataTables_wrapper .dataTables_paginate{
        padding-right: 20px;
    }
    #qucik_responce .popover{
        background: transparent;
    }
    .table.dataTable.no-footer{
        border-collapse: separate !important;
        border-top: 1px solid #111;
        border-right: 1px solid #111;
        border-bottom: none;
    }
    .desk-plan > thead > tr > th, .desk-plan > tbody > tr > td{
        border-right:1px black!important;
        border-top:1px black!important;

    }
    /*.desk-plan>thead{
        background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858)); 
    }*/
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
    .uppercase {
        text-transform: uppercase;
        font-size: 13px;
    }
    .fontweight{
      font-weight:bold;
    }
    .margintop{
      margin-top:5px;
    }
    .margintop10{
      margin-top:10px;
    }
    .marginbottom{
      margin-bottom:10px;
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
    table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc {background : none;}
    .desk-plan .form-control[disabled],.desk-plan .form-control[readonly],.desk-plan fieldset[disabled] .form-control {background: #999;}
    .p-lr-0 {padding-left:0;padding-right:0;}
    .p-r-9 {padding-right:9px;}
    .m-l-7 {margin-left:7px;}
    .tooltip_cancel, .tooltip_revise_dbl, .tooltip_revise_valid {position: relative;}
    .tooltip_cancel_position, .tooltip_fpl_position1,.tooltip_fpl_position2, .tooltip_fpl_position, .tooltip_info_position, .tooltip_revise_position,.tooltip_change_position,.tooltip_revise_dbl_position, .tooltip_dept_position, .tooltip_dest_position, .tooltip_pdf_position, .tooltip_notam_position, .tooltip_wx_position, .tooltip_revise_dbl_position_valid, .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year, .tooltip_wx, .tooltip_tripkit  {
        position: absolute;top: -25px;left: 45px;padding: 3px 11px;color: #000;border-radius: 4px;visibility: hidden;font-size: 10px;font-weight: bold;
        box-shadow: 0 0 1px 1px #ccc;background:#DAF1D6;white-space: nowrap;z-index: 20}
    .tooltip_cancel:hover .tooltip_cancel_position, .tooltip_revise_valid:hover .tooltip_tri_shape_valid, .tooltip_revise_valid:hover .tooltip_revise_dbl_position_valid, .tooltip_cancel:hover .tooltip_fpl_position1, .tooltip_cancel:hover .tooltip_fpl_position2 ,.tooltip_cancel:hover .tooltip_fpl_position, .tooltip_cancel:hover .tooltip_info_position,.tooltip_cancel:hover .tooltip_revise_position,.tooltip_cancel:hover .tooltip_change_position, .tooltip_revise_dbl:hover .tooltip_revise_dbl_position, .tooltip_cancel:hover .tooltip_dept_position, .tooltip_cancel:hover .tooltip_dest_position, .tooltip_cancel:hover .tooltip_pdf_position, .tooltip_cancel:hover .tooltip_notam_position, .tooltip_cancel:hover .tooltip_wx_position, .tooltip_revise_dbl:hover .tooltip_tri_shape, .stats_fixed_wing:hover .tooltip_fixed_wing, .stats_heli:hover .tooltip_heli,.stats_month:hover .tooltip_month, .stats_year:hover .tooltip_year,.stats_wx:hover .tooltip_wx, .stats_tripkit:hover .tooltip_tripkit {
        visibility: visible;
    }
    .tooltip_revise_dbl:hover .tooltip_tri_shape_valid, .tooltip_revise_dbl:hover .tooltip_revise_dbl_position_valid{visibility: hidden;}
    .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year, .tooltip_wx, .tooltip_tripkit {top:-31px;left:22px;font-size: 12px;text-transform: uppercase;}

    .tooltip_fpl_position {left: 41px;width: 81px;}
    .tooltip_fpl_position1 {left:0;}
    .tooltip_fpl_position2 {left:60px;}
    .tooltip_info_position  {left: 35px;}
    .tooltip_revise_position {left: 45px;width: 78px;}
    .tooltip_change_position {left: -45px;width: 79px;}
    .tooltip_revise_dbl_position_valid {left:0;}
    .tooltip_revise_dbl_position {width:175px;z-index: 9999;left: 15px;top:-25px;}
    .tooltip_pdf_position, .tooltip_notam_position, .tooltip_wx_position {left:-70px;}
    .tooltip_pdf_position {left:-38px;}
    /*.carousel-inner > .item > a > img, .carousel-inner > .item > img, .img-responsive, .thumbnail a > img, .thumbnail > img{
        max-width: 112%!important; 
    }*/
    .tooltip_tri_shape, .tooltip_tri_shape1, .tooltip_tri_shape2, .tooltip_tri_shape3, .tooltip_tri_shape4, .tooltip_tri_shape5, .tooltip_tri_shape6, .tooltip_tri_shape7, .tooltip_tri_shape8, .tooltip_tri_shape9, .tooltip_tri_shape10, .tooltip_tri_shape11, .tooltip_tri_shape12, .tooltip_tri_shape_valid, .tooltip_trishape_01, .tooltip_trishape_02, .tooltip_trishape_03, .tooltip_trishape_04, .tooltip_trishape_05, .tooltip_trishape_06 {
        width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-top: 6px solid #333;position: absolute;top: -5px;right: 21px;z-index: 99999;visibility: hidden;}

    .tooltip_cancel_position {left:68px;}
    .tooltip_fpl_position {left: 90px;}
    .tooltip_tri_shape1 {right:5px;}
    .tooltip_tri_shape2 {right:5px;}
    .tooltip_tri_shape3 {right:18px;}
    .tooltip_tri_shape4, .tooltip_tri_shape5 {right:65px;}
    .tooltip_tri_shape6 {right:18px;}
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
    .q_filter {width: 100%;float:left; padding-left: 10px;padding-right: 10px;box-shadow: 0 6px 8px 0px #a7a7a7;}
    .q_filter .depstatns, .q_filter .destatns {width:20%;}
    .from_to_adj_width {width:32%;}
    .from_dp_pos {width: 100%;}
    .from_widthv {width: 42% !important;}
    #from_date {text-align: left;font-size: 13px;font-weight: normal;color: #222;padding-left: 5px!important;}
    #to_date {padding-left: 5px!important;font-size:13px;font-weight: normal;color: #222;text-align: left;width: 137%;border-radius: 5px;}
    .to_widthv {width: 58%;}
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        background: #333;color: #fff !important;}
    .dataTables_wrapper .dataTables_paginate .previous {background: #333 !important;color: #fff !important;}
    .dataTables_wrapper .dataTables_paginate .next {background: #333 !important;color: #fff !important;}
    .fic-adc .send {width: 21%;}
    .desk-plan {border-collapse: collapse !important;}
   /* .desk-plan>thead {background: #F26232;background: linear-gradient(to top, #fa9b5b, #F26232);background: #f1292b;
                      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
                      background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
                      background: -moz-linear-gradient(top, #f1292b, #f37858);border-top:1px solid #333333;}*/
    #tbl_head th{
        background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
        }
     .desk-plan>thead {
    background: none;
   
}   
    .desk-plan>tbody>tr>td {font-size: 14px;}
    .dataTables_wrapper {margin-left:5px;margin-right:5px;}
    .desk-plan tr:nth-child(odd) td{background: #ffffff;}
    .desk-plan tr:nth-child(even) td{background: #eeeeee;}
    .desk-plan tr:hover:nth-child(odd) td,.desk-plan tr:hover:nth-child(even) td {background: #ccc;}
    .desk-plan>thead>tr>th, .desk-plan>tbody>tr>td {padding:5px;border:1px solid #333;text-transform: uppercase;}
    .dataTables_wrapper .dataTables_paginate .paginate_button {padding:1px 8px;}
    .dataTables_wrapper .dataTables_paginate .paginate_button {margin-left:10px;}

    /*        New changes to datatables*/
    .table>thead:first-child>tr:first-child>th.thdpt, .table>thead:first-child>tr:first-child>th.thdof, .table>thead:first-child>tr:first-child>th.thpdf, .table>thead:first-child>tr:first-child>th.thnotam,  .table>thead:first-child>tr:first-child>th.thchange  {
        padding-left:0;
        padding-right: 0;
    }
    .desk-plan>thead>tr>th {font-size: 14px;color: #ffffff;}
    .desk-plan>thead>tr>th:nth-child(9), .desk-plan>tbody>tr>td:nth-child(9) {border-right:0;}
    .desk-plan>thead>tr>th:nth-child(10), .desk-plan>tbody>tr>td:nth-child(10) {border-left:0;border-right:0;}
    .desk-plan>thead>tr>th:nth-child(11), .desk-plan>tbody>tr>td:nth-child(11) {border-left:0;}
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

    .stats_fixed_wing, .stats_heli, .stats_month, .stats_year, .stats_wx, .stats_tripkit {width: 12.5%;display: inline-block;text-align: center;position: relative;cursor:pointer;}
    .fixed_wing_count, .heli_count, .month_count, .year_count, .wx_count, .tripkit_count {color:#333;font-size: 14px;margin-top:0px;font-weight: bold;}
    .fixed_wing_count:hover, .heli_count:hover, .month_count:hover, .year_count:hover, .wx_count:hover, .tripkit_count:hover {color:#f1292b;}
    .stats_fixed_wing img, .stats_heli img, .stats_month img, .stats_year img, .stats_wx img, .stats_tripkit img {transition: 0.3s all;height: 42px;}
    .stats_fixed_wing:hover img, .stats_heli:hover img, .stats_month:hover img, .stats_year:hover img, .stats_wx:hover img, .stats_tripkit:hover img {transform: scale(1.1);transition: 0.3s all;}
    .stats_fixed_wing:hover p, .stats_heli:hover p, .stats_month:hover p, .stats_year:hover p, .stats_wx:hover p, .stats_tripkit:hover p {color:#f1292b;}
    .dof .flightdate, .flightdate1,.calsign .csgn, .depart-time .mod-time .alt-time {font-size: 14px;}
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
    .table-hover>tbody>tr {
        position: relative;
    }
    .table-hover>tbody>tr:hover .weather, .table>tbody>tr.active:hover .weather, .table-hover>tbody>tr:hover .notams, .table>tbody>tr.active:hover .notams, .table-hover>tbody>tr:hover .fildate, .table>tbody>tr.active:hover .fildate {visibility: visible !important;}

    @media screen and (min-width:767px) and (max-width:1300px) {
        .todaycancelledpans_body{
            left: -50px!important;
        }
        .todaycancelledpans_shape{
            right: 22px!important;
        }
        .Todayfixedwingplans_body{
            left: -34px!important;
        }
        .Todayfixedwingplans_shape{
            right: 8px!important;
        }
        .Todayhelicopterplans_body{
            left: -37px!important;
        }
        .Todayhelicopterplans_shape{
            right: 11px!important; 
        }
        .Todayweatherplans_body{
            left: -42px!important;
        }
        .Todayweatherplans_shape{
            right: 24px!important;
        }
        .Todaytripkitplans_body{
            left: -40px!important;
        }
        .Todaytripkitplans_shape{
            right: 23px!important;
        }
        .Thismonthtotalplans_body{
            left: -48px!important;
        }
        .Thismonthtotalplans_shape{
            right: 20px!important;
        }
        .TOTALPLANSTILLDATE_body{
            left: -45px!important; 
        }
        .TOTALPLANSTILLDATE_shape{
            right: 22px!important;
        }

    }

    @media screen and (min-width:1301px) and (max-width:1600px) {
        .todaycancelledpans_body{
            left: -50px!important;
        }
        .todaycancelledpans_shape{
            right: 22px!important;
        }
        .Todayfixedwingplans_body{
            left: -34px!important;
        }
        .Todayfixedwingplans_shape{
            right: 8px!important;
        }
        .Todayhelicopterplans_body{
            left: -37px!important;
        }
        .Todayhelicopterplans_shape{
            right: 11px!important; 
        }
        .Todayweatherplans_body{
            left: -42px!important;
        }
        .Todayweatherplans_shape{
            right: 24px!important;
        }
        .Todaytripkitplans_body{
            left: -40px!important;
        }
        .Todaytripkitplans_shape{
            right: 23px!important;
        }
        .Thismonthtotalplans_body{
            left: -48px!important;
        }
        .Thismonthtotalplans_shape{
            right: 20px!important;
        }
        .TOTALPLANSTILLDATE_body{
            left: -45px!important; 
        }
        .TOTALPLANSTILLDATE_shape{
            right: 22px!important;
        }
        .sendemailtooltip_shape {
            right: 30px!important;
        }
        .deptimerevisetime_shape1 {
            right: 22px!important;
        }

    }
    .container {
        width: 900px;
    }
    .sec_container{
        width:850px;
        text-align: center;background: #ffffff;
        margin: 15px auto;
        box-shadow: 0 0 3px 1px #999999;
    }
    .new_heading{
        text-align: center;
        padding: 7px 0;
        font-weight: 600;
        font-size: 15px;
        color: #fff;
        font-family: 'pt_sansregular', sans-serif;
        background: #a6a6a6;
        background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
    }
    .new_heading1{
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        font-family: 'pt_sansregular', sans-serif;
        background: #a6a6a6;
        background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -webkit-linear-gradient(left, #a6a6a6 0%, #9E9E9E 50%, rgba(166, 166, 166, 0.08) 100%);
        background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: linear-gradient(to right, hsla(0, 0%, 62%, 0) 0%, rgba(33, 33, 33, 0.15) 50%, rgba(166, 166, 166, 0) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
    }
    input[type="text"],select {
        font-size: 14px;
        padding: 4px 0px 0px 0px;
        display: block;
        width: 100%;
        color: #000;
        border-left: 0px;
        border-right: 0px;
        border-top: 0px;
        border-color: #777;
        border-width: 1px;
        text-transform: uppercase;
    }
    .ltrim_sec div.dynamiclabel{
        display: block;
        position: relative;
        text-align: left;
        padding-right: 0px;  
    }
    .ltrim_sec div.dynamiclabel label{
        position: absolute;
        font-size:10px;
        color:#555;
        font-weight:normal;      
        top: 31px;
        left:15px;          
        -moz-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        -webkit-transition: all 0.6s ease-in-out;
        -o-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        opacity: 0;
        z-index: -1;
        line-height: 0px;
        white-space: nowrap;
        font-style: italic;
    }
    .top_level{
        position: absolute;
        font-size: 13px;
        color: #f1292b;
        font-weight: bold;
        top: -7px;
        -moz-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        -webkit-transition: all 0.6s ease-in-out;
        -o-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        opacity: 1;
        line-height: 0px;
        white-space: nowrap;
        text-transform: uppercase;
        z-index: 1000; 
    }
    .top_level1{

        top: -2px !important;
    }
    .ltrim_sec div.dynamiclabel > *:not(:placeholder-shown) + label{
        opacity: 1;
        z-index:1;
        top:31px;
        left:0px;
        text-transform: uppercase;
        font-style: italic;
    }
    .ltrim_sec div.dynamiclabel > *:focus + label{
        opacity: 1;
        z-index:100;
        top:31px;
        left:0px;
        text-transform: uppercase;
        font-style: italic;
    }
    .ltrim_sec div.dynamiclabel > *:focus{
        border-color:#f1292b ;
        outline: none;
    }
    .ltrim_sec div.dynamiclabel [placeholder]::-webkit-input-placeholder {
        transition: opacity 0.4s 0.4s ease;
        text-align: left;
    }
    input::-webkit-input-placeholder {
        color: #000 !important;
        font-size: 12px!important;
        padding:0px;
        margin:0px; 
    }
    input:-moz-placeholder { /* Firefox 18- */
        color: #000 !important;
        font-size: 12px!important;  
    }
    input::-moz-placeholder {  /* Firefox 19+ */
        color: #000 !important;
        font-size: 12px!important;  
    }
    input:-ms-input-placeholder {  
        color: #000 !important;
        font-size: 12px!important;  
    }
    .ltrim_sec div.dynamiclabel [placeholder]:focus::-webkit-input-placeholder {
        transition: opacity 0.4s 0.4s ease;
        opacity: 0;
    }
    .ltrim_sec div.dynamiclabel .form-control {
        text-align: left;
        font-weight: bold;
        color: #333;
    }
    .ltrim_sec div.dynamiclabel .form-control:focus {
        border-bottom: 1px solid #ff0000 ;
    }
    .style_date{
        width: 14%!important;
        padding-right: 0px;
    }
    .style_registration{
        width:8%;
        padding-right: 0px;
        padding-left:0;
    }
    .style_registration1{
        width:11%;
        padding-right: 0px;
    }
    .style_departure{
        width:15%;
        padding-right: 0px;
    }
    .style_destination{
        width:15%;
        padding-right: 0px;
    }
    .style_departure_time{
        width:12%;
        padding-right: 0px;
    }
    .style_pax{
        width: 7%;
        color:#000;
        padding-right: 0px;
    }
    .style_load{
        width:5%;
        padding-right:0px;
        padding-left:0px;
    }
    .style_fuel{
        width:7%;
        padding-right: 0px;
    }
    .style_radio{
        width:7%;
        font-size:11px;
        padding-right: 0px;
        padding-left: 0px;
        margin-top:-10px;
    }
    .radio {
    padding-left: 32px !important;
    
}
    .checkbox-inline, .radio-inline {
        position: relative;
        display: inline-block;
        padding-left: 25px;
        margin-bottom: 0;
        font-weight: 400;
        vertical-align: middle;
        cursor: pointer;
    }
    .wrapper-class input[type="radio"] {
        width: 15px;
    }
    .wrapper-class label {
        display: inline;
        margin-left: 5px;
    }
    .style_pilot_in{
        width:22%;
        padding-left:7px;
    }
    .style_mobile{
        width:14%;
        margin-left: -16px;
    }
    .style_co_pilot{
        width:23%;
        padding-left: 0px;
    }
    .style_cabincrew{
        width: 23%;
        margin-left: -14px;
        padding-right:0px;
    }
    .style_remarks{
        width:69%;
        padding-right:0px;
    }
    .ui-datepicker-trigger{
        height:24px;
        top:0px;
        right:0px;
    }
     .ui-datepicker-trigger1{
        height:24px;
        top:0px;
        right:0px;
    }
    .sub_new_heading{
        margin-top:0px;
    }
    .sub_radio{
        padding-left:15px;
        padding-right:0px;
    }
    .pilot_in_comm{
        margin-top:-10px;
    }
    .remarkes{
        margin-top:20px;
    }
    .place_long{
        margin-top:20px;
    }
    .pace_name{
        background: #eee;
    }
    .mfProgress:hover{
        font-weight:normal;
        color: #fff !important;
    }
    .input_blod{
        font-weight: bold;
    }
    .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover{
        background:-webkit-gradient(linear, left top, left bottom, from(#f1292b ), to(#f37858 ));
    }
    .speed_drop{
        min-width: 92px;
    }
    .panel-default{
        margin-bottom:0px;
    }
    .panel-default>.panel-heading{
        color: #fff;
        background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        padding:0px 0px;
    }
    .panel-title{
        text-align:center;
        cursor: pointer;
    }
    #accordion .panel-heading { padding: 0;}
    #accordion .panel-title > a {
        display: block;
        padding: 0.4em 0.6em;
        outline: none;
        font-weight:bold;
        text-decoration: none;
    }
    #accordion .panel-title > a.accordion-toggle::before, #accordion a[data-toggle="collapse"]::before  {
        content:"\e113";
        float: left;
        font-family: 'Glyphicons Halflings';
        margin-right :1em;
    }
    #accordion .panel-title > a.accordion-toggle.collapsed::before, #accordion a.collapsed[data-toggle="collapse"]::before  {
        content:"\e114";
    }
    .panel-body{
        /*box-shadow: 3px 3px 12px 0px #999;*/
        box-shadow: 0 5px 4px 0px #999;
        padding: 5px 15px 15px 15px;
    }
    .panel-group .panel-heading+.panel-collapse>.list-group, .panel-group .panel-heading+.panel-collapse>.panel-body{
        border-top:0;
    }
    .panel-group .panel+.panel{
        margin-top: 0px;
    }
    .mfProgress.active.focus, .mfProgress.active:focus, .mfProgress.focus, .mfProgress:active.focus, .mfProgress:active:focus, .mfProgress:focus{
        color: #fff!important;
        background:-webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b))!important;
    }
    .dropdown dd ul{
        width: 92px;
        top:0px;
        height: 122px;
        overflow: hidden;
        padding: 0px;
        padding: 0px;
        left: 0px;
    }
    #hour1,#hour2, #hour3,#hour4,#hour5,#hour6,#hour7,#speed1,#speed2, #speed3,#speed4,#speed5,#speed6,#speed7{
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
        border-radius: 0px;
        box-shadow: none;
        z-index: 99;
        margin-bottom: 0;
    }
    .dropdown dt a span, .dropdowns dt a span, .speed dt a span, .level dt a span, .modhrs dt a span, .modmin dt a span, .nationality dt a span, .endhrs dt a span, .endmin dt a span, .flrules dt a span, .fltypes dt a span, .wtcat dt a span, .transmode dt a span, .tt-hrs dt a span, .tt-mins dt a span, .crfacility dt a span,.dropdown2 dt a span,{
        font-size:14px;
    }
    .dropdown dd ul li a:hover, .dropdowns dd ul li a:hover, .speed dd ul li a:hover, .level dd ul li a:hover, .modhrs dd ul li a:hover, .modmin dd ul li a:hover, .endhrs dd ul li a:hover, .endmin dd ul li a:hover, .nationality dd ul li a:hover, .flrules dd ul li a:hover, .fltypes dd ul li a:hover, .wtcat dd ul li a:hover, .transmode dd ul li a:hover, .tt-hrs dd ul li a:hover, .tt-mins dd ul li a:hover, .crfacility dd ul li a:hover,.dropdown2 dd ul li a:hover {
        background:-webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b))!important;
        color: #fff;
    }
    .title_navlog:hover{
        text-decoration: none;
        color:#fff;
    }
    .no_of_flights{
        font-size: 13px;
        color: #f1292b;
        font-weight: bold;
        z-index: 999;
        margin-left:15px;
    }
    .dropdown dd ul li a, .dropdowns dd ul li a, .speed dd ul li a, .level dd ul li a, .modhrs dd ul li a, .modmin dd ul li a, .endhrs dd ul li a, .endmin dd ul li a, .nationality dd ul li a, .flrules dd ul li a, .fltypes dd ul li a, .wtcat dd ul li a, .transmode dd ul li a, .tt-hrs dd ul li a, .tt-mins dd ul li a, .crfacility dd ul li a{
        cursor: pointer;
    }
    .dropdown2 dt a span{
        cursor: pointer;
        display: block;
        text-transform: uppercase;
        font-size: 12px;
        vertical-align: middle;
    }
    .speed_info{
        text-align: left;
    }
    .speed_ul{
        top: 24px!important;
        width:50px!important;
    }
    a:focus, a:hover {
        color: #000;
        text-decoration: underline;
    }
    .fltypes dt a span{
        font-weight: bold;
    }
    .border_red{
        border-color: red !important;
    }
    .hide{
        display: none;
    }
    #hour, #mins, #setspeed, #national, #endhrs, #endmin, #rules {
        z-index: 98;
        margin-bottom: 0;
        padding: 6px;
    }
    .styledl{
        border-left: 0px;
        border-right: 0px;
        border-top: 0px;
        border-radius: 0;
        box-shadow: none; 
    }
    input[type="text"]#subdomaintwoleft {
        -webkit-appearance: none!important;
        color: red;
        text-align: right;
        width: 75px;
        border: 1px solid gray;
        border-left: 0px;
        margin: 0 0 0 -7px;
        background: white;
        border-right:0!important;
        border-top:0!important;
    }
    input[type="text"]#dept_time {
        -webkit-appearance: none!important;
        border: 1px solid gray;
        border-right: 0px;
        outline: none;
    }
    input[type="text"]#subdomaintwo {
        -webkit-appearance: none!important;
        color: red;
        text-align: right;
        width: 75px;
        border: 1px solid gray;
        border-left: 0px;
        margin: 0 0 0 -7px;
        background: white;
        line-height:1.5;
        font-size:12px;
    }
    .dlcabin{
        height: 25px;
        padding-left: 0;
        border-left: 0;
        border-radius: 0;
        border-right: 0;
        border-top: 0;
        box-shadow: none;
    }
    input[type="text"]#subdomaintwo{
        -webkit-appearance:none!important;
        color:red;
        text-align:right;
        width:75px;
        border:1px solid gray;
        border-left:0px;
        margin:0 0 0 -7px;
        background:white;
    }
    input[type="text"]#subdomaintwo7{
        -webkit-appearance:none!important;
        color:red;
        text-align:right;
        width:75px;
        border:1px solid gray;
        border-left:0px;
        margin:0 0 0 -7px;
        background:white;
    }
    
    input[type="text"]#subdomaintwoleft{
        -webkit-appearance:none!important;
        color:red;
        text-align:right;
        width:75px;
        border:1px solid gray;
        border-left:0px;
        margin:0 0 0 -7px;
        background:white;
    }
     input[type="text"]#subdomaintwoleft7{
        -webkit-appearance:none!important;
        color:red;
        text-align:right;
        width:75px;
       
        border-left:0px;
        margin:0 0 0 -7px;
        
    }
    input[type="text"]#dept_time{
        -webkit-appearance:none!important;
        border:1px solid gray;
        border-right:0px;
        outline:none;
    }
    .paxdl{
        border-left: 0;
        border-radius: 0;
        border-right: 0;
        border-top: 0;
        box-shadow: none;
    }
    .flrules dd ul {
        left: 0px;
        top: 2px!important;
        overflow: auto;
        height: auto;
    }
    .cabinul{
        left:0px!important;
    }
    .dlcabin dd, .dlcabin dt, .dlcabin ul, .speeddl dd, .speeddl dt, .speeddl ul, .flight_no dd, .flight_no dt, .flight_no ul, .Paxrules dd, .Paxrules dt, .Paxrules ul {
        margin: 0px;
        padding: 0px;
    }
    .dlcabin dd, .flight_no dd, .Paxrules dd{
        position: relative;
    }
    .dlcabin a, .dlcabin a:visited, .speeddl a, .speeddl a:visited, .flight_no a, .flight_no a:visited, .Paxrules a, .Paxrules a:visited{
        text-decoration: none;
        outline: none;
        color:#222222;
    }
    .dlcabin a:hover, .speeddl a:hover, .flight_no a:hover, .Paxrules a:hover{
        color: #222222;
    }
    .dlcabin dt a:hover, .dlcabin dt a:focus, .speeddl dt a:hover, .speeddl dt a:focus, .flight_no dt a:hover, .flight_no dt a:focus, .Paxrules dt a:hover, .Paxrules dt a:focus{
        color: #222222;
    }
    .dlcabin dt a, .speeddl dt a, .flight_no dt a, .Paxrules dt a{
        display: block;
        background: #fff url(../images/dwnarrow.png) no-repeat center right;
        text-align: left;
        font-weight: normal;
        text-decoration: none;
        color: #222222;
    }
    .dlcabin dt a span, .speeddl dt a span, .flight_no dt a span, .Paxrules dt a span{
        cursor: pointer;
        display: block;
        text-transform: uppercase;
        font-size: 12px;
        vertical-align: middle;
    }
    .dlcabin dd ul, .speeddl dd ul, .flight_no dd ul, .Paxrules dd ul{
        background: #f9f9f9;
        border: 2px solid #ccc;
        color: #C5C0B0;
        display: none;
        left: 0px;
        padding: 5px 0px;
        position: absolute;
        top: 0px;
        width: 58px;
        list-style: none;
        z-index:1001;
        height: 206px;
        overflow-y: scroll;
    }
    .dlcabin dd ul, .speeddl dd ul, .flight_no dd ul, .Paxrules dd ul{
        height: auto;
        overflow-y: auto;
        width: 58px;
    }
    .dlcabin span.value, .speeddl span.value, .flight_no span.value, .Paxrules span.value{
        display: none;
    }
    .dlcabin dd ul li a , .speeddl dd ul li a, .flight_no dd ul li a , .Paxrules dd ul li a  {
        padding: 0px;
        display: block;
        text-align: center;
        text-decoration: none;
        font-weight: 600;
    }
    .dlcabin dd ul li a:hover, .speeddl dd ul li a:hover, .flight_no dd ul li a:hover, .Paxrules dd ul li a:hover{
        background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b))!important;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
    }
    .flight_no dd ul{
        width:50px;
    }
    .paxdl dd ul{
        max-height: 310px;
        overflow-y: scroll;
    }
    .Paxrules{
        border-top: 0px!important;
        border-left: 0px!important;
        border-right: 0px!important;
        border-radius: 0;
        box-shadow: none;
    }
    .popover-content{
        padding:2px;
    }
    /*loader*/
    #loading-img {
        background: url(../media/images/loader.gif) center center no-repeat;
        z-index: 20;
        position: fixed;
        width: 100px;
        height: 100px;
        left: 50%;
        margin-left: -50px;
        margin-top: -50px;
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
    /*loader*/
    .ui-widget-content {
        border: 2px solid #dddddd;
        background: #f9f9f9;
        color: #333333;
        border-top: none;
    }
    .ui-menu .ui-menu-item:hover{
        background:-webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b))!important;
    }
    .downlable{
        position: absolute;
        font-size:10px;
        color:#555;
        font-weight:normal;      
        top: 31px;
        left:15px;          
        -moz-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        -webkit-transition: all 0.6s ease-in-out;
        -o-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        opacity:1;
        z-index:1000;
        line-height: 0px;
        white-space: nowrap;
        font-style: italic;
    }
    .borderclass{
      border:1px solid #777!important;
      padding-top:0px!important;
      text-align: center;
    }
    .borderclass:focus {
     box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 6px #ce8483!important;
     border: 1px solid #f1292b!important;
     }
     .paddingleft10{
         padding-left:0px;
     }
     .top {
        margin-bottom: 5px;
    }
    .lntstyle{
        border-left: 0px!important;
        padding-left: 4px!important;
        padding-right: 4px!important;
    }
    .kitstyle{
        border-left: 0px!important;
        padding-left: 4px!important;
        padding-right: 4px!important;
    }
    .navstyle{
        padding-left: 4px!important;
    }
    .changestyle{
        padding-left: 4px!important;
        padding-right: 4px!important;
    }
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
    .fplstye{
        padding-left: 4px!important;
        padding-right: 4px!important;
    }
    .notamstyle{
        padding-left: 4px!important;
        padding-right: 4px!important;
    }
    .desk-plan>tbody>tr>td:nth-child(13){
        border-left: 0;
    }
    .desk-plan>tbody>tr>td:nth-child(14) {
        border-left: 0;
    }
    .deptimestyle{
        border:1px solid #777!important;
    }
    .deptimestyle:focus{
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 6px #ce8483!important;
        border: 1px solid #f1292b!important;
    }
    .table>thead:first-child>tr:first-child>th.thdpt {
        width:95px !important;
        white-space: pre;
    }
    .flmodify img {
        /*width:38%;*/
        width:unset;
    }
    .table>thead:first-child>tr:first-child>th.thficadc{
        width: 130px !important;
    }
    .depart-time .time-icon {
        width:38%;
        padding:2px;
    }
    .adcstyle{
       border-top:1px solid #777!important;
       border-bottom:1px solid #777!important;
       border-right:1px solid #777!important;
    }
    .adcstyle:focus{
       box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 6px #ce8483!important;
       border: 1px solid #f1292b!important;
    }
    .ficstyle{
       border:1px solid #777!important; 
    }
    .ficstyle:focus{
       box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 6px #ce8483!important;
       border: 1px solid #f1292b!important;
    }
    .canceltooltip_position{
        left:-14px!important;
    }
    .canceltooltip_shape{
        left:7px!important;
    }
    .sendemailtooltip_position{
        left:-28px!important;
    }
    .sendemailtooltip_shape{
        right: 85px!important;
    }
    .fplreview_position{
        left: 45px!important;
        width: 100%!important;
    }
    .modifychangefpl_position{
        left: -28px!important;
        width: 98px!important;
    }
    .modifychangefpl_shape{
        right: 37px!important;
    }
    .deptimerevisetime_shape{
        right: 12px!important;
    }
    .deptimerevisetime_position{
        left: -65px!important;
    }
    .deptimerevisetime_shape1{
        right:22px!important;
    }
    .editfdtl_position{
        left: 18px!important;
    }
    .editfdtl_shape{
        left: 47px!important;
    }
    .icaoatc_position{
        left: -22px!important;
    }
    .icaoatc_shape{
        left: 16px!important;
    }
    .filterednotams_position{
        left:-34px!important;
    }
    .filterednotams_shape{
       left: 14px!important;
    }
    .weatherbrief_position{
       left: -34px!important;
    }
    .weatherbrief_shape{
        left:6px!important;
    }
    .revisetime_position{
        left:28px!important;
    }
    .revisetime_shape{
        right:14px!important;
    }
    .weather a, .notam a, .pdf a {
        display: inline;
    }
    .navicon_style_image {
        padding-top: 0px!important;
        width: 82%!important;
    }
    .notams {
        width: 30% !important;
    }
    .notamimage_style{
       display: inline-block!important; 
    }
    .navicon_position{
       left: -20px!important;
    }
    .navicon_shape{
       left: 5px!important;
    }
    .lnticon_position{
       left:-31px!important;
    }
    .lnticon_shape{
       left:11px!important;
    }
    .kiticon_position{
       left: -32px!important;
    }
    .kiticon_shape{
       left: 5px!important;
    }
    .table>thead:first-child>tr:first-child>th.thto {
        width: 60px !important;
        white-space: pre;
    }
    .table>thead:first-child>tr:first-child>th.thfrom {
        width: 60px !important;
        white-space: pre;
    }
    .weather {
        width: 100%;
    }
    .form-row .form-search-row-right {
        width: 53%;
    }
    .timeicon_style{
        max-width: 70%!important;
    }
    .table>thead:first-child>tr:first-child>th.thcalsign {
        width: 100px !important;
        white-space: pre;
    }
    .callsign_wrapper{
        width:12%!important;
        padding-right:10px;
        padding-left: 0px;
    }
    .depaero_wrapper{
       width:12%!important;
       padding-right: 10px; 
    }
    .destaero_wrapper{
       width:18%!important; 
    }
    .operator_wrapper{
       width:26%!important;
    }
    .one_button{
      padding-left:0px;
      padding-right: 0px;
      margin-right: 30px;
      top:12px;
    }
    .two_button{
      top:12px;
      margin-right: 10px;
      padding-left:5px;
    }
    .three_button{
      margin-left: 25px;
      top:12px;
      padding-left: 5px;
    }
    .one_button_style{
      border-radius: 50px;
      width: 90px;
      background: -webkit-gradient(linear, left top, left bottom, from(#2172c5), to(#4667cc))!important;
      height: 28px;
      line-height: 0.5;
    }
    .one_button_style:focus{
      outline:none;
    }
    .two_button_style:focus{
      outline:none;
    }
    .three_button_style:focus{
      outline:none;
    }
    .two_button_style{
      border-radius: 50px; 
      width: 90px;
      background: -webkit-gradient(linear, left top, left bottom, from(#2a922f), to(#379e3c))!important;
      height: 28px;
      line-height: 0.5;
    }
    .three_button_style{
     border-radius: 50px;
     width: 90px;
     background-color:#f1292b;
     height: 28px;
     line-height: 0.5;
    }
    .newbtnv1{
        font-size: 13px !important;
    }
    .panel{
        border-left: none;
        border-right:none; 
    }
    .callsign_icon_margin{
       width: 45%!important;
       margin-left: 15px;
    }
    .dof .flightdate1{
        float:right;
        width: 64%;
        text-align: left;
        display: inline-block;
        margin-left: 8px;
        white-space: nowrap;
    }
    .navicon_style{
        max-width: 75%;
        margin-left: 3px;
    }
    .prvplan {
        width:50%;
    }
    .modal-body {
        position: relative;
        padding: 10px 15px 15px 15px;
    }
    .cursor_not_allowed{
        cursor:not-allowed !important;
    }
    .background_gray{
        background: #999 !important;
    }
    .pendingimage_style{
        padding-left: 5px;
        padding-right:2px;
    }
    .completedimage_style{
        padding-left: 15px;
        padding-right:2px;
    }
    .cancelledimage_style{
        padding-left:15px;
        padding-right:2px;
    }
    .completed_text{
        background: none!important;
        color: #000!important;
    }
    .completed_text {
        background: none!important;
        color:#00c853!important;
        font-weight: bold!important;
        font-size:15px!important;
    }
    .completed_text:hover{
        background: none!important;
        color:#00c853!important;
        font-weight: bold!important;
        box-shadow:none!important;
    }
    .cancelled_text{
        background: none!important;
        color:#f1292b!important;
        font-weight: bold!important;
        font-size:15px!important;
    }
    .cancelled_text:hover{
        background: none!important;
        color:#f1292b!important;
        font-weight: bold!important;
        box-shadow:none!important;
    }
    .pending_text{
        background: none!important;
        color:#00acff!important;
        font-weight: bold!important;
        font-size:15px!important;
    }
    .pending_text:hover{
        background: none!important;
        color:#00acff!important;
        font-weight: bold!important;
        box-shadow:none!important;
    }
    .cancelled_href{
        background:none!important;
    }
    .cancelled_href:hover{
        background:none!important;
        box-shadow:none!important;
    }
    .completed_href{
        background:none!important;
    }
    .completed_href:hover{
        background:none!important;
        box-shadow:none!important;
    }
    .pending_href{
        background:none!important;
    }
    .pending_href:hover{
        background:none!important;
        box-shadow:none!important;
    }
    .pending_image{
        max-width:90%;
    }
    .completed_image{
        max-width:90%;
    }
    .cancelled_image{
        max-width:90%;
    }
    .airportname_position{
        left:0px!important;
    }
    .airportname_shape{
        right: 26px!important;
    }
    .airportname_position_to{
        left: 0px!important;
    }
    .airportname_shape_to{
        right: 27px!important;
    }

      /* Modals */
.modal .modal-dialog .modal-content {
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  border-color: #DDDDDD;
  border-radius: 2px;
  box-shadow: none;
  padding: 25px;
}
.modal .modal-dialog .modal-content .modal-header {
  border-bottom-width: 2px;
  margin: 0;
  padding: 0;
  padding-bottom: 15px;
}
.modal .modal-dialog .modal-content .modal-body {
  padding: 20px 0;
}
.modal .modal-dialog .modal-content .modal-footer {
  padding: 0;
  padding-top: 15px;
}
.modal-full {
  width: 98%;
}
.modal-content .nav.nav-tabs + .tab-content {
  margin-bottom: 0px;
}
.modal-content .panel-group {
  margin-bottom: 0px;
}
.modal-content .panel {
  border-top: none;
}
/* Custom-modal */
.modal-demo {
  background-color: #ffffff;
  width:400px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  -moz-border-radius: 4px;
  background-clip: padding-box;
  display: none;
}
.modal-demo .close {
  position: absolute;
  top:0px;
  right:15px;
  color: #eeeeee;
  outline:none;
}
.modal-demo .close:focus,
.modal-demo .close:hover{
  opacity:1; 
}
.modal-demo .close{
  opacity:1;
  font-size: 30px;
}
.custom-modal-title {
  padding:8px 25px 8px 25px;
  line-height: 22px;
  font-size:16px;
  background-color: #fe6271;
  color: #ffffff;
  text-align: left;
  margin: 0px;
}
.custom-modal-text {
    padding: 17px;
    font-weight: bold;
}
.custombox-modal-flash .close,
.custombox-modal-rotatedown .close {
  top: 20px;
  z-index: 9999;
}
.btn-group .btn + .btn,
.btn-group .btn + .btn-group,
.btn-group .btn-group + .btn,
.btn-group .btn-group + .btn-group {
  margin-left: 0px;
}
.btn-custom,
.btn-primary,
.btn-success,
.btn-info,
.btn-warning,
.btn-danger,
.btn-inverse,
.btn-purple,
.btn-pink {
  color: #ffffff !important;
}
.btn-custom {
  background-color: #fe6271 !important;
  border-color: #fe6271 !important;
}
.btn-default:hover,
.btn-default:focus,
.btn-default:active,
.btn-default.active,
.btn-default.focus,
.btn-default:active,
.btn-default:focus,
.btn-default:hover,
.open > .dropdown-toggle.btn-default {
  background-color: #ffffff !important;
  border: 1px solid #ebebec !important;
}
.custom-modal-title{
    text-align:center;
    background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
}
.custombox-modal-container{
    margin-top: 315px!important;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
opacity:1;
text-align: left;
}
#aircraft_callsign2::-moz-placeholder{
text-align: center;    
}
#departure_aerodrome2::-moz-placeholder{
text-align: center;    
}
#destination_aerodrome2::-moz-placeholder{
text-align: center;    
}
.form-row .form-search-row-left {
width: 40%;
margin-right: 0%;
float: left;
padding-right: 0;
padding-left: 0;
}
.form-row .form-search-row-right {
width: 55%;
padding-left: 0;
padding-right: 0;
}
.tooltip_cancel_position, .tooltip_fpl_position1,.tooltip_fpl_position2, .tooltip_fpl_position, .tooltip_info_position, .tooltip_revise_position,.tooltip_change_position,.tooltip_revise_dbl_position, .tooltip_dept_position, .tooltip_dest_position, .tooltip_pdf_position, .tooltip_notam_position, .tooltip_wx_position, .tooltip_revise_dbl_position_valid, .tooltip_fixed_wing, .tooltip_heli, .tooltip_month, .tooltip_year, .tooltip_wx, .tooltip_tripkit  {
position: absolute;top: -25px;left: 45px;padding: 3px 11px;color: #eee;border-radius: 4px;visibility: hidden;font-size: 10px;font-weight: normal;
box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20}
.pace_name1{
background: #eee;
cursor: not-allowed !important;
}
/*model open padding right*/
.test[style] {
    padding-right:0;
}
.test.modal-open {
    overflow: auto;
}
.body_padding {
    padding-right:0px !important;
}
.red{
    color: red;
}
/*model open padding right*/
</style>
<div class="page" id="app">  
    @include('includes.new_header',[])
    <!--loader-->
    <div class="overlay">
        <div id="loading-img"></div>
    </div>
    <!--loader-->
    <div class="container" style="margin: 10px auto;">
        <div class="row" style="box-shadow: 0 3px 3px 1px #999999;">
            <div class="panel-group" id="accordion_reg" role="tablist" aria-multiselectable="true" data-prev-section-count="1" >
                <div class="panel panel-default"  data-slidecount="1">
                    <div class="panel-heading" role="tab" id="heading_reg1">
                        <h4 class="panel-title collapsed title_header" id="accord1">
                            <a class="title_navlog">
                                TEST NAV LOG # 1
                            </a>
                        </h4>
                    </div>
                    <div id="collapse_reg1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_reg1" >
                        <span class="lrsuccess updated_successfully" id="success_msg">
                            <div style="margin-top:5px;width:100%;text-align:center;color: #f1292b;text-transform: uppercase" class="hide" id="msg">
                                <div class="success-left animated infinite zoomIn custdelay">
                                    <span class="success-font" id="msg1"></span>
                                </div>
                            </div>
                        </span>
                        <div class="panel-body">
                            <form action="{{url('navlog_test')}}" method="POST" class="navlog" >
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="section" value="navlog1">
                                <input type="hidden" name="plan_status" value=1>
                                <input type="hidden" name="live_test_mode" value=2>
                                <div class="col-md-12">
                                    <span class="no_of_flights">NO OF FLIGHTS</span>
                                </div>
                                <div class="col-md-12 sub_new_heading">
                                    <div class="col-md-1" style="width:8%;margin-top:-2px;">
                                        <div class="form-group">
                                            <dl id="hour1" class="form-control validation_class_click select border_red flight_no" style="height:27px;padding:8px 0px 0px 0px;"  data-toggle="popover
                                                "  data-placement="top" data-id="1">
                                                <dt ><a >
                                                        <span style="font-weight:normal;" id="no_of_flight1" class="no_of_flight">SELECT</span>
                                                    </a>
                                                </dt>
                                                <dd >
                                                    <ul>
                                                        <li><a>1</a></li>
                                                        <li><a>2</a></li>
                                                        <li><a>3</a></li>
                                                        <li><a>4</a></li>
                                                        <li><a>5</a></li>
                                                        <li><a>6</a></li>
                                                    </ul>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="col-md-1 style_registration">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                                <input  class="input_blod special_symbols callsign border_red " id="callsign1" type="text" placeholder="CALL SIGN" name="callsign" autocomplete="off" maxlength="7" data-toggle="popover" data-placement="top" data-id="1">
                                                <label id="callsign1_lbl"> CALL SIGN</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-2 col-xs-6 style_registration1" style="padding-left:15px;">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                                <input  class="input_blod special_symbols aircraft border_red disable" id="aircraft1" type="text" placeholder="REGISTRATION" name="registration" autocomplete="off" maxlength="7"  data-toggle="popover" data-placement="top" data-id="1">
                                                <label id="aircraft1_lbl">REGISTRATION</label>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-1 style_departure">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel departure_newbill_wrapper">
                                                <input class="input_blod  alphabets departure border_red" id="departure1" type="text" placeholder="DEPARTURE" name="departure" autocomplete="off"  maxlength="4" data-toggle="popover" data-placement="top" data-id="1">
                                                <label>DEPARTURE</label>
                                                <p id="departure1_lbl" class="top_level departure_lbl"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 style_destination">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel destination_newbill_wrapper">
                                                <input style="border-radius:0;" class="input_blod alphabets destination border_red" id="destination1" maxlength="4" type="text" placeholder="DESTINATION" name="destination" autocomplete="off" data-toggle="popover" data-placement="top" data-id="1">
                                                <label> DESTINATION</label>
                                                <p id="destination1_lbl" class="destination_lbl top_level" ></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 style_date">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel  flightdate_newbill_wrapper">
                                                <input id="flight_date1" type="text" placeholder="FLIGHT DATE" name="flight_date" autocomplete="off" class="input_blod infocus outfocus ui-datepicker-trigger flightdate" readonly data-toggle="popover" data-placement="top" data-id="1" value="{{date('d-M-Y')}}" data-date="{{date('d-M-Y')}}" data-id="1">
                                                <label id="flight_date1_lbll" style="display: none;"> FLIGHT DATE</label>
                                                <p id="flight_date1_lbl" style="display: none"  class="top_level">FLIGHT DATE</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-2 col-xs-6 style_departure_time fakeinput_wrapper">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel fakeinput">
                                                <input type="text" id="hhdept_time1" maxlength="2" style="padding-left:10px;display:inline-block;width: 44%;" size="2" class="mini_input numeric 
                                                bill_time hhdeparturetime disable input_blod" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top" data-id="1" name="hhdept_time" data-id="1"/><label>DEP TIME UTC</label><span id="bill_time_lbl" class="billingtime_span"></span><div style="display:inline-block;" class="slash">:</div><input style="padding-left:5px;display:inline-block;width: 44%;" type="text" maxlength="2" size="2" class="mini_input numeric bill_time mmdeparturetime disable input_blod" id="mmdept_time1" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" data-id="1" name="mmdept_time"/>
                                                <span id="dept_time1_lbl" class="top_level dept_time_lbl" style="left: 10px;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="width:8%;">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel">
                                            <input class="input_blod numbers pax  disable" id="pax1" type="text" placeholder="PAX" name="pax" autocomplete="off" maxlength="2" data-toggle="popover" data-placement="top" data-id="1" readonly>
                                            <label id="pax1_lbl">Pax</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 style_load">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel  load_newbill_wrapper">
                                                <input class="input_blod numbers load" id="load1" type="text" placeholder="CARGO" name="load" autocomplete="off" maxlength="3" data-toggle="popover" data-placement="top" data-id="1">
                                                <label id="load1_lbl">CARGO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top:10px;margin-left: -2%;">
                                        <div class="col-md-1 style_fuel">
                                            <div class="ltrim_sec">
                                                <div class="group dynamiclabel  fuel_newbill_wrapper">
                                                    <input class="input_blod numbers fuel"  maxlength="5" id="fuel1" type="text" placeholder="FUEL" name="fuel" autocomplete="off" maxlength="5" data-toggle="popover" data-placement="top" data-id="1">
                                                    <label id="fuel1_lbl"> FUEL</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="group col-md-1 amountmode_newbill_wrapper style_radio">
                                            <div class="radio radio-custom ">
                                                <input type="radio" name="min_max" id="min_1" value="1" data-id="1">
                                                <label for="min_1">
                                                    MIN
                                                </label>
                                            </div>
                                            <div class="radio radio-custom ">
                                                <input type="radio" name="min_max" id="max_1" value="2" data-id="1">
                                                <label for="max_1">
                                                    MAX
                                                </label>
                                            </div>
                                        </div>                              
                                        <div class="col-md-6 style_remarks">
                                            <div class="ltrim_sec">
                                                <div class="group dynamiclabel  remarks_newbill_wrapper">
                                                    <input class="input_blod remarks special_symbols1" id="remarks1" type="text" placeholder="REMARKS" name="remarks" autocomplete="off" maxlength="149" data-toggle="popover" data-placement="top" data-id="1">
                                                    <label id="remarks1_lbl">REMARKS</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" >
                                            <button   data-parent="#accordion_reg" href="#collapse_reg2" aria-expanded="true" aria-controls="collapse_reg2" class="btn footer-send btn_send_f01 newbtn mfProgress newbtnv1" style="margin-top:-6px;width:115px !important; font-size: 15px !important;" id="submit_lbl1" type="submit" name="submit" disabled>SUBMIT</button>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-12" style="margin-top:19px;">
                                    <div class="col-md-12 new_heading1">ADDITIONAL INFO</div>
                                </div>
                                <div class="col-md-12 place_long" style="margin-bottom: 10px;">
                                    <div class="col-md-3">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                                <input class="input_blod pace_name dept_place alphabets_numbers_with_space" maxlength="25" id="dept_place1" type="text" placeholder="DEP ZZZZ PLACE NAME" name="dept_place" autocomplete="off" disabled  data-toggle="popover" data-placement="top" data-id="1">
                                                <label id="dept_place1_lbl">DEP ZZZZ PLACE NAME</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                                <input class="input_blod pace_name dept_lat latlong " id="dept_lat1" type="text" placeholder="DEP ZZZZ LAT LONG" name="dept_lat" autocomplete="off" disabled  data-toggle="popover" data-placement="top" data-id="1">
                                                <label id="dept_lat1_lbl"> DEP ZZZZ LAT LONG</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                                <input class="input_blod dest_place pace_name alphabets_numbers_with_space" maxlength="25" id="dest_place1" type="text" placeholder="DEST ZZZZ PLACE NAME" name="dest_place" autocomplete="off" disabled  data-toggle="popover" data-placement="top" data-id="1">
                                                <label id="dest_place1_lbl"> DEST ZZZZ PLACE NAME</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="ltrim_sec">
                                            <div class="group dynamiclabel  operator_newbill_wrapper">
                                                <input class="input_blod dest_lat pace_name latlong" id="dest_lat1" type="text" placeholder="DEST ZZZZ LAT LONG" name="dest_lat" autocomplete="off" disabled  data-toggle="popover" data-placement="top" data-id="1">
                                                <label id="dest_lat1_lbl"  class="dest_lat_lbl"> DEST ZZZZ LAT LONG</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div id="mysuccess" class="successmsg" style="text-align: center;color: red;font-weight: bold">
            </div> -->
            <div class="row cust_box_shadow">
              <div id="mysuccess" class="successmsg" style="text-align: center;color: red;font-weight: bold">
                  
              </div>
            </div>
            <div class="row cust_box_shadow">
              <div id="mysuccess" class="successmsg" style="text-align: center;color: red;font-weight: bold"> 
              </div>
              <div class="col-md-12 p-lr-0">
                   <p class="search_heading">Search Account</p>
              </div>
              <div class="col-md-12 p-lr-0" style="width:100%;float:left">
                    <div class="q_filter">
                        <!--<form name="search" id="search" method="post" action="{{url('/fpl')}}">-->
                        <form data-url="{{url('navlog_get_test_filter_data')}}" name="search" id="navlog_search" method="post" action="#">
                            <div class="col-sm-2 col-xs-6 col-md-3 xs-p-lr-5 callsign_wrapper">
                                <div class="form-group">
                                    <input type="text" data-toggle ="popover" data-placement="bottom"  minlength="5" maxlength="7" autocomplete="off"  class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip borderclass"  placeholder="Call Sign" id="aircraft_callsign2" name="aircraft_callsign2" tabindex="1">
                                </div>
                            </div>
                            <div class="col-sm-2 col-xs-6 col-md-3 depaero_wrapper_mobile depstatns xs-p-lr-5 paddingleft10 depaero_wrapper">
                                <div class="form-group">
                                    <input type="text" class="form-control text_uppercase alphabets font-bold stations borderclass" id="departure_aerodrome2" minlength="4" maxlength="4"  name="departure_aerodrome2" placeholder="Dep Aero">
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6 destaero_mobile_wrapper col-md-3 destatns xs-p-lr-5 paddingleft10 destaero_wrapper">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control  text_uppercase alphabets font-bold stations borderclass" id="destination_aerodrome2" minlength="4" maxlength="4"  name="destination_aerodrome2" placeholder="Dest Aero">            
                                        <div class="input-group-addon search-addon">
                                            <button id="first" type="submit" name="flag" value="search" class="btn newbtnv1"><span class="glyphicon glyphicon-search"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3 col-xs-6 operator_mobile_wrapper destatns xs-p-lr-5 paddingleft10 operator_wrapper">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control  text_uppercase alphabets font-bold stations borderclass auto_operator" id="destination_aerodrome2" minlength="4" maxlength="4"  name="destination_aerodrome2" placeholder="OPERATOR">
                                        <div class="input-group-addon search-addon">
                                            <button id="first" type="submit" name="flag" value="search" class="btn newbtnv1"><span class="glyphicon glyphicon-search"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 col-md-3 xs-p-lr-5 from_to_adj_width paddingleft10">
                                <div class="form-row">
                                    <div class="form-search-row-left from_widthv col-xs-6">
                                        <div class="form-group">
                                            <div class="input-group from_dp_pos">
                                                <input type="text"  autocomplete="off" class="form-control font-bold from_date pointer fpl_from_box borderclass" placeholder="FROM" name="from_date" id="from_date" minlength="6" maxlength="6" tabindex="5" readonly style="border-radius:4px;
                                                       ">
                                                <span class="fpl_search_from_label">From</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-search-row-right to_widthv col-xs-6">
                                        <div class="form-group">
                                            <div class="input-group xs-m-r-0">
                                                <input type="text" autocomplete="off" class="form-control font-bold to_date pointer fpl_to_box borderclass" placeholder="TO" name="to_date" id="to_date" minlength="6" maxlength="6" tabindex="5" readonly>
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
                                <!-- open here-->
                                <div class="form_pilots_top2" style="position:absolute;z-index:999;top:70px;">
                                    <table>
                                        <tr>
                                            <td class="pendingimage_style">
                                                <a class="pending_href" href="javascript:void(0)">
                                                    <img class="pending_image" src="{{url('app/new_temp/images/pending1.png')}}">
                                                </a>
                                            </td>
                                            <td class="pending_mobile">
                                                <a href="javascript:void(0)" class="pending_text others" data-url="{{url('navlog_get_test_filter_data')}}" id="3rd">PENDING<span id="pend"></span>
                                                </a>
                                            </td>
                                            <td class="completedimage_style">
                                                <a class="completed_href others" href="javascript:void(0)"><img class="completed_image" src="{{url('app/new_temp/images/completed.png')}}" >
                                                </a>
                                            </td>
                                            <td class="pending_mobile">
                                                <a href="javascript:void(0)" class="completed_text others" id="4th" data-url="{{url('navlog_get_test_filter_data')}}">COMPLETED<span id="comp"> (0)</span></a>
                                            </td>
                                            <td class="cancelledimage_style">
                                                <a class="cancelled_href others" href="javascript:void(0)"><img class="cancelled_image" src="{{url('app/new_temp/images/cancelled.png')}}"></a>
                                            </td>
                                            <td class="pending_mobile">
                                                <a href="javascript:void(0)" class="cancelled_text others" data-url="{{url('navlog_get_test_filter_data')}}" id="5th">CANCELLED<span id="canc"></span></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- close here-->
                        </form>
                    </div>
                </div>
            </div>

            <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
            <form id="" name="">
                <div id="result">
                    <div class="desk-view">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="navlog_info table table-hover table-responsive desk-plan">
                                    <thead id="tbl_head">
                                        <tr>
                                            <th class="slno">Sl</th>
                                            <th class="dof thdof" style="width: 10%">Flight Date</th>
                                            <th class="calsign " style="width: 10%">Call Sign</th>
                                            <th class="dpt thdpt" >Dep. Time</th>
                                            <th class="from thfrom">From</th>
                                            <th class="to thto">To</th>
                                            <th class="fildate">Change</th>
                                            <th class="pdf">NAV</th>
                                            <th class="weather">Others</th>                 
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
                </div>
            </form>
        </div>
    </div>
    <!-- Edit plan modal-->
    <div class="modal fade" id="editplan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-container" role="document" style="width:900px;">
            <header class="popupHeader" style="text-align: center;">
                <span class="header_Title" id="chg_navlog">CHANGE NAV LOG</span>
                <span class="modal_close" data-dismiss="modal">
                    <i class="fa fa-times-circle"></i>
                </span>
            </header>
            <section class="popupBody" style="padding:0;">                 
                <div class="modal-body" style="padding:0;">
                   <div class="panel-group" id="accordion_reg" role="tablist" aria-multiselectable="true" data-prev-section-count="1">
                                   <div class="panel panel-default" style="border:none;" data-slidecount="7">
                                      
                                       <div id="collapse_reg1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading_reg1">
                                           <div class="panel-body" style="box-shadow:none;">
                                               <form action="{{url('update_test_navlog')}}" method="POST" class="update_navlog">
                                                   {{csrf_field()}}
                                                   <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                   <input type="hidden" name="navlog_id" id="navlog_id" >
                                                   <input type="hidden" name="navlog_masterid" id="navlog_masterid" >
                                                   <div class="col-md-12">
                                                       <span class="no_of_flights"></span>
                                                   </div>
                                                   <div class="col-md-12 sub_new_heading">
                                                       <div class="col-md-1 style_registration" style="margin-left: 15px;width:9%;">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  operator_newbill_wrapper">
                                                                   <input class="input_blod special_symbols callsign border_red pace_name" id="callsign7" type="text" placeholder="CALL SIGN" name="callsign" autocomplete="off" maxlength="7" data-toggle="popover" data-placement="top" data-original-title="" title="" disabled data-id="7">
                                                                   <label id="callsign7_lbl"> CALL SIGN</label>
                                                               </div>
                                                           </div>
                                                       </div> 
                                                       <div class="col-md-1 style_registration1" style="padding-left:15px;width:13%;">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  operator_newbill_wrapper">
                                                                   <input class="input_blod special_symbols aircraft border_red pace_name" id="aircraft7" type="text" placeholder="REGISTRATION" name="registration" autocomplete="off" maxlength="7" data-toggle="popover" data-placement="top" data-original-title="" title="" data-id="7">
                                                                   <label id="aircraft7_lbl">REGISTRATION</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-1 style_departure" style="width: 18%;">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel departure_newbill_wrapper">
                                                                   <input class="input_blod  alphabets departure border_red pace_name" id="departure7" type="text" placeholder="DEPARTURE" name="departure" autocomplete="off" maxlength="3" data-toggle="popover" data-placement="top" data-original-title="" title=""
                                                                   disabled data-id="7">
                                                                   <label>DEPARTURE</label>
                                                                   <p id="departure7_lbl" class="top_level departure_lbl"></p>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-1 style_destination" style="width: 17%;">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel destination_newbill_wrapper">
                                                                   <input style="border-radius:0;" class="input_blod alphabets destination border_red pace_name" id="destination7" maxlength="4" type="text" placeholder="DESTINATION" name="destination" autocomplete="off" data-toggle="popover" data-placement="top" data-original-title="" title="" disabled data-id="7">
                                                                   <label> DESTINATION</label>
                                                                   <p id="destination7_lbl" class="destination_lbl top_level"></p>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-1 style_date">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  flightdate_newbill_wrapper">
                                                                   <input id="flight_date7" type="text" placeholder="FLIGHT DATE" name="flight_date" autocomplete="off" class="input_blod infocus outfocus pace_name editflightdate"  data-toggle="popover" data-placement="top" data-original-title="" title="" disabled data-id="7"><img src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="..." style="margin-left: 80%;margin-top: -50%;" class="ui-datepicker-trigger1">
                                                                   <label id="flight_date7_lbll" > FLIGHT DATE</label>
                                                                   <p id="flight_date7_lbl" class="top_level">FLIGHT DATE</p>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-1 style_departure_time">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  departure_time_newbill_wrapper">
                                                                 <input type="text" id="hhdept_time7" maxlength="2" style="padding-left:10px;display:inline-block;width: 44%;" size="2" class="mini_input numeric 
                                                bill_time hhdeparturetime disable input_blod" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top" data-id="7" name="hhdept_time" ><label>DEP TIME UTC</label><span id="bill_time_lbl" class="billingtime_span"></span><div style="display:inline-block;" class="slash">:</div><input style="padding-left:5px;display:inline-block;width: 44%;" type="text" maxlength="2" size="2" class="mini_input numeric bill_time mmdeparturetime disable input_blod" id="mmdept_time7" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" data-id="7" name="mmdept_time">
                                                <span id="dept_time7_lbl" class="top_level dept_time_lbl" style="left: 10px;">20 : 30 IST</span>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-3" style="width:8%;">
                                                             <div class="ltrim_sec">
                                                               <div class="group dynamiclabel">
                                                               <input class="input_blod numbers pax disable" id="pax7" type="text" placeholder="PAX" name="pax" autocomplete="off" maxlength="2" data-toggle="popover" data-placement="top" data-id="7" readonly>
                                                               <label id="pax7_lbl">Pax</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-1 style_load">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  load_newbill_wrapper">
                                                                   <input class="input_blod numbers load border_red" id="load7" type="text" placeholder="CARGO" name="load" autocomplete="off" maxlength="3" data-toggle="popover" data-placement="top" data-original-title="" title="" data-id="7">
                                                                   <label id="load7_lbl">CARGO</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12 remarkes" style="margin-top: 20px;">
                                                       <div class="col-md-1 style_fuel">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  fuel_newbill_wrapper">
                                                                   <input class="input_blod numbers fuel border_red" maxlength="5" id="fuel7" type="text" placeholder="FUEL" name="fuel" autocomplete="off" data-toggle="popover" data-placement="top" data-original-title="" title="" data-id="7">
                                                                   <label id="fuel7_lbl"> FUEL</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="group col-md-1 amountmode_newbill_wrapper style_radio">
                                                           <div class="radio radio-custom ">
                                                               <input type="radio" name="min_max" id="min_7" value="1" data-id="7">
                                                               <label for="min_7">
                                                                   MIN
                                                               </label>
                                                           </div>
                                                           <div class="radio radio-custom ">
                                                               <input type="radio" name="min_max" id="max_7" value="2" data-id="7">
                                                               <label for="max_7">
                                                                   MAX
                                                               </label>
                                                           </div>
                                                           <div class="radio radio-custom" style="top: -52px;left: -63px;">
                                                               <input type="radio" name="min_max" id="norefuel_7" value="3" data-id="7">
                                                               <label for="norefuel_7">
                                                                   NO REFUEL
                                                               </label>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-9 style_remarks" style="width: 74%">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  remarks_newbill_wrapper">
                                                                   <input class="input_blod remarks special_symbols1" id="remarks7" type="text" placeholder="REMARKS" name="remarks" autocomplete="off" maxlength="149" data-toggle="popover" data-placement="top" data-original-title="" title="" data-id="7">
                                                                   <label id="remarks7_lbl">REMARKS</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-1">
                                                           <button  class="btn button_next_main newbtnv1" style="margin-top:-6px;" id="submit_lbl7" type="submit" name="submit">CHANGE</button>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12" >
                                                       <div class="col-md-12 new_heading1">ADDITIONAL INFO</div>
                                                   </div>
                                                   <div class="col-md-12 place_long">
                                                       <div class="col-md-3">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  operator_newbill_wrapper">
                                                                   <input class="input_blod pace_name dept_place alphabets_numbers_with_space" maxlength="25" id="dept_place7" type="text" placeholder="DEP ZZZZ PLACE NAME" name="dept_place" autocomplete="off"  data-toggle="popover" data-placement="top" data-original-title="" title="" disabled="" data-id="7">
                                                                   <label id="dept_place7_lbl">DEP ZZZZ PLACE NAME</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-3">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  operator_newbill_wrapper">
                                                                   <input class="input_blod pace_name dept_lat latlong " id="dept_lat7" type="text" placeholder="DEP ZZZZ LAT LONG" name="dept_lat" autocomplete="off" disabled="" data-toggle="popover" data-placement="top" data-original-title="" title="" data-id="7">
                                                                   <label id="dept_lat7_lbl"> DEP ZZZZ LAT LONG</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-3">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  operator_newbill_wrapper">
                                                                   <input class="input_blod dest_place pace_name alphabets_numbers_with_space" maxlength="25" id="dest_place7" type="text" placeholder="DEST ZZZZ PLACE NAME" name="dest_place" autocomplete="off" disabled="" data-toggle="popover" data-placement="top" data-original-title="" title="" data-id="7">
                                                                   <label id="dest_place7_lbl"> DEST ZZZZ PLACE NAME</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-3">
                                                           <div class="ltrim_sec">
                                                               <div class="group dynamiclabel  operator_newbill_wrapper">
                                                                   <input class="input_blod dest_lat pace_name latlong" id="dest_lat7" type="text" placeholder="DEST ZZZZ LAT LONG" name="dest_lat" autocomplete="off" disabled="" data-toggle="popover" data-placement="top" data-original-title="" title="" data-id="7">
                                                                   <label id="dest_lat7_lbl" class="dest_lat_lbl"> DEST ZZZZ LAT LONG</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                    </div> 
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>      
            </section>  
        </div>                               
    </div>
    @include('includes.new_navlog_modal')
    @include('includes.new_footer',[])
</div>
<script type="text/javascript">
    $(function(){
      autosuggest();
      function autosuggest(){
        $.ajax({
        url: '/navlog/autosuggest',
        dataType:"json",  
        success: function(result)
        {
            $(".departure,.destination").autocomplete({
                source: result,
                selectFirst: true,
                minLength: 3,
                select: function (event, ui) 
                {
                    console.log(ui);
                    closePopover("#"+$(this).attr('id'));
                    var id_no=$(this).attr('data-id');
                    setTimeout(function(){  validation(id_no); },500);
                    $.ajax({
                           context : $(this),  
                           url: '/get_airport_name',
                           dataType:"json",
                           data:{airport_code:ui.item.value},
                           success: function(result) {
                              if(result.success==true && result.airportcity!="") {
                                  $("#"+$(this).attr('id')+'_lbl').text(result.airportcity);
                              }
                               else
                              {
                                var id=$(this).attr('id');
                                if($(this).hasClass('alternate1')){
                                    $("#"+$(this).attr('id')+'_lbl').text("");
                                  }
                                else if($(this).hasClass('alternate2')){
                                    $("#"+$(this).attr('id')+'_lbl').text("");
                                  }
                                else if($(this).hasClass('take_off_alternate')){
                                   $("#"+$(this).attr('id')+'_lbl').text("");
                                  }
                                else if($(this).hasClass('departure')){
                                   $("#"+$(this).attr('id')+'_lbl').text("");
                                  }
                                else if($(this).hasClass('destination')){
                                   $("#"+$(this).attr('id')+'_lbl').text("");
                                  }  

                              }
                           }
                         });
                }
            });
        }});
     }    
    pending_cancelled_completed();    
    $('body').addClass('body_padding');    
    localStorage.setItem("test_clicked_btn", "second");
    $('body').on('show.bs.modal',"#navlog_preview, #navlog_cancel_plan, #changeplan,#edit_modal,#editplan, #navlogpending_cancel_plan,#cnfrevise,#sendficadc", function (e) {
      $('body').addClass('test');
    });
    $("#from_date, #to_date,.ui-datepicker-trigger").click(function () {
        $(".notify-bg-v").fadeIn();
        $('.notify-bg-v').css('height',0);
        $('.notify-bg-v').css('height', $(document).height());
    });
    });
    $('body').on('click', '.panel-heading', function(e){
            var id = $(this).next().attr('id');
            $(this).next().toggle(200);
            for(k = 1; k <= 6; k++){
            var accordid = 'collapse_reg' + k;
            if (id == accordid)
                    continue;
            $("#collapse_reg" + k).hide(200);
            }
    });
     $('.modal_close').click(function(){
           $('body').addClass('body_padding');
    });
    $('body').on('click', '.select dd ul li a', function(e){
        var prev_section_count = parseInt($("#accordion_reg").attr('data-prev-section-count'));
        var no_of_flight = parseInt($(this).text());
        var current_section_count = no_of_flight;
        var accordion = "", count = 1, accordion_length = 1, submit_lbl, autocomplete_count = 1, cnt = 2;
        if (no_of_flight > 1)
            $("#submit_lbl1").html("NEXT");
        else
            $("#submit_lbl1").html("SUBMIT");
        $("#no_of_flight1").text(no_of_flight);
        $("#accordion_reg").attr('data-prev-section-count', current_section_count);
        if (current_section_count > prev_section_count)
        {
            remaining_section_count = current_section_count - prev_section_count;
            count = prev_section_count;
            autocomplete_count = prev_section_count;
            if (parseInt(prev_section_count) > 1)
                    $("#submit_lbl" + prev_section_count).text('NEXT');
        }
        else{
            for (var j = prev_section_count; j > current_section_count; j--){
             $("#accord" + j).remove();
            }
        $(".no_of_flight").text(no_of_flight);
        $("#submit_lbl" + no_of_flight).text('SUBMIT');
     }
    for (var i = prev_section_count; i < current_section_count; i++){
        if (i == no_of_flight - 1)
           submit_lbl = 'SUBMIT';
       else
       submit_lbl = 'NEXT';
    count++; cnt++;
    accordion = accordion + `<div class="panel panel-default"  id="accord${count}" data-slidecount="${count}" style="display:none">
            <div class="panel-heading" role="tab" id="heading_reg${count}">
               <h4 class="panel-title collapsed title_header" id="accord1">
                  <a class="title_navlog">
                  TEST NAV LOG # ${count}
                  </a>
               </h4>
            </div>
            <div id="collapse_reg${count}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_reg${count}">
               <div class="panel-body">
                  <form action="{{url('navlog_test')}}" method="POST" class="navlog" >
                     {{csrf_field()}}
                     <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                     <input type="hidden" name="section" value="navlog${count}">
                     <input type="hidden" name="plan_status" value=1>
                     <input type="hidden" name="live_test_mode" value=2>
                     <div class="col-md-12">
                        <span class="no_of_flights">NO OF FLIGHTS</span>
                     </div>
                     <div class="col-md-12 sub_new_heading" style="margin-top: 10px;">
                        <div class="col-md-1" style="width:8%;margin-top:-2px;">
                           <div class="form-group">
                              <dl id="hour${count}" class="form-control validation_class_click select flight_no" style="height: 27px;padding:5px 0px 0px 0px;"  data-toggle="popover
                                 "  data-placement="top" data-id="${count}">
                                 <dt ><a>
                                    <span style="font-weight:bold;font-size:14px" readonly id="no_of_flight${count}" id="no_of_flight1" class="no_of_flight">${no_of_flight}</span>
                                    </a>
                                 </dt>
                                 <dd >
                                    <ul>
                                       <li><a>1</a></li>
                                       <li><a>2</a></li>
                                       <li><a>3</a></li>
                                       <li><a>4</a></li>
                                       <li><a>5</a></li>
                                       <li><a>6</a></li>
                                    </ul>
                                 </dd>
                              </dl>
                           </div>
                        </div>
                        <div class="col-md-1 style_registration">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel  operator_newbill_wrapper">
                                 <input  class="input_blod special_symbols callsign pace_name" id="callsign${count}" type="text" placeholder="CALL SIGN" name="callsign" autocomplete="off" maxlength="7" data-toggle="popover" data-placement="top" readonly data-id="${count}">
                                 <label id="callsign${count}_lbl"> CALL SIGN</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-xs-6 style_registration1" style="padding-left:15px;">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel  operator_newbill_wrapper">
                                    <input  class="input_blod special_symbols aircraft border_red disable pace_name" id="aircraft${count}" type="text" placeholder="REGISTRATION" name="registration" autocomplete="off" maxlength="7"  data-toggle="popover" data-placement="top" data-id="${count}" readonly>
                                    <label id="aircraft${count}_lbl">REGISTRATION</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-1 style_departure">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel departure_newbill_wrapper">
                                 <input class="input_blod alphabets departure pace_name" id="departure${count}" type="text" placeholder="DEPARTURE" name="departure" autocomplete="off"  maxlength="4" data-toggle="popover" data-placement="top" readonly data-id="${count}">
                                   <label>DEPARTURE</label>
                                 <p class="top_level departure_lbl" id="departure${count}_lbl"></p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-1 style_destination">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel destination_newbill_wrapper">
                                 <input style="border-radius:0;" class="input_blod  alphabets destination border_red" id="destination${count}" maxlength="4"  type="text" placeholder="DESTINATION" name="destination" autocomplete="off" data-toggle="popover" data-placement="top" data-id="${count}">
                                 <label>DESTINATION</label>
                                 <p id="destination${count}_lbl" class="destination_lbl top_level"></p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-1 style_date">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel  flightdate_newbill_wrapper">
                                 <input id="flight_date${count}" type="text" placeholder="FLIGHT DATE" name="flight_date" autocomplete="off" class="input_blod infocus outfocus ui-datepicker-trigger flightdate" readonly data-toggle="popover" data-placement="top" data-id="${count}">
                                  <label id="flight_date${count}_lbll"> FLIGHT DATE</label>
                                  <p id="flight_date${count}_lbl" class="top_level">FLIGHT DATE</p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-1 col-sm-2 col-xs-6 style_departure_time fakeinput_wrapper">
                            <div class="ltrim_sec">
                                <div class="group dynamiclabel fakeinput">
                                    <input type="text" id="hhdept_time${count}" maxlength="2" style="padding-left:10px;display:inline-block;width: 44%;" size="2" class="mini_input numeric 
                                    bill_time hhdeparturetime disable input_blod" autocomplete="off" placeholder="HH" data-toggle="popover" data-placement="top" data-id="${count}" name="hhdept_time"/><label>DEP TIME UTC</label><span id="bill_time_lbl" class="billingtime_span"></span><div style="display:inline-block;" class="slash">:</div><input style="padding-left:5px;display:inline-block;width: 44%;" type="text" maxlength="2" size="2" class="mini_input numeric bill_time mmdeparturetime disable input_blod" id="mmdept_time${count}" placeholder="MM" autocomplete="off" data-toggle="popover" data-placement="top" data-id="${count}" name="mmdept_time" data-id="${count}"/>
                                    <span id="dept_time${count}_lbl" class="top_level dept_time_lbl" style="left: 10px;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="width:8%;">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel">
                                 <input class="input_blod numbers pax disable" id="pax${count}" type="text" placeholder="PAX" name="pax" autocomplete="off" maxlength="2" data-toggle="popover" data-placement="top" data-id="${count}" readonly>
                                 <label id="pax${count}_lbl" >PAX</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-1 style_load">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel  load_newbill_wrapper">
                                 <input class="input_blod numbers load" id="load${count}" type="text" placeholder="CARGO" name="load" autocomplete="off" maxlength="3" data-toggle="popover" data-placement="top" data-id="${count}">
                                 <label id="load${count}_lbl">CARGO</label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12" style="margin-top: 15px;">
                        <div class="col-md-1 style_fuel">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel  fuel_newbill_wrapper">
                                 <input class="input_blod numbers fuel" maxlength="5" id="fuel${count}" type="text" placeholder="FUEL" name="fuel" autocomplete="off" maxlength="5" data-toggle="popover" data-placement="top" data-id="${count}">
                                 <label id="fuel${count}_lbl">FUEL</label>
                              </div>
                           </div>
                        </div>
                        <div class="group col-md-1 amountmode_newbill_wrapper style_radio" >
                            <div class="radio radio-custom ">
                                <input type="radio" name="min_max" id="min_${count}" value="1" data-id="${count}">
                                <label for="min_${count}">
                                    MIN
                                </label>
                            </div>
                            <div class="radio radio-custom ">
                                <input type="radio" name="min_max" id="max_${count}" value="2" data-id="${count}">
                                <label for="max_${count}">
                                    MAX
                                </label>
                            </div>
                            <div class="radio radio-custom" style="top: -52px;left:-61px;">
                                <input type="radio" name="min_max" id="norefuel_${count}" value="3" data-id="${count}">
                                <label for="norefuel_${count}">
                                    NO REFUEL
                                </label>
                            </div>
                        </div>
                        <div class="col-md-8 style_remarks" style="width: 68%;">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel  remarks_newbill_wrapper">
                                 <input class="input_blod remarks special_symbols1" id="remarks${count}" type="text" placeholder="REMARKS" name="remarks" autocomplete="off" maxlength="149" data-toggle="popover" data-placement="top">
                                 <label id="remarks${count}_lbl" data-id="${count}">REMARKS</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2" style="padding-left: 0px;">
                          <button data-toggle="" data-parent="#accordion_reg" href="#collapse_reg${cnt}" aria-expanded="true" aria-controls="collapse_reg${cnt}" class="btn footer-send btn_send_f01 newbtn mfProgress newbtnv1" style="margin-top:-6px;width:115px !important;font-size: 15px !important;" id="submit_lbl${count}" type="submit" name="submit" disabled>${submit_lbl}</button>
                        </div>
                     </div>
                     
                     <div class="col-md-12" >
                        <div class="col-md-12 new_heading1">ADDITIONAL INFO</div>
                     </div>
                     <div class="col-md-12 place_long" style="margin-bottom: 10px;">
                        <div class="col-md-3">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel  operator_newbill_wrapper">
                                 <input class="input_blod  pace_name dept_place alphabets_numbers_with_space" maxlength="25" id="dept_place${count}" type="text" placeholder="DEP ZZZZ PLACE NAME" name="dept_place" autocomplete="off" disabled  data-toggle="popover" data-placement="top">
                                 <label id="dept_place${count}_lbl">DEP ZZZZ PLACE NAME</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel  operator_newbill_wrapper">
                                 <input class="input_blod  pace_name dept_lat latlong" id="dept_lat${count}" type="text" placeholder="DEP ZZZZ LAT LONG" name="dept_lat" autocomplete="off" disabled  data-toggle="popover" data-placement="top">
                                 <label id="dept_lat${count}_lbl"> DEP ZZZZ LAT LONG</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel  operator_newbill_wrapper">
                                 <input class="input_blod dest_place alphabets_numbers_with_space pace_name" maxlength="25" id="dest_place${count}" type="text" placeholder="DEST ZZZZ PLACE NAME" name="dest_place" autocomplete="off" disabled  data-toggle="popover" data-placement="top">
                                 <label id="dest_place${count}_lbl"> DEST ZZZZ PLACE NAME</label>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="ltrim_sec">
                              <div class="group dynamiclabel  operator_newbill_wrapper">
                                 <input class="input_blod dest_lat latlong pace_name" id="dest_lat${count}" type="text" placeholder="DEST ZZZZ LAT LONG" name="dest_lat" autocomplete="off" disabled  data-toggle="popover" data-placement="top">
                                 <label id="dest_lat${count}_lbl"> DEST ZZZZ LAT LONG</label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>`;

    }
    $("#accordion_reg").append(accordion);
     for(var i=prev_section_count; i<current_section_count;i++){
       var temp=true;
       autocomplete_count++;
       $.ajax({
       url: '/navlog/autosuggest',
       dataType:"json",  
       success: function(result)
       {
           $(".departure,.destination").autocomplete({
               source: result,
               selectFirst: true,
               minLength: 3,
               select: function (event, ui) 
               {
                   console.log(ui);
                   closePopover("#"+$(this).attr('id'));
                   var id_no=$(this).attr('data-id');
                   setTimeout(function(){  validation(id_no); },500);
                   $.ajax({
                          context : $(this),  
                          url: '/get_airport_name',
                          dataType:"json",
                          data:{airport_code:ui.item.value},
                          success: function(result) {
                             if(result.success==true && result.airportcity!="") {
                                 $("#"+$(this).attr('id')+'_lbl').text(result.airportcity);
                             }
                              else
                             {
                               var id=$(this).attr('id');
                               if($(this).hasClass('alternate1')){
                                   $("#"+$(this).attr('id')+'_lbl').text("");
                                 }
                               else if($(this).hasClass('alternate2')){
                                   $("#"+$(this).attr('id')+'_lbl').text("");
                                 }
                               else if($(this).hasClass('take_off_alternate')){
                                  $("#"+$(this).attr('id')+'_lbl').text("");
                                 }
                               else if($(this).hasClass('departure')){
                                  $("#"+$(this).attr('id')+'_lbl').text("");
                                 }
                               else if($(this).hasClass('destination')){
                                  $("#"+$(this).attr('id')+'_lbl').text("");
                                 }  

                             }
                          }
                        });
               }
           });
       }});  
       $("#pax"+autocomplete_count).autocomplete({
           minLength: 0,
           source: function (request, response) {
               $.ajax({
                       url: base_url + "/get_pax_no",
                       dataType:"json",
                       
                       headers: {
                       'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                       },
                       data:{callsign:$(this.element).parents('.panel').find('.callsign').val()},
                       success: function(data)
                       {
                           response(data);
                       }
                     });
           },
           select: function (event, ui) {   
             closePopover('#pax'+$(this).attr('data-id'))
             var id_no=$(this).attr('data-id');
             $("#load"+id_no).focus();
             setTimeout(function(){  validation(id_no); },500);  
       
           }
       }).click(function () {
           $("#pax"+autocomplete_count).autocomplete('search',$(this).val());
       }).focus(function(){
           $("#pax1"+autocomplete_count).autocomplete('search',$(this).val());
       });
     }
        $(".flightdate").datepicker({
             dateFormat: 'dd-M-yy',
             minDate: 0, 
             showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
             onSelect: function(selectedDate) 
             {   
                 var accordion_index=$(this).attr('id').substr(11,1);
                 var id_no=$(this).attr('data-id');
                 validation(id_no); 
                 var next_accordion_index=parseInt(accordion_index)+1;
                 $('#flight_date'+next_accordion_index).val(selectedDate);
                 $('#flight_date'+next_accordion_index).datepicker("option",{ minDate: new Date(selectedDate)});
                 $("#"+$(this).attr('id')+'_lbl').css('display','block');
                 $("#"+$(this).attr('id')+'_lbll').css('display','block');
                 closePopover("#"+$(this).attr('id'))
                 $("#"+$(this).attr('id')+'_lbl').removeClass('hide');
                 $(".notify-bg-v").fadeOut();
             }
         });
        for (var i = prev_section_count+1; i < current_section_count; i++){
           var now=new Date();
           var currentTime = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(),  now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds(), now.getUTCMilliseconds());
           var hours = currentTime.getHours()+1;
           var minutes = currentTime.getMinutes();
           if(minutes>=0 && minutes<=30){
              minutes=0;
           }
           else if(minutes>=31 && minutes<=59){
             minutes=30;
           }  
           if (minutes < 10) {
               minutes = "0" + minutes;
           }
           if (hours < 10) {
               hours = "0" + hours;
           }
           $("#hhdept_time"+i).val(hours);
           $("#mmdept_time"+i).val(minutes);
           var time=calculate_ist(hours,minutes)
           $("#dept_time"+i+"_lbl").html(time);
         }
      });
     function time1(i){
         var now=new Date();
         var currentTime = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(),  now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds(), now.getUTCMilliseconds());

         var hours = currentTime.getHours()+1;
         var minutes = currentTime.getMinutes();
         console.log('Hours ='+hours+'Minute='+minutes);
         if(minutes>=0 && minutes<=30){
            minutes=0;
         }
         else if(minutes>=31 && minutes<=59){
           minutes=30;
         }  
         if (minutes < 10) {
             minutes = "0" + minutes;
         }
         if (hours < 10) {
             hours = "0" + hours;
         }
         $("#hhdept_time"+i).val(hours);
         $("#mmdept_time"+i).val(minutes);
         var time=calculate_ist(hours,minutes)
         $("#dept_time"+i+"_lbl").html(time);
     }
     time1(1);  
     $(".auto_operator").autocomplete({
         minLength: 2,
         source: function (request, response) {
             $.ajax({
                 type: "GET",
                 url: base_url + "/Admin/user/auto_operator",
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
             if ((ui.item.value == '') || (ui.item.value.length <= '1')) {

             } else {

             }
         }
     });
     $(document).bind('click', function(e) {
         var $clicked = $(e.target);
         if (!$clicked.parents().hasClass("flight_no")) $(".flight_no dd ul").hide();
         if (!$clicked.parents().hasClass("dlcabin")) $(".dlcabin dd ul").hide();
         if (!$clicked.parents().hasClass("Paxrules")) $(".Paxrules dd ul").hide();
         if (!$clicked.parents().hasClass("speeddl")) $(".speeddl dd ul").hide();
     });
     $('body').on('click', '.flight_no dt a', function(){
        if($("#no_of_flight1").text()!="SELECT")
         return false;
        var id=$(this).parents('.panel').find('.flight_no').attr('id');
        $('.Paxrules dd ul').css('display','none');
        $('.dlcabin dd ul').css('display','none');
        $('.speeddl dd ul').css('display','none');
        $("#"+id+' dd ul').toggle();
     });
     $('body').on('click', '.flight_no dd ul li a', function(){
        $(".no_of_flight").addClass('pace_name1');  
        var text = $(this).html();
        var id=$(this).parents('.panel').find('.flight_no').attr('id');
        closePopover("#"+id);
        $('.flight_no dt a span').html(text).css({'font-weight':'bold','font-size':'14px'});
         $('.flight_no').css({'padding':'6px 0px 0px'});
        $("#"+id+' dd ul').toggle();
        // if($(this).parents('.panel').find('.callsign').val().length>=5)
        // { 
        //  select_pax_no($(this).parents('.panel').find('.callsign').val(),$(this));
        // }
        var id_no=$(this).parents(".flight_no").attr('data-id');
        validation(id_no);
     });    
     $('body').on('click', '.Paxrules dt a', function(){
        var id=$(this).parents('.panel').find('.Paxrules').attr('id');
        $("#"+id+' dd ul').toggle();
        $('.flight_no dd ul').css('display','none');
        $('.dlcabin dd ul').css('display','none');
        $('.speeddl dd ul').css('display','none');
     });
     $('body').on('click', '.Paxrules dd ul li a', function(){
        var text = $(this).html();
        var id=$(this).parents('.panel').find('.Paxrules').attr('id');
        $("#"+id+'_lbl').removeClass('hide');
        closePopover("#"+id);
        $('#'+id+' dt a span').html(text).css({'font-weight':'bold','font-size':'14px','line-height':'1.2'});
        $("#"+id+' dd ul').toggle();
     });     
     $('body').on('click', '#speed6 dd ul li a', function(){
         var text = $(this).html();
        $("#speed6 dt a span").html(text);
        $("#speed6 dd ul").hide();
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
         $('body').on('focus', '.dept_place,.dest_place', function(){
         $(this).autocomplete({
          source: base_url + "/fpl/stations_autocomplete",
          minLength: 2,
          select: function(event, ui) {
              var data = $(this).val(ui.item.value);
              var data_url = base_url + "/fpl/station_latlong";
              if ($(this).hasClass('dept_place')) {  
                  if ((ui.item.value == '') || (ui.item.value.length <'3')) {
                     errorPopover("#"+$(this).parents('.panel').find('.dept_place').attr('id'),'Min. 3 & Max. 25 Characters, only Alphabets allowed');
                  } else {
                       closePopover("#"+$(this).parents('.panel').find('.dept_place').attr('id'));
                  }
                  fetch_departure_latlong(ui.item.value, data_url,$(this));
                  // var id_no=$(this).attr('data-id');
                  // setTimeout(function(){  validation(id_no); },500);
              } else if ($(this).hasClass('dest_place')) {
                  if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                      errorPopover("#"+$(this).parents('.panel').find('.dest_place').attr('id'),'Min. 3 & Max. 25 Characters, only Alphabets allowed');
                  } else {
                      closePopover("#"+$(this).parents('.panel').find('.dest_place').attr('id'));
                  }
                  fetch_destination_latlong(ui.item.value,data_url,$(this));
                  var id_no=$(this).attr('data-id');
                  setTimeout(function(){  validation(id_no); },500);
              }
              //var id_no=$(this).attr('data-id');
              //setTimeout(function(){  validation(id_no); },500);
          }
      });
      }); 
      function fetch_departure_latlong(stationname, base_url,thi) {
          $.ajax({
              type: "POST",
              url: base_url,
              data: { "station_name": stationname },
              headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
              success: function(result) {
                  var latlongvalue = result.stationlatlong;
                  thi.parents('.panel').find('.dept_lat').val(latlongvalue);
                  var id_no=thi.attr('data-id');
                  validation(id_no);
                  $("#"+thi.parents('.panel').find('.dept_lat').attr('id')+'_lbl').css('display','block');  
                  if ((latlongvalue == '') || (parseInt(latlongvalue.length) <11)) {
                      errorPopover("#"+thi.parents('.panel').find('.dept_lat').attr('id'),'Min. 11 & Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1257N07739E or BBG353020)')

                  } else {
                      closePopover("#"+thi.parents('.panel').find('.dept_lat').attr('id'));
                  }
              }
          });
      }
      function fetch_destination_latlong(stationname,base_url,thi) {
          $.ajax({
              type: "POST",
              url: base_url,
              data: { "station_name": stationname },
              headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
              success: function(result) {
                  var latlongvalue = result.stationlatlong;
                  thi.parents('.panel').find('.dest_lat').val(latlongvalue);
                  var id_no=thi.attr('data-id');
                  validation(id_no);
                  $("#"+thi.parents('.panel').find('.dest_lat').attr('id')+'_lbl').css('display','block');
                  if ((latlongvalue == '') || (parseInt(latlongvalue.length) <11)) {
                      errorPopover("#"+thi.parents('.panel').find('.dest_lat').attr('id'),'Min. 11 & Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1257N07739E or BBG353020)')

                  } else {
                      closePopover("#"+thi.parents('.panel').find('.dest_lat').attr('id'));
                  }
              }
          });
       }
      $("#pax1").autocomplete({
          minLength: 0,
          source: function (request, response) {
              $.ajax({
                      url: base_url + "/get_pax_no",
                      dataType:"json",
                      
                      headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      },
                      data:{callsign:$(this.element).parents('.panel').find('.callsign').val()},
                      success: function(data)
                      {
                          response(data);
                      }
                    });
          },
          select: function (event, ui) {
                
            closePopover('#pax1')
            var id_no=$(this).attr('data-id');
            $("#load"+id_no).focus();
            setTimeout(function(){  validation(id_no); },500);  
      
          }
      }).click(function () {
          $("#pax1").autocomplete('search',$(this).val());
      }).focus(function(){
          $("#pax1").autocomplete('search',$(this).val());
      });
      $("#pax7").autocomplete({
          minLength: 0,
          source: function (request, response) {
              $.ajax({
                      url: base_url + "/get_pax_no",
                      dataType:"json",
                      
                      headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      },
                      data:{callsign:$(this.element).parents('.panel').find('.callsign').val()},
                      success: function(data)
                      {
                          response(data);
                      }
                    });
          },
          select: function (event, ui) {
            
            closePopover('#pax7');
            var id_no=$(this).attr('data-id');
            $("#load"+id_no).focus();
            setTimeout(function(){  validation(id_no); },500);  
      
          }
      }).click(function () {
          $("#pax7").autocomplete('search',$(this).val());
      }).focus(function(){
          $("#pax7").autocomplete('search',$(this).val());
      }); 
      $(document).on("keyup",".callsign",function(e){  
          if($(this).val().length >=5){ 
             var callsign_id=$(this).attr('id');
             var callsign=$(this).val();
             var callsign_2digit=$(this).val().substr(0,2);
             var dept="";
             
            var air_craft=$(this).val().substr(0,5);             
            $(this).parents('.panel').find('.aircraft').val(air_craft).removeClass('border_red').css({'border-color':'#777'});
             closePopover('#aircraft1'); 
             $(this).parents('.panel').find('.departure').focus();
          }

          if($(this).val().length>=5){
              closePopover("#"+$(this).attr('id'));
              //pax_no($(this).val(),$(this));
          }
         var id_no=$(this).attr('data-id');
         validation(id_no); 
      });
      $(document).on("blur",".callsign",function(e){ 
          if($(this).val().length <5){
            errorPopover("#"+$(this).attr('id'),"Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
          }  
      });
      $(document).on("keyup",".aircraft",function(e){  
          if($(this).val().length == 5 || $(this).val().length == 7)
          { 
             $(this).parents('.panel').find('.departure').focus();
             closePopover("#"+$(this).parents('.panel').find('.aircraft').attr('id'));
          }
          var id_no=$(this).attr('data-id');
          validation(id_no);   
      });
      $(document).on("blur",".aircraft",function(e){ 
          if($(this).val().length <5){  
            errorPopover("#"+$(this).attr('id'),"Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
          }  
      });
      $(document).on("keyup",".departure",function(e){
          if($(this).val().length == 4)
              closePopover("#"+$(this).attr('id'));
              if(($(this).val()=="ZZZZ" && $(this).val().length == 4)||($(this).val()=="zzzz" && $(this).val().length == 4)){
                $(this).parents('.panel').find('.dept_place').removeClass('pace_name');
                $(this).parents('.panel').find('.dept_lat').removeClass('pace_name');
                $(this).parents('.panel').find('.dept_place').attr('disabled',false).focus().addClass('border_red');
                $(this).parents('.panel').find('.dept_lat').attr('disabled',false).addClass('border_red');
              }
              else if(($(this).val() !="ZZZZ" && $(this).val().length == 4)||($(this).val()!="zzzz" && $(this).val().length == 4)){  
                  $(this).parents('.panel').find('.destination').focus();
              }
              else if($(this).val() !="ZZZZ" || $(this).val()!="zzzz"){  
                 $(this).parents('.panel').find('.dept_place').val('').attr('disabled',true).addClass('pace_name');
                 $(this).parents('.panel').find('.dept_lat').val('').attr('disabled',true).addClass('pace_name');
                 closePopover("#"+$(this).parents('.panel').find('.dept_place').attr('id'));
                 closePopover("#"+$(this).parents('.panel').find('.dept_lat').attr('id'));
              }
             if($(this).val()=="ZZZ" || $(this).val()=="zzz" || $(this).val().length==4){
                 $(this).attr('maxlength',4);
             }
             else
                $(this).attr('maxlength',3); 
             var id_no=$(this).attr('data-id');
              validation(id_no); 
      });
      $(document).on("blur",".departure",function(e){ 
          if($(this).val().length <4){  
            errorPopover("#"+$(this).attr('id'),"Min. 4 & Max. 4 Characters, only Alphabets allowed");
          }  
      });
      $(document).on("keyup",".destination",function(e){   
          if($(this).val().length ==4)
              closePopover("#"+$(this).attr('id'));

              if(($(this).val()=="ZZZZ" && $(this).val().length == 4)||($(this).val()=="zzzz" && $(this).val().length == 4)){
                $(this).parents('.panel').find('.dest_place').removeClass('pace_name');
                $(this).parents('.panel').find('.dest_lat').removeClass('pace_name');
                $(this).parents('.panel').find('.dest_place').attr('disabled',false).focus().addClass('border_red');
                $(this).parents('.panel').find('.dest_lat').attr('disabled',false).addClass('border_red');
              }
              else if(($(this).val() !="ZZZZ" && $(this).val().length == 4)||($(this).val()!="zzzz" && $(this).val().length == 4)){ 
                 $(this).parents('.panel').find('.dest_place').val('').attr('disabled',true).addClass('pace_name');
                 $(this).parents('.panel').find('.dest_lat').val('').attr('disabled',true).addClass('pace_name');
                 $(".notify-bg-v").fadeIn();
                 $('.notify-bg-v').css('height',0);
                 $('.notify-bg-v').css('height', $(document).height());
                 $(this).parents('.panel').find('.flightdate').focus();
              }
              else if($(this).val() !="ZZZZ" || $(this).val()!="zzzz"){  
                 $(this).parents('.panel').find('.dest_place').val('').attr('disabled',true).addClass('pace_name');
                 $(this).parents('.panel').find('.dest_lat').val('').attr('disabled',true).addClass('pace_name');
                 closePopover("#"+$(this).parents('.panel').find('.dest_place').attr('id'));
                 closePopover("#"+$(this).parents('.panel').find('.dest_lat').attr('id')); 
              }
             if($(this).val()=="ZZZ" || $(this).val()=="zzz" || $(this).val().length==4){
                 $(this).attr('maxlength',4);
             }
             else
                $(this).attr('maxlength',3); 
             var id_no=$(this).attr('data-id');
             validation(id_no);     
      });
       $(document).on("blur",".destination",function(e){ 
          if($(this).val().length <4){  
            errorPopover("#"+$(this).attr('id'),"Min. 4 & Max. 4 Characters, only Alphabets allowed");
          }  
      });  
       $(document).on("keyup",".pax",function(e){ 
          if($(this).val().length ==3){   
            $(this).parents('.panel').find('.load').focus();
          }  
      });
        $(document).on("keyup",".fuel",function(e){ 
          $(this).parents('.panel').find('input[name=min_max]').attr('checked',false);    
          if($(this).val().length >=3 || $(this).val()==""){   
            closePopover("#"+$(this).attr('id'));
          }
             var id_no=$(this).attr('data-id');
              validation(id_no); 
      });
        $(document).on("blur",".fuel",function(e){  
          if(($(this).val()!="" && $(this).parents('.panel').find($("input[name='min_max']")).is(':checked')==false)||($(this).val().length>=1 && $(this).val().length<3)){   
            errorPopover("#"+$(this).attr('id'),"Min. 3 & Max. 5 Characters, only Numbers allowed");
          } 
          if($(this).val().length >=3){   
             var max_fuel=max_fuel_check($(this).val(),$(this).parents('.panel').find('.callsign').val(),$(this));
              if((parseInt(max_fuel)<parseInt($(this).val())) && $(this).val()!="")
                 errorPopover('#'+$(this).attr('id'),"Max Fuel Should be less than "+max_fuel);
              else if($(this).val().length >=3 || $(this).val()=="")
                closePopover('#'+$(this).attr('id'));
          }
      });  
      $(document).on("keyup",".load",function(e){ 
          if($(this).val().length >=2 || $(this).val()=="")
            closePopover("#"+$(this).attr('id')); 
          if($(this).val().length ==3){   
            $(this).parents('.panel').find('.fuel').focus();
          }  
          var id_no=$(this).attr('data-id');
          validation(id_no); 
      });
      $(document).on("blur",".load",function(e){ 
           if($(this).val().length>0 && $(this).val().length<2){  
             errorPopover("#"+$(this).attr('id'),"Min. 2 & Max. 3 Characters, only Numbers allowed");
           }  
      }); 
      $(document).on("blur",".dept_place",function(e){ 
          if(($(this).parents('.panel').find('.departure').val()=="zzzz"||$(this).parents('.panel').find('.departure').val()=="ZZZZ")&&($(this).val().length<3)){
             errorPopover("#"+$(this).attr('id'),"Min. 3 & Max. 25 Characters, only Alphabets and Number allowed");
           }  
      });
      $(document).on("keyup",".dept_place",function(e){ 
          if(($(this).parents('.panel').find('.departure').val()=="zzzz"||$(this).parents('.panel').find('.departure').val()=="ZZZZ")&&($(this).val().length>=3)){
             closePopover("#"+$(this).attr('id'));
           }
           var id_no=$(this).attr('data-id');
           validation(id_no);   
      });
      $(document).on("blur",".dept_lat",function(e){ 
          if(($(this).parents('.panel').find('.departure').val()=="zzzz"||$(this).parents('.panel').find('.departure').val()=="ZZZZ")&&($(this).val().length<11)){
             errorPopover("#"+$(this).attr('id'),"Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)");
           }  
      });
      $(document).on("keyup",".dept_lat",function(e){ 

          if($(this).val().length==4)
              $($(this).val($(this).val()+'N'));
          if($(this).val().length==10)
              $($(this).val($(this).val()+'E'));
          if(($(this).parents('.panel').find('.departure').val()=="zzzz"||$(this).parents('.panel').find('.departure').val()=="ZZZZ")&&($(this).val().length>=11)){
             closePopover("#"+$(this).attr('id'));
           }
          var id_no=$(this).attr('data-id');
          validation(id_no);   
      });

      $(document).on("blur",".dest_place",function(e){ 
          if(($(this).parents('.panel').find('.destination').val()=="zzzz"||$(this).parents('.panel').find('.destination').val()=="ZZZZ")&&($(this).val().length<3)){
             errorPopover("#"+$(this).attr('id'),"Min. 3 & Max. 25 Characters, only Alphabets and Number allowed");
           }   
      });
      $(document).on("keyup",".dest_place",function(e){ 
          if(($(this).parents('.panel').find('.destination').val()=="zzzz"||$(this).parents('.panel').find('.destination').val()=="ZZZZ")&&($(this).val().length>=3)){
             closePopover("#"+$(this).attr('id'));
           }  
           var id_no=$(this).attr('data-id');
           validation(id_no); 
      });
      $(document).on("blur",".dest_lat",function(e){ 

          if(($(this).parents('.panel').find('.destination').val()=="zzzz"||$(this).parents('.panel').find('.destination').val()=="ZZZZ")&&($(this).val().length<11)){
             errorPopover("#"+$(this).attr('id'),"Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)");
           }  
      });
      $(document).on("keyup",".dest_lat",function(e){ 
           if($(this).val().length==4)
               $($(this).val($(this).val()+'N'));
           if($(this).val().length==10)
               $($(this).val($(this).val()+'E'));
          if(($(this).parents('.panel').find('.destination').val()=="zzzz"||$(this).parents('.panel').find('.destination').val()=="ZZZZ")&&($(this).val().length>=11)){
             closePopover("#"+$(this).attr('id'));
           }
          var id_no=$(this).attr('data-id');
          validation(id_no);   
      });
      $(document).on("keyup",".remarks",function(e){ 
          if($(this).val().length >=3 || $(this).val()==""){   
            closePopover("#"+$(this).attr('id'));
          }
          var id_no=$(this).attr('data-id');
          validation(id_no);   
      });  
      $(document).on("blur",".remarks",function(e){ 
          if($(this).val().length>=1 && $(this).val().length<3){   
            errorPopover("#"+$(this).attr('id'),"Min. 3 & Max. 150 character allowed");
          }  
      });  
      $(document).on("change","input:radio",function(e){    
            $(this).parents('.panel').find('.fuel').val('');
            closePopover("#"+$(this).parents('.panel').find('.fuel').attr('id'));
      });       
      $(document).on("keypress",".latlong",function(e){
        if(($(this).val().length>=0 && $(this).val().length<=3 && (e.charCode >= 48 && e.charCode <= 57))||($(this).val().length==4 && (e.charCode == 110||e.charCode == 78))||($(this).val().length==10 && (e.charCode == 101 || e.charCode == 69))||($(this).val().length>=5 && $(this).val().length<=9 && (e.charCode >= 48 && e.charCode <= 57))){
          return true;
        }
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
             if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) ||(e.charCode==0)||(e.charCode==32))
             return true;
             else
             return false; 
      });
      $(document).on("keypress",".alphabets",function(e){
             if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0))
             return true;
             else
             return false; 
      });
      $(document).on("keypress",".alphabets_with_space",function(e){
              if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode==0)|| (e.charCode==32))
              return true;
              else
              return false; 
      });
      $(document).on("keypress",".numbers_colon",function(e){  
            if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode > 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
            return false;
            else
            return true;    
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
    function pax_no(callsign,thi)
      {
        $.ajax({
               context : thi,  
               url: '/get_pax_no',
               dataType:"json",
               data:{callsign:callsign},
               success: function(result) {
                 var current_accord=$(thi).parents('.panel').attr('data-slidecount');
                 for(var j=parseInt(current_accord);j<=6;j++){
                   $("#ddpax"+j).empty();
                   $("#rules"+j+"_lbl").addClass('hide');
                   $("#pax_value"+j).text('PAX').css({'font-weight':'normal','font-size':'12px','line-height':'1.5'});
                 }  
                 if(result.success==true && result.data!=null) {
                   var str=`<ul  style='width: 40px !important; display: none;'>`;
                   for(var i=0;i<=result.data.max_pax;i++){
                     str+=`<li><a>${i}</a></li>`;
                    }
                   str+=`</ul>`
                   for(var j=parseInt(current_accord);j<=6;j++){
                        $("#ddpax"+j).append(str);
                        if(result.data.max_pax>14)
                          $("#rules"+j).addClass('paxdl');
                        else
                          $("#rules"+j).removeClass('paxdl');

                    }    
                  }
               }
             });
      } 
      function select_pax_no(callsign,thi)
        {
          $.ajax({
                 context : thi,  
                 url: '/get_pax_no',
                 dataType:"json",
                 data:{callsign:callsign},
                 success: function(result) {
                   var current_accord=$(thi).parents('.panel').attr('data-slidecount');
                   if(result.success==true && result.data!=null) {
                     var str=`<ul  style='width: 40px !important; display: none;'>`;
                     for(var i=0;i<=result.data.max_pax;i++){
                       str+=`<li><a>${i}</a></li>`;
                      }
                     str+=`</ul>`
                     for(var j=parseInt(current_accord);j<=6;j++){
                          if($("#pax_value"+j).text()!='PAX')
                            continue;
                          $("#ddpax"+j).empty();
                           $("#rules"+j+"_lbl").addClass('hide');
                          $("#pax_value"+j).text('PAX').css({'font-weight':'normal','font-size':'12px','line-height':'1.5'});
                          $("#ddpax"+j).append(str);
                          if(result.data.max_pax>14)
                            $("#rules"+j).addClass('paxdl');
                          else
                            $("#rules"+j).removeClass('paxdl');

                      }    
                    }
                 }
               });
        } 
    function max_fuel_check(fuel, callsign)
    {
    var max_fuel_res;
    $.ajax({
    async: false,
            context : this,
            url: '/get_max_fuel',
            dataType:"json",
            data:{callsign:callsign},
            success: function(result) {
            if (result.success == true) {
            max_fuel_res = result.data.max_fuel;
                }
            }

    });
    return max_fuel_res;
    }
    $(".flightdate").datepicker({
            dateFormat: 'dd-M-yy',
            minDate: 0, 
            maxDate: "+3months",
            showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
            onSelect: function(selectedDate) 
            {  
                $('#flight_date2').val(selectedDate);
                $('#flight_date2').datepicker("option",{ minDate: new Date(selectedDate)});
                var id=$(this).attr('id');
                $("#"+id+'_lbl').css('display','block');
                $("#"+id+'_lbll').css('display','block');
                closePopover("#"+$(this).attr('id'));
                $(".notify-bg-v").fadeOut();
                 var id=$(this).attr('id');
                 var data_id=$(this).attr('data-id');
                 var dept_time=$("#hhdept_time"+data_id).val()+$("#mmdept_time"+data_id).val();
                 $("#hhdept_time"+data_id).focus();
                 if(dept_time!="" && dept_time.length==4)
                 {   
                     var result =CheckDeptTime($("#hhdept_time"+data_id).val(),$("#mmdept_time"+data_id).val(),$(this).parents('.panel').attr('data-slidecount'),$(this).datepicker('getDate'));
                    if(result.utc_depttime_getTime<result.utc_1hr_getTime && id=="dept_time1"){
                      $(this).parents('.panel').find('.subdomaintwoleft').addClass('border_red');
                      $(this).parents('.panel').find('.subdomaintwo').addClass('border_red');
                      errorPopover("#hhdept_time"+data_id,"Enter minimum 30 min from current UTC time");
                      errorPopover("#mmdept_time"+data_id,"Enter minimum 30 min from current UTC time");
                    }
                    else if((result.utc_depttime_getTime<result.utc_last_arrivaltime) &&  id!="dept_time1"){
                      $(this).parents('.panel').find('.subdomaintwoleft').addClass('border_red');
                      errorPopover('#hhdept_time'+data_id,"DEP TIME ENTERED IS LESS THAN LAST FLIGHT ARRIVAL TIME OF  "+result.utc_last_arrivaltime_format);
                       errorPopover('#mmdept_time'+data_id,"DEP TIME ENTERED IS LESS THAN LAST FLIGHT ARRIVAL TIME OF  "+result.utc_last_arrivaltime_format);
                    }
                    else{
                      $(this).parents('.panel').find('.subdomaintwoleft').removeClass('border_red');
                      $(this).parents('.panel').find('.subdomaintwo').removeClass('border_red');
                      closePopover('#mmdept_time'+data_id);
                      closePopover('#mmdept_time'+data_id);
                    }
                } 
            }
        });
     $(".editflightdate").datepicker({
             dateFormat: 'dd-M-yy',
             minDate: 0, 
             maxDate: "+4d",
             onSelect: function(selectedDate) 
             {  
                var id_no=$(this).parents(".Paxrules").attr('data-id');
                 $('#flight_date2').val(selectedDate);
                 $('#flight_date2').datepicker("option",{ minDate: new Date(selectedDate)});
                 var id=$(this).attr('id');
                 var data_id=$(this).attr('data-id');
                 $("#"+id+'_lbl').css('display','block');
                 $("#"+id+'_lbll').css('display','block');
                 closePopover("#"+$(this).attr('id'));
                 $(".notify-bg-v").fadeOut();
                  // var result=CheckDeptTime($(this));
                  var result =CheckDeptTime($("#hhdept_time"+data_id).val(),$("#mmdept_time"+data_id).val(),$(this).parents('.panel').attr('data-slidecount'),$(this).datepicker('getDate'));
                  if($(this).parents('.panel').find('.departuretime').val()!="")
                  {  
                     /*if(result.utc_depttime_getTime<result.utc_now_getTime){
                       $(this).parents('.panel').find('.subdomaintwoleft').addClass('border_red');
                       errorPopover("#"+$(this).parents('.panel').find('.departuretime').attr('id'),"Enter more than current UTC time");
                     }
                      else*/ 

                     if(result.utc_depttime_getTime<result.utc_1hr_getTime){
                       $(this).parents('.panel').find('.subdomaintwoleft').addClass('border_red');
                       errorPopover("#"+$(this).parents('.panel').find('.departuretime').attr('id'),"Enter minimum 30 min from current UTC time");
                     }
                     else{
                       $(this).parents('.panel').find('.subdomaintwoleft').removeClass('border_red');
                       closePopover("#"+$(this).parents('.panel').find('.departuretime').attr('id'));
                     }
                 }    
             }
         });
     $(document).on("keyup",".hhdeparturetime,.mmdeparturetime",function(e){ 
            var data_id=$(this).attr('data-id');
            var id=$(this).attr('id');
            var hhdept_time=$("#hhdept_time"+data_id).val();
            var mmdept_time=$("#mmdept_time"+data_id).val();
             if(data_id!=7){             
            if(hhdept_time.length==2 && mmdept_time.length==2 && $(this).parents('.panel').find('.flightdate').val()!="")
            {
                
               if(data_id==7)
               var result=CheckDeptTime(hhdept_time,mmdept_time,$(this).parents('.panel').attr('data-slidecount'),$(this).parents('.panel').find('.editflightdate').datepicker('getDate'));
              else  
               var result=CheckDeptTime(hhdept_time,mmdept_time,$(this).parents('.panel').attr('data-slidecount'),$(this).parents('.panel').find('.flightdate').datepicker('getDate'));
               if(result.utc_depttime_getTime<result.utc_1hr_getTime && (id=="hhdept_time1"||id=="mmdept_time1"||id=="hhdept_time7"||id=="mmdept_time7")){
                errorPopover("#hhdept_time"+data_id,"Enter minimum 30 min from current UTC time");
                errorPopover("#mmdept_time"+data_id,"Enter minimum 30 min from current UTC time");
              }
              else if((result.utc_depttime_getTime<result.utc_last_arrivaltime) &&  id!="hhdept_time1" && id!="hhdept_time7"){
                $(this).parents('.panel').find('.subdomaintwoleft').addClass('border_red');
                errorPopover("#hhdept_time"+data_id,"DEP TIME ENTERED IS LESS THAN LAST FLIGHT ARRIVAL TIME OF  "+result.utc_last_arrivaltime_format);
                errorPopover("#mmdept_time"+data_id,"DEP TIME ENTERED IS LESS THAN LAST FLIGHT ARRIVAL TIME OF  "+result.utc_last_arrivaltime_format);
                bool=false;
              }
              else{
                $(this).parents('.panel').find('.subdomaintwoleft').removeClass('border_red');
                $(this).parents('.panel').find('.subdomaintwo').removeClass('border_red');
                closePopover("#hhdept_time"+data_id);
                closePopover("#mmdept_time"+data_id);
              }
           } 
          }
           var id_no=$(this).attr('data-id');
       });
      $(document).on("focusin",".hhdeparturetime ",function(e){ 
            if($(this).val().length==2)
              $(this).select();
      });
      $(document).on("focusin",".mmdeparturetime ",function(e){ 
           if($(this).val().length==2)
             $(this).select();
       });
      $(document).on("keypress",".hhdeparturetime",function(e){ 
         var time=$(this).val();
         var id=$(this).attr('data-id');
         var mmdeparturetime=$("#mmdept_time"+id).val();

         if ((time.length == 0||time.length == 2) && ((e.which >=51 &&  e.which <= 57))){
            return false;
         }
         if (time.length == 1 && $(this).val().charAt(0)==2 && ((e.which >=52 &&  e.which <= 57))){
            return false;
         }
         if (time.length == 1 && mmdeparturetime=='00' && e.which==48 && time=='0'){
            return false;
         }
      });
      $(document).on("keypress",".mmdeparturetime",function(e){ 
         var time=$(this).val();
         var id=$(this).attr('data-id');
         var hhdeparturetime=$("#hhdept_time"+id).val();

         if ((time.length == 0||time.length == 2) && ((e.which >=54 &&  e.which <= 57))|| (time.length == 3 && parseInt(hhdeparturetime)>=24 && (e.which >=49 &&  e.which <= 57) )){
            return false;
         }
         if (time.length == 1 && ((e.which >=49 &&  e.which <= 52)||(e.which >=54 &&  e.which <= 57) || (time=='0' && hhdeparturetime =='00' && hhdeparturetime !="" && e.which ==48) )){
            return false;
         }
      }); 
      $('body').on('keyup', '.hhdeparturetime',function (event){  
           if($(this).val().length==2 || $(this).val()==""){
            closePopover("#"+$(this).attr('id'));
            $(this).parents('.panel').find('.mmdeparturetime').focus();
           }
      });
      $('body').on('keyup', '.mmdeparturetime',function (event){  
           var id=$(this).attr('data-id');
           if($(this).val().length==2 || $(this).val()=="")
            closePopover("#"+$(this).attr('id'));

           if($(this).val().length==2){
            
            $("#pax"+id).focus(); 
           }
      }); 
      $('body').on('keyup', '.mmdeparturetime,.hhdeparturetime',function (event){  
        var id=$(this).attr('data-id');
        var hhdept_time= $("#hhdept_time"+id).val();
        var mmdept_time= $("#mmdept_time"+id).val();
        if(hhdept_time.length==2 && mmdept_time.length==2)
          {
               if(parseInt(hhdept_time)<=24 && parseInt(mmdept_time)<=60)
               {
                 var time=calculate_ist(hhdept_time,mmdept_time)
                 $("#dept_time"+id+"_lbl").html(time);
               }
              else
                $("#dept_time"+id+"_lbl").html('');
          }
        else if(hhdept_time=="" && mmdept_time=="") 
          $("#dept_time"+id+"_lbl").html(''); 
             var id_no=$(this).attr('data-id');
             validation(id_no); 
      });
      function calculate_ist(hhhandling_arrival_time,mmhandling_arrival_time)
      {
            hr=parseInt(hhhandling_arrival_time)+5;
            min=parseInt(mmhandling_arrival_time)+30;
            if(min>=60){
               hr=hr+1;
               min=min-60;
            }
            if(hr>=24)
              hr=hr-24;
            if(min.toString().length==1)
                  min='0'+min;
            if(hr.toString().length==1)
                  hr='0'+hr;
          time=hr+" : "+min+" IST";
          return time;
      }
     $(document).on("blur",".hhdeparturetime,.mmdeparturetime",function(e){ 
            var data_id=$(this).attr('data-id');
            var id=$(this).attr('id');
            var hhdept_time=$("#hhdept_time"+data_id).val();
            var mmdept_time=$("#mmdept_time"+data_id).val();
            if($(this).val().length<2 && $(this).val().length>=1){  
                errorPopover("#"+$(this).attr('id'),"Please Enter Dept Time");
            }  
       });    
     $('body').on('focusin', '.infocus',function (){    
          var id=$(this).attr('id');
          if(!$(this).hasClass("flightdate")){
             $("#"+id+'_lbl').css('display','block');  
          }
     });
      $('body').on('focusout', '.outfocus',function (){
          var id=$(this).attr('id');     
          if(!$(this).hasClass("flightdate") && !$(this).hasClass("alternate1") && !$(this).hasClass("alternate2") && !$(this).hasClass("take_off_alternate") && !$(this).hasClass("departure") && !$(this).hasClass("destination") && !$(this).hasClass("departuretime")){
            $("#"+id+'_lbl').css('display','none');
          }
     });
       $(".ui-datepicker-trigger").click(function(){
              $(".notify-bg-v").fadeIn();
              $('.notify-bg-v').css('height',0);
              $('.notify-bg-v').css('height', $(document).height());
       });
       $('body').on('click','.ui-datepicker-trigger',function (){       
             $(".notify-bg-v").fadeIn();
             $('.notify-bg-v').css('height',0);
             $('.notify-bg-v').css('height', $(document).height());
       });
      $('body').on('submit', '.navlog',function (event){
        event.preventDefault();
        var ist= $(this).parents('.panel').find('.dept_time_lbl').text();
        var slide_count=$(this).parents('.panel').attr('data-slidecount');
        var no_of_flight=$(this).parents('.panel').find('.no_of_flight').text();
        var flight_date=$(this).parents('.panel').find('.flightdate').val();
        var callsign=$(this).parents('.panel').find('.callsign').val();
        var registration=$(this).parents('.panel').find('.aircraft').val();
        var departure=$(this).parents('.panel').find('.departure').val();
        var destination_airportname=$(this).parents('.panel').find('.destination_lbl').text();
        var hhdept_time_id=$(this).parents('.panel').find('.hhdeparturetime').attr('id');
        var mmdept_time_id=$(this).parents('.panel').find('.mmdeparturetime').attr('id');
        var destination=$(this).parents('.panel').find('.destination').val();
        var pax=$(this).parents('.panel').find('.pax').val();
        var load=$(this).parents('.panel').find('.load').val();
        var fuel=$(this).parents('.panel').find('.fuel').val();
        var min_max = $(this).parents('.panel').find($("input[name='min_max']:checked")).val();
        var remarks=$(this).parents('.panel').find('.remarks').val();
        var dept_place=$(this).parents('.panel').find('.dept_place').val();
        var dept_lat=$(this).parents('.panel').find('.dept_lat').val();
        var dest_place=$(this).parents('.panel').find('.dest_place').val();
        var dest_lat=$(this).parents('.panel').find('.dest_lat').val();
        var remarks=$(this).parents('.panel').find('.remarks').val();
        var hhdept_time=$(this).parents('.panel').find('.hhdeparturetime').val();
        var mmdept_time=$(this).parents('.panel').find('.mmdeparturetime').val();
        var hhdept_time_id=$(this).parents('.panel').find('.hhdeparturetime').attr('id');
        var bool=true;
        if(no_of_flight=="SELECT"){
            errorPopover('#'+$(this).parents('.panel').find('.flight_no ').attr('id'),"Select Number of Flights");
            bool=false; 
        }
         if(callsign=="" || callsign.length<5){
          errorPopover('#'+$(this).parents('.panel').find('.callsign').attr('id'),"Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
          bool=false;
        }
        if(registration=="" ||registration.length<5){
          errorPopover('#'+$(this).parents('.panel').find('.aircraft').attr('id'),"Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
          bool=false;
        }
        if(departure=="" || departure.length<4){
            errorPopover('#'+$(this).parents('.panel').find('.departure').attr('id'),'Min. 4 & Max. 4 Characters, only Alphabets allowed');
            bool=false;
        }
        if(destination=="" || destination.length<4){
            errorPopover('#'+$(this).parents('.panel').find('.destination').attr('id'),'Min. 4 & Max. 4 Characters, only Alphabets allowed');
            bool=false;
        }
        if(flight_date=="") {
            errorPopover('#'+$(this).parents('.panel').find('.flightdate').attr('id'),'Enter Flight date');
            bool=false;
        }
         if(mmdept_time.length<2 && mmdept_time.length>=1){
             $(this).parents('.panel').find('.subdomaintwoleft').addClass('border_red');
             errorPopover('#'+$(this).parents('.panel').find('.mmdeparturetime').attr('id'),'Enter Departure Time');
             bool=false;
         }
         if(hhdept_time.length<2 && hhdept_time.length>=1){
             $(this).parents('.panel').find('.subdomaintwoleft').addClass('border_red');
             errorPopover('#'+$(this).parents('.panel').find('.hhdeparturetime').attr('id'),'Enter Departure Time');
             bool=false;
         }
        else if(hhdept_time.length==2 && mmdept_time.length==2 && $(this).parents('.panel').find('.flightdate').val()!=""){
           var result=CheckDeptTime(hhdept_time,mmdept_time,$(this).parents('.panel').attr('data-slidecount'),$(this).parents('.panel').find('.flightdate').datepicker('getDate'));
          if((result.utc_depttime_getTime<result.utc_1hr_getTime) &&  (hhdept_time_id=="hhdept_time1"||mmdept_time_id=="mmdept_time1")){
             errorPopover('#'+$(this).parents('.panel').find('.hhdeparturetime').attr('id'),"Enter minimum 30 min from current UTC time");
             errorPopover('#'+$(this).parents('.panel').find('.mmdeparturetime').attr('id'),"Enter minimum 30 min from current UTC time");
             bool=false;
          }
          else if((result.utc_depttime_getTime<result.utc_last_arrivaltime) &&  hhdept_time_id!="hhdept_time1"){
             errorPopover('#'+$(this).parents('.panel').find('.hhdeparturetime').attr('id'),"DEP TIME ENTERED IS LESS THAN LAST FLIGHT ARRIVAL TIME OF  "+result.utc_last_arrivaltime_format);
             errorPopover('#'+$(this).parents('.panel').find('.mmdeparturetime').attr('id'),"DEP TIME ENTERED IS LESS THAN LAST FLIGHT ARRIVAL TIME OF  "+result.utc_last_arrivaltime_format);
             bool=false;
          }
          else{
            $(this).parents('.panel').find('.subdomaintwoleft').removeClass('border_red');
            closePopover('#'+$(this).parents('.panel').find('.departuretime').attr('id'));
          }
         }
        if(load.length>=1 && load.length<2){
            errorPopover('#'+$(this).parents('.panel').find('.load').attr('id'),'Min. 2 & Max. 3 Characters, only Numbers allowed');
            bool=false;
        }
        if((fuel.length>=1 && $(this).parents('.panel').find($("input[name='min_max']")).is(':checked')==false)||(fuel.length>=1 && fuel.length<3)){
            errorPopover('#'+$(this).parents('.panel').find('.fuel').attr('id'),"Min. 3 & Max. 5 Characters, only Numbers allowed");
             bool=false;
        }
        else if(fuel.length>=3){
          var max_fuel=max_fuel_check(fuel,$(this).parents('.panel').find('.callsign').val(),$(this));
          if(parseInt(max_fuel)<parseInt(fuel)){
             errorPopover('#'+$(this).parents('.panel').find('.fuel').attr('id'),"Max Fuel Should be less than "+max_fuel);
             bool=false;
           }
        } 
        if(remarks.length>=1 && remarks.length<3){
            errorPopover('#'+$(this).parents('.panel').find('.remarks').attr('id'),'Min. 3 & Max. 150 character allowed');
            bool=false;
        }
        if(departure=='zzzz'|| departure=="ZZZZ"){
            if(dept_place==""|| dept_place<3){
              errorPopover('#'+$(this).parents('.panel').find('.dept_place').attr('id'),"Min. 3 & Max. 25 Characters, only Alphabets and Number allowed");
               bool=false;
            }
            if(dept_lat==""|| dept_lat<11){
              errorPopover('#'+$(this).parents('.panel').find('.dept_lat').attr('id'),"Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)");
               bool=false;
            }
        }
        if(destination=='zzzz'|| destination=="ZZZZ"){
            if(dest_place==""|| dest_place<3){
              errorPopover('#'+$(this).parents('.panel').find('.dest_place').attr('id'),"Min. 3 & Max. 25 Characters, only Alphabets and Number allowed");
               bool=false;
            }
            if(dest_lat==""|| dest_lat<11){
              errorPopover('#'+$(this).parents('.panel').find('.dest_lat').attr('id'),"Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)");
               bool=false;
            }
        }
        if(bool==false)
           return false;  
       if($(this).find('.btn_send_f01').text()=='SUBMIT'){
               $('.overlay').css('height',0);
               $('.overlay').css('height', $(document).height()); 
               $(".overlay").show();
               $(this).find('.btn_send_f01').attr('disabled',true);
          }  
        var data=$(this).serialize()+'&btnvalue='+$(this).find('.btn_send_f01').text()+'&no_of_flight='+$(this).find('.no_of_flight').text()+'&dep_airport_name='+$(this).parents('.panel').find('.departure_lbl').text()+'&dest_airport_name='+$(this).parents('.panel').find('.destination_lbl').text()+'&deptime_ist='+ ist+'&dep_time='+$(this).parents('.panel').find('.hhdeparturetime').val()+$(this).parents('.panel').find('.mmdeparturetime').val();
        if(min_max==undefined)
              data=data+'&min_max='+''; 
         $.ajax({
                context : this,  
                type: "POST",  
                url: $(this).attr('action'),
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                dataType:"json",
                data:data,
                success: function(result) 
                {
                   if(result.success==false){
                    $(".overlay").fadeOut();
                    swal("Navlog Plan Already Exist");  
                    $(this).find('.btn_send_f01').attr('disabled',false);
                    return false;
                   }   
                   if($(this).find('.btn_send_f01').text()=='SUBMIT'){
                     $("#accord2,#accord3,#accord4,#accord5,#accord6").remove(); 
                     $("#msg1").html('TEST PLAN REQUEST SENT SUCCESSFULLY');
                     $.growl({ title:'',location:'tc',size:'large', message: 'TEST PLAN REQUEST SENT SUCCESSFULLY'});
                       hidemsg();
                       $(".navlog")[0].reset();
                       $('#collapse_reg1').show();
                       $("#submit_lbl1").html('SUBMIT');
                       $("#no_of_flight1").text('SELECT').css({'font-weight':'normal','font-size':'12px'}).removeClass('pace_name1');
                       $("#hour1").css({'padding':'8px 0px 0px 0px'});
                       $('.ddpax').empty();
                       $(".pax_value").text('PAX').css({'font-weight':'normal','font-size':'12px','line-height':'1.5'});
                       $("#cabin").text('CABIN').css({'font-weight':'normal','font-size':'12px'});
                       $("#flight_date1_lbl,#flight_date1_lbll").css('display','none');
                       $("#hour1,#callsign1,#aircraft1,#departure1,#destination1").addClass('border_red');
                       $('#departure1_lbl,#dept_time1_lbl,#destination1_lbl').html('');
                       $("#rules1_lbl,#mins1_lbl").addClass('hide');
                       $(this).find('.btn_send_f01').attr('disabled',false);
                       $("#dept_place1").attr('disabled',true).addClass('pace_name');
                       $("#dept_lat1").attr('disabled',true).addClass('pace_name');
                       $("#dest_place1").attr('disabled',true).addClass('pace_name');
                       $("#dest_lat1").attr('disabled',true).addClass('pace_name');
                       $("#flight_date1").val($("#flight_date1").attr('data-date'));
                       time1(1);
                       $(".overlay").fadeOut();
                       $("#accordion_reg").attr('data-prev-section-count',1);
                       var clicked_btn = $(this).find("button[type=submit]:focus").attr('id');
                       var data_url = '/navlog_get_test_filter_data';
                       var data = $('form[id="navlog_search"]').serialize();
                       data = data + '&clicked_btn=' + clicked_btn;
                       $("#accordion_reg").attr('data-prev-section-count',1);
                       $(".dt_loading").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
                       $.ajax({
                           url: data_url,
                           type: 'POST',
                           data: {'clicked_btn':localStorage.getItem("test_clicked_btn")},
                           headers: {
                               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                           },
                           success: function (data, textStatus, jqXHR) {
                               // console.log(data);
                               $("#result").html(data);

                           },
                           error: function (jqXHR, textStatus, errorThrown) {
                               console.log(errorThrown)
                           }
                       });
                   }
                   else{
                        var current_slide=$(this).parents('.panel').attr('data-slidecount');
                        var next_slide=parseInt(current_slide)+1;   
                        $("#collapse_reg"+current_slide).hide(200);
                        $('#accord'+next_slide).show();
                        $('#collapse_reg'+next_slide).show();
                        $("#callsign"+next_slide).val(callsign).removeClass('border_red');
                        $("#departure"+next_slide).val(destination).removeClass('border_red');
                        $("#aircraft"+next_slide).val(registration).removeClass('border_red');
                        var id="departure"+next_slide+"_lbl";
                        $("#"+id).html(destination_airportname);  
                        if(destination=='zzzz'||destination=="ZZZZ"){
                            $("#dept_place"+next_slide).val(dest_place).attr('disabled',false).attr('readonly',true).removeClass('border_red');
                            $("#dept_lat"+next_slide).val(dest_lat).attr('disabled',false).attr('readonly',true).removeClass('border_red');
                         }
                        $("#flight_date"+next_slide).val(flight_date); 
                        $('#flight_date'+next_slide).datepicker("option",{ minDate: new Date(flight_date)});
                        $("#destination"+next_slide).focus(); 
                  }

                }
              });
    });
        function hidemsg() {
            setTimeout(function(){ 
                $("#msg,#mysuccess").addClass('hide');
            }, 5000);
        }
        $(document).on("blur",'.destination,.departure',function(){
              $.ajax({
                     context : this,  
                     url: '/get_airport_name',
                     dataType:"json",
                     data:{airport_code:$(this).val()},
                     success: function(result) {
                        if(result.success==true && result.airportcity!="") {
                            $("#"+$(this).attr('id')+'_lbl').text(result.airportcity);
                        }
                         else
                        {
                          var id=$(this).attr('id');
                          if($(this).hasClass('alternate1')){
                              $("#"+$(this).attr('id')+'_lbl').text("");
                            }
                          else if($(this).hasClass('alternate2')){
                              $("#"+$(this).attr('id')+'_lbl').text("");
                            }
                          else if($(this).hasClass('take_off_alternate')){
                             $("#"+$(this).attr('id')+'_lbl').text("");
                            }
                          else if($(this).hasClass('departure')){
                             $("#"+$(this).attr('id')+'_lbl').text("");
                            }
                          else if($(this).hasClass('destination')){
                             $("#"+$(this).attr('id')+'_lbl').text("");
                            }  

                        }
                     }
                   });
        }); 
        $("#co_pilot1").autocomplete({
               minLength: 0,
               source: function (request, response) {
                   $.ajax({
                           url: base_url + "/navlog/copilot",
                           dataType:"json",
                           type:"post",
                           headers: {
                           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                           },
                           data:{'term':'','aircraft_callsign': $(this.element).parents('.panel').find('.callsign').val()},  
                           success: function(data)
                           {
                               response(data);
                           }});
               },
               select: function (event, ui) {
                   if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                       errorPopover("#"+$(this).attr('id'),"Min. 2 & Max. 25 Alphabets and only SPACE Character allowed");
                   } else {
                       closePopover('#'+$(this).attr('id'));
                   }

               }
           }).click(function () {
               $("#co_pilot1").autocomplete('search', $(this).val());
           }).focus(function(){$("#co_pilot1").autocomplete('search', $(this).val());}); 
           $('#loading-img').height($(window).height());
           $('.overlay').height($(document).height());  
          
           if ($('.navlog_info').length > 0) 
           {
               $('.navlog_info').each(function (e) 
               {
                   var url_fpl_list = $("#url").val();
                   var date = $("#date_of_flight2").val();
                   jQuery.fn.dataTableExt.sErrMode = 'throw';
                   jQuery.fn.dataTableExt.oPagination.iFullNumbersShowPages = 10;
                   var opt = {
                   "sDom": '<"top"iflp<"clear">>rt',
                           "bFilter": false,
                           "bLengthChange": false,
                           "iDisplayLength": 25,
                           "sPaginationType": "simple_numbers",
                           "bProcessing": false,
                           "bServerSide": true,
                           "info": false,
                           "sAjaxSource": url_fpl_list + '/test_navlog_list',
                           "fnServerParams": function (aoData, fnCallback) {
                           aoData.push({"name": "url", "value": $("#url").val()});
                           aoData.push({"name": "live_test_mode", "value": 2});
                           aoData.push({"name": "flight_date", "value": $("#date_of_flight2").val()});
                           aoData.push({"name": "email", "value": $("#email").val()});
                           },
                           "sAjaxDataProp": "aaData",
                           "bPaginate": true,
                           "oLanguage": {
                           "sSearch": "<span>Search:</span> ",
                                   "sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
                                   "sLengthMenu": "_MENU_ <span>entries per page</span>",
                                   "sLoadingRecords": "<span style='font-size:13px'>Please wait - loading...</span>",
                                   "sProcessing": "<span style='font-size:13px'>Loading, please wait...</span>",
                                   "sZeroRecords": "<p style='color:red'>NO MATCHING RECORDS FOUND</p>"
                           },
                           "aLengthMenu": [20, 50, 100, 200, 400],
                           "fnDrawCallback": function (oSettings) {
                           $('[rel=popover]').popover({
                           placement: "top",
                                   html: true,
                           });
                           },
                           "initComplete": function (settings, json) {
                           $('div.dt_loading').remove();
                           }
                   };
                   $.datepicker.setDefaults({
                       dateFormat: "dd-mm-yy"
                   });
                   var oTable = $(this).dataTable(opt);
                   $(this).css("width", '100%');
                   $('.dataTables_filter input').attr("placeholder", "Search here...");
                   oTable.fnDraw();
                   oTable.fnAdjustColumnSizing();
                });
             }

             function pending_cancelled_completed()
             {
                 $.ajax({
                     url: '/pending_cancelled_completed',
                     data:{'live_test_mode':2,'from_date':$("#from_date").val(),'to_date':$("#to_date").val()},
                     success: function(result) {
                        $('#pend').html(' ('+result.pending+')');
                        $('#canc').html(' ('+result.cancelled+')');

                     }
                 });
             }  
             $(document).on('click', ".navlog_modal_class", function (e) {
                 var data_value = $(this).attr('data-value');
                 var url = $(this).attr('data-url');
                 var modal_type = $(this).attr('modal-type');
                 var is_plan_active = $(this).attr('is-plan-active');
                 var is_fic_active = $(this).attr('is-fic-active');
                 var data_encoded = $(this).attr('data-encoded');
                 switch (modal_type) {
                     case 'cancel':
                         $(".navlog_cancel_plan").attr('data-value', data_value);
                         if (is_plan_active) {
                             $("#navlog_preview").modal('hide');
                             $("#cnfrevise").modal('hide');
                             $("#navlog_cancel_plan").modal();
                         }
                         break;
                    case 'pending_cancel':
                        $(".navlogpending_cancel_plan").attr('data-value', data_value);
                        if (is_plan_active) {
                            $("#navlog_preview").modal('hide');
                            $("#cnfrevise").modal('hide');
                            $("#navlogpending_cancel_plan").modal();
                        }
                        break; 
                     case 'test-preview':
                         $("#navlog_cancel_plan").modal('hide'); 
                         $("#cnfrevise").modal('hide'); 
                         $("#navlog_preview").modal();
                         break;
                     case 'revise_confirm':
                         $(".departure_time").attr('data-content', '');
                         $("#confirm_revise").attr('data-value', data_value);
                         if (is_plan_active) {
                             $("#navlog_preview").modal('hide');
                             $("#navlog_cancel_plan").modal('hide');
                             $("#cnfrevise").modal();
                         }
                         break;
                     case 'change_plan':
                         var is_change_allowed = $(this).attr('is_change_allowed');
                          $("#submit_lbl7").removeClass('change_plan');
                          $("#submit_lbl7").removeClass('pending_change_plan');
                         if (is_plan_active && is_change_allowed == '') {
                             $("#changeplan").modal();
                             
                         }
                         $("#submit_lbl7").addClass('change_plan');
                         $("#id").val(data_value);
                         $("#encodedid").val(data_encoded)
                         break;
                    case 'pending_change_plan':
                         $("#submit_lbl7").removeClass('change_plan');
                          $("#submit_lbl7").removeClass('pending_change_plan');
                         var is_change_allowed = $(this).attr('is_change_allowed');
                         if (is_plan_active && is_change_allowed == '') {
                             $("#changeplan").modal();
              
                         }
                         $("#submit_lbl7").addClass('pending_change_plan');
                         $("#id").val(data_value);
                         $("#encodedid").val(data_encoded)
                         break;
                     case 'tableview':
                         $("#tableview").modal();
                         break;
                     default:
                         break;
                 }
                 var data = {'id': data_value, 'modal_type': modal_type}
                 $.ajax({
                     url: url,
                     type: 'POST',
                     data: data,
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     },
                     success: function (data, textStatus, jqXHR) {
                         $(".header_title").html(data.header_title);
                         $(".modal_message").html(data.modal_message);
                     },
                     error: function (jqXHR, textStatus, errorThrown) {
                         console.log(errorThrown)
                     }
                 })

             });
               $('body').on('click', '.navlog_cancel_plan',function (event){
                 var data_value = $(this).attr('data-value');
                 var data_url = $(this).attr('data-url');
                 var email = $("#email").val();
                 var user_mobile = $("#user_mobile").val();
                 var environment = $("#environment").val();
                 $("#navlog_cancel_plan").modal('hide');
                 $("#mysuccess").removeClass('hide'); 
                 $('.overlay').css('height',0);
                 $('.overlay').css('height', $(document).height());
                 $(".overlay").show();
                 $.ajax(data_url,
                         {
                             type: 'POST',
                             data: {'id': data_value, 'email': email, 'user_mobile': user_mobile},
                             cache: false,
                             headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                             success: function (data) {
                                 $(".overlay").fadeOut();
                                 $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font" style="font-size:15px">' + data.success + '</div>');
                                 hidemsg();
                                 $.ajax({
                                     url: '/navlog_get_test_filter_data',
                                     type: 'POST',
                                     data: {'clicked_btn':localStorage.getItem("test_clicked_btn")},
                                     headers: {
                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                     },
                                     success: function (data, textStatus, jqXHR) {
                                         $("#result").html(data);

                                     }
                                 }) 
                                 pending_cancelled_completed(); 
                               }
                         });
             
             });
             $("#navlog_search").on('submit', function (e) {
                 e.preventDefault();
                 var clicked_btn = $(this).find("button[type=submit]:focus").attr('id');
                 var data_url = $(this).attr('data-url');
                 var data = $('form[id="navlog_search"]').serialize();
                 data = data + '&clicked_btn=' + clicked_btn;
                 var aircraft_callsign2 = $("#aircraft_callsign2").val();
                 var departure_aerodrome2 = $("#departure_aerodrome2").val();
                 var destination_aerodrome2 = $("#destination_aerodrome2").val();
                 var from_date = $("#from_date").val();
                 var to_date = $("#to_date").val();
                 if (clicked_btn == 'first') {
                     if (aircraft_callsign2 == '' && departure_aerodrome2 == '' && destination_aerodrome2 == '') {
                         $("#alert_validation").modal();
                         $(".modal_message").html("Please enter any one field");
                         $(".header_title").html('Validation Fail Message')
                         return false;
                     }
                     
                 }
                 localStorage.setItem("test_clicked_btn",clicked_btn);
                 $(".dt_loading").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
                 $.ajax({
                     url: data_url,
                     type: 'POST',
                     data: data,
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     },
                     success: function (data, textStatus, jqXHR) {
                         $("#result").html(data);
                     },
                     error: function (jqXHR, textStatus, errorThrown) {
                         console.log(errorThrown)
                     }
                 })

             });   
             function CheckDeptTime(hr,min,slidecount,flight_date){
               var currentaccord=slidecount;
               var lastaccord=currentaccord-1;
               var now = new Date();
               var utc_now = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(),  now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds(), now.getUTCMilliseconds());
               var utc_1hr= new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(),  now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds(), now.getUTCMilliseconds());
               utc_1hr.setMinutes(utc_1hr.getMinutes() + 30);

               var date = flight_date;
               var day  = date.getDate();
               var month = date.getMonth();              
               var year =  date.getFullYear();  
               var utc_depttime = new Date(year,month,day,hr,min,00,000);
               var validation_time;
                if(currentaccord==1||currentaccord==7)
                { 
                 
                    validation_time= {
                              utc_now_getTime: utc_now.getTime(),
                              utc_depttime_getTime: utc_depttime.getTime(),
                              utc_1hr_getTime: utc_1hr.getTime(),
                              utc_last_arrivaltime:999999999,
                              utc_last_arrivaltime_format:'',
                                   };
               }
                else
                {
                  var callsign=$('#callsign1').val();
                  var departure=$('#departure'+lastaccord).val();
                  var destination=$('#destination'+lastaccord).val();
                  var last_date =$('#flight_date'+lastaccord).datepicker('getDate');
                  var last_day  = last_date.getDate();
                  var last_month = last_date.getMonth();              
                  var last_year =  last_date.getFullYear();
                  var last_hhdept_time=$('#hhdept_time'+lastaccord).val();
                  var last_mmdept_time=$('#mmdept_time'+lastaccord).val();
                  var utc_last_depttime = new Date(last_year,last_month,last_day,last_hhdept_time,last_mmdept_time,00,000);
                  var mont = new Array();
                      mont[0] = "Jan";
                      mont[1] = "Feb";
                      mont[2] = "Mar";
                      mont[3] = "Apr";
                      mont[4] = "May";
                      mont[5] = "Jun";
                      mont[6] = "Jul";
                      mont[7] = "Aug";
                      mont[8] = "Sep";
                      mont[9] = "Oct";
                      mont[10] = "Nov";
                      mont[11] = "Dec";

                  $.ajax({
                    url: '/get_flying_time',
                    dataType:"json",
                    async: false,
                    data:{callsign:callsign,departure:departure,destination:destination},
                    success: function(result) {
                       if(result.success==true) {
                          var total_flying_hours=parseInt(result.total_flying_hours);
                          total_flying_minutes=parseInt(result.total_flying_minutes);
                          utc_last_depttime.setHours(utc_last_depttime.getHours()+total_flying_hours);
                          utc_last_depttime.setMinutes(utc_last_depttime.getMinutes()+total_flying_minutes);
                          utc_last_arrivaltime=utc_last_depttime.getTime();
                          utc_last_arrivaltime_format=utc_last_depttime.getHours()+' : '+(utc_last_depttime.getMinutes()<10?'0':'') + utc_last_depttime.getMinutes()+' ON '+utc_last_depttime.getDate()+'-'+mont[utc_last_depttime.getMonth()]+'-'+utc_last_depttime.getFullYear();
                          validation_time= {
                             utc_now_getTime: utc_now.getTime(),
                             utc_depttime_getTime: utc_depttime.getTime(),
                             utc_last_arrivaltime: utc_last_arrivaltime,
                             utc_1hr_getTime: utc_1hr.getTime(),
                             utc_last_arrivaltime_format:utc_last_arrivaltime_format,
                                   };
                       }
                    }
                  });
                } 
                return validation_time;
             }  
             $(".pending_text").click(function(){
                  localStorage.setItem("test_clicked_btn", "3rd");
             });  
             $(".cancelled_text").click(function(){
                  localStorage.setItem("test_clicked_btn", "5th");
             });
             $('.others').click(function(){
                var clicked_btn = $(this).attr('id');
                var data_url = $(this).attr('data-url');
                var data='aircraft_callsign2=&departure_aerodrome2=&destination_aerodrome2=&destination_aerodrome2=&from_date='+"{{date('d-M-Y')}}"+'&to_date='+"{{date('d-M-Y')}}"+'&date_of_flight2='+"{{date('d-M-Y')}}"+'&default_fpl_date='+"{{date('ymd')}}"+'&current_time='+"{{date('Hi')}}";
                data = data + '&clicked_btn=' + clicked_btn;
                var aircraft_callsign2 = $("#aircraft_callsign2").val();
                var departure_aerodrome2 = $("#departure_aerodrome2").val();
                var destination_aerodrome2 = $("#destination_aerodrome2").val();
                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();
                $(".dt_loading").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
              $.ajax({
                  context:this,
                  url: data_url,
                  type: 'POST',
                  data: data,
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  },
                  success: function (data, textStatus, jqXHR) {
                      $("#result").html(data);
                      if($(this).attr('id')=='3rd')
                      $("#tbl_head").addClass('pending'); 
                       else if($(this).attr('id')=='4th')
                      $("#tbl_head").addClass('completed');  
                      else if($(this).attr('id')=='5th')
                      $("#tbl_head").addClass('cancelled');  
                  },
                  error: function (jqXHR, textStatus, errorThrown) {
                      console.log(errorThrown)
                  }
              })
             }); 
             $('body').on('click', '.edit_navlog_plan',function (event){
                 closePopover("#load7");
                 closePopover("#fuel7");
                 closePopover("#pilot7");
                 closePopover("#mobile7");
                 closePopover("#co_pilot7");
                 closePopover("#level17");
                 closePopover("#mainroute7");
                 closePopover("#remarks7");
                 closePopover("#alternate17");
                 closePopover("#level27");
                 closePopover("#alternate1route7");
                 closePopover("#alternate27");
                 closePopover("#level37");
                 closePopover("#alternate2route7");
                 closePopover("#take_off_alternate7");
                 closePopover("#level47");
                 closePopover("#takeoff_alternate_route7");
                 closePopover("#speed7");

                 var id = $("#id").val();
                 $("#changeplan").modal('hide');
                  $('#editplan').modal();
                 var data = {'id': id}
                 $('.update_navlog')[0].reset();
                 $('#max_7,#min_7').removeAttr("checked");
                 $("#speed7").css({'padding':'7px 0px 0px 0px'});
                 $('#ddspeed7').empty();
                 $("#spd7").text('SPEED').css({'font-weight':'normal','font-size':'12px'});
                 $("#ddpax7").empty();
                 $("#pax_value7").text('PAX').css({'font-weight':'normal','font-size':'12px','line-height':'1.5'});
                 $("#cabin7").text('CABIN').css({'font-weight':'normal','font-size':'12px'});
                 $('#alternate27_lbl,#alternate17_lbl,#take_off_alternate7_lbl').html('');
                 $.ajax({
                     url: '/edit_navlog',
                     data: data,
                     success: function (result) {
                       if(result.success==true && result.paxs!=null) {
                         var str=`<ul  style='width: 40px !important; display: none;'>`;
                         for(var i=0;i<=parseInt(result.paxs.max_pax);i++){
                            str+=`<li><a>${i}</a></li>`;
                          }
                         str+=`</ul>`
                          $("#ddpax7").append(str);
                          if(result.data.max_pax>14)
                             $("#rules7").addClass('paxdl');
                          else
                            $("#rules7").removeClass('paxdl');   
                        }
                         if(result.success==true){
                            $("#chg_navlog").html('CHANGE NAV LOG '+result.data.navlog_no);
                            $("#navlog_masterid").val(result.data.navlog_masterid);
                            $("#navlog_id").val(result.data.id);
                            $("#callsign7").val(result.data.callsign).removeClass('border_red');
                            $("#aircraft7").val(result.data.registration).removeClass('border_red');
                            //if(result.data.registration.substr(0,2)=='vt'|| result.data.registration.substr(0,2)=='VT')
                                $("#aircraft7").attr("disabled", true).addClass('pace_name');
                            /*else {    
                                $("#aircraft7").removeClass('pace_name');
                                $("#aircraft7").attr("disabled", false);
                            }*/
                            $("#departure7").val(result.data.departure).removeClass('border_red');
                            if(result.data.dep_airport_name!='')
                              $("#departure7_lbl").text(result.data.dep_airport_name).removeClass('border_red');
                            $("#destination7").val(result.data.destination).removeClass('border_red');
                            if(result.data.dest_airport_name!='')
                              $("#destination7_lbl").text(result.data.dest_airport_name).removeClass('border_red');
                            $("#flight_date7").val(result.data.flight_date).removeClass('border_red');
                            $("#dept_time7_lbl").text(result.data.deptime_ist);
                            $("#hhdept_time7").val(result.data.dep_time.substr(0,2));
                            $("#mmdept_time7").val(result.data.dep_time.substr(2,2));
                            // $("#pax_value7").text(result.data.pax).css({'font-weight':'bold','font-size':'14px','line-height': '1.2'});
                            $("#pax7").val(result.data.pax);
                            $("#rules7_lbl").removeClass('hide');
                            $("#rules7").removeClass('border_red');
                            $("#load7").val(result.data.load).removeClass('border_red');
                            $("#fuel7").removeClass('border_red');
                            if(result.data.min_max==1)
                               $("#min_7").attr('checked', true);
                            if(result.data.min_max==2)
                               $("#max_7").attr('checked', true);
                            if(result.data.min_max==3)
                               $("#norefuel_7").attr('checked', true);
                            if(result.data.fuel!=0){
                               $("#fuel7").val(result.data.fuel);
                            }
                            if(result.data.remarks!=''){
                              $("#remarks7").val(result.data.remarks);  
                            }
                            if(result.data.dept_lat!=null){
                              $("#dept_lat7").val(result.data.dept_lat);  
                            }
                            if(result.data.dept_place!=null){
                              $("#dept_place7").val(result.data.dept_place);  
                            }
                            if(result.data.dest_place!=null){
                              $("#dest_place7").val(result.data.dest_place);  
                            }
                            if(result.data.dest_lat!=null){
                              $("#dest_lat7").val(result.data.dest_lat);  
                            }
                         }
                     }
                 });
             })
                   
                                  function validation(id_no){
                                      
                                       var flights_no=$("#no_of_flight"+id_no).text();
                                       var is_flights_no=false;
                                       if(flights_no!="SELECT"){
                                        is_flights_no=true;
                                       }
                                       else
                                        is_flights_no=false;

                                         var callsign=$("#callsign"+id_no).val();
                                         var is_callsign=false;
                                         if(callsign.length>=5){
                                           is_callsign=true;
                                         }  
                                         else{
                                           is_callsign=false;
                                         }
                                         var aircraft=$("#aircraft"+id_no).val();
                                         var is_aircraft=false;
                                         if(aircraft.length>=5){
                                           is_aircraft=true;
                                         }  
                                         else{
                                           is_aircraft=false;
                                         }
                                         var dept=$("#departure"+id_no).val();
                                         var is_dept=false;
                                         if(dept.length>=4){
                                           is_dept=true;
                                         }  
                                         else{
                                           is_dept=false;
                                         }

                                         var dest=$("#destination"+id_no).val();
                                         var is_dest=false;
                                         if(dest.length>=4){
                                           is_dest=true;
                                         }  
                                         else{
                                           is_dest=false;
                                         }

                                         var flight_date=$("#flight_date"+id_no).val();
                                         var is_flight_date=false;
                                         if(flight_date!=""){
                                           is_flight_date=true;
                                         }  
                                         else{
                                           is_flight_date=false;
                                         }
                                         if(id_no!=7){ 
                                           var hhdept_time=$("#hhdept_time"+id_no).val();
                                           var is_hhdept_time=true;
                                           var is_mmdept_time=true;
                                           if(hhdept_time.length>=2){
                                             is_hhdept_time=true;
                                             var is_mmdept_time=false;
                                           }  
                                           else if (hhdept_time.length>=1 && hhdept_time.length<2){
                                             is_hhdept_time=false;
                                           }

                                           var mmdept_time=$("#mmdept_time"+id_no).val();
                                           
                                           if(mmdept_time.length>=2){
                                             is_mmdept_time=true;
                                           }  
                                           else if (mmdept_time.length>=1 && mmdept_time.length<2){
                                             is_mmdept_time=false;
                                           }
                                         }
                                         else{
                                               var is_hhdept_time=true;
                                               var is_mmdept_time=true;
                                         }
                                         var pax=$("#pax"+id_no).val();
                                         var is_pax=true;
                                         // if(pax.length>=1){
                                         //  is_pax=true;
                                         //  closePopover("#pax"+id_no); 
                                         // }
                                         // else
                                         //  is_pax=false;

                                         var cargo=$("#load"+id_no).val();
                                         var is_cargo=true;
                                         if(cargo.length>=2){
                                           is_cargo=true;
                                         }  
                                         else if(cargo.length>=1 && cargo.length<2){
                                           is_cargo=false;
                                         }
                                         
                                         var fuel=$("#fuel"+id_no).val();
                                         var is_fuel=true;
                                         if(fuel.length>=3 || $('#min_'+id_no).prop('checked')==true || $('#max_'+id_no).prop('checked')==true|| $('#norefuel_'+id_no).prop('checked')==true){
                                           is_fuel=true;
                                         }  
                                         else if(fuel.length>=1 && fuel.length<3){
                                           is_fuel=false;
                                         }

                                         var is_max_fuel=true;
                                         if(fuel.length>=3 && callsign.length>=5){
                                              var max_fuel=max_fuel_check(fuel,callsign);
                                              if(parseInt(max_fuel)<parseInt(fuel)){
                                                 is_max_fuel=false;
                                               }
                                              else 
                                                is_max_fuel=true;
                                         }
                                         var remarks=$("#remarks"+id_no).val();
                                         var is_remarks=true;
                                         if(remarks.length>=3){
                                           is_remarks=true;
                                         }  
                                          else if(remarks.length>=1 && remarks.length<3){
                                           is_remarks=false;
                                         }

                                         
                                         var dept_place=$("#dept_place"+id_no).val();
                                         var is_dept_place=true; 
                                         if(dept=='zzzz'||dept=='ZZZZ'){
                                              if(dept_place.length>=3){
                                                is_dept_place=true;
                                              }  
                                              else if(dept_place.length<3){
                                                is_dept_place=false;
                                              }
                                         }

                                         var dept_lat=$("#dept_lat"+id_no).val();
                                         var is_dept_lat=true; 
                                         if(dept=='zzzz'||dept=='ZZZZ'){
                                              if(dept_lat.length>=11){
                                                is_dept_lat=true;
                                              }  
                                              else if(dept_lat.length<11){
                                                is_dept_lat=false;
                                              }
                                         }
                                        
                                         var dest_place=$("#dest_place"+id_no).val();
                                         var is_dest_place=true; 
                                         if(dest=='zzzz'||dest=='ZZZZ'){
                                              if(dest_place.length>=3){
                                                is_dest_place=true;
                                              }  
                                              else if(dest_place.length<3){
                                                is_dest_place=false;
                                              }
                                         }

                                         var dest_lat=$("#dest_lat"+id_no).val();
                                         var is_dest_lat=true; 
                                         if(dest=='zzzz'||dest=='ZZZZ'){
                                              if(dest_lat.length>=11){
                                                is_dest_lat=true;
                                              }  
                                              else if(dest_lat.length<11){
                                                is_dest_lat=false;
                                              }
                                         }

                                         
                                         console.log("is_flights_no="+is_flights_no);
                                         console.log("is_callsign="+is_callsign);
                                         console.log("is_aircraft="+is_aircraft);
                                         console.log("is_dept="+is_dept);
                                         console.log("is_dest="+is_dest);
                                         console.log("is_flight_date="+is_flight_date);
                                         console.log("is_hhdept_time="+is_hhdept_time);
                                         console.log("is_mmdept_time="+is_mmdept_time);
                                         console.log("is_pax="+is_pax);
                                         console.log("is_cargo="+is_cargo);
                                         console.log("is_fuel="+is_fuel);
                                         console.log("is_max_fuel="+is_max_fuel); 
                                         console.log("is_remarks="+is_remarks);
                                         console.log("is_dept_place="+is_dept_place);
                                         console.log("is_dept_lat="+is_dept_lat);
                                         console.log("is_dest_place="+is_dest_place);
                                         console.log("is_dest_lat="+is_dest_lat);
                                                        
                                         // if(is_callsign==true && is_aircraft==true && is_dept==true && is_dest==true && is_flight_date==true && is_hhdept_time==true && is_mmdept_time==true && is_pax==true && is_flights_no==true && is_cargo==true && is_pilot==true && is_mobile==true && is_co_pilot==true && is_fuel==true && is_level1==true && is_mainroute==true && is_remarks==true && is_alternate1==true && is_level2==true && is_alternate1route==true && is_alternate2==true && is_level3==true && is_alternate2route==true && is_take_off_alt==true && is_level4==true && is_takeoff_alternate_route==true && is_dept_place==true && is_dept_lat==true && is_dest_place==true && is_dest_lat==true && is_pilot_copilot_diff==true && is_max_fuel==true && is_text_speed==true){
                                         //      $("#submit_lbl"+id_no).prop("disabled",false);
                                         // }
                                         // else if(is_callsign==false||is_aircraft==false || is_dept==false || is_dest==false || is_flight_date==false || is_hhdept_time==false || is_mmdept_time==false || is_pax==false || is_flights_no==false || is_cargo==false || is_pilot==false || is_mobile==false || is_co_pilot==false || is_fuel==false || is_level1==false || is_mainroute==false || is_remarks==false || is_alternate1==false || is_level2==false || is_alternate1route==false || is_alternate2==false || is_level3==false ||is_alternate2route==false || is_take_off_alt==false ||is_level4==false||is_takeoff_alternate_route==false||is_dept_place==false|| is_dept_lat==false ||is_dest_place==false|| is_dest_lat==false||is_pilot_copilot_diff==false || is_max_fuel==false || is_text_speed==false){
                                         //      $("#submit_lbl"+id_no).prop("disabled",true);
                                         // }
                                         if(is_flights_no==true && is_callsign==true && is_aircraft==true && is_dept==true && is_dest==true && is_flight_date==true && is_cargo==true && is_fuel==true && is_remarks==true && is_hhdept_time==true && is_mmdept_time==true && is_dept_place==true && is_dept_lat==true && is_dest_place==true && is_dest_lat==true){
                                              $("#submit_lbl"+id_no).prop("disabled",false);
                                         }
                                         else if(is_flights_no==false || is_callsign==false||is_aircraft==false || is_dept==false || is_dest==false || is_flight_date==false || is_cargo==false || is_remarks==false || is_hhdept_time==false ||is_mmdept_time==false || is_dept_place==false || is_dept_lat==false || is_dest_place==false || is_dest_lat==false || is_fuel==false){
                                              $("#submit_lbl"+id_no).prop("disabled",true);
                                         }
                                  }
              $('.update_navlog').on('submit',function (event){
                 event.preventDefault();
                 var ist= $(this).parents('.panel').find('.dept_time_lbl').text();
                 var slide_count=$(this).parents('.panel').attr('data-slidecount');
                 var flight_date=$(this).parents('.panel').find('.flightdate').val();
                 var callsign=$(this).parents('.panel').find('.callsign').val();
                 var registration=$(this).parents('.panel').find('.aircraft').val();
                 var departure=$(this).parents('.panel').find('.departure').val();
                 var destination_airportname=$(this).parents('.panel').find('.destination_lbl').text();
                 var dept_time_id=$(this).parents('.panel').find('.departuretime').attr('id');
                 var destination=$(this).parents('.panel').find('.destination').val();
                 var pax=$(this).parents('.panel').find('.pax').val();
                 var load=$(this).parents('.panel').find('.load').val();
                 var fuel=$(this).parents('.panel').find('.fuel').val();
                 var min_max = $(this).parents('.panel').find($("input[name='min_max']:checked")).val();
                 var dept_place=$(this).parents('.panel').find('.dept_place').val();
                 var dept_lat=$(this).parents('.panel').find('.dept_lat').val();
                 var dest_place=$(this).parents('.panel').find('.dest_place').val();
                 var dest_lat=$(this).parents('.panel').find('.dest_lat').val();
                 var remarks=$(this).parents('.panel').find('.remarks').val();
                 var hhdept_time=$(this).parents('.panel').find('.hhdeparturetime').val();
                 var mmdept_time=$(this).parents('.panel').find('.mmdeparturetime').val();
                 var hhdept_time_id=$(this).parents('.panel').find('.hhdeparturetime').attr('id');
                 var mmdept_time_id=$(this).parents('.panel').find('.mmdeparturetime').attr('id');
                 var bool=true;
                 if(pax==""){
                     errorPopover('#'+$(this).parents('.panel').find('.Paxrules').attr('id'),'Min. 2 & Max. 4 Characters, only Numbers allowed');
                     bool=false;
                 }
                 if(load.length>=1 && load.length<2){
                     errorPopover('#'+$(this).parents('.panel').find('.load').attr('id'),'Min. 2 & Max. 4 Characters, only Numbers allowed');
                     bool=false;
                 }
                 if(fuel.length>=1 && fuel.length<3){
                     errorPopover('#'+$(this).parents('.panel').find('.fuel').attr('id'),"Min. 3 & Max. 5 Characters, only Numbers allowed");
                      bool=false;
                 }
                 else if(fuel.length>=3){
                   var max_fuel=max_fuel_check(fuel,$(this).parents('.panel').find('.callsign').val(),$(this));
                   console.log('max_fuel_update'+max_fuel);
                   if(parseInt(max_fuel)<parseInt(fuel)){
                      errorPopover('#'+$(this).parents('.panel').find('.fuel').attr('id'),"Max Fuel Should be less than "+max_fuel);
                      bool=false;
                    }
                 } 
                 if(remarks.length>=1 && remarks.length<3){
                     errorPopover('#'+$(this).parents('.panel').find('.remarks').attr('id'),'Min. 3 & Max. 150 character allowed');
                     bool=false;
                 }
                  if(mmdept_time.length<2 && mmdept_time.length>=1){
                      $(this).parents('.panel').find('.subdomaintwoleft').addClass('border_red');
                      errorPopover('#'+$(this).parents('.panel').find('.mmdeparturetime').attr('id'),'Enter Departure Time');
                      bool=false;
                  }
                  if(hhdept_time.length<2 && hhdept_time.length>=1){
                      $(this).parents('.panel').find('.subdomaintwoleft').addClass('border_red');
                      errorPopover('#'+$(this).parents('.panel').find('.hhdeparturetime').attr('id'),'Enter Departure Time');
                      bool=false;
                  }
                 //  else if(hhdept_time.length==2 && mmdept_time.length==2 && $(this).parents('.panel').find('.editflightdate').val()!="")
                 //  {
                 //     var result=CheckDeptTime(hhdept_time,mmdept_time,$(this).parents('.panel').attr('data-slidecount'),$(this).parents('.panel').find('.editflightdate').datepicker('getDate'));
                 //    if((result.utc_depttime_getTime<result.utc_1hr_getTime)){
                 //       errorPopover('#'+$(this).parents('.panel').find('.hhdeparturetime').attr('id'),"Enter minimum 30 min from current UTC time");
                 //       errorPopover('#'+$(this).parents('.panel').find('.mmdeparturetime').attr('id'),"Enter minimum 30 min from current UTC time");
                 //       bool=false;
                 //    }
                 // }
                 if(bool==false)
                    return false;  
                 $('body').addClass('body_padding');
                $('#editplan').modal('hide');
                $('.overlay').css('height',0);
                $('.overlay').css('height', $(document).height());
                $(".overlay").show(); 
                console.log($(this).serialize());
                 var data=$(this).serialize()+'&btnvalue='+$(this).find('.button_next_main').text()+'&pax='+pax+'&dep_airport_name='+$(this).parents('.panel').find('.departure_lbl').text()+'&dest_airport_name='+$(this).parents('.panel').find('.destination_lbl').text()+'&deptime_ist='+ ist+'&dep_time='+$(this).parents('.panel').find('.hhdeparturetime').val()+$(this).parents('.panel').find('.mmdeparturetime').val();
                 if(min_max==undefined)
                       data=data+'&min_max='+''; 
                  $.ajax({
                         context : this,  
                         type: "POST",  
                         url: $(this).attr('action'),
                         headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                         dataType:"json",
                         data:data,
                         success: function(result) 
                         {
                          if(result.updated==true){
                               var c_sign=$("#callsign7").val();
                               $("#mysuccess").removeClass('hide');
                               $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font" style="font-size: 15px;!important">' + c_sign +' PLAN UPDATED SUCCESSFULLY' + '</div>');
                               hidemsg();
                          }
                            $(".overlay").fadeOut();
                            var data_url = '/navlog_get_test_filter_data';
                            $(".dt_loading").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
                         if(result.updated==true){
                           $.ajax({
                                url: data_url,
                                type: 'POST',
                                data: {'clicked_btn':localStorage.getItem("test_clicked_btn")},
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                },
                                success: function (data, textStatus, jqXHR) {
                                    $("#result").html(data);
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown)
                                 }
                               });
                              }

                           }
                     });
             });
    </script>
    @stop