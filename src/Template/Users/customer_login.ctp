<?php

use Cake\Datasource\ConnectionManager;

// Google api integration
if (isset($_GET['code'])) {
    try {

        $gapi = new GoogleLoginApi();

        // Get the access token 
        $data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
        //print_r($data);
        // Access Tokem
        $access_token = $data['access_token'];

        // Get user information
        $user_info = $gapi->GetUserProfileInfo($access_token);


        $email = $user_info['emails'][0]['value'];
        $firstname = $user_info['name']['givenName'];
        $lastname = $user_info['name']['familyName'];
        $photo = $user_info['image']['url'];
        if (!empty($user_info['placesLived'][0]['value'])) {
            $address = $user_info['placesLived'][0]['value'];
        } else {
            $address = "";
        }

        if (!empty($user_info['gender'])) {
            $gender = $user_info['gender'];
        } else {
            $gender = "";
        }

        $this->request->session()->write('email', $email);
        $this->request->session()->write('first_name', $firstname);
        $this->request->session()->write('last_name', $lastname);
        $this->request->session()->write('profile_image', $photo);
        $this->request->session()->write('address', $address);
        $this->request->session()->write('gender', $gender);

        $rand = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
        $userName = $firstname . ' ' . $rand;
        $roleId = 2;
        $conn = ConnectionManager::get('default');
        $modified = date('Y-m-d H:i:s');


        $query_users = $conn->execute('SELECT * from users where email="' . $email . '"');


        $details_users = $query_users->fetchAll('assoc');




        if (empty($details_users)) {
            $query = $conn->execute("INSERT INTO `users`(`role_id`, `first_name`, `last_name`, `address1`,
        `profile_image`, `gender`, `user_name`, `email`, `status`, `modified`) 
        VALUES ('$roleId', '$firstname', '$lastname', '$address', '$photo', '$gender', '$userName', '$email', 1, '$modified')");
            ?>
            <script>
                window.location = "<?php echo $this->request->webroot; ?>Users/individualEvents";
            </script>

        <?php } else {
            ?>
            <script>
                window.location = "<?php echo $this->request->webroot; ?>Users/individualEvents";
            </script>
        <?php
        }
        // Now that the user is logged in you may want to start some session variables
        $_SESSION['logged_in'] = 1;

        // You may now want to redirect the user to the home page of your website
        // header('Location: home.php');
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

// Google api integration
?>

<style>
    ::placeholder {
        color: gray !important;
        opacity: 1; /* Firefox */
    }
    #customer_login_button{
        color:white !important;
        background-color: #7D1A2E;
    }
    #customer_login_button::hover{
        color:white !important;
        background-color: #7D1A2E;
    }
    .special-login {
        padding: 0px;
        box-shadow: 0px 1px 18px #7D1A2E;
        position: relative;
        border: 1px solid #7D1A2E;
    }
    #display_reg_form{
        color:#7D1A2E;
    }
    #display_reg_form::hover{
        color:#7D1A2E;
    }
</style>


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

        FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id'}, function (response) {

            window.location = '<?php echo $this->request->webroot; ?>users/customerLogin?userid=' + response.id + '&url=<?php echo $url; ?>';
            //alert(response.id);
            //document.getElementById('status').innerHTML = response.id;
        });
    }

    // getting basic user info
    function getInfo() {
        FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id'}, function (response) {
            $("#googleid").val(response.id);
            //document.getElementById('status').innerHTML = response.id;
        });
    }
</script> 
<script src="https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- login with instagram-->
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
        var popup = window.open('<?php echo $this->request->webroot ?>Users/instagramauth', '', 'width=' + popupWidth + ',height=' + popupHeight + ',left=' + popupLeft + ',top=' + popupTop + '');
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
                //$('#status').text('Thanks for logging in, ' + response.data.username + '!');

                if (response.data.id) {

                    window.location = '<?php echo $this->request->webroot; ?>users/customerLogin?userid=' + response.data.id + '&url=<?php echo $url; ?>';
                }
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
//                'f30a5a890b4041af886e0d314c3693e6',
                'b249bdcf67f64782b2e7628eadade213',
                'https://www.welvett.com/Users/customer_login/registeremployee',
                login_callback //optional - a callback function
                );
        return false;
    }

    // Display user profile details
    function displayUserProfileData(userData) {


    }
    // Get user data from session storage
    $(document).ready(function () {
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
                //$('#status').text('Thanks for logging in, ' + userData.username + '!');

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
<!-- login with instagram-->

<form method="post" class="pt-4">
<?php
if ($url != 'registeremployee') {
    ?>
        <div class="form-group">
            <!--<label for="exampleInputEmail1">Username</label>-->
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            <i class="mdi mdi-account"></i>
        </div>
        <div class="form-group">
            <!--<label for="exampleInputPassword1">Password</label>-->
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            <i class="mdi mdi-eye"></i>
        </div>
        <div class="mt-5">
            <button id="customer_login_button" type="submit" class="btn btn-block btn-lg font-weight-medium">Login</button>
        </div>
        <div class="text-center">
            <a href="<?php echo $this->request->webroot ?>Users/forgotPassword" id="display_reg_form">Forgot Password?</a>

        </div>
<?php } ?>

    <div id="gSignIn" class="gSignIn" ></div>
    <div class="mt-3 text-center">
        <span>Haven't Account </span><a href="<?php echo $this->request->webroot ?>" id="display_reg_form">Sign Up</a>
    </div> 
    <div class="mt-3 text-center">
        <span>Back to </span><a href="<?php echo $this->request->webroot ?>" id="display_reg_form">Home</a>
    </div>                  
    <!--<div id="status"></div>-->

<?php
if ($url == 'registerindividual') {
    ?>
        <br>
        <div>
            <button type="button" id="login" class="btn btn-social fb_button btn-block btn-lg" onclick="login();">
                <i class="fa fa-facebook pull-left"></i> Sign in with Facebook 
            </button>

        </div>
        <br>

    <?php
}
?>
<?php
if ($url == 'registeremployee') {
    ?>
        <br>
        <div>

        <?php echo $this->Form->button('<i class="fa fa-facebook pull-left"></i>Sign in with Facebook', ['type' => 'button', 'value' => '', 'id=' => 'login', 'class' => 'btn btn-social fb_button btn-block btn-lg', 'onclick' => 'login();']); ?>
        </div>
        <br>
        <div>
            <a href="javascript:void(0)" onclick="instagramLogin();"  style="" class="btn instagram-btn social-btn g_button btn-block btn-lg instagramLogin">
                <i class="fa fa-instagram pull-left" style="font-size:20px;"></i> Join via Instagram </a>
        </div>
        <br>
        <div>
            <a id="twitter-button" class="twitter_login btn twitter-btn g_button social-btn btn-block btn-lg">
                <i class="fa fa-twitter twitter pull-left" style="font-size:20px; color: #7cc5f8 !important; background-color: #fff !important;"></i> Join via Twitter</a>
        </div>
        <!--
    <div><?php //echo $this->Form->button('Sign in with Facebook', ['type' => 'button', 'value' => ' Register ','id='=>'login', 'class' => 'btn btn-social','onclick'=>'login();']); ?> 
    </div>
        -->


    <?php
}
?>



</form>

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

                window.location = '<?php echo $this->request->webroot . 'EmployeeMembers/employee_events'; ?>';

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