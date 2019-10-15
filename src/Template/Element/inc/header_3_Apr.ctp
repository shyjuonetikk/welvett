<style>
    #login{
        color:white;
    }
    #login:hover{
        color:white !important;
    }
    .padding_20{
        padding: 20px;
    }
    .top-member-menu ul li{
        padding-bottom: 3px;
    }
</style>
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
            <div class="col-md-5">
                <div class="left-header-section">
                    <div class="branding">
                        <a class="navbar-brand" href="#">
                            <img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive"  />
                        </a>
                    </div>
                    <div class="top-member-menu">
                        <!--<form class="reg-choose-form" mehtod="post" action="">-->
                        <form method="post" accept-charset="utf-8" action="<?php echo $this->request->webroot; ?>">
                            <?php
                            //                        echo $this->Form->create('login');
                            ?>
                            <ul>


                                <li class="">
                                    <label for="individual">
                                        <a class="padding_20" href="<?php  echo $this->request->webroot;?>pages/registerindividual">
                                            <span class="top-icon-wrapper pull-left">
                                                <img src="<?php echo $this->request->webroot ?>assets/images/individual-icon.png" class="top-menu-icon">
                                            </span> Individual Account
                                        </a>
                                    </label>
                                    <input id="individual" value="individual" type="radio" name="role" style="display:none;">
                                </li>

                                <li class="">
                                    <label for="corporate">
                                        <a class="padding_20" href="<?php echo $this->request->webroot; ?>pages/registercorporate">
                                            <span class="top-icon-wrapper pull-left">
                                                <img src="<?php echo $this->request->webroot ?>assets/images/corporate-icon.png" class="top-menu-icon">
                                            </span>Corporate Account
                                        </a>
                                    </label>

                                    <input id="corporate" value="corporate" type="radio" name="role" style="display:none;">

                                </li>

                                <li class="nonactive"><hr class="top-divider" /></li>
                                <li class="">
                                    <label for="employee">
                                        <a class="padding_20" href="<?php echo $this->request->webroot; ?>pages/registeremployee">
                                            <span class="top-icon-wrapper pull-left">
                                                <img src="<?php echo $this->request->webroot ?>assets/images/employee-icon.png" class="top-menu-icon">
                                            </span> Talent Account
                                        </a>
                                    </label>
                                    <input id="employee" value="employee" type="radio" name="role" style="display:none;">

                                </li>
                            </ul>
                            <button id="registration" class="top-menu-reg-btn" type="submit" style="color:gray" disabled>Registration</button>
<!--
                            <p style="text-align: center;">
                                <a href="<?php //echo $this->request->webroot . 'login' ?>" id="login" style="display:inline;color:white;">Already have account?</a>
                            </p>
-->

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="right-header-section colored-maroon">
                    <img src="<?php echo $this->request->webroot ?>assets/images/talent_network.png" class="top-header-image" />
                </div>
            </div>
        </div>	
    </div>
</header>
<!-- ######## END OF HEADER ############### -->  
