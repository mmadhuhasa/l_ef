<script>
    $(function () {


//        $(".add_designation").autocomplete({
//            minLength: 0,
//            source: function (request, response) {
//                console.log('Hi');
//                $.ajax({
//                    type: "GET",
//                    url: base_url + "/Admin/get_designations",
//                    dataType: "json",
//                    data: {
//                        term: request.term.toUpperCase(),
////                    aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
//                    },
//                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
//                    success: function (data) {
//                        response(data);
//
//                    }
//                });
//            },
//            select: function (event, ui) {
//
//            }
//        }).click(function () {
//            $(this).autocomplete('search', $(this).val());
//        });

        $(document).on('click', '.modal_info_class', function () {
            var data_id = $(this).attr('data-id');
            var modal_type = $(this).attr('modal-type');
            var data_text = $("#" + modal_type + data_id).attr('data-text');

            console.log(data_id + ' ' + data_text)
            switch (modal_type) {
                case 'email':
                    $(".header_title").html('Edit Emails');
                    $(".email_message").html(data_text);
                    $(".email_message").attr('data-id', data_id);
                    $(".update_text").attr('modal-type', 'email');
                    $('#edit_email_modal').modal();
                    break;
                case 'mobile_number':
                    $(".header_title").html('Edit Mobile Numbers');
                    $(".mobile_message").html(data_text);
                    $(".mobile_message").attr('data-id', data_id);
                    $(".update_text").attr('modal-type', 'mobile_number');
                    $('#edit_mobile_modal').modal();
                    break;
                default :
                    break;
            }
        });

        $(".update_text").on('click', function () {
            var modal_type = $(this).attr('modal-type');
            var url = base_url + '/Admin/modal_msg_text';
            var designation = $("#designation" + data_id).text();
            var name = $("#name" + data_id).text();
            var mobile_number = $("#mobile_number" + data_id).text();

            switch (modal_type) {
                case 'email' :
                    var modal_msg_text = $(".email_message").text();
                    var data_id = $(".email_message").attr('data-id');
                    var sub_msg_text = modal_msg_text.substring(0, 40);

                    $("#email" + data_id).html(sub_msg_text + " ...");
                    $("#email" + data_id).attr('data-original-title', modal_msg_text);
                    $("#email" + data_id).attr('data-text', modal_msg_text);
                    $.ajax({
                        url: url,
                        data: {'modal_type': modal_type, 'email': modal_msg_text, 'data_id': data_id,
                            'designation': designation, 'name': name},
                        type: 'POST',
                        cache: false,
                        headers: {'X-CSRF-TOKEN': $("meta[name='_token']").attr('content')},
                        success: function (data, textStatus, jqXHR) {
                            $("#success_message").html("<span style='color:green'>Info updated successfully</span>");
                        },
                        error: function (jqXHR, textStatus, errorThrown) {

                        }
                    });
                    $('#edit_email_modal').modal('hide');
                    break;
                case 'mobile_number' :
                    var modal_msg_text = $(".mobile_message").text();
                    var data_id = $(".mobile_message").attr('data-id');
                    var sub_msg_text = modal_msg_text.substring(0, 25);
                    $("#mobile_number" + data_id).html(sub_msg_text + " ...");
                    $("#mobile_number" + data_id).attr('data-original-title', modal_msg_text);
                    $("#mobile_number" + data_id).attr('data-text', modal_msg_text);
                    $.ajax({
                        url: url,
                        data: {'modal_type': modal_type, 'mobile_number': modal_msg_text, 'data_id': data_id,
                            'designation': designation, 'name': name},
                        type: 'POST',
                        cache: false,
                        headers: {'X-CSRF-TOKEN': $("meta[name='_token']").attr('content')},
                        success: function (data, textStatus, jqXHR) {
                            $("#success_message").html("<span style='color:green'>Info updated successfully</span>");
                        },
                        error: function (jqXHR, textStatus, errorThrown) {

                        }
                    });
                    $('#edit_mobile_modal').modal('hide');
                    break;
            }
        });

        $(".info_edit").on('blur', function () {
            var aircraft_callsign = $("#aircraft_callsign").val();
            var departure_aerodrome = $("#departure_aerodrome").val();
            var data_id = $(this).attr('data-id');
            var data_value = $(this).attr('data-value');
            var url = base_url + '/Admin/save_callsign_info';
            $this = $(this);

            if (data_id != '') {
                var designation = $("#designation" + data_id).text();
                var name = $("#name" + data_id).text();
                var email = $("#email" + data_id).text();
                var mobile_number = $("#mobile_number" + data_id).text();
                var data = {'aircraft_callsign': aircraft_callsign, 'departure_aerodrome': departure_aerodrome,
                    'designation': designation, 'name': name, 'email': email, 'mobile_number': mobile_number, 'data_id': data_id};
            } else {
                var designation = $("#designation" + data_value).text();
                var name = $("#name" + data_value).text();
                var email = $("#email" + data_value).text();
                var mobile_number = $("#mobile_number" + data_value).text();
                var data = {'aircraft_callsign': aircraft_callsign, 'departure_aerodrome': departure_aerodrome,
                    'designation': designation, 'name': name, 'email': email, 'mobile_number': mobile_number};
            }

            if (name != '' && email != '' && mobile_number != '') {
                if (confirm('Do you wish to update info ?')) {
                    $("#success_message").html("<span style='color:green'><a href=''><i class='fa fa-spinner fa-spin'></i></a> Processing ...</span>");
                    $.ajax({
                        url: url,
                        data: data,
                        type: 'POST',
                        cache: false,
                        headers: {'X-CSRF-TOKEN': $("meta[name='_token']").attr('content')},
                        success: function (data, textStatus, jqXHR) {
                            var data_id = data.data_id;
                            var new_id = data.new;
                            if (new_id != '') {
                                $("#designation" + data_value).attr('data-id', data_id);
                                $("#name" + data_value).attr('data-id', data_id);
                                $("#name" + data_value).attr('id', 'name' + data_id);
                                $("#designation" + data_value).attr('id', 'designation' + data_id);
//                                $("#email" + data_value).removeClass('content_edit');
//                                $("#mobile_number" + data_value).removeClass('content_edit');
//                                $("#email" + data_value).removeAttr('contenteditable')
//                                $("#mobile_number" + data_value).removeAttr('contenteditable')

                                $("#mobile_number" + data_value).html('<span href="#" id="mobile_number' + data_id + '" data-id ="' + data_id + '" class="content_mobile modal_info_class" modal-type="mobile_number" data-text ="' + mobile_number + '" data-toggle="tooltip" title="' + mobile_number + '" data-placement="bottom">' + mobile_number + '</span>');
                                $("#email" + data_value).html('<span href="#" id="email' + data_id + '" data-id ="' + data_id + '" class="content_mobile modal_info_class" modal-type="email" data-text ="' + email + '" data-toggle="tooltip" title="' + email + '" data-placement="bottom">' + email + '</span>');

                                $("#success_message").html("<span style='color:green'>Info updated successfully</span>");
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {

                        }
                    })
                }
            }
        });

        $(".handlers_edit").on('blur', function () {
            var aircraft_callsign = $("#aircraft_callsign").val();
            var departure_aerodrome = $("#departure_aerodrome").val();
            var data_id = $(this).attr('data-id');

            var url = base_url + '/Admin/save_callsign_handlers';
            var designation = $("#designation11" + data_id).text();
            var name = $("#name11").text();
            var email = $("#email11").text();
            var mobile_number = $("#mobile_number11").text();

            var data = {'aircraft_callsign': aircraft_callsign, 'departure_aerodrome': departure_aerodrome,
                'name': name, 'email': email, 'mobile_number': mobile_number, 'data_id': data_id};

            console.log(data)

            if (name != '' && email != '' && mobile_number != '') {
                if (confirm('Do you wish to update info ?')) {
                    $("#success_message").html("<span style='color:green'><a href=''><i class='fa fa-spinner fa-spin'></i></a> Processing ...</span>");
                    $.ajax({
                        url: url,
                        data: data,
                        type: 'POST',
                        cache: false,
                        headers: {'X-CSRF-TOKEN': $("meta[name='_token']").attr('content')},
                        success: function (data, textStatus, jqXHR) {
                            $("#success_message").html("<span style='color:green'>Info updated successfully</span>");
                        },
                        error: function (jqXHR, textStatus, errorThrown) {

                        }
                    });
                }
            }
        });
        $(".edit_info").on('click', function () {
            var id = $(this).attr('data-id');
            var data_value = $(this).attr('data-value');
            var data_url = $(this).attr('data-url') + '/' + id;
            var data = {'id': id, 'data_value': data_value};
            $("#data_value").val(data_value);
            var aircraft_callsign = $("#aircraft_callsign").val();
            if (id) {
                $.ajax({
                    url: data_url,
                    type: 'GET',
                    data: data,
                    dataType: 'json',
                    cache: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    success: function (data, textStatus, jqXHR) {
                        var aircraft_callsign = data.response.aircraft_callsign;
                        console.log(aircraft_callsign)
                        $("#aircraft_callsign2").val(aircraft_callsign)
                        $("#designation").val(data.designation);
                        $("#mobile_number").val(data.response.mobile_number)
                        $("#name").val(data.response.name)
                        $("#email").val(data.response.email)
                        $("#is_pilot").val(data.response.is_pilot)
                        $("#is_copilot").val(data.response.is_copilot)
                        $("#is_active").val(data.response.is_active)
                        $("#signature").html(data.signature)
                        $("#id").val(data.response.id);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    },
                    async: false
                });
            } else {
                $("#aircraft_callsign2").val(aircraft_callsign)
                $("#designation").val('')
                $("#mobile_number").val('')
                $("#name").val('')
                $("#email").val('')
                $("#is_pilot").val('')
                $("#is_copilot").val('')
                $("#is_active").val('')
                $("#signature").val('');
                $("#id").val('');
            }
            $("#info_modal").modal()
        });
        $(".delete_info").on('click', function () {
            var id = $(this).attr('data-id');
            var aircraft_callsign = $(this).attr('data-callsign');
            $(".aircraft").html(aircraft_callsign);
            console.log('id ', id)
            $(".delete_info_confirm").attr('data-value', id);
            $("#delete_info_modal").modal();
        });

        $(".delete_info_confirm").on('click', function () {
            var id = $(this).attr('data-value');
            var url = $(this).attr('data-url') + '/' + id;
            var data = {'id': id};
            $("#delete_info_modal").modal('hide');
            $(".success").html('<span style="color:black"><a><i class="fa fa-spinner fa-spin" style="color:red"></i> Processing ...</a></span>');
            $.ajax({
                url: url,
                data: data,
                type: 'DELETE',
                cache: false,
                headers: {'X-CSRF-TOKEN': $("meta[name='_token']").attr('content')},
                success: function (data, textStatus, jqXHR) {
                    console.log(data + id)
                    if (data.STATUS_CODE == 1 && data.STATUS_DESC != '') {
                        $(".success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">Info deleted successfully</p>')
                        $("#row" + id).remove();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR)
                }
            });
        });

    });
</script>

<div class="table-responsive tableviewclass">
    <table class="table table-bordered m-0">
        <thead class="table-inverse">
            <tr>
            <tr>
                <th class="sno">SI</th>
                <th class="info_desig">Designation</th>
                <th class="info_name">Name</th>
                <th class="info_email">Email</th>
                <th class="info_mob">Mobile</th>
                <!--<th>Fpl</th>-->
                <th class="info_icon"></th>
            </tr>
            </tr>
        </thead>
        <?php
        $callsign_info_count = count($callsign_info);
        $callsign_info_count2 = 15 - $callsign_info_count;
//	$departure_aerodrome = ($callsign_handlers) ? $callsign_handlers->aerodrome : '';
        $handlers_name = ($callsign_handlers) ? $callsign_handlers->name : '';
        $handlers_email = ($callsign_handlers) ? $callsign_handlers->email : '';
        $handlers_mobile_number = ($callsign_handlers) ? $callsign_handlers->mobile_number : '';
        $handler_id = ($callsign_handlers) ? $callsign_handlers->id : '';
        $departure_only = ($callsign_handlers) ? $callsign_handlers->departure_only : '';
        $destination_only = ($callsign_handlers) ? $callsign_handlers->destination_only : '';
        $i = 1;
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
                <td id="designation{{$id}}" data-id ="{{$id}}" style="cursor: pointer" data-value="" class="font_bold_14 pointer info_edit add_designation {{$company_color}}">{{$designation_name}}</td>
                <td id="name{{$id}}" data-value="" data-id ="{{$id}}" class="font_bold_14 content_edit info_edit {{$company_color}}" >{{$callsign_data->name}}</td>
                <td id="email{{$i}}" data-value="" data-id ="{{$id}}" class="font_bold_14"><span href="#" id="email{{$id}}"  data-id ="{{$id}}" class="content_emails {{$company_color}}" modal-type="email" data-text ="{{$emails}}" data-toggle="tooltip" title="{{$emails}}" data-placement="bottom">{{($callsign_data->email) ? str_limit($callsign_data->email,40): '---'}}</span></td>
                <td id="mobile_number{{$i}}" data-value="" data-id ="{{$id}}" class="font_bold_14 {{$company_color}}" ><span href="#" id="mobile_number{{$id}}" data-id ="{{$id}}" class="content_mobile" modal-type="mobile_number" data-text ="{{$mobile_numbers}}" data-toggle="tooltip" title="{{$mobile_numbers}}" data-placement="bottom">{{(($callsign_data->mobile_number)) ? str_limit($callsign_data->mobile_number,12) : '0'}}</span></td>
                <!--<td><input type="checkbox" name="is_fpl{{$id}}" id="is_fpl{{$id}}" data-value="" data-type='fpl' data-id ="{{$id}}" class="info_check"  {{($is_fpl) ? "checked='checked'" : ''}} /></td>-->
                <!-- <td><a class="pi_edit_button" href="#"></a></td> -->
                <td align="center">
                    <a class="ai_edit_icon edit_info pointer" data-url="info" data-id="{{$id}}" data-value=""><i class="p-r-5 fa fa-edit"></i></a>
                    <a class="ai_trash_icon pointer delete_info" data-callsign="{{$aircraft_callsign}}" data-url="info" data-id="{{$id}}" data-value="" ><i class=" fa fa-trash"></i></a>
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach
            
            <?php $id = "new" ?>
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
<!--<div class="table-responsive tableviewclass m-t-20">
    <table class="table table-bordered m-0">
        <thead class="table-inverse">
            <tr>
                <th class="sno">SI</th>
                <th class="desig">Airport</th>
                <th class="name">Name</th>
                <th class="info_email">Email</th>
                <th class="mob">Mobile</th>
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
                    <a class="ai_edit_icon" href=""><i class="p-r-5 fa fa-edit"></i></a>
                    <a class="ai_trash_icon" href="#"><i class=" fa fa-trash"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
</div> end of pilots information -->