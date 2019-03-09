$(function () {

    $(document).on('click', ".edit_users", function () {
        var id = $(this).attr('data-value');
        var data_url = $(this).attr('data-url') + '/' + id;
        var data = {'id': id};
//    $("#user_role_id option").attr('selected','')
        $.ajax({
            url: data_url,
            type: 'GET',
            data: data,
            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                var response = data.response;
                var user_role = data.response.user_role_id;
                $("#user_role_id option[value=" + user_role + "]").attr('selected', 'selected')
                $("#mobile_number").val(response.mobile_number)
                $("#name").val(response.name)
                $("#email").val(response.email)
                $("#operator").val(response.operator)
                $("#operator_email").val(response.operator_email)
                $("#user_callsigns").val(response.user_callsigns)
                $("#is_admin").val(response.is_admin)
                $("#is_active").val(response.is_active)
                $("#id").val(response.id);
                $("#user_edit_modal").modal();
                if (response.is_fpl == 1) {
                    $("#is_fpl").attr('checked', 'checked');
                    $("#is_fpl").val('1');
                }
                if (response.is_notams == 1) {
                    $("#is_notams").attr('checked', 'checked');
                }
                if (response.is_navlog == 1) {
                    $("#is_navlog").attr('checked', 'checked');
                }
                if (response.is_lnt == 1) {
                    $("#is_lnt").attr('checked', 'checked');
                }
                if (response.is_lr == 1) {
                    $("#is_lr").attr('checked', 'checked');
                }
                if (response.is_weather == 1) {
                    $("#is_weather").attr('checked', 'checked');
                }
                if (response.is_runway == 1) {
                    $("#is_runway").attr('checked', 'checked');
                }
                if (response.is_airports == 1) {
                    $("#is_airports").attr('checked', 'checked');
                }
                if (response.is_fdtl == 1) {
                    $("#is_fdtl").attr('checked', 'checked');
                }
                
                 if (response.is_billing == 1) {
                    $("#is_billing").attr('checked', 'checked');
                }

                if (user_role != 4) {
                    $("#operator_email").attr('readonly', 'readonly');
                } else {
                    $("#operator_email").removeAttr('readonly');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

            },
            async: false
        });
    });/* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    $(document).on('click', '.filter_users', function () {
        $current_ele = $(this).text();
        if ($current_ele == 'RESET') {
            $("#operator2").val('');
            $("#email2").val('');
            $("#name2").val('');
            $("#mobile2").val('');
            $(this).text('SEARCH');
        } else {
            $(this).text('RESET');
        }
        var url = $(this).attr('data-url');
        var data = '';
        $.get(url, data, function (data) {
            $(".search_users_info").html(data);
        });
    });

    $("#users_edit_form").on('submit', function (e) {
        e.preventDefault();
        var data = $("form#users_edit_form").serializeArray();
        var data_url = $("form#users_edit_form").attr('data-url');
        $("#user_edit_modal").modal('hide');

        var is_fpl = ($("#is_fpl").is(":checked")) ? 1 : 0;
        var is_fdtl = ($("#is_fdtl").is(":checked")) ? 1 : 0;
        var is_navlog = ($("#is_navlog").is(":checked")) ? 1 : 0;
        var is_lnt = ($("#is_lnt").is(":checked")) ? 1 : 0;
        var is_runway = ($("#is_runway").is(":checked")) ? 1 : 0;
        var is_notams = ($("#is_notams").is(":checked")) ? 1 : 0;
        var is_weather = ($("#is_weather").is(":checked")) ? 1 : 0;
        var is_lr = ($("#is_lr").is(":checked")) ? 1 : 0;
        var is_billing = ($("#is_billing").is(":checked")) ? 1 : 0;
        data.push({'name': 'is_fpl', 'value': is_fpl},
                {'name': 'is_fdtl', 'value': is_fdtl}, {'name': 'is_navlog', 'value': is_navlog}
        , {'name': 'is_lnt', 'value': is_lnt}, {'name': 'is_runway', 'value': is_runway}, {'name': 'is_notams', 'value': is_notams}
        , {'name': 'is_weather', 'value': is_weather}, {'name': 'is_lr', 'value': is_lr},{'name':'is_billing', 'value':is_billing})

        console.log('datat ', data);//alert(data)

        $.post(data_url, data, function (data) {
            $(".success").html('<p class="success animated  zoomIn custdelay" style="text-align: center;color:red">' + data.STATUS_DESC + '</p>')
        });
    });

    $("#user_role_id").on('change', function () {
        var value = $(this).val();
        if (value != 4) {
            $("#operator_email").attr('readonly', 'readonly');
        } else {
            $("#operator_email").removeAttr('readonly');
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
            
            get_user_data('',ui.item.value)
        }
    });
    
    $(".ops_admin_email").autocomplete({
            minLength: 2,
            source: function (request, response) {
                $.ajax({
                    type: "GET",
                    url: base_url + "/Admin/user/auto_email",
                    dataType: "json",
                    data: {
                        term: request.term,
                        'ops_admin': 1
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
                get_user_data(ui.item.value);
            }
            
        });
    
    
    function get_user_data(email='',name='') {
            if(email !=''){
                var data = {'email':email}
            }else{
                var data = {'name':name} 
            }
            $.ajax({
                type: "GET",
                url: base_url + "/Admin/get_user_data",
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (response) {
                    console.log('result ',response.result.email)
                    $("#operator").val(response.result.operator)
//                    $("#operator_email").val(response.result.email)
                }
            });
        }
});


