function lnt_validation(data_value) {
    console.log('lnt_validation')
    var departure_aerodrome = $("#departure_aerodrome").val();
    var destination_aerodrome = $("#destination_aerodrome").val();
    var departure_time = $("#departure_time").val();
    var pilot_in_command = $("#pilot_in_command").val();
    var copilot = $("#copilot").val();
    var take_off_fuel = $("#weight18").val();
    var landing_fuel = $("#weight19").val();
    var is_form_valid = $("#is_form_valid").val();
    var validation = true;
    if (data_value == 'pilot_in_command') {
        if (departure_aerodrome != '' && destination_aerodrome != '' && departure_time != ''
                && copilot != '' && take_off_fuel != '' && landing_fuel != '' && take_off_fuel != '' && landing_fuel != '')
        {
            if (parseInt(landing_fuel) < parseInt(take_off_fuel) && take_off_fuel.length >= 4 && landing_fuel.length >= 4) {
                $("#weight19").css('border', 'lightgrey 1px solid');
            } else {
                $("#weight19").css('border', 'red 1px solid');
                validation = false;
            }

            if ((departure_aerodrome == '') || (departure_aerodrome.length <= '3')) {
                $("#departure_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#departure_aerodrome").css("border", "red solid 1px");
                validation = false;
            } else {
                $('#departure_aerodrome').popover('destroy');
                $("#departure_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ((destination_aerodrome == '') || (destination_aerodrome.length <= '3')) {
                $("#destination_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#destination_aerodrome").css("border", "red solid 1px");
                validation = false;
            } else {
                $('#destination_aerodrome').popover('destroy');
                $("#destination_aerodrome").css("border", "lightgrey solid 1px");
            }

            if (departure_time == '' || departure_time.length < 4) {
                $("#departure_time").css('border', 'red 1px solid');
                validation = false;
            } else {
                $("#departure_time").css('border', 'lightgrey 1px solid');

            }


        } else {
            validation = false;
        }
    } else if (data_value == 'copilot') {
        if (departure_aerodrome != '' && destination_aerodrome != '' && departure_time != '' && pilot_in_command != ''
                && take_off_fuel != '' && landing_fuel != '' && take_off_fuel != '' && landing_fuel != '')
        {
            if (parseInt(landing_fuel) < parseInt(take_off_fuel) && take_off_fuel.length >= 4 && landing_fuel.length >= 4) {
                $("#weight19").css('border', 'lightgrey 1px solid');
            } else {
                $("#weight19").css('border', 'red 1px solid');
                validation = false;
            }

            if ((departure_aerodrome == '') || (departure_aerodrome.length <= '3')) {
                $("#departure_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#departure_aerodrome").css("border", "red solid 1px");
                validation = false;
            } else {
                $('#departure_aerodrome').popover('destroy');
                $("#departure_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ((destination_aerodrome == '') || (destination_aerodrome.length <= '3')) {
                $("#destination_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#destination_aerodrome").css("border", "red solid 1px");
                validation = false;
            } else {
                $('#destination_aerodrome').popover('destroy');
                $("#destination_aerodrome").css("border", "lightgrey solid 1px");
            }

            if (departure_time == '' || departure_time.length < 4) {
                $("#departure_time").css('border', 'red 1px solid');
                validation = false;
            } else {
                $("#departure_time").css('border', 'lightgrey 1px solid');

            }

        } else {
            validation = false;
        }
    } else {
        if (departure_aerodrome != '' && destination_aerodrome != '' && departure_time != '' && pilot_in_command != ''
                && copilot != '' && take_off_fuel != '' && landing_fuel != '' && take_off_fuel != '' && landing_fuel != '')
        {
            if (parseInt(landing_fuel) < parseInt(take_off_fuel) && take_off_fuel.length >= 4 && landing_fuel.length >= 4) {
                $("#weight19").css('border', 'lightgrey 1px solid');
            } else {
                $("#weight19").css('border', 'red 1px solid');
                validation = false;
            }

            if ((departure_aerodrome == '') || (departure_aerodrome.length <= '3')) {
                $("#departure_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#departure_aerodrome").css("border", "red solid 1px");
                validation = false;
            } else {
                $('#departure_aerodrome').popover('destroy');
                $("#departure_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ((destination_aerodrome == '') || (destination_aerodrome.length <= '3')) {
                $("#destination_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#destination_aerodrome").css("border", "red solid 1px");
                validation = false;
            } else {
                $('#destination_aerodrome').popover('destroy');
                $("#destination_aerodrome").css("border", "lightgrey solid 1px");
            }

            if (departure_time == '' || departure_time.length < 4) {
                $("#departure_time").css('border', 'red 1px solid');
                validation = false;
            } else {
                $("#departure_time").css('border', 'lightgrey 1px solid');

            }

        } else {
            validation = false;
        }
    }
    if (parseInt(landing_fuel) < parseInt(take_off_fuel) && take_off_fuel.length >= 4 && landing_fuel.length >= 4) {
        $("#weight19").css('border', 'lightgrey 1px solid');
    } else {
        $("#weight19").css('border', 'red 1px solid');
        validation = false;
    }
    if (!validation) {
        $(".calculate_lnt").attr('disabled', 'disabled');
        $(".save_lnt_data").addClass('disabled');
        $(".graph_print").addClass('disabled')
        //            return false;
    } else {
        $(".calculate_lnt").removeAttr('disabled');
    }
}