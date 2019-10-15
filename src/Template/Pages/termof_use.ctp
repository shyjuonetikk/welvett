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
