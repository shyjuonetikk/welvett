<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
    .top-member-menu2 ul li:hover {
        background: unset !important;
    }
    .top-member-menu2 ul li {
        font-size:16px !important;
        /*margin: 10px auto;*/  

    }
    .sign_up{
        padding: 5px 10px;
        background-color: #eee;
        color: black !important;
        border-radius: 3px;
        font-size:16px;
    }
    a:focus, a:active {
        background: #eee !important;
    }
    .top-member-menu ul li a:hover {
        color: black !important;
    }
    .top-member-menu ul .sign_up_li:hover {
        background: unset !important;

    }

    .top-header-image{
        padding-top:0;
    }
    a:focus, a:active {
        background: unset !important;
    }
    .top-member-menu ul li a:hover {
        color: #fff !important;
    }
    .sign_up_li:hover a.sign_up{

        color: #000 !important;
    }
    .account_links li{
        max-width: 90% !important;
    }
    .account_links li a{
        display: block;
        padding: 15px;
    }
    .account_links li a small{
        float: right;
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
                <div class="branding">
                    <a class="navbar-brand" href="#" style="padding-top:20px">
                        <img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive"  />
                    </a>
                </div>
            </div>
            <div class="col-md-7" style="text-align:right">
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
                        Already have account
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?php echo $this->request->webroot . 'Users/customer_login/registerindividual'; ?>">
                            Individual login
                        </a>
                        <a class="dropdown-item" href="<?php echo $this->request->webroot . 'Users/customer_login/corporate'; ?>">Corporate login</a>
                        <a class="dropdown-item" href="<?php echo $this->request->webroot . 'Users/customer_login/registeremployee'; ?>">Talent login</a>

                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="left-header-section">

                    <div class="top-member-menu">
                        <div class="row">
                            <div class="col-md-12">

                                <ul class="account_links">
                                    <!--                                    <div class="row">
                                                                            <div class="col-md-8">-->
                                    <li class="">
                                        <a class="padding_20" href="<?php echo $this->request->webroot; ?>pages/registerindividual">
                                            <span class="top-icon-wrapper pull-left">
                                                <img src="<?php echo $this->request->webroot ?>assets/images/individual-icon.png" class="top-menu-icon">
                                            </span> Individual Account
                                            <small>
                                                Sign up
                                            </small>

                                        </a>

                                    </li>
                                    <!--                                        </div>
                                                                            <div class="col-md-4">-->

                                    <!--                                        </div>
                                                                            <div class="col-md-8">-->
                                    <li class="">
                                        <a class="padding_20" href="<?php echo $this->request->webroot; ?>pages/registercorporate">
                                            <span class="top-icon-wrapper pull-left">
                                                <img src="<?php echo $this->request->webroot ?>assets/images/corporate-icon.png" class="top-menu-icon">
                                            </span>Corporate Account
                                            <small>
                                                Sign up
                                            </small>

                                        </a>

                                    </li>
                                    <!--                                        </div>
                                                                            <div class="col-md-4">-->

                                    <!--</div>-->
                                    <li class="nonactive"><hr class="top-divider" /></li>
                                    <!--<div class="col-md-8">-->
                                    <li class="">
                                        <a class="padding_20" href="<?php echo $this->request->webroot; ?>pages/registeremployee" style="display:block">
                                            <span class="top-icon-wrapper pull-left">
                                                <img src="<?php echo $this->request->webroot ?>assets/images/employee-icon.png" class="top-menu-icon">
                                            </span> Talent Account
                                            <small> Sign up</small>
                                        </a>
                                    </li>

                                </ul>

                            </div>

                        </div>
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
