<?php


use Cake\Datasource\ConnectionManager;


?>

<script>
    // initialize and setup facebook js sdk
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '321635131817657',
            xfbml      : true,
            version    : 'v2.5'
        });

        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                document.getElementById('status').innerHTML = 'We are connected.';
                document.getElementById('login').style.visibility = 'hidden';
            } else if (response.status === 'not_authorized') {
                document.getElementById('status').innerHTML = 'We are not logged in.'
            } else {
                document.getElementById('status').innerHTML = 'You are not logged into Facebook.';
            }
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // login with facebook with extra permissions
    function login() {
        FB.login(function(response) {
            if (response.status === 'connected') {

                document.getElementById('status').innerHTML = 'We are connected.';
                document.getElementById('login').style.visibility = 'hidden';
            } else if (response.status === 'not_authorized') {
                document.getElementById('status').innerHTML = 'We are not logged in.'
            } else {
                document.getElementById('status').innerHTML = 'You are not logged into Facebook.';
            }
        }, {scope: 'email'});

        FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id'}, function(response) {
            //window.location='/talents/talents/users/customerLogin?userid='+response.id;
            //alert(response.id);
            //document.getElementById('status').innerHTML = response.id;
        });
        FB.api('/me', {fields: 'name,email,first_name,last_name'}, function(response) {
            var img_link = "http://graph.facebook.com/"+response.id+"/picture";
            window.location='/Welvett/pages/registerindividual?userid='+response.id+'&firstname='+ response.first_name + '&lastname=' + response.last_name + '&email=' + response.email+ '&photo='+img_link;
            //alert("Name: "+ response.name + "\nFirst name: "+ response.first_name + "ID: "+response.id+ response.email + response.last_name);

            //alert(img_link);

        });
    }

    // getting basic user info
    function getInfo() {
        FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id'}, function(response) {
            $("#googleid").val(response.id);
            //document.getElementById('status').innerHTML = response.id;
        });
    }
</script>  


<header>
    <div class="container-fluid top-member-area colored-maroon">
        <div class="row">
            <?php echo $this->element('inc/menu'); ?> 

            <div class="col-md-6">
                <div class="right-header-section colored-light-grey">
                    <h2 class="text-center form-heading">Registration</h2>  
                    <small class="centered">Already have an account? <a href="<?php echo $this->request->webroot . 'login' ?>">Login</a></small>      
                    <div class="reg-form-wrapper">
                        <?php echo $this->Form->create('User', array('type' => 'file', 'class' => 'form-horizontal', 'id' => 'UserAddForm', 'enctype' => 'multipart/form-data')); ?>

                        <div class="social-login">
                            <?php echo $this->Form->button('<span><i class="fa fa-facebook-square pull-left" style="font-size:20px;"></i> Join via Facebook</span>', ['type' => 'button', 'value' => ' Register ','id='=>'login', 'class' => 'btn facebook-btn social-btn','onclick'=>'login();']);?>

                            
                        </div>
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="first_name">First name 
                                    <i class="fa pull-right"></i>
                                </label>
                                <?php echo $this->Form->control('first_name', array('div' => false, 'label' => false, 'id' => 'first_name', 'class' => 'form-control text-capitalize', 'required' => 'required')); ?>

                            </div> <!-- form-group end.// -->
                            <div class="col form-group">
                                <label for="last_name">Last name 
                                    <i class="fa pull-right"></i>
                                </label>
                                <?php echo $this->Form->control('last_name', array('div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'id' => 'last_name', 'required' => 'required')); ?>
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row end.// -->
                        <!--                              <div class="form-group">
<label>User Name
<i class="fa fa-smile-o field_ok pull-right"></i>
<i class="fa fa-frown-o field_error pull-right"></i>
</label>
<input type="text" class="form-control" name="user_name" required="required">
</div>  form-group end.// -->
                        <div class="form-group">
                            <label for="email">Email address
                                <i class="fa pull-right"></i>
                            </label>
                            <?php echo $this->Form->control('email', array('type' => 'email', 'div' => false, 'label' => false, 'class' => 'form-control', 'required' => 'required', 'id' => 'email')); ?>
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label for="phone">Phone<span class="required">*</span>  
                                <i class="fa pull-right"></i>
                            </label>
                            <?php echo $this->Form->control('phone1', array('label' => false, 'class' => 'form-control', 'required' => 'required', 'id' => 'phone', 'type' => 'tel')); ?>

                        </div> <!-- form-group end.// -->

                        <div class="form-group">
                            <label for="password">Password 
                                <i class="fa pull-right"></i>
                            </label>
                            <?php echo $this->Form->control('password', array('type' => 'password', 'div' => false, 'label' => false, 'class' => 'form-control', 'required' => 'required', 'id'=>'password')); ?>
                        </div> <!-- form-group end.// -->  
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password
                                <i class="fa pull-right"></i>
                            </label>
                            <input id="confirm_password" name="confirm_password" class="form-control" type="password">
                        </div> <!-- form-group end.// --> 
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    <br>

                                    <small class="centered">Please enter "Y" if you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.</small> 
                                </div>
                                <div class="col-sm-4">
                                    <label for="terms_conditions">
                                        <i class="fa pull-right"></i>
                                    </label>
                                    <input type="text" id="terms_conditions"> 
                                </div>
                            </div>

                        </div> 
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary btn-block maroon-btn" id="register"> Register  </button>
                        </div> <!-- form-group// -->      

                        </form>
                </div>
            </div>
        </div>
    </div>	
    </div>
</header>
<!-- ######## END OF HEADER ############### -->   
<script src="<?php echo $this->request->webroot ?>assets/js/intlTelInput.js"></script>
<script>

   
$(document).ready(function(){    

var input = document.querySelector("#phone");
    
var iti = window.intlTelInput(input, {
        initialCountry: "us",
        onlyCountries: ['us','az'],
  utilsScript: "<?php echo $this->request->webroot ?>assets/js/utils.js"
});
input.addEventListener("countrychange", function() {
    // do something with iti.getSelectedCountryData()
    $(input).val('');
    $(input).attr('value','');
    });
input.addEventListener('blur', function() {
    
    if(input.value.length > 0) {
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      // enable submit button
      var countrycode = iti.getSelectedCountryData()['dialCode'];
      var phoneno = $(input).val().replace("+"+countrycode+ " ", "");
      
      $(input).val("+"+countrycode+ " "+phoneno);
      $("#register").removeAttr('disabled','disabled');
      $('label[for=phone] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');

    } else {
      $(input).focus();
      $("#register").attr('disabled','disabled');
      alert('Invalid phone format');
      $('input[name=phone1]').focus();
      $('label[for=phone] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
    }
  }
  } else {
   $("#register").removeAttr('disabled','disabled'); 
    $('label[for=phone] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
  }
});
});
</script>

<script src="<?php echo $this->request->webroot ?>bower_components/jquery/dist/jquery.min.js"></script> 
<script src="<?php echo $this->request->webroot ?>bower_components/jquery-ui/jquery-ui.min.js"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo $this->request->webroot ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo $this->request->webroot; ?>bower_components/jquery_confirm/jquery-confirm.js"></script>

<script>
    $(document).ready(function () {

        var phone_pat = /^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/;
        var first = $("#first").val();
        var last = $("#last").val();
        $("#first").keyup(function () {
            $("#first_error").show();
            $("#first_ok").hide();

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

        $("#last").keyup(function () {
            $("#last_error").hide();
            $("#last_ok").show();
            $("#first_error").hide();
            $("#first_ok").show();
        });

       /* $('input[name=phone1]').blur(function () {
            var phone = $("#phone").val();

            if ($('input[name=phone1]').val()) {
                //code for further validation
                if (!phone_pat.test(phone)){

                    $('input[name=phone1]').focus();
                    $('label[for=phone] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                } else{

                    $('label[for=phone] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
                }

            } else {
                $('input[name=phone1]').focus();
                $('label[for=phone] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
            }
        });*/

        $("#register").click(function () {

            var email = $("#email").val();
            var phone = $("#phone").val();

            var email_pat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var phone_pat = /^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/;

            var termsConditions = $('#terms_conditions').val();
            if(termsConditions !== ''){
                if(termsConditions === 'y' || termsConditions === 'Y'){
                    $('label[for=terms_conditions] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
                    $('#register').attr('disabled', false);

                } else{
                    $('label[for=terms_conditions] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                    $('#register').attr('disabled', true);
                    $('#terms_conditions').focus();

                    return false;

                }
            } else{
                $('#register').attr('disabled', true);
                $('#terms_conditions').focus();

                return false;
            }

            if (first === '') {

                $("#first_error").show();
                $("#first_ok").hide();

            } else {
                $("#first_error").hide();
                $("#first_ok").show();
            }
            if (last === '') {

                $("#last_error").show();
                $("#last_ok").hide();

            } else {
                $("#last_error").hide();
                $("#last_ok").show();
            }



            if (email === '' || !email_pat.test(email)) {
                $('#email').focus();
                alert('Invalid email format.');
                return false;
            } else if (!email_pat.test(email))
            {
                alert('Invalid email format');
                $('#email').focus();
                return false;
            } /*else if (phone === '' || !phone_pat.test(phone)){
                alert('Invalid phone format');
                $('input[name=phone1]').focus();
                $('label[for=phone] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');
                return false;
            } else if (!phone_pat.test(phone)){
                alert('Invalid phone format');
                $('input[name=phone1]').focus();
                $('label[for=phone] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');
                return false;
            }*/ else {
                if ($('input[required="required"], select[required="required"], textarea[required="required"]').val() == "") {
                    $('input[required="required"], select[required="required"], textarea[required="required"]').addClass('red_border');
                    alert('Please fill the form properly, Fields with * are required.');

                } else {

                    $('#UserAddForm').submit();
                }
            }
        });


    });</script>