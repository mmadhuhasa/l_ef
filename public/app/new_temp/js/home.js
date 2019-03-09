

$(function () {

    var $c = $('#carousel'),
            $w = $(window);

    $c.carouFredSel({
        align: false,
        items: 10,
        wrap: false,
        scroll: {
            items: 1,
            duration: 2000,
            timeoutDuration: 0,
            easing: 'linear',
            pauseOnHover: 'immediate'

        }
    });

    $(window).load(function () {
        var n = 1;
        $('.flexslider').flexslider({
            animationLoop: true,
            start: function (slider) {
                $('body').removeClass('loading');
            },
            after: function (slider) {
                if (slider.currentSlide == 0) { // is last slide
                    n--;
                    if (n == 0) {
                        slider.pause();
                    }
                }
            }

        });

        $('.slides').removeClass('hidden');
        $("#loader_img").addClass('hidden');
    });

    $.scrollUp();
});




