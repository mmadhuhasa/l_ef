jQuery(document).ready(function () {
    jQuery('.tabs.animated-slide-2 li a').on('click', function (e) {
        var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).slideDown(400).siblings().slideUp(400);

        // Change/remove current tab to active

        jQuery('.tabs.animated-slide-2 li a').removeClass('active');
        jQuery(this).addClass('active');

        e.preventDefault();
    });
    jQuery(".arrow").on('click', function () {
        var id = $(this).attr('id');

        switch (id) {
            case 'navlog':
                $(".tabs-downarrow").css('left', '0%').show(1000);
                break;
            case 'trim':
                $(".tabs-downarrow").css('left', '17%').show(1000);
                break;
            case 'notams':
                $(".tabs-downarrow").css('left', '34%').show(1000);
                break;
            case 'weather':
                $(".tabs-downarrow").css('left', '51%').show(1000);
                break;
            case 'fdtl':
                $(".tabs-downarrow").css('left', '67%').show(1000);
                break;
            case 'airport':
                $(".tabs-downarrow").css('left', '84%').show(1000);
                break;
        }
    });
    var placeholder = 'Flight\nDate';
    $('.from_date').attr('value', placeholder);

    $('.from_date').focus(function () {
        if ($(this).val() === placeholder) {
            $(this).attr('value', '');
        }
    });

    $('.from_date').blur(function () {
        if ($(this).val() === '') {
            $(this).attr('value', placeholder);
        }
    });

    var placeholder = 'Time \n (UTC)';
    $('.clock').attr('value', placeholder);
//
//    $('.clock').focus(function () {
//        if ($(this).val() === placeholder) {
//            $(this).attr('value', '');
//        }
//    });
//
//    $('.clock').blur(function () {
//        if ($(this).val() === '') {
//            $(this).attr('value', placeholder);
//        }
//    });
});