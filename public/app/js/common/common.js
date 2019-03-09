
$(function () {
    //UTC date
    var currentDate = $("#date_of_flight").val();//document.getElementById("utcdate").value;
    var default_fpl_date = $("#default_fpl_date").val();//document.getElementById("utcdate").value;
    var current_day = '';
    var current_month = '';
    var current_year = '';
    if (default_fpl_date) {
        current_day = default_fpl_date.substr(4, 2);
        current_month = default_fpl_date.substr(2, 2) - 1;
        current_year = '20' + default_fpl_date.substr(0, 2);
    }
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

    $(".datepicker").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/calender-icon1.png', buttonImageOnly: true, minDate: min_date, maxDate: max_date, showOtherMonths: true, selectOtherMonths: true,
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
        },
        onSelect: function () {
            $(".notify-bg-v").fadeOut();
        }
    });
    $(".datepicker").datepicker("option", "dateFormat", "dd-M-yy");
    $(".datepicker").datepicker("setDate", currentDate);
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    if (from_date == '') {
        from_date = $("#date_of_flight2").val();
    }
    if (to_date == '') {
        to_date = $("#date_of_flight2").val();
    }

    $(".from_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/from-icon1.png', buttonImageOnly: true, maxDate: max_date,
        onSelect: function () {
            $(".notify-bg-v").fadeOut();
        }
    });
    $(".from_date").datepicker("option", "dateFormat", "dd-M-yy");
    $(".from_date").datepicker("setDate", from_date);

    $(".to_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/to-icon1.png', buttonImageOnly: true, maxDate: max_date,
        onSelect: function () {
            $(".notify-bg-v").fadeOut();
        }
    });
    $(".to_date").datepicker("option", "dateFormat", "dd-M-yy");
    $(".to_date").datepicker("setDate", to_date);

    $('.disable_paste').bind("paste", function (e) {
        e.preventDefault();
    });
    //Make text upper case
    $(document).on('keyup', '.text_uppercase', function () {
        fpl_validation();
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

    $('.alpha_numeric').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z0-9]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;

        if ((e.charCode < 97 || e.charCode > 122)
                && (e.charCode < 65 || e.charCode > 90)
                && (e.charCode != 45)
                && (e.charCode < 48 || e.charCode > 57)
                && (e.charCode != 0))
            return false;

    });

    $('.alpha_numeric').bind('paste input', function (e) {
        $(this).val($(this).val().replace(/[^a-zA-Z0-9]/g, '').toUpperCase());
    });

    $('.numeric').bind('paste input', function (e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });

    $('.numbers').bind('paste input', function (e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });

    $('.alphabets').bind('paste input', function (e) {
        $(this).val($(this).val().replace(/[^a-zA-Z]/g, '').toUpperCase());
    });

    $('.pilot_in_command').bind('paste input', function (e) {
        $(this).val($(this).val().replace(/[^a-zA-Z ]/g, '').toUpperCase());
    });

    $('.operator').bind('paste input', function (e) {
        $(this).val($(this).val().replace(/[^a-zA-Z0-9 ]/g, '').toUpperCase());
    });

    $('.route_allowed_chars').bind('paste input', function (e) {
        $(this).val($(this).val().replace(/[^a-zA-Z0-9/ ]/g, '').toUpperCase());
    });


    $('.numeric').on('keypress', function (e) {
//        var regex = new RegExp("^[0-9]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;

        if ((e.charCode < 48 || e.charCode > 57)
                && (e.charCode != 0)
                && (e.charCode != 8))
            return false;
    });

    $('.numbers').on('keypress', function (e) {
//        var regex = new RegExp("^[0-9]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;

        if (
                (e.charCode < 48 || e.charCode > 57)
                && (e.charCode != 0)
                && (e.charCode != 8))
            return false;
    });

    $('.alphabets').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;

        if ((e.charCode < 97 || e.charCode > 122)
                && (e.charCode < 65 || e.charCode > 90)
                && (e.charCode != 45)
                && (e.charCode != 0))
            return false;

    });

    $('.route_allowed_chars').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z0-9/ ]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;

        if ((e.charCode < 97 || e.charCode > 122)
                && (e.charCode < 65 || e.charCode > 90)
                && (e.charCode != 45)
                && (e.charCode < 48 || e.charCode > 57)
                && (e.charCode != 0)
                && (e.charCode != 32)
                && (e.charCode != 47))
            return false;

    });

    $('.pilot_in_command').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z ]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;

        if ((e.charCode < 97 || e.charCode > 122)
                && (e.charCode < 65 || e.charCode > 90)
                && (e.charCode != 45)
                && (e.charCode != 0)
                && (e.charCode != 32)
                )
            return false;

    });

    $('.operator').on('keypress', function (e) {
//        var regex = new RegExp("^[a-zA-Z0-9 ]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;

        if ((e.charCode < 97 || e.charCode > 122)
                && (e.charCode < 65 || e.charCode > 90)
                && (e.charCode != 45)
                && (e.charCode < 48 || e.charCode > 57)
                && (e.charCode != 0)
                && (e.charCode != 32)
                )
            return false;

    });

    $("#departure_aerodrome").keyup(function () {
        var departure_aerodrome = $("#departure_aerodrome").val().toUpperCase();
        var validation = true;
        if (departure_aerodrome == "ZZZZ") {
            $("#departure_station").removeAttr('readonly');
            $("#departure_latlong").removeAttr('readonly');
            $("#departure_aerodrome").css("border", "lightgrey solid 1px");
            $("#departure_station").attr('required', 'required').css("border", "#f1292b solid 1px");
            $("#departure_latlong").attr('required', 'required').css("border", "#f1292b solid 1px");
        } else {
            $("#departure_station").attr('readonly', 'readonly');
            $("#departure_latlong").attr('readonly', 'readonly');
            $("#departure_station").val('');
            $("#departure_latlong").val('');
        }
        if ((departure_aerodrome == '') || (departure_aerodrome.length <= '3')) {
//            $("#departure_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Departing Station (Min. & Max. 4 Alphabets)');
            $("#departure_aerodrome").css("border", "#f1292b solid 1px");
            $("#is_form_valid").val('0');
            validation = false;
        } else {
            $('#departure_aerodrome').popover('destroy');
            $("#departure_aerodrome").css("border", "lightgrey solid 1px");
        }
    });

    $("#destination_aerodrome").keyup(function () {
        var destination_aerodrome = $("#destination_aerodrome").val().toUpperCase();
        var validation = true;
        if (destination_aerodrome == "ZZZZ") {
            $("#destination_station").removeAttr('readonly');
            $("#destination_latlong").removeAttr('readonly');
            $("#destination_station").attr('required', 'required').css("border", "#f1292b solid 1px");
            $("#destination_latlong").attr('required', 'required').css("border", "#f1292b solid 1px");
            $("#destination_aerodrome").css("border", "lightgrey solid 1px");
        } else {
            $("#destination_station").attr('readonly', 'readonly');
            $("#destination_latlong").attr('readonly', 'readonly');
            $("#destination_station").val('');
            $("#destination_latlong").val('');
        }
        if ((destination_aerodrome == '') || (destination_aerodrome.length <= '3')) {
//            $("#destination_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
            $("#destination_aerodrome").css("border", "#f1292b solid 1px");
            validation = false;
        } else {
            $('#destination_aerodrome').popover('destroy');
            $("#destination_aerodrome").css("border", "lightgrey solid 1px");
        }

    });
    function fpl_validation(){
        var aircraft_callsign=$("#aircraft_callsign").val();
        var is_aircraft_callsign=false;
        if(aircraft_callsign.length>=5){
         is_aircraft_callsign=true;
        }
        else
         is_aircraft_callsign=false;

        var departure_aerodrome=$("#departure_aerodrome").val();
        var is_departure_aerodrome=false;
        if(departure_aerodrome.length>=4){
         is_departure_aerodrome=true;
        }
        else
         is_departure_aerodrome=false;

        var destination_aerodrome=$("#destination_aerodrome").val();
        var is_destination_aerodrome=false;
        if(destination_aerodrome.length>=4){
         is_destination_aerodrome=true;
        }
        else
         is_destination_aerodrome=false;

        var dep_time_hours=$("#dep_time_hours").text();
        var is_dep_time_hours=false;
        if(dep_time_hours!="Hr"){
         is_dep_time_hours=true;
        }
        else
         is_dep_time_hours=false;

        var dep_time_minutes=$("#dep_time_minutes").text();
        var is_dep_time_minutes=false;
        if(dep_time_minutes!="Min"){
         is_dep_time_minutes=true;
        }
        else
         is_dep_time_minutes=false;

        var pilot_in_command=$("#pilot_in_command").val();
        var is_pilot_in_command=false;
        if(pilot_in_command.length>=2){
         is_pilot_in_command=true;
        }
        else
         is_pilot_in_command=false;

        var mobile_number=$("#mobile_number").val();
        var is_mobile_number=false;
        if(mobile_number.length>=10){
         is_mobile_number=true;
        }
        else
         is_mobile_number=false;

        var copilot=$("#copilot").val();
        var is_copilot=false;
        if(copilot.length>=2){
         is_copilot=true;
        }
        else
         is_copilot=false;

       var cabincrew=$("#cabincrew").val();
       var is_cabincrew=true;
       if(cabincrew.length>=2){
        is_cabincrew=true;
       }
       else if(cabincrew.length>=1 && cabincrew.length<2)
        is_cabincrew=false;

      var remarks=$("#remarks").val();
      var is_remarks=true;
      if(remarks.length>=3){
       is_remarks=true;
      }
      else if(remarks.length>=1 && remarks.length<3)
       is_remarks=false;

     var dept_place=$("#departure_station").val();
     var is_dept_place=true; 
     if(departure_aerodrome=='zzzz'||departure_aerodrome=='ZZZZ'){
          if(dept_place.length>=3){
            is_dept_place=true;
          }  
          else if(dept_place.length<3){
            is_dept_place=false;
          }
     }

     var dept_lat=$("#departure_latlong").val();
     var is_dept_lat=true; 
     if(departure_aerodrome=='zzzz'||departure_aerodrome=='ZZZZ'){
          if(dept_lat.length>=11){
            is_dept_lat=true;
          }  
          else if(dept_lat.length<11){
            is_dept_lat=false;
          }
     }
     
     var dest_place=$("#destination_station").val();
     var is_dest_place=true; 
     if(destination_aerodrome=='zzzz'||destination_aerodrome=='ZZZZ'){
          if(dest_place.length>=3){
            is_dest_place=true;
          }  
          else if(dest_place.length<3){
            is_dest_place=false;
          }
     }

     var dest_lat=$("#destination_latlong").val();
     var is_dest_lat=true; 
     if(destination_aerodrome=='zzzz'||destination_aerodrome=='ZZZZ'){
          if(dest_lat.length>=11){
            is_dest_lat=true;
          }  
          else if(dest_lat.length<11){
            is_dest_lat=false;
          }
     }
     console.log("is_aircraft_callsign="+is_aircraft_callsign);
     console.log("is_departure_aerodrome="+is_departure_aerodrome);
     console.log("is_destination_aerodrome="+is_destination_aerodrome);
     console.log("is_dep_time_hours="+is_dep_time_hours);
     console.log("is_dep_time_minutes="+is_dep_time_minutes);
     console.log("is_pilot_in_command="+is_pilot_in_command);
     console.log("is_mobile_number="+is_mobile_number);
     console.log("is_copilot="+is_copilot);
     console.log("is_cabincrew="+is_cabincrew);
     console.log("is_remarks="+is_remarks);
     console.log("is_dept_place="+is_dept_place);
     console.log("is_dept_lat="+is_dept_lat);
     console.log("is_dest_place="+is_dest_place);
     console.log("is_dest_lat="+is_dest_lat);
     if(is_aircraft_callsign==true && is_departure_aerodrome==true && is_destination_aerodrome==true && is_dep_time_hours==true && is_dep_time_minutes==true && is_pilot_in_command==true && is_mobile_number==true && is_copilot==true && is_cabincrew==true && is_remarks==true  && is_dept_place==true && is_dept_lat==true && is_dest_place==true && is_dest_lat==true){
          console.log("if");
          $("#process").prop("disabled",false);
     }
     else if(is_aircraft_callsign==false || is_departure_aerodrome==false || is_destination_aerodrome==false || is_dep_time_hours==false || is_dep_time_minutes==false || is_pilot_in_command==false || is_mobile_number==false || is_copilot==false || is_cabincrew==false || is_remarks==false  || is_dept_place==true || is_dept_lat==true || is_dest_place==true ||is_dest_lat==true){
         console.log("else");
          $("#process").prop("disabled",true);
     }
    } 
    $(".dropdown dd ul li a,.dropdowns dd ul li a").click(function () {
        fpl_validation();
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
                setTimeout(function(){fpl_validation();},500);
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
                   
                    if ((latlongvalue == '') || (latlongvalue.length <= '8')) {
                        $("#departure_latlong").attr('data-content', 'Min. 9 & Max. 15 Characters, only Alphabets & Numbers allowed (Eg: 1257N07739E or BBG353020)');
                        $("#departure_latlong").css("border", "red solid 1px");
                       

                    } else {
                        $("#departure_latlong").val(latlongvalue);
                         // fpl_validation();
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
                        $("#destination_latlong").val(latlongvalue);
                         // fpl_validation();
                        $('#destination_latlong').popover('destroy');
                        $("#destination_latlong").css("border", "lightgrey solid 1px");
                    }
                }
            });
        }
    $("#pilot_in_command").autocomplete({
        minLength: 0,
        source: function (request, response) {
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
                    var pp = $("#pilot_in_command").attr('readonly')
                    console.log('JJ', pp);
                    if (pp != 'readonly') {
                        response(data);
                    }
                }
            });
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#pilot_in_command").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#pilot_in_command").css("border", "#f1292b solid 1px");
//                $('#pilot_in_command').popover('show');
            } else {
                $('#pilot_in_command').popover('destroy');
                $("#pilot_in_command").css("border", "lightgrey solid 1px");
            }
            get_pilot_mobile(ui.item.value);
            lnt_validation('pilot_in_command');
            setTimeout(function(){  fpl_validation(); },500); 
        }
    }).click(function () {
        $(this).autocomplete('search', $(this).val())
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
        <span style="color:red;" >(min. 10 & max. 10 numbers)</span>');
                    $("#mobile_number").css("border", "#f1292b solid 1px");
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
        $("#mobile_number").val('');
        if (pilot_in_command == '' || (pilot_in_command.length < '2')) {
            $("#pilot_in_command").css("border", "#f1292b solid 1px");
        } else {
            $('#pilot_in_command').popover('destroy');
            $("#pilot_in_command").css("border", "lightgrey solid 1px");
        }
    });

    $("#mobile_number").on('keyup', function () {
        fpl_validation();
        var mobile_number = $(this).val().toUpperCase();
        if (mobile_number == '' || (mobile_number.length < '10')) {
            $("#mobile_number").css("border", "#f1292b solid 1px");
        } else {
            $('#mobile_number').popover('destroy');
            $("#mobile_number").css("border", "lightgrey solid 1px");
        }
    });

    $("#copilot").on('keyup', function () {
        var copilot = $(this).val().toUpperCase();
        if (copilot == '' || (copilot.length < '2')) {
            $("#copilot").css("border", "#f1292b solid 1px");
        } else {
            $('#copilot').popover('destroy');
            $("#copilot").css("border", "lightgrey solid 1px");
        }
    });

    $("#copilot").autocomplete({
        minLength: 0,
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
                    var pp = $("#copilot").attr('readonly')
                    console.log('cc', pp);
                    if (pp != 'readonly') {
                        response(data);
                    }
                }
            });
        },
        select: function (event, ui) {
            if ((ui.item.value == '') || (ui.item.value.length <= '1')) {
                $("#copilot").attr('data-content', 'Min. 2 & Max. 25 Alphabets and only SPACE Character allowed');
                $("#copilot").css("border", "#f1292b solid 1px");
//                $('#copilot').popover('show');
            } else {
                $('#copilot').popover('destroy');
                $("#copilot").css("border", "lightgrey solid 1px");
            }
            lnt_validation('copilot');
            setTimeout(function(){  fpl_validation(); },500);

        }
    }).click(function () {
        $(this).autocomplete('search', $(this).val());
    });




//    Number.prototype.between = function (a, b, inclusive) {
//        var min = Math.min.apply(Math, [a, b]),
//                max = Math.max.apply(Math, [a, b]);
//        return inclusive ? this >= min && this <= max : this > min && this < max;
//    };

    $('.max_value_valid').keydown(function (event) {
        var id = $.trim($(this).attr('id'));
        console.log(id)
        var v = parseFloat(this.value + String.fromCharCode(event.which));
        if (id == "weight16") {
            return parseFloat(v).between(0, 25, true);
        } else if (id == "weight17") {
            return parseFloat(v).between(0, 350, true);
        } else if (id == "weight18") {
            console.log('Hii')
            return parseFloat(v).between(0, 19592, true);
        } else if (id == "weight19") {
            return parseFloat(v).between(0, 19592, true);
        } else {
            return true;
        }

    });

// $( 'ul.sf-menu li' ).on( 'click', function() {
////          var value1 = $(this).children().text();
////          alert(value1);
//
//            $('ul').find('.active').removeClass( 'active' );
//            $(this).addClass('active');
//      });


//    $('.nav ul.sf-menu li a').each(function(){
//        var path = window.location.href;
//        var current = path.substring(path.lastIndexOf('/')+1);
//        var url = $(this).attr('href');
//        alert(url);
//
//        if(url == current){
//            $(this).addClass('active');
//        };
//    });



    setInterval(web_notification, 60000)

    $(document).on('click', '.fpl_notify_click', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: base_url + "/notifications/onclick",
            type: "POST",
            data: {'id': id},
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data, textStatus, jqXHR) {
                console.log('onclick in Notification');
                $("#notify_count").html(data.notify_count);
                $("#" + id).css('font-weight', 'normal');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('onclick in Notification');
            }
        })
    });

});//End of document

//$(function () {
//    setNavigation();
//});
//
//function setNavigation() {
//    var path = window.location.pathname;
//    path = path.replace(/\/$/, "");
//    path = decodeURIComponent(path);
//
//    $(".nav a").each(function () {
//        var href = $(this).attr('href');
//        if (path.substring(0, href.length) === href) {
//            $(this).closest('li').addClass('active');
//        }
//    });
//}
//$(function() {
//     var pgurl = window.location.href.substr(window.location.href
//.lastIndexOf("/")+1);
//     $("nav ul a").each(function(){
//        // var x = $(this).attr("href");
//       
//          if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
//           $(this).closest("li").addClass("current"); 
//     })
//});

var str = location.href.toLowerCase();
$("ul li a").each(function () {
    if (str.indexOf(this.href.toLowerCase()) > -1) {
        $("li.current").removeClass("current");
        $(this).addClass("current");
    }
});


/* here's the code if u want to use plain javascript
 
 function setActive() {
 aObj = document.getElementById('nav').getElementsByTagName('a');
 for(i=0;i<aObj.length;i++) { 
 if(document.location.href.indexOf(aObj[i].href)>=0) {
 aObj[i].className='active';
 }
 }
 }
 
 window.onload = setActive;
 
 */

function minmax(value, min, max)
{
    if (parseInt(value) < min || isNaN(value))
        return 0;
    else if (parseInt(value) > max)
        return max;
    else
        return value;
}

function time_minmax(value, min, max)
{
    if (value.length >= 4) {
        if (value.substring(2, 4) > 59 && value.substring(0, 2) > 23) {
            return '0000';
        }
        if (value.substring(2, 4) > 59 && value.substring(0, 2) <= 23) {
            return value.substring(0, 2) + '00';
        }
        if (value.substring(0, 2) > 23) {
            return '0000';
        }
        if (parseInt(value) < min || isNaN(value))
            return 0;
        else if (parseInt(value) > max)
            return max;
        else
            return value;
    } else
        return value;
}

function web_notification() {
    var api_text = $("#api").text();
    var add_value = 1;
    add_value = Number(api_text) + Number(add_value);
    var user_id = $('[name="user_id"]').val();
    var data_url = base_url + "/api/notifications/new";
    var data = {'user_id': user_id};
    var fpl_result = '';
    var cancel_fpl_result = '';
    var delay_fpl_result = '';
    var change_fpl_result = '';
    $.ajax({
        url: data_url,
        type: 'GET',
        data: data,
        cache: false,
        success: function (data, textStatus, jqXHR) {
//            $("#api").html(data);
//            $.each(data.success, function (i, v) {
            $.each(data.fpl_notifications, function (fpl_i, fpl_v) {
                if (fpl_v.viewed_user_id != 0) {
                    fpl_result += '<li>' + fpl_v.subject + '</li>';
                } else {
                    fpl_result += '<li class="fpl_notify_click" id= "' + fpl_v.id + '" style="font-weight:bold;color:black;cursor:pointer">' + fpl_v.subject + '</li>';
                }
            });
            $.each(data.fpl_notifications2, function (fpl_i, fpl_v) {
                if (fpl_v.viewed_user_id != 0) {
                    cancel_fpl_result += '<li>' + fpl_v.subject + '</li>';
                } else {
                    cancel_fpl_result += '<li class="fpl_notify_click" id= "' + fpl_v.id + '" style="font-weight:bold;color:black;cursor:pointer">' + fpl_v.subject + '</li>';
                }
            });
            $.each(data.fpl_notifications3, function (fpl_i, fpl_v) {
                if (fpl_v.viewed_user_id != 0) {
                    delay_fpl_result += '<li>' + fpl_v.subject + '</li>';
                } else {
                    delay_fpl_result += '<li class="fpl_notify_click" id= "' + fpl_v.id + '" style="font-weight:bold;color:black;cursor:pointer">' + fpl_v.subject + '</li>';
                }
            });
            $.each(data.fpl_notifications4, function (fpl_i, fpl_v) {
                if (fpl_v.viewed_user_id != 0) {
                    change_fpl_result += '<li>' + fpl_v.subject + '</li>';
                } else {
                    change_fpl_result += '<li class="fpl_notify_click" id= "' + fpl_v.id + '" style="font-weight:bold;color:black;cursor:pointer">' + fpl_v.subject + '</li>';
                }
            });

//                if (window.Notification && Notification.permission !== "denied") {
//                        Notification.requestPermission(function (status) {  // status is "granted", if accepted by user
//                            var title = v.action_name;
//                            var body = v.subject;
//                            var n = new Notification(title, {
//                                body: body,
//                                dir: "ltr",
//                                sound: base_url + '/media/audio/1-19992.mp3',
//                                icon: base_url + '/app/new_temp/images/logo-web.png' // optional https://davidwalsh.name/demo/notifications-api.php
//                            });
//
//                            var snd = new Audio(base_url + '/media/audio/beep-05.mp3');
//                            snd.play();
//
//                            n.onshow = function () {
//                                console.log('Notification shown');
//                            };
//                            n.onerror = function () {
//                                console.log('Error in Notification');
//                            }
//                            n.onclick = function () {
//                                $.ajax({
//                                    url: base_url + "/notifications/onclick",
//                                    type: "POST",
//                                    data: {'id': v.id},
//                                    cache: false,
//                                    headers: {
//                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//                                    },
//                                    success: function (data, textStatus, jqXHR) {
//                                        console.log('onclick in Notification');
//                                    },
//                                    error: function (jqXHR, textStatus, errorThrown) {
//                                        console.log('onclick in Notification');
//                                    }
//                                })
//                            }
//                            n.onclose = function () {
//                                $.ajax({
//                                    url: base_url + "/notifications/onclose",
//                                    type: "POST",
//                                    data: {'id': v.id},
//                                    cache: false,
//                                    headers: {
//                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//                                    },
//                                    success: function (data, textStatus, jqXHR) {
//                                        console.log('onclick in Notification');
//                                    },
//                                    error: function (jqXHR, textStatus, errorThrown) {
//                                        console.log('onclick in Notification');
//                                    }
//                                })
//                            }
//                            n.close();
//                        });
//                    }


//                });

            $("#new_fpl_notify").html('<ul>' + fpl_result + '</ul>');
            $("#cancel_fpl_notify").html('<ul>' + cancel_fpl_result + '</ul>');
            $("#delay_fpl_notify").html('<ul>' + delay_fpl_result + '</ul>');
            $("#change_fpl_notify").html('<ul>' + change_fpl_result + '</ul>');
            $("#notify_count").html(data.notify_count);
//            $(data.success).each(function (i, v) {
//                console.log('i ' + i + ' v ' + v)
//            });
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown)
        }
    })

}

function addDays(theDate, days) {
    return new Date(theDate.getTime() + days * 24 * 60 * 60 * 1000);
}

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
            if ((departure_aerodrome == '') || (departure_aerodrome.length <= '3')) {
                $("#departure_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#departure_aerodrome").css("border", "#f1292b solid 1px");
                validation = false;
            } else {
                $('#departure_aerodrome').popover('destroy');
                $("#departure_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ((destination_aerodrome == '') || (destination_aerodrome.length <= '3')) {
//                $("#destination_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
//                $("#destination_aerodrome").css("border", "#f1292b solid 1px");
                validation = false;
            } else {
                $('#destination_aerodrome').popover('destroy');
                $("#destination_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ($("#departure_time").length > 0) {
                if (departure_time == '' || departure_time.length < 4) {
                    $("#departure_time").css('border', 'red 1px solid');
                    validation = false;
                } else {
                    $("#departure_time").css('border', 'lightgrey 1px solid');

                }
            } else {
                $("#departure_time").css('border', 'lightgrey 1px solid');
                validation = false;

            }
        } else {
            validation = false;
        }
    } else if (data_value == 'copilot') {
        if (departure_aerodrome != '' && destination_aerodrome != '' && departure_time != '' && pilot_in_command != ''
                && take_off_fuel != '' && landing_fuel != '' && take_off_fuel != '' && landing_fuel != '')
        {
            if ((departure_aerodrome == '') || (departure_aerodrome.length <= '3')) {
                $("#departure_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#departure_aerodrome").css("border", "#f1292b solid 1px");
                validation = false;
            } else {
                $('#departure_aerodrome').popover('destroy');
                $("#departure_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ((destination_aerodrome == '') || (destination_aerodrome.length <= '3')) {
//                $("#destination_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
//                $("#destination_aerodrome").css("border", "#f1292b solid 1px");
                validation = false;
            } else {
                $('#destination_aerodrome').popover('destroy');
                $("#destination_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ($("#departure_time").length > 0) {
                if (departure_time == '' || departure_time.length < 4) {
                    $("#departure_time").css('border', 'red 1px solid');
                    validation = false;
                } else {
                    $("#departure_time").css('border', 'lightgrey 1px solid');

                }
            } else {
                $("#departure_time").css('border', 'lightgrey 1px solid');
                validation = false;

            }

        } else {
            validation = false;
        }
    } else {
        if (departure_aerodrome != '' && destination_aerodrome != '' && departure_time != '' && pilot_in_command != ''
                && copilot != '' && take_off_fuel != '' && landing_fuel != '' && take_off_fuel != '' && landing_fuel != '')
        {

            if ((departure_aerodrome == '') || (departure_aerodrome.length <= '3')) {
                $("#departure_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
                $("#departure_aerodrome").css("border", "#f1292b solid 1px");
                validation = false;
            } else {
                $('#departure_aerodrome').popover('destroy');
                $("#departure_aerodrome").css("border", "lightgrey solid 1px");
            }

            if ((destination_aerodrome == '') || (destination_aerodrome.length <= '3')) {
//                $("#destination_aerodrome").attr('data-content', 'ICAO Codes only, use ZZZZ if no Code allocated for Destination Station (Min. & Max. 4 Alphabets)');
//                $("#destination_aerodrome").css("border", "#f1292b solid 1px");
                validation = false;
            } else {
                $('#destination_aerodrome').popover('destroy');
                $("#destination_aerodrome").css("border", "lightgrey solid 1px");
            }
            if ($("#departure_time").length > 0) {
                if (departure_time == '' || departure_time.length < 4) {
                    $("#departure_time").css('border', 'red 1px solid');
                    validation = false;
                } else {
                    $("#departure_time").css('border', 'lightgrey 1px solid');

                }
            } else {
                $("#departure_time").css('border', 'lightgrey 1px solid');
                validation = false;

            }
        } else {
            validation = false;
        }
    }
    if (take_off_fuel != '' && landing_fuel != '') {
        if (parseInt(landing_fuel) < parseInt(take_off_fuel) && take_off_fuel.length >= 4 && landing_fuel.length >= 4) {
            $("#weight19").css('border', 'lightgrey 1px solid');
        } else {
            $("#weight19").css('border', 'red 1px solid');
            validation = false;
        }
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