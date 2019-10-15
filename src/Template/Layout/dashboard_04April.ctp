<?php

use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

$userId = $this->request->session()->read('Auth.User.id');

$conn = ConnectionManager::get('default');
$query = $conn->execute("SELECT `u`.*, `r`.* FROM `users` AS `u` 
INNER JOIN `roles` AS `r` ON `u`.`role_id` = `r`.`id`
WHERE `u`.`id` = '$userId'");

$row = $query->fetch('assoc');
$roleId = $row['role_id'];
$role = $row['name'];
//$queryMembership = "SELECT COUNT(*) AS `count` FROM `memberships` WHERE `user_id` = '$userId'";
//$rowMembership = $queryMembership->fetch('assoc');
//$membership = Membership['count'];
//debug($this->request->session()->read('Auth.User.loginwithsocial'));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?></title>
        <!-- Bootstrap core CSS -->
        <link href="<?php echo $this->request->webroot ?>assets/css/bootstrap.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?php echo $this->request->webroot ?>assets/css/custom.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/responsive.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/googlefonts.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/me.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/saif.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/naqeeb.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.css" rel="stylesheet">


        <script src="<?php echo $this->request->webroot ?>assets/js/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>



    </head>
    <body> 
        <!-- ######## START OF NAVIGATION ############### -->
        <nav class="navbar navbar-default navbar-expand-xl navbar-light custom-navbar" >
            <div class="navbar-header d-flex col">
                <div class="branding">
                    <?php
                    if ($roleId == 2) {
                        ?>
                        <a class="navbar-brand" href="<?php echo $this->request->webroot; ?>pages/categories">
                            <img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive mini-logo"  />
                        </a>
                        <?php
                    } else if ($roleId == 3) {
                        ?>
                        <a class="navbar-brand" href="<?php echo $this->request->webroot; ?>pages/categories">
                            <img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive mini-logo"  />
                        </a>
                        <?php
                    } else if ($roleId == 4) {
                        if ($membership) {
                            ?>
                            <a class="navbar-brand" href="<?php echo $this->request->webroot; ?>EmployeeMembers/services">
                                <img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive mini-logo"  />
                            </a>
                            <?php
                        } else {
                            ?>
                            <a class="navbar-brand" href="<?php echo $this->request->webroot; ?>EmployeeMembers/employeeFreeevents">
                                <img src="<?php echo $this->request->webroot ?>assets/images/logo.png" class="image-responsive mini-logo"  />
                            </a>
                            <?php
                        }
                    }
                    ?>

                </div>     
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
                    <span class="navbar-toggler-icon"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse"  style="" class="collapse navbar-collapse justify-content-start">
                <?php
                if ($this->request->session()->read('Auth.User.role_id') != 4) {
                    ?>
                    <form  class="navbar-form form-inline search-form" method="POST" action="<?php echo $this->request->webroot ?>Pages/categories">

                        <div class="input-group search-box">
                            <a href="javascript:" class="filter-icon"><i class="fa fa-filter"></i></a>                     
                            <input type="text" id="search"  name='search' autocomplete="off"  class="form-control searching sear" value="<?= isset($this->request->data['search']) ? $this->request->data['search'] : ''; ?>">
                            <input type="hidden" name='category' value="<?php
                            if (isset($_GET['category_id'])) {
                                echo $_GET['category_id'];
                            }
                            ?>">
                            <span class="input-group-addon"> <button id="search" type="submit"><i class="fa fa-search"></i></button></span>

                        </div>
                        <div class="search-result" id="search-result">

                            <div class="clearfix"></div>

                        </div>
                    </form>

                    <?php
                }
                ?>
                <ul class="nav navbar-nav navbar-right ml-auto">
                    <li class="nav-item dropdown notifydd">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                            <?php
                            if ($messageCount != 0) {
                                ?>
                                <span class="badge"><?= $messageCount; ?></span>
                            <?php } ?>

                        </a>
                        <ul class="dropdown-menu notify-drop">
                            <div class="notify-drop-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">Messages</div>
                                </div>
                            </div>
                            <!-- end notify title -->
                            <!-- notify content -->
                            <div class="drop-content">
                                <?php
                                if ($roleId == 3) {
                                    $type = 'CorporateMembers';
                                } else if ($roleId == 4) {
                                    $type = 'EmployeeMembers';
                                } else if ($roleId == 2) {
                                    $type = 'Users';
                                }
                                foreach ($latest_msg as $latest):
                                    // debug($latest);
                                    $path = '';
                                    $loginWithSocial = $latest->user->loginwithsocial;
                                    $path = $latest->user->profile_image;
                                    $image = 'cyber1550500683.png';
                                    if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                        $path = $latest->user->profile_image;
                                    } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                        if ($latest->user->profile_image == '') {

                                            $path = $this->request->webroot.'img/users/' . $image;
                                        } else {
                                            $path = $this->request->webroot.'img/users/' . $path;
                                        }
                                    } else {
                                        $path = $this->request->webroot.'img/users/' . $image;
                                    }
                                    ?>
                                    <li style='padding: 5px 0 !important;'>
                                        <a href="<?php echo $this->request->webroot . $type . '/messages/' . $latest->booking->id; ?>" style="padding:0 !important;">
                                            <div class="row" style="margin:0;">
                                                <div class="col-md-3" style="padding: 5px !important;">
                                                    <div class="notify-img">
                                                        <img src="<?php echo $path ?>" alt="" style="width:100%;">
                                                    </div>
                                                </div>
                                                <div class="col-md-8" style="padding: 0 !important;">
                                                    <p>
                                                        <?php echo ucwords($latest->user->first_name . ' ' . $latest->user->last_name); ?>
                                                    </p>
                                                    <p>
                                                        <?php echo $latest->message; ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-1" style="padding: 0 !important;">
                                                    <span class="badge badge-secondary"></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                            <div class="notify-drop-footer text-center">
                                <a href="<?php echo $this->request->webroot . $type ?>/messages">View All Messages</a>
                            </div>
                        </ul>  

                    </li>
                    <li class="nav-item dropdown notifydd">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <?php
                            if (count($notifications) != 0) {
                                ?>
                                <span class="badge"><?= count($notifications); ?></span>
                            <?php } ?>
                        </a>
                        <ul class="dropdown-menu notify-drop">
                            <div class="notify-drop-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">Notifications</div>
                                </div>
                            </div>
                            <!-- end notify title -->
                            <!-- notify content -->
                            <div class="drop-content">
                                <?php
                                $index = 'talent';
//                                debug($roleId);
                                if ($roleId == 4) {
                                    $index = 'customer';
                                }
                                foreach ($notifications as $n):
                                    $path = $n->$index->profile_image;
                                    if ($n->$index->profile_image && file_exists(WWW_ROOT . 'img/users/' . $n->$index->profile_image)) {
                                        $path = $this->request->webroot . 'img/users/' . $n->$index->profile_image;
                                    }
//                                    debug($path);
                                    ?>
                                    <li>
                                        <div class="row" style="margin: 0;">

                                            <div class="col-md-2">
                                                <div class="notify-img" style="width: 30px;height:30px;">
                                                    <img src="<?php echo $path ?>" alt="" style="width:100%;">
                                                </div>
                                            </div>
                                            <div class="col-md-8" style="padding:0 0 0 5px;">
                                                <p><?= $n->message; ?></p>
                                            </div>
                                            <div class="col-md-2" style="padding:0;">
                                                <?php
                                                $start_date = new \DateTime($n->created);
                                                $since_start = $start_date->diff(new DateTime());
                                                $show_date = '';
                                                if ($since_start->y != 0) {
                                                    $show_date = $since_start->y . ' y<br>';
                                                } elseif ($since_start->m != 0) {
                                                    $show_date = $since_start->m . ' months<br>';
                                                } elseif ($since_start->d != 0) {
                                                    $show_date = $since_start->d . ' d<br>';
                                                } elseif ($since_start->h != 0) {
                                                    $show_date = $since_start->h . ' h<br>';
                                                } elseif ($since_start->i != 0) {
                                                    $show_date = $since_start->i . ' min<br>';
                                                } else {
                                                    $show_date = $since_start->s . ' sec<br>';
                                                }
                                                echo $show_date;
                                                ?>
                                            </div>
                                        </div>


                                    </li>
                                <?php endforeach; ?>
                            </div>
                        </ul>  
                    </li>
                    <li class="nav-item dropdown">

                        <a href="#" data-toggle="dropdown" class="nav-link  user-action">
                            <?php if ($this->request->session()->read('Auth.User.loginwithsocial') != 'undefined' && $this->request->session()->read('Auth.User.loginwithsocial') != "") { ?>
                                <img src="<?php echo $row['profile_image']; ?>" class="avatar" alt=""> 
                                <?php
                            } else if ($this->request->session()->read('Auth.User.loginwithsocial') == 'undefined' || $this->request->session()->read('Auth.User.loginwithsocial') == '') {
                                if ($row['profile_image'] == '') {
                                    ?>
                                    <img src="<?php echo $this->request->webroot; ?>img/users/cyber1550500683.png" class="avatar" alt=""> 

                                    <?php
                                } else {
                                    ?>
                                    <img src="<?php echo $this->request->webroot; ?>img/users/<?php echo $row['profile_image']; ?>" class="avatar" alt=""> 
                                    <?php
                                }
                            } else {
                                ?>
                                <img src="<?php echo $this->request->webroot; ?>img/users/cyber1550500683.png" class="avatar" alt="">
                            <?php } ?>
                            <?php echo $row['first_name'] . ' ' . $row['last_name']; ?> 
                            <i class="fa fa-chevron-down" style="font-size:12px;"></i></a>
                        <ul class="dropdown-menu">
                            <?php
                            if ($roleId == 2) {
                                ?>
                                <li><a href="<?php echo $this->request->webroot ?>pages/categories" class="dropdown-item"><i class="fa fa-home"></i> Home</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>users/individualEvents/edit" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>users/individual-events" class="dropdown-item"><i class="fa fa-calendar"></i> My events</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>users/individualReviews" class="dropdown-item"><i class="fa fa-comments"></i> My reviews</a></li>
                            <?php } ?>
                            <?php
                            if ($roleId == 3) {
                                ?>
                                <li><a href="<?php echo $this->request->webroot ?>pages/categories" class="dropdown-item"><i class="fa fa-home"></i> Home</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>corporateMembers/corporateEvents/edit" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>corporateMembers/corporateEvents" class="dropdown-item"><i class="fa fa-calendar"></i> My events</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>corporateMembers/corporateReviews" class="dropdown-item"><i class="fa fa-comments"></i> My review</a></li>
                                <?php
                            }
                            if ($roleId == 4) {
                                ?>
                                <li><a href="<?php echo $this->request->webroot ?>EmployeeMembers/employeeEvents/edit" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>EmployeeMembers/employee_events" class="dropdown-item"><i class="fa fa-calendar"></i> Bookings</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>EmployeeMembers/talentReviews" class="dropdown-item"><i class="fa fa-comments"></i> My reviews</a></li>
                                <?php
                                if ($membership) {
                                    ?>
                                    <li><a href="<?php echo $this->request->webroot ?>EmployeeMembers/services" class="dropdown-item"><i class="fa fa-dashboard"></i> Services</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="<?php echo $this->request->webroot ?>EmployeeMembers/employeeFreeevents" class="dropdown-item"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                    <?php
                                }
                            }
                            ?>

                            <li>
                                <a href="<?php echo $this->request->webroot . 'Users/logout'; ?>" class="dropdown-item"><i class="fa fa-search"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
        if ($this->request->session()->read('Auth.User.role_id') != 4) {
            ?>
            <div class="filters">
                <div class='row'>
                    <div class='col-lg-2'>
                        <h1>Filters <i class="fa fa-filter"></i></h1>
                    </div>
                    <div class='col-lg-10'>
                        <form  class="form-inline"  method="POST" action="<?php echo $this->request->webroot ?>Pages/categories">


                            <div class="form-group">
                                <?php echo $this->Form->control('category', ['empty' => 'Select Category', 'name' => 'category', 'id' => 'services', 'options' => $eventcateg, 'class' => 'form-control', 'label' => false]); ?>

                            </div>

                            <div class="form-group">
                                <select name="subcategory" id="subservices" class="form-control"></select>

                            </div>
                            <div class="form-group">
                                <input type="text" name="min-price" class="form-control" placeholder="Min Price" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="max-price" class="form-control" placeholder="Max Price" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="search" id='searc' class="form-control" placeholder="" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="date" class="form-control datepicker" placeholder="Date" />
                            </div>
                            <div class="form-group">
                                <button type='submit' id='subt'><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- ######## END OF NAVIGATION ############### -->
        <?php $flashRender = $this->Flash->render(); ?>
        <?php if (!empty($flashRender)) : ?>
            <script>
                $(document).ready(function () {
                    show_custom_message('<?= $flashRender; ?>');
                    if ($('.success_message').length) {
                        $('span[class=title]').css('color', 'green');
                    }
                    if ($('.error_message').length) {
                        $('span[class=title]').css('color', 'red');
                    }
                });

            </script>
        <?php endif; ?>
        <!-- Page Content -->
        <?php echo $this->fetch('content'); ?>
        <!-- End of Page Content -->


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
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li>
                                        <a href="#">About Us</a>
                                    </li>
                                    <li>
                                        <a  href="#">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="#">Welvett for IOS</a>
                                    </li>
                                    <li>
                                        <a  href="#">Welvett for Android</a>
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
                                            <a href="index.html">Contact</a>
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
                                        <a href="index.html">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="#">Website Term of Use</a>
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
                    <p style="text-align: center" class="pull-right">Developed By: <a href="http:cyberclouds.com">Cyberclouds</a></p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- End Of Footer -->

        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo $this->request->webroot ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>assets/js/owl.carousel.js"></script>
        <script src="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.js"></script>
        <script src="<?php echo $this->request->webroot ?>assets/js/scrollBar.js"></script>
        <script>

                $(document).ready(function () {

                    $('#services').change(function () {
                        var service = $(this).val();


                        $("#subservices").html("<option value=''>Select Sevice</option>");

                        if (service !== "") {
                            $.ajax({
                                url: '<?php echo $this->request->webroot ?>Pages/Subservice',
                                data: {
                                    'eventcategory_id': service
                                },
                                type: 'POST',
                                cache: false,
                                success: function (responce) {

                                    if (responce !== "") {
                                        $("#subservices").html(responce);
                                    } else {
                                        $("#subservices").html("<option value=''>Select Sub Service</option>");
                                    }

                                }


                            });
                        }
                    });

                    if ($('#conversation_height').innerHeight() > 407) {
                        var height = $('#conversation_height').innerHeight();
                        var scrollHeight = 407 * 100 / height;

                        $("#conversation_height").scrollBox();
                        $('#conversation_height').innerHeight('407px');
                        $('#conversation_height > .sb-scrollbar-container > .sb-scrollbar').css('height', scrollHeight + '%');

                    }

                    if ($('#user_list_height').innerHeight() > 390) {
                        var height = $('#user_list_height').innerHeight();
                        var scrollHeight = 390 * 100 / height;
                        $("#user_list_height").scrollBox();
                        $('#user_list_height').innerHeight('390px');
                        $('#user_list_height > .sb-scrollbar-container > .sb-scrollbar').css('height', scrollHeight + '%');
                    }
                    if ($('#category_list_height').innerHeight() > 343) {
                        var height = $('#category_list_height').innerHeight();
                        var scrollHeight = 343 * 100 / height;
                        $("#category_list_height").scrollBox();
                        $('#category_list_height').innerHeight('343px');
                        $('#category_list_height > .sb-scrollbar-container > .sb-scrollbar').css('height', scrollHeight + '%');
                    }


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

        </script>

        <script>
            $(document).ready(function () {

                $("#subt").click(function () {
                    var contents = $(".sear").val();
                    $("#searc").val(contents);



                });

                $(".filter-icon").on('click', function () {

                    $(".filters").slideToggle();
                });

            });

            function show_custom_message(message) {
                $.alert({
                    confirmButton: 'Ok',
                    title: 'Information!',
                    content: message,

                });
            }

        </script>

        <script>
            $(document).ready(function () {
                $(document).on('click', '.searched_user', function () {
                    $('input[name=search]').val($(this).children('.get_value').text());
                    $('form.search-form').submit();
                });

                $('.searching').keyup(function () {

                    var value = $('.searching').val();
                    if (value == "") {
                        value = 'null';
                    }

                    if (value != "")
                    {
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo $this->request->webroot ?>Pages/searchtext',
                            data: 'value=' + value,
                            contentType: 'json',
                            success: function (data)
                            {


                                var data = JSON.parse(data);

                                if ($.isEmptyObject(data))
                                {

                                    var divsearch = $('#search-result').empty();
                                    var app = "<ul></ul>"

                                    $('#search-result').append(app);

                                } else
                                {


                                    $('#search-result').empty();
                                    var icon;
                                    var loginWithSocial;
                                    var path = '';
                                    $.each(data, function (key, value) {
                                        icon = value.profile_image;
                                        loginWithSocial = value.loginwithsocial;

                                        $('#search-result').empty();
                                        if (loginWithSocial != 'undefined' && loginWithSocial != "") {
                                            path = icon;
                                        } else if (loginWithSocial === 'undefined' || loginWithSocial === "") {
                                            if (icon === '' || icon === null) {
                                                path = 'http://localhost/talents/talents/webroot/img/users/cyber1550500683.png';

                                            } else {
                                                path = 'http://localhost/talents/talents/webroot/img/users/"' + icon + '"';
                                            }


                                        } else {
                                            path = 'http://localhost/talents/talents/webroot/img/users/cyber1550500683.png';
                                        }


                                        var app = "<ul>"
                                                + "<li class='searched_user'>"
                                                + "<img src='" + path + "'  width='30' height: 30px class='avatar pull-left' />"
                                                + "<p class='pull-left left-10 get_value'>" + value.first_name + " " + value.last_name + "</p>"
                                                + "<img src='<?php echo $this->request->webroot ?>img/event/" + value.image_icon + "' width='30' class='pull-right icon-image' />"
                                                + "<div class='clearfix'></div>"
                                                + "</li>"
                                                + "<li class='text-center viewmore-list'><a href='<?php echo $this->request->webroot ?>Pages/categories?text=" + value.first_name + "" + value.last_name + "' class='color-black'>See all results for " + value.first_name + " " + value.last_name + "</a></li>"
                                                + "</ul>"
                                                + "<div class='clearfix'></div>"
                                                + "</div>";
                                        $('#search-result').append(app);


                                    });
                                }

                            }
                        });
                        //end
                    }

                });
                $('.searching').focus(function () {

                    var value = $('.searching').val();
                    if (value == "") {
                        value = 'null';
                    }

                    if (value != "")
                    {
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo $this->request->webroot ?>Pages/searchtext',
                            data: 'value=' + value,
                            contentType: 'json',
                            success: function (data)
                            {


                                var data = JSON.parse(data);

                                if ($.isEmptyObject(data))
                                {

                                    var divsearch = $('#search-result').empty();
                                    var app = "<ul></ul>"

                                    $('#search-result').append(app);
                                } else
                                {
                                    $('#search-result').empty();
                                    var icon;
                                    var loginWithSocial;
                                    var path = '';
                                    $.each(data, function (key, value) {
                                        icon = value.profile_image;
                                        loginWithSocial = value.loginwithsocial;

                                        $('#search-result').empty();
                                        if (loginWithSocial != 'undefined' && loginWithSocial != "") {
                                            path = icon;
                                        } else if (loginWithSocial === 'undefined' || loginWithSocial === "") {
                                            if (icon === '' || icon === null) {
                                                path = 'http://localhost/talents/talents/webroot/img/users/cyber1550500683.png';

                                            } else {
                                                path = 'http://localhost/talents/talents/webroot/img/users/"' + icon + '"';
                                            }


                                        } else {
                                            path = 'http://localhost/talents/talents/webroot/img/users/cyber1550500683.png';
                                        }

                                        var app = "<ul>"
                                                + "<li class='searched_user'>"
                                                + "<img src='" + path + "'  width='30' height: 30px class='avatar pull-left' />"
                                                + "<p class='pull-left left-10 get_value'>" + value.first_name + " " + value.last_name + "</p>"
                                                + "<img src='<?php echo $this->request->webroot ?>img/event/" + value.image_icon + "' width='30' class='pull-right icon-image' />"
                                                + "<div class='clearfix'></div>"
                                                + "</li>"
                                                + "<li class='text-center viewmore-list'><a href='<?php echo $this->request->webroot ?>Pages/categories?text=" + value.first_name + "" + value.last_name + "' class='color-black'>See all results for " + value.first_name + " " + value.last_name + "</a></li>"
                                                + "</ul>"
                                                + "<div class='clearfix'></div>"
                                                + "</div>";
                                        $('#search-result').append(app);


                                    });
                                }

                            }
                        });
                        //end
                    }

                });
            });

            $(document).ready(function () {

                $('.searching').focusout(function () {

                    var value = "null";


                    if (value != "")
                    {
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo $this->request->webroot ?>Pages/searchtext',
                            data: 'value=' + value,
                            contentType: 'json',
                            success: function (data)
                            {


                                var data = JSON.parse(data);

                                if ($.isEmptyObject(data))
                                {

                                    var divsearch = $('#search-result').empty();
                                    var app = "<ul></ul>"

                                    $('#search-result').append(app);
                                }


                            }
                        });
                        //end
                    }

                });
            });
        </script>

    </body>
</html>



