<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    // Access token is required to make any endpoint calls,
// http://instagram.com/developer/endpoints/
var accessToken = null;
var authenticateInstagram = function(instagramClientId, instagramRedirectUri, callback) {
    // Pop-up window size, change if you want
    var popupWidth = 700,
        popupHeight = 500,
        popupLeft = (window.screen.width - popupWidth) / 2,
        popupTop = (window.screen.height - popupHeight) / 2;
    // Url needs to point to instagram_auth.php
    var popup = window.open('instagramauth', '', 'width='+popupWidth+',height='+popupHeight+',left='+popupLeft+',top='+popupTop+'');
    popup.onload = function() {
        // Open authorize url in pop-up
        if(window.location.hash.length == 0) {
            popup.open('https://instagram.com/oauth/authorize/?client_id='+instagramClientId+'&redirect_uri='+instagramRedirectUri+'&response_type=token', '_self');
        }
        // An interval runs to get the access token from the pop-up
        var interval = setInterval(function() {
            try {
                // Check if hash exists
                if(popup.location.hash.length) {
                    // Hash found, that includes the access token
                    clearInterval(interval);
                    accessToken = popup.location.hash.slice(14); //slice #access_token= from string
                    popup.close();
                    if(callback != undefined && typeof callback == 'function'){
                        callback();
                    }
                }
            }
            catch(evt) {
                // Permission denied
            }
        }, 100);
    };
};
function login_callback(){
    //alert("You are successfully logged in! Access Token: "+accessToken);
    $.ajax({
        type: "GET",
        dataType: "jsonp",
        url: "https://api.instagram.com/v1/users/self/?access_token="+accessToken,
        success: function(response){ 
            // Change button and show status
            $('.instagramLoginBtn').attr('onclick','instagramLogout()');
            $('.btn-text').text('Logout from Instagram');
            $('#status').text('Thanks for logging in, ' + response.data.username + '!');
            
        if(response.data.id){
           
         window.location='/talents/talents/users/customerLogin?userid='+response.data.id;
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
        'f30a5a890b4041af886e0d314c3693e6',
        'http://localhost/talents/talents/users/customer_login',
        login_callback //optional - a callback function
    );
    return false;
}

    // Display user profile details
function displayUserProfileData(userData){
     
            
   }
// Get user data from session storage
$(document).ready(function(){
    if(typeof(Storage) !== "undefined"){
        var userLoggedIn = sessionStorage.getItem("userLoggedIn");
        if(userLoggedIn == '1'){
            // Get user data from session storage
            var provider = sessionStorage.getItem("provider");
            var userInfo = sessionStorage.getItem("userData");
            var userData = $.parseJSON(userInfo);
            
            // Change button and show status
            $('.instagramLoginBtn').attr('onclick','instagramLogout()');
            $('.btn-text').text('Logout from Instagram');
            $('#status').text('Thanks for logging in, ' + userData.username + '!');
            
            // Display user data
            displayUserProfileData(userData);
        }
    }else{
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
    
    $('.instagramLoginBtn').attr('onclick','instagramLogin()');
    $('.btn-text').text('Login with Instagram');
    $('#status').text('You have successfully logout from Instagram.');
    $('#userData').html('');
}
</script>
<!-- login with instagram-->