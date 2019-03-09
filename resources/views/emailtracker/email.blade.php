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
right: 58%;
z-index: 99;
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
.get_filter_result, .search_users_info {display: inline;}
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
z-index: 10000;    
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
/*.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{
background-color: #fff;    
}*/
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
/*fakeinput*/
.fakeinput{
display: block!important;
border-left: 0;
border-top: 0;
border-right: 0;
}
.mini_input {
width:58%!important;
font-size: 14px!important;
font-weight: bold!important;
box-shadow: none;
text-align:center;
padding-left: 0!important;
padding-right: 0!important;
}
/*.fakeinput *{font-weight:bold;}*/
.mini_input:focus{
outline: none!important;
box-shadow: none;
}
/*fakeinput*/
.timeright::-webkit-input-placeholder { /* Chrome/Opera/Safari */
text-align:left;
}
.timeleft::-webkit-input-placeholder { /* Chrome/Opera/Safari */
text-align:right;
}
.ui-datepicker-calendar a.ui-state-default {border-color:lightgray;text-align: center; font-weight: bold; }
.ui-datepicker-calendar td.ui-datepicker-today a { border-color: #333; background: #333;text-align: center;color: beige;  } 
.ui-datepicker-calendar a.ui-state-hover { background: darkgray; border-color:darkgray;text-align: center;} 
.ui-datepicker-calendar a.ui-state-active { background: #F1292b !important;border-color: #F1292b;color: white !important;text-align: center; } 
.ui-datepicker-today.ui-datepicker-current-day a.ui-state-highlight {border-color: #F1292b;background: #F1292b;text-align: center;}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
background: #fff
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
</style>
@include('includes.new_header',[])
<script type="text/javascript" src="{{url('app/js/BuroRaDer.DateRangePicker.js')}}"></script>
<!--loader-->
<div class="overlay">
    <div id="loading-img"></div>
</div> 
<!--loader-->
<section>
    <div class="container cust-container">
     @if(Session::has('msg'))
         <span class="lrsuccess updated_successfully1">
             <div class="success_search" style="width:100%;text-align: center;color: #f1292b;text-transform: uppercase;margin-top:10px;">
                 <div class="success-left animated infinite zoomIn custdelay">
                     <span id="succ_msg" style="font-weight: bold;"> {{ Session::get('msg') }}</span>
                 </div>
             </div>
         </span> 
     @endif
     @php  
         if(($status=='URGENT')||($status=='' && $resultlist['urgent_trackerlist_count']>0))
         	$status="URGENT"; 
         else if($status=='PENDING' ||($status=='' && $resultlist['urgent_trackerlist_count']==0 && $resultlist['pending_trackerlist_count']>0))  
          	$status="PENDING";
         else if($status=='DONE' ||($status=='' && $resultlist['urgent_trackerlist_count']==0 && $resultlist['pending_trackerlist_count']==0 && $resultlist['done_trackerlist_count']>0))  
          	$status="DONE"; 
         else $status="URGENT";
     @endphp
        <div class="row pilots_main"> 
            <div class="col-md-12 LR_style">
                <p class="new_fpl_heading">EMAIL TRACKER SUPPORT</p>
            </div>
            <form id="status_filter" method="post" action="{{url('emails')}}">
            <div class="form_pilots_top">
                <div class="col-md-1 tooltip_rel" style="width:2%;margin-top: 8px;">
                    <a data-target="#modeltest" data-toggle="modal" style="cursor:pointer;color:#f1292b;">
                       <i class="fa fa-plus add_license"></i>
                    </a>
                </div>
                <div class="col-md-5 col-sm-6 md-p-r-0 sm-m-b-15 xs-m-b-15 name-margin" style="padding-right:10px;margin-right:0px;width:15%;padding-left: 15px;">
                    <div class="dropdown dropdown-select">
                            <button id="ultype_filter_btn" class="btn dropdown-toggle bold" style="color:#000;background:#fff;width:100%;border:1px solid #999;height:34px;" type="button" data-toggle="dropdown" aria-expanded="true" data-toggle="popover" data-placement="top" >
                                    @if($resultlist['type']!='') {{$resultlist['type']}} @else TYPE @endif
                                <span @if($resultlist['type']=='') style="margin-left:20px;"  @endif  class="caret"></span>
                            </button>
                            <ul class="dropdown-menu ul_type_filter" role="menu" id="ultype_filter" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation" value="FPL"><a role="menuitem" tabindex="-1" href="javascript:void(0)" >FPL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" value="NAV LOG">NAV LOG</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" value="FDTL">FDTL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" value="LICENSE">LICENSE</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" value="FUEL">FUEL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" value="HANDLING">HANDLING</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" value="HOTEL">HOTEL</a></li>
                            </ul>
                        </div>
                        <input type="hidden" name="type" id="type_filter"  @if($resultlist['type']!='') value="{{trim($resultlist['type'],"")}}" @endif> </input>

                </div>
                <div class="col-md-5 col-sm-6 md-p-r-0 sm-m-b-15 xs-m-b-15 name-margin" style="padding-right:10px;margin-right:0px;width:38%;padding-left:0px;">
                    <input type="text" name="operator" class="form-control text_uppercase alphabets_with_space bold" placeholder="OPERATOR" autocomplete="off" maxlength="25" @if($resultlist['operator']!='') value="{{$resultlist['operator']}}" @endif id="search_operator">
                </div>
                <div class="col-md-4 col-sm-6  sm-m-b-15 xs-m-b-15" style="padding-left:2px;padding-right:2px;width:20%;">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" style="border-top-right-radius: 4px;border-bottom-right-radius:4px;" class="form-control get_operators text_uppercase special_symbols bold" autocomplete="off" name="callsign" placeholder="CALL SIGN" maxlength="7" @if($resultlist['callsign']!='') value="{{$resultlist['callsign']}}" @endif id="search_callsign">
                            <div class="input-group-addon" style="padding:0px 10px 0px 5px;border:none;">
                                <button style="width:60px;border-radius:4px;" type="submit" name="filter" id="search" value="search" class="btn newbtnv1 input-group-addon">SEARCH</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2  col-sm-3 col-xs-6 md-p-l-0 width-lfrom xs-m-b-15" style="padding-right:2px;">
                    <div class="input-group">
                        <input type="text" name="from_date" autocomplete="off" class="form-control text_lowercase filter_from_date bold" placeholder="From-Date" maxlength="7" readonly @if($resultlist['from_date']!='') value="{{$resultlist['from_date']}}" @endif data-date-range-end="#to" id="frm" style="cursor: pointer;">
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6 md-p-l-0 width-lto xs-m-b-15" style="padding-right:2px;">
                    <div class="input-group">
                        <input type="text" name="to_date" maxlength="10" class="form-control numeric filter_to_date hasDatepicker bold" placeholder="To-Date" readonly @if($resultlist['to_date']!='') value="{{$resultlist['to_date']}}" @endif id="to" data-date-range-start="#frm" style="cursor: pointer;">
                    </div>
                </div>
                <button style="width: 40px;" type="submit" class="btn newbtnv1 lr_search" name="filter" value="2nd_search"style="line-height:1" id="2nd_search"><span class="glyphicon glyphicon-search"></span></button>
            </div>
            <div class="col-md-12" >
                <div class="search_users_info exp_val_due_btns_sec">
              
                {{ csrf_field() }}
                <input type="hidden" name="last_active_btn" @if($resultlist['last_active_btn']!='') value="{{$resultlist['last_active_btn']}}" @else value="URGENT" @endif>
                <div class="form_pilots_top2">                                   
                    <div class="col-md-4 width-search">
                        <button type="submit" data-value="exp1" class="filter_users newbtnv1 btn exp_btn" name="filter" value="URGENT">URGENT <span>({{$resultlist['urgent_trackerlist_count']}})</span></button>
                        @if($status=='URGENT') <span class="filter_shape exp1 tooltip_exp_trishape"></span>  @endif
                    </div>
                    <div class="col-md-4 width-search">
                        <button type="submit" data-value="due1" class="filter_users newbtnv1 btn due_btn" name="filter" value="PENDING">PENDING <span>({{$resultlist['pending_trackerlist_count']}})</span></button>
                        @if($status=='PENDING') <span class="filter_shape  due1 tooltip_due_trishape "></span> @endif
                    </div>
                    <div class="col-md-4 width-search">
                        <button type="submit" data-value="valid1" class="filter_users newbtnv1 btn valid_btn" name="filter" value="DONE">DONE <span>({{$resultlist['done_trackerlist_count']}})</span></button>
                        @if($status=='DONE') <span class="filter_shape  tooltip_val_trishape valid1"></span> @endif
                    </div>
                </div>
              </form>  
            </div><!--search_users_info close here-->

                <table id="email_tracker_info" class="table table-hover table-responsive desk-plan" style="width:100%;">
                    <thead>
                        <tr  >
                            <th class="{{$status}}" style="font-size: 14px;width:4%;">SL</th>
                            <th class="{{$status}}"  style="font-size: 14px;width:10%;">CALLSIGN</th>
                            <th class="{{$status}}"  style="font-size: 14px;width:31%;">EMAIL SUBJECT</th>
                            <th class="{{$status}}"  style="font-size: 14px;width:12%;">EMAIL DATE</th>
                            <th class="{{$status}}"  style="font-size: 14px;width:17%;">COMPLETE BY DATE</th>
                            <th class="{{$status}}"  style="font-size: 14px;width:8%;">TIME</th>
                            <th class="{{$status}}"  style="font-size: 14px;width:9%;">TYPE</th>
                            <th class="{{$status}}"  style="font-size: 14px;width:10%;">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count=1;@endphp 
                        @foreach($resultlist['email_trackerlist'] as $result)

                          <tr  style="@if($result->action==1) color:red;font-weight:bold; @endif" id="row_{{$result->id}}" >
                            <td class="" >{{$count++}}</td>
                            <td class="" >{{$result->callsign}}</td>
                            <td class="" >
                                <div class="tooltip_cancel">
                                    <span>{{substr($result->subject,0,35)}}</span> 
                                    @if(strlen($result->subject)>35) 
                                    <span class="tooltip_dept_position">{{$result->subject}}</span>
                                    <div class="tooltip_tri_shape4"></div>
                                    @endif
                                </div>
                            </td>
                            <td class="" >{{date('d-M-Y',strtotime($result->email_date))}}</td>
                            <td class="" >{{date('d-M-Y',strtotime($result->email_completed_by))}}</td>
                            <td class="" >{{substr($result->completed_time,0,2)}}:{{substr($result->completed_time,2,2)}}</td>
                            <td>{{$result->type}}</td>
                            <td class="" >
                              @if($result->action!=1)
                                <div class="tooltip_rel">
                                    <a data-target="#modeltestedit" data-toggle="modal" class="edit_email_tracker" data-type="{{$result->type}}" data-operator="{{$result->operator}}" data-status="{{$result->status}}" data-subject="{{$result->subject}}" data-remarks="{{$result->remarks}}" data-completed_time="{{$result->completed_time}}" data-email_date="{{date('d-M-Y',strtotime($result->email_date))}}" data-email_completed_by="{{date('d-M-Y',strtotime($result->email_completed_by))}}" data-callsign="{{$result->callsign}}" data-id="{{$result->id}}">
                                    <i class="fa fa-pencil-square"></i></a><span class="p-l-9"></span>
                                    <span class="tooltip_edit_position">Edit</span>
                                    <span class="tooltip_tri_shape1"></span>
                                </div>
                              @endif      
                                <div class="tooltip_rel"><a class="viewhistory" data-target="#ViewHistory" data-toggle="modal" data-id="{{$result->id}}">
                                    <i class="fa fa-history"></i></a><span class="p-l-9"></span>
                                    <span class="tooltip_edit_position t_vh">History</span>
                                    <span class="tooltip_tri_shape2"></span>
                                </div>
                               @if($result->action!=1)  
                                <div class="tooltip_rel">
                                    <a data-target="#modeltestdelete" data-toggle="modal" class="delete_email_tracker" data-callsign="{{$result->callsign}}" data-id="{{$result->id}}" data-subject="{{$result->subject}}" data-id="{{$result->id}}">
                                    <i class="fa fa-trash"></i></a>
                                    <span class="tooltip_edit_position">Delete</span>
                                    <span class="tooltip_tri_shape3"></span>
                                </div>               
                               @endif      
                            </td> 
                          </tr>
                        @endforeach
                        
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
         <form id="add_emailtracker" action="{{url('emails/store')}}" method="post">
            <div class="modal-body" style="text-align: center;padding:15px;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="dropdown dropdown-select">
                            <button class="btn dropdown-toggle bold" style="color:#000;background:none;width:100%;border:1px solid #999;" type="button" id="type" data-toggle="dropdown" aria-expanded="true" data-toggle="popover" data-placement="top">
                                    TYPE
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" id="ultype_add_email_tracker" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FPL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">NAV LOG</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FDTL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">LICENSE</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FUEL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HANDLING</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HOTEL</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3" style="width: 16%;padding-left: 0px;padding-right: 0px;">
                         <input type="text" name="callsign" autocomplete="off" id="callsign" class="form-control text_uppercase special_symbols callsign centerandbold" maxlength="7" placeholder="CALLSIGN" data-toggle="popover" data-placement="top" autocomplete="off">
                    </div>
                    <div class="col-md-6" style="width: 59%;">
                         <input type="text" name="operator" autocomplete="off" id="operator" class="form-control centerandbold text_uppercase operator alphabets_with_space pace_name" maxlength="25" placeholder="OPERATOR" data-toggle="popover" data-placement="top" autocomplete="off" readonly>
                    </div>
                    <div class="col-md-12" style="margin-top:15px;margin-bottom:15px;">
                         <input type="text" name="subject" autocomplete="off" id="subject" class="form-control text_uppercase subject centerandbold" maxlength="60" placeholder="EMAIL SUBJECT" data-toggle="popover" data-placement="top" autocomplete="off">
                    </div>
                     <div class="col-md-4" style="width:20%;margin-top:0px;padding-right:10px;margin-left:12%;">
                         <input type="text" name="email_date" autocomplete="off" id="email_date"  class="form-control text_uppercase email_date numbers centerandbold" maxlength="4" placeholder="Email DATE" data-toggle="popover" data-placement="top" autocomplete="off" readonly style="cursor: pointer;">
                    </div>
                     <div class="col-md-4" style="width:17%;margin-top:0px;padding-left: 0px;padding-right:10px;">
                         <input type="text" name="email_complete_by" autocomplete="off" id="email_complete_by"  class="form-control text_uppercase email_complete_by numbers centerandbold" maxlength="4" placeholder="COMPLETE BY" data-toggle="popover" data-placement="top" autocomplete="off" readonly style="cursor: pointer;">
                    </div>
                     <div class="col-md-2" style="width:19%;margin-top:0px;padding-left:0;padding-right:10px;">
                         <input type="text" name="completed_time" autocomplete="off" id="completed_time"  class="form-control text_uppercase completed_time numbers centerandbold" maxlength="4" placeholder="COMPLETE TIME" data-toggle="popover" data-placement="top" autocomplete="off">
                    </div>
                    <div class="col-md-4" style="margin-top: 0px;width:16%;padding-left: 0;padding-right:0px;">
                        <div class="dropdown dropdown-select">
                            <button class="btn dropdown-toggle bold" style="color:#000;background:none;width:100%;border:1px solid #999;" type="button" id="status" data-toggle="dropdown" aria-expanded="true" data-toggle="popover" data-placement="top">
                                    STATUS
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu"  id="ulstatus" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">URGENT</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">PENDING</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">DONE</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-12" style="padding-left: 5px;margin-top:0px;padding-right: 0;">
                    <label class="cust_label" style="text-align:left;">Remarks</label>
                    <div class="form-group">
                        <textarea id="remarks" name="remarks" autocomplete="off" maxlength="150" name="" class="form-control text_uppercase" style="resize:vertical;font-weight:bold;"></textarea>
                    </div>
                </div>
                <div class="row" style="text-align:center;margin-top:20px">
                    <div class="col-md-12">
                        <button type="submit" class="btn_secondary newbtn_blackv1 modal_btn_navlog"  style="width:15%;line-height:27px;margin-top: 5px;" id="edit_yes" data-url="{{url('navlog_cancel')}}" data-value="">ADD</button>
                    </div>
                </div>      
            </div>
            </form>
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
          <form id="edit_emailtracker" action="{{url('emails/update')}}" method="post">
            <div class="modal-body" style="text-align: center;padding:15px;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="dropdown dropdown-select">
                            <button class="btn btn-default dropdown-toggle bold" style="color:#000;background:none;width:100%;" type="button" id="edit_type" data-toggle="dropdown" aria-expanded="true" class="bold">
                                    TYPE
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu " role="menu" id="ultype_edit_email_tracker" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="return false;">FPL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">NAV LOG</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FDTL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">LICENSE</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">FUEL</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HANDLING</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">HOTEL</a></li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id">
                    <div class="col-md-3" style="width: 16%;padding-left: 0px;padding-right: 0px;">
                         <input type="text" name="callsign" autocomplete="off" id="edit_callsign" class="form-control text_uppercase  special_symbols callsign centerandbold" maxlength="7" placeholder="CALLSIGN" data-toggle="popover" data-placement="top" autocomplete="off">
                    </div>
                    <div class="col-md-6" style="width: 59%;">
                         <input type="text" name="operator" id="edit_operator" autocomplete="off" class="form-control text_uppercase centerandbold operator pace_name" placeholder="OPERATOR" maxlength="25" data-toggle="popover" data-placement="top" readonly>
                    </div>
                    <div class="col-md-12" style="margin-top:15px;margin-bottom:15px;">
                         <input type="text" name="subject" id="edit_subject" autocomplete="off" class="form-control text_uppercase centerandbold subject" placeholder="EMAIL SUBJECT" maxlength="60" data-toggle="popover" data-placement="top">
                    </div>
                     <div class="col-md-4" style="width:20%;margin-top:0px;padding-right:10px;margin-left:12%;">
                         <input type="text" name="email_date" autocomplete="off" id="edit_email_date"  class="form-control text_uppercase email_date numbers centerandbold" maxlength="4" placeholder="Email DATE" data-toggle="popover" data-placement="top" autocomplete="off" readonly style="cursor: pointer;">
                    </div>
                     <div class="col-md-4" style="width:17%;margin-top:0px;padding-left: 0px;padding-right:10px;">
                         <input type="text" name="email_complete_by" autocomplete="off" id="edit_email_complete_by"  class="form-control text_uppercase email_complete_by numbers centerandbold" maxlength="4" placeholder="COMPLETE BY" data-toggle="popover" data-placement="top" autocomplete="off" readonly style="cursor: pointer;">
                    </div>
                     <div class="col-md-4" style="width:19%;margin-top:0px;padding-left:0;padding-right:10px;">
                         <input type="text" name="completed_time" id="edit_completed_time" class="form-control text_uppercase numbers centerandbold completed_time" maxlength="4" placeholder="COMPLETE TIME" autocomplete="off" data-toggle="popover" data-placement="top">
                    </div>
                    <div class="col-md-4" style="margin-top: 0px;width:16%;padding-left: 0;padding-right:0px;">
                        <div class="dropdown dropdown-select">
                            <button class="btn btn-default dropdown-toggle bold" style="color:#000;background:none;width:100%;" type="button" id="edit_status" data-toggle="dropdown" aria-expanded="true">
                                    STATUS
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu bold" role="menu" style="min-width: 100%;" aria-labelledby="dropdownMenu1">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">URGENT</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">PENDING</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">DONE</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="padding-left: 5px;margin-top:0px;padding-right: 0;">
                    <label class="cust_label" style="text-align: left;">Remarks</label>
                    <div class="form-group">
                        <textarea id="edit_remarks" name="remarks" maxlength="200" name="" class="form-control text_uppercase" style="resize:vertical;font-weight:bold;" autocomplete="off"></textarea>
                    </div>
                </div>
                <div class="row" style="text-align:center;margin-top:20px">
                    <div class="col-md-12">
                        <button type="submit" class="btn_secondary newbtn_blackv1 modal_btn_navlog"  style="width:14%;line-height:27px;margin-top:5px;" id="edit_yes" data-value="">EDIT</button>
                    </div>
                </div>      
            </div>
           </form> 
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
                       <p class="dl_sure_text" style="margin-bottom:0;">Are you sure to delete (<span id="callsign_del"></span>) (<span id="subject_del"></span>)?</p>
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
<!-- history modal-->
<div class="modal fade" id="ViewHistory"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container" style="width:900px;" role="document">
        <header class="popupHeader">
            <span class="header_title" id="billing_header">HISTORY</span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>   
        <section class="popupBody">
            <div class="modal-body" style="text-align: center;padding:15px;">
                <div class="row">
                    <table style="width:100%;" class="emailtracker_info history_fuel table table-hover table-responsive desk-plan" id="emailtracker_info">
                    <thead style="background: #333;">
                        <tr>
                            <th style="width:20px !important;border-left: 1px solid #000;" class="">Sl</th>
                            <th style="width:35px !important;" class="">ACTIONS</th>
                            <th style="width:70px !important;" class="">CALLSIGN</th>
                            <th style="width:30px !important;" class="">EMAIL SUBJECT</th>
                            <th style="width:60px !important;" class="">EMAIL DATE</th>
                            <th style="width:60px !important;" class="">TYPE</th>
                            <th style="width:100px !important;" class="">DATE AND TIME</th>
                            <th style="width:50px !important;" class="">BY</th>
                        </tr>
                    </thead>
                    <tbody id="fuel_info_tbody">

                    </tbody>
                </table>
                </div>
            </div>   
        </section>
    </div>
</div>
<!-- History Modal -->
<!-- alert validation modal-->
<div class="modal fade" id="emailtracker_alert_validation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-container prvplan" role="document">
        <header class="popupHeader">
            <span class="validation_header_title"></span>
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
<script>
$(document).ready(function() {

	$(".ul_type_filter li").click(function(){
		$(".notify-bg-v").fadeOut();
	  	$("#type_filter").val($(this).text());
	 });
	// $("#ultype_filter_btn,#type,#edit_type,#status,#edit_status").click(function(){ 
	// 	$('.notify-bg-v').css('height',0);
	// 	$('.notify-bg-v').css('height', $(document).height());
	// 	$(".notify-bg-v").fadeIn();

	// });
	$("#ultype_filter_btn").click(function(){ 
		$('.notify-bg-v').css('height',0);
		$('.notify-bg-v').css('height', $(document).height());
		$(".notify-bg-v").fadeIn();

	});
	setInterval(function(){ $("#succ_msg").fadeOut(); }, 6000);
	$(document).on("keypress",".completed_time",function(e){ 
	   var time=$(this).val();
	   if ((time.length == 0) && ((e.which >=51 &&  e.which <= 57))){
	      return false;
	   }
	   if (time.length == 1 && $(this).val().charAt(0)==2 && ((e.which >=52 &&  e.which <= 57))){
	   	console.log("s");
	      return false;
	   }
	   if ((time.length == 2) && ((e.which >=54 &&  e.which <= 57))){
	      return false;
	   }
	   if (time.length == 3 && ((e.which >=49 &&  e.which <= 52)||(e.which >=54 &&  e.which <= 57) || (time=='000'  && e.which ==48) )){
	      return false;
	   }
	}); 
	$(document).on("keypress",".mmcompleted_time",function(e){ 
	   var time=$(this).val();
	   var hhdeparturetime=$("#hhcompleted_time").val();
	   if ((time.length == 0||time.length == 2) && ((e.which >=54 &&  e.which <= 57))|| (time.length == 3 && parseInt(time_split[0])>=24 && (e.which >=49 &&  e.which <= 57) )){
	      return false;
	   }
	   if (time.length == 1 && ((e.which >=49 &&  e.which <= 52)||(e.which >=54 &&  e.which <= 57) || (time=='0' && hhdeparturetime =='00' && hhdeparturetime !="" && e.which ==48) )){
	      return false;
	   }
	}); 
	$("#email_date,#edit_email_date").datepicker({ 
	      dateFormat: 'dd-M-yy',
	      minDate:0, 
	      onSelect: function(selectedDate) 
	      {   
	           var id=$(this).attr('id');
	           closePopover("#"+id);
	           if(id=='email_date'){
	            $("#email_complete_by").datepicker('option',{minDate:new Date(selectedDate)}); 
	               setTimeout(function(){
	                   $("#email_complete_by").datepicker("show");
	                   $(".notify-bg-v").fadeIn(); 
	               }, 16);
	           }
	           else{
	           	$("#edit_email_complete_by").datepicker('option',{minDate:new Date(selectedDate)});
                setTimeout(function(){
                    $("#edit_email_complete_by").datepicker("show");
                    $(".notify-bg-v").fadeIn();
                 }, 16);
               }
	          //$(".notify-bg-v").fadeOut();
	      }
	  });
	 $("#email_complete_by,#edit_email_complete_by").datepicker({ 
	      dateFormat: 'dd-M-yy',
	      minDate: 0, 
	      onSelect: function(selectedDate) 
	      {  
	         var id=$(this).attr('id');
	         closePopover("#"+id);
	         if(id=='email_complete_by'){
	           $("#hhcompleted_time").focus();
	         }  
             $(".notify-bg-v").fadeOut();
	      }
	  });
	 $("#callsign").on('keyup', function() {
	    var aircraft_callsign = $(this).val().toUpperCase();
	    var data_url = $(this).attr('data-url');
	    var data = {
	        'aircraft_callsign': aircraft_callsign, 
	    };
	    if(aircraft_callsign.length >= 5){
	        $.ajax({
	            url: base_url + "/billing/callsign_operator",
	            data: data,
	            type: 'GET',
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	            },
	            success: function(data) {
	                $("#operator").val(data.operator.toUpperCase());
	            },
	            error: function(data) {
	                //console.log(data);
	            }
	        })
	    } 
	});
	 $('#ultype_add_email_tracker li').click(function(e) 
	     { 
	     	$(".notify-bg-v").fadeOut();
	        $("#type").addClass('bold');
	     });
	 $('#ulstatus li').click(function(e) 
	     { 
	        $("#status").addClass('bold');
	     });
	$("#frm,#to,#email_date,#email_complete_by,#edit_email_date,#edit_email_complete_by").click(function (e) {
	    $(".notify-bg-v").fadeIn();
	    $('.notify-bg-v').css('height', $(document).height());
	});
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
       if ((e.charCode > 64 && e.charCode < 91) || (e.charCode > 96 && e.charCode < 123) || (e.charCode >= 32 && e.charCode <= 47) || (e.charCode >= 58 && e.charCode <= 64) || (e.charCode >= 91 && e.charCode <= 96)|| (e.charCode >= 123 && e.charCode <= 127))
         return false;
           else
         return true;    
    });
    $('body').on('show.bs.modal',"#modeltest,#ViewHistory,#modeltestedit,#modeltestdelete,#emailtracker_alert_validation", function (e) {
      $('body').addClass('test');
    });
});

$('.dropdown-select').on( 'click', '.dropdown-menu li a', function() { 
    var target = $(this).html();
    $(this).parents('.dropdown-menu').find('li').removeClass('active');
    $(this).parent('li').addClass('active');
    $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + '<span class="caret"></span>');
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
$(document).on("keyup",".operator",function(e){  
   if($(this).val().length>=2) 
     closePopover("#"+$(this).attr('id'));
});
$(document).on("keyup",".callsign",function(e){  
   if($(this).val().length>=5){ 
     closePopover("#"+$(this).attr('id'));
     if($(this).attr('id')=="callsign")
      $("#subject").focus();
     else
       $("#edit_subject").focus();
   }
});
$(document).on("keyup",".subject",function(e){  
   if($(this).val().length>=2) 
     closePopover("#"+$(this).attr('id'));
});
$(document).on("keyup","#completed_time",function(e){  
   if($(this).val().length==4){ 
      closePopover("#completed_time");
    } 
});
$(document).on("keyup","#edit_completed_time",function(e){  
   if($(this).val().length==4){ 
      closePopover("#edit_completed_time");
    } 
});
$('#ultype_add_email_tracker').click(function(){
     closePopover("#type");
 });
$('#ulstatus').click(function(){
     closePopover("#status");
 });
$('#add_emailtracker').on('submit',function (event){
	event.preventDefault();
	var type= $("#type").text();
	var operator=$("#operator").val();
	var callsign=$("#callsign").val();
	var subject=$("#subject").val();
    var email_date=$("#email_date").val();
    var email_complete_by=$("#email_complete_by").val();
    var completed_time=$("#completed_time").val();
	var status= $("#status").text();
	var bool=true;
	if(type.trim()=="TYPE"){
	    errorPopover('#type','Select Type');
	    bool=false;
	}
	if(email_date==""){
	    errorPopover('#email_date','Enter Email Date');
	    bool=false;
	}
	if(email_complete_by==""){
	    errorPopover('#email_complete_by','Enter Completed BY');
	    bool=false;
	}
	if(callsign.length<5){
	    errorPopover('#callsign','Min. 5 & Max. 7 Characters, only Alphabets & Numbers allowed');
	    bool=false;
	}
	if(subject.length<2){
	    errorPopover('#subject','Min. 2 & Max. 150 Alphabets and only SPACE Character allowed');
	    bool=false;
	}
	if(completed_time.length<4){
	    errorPopover('#completed_time','Min. & Max. 4 digits');
	    bool=false;
	}
	if(status.trim()=="STATUS"){
	    errorPopover('#status','Select STATUS');
	    bool=false;
	}
    if(bool==false)
       return false;
    $("#modeltest").modal('hide');     
    $('.overlay').css('height',0);
    $('.overlay').css('height', $(document).height());
    $(".overlay").show(); 
	var data=$(this).serialize()+'&type='+$("#type").text()+'&status='+$("#status").text();
    $.ajax({
           context : this,  
           type: $(this).attr('method'),  
           url: $(this).attr('action'),
           headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
           dataType:"json",
           data:data,
           success: function(result) 
           {
           	   setTimeout(function(){ 
           	   	 $(".overlay").fadeOut();
                 location.reload(); }, 2000);
           }
     });       
   });
   $('#edit_emailtracker').on('submit',function (event){
   	event.preventDefault();
   	var bool=true;
   	var type= $("#edit_type").text();
   	var operator=$("#edit_operator").val();
   	var callsign=$("#edit_callsign").val();
   	var subject=$("#edit_subject").val();
   	var completed_time=$("#edit_completed_time").val();
   	var status= $("#edit_status").text();
   	if(completed_time.length<4){
   	    errorPopover('#edit_completed_time','Min. & Max. 4 digits');
   	    bool=false;
   	}
   	if(type.trim()=="TYPE"){
   	    errorPopover('#edit_type','Select Type');
   	    bool=false;
   	}
   	if(callsign.length<5){
   	    errorPopover('#edit_callsign','Min. 5 & Max. 7 Characters, only Alphabets & Numbers allowed');
   	    bool=false;
   	}
   	if(subject.length<2){
   	    errorPopover('#edit_subject','Min. 2 & Max. 150 Alphabets and only SPACE Character allowed');
   	    bool=false;
   	}
   	if(status.trim()=="STATUS"){
   	    errorPopover('#edit_status','Select STATUS');
   	    bool=false;
   	}
       if(bool==false)
          return false; 
    $("#modeltestedit").modal('hide');     
    $('.overlay').css('height',0);
    $('.overlay').css('height', $(document).height());
    $(".overlay").show();        
   	var data=$(this).serialize()+'&type='+$("#edit_type").text()+'&status='+$("#edit_status").text();
       $.ajax({
              context : this,  
              type: $(this).attr('method'),  
              url: $(this).attr('action'),
              headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
              dataType:"json",
              data:data,
              success: function(result) 
              {
               	   setTimeout(function(){ 
               	   	 $(".overlay").fadeOut();
                     location.reload(); 
                   }, 2000);
              }
        });       
      });
     $("#frm").datepicker({  
        dateFormat: 'dd-M-yy',
        changeMonth: true,
        changeYear: true,
        closeText: 'Clear',
        onSelect: function(selectedDate) 
        { 
           if($("#to").val()!="")
           {
            $(".notify-bg-v").fadeOut();
            }
        }
      });
     $('#frm').focusin(function(){  
         if($(this).val()=="")
           $(this).addClass('focusin');
          else
           $(this).removeClass('focusin');  
       });
     $('#frm').focusout(function(){  
          $(this).removeClass('focusin');  
       });
      $("#frm").click(function() {  
        
        $(this).focus();
      });
      $("#to").bind("click focus", function() {
        $($(this).data("date-range-start")).click();
        
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
     function setTypeMenu(text) {
        $('#edit_type').val(text).html(function(i, html) {
            return text + html.slice(html.indexOf(' <'));
        });
    }
    function setStatusMenu(text) {
        $('#edit_status').val(text).html(function(i, html) {
            return text + html.slice(html.indexOf(' <'));
        });
    }
  $(".edit_email_tracker").click(function(){
      var type=$(this).attr('data-type');
      var id=$(this).attr('data-id');
      var operator=$(this).attr('data-operator');
      var callsign=$(this).attr('data-callsign');
      var status=$(this).attr('data-status');
      var subject=$(this).attr('data-subject');
      var remarks=$(this).attr('data-remarks');
      var completed_time=$(this).attr('data-completed_time');
      var email_date=$(this).attr('data-email_date');
      var email_completed_by=$(this).attr('data-email_completed_by');
      $("#id").val(id);
      setTypeMenu(type.trim());
      $("#edit_operator").val(operator);
      $("#edit_callsign").val(callsign);
      $("#edit_remarks").val(remarks);
      $("#edit_subject").val(subject);
      $("#edit_completed_time").val(completed_time);
      setStatusMenu(status.trim());
      $("#edit_email_date").val(email_date);
      $("#edit_email_complete_by").val(email_completed_by);
  });
  $(".delete_email_tracker").click(function(){
      var id=$(this).attr('data-id');
      var subject=$(this).attr('data-subject');
      var callsign=$(this).attr('data-callsign');
      $("#del_btn").attr('data-email_id',id);
      $("#callsign_del").text(callsign);
      $("#subject_del").text(subject);
  });
  $("#del_btn").click(function(){
      var id=$(this).attr('data-email_id');
      $("#modeltestdelete").modal('hide');
       $.ajax({
              context : this,  
              type: 'POST',  
              url: '/emails/delete',
              headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
              dataType:"json",
              data:{'id':id},
              success: function(result) 
              {
                    location.reload();
              }
        });       
  });
  $(document).on("click",".viewhistory",function()
  {   $("#fuel_info_tbody").empty();
      var emailtracker_id=$(this).attr('data-id');
      viewhistory(emailtracker_id);
  });    
  function viewhistory(emailtracker_id)
  {
    $('#emailtracker_info').DataTable( {
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
              // {"bSortable": false},
              // {"bSortable": false},
              {"bSortable": false},
              {"bSortable": false},
              {"bSortable": false},
              {"bSortable": false},   
              {"bSortable": false},
          ],
           "ajax":"/emails/viewhistory?emailtracker_id="+emailtracker_id,
      });
  }
  $("#search").on('click', function (e) {
      if($("#search_operator").val()=='' && $("#search_callsign").val()=='' && $("#type_filter").val()==''){
      	$(".modal_message").html("Please enter any one field");
      	$(".validation_header_title").html('Validation Fail Message')
        $("#emailtracker_alert_validation").modal('show');
         return false;
      }
   }); 
   $("#2nd_search").on('click', function (e) {
      if($("#frm").val()=='' && $("#to").val()==''){
      	$(".modal_message").html("Please enter any one field");
      	$(".header_title").html('Validation Fail Message')
        $("#emailtracker_alert_validation").modal('show');
         return false;
      }
   });
</script>
</div>
@stop