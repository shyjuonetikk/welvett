<?php
$loginWithSocial = $this->request->session()->read('Auth.User.loginwithsocial');

use Cake\I18n\Time;
?>
<link rel="stylesheet" href="<?php echo $this->request->webroot; ?>progress/progresscircle.css">

<style>
    .edit_profile {
        bottom: 56px;
        right: 55px;
    }
    .circle-chart {
        width: 80% !important;
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
</style>
<section class="content-wrapper header_bg">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="row" style="padding-top:25px; padding-bottom: 10px;">
                    <?php
                    foreach ($userInfo->talent_events as $img) {
                    ?>
                    <div class="col-md-2">
                        <img src="<?php echo $this->request->webroot . 'img/event/' . $img->eventcategory->image_icon; ?>" style="width: 40px;">
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <?php
                $c_image = 'cyber1550500683.png';
                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {
                ?>
                <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $userInfo['profile_image']; ?>'); position: relative;">

                    <img class="blue_tick" src="<?php echo $this->request->webroot;?>img/blue_tick.png" alt="">
                </div>
                <?php
                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                    if ($userInfo['profile_image'] == '') {
                ?>
                <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>'); position: relative;">
                    <img class="blue_tick" src="<?php echo $this->request->webroot;?>img/blue_tick.png" alt="">
                </div>

                <?php
                    } else {
                ?>
                <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $userInfo['profile_image']; ?>'); position: relative;">

                    <img class="blue_tick" src="<?php echo $this->request->webroot;?>img/blue_tick.png" alt="">

                </div>
                <?php
                    }
                } else {
                ?>
                <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>'); position: relative;">

                    <img class="blue_tick" src="<?php echo $this->request->webroot;?>img/blue_tick.png" alt="">
                </div>
                <?php }
                ?>
                <div>
                    <span class="white_color"><strong><?= ucfirst($userInfo->first_name); ?></strong></span>

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
                    <a href="<?php echo $this->request->webroot; ?>EmployeeMembers/employee_events" class="review_link">
                        <button class="review_button">
                            <i class="fa fa-calendar"></i>
                        </button>
                        <span class="white_color">My Bookings</span>
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
                        <li class="active">My Reviews</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-xl-5 border_right" style="padding-bottom: 20px;">

                <div>

                    <div>
                        <h6 class="text-center">Ratings</h6>
                    </div>
                    <?php
                    if (count($ratings) > 0) {
                        foreach ($ratings as $rating):

                        $path = '';
                        $loginWithSocial = $rating->customer->loginwithsocial;

                        $path = $rating->customer->profile_image;
                        $image = 'cyber1550500683.png';
                        if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                            $path = $rating->customer->profile_image;
                        } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                            if ($rating->customer->profile_image == '') {

                                $path = $this->request->webroot.'img/users/' . $image;
                            } else {
                                $path = $this->request->webroot.'img/users/' . $path;
                            }
                        } else {
                            $path = $this->request->webroot.'img/users/' . $image;
                        }
                    ?>
                    <div class="row rating_div" style="margin-top: 10px;">
                        <div class="event_image" style="width:80px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>'); position: relative;">
                            <img class="blue_tick" src="<?php echo $this->request->webroot;?>img/blue_tick.png" alt="">
                        </div>
                        <div class="col-sm-6 col-md-6 p_info">
                            <strong>
                                <?php echo ucwords($rating->customer->first_name . ' ' . $rating->customer->last_name); ?>
                            </strong>
                            <br>
                            <span style="font-size:13px;">
                                <?php
                        $date = date('M d, Y', strtotime($rating->created));
                        echo $date;
                                ?>
                            </span>
                        </div>
                        <?php
                        $rated = (100 * $rating->rate) / 5;
                        ?>
                        <div class="col-sm-4 col-md-3 circlechart" data-percentage="<?php echo $rated; ?>" style="text-align:center;cursor: pointer;">
                            <div>
                                <?php echo $rating->rate; ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php
                        endforeach;
                    } else {
                    ?>
                    <h6 class="text-center">No rating found</h6>
                    <?php
                    }
                    ?>
                </div>

            </div>
            <div class="col-md-7 col-lg-7 col-xl-7">
                <div id="my_events">
                    <div>

                        <div>
                            <h6 class="text-center">Reviews</h6>
                        </div>
                        <?php
                        if (count($reviews) > 0) {
                            foreach ($reviews as $review):

                            $path = '';
                            $loginWithSocial = $review->customer->loginwithsocial;
                            $path = $review->customer->profile_image;
                            $image = 'cyber1550500683.png';
                            if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                $path = $review->customer->profile_image;
                            } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                if ($review->customer->profile_image == '') {

                                    $path = $this->request->webroot.'img/users/' . $image;
                                } else {
                                    $path = $this->request->webroot.'img/users/' . $path;
                                }
                            } else {
                                $path = $this->request->webroot.'img/users/' . $image;
                            }
                        ?>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="event_image" style="width:80px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>'); position: relative;">
                                    <img class="blue_tick" src="<?php echo $this->request->webroot;?>img/blue_tick.png" alt="">
                                </div>
                                <strong>
                                    <?php echo ucwords($review->customer->first_name . ' ' . $review->customer->last_name); ?>
                                </strong>
                                <span class="pull-right">
                                    <?php
                            $date = date('M d, Y', strtotime($review->created));
                            echo $date;
                                    ?>
                                </span>
                                <br>
                                <p>
                                    <?php echo strlen($review->review) > 200 ? substr($review->review, 0, 200) . "..." : $review->review; ?>
                                </p> 
                            </div>


                        </div>
                        <hr>
                        <?php
                            endforeach;
                        } else {
                        ?>
                        <h6 class="text-center">No reviews found</h6>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

<script src="<?php echo $this->request->webroot; ?>progress/progresscircle.js"></script>
<script>
    $('.circlechart').circlechart(); // Initialization
</script>