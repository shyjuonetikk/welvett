<?php

use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

$categoryservice = $talentEvent->eventcategory_id;
//$subcategoryservice=$_GET['subcatid'];
$talentservice = $talentEvent->id;
$conn = ConnectionManager::get('default');
$query = $conn->execute("SELECT s.statename,`c`.`id`, `c`.`city`,`c`.`state_id`, `c`.`accommodation_price` FROM `talent_events` AS `e` 
LEFT JOIN `talent_event_cities` AS `c` ON `e`.`id` = `c`.`talent_event_id` LEFT JOIN `states` AS `s` ON `s`.`id` = `c`.`state_id` where `e`.`id` = '$talentservice'");
$city_event = $query->fetchAll('assoc');

$query_booking = $conn->execute('SELECT amount,client_type,payment_type '
        . ' FROM talent_events  '
        . 'where talent_events.id=' . $talentservice);
$details_booking = $query_booking->fetchAll('assoc');
if ($details_booking) {
    $details_amount = $details_booking[0]['amount'];
    $details_type = $details_booking[0]['client_type'];
} else {
    $details_amount = '';
    $details_type = '';
}
$user_id = $talentEvent->user_id;
//debug($talentservice);exit;
?>

<style>
    .edit_profile {
        bottom: 56px;
        right: 55px;
    }
    .btn_remove{
        padding: unset;
        color: #6D6D6D;
    }
    .table tr td {
        background-color: #F5F5F5 !important;
        font-size: 12px !important;
    }

    div.zabuto_calendar .table tr.calendar-dow-header th {
        background-color: #F5F5F5 !important;
    }
    .test:after {
        content: '\2807';
        font-size: 2em;
        color: #939393;
    }
</style>
<style>


</style>
<!-- Zabuto Calendar -->
<script src="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<?php
$userids = $this->request->session()->read('Auth.User.id');
//debug($events['id']);
?>

<section class="content-wrapper header_bgnew" style="">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-12 col-lg-12 text-center">
                <div style="padding-top: 10px;">

                    <span class="dashbord_btn" style="font-size:24px;"><img class="dashboard_image" style="" src="<?php echo $this->request->webroot; ?>img/dashboard_icon.jpg" alt="<?php echo $this->request->session()->read('Auth.User.first_name'); ?>" /><?= $talentEvent->eventcategory->title; ?> Dashboard</span>
                </div>
                <div class="service_name">
                    <?php
                    if ($membership) {
                        $proDetails = 'col-md-8 col-lg-8 col-xl-4 border_right_me';
                        $calendarClasses = 'col-md-4 col-lg-4 col-xl-4 border_right_me text-center';
                        ?>

                        <?php
                    } else {
                        $proDetails = 'col-md-4 col-lg-4 col-xl-4 border_right_me';
                        $calendarClasses = 'col-md-4 col-lg-4 col-xl-4 border_right_me text-center';
                        ?>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<section class="content-wrapper content_bg" style="padding-top: 50px;">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-lg-3 col-xl-3 border_right_me text-center credit_card_div">
                <div class="text-center credit_card_bank" id="basic_info" style="background: #F5F5F5 !important;">
                    <div class="row" >
                        <div class="col-md-12 col-lg-12">
                            <div style="border-bottom: 2px solid #acacac; padding-bottom: 30px; margin: 0 20px;">
                                <label class="dashboard_labels" style="padding-bottom: 10px;">
                                    Link my Bank Account
                                </label>
                                <div class="credit_earning_box">
                                    <!--<p style="padding-left: 10px; padding-top: 8px;" class="text-uppercase text-left">Credit Card</p>-->
                                    <p style="text-align: center !important;font-weight: bold;padding-top: 30px;" class="text-uppercase text-left">Coming soon</p>
                                </div>

                            </div>
                            <div>
                                <div>
                                    <label style="color: #8f8f8f; font-size: 12px; margin: 0;">
                                        <span style="border: none !important; font-size: 12px;">
                                            Account :
                                        </span> 
                                        <?php echo $this->request->session()->read('Auth.User.first_name') . ' ' . $this->request->session()->read('Auth.User.last_name'); ?>
                                    </label>

                                </div>
                                <div>
                                    <label style="color: #8f8f8f; font-size: 12px; margin: 0;">
                                        <span style="border: none !important; font-size: 12px;">
                                            Cart Status :
                                        </span> 
                                        Active
                                    </label>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-8 col-lg-9 col-xl-9" style="">
                <div class="credit_card_bank" id="">

                    <div class="row" >
                        <div class="col-md-6 col-lg-6 col-xl-3 text-center my_earnings" >
                            <div class="">
                                <label class="dashboard_labels">My Earnings</label>
                                <div class="clearfix">&nbsp;</div>
                                <div class="credit_earning_box" style="width:180px;">
                                    <div class="row">
                                        <div class="arrow_btn col-md-2" style="text-align:right;padding:0;">
                                            <i class="fa fa-caret-left" id="previous_month" onclick="change_earning('<?php echo date("Y-m", strtotime("-1 month")) ?>')" style="cursor:pointer"></i>
                                        </div>
                                        <div class="earning_btn col-md-8" style="padding:0;padding-top:5px;font-size: 13px">
                                            Earning in <span id="show_month"><?php echo date("F"); ?></span>
                                        </div>
                                        <div class="arrow_btn col-md-2" style="text-align:left;padding:0;">
                                            <i class="fa fa-caret-right" id="next_month" onclick="change_earning('<?php echo date("Y-m", strtotime("+1 month")) ?>')" style="cursor:pointer"></i>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="text-align:right;text-align: right;font-size:20px;padding: 40px 25px 0 0;">
                                            $ <span id="total_earning"><?php echo ($totalEarning) ? $totalEarning : 0; ?></span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-5 col-xl-3 text-center" >
                            <div style="">
                                <label class="text-center dashboard_labels">Booking Price</label>

                                <div class="clearfix">&nbsp;</div>
                                <form action="" id="set_amount">
                                    <div class="booking_price" style="">
                                        <div class="" style="padding: 10px;">
                                            <span class="input-group-btn">
                                                <button style="padding: 3px 8px;" type="button" class="inc_dec btn-number" disabled="disabled" data-type="minus" data-field="set_amount">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                            </span>
                                            <span id="bookingamount">
                                                <input type="hidden" name="service_id"  value="<?php echo $talentEvent->id; ?>">
                                                <?php
                                                $amount = 0;
                                                if (!empty($talentEvent->event_types)) {
                                                    $amount = $talentEvent->event_types[0]->amount;
                                                }
                                                ?>
                                                $ <input style="background: transparent;width: 27%!important" type="text" name="set_amount" class="inc_dec_field input-number"  value="<?php echo $amount; ?>" min="1" max="10000" >
                                            </span>

                                            <span class="input-group-btn" style="margin-left: 10px;">
                                                <button style="padding: 3px 8px;" type="button" class="inc_dec btn-number" data-type="plus" data-field="set_amount">
                                                    <span class="fa fa-plus"></span>
                                                </button>
                                            </span> 
                                        </div>
                                    </div>


                                    <div class="text-center" id="event_payment_type">
                                        <?php
                                        $c = '';
                                        if (empty($talentEvent->event_types)) {
                                            $c = 'checked';
                                        }
                                        ?>
                                        <label class="font_12" for="event_type_hourly" >
                                            <input id="event_type_hourly" type="radio" name="event_type" value="1" <?= (isset($talentEvent->event_types[0]) && $talentEvent->event_types[0]->event_type == 1) ? 'checked' : ''; ?> <?= $c; ?>>
                                            Hourly
                                        </label>
                                        &nbsp;&nbsp;&nbsp;
                                        <label class="font_12" for="event_type_whole">
                                            <input id="event_type_whole" type="radio" value="2" name="event_type" <?= (isset($talentEvent->event_types[0]) && $talentEvent->event_types[0]->event_type == 2) ? 'checked' : ''; ?>> 
                                            Whole Event 
                                        </label>

                                        <button type="submit" class="modal_btn" type="submit"  id="bookingtype" style="border:none;color:white; background:#7b1b2d;border-radius: 3px; font-size: 12px;">Save</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-6 text-center" >
                            <div style="">
                                <label class="dashboard_labels">Statistics</label>

                                <div class="dashbord_text_color" style=" font-size: 20px; color: #F5F5F5;"> 
                                    <!--<img style="max-width: 100%;" src="<?php // echo $this->request->webroot                                                                                                                                                                                                                                                                   ?>img/stats.jpg"/>-->
                                    <p style="color: #8f8f8f !important;text-align: center !important;font-weight: bold;padding-top: 30px;" class="text-uppercase text-left">Coming soon</p>

                                </div>

                            </div>

                        </div>



                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<section class="content-wrapper content_bg" >
    <div class="container">
        <div class="row">
            <?php
            if (!$membership) {
                ?>
                <div class="<?php echo $proDetails; ?>" style="">
                    <div class="box_bg" style="min-height: 250px;">
                        <div class="">
                            <div class="" style=" ">
                                <div class="free_vs_pro" style="margin-top: 10px !important; padding-bottom: 20px;">
                                    <label class="compare_type">Compare License Types</label>

                                    <table class="license_table">
                                        <tr>
                                            <th style="width: 60%;"></th>
                                            <th style="width: 20%; text-align: center; color: #9c9c9c;">Basic </th>
                                            <th style="width: 20%; text-align: center;">
                                                <!--                                            <button class="pro_btn"><i></i> Pro</button>-->
                                                <img src="<?php echo $this->request->webroot; ?>img/up_pro.png" alt="Upgrade to pro">
                                            </th>
                                        </tr>
                                        <tr style="border-bottom:1px solid #acacac;">
                                            <td style="width: 60%;">Instant messaging</td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #acacac;">
                                            <td style="width: 60%;">Whole event + hourly price</td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #acacac;">
                                            <td style="width: 60%;">Unlimited bookings</td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #acacac;">
                                            <td style="width: 60%;">Get booked in your register city</td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #acacac;">
                                            <td style="width: 60%;">Get booked in desired city</td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/cross.png" width="20"/></td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #acacac;">
                                            <td style="width: 60%;">Get your clientele</td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/cross.png" width="20"/></td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #acacac;">
                                            <td style="width: 60%;">Low commission rate</td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/cross.png" width="20"/></td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                        </tr>
                                        <tr style="border-bottom:1px solid #acacac;">
                                            <td style="width: 60%;">Higher visibility rate</td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/cross.png" width="20"/></td>
                                            <td style="width: 20%; text-align: center;"><img src="<?php echo $this->request->webroot ?>img/tick.PNG" width="20"/></td>
                                        </tr>

                                    </table>
                                    <div class="clearfix">&nbsp;</div>
                                    <?php if (!$membership) { ?>
                                        <div class="text-center">
                                            <a class="upgrade_to_pro" href="#" data-toggle="modal" data-target="#myModal">Upgrade to <img src="<?php echo $this->request->webroot; ?>img/up_pro.png" alt="" style="margin-left: 5px;"></a>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>


                            <?php echo $this->element('inc/updtaetopro'); ?>   

                        </div>

                    </div>

                </div>
            <?php } ?>

            <?php
            if ($membership) {
                ?>
                <div class="col-md-4 col-lg-4 col-xl-4 border_right_me" style="">
                    <div class="box_bg" style="margin-top: 10px; padding: 10px 0px;">
                        <div style="margin: 1px 2px 0px 5px;">
                            <label id="add_accomod" style="color:#7b1b2d;font-size: 14px; font-weight: bold;">
                                Add Accomodation fee
                            </label>
                            <span class="pull-right" style="padding-right: 10px;"><img style="height: 20px;" src="<?php echo $this->request->webroot; ?>img/pro.png" alt=""></span>
                        </div>

                        <table class="text-center acco_fee_table" style="font-size: 13px;width:75%;">
                            <thead>
                                <tr>
                                    <th style="width:60px;">City</th>
                                    <th style="width:60px;">State</th>
                                    <th style="width:60px;">Price</th>
                                    <th style="width:60px;">Action</th>
                            </thead>
                            <tbody id="accomodation_cities">
                                <?php
                                foreach ($city_event as $city_events):


                                    //                                    if ($city_events['accommodation_price'] != 0) {
                                    ?>
                                    <tr style="">
                                        <td style="width:60px;"><?= h($city_events['city']) ?></td>
                                        <td style="width:60px;"><?= h($city_events['statename']) ?></td>
                                        <td style="width:60px;"><?= ($city_events['accommodation_price']) ? $city_events['accommodation_price'] : 0; ?></td>
                                        <td style="width:60px;">
                                            <input type="hidden" class="event_city_id" value="<?php echo $city_events['id']; ?>">
                                            <i class="fa fa-trash-o delete_acco_city cities_links"></i>&nbsp;
                                            <i class="fa fa-edit cities_links" onclick='edit_city(<?= $city_events['id'] ?>)'></i>
                                        </td>
                                    </tr>
                                    <?php
                                    //                                    }
                                endforeach;
                                ?>
                            </tbody>
                        </table>

                        <div>
                            <a class=""  data-toggle="modal" data-target="#myModal2" style="border:none;color:#7b1b2d; background: none;font-size: 12px; width: 70px;height: 25px; padding-left: 15px; "> <span class="plus_bg"><i class="fa fa-plus plus_color"></i></span> Add cities</a>
                        </div>
                    </div>


                    <div class="clearfix">&nbsp;</div>
                    <div class="" >
                        <div class="box_bg" style="padding-bottom: 10px;">
                            <div style="margin: 1px 2px 0px 5px;">
                                <label class="dashboard_labels" style="margin: 0; font-size: 12px; padding-left: 10px; padding-top: 5px;" for="client_type">Choose your customer</label>
                                <span class="pull-right" style="padding-right: 10px;"><img style="height: 20px;" src="<?php echo $this->request->webroot; ?>img/pro.png" alt=""></span>
                            </div>

                            <div class="" style="margin-left: 15px;">
                                <?php
                                $both = '';
                                if ($details_type == null) {
                                    $both = 'checked';
                                }
                                ?>
                                <div style="margin: 10px 0px;">
                                    <label class="clientele_style" style="" for="individual"> Individual Member
                                        <input class="pull-right" type="checkbox" name="client_type[]"  <?php
                                        if ($details_type == 2) {
                                            echo 'checked="checked"';
                                        }
                                        ?> value="2" id="individual" <?= $both ?> >
                                    </label> 

                                    <label class="clientele_style" style="" for="corporate"> Corporate Member 
                                        <input class="pull-right" type="checkbox" name="client_type[]" <?php
                                        if ($details_type == 3) {
                                            echo 'checked="checked"';
                                        }
                                        ?>  value="3" id="corporate" <?= $both ?> >
                                    </label>


                                </div>
                            </div>

                            <div style="padding-right: 15px;">
                                <button type="button" class="pull-right" type="submit"  id="clienttype" style="border:none; color:white; background:#7b1b2d; border-radius: 3px; font-size: 12px; padding: 2px 15px;">Save</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>


                </div>

            <?php } ?>

            <div class="col-md-4 col-lg-4 col-xl-4 border_right_me" style="">
                <div class="box_bg" style="margin-top: 10px; padding: 10px 0px;">
                    <div style="margin: 1px 2px 0px 5px;">
                        <label id="add_accomod" style="color:#7b1b2d;font-size: 14px; font-weight: bold;">
                            Add Reference link
                        </label>
                        <span class="pull-right" style="padding-right: 10px;"><img style="height: 20px;" src="<?php echo $this->request->webroot; ?>img/pro.png" alt=""></span>
                    </div>

                    <table class="text-center acco_fee_table" style="font-size: 13px;width:75%;">
                        <thead>
                            <tr>
                                <th style="width:60px;">Title</th>
                                <th style="width:60px;">Action</th>
                        </thead>
                        <tbody id="accomodation_cities">
                            <?php
                            foreach ($talentEvent->refrence_links as $link):
                                ?>
                                <tr style="">
                                    <td style="width:60px;">
                                        <a href="<?php echo $link->link; ?>"style="border:none;color:#7b1b2d;" target="_blank">
                                            <?= $link->title ?>
                                        </a>
                                    </td>
                                    <td style="width:60px;">
                                        <i class="fa fa-trash-o cities_links" onclick='delete_link(<?= $link->id; ?>)' id="delete_link<?= $link->id; ?>"></i>&nbsp;
                                        <i class="fa fa-edit cities_links" onclick='edit_link(<?= $link->id; ?>)'></i>
                                    </td>
                                </tr>
                                <?php
                                //                                    }
                            endforeach;
                            ?>
                        </tbody>
                    </table>

                    <div>
                        <a data-toggle="modal" data-target="#referenceModal" style="border:none;color:#7b1b2d; background: none;font-size: 12px; width: 70px;height: 25px; padding-left: 15px; "> <span class="plus_bg"><i class="fa fa-plus plus_color"></i></span> Add Link</a>
                    </div>
                </div>
            </div>
            <div class="<?php echo $calendarClasses; ?>" style="">
                <div class="row" style="background-color:#F5F5F5;padding: 15px 10px 5px 10px; margin: 0px; margin-top: 10px;">
                    <div class="col-xs-4 col-sm-3 col-md-2 c_icon">
                        <span class="fa fa-calendar" style="font-size: 24px;background-color: #7B1B2D;color: white;padding: 10px;border-radius: 4px;"></span>
                    </div>
                    <div class="col-xs-6 col-sm-7 col-md-8 c_title" style="text-align:left; padding-left: 25px;">
                        <h5 style="font-size: 1.1rem;color:#939393;font-weight: bold;text-align:left; margin-bottom:0 !important;">
                            My Calendar
                        </h5>
                        <span style="color:#939393;font-size: 14px"><?= date('M d, Y') ?></span>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 c_btn" style="text-align: right;padding: 0;">
                        <span data-original-title="Block Availability!" class="fa fa-lock" data-toggle="modal" data-target="#block_days" style="cursor:pointer;font-size:22px;"></span>
                    </div>
                </div>
                <div class="row" style="background-color:#F5F5F5; margin: 0px;">
                    <div class="col-md-12">
                        <div id="my-calendar"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<div class="modal fade" id="block_days" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="background-color: #F5F5F5 !important;">
            <div class="modal-header" style="display:block !important;padding: 0 10px;border-bottom: none;">
                <button type="button" class="close"  data-dismiss="modal">&times;</button>
            </div>

            <form action="<?php echo $this->request->webroot ?>EmployeeMembers/block_dates" method="post" id="block_calendar_form" >
                <div class="modal-body" id="dynamic_content">
                    <div class="row">
                        <div class="mb-3 col-md-6 modal_btn_div">

                            <input id="talent_event_id" name="talent_event_id" value="<?= $talentservice; ?>" type="hidden">
                            <input id="from_date" type="text" name="from_date" class="form-control change-placeholder datepicker"  placeholder="Start date" data-original-title="This Field is required" title="" style="background-color:#711A2A;">
                            <div class="input-group-prepend">
                                <span class="fa fa-calendar input-group-text"></span>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 modal_btn_div">
                            <input type="text" id="to_date" name="to_date" class="form-control change-placeholder datepicker" placeholder="End date" data-original-title="This Field is required" title="" style="background-color:#711A2A;" >
                            <div class="input-group-prepend">
                                <span class="fa fa-calendar input-group-text"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer" style="text-align: right;">
                <button id="add_to_calendar" class="modal_btn" style="border:none;color:white !important">Add to calendar</button>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h5 class="modal-title">Add Cities and Accommodation</h5>
            </div>


            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <form action="<?php echo $this->request->webroot ?>EmployeeMembers/addcities" name="add_name" method="post" id="add_name">

                            <input type="hidden" name="talent"  value="<?php echo $talentservice; ?>" placeholder=""  class=""  style=" "/>
                            <table class="table table-bordered" id="dynamic_field" style="">
                                <thead>
                                <th>City</th>
                                <th>State</th>
                                <th>Acco &#36;</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="position:relative;">
                                            <!--<input type="text" name="name[]" style="height: 25px;" placeholder="city" class="custom_field" data-original-title="This Field is required" title="" />-->
                                            <div class="search-box" style="background:unset;">
                                                <input name="name[]" class="custom_field searching" autocomplete="off" placeholder="City" required="required" id="city" type="text">
                                                <?= $this->Form->hidden('check_city'); ?>
                                            </div> 
                                            <div class="search-result" id="search-result" style="border:none;">
                                                <div class="clearfix"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <select name="state_id[]" class="minimal" required="required" id="state" style="border:none;">
                                                <option value="">- State -</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="amount[]"  placeholder="amount" class="custom_field" required style="height: 25px;" />
                                        </td>
                                        <td>
                                            <span style="padding: 4px; margin-left: 10px;" id="" onclick="btn_remove()" class="fa fa-trash-o btn_remove"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>

                <br/>
            </div>
            <div class="modal-footer" style="text-align:right">

                <button type="button" class="btn btn-default btn-sm"  name="add" id="add">Add More</button>
                <button type="button" class="btn btn-default btn-sm" type="submit"  id="addcities">Save</button>

                <button type="button" class="btn btn-default btn-sm" id='close' data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="edit_city_modal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h5 class="modal-title">Edit City</h5>
            </div>


            <div class="modal-body">
                <form id="edit_city_form" method="post" action="<?php echo $this->request->webroot ?>EmployeeMembers/edit_cities">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="city_id"  value="" placeholder=""  class=""  style=""/>
                            <!--<input type="text" name="city_name"    placeholder="city"  class="custom_field searching"  required  style="height: 35px;" data-original-title="This Field is required" title="">-->
                            <?php
                            $random_dynamic_val = rand();
                            ?>
                            <!--<input type="text" name="name[]" style="height: 25px;" placeholder="city" class="custom_field" data-original-title="This Field is required" title="" />-->
                            <div class="search-box" style="background:unset;height: 100%;">
                                <input dynamic_val="<?= $random_dynamic_val; ?>" name="city_name" class="custom_field searching" autocomplete="off" placeholder="City" required="required" id="city<?= $random_dynamic_val; ?>" type="text" style="height: 100%;" data-original-title="This Field is required" title="">
                                <?= $this->Form->hidden('check_city' . $random_dynamic_val); ?>
                            </div> 
                            <div class="search-result" id="search-result<?= $random_dynamic_val; ?>" style="border:none;">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding:0">
                            <select name="state_id" class="minimal" required="required" id="state<?= $random_dynamic_val ?>" style="border:1px solid #ccc; padding: 10px 0;">
                                <option value="">- State -</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="city_amount"  placeholder="amount"  class="custom_field" required  style="height: 100%;">
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-12" style="text-align: right;margin-top: 15px;">
                        <button type="button" class="btn btn-default btn-sm" type="submit"  id="editcities">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id='modalhide'>
    <div class="modal fade"  id="myModal1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                    <h5 class="modal-title">Add Radius</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label for="message" class="col-md-3 control-label">Add Cities</label>
                        <div class="col-md-9">
                            <form name="add_radius" method="post" action="<?php echo $this->request->webroot ?>EmployeeMembers/addcities" id="add_radius">
                                <table class="" id="dynamic_field2" style="background: #F5F5F5;">
                                    <tr>
                                        <td style="background-color:white;">
                                            <input type="text" name="name[]"   placeholder="city"  class="custom_field"  required  style="width: 200px;height: 35px;" data-original-title="This Field is required" title="">
                                            <input type="hidden" name="talent"  value="<?php echo $talentservice; ?>" placeholder=""  class=""  style=" "/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>

                    <br/>
                </div>
                <div class="modal-footer" style="text-align:right">
                    <button type="button" class="btn btn-default btn-sm"  name="add" id="addmore">Add More</button>
                    <button type="button" class="btn btn-default btn-sm" type="submit"  id="addradius">Save</button>
                    <button type="button" class="btn btn-default btn-sm"   data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="referenceModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h5 class="modal-title">Add Any reference link if you have</h5>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="referenceLinkForm" action="<?php echo $this->request->webroot ?>EmployeeMembers/addReference" method="post">
                            <div class="row">
                                <label for="title" class="col-md-12">
                                    Title   
                                </label>
                                <div class="col-md-12">
                                    <input type="hidden" name="talent_event_id" value="<?php echo $talentservice ?>" >
                                    <input class="custom_field" name="title" style="width:100%" required>   
                                </div>
                            </div>
                            <div class="row">
                                <label for="title" class="col-md-12">
                                    Reference link   
                                </label>
                                <div class="col-md-12">
                                    <input class="custom_field" name="link" style="width:100%" required>   
                                </div>
                            </div>
                            <div class="row" style="padding-top:10px;">
                                <div class="col-md-12" style="text-align:right">
                                    <button class="btn btn-default">Submit</button>   
                                </div>                                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="referenceModalEdit" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h5 class="modal-title">Edit Reference link</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="editLinkForm" action="<?php echo $this->request->webroot ?>EmployeeMembers/editReference" method="post">
                            <div class="row">
                                <label for="title" class="col-md-12">
                                    Title   
                                </label>
                                <div class="col-md-12">
                                    <input type="hidden" name="link_id" value="" >
                                    <input type="hidden" name="talent_event_id" value="" >
                                    <input class="custom_field" name="title" style="width:100%" required>   
                                </div>
                            </div>
                            <div class="row">
                                <label for="title" class="col-md-12">
                                    Reference link   
                                </label>
                                <div class="col-md-12">
                                    <input class="custom_field" name="link" style="width:100%" required>   
                                </div>
                            </div>
                            <div class="row" style="padding-top:10px;">
                                <div class="col-md-12" style="text-align:right">
                                    <button class="btn btn-default">Submit</button>   
                                </div>                                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function edit_link(l_id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot ?>EmployeeMembers/get_link',
            data: 'link_id=' + l_id,
            success: function (data)
            {
                data = JSON.parse(data);
                if (data.flag == 1) {
                    $('#editLinkForm input[name=link_id]').val(data.data.id);
                    $('#editLinkForm input[name=talent_event_id]').val(data.data.talent_event_id);
                    $('#editLinkForm input[name=title]').val(data.data.title);
                    $('#editLinkForm input[name=link]').val(data.data.link);
                    $('#referenceModalEdit').modal('show');
                } else {

                }
                console.log(data);
            }
        });
    }
    function delete_link(l_id) {
        if (confirm('Are you sure')) {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/deleteReference',
                data: 'link_id=' + l_id,
                success: function (data)
                {
                    data = JSON.parse(data);
                    if (data.flag == 1) {
                        $('#delete_link' + l_id).parent('td').parent('tr').remove();

                    }
                    show_custom_message(data.message);
                }
            });
        }
    }
    function edit_city(c_id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo $this->request->webroot ?>EmployeeMembers/get_city',
            data: 'id=' + c_id,
            success: function (data)
            {
                data = JSON.parse(data);
                if (data != 'error') {
                    var dynamic_val = $('#edit_city_form input[name=city_name]').attr('dynamic_val');
                    $('#edit_city_form input[name=city_id]').val(data.city.id);
                    $('#edit_city_form input[name=city_name]').val(data.city.city);
                    $('#edit_city_form input[name=city_amount]').val(data.city.accommodation_price);
                    $('#edit_city_modal').modal('show');
                    $('#state' + dynamic_val).empty();
                    $('#state' + dynamic_val).append("<option value=''>- States -</option>");

                    $.each(data.states, function (key, value) {
                        var selected = '';
                        if (data.city.state_id == value.id) {
                            selected = 'selected';
                        }
                        $('#state' + dynamic_val)
                                .append("<option value='" + value.id + "' " + selected + ">" + value.statename + "</option>");
                    });
                } else {
                    show_custom_message('Record not found');
                }

            }
        });
    }
    function btn_remove(btn) {
        $('#row' + btn).remove();
    }
    function btn_remove1(btn) {
        $('#rowRadius' + btn).remove();
    }
    function change_earning(month) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot ?>EmployeeMembers/change_earning',
            data: 'month=' + month + '&service=' +<?= $talentservice ?>,
            success: function (data)
            {
                data = JSON.parse(data);
                $('#show_month').text(data.month_name);
                $('#total_earning').text(data.earning);
                $('#previous_month').attr('onclick', "change_earning('" + data.previous + "')");
                $('#next_month').attr('onclick', "change_earning('" + data.next + "')");
            }
        });
    }
    function get_date(get_date) {
        var new_date = get_date.split('-');
        new_date = new_date[1] + '/' + new_date[2] + '/' + new_date[0];
        $('#block_calendar_form input[name=from_date]').val(new_date);
        $('#block_calendar_form input[name=to_date]').val(new_date);
        $('#block_days').modal('show');
    }
    function isUrlValid(url) {
        return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
    }
    $(document).ready(function () {
        $('#referenceLinkForm').submit(function () {
            var url = $('#referenceLinkForm input[name=link]').val();
            if (isUrlValid(url)) {
            } else {
                show_custom_message('Invalid url');
                return false;
            }
        });
        $('#editLinkForm').submit(function () {
            var url = $('#editLinkForm input[name=link]').val();
            if (isUrlValid(url)) {
            } else {
                show_custom_message('Invalid url');
                return false;
            }
        });
        $('.fa-lock').hover(function () {
            $('.fa-lock').tooltip("show");
        });
        $('#editcities').click(function () {
            if (!$('#edit_city_form input[name=city_name]').val()) {
                $('input[name=city_name]').tooltip("show");
                return false;
            }
            $('#edit_city_form').submit();
        });
        $('#from_date').change(function () {
            $('#to_date').val('');
        });
        $('#to_date').change(function () {
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
                    data: 'from_date=' + $('#from_date').val() + '&to_date=' + $('#to_date').val() + '&talent=' +<?= $user_id; ?>,
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

        });
        $('#add_to_calendar').click(function () {
            if (!$('#from_date').val()) {
                $('#from_date').tooltip("show");
                $('#from_date').focus();
                return false;
            }
            if (!$('#to_date').val()) {

                $('#to_date').tooltip("show");
                $('#to_date').focus();
                return false;
            }
            $('#block_calendar_form').submit();
        });
        $('input[name=event_type]').change(function () {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/booktype',
                data: $('#set_amount').serialize() + '&fetch_amount=1',
                contentType: 'json',
                success: function (data)
                {
                    //                    alert($('input[name=event_type]:checked').val());
                    //                    if (data != 0) {
                    $('input[name=set_amount]').val(data);
                    //                    }
                }
            });
        });
        $('#add').click(function () {
            var i = $('#add_name input[name="name[]"]').length;
            var row = '<tr id="row' + i + '">';
            row = row + '<td style="position:relative;">'
                    + '<div class="search-box" style="background:unset;">'
                    + '<input name="name[]" dynamic_val="' + i + '" class="custom_field searching" autocomplete="off" placeholder="City" required="required" id="city' + i + '" type="text">'
                    + '<input name="check_city' + i + '" type="hidden"></div>'
                    + '<div class="search-result" id="search-result' + i + '" style="border: medium none;"></div>'
                    + '</td><td>'
                    + '<select name="state_id[]" class="minimal" required="required" id="state' + i + '" style="border:none;">'
                    + ' <option value="">- State -</option>'
                    + '</select>'
                    + ' </td>'
                    + '<td>'
                    + '<input name="amount[]" placeholder="amount" class="custom_field" required="" style="height: 25px;" type="text">'
                    + '</td>'
                    + ' <td>'
                    + '<span style="padding: 4px; margin-left: 10px;" id = "' + i + '" onclick = "btn_remove(' + i + ')" class="fa fa-trash-o btn_remove"></span>'
                    + '</td>'
                    + '</tr>';

            $('#dynamic_field').append(row);
        });
        $('#addcities').click(function () {
            var check = 0;
            $('#add_name input[name="name[]"]').each(function () {
                if (!$(this).val())
                {
                    check = 1;
                    $(this).tooltip("show");
                    $(this).focus();
                    return false;
                }

            });
            if (check == 0) {
                $('#add_name').submit();
            }
        });
        $('#addmore').click(function () {
            var j = $('#add_radius input[name="name[]"]').length;
            $('#dynamic_field2').append('<tr id="rowRadius' + j + '"><td style="width:250px;background-color: white !important;"><input type="text" name="name[]"   placeholder="city"  class="custom_field"  required  style="height: 35px; width:200px;" data-original-title="This Field is required" title=""><span id="' + j + '" onclick="btn_remove1(' + j + ')" class="fa fa-trash-o"></span></td></tr>');
        });
        $('.btn_remove1').on('click', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
        $('#addradius').click(function () {
            var check = 0;
            $('#add_radius input[name="name[]"]').each(function () {
                if (!$(this).val())
                {
                    check = 1;
                    $(this).tooltip("show");
                    $(this).focus();
                    return false;
                }

            });
            if (check == 0) {

                $('#add_radius').submit();
            }

        });
        $('#set_amount').submit(function () {
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/booktype',
                data: $('#set_amount').serialize(),
                contentType: 'json',
                success: function (data)
                {
                    var msg = '';
                    if ($('input[name=event_type]:checked').val() == 1) {
                        msg = 'Hourly booking price hasbeen saved';
                    }
                    if ($('input[name=event_type]:checked').val() == 2) {
                        msg = 'Booking price for whole event is saved';
                    }
                    if (data == 1) {
                        show_custom_message(msg);
                    }
                }
            });
            return false;
        });
        $('#clienttype').click(function () {
            var individual = '';
            var corporate = '';
            if (typeof $('#individual:checked').val() != 'undefined') {
                individual = $('#individual:checked').val();
            }
            if (typeof $('#corporate:checked').val() != 'undefined') {

                corporate = $('#corporate:checked').val();
            }

            var service = '<?php echo $categoryservice; ?>';
            var subservice = '';
            //            alert();
            var talentid = '<?php echo $talentservice; ?>';
            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/clienttype',
                data: 'individual=' + individual + '&corporate=' + corporate + '&service=' + service + '&subservice=' + subservice + '&talentid=' + talentid,
                contentType: 'json',
                success: function (data)
                {
                    var data = JSON.parse(data);
                    if (data.flag == 1) {
                        show_custom_message(data.message);
                    } else {
                        show_custom_message(data.message);
                    }
                }
            });
        });
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
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                $(this).val($(this).data('oldValue'));
            }


        });
        $("#my-calendar").zabuto_calendar({
            ajax: {
                url: "<?php echo $this->request->webroot . 'EmployeeMembers/calendardates?talent_id=' . $userids; ?>"

            }
        });
    });</script>
<script>

    $(document).ready(function () {
        //city deletion with amount
        $(document).on('click', '.delete_acco_city', function () {
            var eventCityId = $(this).siblings().val();
            if (eventCityId !== "") {

                $.ajax({
                    url: "<?php echo $this->request->webroot . 'EmployeeMembers/deleteAccoCity' ?>",
                    type: "POST",
                    data: {
                        'id': eventCityId
                    },
                    cache: false,
                    async: false,
                    success: function (data)
                    {
                        data = JSON.parse(data);
                        if (data[0] === 'success') {
                            $('#accomodation_cities').html(data[1]);
                            show_custom_message('City has been deleted.');
                        } else if (data[0] === 'error') {
                            show_custom_message('At least one city required for service.');
                        }

                    }

                });
            }
        });
    });
    $(function () {
        var dateToday = new Date();
        $(".datepicker").datepicker({
            minDate: 0
        });
    });
</script>


