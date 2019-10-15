<!-- Zabuto Calendar -->
<link rel="stylesheet" type="text/css" href="<?= $this->request->webroot; ?>dist/bootstrap-clockpicker.min.css">
<script src="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<?php

use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

//debug($service);
?>
<style>
    .refLink:hover{
        text-decoration: underline;
    }
</style>
<section class="content-wrapper header_bg view_emp">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="row view_emp_profile_row" style="margin-top: 30px;">
                    <div class="col-md-3">
                        <img class="service_image" src="<?= $this->request->webroot . 'img/event/' . $service->eventcategory->image_icon ?>" style="width:100%">

                    </div>
                    <div class="col-md-9">
                        <h1 class="profile_text_color pos_absolute">
                            <?php echo ucwords($service->eventcategory->title); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <?php
                $loginWithSocial = $userInfo['loginwithsocial'];
                $path = $userInfo['profile_image'];
                $image = 'cyber1550500683.png';
                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                    $path = $userInfo['profile_image'];
                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                    if ($userInfo['profile_image'] == '') {

                        $path = $this->request->webroot . 'img/users/"' . $image . '"';
                    } else {
                        $path = $this->request->webroot . 'img/users/"' . $path . '"';
                    }
                } else {
                    $path = $this->request->webroot . 'img/users/"' . $image . '"';
                }
                ?>
                <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>');">
                </div>
                <div>
                    <span class="white_color">
                        <strong><?= ucwords($userInfo->first_name . ' ' . $userInfo->last_name); ?> &nbsp;</strong>
                        <?php
                        $conn = ConnectionManager::get('default');
                        $query = $conn->execute('SELECT t.talent_id,SUM(t.rate) as ratings,COUNT(t.booking_id) as total_booking FROM talent_ratings as t WHERE talent_event_id=' . $this->request->params['pass'][0] . ' GROUP BY t.talent_id');
                        $ratings = $query->fetchAll('assoc');
                        $calculateRatings = 0;
                        if (isset($ratings[0])) {
                            $calculateRatings = round(($ratings[0]['ratings'] / $ratings[0]['total_booking']) * 2) / 2;
                        }
                        ?>

                        <?php if ($calculateRatings != 0) { ?>
                            <span class="profile_font_color"><?php echo $calculateRatings; ?>/5 <i class="fa fa-star gotted_stars" style=""></i></span>
                        <?php } else { ?>
                            <span style="color: #f9d857; margin-left: 5px;white-space: nowrap;" class=""> Not Rated</span>
                        <?php } ?>

                    </span>


                </div>
            </div>
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="pos_absolute booking_prices" style="right: 10%;width:40%">
                    <form id="get_amount">
                        <div class="row view_emp_profile_row" style="margin-bottom:15px;">
                            <input type="hidden" name="event_id" value="<?= $service->id; ?>">
                            <div class="col-md-8 event_type_left_div">
                                <div>
                                    <input name="event_type" id="hourly" type="radio" value="1" checked="">
                                    <label class="event_type_label" for="hourly">Hourly</label>
                                </div>
                                <div>
                                    <input name="event_type" id="whole_event" type="radio" value="2">
                                    <label class="event_type_label" for="whole_event">Whole Event</label>
                                </div>
                                <div class="">

                                </div>
                            </div>
                            <div class="col-md-4 event_type_right_div">
                                <span class="amount_style"></span>
                            </div>

                        </div>
                    </form>
                    <div class="col-md-12 book_button_div text-center">
                        <a class="book_button" href="#" data-toggle="modal" data-target="#booking_requirement_modal"> Book <?php echo ucwords($userInfo->first_name); ?> </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<section class="content-wrapper content_bg">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class=""><a class="black-text" href="<?= $this->request->webroot; ?>Pages/categories">Home</a><i class="" aria-hidden="true"> > &nbsp;</i></li>
                        <li class="active">Talent Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row">

            <div class="col-md-4 col-lg-4 col-xl-4 border_right" style="padding-bottom: 20px;">
                <div class="text-center" id="basic_info">
                    <div>
                        <h5>Bio</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 text-right">
                            <span style="position: relative;">
                                Name
                            </span>
                        </div>
                        <div class="col-md-9 col-lg-9 text-left">
                            <span style="position: relative;">
                                <?php echo ucwords($userInfo->first_name . ' ' . $userInfo->last_name); ?>
                            </span>
                        </div>
                        <div class="col-md-3 col-lg-3 text-right">
                            <span style="position: relative;white-space: nowrap;">
                                City
                            </span>
                        </div>
                        <div class="col-md-9 col-lg-9 text-left">
                            <span style="position: relative;">
                                <?= $userInfo->city; ?>
                            </span>
                        </div>
                        <div class="col-md-3 col-lg-3 text-right">
                            <span style="position: relative;white-space: nowrap;">
                                State
                            </span>
                        </div>
                        <div class="col-md-9 col-lg-9 text-left">
                            <span style="position: relative;">
                                <?= $states[$userInfo->state]; ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 text-right">
                            <span style="position: relative;">
                                Description
                            </span>

                        </div>
                        <div class="col-md-9 col-lg-9 text-left">
                            <p style="font-size:12px;"><?php echo $userInfo->employee_member->description ?></p>
                        </div>

                        <div class="col-md-3 col-lg-3 text-right">
                            <span style="position: relative;white-space: nowrap;">
                                Booking REQS
                            </span>
                        </div>
                        <div class="col-md-9 col-lg-9 text-left">
                            <p style="font-size:12px;"> 
                                <?php echo $userInfo->talent_events[0]->booking_requirement ?>
                            </p>
                        </div>
                        <div class="col-md-3 col-lg-3 text-right">
                            <span style="position: relative;white-space: nowrap;">
                                Reference links
                            </span>
                        </div>
                        <div class="col-md-9 col-lg-9 text-left">
                            <div class="row"> 
                                <?php foreach ($referenceLinks as $rl): ?>
                                    <div class="col-md-12" style="padding-top:0;">
                                        <a href="<?= $rl->link ?>" class="refLink" target="_blank" style="color:#511723; "><?= $rl->title ?></a>
                                    </div>
                                <?php endforeach; ?>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-8 col-xl-8">
                <div id="my_events" class="row">

                    <div class="col-md-12">
                        <h6 class="text-center">Reviews</h6>
                    </div>
                    <?php
                    if (count($reviews) > 0) {
                        foreach ($reviews as $review):
                            ?>
                            <div class="col-md-12 col-lg-12 col-xl-12" style="margin-top: 10px;">
                                <?php
                                $loginWithSocial = $review->customer->loginwithsocial;
                                $path = $review->customer->profile_image;
                                $image = 'cyber1550500683.png';
                                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {
                                    ?>

                                    <div class="event_image" style="width:80px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>');">

                                    </div>
                                    <?php
                                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                                    if ($review->customer->profile_image == '') {
                                        ?>
                                        <div class="event_image" style="width:80px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot; ?>img/users/<?php echo $image; ?>');">

                                        </div>


                                        <?php
                                    } else {
                                        ?>


                                        <div class="event_image" style="width:80px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot; ?>img/users/<?php echo $path; ?>');">

                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>

                                    <div class="event_image" style="width:80px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot; ?>img/users/<?php echo $image; ?>');">

                                    </div>
                                    <?php
                                }
                                ?>




                                <strong>
                                    <?php echo ucwords($review->customer->first_name . ' ' . $review->customer->last_name); ?>
                                </strong>
                                <span class="pull-right">
                                    <?php
                                    $date = date('M d, Y', strtotime($review->created));
                                    echo $date;
                                    ?>
                                </span>
                                <p>
                                    <?php echo strlen($review->review) > 200 ? substr($review->review, 0, 200) . "..." : $review->review; ?>
                                </p> 


                            </div>

                            <hr>
                            <?php
                        endforeach;
                    } else {
                        ?>
                        <div class="col-md-12">
                            <h6 class="text-center">No reviews found</h6>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="booking_requirement_modal" role="dialog">
        <div class="modal-dialog modal-lg" style="">
            <div class="modal-content">
                <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                    <h5 class="modal-title">Booking Requirements</h5>
                </div>
                <div class="modal-body">

                    <p style="font-weight: bold; font-size: 16px;"><?php echo $service->booking_requirement; ?></p>
                </div>
                <div class="modal-footer" style="text-align:right">
                    <span style="margin-right: 20px;">Do you agree?</span>
                    <?php
                    echo $this->Form->button('Yes', array('type' => 'button', 'div' => false, 'label' => false, 'class' => 'event_button', 'id' => 'register', 'style' => 'margin:unset !important;padding: 0.25rem 0.5rem !important;font-size:0.875rem !important;cursor:pointer'));
                    ?>

                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #F5F5F5 !important;">
                <div class="modal-header" style="display:block !important;padding: 0 10px;border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="booking_form" action="" method="post">
                    <div class="modal-body">
                        <div class="row event_date_time">
                            <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
                                <input id="talent_event_id" name="talent_event_id" value="<?= $this->request->params['pass'][0] ?>" type="hidden">
                                <input id="from_date" type="text" name="from_date" class="form-control change-placeholder datepicker"  placeholder="Start date" data-original-title="This Field is required" title="" style="background-color:#711A2A;" tabindex="1">
                                <div class="input-group-prepend">
                                    <span class="fa fa-calendar input-group-text"></span>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
                                <input type="text" id="to_date" name="to_date" class="form-control change-placeholder datepicker" placeholder="End date" data-original-title="This Field is required" title="" style="background-color:#711A2A;" tabindex="2">
                                <div class="input-group-prepend">
                                    <span class="fa fa-calendar input-group-text"></span>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-lg-3 modal_btn_div clockpicker" data-autoclose="true">
                                <input type="text" id="hour" name="hour" class="form-control change-placeholder" placeholder="Hour" data-original-title="This Field is required" title="" style="background-color:#711A2A;" tabindex="3" >
                                <div class="input-group-prepend">
                                    <span class="fa fa-clock-o input-group-text"></span>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6 col-lg-3 modal_btn_div" style="padding:0;">
                                <?php // debug($get_talent_cities)?>
                                <select id="location" name="talent_event_city_id" class="form-control change-placeholder" style="background-color:#711A2A;height:36px !important;font-size: 13px;" tabindex="4">
                                    <?php foreach ($get_talent_cities as $city): ?>
                                        <option value="<?= $city['id'] ?>"><?= $city['city'] . ', ' . $states[$city['state_id']] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-prepend">
                                    <span class="fa fa-map-marker input-group-text"></span>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="input-group modal_event_type">
                                    <?php
                                    foreach ($service->event_types as $event_type):
                                        if ($event_type->event_type == 1) {
                                            ?>
                                            <div class="col-md-6">
                                                <div class="col-md-12" style="padding:0">
                                                    <input type="radio" name="modal_event_type" id="modal_event_type_hourly" value="1" tabindex="5">
                                                    <label for="modal_event_type_hourly">Hourly <small>(total hours)</small></label>
                                                </div>
                                                <!--                                                <div id="hour_quantity" class="col-md-12" style="padding:0;display:none;">
                                                                                                    <span class="input-group-btn">
                                                                                                        <button type="button" class="inc_dec btn-number" disabled="disabled" data-type="minus" data-field="total_hours" style="cursor:pointer">
                                                                                                            <span class="fa fa-minus"></span>
                                                                                                        </button>
                                                                                                    </span>
                                                                                                    <input type="text" name="total_hours" class="inc_dec_field input-number" value="1" min="1" max="100">
                                                                                                    <span class="input-group-btn">
                                                                                                        <button type="button" class="inc_dec btn-number" data-type="plus" data-field="total_hours" style="cursor:pointer">
                                                                                                            <span class="fa fa-plus"></span>
                                                                                                        </button>
                                                                                                    </span> 
                                                                                                    <p id="hourly_amount" style="margin:0 !important;color:green;margin-top:10px !important;"></p>
                                                                                                </div>-->

                                            </div>
                                            <?php
                                        }
                                        if ($event_type->event_type == 2) {
                                            ?>

                                            <div class="col-md-6">
                                                <div class="col-md-12" style="padding:0">
                                                    <input type="radio" name="modal_event_type" id="modal_event_type_whole" value="2" tabindex="6">
                                                    <label for="modal_event_type_whole">Whole Event</label>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    endforeach;
                                    ?>

                                </div>

                                <div class="row" id="time_range" style="display:none;padding-top:10px">
                                    <div class="col-lg-6">
                                        <div class="form-group clockpicker"  data-autoclose="true">
                                            <input type="text" id="from_time" name="from_time" class="form-control change-placeholder" placeholder="From Time" data-original-title="This Field is required" title="" style="background-color:#711A2A;" >
                                            <div class="input-group-prepend">
                                                <span class="fa fa-clock-o input-group-text"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group clockpicker"  data-autoclose="true">
                                            <input type="text" id="to_time" name="to_time" class="form-control change-placeholder" placeholder="To Time" data-original-title="This Field is required" title="" style="background-color:#711A2A;" >
                                            <div class="input-group-prepend">
                                                <span class="fa fa-clock-o input-group-text"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="custom_label" for="title">Booking title</label>
                                    <input class="custom_field" name="title" type="text" data-original-title="This Field is required" title="" tabindex="7">
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="street_address">Street Address</label>
                                    <input class="custom_field" name="street_address" type="text" data-original-title="This Field is required" title="" tabindex="8">
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="street_address2">Street Address 2</label>
                                    <input class="custom_field" name="street_address2" type="text" data-original-title="This Field is required" title="" tabindex="9">
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <?php
                                            $dynamic_val = rand();
                                            ?>
                                            <label class="custom_label" for="city" >City</label>
                                            <input id="city<?= $dynamic_val; ?>" class="custom_field searching" dynamic_val="<?= $dynamic_val; ?>" name="city" type="text" data-original-title="This Field is required" autocomplete="off" title="" tabindex="10">
                                            <?= $this->Form->hidden('check_city' . $dynamic_val); ?>
                                        </div>
                                        <!--                                        <div class="form-group search-box">
                                                                                    < $this->Form->control('city', ['class' => 'form-control searching', 'label' => false, 'autocomplete' => 'off', 'placeholder' => 'City', 'required', 'templates' => ['inputContainer' => '{{content}}']]); ?>
                                        
                                                                                </div> -->
                                        <div class="input-group search-result" id="search-result<?= $dynamic_val; ?>" style="top:52px;border:none;">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!--                                        <div class="col form-group"> 
                                                                                    < $this->Form->control('state', ['class' => 'form-control minimal', 'empty' => '- State -', 'options' => array(), 'label' => false, 'required']); ?>
                                                                                </div>-->
                                        <div class="form-group">
                                            <label class="custom_label" for="state">State</label>
                                            <select class="custom_field" id="state<?= $dynamic_val ?>" name="state_id" required tabindex="11">
                                                <option value="">- States -</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="custom_label" for="zip">zip</label>
                                            <input class="custom_field" tabindex="12" name="zip" type="text" data-original-title="This Field is required" title="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="custom_label" for="special_direction">Special Direction</label>
                                    <textarea class="custom_field" name="special_direction" tabindex="13"></textarea>
                                </div>
                            </div>
                            <div class="col-md-5 calendar_view" style="padding: 0 25px;">
                                <div class="col-md-12">
                                    <span class="fa fa-circle" style="color:#7B1A2D"></span> Booked/unavailable
                                </div>  
                                <div id="my-calendar"></div>
                            </div>
                            <div class="col-md-5 table_view" style="padding: 0 25px; display: none;">

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="custom_label" for="booking_purpose">Purpose of booking</label>
                                    <textarea tabindex="14" class="custom_field" name="booking_purpose" data-original-title="This Field is required" title=""></textarea>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="custom_label" for="personal_message">Personal Message</label>
                                    <textarea tabindex="15" class="custom_field" name="personal_message" data-original-title="This Field is required" title=""></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="custom_label" for="describe_event">Describe your event</label>
                                    <textarea tabindex="16" class="custom_field" rows="5" name="describe_event" data-original-title="This Field is required" title=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" style="text-align:center">

                                    <button tabindex="17" id="requestBooking" class="modal_btn" type="button" style="border:none;">Request the book</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="summary_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #F5F5F5 !important;">
                <div class="modal-header" style="display:block !important;padding: 0 10px;border-bottom: none;">
                    <button type="button" class="close close_summary_modal">&times;</button>
                </div>
                <div class="modal-body" id="dynamic_content">

                </div>
                <div class="modal-footer" style="text-align: right;padding-top: 0;border-top: unset;">
                    <a class="modal_btn close_summary_modal" style="border:none;color:white !important">Go back</a>
                    <a class="modal_btn" style="border:none;color:white !important" id="confirm_request">Confirm Booking</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function get_date(date) {
        //        alert(date);
    }
    function get_amount() {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot ?>EmployeeMembers/get_amount',
            data: $('#get_amount').serialize(),
            contentType: 'json',
            success: function (data)
            {
                $('.amount_style').text(data);

            }
        });
    }
    // new Date("dateString") is browser-dependent and discouraged, so we'll write
// a simple parse function for U.S. date format (which does no error checking)
    function parseDate(str) {
        var mdy = str.split('/');
        return new Date(mdy[2], mdy[0] - 1, mdy[1]);
    }

    function datediff(first, second) {
        // Take the difference between the dates and divide by milliseconds per day.
        // Round to nearest whole number to deal with DST.
        return Math.round((second - first) / (1000 * 60 * 60 * 24));
    }

    function validate_booking() {
        var event_type = $('#booking_form input[name=modal_event_type]:checked').val();
        if (event_type == 1) {
            $('#time_range').show();
        } else {
            $('#time_range').hide();
        }

        if ($('#from_date').val() && $('#to_date').val()) {
            var date_diff = datediff(parseDate($('#from_date').val()), parseDate($('#to_date').val()));
            if (event_type == 1 && date_diff > 1) {
                show_custom_message('24 hours of time is allowed in hourly events.');
                return false;
            }
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/validate_bookings',
                data: 'from_date=' + $('#from_date').val() + '&to_date=' + $('#to_date').val() + '&talent=' +<?= $userInfo->id; ?> + '&event_type=' + event_type,
                success: function (data)
                {
                    data = JSON.parse(data);
                    if (data.event_type == 1) {
                        if (data.is_success == 0) {
                            show_custom_message('<span class="error">' + data.message + '</span>');
                        } else {
                            $('#time_range').show();
                        }
                        $('.table_view').html(data.html);
                        $('.calendar_view').hide();
                        $('#booking_form input[name=from_time]').val($('#booking_form input[name=hour]').val());
                        $('.table_view').show();

                    } else {
                        if (data.is_success == 0) {
                            show_custom_message('<span class="error">' + data.message + '</span>');
                        }
                        $('.table_view').html('');
                        $('.table_view').hide();
                        $('.calendar_view').show();
                        $('#time_range').hide();

                    }

                }
            });
        }
    }
    function show_summary() {
        $('#myModal').modal('hide');
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->request->webroot ?>EmployeeMembers/validateForm',
            data: $('#booking_form').serialize(),
            success: function (data)
            {
                $('#dynamic_content').html(data);
                setTimeout(function () {
                    $('#summary_modal').modal('show');
                }, 500);
            }
        });
    }
    $(document).ready(function () {
        $('#booking_form input[name=hour]').change(function () {
            $('#booking_form input[name=from_time]').val($('#booking_form input[name=hour]').val());
        });
        $('#booking_form input[name=from_time]').change(function () {
            $('#booking_form input[name=hour]').val($('#booking_form input[name=from_time]').val());
        });
        $('input[name=total_hours]').change(function () {
            var amount =<?php echo $total_amount; ?>;
            var total_hours = amount * $('input[name=total_hours]').val();
            $('#hourly_amount').text('Amount: $ ' + total_hours);
        });
        $("input[name=modal_event_type]").change(function () {
            if (typeof $("input[name=modal_event_type]:checked").val() != 'undefined') {
                if ($("input[name=modal_event_type]:checked").val() == 1) {
                    $('#hour_quantity').show();
                } else {
                    $('#hour_quantity').hide();
                }
            }
        });
        $('#confirm_request').click(function () {
            $('#booking_form').submit();
        });
        $('.close_summary_modal').click(function () {
            $('#summary_modal').modal('hide');
            setTimeout(function () {
                $('#myModal').modal('show');
            }, 500);
        });
        $('#register').click(function () {
            $('#booking_requirement_modal').modal('hide');
            setTimeout(function () {
                $('#myModal').modal('show');
            }, 500);
        });
        $('#requestBooking').click(function () {
            //            first validate the form
            var check = 0;
            $("form#booking_form :input[type=text]").each(function () {

                if (typeof $(this).attr('name') != 'undefined' && $(this).attr('name') != 'total_hours') {
                    if ($(this).attr('name') != 'street_address2' && $(this).attr('name') != 'from_time' && $(this).attr('name') != 'to_time') {
                        if (!$(this).val())
                        {
                            check = 1;
                            $(this).tooltip("show");
                            $(this).focus();
                            return false;
                        }
                    }

                }
            });
            if (check == 0) {
                if (typeof $("input[name=modal_event_type]:checked").val() == 'undefined') {

                    show_custom_message('Event type must be selected');
                    return false;
                } else {
                    if ($("input[name=modal_event_type]:checked").val() == 1) {
                        if (!$("input[name=from_time]").val())
                        {
                            check = 1;
                            $("input[name=from_time]").tooltip("show");
                            $("input[name=from_time]").focus();
                            return false;
                        }
                        if (!$("input[name=to_time]").val())
                        {
                            check = 1;
                            $("input[name=to_time]").tooltip("show");
                            $("input[name=to_time]").focus();
                            return false;
                        }
                    }
                }
                if (!$("textarea[name=describe_event]").val()) {
                    setTimeout(function () {
                        $("textarea[name=describe_event]").tooltip("show");
                        $("textarea[name=describe_event]").focus();
                    }, 0);
                    return false;
                }
                if (!$("textarea[name=booking_purpose]").val()) {
                    setTimeout(function () {
                        $("textarea[name=booking_purpose]").tooltip("show");
                        $("textarea[name=booking_purpose]").focus();
                    }, 0);
                    return false;
                }
                if (!$("textarea[name=personal_message]").val()) {
                    setTimeout(function () {
                        $("textarea[name=personal_message]").tooltip("show");
                        $("textarea[name=personal_message]").focus();
                    }, 0);
                    return false;
                }


                var event_type = $('#booking_form input[name=modal_event_type]:checked').val();
                var from_time = $('#booking_form input[name=from_time]').val();
                var to_time = $('#booking_form input[name=to_time]').val();

                var date_diff = datediff(parseDate($('#from_date').val()), parseDate($('#to_date').val()));
                if (event_type == 1 && date_diff > 1) {
                    show_custom_message('24 hours of time is allowed in hourly events.');
                    return false;
                }
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->request->webroot ?>EmployeeMembers/validate_bookings',
                    data: 'from_date=' + $('#from_date').val() + '&to_date=' + $('#to_date').val() + '&talent=' +<?= $userInfo->id; ?> + '&event_type=' + event_type + '&from_time=' + from_time + '&to_time=' + to_time,
                    success: function (data)
                    {
                        data = JSON.parse(data);
                        console.log(data);
                        if (data.is_success == 1) {
                            show_summary();
                        } else {
                            show_custom_message(data.message);
                            return false;
                        }
                    }
                });


            }
        });
        $('#from_date').change(function () {
            $('#to_date').val('');
            $('#booking_form input[name=modal_event_type]').prop('checked', false);
        });
        $('#to_date').change(function () {
            $('#booking_form input[name=modal_event_type]').prop('checked', false);
            if ($('#from_date').val() == '') {
                $('#to_date').val('');
                alert('Select From date first');
            }
            if (new Date($('#from_date').val()) > new Date($('#to_date').val()))
            {
                $('#to_date').val('');
                alert('invalid End date');
            }
        });
        $('#booking_form input[name=modal_event_type]').change(function () {
            validate_booking();
        });
        $("#my-calendar").zabuto_calendar({
            ajax: {
                url: "<?php echo $this->request->webroot . 'EmployeeMembers/calendardates?talent_id=' . $userInfo->id; ?>"
            }
        });
        if (typeof $('input[name=event_type]:checked').val() != 'undefined') {
            get_amount();
        }
        $('input[name=event_type]').change(function () {
            get_amount();
        });
    }
    );</script>
<script>
    //plugin bootstrap minus and plus
    //http://jsfiddle.net/laelitenetwork/puJ6G/
    $('.btn-number').click(function (e) {
        e.preventDefault();
        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {
                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {

                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());
        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                        // Allow: home, end, left, right
                                (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });</script>
<script>
    $(function () {
        var dateToday = new Date();
        $(".datepicker").datepicker({
            //dateFormat: 'mm-dd-yy',
            minDate: 0
        });
    });</script>
<script type="text/javascript" src="<?= $this->request->webroot; ?>dist/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
    $('.clockpicker').clockpicker()
            .find('input').change(function () {
        console.log(this.value);
    });

</script>
