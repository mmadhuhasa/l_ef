@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')

<link rel="stylesheet" href="{{url('/media/lr_hrtimeline/css/style.css')}}">
<script src="{{url('/media/lr_hrtimeline/js/modernizr.js')}}"></script>

<style>
    @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
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
    /*    table.dataTable thead .sorting, 
        table.dataTable thead .sorting_asc, 
        table.dataTable thead .sorting_desc {
            background : none;
        }*/
    .form_pilots_top {
        padding:10px 0;
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
        font-size: 13px;
    }

    .form_pilots_top2{
        margin-top: 10px
    }

    .pilots_main {
        border:1px solid #999;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        background: #fff;

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
        width: 150px;
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
        font-size: 13px;
        vertical-align: middle;
        border: 1px solid #333;

        padding: 4px 15px;
        white-space: nowrap;
        text-transform: uppercase;
    }
    table.dataTable {
        border-collapse: collapse;
    }
    .desk-plan>thead>tr>th {
        background: #c9c9c9;
        color:#000;
        font-weight: normal;
        white-space: nowrap;
        font-weight: bold;
        font-size: 12px;
    }

    .desk-plan>tbody>tr>td {
        font-family: monospace;
        font-size: 13px;
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
    .form-control:focus {
        border-color: #f1292b !important;
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
        position: absolute;
        top:0px;
        z-index: 1;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-bottom: 1.1em;
        padding-top: 0.7em;
    }
    .exp_btn {
        background: #f1292b;
    }
    .valid_btn {
        background: #22b14c;
    }
    .due_btn {
        background: #ff7f27;
    }
    .valid_btn, .due_btn, .exp_btn {
        line-height: 0 !important;
        height:24px;
        width:100px;
    }
    .ui-datepicker-trigger {
        height: 21px;
        top:6px;
        right:9px;
    }

    .nav_add_icons {position: absolute;top: 12px;left: 43.5%;z-index: 10;}
    .nav_add_icons .fa {color: #f1292b;font-size: 17px;}
    .tooltip_rel {position: relative;}
    .tooltip_rel .fa {cursor:pointer; font-size: 17px;}
    .tooltip_cust {position: absolute;top: -25px;left: 15px;padding: 1px 11px;color: #fff;border-radius: 4px;visibility: hidden;font-size: 11px;text-transform: capitalize;font-weight: normal; box-shadow: 0 0 1px 1px #ccc; background: #333333; z-index: 999999; white-space: nowrap; text-align: center;}
    .tooltip_rel:hover .tooltip_cust{visibility: visible;}
    .modal-addlicense {width: 500px;background: #fff;border-radius: 6px;}
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
    .pdfimg {height: 17px; margin-top: -4px;}
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
    .tooltip_exp_trishape {border-top: 8px solid #f1292b;}
    .tooltip_val_trishape {border-top: 8px solid #22b14c;}
    .tooltip_due_trishape {border-top: 8px solid #ff7f27;}

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
        color: #999;
        font-size: 13px;
    }
    .newbtnv1{color:#fff !important;}
    #add_license_form input::-webkit-input-placeholder, #edit_license_form input::-webkit-input-placeholder, .form_addUser input::-webkit-input-placeholder, .form_addUser select, #edit_license_type_id {
        color: #999 !important;
    }
    #to_date_add_ld, #renewed_date_add_ld {text-align: left; padding-left: 20px;}
    .newbtn_blackv1 {color: #fff !important;}
    .width-ltype {width: 40%;}
    .width-lfrom, .width-lto {width: 13%;}
    .width-lfrom input, .width-lto input {text-align: left !important; border-radius: 4px !important;}
    .desk-plan {border-top: 1px solid #333 !important;margin-bottom: 15px !important;}
    .popupBody {padding: 6px 12px;}
    .bt_black{
        border-top-color: #333;
        transition: all 0.3s ease-in-out;
    }
    #to_date, #renewed_date {padding-left: 14px;}
    #example_wrapper, #filter_lr_info_wrapper {overflow-x: scroll;}


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
        .tooltip_exp_trishape, .tooltip_val_trishape, .tooltip_due_trishape {right:38%;}


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
    @media only screen and (min-width:992px) {
        .md-p-r-0 {padding-right:0;}
        .md-p-l-0 {padding-left: 0;} 

    }
    @media only screen and (min-width:1200px) {
        .get_filter_result, .search_users_info {display: inline-block;}
        #example_wrapper::-webkit-scrollbar, #filter_lr_info_wrapper::-webkit-scrollbar {display: none;}
    }


</style>
<script>
$(document).ready(function () {
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
        "order": [[6, "asc"]],
        aoColumnDefs: [
            {"aTargets": [7], "bSortable": false},
            {"aTargets": [0], "bSortable": false},
        ],
        "sAjaxSource": base_url + '/lr/list',
        "fnServerParams": function (aoData, fnCallback) {
            aoData.push({"name": "email", "value": $("#email").val()}),
                    aoData.push({"name": "status_type", "value": 'expire'})
        },
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            var oSettings = dt.fnSettings();
            $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
            return nRow;
        },
        "initComplete": function (settings, json) {
            //                    alert('DataTables has finished its initialisation.');
            $('div.dt_loading').remove();
        }
    });
    var currentDate = $("#lr_date").val();//document.getElementById("utcdate").value;
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

    $(".lrdate").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: min_date, showOtherMonths: true, selectOtherMonths: true,
        showAnim: "slide",
        changeMonth: true,
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
    
    
    var from_date = $("#filter_from_date2").val();
    var to_date = $("#filter_to_date2").val();
    

    $(".filter_from_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', 
        buttonImageOnly: true, showOtherMonths: true, selectOtherMonths: true,showAnim: "slide",
        changeMonth: true,
        changeYear: true});
    $(".filter_from_date").datepicker("option", "dateFormat", "dd-M-yy");
    $(".filter_from_date").datepicker("setDate", from_date);

    $(".filter_to_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', 
        buttonImageOnly: true, showOtherMonths: true, selectOtherMonths: true,showAnim: "slide",
        changeMonth: true,
        changeYear: true});
    $(".filter_to_date").datepicker("option", "dateFormat", "dd-M-yy");
    $(".filter_to_date").datepicker("setDate", to_date);
    

});
</script>
<div id="page">
    @include('includes.new_header',[])  
    <!--<form enctype="multipart/form-data" action="#" id="user_form" method="Post">-->
    <div id="">
        <section>
            <div class="container cust-container">
                <form id="lr_form" name="lr_form" data-url="">
                    <div class="row pilots_main"> 
                        <?php
                        $user_id = Auth::user()->id;
                        $user_type = 1;
                        $expire = \App\models\lr\LicenseDetailsModel::get_lr_count($user_id, $user_type, 1);
                        $valid = \App\models\lr\LicenseDetailsModel::get_lr_count($user_id, $user_type, 2);
                        $due = \App\models\lr\LicenseDetailsModel::get_lr_count($user_id, $user_type, 3);
                        ?>
                        <div class="search_users_info">
                            <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
                            <div class="get_filter_result" >
                                <div class="col-md-12" >
                                    <table id="example" class="table table-hover table-responsive desk-plan">
                                        <thead>
                                            <tr class="bg-v-333">
                                                <th class="slno">SL</th>
                                                <th class="uname">NAME</th>
                                                <th class="ltype">LICENSE TYPE</th>
                                                <th class="lnum">LICENSE NUMBER</th>
                                                <th class="rdate">RENEWED DATE</th>
                                                <th class="exp-date">EXPIRY DATE</th>
                                                <th class="vdays">DAYS TO GO</th>

                                                <th class="action">ACTIONS</th>
                                            </tr>
                                        </thead>                                  
                                    </table>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <input type="hidden" name="filter_from_date2" id="filter_from_date2" value="{{date('d-M-Y',strtotime('-1 years'))}}" />
                    <input type="hidden" name="filter_to_date2" id="filter_to_date2" value="{{date('d-M-Y',strtotime('+1 years'))}}" />
                </form>
            </div>
        </section>    	
    </div>
    @include('includes.new_footer',[])  
</div>
@stop