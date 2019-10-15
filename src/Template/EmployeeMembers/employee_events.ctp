<script src="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.css">
<?php

use Cake\I18n\Time;

$loginWithSocial = $this->request->session()->read('Auth.User.loginwithsocial');

$url = $_SERVER['REQUEST_URI'];
$urlArray = explode('/', $url);
$lastIndex = end($urlArray);
if ($lastIndex == 'edit') {
    $isEdit = 1;
} else {
    $isEdit = 0;
}
?><style>
    .booking_details tr th{
        font-size: 12px;
        font-weight: bold;
        color: black;

    }
    .booking_details tr td{
        font-size: 12px;
        font-weight: bold;
        padding-right: 10px;
    }
    .edit_profile {
        bottom: 56px;
        right: 55px;
    }
    .circle-chart {
        width: 35% !important;
        height: 85px !important;
    }
    .circle-chart__percent{
        display:none !important;
    }
    .circle-chart__subline {
        font-size: 9px !important;
        word-spacing: 9999999px;
    }
    .warning-stroke{
        stroke:#FFC502 !important;
    }
    .success-stroke{
        stroke:#FFC502 !important;

    }
    .image_icon_div{
        width: 25px;
        display: inline-block;
        background-color: white;
        margin-right: 10px;
    }
    .image_icon_div img{
        width: 100%;

    }
    .discuss_button:hover{
        color:white !important;
    }
    .discuss_button:active,.discuss_button:focus{
        background: #711A2A !important;
    }
</style>

<link rel="stylesheet" href="<?php echo $this->request->webroot; ?>rating/jquery.rateyo.min.css"/>
<link rel="stylesheet" href="<?php echo $this->request->webroot; ?>progress/progresscircle.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<section class="content-wrapper header_bg talent_end">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="row" style="padding-top:25px;">
                    <?php
                    foreach ($user->talent_events as $img) {
                        ?>
                        <div class="col-md-2">
                            <img src="<?php echo $this->request->webroot . 'img/event/' . $img->eventcategory->image_icon; ?>" style="width: 40px;">
                        </div>
                    <?php } ?>
                </div>
                <div class="clearfix">&nbsp;</div>
            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <?php
                $c_image = 'cyber1550500683.png';
                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {
                    ?>
                    <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $user['profile_image']; ?>'); position: relative;">

                        <?php
                        if ($isEdit == 1) {
                            echo '<i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>';
                        }
                        ?>
                        <img class="blue_tick" src="<?php echo $this->request->webroot; ?>img/blue_tick.png" alt="">
                    </div>
                    <?php
                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                    if ($user['profile_image'] == '') {
                        ?>
                        <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>'); position: relative;">

                            <?php
                            if ($isEdit == 1) {
                                echo '<i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>';
                            }
                            ?>
                            <img class="blue_tick" src="<?php echo $this->request->webroot; ?>img/blue_tick.png" alt="">
                        </div>

                        <?php
                    } else {
                        ?>
                        <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $user['profile_image']; ?>'); position: relative;">

                            <?php
                            if ($isEdit == 1) {
                                echo '<i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>';
                            }
                            ?>
                            <img class="blue_tick" src="<?php echo $this->request->webroot; ?>img/blue_tick.png" alt="">
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>'); position: relative;">

                        <?php
                        if ($isEdit == 1) {
                            echo '<i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>';
                        }
                        ?>
                        <img class="blue_tick" src="<?php echo $this->request->webroot; ?>img/blue_tick.png" alt="">
                    </div>
                <?php }
                ?>

                <div>
                    <!--<img class="profile_image" src="" alt="">-->
                    <span class="white_color"><strong><?= ucfirst($user->first_name); ?></strong></span>


                </div>
            </div>
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="pos_absolute review_btn_parent" style="right: 10%;top:0;">
                    <?php
                    if ($membership) {
                        ?>
                        <a style="display:block" href="<?php echo $this->request->webroot; ?>EmployeeMembers/services" class="review_link">
                            <button class="review_button">

                                <i class="fa fa-briefcase"></i>
                            </button>
                            <span class="white_color">My Services</span>
                        </a>
                    <?php } else { ?>
                        <a style="display:block" href="<?php echo $this->request->webroot; ?>EmployeeMembers/employeeFreeevents" class="review_link">
                            <button class="review_button">

                                <i class="fa fa-tachometer"></i>
                            </button>
                            <span class="white_color">My Dashboard</span>
                        </a>

                    <?php } ?>
                    <a href="<?php echo $this->request->webroot; ?>employeeMembers/talentReviews" class="review_link">
                        <button class="review_button">

                            <i class="fa fa-star"></i>
                        </button>
                        <span class="white_color">My Reviews</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<section class="content-wrapper content_bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class=""><a class="black-text" href="<?= $this->request->webroot; ?>EmployeeMembers/services">Home</a><i class="" aria-hidden="true"> > &nbsp;</i></li>
                        <li class="active">My Bookings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4 border_right" style="padding-bottom: 20px;">
                <div class="text-center" id="basic_info">
                    <form id="dashboard_service">
                        <div>
                            <h6><i class="fa fa-users"></i> Info</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 text-right">

                                <span style="position: relative;">
                                    <?php
                                    if ($isEdit == 1) {
                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                    }
                                    ?>
                                    First Name
                                </span>
                            </div>
                            <div class="col-md-6 col-lg-6 text-left">

                                <input id="first_name" name="first_name" type="text" class="" readonly value="<?= $user->first_name ?>" >
                            </div>
                            <div class="col-md-6 col-lg-6 text-right">
                                <span style="position: relative;">
                                    <?php
                                    if ($isEdit == 1) {
                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                    }
                                    ?>
                                    Last Name
                                </span>
                            </div>
                            <div class="col-md-6 col-lg-6 text-left">
                                <input id="last_name" name="last_name" type="text" class="" readonly value="<?= $user->last_name ?>">
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div>
                            <h6><i class="fa fa-user"></i> Account Settings</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 text-right">
                                <span style="position: relative;">
                                    <?php
                                    if ($isEdit == 1) {
                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                    }
                                    ?>
                                    Email
                                </span>
                            </div>
                            <div class="col-md-6 col-lg-6 text-left">
                                <input id="email" name="email" type="text" class="" readonly value="<?php echo $user->email; ?>">
                            </div>


                            <div class="col-md-6 col-lg-6 text-right">
                                <span style="position: relative;">
                                    <?php
                                    if ($isEdit == 1) {
                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                    }
                                    ?>
                                    Phone Number</span>
                            </div>
                            <div class="col-md-6 col-lg-6 text-left">
                                <input type="text" id="phone1" name="phone" class="" readonly value="<?= $user->phone1 ?>">
                            </div>

                            <div class="col-md-6 col-lg-6 text-right">
                                <span style="position: relative;">
                                    <?php
                                    if ($isEdit == 1) {
                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                    }
                                    ?>Description</span>
                            </div>
                            <div class="col-md-6 col-lg-6 text-left">
                                <textarea id="description" readonly name="description" id="" rows="3" ><?= $user->employee_member->description ?></textarea>
                            </div>
                        </div>
                        <?php
                        if ($user->memberships == null) {
                            ?>
                            <div class="clearfix">&nbsp;</div>
                            <div>
                                <h6><i class="fa fa-cog"></i> Service</h6>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 text-right">

                                    <span style="position: relative;">
                                        <?php
                                        if ($isEdit == 1) {
                                            echo '<i class="fa fa-pencil edit_service"></i>';
                                        }
                                        ?>
                                        Service
                                    </span>
                                </div>
                                <div class="col-md-6 col-lg-6 text-left">
                                    <input type="hidden" name="service_id" value="<?= $user->talent_events[0]->id ?>">
                                    <?php
                                    echo $this->Form->input('event_categories', array('options' => $services, 'empty' => 'Select Service', 'div' => false, 'label' => false, 'class' => 'form-control', 'id' => 'service', 'disabled', 'style' => 'height: 30px;'));
                                    ?>

                                    <input id="selected_service" type="text" readonly value="<?php echo $user->employee_member->eventcategory->title; ?>">

                                </div>

                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <div class="row" id="sub_services" style="font-size: 12px;">
                                <?php
                                $checkedArray = array();
                                foreach ($user->talent_event_subcategories as $tService) {
                                    $checkedArray[] = $tService->eventsubcategory_id;
                                }

                                foreach ($user->employee_member->eventcategory->eventsubcategories as $subService) {
                                    if (in_array($subService->id, $checkedArray)) {
                                        $checked = 'checked';
                                    } else {
                                        $checked = '';
                                    }

                                    echo '<div class="col-md-6 col-lg-6">
                            <label for="sub_serive_' . $subService->id . '">
                                <input name="sub_categories[]" disabled type="checkbox" id="sub_serive_' . $subService->id . '" value="' . $subService->id . '" ' . $checked . '>
                                ' . $subService->title . '
                            </label>

                        </div>';
                                }
                                ?>
                            </div>

                        <?php } ?>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row user_profile_info">
                            <div class="col-md-6 col-lg-6" style="text-align:right;">
                                <span style="position: relative;">
                                    Social media
                                </span>
                            </div>
                            <div class="col-md-6 col-lg-6 text-left">
                                <?php
                                if ($user->howtologin == 'login with google') {
                                    ?>
                                    <span class="fa fa-google-plus-square" style="font-size:24px;border-bottom: none !important;"></span>
                                <?php } ?>
                                <?php
                                if ($user->howtologin == 'login with twitter') {
                                    ?>
                                    <span class="fa fa-twitter twitter" style="font-size:24px;border-bottom: none !important;"></span>
                                <?php } ?>
                                <?php
                                if ($user->howtologin == 'login with instagram') {
                                    ?>
                                    <span class="fa fa-instagram" style="font-size:24px;border-bottom: none !important;"></span>
                                <?php } ?>
                                <?php
                                if ($user->howtologin == 'login with facebook done') {
                                    ?>
                                    <span class="fa fa-facebook" style="font-size:24px;border-bottom: none !important;"></span>
                                <?php } ?>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 text-right" style="margin-bottom:8px;">    
                                <button type="button" id="submit_dashboard_service" style="display: none; border:none; color:#fff; background:#802335; border-radius: 3px; font-size: 12px; padding: 2px 15px;cursor: pointer;">Save</button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8 col-lg-8 col-xl-8">
                <div id="my_events">
                    <div>
                        <div>
                            <h4 class="text-center" style="margin-bottom: 1rem;"><i class="fa fa-calendar"></i> My Bookings</h4>
                        </div>
                        <?php echo $this->element('inc/tabs'); ?>
                        <?php
                        if (count($bookings) > 0) {
                            foreach ($bookings as $booking):
                                //                            debug($booking);

                                $rating = 0;
                                if (!empty($booking->customer_rating)) {
                                    $rating = (100 * $booking->customer_rating->rate) / 5;
                                }


                                $path = '';
                                $loginWithSocial = $booking->customer->loginwithsocial;
                                $path = $booking->customer->profile_image;
                                $image = 'cyber1550500683.png';
                                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                    $path = $booking->customer->profile_image;
                                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                    if ($booking->customer->profile_image == '') {

                                        $path = $this->request->webroot . 'img/users/' . $image;
                                    } else {
                                        $path = $this->request->webroot . 'img/users/' . $path;
                                    }
                                } else {
                                    $path = $this->request->webroot . 'img/users/' . $image;
                                }
                                ?>
                                <div class="row" id="bookingNumber<?= $booking->id; ?>" >
                                    <div class="col-lg-7">
                                        <div style="width: 80px;float: left;margin-right: 15px;">
                                            <?php
                                            if ($booking->status == 0) {
                                                $fetchWhat = 'reviews';
                                            } else {
                                                $fetchWhat = 'details';
                                            }
                                            ?>
                                            <a onclick="displayReviews(<?php echo $booking->customer->id . ",'" . $fetchWhat . "'"; ?>)">

                                                <div class="event_image" style="width:80px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>'); position: relative;">
                                                    <img class="blue_tick" src="<?php echo $this->request->webroot; ?>img/blue_tick.png" alt="">
                                                </div>
                                            </a>
                                            <div>
                                                <strong><?php echo ucwords($booking->customer->first_name . ' ' . $booking->customer->last_name); ?></strong>
                                            </div>
                                        </div>
                                        <?php if ($booking->status == 2) { ?>
                                            <div class="col-md-12">
                                                <span style="font-size: 12px;font-weight: bold;color: black;">
                                                    Email:
                                                </span>
                                                <a href="mailto:<?php echo $booking->customer->email; ?>" style="color:#511723;"><?php echo $booking->customer->email; ?></a>
                                            </div>
                                            <div class="col-md-12">
                                                <span style="font-size: 12px;font-weight: bold;color: black;">
                                                    Phone No:
                                                </span>
                                                <a href="tel:<?php echo $booking->customer->phone1; ?>" style="color:#511723;"><?php echo $booking->customer->phone1; ?></a>
                                            </div>
                                        <?php } ?>
                                        <div>
                                            <span style="font-size: 12px;font-weight: bold;color: black;">
                                                Booking Title:
                                            </span>
                                            <strong><?php echo ucwords($booking->title); ?></strong>
                                            <span class="pull-right">
                                                <?php
                                                $time = new Time($booking->created);
                                                $result = $time->timeAgoInWords([
                                                    'accuracy' => 'hour'
                                                ]);
                                                echo $result;
                                                ?>
                                            </span>
                                        </div>

                                        <div id="event_booking_table">
                                            <table class="booking_details">
                                                <tr>
                                                    <th>From date</th>
                                                    <th>To date</th>
                                                    <th>Time</th>
                                                    <th>City</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php echo date('M d, Y', strtotime($booking->from_date)) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo date('M d, Y', strtotime($booking->to_date)) ?>

                                                    </td>
                                                    <td>
                                                        <?php echo date('h:i a', strtotime($booking->hour)); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $booking->city ?>
                                                    </td>

                                                </tr>
                                            </table>
                                        </div>
                                        <button class="event_button pull-right" onclick="show_detail(<?= $booking->id; ?>)" style="margin:0 5px;cursor: pointer;" data-toggle='tooltip' title="View booking"><i class="fa fa-eye"></i></button>

                                        <?php
                                        if ($booking->status == 2) {

                                            if ($booking->payment->talent_issues) {
                                                $dispLabel = 'Dispute in progress';
                                                $disputeBadge = 'badge badge-warning';

                                                if ($booking->payment->dispute_resolved) {
                                                    $dispLabel = 'Dispute Resolved';
                                                    $disputeBadge = 'badge badge-success';
                                                }
                                                ?>
                                                <span class="pull-right <?= $disputeBadge; ?>" onclick="bothDisputes(<?= $booking->payment->id ?>)" style="cursor: pointer;margin:0 5px;padding: 7px 5px;"><?= $dispLabel; ?></span>
                                                <?php
                                            } else {
                                                ?>
                                                <button id="dispute<?= $booking->payment->id; ?>" onclick="dispute(<?= $booking->payment->id ?>)" class="event_button pull-right" data-toggle="tooltip" title="Dispute" style="margin:0 5px;cursor:pointer;">Dispute</button>
                                                <?php
                                            }

                                            if ($booking->payment->is_requested) {
                                                if (!$booking->payment->status) {
                                                    ?>
                                                    <span class="event_button pull-right" data-toggle="tooltip" title="Requested for payment" style="margin:0 5px;cursor: pointer;background: gray"><i class="fa fa-money"></i></span>
                                                    <?php
                                                } else {
                                                    $pLabel = 'Payment Released';
                                                    $badge = 'success';
                                                    if ($booking->payment->dispute_resolved && $booking->payment->status == 2) {
                                                        $pLabel = 'Payment Refunded';
                                                        $badge = 'danger';
                                                    }
                                                    ?>
                                                    <span class="pull-right badge badge-<?= $badge; ?>" style="margin:0 5px;padding: 7px 5px;"><?= $pLabel ?></span>

                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <button id="request<?= $booking->payment->id; ?>" onclick="requestPayment(<?= $booking->payment->id ?>)" class="event_button pull-right" data-toggle="tooltip" title="Request payment" style="margin:0 5px;cursor: pointer;"><i class="fa fa-money"></i></button>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <a href="<?php echo $this->request->webroot . 'EmployeeMembers/messages/' . $booking->id ?>"  data-toggle="tooltip" title="Discuss" class="event_button pull-right discuss_button" style="margin:0 5px;cursor: pointer;"><i class="fa fa-comments"></i></a>

                                        <?php
                                        //                                    $booking->status=1;
                                        if ($booking->status == 1) {
                                            $status = 'Declined';
                                            $class = 'badge-danger';
                                        } elseif ($booking->status == 2) {
                                            $status = 'Accepted';
                                            $class = 'badge-success';
                                        } elseif ($booking->status == 0) {
                                            $status = 'Waiting for Acceptance';
                                            $class = 'badge-secondary';
                                        } else {
                                            $status = 'Discussion';
                                            $class = 'badge-info';
                                        }
                                        ?>
                                        <div class="image_icon_div">
                                            <img data-toggle="tooltip" title="<?php echo $booking->talent_event->eventcategory->title ?>" src="<?php echo $this->request->webroot . 'img/event/' . $booking->talent_event->eventcategory->image_icon; ?>">
                                        </div>
                                        <span class="badge <?php echo $class; ?>" style="margin-right: 20px;"><?php echo $status; ?></span> 


                                    </div>
                                    <?php
                                    if (isset($booking->payment->status) && $booking->payment->status) {
                                        if (!empty($booking->customer_rating)) {
                                            ?>
                                            <div class="col-sm-6 col-lg-2 circlechart" data-percentage="<?php echo $rating; ?>" style="text-align:center;cursor: pointer;">
                                                <div>
                                                    <?php echo!empty($booking->customer_rating) ? $booking->customer_rating->rate : 0; ?>
                                                </div>
                                            </div>
                                        <?php } else { ?>

                                            <div class="col-sm-6 col-lg-2" style="text-align:center;" id="rate_button<?= $booking->id; ?>">
                                                <?php if ($booking->status == 2 || $booking->status == 1) { ?>
                                                    <button id="rating_div<?= $booking->id; ?>" onclick="rating_modal(<?php echo $booking->id; ?>)" class="event_button" style="margin-top: 30px;cursor: pointer;" data-toggle="tooltip" title="Rate user"><i class="fa fa-star" style="font-size: 18px;"></i></button> 
                                                <?php } ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="col-sm-6 col-lg-3">
                                        <?php
                                        if (isset($booking->payment->status) && $booking->payment->status) {
                                            ?>
                                            <?php
                                            if (empty($booking->customer_review)) {
                                                ?>
                                                <form id="review<?= $booking->id; ?>" onsubmit="return submit_review(<?= $booking->id; ?>)">
                                                    <input type="hidden" name="booking_id" value="<?= $booking->id; ?>">
                                                    <textarea  rows="2" name="review" placeholder="Additional Comments." style="font-size: 12px;margin-top: 5px" required></textarea>
                                                    <button type="submit" class="event_button pull-right" style="padding: 2px 10px;">Submit Review</button>
                                                </form>
                                            <?php } else { ?>
                                                <div style="text-align: center;">
                                                    <span class="fa fa-check-circle" style="font-size: 34px;display:block;"></span>
                                                    <span style="font-size: 15px;display:block;margin-top: 0;">Thank You</span>
                                                    <span style="font-size: 13px;display:block;margin-top: 0;">Your submission has been received.  </span>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr>
                                <?php
                            endforeach;
                        } else {
                            ?>
                            <h6 class="text-center">No booking found</h6>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                        <h5 class="modal-title">Change Image</h5>
                    </div>
                    <?php echo $this->Form->create('message_edit_form', array('id' => 'edit_image', 'type' => 'file')); ?>

                    <div class="modal-body">
                        <div class="row">
                            <label for="message" class="col-md-3 control-label">Select Image</label>
                            <div class="col-md-9">
                                <?php echo $this->Form->control('image', array('id' => 'sectionImage', 'type' => 'file', 'div' => false, 'label' => false, 'required', 'style' => 'border-bottom:unset !important;', 'onchange' => "readURL(this)")); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <img id="show_section_uploaded_image" width="200" src=""  class="section-up-image" alt=""/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align:right">
                        <?php
                        echo $this->Form->button('Update Image', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-default btn-sm', 'id' => 'register'));
                        ?>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <div class="modal fade" id="summary_modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #F5F5F5 !important;">
                    <div class="modal-header" style="display:block !important;padding: 0 10px;border-bottom: none;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="dynamic_content">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="booking_modal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                        <h5 class="modal-title">Ratings</h5>
                    </div>
                    <?php echo $this->Form->create('ratings', ['id' => 'ratings']); ?>
                    <div class="modal-body">
                        <input type="hidden" name="booking_id" value="">
                        <input type="hidden" name="review" value="">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="rateYo"></div>
                            </div>
                            <div class="col-md-3" >
                                <p id="show_rating" style="height:20px;margin-bottom: 0.5rem;text-align: center;color:#808080;font-weight: bold;"></p>
                                <button id="submit_rating" type="button" class="event_button" style="padding: 5px 10px !important;cursor: pointer;">Submit rating </button>
                            </div>

                        </div>

                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <div class="modal fade" id="disputeReason" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content" style="background-color: #F5F5F5 !important;">
                    <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                        <h5 class="modal-title">Talent Dispute</h5>
                    </div>
                    <div class="modal-body">
                        <form id="customer_issue_form" method="post" action="<?= $this->request->webroot . 'EmployeeMembers/saveTalentDispute'; ?>">
                            <div class="row" id="opponentDispute">

                            </div>
                            <div class="row">
                                <label class="col-md-12" for="talent_issue">Write down the reason for disputing</label>

                                <div class="col-md-12">
                                    <input type="hidden" name="payment_id">
                                    <textarea name="customer_issue" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align:right">
                                    <button type="submit" class="event_button" style="padding: 5px 10px !important;cursor: pointer;">Submit Dispute</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="getBothDisputes" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content" style="background-color: #F5F5F5 !important;">
                    <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                        <h5 class="modal-title">Dispute</h5>
                    </div>
                    <!--                    <div class="modal-header" style="display:block !important;padding: 0 10px;border-bottom: none;">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>-->
                    <div class="modal-body">
                        <form id="customer_issue_form" method="post" action="<?= $this->request->webroot . 'EmployeeMembers/saveDispute'; ?>">

                            <div id="opponentBothDispute">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="displayReviews" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="" style="margin-bottom: 10px;padding:10px;background-color: #7B1B2D;color: white;">
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                    </div>
                    <div class="modal-body" id="injectReviews" style="padding: 0 10px;">

                    </div>
                    <div class="modal-footer" style="border-top: none;padding:10px; text-align:right">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<script type="text/javascript" src="./jquery.min.js"></script>-->
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>rating/jquery.rateyo.js"></script>
<script src="<?php echo $this->request->webroot; ?>progress/progresscircle.js"></script>
<script>
                                    $('.circlechart').circlechart(); // Initialization
</script>
<script>
    function displayReviews(id, fetchWhat) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'EmployeeMembers/getCustomerReviews' ?>',
            data: 'id=' + id + '&fetchWhat=' + fetchWhat,
            contentType: 'json',
            success: function (data)
            {
                $('#injectReviews').html(data);
                $('#displayReviews').modal('show');
            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });

    }
    function dispute(payment_id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'EmployeeMembers/getDisputes' ?>',
            data: 'payment_id=' + payment_id + '&get_field=customer_issues',
            contentType: 'json',
            success: function (data)
            {
                if (data != '') {
                    $('#opponentDispute').html('<label class="col-md-12">Customer Disputed</label><div class="col-md-12"><p class="custom_field">' + data + '</p></div>')
                }
                $('#customer_issue_form input[name=payment_id]').val(payment_id);
                $('#disputeReason').modal('show');
            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }
    function bothDisputes(payment_id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'EmployeeMembers/getBothDisputes' ?>',
            data: 'payment_id=' + payment_id,
            contentType: 'json',
            success: function (data)
            {
                data = JSON.parse(data);
                console.log(data.talent);
                $('#opponentBothDispute').empty();
                if (data.admin) {
                    $('#opponentBothDispute').append('<div class="row"><label class="col-md-12">Admin</label><div class="col-md-12"><p class="custom_field">' + data.admin + '</p></div></div>')
                }
                if (data.customer) {
                    $('#opponentBothDispute').append('<div class="row"><label class="col-md-12">Customer Dispute</label><div class="col-md-12"><p class="custom_field">' + data.customer + '</p></div></div>')
                }
                if (data.talent) {
                    $('#opponentBothDispute').append('<div class="row"><label class="col-md-12">Your Disputed</label><div class="col-md-12"><p class="custom_field">' + data.talent + '</p></div></div>')
                }
                $('#customer_issue_form input[name=payment_id]').val(payment_id);
                $('#getBothDisputes').modal('show');
            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }

    function requestPayment(payment_id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'EmployeeMembers/request_payment' ?>',
            data: 'payment_id=' + payment_id,
            contentType: 'json',
            success: function (data)
            {
                if (data == 1) {
                    $('#request' + payment_id).tooltip('hide');
                    $('#request' + payment_id).replaceWith('<span class="event_button pull-right" data-toggle="tooltip" title="Requested for payment" style="margin:0 5px;background: gray"><i class="fa fa-money"></i></span>');
                } else {
                    show_custom_message('request can not be forworded');
                }

            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }
    function rating_modal(b_id) {
        var current_rating = $('#rating_div' + b_id).attr('rating');
        $('input[name=booking_id]').val(b_id);
        var $rateYo = $(".rateYo").rateYo({
            rating: current_rating,
            starWidth: "64px",
            fullStar: true
        });
        /* set the option `onChange` */
        $rateYo.rateYo("option", "onChange", function (rating, rateYoInstance) {
            $('#show_rating').text(rating);
            /* get the rated fill at the current point of time */
            var ratedFill = $rateYo.rateYo("option", "ratedFill");
            console.log("The color of rating is " + ratedFill);
        });
        $rateYo.rateYo("option", "onSet", function (rating, rateYoInstance) {
            $('#ratings input[name=review]').val(rating);

        });
        /* set the option `multiColor` to show Multi Color Rating */
        $rateYo.rateYo("option", "multiColor", true);
        $('#booking_modal').modal('show');
    }

</script>
<script>
    function submit_review(review) {
        if ($('#rating_div' + review).length == 1) {
            rating_modal(review);
        } else {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot . 'EmployeeMembers/add_review' ?>',
                data: $('#review' + review).serialize() + '&event_id=' + review,
                contentType: 'json',
                success: function (data)
                {
                    $('#review' + review).parent().html(data);
                    //                data = JSON.parse(data);
                    console.log(data);

                }, error: function (error) {
                    // alert(JSON.stringify(error));
                }
            });
        }
        return false;

    }
</script>

<script>
    function readURL(input, showId = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.files[0]);   
            reader.onload = function (e) {
                if (input.id == "sectionImage") {
                    $('#show_section_uploaded_image').attr('src', e.target.result);
                }
            };
            reader.readAsDataURL(input.files[0]);
    }
    }
    function show_detail(booking) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot ?>EmployeeMembers/show_booking',
            data: 'booking_id=' + booking,
            success: function (data)
            {
                $('#dynamic_content').html(data);
                $('#summary_modal').modal('show');
            }
        });

    }
    $(document).ready(function (e) {
        $('.edit_service, .edit_info').click(function () {
            $('#submit_dashboard_service').show();
        });
        $('#submit_rating').click(function () {
            if (!$('#ratings input[name=review]').val()) {
                show_custom_message('Please select a review');
                return false;
            }
            var review = $('input[name=booking_id]').val();
            if ($('#review' + review + ' textarea[name="review"]').val() != '') {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot . 'EmployeeMembers/add_review' ?>',
                    data: $('#review' + review).serialize() + '&event_id=' + review,
                    contentType: 'json',
                    success: function (data)
                    {
                        $('#review' + review).parent().html(data);
                        //                data = JSON.parse(data);
                        console.log(data);

                    }, error: function (error) {
                        // alert(JSON.stringify(error));
                    }
                });
            }

            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot . 'EmployeeMembers/ratings' ?>',
                data: $('#ratings').serialize(),
                contentType: 'json',
                success: function (data)
                {
                    var rating = $('#ratings input[name=review]').val();
                    var b_id = $('#ratings input[name=booking_id]').val();
                    data = JSON.parse(data);
                    if (data.flag == 1) {
                        var calculate_percentage = (100 * rating) / 5;
                        var change_class = 'success-stroke';
                        if (rating <= 1.5) {
                            var change_class = 'warning-stroke';
                        }
                        var insert_html = '<div class="col-md-2 circlechart" data-percentage="' + calculate_percentage + '" style="text-align:center;cursor: pointer;"><svg class="circle-chart" viewBox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg"><circle class="circle-chart__background" cx="16.9" cy="16.9" r="15.9"></circle><circle class="circle-chart__circle ' + change_class + '" stroke-dasharray="' + calculate_percentage + ',100" cx="16.9" cy="16.9" r="15.9"></circle><g class="circle-chart__info"><text class="circle-chart__percent" x="17.9" y="15.5">' + calculate_percentage + '%</text><text class="circle-chart__subline" x="16.91549431" y="22">' + rating + '</text> </g></svg></div>'
                        $('#rate_button' + b_id).replaceWith(insert_html);
                        $('#booking_modal').modal('hide');
                        show_custom_message(data.message);
                    } else {
                        $('#booking_modal').modal('hide');
                        show_custom_message(data.message);

                    }

                }, error: function (error) {
                    // alert(JSON.stringify(error));
                }
            });


        });

        $("#edit_image").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo $this->request->webroot . 'CorporateMembers/editImage' ?>",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    data = JSON.parse(data);
                    if (data[0] == 'success') {
                        $('#profile_image_div').css('background-image', "url('" + data[1] + "')");
                        $('#myModal').modal('hide');
                        show_custom_message('Profile image changed.');
                    } else {

                    }
                },
                error: function (e)
                {

                }
            });
            return false;
        }));

        $('.edit_info').click(function () {

            $('#basic_info input, #basic_info select, #basic_info textarea').attr('readonly', false);

            $('#basic_info input').css({
                "background-color": "#fff",
                "height": "20px",
                "color": "#a7a7a7"

            });

            var reference = $(this).parent().parent().next().children();
            $(reference).attr('readonly', false);
            var field = $(reference).attr('id');
            $(reference).focus();
            $('#description').css({
                "background-color": "#fff",
                "outline": "1px solid #ccc",
                'min-height': '100px',
                'padding': '3px',
                'margin-bottom': '5px'
            });


            $('#basic_info input:not(:checkbox), #basic_info select').css({
                "background-color": "#fff",
                "outline": "1px solid #ccc",
                'height': '20px',
                'padding': '0px 10px'
            });

            var selectedService = '<?php echo $user->employee_member->eventcategory_id; ?>';
            $('#selected_service').hide();
            $('#service').show();
            $('#service').val(selectedService);
            $('#service').removeAttr('disabled', 'disabled');
            $('#sub_services input[type="checkbox"]').removeAttr('disabled', 'disabled');

            //            if (field != 'description') {
            //                $(reference).css({
            //                    "background-color": "#fff",
            //                    "height": "20px",
            //                    "color": "#5E5E5E"
            //
            //                });
            //            } else {
            //                $(reference).css({
            //                    "background-color": "#fff",
            //                    "color": "#5E5E5E"
            //
            //                });
            //            }
        });

        $('#service').hide();
        $('.edit_service').click(function () {
            var selectedService = '<?php echo $user->employee_member->eventcategory_id; ?>';
            $('#selected_service').hide();
            //            $('#basic_info input').attr('readonly', true);
            //
            //            $('#basic_info input').css({
            //                "background-color": "#EFEFEF",
            //                "height": "20px",
            //                "color": "#a7a7a7"
            //
            //            });

            $('#basic_info select').css({
                "background-color": "#fff",
                "outline": "1px solid #ccc",
                'height': '20px',
                'padding': '0px 10px'
            });

            var reference = $(this).parent().parent().next().children();
            $('#service').show();
            $('#service').val(selectedService);
            $('#service').removeAttr('disabled', 'disabled');
            $('#sub_services input[type="checkbox"]').removeAttr('disabled', 'disabled');

            $('#service').focus();
        });



        $('#service').change(function () {
            var serviceId = $(this).val();

            if (serviceId !== "") {
                $.ajax({
                    url: '<?php echo $this->request->webroot ?>EmployeeMembers/findServices',
                    data: {
                        'service_id': serviceId
                    },
                    type: 'POST',
                    cache: false,
                    async: false,
                    success: function (responce) {
                        $('#sub_services').show();
                        var data = JSON.parse(responce);
                        $('#sub_services').html(data);

                    },
                    error: function () {
                        alert('error');
                    }

                });

            } else {
                show_custom_message('Please select service');
                $('#service').focus();
                $('#sub_services').hide();
            }

        });


        $('#submit_dashboard_service').click(function () {
            var phone_pat = /^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/;
            var phone = $("#phone1").val();

            if (!phone_pat.test(phone)) {

                show_custom_message('Invalid phone format.');
            } else {
                $.ajax({
                    url: "<?php echo $this->request->webroot . 'EmployeeMembers/update_services_dashboard' ?>",
                    type: "GET",
                    data: $('#dashboard_service').serialize(),
                    success: function (data)
                    {
                        data = JSON.parse(data);
                        console.log(data);
                        if (data.flag == 1) {
                            show_custom_message(data.message);
                            $('#service').prop("disabled", true);
                            $('input[name="sub_categories[]"]').prop("disabled", true);
                            $('.edit_sub_cat').hide();
                            $('#submit_dashboard_service').hide();
                            $('#dashboard_service input,select,textarea').css({
                                'outline': 'unset',
                                "background-color": "#EFEFEF"
                            });
                            $('#basic_info input, #basic_info select, #basic_info textarea').attr('readonly', true);
                        } else {
                            show_custom_message(data.message);
                        }
                    }

                });
            }
        });

    });

</script>
