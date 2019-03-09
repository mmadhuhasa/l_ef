$(document).ready(function () {
    $(document).on('click', ".edit_pilots", function () {
        var id = $(this).attr('data-value');
        var data_url = $(this).attr('data-url') + '/' + id;
        var data = {'id': id};
        console.log('id', id)
        $.ajax({
            url: data_url,
            type: 'GET',
            data: data,
            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                var aircraft_callsign = data.response.aircraft_callsign;
                console.log('data ', data)
                $("#aircraft_callsign2").val(aircraft_callsign)
                $("#mobile_number2").val(data.response.mobile_number)
                $("#name2").val(data.response.name)
                $("#email2").val(data.response.email)
                $("#is_pilot").val(data.response.is_pilot)
                $("#is_copilot").val(data.response.is_copilot)
                $("#is_active").val(data.response.is_active)
                if(data.signature !='' && data.is_pilot_sign !=''){
                $("#signature").html(data.signature +' <span style="padding-left:10px;cursor:pointer;"><i class="fa fa-close close_sign"></span>')
            }else{
                $("#signature").html(data.signature)
            }
                $("#id").val(data.response.id);

            },
            error: function (jqXHR, textStatus, errorThrown) {

            },
            async: false
        });
        $("#pilots_modal").modal();
    });

    $(document).on('click', ".alert_delete_pilots", function () {
        var id = $(this).attr('data-value');
        console.log('id ', id);
        $(".delete_pilots_confirm").attr('data-value', id);
        $(".aircraft").html($(this).attr('data-aircraft'))
        $("#delete_pilots_modal").modal();
    });

    $(document).on('click', ".delete_pilots_confirm", function () {
        var id = $(this).attr('data-value');
        var data_url = base_url + '/Admin/pilots/' + id;
        var data = {'id': id};
        console.log('id2 ', id);
        $("#delete_pilots_modal").modal('hide');
        $.ajax({
            url: data_url,
            type: 'DELETE',
            data: data,
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                $('#delete_' + id).parents('tr').remove();
                $(".success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + data.STATUS_DESC + '</p>')
            },
            error: function (jqXHR, textStatus, errorThrown) {

            },
        });
    });

    $("form#pilots_form2").on('submit', function (e) {
        e.preventDefault();
        var data = $("form[id=pilots_form2]").serialize();
        var file = $("#signature2").val();
        var data_url = $("form[id=pilots_form2]").attr('data-url');

        var form_data = new FormData($(this)[0]);
        $("#pilots_modal").modal('hide');
        data = data + '&signature=' + file;
        $.ajax({
            url: data_url,
            type: 'POST',
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                $(".success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + data.STATUS_DESC + '</p>')
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    });

    $(document).on('click', '.pilots_search', function () {
        $current_ele = $(this).text();
        if ($current_ele == 'RESET') {
            $("#aircraft_callsign").val('');
            $("#email").val('');
            $("#name").val('');
            $("#mobile_number").val('');
            $(this).text('SEARCH');
        }else{
            $(this).text('RESET') ;
        }
        var data = '';
        $.ajax({
            url: base_url + '/Admin/pilots_filter',
            type: 'GET',
            data: data,
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                $('.filter_pilots_info').html(data)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR)
            },
        });
    })
    
    $(document).on('click','.close_sign', function(){
       console.log('Jiii');
       $("#signature").html('');
       $("#img_sign").val('0');
    });
    
    $(document).on('click',".pilots_name_popup", function(){
        $("#pilots_name_modal").modal();
    });
})