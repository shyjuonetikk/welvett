$(document).ready(function () {
    $('input[name=first_name]').blur(function () {
        if ($('input[name=first_name]').val()) {
            if ($(this).val().match('^[a-zA-Z]{3,16}$')) {
                $('label[for=first_name] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {
                $('label[for=first_name] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            }
        } else {
            $('input[name=first_name]').focus();
            $('label[for=first_name] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });

    $('input[name=last_name]').blur(function () {
        if ($('input[name=last_name]').val()) {
            if ($(this).val().match('^[a-zA-Z]{3,16}$')) {
                $('label[for=last_name] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');

            } else {

                $('label[for=last_name] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            }
        } else {
            $('input[name=last_name]').focus();
            $('label[for=last_name] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });
    $('input[name=email]').blur(function () {
        if ($('input[name=email]').val()) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (regex.test($('input[name=email]').val())) {
                $('label[for=email] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {

                $('label[for=email] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            }
        } else {
            $('input[name=email]').focus();
            $('label[for=email] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });

    $('input[name=phone1]').blur(function () {
        if ($('input[name=phone1]').val()) {
            //code for further validation
            $('label[for=phone1] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');

        } else {
            $('input[name=phone1]').focus();
            $('label[for=phone1] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });

    $('input[name=password]').blur(function () {
        if ($(this).val()) {
            if ($(this).val().length < 6) {
                $('label[for=password] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                if ($(this).siblings('small').length > 0) {
                    $(this).siblings('small').text('At least 6 characters');
                } else {
                    $('<small style="color:red">At least 6 characters</small>').insertAfter($(this));
                }
            } else {
                $(this).siblings('small').text('');
                $('label[for=password] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            }
        } else {
            $('label[for=password] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });
    $('input[name=confirm_password]').blur(function () {
        if ($(this).val()) {
            if ($('input[name="password"]').val() != $(this).val()) {
                if ($(this).siblings('small').length > 0) {
                    $(this).siblings('small').text('Confirm Password does not match');
                } else {
                    $('<small style="color:red">Confirm Password does not match</small>').insertAfter($(this));
                }
                $('label[for=confirm_password] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');

            } else {
                $(this).siblings('small').text('');
                $('label[for=confirm_password] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            }
        } else {
            $('label[for=confirm_password] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });

    $('#member_form').submit(function () {
        if ($('input[name=first_name]').val()) {
            if ($('input[name=first_name]').val().match('^[a-zA-Z]{3,16}$')) {
                $('label[for=first_name] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');

            } else {
                $('input[name=first_name]').focus();
                $('label[for=first_name] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                return false;
            }
        } else {
            $('input[name=first_name]').focus();
            return false;
        }

        if ($('input[name=last_name]').val()) {
            if ($('input[name=last_name]').val().match('^[a-zA-Z]{3,16}$')) {
                $('label[for=last_name] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {
                $('input[name=last_name]').focus();
                return false;
            }
        } else {
            $('input[name=last_name]').focus();
            return false;
        }
        if ($('input[name=email]').val()) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (regex.test($('input[name=email]').val())) {
                $('label[for=email] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {
                $('input[name=email]').focus();
                return false;
            }
        } else {
            $('input[name=email]').focus();
            return false;
        }
        if ($('input[name=phone1]').val()) {
            //code for further validation
        } else {
            $('input[name=phone1]').focus();
            return false;
        }
        if ($('input[name=password]').val()) {
            if ($('input[name=password]').val().length < 6) {
                $('label[for=password] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                if ($('input[name=password]').siblings('small').length > 0) {
                    $('input[name=password]').siblings('small').text('At least 6 characters');
                } else {
                    $('<small style="color:red">At least 6 characters</small>').insertAfter($('input[name=password]'));
                }
                return false;
            } else {
                $('input[name=password]').siblings('small').text('');
                $('label[for=password] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            }
        } else {
            $('input[name=password]').focus();
            $('label[for=password] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            return false;
        }


        if ($('input[name=confirm_password]').val()) {
            if ($('input[name="password"]').val() != $('input[name=confirm_password]').val()) {
                if ($('input[name=confirm_password]').siblings('small').length > 0) {
                    $('input[name=confirm_password]').siblings('small').text('Confirm Password does not match');
                } else {
                    $('<small style="color:red">Confirm Password does not match</small>').insertAfter($('input[name=confirm_password]'));
                }
                $('label[for=confirm_password] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                return false;
            } else {
                $('input[name=confirm_password]').siblings('small').text('');
                $('label[for=confirm_password] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            }
        } else {
            $('input[name=confirm_password]').focus();
            $('label[for=confirm_password] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            return false;
        }
    });

});