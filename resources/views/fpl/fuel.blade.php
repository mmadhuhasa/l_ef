@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<div class="page" id="quick_app">
<style>
#from_date1 {
text-align: left;
font-size: 13px;
font-weight: normal;
color: #222;
}
#to_date1 {
padding-left: 5px;
font-size: 13px;
font-weight: normal;
color: #222;
text-align: left;
width: 102%;
border-radius: 5px;
}
.disabled
{
background: #333 !important; 
}
.enabled{
background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b)) !important; 
}
.ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary{
color: #454545;
}
*{
-moz-box-sizing: border-box !important;
}
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
table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc {background : none;}
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
.tooltip_tri_shape, .tooltip_tri_shape1, .tooltip_tri_shape2, .tooltip_tri_shape3, .tooltip_tri_shape4, .tooltip_tri_shape5, .tooltip_tri_shape6, .tooltip_tri_shape7, .tooltip_tri_shape8, .tooltip_tri_shape9, .tooltip_tri_shape10, .tooltip_tri_shape11, .tooltip_tri_shape12, .tooltip_tri_shape_valid, .tooltip_trishape_01, .tooltip_trishape_02, .tooltip_trishape_03, .tooltip_trishape_04, .tooltip_trishape_05, .tooltip_trishape_06 {
width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-top: 6px solid #333;position: absolute;top: -5px;right: 21px;z-index: 99999;visibility: hidden;}
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
.q_filter .depstatns, .q_filter .destatns {width:21%;}
.from_to_adj_width {width:33%;}
.q_filter .btn {width: 41px;border-radius: 0 4px 4px 0;}
.from_dp_pos {width: 100%;}
.from_widthv {width: 42% !important;}
#from_date {text-align: left;font-size: 13px;font-weight: normal;color: #222;}
#to_date {padding-left: 5px;font-size:13px;font-weight: normal;color: #222;text-align: left;width: 104%;border-radius: 5px;}
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
.table>thead:first-child>tr:first-child>th.thchange{
width:90px!important;
}
.table>thead:first-child>tr:first-child>th.fuelwidth{
width:144px!important;
}
.table>thead:first-child>tr:first-child>th.pobwidth{
width:81px!important;
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
.table>thead:first-child>tr:first-child>th.thdof{
width: 99px !important;
}
.dof {
width: 85%;
font-weight: normal;
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
width: 52%;
}
.desk-plan>thead>tr>th {font-size: 14px;color: #ffffff;}
.desk-plan>thead>tr>th:nth-child(9), .desk-plan>tbody>tr>td:nth-child(9) {border-right:0;}
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
.desk-plan .form-control{height: 32px}
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
.fic-adc .fic input[type=text] {
border-top-right-radius: 0;
border-bottom-right-radius: 0;
border-right: #d3d3d3 solid 1px;
}
.desk-plan .form-control[disabled], .desk-plan .form-control[readonly], .desk-plan fieldset[disabled] .form-control{
background: #999
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
}
.table-hover>tbody>tr:hover .edit_license {
visibility:visible;
}
.modal-footer{
text-align: center; 
}
.modal-dialog{
width:270px; 
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
.ltrim_sec div.dynamiclabel{
display: block;
position: relative;
text-align: left;
padding-right: 0px;  
}
.ltrim_sec div.dynamiclabel label{
position: absolute;
font-size: 12px;
color:#f1292b ;
font-weight:bold;      
top: 7px;
left:2px;          
-moz-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
-webkit-transition: all 0.6s ease-in-out;
-o-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
opacity: 0;
z-index: -1;
line-height: 0px;
white-space: nowrap;
}
.ltrim_sec div.dynamiclabel > *:focus{
border-color:#f1292b ;
outline: none;
}
.ltrim_sec div.dynamiclabel > *:not(:placeholder-shown) + label{
opacity: 1;
z-index:1;
top: -7px;
left:2px;
text-transform: uppercase;
}
.ltrim_sec div.dynamiclabel > *:focus + label{
opacity: 1;
z-index:100;
top: -7px;
left:2px;
text-transform: uppercase;
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
.eflightrate_input{
width: 100%;
border-radius: 4px 0px 0px 4px;
padding:6px;
border: 1px solid #999; 
border-right: 0px;
font-size:13px;
font-weight: bold;
background: #eee;
}
.hprate_input{
width: 134%;
border-left: 0px;
border-radius: 0px 4px 4px 0px;
padding:6px;
border: 1px solid #999;
font-size:13px;
font-weight: bold;
background: #eee;
}
.airportcode_fuelrequest_input{
border-radius: 4px 0px 0px 4px;
}
.airportname_fuelrequest_input{
border-left: 0px;
border-radius: 0px 4px 4px 0px;
}
.litres{
font-size: 12px;
color: red; 
}
.fuelrequest_table>thead>tr>th, .fuelrequest_table>tbody>tr>td{
padding: 2px!important;
font-weight: normal;
font-size: 13px;
border-right:1px solid #333!important;
}
.text_image{
margin-left: -4px;
margin-top: -10px;
max-width: 145%;
}
.fuelrequest_table>thead{
background:linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%)!important;
}
.placehoder_citycode::-webkit-input-placeholder {
color: blue;
font-weight: bold;
}
.placehoder_cityname::-webkit-input-placeholder {
color: blue;
font-weight: bold;
}
.fuel_required_class{
color: #0c7d3b;
font-weight: bold;
/*background: red;*/
}
/*.fuel_required_row_class{
background: red;
}*/
.taxrate_wrapper{
width:10%;
}
.even{
background: red!important;
}
.ui-datepicker-close{
margin-left: 76% !important;
margin-bottom: 1%;
}
.ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary {
margin-left: 1% ;
}
</style>
    @include('includes.new_header',[])
     <script type="text/javascript" src="{{url('app/js/BuroRaDer.DateRangePicker.js')}}"></script>
    <main>
        <div class="container">
            <div class="bg-white">
                <div class=" fpl_sec">
                    <section>
                        <div class="row cust_box_shadow">
                            <div class="col-md-12 p-lr-0">
                                <p class="search_heading">FUEL DATA</p>
                            </div>
                            <div class="col-md-12 p-lr-0" style="width:100%;float:left">
                                <div class="q_filter">
                                    <!--<form name="search" id="search" method="post" action="{{url('/fpl')}}">-->
                                    <form data-url="{{url('/fuel/get_filter_fuel')}}" name="search" id="fuel_search" method="post" action="#">
                                        <div class="col-sm-6 col-md-3 xs-p-lr-5" style="width: 33%;padding-right:0px;padding-left:0px;">
                                            <div class="form-group">
                                                <input type="text" data-toggle ="popover" data-placement="bottom"  minlength="1" maxlength="5" autocomplete="off"   class="operator auto_operator text-center font-bold text_uppercase form-control modtooltip"  placeholder="OPERATOR" id="operator2" name="operator2" tabindex="1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 xs-p-lr-5" style="width:10%;padding-right:0px;">
                                            <div class="form-group">
                                                <input type="text" data-toggle ="popover" data-placement="bottom"  minlength="5" maxlength="7" autocomplete="off"   class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip"  placeholder="Call Sign" id="aircraft_callsign2" name="aircraft_callsign2" tabindex="1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6  col-md-3 depstatns xs-p-lr-5" style="width:12%;padding-right:0px;">
                                            <div class="form-group">
                                                <input type="text" class="form-control text-center text_uppercase alphabets font-bold stations" id="departure_aerodrome2" minlength="4" maxlength="4"  name="departure_aerodrome2" placeholder="Dep Aero">
                                            </div>
                                        </div>
                                        <div class="col-sm-6  col-md-3 depstatns xs-p-lr-5" style="width:12%;padding-right:0px;">
                                            <div class="form-group">
                                                <input type="text" class="form-control text_uppercase alphabets font-bold stations text-center" id="destination_aerodrome2" minlength="4" maxlength="4"  name="destination_aerodrome2" placeholder="Dest Aero">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 xs-p-lr-5 from_to_adj_width">
                                            <div class="form-row">
                                                <div class="form-search-row-left from_widthv">
                                                    <div class="form-group">
                                                        <div class="input-group from_dp_pos">
                                                            <input type="text"  autocomplete="off" class="form-control font-bold from_date1 pointer fpl_from_box" placeholder="FROM" name="from_date"  id="from_date" minlength="6" maxlength="6" tabindex="5" readonly style="border-radius:4px;
                                                                   " data-date-range-end="#to_date" >
                                                            <!-- <span class="fpl_search_from_label">From</span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-search-row-right to_widthv">
                                                    <div class="form-group">
                                                        <div class="input-group xs-m-r-0">
                                                            <input type="text" autocomplete="off" class="form-control font-bold to_date1 pointer fpl_to_box" placeholder="TO" name="to_date" id="to_date" minlength="6" maxlength="6" tabindex="5" readonly data-date-range-start="#from_date">
                                                           <!--  <span class="fpl_search_to_label">To</span> -->
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
                        <div class="success" style="margin-top: 10px"></div>
                        <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
                        <div style="color: #333;
                             position: absolute;
                             margin-left: 346px;
                             top: 331px;
                             font-size: 15px;" class="success_msg"></div>
                        <div class="fuel_count" style="display:none">
                            <p class="no_of_flight">No. of FLIGHT = <span id="no_of_flight"></span></p>
                            <p class="total_flying_hours">TOTAL FLYING HOURS = <span id="total_flying_hours"></span></p>
                            <p class="fuel_burn" data-toggle="popover" data-placement="top" style="cursor: pointer">FUEL BURN  = <span id="fuel_burn"></span> KL</p>
                            <p class="cost_rupee">COST  = Rs <span id="cost_rupee">0</span> Crores</p>
                        </div>
                        <form id="" name="">
                            <div style="position: absolute;top: 360px;margin-left: 21px;z-index: 999">
                                <a class="dwn_exl"><img style="height:30px; width:30px;cursor: pointer" src="{{url('media/images/excel_download.png')}}" /></a>
                            </div>
                            <div id="result">
                                <div class="desk-view">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="fuel_info table table-hover table-responsive desk-plan">
                                                <thead>
                                                    <tr>
                                                        <th class="slno">Sl</th>
                                                        <th class="dof thdof">Flight Date</th>
                                                        <th class="ficadc thficadc">Operator</th>
                                                        <th class="calsign thchange">Call Sign</th>
                                                        <th class="from thfrom">From</th>
                                                        <th class="to thto">To</th>
                                                        <th class="dpt thdpt">Dep. Time</th>
                                                        <th class="fildate thchange">Flying Time</th>
                                                        <th class="pdf pobwidth">POB</th>
                                                        <th class="pdf fuelwidth">Fuel</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="FuelRequest" role="dialog">
        <div class="modal-dialog" style="width:500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                    <h4 class="modal-title" style="padding: 4px 0px 4px 0px;font-size:16px">
                        <span id="f_callsign"></span>
                        <span id="fuel_price_heading"></span>
                        <span>FUEL REQUEST</span></h4>
                </div>
                <form method="POST" action="" id="app_page">
                    <div class="modal-body" style="padding-left:15px;padding: 15px 15px 0px 15px;">
                        <div class="row">
                            <div class="col-sm-2" style="padding-right:0px;">
                                <div class="ltrim_sec">
                                    <div class="group dynamiclabel">
                                        <input class="infocus outfocus alphabets_with_space hprate_input" type="text" placeholder="H.P. RATE" name="hp_rate" id="hp_rate" autocomplete="off" data-toggle="popover" data-placement="top" data-original-title="" title="" value="5000" readonly>
                                        <label id="price_label"></label>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-2" style="padding-left:0px;">
                                <div class="ltrim_sec">
                                    <div class="group dynamiclabel">
                                        <input class="infocus outfocus alphabets_with_space hprate_input" style="font-weight:normal;" type="text" placeholder="BASIC" name="basic" id="basic_rate" autocomplete="off" data-toggle="popover" data-placement="top" data-original-title="" title="" readonly>
                                        <label style="top:7px;left: 12px;font-style: italic;" id="pilot_lbl">BASIC</label>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-1 taxrate_wrapper" style="padding-left:0px;">
                                <div class="ltrim_sec">
                                    <div class="group dynamiclabel">
                                        <input class="infocus outfocus alphabets_with_space hprate_input" style="font-weight:normal;" type="text" placeholder="TAX" name="tax_rate" id="tax_rate" autocomplete="off" data-toggle="popover" data-placement="top" data-original-title="" title="" readonly>
                                        <label style="top:7px;left: 12px;font-style: italic;" id="pilot_lbl">Tax %</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1" style="padding-right:0px;width:15%;">
                                <div class="form-group">
                                    <input style="background:#eee;font-weight:bold;" type="text" class="placehoder_citycode airportcode_fuelrequest_input text-center font-bold text_uppercase form-control modtooltip decimal ui-autocomplete-input" placeholder="AIRPORT"  name="airport_code" id="airport_code" autocomplete="off" data-placement="top"  minlength="7" maxlength="9" readonly>
                                </div>
                            </div>
                            <div class="col-sm-5" style="padding-left:0px;">
                                <div class="form-group">
                                    <input style="background:#eee;font-weight:bold;" type="text" class="placehoder_cityname airportname_fuelrequest_input text-center font-bold text_uppercase form-control decimal modtooltip  ui-autocomplete-input" placeholder="CITY"  name="city"  id="city" autocomplete="off" data-placement="top" minlength="5" maxlength="5" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2" style="padding-right:0px;padding-top:5px;width: 21%;">
                                <div class="ltrim_sec">
                                    <div class="group dynamiclabel">
                                        <input class="infocus outfocus alphabets_with_space eflightrate_input" type="text" placeholder="FROM DATE" name="f_from_date" id="f_from_date" autocomplete="off" readonly>
                                        <label id="pilot_lbl">FROM DATE</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2" style="padding-left:0px;padding-top:5px;margin-right: 20px;">
                                <div class="ltrim_sec">
                                    <div class="group dynamiclabel">
                                        <input class="infocus outfocus alphabets_with_space hprate_input" type="text" placeholder="TO DATE" name="f_to_date" id="f_to_date" autocomplete="off" readonly>
                                        <label id="pilot_lbl"> TO DATE</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2" style="padding-top:5px;">
                                <span class="litres">
                                    <img class="text_image" src="{{url('media/images/textlitres1.png')}}"/>
                                </span> 
                            </div>
                            <div class="col-sm-2" style="padding-left:0px;padding-top:5px;width:15%;">
                                <div class="form-group">
                                    <input type="text" class="text-center font-bold text_uppercase form-control modtooltip numeric" placeholder="Fuel" id="fuel_order" v-model="fuel_order"  name="fuel_order" autocomplete="off" data-toggle="popover" data-placement="top"  minlength="3" maxlength="5" >
                                </div>
                                <div style="display: none" class="popshow">
                                    <div class="popover fade top in" id="popover1" style="top: -36px; left: -76px; display: block;">
                                        <div class="arrow" style="left: 50%;"></div>
                                        <h3 class="popover-title" style="display: none;"></h3>
                                        <div class="popover-content">PLEASE ORDER MIN. 100 LITRES</div></div></div>
                            </div>
                            <div class="col-sm-3" style="padding-right: 0px;left: 24px;padding-top:5px;">
                                <div class=" b-radius-5" id="order_parent">
                                    <input type="button" class="btn btn_appearance" id="order" @click="fuel_order_method" name="" data-name="order" value="ORDER">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div style="text-align: center" class="fuel_success"></div>
                            </div>
                            <input type="hidden" id="fpl_id" />
                            <div class="col-sm-12" style="border-bottom: 1px solid #f1292b;"></div>
                            <div class="col-sm-12" style="padding-top:10px;">
                                <table class="table table-hover table-responsive fuelrequest_table desk-plan">
                                    <thead style="background: #333;">
                                        <tr>
                                            <th style="width:20px !important;border-left: 1px solid #000;" class="">Sl</th>
                                            <th style="width:35px !important;" class="">FUEL</th>
                                            <th style="width:80px !important;" class="">DATE AND TIME  <span style="margin-left:5px;">(IST)</span></th>
                                            <th style="width:50px !important;" class="">BY</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trdata">
                                        <tr>
                                            <td>1</td>
                                            <td></td>
                                            <td>25-NOV-2017  <span style="margin-left: 10px;">01:25:08</span></td>
                                            <td>SAICHARAN</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer" style="padding: 8px;"></div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id='v_toTop'><span></span></div>
    @include('includes.new_footer',[])
</div>
<script>
$("#from_date").datepicker({  
   dateFormat: 'd-M-yy',
   showMonthAfterYear: true,
   closeText: 'Clear',
   showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true,
    // minDate: new Date(1, 07, 2008),
//   yearRange: "-10:+10",
   onSelect: function(selectedDate) 
   { 
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
        if ($('.fuel_info').length > 0) {
            $('.fuel_info').each(function (e) {
                var url_fpl_list = $("#url").val();
                var date = $("#date_of_flight2").val();
                jQuery.fn.dataTableExt.sErrMode = 'throw';
                jQuery.fn.dataTableExt.oPagination.iFullNumbersShowPages = 10;
                var opt = {
                    //"bJQueryUI" : true,
                    "sDom": '<"top"iflp<"clear">>rt',
                    "bFilter": false,
                    "bLengthChange": false,
                    "iDisplayLength": 25,
                    "sPaginationType": "simple_numbers",
                    "bProcessing": false,
                    "bServerSide": true,
                    "info": false,
                    "sAjaxSource": url_fpl_list + '/fuel/list',
                    "fnServerParams": function (aoData, fnCallback) {
                        aoData.push({"name": "url", "value": $("#url").val()});
                        aoData.push({"name": "date_of_flight", "value": $("#date_of_flight2").val()});
                        aoData.push({"name": "email", "value": $("#email").val()})
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
                    //                'sDom': "lfrtip",
                    //                    "aaSorting": [[0, 'desc']],
                    "aLengthMenu": [20, 50, 100, 200, 400],
                    //                "fnInitComplete": function () {
                    //                    $('[rel=popover]').popover({
                    //                        placement: "top",
                    //                        html: true,
                    //                    });
                    //                },
                    "fnDrawCallback": function (oSettings) {
                        $('[rel=popover]').popover({
                            placement: "top",
                            html: true,
                        });
                        //                    if ($('.fpl_info tr').length < 25) {
                        //                        $('.dataTables_paginate').hide();
                        //                    }
                    },
                    "initComplete": function (settings, json) {
                        //                    alert('DataTables has finished its initialisation.');
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
                //                oTable.$("[rel=popover]").popover();
                //                oTable.fnGetNodes().popover();

            });
        }
        $(".dwn_exl").on("click", function () {
            var data = $('form[id="fuel_search"]').serialize();
            console.log('data ', data);
            window.location = base_url + "/fuel/download_excel?" + data;
        });
        $.get(base_url + "/fuel/fuel_count", function (data) {
            console.log('Resp ', data.result.kilo_total_fuel);
            $(".fuel_count").show();
            $("#no_of_flight").html(data.result.no_of_flight);
            $("#total_flying_hours").html(data.result.total_flying);
            $("#fuel_burn").html(data.result.kilo_total_fuel);
            $(".fuel_burn").attr('data-content', 'TOTAL FUEL BURN: ' + data.result.total_block_fuel);
        });
        $("#fuel_search").on('submit', function (e) {
            e.preventDefault();
            var data_url = $(this).attr('data-url');
            var data = $('form[id="fuel_search"]').serialize();
            var aircraft_callsign2 = $("#aircraft_callsign2").val();
            var departure_aerodrome2 = $("#departure_aerodrome2").val();
            var destination_aerodrome2 = $("#destination_aerodrome2").val();
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            console.log('data ', data);
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
            $(".fuel_count").show()
            $.get(base_url + "/fuel/fuel_count?" + data, function (data) {
                console.log('Resp ', data.result.kilo_total_fuel);
                $("#no_of_flight").html(data.result.no_of_flight);
                $("#total_flying_hours").html(data.result.total_flying);
                $("#fuel_burn").html(data.result.kilo_total_fuel);
                $(".fuel_burn").attr('data-content', 'TOTAL FUEL BURN: ' + data.result.total_block_fuel);
            });
        });
        $(document).on('click', ".fuel_submit", function (e) {
            e.preventDefault();
            var id = $(this).attr('data-value');
            var fuel_val = $("#fuel" + id).val();
            var pob = $("#pob" + id).val();
            if (fuel_val.length < 3 || fuel_val.length > 5) {
                $("#fuel" + id).css('border', '1px #f1292b solid');
//                $("#fuel" + id).attr('data-content', "Enter Min. 3 or Max. 5 digits");
                return false;
            } else {
                $("#fuel" + id).css('border', '1px #D3D3D3 solid');
                $("#fuel" + id).attr('data-content', "")
            }
            var data = {'id': id, 'fuel_value': fuel_val, 'pob': pob};
            var data_url = $(this).attr('data-url');
            $(".success").css('visibility', 'visible');
            $(".success").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
            $.ajax({
                url: data_url,
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function (data, textStatus, jqXHR) {
                    $("#fuel" + id).css('background', '#999');
                    $("#pob" + id).css('background', '#999');
                    $(".success").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.STATUS_DESC + '</div>');
                    setTimeout(function () {
                        $(".success").css('visibility', 'hidden');
                    }, 6300)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown)
                }
            })
        });
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
        $(document).on('keyup', ".pobc", function () {
            var pob = $(this).val();
            var data_val = $(this).attr('data-value');
            if (pob.length >= '1') {
                console.log('inn', "#pob" + data_val)
                $("#pob" + data_val).css('border', '#d3d3d3 solid 1px');
            } else {
                $("#pob" + data_val).css('border', '#f1292b solid 1px');
            }
        });
        $(document).on('keyup', ".fuelc", function () {
            var fuel = $(this).val();
            var data_val = $(this).attr('data-value');
            if (fuel.length >= '3') {
                console.log('inn', "#fuel" + data_val)
                $("#fuel" + data_val).css('border', '#d3d3d3 solid 1px');
            } else {
                $("#fuel" + data_val).css('border', '#f1292b solid 1px');
            }
        });
        $(document).on('keyup', ".fueld", function () {
            var fuel = $(this).val();
            var data_val = $(this).attr('data-value');
            if (fuel.length >= '3') {
                console.log('inn', "#fuel_order" + fuel)
                $("#fuel_order").css('border', '#d3d3d3 solid 1px');
            } else {
                $("#fuel_order").css('border', '#f1292b solid 1px');
            }
        });
        $(document).on('dblclick', ".pobc", function () {
        	if($(this).attr('data-plan_status')==2)
        		return false;
            var pob = $(this).val();
            var data_val = $(this).attr('data-value');
            $("#pob" + data_val).removeAttr('readonly').css('background', "#fff");
        });
        $(document).on('dblclick', ".fuelc", function () {
        	if($(this).attr('data-plan_status')==2)
        		return false;
            var fuel = $(this).val();
            var data_val = $(this).attr('data-value');
            $("#fuel" + data_val).removeAttr('readonly').css('background', "#fff");
        });
    });
    $(window).scroll(function () {
        if ($(this).scrollTop()) {
            $('#v_toTop').fadeIn();
        } else {
            $('#v_toTop').fadeOut();
        }
    });
    $("#v_toTop").click(function () {
        $("html, body").animate({scrollTop: 0}, 500);
    });
    $(document).on('click', ".FuelRequest", function () {
        if($(this).attr('data-plan_status')==2)
        	return false; 
        var data_url = base_url + "/fuel/get_price_data";
        var data_value = $(this).attr('data-value');
        var data_button = $(this).attr('data-button');
        if(data_button=='1'){
            $('#order').prop('disabled', true);
            $('#order').addClass('disabled');
            $('#order_parent').removeClass('newbtnv1'); 
        }
        else{
             $('#order').prop('disabled',false);
             $('#order_parent').addClass('newbtnv1');
             $('#order').removeClass('disabled');
        }
        var callsign = $(this).attr('data-callsign');
        var airportcode = $(this).attr('data-aero');
        var data = {'id': data_value, 'callsign': callsign, 'airportcode': airportcode};

        $("#f_callsign").html(callsign);
        $("#fpl_id").val(data_value);
        $.ajax({
            url: data_url,
            type: 'GET',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data, textStatus, jqXHR) {
                console.log('ggg ', data);
                if (data.result2) {
//                    if(data.result.basic_price==0)
                         if(false)
                        alert('Fuel service not available at this Airport. Please contact us for more info.');
                    else{
                        if(data.result.fuel_type==1)
                            $("#price_label").html('H.P. RATE<span style="font-style: italic;">( per KL )</span>');
                        else
                            $("#price_label").html('B.P. RATE<span style="font-style: italic;">( per KL )</span>');
                        $("#hp_rate").val(data.result.hp_price);
                        $("#airport_code").val(data.result.airport_code);
                        $("#city").val(data.result.city);
                        $("#fuel_order").val(data.fuel);
                        $("#f_from_date").val(data.from_date);
                        $("#f_to_date").val(data.to_date);
                         $("#basic_rate").val(data.result.basic_price);
                        $("#tax_rate").val(data.result.tax);
                       
                        $("#FuelRequest").modal();
                        var list = "";
                        $.each(data.history, function (i, v) {
                            var j = i + 1;
                            list += "<tr>";
                            list += "<td>" + j + "</td>";
                            list += "<td>" + v.fuel_order + "</td>";
                            list += "<td>" + v.updated_date + "</td>";
                            list += "<td>" + v.updated_by + "</td>";
                            list += "</tr>";
                        });

                        $("#trdata").html(list)
                    }    
                } else {
                    alert('Fuel service not available at this Airport. Please contact us for more info.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown)
            }
        })
    })
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
    new Vue({
        el: "#app_page",
        data: {
            'fuel_order': ""
        },
        methods: {
            fuel_order_method: function (e) {
                e.preventDefault();
                var data_url = base_url + "/fuel/order";
                var formdata = $("#lr_form").serializeArray();
                var fuel = $("#fuel_order").val();
                var data = {'fuel_order': fuel, 'id': $("#fpl_id").val()};

                if (fuel.length < '3') {
                    $("#fuel_order").css('border', '#f1292b solid 1px');
                    $("#fuel_order").attr('data-content', 'PLEASE ORDER MIN. 100 LITRES');
                    $(".popshow").css('display', 'block');
                    return false;
                } else {

                    $("#fuel_order").css('border', '#d3d3d3 solid 1px');
                    $('#fuel_order').popover('destroy');
                    $(".popshow").css('display', 'none');
                }
                console.log(data);
                $(".fuel_success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a>PLEASE WAIT ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $(".fuel_success").html('');
                        $(".get_filter_result").html(data.body);
                        $("#FuelRequest").modal("hide");
                        $(".success_msg").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + data.body.STATUS_DESC + '</p>')
                    }
                });
            }
        }
    });
</script>
@stop