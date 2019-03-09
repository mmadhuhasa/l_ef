@extends('layouts.check_quick_plan_layout',array('1'=>'1'))

@section('content')
<div class="page" id="quick_app">
    <style>
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
        /*.btn-red{
            background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b)) !important;
        }*/
        .desk-view {
            margin: 0 0;
        }

        #qucik_responce .popover{
            background: transparent;
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

        .desk-plan .form-control[disabled],.desk-plan .form-control[readonly],.desk-plan fieldset[disabled] .form-control {background: #fff;border-radius: 0;}
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
        #from_date {text-align: center;font-size: 14px;font-weight: normal;color: #222;}
        #to_date {padding-left: 5px;font-size:14px;font-weight: normal;color: #222;text-align: left;width:139%;border-radius: 5px;}
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
        .desk-plan>thead>tr>th{padding:4px 1px 4px 1px;border:1px solid #333;text-transform: uppercase;}
        .desk-plan>tbody>tr>td{padding:0px;border:1px solid #333;text-transform: uppercase;}
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
        .desk-plan .form-control{height: 32px;border: none!important;border-radius: 0;}
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
        .saveicon_record:hover {
            color: #ff0000;
        }
        .edit_handler, .viewhistory, .edit_handler_new{
            visibility: hidden;
            
        }
        .table-hover>tbody>tr:hover .edit_handler {
            visibility:visible;
        }
        .table-hover>tbody>tr:hover .edit_handler_new {
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
            /*left: 40px!important;*/
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
    padding-bottom:15px;
}
.slno_handler{
    width:2%!important;
}
.code_handler{
    width:3%!important;
}
.basicrate_handler{
    width:4%!important;
}
.total_handler{
    width:3%!important;
}
.city_handler{
    width:10%!important; 
}
.handler_handler{
    width:18%!important;
}
.callsign_handler{
   width:18%!important; 
}
.action_handler{
  width:10%!important;  
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
  width:370px;   
}
.pright5{
padding-right:5px;
}
.pleft5{
padding-left:5px;    
}
.border_bottom{
  border: 1px solid red !important;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: white;
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
.align_center{
    text-align: center;
    box-shadow: none;  
}
.coloraddEditable {
    background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858))!important;
    color:#fff!important;
    outline: none;
}
.save_handler{
    display: none
}
.disable {
    pointer-events: none;
}
.action_search{
    width:5%!important;
}
.gst_search{
  width:4%!important;  
}
.royality_search{
  width:4%!important;  
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
.airport_autocomplete{
    font-size: 12px;
}    
.growl.growl-small {
    text-align:center;
 }
 .growl.growl-medium {
    text-align:center;
 }
 .border_right{
     border-right:1px solid #fff!important;
 }
  #handler_serach_list_previous, #handler_serach_list_next,#handler_info_previous, #handler_info_next {
    display: none;
}
a:focus, a:hover {
    color: #000;
    text-decoration: none;
}
.alertmessage_validation{
    text-align: center;
    font-size: 18px;
}
/*model open padding right*/
.test[style] {
    padding-right:0;
}
.test.modal-open {
    overflow: auto;
}
/*model open padding right*/
</style>
    @include('includes.new_header',[])
     <div class="overlay">
        <img class="img_loader" src="{{url('media/images/loader.gif')}}"/>
    </div> 
    <main>
        <div class="container" style="margin-bottom: 10px;">
            <div class="fpl_sec">
                <div class="row">
                        <div class="col-md-12">
                            <p class="search_heading">HANDLER DETAILS</p>
                        </div>
                        <div class="col-md-12 q_filter">
                                <div class="col-md-1 tooltip_rel style_plus_wrapper" style="width:2%;margin-left:2%;">
                                    <a data-toggle="modal" data-target="#Addhandler" style="cursor:pointer;"  class="style_plus_price" id="add-fuel-airport">
                                        <i class="fa fa-plus add_license"></i>
                                    </a>
                                    <span class="tooltip_cust">ADD</span>
                                    <span class="tooltip_tri_shape1" style="right:7px;"></span>
                                </div>
                               <form id="search_handler" method="POST" action="{{url('handling')}}"> 
                                {{csrf_field()}}
                                <div class="col-sm-4">
                                    <div class="form-group">
                                     <div class="input-group">
                                        <input type="text" class="form-control text-center text_uppercase alphabets font-bold" id="aero" name="aero" style="text-align:center;" placeholder="Airport" value="{{$aero}}" maxlength="3" autocomplete="off">
                                        <div class="input-group-addon search-addon">
                                            <button type="submit" name="search" id="3rd_search" value="3rd_search" class="btn newbtnv1"><span class="glyphicon glyphicon-search"></span></button>
                                        </div>
                                      </div>
                                    </div>
                                </div>

                                <div class="col-sm-4" style="width:37%;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control  text-center text_uppercase alphabets_with_space font-bold ui-autocomplete-input" id="handler" minlength="4" maxlength="3" name="handler" placeholder="HANDLER" autocomplete="off" value="{{$handler}}" autocomplete="off">
                                            <div class="input-group-addon search-addon">
                                                <button type="submit" name="search" value="first_search" id="first_search" class="btn newbtnv1"><span class="glyphicon glyphicon-search"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control text-center text_uppercase special_symbols font-bold ui-autocomplete-input" id="callsign_info" minlength="5" maxlength="3" name="callsign_info" placeholder="CALLSIGN" autocomplete="off" value="{{$callsign}}" autocomplete="off">
                                            <div class="input-group-addon search-addon">
                                                <button type="submit" name="search" value="2nd_search" id="2nd_search" class="btn newbtnv1"><span class="glyphicon glyphicon-search"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               </form>  
                        </div>     
                </div> <!--row close here-->                
        </div>
        <?php $sr=1;?>
        <div class="col-md-12 tablewrapper">
        <table class="table table-hover table-responsive desk-plan" id="handler_serach_list">
                <thead>
                    <tr>
                        <th class="slno_handler two_main_th">SL</th>
                        <th class="code_handler two_main_th">CODE</th>
                        <th class="city_handler two_main_th">CITY</th>
                        <th class="handler_handler two_main_th">HANDLER</th>
                        <th class="callsign_handler two_main_th">CALLSIGN</th>
                        <th class="basicrate_handler two_main_th">BASIC</th>
                        <th class="two_main_th royality_search">AAI%</th>
                        <th class="two_main_th gst_search">TAX</th>
                        <th class="total_handler two_main_th">TOTAL</th>
                        <th class="two_main_th action_search">ACTION</th>
                    </tr>
                </thead>
                <tbody class="main_table">
                 @foreach($handlinglist as $handler)
                   <tr id="record_{{$handler['id']}}">
                    <td>{{$sr++}}</td>
                    <td id="airport_code_{{$handler['id']}}">{{$handler['airport_code']}}</td>
                    <td id="city_{{$handler['id']}}">{{$handler['city']}}</td>
                    <td>
                       <input type="text" class="form-control align_center alphabets_with_space font-bold handler" minlength="2" maxlength="25"  placeholder="Handler" autocomplete="off" value="{{$handler['handler_name']}}" readonly id="handler_{{$handler['id']}}" autocomplete="off" data-placement="top" data-value="{{$handler['handler_name']}}" style="background: none;">
                    </td>
                    <td>
                      @foreach($handler['callsign_list'] as $key=>$callsign)
                      {{$callsign}}@if($key!=count($handler['callsign_list'])-1),@endif 
                      @endforeach
                      <!--  <input type="text" class="form-control align_center special_symbols font-bold callsign"  maxlength="7" placeholder="Callsign" autocomplete="off" value="{{$handler['callsign_list']}}" readonly id="callsign_{{$handler['id']}}" autocomplete="off" data-placement="top" data-value="{{$handler['callsign_list']}}"> -->
                    </td>
                    <td class="edittd">
                        <input type="text" class="form-control align_center numbers font-bold edit basic_rate"  maxlength="6"  placeholder="Basic Rate" autocomplete="off" value="{{$handler['basic_rate']}}" readonly id="basic_rate_{{$handler['id']}}" autocomplete="off" data-placement="top" data-value="{{$handler['basic_rate']}}" style="background: none;">
                    </td>
                    <td class="edittd">
                       <input type="text" class="form-control align_center number font-bold edit royalty" data-v-max="99.99" data-m-dec="2" name="" placeholder="Royalty" autocomplete="off" value="{{$handler['royalty']}}" readonly id="royalty_{{$handler['id']}}" autocomplete="off" data-placement="top" data-value="{{$handler['royalty']}}" style="background: none;">
                    </td>
                    <td id="gst_amount_{{$handler['id']}}" data-value="{{$handler['gst']}}">{{$handler['gst']}}</td>
                    <td id="total_{{$handler['id']}}" data-value="{{$handler['total']}}">{{$handler['total']}}</td>
                    <td class="one_main_table_td">
                        <div class="tooltip_rel">
                            <a class="edit_handler" id="edit_handler" data-id="{{$handler['id']}}">
                              <i class="fa fa-pencil-square pencil_fuel_price"></i>
                            </a>
                            <span class="p-l-9"></span>
                            <span class="tooltip_edit_position" style="left:-16px;">Edit Rate</span>
                            <span class="tooltip_tri_shape1"></span>
                        </div>
                        <div class="tooltip_rel">
                            <a class="edit_handler_new" data-id="{{$handler['id']}}">
                              <i class="fa fa-pencil-square pencil_fuel_price"></i>
                            </a>
                            <span class="p-l-9"></span>
                            <span class="tooltip_edit_position" style="left:-16px;">Edit handler</span>
                            <span class="tooltip_tri_shape1"</span>
                        </div>
                        <div class="tooltip_rel" >
                            <a class="viewhistory" id="historyicon" data-toggle="modal" data-target="#ViewHistory" style="cursor:pointer;" data-id="{{$handler['id']}}">
                                <i class="fa fa-history pencil_fuel_price"></i>
                            </a>
                            <span class="p-l-9"></span>
                            <span class="tooltip_edit_position t_vh" style="left:-30px;">History</span>
                            <span class="tooltip_tri_shape2"></span>
                        </div>
                        <div class="tooltip_rel" >
                            <a class="save_handler" id="saveicon" style="cursor:pointer;" data-id="{{$handler['id']}}">
                               <i class="fa fa-floppy-o saveicon_record" aria-hidden="true"></i>
                            </a>
                            <span class="p-l-9"></span>
                            <span class="tooltip_edit_position t_vh" style="left:-16px;">Save</span>
                            <span class="tooltip_tri_shape2" style="right:4px;"></span>
                        </div>
                    </td>
                    </tr>
                 @endforeach
                </tbody>
        </table>
        </div>

    </div>
</main>
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
<!-- Modal -->
<div class="modal fade" id="ViewHistory" role="dialog">
    <div class="modal-dialog" style="width:800px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                <h4 class="modal-title">HISTORY</h4>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;padding-top:0px;">
                <table class="fuel_info history_fuel table table-hover table-responsive desk-plan" style="width:100%;" id="handler_info">
                    <thead style="background: #333;">
                        <tr>
                            <th style="width:20px !important;" class="border_right">Sl</th>
                            <th style="width:35px !important;" class="border_right">ACTIONS</th>
                            <th style="width:70px !important;" class="border_right">CALLSIGN</th>
                            <th style="width:30px !important;" class="border_right">HANDLER</th>
                            <th style="width:60px !important;" class="border_right">BASIC RATE</th>
                            <th style="width:60px !important;" class="border_right">ROYALTY</th>
                            <th style="width:100px !important;" class="border_right">DATE AND TIME</th>
                            <th style="width:50px !important;" class="">BY</th>
                        </tr>
                    </thead>
                    <tbody id="fuel_info_tbody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="Addhandler" role="dialog">
    <div class="modal-dialog addhandler_model">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                <h4 class="modal-title">ADD HANDLER</h4>
            </div>
              <form id="add_handler_form" action="{{url('handling/store')}}" method="post">
                <div class="modal-body">
                    <div class="col-sm-6 pright5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets form-control modtooltip ui-autocomplete-input readonly" placeholder="AIRPORT CODE"  name="airport_code" autocomplete="off" data-placement="top" id="airport_code" maxlength="3" >
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase special_symbols form-control modtooltip ui-autocomplete-input readonly" placeholder="CALL SIGN"  name="callsign" autocomplete="off" data-placement="top" id="callsign" maxlength="7">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets_with_space form-control modtooltip ui-autocomplete-input readonly" placeholder="HANDLER NAME"  id="handler_name" name="handler_name" autocomplete="off" data-placement="top" style=";text-transform: uppercase;" maxlength="25">
                        </div>
                    </div>
                    <div class="col-sm-6 pright5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase  numbers form-control modtooltip ui-autocomplete-input readonly" placeholder="BASIC RATE"  name="basic_rate" id="basic_rate" autocomplete="off" data-placement="top" maxlength="6" >
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase number form-control modtooltip ui-autocomplete-input readonly" placeholder="ROYALTY" name="royalty" autocomplete="off" id="royalty" data-placement="top"   data-v-max="99.99" data-m-dec="2">
                        </div>
                    </div>
                    <div class="col-sm-6 pright5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase number form-control modtooltip ui-autocomplete-input" placeholder="GST AMOUNT"  name="gst_amount" id="gst_amount" autocomplete="off" data-placement="top"  readonly>
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase number form-control modtooltip ui-autocomplete-input" placeholder="TOTAL"  name="total"  id="total" autocomplete="off" data-placement="top" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding:0px 0px 10px 0px;">
                    <div class="col-sm-12"><button type="submit" class="btn  newbtnv1" style="width:100px;" id="add_handler_btn">ADD</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="edit_handler_newpopup" role="dialog">
    <div class="modal-dialog addhandler_model">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                <h4 class="modal-title">EDIT HANDLER</h4>
            </div>
              <form method="post"  action="{{url('handling/update-handler')}}" id="update_handler">
                {{csrf_field()}}
                <input type="hidden" id="current_handler_name">
                <div class="modal-body">
                    <div class="col-sm-6 pright5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets form-control modtooltip ui-autocomplete-input" placeholder="AIRPORT CODE"  name="airport_code" autocomplete="off" data-placement="top" id="edit_airport_code" maxlength="3" readonly style="background-color: #eee;">
                        </div>
                    </div>
                    <div class="col-sm-6 pleft5">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase special_symbols form-control modtooltip ui-autocomplete-input readonly" placeholder="CALL SIGN"  name="callsign" autocomplete="off" data-placement="top" id="edit_callsign" data-placement="top" maxlength="3">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets_with_space form-control modtooltip ui-autocomplete-input" placeholder="HANDLER NAME"  id="edit_handler_name" name="handler_name" autocomplete="off" data-placement="top" style=";text-transform: uppercase;" maxlength="25" data-placement="top" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding:0px 0px 10px 0px;">
                    <div class="col-sm-12"><button type="submit" class="btn  newbtnv1" style="width:100px;" >UPDATE</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->


<div id='v_toTop'><span></span></div>
@include('includes.new_footer',[])
</div>
<script>
   $(document).ready(function() {
    $(document).on("focusin",".royalty",function(e){
         if($(this).val().length==5){
           $(this).select();  
         }
     });
    $(document).on("focusin",".basic_rate",function(e){
         if($(this).val().length>=4){
           $(this).select();  
         }
     });
    $('#Addhandler,#ViewHistory,#edit_handler_newpopup').on('show.bs.modal', function (e) {
     $('body').addClass('test');
    });
    $(document).on("submit","#edit_handler",function(e){
      e.preventDefault();
   }); 
   $('.edit_handler_new').click(function(){
         var id=$(this).attr('data-id');
         console.log('id is'+id);
         var edit_airport_code=$('#airport_code_'+id).text()+' - '+$('#city_'+id).text();
         $("#current_handler_name").val($('#handler_'+id).val());
         $("#edit_airport_code").val(edit_airport_code); 
         $('#edit_handler_newpopup').modal('show');
         $.ajax({
            url: '/handling/autosuggest_callsign_airportcode',
            dataType:"json",
            type:"post",
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            data:{'airport_code': $('#edit_airport_code').val()},    
            success: function(result)
            {
                $("#edit_callsign").autocomplete({
                   "ui-autocomplete": "xyz",
                    source: result,
                    selectFirst: true,
                    minLength: 3,
                    select: function (event, ui) 
                    {
                        closePopover('#'+$(this).attr('id'));
                    }
                });
            }});
         
   });

   $(".number").autoNumeric("init",{ aSep: ''});
    function errorPopover(id, message) {

          $(id).addClass('border_bottom');
          $(id).attr('data-content', message);   
          $(id).popover( {trigger : 'hover'}); 
    }
   function closePopover(id) {
            $(id).popover('destroy');
            $(id).removeClass('border_bottom');
            $(id).css({"border-color": "#a6a6a6"});
            $(this).next().css('display','none');
   }
   $(document).on("keypress",".special_symbols",function(e){
          if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 48 && e.charCode <= 57) ||(e.charCode==0))
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
   $(document).on("keypress",".numbers",function(e){  
          if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode > 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
          return false;
          else
          return true;    
   });
   $(document).on("click",".viewhistory",function()
   {   $("#fuel_info_tbody").empty();
       var handlerid=$(this).attr('data-id');

       viewhistory(handlerid)
   });    
   function viewhistory(handlerid)
   {

     $('#handler_info').DataTable( {
                destroy: true,   
               "serverSide": true,
               "pageLength":10,
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
           ],
            "ajax":"/handling/viewhistory?handlerid="+handlerid,
       });
   }
   $('#handler_serach_list').DataTable({
       
       "pageLength":15,
       "lengthChange": false,
       "aaSorting": [],
       "searching": false,
       "bInfo" : false,
       "processing": true,
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
           {"bSortable": false},   
           ]
   });
   function handlerlist()
        {

          $('#handlerlist').DataTable( {
                     destroy: true,   
                    "serverSide": true,
                    "pageLength":10,
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
                    {"bSortable": false}
                ],
                 "ajax":"/handlinglist",
            });
        }
   $(document).on("keyup","#airport_code",function(e){ 
       if($(this).val().length ==4){   

         closePopover("#"+$(this).attr('id'));
         $("#callsign").focus();
       }  
   });  
   $(document).on("keyup","#callsign,#callsign_info,.callsign",function(e){ 
       if($(this).val().length >=5){   
         closePopover("#"+$(this).attr('id'));
       }  
       if($(this).val().length ==5 && $(this).attr('id')=='callsign'){   
         $("#handler_name").focus();
       }  
   });  
   $(document).on("keyup","#handler_name,#handler,.handler",function(e){ 
       if($(this).val().length >=2){   
         closePopover("#"+$(this).attr('id'));
       }  
   });  
   $(document).on("keyup","#basic_rate,.basic_rate",function(e){ 
       if($(this).val().length >=4){   
         closePopover("#"+$(this).attr('id'));
       }  
       calculation();
   });   
    $(document).on("keyup","#royalty,.royalty",function(e){ 
       if($(this).val().length >=2){   
         closePopover("#"+$(this).attr('id'));
       }    
       calculation();
   });   
   $(document).on("blur","#royalty",function(e){ 
       if($(this).val().length >=5){   
         closePopover("#"+$(this).attr('id'));
       }  
   }); 
   function calculation()
   {
       if($("#basic_rate").val()!='' && $("#royalty").val()!='')
       {
          var gst =Math.ceil((parseInt($("#basic_rate").val())+(parseInt($("#basic_rate").val())*.21)) * .18);
          var total=gst+parseInt($("#basic_rate").val())+Math.ceil((parseInt($("#royalty").val())/100)*parseInt($("#basic_rate").val()));
          $("#gst_amount").val(gst);
          $("#total").val(total);
       }
       else{
         $("#gst_amount").val('');
          $("#total").val('');
        }
   } 
   $(document).on("keyup",".basic_rate",function(e){ 
       if($(this).val().length >=4){   
         closePopover("#"+$(this).attr('id'));
       }
       var handler_id=$(this).attr('id').substr(11);
       edit_calculation(handler_id);
   });   
    $(document).on("keyup",".royalty",function(e){ 
       if($(this).val().length >=2){   
         closePopover("#"+$(this).attr('id'));
       }    
       var handler_id=$(this).attr('id').substr(8); 
       edit_calculation(handler_id);
   }); 
   function edit_calculation(handler_id)
   {  
       if($("#basic_rate_"+handler_id).val()!='' && $("#royalty_"+handler_id).val()!='')
       {
          var gst =Math.ceil((parseInt($("#basic_rate_"+handler_id).val())+(parseInt($("#basic_rate_"+handler_id).val())*(parseInt($("#royalty_"+handler_id).val())/100))) * .18);
          var total=gst+parseInt($("#basic_rate_"+handler_id).val())+Math.ceil((parseInt($("#royalty_"+handler_id).val())/100)*parseInt($("#basic_rate_"+handler_id).val()));
          $("#gst_amount_"+handler_id).html(gst);
          $("#total_"+handler_id).html(total);
       }
       else{
         $("#gst_amount_"+handler_id).html('');
          $("#total_"+handler_id).html('');
        }
   } 
   $.ajax({
    url: '/handling/autosuggest_callsign',
    dataType:"json",  
    success: function(result)
    {
        $("#callsign_info").autocomplete({
            source: result,
            selectFirst: true,
            minLength: 2,
            select: function (event, ui) 
            {
                $("#callsign_info").css('border','1px solid #999');
                closePopover("#callsign_info");
            }
        });
    }});
    $.ajax({
   url: '/handling/autosuggest_handler',
   dataType:"json",  
   success: function(result)
   {
       $("#handler").autocomplete({
           source: result,
           selectFirst: true,
           minLength: 2,
           select: function (event, ui) 
           {
               $("#handler").css('border','1px solid #999');
               closePopover("#handler");
           }
       });
   }});
   $("#handler_name").autocomplete({
          minLength: 0,
          source: function (request, response) {
              $.ajax({
                      url: base_url + "/handling/autosuggest_handler_airportcode",
                      dataType:"json",
                      type:"post",
                      headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      },
                      data:{'airport_code': $('#airport_code').val()},  
                      success: function(data)
                      {
                          response(data);
                      }});
          },
          select: function (event, ui) {
                  closePopover('#'+$(this).attr('id'));
          }
      }).click(function () {
          $("#handler_name").autocomplete('search', $(this).val());
      }).focus(function(){$("#handler_name").autocomplete('search', $(this).val());}); 

    $("#edit_handler_name").autocomplete({
           minLength: 0,
           source: function (request, response) {
               $.ajax({
                       url: base_url + "/handling/autosuggest_handler_callsign_airportcode",
                       dataType:"json",
                       type:"post",
                       headers: {
                       'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                       },
                       data:{'airport_code': $('#edit_airport_code').val(),'callsign':$("#edit_callsign").val(),'handler':$("#current_handler_name").val()},  
                       success: function(data)
                       {
                           response(data);
                       }});
           },
           select: function (event, ui) {
                   closePopover('#'+$(this).attr('id'));
           }
       }).click(function () {
           $("#edit_handler_name").autocomplete('search', $(this).val());
       }).focus(function(){$("#edit_handler_name").autocomplete('search', $(this).val());});   

   $.ajax({
   url: '/fpl/fuelprice/autosuggest',
   dataType:"json",  
   success: function(result)
   {
       $("#aero,#edit_airport_code").autocomplete({
          "ui-autocomplete": "xyz",
           source: result,
           selectFirst: true,
           minLength: 3,
           select: function (event, ui) 
           {
               $("#aero,#edit_airport_code").css('border','1px solid #999');
               closePopover("#aero");
               closePopover("#edit_airport_code");
           }
       });
   }});
   $.ajax({
   url: '/fpl/fuelprice/autosuggest',
   dataType:"json",  
   success: function(result)
   {
       $("#airport_code" ).autocomplete({
          "ui-autocomplete": "xyz",
           source: result,
           selectFirst: true,
           minLength: 3,
           select: function (event, ui) 
           {
               $("#airport_code").css('border','1px solid #999');
               closePopover("#airport_code");
           }
       }).autocomplete("widget" ).addClass("airport_autocomplete");
   }});
   $(document).on('submit','#add_handler_form',function(e){
        e.preventDefault();
        var airport_code=$("#airport_code").val();
        var callsign=$("#callsign").val();
        var handler_name=$("#handler_name").val();
        var basic_rate=$("#basic_rate").val(); 
        var royalty=$("#royalty").val();
        var gst_amount=$("#gst_amount").val();
        var total=$("#total").val();
        var bool=true;
        if(airport_code.length <4){
          errorPopover("#airport_code","Please Select Airport");
          bool=false;
        } 
        if(callsign.length <5){
          errorPopover("#callsign","Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
          bool=false;
        } 
        if(handler_name.length <2){
          errorPopover("#handler_name","Min. 2 & Max. 25 Characters allowed");
          bool=false;
        } 
        if(basic_rate.length <4){
          errorPopover("#basic_rate","Min. 4 & Max. 6 digits allowed");
          bool=false;
        } 
        if(royalty.length <2){
          errorPopover("#royalty","Min. & Max. 2 digits allowed");
          bool=false;
        } 
        if(bool==false)
          return false;
        
        $(".overlay").show();
        $.ajax({
               context : this,  
               type: "POST",  
               url: $(this).attr('action'),
               headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
               dataType:"json",
               data:$("#add_handler_form").serialize(),
               success: function(result) 
               {
                   setTimeout(function () {
                       $(".overlay").hide();
                       if(result.success==true){
                          $('#Addhandler').modal('hide');
                          $('#add_handler_form')[0].reset(); 
                          $.growl({title: '', location: 'tc', size: 'small', message: 'Handler created successfully'});
                       }
                       if(result.success==false){
                         errorPopover("#handler_name",'Handler Already Exist');
                       }
                       handlerlist();
                   }, 3000);
               }
        });  
    });
   edit_handler=false;
   $('.dataTables_paginate').click(function(e){
       checksave();
   });
   function clear(){
       edit_handler=false;
       $('.paginate_button').removeClass('disable');
       var edit_record_id=$('body').find('.edit_record').attr('id');
       var id=edit_record_id.substr(7);
       $("#handler_"+id).val($("#handler_"+id).attr('data-value'));
       $("#callsign_"+id).val($("#callsign_"+id).attr('data-value'));
       $("#basic_rate_"+id).val($("#basic_rate_"+id).attr('data-value'));
       $("#royalty_"+id).val($("#royalty_"+id).attr('data-value'));
       $("#gst_amount_"+id).text($("#gst_amount_"+id).attr('data-value'));
       $("#total_"+id).text($("#total_"+id).attr('data-value'));
       $("#"+edit_record_id).find('.save_handler').css("display", "none");
       $("#"+edit_record_id).find('.edit_handler').css("display", "inline-block");
       $("#"+edit_record_id).find('.edit').prop("readonly",true).removeClass("coloraddEditable");
       $("#"+edit_record_id).removeClass('edit_record');
   }
   function checksave()
   {
       if(edit_handler==true){
       $.confirm({
           title: 'Confirm!',
           content: 'Would you like to exit without saving?',
           buttons: {
                Yes:{
                        text: 'YES',
                        btnClass: 'btn-black',
                        action: function(){
                           clear();
                       }

                    } ,
               save: {
                         text: 'SAVE',
                         btnClass: 'btn-red',
                         action: function(){
                            save();
                            }
                    }
              
           }
       });

      }
   }
   $(document).on("click",".edit_handler",function()
   {
       if(edit_handler==true){
           checksave();
       }
       if(edit_handler==false){
         edit_handler=true;
         var id='record_'+$(this).attr('data-id');
         $(this).css("display", "none");
         $(this).parents().find("#"+id).addClass('edit_record');
         $('.paginate_button').addClass('disable');    
         $(this).parents('#'+id).find('.edit').prop("readonly",false).addClass("coloraddEditable");
         $(this).parents('#'+id).find('.viewhistory').css("display","none");
         $(this).parents('#'+id).find('.edit_handler_new').css("display","none");
         $(this).parents('#'+id).find('.save_handler').css("display","inline-block");
        } 
     });
    $(document).on("click",".save_handler",function()
    {
         save();
    });
   
    function save()
    {
        edit_handler=false;
        $('.paginate_button').removeClass('disable');
        var edit_record_id=$('body').find('.edit_record').attr('id');
        var id='record_'+edit_record_id.substr(7);
        var handlerid=edit_record_id.substr(7);
        var handler =$('#handler_'+handlerid).val();
        // var callsign =$('#callsign_'+handlerid).val();
        var basic_rate =$('#basic_rate_'+handlerid).val();
        var royalty =$('#royalty_'+handlerid).val();
        var airport_code =$('#airport_code_'+handlerid).text();
        var gst_amount =$('#gst_amount_'+handlerid).text();
        var total =$('#total_'+handlerid).text();
        var bool = true;
         if (handler.length <2) {
             
            $("#handler_"+handlerid).attr('data-content', "Min. 2 & Max. 25 Characters allowed");
            $("#handler_"+handlerid).popover('show');
            $("#handler_"+handlerid).focus();
            bool = false;
         }
         //  else if(callsign.length<5){
         //     $("#callsign_"+handlerid).attr('data-content', "Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
         //     $("#callsign_"+handlerid).popover('show');
         //     $("#callsign_"+handlerid).focus();
         //     bool = false;
         // }
         else if (basic_rate.length<4) {
             $("#basic_rate_"+handlerid).attr('data-content', "Min. 4 & Max. 6 digits allowed");
             $("#basic_rate_"+handlerid).popover('show');
             $("#basic_rate_"+handlerid).focus();
             bool = false;
         }
         else if (royalty.length <2) {
             $("#royalty_"+handlerid).attr('data-content', "Min. & Max. 2 digits allowed");
             $("#royalty_"+handlerid).popover('show');
             $("#royalty_"+handlerid).focus();
             bool = false;
         }
        if(bool==false)
             return false;  
         $(this).parents().find("#"+id).removeClass('edit_record');
            $.ajax({
             context : this,  
             type: "POST",  
             url: '/handling/update',
             headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
             dataType:"json",
             // data:{'handler_name':handler,'callsign':callsign,'basic_rate':basic_rate,'royalty':royalty,'id':handlerid,'airport_code':airport_code,'gst_amount':gst_amount,'total':total},
             data:{'handler_name':handler,'basic_rate':basic_rate,'royalty':royalty,'id':handlerid,'airport_code':airport_code,'gst_amount':gst_amount,'total':total},    
             success: function(result) {
                if(result.success==false){
                    $("#handler_"+handlerid).attr('data-content', "Handler Already Exist");
                    $("#handler_"+handlerid).popover('show');
                }
                 if(result.success==true){
                      edit_handler=false;
                      $("#handler_"+handlerid).attr('data-value',handler);
                      //$("#callsign_"+handlerid).attr('data-value',callsign);
                      $("#basic_rate_"+handlerid).attr('data-value',basic_rate);
                      $("#royalty_"+handlerid).attr('data-value',royalty);
                      $("#gst_amount_"+handlerid).attr('data-value',gst_amount);
                      $("#total_"+handlerid).attr('data-value',total);
                      $(".edit_record").find('.edit').prop("readonly",true).removeClass("coloraddEditable");
                      //$(".edit_record").find('.edittd').prop("readonly",true).removeClass("coloraddEditable");
                      $(".edit_record").find('.save_handler').css("display","none");
                      $('.edit_record').find('.viewhistory').css("display","inline-block");
                      $(".edit_record").find('.edit_handler').css("display","inline-block");
                      $('.edit_record').find('.edit_handler_new').css("display","inline-block");
                      $('.paginate_button').removeClass('disable'); 
                      $("#"+id).removeClass('edit_record');   
                      $.growl({title: '', location: 'tc', size: 'medium', message: 'Handler Rates Updated Successfully'});
                 }
             }
           });
    }
    $("#first_search").click(function(){
         if ($("#aero").val()=='' && $("#handler").val() =='') {
                  $("#handling_alert_validation").modal();
                  $(".modal_message").html("Please enter any one field");
                  $(".header_title").html('Validation Fail Message')
                  return false;
         }
    });
     $("#2nd_search").click(function(){
         if ($("#aero").val()=='' && $("#handler").val() =='' && $("#callsign_info").val() =='') {
                  $("#handling_alert_validation").modal();
                  $(".modal_message").html("Please enter any one field");
                  $(".header_title").html('Validation Fail Message')
                  return false;
         }
    });
     $("#3rd_search").click(function(){
         if ($("#aero").val()=='') {
                  $("#handling_alert_validation").modal();
                  $(".modal_message").html("Please enter any one field");
                  $(".header_title").html('Validation Fail Message')
                  return false;
         }
    }); 
    $("#update_handler").submit(function(event){
      event.preventDefault();
      var airport_code=$("#edit_airport_code").val();
      var callsign=$("#edit_callsign").val();
      var handler_name=$("#edit_handler_name").val();
      var bool=true;
      if(callsign.length<5){
          errorPopover("#edit_callsign","Min. 5 & Max. 7 Characters, Alphabets & Numbers allowed");
          bool=false;
      }   
      if(handler_name.length==""){
          errorPopover("#edit_handler_name","Min. 2 & Max. 25 Characters allowed");
          bool=false;
      }    
      if(bool==false)
        return false;
      
      $(".readonly").prop("readonly", true);
      $(".overlay").show();
      $.ajax({
             context : this,  
             type: "POST",  
             url: $(this).attr('action'),
             headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
             dataType:"json",
             data:$("#update_handler").serialize(),
             success: function(result) 
             {
                 setTimeout(function () {
                     $(".overlay").hide();
                     if(result.success==true){
                        $('#edit_handler_newpopup').modal('hide');
                        $('#update_handler')[0].reset(); 
                        closePopover("#edit_handler_name");
                        $.growl({title: '', location: 'tc', size: 'medium', message: 'Handler Name Updated successfully'});
                        $(".readonly").prop("readonly",false);
                        location.reload();
                     }
                     if(result.success==false){
                       errorPopover("#edit_handler_name",'Handler Already Exist');
                     }
                 }, 3000);
             }
      });  

    });
  }); 
</script>
@stop