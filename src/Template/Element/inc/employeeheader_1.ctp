<?php ?>

<!-- ######## START OF NAVIGATION ############### -->
<!--  <nav class="navbar navbar-expand-lg topnav">
<div class="container">
<div class="branding">
<a class="navbar-brand" href="#">
<img src="assets/images/logo.png" class="image-responsive"  />
</a>
</div>
<div class="collapse navbar-collapse customnav" id="navbarResponsive">
<ul class="navbar-nav ml-auto">
<li class="nav-item active">
<a class="nav-link" href="index.html">Home
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Tech</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Science</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Culture</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Cars</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Tech</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">Contact</a>
</li>
</ul>
</div> 
</div>
</nav>-->
<!-- ######## END OF NAVIGATION ############### -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale = 1.0" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
<meta name="google-signin-client_id" content="461117325997-ni57tvgm7dte53h1gh9b58l227mbiql5.apps.googleusercontent.com">
<script src="https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js"></script>

<script>
    // Render Google Sign-in button
    function renderButton() {
        gapi.signin2.render('gSignIn', {
            'scope': 'profile email',
            'width': 140,
            'height': 25,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
        });
    }

    // Sign-in success callback
    function onSuccess(googleUser) {
        // Get the Google profile data (basic)
        //var profile = googleUser.getBasicProfile();

        // Retrieve the Google account data
        gapi.client.load('oauth2', 'v2', function () {
            var request = gapi.client.oauth2.userinfo.get({
                'userId': 'me'
            });
            request.execute(function (resp) {
                $("#facebookurl").val('');
                $('#form-hide').hide();
                // Display the user details
                //            var profileHTML = '<h3>Welcome '+resp.given_name+'! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></h3>';
                //            profileHTML += '<img src="'+resp.picture+'"/><p><b>Google ID: </b>'+resp.id+'</p><p><b>Name: </b>'+resp.name+'</p><p><b>Email: </b>'+resp.email+'</p><p><b>Gender: </b>'+resp.gender+'</p><p><b>Locale: </b>'+resp.locale+'</p><p><b>Google Profile:</b> <a target="_blank" href="'+resp.link+'">click to view profile</a></p>';
                //            document.getElementsByClassName("userContent")[0].innerHTML = profileHTML;
                //            
                //            document.getElementById("gSignIn").style.display = "none";
                //            document.getElementsByClassName("userContent")[0].style.display = "block";
                $("#googleid").val(resp.id);
                $("#photo").val(resp.picture);
                $("#profile").val(resp.link);

                $("#howtologin").val('login with google');
                var googleId = $("#googleid").val();

                if (googleId != "") {
                    $('label[for=gSignIn] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');


                } else {
                    $('label[for=gSignIn] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');

                }

            });
        });
    }

    // Sign-in failure callback
    function onFailure(error) {
        console.log(error);
    }

    // Sign out the user
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            document.getElementsByClassName("userContent")[0].innerHTML = '';
            document.getElementsByClassName("userContent")[0].style.display = "none";
            document.getElementById("gSignIn").style.display = "block";
        });

        auth2.disconnect();
    }
</script>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">// Save user data to the database
    function saveUserData(userData) {
        $.post('userData.php', {oauth_provider: 'google', userData: JSON.stringify(userData)});


    }
    // Sign-in success callback
    function onSuccess(googleUser) {
        // Get the Google profile data (basic)
        //var profile = googleUser.getBasicProfile();

        // Retrieve the Google account data
        gapi.client.load('oauth2', 'v2', function () {
            var request = gapi.client.oauth2.userinfo.get({
                'userId': 'me'
            });
            request.execute(function (resp) {
                // Display the user details
                //            var profileHTML = '<h3>Welcome '+resp.given_name+'! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></h3>';
                //            profileHTML += '<img src="'+resp.picture+'"/><p><b>Google ID: </b>'+resp.id+'</p><p><b>Name: </b>'+resp.name+'</p><p><b>Email: </b>'+resp.email+'</p><p><b>Gender: </b>'+resp.gender+'</p><p><b>Locale: </b>'+resp.locale+'</p><p><b>Google Profile:</b> <a target="_blank" href="'+resp.link+'">click to view profile</a></p>';
                //            document.getElementsByClassName("userContent")[0].innerHTML = profileHTML;


                $("#googleid").val(resp.id);

                document.getElementById("gSignIn").style.display = "none";
                document.getElementsByClassName("userContent")[0].style.display = "block";

                // Save user data
                saveUserData(resp);
            });
        });
    }

</script>

<!-- ######## START OF HEADER ############### -->

<script>
    // initialize and setup facebook js sdk
    window.fbAsyncInit = function () {
        FB.init({
            appId: '321635131817657',
            xfbml: true,
            version: 'v2.5'
        });

        FB.getLoginStatus(function (response) {
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

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // login with facebook with extra permissions
    function login() {
        $('#profile').val('');
        FB.login(function (response) {
            if (response.status === 'connected') {

                document.getElementById('status').innerHTML = 'We are connected.';
                document.getElementById('login').style.visibility = 'hidden';
            } else if (response.status === 'not_authorized') {
                document.getElementById('status').innerHTML = 'We are not logged in.'
            } else {
                document.getElementById('status').innerHTML = 'You are not logged into Facebook.';
            }
        }, {scope: 'email'});
        FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,link,name_format'}, function (response) {

            if (response.id != 'undefined') {
                $('#form-hide').show();
                $("#facebookurl").val(' https://www.facebook.com/');
            }
            $("#googleid").val(response.id);

            var img_link = "http://graph.facebook.com/" + response.id + "/picture";
            // var profile = response.link;

            $("#photo").val(img_link);
            $("#howtologin").val('login with facebook done');
            //document.getElementById('status').innerHTML = response.id;
            var googleId = $("#googleid").val();

            if (googleId != "") {
                $('label[for=gSignIn] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');


            } else {
                $('label[for=gSignIn] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');

            }
        });

    }

    // getting basic user info
    function getInfo() {
        FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id'}, function (response) {

            var img_link = "http://graph.facebook.com/" + response.id + "/picture";
            $("#photo").val(img_link);
            $("#howtologin").val('login with facebook done');
            //document.getElementById('status').innerHTML = response.id;
        });
    }
    $("#redir").click(function () {
        window.location = '/Mypage?Name=2';
    });

    function prof() {
        if ($("#howtologin").val() == 'login with facebook done') {

            $("#profile").val($("#socialname").val());
            exit;



        }
    }

</script>


<script>
    // Access token is required to make any endpoint calls,
    // http://instagram.com/developer/endpoints/
    var accessToken = null;
    var authenticateInstagram = function (instagramClientId, instagramRedirectUri, callback) {
        // Pop-up window size, change if you want
        var popupWidth = 700,
                popupHeight = 500,
                popupLeft = (window.screen.width - popupWidth) / 2,
                popupTop = (window.screen.height - popupHeight) / 2;
        // Url needs to point to instagram_auth.php
        var popup = window.open('<?php echo $this->request->webroot ?>Pages/instagramauth', '', 'width=' + popupWidth + ',height=' + popupHeight + ',left=' + popupLeft + ',top=' + popupTop + '');
        popup.onload = function () {
            // Open authorize url in pop-up
            if (window.location.hash.length == 0) {
                popup.open('https://instagram.com/oauth/authorize/?client_id=' + instagramClientId + '&redirect_uri=' + instagramRedirectUri + '&response_type=token', '_self');
            }
            // An interval runs to get the access token from the pop-up
            var interval = setInterval(function () {
                try {
                    // Check if hash exists
                    if (popup.location.hash.length) {
                        // Hash found, that includes the access token
                        clearInterval(interval);
                        accessToken = popup.location.hash.slice(14); //slice #access_token= from string
                        popup.close();
                        if (callback != undefined && typeof callback == 'function') {
                            callback();
                        }
                    }
                } catch (evt) {
                    // Permission denied
                }
            }, 100);
        };
    };

    function login_callback() {
        //alert("You are successfully logged in! Access Token: "+accessToken);
        $.ajax({
            type: "GET",
            dataType: "jsonp",
            url: "https://api.instagram.com/v1/users/self/?access_token=" + accessToken,
            success: function (response) {
                // Change button and show status
                $('.instagramLoginBtn').attr('onclick', 'instagramLogout()');
                $('.btn-text').text('Logout from Instagram');
                $('#status').text('Thanks for logging in, ' + response.data.username + '!');
                $('#form-hide').hide();
                $("#facebookurl").val('');
                // Display user data
                displayUserProfileData(response.data);

                // Save user data
                saveUserData(response.data);

                // Store user data in sessionStorage
                sessionStorage.setItem("userLoggedIn", "1");
                sessionStorage.setItem("provider", "instagram");
                sessionStorage.setItem("userData", JSON.stringify(response.data));
            }
        });
    }
    // Authenticate instagram
    function instagramLogin() {
        authenticateInstagram(
                '22dbb58e19514d0781d9f997e0a626ed',
                'http://needanecommercesite.com/Welvett/pages/registeremployee',
                login_callback //optional - a callback function
                );
        return false;
    }

    // Display user profile details
    function displayUserProfileData(userData) {

        $("#googleid").val(userData.id);
        $("#photo").val(userData.profile_picture);
        $("#howtologin").val('login with Instagram');
        $("#profile").val('https://www.instagram.com/' + userData.username);


        var googleId = $("#googleid").val();


        if (googleId != "") {
            $('label[for=gSignIn] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');


        } else {
            $('label[for=gSignIn] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');

        }
    }
    // Get user data from session storage
    $(document).ready(function () {
        $('#form-hide').hide();
        if (typeof (Storage) !== "undefined") {
            var userLoggedIn = sessionStorage.getItem("userLoggedIn");
            if (userLoggedIn == '1') {
                // Get user data from session storage
                var provider = sessionStorage.getItem("provider");
                var userInfo = sessionStorage.getItem("userData");
                var userData = $.parseJSON(userInfo);

                // Change button and show status
                $('.instagramLoginBtn').attr('onclick', 'instagramLogout()');
                $('.btn-text').text('Logout from Instagram');
                $('#status').text('Thanks for logging in, ' + userData.username + '!');

                // Display user data
                displayUserProfileData(userData);
            }
        } else {
            console.log("Sorry, your browser does not support Web Storage...");
        }
    });
    // Logout from instagram
    function instagramLogout() {
        // Remove user data from sessionStorage
        sessionStorage.removeItem("userLoggedIn");
        sessionStorage.removeItem("provider");
        sessionStorage.removeItem("userData");
        sessionStorage.clear();

        $('.instagramLoginBtn').attr('onclick', 'instagramLogin()');
        $('.btn-text').text('Login with Instagram');
        $('#status').text('You have successfully logout from Instagram.');
        $('#userData').html('');
    }
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<!-- login with instagram-->
<header>
    <div class="container-fluid top-member-area colored-maroon">
        <div class="row">
            <?php echo $this->element('inc/menu'); ?>   
            <div class="col-md-6">
                <div class="right-header-section colored-light-grey">
                    <h2 class="text-center form-heading">Registration</h2>   
                    <small class="centered">Already have an account? <a href="<?php echo $this->request->webroot . 'login' ?>">Login</a></small>     
                    <div class="reg-form-wrapper">
                        <?php
                        echo $this->Form->create('member_form', ['id' => 'member_form']);
                        ?>
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="first_name">First name 
                                    <i class="fa pull-right"></i>

                                </label>  
                                <?= $this->Form->control('first_name', ['class' => 'form-control', 'label' => false, 'required']); ?>
                                <!--<input type="text" class="form-control" name="fname">-->
                            </div> <!-- form-group end.// -->
                            <div class="col form-group">
                                <label for="last_name">Last name 
                                    <i class="fa pull-right"></i>

                                </label>
                                <!--<input type="text" class="form-control" name="lname">-->
                                <?= $this->Form->control('last_name', ['class' => 'form-control', 'label' => false, 'required']); ?>

                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row end.// -->

                        <div class="form-group">
                            <label for="email">Email address
                                <i class="fa pull-right"></i>
                            </label>
                            <?= $this->Form->control('email', ['type' => 'email', 'class' => 'form-control', 'label' => false, 'required']); ?>
                            <p style="color:red">
                                <?php
                                if (isset($user)) {

                                    $error = $user->errors();
                                    if (isset($error['email']['_isUnique'])) {
                                        echo $error['email']['_isUnique'];
                                    }
                                }
                                ?>
                            </p>

                            <!--<input type="email" class="form-control" name="company_email">-->
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label for="phone">Phone number
                                <i class="fa pull-right"></i>

                            </label>
                            <!--<input id="phone" name="company_phone" class="form-control" type="tel">-->
                            <?= $this->Form->control('phone', ['type' => 'tel', 'class' => 'form-control', 'label' => false, 'required']); ?>

                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label for="category">Choose category
                                <i class="fa pull-right"></i>

                            </label>
                            <?= $this->Form->control('eventcategory_id', ['options' => $services, 'empty' => ' - Select -', 'div' => false, 'label' => false, 'class' => 'form-control', 'id' => 'service']); ?>

                            <div class="form-row" id="show_sub_categories" style="display: none;">

                            </div>

                            <div class="form-row">
                                <div class="col-12 form-group">
                                    <label for="address">Address 
                                        <i class="fa pull-right"></i>

                                    </label> 
                                </div>
                                <div class="col form-group">    
                                    <!--<input class="form-control" type="text" name="address" placeholder="Street Address">-->
                                    <?= $this->Form->control('address', ['class' => 'form-control', 'placeholder' => 'Street Address', 'label' => false, 'required']); ?>
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <!--<input class="form-control" type="text" name="appartment" placeholder="Appartment / House no">-->
                                    <?= $this->Form->control('appartment', ['class' => 'form-control', 'placeholder' => 'Appartment / House no', 'label' => false, 'required']); ?>

                                </div> 
                                <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-row">
                                <!-- form-group end.// -->
                                <div class="col form-group">

                                    <select class="js-example-basic-single" name="state">
                                        <option value="AL">Alabama</option>
                                        ...
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div> 
                                <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-row">
                                <!-- form-group end.// -->
                                <div class="col form-group">
                                    <!--<input class="form-control" type="text" name="city" placeholder="City">-->

                                    <?= $this->Form->control('city', ['class' => 'form-control', 'label' => false, 'placeholder' => 'City', 'required']); ?>

                                </div> 
                                <div class="col form-group"> 
                                    <?= $this->Form->control('state', ['class' => 'form-control minimal', 'empty' => '- State -', 'options' => $states, 'label' => false, 'required']); ?>
                                    <!--                                <select  class="form-control minimal" >
    <option>- State -</option>
    <option value='FL'>Florida</option>
    </select>-->
                                </div>
                                <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-group">
                                <!--<input class="form-control" type="text" name="zipcode" placeholder="Zip Code">-->
                                <?= $this->Form->control('zipcode', ['class' => 'form-control', 'placeholder' => 'Zip Code', 'label' => false, 'required']); ?>

                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <small>Note: Please use your current physical location as we will send special package to complete registration</small>
                            </div>
                            <br />
                            <p style="color:red">
                                <?php
                                if (isset($user)) {
                                    $error = $user->errors();
                                    if (isset($error['loginwithsocial']['_isUnique'])) {
                                        echo $error['loginwithsocial']['_isUnique'];
                                    }
                                }
                                ?>
                            </p>
                            <div class="form-group">
                                <label for="gSignIn">Link your verfied social media account
                                    <i class="fa pull-right"></i>

                                </label>
                                <!-- Display Google sign-in button -->
                                <div id="gSignIn" class="gSignIn" ></div>
                                <div>
                                    <?php echo $this->Form->button('<i class="fa fa-facebook"> </i><span>Facebook</span>', ['type' => 'button', 'value' => '', 'id=' => 'login', 'class' => 'fb_auth_button', 'onclick' => 'login();']); ?>


                                </div>


                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="form-group">

                                <div class="twitter_div">
                                    <a class="fb_auth_button" id="twitter-button" class="btn btn-social btn-twitter">
                                        <i class="fa fa-twitter"></i> <span>Twitter</span>
                                    </a>
                                </div> 
                                <div class="insta_div" >
                                    <a class="fb_auth_button" href="javascript:void(0)" onclick="instagramLogin();"><i class="fa fa-instagram instagram"> </i> <span>Instagram</span></a>
                                </div>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="form-row"  id="form-hide">
                                <label for="">Please Provide Facebook User Name
                                </label>
                                <!-- form-group end.// -->
                                <div class="col form-group" style="text-align: left;margin-top:10px;">
                                    https://www.facebook.com/
                                    <input id="facebookurl" name="facebookurl" class="form-control" type="hidden">
                                </div> 
                                <div class="col form-group" style="float:left; margin-left:-170px; "> 
                                    <?= $this->Form->control('profile', ['type' => 'text', 'name' => 'profile', 'class' => 'form-control', 'id' => 'profile', 'label' => false, 'required', 'placeholder' => 'e.g. John Smith']); ?>

                                </div>
                                <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="clearfix">&nbsp;</div>

                            <div class="form-group">
                                <label for="job">Define your job
                                    <i class="fa pull-right"></i>

                                </label>
                                <!--<textarea class="form-control" name="job"></textarea>-->
                                <?= $this->Form->control('job', ['type' => 'textarea', 'class' => 'form-control', 'label' => false, 'required']); ?>

                            </div> <!-- form-group end.// -->
                            <br>
                            <div class="form-group">

                            <!--<input class="form-control" type="password" name="password">-->
                                <?= $this->Form->control('password', ['type' => 'hidden', 'value' => 'emp@tal', 'class' => 'form-control', 'label' => false, 'required']); ?>

                            </div> <!-- form-group end.// -->  
                            <div class="form-group">


                            <!--<input class="form-control" type="password" >-->
                                <?= $this->Form->control('confirm_password', ['type' => 'hidden', 'value' => 'emp@tal', 'class' => 'form-control', 'label' => false, 'required']); ?>
                                <?= $this->Form->control('googleid', ['type' => 'hidden', 'name' => 'googleid', 'class' => 'form-control', 'id' => 'googleid', 'label' => false, 'required']); ?>
                                <?= $this->Form->control('photo', ['type' => 'hidden', 'name' => 'photo', 'class' => 'form-control', 'id' => 'photo', 'label' => false, 'required']); ?>

                                <?= $this->Form->control('howtologin', ['type' => 'hidden', 'name' => 'howtologin', 'class' => 'form-control', 'id' => 'howtologin', 'label' => false, 'required']); ?>

                            </div> <!-- form-group end.// -->  

                            <div class="form-group">
                                <?php
                                echo $this->Form->button('Register', ['type' => 'submit', 'value' => ' Register ', 'class' => 'btn btn-primary btn-block maroon-btn', 'onclick' => 'prof']);
                                ?>
                            </div>

                            <!-- form-group// -->      
                            <small class="centered">By joining, you agree to the <a href="#">Terms</a>  and <a href="#">Privacy Policy</a>.</small>                                          
                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
</header>
<!-- ######## END OF HEADER ############### -->   
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script src="<?php echo $this->request->webroot ?>assets/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        // allowDropdown: false,
        //autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // preferredCountries: ['cn', 'jp'],
        // separateDialCode: true,
        utilsScript: "assets/js/utils.js",
    });

    var company_input = document.querySelector("#company_phone");
    window.intlTelInput(company_input, {
        // allowDropdown: false,
        //autoHideDialCode: false,
        // autoPlaceholder: "off",
        // dropdownContainer: document.body,
        // excludeCountries: ["us"],
        // formatOnDisplay: false,
        // geoIpLookup: function(callback) {
        //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //     var countryCode = (resp && resp.country) ? resp.country : "";
        //     callback(countryCode);
        //   });
        // },
        // hiddenInput: "full_number",
        // initialCountry: "auto",
        // localizedCountries: { 'de': 'Deutschland' },
        // nationalMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // preferredCountries: ['cn', 'jp'],
        // separateDialCode: true,
        utilsScript: "<?php echo $this->request->webroot ?>assets/js/utils.js",
    });



</script>
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });
    $('#twitter-button').on('click', function () {
        // Initialize with your OAuth.io app public key
        OAuth.initialize('HwAr2OtSxRgEEnO2-JnYjsuA3tc');
        // Use popup for OAuth
        OAuth.popup('twitter').then(twitter => {
            console.log('twitter:', twitter);
            // Prompts 'welcome' message with User's email on successful login
            // #me() is a convenient method to retrieve user data without requiring you
            // to know which OAuth provider url to call
            twitter.me().then(data => {
                console.log('data:', data);

                //var img_link = "http://avatars.io/twitter/"+data.id";
//                alert(data.avatar);
                $("#googleid").val(data.id);
                $("#photo").val(data.avatar);
                $("#howtologin").val('login with Twitter');
                var googleId = $("#googleid").val();

                if (googleId != "") {
                    $('label[for=gSignIn] i').addClass('fa-smile-o field_ok').removeClass('fa-frown-o field_error');


                } else {
                    $('label[for=gSignIn] i').addClass('fa-frown-o field_error').removeClass('fa-smile-o field_ok');

                }
                //alert('Twitter says your email is:' + data.id + ".\nView browser 'Console Log' for more details");
            });
            // Retrieves user data from OAuth provider by using #get() and
            // OAuth provider url    
            twitter.get('/1.1/account/verify_credentials.json?include_email=true').then(data => {
                console.log('self data:', data);
            })
        });
    })
</script>