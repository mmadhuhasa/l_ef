$(document).ready(function () {
    function custom_typeahead() {
        $('input#auto_complete').each(function () {
            var $this = $(this);
            $this.typeahead({
                source: function (query, process) {
                    $.ajax({
                        url: $this.attr('data-url') + '/' + 'id',
                        type: 'get',
                        dataType: 'JSON',
                        data: {flag: 'emails', 'email': query},
                        success: function (data) {
                            var emails = [];
                            map = {};
                            $.each(data.result, function (i, email) {
                                map[email.companyEmail] = email;
                                emails.push(email.companyEmail);
                            });
                            process(emails);
                        },
                        error: function (data) {
                            console.log('fail-' + query);
                        },
                    });
                },
                updater: function (item) {
//                console.log(item);
                    var result = getAutoCompleteData($this.attr('data-url') + '/' + 'id', item);
                    var json = JSON.parse(result);
                    $('span.help-block').remove();
                    return item;
                },
                highlighter: function (data) {
                    $("body").tooltip({selector: '[data-toggle=tooltip]'});
                    $this.parent().addClass('tooltip-wide');
                }
            });
        });
    }

//get getAutoCompleteData details
    function getAutoCompleteData(url, email) {
        var result = null;
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'html',
            async: false,
            data: {'flag': 'all', 'email': email},
            success: function (data) {
                result = data;
            },
            error: function (data) {
                console.log(data);
            }
        });
        return result;
    }

    if ($('#auto_complete').length > 0) {
        console.log('Hi')
        custom_typeahead();
    }
})