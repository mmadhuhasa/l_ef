$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

//    $(".edit_info").on('click', function () {
//        $(".content_edit").attr('contenteditable', true);
        // $(".content_designation").addClass('add_designation');
//        $(".content_emails").addClass('modal_info_class');
//        $(".content_mobile").addClass('modal_info_class');
//    });

    $(".add_designation").autocomplete({
        minLength: 0,
        source: function (request, response) {
            console.log('Hi');
            $.ajax({
                type: "GET",
                url: base_url + "/Admin/get_designations",
                dataType: "json",
                data: {
                    term: request.term.toUpperCase(),
                    //                    aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    response(data);

                }
            });
        },
        select: function (event, ui) {
          console.log("Designation select")  
          $("#designation").popover('destroy');
          $("#designation").css('border', '1px solid #555');
        }
    }).click(function () {
        $(this).autocomplete('search', $(this).val());
    });

    $(document).on('click', ".page", function () {
        $(".ui-menu-item").hide();
    });

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
            default:
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
            case 'email':
                var modal_msg_text = $(".email_message").text();
                var data_id = $(".email_message").attr('data-id');
                var sub_msg_text = modal_msg_text.substring(0, 25);

                $("#email" + data_id).html(sub_msg_text + " ...");
                $("#email" + data_id).attr('data-original-title', modal_msg_text);
                $("#email" + data_id).attr('data-text', modal_msg_text);
                $.ajax({
                    url: url,
                    data: {
                        'modal_type': modal_type,
                        'email': modal_msg_text,
                        'data_id': data_id,
                        'designation': designation,
                        'name': name
                    },
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
            case 'mobile_number':
                var modal_msg_text = $(".mobile_message").text();
                var data_id = $(".mobile_message").attr('data-id');
                var sub_msg_text = modal_msg_text.substring(0, 25);
                $("#mobile_number" + data_id).html(sub_msg_text + " ...");
                $("#mobile_number" + data_id).attr('data-original-title', modal_msg_text);
                $("#mobile_number" + data_id).attr('data-text', modal_msg_text);
                $.ajax({
                    url: url,
                    data: {
                        'modal_type': modal_type,
                        'mobile_number': modal_msg_text,
                        'data_id': data_id,
                        'designation': designation,
                        'name': name
                    },
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

    $(".get_callsign_info").on('click', function () {
        var aircraft_callsign = $("#aircraft_callsign").val();
        var departure_aerodrome = $("#departure_aerodrome").val();
        $(".success").html('<span><a><i style="color:red" class="fa fa-spinner fa-spin"></i></a> Please wait ...</p>');
        $.ajax({
            type: "POST",
            url: base_url + "/Admin/get_callsign_info",
            data: {'aircraft_callsign': aircraft_callsign, 'departure_aerodrome': departure_aerodrome},
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data) {
                $("#result").html(data);
                 $(".success").html('<p class="success animated  zoomIn custdelay">DISPLAYING '+ aircraft_callsign +' CALL SIGN INFO</p>');
            }
        });
    });

    $(document).on('click', "#save_callsign_info", function () {
        var aircraft_callsign = $("#aircraft_callsign").val();
        var departure_aerodrome = $("#departure_aerodrome").val();
        var designation = [];
        var name = [];
        var email = [];
        var mobile_number = [];
        var url = base_url + '/Admin/info'
        for (var i = 1; i <= 11; i++) {
            designation.push($("#designation" + i).text());
            name.push($("#name" + i).text());
            email.push($("#email" + i).text());
            mobile_number.push($("#mobile" + i).text());
        }
        var data = {
            'aircraft_callsign': aircraft_callsign,
            'departure_aerodrome': departure_aerodrome,
            'designation': designation,
            'name': name,
            'email': email,
            'mobile_number': mobile_number
        };
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
        })
    });

    $(".info_edit").on('blur', function () {
        var aircraft_callsign = $("#aircraft_callsign").val();
        var departure_aerodrome = $("#departure_aerodrome").val();
        var data_id = $(this).attr('data-id');
        var data_value = $(this).attr('data-value');
        var url = base_url + '/Admin/save_callsign_info';
        $this = $(this);

        if (data_id != '') {
            console.log('Hiii')
            var designation = $("#designation" + data_id).text();
            var name = $("#name" + data_id).text();
            var email = $("#email" + data_id).text();
            var mobile_number = $("#mobile_number" + data_id).text();

            var data = {
                'aircraft_callsign': aircraft_callsign,
                'departure_aerodrome': departure_aerodrome,
                'designation': designation,
                'name': name,
                'email': email,
                'mobile_number': mobile_number,
                'data_id': data_id
            };

        } else {
            console.log('Hiii212')
            var designation = $("#designation" + data_value).text();
            var name = $("#name" + data_value).text();
            var email = $("#email" + data_value).text();
            var mobile_number = $("#mobile_number" + data_value).text();

            var data = {
                'aircraft_callsign': aircraft_callsign,
                'departure_aerodrome': departure_aerodrome,
                'designation': designation,
                'name': name,
                'email': email,
                'mobile_number': mobile_number
            };
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
                            $("#is_fpl" + data_value).attr('data-id', data_id);
//                            $("#email" + data_value).removeClass('content_edit');
//                            $("#mobile_number" + data_value).removeClass('content_edit');
//                            $("#email" + data_value).removeAttr('contenteditable')
//                            $("#mobile_number" + data_value).removeAttr('contenteditable')

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

        var data = {
            'aircraft_callsign': aircraft_callsign,
            'departure_aerodrome': departure_aerodrome,
            'name': name,
            'email': email,
            'mobile_number': mobile_number,
            'data_id': data_id
        };

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

    $(".info_check").on('change', function () {
        var aircraft_callsign = $("#aircraft_callsign").val();
        var departure_aerodrome = $("#departure_aerodrome").val();
        var data_id = $(this).attr('data-id');
        var data_value = $(this).attr('data-value');
        var url = base_url + '/Admin/checkbox_info';
        var is_fpl_checked = false;
        var type = $(this).attr('data-type');

        if (type == 'fpl') {
            is_fpl_checked = ($(this).is(':checked')) ? 1 : 0;
        }
        if (data_id != '') {
            console.log('Hiii')
            var designation = $("#designation" + data_id).text();
            var name = $("#name" + data_id).text();
            var email = $("#email" + data_id).text();
            var mobile_number = $("#mobile_number" + data_id).text();
            var data = {
                'aircraft_callsign': aircraft_callsign,
                'departure_aerodrome': departure_aerodrome,
                'designation': designation,
                'name': name,
                'email': email,
                'mobile_number': mobile_number,
                'data_id': data_id,
                'type': type,
                'is_fpl_checked': is_fpl_checked
            };
        }
        if (name != '' && email != '' && mobile_number != '') {
            //            if (confirm('Do you wish to update info ?')) {
            $("#success_message").html("<span style='color:green'><a href=''><i class='fa fa-spinner fa-spin'></i></a> Processing ...</span>");
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                cache: false,
                headers: {'X-CSRF-TOKEN': $("meta[name='_token']").attr('content')},
                success: function (data, textStatus, jqXHR) {
                    console.log(data)
                    $("#success_message").html("<span style='color:green'>Info updated successfully</span>");
                },
                error: function (jqXHR, textStatus, errorThrown) {}
            })
            //            }
        }
    });


    $(".edit_info").on('click', function () {
        $("#name,#designation,#is_active").popover('destroy');
        $("#name,#is_active,#designation").css('border', '1px solid #555');
        var id = $(this).attr('data-id');
        var data_value = $(this).attr('data-value');
        var data_url = $(this).attr('data-url') + '/' + id;
        var data = {'id': id, 'data_value': data_value};
        var aircraft_callsign = $("#aircraft_callsign").val();
         $("#data_value").val(data_value);
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
                   
                    console.log(data.response.is_active)
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


//    $(".fpl_check").on('change', function () {
//        var aircraft_callsign = $("#aircraft_callsign").val();
//        var departure_aerodrome = $("#departure_aerodrome").val();
//        var data_id = $(this).attr('data-id');
//        var data_value = $(this).attr('data-value');
//        var url = base_url + '/Admin/checkbox_info';
//        var is_checked = $(this).is(':checked');
//        console.log(is_checked)
//        var data = {'type': 'fpl', 'data_value': data_value, 'data_id': data_id};
//
//        if (data_id != '') {
//            console.log('Hiii')
//            var designation = $("#designation" + data_id).text();
//            var name = $("#name" + data_id).text();
//            var email = $("#email" + data_id).text();
//            var mobile_number = $("#mobile_number" + data_id).text();
//
//            var data = {'aircraft_callsign': aircraft_callsign, 'departure_aerodrome': departure_aerodrome,
//                'designation': designation, 'name': name, 'email': email, 'mobile_number': mobile_number, 'data_id': data_id};
//
//        } else {
//            console.log('Hiii212')
//            var designation = $("#designation" + data_value).text();
//            var name = $("#name" + data_value).text();
//            var email = $("#email" + data_value).text();
//            var mobile_number = $("#mobile_number" + data_value).text();
//
//            var data = {'aircraft_callsign': aircraft_callsign, 'departure_aerodrome': departure_aerodrome,
//                'designation': designation, 'name': name, 'email': email, 'mobile_number': mobile_number};
//        }
//
//        console.log(data)
//        $.ajax({
//            url: url,
//            data: data,
//            type: 'POST',
//            cache: false,
//            headers: {'X-CSRF-TOKEN': $("meta[name='_token']").attr('content')},
//            success: function (data, textStatus, jqXHR) {
//                console.log(data)
//            },
//            error: function (jqXHR, textStatus, errorThrown) {
//
//            }
//        });
//    });

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
                console.log(data+id)
                if(data.STATUS_CODE == 1 && data.STATUS_DESC !=''){
                    $(".success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">Info deleted successfully</p>')
                     $("#row"+id).remove();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR)
            }
        });
    });
    
     $(".delete_info").on('click', function () {
       var id = $(this).attr('data-id');
       var aircraft_callsign = $(this).attr('data-callsign')
       console.log('id ',id)
       $(".delete_info_confirm").attr('data-value',id);
       $(".aircraft").html(aircraft_callsign);
       $("#delete_info_modal").modal();
    });

});
