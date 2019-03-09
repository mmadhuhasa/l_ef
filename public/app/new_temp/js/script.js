
function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}
;

/* cookie.JS
 ========================================================*/
include(base_url + '/app/new_temp/js/jquery.cookie.js');

/* Easing library
 ========================================================*/
include(base_url + '/app/new_temp/js/jquery.easing.1.3.js');

/* PointerEvents
 ========================================================*/
;
(function ($) {
    if (isIE() && isIE() < 11) {
        include(base_url + '/app/new_temp/js/pointer-events.js');
        $('html').addClass('lt-ie11');
        $(document).ready(function () {
            PointerEventsPolyfill.initialize({});
        });
    }
})(jQuery);

/* Stick up menus
 ========================================================*/
;
(function ($) {
    var o = $('html');
    if (o.hasClass('desktop')) {
        include(base_url + '/app/new_temp/js/tmstickup.js');

        $(document).ready(function () {
            $('#stuck_container').TMStickUp({})
        });
    }
})(jQuery);

/* ToTop
 ========================================================*/
;
(function ($) {
    var o = $('html');
    if (o.hasClass('desktop')) {
        include(base_url + '/app/new_temp/js/jquery.ui.totop.js');

        $(document).ready(function () {
            $().UItoTop({
                easingType: 'easeOutQuart',
                containerClass: 'toTop fa fa-arrow-up'
            });
        });
    }
})(jQuery);

/* EqualHeights
 ========================================================*/
;
(function ($) {
    var o = $('[data-equal-group]');
    if (o.length > 0) {
        include(base_url + '/app/new_temp/js/jquery.equalheights.js');
    }
})(jQuery);

/* Copyright Year
 ========================================================*/
;
(function ($) {
    var currentYear = (new Date).getFullYear();
    $(document).ready(function () {
        $("#copyright-year").text((new Date).getFullYear());
    });
})(jQuery);


/* Superfish menus
 ========================================================*/
;
(function ($) {
    include(base_url + '/app/new_temp/js/superfish.js');
})(jQuery);

/* Navbar
 ========================================================*/
;
(function ($) {
    include(base_url + '/app/new_temp/js/jquery.rd-navbar.js');
})(jQuery);


/* Google Map
 ========================================================*/
;
(function ($) {
    var o = document.getElementById("google-map");
    if (o) {
        include('//maps.google.com/maps/api/js?sensor=false');
        include(base_url + '/app/new_temp/js/jquery.rd-google-map.js');

        $(document).ready(function () {
            var o = $('#google-map');
            if (o.length > 0) {
                o.googleMap();
            }
        });
    }
})
        (jQuery);

/* WOW
 ========================================================*/
;
(function ($) {
    var o = $('html');

    if ((navigator.userAgent.toLowerCase().indexOf('msie') == -1) || (isIE() && isIE() > 9)) {
        if (o.hasClass('desktop')) {
            include(base_url + '/app/new_temp/js/wow.js');

            $(document).ready(function () {
                new WOW().init();
            });
        }
    }
})(jQuery);

/* Mailform
 =============================================*/
;
(function ($) {
    include(base_url + '/app/new_temp/js/mailform/jquery.form.min.js');
    include(base_url + '/app/new_temp/js/mailform/jquery.rd-mailform.min.js');
})(jQuery);

/* Orientation tablet fix
 ========================================================*/
$(function () {
    // IPad/IPhone
    var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
            ua = navigator.userAgent,
            gestureStart = function () {
                viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0";
            },
            scaleFix = function () {
                if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
                    viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                    document.addEventListener("gesturestart", gestureStart, false);
                }
            };

    scaleFix();
    // Menu Android
    if (window.orientation != undefined) {
        var regM = /ipod|ipad|iphone/gi,
                result = ua.match(regM);
        if (!result) {
            $('.sf-menus li').each(function () {
                if ($(">ul", this)[0]) {
                    $(">a", this).toggle(
                            function () {
                                return false;
                            },
                            function () {
                                window.location.href = $(this).attr("href");
                            }
                    );
                }
            })
        }
    }
});
var ua = navigator.userAgent.toLocaleLowerCase(),
        regV = /ipod|ipad|iphone/gi,
        result = ua.match(regV),
        userScale = "";
if (!result) {
    userScale = ",user-scalable=0"
}
document.write('<meta name="viewport" content="width=device-width,initial-scale=1.0' + userScale + '">');

/* Camera
 ========================================================*/
;
(function ($) {
    var o = $('#camera');
    if (o.length > 0) {
        if (!(isIE() && (isIE() > 9))) {
            include(base_url + '/app/new_temp/js/jquery.mobile.customized.min.js');
        }

        include(base_url + '/app/new_temp/js/camera.js');

        $(document).ready(function () {
            o.camera({
                autoAdvance: true,
                height: '31.234749%',
                minHeight: '300px',
                pagination: true,
                thumbnails: false,
                playPause: false,
                hover: false,
                loader: 'none',
                navigation: false,
                navigationHover: false,
                mobileNavHover: false,
                fx: 'simpleFade'
            })
        });
    }
})(jQuery);

/* Search.js
 ========================================================*/
;
(function ($) {
    include(base_url + '/app/new_temp/js/TMSearch.js');
})(jQuery);


/* LogIn.js
 ========================================================*/
// ;
// (function ($) {
//     include(base_url+'/app/new_temp/js/TMLogIn.js');
// })(jQuery);

/* Parallax
 =============================================*/
;
(function ($) {
    include(base_url + '/app/new_temp/js/jquery.rd-parallax.js');
})(jQuery);



/* CountTo.js
 ========================================================*/

(function ($) {
    var o = $('.count');
    var cc = 1;

    if (o.length > 0) {
        include(base_url + '/app/new_temp/js/jquery.countTo.js');

        $(window).scroll(function () {
            var targetPos = o.offset().top;
            var winHeight = $(window).height();
            var scrollToElem = targetPos - winHeight;
            var winScrollTop = $(this).scrollTop();

            if (winScrollTop > scrollToElem) {
                if (targetPos > winScrollTop) {
                    if (cc < 2) {
                        cc = cc + 2;
                        $(document).ready(function () {
                            $(o).countTo();
                        });
                    }
                }
            }
        });
    }
})(jQuery);


/* Owl Carousel
 ========================================================*/
;
(function ($) {
    var o = $('.owl-carousel');
    if (o.length > 0) {
        include(base_url + '/app/new_temp/js/owl.carousel.min.js');
        $(document).ready(function () {
            o.owlCarousel({
                margin: 30,
                smartSpeed: 450,
                loop: true,
                dots: true,
                dotsEach: 1,
                nav: false,
                navClass: ['owl-prev fa fa-angle-left', 'owl-next fa fa-angle-right'],
                responsive: {
                    0: {items: 1},
                    768: {items: 1},
                    992: {items: 1}
                }
            });
        });
    }
})(jQuery);



function include(scriptUrl) {
    document.write('<script src="' + scriptUrl + '"></script>');
}



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

});