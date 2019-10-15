<?php

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
                <h1 class="profile_text_color pos_absolute">
                    <?php echo $userInfo->role->name; ?>
                </h1>
            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <?php
                $path = '';
                $loginWithSocial = $userInfo->loginwithsocial;
                $path = $userInfo->profile_image;
                $image = 'cyber1550500683.png';
                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                    $path = $userInfo->profile_image;
                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                    if ($userInfo->profile_image == '') {

                        $path = $this->request->webroot.'img/users/' . $image;
                    } else {
                        $path = $this->request->webroot.'img/users/' . $path;
                    }
                } else {
                    $path = $this->request->webroot.'img/users/' . $image;
                }
                ?>
                <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>'); position: relative;">
                    <img class="blue_tick" src="<?php echo $this->request->webroot;?>img/blue_tick.png" alt="">

                </div>
                <div>
                    <span class="white_color"><strong><?= ucfirst($userInfo->first_name); ?></strong></span>
                    <br>
                    <span class="profile_text_color">
                        <?php
                        if ($userInfo->state != null) {
                            echo $userInfo->city . ', ' . $states[$userInfo->state];
                        }
                        ?>
                    </span>
                </div>

            </div>
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="pos_absolute" style="right: 10%;">
                    <div class="btn_in_header">
                        <a href="<?php echo $this->request->webroot; ?>corporateMembers/corporateEvents" class="review_link">
                            <button class="review_button">
                                <i class="fa fa-calendar"></i>
                            </button>
                            <span class="white_color">My Events</span>
                        </a>
                    </div>

                    <div class="btn_in_header">
                        <a href="<?php echo $this->request->webroot; ?>corporateMembers/profile" class="review_link">
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
                        <li class=""><a class="black-text" href="<?= $this->request->webroot; ?>pages/categories">Home</a><i class="" aria-hidden="true"> > &nbsp;</i></li>
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
                        $loginWithSocial = $rating->talent->loginwithsocial;

                        $path = $rating->talent->profile_image;
                        $image = 'cyber1550500683.png';
                        if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                            $path = $rating->talent->profile_image;
                        } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                            if ($rating->talent->profile_image == '') {

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
                                <?php echo ucwords($rating->talent->first_name . ' ' . $rating->talent->last_name); ?>
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
            <div class="col-lg-7 col-xl-7">
                <div id="my_events">
                    <div>

                        <div>
                            <h6 class="text-center">Reviews</h6>
                        </div>
                        <?php
                        if (count($reviews) > 0) {

                            foreach ($reviews as $review):

                            $path = '';
                            $loginWithSocial = $review->talent_user->loginwithsocial;
                            $path = $review->talent_user->profile_image;
                            $image = 'cyber1550500683.png';
                            if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                $path = $review->talent_user->profile_image;
                            } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                if ($review->talent_user->profile_image == '') {

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
                                    <?php echo ucwords($review->talent_user->first_name . ' ' . $review->talent_user->last_name); ?>
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