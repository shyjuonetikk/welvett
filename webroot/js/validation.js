function check_address() {
    var success = 0;
    var field = '';
    var name = '';
    if ($('select[name=state]').length) {
        if ($('select[name=state]').val()) {
            success = 1;
        } else {
            success = 0;
            field = 'select';
            name = 'state';
            return [success, field, name];
        }
    }

    if ($('input[name=city]').length) {
        if ($('input[name=city]').val()) {
            success = 1;
        } else {
            success = 0;
            field = 'input';
            name = 'city';
            return [success, field, name];
        }
    }
    if ($('input[name=address]').length) {
        if ($('input[name=address]').val()) {
            success = 1;
        } else {
            success = 0;
            field = 'input';
            name = 'address';
            return [success, field, name];
        }
    }
    if ($('input[name=zipcode]').length) {
        if ($('input[name=zipcode]').val()) {
            //             alert($('input[name=zipcode]').val().length);
            if ($('input[name=zipcode]').val().length > 5) {
                success = 0;
                field = 'input';
                name = 'zipcode';
                return [success, field, name];
            } else {
                success = 1;
            }
        } else {
            success = 0;
            field = 'input';
            name = 'zipcode';
            return [success, field, name];
        }
    }
    if (success == 0) {
        $('label[for=address] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');

    } else {
        $('label[for=address] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
    }
    return [success, field, name];
}
$(document).ready(function () {

    var phone_pat = /^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/;
    var email_pat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

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
    $('input[name=job_title]').blur(function () {
        if ($('input[name=job_title]').val()) {
            $('label[for=job_title] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
        } else {
            $('input[name=job_title]').focus();
            $('label[for=job_title] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });
    $('input[name=company_name]').blur(function () {

        if ($('input[name=company_name]').val()) {
            $('label[for=company_name] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
        } else {
            $('input[name=company_name]').focus();
            $('label[for=company_name] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });

    $('input[name=company_address]').blur(function () {
        if ($('input[name=company_address]').val()) {
            $('label[for=company_address] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
        } else {
            $('input[name=company_address]').focus();
            $('label[for=company_address] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
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

    $('input[name=phone]').blur(function () {

        var phone = $("#phone").val();

        if ($('input[name=phone]').val()) {
            //code for further validation
            if (!phone_pat.test(phone)){

                $('input[name=phone]').focus();
                $('label[for=phone] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            } else{

                $('label[for=phone] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            }

        } else {
            $('input[name=phone]').focus();
            $('label[for=phone] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });

    $('select[name=eventcategory_id]').change(function () {

        if ($('select[name=eventcategory_id]').val()) {
            $('label[for=category] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
        } else {
            $('label[for=category] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });

    $('textarea[name=job]').blur(function () {
        if ($(this).val()) {
            $('label[for=job] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
        } else {
            $('label[for=job] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
        }
    });


    $('#terms_conditions').blur(function () {

        if($(this).val() !== ''){
            if($(this).val() === 'y' || $(this).val() === 'Y'){
                $('label[for=terms_conditions] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
                $('#register').attr('disabled', false);
            } else{
                $('label[for=terms_conditions] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                $('#register').attr('disabled', true);
                $(this).focus();
            }
        } else{
            $('label[for=terms_conditions] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            $('#register').attr('disabled', true);
            $(this).focus();
        }

    });


    $("#auth_phone").blur(function () {

        if(!phone_pat.test($(this).val())){
            $('label[for=terms_conditions] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            alert('Invalid auth phone format');
            $('input[name=auth_phone]').focus();
            $('#register').attr('disabled', true);
        } else{
            $('label[for=terms_conditions] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            $('#register').attr('disabled', false);
        }


    });

    $("#auth_email").blur(function () {

        if(!email_pat.test($(this).val())){

            alert('Invalid email format');
            $('input[name=auth_email]').focus();
            $('#register').attr('disabled', true);
        } else{

            $('#register').attr('disabled', false);
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
        var phone = $("#phone").val();

        var termsConditions = $('#terms_conditions').val();
        if(termsConditions !== ''){
            if(termsConditions === 'y' || termsConditions === 'Y'){
                $('label[for=terms_conditions] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
                $('#register').attr('disabled', false);
            } else{
                $('label[for=terms_conditions] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                $('#register').attr('disabled', true);
                $(this).focus();
                return false;
            }
        } else{
            $('#register').attr('disabled', true);
            $(this).focus();
            return false;
        }

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

        // validation of corporate Members fields
        if ($('input[name=job_title]').length) {
            if ($('input[name=job_title]').val()) {
                $('label[for=job_title] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {
                $('input[name=job_title]').focus();
                $('label[for=job_title] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                return false;
            }
        }
        if ($('input[name=company_name]').length) {
            if ($('input[name=company_name]').val()) {
                $('label[for=company_name] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {

                $('input[name=company_name]').focus();
                $('label[for=company_name] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                return false;
            }
        }
        if ($('input[name=googleid]').length) {
            if ($('input[name=googleid]').val()) {
                $('label[for=gSignIn] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {

                $('#gSignIn').focus();
                $('label[for=gSignIn] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                show_custom_message('Please link any of your social account.');
                return false;
            }
        }
        if ($('input[name=company_address]').length) {
            if ($('input[name=company_address]').val()) {
                $('label[for=company_address] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {
                $('input[name=company_address]').focus();
                $('label[for=company_address] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                return false;
            }
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

        if (phone === '' || !phone_pat.test(phone)){
            alert('Invalid phone format');
            $('input[name=phone]').focus();
            $('label[for=phone] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            return false;
        } else {
            $('label[for=phone] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
        }

        if ($('select[name=eventcategory_id]').length) {
            if ($('select[name=eventcategory_id]').val()) {
                $('label[for=category] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {
                $('select[name=eventcategory_id]').focus();
                return false;
            }
        }
        var address = check_address();

        if (address[0] == 0) {
            $(address[1] + '[name=' + address[2] + ']').focus();
            return false;
        }
        if ($('textarea[name=job]').length) {
            if ($('textarea[name=job]').val()) {

                $('label[for=job] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
            } else {
                $('textarea[name=job]').focus();
                return false;
            }
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

    //    $('input[name="authorise_company"]').change(function () {
    //        var isAuthorized = $(this).val();
    //
    //        if (isAuthorized === '1') {
    //            $('#auth_phone').attr('readonly', 'readonly');
    //            $('#auth_email').removeAttr('readonly', 'readonly');
    //            $('#auth_phone').val('');
    //        } else if (isAuthorized === '0') {
    //            $('#auth_email').attr('readonly', 'readonly');
    //            $('#auth_phone').removeAttr('readonly', 'readonly');
    //            $('#auth_email').val('');
    //        }
    //    });
});