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
.desk-view {
margin: 0 0;
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
.q_filter {width: 100%;float:left; padding-left: 10px;padding-right: 10px;box-shadow: 0 6px 8px 0px #a7a7a7;}
.q_filter .depstatns, .q_filter .destatns {width:21%;}
.from_to_adj_width {width:26%;margin-right:28px;}
.q_filter .btn {width: 41px;border-radius: 0 4px 4px 0;}
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
.desk-plan>tbody>tr>td {font-size: 14px;padding:0px!important;font-weight:bold;}
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
/*New changes to datatables*/
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
/*START OF FDTL MODAL PLACEHOLDER STYLES*/
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
/*END OF FDTL MODAL PLACEHOLDER STYLES*/
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
left: -5px;
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
right:3px;
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
.hover_red{
color: red !important;
}
.hover_black{
color: black !important;
}
.edit_license, .viewhistory{
visibility: hidden;
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
#SaveRecord{
display:none;
}
.coloraddEditable{
background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858))!important;
color: rgb(255, 255, 255);
outline: none;
}
.saveicon_record:hover{
color:#ff0000;
}
.eflight_price{
width:124px;
}
.code_price{
width:45px;
}
.basic_price{
width:110px;
}
.tax_price{
width:55px;
}
.hpprice_price{
width:90px!important;
}
.taxamount_price{
width:84px;
}
.actions_price{
width:78px;
}
.one_main_table_td{
border-right:0px!important;
border-top: 0px!important;
}
.two_main_th{
border-right:0px!important;
}
.field_fromdate:focus{
box-shadow:none!important; 
}
.fpl_from_box{
background: none!important;
box-shadow: none;
border:none;
font-weight: normal!important;
}
.fromdate_price{
width:95px!important;
}
.todate_price{
width:95px!important;
}
.main_table .desk-plan .form-control{
border:none!important;
}
.ui-menu .ui-menu-item{
font-size: 13px;
width: 100%;
font-weight:bold;
}
.ui-menu .ui-menu-item:hover{
background:-webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
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
.alert-info {
color: green;
background-color: #ffffff;
border-color: #ffffff;
font-weight: bold;
text-align: center;
}
.alert {
padding: 10px;
margin-bottom:0px;
border: 1px solid transparent;
border-radius: 4px;
}
.ui-menu-item:focus{
outline:-webkit-focus-ring-color auto 0px!important;
}
.updated_successfully{
text-align: center;
font-weight: bold;
color: #f1292b;
display:none;
text-transform:uppercase;
margin-top: 10px;
}
.updated_successfully1{
text-align: center;
font-weight: bold;
color: #f1292b;
text-transform:uppercase;
}
.ui-datepicker-calendar a.ui-state-default{
background:#fff;
}
.ui-datepicker-calendar a.ui-state-default:hover{
background: lightgray;
border-color: lightgray;
text-align: center;
font-weight: bold;
color:#000;
}
table.dataTable thead .sorting{
background-size: 22px 22px;
}
table.dataTable thead .sorting_asc{
background-size: 22px 22px;
}
table.dataTable thead .sorting_desc{
background-size: 22px 22px;
}
.history_fuel{
width: 90%!important;
}
.history_slno{
width:18px!important;
border-right: 0px!important;
}
.history_actions{
border-right: 0px!important;
}
.history_date{
width:138px!important;
border-right: 0px!important;
}
.history_by{
width:80px!important;
border-right: 0px!important;
}
#fuel_info_paginate{
margin-right:38px;
}
.history_fuel>tbody>tr>td{
border-right: 0px!important;
border-top: 0px!important;
}
a:hover {
color: #000;
}
.plus_fuel_price:hover{
color: red;
}
@media screen and (min-width:767px) and (max-width:1300px) {
.basic_price{
width:115px!important;
}
.fromdate_price {
width: 110px!important;
}
.todate_price {
width: 110px!important;
}
.taxamount_price{
width:90px!important; 
}
.actions_price{
width:85px!important; 
}
.hpprice_price {
width: 105px!important;
}
.eflight_price{
width: 128px!important; 
}
}
.ui-datepicker-close{
margin-left: 76% !important;
margin-bottom: 1%;
}
#frm{
cursor: pointer;
}
#to{
cursor: pointer;
}
.from_fuel_date {
cursor: pointer;
}
.to_fuel_date {
cursor: pointer;
}
.ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary{
margin-left: 1%; 
}
#eflght_price {
border: none;
outline: none;
text-align: center;
background: none;
}
#basic_price{
border: none;
outline: none;
text-align: center;
background: none;
}
#tax{
border: none;
outline: none;
text-align: center;
background: none;
}
.desk-plan .form-control[disabled], .desk-plan , .desk-plan fieldset[disabled] .form-control{
color:#000!important;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{
border: 1px solid #999;
background:#fff; 
}
.add_fuel_from_cal .ui-datepicker-trigger{
height: 25px;
right: 20px;
top: 4px;
}
.white{
color: rgb(255, 255, 255) !important;
}
.black {
color:#000!important;
}
#fuel_info>thead>tr>th{
border:1px solid #fff;
border-right: 0px;
border-top: 0px;
}
.fromdate_newprice .popover.top{
left: 18px!important;
width: 112px;
}
.todate_newprice .popover.top{
left: 0px!important;
width: 115px!important;
}
.red_color{
color: red;
}
.empty_eflight_price{
display: none;
}
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
.focusin {
border:1px solid red !important;
}
.hpmainbutton{
background: none;
color: #fff;
height: 20px;
outline: none;
padding: 0;
border-radius: 0;
font-weight: bold;
line-height: 1.2;
cursor: pointer;
border: none;
margin-top: 7px;
width:100%!important;
}
.bpmainbutton{
background: none;
color: #fff;
height: 20px;
outline: none;
padding: 0;
border-radius: 0;
font-weight: bold;
line-height: 1.2;
cursor: pointer;
border: none;
margin-top: 7px;
width:100%!important;
}
.bpmainbutton:hover{
background: none;
color: #f1292b;
text-decoration: underline;
}
.bpmainbutton:active{
text-decoration: underline;
}
.hpmainbutton:active{
text-decoration: underline;
}
.bpmainbutton:focus{
text-decoration: underline;
color: #f1292b;
}
.hpmainbutton:focus{
text-decoration: underline;
color: #000;
}
.hpmainbutton:hover{
background: none;
color: #000;
text-decoration: underline;
}
.bgwrapper_blue{
background: #4667cc;
height:34px;
width: 39%;
margin-right: 10px;
border-radius: 4px;
}
.bgwrapper_yellow{
background:#fbca35;
height:34px;
width: 34%;
border-radius: 4px;
}
.form_wrapper{
margin-left:51%;
}
.ui-priority-primary, .ui-widget-content .ui-priority-primary, .ui-widget-header .ui-priority-primary{
color: #454545;
}
.ui-menu .ui-menu-item:hover{
color:#fff;
}
.ui-menu .ui-menu-item{
background:#fff;
color:#000;
border-bottom:0;
border-top:0;
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
    <script type="text/javascript" src="{{url('app/js/BuroRaDer.DateRangePicker.js')}}"></script>
    <main>
        <div class="container">
                    @if(Session::has('msg'))
                        <span class="lrsuccess updated_successfully1">
                            <div class="success_search" style="width:100%;text-align: center;color: #f1292b;text-transform: uppercase;margin-top:10px;">
                                <div class="success-left animated infinite zoomIn custdelay">
                                    <span id="succ_msg"> {{ Session::get('msg') }}</span>
                                </div>
                            </div>
                        </span> 
                    @endif
                    <span class="lrsuccess updated_successfully" id="edit_fuel" >
                        <div style="width:100%;text-align: center;color: #f1292b;text-transform: uppercase">
                            <div class="success-left animated infinite zoomIn custdelay">
                                <span class="success-font"><span id="msg_code"></span> - <span id="msg_city"></span> FUEL PRICE UPDATED SUCCESSFULLY</span>
                            </div>
                        </div>
                    </span> 
            <div class="bg-white">
                <div class=" fpl_sec">
                    <section>
                        <div class="row cust_box_shadow">
                            <div class="col-md-12 p-lr-0">
                                <p class="search_heading">FUEL PRICE</p>
                            </div>
                            <div class="col-md-12 p-lr-0" style="width:100%;float:left">
                                <form action="{{url('fpl/fuelprice')}}" method="POST" id="fuel_search">
                                    <div class="q_filter">
                                        {{ csrf_field() }}
                                        <div class="col-md-1 tooltip_rel style_plus_wrapper" style="width:3%;margin-left: 1%;">
                                            <a data-toggle="modal" data-target="#AddAirport" style="cursor:pointer;"  class="style_plus_price" id="add-fuel-airport">
                                                <i class="fa fa-plus add_license"></i>
                                            </a>
                                            <span class="tooltip_cust">ADD AIRPORT</span>
                                            <span class="tooltip_tri_shape1" style="right: 15px;"></span>
                                        </div>
                                        <div class="col-sm-6  col-md-3 depstatns xs-p-lr-5" style="width:30%;padding-right:0px;">
                                            <div class="form-group">
                                                <input type="text" class="form-control text_uppercase alphabets font-bold stations" id="aero" data-placement="top" name="aero" style="text-align:center;" placeholder="Airport" @if(isset($aero)) value="{{$aero}}" @endif maxlength="3">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 xs-p-lr-5 from_to_adj_width">
                                            <div class="form-row">
                                                <div class="form-search-row-left from_widthv">
                                                    <div class="form-group">
                                                        <div class="input-group from_dp_pos">
                                                            <input type="text"  class="datepicker1 clear from_control1" id="frm" readonly name="frm_date" autocomplete="off" @if(isset($frm_date)) value="{{$frm_date}}" @endif placeholder="From" data-date-range-end="#to">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-search-row-right to_widthv">
                                                    <div class="form-group">
                                                        <div class="input-group xs-m-r-0">
                                                            <input type="text"  class="form-control  datepicker1 clear" id="to"  readonly name="to_date" autocomplete="off"  style="border-radius: 0px;background:#fff;" placeholder="To"  @if(isset($to_date)) value="{{$to_date}}" @endif data-date-range-start="#frm">      
                                                            <div class="input-group-addon search-addon" style="border:none;">
                                                            <button id="second" type="submit" value="search" class="btn newbtnv1" style="height: 34px;"><span class="glyphicon glyphicon-search"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         <div>
                                     </div>     
                                </div>
                            </form>
                            <form action="{{url('fpl/fuelprice')}}" class="form_wrapper" method="POST" id="bp_hp">
                                    {{csrf_field()}}
                                    <div class="col-md-1 bgwrapper_blue hpwrapper_main">
                                        <button type="submit" class="hpmainbutton fuel_filter btn" value="hp_filter" name="submit" @if($disable==true) disabled @endif>HINDUSTAN PETROLEUM</button >
                                    </div>
                                    <div class="col-md-1 bgwrapper_yellow">
                                        <button type="submit" class="bpmainbutton fuel_filter btn" value="bp_filter" name="submit">BHARAT PETROLEUM</button> 
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="result">
                    <div class="desk-view">
                        <div class="row" style="margin-right: 0px; margin-left: 0px;">
                            <div class="col-md-12">
                                <table class="fuel_info table table-hover table-responsive desk-plan" id="fuelpricelist">
                                    <thead>
                                        <tr>
                                            <th class="slno_price two_main_th">Sl</th>
                                            <th class="code_price two_main_th">CODE</th>
                                            <th class="city_price two_main_th">CITY</th>
                                            <!-- <th class="eflight_price two_main_th">EFLIGHT PRICE</th> -->
                                            <th class="hpprice_price two_main_th">HP PRICE</th>
                                            <th class="basic_price two_main_th">BASIC PRICE</th>
                                            <th class="tax_price two_main_th">TAX %</th>
                                            <th class="taxamount_price two_main_th">TAX AMOUNT</th>

                                            <th class="fromdate_price two_main_th">FROM DATE</th>
                                            <th class="todate_price two_main_th">TO DATE</th>
                                            <th class="actions_price two_main_th">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="main_table">
                                        @php $i=1  @endphp
                                        <?php //dd($latestfuelid);?>
                                        <?php $fuelpricelist = (isset($fuelpricelist)) ? $fuelpricelist : [];
                                        ?>
                                        @foreach($fuelpricelist as $fuelprice)
                                        <tr role="row" id="record_{{$fuelprice['id']}}">
                                            {{ csrf_field() }}
                                            <td class="one_main_table_td @if($fuelprice['fuel_type']==2) red_color  @endif" style="font-weight: normal !important">{{$i++}}</td>
                                            <td class="one_main_table_td @if($fuelprice['fuel_type']==2) red_color  @endif" id="aero_code">{{$fuelprice['airport_code']}}</td>
                                            <td class="one_main_table_td @if($fuelprice['fuel_type']==2) red_color  @endif" id="aero_city">{{$fuelprice['city']}}</td>
                                            <td class="one_main_table_td" id="hp_price" style="font-weight: bold !important">{{sprintf('%.0f',$fuelprice['hp_price'])}} </td> 
                                           
                                            <td class="editrow  one_main_table_td" style="font-weight: normal !important">
                                                <input style="width:110px;" type="text" class="decimal edit b_price_popover number"  value="{{sprintf('%.0f',$fuelprice['basic_price'])}}"  id="basic_price" disabled data-placement="top" data-v-max="99999.99" data-m-dec="0" data-value="{{sprintf('%.0f',$fuelprice['basic_price'])}}">
                                            </td>

                                            <td class="editrow  one_main_table_td" style="font-weight: normal !important">
                                                <input style="width:65px;" type="text" class="edit_decimal tax_decimal edit number" value="{{$fuelprice['tax']}}" id="tax" disabled data-placement="top" data-v-max="99.99" data-m-dec="2" data-value="{{$fuelprice['tax']}}">
                                            </td>
                                            <td class="one_main_table_td" id="tax_amount" style="font-weight: normal !important">{{sprintf('%.0f',$fuelprice['tax_amount'])}}</td>

                                            <td class="editrow from_date one_main_table_td" id="from_date" style="font-weight: normal !important">
                                                <input type="text" disabled class="form-control fpl_from_box  field_fromdate datepicker1 clear from_fuel_date" style="font-weight:normal!important;" name="date" autocomplete="off" data-fuelid="{{$fuelprice['id']}}"
                                                       @if(!empty($fuelprice['from_date'])) value="{{date('d-M-Y', strtotime($fuelprice['from_date']))}}"  data-value="{{date('d-M-Y', strtotime($fuelprice['from_date']))}}" @endif>
                                            </td>
                                            <td class="editrow to_date one_main_table_td" id="to_date" style="width:80px;border-radius: 0px;text-align: center;" >
                                                <input type="text" disabled class="form-control fpl_from_box datepicker1 clear to_fuel_date {{date('d-M-Y',strtotime($fuelprice['to_date']))}}" style="font-weight:normal!important;"   name="date" id="to_date{{$fuelprice['id']}}"autocomplete="off"  @if(!empty($fuelprice['to_date'])) value="{{date('d-M-Y', strtotime($fuelprice['to_date']))}}" data-value="{{date('d-M-Y', strtotime($fuelprice['to_date']))}}" @endif >
                                            </td>

                                            @if($fuelprice['id']==$latestfuelid)
                                            <td class="one_main_table_td">
                                                <div class="tooltip_rel">
                                                    <a class="edit_license" id="edit_license" data-fuelid="{{$fuelprice['id']}}"><i class="fa fa-pencil-square pencil_fuel_price"></i></a><span class="p-l-9"></span>
                                                    <span class="tooltip_edit_position hover" style="left:-16px;">Edit</span>
                                                    <span class="tooltip_tri_shape1 hover" style="right:7px;"></span>
                                                </div>
                                                <div class="tooltip_rel">
                                                    <a data-toggle="modal" data-target="#AddFuelData" style="cursor:pointer;margin-right:10px;margin-left:10px;" class="Add_row_fuel  " data-value="94" data-aerocode="{{$fuelprice['airport_code']}}" data-city="{{$fuelprice['city']}}" data-fuel_type="{{$fuelprice['fuel_type']}}" data-tax="{{$fuelprice['tax']}}" style="margin-right: 10px;"><i class="fa fa-plus plus_fuel_price"></i></a><span class="p-l-9"></span>
                                                    <span class="tooltip_edit_position hover" style="left:-16px;">NEW PRICE</span>
                                                    <span class="tooltip_tri_shape1 hover" style="right:16px;"></span>
                                                </div>
                                                <div class="tooltip_rel">
                                                    <a class="saverecord" id="SaveRecord" data-fuelid="{{$fuelprice['id']}}" ><i class="fa fa-floppy-o saveicon_record" aria-hidden="true"></i></a><span class="p-l-9" ></span>
                                                    <span style="left: -19px;" class="tooltip_edit_position">SAVE</span>
                                                    <span style="right:8px;"class="tooltip_tri_shape1"></span>
                                                </div>
                                                <div class="tooltip_rel" >
                                                    <a class="viewhistory" data-toggle="modal" data-target="#ViewHistory" data-fuelid="{{$fuelprice['id']}}" style="cursor:pointer;" data-target="#ViewHistory">
                                                        <i class="fa fa-history pencil_fuel_price" ></i></a><span class="p-l-9"></span>
                                                        <span class="tooltip_edit_position t_vh hover" style="left:-30px;">History</span>
                                                        <span class="tooltip_tri_shape2 hover"></span>
                                                </div>
                                            </td>
                                            @else
                                            <td class="one_main_table_td">
                                                <div class="tooltip_rel">
                                                    <a class="edit_license" id="edit_license" data-fuelid="{{$fuelprice['id']}}" style="margin-right: 10px;"><i class="fa fa-pencil-square pencil_fuel_price"></i></a><span class="p-l-9"></span>
                                                    <span class="tooltip_edit_position hover" style="left:-16px;">Edit</span>
                                                    <span class="tooltip_tri_shape1 hover" style="right:16px;"></span>
                                                </div>   
                                                <div class="tooltip_rel">
                                                    <a class="saverecord" id="SaveRecord" data-fuelid="{{$fuelprice['id']}}" style="margin-right: 10px;"><i class="fa fa-floppy-o saveicon_record" aria-hidden="true"></i></a><span class="p-l-9" ></span>
                                                    <span style="left: -19px;" class="tooltip_edit_position">SAVE</span>
                                                    <span style="right:17px;"class="tooltip_tri_shape1"></span>
                                                </div>
                                                <div class="tooltip_rel" >
                                                    <a class="viewhistory" data-toggle="modal" data-target="#ViewHistory" data-fuelid="{{$fuelprice['id']}}" style="cursor:pointer;" data-target="#ViewHistory">
                                                        <i class="fa fa-history pencil_fuel_price" ></i></a><span class="p-l-9"></span>
                                                        <span class="tooltip_edit_position t_vh hover">History</span>
                                                        <span class="tooltip_tri_shape2 hover"></span>
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</main>
<!-- Modal -->
<div class="modal fade" id="AddAirport" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                <h4 class="modal-title">ADD AIRPORT</h4>
            </div>
            <form method="POST" action="{{url('fpl/fuelprice/add-airport')}}" id="add-airport">
                <div class="modal-body">
                    <div class="col-sm-12" style="padding-right:0px;">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets form-control modtooltip ui-autocomplete-input" placeholder="AIRPORT CODE"  id="airport_code" name="airport_code" autocomplete="off" data-placement="top">
                            {{ csrf_field() }}
                        </div>
                    </div>
                    <div class="col-sm-12" style="padding-right:0px;">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets_with_space form-control modtooltip ui-autocomplete-input" placeholder="CITY NAME"  id="city" name="city" autocomplete="off" data-placement="top" style=";text-transform: uppercase;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding:0px 0px 10px 0px;">
                    <div class="col-sm-3"><input type="checkbox" name="fuel_type" value="1" checked> HP<br></div>
                    <div class="col-sm-9"><button type="submit" class="btn  newbtnv1" style="width:100px;left:35px;">ADD</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="ViewHistory" role="dialog">
    <div class="modal-dialog" style="width:900px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                <h4 class="modal-title">HISTORY</h4>
            </div>
            <div class="modal-body" style="padding-left:30px;padding-right:30px;padding-top:0px;">
                <table class="fuel_info history_fuel table table-hover table-responsive desk-plan" id="fuel_info">
                    <thead style="background: #333;">
                        <tr>
                            <th style="width:20px !important;border-left: 1px solid #000;">Sl</th>
                            <th style="width:35px !important;">ACTIONS</th>
                            <th style="width:70px !important;">BASIC PRICE</th>
                            <th style="width:30px !important;">TAX</th>
                            <th style="width:60px !important;">FROM DATE</th>
                            <th style="width:60px !important;">TO DATE</th>
                            <th style="width:100px !important;">DATE AND TIME</th>
                            <th style="width:50px !important;">BY</th>
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
<div class="modal fade" id="AddFuelData" role="dialog">
    <div class="modal-dialog" style="width: 295px;">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal_close close_style_addairport" data-dismiss="modal"><i class="fa fa-times-circle"></i></span>
                <h4 class="modal-title" style="padding: 4px 0px 4px 0px;font-size: 14px"><span> ADD </span><span id="fuel_price_heading"></span><span>FUEL PRICE</span></h4>
            </div>
            <form method="POST" action="{{url('fpl/fuelprice/add-fuelprice')}}" id="addfuelprice">
                <div class="modal-body" style="padding-left:15px;">
                    <input type="hidden" name="city" id="fuel-city">
                    <input type="hidden" name="airport_code" id="fuel-aerocode">
                    <input type="hidden" name="fuel_type" id="fuel-type">
                    <div class="col-sm-12">
                        <div class="form-group">
                    <input type="text" class="auto_operator text-center font-bold  form-control modtooltip decimal ui-autocomplete-input number" placeholder="BASIC PRICE"  name="basic_price"  id="fuelbasicprice" autocomplete="off" data-placement="top" data-v-max="99999.99" data-m-dec="0">
                            
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="text" class="auto_operator text-center font-bold  form-control tax_decimal  modtooltip  ui-autocomplete-input number" placeholder="TAX"  name="tax"  id="fueltax" autocomplete="off" data-placement="top" minlength="5" maxlength="5" data-v-max="99.99" data-m-dec="2">
                        </div>
                    </div>
                    <div class="col-sm-6 fromdate_newprice" style="padding-right: 0px;">
                        <div class="form-group" >
                            <input type="text" class="auto_operator text-center font-bold text_uppercase alphabets from_control1 modtooltip ui-autocomplete-input" placeholder="FROM DATE"  id="fuelfrom_date" name="from_date" autocomplete="off" data-placement="top" data-date-range-end="#fuelto_date" readonly >
                        </div>
                    </div>
                    <div class="col-sm-6 todate_newprice add_fuel_from_cal" style=" padding-left: 0px;">
                        <div class="form-group">
                            <input type="text" style="cursor:pointer;text-align: left;border-radius: 0px 5px 5px 0px;" class="auto_operator text-center font-bold text_uppercase alphabets form-control modtooltip ui-autocomplete-input" placeholder="TO DATE"  id="fuelto_date" name="to_date" autocomplete="off" data-placement="top" data-date-range-start="#fuelfrom_date" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn  newbtnv1" style="width:100px;">ADD</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div id='v_toTop'><span></span></div>
@include('includes.new_footer',[])
</div>
<script src="{{url('app/js/fpl/fuel_price.js')}}" type="text/javascript"></script>
<script type="text/javascript">
 $(function() {
     $(".number").autoNumeric("init",{ aSep: ''});
     $('.dataTables_wrapper').on('mousedown touchstart', '.paginate_button:not(.previous):not(.next)', function() 
     {   
       setTimeout(function(){ console.log("ww"); $(".number").autoNumeric("init",{ aSep: ''}); }, 1000);
     });
    
});
$(document).ready(function() {
   $('#AddAirport, #ViewHistory, #AddFuelData').on('show.bs.modal', function (e) {
    $('body').addClass('test');
   });
});
</script>
@stop