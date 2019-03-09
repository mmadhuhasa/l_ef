$(document).ready(function () {
    $('#quick_fpl').formValidation({
        err: {
            container: 'tooltip'
        },
//        trigger: 'blur',
        icon: {
            valid: 'glyphicon',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            callsign: {
                validators: {
                    stringLength: {
                        enabled: false,
                        min: 4,
                        message: 'The first name must be more than 5 characters'
                    },
                    notEmpty: {
                        message: 'The first name is required'
                    },
                    regexp: {
                        enabled: true,
                        regexp: /^[a-z]+$/i,
                        message: 'The first name must consist of a-z, A-Z characters only'
                    }
                }
            }

        }
    });

    //Make Airport upper case
    $(document).on('keyup', '.text_uppercase', function () {
        var reid = $(".text_uppercase").map(function () {
            this.value = this.value.toUpperCase();
        })
                .get().join();
    })

});