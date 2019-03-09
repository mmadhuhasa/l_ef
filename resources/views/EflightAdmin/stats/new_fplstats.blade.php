@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<div class="page" id="quick_app">
<style>
.ui-datepicker-calendar td.ui-datepicker-today a {
border-color: #333;
background: #333;
text-align: center;
color: beige;
}
.fpl_search_to_label {
position: absolute;
top: -20px;
left: 26%;
font-size: 13px;
color: #222;
}
.fpl_search_from_label, .fpl_search_to_label {
position: absolute;
top: -20px;
left: 26%;
font-size: 13px;
color: #222;
}
.LR_style{
background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
text-align: center;
padding: 7px 0;
font-weight: 600;
font-size: 15px;
color: #fff;
font-family: 'pt_sansregular', sans-serif;
}
input::placeholder {
color: #999!important;
}
.ui-datepicker-year option:hover {
background-color: #f1292b;
color: #222222;
font-weight: bold;
}
.table-hover>tbody>tr:hover .edit_email_tracker {
visibility:visible;
}
.table-hover>tbody>tr:hover .delete_email_tracker {
visibility:visible;
}
.table-hover>tbody>tr:hover .viewhistory {
visibility:visible;
}
.edit_email_tracker, .viewhistory, .delete_email_tracker{
visibility:hidden;
}
.name-margin{
margin-right: 14px; 
}
@import url('../app/css/font-awesome.min.css');
@media (min-width: 1200px) {
.container {
width: 1000px;
}
}
.cust-container {
margin: 15px auto;
}
.p-lr-0 {padding-left: 0;padding-right: 0;}
.p-lr-10 {padding-left: 10px;padding-right: 10px;}
.p-l-5 {
padding-left: 5px;
}
.p-l-9 {
padding-left: 9px; 
}
.desk-plan .fa {
color:#000;
}
.bg-v-333 {
background: #333;
}
.fa-2x {
font-size: 1.6em;
}
a:hover .fa{ 
color: red;
}
.form_pilots_top {
padding: 20px 0px 0px 0px;
float:left;
border:1px solid #ccc;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
margin:15px;
background: #f2f2f2;
}
.form_pilots_top input[type="text"] {
text-align: center;
font-size: 12px;
}
.pilots_main {
border:1px solid #999;
border-radius: 4px;
background: #fff;
box-shadow: 0 3px 3px 1px #999999;
}
.form_pilots_top input[type='text']::-webkit-input-placeholder {
color: #222;
text-transform: uppercase;
font-size: 13px;
}
.form_pilots_top input[type='text']:-moz-placeholder { /* Firefox 18- */
color: #222;
text-transform: uppercase;
font-size: 13px;
}
.form_pilots_top input[type='text']::-moz-placeholder {  /* Firefox 19+ */
color: #222;
text-transform: uppercase;
font-size: 13px;
}
.form_pilots_top input[type='text']:-ms-input-placeholder {  
color: #222;
text-transform: uppercase;
font-size: 13px;
}
.btn-search-top {
background: #F26232;
/* background: linear-gradient(to top, #fa9b5b, #F26232); */
background: #f1292b;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
background: -moz-linear-gradient(top, #f37858, #f1292b);
color: #fff;
font-size: 14px;
font-weight: 300;
text-transform: uppercase;
text-align: center;
vertical-align: middle;
border:none;
height:32px;
}
.btn-search-top:hover {
color: #fff;
}
table.dataTable thead th, table.dataTable thead td {
padding: 10px 8px;
}
.width-input-boxes {
width: 195px;
}
.width-search {
width:140px;
padding-left: 0;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
font-size:12px;
border-radius: 50%;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
background: #dedede;
color: #f1292b !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
font-size: 12px;
color: #f1f1f1 !important;
border:none;
background: #f1292b;
}
.desk-plan>thead>tr>th{
text-align: center;
font-size: 14px;
vertical-align: middle;
padding: 4px 5px;
white-space: nowrap;
text-transform: uppercase;
}
table.dataTable {
border-collapse: collapse;
}
.desk-plan>thead>tr>th {
color:#fff;
font-weight: normal;
white-space: nowrap;
font-weight: bold;
font-size: 13px;
}
.URGENT{
background-color: #fb4c42 !important
}
.PENDING{
background-color: #f9a43b !important
}
.DONE{
background-color: #3da95c !important;
}
.desk-plan>tbody>tr>td {
font-family: monospace;
font-size: 15px;
padding:1px 0px 1px 0px!important;
}
.top {
margin-bottom: 10px;
}
.dataTables_wrapper .dataTables_paginate {
padding-top:0.25em;
padding-bottom: 0.5em;
}
.table-hover>tbody>tr:hover, .table>tbody>tr.active:hover {
background:#c9c9c9;
}
.fa-2x {
font-size: 1.3em;
}
form#user_form{
text-transform: uppercase
}
#add_license_form .form-control:focus, .form_pdfreport .form-control:focus,
.form_addUser .form-control:focus, #edit_license_form .form-control:focus {
border-color: #f1292b;
outline: 0;   
}
.dataTables_wrapper .dataTables_paginate .paginate_button{
background: #dedede;
color: #555 !important;
font-weight: bold;
}
.company_color{
color: #f1292b;
}
/*Pagination Styles*/
.dataTables_wrapper .dataTables_paginate .paginate_button {
padding:1px 8px;
margin-left:10px;
font-weight: normal;
background: transparent;
}
.dataTables_wrapper .dataTables_paginate .previous, .dataTables_wrapper .dataTables_paginate .next, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
background: #333;
color: #fff !important;
font-weight: normal;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover{
background: #eee;
}
.dataTables_wrapper .dataTables_paginate .previous:hover, .dataTables_wrapper .dataTables_paginate .next:hover {
background: #eee;
color:#333 !important;
}
/* end of pagination styles */
.search_users_info {
position: relative;
}
.exp_val_due_btns_sec {
z-index: 1;
}
.dataTables_wrapper .dataTables_paginate {
padding-bottom: 1.1em;
padding-top: 0.7em;
}
.exp_btn {
background: #F26232;
background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f16844)) !important;
}
.valid_btn {
background: rgba(90,204,122,1);
background: -webkit-linear-gradient(top, rgb(34, 136, 64) 0%, rgba(90,204,122,1) 100%) !important;
}
.fdtl_btn {
background: rgba(150,150,150,1);
background: -webkit-linear-gradient(top, rgb(150, 150, 150) 0%, rgba(158,158,158,1) 100%) !important;    
}
.due_btn {
background: rgba(250,177,68,1);
background: -webkit-linear-gradient(top, rgba(245,108,22,1) 0%, rgba(250,177,68,1)  100%) !important;
/*color: #f67f22*/ 
}
.exp_th_color>th{
background-color:#fb4c42 !important; 
}
.due_th_color>th {
background-color: #f9a43b !important;
/*background: -webkit-gradient(linear, left top, left bottom, from(#f9a43b), to(#f5781e))!important;*/
}
.valid_th_color>th {
background-color: #3da95c !important;
/*background: -webkit-linear-gradient(top, rgb(34, 136, 64) 0%, rgba(90,204,122,1) 100%) !important;*/
}
.valid_btn, .due_btn, .exp_btn, .fdtl_btn {
line-height: 0 !important;
height:24px;
width:103px;
font-weight:bold;
}
.ui-datepicker-trigger {
height: 0px;
top:0px;
right:9px;
}
.nav_add_icons {position: absolute;top: 22px;left: 43.5%;z-index: 10;}
.nav_add_icons .fa {color: #f1292b;font-size: 17px;}
.tooltip_rel {position: relative;}
.tooltip_rel .fa {cursor:pointer; font-size: 20px;}
.tooltip_cust {position: absolute;top: -25px;left: 15px;padding: 1px 11px;color: #fff;border-radius: 4px;visibility: hidden;font-size: 11px;text-transform: capitalize;font-weight: normal; box-shadow: 0 0 1px 1px #ccc; background: #333333; z-index: 999999; white-space: nowrap; text-align: center;}
.tooltip_rel:hover .tooltip_cust{visibility: visible;}
.modal-addlicense {width: 585px;background: #fff;border-radius: 6px;}
.modal-addUser, .modal-editLicense {width:800px;background: #fff;border-radius:6px;}
.modal-editLicense {width: 450px;}
.modal-editLicense .form-control {border-radius: 4px !important;}
.modal-pdfreport, .modal-deleteLicense{width: 400px;background: #fff;border-radius:6px;}
.modal-pdfreport {width: 250px;}
.modal-viewhistory {width: 820px;background: #fff;border-radius: 6px;}
.form_add_license select.form-control{background-position: 95% 11px;color:#999;font-size: 13px;}
.form_add_license .ui-datepicker-trigger {width:17px; height:20px;right: 22px;top: 26px;}
.form_add_license .datepicker {text-align: left;}
.ui-datepicker{z-index: 9999 !important;}
.dl_sure_text{text-align: center;text-transform: uppercase;font-weight: bold;font-size:14px;margin-bottom: 10px;}
.form_add_license textarea.form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
text-align: left;
}
.form_add_license textarea.form-control::-moz-placeholder { /* Firefox 19+ */
text-align: left;
}
.form_add_license textarea.form-control:-ms-input-placeholder { /* IE 10+ */
text-align: left;
}
.form_add_license textarea.form-control:-moz-placeholder { /* Firefox 18- */
text-align: left;
}
.newbtnv1{line-height: 1;}
.cust_label {text-align: center;width: 100%; font-weight: normal;font-size: 13px;margin-bottom:0;color:#000;}
.modal-editLicense .popupBody, .modal-viewhistory .popupBody, .modal-deleteLicense .popupBody {padding: 12px 20px;}
.modal-editLicense .popupHeader, .modal-viewhistory .popupHeader, .modal-deleteLicense .popupHeader {padding:7px 20px;}
.desg_arw, .desg_arw1, .desg_arw2 {
background-position: 96% 11px !important;
color:#000 !important;
text-transform: uppercase;
padding-left: 33%;
font-size: 13px !important;
}
.desg_arw1 {
background-position: 97% 11px !important;
padding-left: 10px;
}
.desg_arw2 {
padding-left: 10px;
}
.pdfreport_arw {
background-position: 96% 11px !important;
color:#000 !important;
text-transform: uppercase;
font-size:13px;
}
.tooltip_rel {
position: relative;
display: inline;
}
.tooltip_edit_position {
position: absolute;top: -28px;left: -5px;padding: 3px 11px;color: #fff;border-radius: 4px;visibility: hidden;font-size: 11px;font-weight: normal;
box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20; text-transform: uppercase;
}
.tooltip_rel:hover .tooltip_edit_position, .tooltip_rel:hover .tooltip_tri_shape1, .tooltip_rel:hover .tooltip_tri_shape2, .tooltip_rel:hover .tooltip_tri_shape3{visibility: visible;}
.tooltip_tri_shape1, .tooltip_tri_shape2, .tooltip_tri_shape3 {width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-top: 6px solid #333;position: absolute;top: -7px;right: 18px;z-index: 99999;visibility: hidden;}
.tooltip_tri_shape3  {left:2px;}
.pdfimg {height: 18px; margin-top: -4px;}
.t_dp {left: -85px;}
.t_vh {left:-40px;}
.cd-horizontal-timeline .events-content p {
text-align: justify;
}
.tooltip_exp_trishape, .tooltip_val_trishape, .tooltip_due_trishape, .tooltip_fdtl_trishape{
width: 0;
height: 0;
border-left: 7px solid transparent;
border-right: 7px solid transparent;
position: absolute;
top: 23px;
right: 58%;
z-index: 99;
}
.tooltip_exp_trishape {border-top: 8px solid #f16141;}
.tooltip_val_trishape {border-top: 8px solid #59cb79;}
.tooltip_due_trishape {border-top: 8px solid #faad41;}
.tooltip_fdtl_trishape{border-top: 8px solid #939393;}
#to_date, #renewed_date {text-align: left;}
.ui-datepicker-calendar a.ui-state-default {
background: #fff;
color: #333;
}
#add_license_form .form-control, .form_pdfreport .form-control, .form_addUser .form-control, #edit_license_form .form-control {
border-color: #555;
color: #555;
font-size: 13px;
}
.newbtnv1{color:#fff !important;}
#add_license_form input::-webkit-input-placeholder, #edit_license_form input::-webkit-input-placeholder, .form_addUser input::-webkit-input-placeholder, .form_addUser select, #edit_license_type_id {
color: #555 !important;
}
#to_date_add_ld, #renewed_date_add_ld {text-align: left; padding-left: 20px;}
.newbtn_blackv1 {color: #fff !important;}
.width-ltype {width:15%;}
.width-lfrom, .width-lto {width:9%;}
.width-lfrom input, .width-lto input {text-align: left !important; border-radius: 4px !important;}
.desk-plan {margin-bottom: 15px !important;}
.popupBody {padding: 6px 12px;}
.bt_black{
border-top-color: #333;
transition: all 0.3s ease-in-out;
}
#to_date, #renewed_date {padding-left: 14px;}
/*#example_wrapper, #filter_lr_info_wrapper {overflow-x: scroll;}*/
#filter_from_date, #filter_to_date {cursor: pointer;}
.expire_color{
color: red;font-weight: bold;font-size: 14px;
}
.due_color{
color: #f67f22;font-weight: bold;font-size: 14px;
}
.valid_color{
color: green;font-weight: bold;font-size: 14px;
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
width: 600px;
-webkit-border-radius: 4px;
border-radius: 4px;
-moz-border-radius: 4px;
background-clip: padding-box;
display: none;
}
.modal-demo .close {
position: absolute;
top: 15px;
right: 25px;
color: #eeeeee;
}
.custom-modal-title {
padding: 15px 25px 15px 25px;
line-height: 22px;
font-size: 18px;
background-color: #fe6271;
color: #ffffff;
text-align: left;
margin: 0px;
}
.custom-modal-text {
padding: 20px;
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
/*model open padding right*/
.test[style] {
padding-right:0;
}
.test.modal-open {
overflow: auto;
}
/*model open padding right*/ 
.table>thead>tr>th, .table>tbody>tr>td{
border: 1px solid #000;
border-top:1px solid #000!important;  
}
/*model open padding right*/
.test[style] {
padding-right:0;
}
.test.modal-open {
overflow: auto;
}
/*model open padding right*/
.newbtn_blackv1{
border-radius: 4px;
outline: none;    
}
.modal-body{
padding: 15px 15px 10px 15px!important;    
}
/*loader*/
#loading-img {
background: url(https://www.eflight.aero/media/images/loader.gif) center center no-repeat;
z-index: 20;
position: fixed;
width: 100px;
left: 50%;
top:50%;
margin-left: -50px;
margin-top: -50px;
padding:40px;
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
.popover {
background-color: #333;
border:none!important;
font-family: 'pt_sansregular';
color: white;
}
.popover.top>.arrow:after{
border-top-color:#333;
}
.popover-content{
padding:2px;
}
.centerandbold{
text-align:center;
font-weight:bold;
}
.dataTables_wrapper {
position: relative;
clear: both;
zoom: 1;
float: right;
margin-top:-35px;
}
#emailtracker_info_wrapper{
margin-top:0px!important;
}
.ui-datepicker-close{
margin-left: 76% !important;
margin-bottom: 1%;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
color: #000;
margin-left: 1%;    
}
.notify-bg-v{
background: rgba(0,0,0,.4)!important;
position: absolute;
width: 100%;
display:block;
height:100%;
z-index:9000;
display: none;
}
.alertmessage_validation{
text-align:center;
}
.pace_name{
background: #eee;
cursor: not-allowed !important;
}
.bold{
font-weight: bold;
}
.deleted_record{
color: red !important;
font-weight: bold !important;
} 
#frm,#to,#email_date,#email_complete_by,#edit_email_date,#edit_email_complete_by {
background-color: #fff;
}
/*tootltip*/
.tooltip_cancel{position: relative;}
.tooltip_dept_position{
position: absolute;top:-25px;left:0%;padding: 3px 11px;color: #eee;border-radius: 4px;visibility: hidden;font-size: 10px;font-weight: normal;
box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20;font-family: sans-serif;}
.tooltip_cancel:hover .tooltip_cancel_position, .tooltip_revise_valid:hover .tooltip_tri_shape_valid, .tooltip_revise_valid:hover .tooltip_revise_dbl_position_valid, .tooltip_cancel:hover .tooltip_fpl_position1, .tooltip_cancel:hover .tooltip_fpl_position2 ,.tooltip_cancel:hover .tooltip_fpl_position, .tooltip_cancel:hover .tooltip_info_position,.tooltip_cancel:hover .tooltip_revise_position,.tooltip_cancel:hover .tooltip_change_position, .tooltip_revise_dbl:hover .tooltip_revise_dbl_position, .tooltip_cancel:hover .tooltip_dept_position, .tooltip_cancel:hover .tooltip_dest_position, .tooltip_cancel:hover .tooltip_pdf_position, .tooltip_cancel:hover .tooltip_notam_position, .tooltip_cancel:hover .tooltip_wx_position, .tooltip_revise_dbl:hover .tooltip_tri_shape, .stats_fixed_wing:hover .tooltip_fixed_wing, .stats_heli:hover .tooltip_heli,.stats_month:hover .tooltip_month, .stats_year:hover .tooltip_year,.stats_wx:hover .tooltip_wx, .stats_tripkit:hover .tooltip_tripkit {
visibility: visible;
}
.tooltip_tri_shape4{
width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-top: 6px solid #333;position: absolute;top: -5px;left:4%;z-index: 99999;visibility: hidden;}
.tooltip_cancel:hover .tooltip_tri_shape1, .tooltip_cancel:hover .tooltip_tri_shape2,.tooltip_cancel:hover .tooltip_tri_shape3, .tooltip_cancel:hover .tooltip_tri_shape4, .tooltip_cancel:hover .tooltip_tri_shape5, .tooltip_cancel:hover .tooltip_tri_shape6, .tooltip_cancel:hover .tooltip_tri_shape7, .tooltip_cancel:hover .tooltip_tri_shape8, .tooltip_cancel:hover .tooltip_tri_shape9, .tooltip_cancel:hover .tooltip_tri_shape10, .tooltip_cancel:hover .tooltip_tri_shape11, .tooltip_cancel:hover .tooltip_tri_shape12, .stats_fixed_wing:hover .tooltip_trishape_01, .stats_heli:hover .tooltip_trishape_02,.stats_month:hover .tooltip_trishape_03, .stats_year:hover .tooltip_trishape_04,.stats_wx:hover .tooltip_trishape_05, .stats_tripkit:hover .tooltip_trishape_06  {
visibility: visible;
}
/*tootltip*/
.desk-plan>thead {
background:#fb4c42;
}
.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover{
background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f16844)) !important;
color:#fff;  
}
.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f16844)) !important;
color:#fff;
}
.dropdown-menu{
min-width: 145px;
z-index: 10000;    
}
.btn .caret {
margin-left: 3px;
}
.input_styles{
text-align:center;
border:none;
width:100%;
line-height:1.8;
}
.input_styles:focus{
outline: none;
}
.history_table>thead>tr>th{
border: 1px solid #c9c8c8;
}
.history_table>tbody>tr>td{
border: 1px solid #c9c8c8;
}
</style>
@include('includes.new_header',[])
<!--loader-->
<div class="overlay">
    <div id="loading-img"></div>
</div> 
<!--loader-->
<section>
    <div class="container cust-container">
        <div class="row pilots_main"> 
            <div class="col-md-12 LR_style">
                <p class="new_fpl_heading">STATS</p>
            </div>
            <div class="col-md-12" style="margin-top:15px;">

                <div class="col-md-1 tooltip_rel" style="width:2%;margin-top:2px;margin-right:20px;padding-left:10px;">
                    <a data-target="#modeltestadd" data-toggle="modal" style="cursor:pointer;color:#f1292b;">
                        <i class="fa fa-plus add_license"></i>
                        <span class="tooltip_edit_position t_vh" style="left:0;">ADD</span>
                        <span class="tooltip_tri_shape2" style="top: -4px;right: 2px;"></span>
                    </a>
                </div>

                <div class="search_users_info exp_val_due_btns_sec">
                    <div class="form_pilots_top2">                                   
                        <div class="col-md-4 width-search">
                            <button type="submit" data-value="exp1" class="filter_users newbtnv1 btn exp_btn" name="filter" value="URGENT">NAV LOG</button>
                            <span class="filter_shape exp1 tooltip_exp_trishape"></span> 
                        </div>
                        <div class="col-md-4 width-search">
                            <button type="submit" data-value="due1" class="filter_users newbtnv1 btn due_btn" name="filter" value="PENDING">FPL</button>
                            <span style="visibility:hidden;" class="filter_shape  due1 tooltip_due_trishape "></span>
                        </div>
                        <div class="col-md-4 width-search">
                            <button type="submit" data-value="valid1" class="filter_users newbtnv1 btn valid_btn" name="filter" value="DONE">HELICOPTER</button>
                            <span style="visibility:hidden;" class="filter_shape  tooltip_val_trishape valid1"></span>
                        </div>
                        <div class="col-md-4 width-search">
                            <button type="submit" data-value="valid1" class="filter_users newbtnv1 btn fdtl_btn" name="filter" value="DONE">FDTL</button>
                            <span style="visibility:hidden;" class="filter_shape  tooltip_fdtl_trishape valid1"></span>
                        </div>
                    </div>
               </div><!--search_users_info close here-->
                <!--<table id="email_tracker_info" class="table table-hover table-responsive desk-plan" style="width:100%;margin-top:40px;">
                    <thead>
                        <tr>
                            <th style="font-size: 14px;width:4%;">SL</th>
                            <th style="font-size: 14px;width:14%;">CALLSIGN</th>
                            <th style="font-size: 14px;width:60%;">OPERATOR</th>
                            <th style="font-size: 14px;width:12%;">TYPE</th>
                            <th style="font-size: 14px;width:10%;">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                     <tr>
                        <td>1</td> 
                        <td>VTSSF</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td> 
                        <td>VTOBR</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>                                   
                </table>-->
            <!--FDTL OPENS HERE-->
            <table id="email_tracker_info" class="table table-hover table-responsive desk-plan" style="width:100%;margin-top:40px;">
                <thead>
                    <tr>
                        <th style="font-size: 14px;width:4%;">SL</th>
                        <th style="font-size: 14px;width:20%;">CREW NAME</th>
                        <th style="font-size: 14px;width:18%;">ROLE</th>
                        <th style="font-size: 14px;width:11%;">CALLSIGN</th>
                        <th style="font-size: 14px;width:24%;">OPERATOR</th>
                        <th style="font-size: 14px;width:12%;">TYPE</th>
                        <th style="font-size: 14px;width:11%;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                   <tr>
                    <td>1</td>
                    <td><input type="text" value="SAICHARAN" class="input_styles"></td>
                    <td>FIXED WING CO PILOT</td>
                    <!--role when we click on inline edit
                    <td>
                        <div class="dropdown dropdown-select">
                            <button class="btn btn-default dropdown-toggle bold" style="color:#000;background:#fff;width:100%;" type="button" id="edit_status" data-toggle="dropdown" aria-expanded="true">
                                    ROLE
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu bold" role="menu" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FIXED WING PILOT</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FIXED WING CO PILOT</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HELICOPTER PILOT</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HELICOPTER CO PILOT</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">CABIN CREW</a></li>
                            </ul>
                        </div>
                    </td>---->
                    <td><input type="text" value="VTSSF" class="input_styles"></td>
                    <td>SIMM SAMM</td>
                    <td>NAVLOG</td>
                    <!--type when we click on inline edit
                    <td>
                        <div class="dropdown dropdown-select col-md-6">
                            <button class="btn btn-default dropdown-toggle bold" style="color:#000;background:#fff;width:100%;" type="button" id="edit_status" data-toggle="dropdown" aria-expanded="true">
                                    TYPE
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu bold" role="menu" style="min-width:88%;margin-left: 15px;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">NAVLOG</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FPL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HELICOPTER</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FDTL</a></li>
                            </ul>
                        </div>
                    </td>---->
                    <td>
                    <div class="tooltip_rel">
                        <a data-target="" data-toggle="modal" class="delete_email_tracker">
                        <i class="fa fa-pencil-square"></i></a>
                        <span class="tooltip_edit_position">Edit</span>
                        <span class="tooltip_tri_shape3"></span>
                    </div>
                    <div class="tooltip_rel">
                        <a data-target="#modeltesthistory" data-toggle="modal" class="delete_email_tracker">
                        <i class="fa fa-history"></i></a>
                        <span class="tooltip_edit_position">History</span>
                        <span class="tooltip_tri_shape3"></span>
                    </div>
                    <div class="tooltip_rel">
                        <a data-target="#modeltestdelete" data-toggle="modal" class="delete_email_tracker">
                        <i class="fa fa-trash"></i></a>
                        <span class="tooltip_edit_position">Delete</span>
                        <span class="tooltip_tri_shape3"></span>
                    </div>
                    </td>
                   </tr>
                </tbody>                                   
            </table>
            <!--FDTL ENDS HERE-->
        </div>
      </div>
    </div>
</section>
<!-- delete modal-->
<div class="modal fade" id="modeltestdelete"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" style="width:32%;" role="document">
        <header class="popupHeader">
            <span class="header_title" id="billing_header">DELETE</span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>   
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;padding:15px;">
                <div class="row">
                    <div class="col-md-12">
                       <p class="dl_sure_text" style="margin-bottom:0;">Are you sure to delete (<span>XYZ</span>)?</p>
                    </div>
                </div>
            </div>
            <div class="row" style="text-align:center;margin-top:10px">
                <div class="col-md-12">
                    <button type="button" class="btn_secondary newbtn_blackv1 modal_btn_navlog"  style="width:17%;line-height:27px;margin-top: 5px;" id="del_btn" data-email_id="">DELETE</button>
                </div>
            </div>      
        </section>
    </div>
</div>
<!-- delete modal-->
<!-- Add modal-->
<div class="modal fade" id="modeltestadd"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" style="width:40%;" role="document">
        <header class="popupHeader">
            <span class="header_title" id="billing_header">ADD</span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>   
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;padding:15px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" style="text-align:center;" class="form-control text_uppercase alphabets font-bold stations ui-autocomplete-input" placeholder="CREW NAME" maxlength="" autocomplete="off">
                        </div>      
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" style="text-align:center;" class="form-control text_uppercase alphabets font-bold stations ui-autocomplete-input" placeholder="CALL SIGN" maxlength="" autocomplete="off">
                        </div>      
                    </div>
                    <div class="dropdown dropdown-select col-md-6">
                        <button class="btn btn-default dropdown-toggle bold" style="color:#000;background:#fff;width:100%;" type="button" id="edit_status" data-toggle="dropdown" aria-expanded="true">
                                ROLE
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu bold" role="menu" style="min-width:88%;margin-left: 15px;" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FIXED WING PILOT</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FIXED WING CO PILOT</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HELICOPTER PILOT</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HELICOPTER CO PILOT</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">CABIN CREW</a></li>
                        </ul>
                    </div>
                    <div class="dropdown dropdown-select col-md-6">
                        <button class="btn btn-default dropdown-toggle bold" style="color:#000;background:#fff;width:100%;" type="button" id="edit_status" data-toggle="dropdown" aria-expanded="true">
                                TYPE
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu bold" role="menu" style="min-width:88%;margin-left: 15px;" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">NAVLOG</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FPL</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HELICOPTER</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FDTL</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12" style="margin-top:15px;">
                        <div class="form-group" style="margin-bottom:5px;">
                            <input type="text" style="text-align:center;" class="form-control text_uppercase alphabets font-bold stations ui-autocomplete-input" placeholder="OPERATOR" maxlength="" autocomplete="off">
                        </div>      
                    </div>
                </div>
            </div>
            <div class="row" style="text-align:center;margin-top:0;">
                <div class="col-md-12">
                    <button type="button" class="btn_secondary newbtn_blackv1 modal_btn_navlog"  style="width:17%;line-height:27px;" id="del_btn" data-email_id="">ADD</button>
                </div>
            </div>      
        </section>
    </div>
</div>
<!-- Add modal-->
<!-- History modal-->
<div class="modal fade" id="modeltesthistory"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" style="width:80%;" role="document">
        <header class="popupHeader">
            <span class="header_title" id="billing_header">HISTORY</span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>   
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;padding:15px;">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table-responsive desk-plan no-footer history_table dataTable">
                            <thead style="background: #333;">
                                <tr role="row">
                                    <th>Sl</th>
                                    <th>ACTIONS</th>
                                    <th>CREW NAME</th>
                                    <th>ROLE</th>
                                    <th>CALLSIGN</th>
                                    <th>TYPE</th>
                                    <th>DATE AND TIME</th>
                                    <th>BY</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr role="row">
                                    <td>1</td>
                                    <td>EDIT</td>
                                    <td>SAICHARAN</td>
                                    <td>FIXED WING PILOT</td>
                                    <td>VTSSF</td>
                                    <td>NAVLOG</td>
                                    <td>06-JUNE-2018 08:54:25</td>
                                    <td>SAICHARAN</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- History modal-->
<div id='v_toTop'><span></span></div>
@include('includes.new_footer',[])
<script>
    $('.dropdown-select').on( 'click', '.dropdown-menu li a', function() { 
    var target = $(this).html();
    $(this).parents('.dropdown-menu').find('li').removeClass('active');
    $(this).parent('li').addClass('active');
    $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + '<span class="caret"></span>');
});
$('#email_tracker_info').DataTable({
    "pageLength":15,
    "lengthChange": false,
    "aaSorting": [],
    "searching": false,
    "bInfo" : false,
    "processing": true,
    "dom": '<"top"flp<"clear">>',
    "aoColumns":[
        {"bSortable": false},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": true},
        {"bSortable": false},     
    ]
});
</script>
</div>
@stop