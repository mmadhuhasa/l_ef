$(document).ready(function () {
//Make text upper case
    $(document).on('keyup', '.text_uppercase', function () {
        var reid = $(".text_uppercase").map(function () {
            this.value = this.value.toUpperCase();
        }).get().join();
    });
    $("[data-toggle = 'popover']").popover({
        html: true,
        trigger: "hover"
    });
    $("[data-toggle = 'tooltip']").tooltip({
        html: true,
        trigger: "hover"
    });
    //UTC date
    var currentDate = $("#utcdate").val();//document.getElementById("utcdate").value;
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
// Datepicker code   
    var date = new Date();
    $(".from_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon.png', buttonImageOnly: true});
    $(".from_date").datepicker("option", "dateFormat", "ymmdd");
    $(".from_date").datepicker("setDate", currentDate);

    $(".to_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon.png', buttonImageOnly: true});
    $(".to_date").datepicker("option", "dateFormat", "ymmdd");
    $(".to_date").datepicker("setDate", currentDate);

    //get Call Sign details
    $("#callsign").on('keyup', function () {
        var callsign = $(this).val().toUpperCase();
        callsign = callsign.substr(0, 5);
        var data_url = $(this).attr('data-url');
        var data = {'flag': 'callsign', 'callsign': callsign};
        $("#departure_station").attr('readonly', 'readonly');
        $("#departure_latlong").attr('readonly', 'readonly');
//        $("#callsign").css("border", "red solid 1px");
        if (callsign.length >= 5) {
            $.ajax({
                url: data_url,
                data: data,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function (data) {
                    $("#pilot_in_command").val(data.pilot_in_command);
                    $("#mobile_number").val(data.mobile_number);
                    $("#copilot").val(data.copilot);
                    $("#cabincrew").val(data.cabincrew);
                    $("#departure_aerodrome").val(data.departure_aerodrome);
                    $("#callsign").css("border", "lightgrey solid 1px");
                    if (data.departure_aerodrome) {
                        $("#destination_aerodrome").focus();
                    } else {
                        //$("#departure_aerodrome").focus();
                    }

                    validform();
                },
                error: function (data) {
                    console.log(data);
                }

            })

        } else {
            $("#pilot_in_command").val('');
            $("#mobile_number").val('');
            $("#copilot").val('');
            $("#cabincrew").val('');
            $("#callsign").css("border", "red solid 1px");
            $("#departure_aerodrome").val('');
        }


    });
    //ZZZZ details
    $("#departure_aerodrome").keyup(function () {
        var dep_aero = $("#departure_aerodrome").val().toUpperCase();
        if (dep_aero == "ZZZZ") {
            $("#departure_station").removeAttr('readonly');
            $("#departure_latlong").removeAttr('readonly');
            $("#departure_aerodrome").css("border", "lightgrey solid 1px");
            $("#departure_station").attr('required', 'required');
            $("#departure_latlong").attr('required', 'required');
        } else {
            $("#departure_station").attr('readonly', 'readonly');
            $("#departure_latlong").attr('readonly', 'readonly');
            $("#departure_station").val('');
            $("#departure_latlong").val('');
            $("#departure_aerodrome").css("border", "lightgrey solid 1px");
        }
    });

    $("#destination_aerodrome").keyup(function () {
        var dest_aero = $("#destination_aerodrome").val().toUpperCase();
        if (dest_aero == "ZZZZ") {
            $("#destination_station").removeAttr('readonly');
            $("#destination_latlong").removeAttr('readonly');
            $("#destination_station").attr('required', 'required');
            $("#destination_latlong").attr('required', 'required');
            $("#destination_aerodrome").css("border", "lightgrey solid 1px");
        } else {
            $("#destination_station").attr('readonly', 'readonly');
            $("#destination_latlong").attr('readonly', 'readonly');
            $("#destination_station").val('');
            $("#destination_latlong").val('');
            $("#destination_aerodrome").css("border", "lightgrey solid 1px");
        }

    });

    $(".revise_time").on('click', function (e) {
        var data_value = $(this).attr('data-value');
        var id = $(this).attr('id');
        $("#departure_time" + data_value).removeAttr('disabled');
        $("#departure_time" + data_value).focus();
        $("#revisetime" + data_value).modal('hide');
    });

    $(".confirm_revise").on('click', function (e) {
        var data_value = $(this).attr('data-value');
        var departure_time = $("#departure_time" + data_value).val();
        var data_url = $(this).attr('data-url');
        $("#cnfrevise" + data_value).modal('hide');
        $("#mysuccess").html('Processing please wait...');
        $.ajax({
            type: 'POST',
            url: data_url,
            data: {'flag': 'revise_time', 'id': data_value, 'departure_time': departure_time},
            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg">' + data.success + '</div>');
                $("#fic" + data_value).removeAttr('readonly');
                $("#adc" + data_value).removeAttr('readonly');
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        })
    });

    $(".departure_time").on('keyup', function () {
        var data_value = $(this).attr('data-value');
        var departure_time = $("#departure_time" + data_value).val();
        if (departure_time.length < 4) {
            $("#departure_time" + data_value).css('border', 'red solid 1px')
        } else {
            $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
        }
    });

    $(".departure_time").on('click', function () {
        $(this).select();
    });

    $(".cancel_plan").on('click', function (e) {
        var data_value = $(this).attr('data-value');
        var data_url = $(this).attr('data-url');
        $("#cancel_plan" + data_value).modal('hide');
        $("#mysuccess").html('Processing please wait...');
        $.ajax({
            type: 'POST',
            url: data_url,
            data: {'id': data_value},
            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg">' + data.success + '</div>');
                $('.add_cancel_class' + data_value).addClass('company_color');
            },
            error: function (data, textStatus, jqXHR) {
                console.log(data);
            }
        })
    });

    $(".change_ficadc").on('click', function (e) {
        var data_value = $(this).attr('data-value');
        var fic = $("#fic" + data_value).val();
        var adc = $("#adc" + data_value).val();
        var data_url = $(this).attr('data-url');
        var validation = true;
        $("#sendficadc" + data_value).modal('hide');
        $("#mysuccess").html('Processing please wait...');
        if ((fic == '') || (fic.length < '4')) {
            $("#fic" + data_value).attr('data-content', 'Min. 4 & Max. 4 Characters, only Numbers allowed');
            $("#fic" + data_value).css("border", "red solid 1px");
            validation = false;
        } else {
            $("#fic" + data_value).popover('destroy');
            $("#fic" + data_value).css("border", "lightgrey solid 1px");
        }
        if (!validation) {
            return false;
        }
        $.ajax({
            type: 'POST',
            url: data_url,
            data: {'flag': 'revise_time', 'id': data_value, 'fic': fic, 'adc': adc},
            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg">' + data.success + '</div>');
                $("#fic" + data_value).attr('readonly', 'readonly');
                $("#adc" + data_value).attr('readonly', 'readonly');
            },
            error: function (data, textStatus, jqXHR) {
                console.log(data);
            }
        })
        console.log("#sendficadc" + data_value)

    });

    $(".fic_valid").on('keyup', function (e) {
        var data_value = $(this).attr('data-value');
        var fic = $("#fic" + data_value).val();
        var adc = $("#adc" + data_value).val();
        var data_url = $(this).attr('data-url');
        var validation = true;
        $("#sendficadc" + data_value).modal('hide');
        if ((fic == '') || (fic.length < '4')) {
            $("#fic" + data_value).attr('data-content', 'Min. 4 & Max. 4 Characters, only Numbers allowed');
            $("#fic" + data_value).css("border", "red solid 1px");
            validation = false;
        } else {
            $("#fic" + data_value).popover('destroy');
            $("#fic" + data_value).css("border", "lightgrey solid 1px");
        }
    });

    $(".adc_valid").on('keypress', function (e) {
        var data_value = $(this).attr('data-value');
        var dept_aero = $(this).attr('data-dept-aero');
        var dest_aero = $(this).attr('data-dest-aero');
        var adc = $("#adc" + data_value).val();
        var adc_length = adc.length;
        var dept_aero_length = dept_aero.length;
        var dept_aero_sub = dept_aero.substr(0, 2);

        if (dept_aero_sub == 'VO') {
            $("#adc" + data_value).attr('maxlength', 5);
            $("#adc" + data_value).attr('minlength', 5);
            if (adc_length == 1) {
                return (adc == 'C') ? number(e) : false;
            } else if (adc_length <= 3 && adc_length >= 1) {
                number(e)
            } else {
                alpha(e);
            }
        } else if (dept_aero_sub == 'VA') {
            $("#adc" + data_value).attr('maxlength', 5);
            $("#adc" + data_value).attr('minlength', 4);
            if (adc_length == 1) {
                return (adc == 'M' || adc == 'N' || adc == 'P') ? number(e) : false;
            } else if (adc_length <= 3 && adc_length >= 1) {
                number(e)
            } else {
                alpha(e);
            }
        } else if (dept_aero_sub == 'VE') {
            $("#adc" + data_value).attr('maxlength', 5);
            $("#adc" + data_value).attr('minlength', 5);
            if (adc_length == 1) {
                return (adc == 'K') ? alpha(e) : false;
            } else if (adc_length == 2) {
                return (adc == 'KX' || adc == 'KY') ? number(e) : false;
            } else if (adc_length <= 4 && adc_length >= 2) {
                number(e)
            } else {
                alpha(e);
            }
        } else if (dept_aero == 'VAAH') {
            $("#adc" + data_value).attr('maxlength', 6);
            $("#adc" + data_value).attr('minlength', 6);
            if (adc_length == 1) {
                return (adc == 'W') ? alpha(e) : false;
            } else if (adc_length == 2) {
                return (adc == 'WM') ? number(e) : false;
            } else if (adc_length <= 4 && adc_length >= 2) {
                number(e)
            } else {
                alpha(e);
            }
        } else if (dept_aero_sub == 'VI') {
            $("#adc" + data_value).attr('maxlength', 4);
            $("#adc" + data_value).attr('minlength', 4);
            if (adc_length == 1) {
                return (adc == 'X' || adc == 'Y' || adc == 'Z') ? true : false;
            } else if (adc_length == 2) {
                return (adc == 'XX' || adc == 'YY' || adc == 'ZZ' || !isNaN(adc.substr(1, 1))) ? number(e) : false;
            } else if (adc_length <= 4 && adc_length >= 2) {
                number(e)
            } else {
                alpha(e);
            }
        }
    });

    $(".adc_valid").on('keyup', function (e) {
        var data_value = $(this).attr('data-value');
        var min_length = $(this).attr('minlength');
        var adc = $("#adc" + data_value).val();
        var adc_length = adc.length;
        if (adc == '' || adc_length >= min_length) {
            $("#adc" + data_value).css("border", "lightgrey solid 1px");
        } else {
            $("#adc" + data_value).css("border", "red solid 1px");
        }
    });

});


