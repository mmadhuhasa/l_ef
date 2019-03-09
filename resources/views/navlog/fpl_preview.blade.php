<div class="page" id="quick_app">
<style>
 .growl.growl-large {
   width: 400px !important;
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
.tooltip_fpl_position2 {left:60px;}
.tooltip_info_position  {left: 35px;}
.tooltip_revise_position {left: 45px;width: 78px;}
.tooltip_change_position {left: -45px;width: 79px;}
.tooltip_revise_dbl_position_valid {left:0;}
.tooltip_revise_dbl_position {width:175px;z-index: 9999;left: 15px;top:-25px;}
.tooltip_pdf_position, .tooltip_notam_position, .tooltip_wx_position {left:-70px;}
.tooltip_pdf_position {left:-38px;}
.carousel-inner > .item > a > img, .carousel-inner > .item > img, .img-responsive, .thumbnail a > img, .thumbnail > img{
max-width: 112%!important; 
}
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
.q_filter .depstatns, .q_filter .destatns {width:21%;}
.from_to_adj_width {width:31.5%;}
.from_dp_pos {width: 100%;}
.from_widthv {width: 42% !important;}
#from_date {text-align: left;font-size: 13px;font-weight: normal;color: #222;}
#to_date {padding-left: 5px;font-size:13px;font-weight: normal;color: #222;text-align: left;width: 137%;border-radius: 5px;}
.to_widthv {width: 58%;}
.top {margin-top:10px;margin-bottom: 10px;width: 100%;float: left;}
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
    <main>
        <div class="container" ng-if="submitNavlog">
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
                                                    <input ng-model="navlogv2.callsign_real" required type="text" required="required" data-toggle ="popover" data-placement="bottom"   minlength="5" maxlength="7" autocomplete="off" data-url="{{url('/fpl/get_callsign_details')}}" readonly='readonly' value="{{Session::get('aircraft_callsign')}}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip departure_aerodrome_autocomplete get_plan_status"  placeholder="Call Sign" id="aircraft_callsign" name="aircraft_callsign" tabindex="1">
                                                    @else
                                                    <input disabled ng-model="navlogv2.callsign_real" required type="text" data-toggle ="popover" data-placement="bottom"   minlength="5" maxlength="7" autocomplete="off" data-url="{{url('/fpl/get_callsign_details')}}" {{(isset($aircraft_callsign)) ?  "readonly='readonly'": ""}} value="{{ (isset($aircraft_callsign)) ?  $aircraft_callsign: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip departure_aerodrome_autocomplete get_plan_status auto_callsigns"  placeholder="Call Sign" id="aircraft_callsign" name="aircraft_callsign" tabindex="1">
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
                                                            <input disabled ng-model="navlogv2.depAerodrome" required="required" type="text" data-toggle = "popover"  data-placement="bottom"   minlength="4" maxlength="4"  name="departure_aerodrome" autocomplete="off" id="departure_aerodrome" {{ (isset($departure_aerodrome)) ?  "readonly='readonly'": "" }} value="{{ (isset($departure_aerodrome)) ?  $departure_aerodrome: "" }}" class="alphabets redirect text-center font-bold text_uppercase validation_class form-control get_plan_status"  placeholder="From" data-redirect-url="{{url('fpl?page=new_full_fpl')}}" data-url="{{url('fpl/check_callsign_exist')}}" tabindex="2">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-search-row-right">
                                                        <div class="form-group">
                                                            <input disabled ng-model="navlogv2.destAerodrome" required="required"  type="text" data-toggle = "popover"  data-placement="bottom"   minlength="4" maxlength="4" class="alphabets text-center font-bold text_uppercase validation_class form-control get_plan_status" autocomplete="off"  {{ (isset($destination_aerodrome)) ?  "readonly='readonly'": "" }} placeholder="To" value="{{ (isset($destination_aerodrome)) ?  $destination_aerodrome: "" }}" name="destination_aerodrome" id="destination_aerodrome" tabindex="3" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3 fpl_deptime_label">
                                                <label for="depart-time" class="flytime timedpt">Departure Time</label>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="form-time-left search-time-left">
                                                            
                                                            <dl  id="hour" class="dropdown form-control validation_class_click disabled_color"   data-toggle = "popover"  data-placement="top">
                                                                <dt><a>
                                                                        <span id="dep_time_hours" style="font-size: 13px;text-align: center" class="dept_time_hours_text disabled_color"  readonly ng-bind="navlogv2.etd_hr"></span>
                                                                    </a>
                                                                </dt>
                                                            </dl>
                                                           
                                                           
                                                        </div>
                                                        <div class="form-time-left search-time-left">
                                                            <dl id="mins" class="dropdowns form-control validation_class_click disabled_color"  data-toggle = "popover"  data-placement="top">
                                                                <dt><a>
                                                                        <span id="dep_time_minutes" style="font-size: 13px;text-align: center" class="dept_time_hours_text disabled_color" ng-bind="navlogv2.etd_mins"></span>
                                                                    </a>
                                                                </dt>
                                                            </dl>
                                                           
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
                                                                
                                                                <input ng-model="navlogv2.date_of_flight" type="text" autocomplete="off" data-url="{{url('/fpl/get_callsign_details2')}}"  readonly='readonly' style="background: #eee; text-align:center;width: 132px" class="form-control text-center font-bold" placeholder="Date of Flight" name="date_of_flight" id="date_of_flight" minlength="6" maxlength="6" tabindex="5" readonly="readonly">
                                                              
                                                                <span class="dof_label">Date of Flight</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-search-row-right processbtn deskprocess">
                                                        <div class="form-group">
                                                            @if(true)
                                                            <a data-toggle="modal" onClick="$('#resetbox').modal()"  class="btn newbtnv1"  tabindex="14" style="line-height: 19px;right: -18px">Reset</a>
                                                            @elseif(Session::get('is_plan_filed'))
                                                            <a style="width:100%" data-toggle="modal" id="reset" onClick="$('#resetbox').modal()"  class=" btn newbtnv1"  tabindex="14">Reset</a>
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
                                                    <input disabled ng-model="navlogv2.pilot" required="required" type="text" data-toggle = "popover"   data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command" value="{{ (isset($pilot_in_command)) ?  $pilot_in_command: "" }}" placeholder="Pilot Name" name="pilot_in_command"  id="pilot_in_command" tabindex="6">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(Session::get('mobile_number'))
                                                    <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="10" maxlength="10" autocomplete="off" class="numbers validation_class text-center font-bold form-control"   value="{{Session::get('mobile_number')}}" placeholder="Mobile Number" name="mobile_number"  id="mobile_number" tabindex="7">
                                                    @elseif(isset($mobile_number))
                                                    <input required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="10" maxlength="10" autocomplete="off" class="numbers validation_class text-center font-bold form-control" readonly='readonly' value="{{ (isset($mobile_number)) ?  $mobile_number: "" }}" placeholder="Mobile Number" name="mobile_number"  id="mobile_number" tabindex="7">
                                                    @else
                                                    <input disabled ng-model="navlogv2.pilot_mobile" required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="10" maxlength="10" autocomplete="off" class="numbers validation_class text-center font-bold form-control" value="{{ (isset($mobile_number)) ?  $mobile_number: "" }}" placeholder="Mobile Number" name="mobile_number"  id="mobile_number" tabindex="7">
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
                                                    <input disabled ng-model="navlogv2.copilot" required="required" type="text"  data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class validation_class form-control pilot_in_command"  value="{{ (isset($copilot)) ?  $copilot: "" }}" placeholder="Co Pilot Name" name="copilot"  id="copilot" tabindex="8">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(Session::get('cabincrew'))
                                                    <input type="text" data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class form-control pilot_in_command" value="{{Session::get('cabincrew')}}" placeholder="Cabin Name" name="cabincrew"  id="cabincrew" tabindex="9">
                                                    @else
                                                    <input disabled ng-model="navlogv2.copilot_mobile" type="text"  data-toggle = "popover"  data-placement="top"   minlength="2" maxlength="25" autocomplete="off" class=" text-center font-bold text_uppercase validation_class form-control pilot_in_command" {{ (isset($cabincrew)) ?  "readonly='readonly'": "" }} value="{{ (isset($cabincrew)) ?  $cabincrew: "" }}" placeholder="Cabin Name" name="cabincrew"  id="cabincrew" tabindex="9">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    @if(isset($remarks))
                                                    <input type="text" autocomplete="off" readonly="readonly" class="form-control text-center font-bold text_uppercase validation_class route_allowed_chars" name="remarks" id="remarks" value="{{ (isset($remarks)) ?  $remarks: "" }}" placeholder="Remarks" data-toggle="popover" data-placement="bottom" maxlength="149" minlength="3" data-original-title="" title="">
                                                    @else
                                                    <input ng-model="navlogv2.remarks" disabled type="text" autocomplete="off" class="form-control text-center font-bold text_uppercase validation_class route_allowed_chars" name="remarks" id="remarks" value="" placeholder="Remarks" data-toggle="popover" data-placement="bottom" maxlength="149" minlength="3" data-original-title="" title="">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(Session::get('destination_station'))
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ Session::get('destination_station')}}" class="operator text-center font-bold text_uppercase validation_class form-control get_plan_status" id="departure_station" name="departure_station" placeholder="Dep. ZZZZ Place Name" tabindex="10">
                                                    @else
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ (isset($departure_station)) ?  $departure_station: "" }}" class="operator text-center font-bold text_uppercase validation_class form-control" id="departure_station" name="departure_station" placeholder="Dep. ZZZZ Place Name" tabindex="10">
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(Session::get('destination_latlong'))
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="11" maxlength="15" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ Session::get('destination_latlong') }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="departure_latlong" name="departure_latlong" placeholder="Dep. ZZZZ Lat-Long" tabindex="11">
                                                    @else
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="11" maxlength="15" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ (isset($departure_latlong)) ?  $departure_latlong: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="departure_latlong" name="departure_latlong" placeholder="Dep. ZZZZ Lat-Long" tabindex="11">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(0)
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ Session::get('destination_station') }}" class="operator text-center font-bold text_uppercase validation_class form-control" id="destination_station" name="destination_station" placeholder="Dest. ZZZZ Place Name" tabindex="12">
                                                    @else
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="3" maxlength="25" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}'  value="{{ (isset($destination_station)) ?  $destination_station: "" }}" class="operator text-center font-bold text_uppercase validation_class form-control get_plan_status" id="destination_station" name="destination_station" placeholder="Dest. ZZZZ Place Name" tabindex="12">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    @if(0)
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="9" maxlength="15" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}' value="{{ Session::get('destination_latlong') }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="destination_latlong" name="destination_latlong" placeholder="Dest. ZZZZ Lat-Long" tabindex="13">
                                                    @else
                                                    <input type="text" data-toggle = "popover"  data-placement="top" minlength="9" maxlength="15" readonly autocomplete="off" data-url='{{url('fpl/station_latlong')}}' value="{{ (isset($destination_latlong)) ?  $destination_latlong: "" }}" class="alpha_numeric text-center font-bold text_uppercase validation_class form-control" id="destination_latlong" name="destination_latlong" placeholder="Dest. ZZZZ Lat-Long" tabindex="13">
                                                    @endif
                                                </div>
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
                                    <input type="hidden" name="user_mobile" id="user_mobile" value="{{Auth::user()->mobile_number}}" />
                                    <input type="hidden" name="is_myaccount" id="is_myaccount" value="{{(isset($is_myaccount)) ? $is_myaccount : '' }}" />
                                    <input type="hidden" name="environment" id="environment" value="{{env('APP_ENV')}}" />
                                    <input type="hidden" name="total_time_after_flying" id="total_time_after_flying" value="" />
                                    <input type="hidden" name="total_flying_time_format1" id="total_flying_time_format1" value="" />
                                    <input type="hidden" name="total_flying_time_format2" id="total_flying_time_format2" value="" />
                                    <input type="hidden" name="is_app" id="is_app" value="0" />
                                    <input type="hidden" name="is_web" value="1">
                                    <input type="hidden" name="is_new_plan" id="is_new_plan" value="{{(isset($is_new_plan)) ? $is_new_plan : ''  }}">
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
                        @if(true)
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
                                                                    <h5>NAVLOG</h5>
                                                                    <span id="qucik_responce">
                                                <p>
                        (FPL-<span ng-bind="atcFpl.callsign"></span>-<span ng-bind="atcFpl.flightRule"></span>N<br>
                        -CL30/M-SDFGHJ4J5RVWY/LB1<br>
                        -<span ng-bind="atcFpl.depAerodrome"></span><span ng-bind="atcFpl.etd"></span><br>
                        -N0<span ng-bind="atcFpl.speed"></span>F<span ng-bind="atcFpl.fLevel"></span> <span ng-bind="atcFpl.route"></span><br>
                        -<span ng-bind="atcFpl.dest"></span><span ng-bind="atcFpl.ete"></span> <span ng-bind="atcFpl.altnAirport"></span><br>
                        -PBN/A1B2B3C2D2D3L1O2 NAV/GPSRNAV DOF/<span ng-bind="atcFpl.dof"></span> REG/<span ng-bind="atcFpl.callsign"></span>
                        EET/<span ng-bind="atcFpl.fir"></span> SEL/DGFM OPR/JUPITER CAPITAL PVT LTD PER/B RMK/<span ng-model="navlogv2.remarks"></span> CREDIT
                        FACILITY AVAILABLE WITH AAI PIC <span ng-bind="navlogv2.pilot"></span> MOB <span ng-bind="navlogv2.pilot_mobile"></span> FO <span ng-bind="navlogv2.copilot"></span> <span ng-bind="navlogv2.copilot_mobile"></span> ALL
                        INDIANS ON BOARD E0629 PAX<span ng-bind="atcFpl.pax"></span>) </p>
                                                                        <!--{!! (isset($fpl_info)) ?  str_ireplace('<br>', "<span class='clearfix'></span>", $fpl_info) : ' <div id="fpl_view" style="height: 200px;display:none;"></div>' !!}-->
                                                                        <!-- {!! (isset($fpl_info)) ?  $fpl_info : ' <div id="fpl_view" style="height: 200px;display:none;"></div>' !!} -->
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @if(true)
                                                                <div class="buttons">
                                                                    <div class="row">
                                                                        <div class="col-xs-offset-1 col-xs-5 col-sm-offset-3 col-sm-3 col-md-offset-3 col-md-3 btn-align">
                                                                            <!--<input  data-toggle="modal" class="btn newbtn_black" data-target="#editbox"     type="button"  value="Edit" >-->
                                                                            <button data-toggle="modal" class="btn newbtn_black" style="height:36px;" onClick="$('#editbox').modal()" data-target="#"  {{(true) ? '' : 'disabled="disabled"'}} >Edit</button>
                                                                        </div>
                                                                        <div class="col-xs-5 col-sm-2 col-md-4 btn-align file-cnf">
                                                                            <!--<input data-toggle="modal" data-target="#confbox" type="button"  id="file" {{(true)? '' : 'disabled="disabled"'}} class="btn btn-primary file-btn" name="flag" value="File">-->
                                                                            <!--<input  type="button"   value="File">-->
                                                                            <button id="file"  name="flag" data-url="{{url('new_fpl/get_auto_num_details')}}" class="btn newbtnv1 file-btn file_the_process" style="height:36px;" ng-click="filePlan()">File</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(true)
                                                    <div class="col-md-6">
                                                        <div class="fdtl-info">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>FDTL</h5>
                                                                    
                                                                <div class="col-md-7 p-lr-0"> 
                                                                   <div> COMPUTED FUEL: <span ng-bind="navlogv2.blockFuel"></span> </div>
                                                                   <div>MIN. TRIP FUEL: <span ng-bind="navlogv2.minFuel"></span> </div>
                                                                   <div>MAX. TRIP FUEL : <span ng-bind="navlogv2.maxFuel"></span> </div>
                                                                   <div class="col-md-12 p-lr-0"><span class="col-md-6 p-lr-0" >TAXI  :</span> <span class="col-md-2 p-lr-0" >0:10</span>  <span class="col-md-2 p-lr-0" ng-bind="navlogv2.taxiFuel"></span> </div>
                                                                   <div class="col-md-12 p-lr-0"><span class="col-md-6 p-lr-0" >TRIP : </span><span class="col-md-2 p-lr-0" ng-bind="navlogv2.tripTime"></span> <span ng-bind="navlogv2.tripFuel"></span></div>
                                                                   <div class="col-md-12 p-lr-0"><span class="col-md-6 p-lr-0" >CONTINGENCY 5%: </span> <span class="col-md-2 p-lr-0" >0:05</span>  <span ng-bind="navlogv2.contingency"></span></div>
                                                                   <div class="col-md-12 p-lr-0"><span class="col-md-6 p-lr-0" >DEST ALTERNATE :</span> <span class="col-md-2 p-lr-0" ng-bind="navlogv2Altn.ete"></span> <span ng-bind="navlogv2.altnFuel"></span></div>
                                                                   <div class="col-md-12 p-lr-0"><span class="col-md-6 p-lr-0" >RESERVE FUEL : </span> <span class="col-md-2 p-lr-0">0:30</span>  <span ng-bind="navlogv2.reserveFuel"></span></div>
                                                                   <div class="col-md-12 p-lr-0"><span class="col-md-6 p-lr-0" >ADDITIONAL : </span>  <span class="col-md-2 p-lr-0" ng-bind="navlogv2.extraTime"></span>  <span ng-bind="navlogv2.extraFuel-navlogv2.contingency"></span> </div>  
                                                                   <div class="col-md-12 p-lr-0"><span class="col-md-6 p-lr-0" >TOTAL :  </span>  <span class="col-md-2 p-lr-0" ng-bind="navlogv2.totalTime"></span>  <span ng-bind="navlogv2.totalFuel"></span> </div>  
                                                                   <div>ALTN :   <span ng-bind="navlogv2.altnAirport"></span></div>  
                                                                   <div>ALTN ROUTE :  <span ng-bind="navlogv2.altnRoute"></span> </div>  
                                                                   <div>DIST :  <span ng-bind="navlogv2.distance"></span> </div>  
                                                                   <div>TAS :  <span ng-bind="navlogv2.tas[0]"></span> </div>  
                                                                   <div>WIND : <span ng-bind="navlogv2.avgWind"></span>  </div>  
                                                                </div>
                                                                <div class="col-md-5 p-lr-0"> 
                                                                <div> BLOCK FUEL: <span ng-bind="navlogv2.blockFuel"></span> </div>
                                                                   <div>TAKE OFF FUEL: <span ng-bind="navlogv2.blockFuel-navlogv2.taxiFuel"></span></div>
                                                                   <div>LANDING FUEL : <span ng-bind="navlogv2.landingFuel"></span></div>
                                                                   <div>LOAD : <span ng-bind="navlogv2.load"></span></div>
                                                                   <div>BASIC WT : <span ng-bind="navlogv2.basicWeight"></span></div>
                                                                   <div>ZERO FUEL : <span ng-bind="navlogv2.zeroFuelWeight"></span></div>
                                                                   <div>T.OFF WT : <span ng-bind="navlogv2.takeOffWeight"></span></div>
                                                                   <div>LAND WT : <span ng-bind="navlogv2.landingWeight"></span></div>

                                                                </div>
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
                                                                    <!-- {!! (isset($supplementary_info)) ? str_ireplace('<br>', "<span class='clearfix'></span>", $supplementary_info) : '' !!} -->
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
                                                                {!! (isset($get_dept_sunrise_sunset_info)) ? $get_dept_sunrise_sunset_info : '' !!}
                                                                <div class="stat-desc">
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
                        <div class="row cust_box_shadow">
                            <div class="col-md-12 p-lr-0">
                                <p class="search_heading">Search Account</p>
                            </div>
                            <div class="col-md-12 p-lr-0" style="width:100%;float:left">
                                <div class="q_filter">
                                    <!--<form name="search" id="search" method="post" action="{{url('/fpl')}}">-->
                                    <form data-url="{{url('/new_fpl/get_filter_data')}}" name="search" id="fpl_search" method="post" action="#">
                                        <div class="col-sm-6 col-md-3 xs-p-lr-5">
                                            <div class="form-group">
                                                <input type="text" data-toggle ="popover" data-placement="bottom"  minlength="5" maxlength="7" autocomplete="off"   class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip auto_callsigns"  placeholder="Call Sign" id="aircraft_callsign2" name="aircraft_callsign2" tabindex="1">
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

                        <?php
                        $day = 1;
                        $month = 1;
                        $total = 1;
                        $get_day_count_fpl = App\models\FlightPlanDetailsModel::get_count_fpl($day);
                        $get_month_count_fpl = App\models\FlightPlanDetailsModel::get_count_fpl('', $month);
                        $get_total_count_fpl = App\models\FlightPlanDetailsModel::get_count_fpl();
                        $day_count = count($get_day_count_fpl);
                        $month_count = count($get_month_count_fpl);
                        $total_count = $get_total_count_fpl;
                        $current_day = date('ymd');

                        $get_day_cancel_plans = App\models\FlightPlanDetailsModel::get_count_fpl('cancel');


                        $get_fpl_stats_ui = App\models\FPLStatsUIModel::get_all();

                        $helicopter_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->helicopter_plans : '';
                        $helicopter_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $helicopter_list);
                        $helicopter_list = str_replace("'", "", $helicopter_list);
                        $helicopter_list = explode(",", $helicopter_list);

                        $navlog_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->navlog_plans : '';
                        $navlog_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $navlog_list);
                        $navlog_list = str_replace("'", "", $navlog_list);
                        $navlog_list = explode(",", $navlog_list);

                        $weather_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->weather_plans : '';
                        $weather_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $weather_list);
                        $weather_list = str_replace("'", "", $weather_list);
                        $weather_list = explode(",", $weather_list);


                        $helicopter_plans = App\models\FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->where('plan_status', '1')
                                ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                                ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                                ->whereIN('aircraft_type', $helicopter_list)
                                ->count();

                        $fixed_wing_plans = App\models\FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->where('plan_status', '1')
                                ->where('aircraft_callsign', 'NOT LIKE', '%TESTA%')
                                ->where('aircraft_callsign', 'NOT LIKE', '%TESTX%')
                                ->whereNOTIN('aircraft_type', $helicopter_list)
                                ->count();

                        $whether_plans = \App\models\FlightPlanDetailsModel::where('is_active', '1')
                                        ->where('date_of_flight', $current_day)
                                        ->where('plan_status', '1')
                                        ->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), $weather_list)->count();

                        $navlog_plans = \App\models\FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->where('plan_status', '1')
                                ->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), $navlog_list)
                                ->orWhere(function($query) use($current_day) {
                                    $query->where('is_active', '1');
                                    $query->where('date_of_flight', $current_day);
                                    $query->where('plan_status', '1');
                                    $query->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,6)"), ['ZOM101', 'ZOM301']);
                                })
                                ->count();
                        ?>
                        <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>

                        <div class="glassy">
                            <div class="stat_icons">
                                <div class="stats_fixed_wing" @click="wing_plans('2')">
                                    <img src="{{url('media/images/fpl/staticons/flight01.png')}}"/>
                                    <p class="fixed_wing_count">{{$fixed_wing_plans}}</p>
                                    <span class="tooltip_fixed_wing Todayfixedwingplans_body">Today fixed wing plans</span>
                                    <span class="tooltip_trishape_01 Todayfixedwingplans_shape"></span>
                                </div>
                                <div class="stats_heli" @click="wing_plans('1')">
                                    <img src="{{url('media/images/fpl/staticons/heli01.png')}}"/>
                                    <p class="heli_count">{{$helicopter_plans}}</p>
                                    <span class="tooltip_heli Todayhelicopterplans_body">Today helicopter plans</span>
                                    <span class="tooltip_trishape_02 Todayhelicopterplans_shape"></span>
                                </div>
                                @if(Auth::user()->is_admin)
                                <div class="stats_wx" @click="wx_notams">
                                    <img src="{{url('media/images/fpl/staticons/clouds01.png')}}"/>
                                    <p class="wx_count" >{{$whether_plans}}</p>
                                    <span class="tooltip_wx Todayweatherplans_body">Today weather plans</span>
                                    <span class="tooltip_trishape_05 Todayweatherplans_shape"></span>
                                </div>
                                <div class="stats_tripkit"  @click="trip_kit">
                                    <img src="{{url('media/images/fpl/staticons/tripkit01.png')}}"/>
                                    <p class="tripkit_count">{{$navlog_plans}}</p>
                                    <span class="tooltip_tripkit Todaytripkitplans_body">Today trip kit plans</span>
                                    <span class="tooltip_trishape_06 Todaytripkitplans_shape"></span>
                                </div>
                                @endif
                                <div class="stats_year" @click="cancel_plans">
                                    <img style="height:36px" src="{{url('media/images/fpl/staticons/cancel.png')}}"/>
                                    <p class="year_count">{{$get_day_cancel_plans}}</p>
                                    <span class="tooltip_year todaycancelledpans_body">TODAY CANCELLED PLANS</span>
                                    <span class="tooltip_trishape_04 todaycancelledpans_shape"></span>
                                </div>
                                <div class="stats_month">
                                    <img src="{{url('media/images/fpl/staticons/month01.png')}}"/>
                                    <p class="month_count">{{$month_count}}</p>
                                    <span class="tooltip_month Thismonthtotalplans_body">This month total plans</span>
                                    <span class="tooltip_trishape_03 Thismonthtotalplans_shape"></span>
                                </div>
                                <div class="stats_year">
                                    <img src="{{url('media/images/fpl/staticons/year01.png')}}"/>
                                    <p class="year_count">{{$total_count}}</p>
                                    <span class="tooltip_year TOTALPLANSTILLDATE_body">TOTAL PLANS TILL DATE</span>
                                    <span class="tooltip_trishape_04 TOTALPLANSTILLDATE_shape"></span>
                                </div>
                            </div>                            
                        </div>

                        <form id="" name="">
                            <div id="result">
                                <div class="desk-view">
                                    <div class="row">
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
                                                @include('includes.new_myaccount_modals')
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
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
    <div id='v_toTop'><span></span></div>


</div>
<script>
    $(document).ready(function() {
        $('body').on('show.bs.modal',"#preview", function (e) {
        $('body').addClass('test');
        });
    });
    $(document).ready(function () {
        $("#from_date, #to_date,#date_of_flight,.ui-datepicker-trigger").click(function () {
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height', $(document).height());
        });
    });
    $(window).scroll(function () {
        if ($(this).scrollTop()) {
            $('#v_toTop').fadeIn();
        } else {
            $('#v_toTop').fadeOut();
        }
    });

//        $('#date_of_flight, #from_date, #to_date').click(function() {
//            $('.notify-bg-v').css('display','block');
//        });
    $("#v_toTop").click(function () {
        //1 second of animation time
        //html works for FFX but not Chrome
        //body works for Chrome but not FFX
        //This strange selector seems to work universally
        $("html, body").animate({scrollTop: 0}, 500);
    });
</script>
<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
    new Vue({
        el: "#quick_app",
        data: {},
        methods: {
            wx_notams: function (e) {
                e.preventDefault();
                var data_url = base_url + "/new_fpl/get_filter_data";
                var formdata = $("#fpl_search").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['filter_stats'] = 'wx_notams';
                console.log(data)
                $(".dt_loading").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
                this.$http.post(data_url, data).then(function (data) {
                    $("#result").html(data.body);
                });
            },
            trip_kit: function (e) {
                e.preventDefault();
                var data_url = base_url + "/new_fpl/get_filter_data";
                var formdata = $("#fpl_search").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['filter_stats'] = 'trip_kit';
                console.log(data)
                $(".dt_loading").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $("#result").html(data.body);
                    }
                });
            },
            cancel_plans: function (e) {
                e.preventDefault();
                var data_url = base_url + "/new_fpl/get_filter_data";
                var formdata = $("#fpl_search").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['filter_stats'] = 'cancel_plans';
                console.log(data)
                $(".dt_loading").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
                this.$http.post(data_url, data).then(function (data) {
                    $("#result").html(data.body);
                });
            },
            wing_plans: function (e) {
//                e.preventDefault();
                var data_url = base_url + "/new_fpl/get_filter_data";
                var formdata = $("#fpl_search").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['filter_stats'] = 'wing_plans';
                data['wing_type'] = e;
                console.log(data)
                $(".dt_loading").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $("#result").html(data.body);
                    }
                });
            }
        }
    });
</script>

