<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?></title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo $this->request->webroot ?>assets/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>assets/css/intlTelInput.css">
        <link href="<?php echo $this->request->webroot ?>assets/css/custom.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/responsive.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/googlefonts.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/saif.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/naqeeb.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.css" rel="stylesheet">

        <script src="<?php echo $this->request->webroot ?>assets/js/jquery.js"></script>
        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
        <style>
            li{
                font-size: 14px;

            }
            b{
                font-size: 18px;
            }
            p{
                font-size: 14px;
            }
            #footer ul > li{
                list-style: none !important;
            }
        </style>
    </head>
    <body> 


        <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
            <a class="navbar-brand" href="<?php echo $this->request->webroot;?>">
                <img src="<?= $this->request->webroot; ?>assets/images/logo.png" class="image-responsive mini-logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $this->request->webroot;?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $this->request->webroot;?>pages/about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $this->request->webroot;?>pages/faq">FAQs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $this->request->webroot;?>pages/contact">Contact</a>
                    </li>
                </ul>

            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="padding:15px">
                    <div>
                        <h2><?php echo ucwords($this->request->params['action']);?></h2>
                        <h3>Coming Soon</h3>
                    </div>
                </div>
                <div class="col-md-1"></div>

            </div>
        </div>
        <!-- Footer -->
        <div id="footer" class="customtemp-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="nav_menu-4" class="boxr boxr_nav_menu">
                            <h4 class="boxr-title">Welvet.com</h4>
                            <div class="menu-customtemp-footer-container">
                                <ul id="menu-customtemp-main-2" class="customtemp-mobile-menu">
                                    <li>
                                        <a href="<?php echo $this->request->webroot;?>">Home</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->request->webroot;?>Pages/about">About Us</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->request->webroot;?>Pages/faq">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->request->webroot;?>Pages/welvettIos">Welvett for IOS (coming soon)</a>
                                    </li>
                                    <li>
                                        <a  href="<?php echo $this->request->webroot;?>Pages/welvettAndroid">Welvett for Android (coming soon)</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="text-5" class="boxr boxr_text">
                            <h4 class="boxr-title">Help</h4>
                            <div class="textboxr">
                                <div class="menu-customtemp-footer-container">
                                    <ul id="menu-customtemp-main-2" class="customtemp-mobile-menu">
                                        <li>
                                            <a href="<?php echo $this->request->webroot ?>Pages/contact">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                                <!--End mc_embed_signup-->
                            </div>
                            <br />
                            <h4 class="boxr-title">Follow Us</h4>
                            <div id="mks_social_boxr-5" class="boxr mks_social_boxr">
                                <ul class="mks_social_boxr_ul">
                                    <li>
                                        <a href="#" title="Facebook" class="facebook_ico soc_circle" target="_blank" style="width: 34px; height: 34px; font-size: 16px;">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Twitter" class="twitter_ico soc_circle" target="_blank" style="width: 34px; height: 34px; font-size: 16px;">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Youtube" class="youtube_ico soc_circle" target="_blank" style="width: 34px; height: 34px; font-size: 16px;">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="text-4" class="boxr boxr_text">
                            <h4 class="boxr-title">About</h4>
                            <div class="textboxr">
                                <div id="mc_embed_signup">
                                    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mihi enim erit isdem istis fortasse iam utendum. Aliter enim nosmet ipsos nosse non possumus. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="nav_menu-4" class="boxr boxr_nav_menu">
                            <h4 class="boxr-title">Legal</h4>
                            <div class="menu-customtemp-footer-container">
                                <ul id="menu-customtemp-main-2" class="customtemp-mobile-menu">
                                    <li>
                                        <a href="<?php echo $this->request->webroot;?>pages/privacyPolicy">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->request->webroot;?>pages/termofUse">Website Term of Use</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="customtemp-copyright">
                <div class="container">
                    <p style="text-align: center" class="pull-left">&copy; <?php echo date('Y'); ?> Welvett, LLC. All rights reserved</p>
                    <p style="text-align: center" class="pull-right">Developed By: <a href="http://www.cyberclouds.com">Cyberclouds</a></p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- End Of Footer -->

        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo $this->request->webroot ?>assets/js/owl.carousel.js"></script>
        <script src="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.js"></script>

        <?php
    if ($this->request->params['action'] == 'registerindividual') {
        ?>
        <script src="<?php echo $this->request->webroot ?>js/validation1.js"></script>
        <?php } else { ?>
        <script src="<?php echo $this->request->webroot ?>js/validation.js"></script>
        <?php } ?>
        <script>
            function show_custom_message(message) {
                $.alert({
                    confirmButton: 'Ok',
                    title: 'Information!',
                    content: message,

                });
            }
            $(function () {
                $.each($('input,textarea,select').filter('[required]:visible'), function () {
                    $(this).parent().siblings('label').append('<span class="required">*</span>');
                });
                $.each($('input,textarea,select').filter('[required]:visible'), function () {
                    $(this).siblings('label').append('<span class="required">*</span>');
                });

                $('input[name=role]').change(function () {
                    //                    registration
                    if (typeof $('input[name=role]:checked').val() != 'undefined') {
                        $(':input[type="submit"]').prop('disabled', false);
                        $(':input[type="submit"]').attr('style', 'color:#7b1b2d');
                    } else {
                        $(':input[type="submit"]').prop('disabled', true);
                        $(':input[type="submit"]').attr('style', 'color:gray');

                    }
                    $('li').removeClass('active-reg-option');
                    $(this).parent().addClass('active-reg-option');
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $(window).scroll(function () {
                    //alert($("body").scrollTop().offset().top);
                    /*if($(window).scrollTop() > $(".topnav").height()-5){
                     $(".topnav").addClass("upnav");
                     $(".topnav .container").addClass("miniheight");
                     } else {
                     $(".topnav").removeClass("upnav");
                     $(".topnav .container").removeClass("miniheight");
                     }
                     if($(window).scrollTop() > $(".topnav").height()){

                     $("body").addClass("customtemp-header-sticky-on");

                     } else {
                     $("body").removeClass("customtemp-header-sticky-on");

                     }*/
                });
                $(".reg-choose-form ul li").on("click", function () {
                    $('.choose-form-option').attr('value', '');
                    $(".reg-choose-form ul li").removeClass('active-reg-option');
                    $(this).addClass('active-reg-option');
                    $(this).find('.choose-form-option').attr('value', 1);
                });

                $(".top-search span").click(function () {
                    $(".top-search").toggleClass("active");
                    $(".top-search span i").toggleClass("fa-times");
                });
                $(".sidemenubtn").click(function () {
                    $("body").toggleClass("customtemp-sidebar-action-open").toggleClass("customtemp-lock");
                });
                $(".customtemp-action-close , .customtemp-sidebar-action-overlay").click(function () {
                    $("body").toggleClass("customtemp-sidebar-action-open").toggleClass("customtemp-lock");
                });
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 0,
                    autoplay: true,
                    autoplayTimeout: 2000,
                    navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true
                        },
                        600: {
                            items: 3,
                            nav: true
                        },
                        1000: {
                            items: 4,
                            nav: true,
                            loop: true
                        }
                    }
                });

                /* Code for radio buttons used in registration forms */
                $(".special-radio").on("click", function () {
                    $('.special-radio').removeClass('active-yes');
                    $('.special-radio').removeClass('active-no');
                    if ($(this).hasClass('yes')) {
                        $(this).addClass('active-yes');
                    } else if ($(this).hasClass('no')) {
                        $(this).addClass('active-no');
                    }



                });

                if ($(".special-radio.yes").find('input[type=radio]').prop('checked') == true) {
                    $(".special-radio.yes").addClass('active-yes');
                } else if ($(".special-radio.no").find('input[type=radio]').prop('checked') == true) {
                    $(".special-radio.no").addClass('active-no');
                }
                /* END OF Code for radio buttons used in registration forms */

            });

            $(document).ready(function () {
                $('#service').change(function () {
                    var serviceId = $(this).val();

                    if (serviceId !== "") {
                        $.ajax({
                            url: '<?php echo $this->request->webroot ?>EmployeeMembers/findSubServices',
                            data: {
                                'service_id': serviceId
                            },
                            type: 'POST',
                            cache: false,
                            async: false,
                            success: function (responce) {

                                $('#show_sub_categories').show();
                                var data = JSON.parse(responce);
                                $('#show_sub_categories').html(data);

                            },
                            error: function () {
                                alert('error');
                            }

                        });

                    } else {

                        $('#service').focus();
                        $('#show_sub_categories').hide();
                    }

                });
            });


        </script>
    </body>
</html>
