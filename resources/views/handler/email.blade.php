@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<div class="page" id="quick_app">
<style>
@media screen and (min-width:767px) and (max-width:1300px) {
.ltype {
width:205px!important;
}
.lnum {
width:180px!important;
}
.vdays {
width:200px!important;
}
.rdate {
width:214px!important;
}
.uname{
width:110px!important;
}
.desk-plan>thead>tr>th, .desk-plan>tbody>tr>td{
padding: 4px 2px!important;
}
}
@media screen and (min-width:1301px) and (max-width:1600px) {
.ltype {
width:205px!important;
}
.lnum {
width:180px!important;
}
.vdays {
width:205px!important;
}
.rdate {
width:214px!important;
}
.uname{
width:110px!important;
}
.desk-plan>thead>tr>th, .desk-plan>tbody>tr>td{
padding: 4px 2px!important;
}
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
.table-hover>tbody>tr:hover .edit_license {
visibility:visible;
}
.table-hover>tbody>tr:hover .delete_license {
visibility:visible;
}
.table-hover>tbody>tr:hover .viewhistory {
visibility:visible;
}
.edit_license, .viewhistory, .delete_license{
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
background:-webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
color:#fff;
font-weight: normal;
white-space: nowrap;
font-weight: bold;
font-size: 13px;
}
.desk-plan>tbody>tr>td {
font-family: monospace;
font-size: 14px;
padding: 4px 0px 4px 0px!important;
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
/*    Pagination Styles*/
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
.valid_btn, .due_btn, .exp_btn {
line-height: 0 !important;
height:24px;
width:103px;
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
.dl_sure_text{text-align: center;text-transform: uppercase;font-weight: bold;font-size: 13px;margin-bottom: 10px;}
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
.tooltip_exp_trishape, .tooltip_val_trishape, .tooltip_due_trishape {
width: 0;
height: 0;
border-left: 7px solid transparent;
border-right: 7px solid transparent;
position: absolute;
top: 23px;
right: 52%;
z-index: 99999;
}
.tooltip_exp_trishape {border-top: 8px solid #f16141;}
.tooltip_val_trishape {border-top: 8px solid #59cb79;}
.tooltip_due_trishape {border-top: 8px solid #faad41;}

#to_date, #renewed_date {text-align: left;}
.ui-datepicker-calendar a.ui-state-default {
background: #fff;
color: #333;
}
.ui-datepicker-calendar td.ui-datepicker-today a {
border-color: #f00;
background-color: #f00; 
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
@media only screen and (min-width : 320px) and (max-width : 767px) {
/*        .xm-w-99{width: 100%;}*/
.xs-m-b-15{margin-bottom: 15px;}
.width-ltype {width: 100%;}
.search_users_info {clear:both;}
.width-lfrom, .width-lto {width: 50%;}
.pilots_search {width:100%;}
.width-lfrom {padding-right: 5px;}
.width-lto {padding-left: 5px;}
.xs-p-r-5 {padding-right: 5px;}
.form_pilots_top {margin-bottom: 55px;}
.width-search{display:inline;}
.exp_val_due_btns_sec {top:-45px;}
.valid_btn, .due_btn, .exp_btn {width: 79px;font-size: 11px;}
.width-search {padding-right: 5px;}
.nav_add_icons {top:-93px;}
.modal-addlicense,.modal-pdfreport, .modal-addUser, .modal-editLicense,  .modal-viewhistory, .modal-deleteLicense {width:275px; margin: 70px auto; }
#license_file_add_ld {margin-bottom: 10px;}
#to_date_add_ld, #renewed_date_add_ld, #to_date, #renewed_date {padding-left: 9px;}
.width-lfrom .lrdate, .width-lto .lrdate {padding-left: 10px;}
.tooltip_exp_trishape, .tooltip_val_trishape, .tooltip_due_trishape {right:50%;}
}
@media only screen and (min-width : 768px) and (max-width : 992px) {
.sm-m-b-15 {margin-bottom:15px}
.width-ltype {width:50%;}
.width-lfrom, .width-lto {width: 25%;}
.pilots_search{width:170px;}
.exp_val_due_btns_sec{top:2px;width:50%;}
.search_users_info {clear:both;}
.width-search{display:inline;}
.valid_btn, .due_btn, .exp_btn {width:92px;font-size: 13px;}
.tooltip_val_trishape, .tooltip_due_trishape{right:43%;}
.tooltip_exp_trishape{right:46%;}
.nav_add_icons{top:-39px;left:75.5%;}
.modal-addlicense {width:300px;}
#license_file_add_ld {margin-bottom:10px;}
.modal-addUser{width:450px;}
.modal-editLicense{width:350px}
.modal-deleteLicense{width:315px;}
.modal-viewhistory{width:550px;}
.desg_arw2{background-position: 99% 11px !important;}
.width-lfrom .lrdate, .width-lto .lrdate {padding-left: 25px;}
#to_date_add_ld, #renewed_date_add_ld {padding-left: 12px;}
}
@media (min-width: 768px) {
.modal-dialog {
margin: 212px auto;
}
}
@media only screen and (min-width:992px) {
.md-p-r-0 {padding-right:0;}
.md-p-l-0 {padding-left: 0;} 
}
@media only screen and (min-width:1200px) {
.get_filter_result, .search_users_info {display: inline-block;width:100%;}
#example_wrapper::-webkit-scrollbar, #filter_lr_info_wrapper::-webkit-scrollbar {display: none;}
}
.expire_color{
color: red;font-weight: bold;font-size: 14px;
}
.due_color{
color: #f67f22;font-weight: bold;font-size: 14px;
}
.valid_color{
color: green;font-weight: bold;font-size: 14px;
}
/*    .ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content{
width: 333px !important
}*/

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
}
.btn .caret {
margin-left: 5px;
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
</style>
@include('includes.new_header',[])
<section>
    <div class="container cust-container">
        <div class="row pilots_main"> 
            <div class="col-md-12 LR_style">
                <p class="new_fpl_heading">EMAIL TRACKER SUPPORT</p>
            </div>
            <div class="form_pilots_top">
                <div class="col-md-1 tooltip_rel" style="width:2%;margin-top: 8px;">
                    <a data-target="#modeltest" data-toggle="modal" style="cursor:pointer;color:#f1292b;">
                       <i class="fa fa-plus add_license"></i>
                    </a>
                </div>
                <div class="col-md-5 col-sm-6 md-p-r-0 sm-m-b-15 xs-m-b-15 name-margin" style="padding-right:0px;margin-right:0px;">
                    <input type="text" name="" v-model="filter_user_name" class="form-control text_uppercase" maxlength="3" placeholder="OPERATOR">
                </div>
                <div class="col-md-4 col-sm-6  sm-m-b-15 xs-m-b-15" style="padding-left:2px;padding-right:2px;width:31%;">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" style="border-top-right-radius: 4px;border-bottom-right-radius:4px;" class="form-control get_operators text_uppercase" name="" placeholder="CALL SIGN">
                            <div class="input-group-addon" style="padding:0px 0px 0px 2px;border:none;">
                                <button style="width:60px;border-radius:4px;" type="button" name="" value="search" class="btn newbtnv1 input-group-addon">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2  col-sm-3 col-xs-6 md-p-l-0 width-lfrom xs-m-b-15" style="padding-right:2px;">
                    <div class="input-group">
                        <input type="text" name="" class="form-control text_lowercase filter_from_date" placeholder="From-Date">
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6 md-p-l-0 width-lto xs-m-b-15" style="padding-right:2px;">
                    <div class="input-group">
                        <input type="text" name="" maxlength="10" class="form-control numeric filter_to_date" placeholder="To-Date">
                    </div>
                </div>
                <button style="width: 40px;" type="button" class="btn newbtnv1 lr_search" style="line-height:1"><span class="glyphicon glyphicon-search"></span></button>
            </div>
            <div class="search_users_info exp_val_due_btns_sec" style="margin-bottom:15px;">
                <div class="form_pilots_top2">                                   
                    <div class="col-md-4 width-search">
                        <button type="button" data-value="exp1" class="filter_users newbtnv1 btn exp_btn">URGENT <span>(50)</span></button>
                        <span class="filter_shape exp1 tooltip_exp_trishape"></span>
                    </div>
                    <div class="col-md-4 width-search">
                        <button type="button" data-value="due1" class="filter_users newbtnv1 btn due_btn">PENDING <span>(10)</span></button>
                        <span class="filter_shape due1"></span>
                    </div>
                    <div class="col-md-4 width-search">
                        <button type="button" data-value="valid1" class="filter_users newbtnv1 btn valid_btn">DONE <span>(20)</span></button>
                        <span class="filter_shape valid1"></span>
                    </div>
                </div>
            </div><!--search_users_info close here-->
            <div class="col-md-12" >
                <table id="example" class="table table-hover table-responsive desk-plan">
                    <thead>
                        <tr class="">
                            <th class="" style="font-size: 14px;width:4%;">SL</th>
                            <th class="" style="font-size: 14px;width:9%;">CALLSIGN</th>
                            <th class="" style="font-size: 14px;width:29%;">EMAIL SUBJECT</th>
                            <th class="" style="font-size: 14px;width:11%;">EMAIL DATE</th>
                            <th class="" style="font-size: 14px;width:26%;">OPERATOR</th>
                            <th class="" style="font-size: 14px;width:11%;">TYPE</th>
                            <th class="" style="font-size: 14px;width:10%;">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr class="">
                            <td class="" >1</td>
                            <td class="" >VTSSF</td>
                            <td class="" >SL</td>
                            <td class="" >15-JAN-2017</td>
                            <td class="" >WENTURA</td>
                            <td>TYPE</td>
                            <td class="" >
                                <div class="tooltip_rel">
                                    <a data-target="#modeltestedit" data-toggle="modal" class="edit_license">
                                    <i class="fa fa-pencil-square"></i></a><span class="p-l-9"></span>
                                    <span class="tooltip_edit_position">Edit</span>
                                    <span class="tooltip_tri_shape1"></span>
                                </div>    
                                <div class="tooltip_rel"><a class="viewhistory">
                                    <i class="fa fa-history"></i></a><span class="p-l-9"></span>
                                    <span class="tooltip_edit_position t_vh">History</span>
                                    <span class="tooltip_tri_shape2"></span>
                                </div>
                                <div class="tooltip_rel">
                                    <a data-target="#modeltestdelete" data-toggle="modal" class="delete_license">
                                    <i class="fa fa-trash"></i></a>
                                    <span class="tooltip_edit_position">Delete</span>
                                    <span class="tooltip_tri_shape3"></span>
                                </div>                    
                            </td> 
                        </tr>
                    </tbody>                                   
                </table>
            </div>
        </div>
    </div>
</section>    	
<!-- add email modal-->
<div class="modal fade" id="modeltest"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" style="width:50%;" role="document">
        <header class="popupHeader">
            <span class="header_title" id="billing_header">ADD EMAIL TRACKER</span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>   
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;padding:15px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="dropdown dropdown-select">
                            <button class="btn btn-default dropdown-toggle" style="color:#000;background:none;width:100%;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    TYPE
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">FPL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">NAV LOG</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">FDTL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">LICENSE</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">FUEL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HANDLING</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HOTEL</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <input type="text" name="" v-model="filter_user_name" class="form-control text_uppercase" maxlength="3" placeholder="OPERATOR">
                    </div>
                    <div class="col-md-12" style="margin-top:15px;margin-bottom:15px;">
                         <input type="text" name="" v-model="filter_user_name" class="form-control text_uppercase" maxlength="3" placeholder="EMAIL SUBJECT">
                    </div>
                    <div class="col-md-12">
                     <span style="float:left;margin-left: 8%;margin-right:18%;font-size: 12px;">EMAIL DATE</span>
                     <span style="float:left;font-size: 12px;">COMPLETE BY</span>
                    </div>
                    <div class="col-md-4" style="margin-top:5px;width: 30%;padding-right: 0;">
                    @php $current_year=date('Y'); $current_mnth =date('M'); $current_day =date('d');@endphp            
                    <span class="">
                        <select class="day" name="day" id="day" style="width: auto;">
                            @for($i=01;$i<=31;$i++)
                            <option value="@if($i < 10)0{{$i}}@else{{$i}}@endif" @if($current_day==$i) selected @endif>@if($i < 10)0{{$i}}@else{{$i}}@endif</option>
                            @endfor
                        </select>&nbsp;
                        <select class="month" name="month" id="month" style="width: auto;">
                            <option value="Jan" @if($current_mnth=="Jan") selected @endif>Jan</option>
                            <option value="Feb" @if($current_mnth=="Feb") selected @endif>Feb</option>
                            <option value="Mar" @if($current_mnth=="Mar") selected @endif>Mar</option>
                            <option value="Apr" @if($current_mnth=="Apr") selected @endif>Apr</option>
                            <option value="May" @if($current_mnth=="May") selected @endif>May</option>
                            <option value="Jun" @if($current_mnth=="Jun") selected @endif>Jun</option>
                            <option value="Jul" @if($current_mnth=="Jul") selected @endif>Jul</option>
                            <option value="Aug" @if($current_mnth=="Aug") selected @endif>Aug</option>
                            <option value="Sep" @if($current_mnth=="Sep") selected @endif>Sep</option>
                            <option value="Oct" @if($current_mnth=="Oct") selected @endif>Oct</option>
                            <option value="Nov" @if($current_mnth=="Nov") selected @endif>Nov</option>
                            <option value="Dec" @if($current_mnth=="Dec") selected @endif>Dec</option>
                        </select>&nbsp;
                        <select class="year" name="year" id="year" style="width: auto;">
                            @for($year=$current_year-3;$year<=2075;$year++)
                            <option value="{{$year}}" @if($year==$current_year) selected @endif>{{$year}}</option>
                            @endfor
                        </select>
                    </span>
                    </div>

                    <div class="col-md-4" style="margin-top:5px;padding-left:0px;padding-right:0;width:30%;">
                    @php $current_year=date('Y'); $current_mnth =date('M'); $current_day =date('d');@endphp            
                    <span class="">
                        <select class="day" name="day" id="day" style="width: auto;">
                            @for($i=01;$i<=31;$i++)
                            <option value="@if($i < 10)0{{$i}}@else{{$i}}@endif" @if($current_day==$i) selected @endif>@if($i < 10)0{{$i}}@else{{$i}}@endif</option>
                            @endfor
                        </select>&nbsp;
                        <select class="month" name="month" id="month" style="width: auto;">
                            <option value="Jan" @if($current_mnth=="Jan") selected @endif>Jan</option>
                            <option value="Feb" @if($current_mnth=="Feb") selected @endif>Feb</option>
                            <option value="Mar" @if($current_mnth=="Mar") selected @endif>Mar</option>
                            <option value="Apr" @if($current_mnth=="Apr") selected @endif>Apr</option>
                            <option value="May" @if($current_mnth=="May") selected @endif>May</option>
                            <option value="Jun" @if($current_mnth=="Jun") selected @endif>Jun</option>
                            <option value="Jul" @if($current_mnth=="Jul") selected @endif>Jul</option>
                            <option value="Aug" @if($current_mnth=="Aug") selected @endif>Aug</option>
                            <option value="Sep" @if($current_mnth=="Sep") selected @endif>Sep</option>
                            <option value="Oct" @if($current_mnth=="Oct") selected @endif>Oct</option>
                            <option value="Nov" @if($current_mnth=="Nov") selected @endif>Nov</option>
                            <option value="Dec" @if($current_mnth=="Dec") selected @endif>Dec</option>
                        </select>&nbsp;
                        <select class="year" name="year" id="year" style="width: auto;">
                            @for($year=$current_year-3;$year<=2075;$year++)
                            <option value="{{$year}}" @if($year==$current_year) selected @endif>{{$year}}</option>
                            @endfor
                        </select>
                    </span>
                    </div>
                    
                     <div class="col-md-4" style="width:18%;margin-top:0px;padding-right:0;padding-left:0;">
                         <input type="text" name="" v-model="filter_user_name" class="form-control text_uppercase" maxlength="3" placeholder="COMPLETE TIME">
                    </div>

                    <div class="col-md-4" style="margin-top:0px;width:22%;">
                        <div class="dropdown dropdown-select">
                            <button class="btn btn-default dropdown-toggle" style="color:#000;background:none;width:100%;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    STATUS
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">URGENT</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">PENDING</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">DONE</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-12" style="padding-left: 5px;margin-top: 10px;padding-right: 0;">
                    <label class="cust_label" style="text-align: left;">Remarks</label>
                    <div class="form-group">
                        <textarea id="" maxlength="200" name="" class="form-control text_uppercase" style="resize:vertical"></textarea>
                    </div>
                </div>
                <div class="row" style="text-align:center;margin-top:20px">
                    <div class="col-md-12">
                        <button type="button" class="btn_secondary newbtn_blackv1 modal_btn_navlog"  style="width:25%;line-height:27px;" id="edit_yes" data-url="{{url('navlog_cancel')}}" data-value="">ADD</button>
                    </div>
                </div>      
            </div>
        </section>
    </div>
</div>
<!-- add email modal-->  
<!-- edit email modal-->
<div class="modal fade" id="modeltestedit"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" style="width:50%;" role="document">
        <header class="popupHeader">
            <span class="header_title" id="billing_header">EDIT EMAIL TRACKER</span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>   
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;padding:15px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="dropdown dropdown-select">
                            <button class="btn btn-default dropdown-toggle" style="color:#000;background:none;width:100%;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    TYPE
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">FPL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">NAV LOG</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">FDTL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">LICENSE</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">FUEL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HANDLING</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">HOTEL</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <input type="text" name="" v-model="filter_user_name" class="form-control text_uppercase" maxlength="3" placeholder="OPERATOR">
                    </div>
                    <div class="col-md-12" style="margin-top:15px;margin-bottom:15px;">
                         <input type="text" name="" v-model="filter_user_name" class="form-control text_uppercase" maxlength="3" placeholder="EMAIL SUBJECT">
                    </div>
                    <div class="col-md-12">
                     <span style="float:left;margin-left: 8%;margin-right:18%;font-size: 12px;">EMAIL DATE</span>
                     <span style="float:left;font-size: 12px;">COMPLETE BY</span>
                    </div>
                    <div class="col-md-4" style="margin-top:5px;width: 30%;padding-right: 0;">
                    @php $current_year=date('Y'); $current_mnth =date('M'); $current_day =date('d');@endphp            
                    <span class="">
                        <select class="day" name="day" id="day" style="width: auto;">
                            @for($i=01;$i<=31;$i++)
                            <option value="@if($i < 10)0{{$i}}@else{{$i}}@endif" @if($current_day==$i) selected @endif>@if($i < 10)0{{$i}}@else{{$i}}@endif</option>
                            @endfor
                        </select>&nbsp;
                        <select class="month" name="month" id="month" style="width: auto;">
                            <option value="Jan" @if($current_mnth=="Jan") selected @endif>Jan</option>
                            <option value="Feb" @if($current_mnth=="Feb") selected @endif>Feb</option>
                            <option value="Mar" @if($current_mnth=="Mar") selected @endif>Mar</option>
                            <option value="Apr" @if($current_mnth=="Apr") selected @endif>Apr</option>
                            <option value="May" @if($current_mnth=="May") selected @endif>May</option>
                            <option value="Jun" @if($current_mnth=="Jun") selected @endif>Jun</option>
                            <option value="Jul" @if($current_mnth=="Jul") selected @endif>Jul</option>
                            <option value="Aug" @if($current_mnth=="Aug") selected @endif>Aug</option>
                            <option value="Sep" @if($current_mnth=="Sep") selected @endif>Sep</option>
                            <option value="Oct" @if($current_mnth=="Oct") selected @endif>Oct</option>
                            <option value="Nov" @if($current_mnth=="Nov") selected @endif>Nov</option>
                            <option value="Dec" @if($current_mnth=="Dec") selected @endif>Dec</option>
                        </select>&nbsp;
                        <select class="year" name="year" id="year" style="width: auto;">
                            @for($year=$current_year-3;$year<=2075;$year++)
                            <option value="{{$year}}" @if($year==$current_year) selected @endif>{{$year}}</option>
                            @endfor
                        </select>
                    </span>
                    </div>

                    <div class="col-md-4" style="margin-top:5px;padding-left:0px;padding-right:0;width:30%;">
                    @php $current_year=date('Y'); $current_mnth =date('M'); $current_day =date('d');@endphp            
                    <span class="">
                        <select class="day" name="day" id="day" style="width: auto;">
                            @for($i=01;$i<=31;$i++)
                            <option value="@if($i < 10)0{{$i}}@else{{$i}}@endif" @if($current_day==$i) selected @endif>@if($i < 10)0{{$i}}@else{{$i}}@endif</option>
                            @endfor
                        </select>&nbsp;
                        <select class="month" name="month" id="month" style="width: auto;">
                            <option value="Jan" @if($current_mnth=="Jan") selected @endif>Jan</option>
                            <option value="Feb" @if($current_mnth=="Feb") selected @endif>Feb</option>
                            <option value="Mar" @if($current_mnth=="Mar") selected @endif>Mar</option>
                            <option value="Apr" @if($current_mnth=="Apr") selected @endif>Apr</option>
                            <option value="May" @if($current_mnth=="May") selected @endif>May</option>
                            <option value="Jun" @if($current_mnth=="Jun") selected @endif>Jun</option>
                            <option value="Jul" @if($current_mnth=="Jul") selected @endif>Jul</option>
                            <option value="Aug" @if($current_mnth=="Aug") selected @endif>Aug</option>
                            <option value="Sep" @if($current_mnth=="Sep") selected @endif>Sep</option>
                            <option value="Oct" @if($current_mnth=="Oct") selected @endif>Oct</option>
                            <option value="Nov" @if($current_mnth=="Nov") selected @endif>Nov</option>
                            <option value="Dec" @if($current_mnth=="Dec") selected @endif>Dec</option>
                        </select>&nbsp;
                        <select class="year" name="year" id="year" style="width: auto;">
                            @for($year=$current_year-3;$year<=2075;$year++)
                            <option value="{{$year}}" @if($year==$current_year) selected @endif>{{$year}}</option>
                            @endfor
                        </select>
                    </span>
                    </div>
                    
                     <div class="col-md-4" style="width:18%;margin-top:0px;padding-right:0;padding-left:0;">
                         <input type="text" name="" v-model="filter_user_name" class="form-control text_uppercase" maxlength="3" placeholder="COMPLETE TIME">
                    </div>

                    <div class="col-md-4" style="margin-top:0px;width:22%;">
                        <div class="dropdown dropdown-select">
                            <button class="btn btn-default dropdown-toggle" style="color:#000;background:none;width:100%;" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    STATUS
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">URGENT</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">PENDING</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">DONE</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-12" style="padding-left: 5px;margin-top: 10px;padding-right: 0;">
                    <label class="cust_label" style="text-align: left;">Remarks</label>
                    <div class="form-group">
                        <textarea id="" maxlength="200" name="" class="form-control text_uppercase" style="resize:vertical"></textarea>
                    </div>
                </div>

                <div class="row" style="text-align:center;margin-top:20px">
                       <div class="col-md-12">
                           <button type="button" class="btn_secondary newbtn_blackv1 modal_btn_navlog"  style="width:25%;line-height:27px;" id="edit_yes" data-url="{{url('navlog_cancel')}}" data-value="">ADD</button>
                       </div>
                </div>      
            </div>
        </section>
    </div>
</div>
<!-- edit email modal-->
<!-- delete modal-->
<div class="modal fade" id="modeltestdelete"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" style="width:32%;" role="document">
        <header class="popupHeader">
            <span class="header_title" id="billing_header">DELETE EMAIL TRACKER</span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>   
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;padding:15px;">
                <div class="row">
                    <div class="col-md-12">
                       <p class="dl_sure_text" style="margin-bottom:0;">Are you sure to delete (CALL SIGN) (EMAIL SUBJECT LINE)?</p>
                    </div>
                </div>
            </div>
            <div class="row" style="text-align:center;margin-top:10px">
                <div class="col-md-12">
                    <button type="button" class="btn_secondary newbtn_blackv1 modal_btn_navlog"  style="width:25%;line-height:27px;" id="" data-value="">DELETE</button>
                </div>
            </div>      
        </section>
    </div>
</div>
<!-- delete modal--> 
<div id='v_toTop'><span></span></div>
@include('includes.new_footer',[])
<script>
$(document).ready(function() {
    $('body').on('show.bs.modal',"#modeltest, #modeltestedit, #modeltestdelete", function (e) {
      $('body').addClass('test');
    });
});

$('.dropdown-select').on( 'click', '.dropdown-menu li a', function() { 
    var target = $(this).html();
    $(this).parents('.dropdown-menu').find('li').removeClass('active');
    $(this).parent('li').addClass('active');
    $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + '<span class="caret"></span>');
});
</script>
</div>

@stop