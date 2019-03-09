/* JavaScript For FPL Page */


function setutcClock() {
    var currentTime = new Date();
    var month = ["JAN", "FEB", "MAR", "ARP", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    var timeString = ("0" + currentTime.getUTCHours()).slice(-2);
    timeString = timeString + ":";
    timeString = timeString + ("0" + currentTime.getUTCMinutes()).slice(-2);
    timeString = timeString + " UTC ";
    $("#newtimeTM").html(timeString);
}



$(function () {
    // Calling Login Form
    $("#login_form").click(function () {
        $(".social_login").hide();
        $(".user_login").show();
        return false;
    });

    // Calling Register Form
    $("#register_form").click(function () {
        $(".social_login").hide();
        $(".user_register").show();
        $(".header_title").text('Register');
        return false;
    });

    // Going back to Social Forms
    $(".back_btn").click(function () {
        $(".user_login").hide();
        $(".user_register").hide();
        $(".social_login").show();
        $(".header_title").text('Login');
        return false;
    });

});



$("document").ready(function () {
    setTimeout(function () {
        $(".icon-angle-right").trigger("click");
    }, 4000);
});


$(document).ready(function () {

    window.setInterval(setutcClock, 1000);

    $(".dropdown dt a").click(function () {
        $(".dropdown dd ul").toggle();
    });

    $(".dropdown dd ul li a").click(function () {
        var text = $(this).html();
        $(".dropdown dt a span").html(text);
        $(".dropdown dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdown"))
            $(".dropdown dd ul").hide();
    });


    $(".dropdowns dt a").click(function () {
        $(".dropdowns dd ul").toggle();
    });

    $(".dropdowns dd ul li a").click(function () {
        var text = $(this).html();
        $(".dropdowns dt a span").html(text);
        $(".dropdowns dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdowns"))
            $(".dropdowns dd ul").hide();
    });

    $(".speed dt a").click(function () {
        $(".speed dd ul").toggle();
    });

    $(".speed dd ul li a").click(function () {
        var text = $(this).html();
        $(".speed dt a span").html(text);
        $(".speed dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("speed"))
            $(".speed dd ul").hide();
    });

    $(".level dt a").click(function () {
        $(".level dd ul").toggle();
    });

    $(".level dd ul li a").click(function () {
        var text = $(this).html();
        $(".level dt a span").html(text);
        $(".level dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("level"))
            $(".level dd ul").hide();
    });

    $(".modhrs dt a").click(function () {
        $(".modhrs dd ul").toggle();
    });

    $(".modhrs dd ul li a").click(function () {
        var text = $(this).html();
        $(".modhrs dt a span").html(text);
        $(".modhrs dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("modhrs"))
            $(".modhrs dd ul").hide();
    });

    $(".modmin dt a").click(function () {
        $(".modmin dd ul").toggle();
    });

    $(".modmin dd ul li a").click(function () {
        var text = $(this).html();
        $(".modmin dt a span").html(text);
        $(".modmin dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("modmin"))
            $(".modmin dd ul").hide();
    });


    $(".nationality dt a").click(function () {
        $(".nationality dd ul").toggle();
    });

    $(".nationality dd ul li a").click(function () {
        var text = $(this).html();
        $(".nationality dt a span").html(text);
        $(".nationality dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("nationality"))
            $(".nationality dd ul").hide();
    });

    $(".endhrs dt a").click(function () {
        $(".endhrs dd ul").toggle();
    });

    $(".endhrs dd ul li a").click(function () {
        var text = $(this).html();
        $(".endhrs dt a span").html(text);
        $(".endhrs dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("endhrs"))
            $(".endhrs dd ul").hide();
    });

    $(".endmin dt a").click(function () {
        $(".endmin dd ul").toggle();
    });

    $(".endmin dd ul li a").click(function () {
        var text = $(this).html();
        $(".endmin dt a span").html(text);
        $(".endmin dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("endmin"))
            $(".endmin dd ul").hide();
    });


    $(".flrules dt a").click(function () {
        $(".flrules dd ul").toggle();
    });

    $(".flrules dd ul li a").click(function () {
        var text = $(this).html();
        $(".flrules dt a span").html(text);
        $(".flrules dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("flrules"))
            $(".flrules dd ul").hide();
    });



    $(".fltypes dt a").click(function () {
        $(".fltypes dd ul").toggle();
    });

    $(".fltypes dd ul li a").click(function () {
        var text = $(this).html();
        $(".fltypes dt a span").html(text);
        $(".fltypes dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("fltypes"))
            $(".fltypes dd ul").hide();
    });


    $(".wtcat dt a").click(function () {
        $(".wtcat dd ul").toggle();
    });

    $(".wtcat dd ul li a").click(function () {
        var text = $(this).html();
        $(".wtcat dt a span").html(text);
        $(".wtcat dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("wtcat"))
            $(".wtcat dd ul").hide();
    });


    $(".transmode dt a").click(function () {
        $(".transmode dd ul").toggle();
    });

    $(".transmode dd ul li a").click(function () {
        var text = $(this).html();
        $(".transmode dt a span").html(text);
        $(".transmode dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("transmode"))
            $(".transmode dd ul").hide();
    });

    $(".tt-hrs dt a").click(function () {
        $(".tt-hrs dd ul").toggle();
    });

    $(".tt-hrs dd ul li a").click(function () {
        var text = $(this).html();
        $(".tt-hrs dt a span").html(text);
        $(".tt-hrs dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("tt-hrs"))
            $(".tt-hrs dd ul").hide();
    });

    $(".tt-mins dt a").click(function () {
        $(".tt-mins dd ul").toggle();
    });

    $(".tt-mins dd ul li a").click(function () {
        var text = $(this).html();
        $(".tt-mins dt a span").html(text);
        $(".tt-mins dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("crfacility"))
            $(".crfacility dd ul").hide();
    });

    $(".crfacility dt a").click(function () {
        $(".crfacility dd ul").toggle();
    });

    $(".crfacility dd ul li a").click(function () {
        var text = $(this).html();
        $(".crfacility dt a span").html(text);
        $(".crfacility dd ul").hide();

    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("crfacility"))
            $(".crfacility dd ul").hide();
    });





});									