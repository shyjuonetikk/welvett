<?php

use Cake\I18n\Time;
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
        <link rel="stylesheet" href="<?php echo $this->request->webroot ?>assets/css/intlTelInput.css">
        <link href="<?php echo $this->request->webroot ?>assets/css/custom.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/responsive.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/googlefonts.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/saif.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/naqeeb.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.css" rel="stylesheet">
        <link href="<?php echo $this->request->webroot ?>assets/css/naqeeb.css" rel="stylesheet">

        <script src="<?php echo $this->request->webroot ?>assets/js/jquery.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->
        <style>
            .notify-drop-footer{
                background: #fff;
                border-top: 1px solid #ccc;
            }
        </style>
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
                            <?php if ($messageCount != 0) { ?>
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

                                            $path = $this->request->webroot . 'img/users/' . $image;
                                        } else {
                                            $path = $this->request->webroot . 'img/users/' . $path;
                                        }
                                    } else {
                                        $path = $this->request->webroot . 'img/users/' . $image;
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
                            if ($unread_notifications != 0) {
                                ?>
                                <span class="badge"><?= $unread_notifications; ?></span>
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
                                    if (!$path) {
                                        $path = $this->request->webroot . 'img/users/cyber1550500683.png';
                                    }
                                    if ($n->activity_by != $n->talent_id && $n->activity_by != $n->customer_id) {
                                        $path = $this->request->webroot . 'assets/images/logo2.png';
                                    }
                                    ?>
                                    <li>
                                        <div class="row" style="margin: 0;">

                                            <div class="col-md-2">
                                                <div class="notify-img" style="width: 30px;height:30px;">
                                                    <img src="<?php echo $path ?>" alt="" style="width:100%;">
                                                </div>
                                            </div>
                                            <div class="col-md-8" style="padding:0 0 0 5px;">
                                                <?php
                                                $read_class = '';
                                                if (!$n->is_read) {
                                                    $read_class = 'unread';
                                                }
                                                ?>
                                                <p class="<?= $read_class; ?>"><?= $n->message; ?></p>
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
                                <div class="notify-drop-footer text-center" style="position:absolute;width: 100%">
                                    <?php if ($unread_notifications == 0) { ?>
                                        <a style="color:gray !important;">Mark all as read</a>

                                    <?php } else { ?>
                                        <a onclick="read_notifications()" id="read_notification_link">Mark all as read</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </ul>  
                    </li>
                    <li class="nav-item dropdown">

                        <a href="#" data-toggle="dropdown" class="nav-link  user-action">
                            <?php
                            $image = $user->profile_image;
                            if ($user->profile_image && file_exists(WWW_ROOT . 'img/users/' . $user->profile_image)) {
                                $image = $this->request->webroot . 'img/users/' . $user->profile_image;
                            }
                            ?>
                            <img src="<?php echo $image; ?>" class="avatar" alt=""> 
                            <?php echo $user->first_name . ' ' . $user->last_name; ?> 
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
                                <li><a href="<?php echo $this->request->webroot ?>EmployeeMembers/profile" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></li>
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
        <?php echo $this->fetch('content'); ?>

        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo $this->request->webroot ?>assets/js/owl.carousel.js"></script>
        <script src="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.js"></script>
        <script>
                function show_custom_message(message) {
                    $.alert({
                        confirmButton: 'Ok',
                        title: 'Information!',
                        content: message
                    });
                }
                function read_notifications() {
                    $.ajax({
                        url: '<?php echo $this->request->webroot ?>EmployeeMembers/read_notifications',
                        type: 'POST',
                        cache: false,
                        success: function (responce) {
                            if (responce == 1) {
                                $('.fa-bell').siblings('span').remove();
                                $('.unread').attr('style', 'color:#666 !important;');
                                $('#read_notification_link').removeAttr('onclick').attr('style', 'color:gray !important;');

                            }
                        }
                    });
                }

        </script>


    </body>
</html>