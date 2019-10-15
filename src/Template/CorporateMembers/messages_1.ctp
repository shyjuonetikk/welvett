<?php

use Cake\I18n\Time;

$img = 'cyber1550500683.png';
?>

<section class="content-wrapper content_bg">
    <div class="container">
        <div class="clearfix">&nbsp;</div>
        <div class="row">
            <!--messages start-->
            <div class="col-md-12 col-lg-12 col-xl-12" style="padding-bottom: 10px;text-align:right;">
                <a onclick="window.history.back()"><i class="fa fa-angle-left"></i>&nbsp;Go back</a>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3">
                <div class="bg-white pd_lr_20 box_shadow" style="min-height: 500px; position: relative; padding-bottom: 20px;">
                    <div class="text-center heading_color" style="padding-top: 10px;">
                        <h3><strong>Messages</strong></h3>
                    </div>

                    <button class="show_xs_message">Start Conversation</button>
                    <div id="user_list_height" class="pd_top_20 custom_scroll sb-container" style="">
                        <?php
                        foreach ($talentDiscussion as $talent) {

                            $path = '';
                            $loginWithSocial = $talent->talent['loginwithsocial'];
                            $path = $talent->talent['profile_image'];
                            $image = 'cyber1550500683.png';
                            if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                $path = $talent->talent['profile_image'];
                            } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                if ($talent->talent['profile_image'] == '') {

                                    $path = $this->request->webroot . 'img/users/' . $image;
                                } else {
                                    $path = $this->request->webroot . 'img/users/' . $path;
                                }
                            } else {
                                $path = $this->request->webroot . 'img/users/' . $image;
                            }
                            ?>
                            <a href="<?php echo $this->request->webroot; ?>CorporateMembers/messages/<?php echo $talent->id; ?>">
                                <div data-booking="<?php echo $talent->id; ?>" class="row load_messages">
                                    <div class="col-md-4">
                                        <div class="user_images_parent">
                                            <div class="user_images" style="background-image: url('<?php echo $path; ?>');">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 font_12 pd_0">
                                        <strong><?php echo $talent->talent->full_name; ?></strong><br>
                                        <span class="paragraph_color">
                                            <?= $talent->title; ?>
                                        </span>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <div class="clearfix">&nbsp;</div>

                        <?php } ?>


                    </div>

                    <div class="search_user">
                        <span style="position: relative;">
                            <input type="text" class="form-control custom_input_search" placeholder="Search">
                            <i style="" class="search_icon fa fa-search"></i>
                        </span>
                    </div>

                </div>

            </div>
            <!--messages end-->

            <div class="clearfix show_xs">&nbsp;</div>
            <!--conversation start-->
            <div class="col-md-8 col-lg-9 col-xl-9">
                <div class="bg-white" style="min-height: 500px; position: relative;">
                    <?php
                    if (isset($bookingId)) {
                        $path = '';
                        $loginWithSocial = $talentInfo[0]->talent->loginwithsocial;
                        $path = $talentInfo[0]->talent->profile_image;
                        $image = 'cyber1550500683.png';
                        if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                            $path = $talentInfo[0]->talent->profile_image;
                        } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                            if ($talentInfo[0]->talent->profile_image == '') {

                                $path = $this->request->webroot . 'img/users/' . $image;
                            } else {
                                $path = $this->request->webroot . 'img/users/' . $path;
                            }
                        } else {
                            $path = $this->request->webroot . 'img/users/' . $image;
                        }
                        ?>
                        <!--header start-->
                        <div class="" style="border-bottom: 1px solid #eaeaea;">
                            <div class="row" id="profile_header">
                                <div class="col-md-12" style="border-right: 1px solid #eaeaea; padding: 7px 30px;">
                                    <div class="user_images" style="background-image: url('<?php echo $path; ?>'); display: inline-block; float: left; margin-right: 15px;">
                                    </div>
                                    <div style="display: inline-block; padding-top: 10px;">
                                        <strong><?php echo $talentInfo[0]->talent->full_name; ?>
                                            <small>
                                                <?= ($booking_detail->title) ? ' - ' . $booking_detail->title : ''; ?>
                                            </small>
                                        </strong>
                                    </div>
                                </div>


                                <!--                                <div class="col-md-2 text-center" style="border-right: 1px solid #eaeaea; padding-top: 15px;">
                                                                    <i style="color: #8a8a92" class="fa fa-star"></i>
                                                                </div>
                                                                <div class="col-md-2 text-center" style="padding-top: 15px;">
                                                                    <i style="color: #8a8a92" class="fa fa-ellipsis-v"></i>
                                                                </div>-->
                            </div>
                        </div>
                        <!--header end-->

                        <div id="conversation_height" class="sb-container custom_scroll" style="padding: 15px; ">
                            <?php
                            foreach ($talentCustomerMsgs as $msg) {

                                if ($msg->user->role_id == 4) {
                                    $path = '';
                                    $loginWithSocial = $msg->user->loginwithsocial;
                                    $path = $msg->user->profile_image;
                                    $image = 'cyber1550500683.png';
                                    if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                        $path = $msg->user->profile_image;
                                    } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                        if ($msg->user->profile_image == '') {

                                            $path = $this->request->webroot . 'img/users/' . $image;
                                        } else {
                                            $path = $this->request->webroot . 'img/users/' . $path;
                                        }
                                    } else {
                                        $path = $this->request->webroot . 'img/users/' . $image;
                                    }
                                    ?>
                                    <!--talent start-->
                                    <div style="margin-bottom: 15px;">
                                        <div style="float: left;">
                                            <div class="talent_profile_for_message" style="background-image: url('<?php echo $path; ?>'); margin-right: 25px;">

                                            </div>
                                            <span style="font-size: 9px;">
                                                <?php echo date('m-d-Y H:i', strtotime($msg->created)); ?>
                                            </span>
                                        </div>
                                        <div class="talent_message" style="max-width: 42%; float: left; position: relative;">
                                            <span class="font_12">
                                                <?php echo $msg->message; ?>
                                            </span>
                                            <i style="position: absolute; left: -6px; top: 10px; color: #f8f8f8;" class="fa fa-caret-left"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--talent end-->
                                    <?php
                                }

                                if ($msg->user->role_id == $this->request->session()->read('Auth.User.role_id')) {
                                    $path = '';
                                    $loginWithSocial = $msg->user->loginwithsocial;
                                    $path = $msg->user->profile_image;
                                    $image = 'cyber1550500683.png';
                                    if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                                        $path = $msg->user->profile_image;
                                    } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                        if ($msg->user->profile_image == '') {

                                            $path = $this->request->webroot . 'img/users/' . $image;
                                        } else {
                                            $path = $this->request->webroot . 'img/users/' . $path;
                                        }
                                    } else {
                                        $path = $this->request->webroot . 'img/users/' . $image;
                                    }
                                    ?>

                                    <!--customer start-->
                                    <div style="margin-bottom: 15px;">
                                        <div style="float: right; text-align: right;">
                                            <div class="customer_profile_for_message" style="background-image: url('<?php echo $path; ?>'); margin-left: 25px;">

                                            </div>
                                            <span style="font-size: 9px;">
                                                <?php echo date('m-d-Y H:i', strtotime($msg->created)); ?>
                                            </span>
                                        </div>
                                        <div class="customer_message" style="max-width: 42%; float: right; position: relative;">
                                            <span class="font_12">
                                                <?php echo $msg->message; ?>
                                            </span>
                                            <i style="position: absolute; right: -5px; top: 10px; color: #7c1b2e;" class="fa fa-caret-right"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--customer end-->
                                    <?php
                                }
                            }
                            ?>

                        </div>

                        <div class="clearfix">&nbsp;</div>
                        <!--send message-->
                        <div class="" style="border-top: 1px solid #eaeaea; position: absolute; width: 100%; bottom: 0;">
                            <form method="post">
                                <div class="row send_msg_row">
                                    <div class="col-md-9 offset-md-1">
                                        <input autocomplete="off" required="required" type="text" name="message" style="border: none !important;" placeholder="Type your message...">
                                        <input type="hidden" name="talent_event_id" value="<?php echo $talentInfo[0]->talent_event_id; ?>">
                                        <input type="hidden" name="booking_id" value="<?php echo $bookingId; ?>">
                                    </div>
                                    <div class="col-md-1 send_msg_div">
                                        <button class="pull-right" type="submit" style="background-color: transparent; border: none;"><i class="fa fa-send send_message"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                    } else {
                        ?>
                        <h3 style="padding: 30px; text-align: center;">Please start conversation</h3>
                        <?php
                    }
                    ?>
                </div>

            </div>
            <!--conversation end-->
        </div>
        <div class="clearfix">&nbsp;</div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('div[data-booking]').click(function () {

        });

        $('input[name="message"]').focus();


    });
</script>