<?php

use Cake\Datasource\ConnectionManager;
?>
<style>
    #submitForm{
        background-color: #7B1B2D; 
    }
    #submitForm:hover{
        box-shadow: 1px 1px 5px #7B1B2D; 
    }
    body{
        background-color: #fff;
    }
    .contact-page-left h2, .contact-page-right h2 {
        color: #2f302f;
        font-weight: 900;
        font-size: 25px;
        position: relative;
        z-index: -1;
        margin-bottom: 55px;
    }
    .company-information {
        margin-top: 25px;
        box-shadow: 0 0 10px #ccc;
        padding: 20px;
    }
    .company-information a {
        position: relative;
        display: block;
        padding-left: 64px;
        margin-bottom: 40px;
    }
    .company-information-icon {
        position: absolute;
        left: 0;
        top: 0;
        height: 50px;
        width: 50px;
        border: 1px solid #D9D9D9;
        text-align: center;
        padding-top: 10px;
        color: #7B1B2D;
        font-size: 15px;
    }
    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .contact-page-left h2:before, .contact-page-right h2:before {
        position: absolute;
        left: 0;
        bottom: -20px;
        width: 50px;
        height: 2px;
        background: #7B1B2D;
        content: "";
        z-index: 2;
    }
    .contact-page-left h2:after, .contact-page-right h2:after {
        position: absolute;
        left: 0;
        bottom: -20px;
        width: 100%;
        height: 1px;
        background: #ddd;
        content: "";
        z-index: 1;
    }

</style>
<header>
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
    <div class="container top-member-area">
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-page-left">
                    <script type="text/javascript">
                        function initialize() {
                            var myLatlng = new google.maps.LatLng(,);

                            var mapOptions = {
                                center: myLatlng,
                                zoom: 17,
                                disableDefaultUI: false,
                                streetViewControl: false,
                                //mapTypeId: google.maps.MapTypeId.DEFAULT,
                                mapTypeId: google.maps.MapTypeId.ROADMAP,
                                mapTypeControl: true,
                                mapTypeControlOptions: {
                                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                                    position: google.maps.ControlPosition.RIGHT_BOTTOM

                                }


                            };
                            var image = new google.maps.MarkerImage(
                                "/fgem/img/bluedot.png",
                                null, // size
                                null, // origin
                                new google.maps.Point(8, 8), // anchor (move to center of marker)
                                new google.maps.Size(17, 17) // scaled size (required for Retina display icon)
                            );
                            var map = new google.maps.Map(document.getElementById('mymap'),
                                                          mapOptions);

                            var marker = new google.maps.Marker({
                                position: myLatlng,
                                //icon: image,
                                map: map,
                                title: "Company Name"
                            });

                            //adding info window to the marker

                            var infowindow = new google.maps.InfoWindow({
                                content: '<div class="info">Company Name</div>'
                            });

                            //adding event to the marker

                            google.maps.event.addListener(marker, 'click', function () {
                                // Calling the open method of the infoWindow 
                                infowindow.open(map, marker);
                            });
                            infoWindow = new google.maps.InfoWindow();
                            infowindow.open(map, marker);
                            google.maps.event.addListenerOnce(map, 'idle', function () {
                                google.maps.event.trigger(map, 'resize');
                                map.setCenter(myLatlng);

                            });

                        }
                        //google.maps.event.addDomListener(window, 'load', infowindow);
                        function changeMapTypeId(mapType) {
                            map.setMapTypeId(mapType);
                        }

                        function zoomInTheMap() {
                            var zoom = map.getZoom();
                            zoom = zoom + 2;
                            map.setZoom(zoom);
                        }
                    </script>
                    <h2>Send a Message</h2>
                    <div class="">

                        <?php
                        if (isset($this->request->params['pass'][0])) {
                        ?>
                        <h3 style="font-size:20px;color:green;">Your Request has been submitted. They will contact you in short.</h3>
                        <?php
                        } else {
                        ?>
                        <form id="mail_form" action="" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="fname" id="fname" placeholder="First name*" required="required" />
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="lname" id="lname" placeholder="Last name*" required="required" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="phone" id="phone" placeholder="Phone*" required="required">
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" name="email" id="email" placeholder="Email*" required="required">
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea name="message" rows="5" placeholder="Message*" id="message" required="required" style="background-color:white"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit" value="Submit" id="submitForm" class="btn btn-default btn-block">
                                    <p><img style="display:none;" alt="Sending ..." src="./img/ajax-loader.png" class="ajax-loader"></p>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-page-right">
                    <h2>Contact Us</h2>
                    <div class="company-information">
                        <a href="tel:+11111111">
                            <div class="company-information-icon">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            +11111111                        </a>
                        <a href="mailto:social@welvett.com">
                            <div class="company-information-icon">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                            social@welvett.com                       </a>
                        <a class="company-information-home">
                            <div class="company-information-icon">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </div>
                            <p>Tampa Florida&nbsp;</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
        </div>
    </div>
</header>

<div class="clearfix"></div>
