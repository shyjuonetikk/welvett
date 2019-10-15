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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
    #privacyPolicy li{
        list-style: outside;
         font-size: 14px;
        
    }
    #privacyPolicy b{
        font-size: 18px;
    }
    #privacyPolicy p{
        font-size: 14px;
    }
    .dynamic_cities{
        padding: 0;
        width:100%;
    }
    .dynamic_cities li{
        padding-left:10px;
        border-bottom: 1px solid #eee;
    }
    .dynamic_cities li:hover{
        background-color: #eeeeee4d;
    }
    #search-result{
        background-color: white;
        min-height: 0;
        max-height: 200px;
        overflow: auto;
        border: 2px solid #ddd;
        border-top: none;
        position: absolute;
        z-index: 1;
    }
    .searched_user p{
        margin:0;
    }
    .searched_user{
        cursor: pointer;
    }
</style>
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
//                '22dbb58e19514d0781d9f997e0a626ed',
                'b249bdcf67f64782b2e7628eadade213',
                'https://www.welvett.com/pages/registeremployee',
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

    function put_value(value) {
        $('.searching').val(value);
        $('input[name=check_city]').val(1);
        $('#search-result').hide();
    }
    $(document).ready(function () {
        $('.searching').focusout(function () {
            setTimeout(function () {
                if ($('input[name=check_city]').val() == 0) {
                    $('.searching').val('');
                    $('#search-result').hide();
                } else {
                    $.ajax({
                        type: 'GET',
                        url: '<?php echo $this->request->webroot ?>Users/search_states',
                        data: 'field=' + $('.searching').val(),
                        contentType: 'json',
                        success: function (data)
                        {
                            data = JSON.parse(data);
                            $('select[name=state]').empty();
                            $('select[name=state]').append($("<option></option>").attr("value", '').text('- State -'));
                            $.each(data, function (key, value) {
                                $('select[name=state]')
                                        .append($("<option></option>")
                                                .attr("value", value.id)
                                                .text(value.statename));
                            });

                        }
                    });
                }
            }, 300);
        });
        $('.searching').keyup(function () {
            $('input[name=check_city]').val(0);
            $('#search-result').show();
            var value = $('.searching').val();
            if (value == "") {
                value = null;
            }
            if (value != '')
            {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot ?>Users/fetch_cities',
                    data: 'field=' + value,
                    contentType: 'json',
                    success: function (data)
                    {
                        var data = JSON.parse(data);

                        if ($.isEmptyObject(data))
                        {

                            var divsearch = $('#search-result').empty();
                            var app = "<ul class='dynamic_cities'><li class='searched_user'><p>No city found</p></li></ul>"

                            $('#search-result').append(app);

                        } else
                        {
                            $('#search-result').empty();
                            var icon;
                            var loginWithSocial;
                            var path = '';
                            var app = "<ul class='dynamic_cities'>";
                            $.each(data, function (key, value) {
                                icon = value.profile_image;
                                loginWithSocial = value.loginwithsocial;

                                $('#search-result').empty();

                                app += "<li class='searched_user'>"
                                        + "<p onclick='put_value(" + '"' + value + '"' + ")'>" + value + "</p>"
                                        + "</li>";
                            });
                            app += "</ul>";
                            $('#search-result').append(app);
                        }

                    }
                });
                //end
            } else {
                $('#search-result').hide();

            }

        });
        $('.searching').focus(function () {
            $('#search-result').show();
            var value = $('.searching').val();
            if (value == "") {
                value = null;
            }
            if (value != null)
            {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot ?>Users/fetch_cities',
                    data: 'field=' + value,
                    contentType: 'json',
                    success: function (data)
                    {
                        var data = JSON.parse(data);

                        if ($.isEmptyObject(data))
                        {
                            var divsearch = $('#search-result').empty();
                            var app = "<ul class='dynamic_cities'><li class='searched_user'><p>No city found</p></li></ul>"

                            $('#search-result').append(app);

                        } else {
                            $('#search-result').empty();
                            var icon;
                            var loginWithSocial;
                            var path = '';
                            var app = "<ul class='dynamic_cities'>";
                            $.each(data, function (key, value) {
                                icon = value.profile_image;
                                loginWithSocial = value.loginwithsocial;

                                $('#search-result').empty();

                                app += "<li class='searched_user'>"
                                        + "<p onclick='put_value(" + '"' + value + '"' + ")'>" + value + "</p>"
                                        + "</li>";
                            });
                            app += "</ul>";
                            $('#search-result').append(app);
                        }
                    }
                });
            } else {
                $('#search-result').hide();

            }
        });
    });
</script>

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
                            <label for="phone">Phone number <span class="required">*</span>
                                <i class="fa pull-right"></i>

                            </label>
                            <!--<input id="phone" name="company_phone" class="form-control" type="tel">-->
                            <?= $this->Form->control('phone', ['type' => 'tel', 'class' => 'form-control', 'label' => false, 'required']); ?>

                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label for="category">Choose category <span class="required">*</span>
                                <i class="fa pull-right"></i>

                            </label>
                            <?= $this->Form->control('eventcategory_id', ['options' => $services, 'empty' => ' - Select -', 'div' => false, 'label' => false, 'class' => 'form-control', 'id' => 'service']); ?>

                            <div class="form-row" id="show_sub_categories" style="display: none;">

                            </div>

                            <div class="form-row">
                                <div class="col-12 form-group">
                                    <label for="address">Address <span class="required">*</span>
                                        <i class="fa pull-right"></i>

                                    </label> 
                                </div>
                                <div class="col form-group">    
                                    <!--<input class="form-control" type="text" name="address" placeholder="Street Address">-->
                                    <?= $this->Form->control('address', ['class' => 'form-control', 'placeholder' => 'Street Address', 'label' => false, 'required']); ?>
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <!--<input class="form-control" type="text" name="appartment" placeholder="Appartment / House no">-->
                                    <?= $this->Form->control('appartment', ['class' => 'form-control', 'placeholder' => 'Street Address2', 'label' => false]); ?>

                                </div> 
                                <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-row">
                                <!-- form-group end.// -->

                            </div> <!-- form-row end.// -->
                            <div class="form-row">
                                <!-- form-group end.// -->
                                <div class="col form-group">
                                    <div class="input-group search-box">
                                        <?= $this->Form->control('city', ['class' => 'form-control searching', 'label' => false, 'autocomplete' => 'off', 'placeholder' => 'City', 'required', 'templates' => ['inputContainer' => '{{content}}']]); ?>
                                        <?= $this->Form->hidden('check_city'); ?>
                                    </div> 

                                    <div class="input-group search-result" id="search-result">

                                        <div class="clearfix"></div>

                                    </div>
                                </div> 
                                <div class="col form-group"> 
                                    <?= $this->Form->control('state', ['class' => 'form-control minimal', 'empty' => '- State -', 'options' => array(), 'label' => false, 'required']); ?>
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
                                <label for="gSignIn">Link your verfied social media account <span class="required">*</span>
                                    <i class="fa pull-right"></i>

                                </label>
                                <!-- Display Google sign-in button -->
                                <div  class="fb_div">
                                    <?php echo $this->Form->button('<i class="fa fa-facebook"> </i><span>Facebook</span>', ['type' => 'button', 'value' => '', 'id=' => 'login', 'class' => 'fb_auth_button', 'onclick' => 'login();']); ?>
                                </div>

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
                                <div class="col form-group" style="text-align: left;margin-top:6px;">
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
                                <div class="row">
                                    <div class="col-sm-8">
                                        <br>
                                        <small class="centered">Please enter "Y" if you agree to our <a data-toggle="modal" data-target="#termsAndConditions" href="#">Terms</a> and <a data-toggle="modal" data-target="#privacyPolicy" href="#">Privacy Policy</a>.</small> 
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
                                <?php
                                echo $this->Form->button('Register', ['type' => 'submit', 'value' => ' Register ', 'id' => 'register', 'class' => 'btn btn-primary btn-block maroon-btn', 'onclick' => 'prof']);
                                ?>
                            </div>

                            <!-- form-group// -->      

                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="termsAndConditions" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="background-color: #F5F5F5 !important;">
                        <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                            <h5 class="modal-title">Terms and Conditions</h5>
                        </div>
                        <div class="modal-body">

                            <h3>Terms and Conditions</h3>
                            <p>Last updated: April 25,2019 <br/>
                                Please read these Terms and Conditions ("Terms","Terms and Conditions") carefully before using the Welvett.com website (the "Service") operated by Welvett Media ("us","we",or "our").
                                <br/> Your access to and use of
                                the Service is conditioned
                                upon your acceptance of
                                and compliance with these
                                Terms. These Terms apply
                                to all visitors, users and
                                others who wish to access
                                or use the Service.
                                By accessing or using the
                                Service you agree to be
                                bound by these Terms. If
                                you disagree with any part
                                of the terms then you do
                                not have permission to
                                access the Service.  
                            </p>
                            <h3>Communications</h3>
                            <p>
                                By creating an Account on
                                our service, you agree to
                                subscribe to newsletters,
                                marketing or promotional
                                materials and other
                                information we may send.
                                However, you may opt out
                                of receiving any, or all, of
                                these communications
                                from us by following the
                                unsubscribe link or
                                instructions provided in
                                any email we send.</p>
                            <h3> Purchases</h3>
                            <p>

                                If you wish to purchase
                                any product or service
                                made available through
                                the Service ("Purchase"),
                                you may be asked to
                                supply certain information
                                relevant to your Purchase
                                including, without
                                limitation, your credit card
                                number, the expiration
                                date of your credit card,
                                your billing address, and
                                your shipping information.<br/>
                                You represent and warrant
                                that: (i) you have the legal
                                right to use any credit
                                card(s) or other payment
                                method(s) in connection
                                with any Purchase; and
                                that (ii) the information you
                                supply to us is true, correct
                                and complete.<br/>
                                The service may employ
                                the use of third party
                                services for the purpose of
                                facilitating payment and
                                the completion of
                                Purchases. By submitting
                                your information, you grant
                                us the right to provide the
                                information to these third
                                parties subject to our
                                Privacy Policy.<br>
                                We reserve the right to
                                refuse or cancel your order
                                at any time for reasons
                                including but not limited to:
                                product or service
                                availability, errors in the
                                description or price of the
                                product or service, error in
                                your order or other
                                reasons.<br/>
                                We reserve the right to
                                refuse or cancel your order
                                if fraud or an unauthorized
                                or illegal transaction is
                                suspected.
                            </p>
                            <h3>Availability,Errors andInaccuracies</h3>
                            We are constantly
                            updating product and
                            service offerings on the
                            Service. We may
                            experience delays in
                            updating information on
                            the Service and in our
                            advertising on other web
                            sites. The information
                            found on the Service may
                            contain errors or
                            inaccuracies and may not
                            be complete or current.
                            Products or services may
                            be mispriced, described
                            inaccurately, or
                            unavailable on the Service
                            and we cannot guarantee
                            the accuracy or
                            completeness of any
                            information found on the
                            Service.<br/>
                            We therefore reserve the
                            right to change or update
                            information and to correct
                            errors, inaccuracies, or
                            omissions at any time
                            without prior notice.
                            <h3>Contests,
                                Sweepstakes
                                and Promotions</h3>
                            <p>
                                Any contests,
                                sweepstakes or other
                                promotions (collectively,
                                "Promotions") made
                                available through the
                                Service may be governed
                                by rules that are separate
                                from these Terms &
                                Conditions. If you
                                participate in any
                                Promotions, please review
                                the applicable rules as well
                                as our Privacy Policy. If
                                the rules for a Promotion
                                conflict with these Terms
                                and Conditions, the
                                Promotion rules will apply.
                            </p>
                            <h3>Content</h3>
                            <p>
                                Our Service allows you to
                                post, link, store, share and
                                otherwise make available
                                certain information, text,
                                graphics, videos, or other
                                material ("Content"). You
                                are responsible for the
                                Content that you post on
                                or through the Service,
                                including its legality,
                                reliability, and
                                appropriateness.<br/>
                                By posting Content on or
                                through the Service, You
                                represent and warrant that:
                                (i) the Content is yours
                                (you own it) and/or you
                                have the right to use it and
                                the right to grant us the
                                rights and license as
                                provided in these Terms,
                                and (ii) that the posting of
                                your Content on or through
                                the Service does not
                                violate the privacy rights,
                                publicity rights, copyrights,
                                contract rights or any other
                                rights of any person or
                                entity. We reserve the right
                                to terminate the account of
                                anyone found to be
                                infringing on a copyright.<br/>
                                You retain any and all of
                                your rights to any Content
                                you submit, post or display
                                on or through the Service
                                and you are responsible
                                for protecting those rights.
                                We take no responsibility
                                and assume no liability for
                                Content you or any third
                                party posts on or through
                                the Service. However, by
                                posting Content using the
                                Service you grant us the
                                right and license to use,
                                modify, publicly perform,
                                publicly display,
                                reproduce, and distribute
                                such Content on and
                                through the Service. You
                                agree that this license
                                includes the right for us to
                                make your Content
                                available to other users of
                                the Service, who may also
                                use your Content subject
                                to these Terms.<br/>
                                Welvett Media has the
                                right but not the obligation
                                to monitor and edit all
                                Content provided by users.<br/>
                                In addition, Content found
                                on or through this Service
                                are the property of Welvett
                                Media or used with
                                permission. You may not
                                distribute, modify, transmit,
                                reuse, download, repost,
                                copy, or use said Content,
                                whether in whole or in
                                part, for commercial
                                purposes or for personal
                                gain, without express
                                advance written
                                permission from us.
                            </p>
                            <h3>Accounts</h3>
                            <p>
                                When you create an
                                account with us, you
                                guarantee that you are
                                above the age of 18, and
                                that the information you
                                provide us is accurate,
                                complete, and current at
                                all times. Inaccurate,
                                incomplete, or obsolete
                                information may result in
                                the immediate termination
                                of your account on the
                                Service.<br/>
                                You are responsible for
                                maintaining the
                                confidentiality of your
                                account and password,
                                including but not limited to
                                the restriction of access to
                                your computer and/or
                                account. You agree to
                                accept responsibility for
                                any and all activities or
                                actions that occur under
                                your account and/or
                                password, whether your
                                password is with our
                                Service or a third-party
                                service. You must notify us
                                immediately upon
                                becoming aware of any
                                breach of security or
                                unauthorized use of your
                                account.<br/>
                                You may not use as a
                                username the name of
                                another person or entity or
                                that is not lawfully
                                available for use, a name
                                or trademark that is
                                subject to any rights of
                                another person or entity
                                other than you, without
                                appropriate authorization.
                                You may not use as a
                                username any name that
                                is offensive, vulgar or
                                obscene.<br/>
                                We reserve the right to
                                refuse service, terminate
                                accounts, remove or edit
                                content, or cancel orders
                                in our sole discretion.
                            </p>
                            <h3>Intellectual</h3>
                            <p>
                                Property
                                The Service and its
                                original content (excluding
                                Content provided by
                                users), features and
                                functionality are and will
                                remain the exclusive
                                property of Welvett Media
                                and its licensors. The
                                Service is protected by
                                copyright, trademark, and
                                other laws of both the
                                United States and foreign
                                countries. Our trademarks
                                and trade dress may not
                                be used in connection with
                                any product or service
                                without the prior written
                                consent of Welvett Media.
                            </p>

                            <h3>Links To Other Web Sites</h3>  
                            <p>
                                Our Service may contain
                                links to third party web
                                sites or services that are
                                not owned or controlled by
                                Welvett Media
                                Welvett Media has no
                                control over, and assumes
                                no responsibility for the
                                content, privacy policies,
                                or practices of any third
                                party web sites or
                                services. We do not
                                warrant the offerings of
                                any of these
                                entities/individuals or their
                                websites.<br/>

                                You acknowledge and
                                agree that Welvett Media
                                shall not be responsible or
                                liable, directly or indirectly,
                                for any damage or loss
                                caused or alleged to be
                                caused by or in connection
                                with use of or reliance on
                                any such content, goods or
                                services available on or
                                through any such third
                                party web sites or
                                services.<br/>
                                We strongly advise you to
                                read the terms and
                                conditions and privacy
                                policies of any third party
                                web sites or services that
                                you visit.
                            </p>
                            <h3>
                                Termination
                            </h3>
                            <p>
                                We may terminate or
                                suspend your account and
                                bar access to the Service
                                immediately, without prior
                                notice or liability, under our
                                sole discretion, for any
                                reason whatsoever and
                                without limitation, including
                                but not limited to a breach
                                of the Terms.<br/>

                                If you wish to terminate
                                your account, you may
                                simply discontinue using
                                the Service.<br/>
                                All provisions of the Terms
                                which by their nature
                                should survive termination
                                shall survive termination,
                                including, without
                                limitation, ownership
                                provisions, warranty
                                disclaimers, indemnity and
                                limitations of liability.</p>
                            <h3>
                                Indemnification
                            </h3>
                            <p>
                                You agree to defend,
                                indemnify and hold
                                harmless Welvett Media
                                and its licensee and
                                licensors, and their
                                employees, contractors,
                                agents, officers and
                                directors, from and against
                                any and all claims,
                                damages, obligations,
                                losses, liabilities, costs or
                                debt, and expenses
                                (including but not limited to
                                attorney's fees), resulting
                                from or arising out of a)
                                your use and access of the
                                Service, by you or any
                                person using your account
                                and password; b) a breach
                                of these Terms, or c)
                                Content posted on the
                                Service.</p>
                            <h3>Limitation Of Liability</h3>
                            <p>
                                In no event shall Welvett
                                Media, nor its directors,
                                employees, partners,
                                agents, suppliers, or
                                affiliates, be liable for any
                                indirect, incidental, special,
                                consequential or punitive
                                damages, including
                                without limitation, loss of
                                profits, data, use, goodwill,
                                or other intangible losses,
                                resulting from (i) your
                                access to or use of or
                                inability to access or use
                                the Service; (ii) any
                                conduct or content of any
                                third party on the Service;
                                (iii) any content obtained
                                from the Service; and (iv)
                                unauthorized access, use
                                or alteration of your
                                transmissions or content,
                                whether based on
                                warranty, contract, tort
                                (including negligence) or
                                any other legal theory,
                                whether or not we have
                                been informed of the
                                possibility of such
                                damage, and even if a
                                remedy set forth herein is
                                found to have failed of its
                                essential purpose.
                            </p>
                            <h3>
                                Disclaimer
                            </h3>
                            <p>
                                Your use of the Service is
                                at your sole risk. The
                                Service is provided on an
                                "AS IS" and "AS
                                AVAILABLE" basis. The
                                Service is provided without
                                warranties of any kind,
                                whether express or
                                implied, including, but not
                                limited to, implied
                                warranties of
                                merchantability, fitness for
                                a particular purpose, noninfringement or course of
                                performance.
                                <br/>
                                Welvett Media its
                                subsidiaries, affiliates, and
                                its licensors do not warrant
                                that a) the Service will
                                function uninterrupted,
                                secure or available at any
                                particular time or location;
                                b) any errors or defects will
                                be corrected; c) the
                                Service is free of viruses
                                or other harmful
                                components; or d) the
                                results of using the
                                Service will meet your
                                requirements.
                            </p>
                            <h3>
                                Exclusions
                            </h3>
                            <p>
                                Some jurisdictions do not
                                allow the exclusion of
                                certain warranties or the
                                exclusion or limitation of
                                liability for consequential
                                or incidental damages, so
                                the limitations above may
                                not apply to you.
                            </p>
                            <h3>
                                Governing Law
                            </h3>
                            <p>
                                These Terms shall be
                                governed and construed in
                                accordance with the laws
                                of Nebraska, United
                                States, without regard to
                                its conflict of law
                                provisions.
                                <br/>
                                Our failure to enforce any
                                right or provision of these
                                Terms will not be
                                considered a waiver of
                                those rights. If any
                                provision of these Terms is
                                held to be invalid or
                                unenforceable by a court,
                                the remaining provisions of
                                these Terms will remain in
                                effect. These Terms
                                constitute the entire
                                agreement between us
                                regarding our Service, and
                                supersede and replace
                                any prior agreements we
                                might have had between
                                us regarding the Service.
                            </p>
                            <h3>
                                Changes
                            </h3>
                            <p>
                                We reserve the right, at
                                our sole discretion, to
                                modify or replace these
                                Terms at any time. If a
                                revision is material we will
                                provide at least 30 days
                                notice prior to any new
                                terms taking effect. What
                                constitutes a material
                                change will be determined
                                at our sole discretion.<br/>

                                By continuing to access or
                                use our Service after any
                                revisions become
                                effective, you agree to be
                                bound by the revised
                                terms. If you do not agree
                                to the new terms, you are
                                no longer authorized to
                                use the Service.
                            </p>
                            <h3>
                                Contact Us
                            </h3>
                            <p>
                                If you have any questions
                                about these Terms, please
                                contact us.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="privacyPolicy" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="background-color: #F5F5F5 !important;">
                        <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                            <h5 class="modal-title">Privacy Policy</h5>
                        </div>
                        <div class="modal-body">
                            <h3>Privacy Policy</h3>
                            Revision date: April 25, 2019<br/>
                            Welvett Media ("us","we", or "our")
                            operates the welvett.com website
                            (hereinafter referred to as the
                            "Service"). 
                            <br/>
                            This page informs you of our policies
                            regarding the collection, use and
                            disclosure of personal data when you
                            use our Service and the choices you
                            have associated with that data.<br/>                            
                            We use your data to provide and
                            improve the Service. By using the
                            Service, you agree to the collection and
                            use of information in accordance with
                            this policy. Unless otherwise defined in
                            this Privacy Policy, the terms used in
                            this Privacy Policy have the same
                            meanings as in our Terms and
                            Conditions, accessible from
                            welvett.com<br/>
                            <h3>
                                Definitions
                            </h3>
                            <ul>
                                <li>
                                    <b> Service</b>
                                    <br/>
                                    Service is the welvett.com website
                                    operated by Welvett 
                                </li>
                                <li>
                                    <b> Media</b>
                                    <br/>
                                    Personal Data
                                    Personal Data means data about a
                                    living individual who can be identified
                                    from those data (or from those and
                                    other information either in our
                                    possession or likely to come into our
                                    possession).
                                </li>
                                <li>
                                    <b>Usage Data</b>
                                    <br/>
                                    Usage Data is data collected
                                    automatically either generated by the
                                    use of the Service or from the Service
                                    infrastructure itself (for example, the
                                    duration of a page visit). 
                                </li>
                                <li><b>
                                        Cookies</b>
                                    <br/>
                                    Cookies are small files stored on your
                                    device (computer or mobile device).
                                </li>
                                <li><b>
                                        Data Controller</b>
                                    <br/>
                                    Data Controller means the natural or
                                    legal person who (either alone or
                                    jointly or in common with other
                                    persons) determines the purposes for
                                    which and the manner in which any
                                    personal information are, or are to be,
                                    processed.<br/> For the purpose of this Privacy Policy,
                                    we are a Data Controller of your
                                    Personal Data. 
                                </li>
                                <li>
                                    <b>Data Processors (or Service Providers)</b>
                                    <br/>
                                    Data Processor (or Service Provider)
                                    means any natural or legal person
                                    who processes the data on behalf of
                                    the Data Controller.
                                    <br/>
                                    We may use the services of various
                                    Service Providers in order to process
                                    your data more effectively.
                                </li>
                                <li>
                                    <b>
                                        Data Subject (or User)
                                    </b>
                                    <br/>
                                    Data Subject is any living individual
                                    who is using our Service and is the
                                    subject of Personal Data.
                                </li>
                            </ul>
                            <h3>
                                Information Collection
                                and Use</h3>
                            <p>
                                We collect several different types of
                                information for various purposes to
                                provide and improve our Service to
                                you.
                            </p> 
                            <h3>Types of Data Collected</h3>
                            <h4> Personal Data</h4>
                            <p>
                                While using our Service, we may ask
                                you to provide us with certain
                                personally identifiable information that
                                can be used to contact or identify you
                                ("Personal Data"). Personally
                                identifiable information may include, but
                                is not limited to:
                            </p>
                            <ul>
                                <li>
                                    Email address</li>
                                <li>
                                    First name and last name</li><li>
                                    Phone number</li><li>
                                    Address, State, Province, ZIP/Postal
                                    code, City</li><li>
                                    Cookies and Usage Data</li>
                            </ul>
                            <P>
                                We may use your Personal Data to
                                contact you with newsletters, marketing
                                or promotional materials and other
                                information that may be of interest to
                                you. You may opt out of receiving any,
                                or all, of these communications from us
                                by following the unsubscribe link or the
                                instructions provided in any email we
                                send.</p>
                            <h3>Usage Data</h3>
                            <p>
                                We may also collect information on how
                                the Service is accessed and used
                                ("Usage Data"). This Usage Data may
                                include information such as your
                                computer's Internet Protocol address
                                (e.g. IP address), browser type,
                                browser version, the pages of our
                                Service that you visit, the time and date
                                of your visit, the time spent on those
                                pages, unique device identifiers and
                                other diagnostic data.
                            </p>
                            <h3> Location Data</h3><p>
                                We may use and store information
                                about your location if you give us
                                permission to do so ("Location Data"). We use this data to provide features of
                                our Service, to improve and customise
                                our Service.
                                <br/>
                                You can enable or disable location
                                services when you use our Service at
                                any time by way of your device
                                settings.</p>
                            <h3> Tracking & Cookies Data</h3><p>
                                We use cookies and similar tracking
                                technologies to track the activity on our
                                Service and we hold certain
                                information.<br/>
                                Cookies are files with a small amount
                                of data which may include an
                                anonymous unique identifier. Cookies
                                are sent to your browser from a website
                                and stored on your device. Other
                                tracking technologies are also used
                                such as beacons, tags and scripts to
                                collect and track information and to
                                improve and analyse our Service.<br/>

                                You can instruct your browser to refuse
                                all cookies or to indicate when a cookie
                                is being sent. However, if you do not
                                accept cookies, you may not be able to
                                use some portions of our Service.<br>
                                Examples of Cookies we use:
                                <br/>
                            <ul>
                                <li><b>
                                        Session Cookies.</b> We use Session
                                    Cookies to operate our Service.</li>

                                <li><b>Preference Cookies.</b> We use
                                    Preference Cookies to remember
                                    your preferences and various
                                    settings.</li><li><b> Security Cookies.</b> We use Security
                                    Cookies for security purposes.
                                </li> 
                                <li><b>Advertising Cookies.</b> Advertising
                                    Cookies are used to serve you with
                                    advertisements that may be relevant
                                    to you and your interests.</li>
                            </ul>
                            <h3>
                                Use of Data
                            </h3><p>
                                Welvett Media uses the collected data
                                for various purposes:</p>
                            <ul><li>
                                    To provide and maintain our Service</li>
                                <li>
                                    To notify you about changes to our
                                    Service
                                </li>
                                <li>
                                    To allow you to participate in
                                    interactive features of our Service
                                    when you choose to do so</li><li>
                                    To provide customer support</li><li>
                                    To gather analysis or valuable
                                    information so that we can improve
                                    our Service</li><li>
                                    To monitor the usage of our Service</li><li>
                                    To detect, prevent and address
                                    technical issues</li><li>
                                    To provide you with news, special
                                    offers and general information about
                                    other goods, services and events
                                    which we offer that are similar to
                                    those that you have already
                                    purchased or enquired about unless
                                    you have opted not to receive such
                                    information</li>
                            </ul>
                            <h3>
                                Legal Basis for
                                Processing Personal
                                Data under the General
                                Data Protection
                                Regulation (GDPR)</h3>
                            <p>
                                If you are from the European Economic
                                Area (EEA), Welvett Media legal basis
                                for collecting and using the personal
                                information described in this Privacy
                                Policy depends on the Personal Data
                                we collect and the specific context in
                                which we collect it.<br/> Welvett Media may process your
                                Personal Data because:
                            </p>
                            <ul><li>
                                    We need to perform a contract with
                                    you</li><li>
                                    You have given us permission to do
                                    so</li><li>
                                    The processing is in our legitimate
                                    interests and it is not overridden by
                                    your rights</li><li>
                                    For payment processing purposes</li>
                                <li> To comply with the law</li>
                            </ul>
                            <h3>Retention of Data</h3>
                            <p>
                                Welvett Media will retain your Personal
                                Data only for as long as is necessary
                                for the purposes set out in this Privacy
                                Policy. We will retain and use your
                                Personal Data to the extent necessary
                                to comply with our legal obligations (for
                                example, if we are required to retain
                                your data to comply with applicable
                                laws), resolve disputes and enforce our
                                legal agreements and policies.
                                <br/>                            
                                Welvett Media will also retain Usage
                                Data for internal analysis purposes. Usage Data is generally retained for a
                                shorter period of time, except when this
                                data is used to strengthen the security
                                or to improve the functionality of our
                                Service, or we are legally obligated to
                                retain this data for longer periods.</p>
                            <h3>Transfer of Data</h3>
                            <p>
                                Your information, including Personal
                                Data, may be transferred to - and
                                maintained on - computers located
                                outside of your state, province, country
                                or other governmental jurisdiction
                                where the data protection laws may
                                differ from those of your jurisdiction.<br/>
                                If you are located outside United States
                                and choose to provide information to
                                us, please note that we transfer the
                                data, including Personal Data, to
                                United States and process it there.<br/>
                                Your consent to this Privacy Policy
                                followed by your submission of such
                                information represents your agreement
                                to that transfer.<br/> Welvett Media will take all the steps
                                reasonably necessary to ensure that
                                your data is treated securely and in
                                accordance with this Privacy Policy and
                                no transfer of your Personal Data will
                                take place to an organisation or a
                                country unless there are adequate
                                controls in place including the security
                                of your data and other personal
                                information.</p><h3> Disclosure of Data</h3>
                            <h4>
                                Business Transaction
                            </h4>
                            <p>
                                If Welvett Media is involved in a
                                merger, acquisition or asset sale, your
                                Personal Data may be transferred. We
                                will provide notice before your Personal
                                Data is transferred and becomes
                                subject to a different Privacy Policy.
                            </p>
                            <h3>
                                Disclosure for Law Enforcement
                            </h3>
                            <p>
                                Under certain circumstances, Welvett
                                Media may be required to disclose your
                                Personal Data if required to do so by
                                law or in response to valid requests by
                                public authorities (e.g. a court or a
                                government agency). </p>
                            <h3>                            
                                Legal Requirements</h3><p>
                                Welvett Media may disclose your
                                Personal Data in the good faith belief
                                that such action is necessary to:</p>
                            <ul><li>
                                    To comply with a legal obligation</li><li>
                                    To protect and defend the rights or
                                    property of Welvett Media</li><li>
                                    To prevent or investigate possible
                                    wrongdoing in connection with the
                                    Service</li><li>
                                    To protect the personal safety of
                                    users of the Service or the public</li><li>
                                    To protect against legal liability</li>
                            </ul>
                            <h3>
                                Security of Data
                            </h3><p>
                                The security of your data is important to
                                us but remember that no method of
                                transmission over the Internet or
                                method of electronic storage is 100%
                                secure. While we strive to use
                                commercially acceptable means to
                                protect your Personal Data, we cannot
                                guarantee its absolute security.</p> 
                            <h3>Our Policy on "Do Not
                                Track" Signals under
                                the California Online
                                Protection Act
                                (CalOPPA)</h3>
                            <p>
                                We do not support Do Not Track
                                ("DNT"). Do Not Track is a preference
                                you can set in your web browser to
                                inform websites that you do not want to
                                be tracked.<br/> You can enable or disable Do Not
                                Track by visiting the Preferences or
                                Settings page of your web browser.
                            </p>
                            <h3>
                                Your Data Protection
                                Rights under the
                                General Data Protection
                                Regulation (GDPR)
                            </h3>
                            <p>
                                If you are a resident of the European
                                Economic Area (EEA), you have certain
                                data protection rights. Welvett Media
                                aims to take reasonable steps to allow
                                you to correct, amend, delete or limit
                                the use of your Personal Data.<br/>
                                If you wish to be informed about what
                                Personal Data we hold about you and if
                                you want it to be removed from our
                                systems, please contact us.<br/>
                                In certain circumstances, you have the
                                following data protection rights:</p>
                            <ul><li><b>
                                        The right to access, update or
                                        delete the information we have on
                                        you.</b> Whenever made possible, you
                                    can access, update or request
                                    deletion of your Personal Data
                                    directly within your account settings
                                    section. If you are unable to perform
                                    these actions yourself, please contact
                                    us to assist you.</li><li><b>
                                        The right of rectification.</b> You have
                                    the right to have your information
                                    rectified if that information is
                                    inaccurate or incomplete.</li><li><b>The right to object.</b> You have the
                                    right to object to our processing of
                                    your Personal Data.</li><li><b> The right of restriction.</b> You have
                                    the right to request that we restrict the
                                    processing of your personal
                                    information.</li><li><b>
                                        The right to data portability.</b> You
                                    have the right to be provided with a
                                    copy of the information we have on
                                    you in a structured, machine-readable
                                    and commonly used format.</li><li><b> The right to withdraw consent.</b> You
                                    also have the right to withdraw your
                                    consent at any time where Welvett
                                    Media relied on your consent to
                                    process your personal information.</li>
                            </ul>
                            <p>
                                Please note that we may ask you to
                                verify your identity before responding to
                                such requests.<br/> You have the right to complain to a
                                Data Protection Authority about our
                                collection and use of your Personal
                                Data. For more information, please
                                contact your local data protection
                                authority in the European Economic
                                Area (EEA).<br/>

                            <h3>Service Providers</h3>
                            <p>
                                We may employ third party companies
                                and individuals to facilitate our Service
                                ("Service Providers"), provide the
                                Service on our behalf, perform Servicerelated services or assist us in
                                analysing how our Service is used.<br/> These third parties have access to your
                                Personal Data only to perform these
                                tasks on our behalf and are obligated
                                not to disclose or use it for any other
                                purpose.

                            </p>
                            <h3>Advertising</h3><p>
                                We may use third-party Service
                                Providers to show advertisements to
                                you to help support and maintain our
                                Service. </p>
                            <ul><li>
                                    <h4>
                                        Google AdSense & DoubleClick
                                        Cookie
                                    </h4>
                                </li>
                            </ul>
                            <p>
                                Google, as a third party vendor, uses
                                cookies to serve ads on our Service. Google's use of the DoubleClick
                                cookie enables it and its partners to
                                serve ads to our users based on their
                                visit to our Service or other websites
                                on the Internet.<br/> You may opt out of the use of the
                                DoubleClick Cookie for interest-based
                                advertising by visiting the Google Ads
                                Settings web page:<br/>
                                <a target="_blank" href="http://www.google.com/ads/preferences">http://www.google.com/ads/preferences</a>
                            <h3> Payments</h3>
                            <p>
                                We may provide paid products and/or
                                services within the Service. In that
                                case, we use third-party services for
                                payment processing (e.g. payment
                                processors).<br/> We will not store or collect your
                                payment card details. That information
                                is provided directly to our third-party
                                payment processors whose use of your
                                personal information is governed by
                                their Privacy Policy. These payment
                                processors adhere to the standards set
                                by PCI-DSS as managed by the PCI
                                Security Standards Council, which is a
                                joint effort of brands like Visa,
                                MasterCard, American Express and
                                Discover. PCI-DSS requirements help
                                ensure the secure handling of payment
                                information.<br/> The payment processors we work with
                                are:</p>
                            <ul><li><b>
                                        Apple Store In-App Payments</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.apple.com/legal/privacy/enww">https://www.apple.com/legal/privacy/enww</a>
                                </li>
                                <li>
                                    <b>
                                        Google Play In-App Payments
                                    </b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.google.com/policies/privacy">https://www.google.com/policies/privacy</a>
                                </li>
                                <li><b>Stripe</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://stripe.com/us/privacy">https://stripe.com/us/privacy
                                    </a>
                                <li><b>WePay</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://go.wepay.com/privacy-policy">
                                        https://go.wepay.com/privacy-policy
                                    </a>
                                </li>
                                <li><b>WorldPay</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.worldpay.com/uk/worldpay-privacy-notice">https://www.worldpay.com/uk/worldpay-privacy-notice</a>
                                </li><li><b>PayPal / Braintree</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.paypal.com/webapps/mpp/ua/privacyfull">
                                        https://www.paypal.com/webapps/mpp/ua/privacyfull
                                    </a></li><li><b>
                                        FastSpring</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a href="http://fastspring.com/privacy">http://fastspring.com/privacy</a> 
                                </li>
                                <li><b>Authorize.net</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.authorize.net/company/privacy">https://www.authorize.net/company/privacy</a>
                                </li>
                                <li><b>
                                        2Checkout</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.2checkout.com/policies/privacy-policy">
                                        https://www.2checkout.com/policies/privacy-policy
                                    </a>
                                </li>
                                <li><b>Sage Pay</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.sagepay.co.uk/policies">https://www.sagepay.co.uk/policies</a>
                                </li>
                                <li><b>
                                        Square</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://squareup.com/legal/privacy-no-account">https://squareup.com/legal/privacy-no-account</a>
                                </li>
                                <li><b>Go Cardless</b>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://gocardless.com/en- eu/legal/privacy">https://gocardless.com/en- eu/legal/privacy</a>
                                </li><li><b>
                                        Elavon</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.elavon.com/privacy-pledge.html">https://www.elavon.com/privacy- pledge.html</a>
                                </li>
                                <li>
                                    <b> Verifone</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.verifone.com/en/us/legal">
                                        https://www.verifone.com/en/us/legal  
                                    </a>
                                </li>
                                <li><b>
                                        Moneris</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://www.moneris.com/en/Privacy- Policy">https://www.moneris.com/en/Privacy- Policy</a>
                                </li>
                                <li><b>
                                        WeChat</b><br/>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href=" https://www.wechat.com/en/privacy_policy.html"> https://www.wechat.com/en/privacy_policy.html</a>
                                </li>
                                <li>
                                    <b>Alipay</b>
                                    Their Privacy Policy can be viewed at
                                    <a target="_blank" href="https://render.alipay.com/p/f/agreementpages/alipayglobalprivacypolicy.html">https://render.alipay.com/p/f/agreementpages/alipayglobalprivacypolicy.html</a>
                                </li>
                            </ul>
                            <h3>
                                Links to Other Sites</h3>
                            <p>
                                Our Service may contain links to other
                                sites that are not operated by us. If you
                                click a third party link, you will be
                                directed to that third party's site. We
                                strongly advise you to review the
                                Privacy Policy of every site you visit.<br/>
                                We have no control over and assume
                                no responsibility for the content, privacy
                                policies or practices of any third party
                                sites or services.</p>
                            <h3>
                                Children's Privacy</h3>
                            <p>
                                Our Service does not address anyone
                                under the age of 18 ("Children").<br/> We do not knowingly collect personally
                                identifiable information from anyone
                                under the age of 18. If you are a parent
                                or guardian and you are aware that
                                your Child has provided us with
                                Personal Data, please contact us. If we
                                become aware that we have collected
                                Personal Data from children without
                                verification of parental consent, we take
                                steps to remove that information from
                                our servers.</p>

                            <h3>Changes to This Privacy
                                Policy</h3>
                            <p>
                                We may update our Privacy Policy from
                                time to time. We will notify you of any
                                changes by posting the new Privacy
                                Policy on this page.<br/>
                                We will let you know via email and/or a
                                prominent notice on our Service, prior
                                to the change becoming effective and
                                update the "revision date" at the top of
                                this Privacy Policy.<br/>
                                You are advised to review this Privacy
                                Policy periodically for any changes. Changes to this Privacy Policy are
                                effective when they are posted on this
                                page. 
                            </p>
                            <h3>
                                Contact Us</h3>
                            <p>
                                If you have any questions about this
                                Privacy Policy, please contact us:
                                By visiting this page on our <a href="<?php echo $this->request->webroot ?>Pages/contact">www.welvett/contact</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</header>
<!-- ######## END OF HEADER ############### -->   

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
                                            onlyCountries: ['us'],
                                            // placeholderNumberType: "MOBILE",
                                            // preferredCountries: ['cn', 'jp'],
                                            separateDialCode: true,
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