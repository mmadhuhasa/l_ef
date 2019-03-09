
$(document).ready(function () {
    $('.numeric').on('keypress', function (e) {
//        var regex = new RegExp("^[0-9]+$");
//        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
//        if (regex.test(str)) {
//            return true;
//        }
//        e.preventDefault();
//        return false;

    if ((e.charCode != 45)
            && (e.charCode < 48 || e.charCode > 57)
            && (e.charCode != 0))
            return false;

    });

    //contact page validation
//    $('#mobile_number,[name="mobile_number"]').on('keyup', function () {
//        var mobile_number = $(this).val();
//        if (mobile_number.length < 10 || mobile_number == '' || !mobile_number) {
//            $("#mobile_number").css("border", "red solid 1px");
//            $("#mobile_number").css("border", "red solid 1px");
//        } else {
//            $("#mobile_number").css("border", "lightgrey solid 1px");
//            $("[name=mobile_number]").css("border-color", "lightgrey");
//        }
//    });
//
//    $("[name='name']").on('keyup', function () {
//        var name = $('[name=name]').val();
//        if (name.length < 1 || name == '' || !name) {
//            $("[name='name']").css("border-color", "red");
//        } else {
//            $("[name='name']").css("border-color", "lightgrey");
//        }
//    });
//
//    $("[name='email']").on('keyup', function () {
//        var name = $('[name=email]').val();
//        if (name.length < 1 || name == '' || !name) {
//            $("[name='email']").css("border-color", "red");
//        } else {
//            $("[name='email']").css("border-color", "lightgrey");
//        }
//    });
//
//    $("[name='message']").on('keyup', function () {
//        var name = $('[name=message]').val();
//        if (name.length < 1 || name == '' || !name) {
//            $("[name='message']").css("border-color", "red");
//        } else {
//            $("[name='message']").css("border-color", "lightgrey");
//        }
//    });
 $("#c_mobile_number").on('keyup', function () {
        var mobile_number = $(this).val();
        if (mobile_number.length < 10 || mobile_number == '' || !mobile_number) {
            $("#c_mobile_number").css("border-color", "#f1292b");
//            $("#[name=c_mobile_number]").css("border", "red solid 1px");
        } else {
//            $("#mobile_number").css("border", "lightgrey solid 1px");
            $("#c_mobile_number").css("border-color", "lightgrey");
        }
    });

    $("#c_name").on('keyup', function () {
        var name = $(this).val();
        if (name.length < 1 || name == '' || !name) {
            $("#c_name").css("border-color", "#f1292b");
        } else {
            $("#c_name").css("border-color", "lightgrey");
        }
    });

    $("#c_email").on('keyup', function () {
        var name = $(this).val();
        if (name.length < 1 || name == '' || !name) {
            $("#c_email").css("border-color", "#f1292b");
        } else {
            $("#c_email").css("border-color", "lightgrey");
        }
    });

    $("#c_message").on('keyup', function () {
        var name = $(this).val();
        if (name.length < 1 || name == '' || !name) {
            $("#c_message").css("border-color", "#f1292b");
        } else {
            $("#c_message").css("border-color", "lightgrey");
        }
    });
    //contact page validation

    $('#password').on('keyup', function () {
        var password = $('#password').val();
        if (password.length < 1 || password == '') {
            $("#password").css("border", "red solid 1px");
        } else {
            $("#password").css("border", "lightgrey solid 1px");
        }
    });

    $('#forgot').hide();
    $('#change').hide();

    $('.a-forgot').on('click', function () {
        showForgot();
    });
    $('.a-login').on('click', function () {
        showLogin();
    });
    $('.a-change').on('click', function () {
        showChange();
    });
    function showForgot() {
        $('#forgot').show();
        $('#signin').hide();
        $('#change').hide();
    }
    function showLogin() {
        $('#signin').show();
        $('#forgot').hide();
        $('#change').hide();
    }
    function showChange() {
        $('#change').show();
        $('#signin').hide();
        $('#forgot').hide();
    }

    $(".rd-with-ul").click(function () {
        $(".rd-mobilemenu_submenu").slideToggle("slow", function () {
            // Animation complete.
        });
    });
})
function checklogin() {
    var data_url = $('form[id="login_form"]').attr('data-url');
    var data = $('form[id="login_form"]').serialize();
    
    $(".login_but").css('border','none')

    var mobile_number = $("#mobile_number").val();
    var password = $("#password").val();
    var validation = true;

    if (mobile_number == '') {
        $("#mobile_number").css('border', 'red solid 1px');
        validation = false;
    }
    if (password == '') {
        $("#password").css('border', 'red solid 1px');
        validation = false;
    }
    if (!validation) {
        return false;
    }

    $("#login_error").html("<span><a href=''><i class='fa fa-spinner fa-spin'></i></a> Please wait ...</span>")

    $.ajax({
        url: data_url,
        type: 'POST',
        data: data,
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
        success: function (data, textStatus, jqXHR) {
            if (data.error == 1) {
                $("#login_error").html('<span style="color: #f1292b;">Invalid Credentials.Please enter correct details</span>')
                return false;
            } else {
                window.location = "fpl";
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown)
            return false;
        }

    })
    return false;
}
function ForgotPassword() {
    var data_url = $('form[id="forgot_password_form"]').attr('data-url');
    var data = $('form[id="forgot_password_form"]').serialize();
    var mobile_number = $("#mobile_number2").val();
    var email = $("#email2").val();
    data = {'mobile_number': mobile_number, 'email': email,'url':base_url};

    if (mobile_number == '' && email == '') {
        $("#email2").css('border', 'red solid 1px');
        return false;
    } else {
        $("#email2").css('border', 'lightgrey solid 1px');
    }
    $(".email_checker").html('');
    $(".mobile_checker").html('');
    $("#success_message_forgot").html('<span><a href="#"><i class="fa fa-spinner fa-spin"></i> Processing please wait ...</a></span>')


    $.ajax({
        url: data_url,
        type: 'POST',
        data: data,
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
        success: function (data, textStatus, jqXHR) {
            if (data.error == 1) {
                $("#error_message_forgot").html('<span style="color: #f1292b;">' + data.error_message + '</span>')
                $("#success_message_forgot").html('')
                return false;
            } else {
                $("#success_message_forgot").html('<span style="color: green;">' + data.success_message + '</span>')
                $("#error_message_forgot").html('')
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown)
            return false;
        }

    })
    return false;
}
function ChangePassword() {
    var data_url = $('form[id="change_password_form"]').attr('data-url');
    var data = $('form[id="change_password_form"]').serialize();
    var data_base_url = $('form[id="change_password_form"]').attr('data-base-url');
    var email = $("#email").val();
    $("#success_message_change").html('<span><a href="#"><i class="fa fa-spinner fa-spin"></i> Processing please wait ...</a></span>')
    $.ajax({
        url: data_url,
        type: 'POST',
        data: data,
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
        success: function (data, textStatus, jqXHR) {
            console.log(data.STATUS_CODE + ' ' + data.STATUS_DESC)
            if (data.STATUS_CODE == 0) {
                $("#error_message_change").html('<span style="color: #f1292b;">' + data.STATUS_DESC + '</span>');
                $("#success_message_change").html('');
                return false;
            } else {
                $("#success_message_change").html('<span style="color: green;">' + data.STATUS_DESC + '</span>');
                $("#error_message_change").html('');
                console.log(data_base_url)
                window.location = data_base_url + "/fpl";
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $("#error_message").html('<span style="color: #f1292b;">' + data.error_message + '</span>');
            console.log(errorThrown)
            return false;
        }

    })
    return false;
}
function ResetPassword() {
    var data_url = $('form[id="reset_password_form"]').attr('data-url');
    var data = $('form[id="reset_password_form"]').serialize();
    var data_base_url = $('form[id="reset_password_form"]').attr('data-base-url');
    $.ajax({
        url: data_url,
        type: 'POST',
        data: data,
        cache: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
        success: function (data, textStatus, jqXHR) {
            if (data.STATUS_CODE == 0) {
                $("#error_message").html('<span style="color: #f1292b;">' + data.error_message + '</span>');
                $("#success_message").html('');
                return false;
            } else {
                $("#success_message").html('<span style="color: green;">' + data.success_message + '</span>');
                $("#error_message").html('');
                window.location = data_base_url 
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown)
            return false;
        }

    })
    return false;
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$(document).on('keyup change', ".user_valid", function () {
    var mobile_number = $(this).val();
    var id = $(this).attr('id');
    var data_url = $(this).attr('data-url');
    var data = {'mobile_number': mobile_number};
    $("#email2").css('border', 'lightgrey solid 1px');
    if (mobile_number != '' && mobile_number.length < 10) {
        $("#" + id).css('border', 'red solid 1px');
    } else {
        $("#" + id).css('border', 'lightgrey solid 1px');
    }
    if (mobile_number.length >= 1) {
        if (id == "mobile_number2") {
            $(".mobile_checker").html('<i class="fa fa-spinner fa-spin"></i> Checking ...');
        } else {
            $(".login_mobile_checker").html('<i class="fa fa-spinner fa-spin"></i> Checking ...');
        }
    } else {
        $(".mobile_checker").html('');
        $(".login_mobile_checker").html('');
    }
    $(".email_checker").html('');
    if (mobile_number.length == 10) {
        $.ajax({
            url: data_url,
            data: data,
            type: 'get',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                if (data.success == 1) {
                    $(".mobile_checker").html('');
                    $(".login_mobile_checker").html('');
                } else {
                    if (id == "mobile_number2") {
                        $(".mobile_checker").html('<span style="color:#f1292b">User does not exist</span>');
                    } else {
                        $(".login_mobile_checker").html('<span style="color:#f1292b">User does not exist</span>');
                    }
                    return false;
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        })
    }

});

$(document).on('keyup change', "#email2", function () {
    var email = $("#email2").val();
    var data_url = $(this).attr('data-url');
    var data = {'email': email};
    $("#mobile_number2").css('border', 'lightgrey solid 1px');
    $("#email2").css('border', 'lightgrey solid 1px');
    $(".mobile_checker").html('');
    if (isEmail(email)) {
        $(".forgot_email_checker").html('');
        $.ajax({
            url: data_url,
            data: data,
            type: 'get',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                if (data.success == 1) {
                    $(".forgot_email_checker").html('');
                } else {
                    $(".forgot_email_checker").html('<span style="color:#f1292b">User does not exist</span>');
                    return false;
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    } else if (email.length >= 1) {
        console.log('kkkk')
        $(".forgot_email_checker").html('<i class="fa fa-spinner"></i> Checking ...');
    } else {
        $(".forgot_email_checker").html('');
    }

});

$(document).on('keyup change', ".email_validation", function () {
    var email = $("#email").val();
    var data_url = $(this).attr('data-url');
    var data = {'email': email};
    $("#email").css('border', 'lightgrey solid 1px');
    if (isEmail(email)) {
        $(".change_email_checker").html('');
        $.ajax({
            url: data_url,
            data: data,
            type: 'get',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                if (data) {
                    $(".change_email_checker").html('');
                } else {
                    $(".change_email_checker").html('<span style="color:#f1292b">User does not exist</span>');
                    return false;
                }

            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    } else if (email.length >= 1) {
        $(".change_email_checker").html('<i class="fa fa-spinner"></i> Checking ...');
    } else {
        $(".change_email_checker").html('');
    }

})



	