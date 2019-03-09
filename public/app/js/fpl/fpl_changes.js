$(document).ready(function () {
    //    //UTC date
    //    var currentDate = $("#date_of_flight").val();//document.getElementById("utcdate").value;
    //    var current_day = '';
    //    var current_month = '';
    //    var current_year = '';
    //    if (currentDate) {
    //        current_day = currentDate.substr(4, 2);
    //        current_month = currentDate.substr(3, 1) - 1;
    //        current_year = '20' + currentDate.substr(0, 2);
    //    }
    //    // Datepicker code
    //    var currentTime = new Date();
    //    var month = currentTime.getMonth() + 1
    //    var day = currentTime.getDate();
    //    var year = currentTime.getFullYear()
    //    var todaydate = year + "-" + month + "-" + day;
    //    var day2 = currentTime.getDate() + 1;
    //    var seconddate = year + "-" + month + "-" + day2;
    //    var day3 = currentTime.getDate() + 2;
    //    var thirddate = year + "-" + month + "-" + day3;
    //    var day4 = currentTime.getDate() + 3;
    //    var fourthdate = year + "-" + month + "-" + day4;
    //    var day5 = currentTime.getDate() + 4;
    //    var fifthdate = year + "-" + month + "-" + day5;
    //    var readonlyDays = [todaydate, seconddate, thirddate, fourthdate, fifthdate];
    //    var date = new Date();
    //    var min_date = new Date(current_year, current_month, current_day);
    //    var max_date = addDays(min_date, 4);
    //
    //    $(".datepicker").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon.png', buttonImageOnly: true, minDate: min_date, maxDate: max_date, showOtherMonths: true, selectOtherMonths: true,
    //        showAnim: "slide",
    //        dateFormat: 'yy-mm-dd',
    //        beforeShowDay: function (date) {
    //            var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
    //            for (i = 0; i < readonlyDays.length; i++) {
    //                if ($.inArray(y + '-' + (m + 1) + '-' + d, readonlyDays) != -1) {
    //                    //return [false];
    //                    return [true, 'dp-highlight-date', ''];
    //                }
    //            }
    //            return [true];
    //        }
    //    });
    //    $(".datepicker").datepicker("option", "dateFormat", "ymmdd");
    //    $(".datepicker").datepicker("setDate", currentDate);
    //    var from_date = $("#from_date").val();
    //    var to_date = $("#to_date").val();
    //
    //    $(".from_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/from-icon.png', buttonImageOnly: true, maxDate: max_date});
    //    $(".from_date").datepicker("option", "dateFormat", "ymmdd");
    //    $(".from_date").datepicker("setDate", from_date);
    //
    //    $(".to_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/to-icon.png', buttonImageOnly: true, maxDate: max_date});
    //    $(".to_date").datepicker("option", "dateFormat", "ymmdd");
    //    $(".to_date").datepicker("setDate", to_date);

    //get Call Sign details
    $("#aircraft_callsign").on('keyup', function () {
        var aircraft_callsign = $(this).val().toUpperCase();
        aircraft_callsign = aircraft_callsign.substr(0, 5);
        aircraft_callsign2 = aircraft_callsign.substr(0, 2);
        var selected_dof = $("#date_of_flight").val();
        var departure_aerodrome = $("#departure_aerodrome").val();
        var data_url = $(this).attr('data-url');
        var data = {
            'flag': 'aircraft_callsign',
            'aircraft_callsign': aircraft_callsign,
            'selected_dof': selected_dof,
            'departure_aerodrome': departure_aerodrome
        };
        $("#departure_station").attr('readonly', 'readonly');
        $("#departure_latlong").attr('readonly', 'readonly');
        //        $("#aircraft_callsign").css("border", "red solid 1px");
        if (aircraft_callsign.length >= 5) {
            $.ajax({
                url: data_url,
                data: data,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function (data) {
                    $("#pilot_in_command").val(data.pilot_in_command.toUpperCase()).removeClass('border');
                    $("#mobile_number").val(data.mobile_number).removeClass('border');
                    $("#copilot").val(data.copilot.toUpperCase()).removeClass('border');
                    $("#cabincrew").val(data.cabincrew.toUpperCase());
                    $("#departure_aerodrome").val(data.departure_aerodrome.toUpperCase()).removeClass('border');
                    if (data.departure_aerodrome == 'ZZZZ') {
                        $("#departure_station").val(data.destination_station.toUpperCase());
                        $("#departure_latlong").val(data.destination_latlong.toUpperCase());
                        $("#departure_station").removeAttr('readonly')
                        $("#departure_latlong").removeAttr('readonly')
                    }
                    $("#total_time_after_flying").val(data.total_time_after_flying)
                    $("#total_flying_time_format1").val(data.total_flying_time_format1)
                    $("#total_flying_time_format2").val(data.total_flying_time_format2)
                    $("#aircraft_callsign").css("border", "lightgrey solid 1px");
                    if (data.departure_aerodrome && aircraft_callsign2 == 'VT') {
                        $("#destination_aerodrome").focus();
                        // $("#departure_aerodrome").attr('readonly','readonly');
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
            $("#aircraft_callsign").css("border", "red solid 1px");
            $("#departure_aerodrome").val('');
        }


    })



   /* $("#departure_station,#destination_station,.stations").autocomplete({
        source: base_url + "/fpl/stations_autocomplete",
        minLength: 2,
        select: function (event, ui) {
            var data = $(this).val(ui.item.value);
            var data_url = base_url + "/fpl/station_latlong";
            if (($(this).attr('id')) == "departure_station") {

                if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                    $("#departure_station").attr('data-content', 'Min. 3 & Max. 25 Characters, only Alphabets allowed');
                    $("#departure_station").css("border", "red solid 1px");
                    //                    $('#departure_station').popover('show');
                } else {
                    $('#departure_station').popover('destroy');
                    $("#departure_station").css("border", "lightgrey solid 1px");
                }
                fetch_departure_latlong(ui.item.value, data_url);


            } else if (($(this).attr('id')) == "destination_station") {
                if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                    $("#destination_station").attr('data-content', 'Min. 3 & Max. 25 Characters, only Alphabets allowed');
                    $("#destination_station").css("border", "red solid 1px");
                    //                    $('#destination_station').popover('show');
                } else {
                    $('#destination_station').popover('destroy');
                    $("#destination_station").css("border", "lightgrey solid 1px");
                }
                fetch_destination_latlong(ui.item.value, data_url);

            }

            if ($(this).hasClass('stations')) {
                if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                    $(this).attr('data-content', 'Min. 3 & Max. 25 Characters, only Alphabets allowed');
                    $(this).css("border", "red solid 1px");
                    //                    $('#departure_station').popover('show');
                } else {
                    $(this).popover('destroy');
                    $(this).css("border", "lightgrey solid 1px");
                }
            }
        }
    });

    function fetch_departure_latlong(stationname, base_url) {
        $.ajax({
            type: "POST",
            url: base_url,
            data: {"station_name": stationname},
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (result) {
                var latlongvalue = result.stationlatlong;
                $("#departure_latlong").val(latlongvalue);
                if ((latlongvalue == '') || (latlongvalue.length <= '8')) {
                    $("#departure_latlong").attr('data-content', 'Min. 9 & Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1257N07739E or BBG353020)');
                    $("#departure_latlong").css("border", "red solid 1px");

                } else {
                    $('#departure_latlong').popover('destroy');
                    $("#departure_latlong").css("border", "lightgrey solid 1px");
                }

            }
        });
    }

    function fetch_destination_latlong(stationname, base_url) {

        $.ajax({
            type: "POST",
            url: base_url,
            data: {"station_name": stationname},
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (result) {
                var latlongvalue = result.stationlatlong;
                $("#destination_latlong").val(latlongvalue);
                if ((latlongvalue == '') || (latlongvalue.length <= '8')) {
                    $("#destination_latlong").attr('data-content', 'Min. 9 & Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1257N07739E or BBG353020)');
                    $("#destination_latlong").css("border", "red solid 1px");

                } else {
                    $('#destination_latlong').popover('destroy');
                    $("#destination_latlong").css("border", "lightgrey solid 1px");
                }
            }
        });
    }*/

    $("#departure_station,#destination_station").on('keyup', function () {
        var departure_station = $("#departure_station").val();
        var destination_station = $("#destination_station").val();
        if (departure_station == '') {
            $("#departure_latlong").val('');
        } else if (departure_station.length >= 1) {
            $("#departure_station").css("border", "lightgrey solid 1px");
        }
        if (destination_station == '') {
            $("#destination_latlong").val('');
        } else if (destination_station.length >= 1) {
            $("#destination_station").css("border", "lightgrey solid 1px");
        }
    });

    $(".redirect").on('click', function () {
        var url = $(this).attr('data-url');
        var redirect_url = $(this).attr('data-redirect-url');
        var aircraft_callsign = $("#aircraft_callsign").val();
        //        aircraft_callsign = aircraft_callsign.substr(0, 5);
        var data = {'flag': 'check_callsign', 'aircraft_callsign': aircraft_callsign};
        if (aircraft_callsign.length >= 5) {
            $.ajax({
                type: 'POST',
                data: data,
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    var is_callsign = data.success;
                    if (!is_callsign) {
                        window.location = redirect_url + '&_cs=' + aircraft_callsign;
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            })
        }

    });

    $(".redirect").on('focus', function () {
        var url = $(this).attr('data-url');
        var redirect_url = $(this).attr('data-redirect-url');
        var aircraft_callsign = $("#aircraft_callsign").val();
        aircraft_callsign = aircraft_callsign.substr(0, 5);
        var data = {'flag': 'check_callsign', 'aircraft_callsign': aircraft_callsign};
        if (aircraft_callsign.length >= 5) {
            $.ajax({
                type: 'POST',
                data: data,
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    var is_callsign = data.success;
                    if (!is_callsign) {
                        window.location = redirect_url + '&_cs=' + aircraft_callsign;
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            })
        }
    })

    $("#equipment").on('keyup', function () {
        var equipment = $(this).val().toUpperCase();
        if (equipment == '' || equipment.length < 1) {
            $("#equipment").css('border', 'red solid 1px');
        } else {
            $("#equipment").css('border', 'lightgrey solid 1px');
        }
        if (equipment.indexOf("R") >= 0) {
            //R present
            $("#pbn").removeAttr('readonly');
            $("#pbn").attr('required', 'required');
        } else {
            $("#pbn").attr('readonly', 'readonly');
            $("#pbn").val('');
        }

        if (equipment.indexOf("/") >= 0) {
            $("#transponder_value").text('Transponder Mode');
            $("#transponder").val('');
            $("#mode").css("border", "lightgrey solid 1px");
        }
        if (equipment.indexOf("/") < 0) {
            $("#transponder_value").text('Transponder Mode');
            $("#transponder").val('');
            $("#mode").css("border", "red solid 1px");
        }

    });

    $("#first_alternate_aerodrome").keyup(function () {
        var alt_aero = $("#first_alternate_aerodrome").val().toUpperCase();
        var second_alt_aero = $("#second_alternate_aerodrome").val().toUpperCase();
        if (alt_aero == '' || alt_aero.length < '4') {
            $("#first_alternate_aerodrome").css("border", "red solid 1px");
        } else {
            $("#first_alternate_aerodrome").css("border", "lightgrey solid 1px");
        }
        if (alt_aero == "ZZZZ") {
            $("#alternate_station").removeAttr('readonly');
            $("#alternate_station").val("ALL OPEN SPACES AND HELIPAD ENROUTE");
            $("#alternate_station").css("border", "lightgrey solid 1px");
        } else if (second_alt_aero == "ZZZZ") {
            $("#alternate_station").removeAttr('readonly');
            $("#alternate_station").val("ALL OPEN SPACES AND HELIPAD ENROUTE");
            $("#alternate_station").css("border", "lightgrey solid 1px");
        } else {
            $("#alternate_station").attr('readonly', 'readonly');
            $("#alternate_station").val('');
        }

    });

    $("#second_alternate_aerodrome").keyup(function () {

        var alt_aero = $("#first_alternate_aerodrome").val().toUpperCase();
        var second_alt_aero = $("#second_alternate_aerodrome").val().toUpperCase();
        if (second_alt_aero == '' || second_alt_aero.length < '4') {
            $("#second_alternate_aerodrome").css("border", "red solid 1px");
        } else {
            $("#second_alternate_aerodrome").css("border", "lightgrey solid 1px");
        }
        if (second_alt_aero == "ZZZZ") {
            $("#alternate_station").removeAttr('readonly');
            $("#alternate_station").val("ALL OPEN SPACES AND HELIPAD ENROUTE");
            $("#alternate_station").css("border", "lightgrey solid 1px");
        } else if (alt_aero == "ZZZZ") {
            $("#alternate_station").removeAttr('readonly');
            $("#alternate_station").val("ALL OPEN SPACES AND HELIPAD ENROUTE");
            $("#alternate_station").css("border", "lightgrey solid 1px");
        } else {
            $("#alternate_station").attr('readonly', 'readonly');
            $("#alternate_station").val('');
        }

    });

    $("#number").keyup(function () {
        var number = $("#number").val();
        if (number.length == 1) {
            $("#number").css('border', '#ff0000 solid 1px');
        } else {
            $("#number").css('border', 'lightgrey solid 1px');
        }

        if (number.length == 2) {

            $("#capacity").removeAttr('readonly');
            $("#cover").removeAttr('readonly');
            $("#capacity").css('border', '#ff0000 solid 1px');
            $("#capacity").attr('required', 'required')
        } else {
            $("#capacity").attr('readonly', 'readonly');
            $("#cover").attr('readonly', 'readonly');
            $("#color").attr('readonly', 'readonly');
            $("#capacity").val('');
            $("#cover").attr('disabled', 'disabled');
            $("#cover").prop('checked', false);
            $("#color").val('');
            $("#capacity").css('border', 'lightgrey solid 1px');
            $("#color").css('border', 'lightgrey solid 1px');
        }

    });

    $("#capacity").on('keyup', function () {
        var capacity = $("#capacity").val();
        if (capacity.length == 2) {
            $("#capacity").css('border', 'lightgrey solid 1px');
            $('#cover').removeAttr('disabled');
        } else {
            $("#capacity").css('border', '#ff0000 solid 1px');
            $("#cover").attr('disabled', 'disabled');
            $("#cover").prop('checked', false);
            $("#color").val('');
            $("#color").attr('readonly', 'readonly');
        }

    });

    $('#cover').click(function () {
        if ($("#cover").is(':checked')) {
            // something when checked
            $("#color").removeAttr('readonly');
            $("#color").css('border', 'red solid 1px');
            $("#color").attr('required', 'required');
        } else {
            // something else when not
            $("#color").attr('readonly', 'readonly');
            $("#color").removeAttr('required');
            $("#color").css('border', 'lightgrey solid 1px');
            $("#color").val('');
            $(".remove_has_error").removeClass('has-error');
        }
    });

    //    $("#pilot_in_command").autocomplete({
    //        minLength: 0,
    //        source: function (request, response) {
    //            $.ajax({
    //                type: "POST",
    //                url: base_url + "/fpl/pilot_in_command",
    //                dataType: "json",
    //                data: {
    //                    term: request.term.toUpperCase(),
    //                    aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
    //                },
    //                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
    //                success: function (data) {
    //                    response(data);
    //
    //                }
    //            });
    //        },
    //        select: function (event, ui) {
    //            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
    //                $("#pilot_in_command").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
    //                $("#pilot_in_command").css("border", "red solid 1px");
    ////                $('#pilot_in_command').popover('show');
    //            } else {
    //                $('#pilot_in_command').popover('destroy');
    //                $("#pilot_in_command").css("border", "lightgrey solid 1px");
    //            }
    //            get_pilot_mobile(ui.item.value);
    //        }
    //    }).click(function () {
    //        $(this).autocomplete('search', $(this).val())
    //    });

    $("#departure_aerodrome_autocomplete").autocomplete({
        minLength: 3,
        source: function (request, response) {
            $.ajax({
                type: "GET",
                url: base_url + "/fpl/get_airports_list",
                dataType: "json",
                data: {
                    term: request.term.toUpperCase()
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            console.log("ui", ui)
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {

            } else {

            }

        }
    });

    //    function get_pilot_mobile(pilot_name) {
    //        $.ajax({
    //            type: "POST",
    //            url: base_url + "/fpl/get_pilot_details",
    //            data: {"pilot_name": pilot_name},
    //            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
    //            success: function (result) {
    //                var mobilenumber = result.mobilenum;
    //                $("#mobile_number").val(mobilenumber);
    ////                if ((mobilenumber == '') || (mobilenumber.length <= '9')) {
    ////                    $("#mobile_number").attr('data-content', 'Only digits & NO Special Characters allowed \n\
    ////        <span style="color:red;" >(min. 10 & max. 11 numbers)</span>');
    ////                    $("#mobile_number").css("border", "red solid 1px");
    //////                $('#mobile_number').popover('show');
    ////                } else {
    ////                    $('#mobile_number').popover('destroy');
    ////                    $("#mobile_number").css("border", "lightgrey solid 1px");
    ////                }
    //            }
    //        });
    //    }
    //
    //    $("#pilot_in_command").on('keyup', function () {
    //        var pilot_in_command = $(this).val().toUpperCase();
    //        if (pilot_in_command == '' || (pilot_in_command.length < '2')) {
    //            $("#pilot_in_command").css("border", "red solid 1px");
    //        } else {
    //            $('#pilot_in_command').popover('destroy');
    //            $("#pilot_in_command").css("border", "lightgrey solid 1px");
    //        }
    //    })
    //
    //    $("#mobile_number").on('keyup', function () {
    //        var mobile_number = $(this).val().toUpperCase();
    //        if (mobile_number == '' || (mobile_number.length < '10')) {
    //            $("#mobile_number").css("border", "red solid 1px");
    //        } else {
    //            $('#mobile_number').popover('destroy');
    //            $("#mobile_number").css("border", "lightgrey solid 1px");
    //        }
    //    })

    //    $("#copilot").on('keyup', function () {
    //        var copilot = $(this).val().toUpperCase();
    //        if (copilot == '' || (copilot.length < '2')) {
    //            $("#copilot").css("border", "red solid 1px");
    //        } else {
    //            $('#copilot').popover('destroy');
    //            $("#copilot").css("border", "lightgrey solid 1px");
    //        }
    //    })

    $("#cabincrew").on('keyup', function () {
        var cabincrew = $(this).val().toUpperCase();
        if (cabincrew == '' || (cabincrew.length < '2')) {
            $("#cabincrew").css("border", "red solid 1px");
        } else {
            $('#cabincrew').popover('destroy');
            $("#cabincrew").css("border", "lightgrey solid 1px");
        }
    })

    $("#nav1").on('keyup', function () {
        //        var nav = $(this).val().toUpperCase();
        //        if (nav == '' || (nav.length < '1')) {
        //            $("#nav1").css("border", "red solid 1px");
        //        } else {
        //            $('#nav1').popover('destroy');
        $("#nav1").css("border", "lightgrey solid 1px");
        //        }
    })

    $("#sel").on('keyup', function () {
        var sel = $(this).val().toUpperCase();
        if ((sel.length >= '1') && (sel.length <= '3')) {
            $("#sel").css("border", "red solid 1px");
        } else {
            $('#sel').popover('destroy');
            $("#sel").css("border", "lightgrey solid 1px");
        }
    })

    $("#code").on('keyup', function () {
        var code = $(this).val().toUpperCase();
        if (code != '' && (code.length < '6')) {
            $("#code").css("border", "red solid 1px");
        } else {
            $('#code').popover('destroy');
            $("#code").css("border", "lightgrey solid 1px");
        }
    })

    $("#per").on('keyup', function () {
        var per = $(this).val().toUpperCase();
        //        if (per == '' || (per.length < '1')) {
        //            $("#per").css("border", "red solid 1px");
        //        } else {
        //            $('#per').popover('destroy');
        $("#per").css("border", "lightgrey solid 1px");
        //        }
    })

    $("#foreigner_nationality").on('keyup', function () {
        var foreigner_nationality = $(this).val().toUpperCase();
        if (foreigner_nationality == '' || (foreigner_nationality.length < '3')) {
            $("#foreigner_nationality").css("border", "red solid 1px");
        } else {
            $('#foreigner_nationality').popover('destroy');
            $("#foreigner_nationality").css("border", "lightgrey solid 1px");
        }
    })

    //    $("#copilot").autocomplete({
    //        minLength: 0,
    //        source: function (request, response) {
    //            $.ajax({
    //                type: "POST",
    //                url: base_url + "/fpl/copilot",
    //                dataType: "json",
    //                data: {
    //                    term: request.term.toUpperCase(),
    //                    aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
    //                },
    //                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
    //                success: function (data) {
    //                    response(data);
    //
    //                }
    //            });
    //        },
    //        select: function (event, ui) {
    //            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
    //                $("#copilot").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
    //                $("#copilot").css("border", "red solid 1px");
    ////                $('#copilot').popover('show');
    //            } else {
    //                $('#copilot').popover('destroy');
    //                $("#copilot").css("border", "lightgrey solid 1px");
    //            }
    //
    //        }
    //    }).click(function () {
    //        $(this).autocomplete('search', $(this).val());
    //    });

    $(".indian").on('click', function () {
        var indian = $("input[name='indian']:checked").val();
        if (indian == "YES") {
            $("#foreigner_nationality").attr('readonly', 'readonly');
            $('#foreigner_nationality').popover('destroy');
            $("#foreigner_nationality").css("border", "lightgrey solid 1px");
            $("#foreigner_nationality").val('');
        } else if (indian == "NO") {
            $("#foreigner_nationality").attr('data-content', 'Capt/ Co-Pilot/ Crew or Passengers Nationality must for ADC purpose. Min. 3 & Max. 50 Characters, only Alphabets & Numbers allowed');
            $("#foreigner_nationality").css("border", "red solid 1px");
            $("#foreigner_nationality").removeAttr('readonly');
            $("#foreigner_nationality").attr('required', 'required');
        } else {
            $("#foreigner_nationality").attr('readonly', 'readonly');
        }
    })

    $('.departure_time_hours,.departure_time_minutes,#date_of_flight,.form-row .deskview .ui-datepicker-trigger').on('change click', function (e) {
        var aircraft_callsign = $("#aircraft_callsign").val().toUpperCase();
        aircraft_callsign = aircraft_callsign.substr(0, 5);
        var data_url = base_url + '/fpl/get_callsign_details2';
        var selected_dof = $("#date_of_flight").val();
        console.log('date_of_flight ', selected_dof)
        var departure_aerodrome = $("#departure_aerodrome").val();
        var data = {
            'aircraft_callsign': aircraft_callsign,
            'selected_dof': selected_dof,
            'departure_aerodrome': departure_aerodrome
        };
        var is_myaccount = $("#is_myaccount").val();
        var is_result_dof = ''
        var total_time_after_flying = '';
        var total_flying_time_format1 = '';
        var total_flying_time_format2 = '';

        if (aircraft_callsign.length >= 5) {
            $.ajax({
                url: data_url,
                data: data,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function (data) {
                    //                    $("#total_time_after_flying").val(data.total_time_after_flying)
                    //                    $("#total_flying_time_format1").val(data.total_flying_time_format1)
                    //                    $("#total_flying_time_format2").val(data.total_flying_time_format2);
                    total_time_after_flying = data.total_time_after_flying;
                    total_flying_time_format1 = data.total_flying_time_format1;
                    total_flying_time_format2 = data.total_flying_time_format2;
                    console.log(data)
                },
                async: false,
                error: function (data) {
                    console.log(data);
                }

            });

        }
        var dep_time_hours = $('#dep_time_hours').text();
        $("#departure_time_hours").val(dep_time_hours);
        var dep_time_minutes = $('#dep_time_minutes').text();
        $("#departure_time_minutes").val(dep_time_minutes);
        var utcdate = $("#utcdate").val();
        var gmttime = $("#gmt_time").val();
        var date_of_flight = $("#date_of_flight").val();
        var utcdate_gmttime = utcdate + ":" + gmttime;
        var selected_dep_time = date_of_flight + ":" + dep_time_hours + ":" + dep_time_minutes;
        //        var total_time_after_flying = $("#total_time_after_flying").val();
        //        var total_flying_time_format1 = $("#total_flying_time_format1").val();
        //        var total_flying_time_format2 = $("#total_flying_time_format2").val();

        if ((($("#dep_time_hours").text() == 'Hr') && ($("#dep_time_minutes").text() == 'Min')) ||
                (($("#dep_time_hours").text() == 'Hr') || ($("#dep_time_minutes").text() == 'Min')) ||
                (($("#dep_time_hours").text() == '00') && ($("#dep_time_minutes").text() == '00')) ||
                (utcdate_gmttime > selected_dep_time && !is_myaccount)
                ) {
            $("#hour").attr('data-content', 'Min. 30 Minutes from present time only accepted');
            $("#hour").css("border", "red solid 1px");
            $("#mins").attr('data-content', 'Min. 30 Minutes from present time only accepted');
            $("#mins").css("border", "red solid 1px");

        } else if ((($("#dep_time_hours").text() == 'Hr') && ($("#dep_time_minutes").text() == 'Min')) ||
                (($("#dep_time_hours").text() == 'Hr') || ($("#dep_time_minutes").text() == 'Min')) ||
                (($("#dep_time_hours").text() == '00') && ($("#dep_time_minutes").text() == '00'))
                ) {
            $("#hour").attr('data-content', 'Dep Time selected is less than previous Flight Arrival Time of ' + total_flying_time_format1 + ' on ' + total_flying_time_format2);
            $("#hour").css("border", "red solid 1px");
            $("#mins").attr('data-content', 'Dep Time selected is less than previous Flight Arrival Time of ' + total_flying_time_format1 + ' on ' + total_flying_time_format2);
            $("#mins").css("border", "red solid 1px");

        } else {
            $('#hour').popover('destroy');
            $("#hour").css("border", "lightgrey solid 1px");
            $('#mins').popover('destroy');
            $("#mins").css("border", "lightgrey solid 1px");
            $("#hour").attr('data-content', '');
            $("#mins").attr('data-content', '');
        }
    });

    $('.crushing_speed_indication').on('click', function () {
        var crushing_speed_indication_value = $("#crushing_speed_indication_value").text();
        $("#crushing_speed_indication").val(crushing_speed_indication_value);
        if (($("#crushing_speed_indication").val()) == "---") {
            $("#crushing_speed").attr('maxlength', '4');
            $("#crushing_speed").val('');
            $("#setspeed").css("border", "red solid 1px");

        } else if (($("#crushing_speed_indication").val()) == "M") {
            $("#crushing_speed").attr('maxlength', '3');
            $("#crushing_speed").val('');
            $("#setspeed").css("border", "lightgrey solid 1px");
        } else {
            $("#crushing_speed").attr('maxlength', '4');
            $("#crushing_speed").val('');
            $("#setspeed").css("border", "lightgrey solid 1px");
        }
    });

    $(".total_flying_hours").on('click', function () {
        var total_time_minutes = $("#total_time_minutes").text();
        var total_time_hours = $("#total_time_hours").text();
        if (total_time_minutes == "00" && total_time_hours == '00') {
            $("#total_mins").css("border", "red solid 1px");
            $("#total_hour").css("border", "red solid 1px");
        } else {
            $("#total_mins").css("border", "lightgrey solid 1px");
            $("#total_hour").css("border", "lightgrey solid 1px");
        }
        $("#total_flying_hours").val(total_time_hours);
    });

    $(".total_flying_minutes").on('click', function () {
        var total_time_minutes = $("#total_time_minutes").text();
        var total_time_hours = $("#total_time_hours").text();
        if (total_time_minutes == "00" && total_time_hours == '00') {
            $("#total_mins").css("border", "red solid 1px");
            $("#total_hour").css("border", "red solid 1px");
        } else {
            $("#total_mins").css("border", "lightgrey solid 1px");
            $("#total_hour").css("border", "lightgrey solid 1px");
        }
        $("#total_flying_minutes").val(total_time_minutes);
    });

    $(".transponder").on('click', function () {
        var transponder_value = $("#transponder_value").text();
        $("#transponder").val(transponder_value);
    });

    $(".flight_type").on('click', function () {
        var flight_type_value = $("#flight_type_value").text();
        $("#flight_type").val(flight_type_value);
    });

    $(".weight_category").on('click', function () {
        var weight_category_value = $("#weight_category_value").text();
        $("#weight_category").val(weight_category_value);
    });

    $(".flight_rules").on('click', function () {
        var flight_rules_value = $("#flight_rules_value").text();
        $("#flight_rules").val(flight_rules_value);
    });

    $("input[name=credit]").on('click', function () {
        $(".credit_color").removeClass('text-red');
    })

    $(".emergency_checkbox").on('click mouseenter', function () {
        var checked_count = $(".emergency_checkbox:checked").size();
        var not_checked_id = $("input:checkbox[class=emergency_checkbox]:not(:checked)").attr('id');
        var emergency_checkbox = $("input:checkbox[class=emergency_checkbox]:checked").val();
        if (checked_count >= 2) {
            $("#" + not_checked_id).attr('disabled', 'disabled');
        } else {
            $('.emergency_checkbox').removeAttr('disabled');
        }
        if (emergency_checkbox == 'uhf' || emergency_checkbox == 'vhf' || emergency_checkbox == 'elba') {
            $('.emergency_border').css('border', "lightgrey solid 1px");
        } else {
            $('.emergency_border').css('border', "red solid 1px");
        }
    })

    $(".survival_checkbox").on('click mouseenter', function () {
        var checked_count = $(".survival_checkbox:checked").length;
        var not_checked_id = $("input:checkbox[class=survival_checkbox]:not(:checked)").attr('id');

        //        if (checked_count > 4) {
        //            $("#" + not_checked_id).attr('disabled', 'disabled');
        //        } else {
        //            $(".survival_checkbox").removeAttr('disabled');
        //        }
        //        if (checked_count > 4) {
        //            $(".survival_border").css('border', 'red solid 1px');
        //        } else {
        //            $(".survival_border").css('border', 'lightgrey solid 1px');
        //        }
    })

    $(".jackets_checkbox").on('click mouseenter', function () {
        var checked_count = $("input:checkbox[class=jackets_checkbox]:checked").length;
        var not_checked_id = $("input:checkbox[class=jackets_checkbox]:not(:checked)").attr('id');
        if (checked_count > 4) {
            $("#" + not_checked_id).attr('disabled', 'disabled');
        } else {
            $(".jackets_checkbox").removeAttr('disabled');
        }
        if (checked_count > 4) {
            $(".jackets_border").css('border', 'red solid 1px');
        } else {
            $(".jackets_border").css('border', 'lightgrey solid 1px');
        }
    })

    $("#crushing_speed").keyup(function () {
        var crushing_speed = $("#crushing_speed").val();
        var crushing_speed_indication = $("#crushing_speed_indication_value").text();
        if (crushing_speed_indication == "M") {
            $("#crushing_speed").attr('maxlength', '3');
            if ((crushing_speed.length == "") || (crushing_speed.length <= "2")) {
                $("#crushing_speed").css('border', '#ff0000 solid 1px');
            } else {
                $("#crushing_speed").css('border', 'lightgrey solid 1px');
            }


        } else {
            $("#crushing_speed").attr('maxlength', '4');
            if ((crushing_speed.length == "") || (crushing_speed.length <= "3")) {
                $("#crushing_speed").css('border', '#ff0000 solid 1px');
            } else {
                $("#crushing_speed").css('border', 'lightgrey solid 1px');
            }

        }
    });

    $('.flight_level_indication').on('click', function () {
        var flight_level_indication_value = $("#flight_level_indication_value").text();
        $("#flight_level_indication").val(flight_level_indication_value);
        if (flight_level_indication_value == '---') {
            $("#setspeedvalue").css("border", "#ff0000 solid 1px");
        } else {
            $("#setspeedvalue").css("border", "lightgrey solid 1px");
        }
    });

    $('.endurance_hours').on('click', function () {
        var endurance_time_hours = $("#endurance_time_hours").text();
        $("#endurance_hours").val(endurance_time_hours);
        if (endurance_time_hours == '---') {
            $("#endurhours").css("border", "#ff0000 solid 1px");
        } else {
            $("#endurhours").css("border", "lightgrey solid 1px");
        }
    });

    $('.endurance_minutes').on('click', function () {
        var endurance_time_minutes = $("#endurance_time_minutes").text();
        $("#endurance_minutes").val(endurance_time_minutes);
        if (endurance_time_minutes == '---') {
            $("#endurmins").css("border", "#ff0000 solid 1px");
        } else {
            $("#endurmins").css("border", "lightgrey solid 1px");
        }
    });

    //    $('#indian').on('click', function () {
    //        $("#foreigner_nationality").attr('readonly', 'readonly');
    //        $("#indian").val('YES');
    //        $("#indian").attr('checked','checked');
    //         $("#foreigner").removeAttr('checked');
    //    });

    //    $('#foreigner').on('click', function () {
    //        $("#foreigner_nationality").removeAttr('readonly');
    //         $("#foreigner").val('YES');
    //        $("#foreigner").attr('checked','checked');
    //         $("#indian").removeAttr('checked');
    //        $("#foreigner_nationality").attr('data-content', 'Capt/ Co-Pilot/ Crew or Passengers Nationality must for ADC purpose. Min. 3 & Max. 50 Characters, only Alphabets & Numbers allowed');
    //            $("#foreigner_nationality").css("border", "red solid 1px");
    //            $("#foreigner_nationality").removeAttr('readonly');
    //            $("#foreigner_nationality").attr('required', 'required');
    //    });

    $("#departure_aerodrome,#destination_aerodrome").keyup(function () {
        var departure_aerodrome = $("#departure_aerodrome").val().toUpperCase();
        var destination_aerodrome = $("#destination_aerodrome").val().toUpperCase();
        var dep_aero_first2char = departure_aerodrome.substring(0, 2);
        var dest_aero_first2char = destination_aerodrome.substring(0, 2);

        if (departure_aerodrome == 'ZZZZ' && destination_aerodrome != 'ZZZZ') {
            $("#flight_rules_value").text('Z');
        } else if (destination_aerodrome == 'ZZZZ' && departure_aerodrome != 'ZZZZ') {
            $("#flight_rules_value").text('Y');
        } else if (destination_aerodrome == 'ZZZZ' && departure_aerodrome == 'ZZZZ') {
            $("#flight_rules_value").text('V');
        } else if (destination_aerodrome != '' || departure_aerodrome != '') {
            $("#flight_rules_value").text('I');
        } else {
            $("#flight_rules_value").text('Flight Rule');
        }
        var flight_rules_value = $("#flight_rules_value").text();
        $("#flight_rules").val(flight_rules_value);
        if (((destination_aerodrome == "ZZZZ") || (departure_aerodrome == "ZZZZ"))) {
            $("#fir_crossing_time").removeAttr('readonly');
            $("#fir_crossing_time").removeAttr('required');
            $("#fir_crossing_time").css("border", "lightgrey solid 1px");
            $("#fir_crossing_time").val('');
        } else if (dep_aero_first2char != dest_aero_first2char && departure_aerodrome.length >= 4 && destination_aerodrome.length >= 4) {
            $("#fir_crossing_time").removeAttr('readonly');
            $("#fir_crossing_time").attr('required', 'required');
            $("#fir_crossing_time").css("border", "red solid 1px");
            $("#fir_crossing_time").val('');
        } else {
            $("#fir_crossing_time").attr('readonly', 'readonly');
            $("#fir_crossing_time").css("border", "lightgrey solid 1px");
        }
    });

    $("#fir_crossing_time").on('keyup', function () {
        var fir_crossing_time = $('#fir_crossing_time').val();
        if (fir_crossing_time == '' || (fir_crossing_time.length >= '1') && (fir_crossing_time.length <= '7')) {
            $("#fir_crossing_time").css("border", "red solid 1px");
        } else {
            $('#fir_crossing_time').popover('destroy');
            $("#fir_crossing_time").css("border", "lightgrey solid 1px");
        }
    });

    $("#fir_crossing_time2").on('keypress', function (e) {
        var fir_crossing_time = $('#fir_crossing_time').val();
        var is_fir_crossing = $("#is_fir_crossing").val();
        var fir_length = fir_crossing_time.length;
        var fir_array = ['VABF', 'VECF', 'VOMF', 'VIDF', 'VCCF', 'VGFR'];
        var validation = true;
        if (is_fir_crossing) {
            fir_crossing_time
        }
        if (fir_crossing_time.length % 8 == 0 && fir_crossing_time.length > 1 && fir_crossing_time.length != 16 && fir_crossing_time.length < 16) {
            fir_crossing_space(e);
        } else if ((fir_crossing_time.length % 17 == 0) && fir_crossing_time.length > 16 && fir_crossing_time.length != 34) {
            fir_crossing_space(e);
        } else if ((fir_crossing_time.length % 26 == 0) && fir_crossing_time.length > 25) {
            fir_crossing_space(e);
        } else if ((fir_crossing_time.length % 35 == 0) && fir_crossing_time.length > 34) {
            fir_crossing_space(e);
        } else if ((fir_crossing_time.length % 44 == 0) && fir_crossing_time.length > 43) {
            fir_crossing_space(e);
        } else {
            if (fir_length <= 3) {
                fir_crossing_alpha(e);
            } else if (fir_length <= 12 && fir_length >= 9) {
                fir_crossing_alpha(e);
            } else if (fir_length <= 21 && fir_length >= 17) {
                fir_crossing_alpha(e);
            } else if (fir_length <= 30 && fir_length >= 26) {
                fir_crossing_alpha(e);
            } else if (fir_length <= 39 && fir_length >= 35) {
                fir_crossing_alpha(e);
            } else if (fir_length <= 48 && fir_length >= 44) {
                fir_crossing_alpha(e);
            } else {
                fir_crossing_number(e);
                if (fir_length <= 4) {
                    if ($.inArray(fir_crossing_time.substring(0, 4), fir_array) > -1) {
                        $("#fir_crossing_time").css('color', '');
                    } else {
                        $("#fir_crossing_time").css('color', 'red');
                        validation = false;
                    }
                } else if (fir_length <= 13 && fir_length >= 9) {
                    if ($.inArray(fir_crossing_time.substr(9, 4), fir_array) > -1) {
                        $("#fir_crossing_time").css('color', '');
                    } else {
                        $("#fir_crossing_time").css('color', 'red');
                        validation = false;
                    }
                } else if (fir_length <= 23 && fir_length >= 19) {
                    if ($.inArray(fir_crossing_time.substr(18, 4), fir_array) > -1) {
                        $("#fir_crossing_time").css('color', '');
                    } else {
                        $("#fir_crossing_time").css('color', 'red');
                        validation = false;
                    }

                } else if (fir_length <= 31 && fir_length >= 27) {
                    if ($.inArray(fir_crossing_time.substr(27, 4), fir_array) > -1) {
                        $("#fir_crossing_time").css('color', '');
                    } else {
                        $("#fir_crossing_time").css('color', 'red');
                        validation = false;
                    }
                } else if (fir_length <= 40 && fir_length >= 35) {
                    if ($.inArray(fir_crossing_time.substr(36, 4), fir_array) > -1) {
                        $("#fir_crossing_time").css('color', '');
                    } else {
                        $("#fir_crossing_time").css('color', 'red');
                        validation = false;
                    }
                } else if (fir_length <= 49 && fir_length >= 44) {
                    if ($.inArray(fir_crossing_time.substr(45, 4), fir_array) > -1) {
                        $("#fir_crossing_time").css('color', '');
                    } else {
                        $("#fir_crossing_time").css('color', 'red');
                        validation = false;
                    }
                } else {
                    $("#fir_crossing_time").css('color', '');
                }
            }
        }
        if (!validation) {
            return false;
        }


    });

    function fir_crossing_space(e) {
        var regex = new RegExp("^[ ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (e.charCode == 32) {
            $("#is_fir_crossing").val('1');
        }
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    }

    function fir_crossing_alpha(e) {
        var regex = new RegExp("^[a-zA-Z]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    }

    function fir_crossing_number(e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    }
    $("#remarks").on('keyup', function () {
        var remarks = $('#remarks').val();
        if (remarks == '' || remarks.length < '3') {
            //                $("#remarks").attr('data-content', 'Additional info for ATC or MLU. Min. 3 & Max. 150 Characters only Alphabets Numbers Space and / Character allowed');
            $("#remarks").css("border", "red solid 1px");
        } else {
            $('#remarks').popover('destroy');
            $("#remarks").css("border", "lightgrey solid 1px");
        }
    });

    $("#aircraft_type").on('keyup', function () {
        var aircraft_type = $('#aircraft_type').val();
        if (aircraft_type == '' || aircraft_type.length < '3') {
            $("#aircraft_type").css("border", "red solid 1px");
        } else {
            $("#aircraft_type").css("border", "lightgrey solid 1px");
        }
    });

    $("#flight_level").on('keyup', function () {
        var flight_level = $('#flight_level').val();
        if (flight_level == '' || flight_level.length < '3') {
            $("#flight_level").css("border", "red solid 1px");
        } else {
            $("#flight_level").css("border", "lightgrey solid 1px");
        }
    });

    $("#take_off_altn").keyup(function () {

        var take_off_altn = $("#take_off_altn").val();
        if ((take_off_altn.length >= '1') && (take_off_altn.length <= '3')) {
            $("#take_off_altn").css("border", "red solid 1px");

        } else {
            $("#take_off_altn").css("border", "lightgrey solid 1px");
        }
    });

    $("#route1").keyup(function () {
        var route1 = $("#route1").val();
        if ((route1.length >= '1') && (route1.length <= '2')) {
            $("#route1").css("border", "red solid 1px");
        } else {
            $("#route1").css("border", "lightgrey solid 1px");
        }
    });

    $("#route").keyup(function () {
        var route = $("#route").val();
        if ((route.length >= '1') && (route.length <= '2')) {
            $("#route").css("border", "red solid 1px");
        } else {
            $("#route").css("border", "lightgrey solid 1px");
        }
    });

    $("#route_altn").keyup(function () {
        var route_altn = $("#route_altn").val();
        if ((route_altn.length >= '1') && (route1.length <= '3')) {
            $("#route_altn").css("border", "red solid 1px");
        } else {
            $("#route_altn").css("border", "lightgrey solid 1px");
        }
    });

    $("#color").keyup(function () {
        var color = $("#color").val();
        if (color.length == '1') {
            $("#color").css("border", "red solid 1px");

        } else {
            $("#color").css("border", "lightgrey solid 1px");
        }
    });

    $("#aircraft_color").keyup(function () {
        var aircraft_color = $("#aircraft_color").val();
        if (aircraft_color == '' || aircraft_color.length < '3') {
            $("#aircraft_color").css("border", "red solid 1px");

        } else {
            $("#aircraft_color").css("border", "lightgrey solid 1px");
        }
    });

    //    $('#indian').on('click', function () {
    //        $("#foreigner_nationality").attr('readonly', 'readonly');
    //    });

    //    $('#foreigner').on('click', function () {
    //        $("#foreigner_nationality").removeAttr('readonly');
    //    });

    //     $(".disabled_onclick").off();
    //      $(".disabled_onclick").prop("onclick", null);
    $("#hour").on('click', function () {
        $("#reset").addClass('hidden');
        $("#process").removeClass('hidden');
    });
    $(".file_the_plan").on('click', function () {
        console.log('hi');
        var data = $("form[id='quick_fpl']").serialize();
        var environment = $("#environment").val();
        if (environment == 'local') {
            var urls = [base_url + "/api/fpl/file_the_process"];
            //["http://localhost:8080/pvtflightnew/public/api/fpl/file_the_process"];
            var time_interval = 110;
        } else if (environment == 'eflightproduction2' || environment == 'eflcoin2') {
            //            var urls = ["https://eflight.co.in/api/fpl/file_the_process",
            //                'https://eflight.aero/api/fpl/file_the_process'];
            var urls = [base_url + "/api/fpl/file_the_process"];
            var time_interval = 110;
        } else {
            var urls = [base_url + "/api/fpl/file_the_process"];
            var time_interval = 110;
        }
        var urls = [base_url + "/api/fpl/file_the_process"];
        var val = 0;
        var interval = setInterval(function () {
            val = val + 1;
            $("#progress_bar").progressbar({value: val});
            $("#percentage").html(val + " %");
            if (val >= 100) {
                clearInterval(interval);
            }
        }, time_interval);
        $(".fpl_loader").html('<a href=""><i style="color:#f1292b;font-size:1.3em" class="fa fa-spinner fa-spin"></i></a><span style="font-weight:bold"> Please Wait Processing ...</span>');
        $(".fpl_modal_text").hide();
        $(".fpl_modal_text").addClass('hidden')

//        $.each(urls, function(i, urls) {
//            $.ajax(urls, {
//                type: 'POST',
//                data: data,
//                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
//                success: function(data) {
//                    if (data.STATUS_DESC == 'Success' && data.STATUS_CODE == 1) {
//                        $("#success_message_forgot").html('<span style="color: green;">' + data.success_message + '</span>')
//                        $("#error_message_forgot").html('')
//                        $("#confbox").modal('hide');
//                        window.location = base_url + '/fpl?quick_id=' + data.id;
//                    } else {
//                        $(".fpl_loader").html('<span style=color:red>' + data.STATUS_DESC + '</span>')
//                        return false;
//                    }
//                }
//            });
//        });

        $.ajax({
            url: urls,
            type: 'POST',
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                if (data.STATUS_DESC == 'Success' && data.STATUS_CODE == 1) {
                    $("#success_message_forgot").html('<span style="color: green;">' + data.success_message + '</span>')
                    $("#error_message_forgot").html('')
                    $("#confbox").modal('hide');
                    window.location = base_url + '/fpl?quick_id=' + data.id;
                } else {
                    $(".fpl_loader").html('<span style=color:red>' + data.STATUS_DESC + '</span>')
                    return false;
                }
            }
        });

    });
    $(".file_the_process").on('click', function () {
        var data = $("form[id='quick_fpl']").serialize();
        var data_url = $(this).attr('data-url');
        console.log('Data', data);
        $.ajax({
            url: data_url,
            type: 'GET',
            data: data,
            cache: false,
            success: function (data, textStatus, jqXHR) {
                if (data.success) {
                    $("#auto_cancel_alert").modal();
                } else {
                    $("#confbox").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });

    });
    $(".change_fpl_myaccount").on('click', function () {
        var data = $("form#new_fpl").serialize();
        $("#change_fpl_myaccount").val('1')
        validform('change_plan_modal');
    });
    $(".onclick_change_plan_modal").on('click', function () {
        var data = $("form#new_fpl").serialize();
        var environment = $("#environment").val();
        // data = data + '&is_myaccount=1';
        console.log(data)
        if (environment == 'local') {
            var urls = [base_url + "/api/fpl/new_plan"]; //["http://localhost:8080/pvtflightnew/public/api/fpl/file_the_process"];
            var time_interval = 45;
        } else if (environment == 'eflightproduction') {
            //            var urls = ["https://eflight.aero/api/fpl/file_the_process", 'http://privateflight.co.in/api/fpl/file_the_process'];
            var time_interval = 80;
        } else {
            //            var urls = ["https://eflight.aero/api/fpl/file_the_process", 'http://privateflight.co.in/api/fpl/file_the_process'];
            var time_interval = 80;
        }
        var urls = [base_url + "/api/fpl/new_plan"];
        var val = 0;
        var interval = setInterval(function () {
            val = val + 1;
            $("#progress_bar").progressbar({value: val});
            $("#percentage").html(val + " %");
            if (val >= 100) {
                clearInterval(interval);
            }
        }, time_interval);
        $(".fpl_loader").html('<a href=""><i style="color:#f1292b;font-size:1.3em" class="fa fa-spinner fa-spin"></i></a><span style="font-weight:bold"> Please Wait Processing ...</span>');
        $(".fpl_modal_text").hide();
        $(".fpl_modal_text").addClass('hidden')

        //        $.each(urls, function (i, urls) {
        //            $.ajax(urls,
        //                    {type: 'POST',
        //                        data: data,
        //                        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
        //                        success: function (data) {
        //                            if (data.STATUS_DESC == 'Success' && data.STATUS_CODE == 1) {
        //                                $("#success_message_forgot").html('<span style="color: green;">' + data.success_message + '</span>')
        //                                $("#error_message_forgot").html('')
        //                                $("#confbox").modal('hide');
        //                                window.location = base_url + '/fpl?quick_id=' + data.id;
        //                            } else {
        //                                $(".fpl_loader").html('<span style=color:red>' + data.STATUS_DESC + '</span>')
        //                                return false;
        //                            }
        //                        }
        //                    }
        //            );
        //        });
        $.ajax({
            url: urls,
            type: 'POST',
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                if (data.STATUS_DESC == 'Success' && data.STATUS_CODE == 1) {
                    $("#confirm_change_plan").modal('hide');
                    window.location = base_url + '/fpl?change_fpl_id=' + data.id;
                } else {
                    window.location = base_url + '/fpl';
                    return false;
                }
            }
        });
    });
    $(".get_plan_status").on('keyup', function () {
        var aircraft_callsign = $("#aircraft_callsign").val().toUpperCase();
        aircraft_callsign = aircraft_callsign.substr(0, 5);
        var selected_dof = $("#date_of_flight").val();
        var departure_aerodrome = $("#departure_aerodrome").val().toUpperCase();
        var destination_aerodrome = $("#destination_aerodrome").val().toUpperCase();
        var departure_station = $("#departure_station").val().toUpperCase();
        var destination_station = $("#destination_station").val().toUpperCase();
        var data_url = base_url + "/fpl/get_plan_status";
        var data = {
            'aircraft_callsign': aircraft_callsign,
            'selected_dof': selected_dof,
            'departure_aerodrome': departure_aerodrome,
            'destination_aerodrome': destination_aerodrome,
            'departure_station': departure_station,
            'destination_station': destination_station
        };
        if (aircraft_callsign.length >= 5 && departure_aerodrome.length >= 4 && destination_aerodrome.length >= 4) {
            $.ajax({
                url: data_url,
                type: 'GET',
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data, textStatus, jqXHR) {
                    if (data.STATUS_DESC == 'Success' && data.STATUS_CODE == 1) {
                        $("#get_plan_status").html($(".success").html('<p style="color:#f1292b" class="animated  zoomIn custdelay">' + data.success + '</p>'));
                    } else {
                        console.log(data)
                    }
                }
            });
        }
    });

    $("#departure_latlong").on('keyup', function (e) {
        var departure_latlong = $("#departure_latlong").val().toUpperCase();
        var dep_latlong_length = departure_latlong.length;
        //        console.log(dep_latlong_length)
        if (dep_latlong_length == 11) {
            var d1 = $.isNumeric(departure_latlong.substr(0, 4));
            var d2 = $.isNumeric(departure_latlong.substr(5, 5));
            var d3 = false;
            var d4 = false;
            if (departure_latlong.substr(4, 1) == 'N') {
                d3 = true;
            }
            if (departure_latlong.substr(10, 1) == 'E') {
                d4 = true;
            }
            console.log(d1 + ' ' + d2 + ' ' + d3 + ' ' + d4);
            if (!d1 || !d2 || !d3 || !d4) {
                $("#departure_latlong").attr('data-content', 'Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)');
                $("#departure_latlong").css("border", "red solid 1px");
            } else {
                $('#departure_latlong').popover('destroy');
                $("#departure_latlong").css("border", "lightgrey solid 1px");
            }
        } else if (dep_latlong_length == 15) {
            var d1 = $.isNumeric(departure_latlong.substr(0, 6));
            var d2 = $.isNumeric(departure_latlong.substr(7, 7));
            var d3 = false;
            var d4 = false;
            if (departure_latlong.substr(6, 1) == 'N') {
                d3 = true;
            }
            if (departure_latlong.substr(14, 1) == 'E') {
                d4 = true;
            }
            if (!d1 && !d2 && !d3 && !d4) {
                $("#departure_latlong").attr('data-content', 'Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)');
                $("#departure_latlong").css("border", "red solid 1px");
            } else {
                $('#departure_latlong').popover('destroy');
                $("#departure_latlong").css("border", "lightgrey solid 1px");
            }
        } else {
            $("#departure_latlong").attr('data-content', 'Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)');
            $("#departure_latlong").css("border", "red solid 1px");
        }
    })

    $("#destination_latlong").on('keyup', function (e) {
        var destination_latlong = $("#destination_latlong").val().toUpperCase();
        var dest_latlong_length = destination_latlong.length;
        console.log(dest_latlong_length)
        if (dest_latlong_length == 11) {
            var d1 = $.isNumeric(destination_latlong.substr(0, 4));
            var d2 = $.isNumeric(destination_latlong.substr(5, 5));
            var d3 = false;
            var d4 = false;
            if (destination_latlong.substr(4, 1) == 'N') {
                d3 = true;
            }
            if (destination_latlong.substr(10, 1) == 'E') {
                d4 = true;
            }
            if (!d1 || !d2 || !d3 || !d4) {
                $("#destination_latlong").attr('data-content', 'Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)');
                $("#destination_latlong").css("border", "red solid 1px");
            } else {
                $('#destination_latlong').popover('destroy');
                $("#destination_latlong").css("border", "lightgrey solid 1px");
            }
        } else if (dest_latlong_length == 15) {
            var d1 = $.isNumeric(destination_latlong.substr(0, 6));
            var d2 = $.isNumeric(destination_latlong.substr(7, 7));
            var d3 = false;
            var d4 = false;
            if (destination_latlong.substr(6, 1) == 'N') {
                d3 = true;
            }
            if (destination_latlong.substr(14, 1) == 'E') {
                d4 = true;
            }
            console.log(d1 + ' ' + d2 + ' ' + d3 + ' ' + d4);
            if (!d1 || !d2 || !d3 || !d4) {
                $("#destination_latlong").attr('data-content', 'Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)');
                $("#destination_latlong").css("border", "red solid 1px");
            } else {
                $('#destination_latlong').popover('destroy');
                $("#destination_latlong").css("border", "lightgrey solid 1px");
            }
        } else {
            $("#destination_latlong").attr('data-content', 'Min. 11 or Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1234N56789E or 112233N4455667E)');
            $("#destination_latlong").css("border", "red solid 1px");
        }
    });

    $(".check_watch_hour").on('keyup', function () {
        var date_of_flight = $("#date_of_flight").val();
        var id = $(this).attr('id');
        var aerodrome = $("#" + id).val();
        var data = {"date_of_flight": date_of_flight, 'aerodrome': aerodrome}
        if (aerodrome.length == 4) {
            $.ajax({
                type: "GET",
                url: base_url + '/fpl/get_watch_hours',
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    switch (id) {
                        case 'departure_aerodrome':
                            $(".watch_hour_box1").html('<div class="oc-time-box1" style="box-shadow: 0 0 3px 1px #000">' + data.STATUS_DESC + '</div>');
                            break;
                        case 'destination_aerodrome':
                            $(".watch_hour_box2").html('<div class="oc-time-box2" style="box-shadow: 0 0 3px 1px #000">' + data.STATUS_DESC + '</div>');
                            break;
                        case 'first_alternate_aerodrome':
                            $(".watch_hour_box3").html('<div class="oc-time-box3" style="box-shadow: 0 0 3px 1px #000">' + data.STATUS_DESC + '</div>');
                            break;
                        case 'second_alternate_aerodrome':
                            $(".watch_hour_box4").html('<div class="oc-time-box4" style="box-shadow: 0 0 3px 1px #000">' + data.STATUS_DESC + '</div>');
                            break;


                    }
                }
            });
        }
    });


    $(document).on('click', ".view_the_notams", function () {
        var dof = $("#date_of_flight").val();
        var airportcodeArr = [];
        var a = $(this).attr('data-a');
        var b = $(this).attr('data-b');
        var c = $(this).attr('data-c');
        var d = $(this).attr('data-d');
        var deptime = $(this).attr('data-dep-time');
        var flyingTime = $(this).attr('data-flying-time');
        var flyingTimeInMins = parseInt(flyingTime.split(':')[0] * 60) + parseInt(flyingTime.split(':')[1]);

        var startDateMoment = moment(dof + ' ' + deptime, 'DD-MMM-YYYY HH:mm').add(-120, 'minutes');
        var endDateMoment = moment(dof + ' ' + deptime, 'DD-MMM-YYYY HH:mm').add((flyingTimeInMins + 180), 'minutes');
        console.log(startDateMoment.format('DD-MMM-YYYY HH:mm'));
        console.log(endDateMoment.format('DD-MMM-YYYY HH:mm'));
        var start_date = startDateMoment.format('DD-MMM-YYYY');
        var end_date = endDateMoment.format('DD-MMM-YYYY');

        var startTimeremainder = 30 - (startDateMoment.minute() % 30);

        if (startTimeremainder > 15) {
            startDateMoment = moment(startDateMoment).subtract((30 - startTimeremainder), "minutes");
        } else {
            startDateMoment = moment(startDateMoment).add(startTimeremainder, "minutes");

        }

        var start_time = startDateMoment.format('HHmm');

        var endTimeremainder = 30 - (endDateMoment.minute() % 30);

        if (endTimeremainder > 15) {
            endDateMoment = moment(endDateMoment).subtract((30 - endTimeremainder), "minutes");

        } else {
            endDateMoment = moment(endDateMoment).add(endTimeremainder, "minutes");
        }
        // console.log(startTimeremainder, endTimeremainder);
        var end_time = endDateMoment.format('HHmm');

        var fir_names = {
            'VI': 'VIDF',
            'VE': 'VECF',
            'VA': 'VABF',
            'VO': 'VOMF'
        };
        if (a) {
            if (airportcodeArr.indexOf(a) == -1) {
                airportcodeArr.push(a);
            }

        }
        if (b) {
            if (airportcodeArr.indexOf(b) == -1) {
                airportcodeArr.push(b);
            }

        }
        if (c) {
            if (airportcodeArr.indexOf(c) == -1) {
                airportcodeArr.push(c);
            }

        }
        if (d) {
            if (airportcodeArr.indexOf(d) == -1) {
                airportcodeArr.push(d);
            }

        }
        var depFir = fir_names[a.substring(0, 2)];
        if (depFir != undefined && airportcodeArr.indexOf(depFir) == -1) {
            airportcodeArr.push(depFir);
        }
        var arrFir = fir_names[b.substring(0, 2)];
        if (arrFir != undefined && airportcodeArr.indexOf(arrFir) == -1) {
            airportcodeArr.push(arrFir);
        }
        var altnFir = fir_names[c.substring(0, 2)];
        if (altnFir != undefined && airportcodeArr.indexOf(altnFir) == -1) {
            airportcodeArr.push(altnFir);
        }
        var altnFir = fir_names[d.substring(0, 2)];
        if (altnFir != undefined && airportcodeArr.indexOf(altnFir) == -1) {
            airportcodeArr.push(altnFir);
        }

        var airport_code = airportcodeArr.join();
        console.log(airport_code);

        var data = {
            "fromdate": start_date,
            "todate": end_date,
            "startTime": start_time,
            "endTime": end_time,
            "airportcode": airport_code,
            "callsign": $('#aircraft_callsign').val(),
            "dof": dof,
            "_token": $('meta[name="_token"]').attr('content')
        };
        console.log('Data ', data);
        // return;
        $.redirect(base_url + '/notams/fplnotams', data, 'POST', '_blank');
    });

    $(".auto_callsigns").autocomplete({
        minLength: 3,
        source: function (request, response) {
            $.getJSON("/new_fpl/auto_callsigns", {
                term: request.term
            }, response);

        },
        select: function (event, ui) {
            console.log("ui", ui)
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#aircraft_callsign").css("border", "red solid 1px");
            } else {
                $("#aircraft_callsign").css("border", "lightgrey solid 1px");
                var aircraft_callsign = ui.item.value;//$(this).val().toUpperCase();
                aircraft_callsign = aircraft_callsign.substr(0, 5);
                var aircraft_callsign2 = aircraft_callsign.substr(0, 2);
                var selected_dof = $("#date_of_flight").val();
                var departure_aerodrome = $("#departure_aerodrome").val();
                var data_url = $(this).attr('data-url');
                var data = {
                    'flag': 'aircraft_callsign',
                    'aircraft_callsign': aircraft_callsign,
                    'selected_dof': selected_dof,
                    'departure_aerodrome': departure_aerodrome
                };
                $("#departure_station").attr('readonly', 'readonly');
                $("#departure_latlong").attr('readonly', 'readonly');
                //        $("#aircraft_callsign").css("border", "red solid 1px");
                if (aircraft_callsign.length >= 5) {
                    $.ajax({
                        url: data_url,
                        data: data,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success: function (data) {
                            $("#pilot_in_command").val(data.pilot_in_command.toUpperCase());
                            $("#mobile_number").val(data.mobile_number);
                            $("#copilot").val(data.copilot.toUpperCase());
                            $("#cabincrew").val(data.cabincrew.toUpperCase());
                            $("#departure_aerodrome").val(data.departure_aerodrome.toUpperCase());
                            if (data.departure_aerodrome == 'ZZZZ') {
                                $("#departure_station").val(data.destination_station.toUpperCase());
                                $("#departure_latlong").val(data.destination_latlong.toUpperCase());
                                $("#departure_station").removeAttr('readonly')
                                $("#departure_latlong").removeAttr('readonly')
                            }
                            $("#total_time_after_flying").val(data.total_time_after_flying)
                            $("#total_flying_time_format1").val(data.total_flying_time_format1)
                            $("#total_flying_time_format2").val(data.total_flying_time_format2)
                            $("#aircraft_callsign").css("border", "lightgrey solid 1px");
                            if (data.departure_aerodrome && aircraft_callsign2 == 'VT') {
                                $("#destination_aerodrome").focus();
                                // $("#departure_aerodrome").attr('readonly','readonly');
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
                    $("#aircraft_callsign").css("border", "red solid 1px");
                    $("#departure_aerodrome").val('');
                }



            }

        }
    });

}); //End of document
