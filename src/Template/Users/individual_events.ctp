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
?>

<style>
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
<!-- Zabuto Calendar -->
<link rel="stylesheet" type="text/css" href="<?= $this->request->webroot; ?>dist/bootstrap-clockpicker.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<section class="content-wrapper header_bg">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-5 col-lg-5 pos_relative">
                <h1 class="profile_text_color pos_absolute">
                    <?php echo $userInfo->role->name; ?>
                </h1>
            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <?php
                $c_image = 'cyber1550500683.png';
                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {
                    ?>
                    <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $userInfo['profile_image']; ?>'); position: relative;">

                        <?php
                        if ($isEdit == 1) {
                            echo '<i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>';
                        }
                        ?>
                        <img class="blue_tick" src="<?php echo $this->request->webroot; ?>img/blue_tick.png" alt="">
                    </div>
                    <?php
                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                    if ($userInfo['profile_image'] == '') {
                        ?>
                        <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>');">

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
                        <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $userInfo['profile_image']; ?>');">

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
                    <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>');">

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
                    <span class="white_color"><strong><?= ucfirst($userInfo->first_name); ?></strong></span>
                    <br>
                    <span class="profile_text_color">
                        <?php
                        if ($userInfo->state != null) {
                            echo $userInfo->city . ', ' . $states[$userInfo->state];
                        } else {
                            ?>
                            &nbsp;&nbsp;&nbsp;
                            <?php
                        }
                        ?>
                    </span>
                </div>

            </div>
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="pos_absolute" style="right: 10%;">
                    <div class="btn_in_header">
                        <a href="<?php echo $this->request->webroot; ?>users/individualReviews" class="review_link">
                            <button class="review_button">

                                <i class="fa fa-star"></i>
                            </button>
                            <span class="white_color">My Reviews</span>
                        </a>
                    </div>

                    <div class="btn_in_header">
                        <a href="<?php echo $this->request->webroot; ?>users/profile" class="review_link">
                            <button class="review_button">

                                <i class="fa fa-user"></i>
                            </button>
                            <span class="white_color">My Profile</span>
                        </a>
                    </div>
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
                        <li class=""><a class="black-text" href="<?= $this->request->webroot; ?>Pages/categories">Home</a><i class="" aria-hidden="true"> > &nbsp;</i></li>
                        <li class="active">My Events</li>
                    </ol>
                </nav>
            </div>
        </div>

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
                                <input id="first_name" name="first_name" type="text" class="" readonly value="<?php echo $userInfo->first_name; ?>">
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
                                <input id="last_name" name="last_name" type="text" class="" readonly value="<?php echo $userInfo->last_name; ?>">
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
                                <input id="email" name="email" type="text" class="" readonly value="<?php echo $userInfo->email; ?>">

                            </div>

                            <div class="col-md-6 col-lg-6 text-right">
                                <span style="position: relative;">
                                    <?php
                                    if ($isEdit == 1) {
                                        echo '<i class="fa fa-pencil edit_info"></i>';
                                    }
                                    ?>
                                    Phone Number
                                </span>

                            </div>
                            <div class="col-md-6 col-lg-6 text-left">
                                <input id="phone1" name="phone1" type="text" class="" readonly value="<?php echo $userInfo->phone1; ?>">
                            </div>

                        </div>
                        <div class="clearfix">&nbsp;</div>
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
                            <h6 class="text-center"><i class="fa fa-calendar"></i> My Events</h6>
                        </div>
                        <?php echo $this->element('inc/tabs'); ?>

                        <?php
                        if (count($bookings) > 0) {
                            foreach ($bookings as $booking):
                                $rating = 0;
                                if (!empty($booking->talent_rating)) {
                                    $rating = (100 * $booking->talent_rating->rate) / 5;
                                }

                                $path = '';
                                $loginWithSocial = $booking->talent->loginwithsocial;
                                $path = $booking->talent->profile_image;
                                $image = 'cyber1550500683.png';
                                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                    $path = $booking->talent->profile_image;
                                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                    if ($booking->talent->profile_image == '') {

                                        $path = $this->request->webroot . 'img/users/' . $image;
                                    } else {
                                        $path = $this->request->webroot . 'img/users/' . $path;
                                    }
                                } else {
                                    $path = $this->request->webroot . 'img/users/' . $image;
                                }
                                ?>
                                <div class="row" id="bookingNumber<?= $booking->id; ?>">
                                    <div class="col-lg-7 event_detail">
                                        <div style="width: 80px;float: left;margin-right: 15px;">
                                            <div class="event_image" style="width:80px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>'); position: relative;">
                                                <img class="blue_tick" src="<?php echo $this->request->webroot; ?>img/blue_tick.png" alt="">
                                            </div>
                                            <div>
                                                <strong><?php echo ucwords($booking->talent->first_name . ' ' . $booking->talent->last_name); ?></strong>
                                            </div>
                                        </div>
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
                                        <br>

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
                                        <button  data-toggle="tooltip" title="View booking" class="event_button pull-right" onclick="show_detail(<?= $booking->id; ?>)" style="margin:0 5px;cursor: pointer;"><i class="fa fa-eye"></i></button>
                                        <?php
                                        if ($booking->status == 2) {
                                            if ($booking->payment->customer_issues) {
                                                $dispLabel = 'Dispute in progress';
                                                $disputeBadge = 'badge badge-warning';

                                                if ($booking->payment->dispute_resolved) {
                                                    $dispLabel = 'Dispute Resolved';
                                                    $disputeBadge = 'badge badge-success';
                                                }
                                                ?>
                                                <span class="pull-right <?= $disputeBadge; ?>" onclick="bothDisputes(<?= $booking->payment->id ?>)" style="padding: 7px 5px;cursor: pointer;margin:0 5px;"><?= $dispLabel; ?></span>

                                                <?php
                                            } else {
                                                ?>
                                                <button id="dispute<?= $booking->payment->id; ?>" onclick="dispute(<?= $booking->payment->id ?>)" class="event_button pull-right" data-toggle="tooltip" title="Dispute" style="margin:0 5px;cursor:pointer;">Dispute</button>
                                                <?php
                                            }
                                            if ($booking->payment->is_requested) {
                                                if (!$booking->payment->status) {
                                                    if ($booking->payment->customer_issues == null && $booking->payment->talent_issues == null) {
                                                        ?>
                                                        <button id="request<?= $booking->payment->id; ?>" onclick="requestPayment(<?= $booking->payment->id ?>)" class="event_button pull-right" data-toggle="tooltip" title="Release payment" style="margin:0 5px;"><i class="fa fa-money"></i></button>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="event_button pull-right" data-toggle="tooltip" title="Release payment" style="margin:0 5px;cursor: pointer;background: gray"><i class="fa fa-money"></i></span>
                                                        <?php
                                                    }
                                                } else {
                                                    $pLabel = 'Payment Released';
                                                    $badge = 'danger';

                                                    if ($booking->payment->dispute_resolved && $booking->payment->status == 2) {
                                                        $pLabel = 'Payment Refunded';
                                                        $badge = 'success';
                                                    }
                                                    ?>

                                                    <span class="pull-right badge badge-<?= $badge; ?>" style="margin:0 5px;padding: 7px 5px;"><?= $pLabel; ?></span>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <button id="edit_booking" onclick="get_booking(<?= $booking->id; ?>)" class="event_button pull-right" style="margin:0 5px;cursor: pointer;"  data-toggle="tooltip" title="Edit booking"><i class="fa fa-edit"></i></button>
                                            <?php
                                        }
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
                                        <a href="<?php echo $this->request->webroot . 'Users/messages/' . $booking->id ?>"  data-toggle="tooltip" title="Discuss" class="event_button pull-right discuss_button" style="margin:0 5px;cursor: pointer;"><i class="fa fa-comments"></i></a>

                                        <div class="image_icon_div">
                                            <img data-toggle="tooltip" title="<?php echo $booking->talent_event->eventcategory->title ?>" src="<?php echo $this->request->webroot . 'img/event/' . $booking->talent_event->eventcategory->image_icon; ?>">
                                        </div>
                                        <span class="badge <?php echo $class; ?>" style="margin-right: 20px;"><?php echo $status; ?></span> 
                                    </div>
                                    <?php
                                    if (isset($booking->payment->status) && $booking->payment->status) {
                                        if (!empty($booking->talent_rating)) {
                                            ?>
                                            <div class="col-lg-2 circlechart" data-percentage="<?php echo $rating; ?>" style="text-align:center;cursor: pointer;">
                                                <div>
                                                    <?php echo!empty($booking->talent_rating) ? $booking->talent_rating->rate : 0; ?>
                                                </div>
                                            </div>
                                        <?php } else { ?>

                                            <div class="col-lg-2" style="text-align:center;" id="rate_button<?= $booking->id; ?>">
                                                <?php if ($booking->status == 2 || $booking->status == 1) { ?>
                                                    <button id="rating_div<?= $booking->id; ?>" onclick="rating_modal(<?php echo $booking->id; ?>)" class="event_button" style="margin-top: 45px;cursor: pointer;" data-toggle="tooltip" title="Rate user"><i class="fa fa-star" style="font-size: 18px;"></i></button> 
                                                <?php } ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>


                                    <div class="col-lg-3">
                                        <?php
                                        if (isset($booking->payment->status) && $booking->payment->status) {
                                            ?>
                                            <?php
                                            if (empty($booking->talent_review)) {
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
                                                <?php
                                            }
                                        }
                                        ?>

                                    </div>
                                </div>
                                <hr>
                                <?php
                            endforeach;
                        } else {
                            ?>
                            <h6 class="text-center">No event found</h6>
                            <?php
                        }
                        ?>
                    </div>
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
    <div class="modal fade" id="edit_booking_div" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #F5F5F5 !important;">
                <div class="modal-header" style="display:block !important;padding: 0 10px;border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="booking_form" action="<?php echo $this->request->webroot; ?>EmployeeMembers/editBooking" method="post">
                    <div class="modal-body" id="get_booking_form">

                    </div>
                </form>
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
    <div class="modal fade" id="disputeReason" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="background-color: #F5F5F5 !important;">
                <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                    <h5 class="modal-title">Customer Dispute</h5>
                </div>
                <div class="modal-body">
                    <form id="customer_issue_form" method="post" action="<?= $this->request->webroot . 'EmployeeMembers/saveDispute'; ?>">
                        <div class="row" id="opponentDispute"></div>
                        <div class="row">
                            <label class="col-md-12" for="customer_issue">Write down the reason for disputing</label>
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
</section>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>rating/jquery.rateyo.js"></script>
<script src="<?php echo $this->request->webroot; ?>progress/progresscircle.js"></script>
<script>
                                    $('.circlechart').circlechart(); // Initialization
</script>
<script>
    function dispute(payment_id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'EmployeeMembers/getDisputes' ?>',
            data: 'payment_id=' + payment_id + '&get_field=talent_issues',
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
                if (data.talent) {
                    $('#opponentBothDispute').append('<div class="row"><label class="col-md-12">Talent Disputed</label><div class="col-md-12"><p class="custom_field">' + data.talent + '</p></div></div>')
                }
                if (data.customer) {
                    $('#opponentBothDispute').append('<div class="row"><label class="col-md-12">Your Dispute</label><div class="col-md-12"><p class="custom_field">' + data.customer + '</p></div></div>')
                }
                $('#customer_issue_form input[name=payment_id]').val(payment_id);
                $('#getBothDisputes').modal('show');
            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }


    function requestPayment(payment_id) {
        if (confirm("Are you sure you want to release payments")) {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot . 'EmployeeMembers/release_payment' ?>',
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
    }
    function get_booking(s_id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'EmployeeMembers/get_booking' ?>',
            data: 'id=' + s_id,
            contentType: 'json',
            success: function (data)
            {

                $('#get_booking_form').html(data);
                $('#edit_booking_div').modal('show');

            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }
    function show_detail(booking) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot ?>EmployeeMembers/viewBooking',
            data: 'booking_id=' + booking,
            success: function (data)
            {
                $('#dynamic_content').html(data);
                $('#summary_modal').modal('show');
            }
        });

    }
    function setFromDate() {
        $('#to_date').val('');
    }
    function setToDate() {
        if ($('#from_date').val() == '') {
            $('#to_date').val('');
            alert('Select From date first');
        }
        if (new Date($('#from_date').val()) > new Date($('#to_date').val()))
        {
            $('#to_date').val('');
            alert('invalid End date');
        }
        if ($('#from_date').val() && $('#to_date').val()) {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/validate_bookings',
                data: 'from_date=' + $('#from_date').val() + '&to_date=' + $('#to_date').val() + '&talent=' + $('input[name=talent_id]').val(),
                success: function (data)
                {
                    if (data == 1) {

                    } else {
                        $('#to_date').val('');
                        alert('The talent is booked for the given time period');
                    }

                }
            });
        }


    }

    function btn_number(btn_id) {
        //        $(this) = $('#' + btn_id);

        var fieldName = $('#' + btn_id).attr('data-field');
        var type = $('#' + btn_id).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {
                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $('#' + btn_id).attr('disabled', true);
                }

            } else if (type == 'plus') {
                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $('#' + btn_id).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }

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
                url: '<?php echo $this->request->webroot . 'users/add_review' ?>',
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

    function readURL(input, showId = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.files[0]);   
            reader.onload = function (e) {
                if (input.id == "sectionImage") {
                    $('#show_section_uploaded_image')
                            .attr('src', e.target.result);
                }
            };
            reader.readAsDataURL(input.files[0]);
    }
    }

    $(document).ready(function () {
        /*
         * change image
         */
        $('#submit_rating').click(function () {
            if (!$('#ratings input[name=review]').val()) {
                show_custom_message('Please select a review');
                return false;
            }

            var review = $('input[name=booking_id]').val();
            if ($('#review' + review + ' textarea[name="review"]').val() != '') {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot . 'users/add_review' ?>',
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
                url: '<?php echo $this->request->webroot . 'Users/ratings' ?>',
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
                url: "<?php echo $this->request->webroot . 'Users/editImage' ?>",
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


        // edit profile info
        $('.edit_info').click(function () {

            $('#basic_info input').attr('readonly', false);
            $('#submit_dashboard_service').show();
            $('#basic_info input').css({
                "background-color": "#fff",
                "height": "20px",
                "color": "#5E5E5E"

            });

        });
        var phone_pat = /^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/;

        $('#submit_dashboard_service').click(function () {

            var phone = $("#phone1").val();

            if (!phone_pat.test(phone)) {

                show_custom_message('Invalid phone format.');
            } else {
                $.ajax({
                    url: "<?php echo $this->request->webroot . 'Users/updateProfileInfo' ?>",
                    type: "GET",
                    data: $('#dashboard_service').serialize(),
                    success: function (data)
                    {

                        data = JSON.parse(data);
                        if (data.flag == 1) {
                            show_custom_message(data.message);

                            $('#submit_dashboard_service').hide();
                            $('#basic_info input').css({
                                'outline': 'unset',
                                "background-color": "#EFEFEF"
                            });
                            $('#basic_info input').attr('readonly', true);
                            $('#basic_info input[type="password"]').val('');
                        } else {
                            show_custom_message(data.message);
                        }
                    }

                });

            }


        });

    });
</script>

<script type="text/javascript" src="<?= $this->request->webroot; ?>dist/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
    function clockpicker() {
        $('.clockpicker').clockpicker()
                .find('input').change(function () {
            console.log(this.value);
        });
    }

</script>