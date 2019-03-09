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
    //get Call Sign details
    $("#callsign2").on('keyup', function () {
        var callsign = $(this).val().toUpperCase();
        callsign = callsign.substr(0, 5);
    });
    //ZZZZ details
    $("#departure_aerodrome2").keyup(function () {
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

    $("#destination_aerodrome2").keyup(function () {
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
        $("#revisetime").modal('hide');
    });

    $(".confirm_revise").on('click', function (e) {
        var data_value = $(this).attr('data-value');
        var departure_time = $("#departure_time" + data_value).val();
        var data_url = $(this).attr('data-url');
        var current_time = $("#current_time").val();
        var current_dept_time = $("#current_dept_time").val();
        $("#cnfrevise").modal('hide');
        $("#mysuccess").html('<a href=""><i class="fa fa-spinner fa-spin"></i></a> Processing please wait...');
        $.ajax({
            type: 'POST',
            url: data_url,
            data: {'flag': 'revise_time', 'id': data_value, 'departure_time': departure_time},
            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
                $("#fic" + data_value).removeAttr('readonly');
                $("#adc" + data_value).removeAttr('readonly');
                $("#departure_time"+data_value).addClass('background-white');
//                $("#departure_time" + data_value).attr('readonly', 'readonly')
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        })
    });

    $(document).on('keyup', ".departure_time", function () {
        $(".departure_time").popover({
            html: true,
            trigger: "hover"
        });
        var data_value = $(this).attr('data-value');
        var departure_time = $("#departure_time" + data_value).val();
        var current_time = $("#current_time").val();
        var current_dof = $("#current_dof").val();
        var a_current_date = $("#a_current_date").val();
        var current_dept_time = $("#current_dept_time" + data_value).val();
        var sum = Number(current_dept_time) + Number(5);
        var sub = Number(current_dept_time) + Number(-5);
        //        console.log('sum ' + sum + 'sub ' + sub + ' departure_time ' + departure_time + 'current_time' + current_time);
        if (current_dof == a_current_date) {
            if ((current_time > departure_time) || departure_time.length < 4 || (departure_time > current_dept_time && departure_time < sum) || (departure_time < current_dept_time && departure_time > sub)) {
                $("#departure_time" + data_value).css('border', 'red solid 1px')
//                $("#departure_time" + data_value).attr('data-content', 'Revise Time in multiples of 5 only');
                $(".tooltip_revise_time").addClass('tooltip_revise_valid');
            } else {
                $('#time_img' + data_value).addClass('modal_class');
                $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
                $("#departure_time" + data_value).popover('destroy');
                $(".tooltip_revise_time").removeClass('tooltip_revise_valid');
            }
        } else {
            $('#time_img' + data_value).addClass('modal_class');
            $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
            $("#departure_time" + data_value).popover('destroy');
            $(".tooltip_revise_time").removeClass('tooltip_revise_valid');
        }

        if (departure_time.length == 4) {
            console.log(departure_time)
            console.log(departure_time[3])
            if ((departure_time[3] == 0 || departure_time[3] == 5) && departure_time < 2359) {
                return true;
            } else {
                $(this).val(departure_time[0] + departure_time[1] + departure_time[2]);
            }
        }
        if (departure_time.substring(2, 4) > 59 && departure_time.substring(0, 2) <= 23) {
            $(this).val(departure_time.substring(0, 2) + '00');
        }

    });

    $(document).on('dblclick', '.departure_time', function () {
        var data_value = $(this).attr('data-value');
        $("#departure_time" + data_value).removeAttr('readonly');
        $(".tooltip_revise_time").removeClass('tooltip_revise_dbl');
    });

    $(document).on('blur', '.departure_time', function () {
        var data_value = $(this).attr('data-value');
        $("#departure_time" + data_value).attr('readonly', 'readonly');
        $(".tooltip_revise_time").addClass('tooltip_revise_dbl');
        $(".tooltip_revise_time").removeClass('tooltip_revise_valid');
    });

    $(document).on('click', '.check_revise', function () {
        var data_value = $(this).attr('data-value');
        var departure_time = $("#departure_time" + data_value).val();
        var current_time = $("#current_time").val();
        var current_dept_time = $("#current_dept_time" + data_value).val();
        var sum = Number(current_dept_time) + Number(5);
        var sub = Number(current_dept_time) + Number(-5);

        $("#departure_time" + data_value).focus();
        $("#departure_time" + data_value).select();
        $("#departure_time" + data_value).removeAttr('readonly');

        var current_dof = $("#current_dof").val();
        var a_current_date = $("#a_current_date").val();


        console.log('departure_time ' + departure_time + ' current_time ' + current_time);
        console.log('current_dept_time ' + current_dept_time + ' sum ' + sum + ' sub ' + sub);
        if (current_dof == a_current_date) {
            if ((current_time > departure_time) || departure_time.length < 4 || (departure_time > current_dept_time && departure_time < sum) || (departure_time < current_dept_time && departure_time > sub)) {
                $("#departure_time" + data_value).css('border', 'red solid 1px');
                $("[data-toggle='popover']").popover({
                    html: true,
                    trigger: "hover"
                });
                $("#departure_time" + data_value).attr('data-content', 'Revise Time in multiples of 5 only');
            } else if (departure_time == current_dept_time) {
                $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
            } else {
                $("#departure_time" + data_value).popover('destroy');
                $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
                $('#time_img' + data_value).addClass('modal_class');
                $('#time_img' + data_value).removeClass('check_revise');
            }
        } else {
            $("#departure_time" + data_value).popover('destroy');
            $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
            $('#time_img' + data_value).addClass('modal_class');
            $('#time_img' + data_value).removeClass('check_revise');
        }

    });

    $(".cancel_plan").on('click', function (e) {
        var data_value = $(this).attr('data-value');
        var data_url = $(this).attr('data-url');
        var email = $("#email").val();
        var user_mobile = $("#user_mobile").val();


        var environment = $("#environment").val();
        if (environment == 'local') {
            var urls = [base_url + "/api/fpl/fpl_cancel"];
            var time_interval = 110;
        } else if (environment == 'pvtcoin2' || environment == 'eflcoin2') {
            var urls = ["https://eflight.co.in/api/fpl/fpl_cancel",
                'http://privateflight.co.in/api/fpl/fpl_cancel'];
        } else {
            var urls = [base_url + "/api/fpl/fpl_cancel"];
        }

        var urls = [base_url + "/api/fpl/fpl_cancel"];
        $("#cancel_plan").modal('hide');
        $("#mysuccess").html('<a href=""><i class="fa fa-spinner fa-spin"></i></a> Processing please wait...');



        $.each(urls, function (i, urls) {
            $.ajax(urls,
                    {type: 'POST',
                        data: {'id': data_value, 'email': email, 'user_mobile': user_mobile},
                        cache: false,
                        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                        success: function (data) {
//                            if (data.STATUS_DESC == 'Success' && data.STATUS_CODE == 1) {
                            $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
                            $('.add_cancel_class' + data_value).addClass('company_color');
                            $('.add_cancel_class' + data_value).removeClass('text-black');
//                            } 
                        },
                        error: function (data, textStatus, jqXHR) {
                            console.log(data);
                        }
                    }
            );
        });



//
//        $.ajax({
//            type: 'POST',
//            url: data_url,
//            data: {'id': data_value},
//            dataType: 'json',
//            cache: false,
//            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
//            success: function (data, textStatus, jqXHR) {
//                $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
//                $('.add_cancel_class' + data_value).addClass('company_color');
//                $('.add_cancel_class' + data_value).removeClass('text-black');
//            },
//            error: function (data, textStatus, jqXHR) {
//                console.log(data);
//            }
//        })
    });

    $(".change_ficadc").on('click', function (e) {
        var data_value = $(this).attr('data-value');
        var fic = $("#fic" + data_value).val();
        var adc = $("#adc" + data_value).val();
        var data_url = $(this).attr('data-url');
        var validation = true;
        var email = $("#email").val();
        var user_mobile = $("#user_mobile").val();
        var environment = $("#environment").val();

        $("#sendficadc").modal('hide');
        $("#mysuccess").html('<a href=""><i class="fa fa-spinner fa-spin"></i></a> Processing please wait...');
        console.log("#sendficadc" + data_value)
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

        if (environment == 'local') {
            var urls = [base_url + "/api/fpl/change_fic_adc"];
            var time_interval = 110;
        } else if (environment == 'pvtcoin2' || environment == 'eflcoin2') {
            var urls = ["https://eflight.co.in/api/fpl/change_fic_adc",
                'http://privateflight.co.in/api/fpl/change_fic_adc'];
        } else {
            var urls = [base_url + "/api/fpl/change_fic_adc"];
        }
        var urls = [base_url + "/api/fpl/change_fic_adc"];
        var data = {'flag': 'revise_time', 'id': data_value, 'fic': fic, 'adc': adc, 'email': email, 'user_mobile': user_mobile};
//        $.each(urls, function (i, urls) {
//            $.ajax(urls,
//                    {
//                        type: 'POST',
//                        data: data,
//                        cache: false,
//                        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
//                        success: function (data) {
//                            $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
//                            $("#fic" + data_value).attr('readonly', 'readonly');
//                            $("#adc" + data_value).attr('readonly', 'readonly');
//                            $("#departure_time" + data_value).attr('readonly', 'readonly');
//                            $("#departure_time" + data_value).removeClass('background-white')
//                        },
//                        error: function (data, textStatus, jqXHR) {
//                            console.log(data);
//                        }
//                    }
//            );
//        });




        $.ajax({
            type: 'POST',
            url: data_url,
            data: data,
//            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
                $("#fic" + data_value).attr('readonly', 'readonly');
                $("#adc" + data_value).attr('readonly', 'readonly');
                $("#departure_time" + data_value).attr('readonly', 'readonly');
                $("#departure_time" + data_value).removeClass('background-white')
            },
            error: function (data, textStatus, jqXHR) {
                console.log(data);
            }
        })


    });

    $(document).on('keyup', '.fic_valid', function (e) {
        var data_value = $(this).attr('data-value');
        console.log(data_value)
        var fic = $("#fic" + data_value).val();
        var adc = $("#adc" + data_value).val();
        var data_url = $(this).attr('data-url');
        var validation = true;
        $("#sendficadc").modal('hide');
        if ((fic == '') || (fic.length < '4')) {
            $("[data-toggle = 'popover']").popover({
                html: true,
                trigger: "hover"
            });
            $("#fic" + data_value).attr('data-content', 'Min. 4 & Max. 4 Characters, only Numbers allowed');
            $("#fic" + data_value).css("border", "red solid 1px");
            validation = false;
        } else {
            $("#fic" + data_value).popover('destroy');
            $("#fic" + data_value).css("border", "lightgrey solid 1px");
        }
          var adc_id="adc"+$(this).attr('data-value')
          if($(this).val().length==4){
            $("#"+adc_id).focus();
          }
    });

    $(document).on('keypress', ".adc_valid", function (e) {
        var data_value = $(this).attr('data-value');
        var dept_aero = $(this).attr('data-dept-aero');
        var dest_aero = $(this).attr('data-dest-aero');
        var adc = $("#adc" + data_value).val();
        var adc_length = adc.length;
        var dept_aero_length = dept_aero.length;
        var dept_aero_sub = dept_aero.substr(0, 2);
        
        console.log(dept_aero_length);

        if (dept_aero_sub == 'VO' && dept_aero_length <=4) {
            $("#adc" + data_value).attr('maxlength', 5);
            $("#adc" + data_value).attr('minlength', 3);
            if (adc_length == 1) {
                return (adc == 'C') ? number(e) : false;
            } else if (adc_length <= 3 && adc_length >= 1) {
                number(e)
            } else {
                alpha(e);
            }
        } else if (dept_aero_sub == 'VA' && dept_aero != 'VAAH' && dept_aero_length <=4) {
            $("#adc" + data_value).attr('maxlength', 5);
            $("#adc" + data_value).attr('minlength', 3);
            if (adc_length == 1) {
                return (adc == 'M' || adc == 'N' || adc == 'P') ? number(e) : false;
            } else if (adc_length <= 3 && adc_length >= 1) {
                number(e)
            } else {
                alpha(e);
            }
        } else if (dept_aero_sub == 'VE' && dept_aero_length <=4) {
            $("#adc" + data_value).attr('maxlength', 5);
            $("#adc" + data_value).attr('minlength', 3);
            if (adc_length == 1) {
                return (adc == 'K') ? alpha(e) : false;
            } else if (adc_length == 2) {
                return (adc == 'KX' || adc == 'KY') ? number(e) : false;
            } else if (adc_length <= 4 && adc_length >= 2) {
                number(e)
            } else {
                alpha(e);
            }
        } else if (dept_aero == 'VAAH' && dept_aero_length <=4) {
            $("#adc" + data_value).attr('maxlength', 6);
            $("#adc" + data_value).attr('minlength', 5);
            if (adc_length == 1) {
                return (adc == 'W') ? alpha(e) : false;
            } else if (adc_length == 2) {
                return (adc == 'WM') ? number(e) : false;
            } else if (adc_length <= 4 && adc_length >= 2) {
                number(e)
            } else {
                return true;
            }
        } else if (dept_aero_sub == 'VI' && dept_aero_length <=4) {
            $("#adc" + data_value).attr('maxlength', 5);
            $("#adc" + data_value).attr('minlength', 3);
            if (adc_length == 1) {
                return (adc == 'X' || adc == 'Y' || adc == 'Z') ? true : false;
            } else if (adc_length == 2) {
                return (adc == 'XX' || adc == 'YY' || adc == 'ZZ' || !isNaN(adc.substr(1, 1))) ? number(e) : false;
            } else if (adc_length <= 4 && adc_length >= 2) {
                number(e)
            } else {
                alpha(e);
            }
        } else {
            $("#adc" + data_value).attr('maxlength', 6);
            $("#adc" + data_value).attr('minlength', 3);
        }
    });

    $(document).on('keyup', ".adc_valid", function (e) {
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

    $(document).on('keypress', '.numeric', function (e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $(".edit_full_plan").on('click', function () {
        var id = $("#id").val();
        var encodedid = $("#encodedid").val();
//        window.location = base_url + "/fpl?_key=" + encodedid;
        $("#changeplan").modal('hide');
        $("#change_fpl_plan").modal('hide');
        window.open(base_url + "/fpl?_key=" + encodedid, '_blank');
    })

});

function alpha(e) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
}

function number(e) {
    var regex = new RegExp("^[0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
}
