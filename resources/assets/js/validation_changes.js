$(document).ready(function () {
    $(".validation_class").on('keyup', function () {
        $(".validation_class").popover({
            html: true,
            trigger: "hover"
        })
        validform()
    });
    $('.validation_class').bind("paste", function (e) {
        e.preventDefault();
    });
    $(".validation_class_click").on('click', function () {
        $(".validation_class_click").popover({
            html: true,
            trigger: "hover"
        })
        validform()
    });
    
//    $('.alpha_numeric').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z0-9]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;
//    });
//    $('.numeric').on('keypress', function (e) {
//        var regex = new RegExp("^[0-9]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;
//    });
//    $('.alphabets').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;
//    });
//    $('.route_allowed_chars').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z0-9/ ]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;
//    });
//    $('.pilot_in_command').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z ]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;
//    });
//    $('.operator').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z0-9 ]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;
//    });
    
    
    $('#process').on('click', function (event) {
        $("#is_process_click").val('1');
    })
    $("#route").on('keyup', function () {
        var route = $("#route").val();
        if (route.length >= 50) {
            $("#route1").focus();
        }

    });
    $("#remarks").on('keyup', function () {
        var remarks = $("#remarks").val();
        if (remarks.length >= 50) {
            $("#remarks1").focus();
        }
    });
    var cs = $("#aircraft_callsign").attr('data-cs');
    var is_edit_plan = $("#is_edit_plan").val()
    if (cs) {
        $("#is_process_click").val('1');
        validform();
    }
    if (is_edit_plan) {
        $("#is_process_click").val('1');
        validform();
    }
});

function validform() {
    var is_process_click = $('#is_process_click').val();
    var flag = $('input[name="flag"]').attr('data-name');
    $('input[type=checkbox]:required').css('outline', '1px solid red');
    $('input[type=radio]:required').css('outline', '1px solid red');

    var validation = true;
    var aircraft_callsign = $('#aircraft_callsign').val();
    var departure_aerodrome = $('#departure_aerodrome').val().toUpperCase();
    var destination_aerodrome = $('#destination_aerodrome').val().toUpperCase();
    var departure_time_hours = $('#departure_time_hours').val();
    var departure_time_minutes = $('#departure_time_minutes').val();
    var pilot_in_command = $('#pilot_in_command').val();
    var mobile_number = $('#mobile_number').val();
    var copilot = $('#copilot').val();
    var cabincrew = $('#cabincrew').val();
    var date_of_flight = $('#date_of_flight').val();
    var utcdate = $("#utcdate").val();
    var gmttime = $("#gmt_time").val();
    var utcdate_gmttime = utcdate + ":" + gmttime;
    var selected_dep_time = date_of_flight + ":" + departure_time_hours + ":" + departure_time_minutes;
    var departure_station = $("#departure_station").val();
    var destination_station = $("#destination_station").val();
    var departure_latlong = $("#departure_latlong").val();
    var destination_latlong = $("#destination_latlong").val();
    var utcdate = $("#utcdate").val();
    //edit
    var crushing_speed_indication = $("#crushing_speed_indication").val();
    var crushing_speed = $("#crushing_speed").val();
    var flight_level_indication = $("#flight_level_indication").val();
    var flight_level = $("#flight_level").val();
    var total_flying_hours = $("#total_flying_hours").val();
    var total_flying_minutes = $("#total_flying_minutes").val();
    var route = $("#route").val();
    var route1 = $("#route1").val();
    var first_alternate_aerodrome = $("#first_alternate_aerodrome").val();
    var second_alternate_aerodrome = $("#second_alternate_aerodrome").val();
    var take_off_altn = $("#take_off_altn").val();
    var indian = $("#indian").val();
    var foreigner = $("#indian").val();
    var foreigner_nationality = $("#foreigner_nationality").val();
    var endurance_hours = $("#endurance_hours").val();
    var endurance_minutes = $("#endurance_minutes").val();
    var fir_crossing_time = $("#fir_crossing_time").val();
    var fir_crossing_readonly = $("#fir_crossing_time").attr('readonly');
    var fir_crossing_required = $("#fir_crossing_time").attr('required');
    var remarks = $("#remarks").val();
    var remarks1 = $("#remarks1").val();
    //new plan
    var flight_rules = $("#flight_rules").val();
    var flight_type = $("#flight_type").val();
    var aircraft_type = $("#aircraft_type").val();
    var weight_category = $("#weight_category").val();
    var equipment = $("#equipment").val();
    var transponder = $("#transponder").val();
    var alternate_station = $("#alternate_station").val();
    var operator = $("#operator").val();
    var pbn = $("#pbn").val();
    var nav1 = $("#nav1").val();
    var registration = $("#registration").val();
    var sel = $("#sel").val();
    var code = $("#code").val();
    var per = $("#per").val();
    var route1 = $("#route1").val();
    var credit = $('input[name=credit]:checked').val();
    var emergency_checkbox = $("input:checkbox[class=emergency_checkbox]:checked").val();
    var emergency_uhf = $("#emergency_uhf").val();
    var emergency_vhf = $("#emergency_vhf").val();
    var emergency_elba = $("#emergency_elba").val();
    var number = $("#number").val();
    var capacity = $("#capacity").val();
    var color = $("#color").val();
    var cover = $("#cover").val();
    var flight_rules_value = $("#flight_rules_value").text();
    var aircraft_color = $("#aircraft_color").val();
    var dep_aero_first2char = departure_aerodrome.substring(0, 2);
    var dest_aero_first2char = destination_aerodrome.substring(0, 2);
    if (route.length >= 50) {
        $("#route1").removeAttr('readonly');
    } else {
        $("#route1").attr('readonly', 'readonly');
    }
    if (remarks.length >= 50) {
        $("#remarks1").removeAttr('readonly');
    } else {
        $("#remarks1").attr('readonly', 'readonly');
    }
    if (remarks1.length >= '1') {
        $("#remarks1").css("border", "lightgrey solid 1px");
    }
    if (route1.length >= '1') {
        $("#route1").css("border", "lightgrey solid 1px");
    }
    if (is_process_click) {
        if (flag == 'Process' || flag == 'New') {
            if ((aircraft_callsign == '') || (aircraft_callsign.length <= '4')) {
                $("#aircraft_callsign").attr('data-content', 'Min. 5 & Max. 7 Characters, only Alphabets & Numbers allowed');
                $("#aircraft_callsign").css("border", "red solid 1px");
            } else {
                $('#aircraft_callsign').popover('destroy');
                $("#aircraft_callsign").css("border", "lightgrey solid 1px");
            }

            if ((departure_aerodrome == '') || (departure_aerodrome.length <= '3')) {
                $("#departure_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Departing Station (Min. & Max. 4 Alphabets)');
                $("#departure_aerodrome").css("border", "red solid 1px");
            } else {
                $('#departure_aerodrome').popover('destroy');
                $("#departure_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ((destination_aerodrome == '') || (destination_aerodrome.length <= '3')) {
                $("#destination_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#destination_aerodrome").css("border", "red solid 1px");
            } else {
                $('#destination_aerodrome').popover('destroy');
                $("#destination_aerodrome").css("border", "lightgrey solid 1px");
            }
            if ((($("#dep_time_hours").text() == 'Hr') && ($("#dep_time_minutes").text() == 'Min'))
                    ||
                    (($("#dep_time_hours").text() == 'Hr') || ($("#dep_time_minutes").text() == 'Min'))
                    ||
                    (($("#dep_time_hours").text() == '00') && ($("#dep_time_minutes").text() == '00'))
                    ||
                    (utcdate_gmttime > selected_dep_time)
                    ) {
                $("#hour").attr('data-content', 'Min. 30 Minutes from present time only accepted');
                $("#hour").css("border", "red solid 1px");
                $("#mins").attr('data-content', 'Min. 30 Minutes from present time only accepted');
                $("#mins").css("border", "red solid 1px");
                validation = false;
            } else {
                $('#hour').popover('destroy');
                $("#hour").css("border", "lightgrey solid 1px");
                $('#mins').popover('destroy');
                $("#mins").css("border", "lightgrey solid 1px");
            }

            $('.departure_time_hours,.departure_time_minutes').on('click', function () {
                if ((($("#dep_time_hours").text() == 'Hr') && ($("#dep_time_minutes").text() == 'Min'))
                        ||
                        (($("#dep_time_hours").text() == 'Hr') || ($("#dep_time_minutes").text() == 'Min'))
                        ||
                        (($("#dep_time_hours").text() == '00') && ($("#dep_time_minutes").text() == '00'))
                        ||
                        (utcdate_gmttime > selected_dep_time)
                        ) {
                    $("#hour").attr('data-content', 'Min. 30 Minutes from present time only accepted');
                    $("#hour").css("border", "red solid 1px");
                    $("#mins").attr('data-content', 'Min. 30 Minutes from present time only accepted');
                    $("#mins").css("border", "red solid 1px");
                    validation = false;
                }
            });

            if ((($("#dep_time_hours").text() == 'Hr') && ($("#dep_time_minutes").text() == 'Min'))
                    ||
                    (($("#dep_time_hours").text() == 'Hr') || ($("#dep_time_minutes").text() == 'Min'))
                    ||
                    (($("#dep_time_hours").text() == '00') && ($("#dep_time_minutes").text() == '00'))
                    ||
                    (utcdate_gmttime > selected_dep_time)
                    ) {
                validation = false;
            } else {
                $('#hour').popover('destroy');
                $("#hour").css("border", "lightgrey solid 1px");
                $('#mins').popover('destroy');
                $("#mins").css("border", "lightgrey solid 1px");
            }

            if ((pilot_in_command == '') || (pilot_in_command.length <= '1')) {
                $("#pilot_in_command").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#pilot_in_command").css("border", "red solid 1px");
//                $('#pilot_in_command').popover('show');
            } else {
                $('#pilot_in_command').popover('destroy');
                $("#pilot_in_command").css("border", "lightgrey solid 1px");
            }

            if ((mobile_number == '') || (mobile_number.length <= '9')) {
                $("#mobile_number").attr('data-content', 'Only digits & NO Special Characters allowed \n\
        <span style="color:red;" >(min. 10 & max. 10 numbers)</span>');
                $("#mobile_number").css("border", "red solid 1px");
//                $('#mobile_number').popover('show');
            } else {
                $('#mobile_number').popover('destroy');
                $("#mobile_number").css("border", "lightgrey solid 1px");
            }

            if ((copilot == '') || (copilot.length <= '1')) {
                $("#copilot").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#copilot").css("border", "red solid 1px");
//                $('#copilot').popover('show');
            } else {
                $('#copilot').popover('destroy');
                $("#copilot").css("border", "lightgrey solid 1px");
            }

            if (cabincrew.length == '1') {
                $("#cabincrew").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#cabincrew").css("border", "red solid 1px");
//                $('#cabincrew').popover('show');
            } else {
                $('#cabincrew').popover('destroy');
                $("#cabincrew").css("border", "lightgrey solid 1px");
            }


            if (departure_aerodrome.toUpperCase() == "ZZZZ") {
                if ((departure_station == '') || (departure_station.length <= '1')) {
                    $("#departure_station").attr('data-content', 'Min. 3 & Max. 25 Characters, only Alphabets allowed');
                    $("#departure_station").css("border", "red solid 1px");
//                    $('#departure_station').popover('show');
                } else {
                    $('#departure_station').popover('destroy');
                    $("#departure_station").css("border", "lightgrey solid 1px");
                }

                if ((departure_latlong == '') || (departure_latlong.length <= '8')) {
                    $("#departure_latlong").attr('data-content', 'Min. 9 & Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1257N07739E or BBG353020)');
                    $("#departure_latlong").css("border", "red solid 1px");

                } else {
                    $('#departure_latlong').popover('destroy');
                    $("#departure_latlong").css("border", "lightgrey solid 1px");
                }

            } else {
                $('#departure_station').popover('destroy');
                $("#departure_station").css("border", "lightgrey solid 1px");
                $('#departure_latlong').popover('destroy');
                $("#departure_latlong").css("border", "lightgrey solid 1px");
            }

            if (destination_aerodrome.toUpperCase() == "ZZZZ") {
                if ((destination_station == '') || (destination_station.length <= '1')) {
                    $("#destination_station").attr('data-content', 'Min. 3 & Max. 25 Characters, only Alphabets allowed');
                    $("#destination_station").css("border", "red solid 1px");
//                    $('#destination_station').popover('show');
                } else {
                    $('#destination_station').popover('destroy');
                    $("#destination_station").css("border", "lightgrey solid 1px");
                }

                if ((destination_latlong == '') || (destination_latlong.length <= '8')) {
                    $("#destination_latlong").attr('data-content', 'Min. 9 & Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1257N07739E or BBG353020)');
                    $("#destination_latlong").css("border", "red solid 1px");

                } else {
                    $('#destination_latlong').popover('destroy');
                    $("#destination_latlong").css("border", "lightgrey solid 1px");
                }


            } else {
                $('#destination_station').popover('destroy');
                $("#destination_station").css("border", "lightgrey solid 1px");
                $('#destination_latlong').popover('destroy');
                $("#destination_latlong").css("border", "lightgrey solid 1px");
            }
        } else if (flag == 'Edit') {
            //alert($("#crushing_speed_indication_value").text());
            if ($("#crushing_speed_indication_value").text() == '---') {


                $("#setspeed").attr('data-content', 'N for Knots, M for Mach & K for Kilometres (Min. 3 & Max. 4 Digits)');
                $("#setspeed").css("border", "red solid 1px");
//                $('#crushing_speed_indication').popover('show');
            } else {
                $('#setspeed').popover('destroy');
                $("#setspeed").css("border", "lightgrey solid 1px");
            }
            $('.crushing_speed_indication').on('click', function () {
                if ($("#crushing_speed_indication_value").text() == '---') {


                    $("#setspeed").attr('data-content', 'N for Knots, M for Mach & K for Kilometres (Min. 3 & Max. 4 Digits)');
                    $("#setspeed").css("border", "red solid 1px");
//                $('#crushing_speed_indication').popover('show');
                } else {
                    $('#setspeed').popover('destroy');
                    $("#setspeed").css("border", "lightgrey solid 1px");
                }
            });
            if ($("#crushing_speed_indication_value").text() == 'M') {

                //console.log($("#crushing_speed_indication_value").text());
                if ((crushing_speed == '') || (crushing_speed.length <= '2')) {
                    $("#crushing_speed").attr('data-content', 'N for Knots, M for Mach & K for Kilometres (Min. 3 & Max. 4 Digits)');
                    $("#crushing_speed").css("border", "red solid 1px");

                } else {
                    $('#crushing_speed').popover('destroy');
                    $("#crushing_speed").css("border", "lightgrey solid 1px");
                }


            } else {

                if ((crushing_speed == '') || (crushing_speed.length <= '3')) {
                    $("#crushing_speed").attr('data-content', 'N for Knots, M for Mach & K for Kilometres (Min. 3 & Max. 4 Digits)');
                    $("#crushing_speed").css("border", "red solid 1px");

                } else {
                    $('#crushing_speed').popover('destroy');
                    $("#crushing_speed").css("border", "lightgrey solid 1px");
                }
            }
            if ($("#flight_level_indication_value").text() == '---') {
                $("#setspeedvalue").attr('data-content', 'F for Flight Level & A for Altitude (Min. 3 & Max. 3 Digits)');
                $("#setspeedvalue").css("border", "red solid 1px");
                validation = false;
            } else {
                $('#setspeedvalue').popover('destroy');
                $("#setspeedvalue").css("border", "lightgrey solid 1px");
            }
            $('.flight_level_indication').on('click', function () {
                if ($("#flight_level_indication_value").text() == '---') {
                    $("#setspeedvalue").attr('data-content', 'F for Flight Level & A for Altitude (Min. 3 & Max. 3 Digits)');
                    $("#setspeedvalue").css("border", "red solid 1px");

                } else {
                    $('#setspeedvalue').popover('destroy');
                    $("#setspeedvalue").css("border", "lightgrey solid 1px");
                }
            });
            if ((flight_level == '') || (flight_level.length <= '2')) {
                $("#flight_level").attr('data-content', 'F for Flight Level & A for Altitude (Min. 3 & Max. 3 Digits)');
                $("#flight_level").css("border", "red solid 1px");
//                $('#flight_level').popover('show');
            } else {
                $('#flight_level').popover('destroy');
                $("#flight_level").css("border", "lightgrey solid 1px");
            }
            if (($("#total_time_hours").text() == 'Hr') && ($("#total_time_minutes").text() == 'Min')
                    ||
                    ($("#total_time_hours").text() == 'Hr') || ($("#total_time_minutes").text() == 'Min')
                    ||
                    ($("#total_time_hours").text() == '00') && ($("#total_time_minutes").text() == '00')) {
                $("#total_hour").attr('data-content', 'Select Total Flying Time');
                $("#total_hour").css("border", "red solid 1px");
                $("#total_mins").attr('data-content', 'Select Total Flying Time');
                $("#total_mins").css("border", "red solid 1px");
                validation = false;
            }

            if (($("#total_time_hours").text() == 'Hr') && ($("#total_time_minutes").text() == 'Min')
                    ||
                    ($("#total_time_hours").text() == 'Hr') || ($("#total_time_minutes").text() == 'Min')
                    ||
                    ($("#total_time_hours").text() == '00') && ($("#total_time_minutes").text() == '00')) {
                $("#total_hour").attr('data-content', 'Select Total Flying Time');
                $("#total_hour").css("border", "red solid 1px");
                $("#total_mins").attr('data-content', 'Select Total Flying Time');
                $("#total_mins").css("border", "red solid 1px");
            } else {
                $('#total_hour').popover('destroy');
                $("#total_hour").css("border", "lightgrey solid 1px");
                $('#total_mins').popover('destroy');
                $("#total_mins").css("border", "lightgrey solid 1px");
            }
            $('.total_flying_hours,.total_flying_minutes').on('click', function () {
                if (($("#total_time_hours").text() == 'Hr') && ($("#total_time_minutes").text() == 'Min')
                        ||
                        ($("#total_time_hours").text() == 'Hr') || ($("#total_time_minutes").text() == 'Min')
                        ||
                        ($("#total_time_hours").text() == '00') && ($("#total_time_minutes").text() == '00')) {
                    $("#total_hour").attr('data-content', 'Select Total Flying Time');
                    $("#total_hour").css("border", "red solid 1px");
                    $("#total_mins").attr('data-content', 'Select Total Flying Time');
                    $("#total_mins").css("border", "red solid 1px");
                } else {
                    $('#total_hour').popover('destroy');
                    $("#total_hour").css("border", "lightgrey solid 1px");
                    $('#total_mins').popover('destroy');
                    $("#total_mins").css("border", "lightgrey solid 1px");

                }
            });
            if ((route == '') || (route.length <= '1')) {
                $("#route").attr('data-content', 'Min. 2 & Max. 150 Characters, only Alphabets Numbers and / Character only allowed');
                $("#route").css("border", "red solid 1px");
//                $('#route').popover('show');
            } else {
                $('#route').popover('destroy');
                $("#route").css("border", "lightgrey solid 1px");
            }
            if ((first_alternate_aerodrome == '') || (first_alternate_aerodrome.length <= '3')) {
                $("#first_alternate_aerodrome").attr('data-content', 'ICAO Codes only & use ZZZZ if no Code allocated for Alternate Station (Min. & Max. 4 Alphabets)');
                $("#first_alternate_aerodrome").css("border", "red solid 1px");
            } else {
                $('#first_alternate_aerodrome').popover('destroy');
                $("#first_alternate_aerodrome").css("border", "lightgrey solid 1px");
            }
            if ((second_alternate_aerodrome.length >= '1') && (second_alternate_aerodrome.length <= '3')) {
                $("#second_alternate_aerodrome").attr('data-content', 'ICAO Codes only & use ZZZZ if no Code allocated for Alternate Station (Min. & Max. 4 Alphabets)');
                $("#second_alternate_aerodrome").css("border", "red solid 1px");
//                $('#second_alternate_aerodrome').popover('show');
            } else {
                $('#second_alternate_aerodrome').popover('destroy');
                $("#second_alternate_aerodrome").css("border", "lightgrey solid 1px");
            }
            if ((take_off_altn.length >= '1') && (take_off_altn.length <= '3')) {
                $("#take_off_altn").attr('data-content', 'Nearest Aerodrome to Departing Station if any problem persists after Take off. 4 Letter ICAO Code only');
                $("#take_off_altn").css("border", "red solid 1px");

            } else {
                $('#take_off_altn').popover('destroy');
                $("#take_off_altn").css("border", "lightgrey solid 1px");
            }
            if (($("#endurance_time_hours").text() == 'Hr') && ($("#endurance_time_minutes").text() == 'Min')
                    ||
                    ($("#endurance_time_hours").text() == 'Hr') || ($("#endurance_time_minutes").text() == 'Min')
                    ||
                    ($("#endurance_time_hours").text() == '00') && ($("#endurance_time_minutes").text() == '00')) {
                $("#endurhours").attr('data-content', 'Select Total Flying Time');
                $("#endurhours").css("border", "red solid 1px");
                $("#endurmins").attr('data-content', 'Select Endurance');
                $("#endurmins").css("border", "red solid 1px");
                validation = false;
            }

            if (($("#endurance_time_hours").text() == 'Hr') && ($("#endurance_time_minutes").text() == 'Min')
                    ||
                    ($("#endurance_time_hours").text() == 'Hr') || ($("#endurance_time_minutes").text() == 'Min')
                    ||
                    ($("#endurance_time_hours").text() == '00') && ($("#endurance_time_minutes").text() == '00')) {
                $("#endurhours").attr('data-content', 'Select Total Flying Time');
                $("#endurhours").css("border", "red solid 1px");
                $("#endurmins").attr('data-content', 'Select Endurance');
                $("#endurmins").css("border", "red solid 1px");
            } else {
                $('#endurhours').popover('destroy');
                $("#endurhours").css("border", "lightgrey solid 1px");
                $('#endurmins').popover('destroy');
                $("#endurmins").css("border", "lightgrey solid 1px");
            }

            $('.total_flying_hours,.total_flying_minutes').on('click', function () {

                if (($("#endurance_time_hours").text() == 'Hr') && ($("#endurance_time_minutes").text() == 'Min')
                        ||
                        ($("#endurance_time_hours").text() == 'Hr') || ($("#endurance_time_minutes").text() == 'Min')
                        ||
                        ($("#endurance_time_hours").text() == '00') && ($("#endurance_time_minutes").text() == '00')) {
                    $("#endurhours").attr('data-content', 'Select Endurance Time');
                    $("#endurhours").css("border", "red solid 1px");
                    $("#endurmins").attr('data-content', 'Select Endurance');
                    $("#endurmins").css("border", "red solid 1px");
                } else {
                    $('#endurhours').popover('destroy');
                    $("#endurhours").css("border", "lightgrey solid 1px");
                    $('#endurmins').popover('destroy');
                    $("#endurmins").css("border", "lightgrey solid 1px");
                }
            });
            if (indian == "indian") {
                $('#foreigner_nationality').popover('destroy');
                $("#foreigner_nationality").css("border", "lightgrey solid 1px");
            }
            if (foreigner == "foreigner") {
                if ((foreigner_nationality.length >= '1') && (foreigner_nationality.length <= '2')) {
                    $("#foreigner_nationality").attr('data-content', 'Capt/ Co-Pilot/ Crew or Passengers Nationality must for ADC purpose. Min. 3 & Max. 50 Characters, only Alphabets & Numbers allowed');
                    $("#foreigner_nationality").css("border", "red solid 1px");
                } else {
                    $('#foreigner_nationality').popover('destroy');
                    $("#foreigner_nationality").css("border", "lightgrey solid 1px");
                }
            }
            if (remarks == '' || (remarks.length >= '1') && (remarks.length <= '2')) {
//                $("#remarks").attr('data-content', 'Additional info for ATC or MLU. Min. 3 & Max. 150 Characters only Alphabets Numbers Space and / Character allowed');
//                $("#remarks").css("border", "red solid 1px");
            } else {
                $('#remarks').popover('destroy');
                $("#remarks").css("border", "lightgrey solid 1px");
            }
            if (((destination_aerodrome == "ZZZZ") || (departure_aerodrome == "ZZZZ"))) {
                $("#fir_crossing_time").removeAttr('readonly');
                $("#fir_crossing_time").removeAttr('required');
                $("#fir_crossing_time").css("border", "lightgrey solid 1px");
            } else if (dep_aero_first2char != dest_aero_first2char && departure_aerodrome.length == 4 && destination_aerodrome.length == 4) {
                $("#fir_crossing_time").removeAttr('readonly');
                if (fir_crossing_time == '' || ((fir_crossing_time.length >= '1') && (fir_crossing_time.length <= '7'))) {
                    $("#fir_crossing_time").attr('data-content', 'Time taken to cross FIR point from Departure Time, only Alphabets & Numbers allowed. Min. 8 & Max. 50 Characters. Example: VABF0012 VIDF0106');
                    $("#fir_crossing_time").css("border", "red solid 1px");
                } else {
                    $('#fir_crossing_time').popover('destroy');
                    $("#fir_crossing_time").css("border", "lightgrey solid 1px");
                }
            } else {
                $("#fir_crossing_time").attr('readonly', 'readonly');
                $("#fir_crossing_time").css("border", "lightgrey solid 1px");
                $("#fir_crossing_time").val('')
            }

        }
        if (flag == 'New') {
            if ((route == '') || (route.length <= '1')) {
                $("#route").attr('data-content', 'Min. 2 & Max. 150 Characters, only Alphabets Numbers and / Character only allowed');
                $("#route").css("border", "red solid 1px");

            } else {
                $('#route').popover('destroy');
                $("#route").css("border", "lightgrey solid 1px");
            }

            if ((first_alternate_aerodrome == '') || (first_alternate_aerodrome.length <= '3')) {
                $("#first_alternate_aerodrome").attr('data-content', 'ICAO Codes only & use ZZZZ if no Code allocated for Alternate Station (Min. & Max. 4 Alphabets)');
                $("#first_alternate_aerodrome").css("border", "red solid 1px");

            } else {
                $('#first_alternate_aerodrome').popover('destroy');
                $("#first_alternate_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ((second_alternate_aerodrome.length >= '1') && (second_alternate_aerodrome.length <= '3')) {
                $("#second_alternate_aerodrome").attr('data-content', 'ICAO Codes only & use ZZZZ if no Code allocated for Alternate Station (Min. & Max. 4 Alphabets)');
                $("#second_alternate_aerodrome").css("border", "red solid 1px");

            } else {
                $('#second_alternate_aerodrome').popover('destroy');
                $("#second_alternate_aerodrome").css("border", "lightgrey solid 1px");
            }

            $('.flight_rules').on('click', function () {
                var flight_rules_value = $("#flight_rules_value").text();
                if ((flight_rules_value == '') || (flight_rules_value == 'Flight Rule')) {
                    $("#rules").attr('data-content', 'I for IFR, V for VFR, Y for IFR First & Z for VFR First');
                    $("#rules").css("border", "red solid 1px");
                } else {
                    $('#rules').popover('destroy');
                    $("#rules").css("border", "lightgrey solid 1px");
                }
                if (departure_aerodrome == 'ZZZZ' && destination_aerodrome != 'ZZZZ') {
                    if (flight_rules_value != 'Z') {
//                        $("#rules").popover({
//                            html: true,
//                            trigger: "hover"
//                        });
//                        $("#rules").attr('data-content', 'I for IFR, V for VFR, Y for IFR First & Z for VFR First');
                        $("#rules").css("border", "red solid 1px");
//                        console.log('departure_aerodrome ' + departure_aerodrome + 'flight_rules_value ' + flight_rules_value);
                        validation = false;
                    }
                } else if (destination_aerodrome == 'ZZZZ' && departure_aerodrome != 'ZZZZ') {
                    if (flight_rules_value != 'Y') {
                        $("#rules").css("border", "red solid 1px");
                        validation = false;
                    }
                } else if (destination_aerodrome == 'ZZZZ' && departure_aerodrome == 'ZZZZ') {
                    if (flight_rules_value != 'V') {
                        $("#rules").css("border", "red solid 1px");
                        validation = false;
                    }
                } else if (destination_aerodrome != '' || departure_aerodrome != '') {
                    if (flight_rules_value != 'I') {
                        $("#rules").css("border", "red solid 1px");
                        validation = false;
                    }
                }

            });

            if ((flight_rules_value == '') || (flight_rules_value == 'Flight Rule')) {
                $("#rules").attr('data-content', 'I for IFR, V for VFR, Y for IFR First & Z for VFR First');
                $("#rules").css("border", "red solid 1px");
            } else {
                $('#rules').popover('destroy');
                $("#rules").css("border", "lightgrey solid 1px");
            }
            $('.flight_type').on('click', function () {
                if (($("#flight_type_value").text() == '') || ($("#flight_type_value").text() == 'Flight Type')) {

                    $("#types").attr('data-content', 'N for NonforSchedule & G for General');
                    $("#types").css("border", "red solid 1px");

                } else {
                    $('#types').popover('destroy');
                    $("#types").css("border", "lightgrey solid 1px");
                }
            });
            if (($("#flight_type_value").text() == '') || ($("#flight_type_value").text() == 'Flight Type')) {

                $("#types").attr('data-content', 'N for NonforSchedule & G for General');
                $("#types").css("border", "red solid 1px");

            } else {
                $('#types').popover('destroy');
                $("#types").css("border", "lightgrey solid 1px");
            }
            if ((aircraft_type == '') || (aircraft_type.length <= '2')) {
                $("#aircraft_type").attr('data-content', 'Min. 3 & Max. 4 Characters, only Alphabets & Numbers allowed');
                $("#aircraft_type").css("border", "red solid 1px");
            } else {
                $('#aircraft_type').popover('destroy');
                $("#aircraft_type").css("border", "lightgrey solid 1px");
            }
            $('.weight_category').on('click', function () {
                if (($("#weight_category_value").text() == '') || ($("#weight_category_value").text() == 'Weight')) {

                    $("#weight").attr('data-content', 'N for NonforSchedule & G for General');
                    $("#weight").css("border", "red solid 1px");

                } else {
                    $('#weight').popover('destroy');
                    $("#weight").css("border", "lightgrey solid 1px");
                }
            });
            if (($("#weight_category_value").text() == '') || ($("#weight_category_value").text() == 'Weight')) {

                $("#weight").attr('data-content', ' L for Light (< 7,000 Kgs), M for Medium (7,000 to 136,000 Kgs) & H for Heavy (> 136,000 Kgs)');
                $("#weight").css("border", "red solid 1px");

            } else {
                $('#weight').popover('destroy');
                $("#weight").css("border", "lightgrey solid 1px");
            }

            $('.transponder').on('click', function () {
                if (($("#transponder_value").text() == '') || ($("#transponder_value").text() == 'Transponder Mode')) {

                    $("#mode").attr('data-content', 'N for None, A for Mode A (code only indication), C for Mode C (code and altitude indication), S for Mode S (including both pressure altitude and aircraft identification), H for Mode H (including both pressure altitude and enhanced surveillance capability), L for Mode L (including both pressure altitude, extended squitter (ADS-B) and enhanced surveillance capability)');
                    $("#mode").css("border", "red solid 1px");

                } else {
                    $('#mode').popover('destroy');
                    $("#mode").css("border", "lightgrey solid 1px");
                }
            });
            if (($("#transponder_value").text() == '') || ($("#transponder_value").text() == 'Transponder Mode')) {
                $("#mode").attr('data-content', 'N for None, A for Mode A (code only indication), C for Mode C (code and altitude indication), S for Mode S (including both pressure altitude and aircraft identification), H for Mode H (including both pressure altitude and enhanced surveillance capability), L for Mode L (including both pressure altitude, extended squitter (ADS-B) and enhanced surveillance capability)');
                $("#mode").css("border", "red solid 1px");

            } else {
                $('#mode').popover('destroy');
                $("#mode").css("border", "lightgrey solid 1px");
            }

            if ($("#crushing_speed_indication_value").text() == '---') {
                $("#setspeed").attr('data-content', 'N for Knots, M for Mach & K for Kilometres (Min. 3 & Max. 4 Digits)');
                $("#setspeed").css("border", "red solid 1px");
                validation = false;
//                $('#crushing_speed_indication').popover('show');
            } else {
                $('#setspeed').popover('destroy');
                $("#setspeed").css("border", "lightgrey solid 1px");
            }

            $('.crushing_speed_indication').on('click', function () {
                if ($("#crushing_speed_indication_value").text() == '---') {
                    $("#setspeed").attr('data-content', 'N for Knots, M for Mach & K for Kilometres (Min. 3 & Max. 4 Digits)');
                    $("#setspeed").css("border", "red solid 1px");
                    validation = false;
//                $('#crushing_speed_indication').popover('show');
                } else {
                    $('#setspeed').popover('destroy');
                    $("#setspeed").css("border", "lightgrey solid 1px");
                }
            });

            if ($("#crushing_speed_indication_value").text() == 'M') {
                //console.log($("#crushing_speed_indication_value").text());
                if ((crushing_speed == '') || (crushing_speed.length <= '2')) {
                    $("#crushing_speed").attr('data-content', 'N for Knots, M for Mach & K for Kilometres (Min. 3 & Max. 4 Digits)');
                    $("#crushing_speed").css("border", "red solid 1px");
                } else {
                    $('#crushing_speed').popover('destroy');
                    $("#crushing_speed").css("border", "lightgrey solid 1px");
                }
            } else {
                if ((crushing_speed == '') || (crushing_speed.length <= '3')) {
                    $("#crushing_speed").attr('data-content', 'N for Knots, M for Mach & K for Kilometres (Min. 3 & Max. 4 Digits)');
                    $("#crushing_speed").css("border", "red solid 1px");
                } else {
                    $('#crushing_speed').popover('destroy');
                    $("#crushing_speed").css("border", "lightgrey solid 1px");
                }
            }
            if ($("#flight_level_indication_value").text() == '---') {
                $("#setspeedvalue").attr('data-content', 'F for Flight Level & A for Altitude (Min. 3 & Max. 3 Digits)');
                $("#setspeedvalue").css("border", "red solid 1px");
            } else {
                $('#setspeedvalue').popover('destroy');
                $("#setspeedvalue").css("border", "lightgrey solid 1px");
            }
            $('.flight_level_indication').on('click', function () {
                if ($("#flight_level_indication_value").text() == '---') {
                    $("#setspeedvalue").attr('data-content', 'F for Flight Level & A for Altitude (Min. 3 & Max. 3 Digits)');
                    $("#setspeedvalue").css("border", "red solid 1px");
                } else {
                    $('#setspeedvalue').popover('destroy');
                    $("#setspeedvalue").css("border", "lightgrey solid 1px");
                }
            });
            if ((flight_level == '') || (flight_level.length <= '2')) {
                $("#flight_level").attr('data-content', 'F for Flight Level & A for Altitude (Min. 3 & Max. 3 Digits)');
                $("#flight_level").css("border", "red solid 1px");
//                $('#flight_level').popover('show');
            } else {
                $('#flight_level').popover('destroy');
                $("#flight_level").css("border", "lightgrey solid 1px");
            }
            if (($("#total_time_hours").text() == 'Hr') && ($("#total_time_minutes").text() == 'Min')
                    ||
                    ($("#total_time_hours").text() == 'Hr') || ($("#total_time_minutes").text() == 'Min')
                    ||
                    ($("#total_time_hours").text() == '00') && ($("#total_time_minutes").text() == '00')) {
                $("#total_hour").attr('data-content', 'Select Total Flying Time');
                $("#total_hour").css("border", "red solid 1px");
                $("#total_mins").attr('data-content', 'Select Total Flying Time');
                $("#total_mins").css("border", "red solid 1px");
            } else {
                $('#total_hour').popover('destroy');
                $("#total_hour").css("border", "lightgrey solid 1px");
                $('#total_mins').popover('destroy');
                $("#total_mins").css("border", "lightgrey solid 1px");
            }
            $('.total_flying_hours,.total_flying_minutes').on('click', function () {
                if (($("#total_time_hours").text() == 'Hr') && ($("#total_time_minutes").text() == 'Min')
                        ||
                        ($("#total_time_hours").text() == 'Hr') || ($("#total_time_minutes").text() == 'Min')
                        ||
                        ($("#total_time_hours").text() == '00') && ($("#total_time_minutes").text() == '00')) {
                    $("#total_hour").attr('data-content', 'Select Total Flying Time');
                    $("#total_hour").css("border", "red solid 1px");
                    $("#total_mins").attr('data-content', 'Select Total Flying Time');
                    $("#total_mins").css("border", "red solid 1px");
                } else {
                    $('#total_hour').popover('destroy');
                    $("#total_hour").css("border", "lightgrey solid 1px");
                    $('#total_mins').popover('destroy');
                    $("#total_mins").css("border", "lightgrey solid 1px");

                }
            });

            if (($("#endurance_time_hours").text() == 'Hr') && ($("#endurance_time_minutes").text() == 'Min')
                    ||
                    ($("#endurance_time_hours").text() == 'Hr') || ($("#endurance_time_minutes").text() == 'Min')
                    ||
                    ($("#endurance_time_hours").text() == '00') && ($("#endurance_time_minutes").text() == '00')) {
                $("#endurhours").attr('data-content', 'Select Endurance Time');
                $("#endurhours").css("border", "red solid 1px");
                $("#endurmins").attr('data-content', 'Select Endurance');
                $("#endurmins").css("border", "red solid 1px");
            } else {
                $('#endurhours').popover('destroy');
                $("#endurhours").css("border", "lightgrey solid 1px");
                $('#endurmins').popover('destroy');
                $("#endurmins").css("border", "lightgrey solid 1px");
            }

            if (equipment == '') {
                $("#equipment").attr('data-content', 'Min. 1 & Max. 32 Characters, only Alphabets & Numbers allowed');
                $("#equipment").css("border", "red solid 1px");
            } else {
                $('#equipment').popover('destroy');
                $("#equipment").css("border", "lightgrey solid 1px");
            }
            if (transponder == '') {
                $("#transponder").attr('data-content', 'N for None, A for Mode A (code only indication), C for Mode C (code and altitude indication), S for Mode S (including both pressure altitude and aircraft identification), H for Mode H (including both pressure altitude and enhanced surveillance capability), L for Mode L (including both pressure altitude, extended squitter (ADS-B) and enhanced surveillance capability)');
                $("#transponder").css("border", "red solid 1px");
            } else {
                $('#transponder').popover('destroy');
                $("#transponder").css("border", "lightgrey solid 1px");
            }
            if ((first_alternate_aerodrome == "ZZZZ") || (second_alternate_aerodrome == "ZZZZ")) {
                if ((alternate_station == '') || (alternate_station.length <= '2')) {
                    $("#alternate_station").attr('data-content', 'Min. 3 & Max. 25 Characters, only Alphabets allowed');
                    $("#alternate_station").css("border", "red solid 1px");
                } else {
                    $('#alternate_station').popover('destroy');
                    $("#alternate_station").css("border", "lightgrey solid 1px");
                }
            }
            if ((operator == '') || (operator.length <= '2')) {
                $("#operator").attr('data-content', 'Min. 3 & Max. 50 Characters, only Alphabets Numbers and only SPACE Character allowed');
                $("#operator").css("border", "red solid 1px");
            } else {
                $('#operator').popover('destroy');
                $("#operator").css("border", "lightgrey solid 1px");
            }
//            if (equipment.contains("R")) {
            if (equipment.indexOf("R") >= 0) {
                //R present
                if (pbn == '') {
                    $("#pbn").attr('data-content', 'If R is filed in Equipment field then PBN is mandatory (If B1, B2, C1, C2, D1, D2, O1 or O2 is included in PBN then G must be included in Equipment List) (If B3, B4, C3, C4, D3, D4, O1, O3 or O4 is included in PBN then D must be included in Equipment List) (If B5 is included in PBN then I must be included in Equipment List). Only Alphabets & Numbers allowed');
                    $("#pbn").css("border", "red solid 1px");
                } else {
                    $('#pbn').popover('destroy');
                    $("#pbn").css("border", "lightgrey solid 1px");
                }
            } else {
                $('#pbn').popover('destroy');
                $("#pbn").css("border", "lightgrey solid 1px");
            }

            if (nav1.length >= '1') {
                $("#nav1").css("border", "lightgrey solid 1px");
            }
            if ((registration == '') || (registration.length <= '4')) {
                $("#registration").attr('data-content', 'Min. 5 & Max. 7 Characters, only Alphabets & Numbers allowed');
                $("#registration").css("border", "red solid 1px");
            } else {
                $('#registration').popover('destroy');
                $("#registration").css("border", "lightgrey solid 1px");
            }

            if ((sel.length >= '1') && (sel.length <= '3')) {
                $("#sel").attr('data-content', 'SEL CAL (Min. & Max. 4 Alphabets)');
                $("#sel").css("border", "red solid 1px");
                validation = false;
            } else {
                $('#sel').popover('destroy');
                $("#sel").css("border", "lightgrey solid 1px");
            }

            if ((code.length >= '1') && (code.length <= '5')) {
                $("#code").attr('data-content', 'ICAO Hexa Decimal Code');
                $("#code").css("border", "red solid 1px");
            } else {
                $('#code').popover('destroy');
                $("#code").css("border", "lightgrey solid 1px");
            }
            if (per.length == '1') {
                $("#per").css("border", "lightgrey solid 1px");
            }
            if ((take_off_altn.length >= '1') && (take_off_altn.length <= '3')) {
                $("#take_off_altn").attr('data-content', 'Nearest Aerodrome to Departing Station if any problem persists after Take off. 4 Letter ICAO Code only');
                $("#take_off_altn").css("border", "red solid 1px");

            } else {
                $('#take_off_altn').popover('destroy');
                $("#take_off_altn").css("border", "lightgrey solid 1px");
            }
            if ((route1.length >= '1') && (route1.length <= '3')) {
                $("#route1").attr('data-content', 'Enroute Aerodrome for Diversion if any problem persists in Flight. 4 Letter ICAO Code only');
                $("#route1").css("border", "red solid 1px");
            } else {
                $('#route1').popover('destroy');
                $("#route1").css("border", "lightgrey solid 1px");
            }
            if (credit == 'YES' || credit == 'NO') {
                $('.credit_color').removeClass('text-red');
            } else {
                $('.credit_color').addClass('text-red');
                validation = false;
            }
            if (emergency_checkbox == 'uhf' || emergency_checkbox == 'vhf' || emergency_checkbox == 'elba') {
                $('.emergency_border').css('border', "lightgrey solid 1px");
            } else {
                $('.emergency_border').css('border', "red solid 1px");
                validation = false;
            }
            if ((emergency_uhf == "UHF") || (emergency_vhf == "VHF") || (emergency_elba == "ELBA")) {
                $(".emergency").attr('data-content', '“U” if UHF on frequency 243.0 MHz is available, “V” if VHF on frequency 121.5 MHz is available and “E” if an emergency locator transmitter (ELBA) is available');
                $(".emergency").css("border", "red solid 1px");
            } else {
                $('.emergency').popover('destroy');
                $(".emergency").css("border", "lightgrey solid 1px");
            }

            if (number.length == 1) {
                $("#number").attr('data-content', 'Number Should Contains 2 Digits');
                $("#number").css("border", "red solid 1px");
            } else {
                $('#number').popover('destroy');
                $("#number").css("border", "lightgrey solid 1px");
            }
            if (number.length == 2) {
                if ((capacity == '') || (capacity.length <= 2)) {
                    $("#capacity").attr('data-content', 'Number Should Contains 2 Digits');
                    $("#capacity").css("border", "red solid 1px");
                } else {
                    $('#capacity').popover('destroy');
                    $("#capacity").css("border", "lightgrey solid 1px");
                }
            }
            if ($("#cover").is(':checked')) {
                if ((color == '') || (color.length == "1")) {
                    $("#color").attr('data-content', ' C if Dinghies are covered and insert Colour of Dinghies if carried');
                    $("#color").css("border", "red solid 1px");
                } else {
                    $('#color').popover('destroy');
                    $("#color").css("border", "lightgrey solid 1px");
                }
            }
            if (aircraft_color == '' || aircraft_color.length < '3') {
                $("#aircraft_color").css("border", "red solid 1px");

            } else {
                $("#aircraft_color").css("border", "lightgrey solid 1px");
            }
            if (fir_crossing_time == '' && fir_crossing_readonly != 'readonly' && fir_crossing_required == 'required' || ((fir_crossing_time.length >= '1') && (fir_crossing_time.length <= '7'))) {
                $("#fir_crossing_time").attr('data-content', 'Time taken to cross FIR point from Departure Time, only Alphabets & Numbers allowed. Min. 8 & Max. 50 Characters. Example: VABF0012 VIDF0106');
                $("#fir_crossing_time").css("border", "red solid 1px");
            } else {
                $('#fir_crossing_time').popover('destroy');
                $("#fir_crossing_time").css("border", "lightgrey solid 1px");
            }
        }

        if (!validation) {
            return false;
        }
    }
}

