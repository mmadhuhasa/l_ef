@extends('layouts.backend_layout2',array('1'=>'1'))
@section('content')
<style>
.LR_style{
background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
text-align: center;
padding: 7px 0px 0px 0px;
font-weight: 600;
font-size: 15px;
color: #fff;
font-family: 'pt_sansregular', sans-serif;
}
table.desk-plan tbody tr:nth-child(even):hover td{
background-color: #c9c9c9 !important;
/* border: 1px solid #000 !important; */
}
table.desk-plan tbody tr:nth-child(odd):hover td {
background-color: #c9c9c9 !important;
/* border: 1px solid #000 !important; */
}
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
@media (min-width: 1200px) {
.container {width: 1000px;}
}
.row-hover-style:hover .edit_users{
visibility:visible;
}
.row-hover-style:hover .delete_users{
visibility:visible;
}
.edit_users{
visibility:hidden;
}
.delete_users{
visibility:hidden;
}
.p-l-5 {padding-left: 5px;}
.desk-plan .fa {color:#000;}
.fa-2x {font-size: 1.6em;}
a:hover .fa{ color: red;}
table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc {background : none;}
.form_pilots_top {padding:10px 0;width: 100%;float:left;border:1px solid #ccc;border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);margin-top: 15px;background: #f2f2f2;}
.form_pilots_top input[type="text"] {text-align: center;font-size: 13px;}
.pilots_main {border:1px solid #999;border-radius: 4px; -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);margin-top: 15px;margin-bottom: 15px;background: #fff;}
@media(min-width:992px) {
.pilots_main {position: relative;}
.suc_msg_pos {position:absolute;top: 88px;left: 20%;}
}
.form_pilots_top input[type='text']::-webkit-input-placeholder {color: #222;text-transform: uppercase;font-size: 13px;}
.form_pilots_top input[type='text']:-moz-placeholder { /* Firefox 18- */
color: #222;text-transform: uppercase;font-size: 13px;}
.form_pilots_top input[type='text']::-moz-placeholder {  /* Firefox 19+ */
color: #222;text-transform: uppercase;font-size: 13px;}
.form_pilots_top input[type='text']:-ms-input-placeholder {  
color: #222;text-transform: uppercase;font-size: 13px;}
.btn-search-top {
background: #F26232;
/* background: linear-gradient(to top, #fa9b5b, #F26232); */
background: #f1292b;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f37858', endColorstr='#f1292b');
background: -webkit-gradient(linear, left top, left bottom, from(#f37858), to(#f1292b));
background: -moz-linear-gradient(top, #f37858, #f1292b);
color: #fff;font-size: 14px;font-weight: 300;text-transform: uppercase;text-align: center;vertical-align: middle;border:none;height:32px;}
.btn-search-top:hover {color: #fff;}
table.dataTable thead th, table.dataTable thead td {padding: 10px 8px;}
.width-search {width: 100px;}
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
/*Dropdown*/
.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover{
background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f16844)) !important;
color:#fff;  
}
.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f16844)) !important;
color:#fff;
outline: none;
}
.dropdown-menu>li>a{
font-size: 13px;
}
.dropdown-menu>li:focus{
outline:none!important;
}
.dropdown-menu{
min-width: 145px;    
}
.dropdown-select:focus, .dropdown-select:active{
outline: none;
}
.dropdown-menu:focus, .dropdown-menu:active{
outline: none;
}
.dropdown-toggle:focus, .dropdown-toggle:active{
outline: none!important;    
}
.btn .caret {
margin-left: 5px;
}
/*Dropdown*/
.filter_users {padding: 0 10px;}
.uppercase_text{
text-transform: uppercase;    
}
/*table tr width*/
.weather{
width:9%!important;    
}
.slnumber{
width:3%!important;
}
.roleclass{
width:15%!important;    
}
.nameclass{
width:27%!important;    
}
.adminemailclass {
width:12%!important;     
}
.emailclass {
width:11%!important;     
}
.mobileclass {
width:9%!important;        
}
.operatorclass {
width:14%!important;     
}
/*table tr width*/
/*model open padding right*/
.test[style] {
padding-right:0;
}
.test.modal-open {
overflow: auto;
}
/*model open padding right*/
.popupHeader{
text-align:center;
}
</style>
<script>
    $(function () {
        if ($('#users_info').length > 0) {
            $('#users_info').each(function (e) {
                var url_fpl_list = $("#url").val();
                var date = $("#date_of_flight2").val();
                jQuery.fn.dataTableExt.sErrMode = 'throw';
                jQuery.fn.dataTableExt.oPagination.iFullNumbersShowPages = 10;
                var opt = {
                    "bSort": false, //disable soting of columns
                    "sDom": '<"top"iflp<"clear">>rt',
                    "bFilter": false,
                    "bLengthChange": false,
                    "iDisplayLength": 25,
                    "sPaginationType": "simple_numbers",
                    "bProcessing": false,
                    "bServerSide": true,
                    "info": false,
                    "sAjaxSource": url_fpl_list + '/Admin/user_list',
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
                    createdRow: function (row, data, index) {
                        $(row).addClass("row-hover-style");
                        // $(row).addClass("sumit-warning");
                    },
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
                $(oTable).addClass('myClass');
            });
        }
        $(".auto_email").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/user/auto_email",
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
        $(".auto_mobile").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/user/auto_mobile",
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
        $(".auto_name").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/user/auto_name",
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
        $("#user_role_select").on("change", function () {
            var url = base_url+"/Admin/get_user_details";
            var data = '';
            $("#user_role_select").css("border","#D3D3D3 1px solid !important");
            $.get(url, data, function (data) {
                $(".search_users_info").html(data);
            });
        });
    });
</script>
<div class="page">
    @include('includes.v_header',[])  
    <!--<form enctype="multipart/form-data" action="#" id="user_form" method="Post">-->
    <div id="page">
        <section>
            <div class="container cust-container">				
                <div class="">
                    <div class="row pilots_main">
                        <div class="col-md-12 LR_style">
                            <p class="new_fpl_heading">USERS</p>
                        </div>
                        <div class="col-md-12">
                            <div class="form_pilots_top">
                                <div class="col-md-3 p-r-0" style="width:20%;">
                                    <input type="text" name="operator2" id="operator2" maxlength="30" class="form-control pilot_in_command text_uppercase auto_operator" placeholder="Operator">
                                </div>
                                <div class="col-md-3 p-r-0" style="width:19%;padding-left:10px;">
                                    <input type="text" name="name2" id="name2" maxlength="30" class="form-control pilot_in_command text_uppercase auto_name" placeholder="name">
                                </div>
                                <div class="col-md-3 p-r-0" style="width:22%;padding-left:10px;">
                                    <input type="text" name="email2" id="email2" maxlength="30" class="form-control text_lowercase auto_email" placeholder="email">
                                </div>
                                <div class="col-md-2" style="width:14%;padding-left:10px;padding-right: 10px;">
                                    <input type="text" name="mobile2" id="mobile2" maxlength="10" class="form-control numeric auto_mobile" placeholder="mobile">
                                </div>
                                <!--dropdown-->
                                <div class="dropdown dropdown-select col-md-2" style="width:16%;padding-left:0;padding-right: 10px;">
                                    <button class="btn dropdown-toggle" style="color:#000;background:#fff;width:100%;border:1px solid #999;padding:7px 9px;font-size:13px;" type="button" id="type" data-toggle="dropdown" aria-expanded="true" data-toggle="popover" data-placement="top">
                                            SELECT ROLE
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" id="ultype" style="min-width:90%;" aria-labelledby="dropdownMenu1">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">USER</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">OPERATOR ADMIN</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">EFLIGHT OPS</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)">EFLIGHT ADMIN</a></li>
                                    </ul>
                                </div>
                                <!--dropdown-->
                                <div class="col-md-1 p-l-0">
                                    <button type="button" class="btn newbtnv1 filter_users" data-url="{{url('/Admin/get_user_details')}}">SEARCH</button>
                                </div>
                            </div>
                        </div>                           
                        <div class="col-md-12">
                            <div class="blinkkk" style="text-align: center;
                                 color: red;font-weight: bold">
                                @if(Session::get('success'))
                                <div class="success-left animated infinite zoomIn custdelay">                                                  
                                    <span class="success-font">{{Session::get('success')}}</span>                                                                     
                                </div>
                                @endif
                            </div>
                        </div>
                        <!--<div style="position: absolute;top: 118px;margin-left: 2px;z-index: 999">
                            <div class="col-md-12">
                                <select name="user_role_select" id="user_role_select"  class="form-control">
                                    <option value="" selected>--SELECT ROLE--</option>
                                    <option value="4">USER</option>
                                    <option value="3">OPERATOR ADMIN</option>
                                    <option value="2">EFLIGHT OPS</option>
                                    <option value="1">EFLIGHT ADMIN</option>                       
                                </select>
                            </div>
                        </div>-->
                        <div class="col-md-6 suc_msg_pos" style="text-align:center;padding:7px;">
                            <span class="success" id="success_message"> </span>					
                        </div>
                        <div class="search_users_info">
                            <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:18px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
                            <div class="col-md-12">
                                <table id="users_info" class="table table-hover table-responsive desk-plan" style="margin-bottom: 15px;">
                                    <thead>
                                        <tr>
                                            <th class="slno uppercase_text slnumber">Sl.</th>
                                            <th class="dof uppercase_text nameclass">Name</th>
                                            <th class="calsign uppercase_text emailclass">Email</th>
                                            <th class="from uppercase_text mobileclass">Mobile</th>
                                            <th class="from uppercase_text operatorclass">Operator</th>
                                            <th class="from uppercase_text adminemailclass">Admin Email</th>
                                            <th class="to roleclass">ROLE</th>                                  
                                            <th class="weather"><span style="padding-right: 9px">E</span><span style="padding-left: 6px">D</span></th>
                                        </tr>
                                    </thead>                                  
                                </table>
                            </div>
                        </div>
                        @include('includes.ops.edit_users')
                    </div>
                </div>
            </div>
        </section>    	
    </div>        
<input type="hidden" name="url" id="url" value="{{url('')}}" />
<!--</form>-->
<div id="delete_user" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-container">
        <header class="popupHeader"> <span class="header_title">DELETE USER</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
        <section class="popupBody editbody">
            <div class="user_login">
                <div class="row">
                    <div class="col-md-12">  
                        <p id="fpl_modal_text" class="fpl_modal_text" style="font-weight: bold;font-size: 13px;text-align:center;text-transform:uppercase;">Are you sure want to delete this user?</p>
                    </div>
                </div>
                <div class="row">	
                    <input type="hidden" name="b_user_id" id="b_user_id" />
                    <div class="col-md-12 yesedit fpl_modal_text" style="text-align: center">                       
                        <button type="button"  class="btn newbtnv1 file-btn delete_users_confirm" data-value="" name="flag" value="File">Yes</button>
                    </div>  
                </div>
            </div>
        </section>
    </div>
</div>
@include('includes.v_footer',[])  
</div>
<script>
$('body').on('show.bs.modal',"#delete_user, #user_edit_modal", function (e) {
    $('body').addClass('test');
});
$('.dropdown-select').on( 'click', '.dropdown-menu li a', function() { 
    var target = $(this).html();
    $(this).parents('.dropdown-menu').find('li').removeClass('active');
    $(this).parent('li').addClass('active');
    $(this).parents('.dropdown-select').find('.dropdown-toggle').html(target + '<span class="caret"></span>');
});
Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
new Vue({
    el: "#page",
    data: {aircraft_callsign: ''},
    methods: {
        delete_users: function () {

        }
    }
});
$(document).on('click', ".delete_users", function () {
    var data_value = $(this).attr('data-value');
    $("#b_user_id").val(data_value);
    $("#delete_user").modal();
});
$(document).on('click', ".delete_users_confirm", function (e) {
    var data_value = $("#b_user_id").val();//$(this).attr('data-value');
    var url = base_url + "/Admin/delete_user";
    var data = {'id': data_value};
    $("#delete_user").modal('hide');
    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: data,
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
        success: function (data) {
            window.location = base_url + "/Admin/users"
        }
    });
});
</script>
@stop