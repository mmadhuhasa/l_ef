$(function () {
   
    var currentDate = $("#date_of_flight").val();//document.getElementById("utcdate").value;
    var current_day = '';
    var current_month = '';
    var current_year = '';
    if (currentDate) {
        current_day = currentDate.substr(4, 2);
        current_month = currentDate.substr(2,2) -1;
        current_year = '20' + currentDate.substr(0, 2);
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
        }
    });
    $(".datepicker").datepicker("option", "dateFormat", "ymmdd");
    $(".datepicker").datepicker("setDate", currentDate);
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    if (from_date == '') {
        from_date = $("#date_of_flight2").val();
    }
    if (to_date == '') {
        to_date = $("#date_of_flight2").val();
    }

    $(".from_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/from-icon1.png', buttonImageOnly: true, maxDate: max_date});
    $(".from_date").datepicker("option", "dateFormat", "ymmdd");
    $(".from_date").datepicker("setDate", from_date);

    $(".to_date").datepicker({showOn: 'both', buttonImage: base_url + '/media/ananth/images/to-icon1.png', buttonImageOnly: true, maxDate: max_date});
    $(".to_date").datepicker("option", "dateFormat", "ymmdd");
    $(".to_date").datepicker("setDate", to_date);

    $('.disable_paste').bind("paste", function (e) {
        e.preventDefault();
    });
    //Make text upper case
    $(document).on('keyup', '.text_uppercase', function () {
        var reid = $(".text_uppercase").map(function () {
            this.value = this.value.toUpperCase();
        }).get().join();
    });
    
    //Make text lower case
    $(document).on('keyup', '.text_lowercase', function () {
        var reid = $(".text_lowercase").map(function () {
            this.value = this.value.toLowerCase()
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
        var regex = new RegExp("^[a-zA-Z0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $('.numeric').on('keypress', function (e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $('.alphabets').on('keypress', function (e) {
        var regex = new RegExp("^[a-zA-Z]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $('.route_allowed_chars').on('keypress', function (e) {
        var regex = new RegExp("^[a-zA-Z0-9/ ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $('.pilot_in_command').on('keypress', function (e) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });

    $('.operator').on('keypress', function (e) {
        var regex = new RegExp("^[a-zA-Z0-9 ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
});

function addDays(theDate, days) {
    return new Date(theDate.getTime() + days * 24 * 60 * 60 * 1000);
}
