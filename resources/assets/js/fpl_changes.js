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
    var currentDate = $("#date_of_flight").val();//document.getElementById("utcdate").value;
    var current_day = currentDate.substr(4, 2);
    var current_month = currentDate.substr(3, 1) - 1;
    var current_year = '20' + currentDate.substr(0, 2);

    // Datepicker code
    var currentTime = new Date();
    var month = currentTime.getMonth() + 1
    var day = currentTime.getDate();
    var year = currentTime.getFullYear()
    var todaydate = year + "-" + month + "-" + day;
    var day2 = currentTime.getDate() + 1;
    var seconddate = year + "-" + month + "-" + day2;
    var day3 = currentTime.getDate() + 2;
    var thirddate = year + "-" + month + "-" + day3;
    var day4 = currentTime.getDate() + 3;
    var fourthdate = year + "-" + month + "-" + day4;
    var day5 = currentTime.getDate() + 4;
    var fifthdate = year + "-" + month + "-" + day5;
    var readonlyDays = [todaydate, seconddate, thirddate, fourthdate, fifthdate];
    var date = new Date();
    var min_date = new Date(current_year, current_month, current_day);
    var max_date = addDays(min_date, 4);

    $(".datepicker").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon.png', buttonImageOnly: true, minDate: min_date, maxDate: max_date, showOtherMonths: true, selectOtherMonths: true,
        showAnim: "slide",
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function (date) {
            var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
            for (i = 0; i < readonlyDays.length; i++) {
                if ($.inArray(y + '-' + (m + 1) + '-' + d, readonlyDays) != -1) {
                    //return [false];
                    return [true, 'dp-highlight-date', ''];
                }
            }
            return [true];
        }
    });
    $(".datepicker").datepicker("option", "dateFormat", "ymmdd");
    $(".datepicker").datepicker("setDate", currentDate);

    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    $(".from_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon.png', buttonImageOnly: true, maxDate: max_date});
    $(".from_date").datepicker("option", "dateFormat", "ymmdd");
    $("#from_date").datepicker("setDate", from_date);
    $(".to_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon.png', buttonImageOnly: true, maxDate: max_date});
    $(".to_date").datepicker("option", "dateFormat", "ymmdd");
    $("#to_date").datepicker("setDate", to_date);

    //get Call Sign details
    $("#aircraft_callsign").on('keyup', function () {
        var aircraft_callsign = $(this).val().toUpperCase();
        aircraft_callsign = aircraft_callsign.substr(0, 5);
        var data_url = $(this).attr('data-url');
        var data = {'flag': 'aircraft_callsign', 'aircraft_callsign': aircraft_callsign};
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
                    $("#pilot_in_command").val(data.pilot_in_command);
                    $("#mobile_number").val(data.mobile_number);
                    $("#copilot").val(data.copilot);
                    $("#cabincrew").val(data.cabincrew);
                    $("#departure_aerodrome").val(data.departure_aerodrome);
                    if (data.departure_aerodrome == 'ZZZZ') {
                        $("#departure_station").val(data.destination_station);
                        $("#departure_latlong").val(data.destination_latlong);
                        $("#departure_station").removeAttr('readonly')
                        $("#departure_latlong").removeAttr('readonly')
                    }

                    $("#aircraft_callsign").css("border", "lightgrey solid 1px");
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
            $("#aircraft_callsign").css("border", "red solid 1px");
            $("#departure_aerodrome").val('');
        }


    })

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

    $("#departure_station,#destination_station").autocomplete({
        source: base_url + "/fpl/stations_autocomplete",
        minLength: 1,
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


            } else {
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
    }


    $(".process_quick_plan").click(function () {
        var data_url = $(this).attr('data-url');
        var aircraft_callsign = $("#aircraft_callsign").val();
        if (aircraft_callsign.length >= 5) {
            $.ajax({
                type: "POST",
                url: data_url,
                data: {'aircraft_callsign': aircraft_callsign},
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (result) {
                    $("#fpl_view").remove();
                    $("#qucik_responce").html(result.fplviewdata);
                    $("#supplementary").html(result.supplementary_info);
                    $("#aircraft_callsign").attr('readonly', 'readonly');
                    $("#departure_aerodrome").attr('readonly', 'readonly');
                    $("#destination_aerodrome").attr('readonly', 'readonly');
                    $("#departure_time_hours").attr('readonly', 'readonly');
                    $("#departure_time_minutes").attr('readonly', 'readonly');
                    $("#date_of_flight").attr('readonly', 'readonly');
                    $("#pilot_in_command").attr('readonly', 'readonly');
                    $("#mobile_number").attr('readonly', 'readonly');
                    $("#copilot").attr('readonly', 'readonly');
                    $("#cabincrew").attr('readonly', 'readonly');
                    $("#departure_station").attr('readonly', 'readonly');
                    $("#departure_latlong").attr('readonly', 'readonly');
                    $("#destination_station").attr('readonly', 'readonly');
                    $("#destination_latlong").attr('readonly', 'readonly');
                }
            });
        } else {
            $("#qucik_responce").html('');
            $("#supplementary").html('');
        }
    });
    $(".redirect").on('click', function () {
        var url = $(this).attr('data-url');
        var redirect_url = $(this).attr('data-redirect-url');
        var aircraft_callsign = $("#aircraft_callsign").val();
        aircraft_callsign = callsign.substr(0, 5);
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
        } else {
            $("#capacity").attr('readonly', 'readonly');
            $("#cover").attr('readonly', 'readonly');
            $("#color").attr('readonly', 'readonly');
            $("#capacity").val('');
            $("#cover").val('');
            $("#color").val('');
            $("#capacity").css('border', 'lightgrey solid 1px');
            $("#color").css('border', 'lightgrey solid 1px');
        }

    });
    $("#capacity").keyup(function () {
        var capacity = $("#capacity").val();
        if (capacity.length == 3) {
            $("#capacity").css('border', 'lightgrey solid 1px');
            $('#cover').removeAttr('disabled');
        } else {
            $("#capacity").css('border', '#ff0000 solid 1px');
            $("#cover").attr('disabled', 'disabled');
        }

    });
    $('#cover').click(function () {
        if ($("#cover").is(':checked')) {
// something when checked
            $("#color").removeAttr('readonly');
        } else {
// something else when not
            $("#color").attr('readonly', 'readonly');
            $("#color").val('');
        }
    });
    $("#pilot_in_command").autocomplete({
        minLength: 1,
        source: function (request, response) {
            console.log('Hii')
            $.ajax({
                type: "POST",
                url: base_url + "/fpl/pilot_in_command",
                dataType: "json",
                data: {
                    term: request.term.toUpperCase(),
                    aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    response(data);

                }
            });
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#pilot_in_command").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#pilot_in_command").css("border", "red solid 1px");
//                $('#pilot_in_command').popover('show');
            } else {
                $('#pilot_in_command').popover('destroy');
                $("#pilot_in_command").css("border", "lightgrey solid 1px");
            }
            get_pilot_mobile(ui.item.value);
        }
    });
    function get_pilot_mobile(pilot_name) {
        $.ajax({
            type: "POST",
            url: base_url + "/fpl/get_pilot_details",
            data: {"pilot_name": pilot_name},
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (result) {
                var mobilenumber = result.mobilenum;
                $("#mobile_number").val(mobilenumber);
                if ((mobilenumber == '') || (mobilenumber.length <= '9')) {
                    $("#mobile_number").attr('data-content', 'Only digits & NO Special Characters allowed \n\
        <span style="color:red;" >(min. 10 & max. 11 numbers)</span>');
                    $("#mobile_number").css("border", "red solid 1px");
//                $('#mobile_number').popover('show');
                } else {
                    $('#mobile_number').popover('destroy');
                    $("#mobile_number").css("border", "lightgrey solid 1px");
                }
            }
        });
    }

    $("#pilot_in_command").on('keyup', function () {
        var pilot_in_command = $(this).val().toUpperCase();
        if (pilot_in_command == '' || (pilot_in_command.length < '2')) {
            $("#pilot_in_command").css("border", "red solid 1px");
        } else {
            $('#pilot_in_command').popover('destroy');
            $("#pilot_in_command").css("border", "lightgrey solid 1px");
        }
    })

    $("#mobile_number").on('keyup', function () {
        var mobile_number = $(this).val().toUpperCase();
        if (mobile_number == '' || (mobile_number.length < '10')) {
            $("#mobile_number").css("border", "red solid 1px");
        } else {
            $('#mobile_number').popover('destroy');
            $("#mobile_number").css("border", "lightgrey solid 1px");
        }
    })

    $("#copilot").on('keyup', function () {
        var copilot = $(this).val().toUpperCase();
        if (copilot == '' || (copilot.length < '2')) {
            $("#copilot").css("border", "red solid 1px");
        } else {
            $('#copilot').popover('destroy');
            $("#copilot").css("border", "lightgrey solid 1px");
        }
    })

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
        var nav = $(this).val().toUpperCase();
        if (nav == '' || (nav.length < '1')) {
            $("#nav1").css("border", "red solid 1px");
        } else {
            $('#nav1').popover('destroy');
            $("#nav1").css("border", "lightgrey solid 1px");
        }
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
        if (code == '' || (code.length < '6')) {
            $("#code").css("border", "red solid 1px");
        } else {
            $('#code').popover('destroy');
            $("#code").css("border", "lightgrey solid 1px");
        }
    })

    $("#per").on('keyup', function () {
        var per = $(this).val().toUpperCase();
        if (per == '' || (per.length < '1')) {
            $("#per").css("border", "red solid 1px");
        } else {
            $('#per').popover('destroy');
            $("#per").css("border", "lightgrey solid 1px");
        }
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

    $("#copilot").autocomplete({
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                type: "POST",
                url: base_url + "/fpl/copilot",
                dataType: "json",
                data: {
                    term: request.term.toUpperCase(),
                    aircraft_callsign: $("#aircraft_callsign").val().toUpperCase()
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data) {
                    response(data);

                }
            });
        },
        select: function (event, ui) {
            //console.log(ui.item.value);
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#copilot").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#copilot").css("border", "red solid 1px");
//                $('#copilot').popover('show');
            } else {
                $('#copilot').popover('destroy');
                $("#copilot").css("border", "lightgrey solid 1px");
            }

        }
    });

    $(".indian").on('click', function () {
        var indian = $("#indian").val();
        var foreigner = $("#foreigner").val();
        if (indian == "YES") {
            $("#foreigner_nationality").attr('readonly', 'readonly');
        } else if (foreigner == "YES") {
            $("#foreigner_nationality").removeAttr('readonly');
        } else {
            $("#foreigner_nationality").attr('readonly', 'readonly');
        }
    })
    $('.departure_time_hours').on('click', function () {
        var dep_time_hours = $('#dep_time_hours').text();
        $("#departure_time_hours").val(dep_time_hours);
        var dep_time_minutes = $('#dep_time_minutes').text();
        $("#departure_time_minutes").val(dep_time_minutes);
        var utcdate = $("#utcdate").val();
        var gmttime = $("#gmt_time").val();
        var date_of_flight = $("#date_of_flight").val();
        var utcdate_gmttime = utcdate + ":" + gmttime;
        var selected_dep_time = date_of_flight + ":" + dep_time_hours + ":" + dep_time_minutes;
        if (((dep_time_hours == null) || (utcdate_gmttime > selected_dep_time) || (dep_time_minutes == null)) || ((dep_time_hours == "00") && (dep_time_minutes == "00"))) {

            $("#hour").css("border", "#ff0000 solid 1px");
            $("#mins").css("border", "#ff0000 solid 1px");
        } else
        {
            $("#hour").css("border", "lightgrey solid 1px");
            $("#mins").css("border", "lightgrey solid 1px");
        }
    })
    $('.departure_time_minutes').on('click', function () {
        var dep_time_minutes = $('#dep_time_minutes').text();
        $("#departure_time_minutes").val(dep_time_minutes);
        var dep_time_hours = $('#dep_time_hours').text();
        $("#departure_time_hours").val(dep_time_hours);
        var utcdate = $("#utcdate").val();
        var gmttime = $("#gmt_time").val();
        var date_of_flight = $("#date_of_flight").val();
        var utcdate_gmttime = utcdate + ":" + gmttime;
        var selected_dep_time = date_of_flight + ":" + dep_time_hours + ":" + dep_time_minutes;
        if (((dep_time_hours == null) || (utcdate_gmttime > selected_dep_time) || (dep_time_minutes == null)) || ((dep_time_hours == "00") && (dep_time_minutes == "00"))) {

            $("#hour").css("border", "#ff0000 solid 1px");
            $("#mins").css("border", "#ff0000 solid 1px");
        } else {
            $("#hour").css("border", "lightgrey solid 1px");
            $("#mins").css("border", "lightgrey solid 1px");
        }
    })


    $("#date_of_flight").on('change', function () {
        var dep_time_hours = $('#dep_time_hours').text();
        $("#departure_time_hours").val(dep_time_hours);
        var dep_time_minutes = $('#dep_time_minutes').text();
        $("#departure_time_minutes").val(dep_time_minutes);
        var utcdate = $("#utcdate").val();
        var gmttime = $("#gmt_time").val();
        var date_of_flight = $("#date_of_flight").val();
        var utcdate_gmttime = utcdate + ":" + gmttime;
        var selected_dep_time = date_of_flight + ":" + dep_time_hours + ":" + dep_time_minutes;
        if (((dep_time_hours == null) || (utcdate_gmttime > selected_dep_time) || (dep_time_minutes == null)) || ((dep_time_hours == "00") && (dep_time_minutes == "00"))) {

            $("#hour").css("border", "#ff0000 solid 1px");
            $("#mins").css("border", "#ff0000 solid 1px");
        } else
        {
            $("#hour").css("border", "lightgrey solid 1px");
            $("#mins").css("border", "lightgrey solid 1px");
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

    $(".emergency_checkbox").on('click', function () {
        var emergency_checkbox = $("input:checkbox[class=emergency_checkbox]:checked").val();
        if (emergency_checkbox == 'uhf' || emergency_checkbox == 'vhf' || emergency_checkbox == 'elba') {
            $('.emergency_border').css('border', "lightgrey solid 1px");
        } else {
            $('.emergency_border').css('border', "red solid 1px");
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

    $('#indian').on('click', function () {
        $("#foreigner_nationality").attr('readonly', 'readonly');
        $("#indian").val('YES');
    });

    $('#foreigner').on('click', function () {
        $("#foreigner_nationality").removeAttr('readonly');
        $("#foreigner").val('NO');
    });
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

    $("#fir_crossing_time").on('keypress', function (e) {
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
            if (fir_length <= 3)
            {
                fir_crossing_alpha(e);
            } else if (fir_length <= 12 && fir_length >= 9)
            {
                fir_crossing_alpha(e);
            } else if (fir_length <= 21 && fir_length >= 17)
            {
                fir_crossing_alpha(e);
            } else if (fir_length <= 30 && fir_length >= 26)
            {
                fir_crossing_alpha(e);
            } else if (fir_length <= 39 && fir_length >= 35)
            {
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

    $('#indian').on('click', function () {
        $("#foreigner_nationality").attr('readonly', 'readonly');
    });

    $('#foreigner').on('click', function () {
        $("#foreigner_nationality").removeAttr('readonly');
    });


//     $(".disabled_onclick").off();
//      $(".disabled_onclick").prop("onclick", null);

    $("#hour").on('click', function () {
        $("#reset").addClass('hidden');
        $("#process").removeClass('hidden');
    });


});

function addDays(theDate, days) {
    return new Date(theDate.getTime() + days * 24 * 60 * 60 * 1000);
}
