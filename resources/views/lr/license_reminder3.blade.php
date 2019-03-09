@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<link href="{{url('app/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">
<script src="{{url('/media/lr_hrtimeline/js/modernizr.js')}}"></script>
<style>
@media screen and (min-width:767px) and (max-width:1300px) {
.ltype {
width:135px!important;
}
.lnum {
width:180px!important;
}
.vdays {
width:75px!important;
}
/*.rdate {
width:214px!important;
}*/
.uname{
width:150px!important;
}
.desk-plan>thead>tr>th, .desk-plan>tbody>tr>td{
padding: 4px 2px!important;
}
}
@media screen and (min-width:1301px) and (max-width:1600px) {
.ltype {
width:135px!important;
}
.lnum {
width:180px!important;
}
.vdays {
width:75px!important;
}
/*.rdate {
width:214px!important;
}*/
.uname{
width:150px!important;
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
width: 100%;
float:left;
border:1px solid #ccc;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
margin-top: 15px;
background: #f2f2f2;

}
.form_pilots_top input[type="text"] {
text-align: center;
font-size: 12px;
}
.form_pilots_top2{
margin-top: 10px
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
.desk-plan>thead>tr>th, .desk-plan>tbody>tr>td {
text-align: center;
font-size: 14px;
vertical-align: middle;
border: 1px solid #333;

padding: 4px 5px;
white-space: nowrap;
text-transform: uppercase;
}
table.dataTable {
border-collapse: collapse;
}
.desk-plan>thead>tr>th {
background: #555;
color:#fff;
font-weight: normal;
white-space: nowrap;
font-weight: bold;
font-size: 13px;
}
.desk-plan>tbody>tr>td {
font-family: monospace;
font-size: 14px;
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
/*end of pagination styles */
.search_users_info {
position: relative;
}
.exp_val_due_btns_sec {
position: absolute;
top:10px;
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
.modal-pdfreport {width: 275px;}
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
.desk-plan {border-top: 1px solid #333 !important;margin-bottom: 15px !important;}
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
.slno{
width:50px!important;
}
.exp-date{
width:110px!important;  
}
.action {
width:85px!important;    
}
.ui-widget-content {
border:2px solid #dddddd;
}
</style>
<script>
$(document).ready(function () {
//    $('#filter_from_date, #filter_to_date').click(function () {
//        $('.notify-bg-v').css('display', 'block');
//    });
    var dt = $('#example').dataTable({
//        "sScrollX": "100%",
        "bScrollCollapse": true,
        "sDom": '<"top"iflp<"clear">>rt',
        "bProcessing": true,
        "bFilter": false,
        "bLengthChange": false,
        "iDisplayLength": 25,
        "sPaginationType": "simple_numbers",
        "info": false,
        bSortable: true,
        bRetrieve: true,
//        "order": [[6, "desc1"], [1, "asc1"]],
        aoColumnDefs: [
            {"aTargets": [7], "bSortable": false},
            {"aTargets": [0], "bSortable": false},
            {"aTargets": [5], "bSortable": false},
        ],
        "sAjaxSource": base_url + '/lr/list',
        "fnServerParams": function (aoData, fnCallback) {
            aoData.push({"name": "email", "value": $("#email").val()}),
                    aoData.push({"name": "status_type", "value": $("#status_type").val()})
        },
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            var oSettings = dt.fnSettings();
            $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);

            return nRow;
        },
        "oLanguage": {
            "sZeroRecords": "<p style='color:#555;font-size:15px;'>Hooray, all your records are valid. Click VALID TAB to know more.</p>"
        },
        "initComplete": function (settings, json) {
            //alert('DataTables has finished its initialisation.');
            $('div.dt_loading').remove();
        }
    });
    var currentDate = $("#lr_date").val();
    var current_day = '';
    var current_month = '';
    var current_year = '';
    if (currentDate) {
        current_day = currentDate.substr(0, 2);
        current_month = currentDate.substr(3, 2) - 1;
        current_year = currentDate.substr(6, 4);
    }
    // Datepicker code
    var currentTime = new Date();
    var month = currentTime.getMonth() + 1;
    var day = currentTime.getDate();
    var year = currentTime.getFullYear();
    var todaydate = year + "-" + month + "-" + day;
    var day2 = currentTime.getDate() + 1;
    var seconddate = year + "-" + month + "-" + day2;
    var day3 = currentTime.getDate() + 2;
    var thirddate = year + "-" + month + "-" + day3;
    var day4 = currentTime.getDate() + 3;
    var fourthdate = year + "-" + month + "-" + day4;
    var day5 = currentTime.getDate() + 4;
    var fifthdate = year + "-" + month + "-" + day5;
    var readonlyDays = [todaydate, seconddate, thirddate, fourthdate, fifthdate];
    var date = new Date();
    var min_date = new Date(current_year, current_month, current_day);
    var max_date = addDays(min_date, 4);
    var min_date2 = new Date('2000', '1', '1');
    $(".lrdate").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: min_date, showOtherMonths: true, selectOtherMonths: true,
        showAnim: "slide",
        changeMonth: true,
        showMonthAfterYear: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function (date) {
            var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
            for (i = 0; i < readonlyDays.length; i++) {
                if ($.inArray(y + '-' + (m + 1) + '-' + d, readonlyDays) !== -1) {
                    //return [false];
                    return [true, 'dp-highlight-date', ''];
                }
            }
            return [true];
        },
        onSelect: function () {
            $('.notify-bg-v').hide();
        }
    });
    $(".lrdate2").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: min_date2, showOtherMonths: true, selectOtherMonths: true,
        showAnim: "slide",
        changeMonth: true,
        showMonthAfterYear: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function (date) {
            var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
            for (i = 0; i < readonlyDays.length; i++) {
                if ($.inArray(y + '-' + (m + 1) + '-' + d, readonlyDays) !== -1) {
                    //return [false];
                    return [true, 'dp-highlight-date', ''];
                }
            }
            return [true];
        },
        onSelect: function () {
            $('.notify-bg-v').hide();
        }
    });
    var exp_date = $('#to_date').val();
    $(".lrdate").datepicker("option", "dateFormat", "dd-M-yy");
    $(".lrdate").datepicker("setDate", currentDate);
    $(".lrdate2").datepicker("option", "dateFormat", "dd-M-yy");
    $(".lrdate2").datepicker("setDate", currentDate);
    var from_date = $("#filter_from_date2").val();
    var to_date = $("#filter_to_date2").val();
    $(".filter_from_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png',
        buttonImageOnly: true, showOtherMonths: true, selectOtherMonths: true, showAnim: "slide",
        changeMonth: true,
        showMonthAfterYear: true,
        onSelect: function (selectedDate)
        {
            $(".notify-bg-v").fadeOut();
        },
        changeYear: true, });
    $(".filter_from_date").datepicker("option", "dateFormat", "dd-M-yy");
    // $(".filter_from_date").datepicker({  
    //       changeMonth: true,
    //       changeYear: true,

    //   });

    $(".filter_from_date").datepicker("setDate", from_date);
    $(".filter_to_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png',
        buttonImageOnly: true, showOtherMonths: true, selectOtherMonths: true, showAnim: "slide",
        changeMonth: true,
        showMonthAfterYear: true,
        onSelect: function (selectedDate)
        {
            alert("hii");
            $(".notify-bg-v").fadeOut();
        },
        changeYear: true
    });
    $(".filter_to_date").datepicker("option", "dateFormat", "dd-M-yy");
    $(".filter_to_date").datepicker("setDate", to_date);
    $(".cal_renewed_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png',
        buttonImageOnly: true, showOtherMonths: true, selectOtherMonths: true, showAnim: "slide",
        changeMonth: true,
        showMonthAfterYear: true,
        changeYear: true});
    $(".cal_renewed_date").datepicker("option", "dateFormat", "dd-M-yy");
    $(".cal_renewed_date").datepicker("setDate", $("#cal_renewed_date").val());
});
</script>
<style>
    .font-14{
        font-size: 14px
    }
</style>
<div id="page">
    @include('includes.new_header',[])  
    <!--<form enctype="multipart/form-data" action="#" id="user_form" method="Post">-->
    <div id="">
        <section>
            <div class="container cust-container">
                <form id="lr_form" name="lr_form" data-url="">
                    <div class="row pilots_main"> 
                        <div class="col-md-12 LR_style">
                            <p class="new_fpl_heading">LICENSE REMINDER</p>
                        </div>
                        <div class="col-md-12">
<!--                            <span class="lrsuccess">
                                <div style="width:100%;text-align: center;color: #f1292b;text-transform: uppercase">
                                    @if(Session::get('success'))
                                    <div class="success-left animated infinite zoomIn custdelay">
                                        <span class="success-font">{{Session::get('success')}}</span>
                                    </div>
                                    @endif
                                </div>
                            </span>    -->
                            <!--                            <div style="width:100%;text-align: center;color: #f1292b;text-transform: uppercase"  class="license_success_message">
                                                        </div>-->
                            <div class="form_pilots_top">
                                <div class="col-md-3 col-sm-6 md-p-r-0 sm-m-b-15 xs-m-b-15 name-margin" style="padding-right:5px;margin-right:0px;">
                                    <input type="text" id="filter_user_name" name="filter_user_name" v-model="filter_user_name" class="form-control text_uppercase" maxlength="3" placeholder="Pilot Name">
                                </div>
                                <div class="col-md-4 col-sm-6 width-ltype sm-m-b-15 xs-m-b-15" style="padding-left:2px;padding-right:5px;">
                                    <input type="text" id="filter_license_type" name="filter_license_type" v-model="filter_license_type" class="form-control pilot_incommand text_uppercase" placeholder="License Name">
                                </div>
                                <div class="col-md-4 col-sm-6  sm-m-b-15 xs-m-b-15" style="padding-left:2px;padding-right:10px;width:36%;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;" class="form-control get_operators text_uppercase" v-model="filter_operator" name="filter_operator" id="filter_operator" placeholder="Operator">
                                            <div class="input-group-addon" style="padding:0px 0px 0px 5px;border:none;">
                                                <button style="width: 60px;border-radius:4px;" @click="lr_field_search" type="button" name="flag" value="search" class="btn newbtnv1 input-group-addon">@{{search_val}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2  col-sm-3 col-xs-6 md-p-l-0 width-lfrom xs-m-b-15" style="padding-right:2px;">
                                    <div class="input-group">
                                        <input type="text" id="filter_from_date" data-url="" name="filter_from_date" class="form-control text_lowercase filter_from_date" placeholder="From-Date">
<!--                                        <img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="...">-->
                                        <span class="fpl_search_from_label">From</span>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-6 md-p-l-0 width-lto xs-m-b-15" style="padding-right:2px;">
                                    <div class="input-group">
                                        <input type="text" id="filter_to_date" data-url="" name="filter_to_date" maxlength="10" class="form-control numeric filter_to_date" placeholder="To-Date">
                                        <!--<img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="...">-->
                                        <span class="fpl_search_to_label">To</span>
                                    </div>
                                </div>
                                <button style="width: 40px;" type="button" @click="lr_search" class="btn newbtnv1 lr_search" style="line-height:1"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                        <?php
                        $user_id = Auth::user()->id;
                        $user_type = 1;
                        $expire = \App\models\lr\LicenseDetailsModel::get_lr_count($user_id, $user_type, 1);
                        $valid = \App\models\lr\LicenseDetailsModel::get_lr_count($user_id, $user_type, 2);
                        $due = \App\models\lr\LicenseDetailsModel::get_lr_count($user_id, $user_type, 3);
                        ?>
                        <div class="search_users_info">
                            <div class="exp_val_due_btns_sec">
                                <div class="form_pilots_top2">                                   
                                    <div class="col-md-4 width-search">
                                        <button type="button" data-value="exp1" class="filter_users newbtnv1 btn exp_btn" id="expire" @click="expire" data-url="{{url('/lr/lr-filter')}}">Expired (<span id="expire_count">{{$expire}}</span>)</button>
                                        <span class="filter_shape exp1 tooltip_exp_trishape"></span>
                                    </div>
                                    <div class="col-md-4 width-search">
                                        <button type="button" data-value="due1" class="filter_users newbtnv1 btn due_btn" @click="due" data-url="{{url('/Admin/get_user_details')}}">Due (<span id="due_count">{{$due}}</span>)</button>
                                        <span class="filter_shape due1"></span>
                                    </div>
                                    <div class="col-md-4 width-search">
                                        <button type="button" data-value="valid1" class="filter_users newbtnv1 btn valid_btn" @click="valid" data-url="{{url('/Admin/get_user_details')}}">Valid (<span id="valid_count">{{$valid}}</span>)</button>
                                        <span class="filter_shape valid1"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 nav_add_icons">
                                <div class="col-md-4 tooltip_rel"><a style="cursor:pointer;"><i @click="addlicense" class="fa fa-plus add_license"></i></a><span class="tooltip_cust">ADD LICENSE</span></div>
                                @if(in_array(Auth::user()->user_role_id,[1,2,3]))
                                <div class="col-md-4 tooltip_rel"><a data-target="#pdfreport" data-toggle="modal" style="cursor:pointer;"><img src="{{'app/new_temp/images/pdf.png'}}" class="pdfimg"></i></a><span class="tooltip_cust">VIEW PDF</span></div>
                                @else
                                <div class="col-md-4 tooltip_rel"><a  style="cursor:pointer;"><img src="{{'app/new_temp/images/pdf.png'}}" class="pdfimg download_user_pdf"></i></a><span class="tooltip_cust">VIEW PDF</span></div>
                                @endif
                                @if(in_array(Auth::user()->user_role_id,[1]))
                                <!--                                <div class="col-md-4 add_user_icon tooltip_rel">
                                                                    <a data-target="#addUser" data-toggle="modal" style="cursor:pointer;"><i class="fa fa-user-plus"></i></a>
                                                                    <span class="tooltip_cust">ADD USER</span>
                                                                </div>-->
                                @endif
                            </div>
                            <div style="width:100%;text-align:center;margin-top:2px;color:#f1292b" class="success_msg"></div>
                            <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
                            <div class="get_filter_result" >
                                <div class="col-md-12" >
                                    <table id="example" class="table table-hover table-responsive desk-plan">
                                        <thead>
                                            <tr class="bg-v-333">
                                                <th class="slno font-14" style="font-size:14px;">SL</th>
                                                <th class="uname font-14" style="font-size: 14px">NAME</th>
                                                <th class="ltype font-14"style="font-size: 14px;">LICENSE NAME</th>
                                                <th class="rdate font-14" style="font-size: 14px">OPERATOR</th>
                                                <th class="lnum font-14" style="font-size: 14px">LICENSE NUMBER</th>
                                                <th class="exp-date font-14" style="font-size: 14px">EXPIRY DATE</th>
                                                <th class="vdays font-14" style="font-size: 14px">DAYS</th>
                                                <th class="action font-14" style="font-size: 14px">ACTIONS</th>
                                            </tr>
                                        </thead>                                  
                                    </table>
                                </div>
                            </div>    
                        </div>
                        @include('includes.ops.edit_users')
                    </div>
                    <input type="hidden" name="filter_from_date2" id="filter_from_date2" value="{{date('d-M-Y',strtotime('-1 years'))}}" />
                    <input type="hidden" name="filter_to_date2" id="filter_to_date2" value="{{date('d-M-Y',strtotime('+10 years'))}}" />
                    <input type="hidden" name="status_type" id="status_type" value="" />

                    <input type="hidden" name="url" id="url" value="{{url('')}}" />
                    <input type="hidden" name="lr_date" id="lr_date" value="{{date('d-m-Y')}}" />
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
                    <input type="hidden" name="cal_renewed_date" id="cal_renewed_date" value="{{date('d-M-Y')}}" />
                </form>


            </div>
        </section>    	
    </div>
    <div class="notify-bg-v"></div>
    @include('includes.lr.license_modal_popups')
    @include('includes.new_footer',[])  
</div>
<script>
    $(document).ready(function () {
        $('body').on('show.bs.modal', "#editLicense, #viewhistory, #addLicense, #deleteLicense", function (e) {
            $('body').addClass('test');
        });
    });
    $('.bg-v-333').addClass('exp_th_color');
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
    new Vue({
        el: "#page",
        data: {aircraft_callsign: '',
            operator: '',
            from_date: '',
            to_date: '',
            flag: '',
            search_val: 'Search',
            filter_user_name: '',
            filter_license_type: '',
            filter_operator: ''
        },
        methods: {
            expire: function (e) {
                e.preventDefault();
                var data_url = base_url + "/lr/lr-filter";
                var formdata = $("#lr_form").serializeArray();
                var flag = $("form").find("button[type=button]:focus").attr('id');
                this.flag = 'expire';
                $("#status_type").val('expire');
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['flag'] = this.flag;
                data['action'] = '';

                $(".success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Fetching data Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $(".success").html('');
                        $(".get_filter_result").html(data.body);
                    }
                });
            },
            valid: function (e) {
                e.preventDefault();
                var data_url = base_url + "/lr/lr-filter";
                var formdata = $("#lr_form").serializeArray();
                var flag = $("form").find("button[type=button]:focus").attr('id');
                this.flag = 'valid';
                var data = {};
                $("#status_type").val("valid");
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['flag'] = this.flag;
                data['action'] = '';

                $(".success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Fetching data Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $(".success").html('');
                        $(".get_filter_result").html(data.body);
                    }
                });
            },
            due: function (e) {
                e.preventDefault();
                var data_url = base_url + "/lr/lr-filter";
                var formdata = $("#lr_form").serializeArray();
                var flag = $("form").find("button[type=button]:focus").attr('id');
                this.flag = 'due';
                var data = {};
                $("#status_type").val("due");
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['flag'] = this.flag;
                data['action'] = '';

                $(".success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Fetching data Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $(".success").html('');
                        $(".get_filter_result").html(data.body);
                    }
                });
            },
            addlicense: function (e) {
                e.preventDefault();
                var currentDate = $("#cal_renewed_date").val();
                $(".add_license_success").html('');
                $("#add_license_form")[0].reset();
//                $("#to_date_add_ld").val(currentDate);
//                $("#renewed_date_add_ld").val(currentDate);
                $("#addLicense").modal();
            },
            add_license_confirm: function (e) {
                e.preventDefault();
                var data_url = base_url + "/lr/lr-filter";
                var formdata = $("#add_license_form").serializeArray();

                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });

                $(".success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Fetching data Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $(".success").html('');
                        $(".get_filter_result").html(data.body);
                    }
                });
            },
            lr_search: function (e) {
                e.preventDefault();
                var data_url = base_url + "/lr/lr-filter";
                var get_data_url = base_url + "/lr/get-lr-count";
                var formdata = $("#lr_form").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['flag'] = this.flag;
                data['s_type'] = 'dates';

                this.$http.post(get_data_url, data).then(function (data) {

                    $("#expire_count").text(data.body.result.expire);
                    $("#valid_count").text(data.body.result.valid);
                    $("#due_count").text(data.body.result.due);
                    if (data.body.result.expire && data.body.result.expire != '0') {
                        $(".exp1").addClass('tooltip_exp_trishape');
                        $('.due1').removeClass('tooltip_due_trishape');
                        $('.valid1').removeClass('tooltip_val_trishape');
                        setTimeout(function () {
                            $('.bg-v-333').addClass('exp_th_color');
                        }, 1000);
                    } else if (data.body.result.due) {
                        $(".due1").addClass('tooltip_due_trishape');
                        $(".exp1").removeClass('tooltip_exp_trishape');
                        $('.valid1').removeClass('tooltip_val_trishape');
                        setTimeout(function () {
                            $('.bg-v-333').addClass('due_th_color');
                        }, 1000);
                    } else if (data.body.result.valid) {
                        $(".valid1").addClass('tooltip_val_trishape');
                        $(".due1").removeClass('tooltip_due_trishape');
                        $(".exp1").removeClass('tooltip_exp_trishape');
                        setTimeout(function () {
                            $('.bg-v-333').addClass('valid_th_color');
                        }, 1200);
                    }
                });
                $(".success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Fetching data Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $(".success").html('');
                        $(".get_filter_result").html(data.body);
                    }
                });
            },
            lr_field_search: function (e) {
                e.preventDefault();
                if (this.search_val == 'Search') {
                    this.search_val = 'Reset';
                } else {
                    this.filter_user_name = "";
                    this.filter_license_type = "";
                    this.filter_operator = "";
                    $("#lr_form")[0].reset();
                    this.search_val = 'Search';
                }
                var data_url = base_url + "/lr/lr-filter";
                var get_data_url = base_url + "/lr/get-lr-count";
                var formdata = $("#lr_form").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['flag'] = this.flag;
                data['s_type'] = 'fields';

                this.$http.post(get_data_url, data).then(function (data) {
                    $("#expire_count").text(data.body.result.expire);
                    $("#valid_count").text(data.body.result.valid);
                    $("#due_count").text(data.body.result.due);
                    if (data.body.result.expire && data.body.result.expire != '0') {
                        $(".exp1").addClass('tooltip_exp_trishape');
                        $('.due1').removeClass('tooltip_due_trishape');
                        $('.valid1').removeClass('tooltip_val_trishape');
                        setTimeout(function () {
                            $('.bg-v-333').addClass('exp_th_color');
                        }, 1000);
                    } else if (data.body.result.due) {
                        $(".due1").addClass('tooltip_due_trishape');
                        $(".exp1").removeClass('tooltip_exp_trishape');
                        $('.valid1').removeClass('tooltip_val_trishape');
                        setTimeout(function () {
                            $('.bg-v-333').addClass('due_th_color');
                        }, 1000);
                    } else if (data.body.result.valid) {
                        $(".valid1").addClass('tooltip_val_trishape');
                        $(".due1").removeClass('tooltip_due_trishape');
                        $(".exp1").removeClass('tooltip_exp_trishape');
                        setTimeout(function () {
                            $('.bg-v-333').addClass('valid_th_color');
                        }, 1200);
                    }
                });
                $(".success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Fetching data Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $(".success").html('');
                        $(".get_filter_result").html(data.body);
                    }
                });
            },
        }
    });
    $(document).on('click', '.filter_users', function () {
        $(".filter_users").css("background", "");
        // $(this).css("background", "#333");
        $(".filter_shape").removeClass('tooltip_exp_trishape');
        var data_value = $(this).attr('data-value');
        console.log("Came");
        if (data_value == 'exp1') {
            $("." + data_value).addClass('tooltip_exp_trishape');
            $('.due1').removeClass('tooltip_due_trishape');
            $('.valid1').removeClass('tooltip_val_trishape');
            setTimeout(function () {
                $('.bg-v-333').addClass('exp_th_color');
            }, 1000);
        }
        if (data_value == 'valid1') {
            $("." + data_value).addClass('tooltip_val_trishape');
            $('.due1').removeClass('tooltip_due_trishape');
            $('.exp1').removeClass('tooltip_exp_trishape');
            setTimeout(function () {
                $('.bg-v-333').addClass('valid_th_color');
            }, 1200);
        }
        if (data_value == 'due1') {
            $("." + data_value).addClass('tooltip_due_trishape');
            $('.valid1').removeClass('tooltip_val_trishape');
            $('.exp1').removeClass('tooltip_exp_trishape');
            setTimeout(function () {
                $('.bg-v-333').addClass('due_th_color');
            }, 1000);
        }
    });
    $(function () {
        $(".exp_btn,.valid_btn, .due_btn").hover(function () {
            $(this).next().toggleClass('bt_black');
        });
        $("#user_id_add_ld, #license_type_add_ld").change(function () {
            $(this).css('border-color', '#555');
        });
        setTimeout(function () {
            $(".lrsuccess").text("")
        }, 5800);
    });
    $(document).on('click', '.delete_license', function () {
        var data_value = $(this).attr('data-value');
        $(".delete_license_confirm").attr('data-value', data_value);
        $("#delete_license_id").val(data_value);
        $(".delete_license_success").hide();
        $(".remove_del").show();
        var attr_data = $(this).data();
        $(".del_lic_heading").html(attr_data.user + " - " + attr_data.license)
        $("#deleteLicense").modal();
    });
    $(document).on('click', '.edit_license', function () {
        var data_value = $(this).attr('data-value');
        $(".edit_license_id").attr('data-value', data_value)
        $("#edit_license_id").val(data_value);
        $(".edit_license_success").html('');
        $(".remove_file_success").html("");
        $.get(base_url + "/lr/get_license_details", {'id': data_value}, function (data) {
            $("#lr_user_name").html(data.result.user_name)
            $("#to_date").val(data.result.to_date);
            $("#previous_exp_date").text(data.result.to_date);
            console.log(data.result.to_date.substr(0, 2));
            $("#edit_day").val(data.result.to_date.substr(0, 2));
            $("#edit_month").val(data.result.to_date.substr(3, 3));
            $("#edit_year").val(data.result.to_date.substr(7));

            $("#renewed_date").val(data.result.renewed_date);
            $("#number").val(data.result.number);
            $("#edit_user_name").val($("#filter_user_name").val());
//            $("#edit_license_name").val($("#filter_license_type").val());
            $("#remarks").val(data.result.message);
            if (data.file_exist) {
                $(".lr_file_icons").show();
                $("#editfile_remove").css('visibility', 'visible');
                $("#editfile_upload").css('color', '#eee');
                $(".file_original_name").html("<span style='color:red'>" + data.file_original_name + "</span>")
                $(".lr-file-download").attr("href", base_url + "/s3down/" + data_value).attr("target","_blank");
            } else {
                $("#editfile_upload").css('color', 'transparent');
                $(".lr_file_icons").hide()
                $(".lr-file-download").attr("href", "#");
            }
//            $("select option[value='" + data.result.license_type_id + "']").attr('selected', 'selected');
            $("#edit_license_type_id").html("<option value='" + data.result.license_type_id + "'>" + data.result.lr_license_name + "</option>")
            $("#editLicense").modal();
        });
    });
    $("#filter_user_name").autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                type: "GET",
                url: base_url + "/lr/autocomplete_user_name",
                dataType: "json",
                data: {
                    term: request.term.toUpperCase(),
//                  aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#filter_user_name").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#filter_user_name").css("border", "red solid 1px");
                //$('#pilot_in_command').popover('show');
            } else {
                $('#filter_user_name').popover('destroy');
                $("#filter_user_name").css("border", "lightgrey solid 1px");
            }
        }
    });
    $(".get_operators").autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.ajax({
                type: "GET",
                url: base_url + "/lr/get_operators",
                dataType: "json",
                data: {
                    term: request.term.toUpperCase(),
//                        aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#filter_user_name").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#filter_user_name").css("border", "red solid 1px");
                //                $('#pilot_in_command').popover('show');
            } else {
                $('#filter_user_name').popover('destroy');
                $("#filter_user_name").css("border", "lightgrey solid 1px");
            }
        }
    });
    $("#filter_license_type").autocomplete({
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                type: "GET",
                url: base_url + "/lr/autocomplete_license_type",
                dataType: "json",
                data: {
                    term: request.term.toUpperCase(),
//                        aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#filter_license_type").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#filter_license_type").css("border", "red solid 1px");
                //                $('#pilot_in_command').popover('show');
            } else {
                $('#filter_license_type').popover('destroy');
                $("#filter_license_type").css("border", "lightgrey solid 1px");
            }
        },
        open: function () {
            $('.ui-autocomplete').css('width', '333px');
        }
    });
    $(document).on('click', '.viewhistory', function () {
        var data_value = $(this).attr('data-value');
//    $.post(base_url + "/lr/get_history_details", {'id': data_value}, function (data) {
//        $(".bbbb").html(data.history_result);
//        alert(data.history_result)
//        $(".cba").html(data.history_result2);
        $.ajax({
            type: "POST",
            url: base_url + "/lr/get_history_details",
//            dataType: "json",
            data: {'id': data_value},
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data) {
                $(".abc").html(data.history_result);
                $(".viewhistory_header_title").html(data.header)
                $("#viewhistory").modal();
            }
        });
//    });
    });
    $(document).on('click', '.download_user_pdf', function () {
        var user_id = $("#user_id").val();
        $("#pdfreport").modal('hide');
        window.location = base_url + '/lr/pdf/' + user_id;
    });
    $("#filter_from_date, #filter_to_date").click(function () {
        $(".notify-bg-v").fadeIn();
        $('.notify-bg-v').css('height', $(document).height());
    });
    $('body').on('click', '.ui-datepicker-trigger', function () {
        $(".notify-bg-v").fadeIn();
        $('.notify-bg-v').css('height', $(document).height());
    });
    $("#filter_from_date, #filter_to_date").datepicker({
        dateFormat: 'dd-M-yy',
        changeMonth: true,
        changeYear: true,
        onSelect: function (selectedDate)
        {
            $(".notify-bg-v").fadeOut();
        }
    });
</script>
<script src="{{url('/media/lr_hrtimeline/js/jquery.mobile.custom.min.js')}}"></script>
<script src="{{url('/media/lr_hrtimeline/js/main.js')}}"></script>
<script src="{{('app/plugins/custombox/dist/custombox.min.js')}}"></script>
<script src="{{('app/js/jquery.core.js')}}"></script>
@stop