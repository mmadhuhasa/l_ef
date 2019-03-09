


function setClock() {

    var currentTime = new Date();
    var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var month = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    var timeString = ("0" + currentTime.getUTCHours()).slice(-2);
    timeString = timeString + ":";
    timeString = timeString + ("0" + currentTime.getUTCMinutes()).slice(-2);
    timeString = timeString + ":";
    timeString = timeString + ("0" + currentTime.getUTCSeconds()).slice(-2);
    timeString = timeString + " UTC " + "&nbsp;&nbsp;";
    timeString = timeString + "<span style='text-align:right'>" + week[currentTime.getUTCDay()];
    timeString = timeString + ", ";
    var dd = currentTime.getUTCDate();

    if (dd < 10) {

        dd = '0' + dd;
    }

    timeString = timeString + dd;

    timeString = timeString + " ";
    timeString = timeString + month[currentTime.getUTCMonth()] + "</span>";
    $("#timeTM").html(timeString);
}
$(document).ready(function () {
    window.setInterval(setClock, 1000);
    var str = location.href.toLowerCase();

    $('.navigation li a').each(function () {
        if (str.indexOf(this.href.toLowerCase()) > -1) {
            $("li.highlight").removeClass("highlight");
            $(this).parent().addClass("highlight");
        }
    });
});
