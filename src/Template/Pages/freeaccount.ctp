<?php ?>
<header>
    <div class="container-fluid top-member-area colored-maroon">
        <div class="row">
            <div class="col-md-6">
                  <div class="left-header-section">
         				<div class="branding">
   		               <a class="navbar-brand" href="<?php echo $this->request->webroot;?>">
   		               <img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive"  />
   		               </a>
   		            </div>
         				<div class="top-member-menu">
         					<ul>
         						<li class="<?php if($this->request->params['action'] == 'registerindividual') echo 'active-reg-option'; ?>">
         							<a href="<?php echo $this->request->webroot;?>pages/registerindividual">
         								<span class="top-icon-wrapper pull-left">
         									<img src="<?php echo $this->request->webroot ?>assets/images/individual-icon.png" class="top-menu-icon">
         								</span> Individual Member
         							</a>
         						</li>
         						
         						<li class="<?php if($this->request->params['action'] == 'registercorporate') echo 'active-reg-option'; ?>">
         							<a href="<?php echo $this->request->webroot;?>pages/registercorporate">
         								<span class="top-icon-wrapper pull-left">
         									<img src="<?php echo $this->request->webroot ?>assets/images/corporate-icon.png" class="top-menu-icon">
         								</span>Corporate Member
         							</a>
         						</li>
         						
         						<li class="nonactive"><hr class="top-divider" /></li>
         						<li class="<?php if($this->request->params['action'] == 'registeremployee') echo 'active-reg-option'; ?>">
         							<a href="<?php echo $this->request->webroot;?>pages/registeremployee">
         								<span class="top-icon-wrapper pull-left">
         									<img src="<?php echo $this->request->webroot ?>assets/images/employee-icon.png" class="top-menu-icon">
         								</span> Employee Member
         							</a>
         						</li>
         					</ul>
         				</div>
                  </div>
      			</div>     
            <div class="col-md-6">
                <div class="right-header-section colored-light-grey">
                    <h2 class="text-center form-heading">Registration</h2>        
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

                                <small style="padding-right:10px;font-size:12px;padding-top:10px;position: relative;top: 35px;">OR</small>
                                <div class="col form-group">
                                    <label for="auth_phone">Phone
                                    </label>
                                    <input id="auth_phone" name="auth_phone" class="form-control" type="tel">
                                </div> <!-- form-group end.// -->
                            </div> <!-- form-row end.// --> 
                            <br />
                            <div class="form-group">
                                <small class="centered">Already have an account? <a href="#">Login</a></small>
                                <button type="submit" class="btn btn-primary btn-block maroon-btn"> Register  </button>
                            </div> <!-- form-group// -->      
                            <small class="centered">By joining, you agree to the <a href="#">Terms</a>  and <a href="#">Privacy Policy</a>.</small>                                          
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
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // preferredCountries: ['cn', 'jp'],
        // separateDialCode: true,
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
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // placeholderNumberType: "MOBILE",
        // preferredCountries: ['cn', 'jp'],
        // separateDialCode: true,
        utilsScript: "<?php echo $this->request->webroot ?>assets/js/utils.js",
    });


</script> 

<section class="content-wrapper very-centered">
    <div class="container">
        <div class="module-header">
            <div class="module-title half-underlined">
                <h2>Corporative Members</h2>
            </div>
            <p class="section-tagline">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <img src="<?php echo $this->request->webroot ?>assets/images/corporate.png" width="100%"/>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="short-content">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</div>
            </div> 
        </div>
    </div>
</section>
<div class="clearfix"></div>

