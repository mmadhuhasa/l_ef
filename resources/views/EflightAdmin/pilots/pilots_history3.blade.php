@extends('layouts.backend_layout2',array('1'=>'1'))
@section('content')
<style>
    @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
    @media (min-width: 1200px) {
        .container {
            width: 1000px;
        }
    }
     @media screen and (min-width:767px) and (max-width:1300px) {
           .edit_tooltip, .delete_tooltip {
             right: -5px!important;
            }   
    }
    .p-l-5 {
        padding-left: 5px;
    }
    .desk-plan .fa {
        color:#000;
        font-size: 1.3em;
    }
    .fa-2x {
        font-size: 1.6em;
    }
    a:hover { 
        color: #f1292b;
    }
    table.dataTable thead .sorting, 
    table.dataTable thead .sorting_asc, 
    table.dataTable thead .sorting_desc {
        background : none;
    }
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
    .pilots_search {
        padding: 0 10px;
    }
    .form_pilots_top input[type="text"] {
        text-align: center;
        font-size: 13px;
    }
    .pilots_main {
        border:1px solid #999;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        margin-top: 15px;
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

    table.dataTable thead th, table.dataTable thead td {
        padding: 10px 8px;
    }

    .width-input-boxes {
        width: 195px;
    }
    .width-search {
        width: 100px;
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
        border: 1px solid #c9c8c8;
        padding: 5px 8px;     
    }
    .desk-plan>thead>tr>th {
        background: #222;
        color:#fff;
        font-weight: normal;
    }
    .top {
        margin-bottom: 10px;
    }
    .dataTables_wrapper .dataTables_paginate {
        padding-top:0.25em;
        padding-bottom: 0.5em;
    }
    .table-hover>tbody>tr:hover, .table>tbody>tr.active:hover {
        background:#999;
    }
    .success{
        margin: 0 0 10px;
        width: 100%;
        text-align: center;
        color: #f1292b;
    }
    .company_color{
        color: #f1292b;
        /*font-weight: bold*/
    }
    .display_none{
        display: none
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
    .desk-plan p {
        margin:0;
    }
    /* end of pagination styles */
    .edit_rel, .delete_rel {
        position: relative;
        display: inline-block;
    }
    .edit_tooltip, .delete_tooltip {
        position: absolute;
        top: -15px;
        right: 2px;
        padding: 0px 5px;
        background: #333;
        color: #fff;
        border-radius: 3px;
        text-transform: uppercase;
        font-size: 11px;
        visibility: hidden;
    }
    .delete_rel {padding-left: 5px;}
    .delete_tooltip {
        right: -10px;
    }
    .edit_rel:hover .edit_tooltip, .delete_rel:hover .delete_tooltip {
        visibility: visible;
    }
     .font_bold_14{
        font-weight: bold;
        font-size: 14px;
    }
</style>
<script>
    $(function () {
        if ($('#pilots_info').length > 0) {
            $('#pilots_info').each(function (e) {
                var url_fpl_list = $("#url").val();
                var date = $("#date_of_flight2").val();
                jQuery.fn.dataTableExt.sErrMode = 'throw';
                jQuery.fn.dataTableExt.oPagination.iFullNumbersShowPages = 10;
                var opt = {
                    "bSort": false, //disable soting of columns
                    "sDom": '<"top"iflp<"clear">>rt',
                    "bFilter": false,
                    "bLengthChange": false,
                    "iDisplayLength": 50,
                    "sPaginationType": "simple_numbers",
                    "bProcessing": false,
                    "bServerSide": true,
                    "info": false,
                    "sAjaxSource": url_fpl_list + '/Admin/pilot_list',
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
//                    "sZeroRecords": "No records to display"
                    },
//                'sDom': "lfrtip",
//                    "aaSorting": [[0, 'desc']],
                    "aLengthMenu": [20, 50, 100, 200, 400],
                    "fnDrawCallback": function (oSettings) {
                        $('[rel=popover]').popover({
                            placement: "top",
                            html: true,
                        });
                    },
                     "initComplete": function (settings, json) {
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
            });
        }

        $(".auto_email").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/auto_email",
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
//                get_pilot_data('', ui.item.value);
            }
        });

        $(".auto_mobile").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/auto_mobile",
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
        
        $(".auto_name").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/auto_name",
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
    });
</script>
<div id="page">
    @include('includes.v_header',[])  
    <div id="page">
        <section>
            <div class="container cust-container nopad">				
                <div class="">
                    <div class="row pilots_main">
                        <div class="col-md-12">
                            <div class="form_pilots_top">
                                <div class="col-md-3 p-r-0">
                                    <input type="text" id="aircraft_callsign" name="aircraft_callsign" maxlength="7" class="form-control alpha_numeric text_uppercase" placeholder="call sign">
                                </div>
                                <div class="col-md-3 p-r-0">
                                    <input type="text" id="name" name="name" class="form-control pilot_in_command text_uppercase auto_name" placeholder="PILOT NAME">
                                </div>
                                <div class="col-md-3 p-r-0">
                                    <input type="text" id="email" name="email" class="form-control text_lowercase auto_email" placeholder="email">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" id="mobile_number" name="mobile_number" maxlength="10" class="form-control numeric auto_mobile" placeholder="mobile">
                                </div>
                                <div class="col-md-1 p-l-0">
                                    <button type="button" class="btn newbtnv1 pilots_search" style="line-height:1">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align:center;padding:7px;font-weight: bold">
                            <span class="success" id="success_message"> </span>					
                        </div>
                        <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
                        <div class="filter_pilots_info">
                            <div class="col-md-12">
                                <table id="pilots_info" class="table table-hover table-responsive desk-plan">
                                    <thead>
                                        <tr>
                                            <th class="slno">Sl.No</th>
                                            <th class="dof">Callsign</th>
                                            <th class="calsign">Pilot</th>
                                            <th class="from">Mobile</th>
                                            <th class="from">Email</th>
                                            <th class="to">Pilot</th>
                                            <th class="dpt">Copilot</th>                                         
                                            <th class="weather">Signature</th>	
<!--                                            <th>Status</th>-->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>  
                        @include('includes.ops.edit_pilots')
                        @include('includes.ops.delete_pilots')
                        <!--Fdtl Popup-->
                        <div id="pilots_name_modal" class="modal fade" style="display:none;">
                            <div class="modal-dialog modal-container">
                                <header class="popupHeader"> <span class="header_title">Favourite Notams</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
                                <section class="popupBody editbody" style="padding-top:16px;padding-bottom: 0;">
                                    <div class="user_login">
                                        <div class="row">
                                            <form>
                                                <div class="col-md-9">  
                                                    <div class="row">
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 p-r-0">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button type="button" class="btn newbtnv1 form-control">edit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button type="button" class="btn newbtnv1 form-control">save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>    	
    </div>  
    <input type="hidden" name="date_of_flight" id="date_of_flight" />
    <input type="hidden" name="url" id="url" value="{{url('')}}" />
    @include('includes.v_footer',[])  
</div>
@stop