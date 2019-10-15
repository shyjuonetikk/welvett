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


<!-- ######## START OF HEADER ############### -->
<header>
    <div class="container-fluid top-member-area colored-maroon">
        <div class="row">
            <?php echo $this->element('inc/menu');?>   
            <div class="col-md-6">
                <div class="right-header-section colored-light-grey">
                    <h2 class="text-center form-heading">Registration</h2>
                    <small class="centered">Already have an account? <a href="<?php echo $this->request->webroot . 'login' ?>">Login</a></small>        
                    <div class="reg-form-wrapper">
                        <form method="post" id="member_form">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="first_name">First name 

                                        <i class="fa pull-right"></i>
                                    </label>   
                                    <input type="text" class="form-control" id="first_name" name="first_name" required="required">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label for="last_name">Last name 

                                        <i class="fa pull-right"></i>
                                    </label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required="required">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// -->
                            <div class="form-group">
                                <label for="job_title">Job title

                                    <i class="fa pull-right"></i>
                                </label>
                                <input type="text" class="form-control" id="job_title" name="job_title" required="required">
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label for="company_name">Company name

                                    <i class="fa pull-right"></i>
                                </label>
                                <input type="text" class="form-control" id="company_name" name="company_name" required="required">
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label for="company_address">Company address

                                    <i class="fa pull-right"></i>
                                </label>
                                <input type="text" class="form-control" id="company_address" name="company_address" required="required">
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label for="email">Company email address

                                    <i class="fa pull-right"></i>
                                </label>
                                <input type="email" class="form-control" id="email" name="email" required="required">
                            </div> <!-- form-group end.// -->
                            <div class="form-group">
                                <label for="phone">Company phone 

                                    <i class="fa pull-right"></i>
                                </label>
                                <input id="phone" name="phone" class="form-control" type="tel" required="required">
                            </div> <!-- form-group end.// -->

                            <div class="form-group">
                                <label for="password">Password 

                                    <i class="fa pull-right"></i>
                                </label>
                                <input class="form-control" type="password" id="password" name="password" required="required">
                            </div> <!-- form-group end.// -->  
                            <div class="form-group">
                                <label for="confirm_password">Comfirm Password

                                    <i class="fa pull-right"></i>
                                </label>
                                <input class="form-control" name="confirm_password" id="confirm_password" type="password" >
                            </div> <!-- form-group end.// -->  

                            <div class="form-group">
                                <p>
                                    Are you authorised to open an account on behalf of this company?
                                </p>
                                <label for="radio_true" class="special-radio yes">
                                    Yes <i class="fa fa-check-circle"></i>
                                    <input type="radio" name="authorise_company" value="1" id="radio_true" style="visibility: hidden;" /> 
                                </label>
                                <label for="radio_false" class="special-radio no">
                                    No <i class="fa fa-times-circle"></i>
                                    <input type="radio" name="authorise_company" value="0" id="radio_false" style="visibility: hidden;"/>
                                </label>
                            </div>  

                            <p><strong>Who authorised you?</strong></p>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="auth_fname">First name 

                                        <i class="fa pull-right"></i>
                                    </label>   
                                    <input type="text" class="form-control" id="auth_fname" name="auth_fname">
                                </div> <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label for="auth_lname">Last name 

                                        <i class="fa pull-right"></i>
                                    </label>
                                    <input type="text" class="form-control" id="auth_lname" name="auth_lname">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// --> 

                            <div class="form-group">
                                <label for="auth_job_title">Job title

                                    <i class="fa pull-right"></i>
                                </label>
                                <input type="text" class="form-control" id="auth_job_title" name="auth_job_title">
                            </div> <!-- form-group end.// -->

                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="auth_email">Email 
                                    </label>   
                                    <input type="text" class="form-control" id="auth_email" name="auth_email">
                                </div> <!-- form-group end.// -->

                                <small style="padding-right:10px;font-size:12px;padding-top:10px;position: relative;top: 35px;">AND</small>
                                <div class="col form-group">
                                    <label for="auth_phone">Phone 
                                    </label>
                                    <input id="auth_phone" name="auth_phone" class="form-control" type="tel">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// --> 

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

                                <button type="submit" id="register" class="btn btn-primary btn-block maroon-btn"> Register  </button>
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

    var auth_input = document.querySelector("#auth_phone");
    window.intlTelInput(auth_input, {
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
        utilsScript: "<?php echo $this->request->webroot ?>assets/js/utils.js",
    });


</script>