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

if (isset($serviceId)) {
    $serviceId = $serviceId;
} else {
    $serviceId = '';
}
if (isset($subCatId)) {
    $subCatId = $subCatId;
} else {
    $subCatId = '';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="<?php echo $this->request->webroot; ?>img/favicon.jpg" type="image/gif" sizes="16x16"> 
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

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="<?php echo $this->request->webroot ?>assets/js/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>

        <style>
            .dynamic_cities{
                padding: 0;
                width:100%;
                margin-bottom: 0; 
            }
            .dynamic_cities li{
                padding-left:10px;
                border-bottom: 1px solid #eee;
            }
            .dynamic_cities li:hover{
                background-color: #eeeeee4d;
            }
            .search-result{
                background-color: white;
                min-height: 0;
                max-height: 200px;
                overflow: auto;
                border: 2px solid #ddd;
                border-top: none;
                position: absolute;
                z-index: 1;
                top: 41px;
                width: 94%;
            }
            .searched_user p{
                margin:0;
            }
            .searched_user{
                cursor: pointer;
            }
            .search-box{
                width: 100%;
            }
            #subt{
                border: none;
                color:gray;
                padding: 3px 8px;
                background-color: white;
                border-radius: 3px; 
            }
            .filter-icon{
                background-color: unset;
                color: white;
                padding: 0;
                border-right: none !important;
                margin-left: 10px;
            }
            .filter-icon:hover{
                color:white !important;
            }
            .search-result ul{
                margin: 0;
            }
            .unread{
                color:black !important;
            }
            .notify-drop-footer{
                background: #fff;
                border-top: 1px solid #ccc;
            }
            table.text-center{
                text-align: left !important;
                width: 95% !important;
                margin-left: 5%; 
            }
            .badge-warning{
                color: white !important;
                background-color: #f09433 !important;
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
                    <form  class="form-inline" id="simple_search"  method="POST" action="<?php echo $this->request->webroot ?>Pages/categories">

                        <input type="hidden" id="cat_id" value="<?php echo $serviceId; ?>">
                        <input type="hidden" id="sub_cat_id" value="<?php echo $subCatId; ?>">
                        <div class="form-group" style="position:relative;">
                            <input type="text" id="userResults" name="name" class="form-control searching" dynamic_val="users" placeholder="Search by name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" autocomplete="off">
                            <div class="search-result" id="search-resultusers">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="date" class="form-control datepicker" placeholder="Date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>"  required/>
                        </div>
                        <div class="form-group" style="position:relative;">
                            <div class="search-box" style="background-color: unset;">
                                <?= $this->Form->control('city', ['class' => 'form-control searching', 'label' => false, 'placeholder' => 'City', 'required', 'templates' => ['inputContainer' => '{{content}}'], 'required', 'autocomplete' => 'off']); ?>
                                <?= $this->Form->hidden('check_city'); ?>
                            </div> 
                            <div class="search-result" id="search-result">
                            </div>
                        </div> 
                        <div class="form-group" style="position:relative;">
                            <div class="search-box" style="background-color: unset;">
                                <select name="state_id" class="form-control" required="required" id="state">
                                    <option value="">- State -</option>
                                    <?php
                                    if (isset($posted_search)) {
                                        foreach ($posted_search as $srch):
                                            ?>
                                            <option value="<?= $srch['id'] ?>" <?= ($srch['id'] == $this->request->data['state_id']) ? 'selected' : ''; ?>><?= $srch['statename'] ?></option>
                                            <?php
                                        endforeach;
                                    }
                                    ?>
                                </select>
                                <?= $this->Form->hidden('check_city'); ?>
                            </div> 
                            <div class="search-result" id="search-result">
                            </div>
                        </div> 

                        <div class="form-group">
                            <?php echo $this->Form->control('category', ['empty' => 'Select Category', 'name' => 'category', 'id' => 'services', 'options' => $eventcateg, 'class' => 'form-control', 'label' => false, 'required']); ?>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="search" id='searc' class="form-control" placeholder="" />
                        </div>

                        <div class="form-group">
                            <button type='submit' id='subt' style="padding:7px 15px;"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="form-group">
                            <a href="javascript:" class="filter-icon">Advance search</a>
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
                                        <?php
                                        if ($this->request->session()->read('Auth.User.role_id') == 2) {
                                            $booking_path = 'Users/individual_events/' . $n->id . '#bookingNumber' . $n->booking_id;
                                        }
                                        if ($this->request->session()->read('Auth.User.role_id') == 3) {
                                            $booking_path = 'CorporateMembers/corporate_events/' . $n->id . '#bookingNumber' . $n->booking_id;
                                        }
                                        if ($this->request->session()->read('Auth.User.role_id') == 4) {
                                            $booking_path = 'EmployeeMembers/employee_events/' . $n->id . '#bookingNumber' . $n->booking_id;
                                        }
                                        ?>
                                        <a href="<?php echo $this->request->webroot . $booking_path; ?>" style="padding:0;">
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
                                        </a>

                                    </li>

                                <?php endforeach; ?>
                                <br/>
                                <br/>
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
                            <?php echo $row['first_name']; ?> 
                            <i class="fa fa-chevron-down" style="font-size:12px;"></i></a>
                        <ul class="dropdown-menu">
                            <?php
                            if ($roleId == 2) {
                                ?>
                                <li><a href="<?php echo $this->request->webroot ?>pages/categories" class="dropdown-item"><i class="fa fa-home"></i> Home</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>users/profile" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>users/individual-events" class="dropdown-item"><i class="fa fa-calendar"></i> My events</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>users/messages" class="dropdown-item"><i class="fa fa-envelope"></i> Messages</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>users/individualReviews" class="dropdown-item"><i class="fa fa-comments"></i> My reviews</a></li>
                            <?php } ?>
                            <?php
                            if ($roleId == 3) {
                                ?>
                                <li><a href="<?php echo $this->request->webroot ?>pages/categories" class="dropdown-item"><i class="fa fa-home"></i> Home</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>corporateMembers/profile" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>corporateMembers/corporateEvents" class="dropdown-item"><i class="fa fa-calendar"></i> My events</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>CorporateMembers/messages" class="dropdown-item"><i class="fa fa-envelope"></i> Messages</a></li>

                                <li><a href="<?php echo $this->request->webroot ?>corporateMembers/corporateReviews" class="dropdown-item"><i class="fa fa-comments"></i> My review</a></li>
                                <?php
                            }
                            if ($roleId == 4) {
                                ?>
                                <li><a href="<?php echo $this->request->webroot ?>EmployeeMembers/profile" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>EmployeeMembers/employee_events" class="dropdown-item"><i class="fa fa-calendar"></i> Bookings</a></li>
                                <li><a href="<?php echo $this->request->webroot ?>EmployeeMembers/messages" class="dropdown-item"><i class="fa fa-envelope"></i> Messages</a></li>

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
            $displayFilters = '';
            $maxpriceVal = '';
            if (isset($this->request->data['max-price']) && !empty($this->request->data['max-price'])) {
                $displayFilters = 'display:block;';
                $maxpriceVal = $this->request->data['max-price'];
            }
            if (isset($this->request->data['subcategory']) && !empty($this->request->data['subcategory'])) {
                $displayFilters = 'display:block;';
            }
            ?>
            <div class="filters" style="<?= $displayFilters; ?>">
                <div class='row'>
                    <div class='col-lg-3'>
                        <h1>Advance Search</h1>
                    </div>
                    <div class='col-lg-9'>
                        <div class="row">
                            <div class="col-lg-2">
                                <select name="subcategory" id="subservices" class="form-control" form="simple_search">
                                    <option value="">Sub Services</option>
                                </select>
                            </div>
                            <div class="col-lg-2">

                                <input type="text" name="max-price" class="form-control" placeholder="Max Price" form="simple_search" value="<?= $maxpriceVal ?>">
                            </div>
                        </div>
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
                                        <a href="<?php echo $this->request->webroot; ?>">Home</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->request->webroot; ?>Pages/about">About Us</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->request->webroot; ?>Pages/faq">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->request->webroot; ?>Pages/welvettIos">Welvett for IOS (coming soon)</a>
                                    </li>
                                    <li>
                                        <a  href="<?php echo $this->request->webroot; ?>Pages/welvettAndroid">Welvett for Android (coming soon)</a>
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
                                        <a href="<?php echo $this->request->webroot; ?>Pages/privacyPolicy">Privacy Policy</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $this->request->webroot; ?>pages/termofUse">Website Term of Use</a>
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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="<?php echo $this->request->webroot ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->request->webroot ?>assets/js/owl.carousel.js"></script>
        <script src="<?php echo $this->request->webroot ?>assets/jquery_confirm/jquery-confirm.js"></script>
        <script src="<?php echo $this->request->webroot ?>assets/js/scrollBar.js"></script>
        <script>
                $(document).ready(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                });
                function put_value(value, dynamic_val) {
                    if (typeof dynamic_val == 'undefined') {
                        dynamic_val = '';
                    }
                    if (dynamic_val == 'users') {
                        $('#userResults').val(value);
                        return false;
                    }
                    $('#city' + dynamic_val).val(value);
                    $('input[name=check_city' + dynamic_val + ']').val(1);
                    $('#search-result' + dynamic_val).hide();
                    $('#search-result' + dynamic_val).css({'border': 'none'});

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
                $(document).ready(function () {


                    $(".datepicker").datepicker();

                    var catId = $('#cat_id').val();
                    var subCatId = $('#sub_cat_id').val();

                    $("#subservices").html("<option value=''>Select Sevice</option>");

                    if (catId !== "") {
                        $.ajax({
                            url: '<?php echo $this->request->webroot ?>Pages/Subservice',
                            data: {
                                'eventcategory_id': catId
                            },
                            type: 'POST',
                            cache: false,
                            success: function (responce) {

                                if (responce !== "") {
                                    $("#subservices").html(responce);
                                    if (subCatId != '') {
                                        $("#subservices").val(subCatId);
                                    }
                                } else {
                                    $("#subservices").html("<option value=''>Select Sub Service</option>");
                                }

                            }


                        });
                    }

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

                });</script>

        <script>
            $(document).ready(function () {



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
                //                $('.searching').focusout(function () {
                $(document).on('focusout', '.searching', function () {
                    var searching = $(this);
                    var dynamic_val = searching.attr('dynamic_val');
                    if (typeof searching.attr('dynamic_val') == 'undefined') {
                        dynamic_val = '';
                    }

                    setTimeout(function () {
                        $('#search-result' + dynamic_val).hide();
                        $('#search-result' + dynamic_val).css({'border': 'none'});

                        if ($('input[name=check_city' + dynamic_val + ']').val() == 0) {
                            searching.val('');
                        } else {
                            $.ajax({
                                type: 'GET',
                                url: '<?php echo $this->request->webroot ?>Users/search_states',
                                data: 'field=' + searching.val(),
                                contentType: 'json',
                                success: function (data)
                                {
                                    data = JSON.parse(data);
                                    //alert(dynamic_val);
                                    //                                    if ($('select[name="state_id[]"]').length != 0) {
                                    $('#state' + dynamic_val).empty();
                                    $('#state' + dynamic_val).append($("<option></option>").attr("value", '').text('- State -'));
                                    $.each(data, function (key, value) {
                                        $('#state' + dynamic_val)
                                                .append($("<option></option>")
                                                        .attr("value", value.id)
                                                        .text(value.statename));
                                    });
                                    //                                    } else {
                                    //                                        $('select[name=state_id]').empty();
                                    //                                        $('select[name=state_id]').append($("<option></option>").attr("value", '').text('- State -'));
                                    //                                        $.each(data, function (key, value) {
                                    //                                            $('select[name=state_id]')
                                    //                                                    .append($("<option></option>")
                                    //                                                            .attr("value", value.id)
                                    //                                                            .text(value.statename));
                                    //                                        });
                                    //                                    }

                                }
                            });
                        }
                    }, 300);
                });
                $(document).on('keyup', '.searching', function () {
                    //                $('.searching').keyup(function () {
                    var value = $(this).val();
                    var dynamic_val = '';
                    if (typeof $(this).attr('dynamic_val') != 'undefined') {
                        dynamic_val = $(this).attr('dynamic_val');
                    }
                    $('#search-result' + dynamic_val).show();
                    $('#search-result' + dynamic_val).css({'border': '1px solid #ccc'});
                    $('input[name=check_city' + dynamic_val + ']').val(0);

                    var url = 'Users/fetch_cities';
                    if (dynamic_val == 'users') {
                        url = 'EmployeeMembers/fetch_users';
                    }
                    if (value != '')
                    {
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo $this->request->webroot ?>'+url,
                            data: 'field=' + value,
                            contentType: 'json',
                            success: function (data)
                            {
                                var data = JSON.parse(data);
                                if ($.isEmptyObject(data))
                                {

                                    var divsearch = $('#search-result' + dynamic_val).empty();
                                    var app = "<ul class='dynamic_cities'><li class='searched_user'><p>No city found</p></li></ul>"
                                    $('#search-result' + dynamic_val).append(app);

                                } else
                                {

                                    $('#search-result' + dynamic_val).empty();
                                    var icon;
                                    var loginWithSocial;
                                    var path = '';
                                    var app = "<ul class='dynamic_cities'>";
                                    $.each(data, function (key, value) {
                                        icon = value.profile_image;
                                        loginWithSocial = value.loginwithsocial;

                                        $('#search-result' + dynamic_val).empty();
                                        app += "<li class='searched_user'>"
                                                + "<p onclick='put_value(" + '"' + value + '","' + dynamic_val + '"' + ")'>" + value + "</p>"
                                                + "</li>";
                                    });
                                    app += "</ul>";

                                    $('#search-result' + dynamic_val).append(app);

                                }

                            }
                        });
                        //end
                    } else {
                        $('#search-result' + dynamic_val).hide();

                    }

                });



                $(document).on('focus', '.searching', function () {
                    var searching = $(this);
                    var dynamic_val = searching.attr('dynamic_val');
                    if (typeof dynamic_val == 'undefined') {
                        dynamic_val = '';
                    }
                    $('#search-result' + dynamic_val).show();
                    $('#search-result' + dynamic_val).css({'border': '1px solid #ccc'});

                });
            });

            //            $(document).ready(function () {
            //
            //                $('.searching').focusout(function () {
            //
            //                    var value = "null";
            //
            //
            //                    if (value != "")
            //                    {
            //                        $.ajax({
            //                            type: 'GET',
            //                            url: '<?php echo $this->request->webroot ?>Pages/searchtext',
            //                            data: 'value=' + value,
            //                            contentType: 'json',
            //                            success: function (data)
            //                            {
            //
            //
            //                                var data = JSON.parse(data);
            //
            //                                if ($.isEmptyObject(data))
            //                                {
            //
            //                                    var divsearch = $('#search-result').empty();
            //                                    var app = "<ul></ul>"
            //
            //                                    $('#search-result').append(app);
            //                                }
            //
            //
            //                            }
            //                        });
            //                        //end
            //                    }
            //
            //                });
            //            });
            //                        

        </script>

    </body>
</html>



