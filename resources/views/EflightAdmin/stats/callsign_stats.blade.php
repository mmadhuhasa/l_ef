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
        border: 1px solid #c9c8c8;
        white-space: nowrap;
    }
    table.dataTable tbody th, table.dataTable tbody td {
        padding: 5px 15px;
        border:1px solid #ccc;
    }
  
    .desk-plan>thead>tr>th {
        background: #999;
        color:#000;
        font-weight: normal;
        white-space: nowrap;
        font-weight: bold;
        font-size: 12px;
        text-transform: uppercase;
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
        top:80px;
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
    /*    .slno {width: 5% !important;}
        .dof {width:22% !important;}
        .calsign {width: 37% !important;}
        .from {width:10% !important;}
        .exp-date {width:10% !important; }
        .action {width:14% !important;}*/

    /*        .slno {width: 54px !important;}
            .uname {width:124px !important;}
            .ltype {width: 208px !important;}
            .lnum {width: 112px !important;}
            .rdate {width: 121px !important;}
            .exp-date {width: 108px !important;}
            .vdays {width: 73px !important;}
            .status {width: 73px !important;}
            .action {width: 95px !important;}*/

    .nav_add_icons {position: absolute;top: 92px;left: 43.5%;z-index: 10;}
    .nav_add_icons .fa {color: #f1292b;font-size: 17px;}
    .tooltip_rel {position: relative;}
    .tooltip_rel .fa {cursor:pointer; font-size: 15px;}
    .tooltip_cust {position: absolute;top: -25px;left: 15px;padding: 1px 11px;color: #eee;border-radius: 4px;visibility: hidden;font-size: 10px;text-transform: capitalize;font-weight: normal; box-shadow: 0 0 1px 1px #ccc; background: #333333; z-index: 999999; width: 85px; text-align: center;}
    .tooltip_rel:hover .tooltip_cust{visibility: visible;}
    .modal-addlicense, .modal-addUser, .modal-editLicense {width:800px;background: #fff;border-radius:6px;}
    .modal-editLicense {width: 450px;}
    .modal-editLicense .form-control {border-radius: 4px !important;}
    .modal-pdfreport, .modal-deleteLicense{width: 400px;background: #fff;border-radius:6px;}
    .modal-viewhistory {width: 820px;background: #fff;border-radius: 6px;}
    .form_add_license select.form-control{background-position: 95% 11px;color:#222}
    .form_add_license .ui-datepicker-trigger {width:17px; height:20px;right: 22px;top: 6px;}
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
    .cust_label {text-align: center;width: 100%; font-weight: normal;font-size: 13px;}
    .modal-editLicense .popupBody, .modal-viewhistory .popupBody, .modal-deleteLicense .popupBody {padding: 12px 20px;}
    .modal-editLicense .popupHeader, .modal-viewhistory .popupHeader, .modal-deleteLicense .popupHeader {padding:7px 20px;}

    .desg_arw {
        background-position: 96% 11px !important;
        color:#000 !important;
        text-transform: uppercase;
        padding-left: 33%;
        font-size: 13px !important;
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
        position: absolute;top: -25px;left: -5px;padding: 3px 11px;color: #eee;border-radius: 4px;visibility: hidden;font-size: 10px;font-weight: normal;
        box-shadow: 0 0 1px 1px #ccc;background: #333333;white-space: nowrap;z-index: 20; text-transform: uppercase;
    }
    .tooltip_rel:hover .tooltip_edit_position, .tooltip_rel:hover .tooltip_tri_shape1, .tooltip_rel:hover .tooltip_tri_shape2, .tooltip_rel:hover .tooltip_tri_shape3{visibility: visible;}
    .tooltip_tri_shape1, .tooltip_tri_shape2, .tooltip_tri_shape3 {width: 0;height: 0;border-left: 5px solid transparent;border-right: 5px solid transparent;border-top: 6px solid #333;position: absolute;top: -5px;right: 10px;z-index: 99999;visibility: hidden;}
    .tooltip_tri_shape3  {left:2px;}
    .pdfimg {height: 17px; margin-top: -4px;}

    .cd-horizontal-timeline .events-content p {
        text-align: justify;
    }
    .tooltip_exp_trishape, .tooltip_val_trishape, .tooltip_due_trishape {
        width: 0;
        height: 0;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 8px solid #333;
        position: absolute;
        top: 23px;
        right: 52%;
        z-index: 99999;
    }
    #to_date, #renewed_date {text-align: left;padding-left: 23px;}
</style>
<script>
$(document).ready(function () {
    $('#example').dataTable({
        "sDom": '<"top"iflp<"clear">>rt',
        "bProcessing": true,
        "bFilter": false,
        "bLengthChange": false,
        "iDisplayLength": 25,
        "sPaginationType": "simple_numbers",
        "info": false,
        bSortable: true,
        bRetrieve: true,
        aoColumnDefs: [
            {"aTargets": [0], "bSortable": false},
            {"aTargets": [1], "bSortable": true},
            {"aTargets": [2], "bSortable": false},
            {"aTargets": [3], "bSortable": false},
            {"aTargets": [4], "bSortable": false},
            {"aTargets": [5], "bSortable": false},
            {"aTargets": [6], "bSortable": false},
            {"aTargets": [7], "bSortable": false},
            {"aTargets": [8], "bSortable": false},
            {"aTargets": [9], "bSortable": false}
        ]
    });
});
</script>
<div id="page">
    @include('includes.new_header',[])  
    <div id="">
        <section>
            <div class="container cust-container">
                <form id="lr_form" name="lr_form" data-url="">
                    <div class="row pilots_main"> 
                        <div class="col-md-12">
                            <div class="form_pilots_top">
                                <div class="col-md-3 norightpad">
                                    <input type="text" id="email" name="email" class="form-control alpha_numeric text_uppercase" placeholder="Email">
                                </div>
                                <div class="col-md-4 norightpad">
                                    <input type="text" id="name" name="name" class="form-control pilot_incommand text_uppercase" placeholder="Name">
                                </div>
                                <div class="col-md-2 norightpad">
                                    <div class="input-group">
                                        <input type="text" id="operator" data-url="" name="operator" class="form-control text_lowercase" placeholder="Operator">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" id="mobile_number" data-url="" name="mobile_number" maxlength="10" class="form-control numeric" placeholder="Mobile Number">
                                    </div>
                                </div>
                                <div class="col-md-1 noleftpad">
                                    <button type="button" class="btn newbtnv1 pilots_search" style="line-height:1">Search</button>
                                </div>
                            </div>
                        </div>
                        <?php
                        $operator_user_id = Auth::user()->id;
                        $users_list = App\User::where('is_active', 1)->where('is_lr', 1)
                                ->get(['name', 'email', 'mobile_number', 'operator']);
                        $sno = 1;
                        ?>
                        <div class="search_users_info">
                            <div class="get_filter_result">
                                <div class="col-md-12">
                                    <table id="example" class="table table-hover table-responsive desk-plan">
                                        <thead>
                                            <tr class="bg-v-333">
                                                <th class="slno">S-NO</th>
                                                <th class="aircraft_callsign">call sign</th>
                                                <th class="action">fpl</th>
                                                <th class="action">fdtl</th>
                                                <th class="action">navlog</th>
                                                <th class="action">l & t</th>
                                                <th class="action">notams</th>
                                                <th class="action">weather</th>
                                                <th class="action">lr</th>
                                                <th class="action">Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <th>TESTA</th>
                                                <th><input id="" type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><i class="fa fa-trash fa-2x"></i></th>
                                            </tr>
                                            <tr>
                                                <th>2</th>
                                                <th>TESTB</th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><i class="fa fa-trash fa-2x"></i></th>
                                            </tr>
                                            <tr>
                                                <th>3</th>
                                                <th>TESTC</th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><input type="checkbox"></th>
                                                <th><i class="fa fa-trash fa-2x"></i></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>    
                        </div>
                    </div>
                </form>
            </div>
        </section>    	
    </div>
    @include('includes.lr.license_modal_popups')
    <script src="{{url('/media/lr_hrtimeline/js/jquery.mobile.custom.min.js')}}"></script>
    <script src="{{url('/media/lr_hrtimeline/js/main.js')}}"></script>

    <input type="hidden" name="url" id="url" value="{{url('')}}" />
    <input type="hidden" name="lr_date" id="lr_date" value="{{date('ymd')}}" />
    @include('includes.new_footer',[])  
</div>
@stop