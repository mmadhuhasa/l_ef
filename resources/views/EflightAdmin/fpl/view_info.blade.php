@extends('layouts.backend_layout2',array('1'=>'1'))
@section('content')
<link rel="stylesheet" href="{{url('app/new_temp/css/animate.css')}}">
<style>
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
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 5px 8px;
    }
    .ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content{
        width: 225px;
        z-index: 9999 !important;
    }
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
    .delete_tooltip {
        right: -10px;
    }
    .edit_rel:hover .edit_tooltip, .delete_rel:hover .delete_tooltip {
        visibility: visible;
    }
    .fa-edit, .fa-trash {font-size: 1.1em;}
    .font_bold_14{
        font-weight: bold;
        font-size: 14px;
    }
    .bold{
        font-weight: bold
    }
</style>

<script>

</script>

<div class="page" id="app">
    @include('includes.v_header',[])
    <main>
        <section class="bg-1 welcome infopage">
            <div class="container">
                <div class="row">
                    <div class="callsign-sec">
                        <div class="col-xs-12 col-md-12">
                            <form method="post" id="info_form">
                                <div class="infor-row">

                                    <div class="col-md-2 p-l-0">
                                        <div class="col-md-9 p-l-0 p-r-5 text-center">
                                            <label style="text-transform: uppercase;font-size: 11px;margin-bottom: 0;font-weight: normal;">call sign</label>
                                            <input type="text" value="{{$aircraft_callsign}}" id="aircraft_callsign" v-model="aircraft_callsign" @keyup="callsign_keyup" minlength="5" maxlength="7" class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip" placeholder="Call Sign">
                                        </div>
                                        <div class="col-md-3 p-l-0">
                                            <label style="visibility:hidden;margin-bottom: 0;">nolabel</label>
                                            <button type="button"  class="btn get_callsign_info newbtnv1" style="width:40px;height:34px"><span class="glyphicon glyphicon-search"></span></button>
                                        </div>
                                    </div>
                                    @if(Session::get('success'))				   				    
                                    <div class="col-md-8" style="text-align:center;padding:7px;font-weight: bold"><span class="success" id="success_message">
                                            <p class="success animated  zoomIn custdelay" style="text-align: center;color:red">{{Session::get('success')}}</p></span></div>					
                                    @else
                                    <div class="col-md-8" style="text-align:center;padding:7px;font-weight: bold;margin-top: 20px;">
                                        <span class="success" id="success_message">
                                            DISPLAYING TESTA CALL SIGN INFO
                                        </span>
                                    </div>
                                    @endif
                                    <div class="col-md-2 p-r-0">
<!--                                        <div class="col-md-9 p-l-0 p-r-5 text-center">
                                            <label style="text-transform: uppercase;font-size: 11px;margin-bottom: 0;font-weight: normal;">AIRPORT</label>
                                            <input type="text" id="departure_aerodrome" value="VOPC" minlength="4" maxlength="4"  class="alpha_numeric text-center font-bold text_uppercase form-control modtooltip" placeholder="Airport">
                                        </div>-->
<!--                                        <div class="col-md-3 p-l-0">
                                            <label style="visibility:hidden;margin-bottom: 0;">nolabel</label>
                                            <button type="button"  class="btn get_callsign_handlers get_callsign_info newbtnv1" style="width:40px;height:34px"><span class="glyphicon glyphicon-search"></span></button>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div id="result">
                                    <div class="table-responsive tableviewclass">
                                        <table class="table table-bordered m-0">
                                            <thead class="table-inverse">
                                                <tr>
                                                    <th class="sno">SI</th>
                                                    <th class="info_desig">Designation</th>
                                                    <th class="info_name">Name</th>
                                                    <th class="info_email">Email</th>
                                                    <th class="info_mob">Mobile</th>
                                                    <!--<th>Fpl</th>-->
                                                    <th class="info_icon"></th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $callsign_info_count = count($callsign_info);
                                            $callsign_info_count2 = 15 - $callsign_info_count;
                                            $departure_aerodrome = ($callsign_handlers) ? $callsign_handlers->aerodrome : '';
                                            $handlers_name = ($callsign_handlers) ? $callsign_handlers->name : '';
                                            $handlers_email = ($callsign_handlers) ? $callsign_handlers->email : '';
                                            $handlers_mobile_number = ($callsign_handlers) ? $callsign_handlers->mobile_number : '';
                                            $handler_id = ($callsign_handlers) ? $callsign_handlers->id : '';
                                            $departure_only = ($callsign_handlers) ? $callsign_handlers->departure_only : '';
                                            $destination_only = ($callsign_handlers) ? $callsign_handlers->destination_only : '';
                                            $i = 1;
                                            $id = 0;
                                            ?>
                                            <tbody>
                                                @foreach($callsign_info as $callsign_data)
                                                <?php
                                                $emails = ($callsign_data->email) ? str_replace(",", ", ", $callsign_data->email) : '---';
                                                $mobile_numbers = ($callsign_data->mobile_number) ? str_replace(",", ", ", $callsign_data->mobile_number) : '0';
                                                $designation = ($callsign_data) ? $callsign_data->designation : '';
                                                $designation_data = App\models\DesignationModel::where('id', $designation)->first();
                                                $designation_name = ($designation_data) ? $designation_data->name : 0;
                                                $id = $callsign_data->id;
                                                $is_fpl = $callsign_data->is_fpl;
                                                $is_active = $callsign_data->is_active;
                                                $company_color = ($is_active == 1) ? "" : 'company_color';
                                                ?>
                                                <tr id="row{{$id}}">
                                                    <td>{{$i}}</td>
                                                    <td id="designation{{$id}}" data-id ="{{$id}}" style="cursor: pointer" data-value="" class="font_bold_14 pointer info_edit content_designation {{$company_color}}">{{$designation_name}}</td>
                                                    <td id="name{{$id}}" data-value="" data-id ="{{$id}}" class="font_bold_14 content_edit info_edit {{$company_color}}" >{{$callsign_data->name}}</td>
                                                    <td id="email{{$id}}" data-value="" data-id ="{{$id}}" class="font_bold_14"><span href="#" id="email{{$id}}"  data-id ="{{$id}}" class="content_emails {{$company_color}}" modal-type="email" data-text ="{{$emails}}" data-toggle="tooltip" title="{{$emails}}" data-placement="bottom">{{($callsign_data->email) ? str_limit($callsign_data->email,40): '---'}}</span></td>
                                                    <td id="mobile_number{{$id}}" data-value="" data-id ="{{$id}}" class="font_bold_14 {{$company_color}}" ><span href="#" id="mobile_number{{$id}}" data-id ="{{$id}}" class="content_mobile" modal-type="mobile_number" data-text ="{{$mobile_numbers}}" data-toggle="tooltip" title="{{$mobile_numbers}}" data-placement="bottom">{{(($callsign_data->mobile_number)) ? str_limit($callsign_data->mobile_number,12) : '0'}}</span></td>
                                                    <!--<td><input type="checkbox" name="is_fpl{{$id}}" id="is_fpl{{$id}}" data-value="" data-type='fpl' data-id ="{{$id}}" class="info_check"  {{($is_fpl) ? "checked='checked'" : ''}} /></td>-->
                                                    <!-- <td><a class="pi_edit_button" href="#"></a></td> -->
                                                    <td align="center">
                                                        <div class="edit_rel">
                                                            <a class="ai_edit_icon edit_info pointer" data-url="info" data-id="{{$id}}" data-value=""><i class="p-r-5 fa fa-edit"></i></a>
                                                            <div class="edit_tooltip">edit</div>
                                                        </div>
                                                        <div class="delete_rel">
                                                            <a class="ai_trash_icon pointer delete_info" data-callsign="{{$aircraft_callsign}}" data-url="info" data-id="{{$id}}" data-value="" ><i class=" fa fa-trash"></i></a>
                                                            <div class="delete_tooltip">delete</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                                @endforeach
                                                @if($callsign_info_count2 > 0)
                                                @for($j = 0;$j<$callsign_info_count2;$j++)
                                                <tr>
                                                    <td>{{$i + $j}}</td>
                                                    <td id="designation{{$id + $i + $j}}" data-value="{{$id + $i + $j}}" data-id ="" class="content_designation">Select Designation</td>
                                                    <td id="name{{$id + $i + $j}}" data-value="{{$id + $i + $j}}" data-id ="" class="content_edit info_edit"></td>
                                                    <td id="email{{$id + $i + $j}}" data-value="{{$id + $i + $j}}" data-id ="" class="info_edit content_edit"></td>
                                                    <td id="mobile_number{{$id + $i + $j}}" data-value="{{$id + $i + $j}}" data-id ="" class="info_edit content_edit numeric " /></td>
                                                    <!--<td><input type="checkbox" name="is_fpl{{$i + $j}}" id="is_fpl{{$i + $j}}" data-id ="" data-type='fpl' data-value="{{$i + $j}}" class="info_check" /></td>-->
                                                    <td>
                                                        <div class="edit_rel">
                                                            <a class="ai_edit_icon edit_info pointer"  data-url="info" data-id=""  data-value="{{$id + $i + $j}}" ><i class="p-r-5 fa fa-edit"></i></a>
                                                            <div class="edit_tooltip">edit</div>
                                                        </div>
                                                        <div class="delete_rel">
                                                            <a class="ai_trash_icon pointer delete_info" data-url="info" data-id="" data-value="{{$id + $i + $j}}" ><i class=" fa fa-trash"></i></a>
                                                            <div class="delete_tooltip">delete</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endfor
                                                @endif
                                            </tbody>
                                        </table>
                                    </div><!-- end of pilots information -->
<!--                                    <div class="table-responsive tableviewclass m-t-20">
                                        <table class="table table-bordered m-0">
                                            <thead class="table-inverse">
                                                <tr>
                                                    <th class="sno">SI</th>
                                                    <th class="info_desig">Airport</th>
                                                    <th class="info_name">Handler Company/Name</th>
                                                    <th class="info_email">Email</th>
                                                    <th class="info_mob">Mobile</th>
                                                    <th class="info_icon"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td id="departure_aerodrome2" data-id="{{$handler_id}}" class="content_edit handlers_edit">{{$departure_aerodrome}}</td>
                                                    <td id="name11" data-id="{{$handler_id}}" class="content_edit handlers_edit">{{$handlers_name}}</td>
                                                    <td id="email11" data-id="{{$handler_id}}" class="content_edit handlers_edit">{{$handlers_email}}</td>
                                                    <td id="mobile_number11" data-id="{{$handler_id}}" class="content_edit handlers_edit">{{$handlers_mobile_number}}</td>
                                                    <td>
                                                        <div class="edit_rel">
                                                            <a class="ai_edit_icon" href=""><i class="p-r-5 fa fa-edit"></i></a>
                                                            <div class="edit_tooltip">edit</div>
                                                        </div>
                                                        <div class="delete_rel">
                                                            <a class="ai_trash_icon" href="#"><i class=" fa fa-trash"></i></a>
                                                            <div class="delete_tooltip">delete</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> end of pilots information -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- edit mail modal-->
    <div class="modal fade" id="edit_email_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-container" role="document">
            <header class="popupHeader">
                <span class="header_title"></span>
                <span class="modal_close" data-dismiss="modal">
                    <i class="fa fa-times-circle"></i>
                </span>
            </header>
            <section class="popupBody">
                <form action="#" id="" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="model_font">
                                <div  contenteditable="true" class="email_message"></div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="confrow">
                            <div class="col-md-6">
                                <button type="button" class="process btn btn_secondary update_text">Update</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn process noprocess" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <!-- edit mail modal-->

    <!-- edit mobile modal-->
    <div class="modal fade" id="edit_mobile_modal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-container" role="document">
            <header class="popupHeader">
                <span class="header_title"></span>
                <span class="modal_close" data-dismiss="modal">
                    <i class="fa fa-times-circle"></i>
                </span>
            </header>
            <section class="popupBody">
                <form action="#" id="" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="model_font">
                                <div  contenteditable="true" class="mobile_message"></div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="confrow">
                            <div class="col-md-6">
                                <button type="button" class="process btn btn_secondary update_text">Update</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn process noprocess" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <!-- edit mobile modal-->

    <!-- edit info modal -->
    @include('includes.ops.edit_info',[])
    @include('includes.ops.delete_info',[])

    @include('includes.v_footer',[])
</div>
<script>
    $("#name").keyup(function(){
        console.log($(this).val().length);
        if($(this).val().length>=2){
             $("#name").popover('destroy');
             $("#name").css('border', '1px solid #555');
         }
        else{
            $("#name").attr('data-content', 'Min. 2 & Max. 25 character allowed');
            $("#name").popover({trigger: 'hover'});
            $("#name").css('border', 'red solid 1px');
        }
    });
    $("#is_active").change(function() {
        $("#is_active").popover('destroy');
        $("#is_active").css('border', '1px solid #555');
    });
    $("#designation").keyup(function(){
        if ($("#designation").val() == "" || $("#designation").val().length < 2)
        {
            $("#designation").attr('data-content', 'Min. 2 & Max. 25 character allowed');
            $("#designation").popover({trigger: 'hover'});
            $("#designation").css('border', 'red solid 1px');
        }
        else if ($("#designation").val() != "PILOT" && $("#designation").val() != "CO-PILOT" && $("#designation").val() != "CABIN CREW" && $("#designation").val() != "OPS STAFF" && $("#designation").val() != "ADMIN MANAGER"){
            $("#designation").attr('data-content', 'INVALID DESIGNATION');
            $("#designation").popover({trigger: 'hover'});
            $("#designation").css('border', 'red solid 1px');
        }
        else{
          $("#designation").popover('destroy');
          $("#designation").css('border', '1px solid #555');  
        }
    });

    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
    new Vue({
        el: "#app",
        data: {aircraft_callsign: ''},
        methods: {
            callsign_keyup: function () {
                if (this.aircraft_callsign.length <= 4) {
                    $("#aircraft_callsign").css('border', '1px solid red')
                } else {
                    $("#aircraft_callsign").css('border', '1px solid lightgrey')
                }
            },
            valid_info: function (e) {
                e.preventDefault();
                var bool=true;
                $("#mobile_number").css('border', '1px solid #555');
                if ($("#name").val() == "" || $("#name").val().length < 2)
                {
                    $("#name").attr('data-content', 'Min. 2 & Max. 25 character allowed');
                    $("#name").popover({trigger: 'hover'});
                    $("#name").css('border', 'red solid 1px');
                    bool = false;
                }
                if ($("#is_active").val() == null)
                {
                    $("#is_active").attr('data-content', 'Please Select Status');
                    $("#is_active").popover({trigger: 'hover'});
                    $("#is_active").css('border', 'red solid 1px');
                    bool = false;
                }
                if ($("#designation").val() == "" || $("#designation").val().length < 2)
                {
                    $("#designation").attr('data-content', 'Min. 2 & Max. 25 character allowed');
                    $("#designation").popover({trigger: 'hover'});
                    $("#designation").css('border', 'red solid 1px');
                    bool = false;
                }
                else if ($("#designation").val() != "PILOT" && $("#designation").val() != "CO-PILOT" && $("#designation").val() != "CABIN CREW" && $("#designation").val() != "OPS STAFF" && $("#designation").val() != "ADMIN MANAGER"){
                    $("#designation").attr('data-content', 'INVALID DESIGNATION');
                    $("#designation").popover({trigger: 'hover'});
                    $("#designation").css('border', 'red solid 1px');
                    bool = false;
                }
                if(bool==false)
                    return bool;
                var data_url = $("#pilots_form").attr('data-url');
                var formdata = $("#pilots_form").serializeArray();
                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                $("#info_modal").modal('hide');
                $(".success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body.STATUS_CODE == 1) {
                        console.log('KK ',data.body.data_result)
                        $(".success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + data.body.STATUS_DESC + '</p>');
                        $("#designation"+data.body.data_result.data_value).html("<span class='bold'>"+data.body.data_result.designation+"</span>");
                        $("#mobile_number"+data.body.data_result.data_value).html("<span class='bold'>"+data.body.data_result.mobile_number+"</span>")
                        $("#name"+data.body.data_result.data_value).html("<span class='bold'>"+data.body.data_result.name+"</span>")
                        $("#email"+data.body.data_result.data_value).html("<span class='bold'>"+data.body.data_result.email+"</span>")
                    }
                    else if(data.body.STATUS_CODE == 0){
                        $(".success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + data.body.STATUS_DESC + '</p>');
                    }
                })
            },
        }
    });
</script>
@stop