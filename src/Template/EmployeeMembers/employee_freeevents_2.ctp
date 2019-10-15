<?php

use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

$categoryservice = $talentEvent->eventcategory_id;
//$subcategoryservice=$_GET['subcatid'];
$talentservice = $talentEvent->id;

$conn = ConnectionManager::get('default');
$query = $conn->execute("SELECT `c`.`id`, `c`.`city`, `c`.`accommodation_price` FROM `talent_events` AS `e` 
LEFT JOIN `talent_event_cities` AS `c` ON `e`.`id` = `c`.`talent_event_id` where `e`.`id` = '$talentservice'");
$city_event = $query->fetchAll('assoc');


$query_booking = $conn->execute('SELECT amount,client_type,payment_type '
        . ' FROM talent_events  '
        . 'where talent_events.id=' . $talentservice);
$details_booking = $query_booking->fetchAll('assoc');
//debug($details_booking);
if ($details_booking) {
    $details_amount = $details_booking[0]['amount'];
    $details_type = $details_booking[0]['client_type'];
} else {
    $details_amount = '';
    $details_type = '';
}
$user_id = $talentEvent->user_id;
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
                    <span class="dashbord_btn"><img class="dashboard_image" style="" src="<?php echo $this->request->webroot; ?>img/dashboard_icon.jpg" alt="<?php echo $this->request->session()->read('Auth.User.first_name'); ?>" /> Dashboard</span>
                </div>
                <div class="service_name">
                    <?php
                    if ($membership) {
                        $proDetails = 'col-md-8 col-lg-8 col-xl-5 border_right_me';
                        $calendarClasses = 'col-md-6 col-lg-6 col-xl-3 border_right_me text-center';
                        ?>

                        <p><?php echo $talentEvent->eventcategory->title; ?></p>
                        <?php
                    } else {
                        $proDetails = 'col-md-6 col-lg-6 col-xl-6 border_right_me';
                        $calendarClasses = 'col-md-6 col-lg-6 col-xl-6 border_right_me text-center';
                        ?>
                        <p><?php echo $user->employee_member->eventcategory->title; ?></p>
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
                                    <p style="text-align: center !important;font-weight: bold;padding-top: 30px;" class="text-uppercase text-left">Comming soon</p>
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
                        <div class="col-md-6 col-lg-3 col-xl-3 text-center my_earnings" >
                            <div class="">
                                <label class="dashboard_labels">My Earnings</label>
                                <div class="clearfix">&nbsp;</div>
                                <div class="credit_earning_box" style="">
                                    <div class="">
                                        Earning in month
                                    </div>
                                    <div style="margin: 30px 10px 0px 0px; float: right;">
                                        <?php echo ($totalEarning) ? $totalEarning : 0; ?> $
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 col-xl-3 text-center" >
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
                                                <input style="background: transparent;width: 27%!important" type="text" name="set_amount" class="inc_dec_field input-number"  value="<?php echo $amount; ?>" min="1" max="10000" > $
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
                        <div class="col-md-12 col-lg-6 col-xl-6 text-center" >
                            <div style="">
                                <label class="dashboard_labels">Statistics</label>

                                <div class="dashbord_text_color" style=" font-size: 20px; color: #F5F5F5;"> 
                                    <!--<img style="max-width: 100%;" src="<?php // echo $this->request->webroot               ?>img/stats.jpg"/>-->
                                    <p style="color: #8f8f8f !important;text-align: center !important;font-weight: bold;padding-top: 30px;" class="text-uppercase text-left">Comming soon</p>

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

            <?php
            if ($membership) {
                ?>
                <div class="col-md-4 col-lg-4 col-xl-2 border_right_me" style="">
                    <div class="box_bg" style="margin-top: 10px; padding-bottom: 5px;">
                        <div style="margin: 1px 2px 0px 5px;">
                            <label id="add_accomod" style="color:#7b1b2d;font-size: 12px; font-weight: bold;">
                                Add Accomodation fee
                            </label>
                            <span class="pull-right"><img style="height: 20px;" src="<?php echo $this->request->webroot; ?>img/pro.png" alt=""></span>
                        </div>

                        <table class="text-center acco_fee_table" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width:60px;"><?= $this->Paginator->sort('City') ?></th>
                                    <th style="width:60px;"><?= $this->Paginator->sort('Price') ?></th>
                                    <th style="width:60px;"><?= $this->Paginator->sort('Delete') ?></th>
                            </thead>
                            <tbody id="accomodation_cities">
                                <?php
                                foreach ($city_event as $city_events):

                                    if ($city_events['accommodation_price'] != 0) {
                                        ?>
                                        <tr style="">
                                            <td style="width:60px;"><?= h($city_events['city']) ?></td>
                                            <td style="width:60px;"><?= h($city_events['accommodation_price']) ?></td>
                                            <td style="width:60px;">
                                                <input type="hidden" class="event_city_id" value="<?php echo $city_events['id']; ?>">
                                                <i class="fa fa-times delete_acco_city"></i>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                endforeach;
                                ?>
                            </tbody>
                        </table>

                        <div>
                            <a class="" href=""  data-toggle="modal" data-target="#myModal2" style="border:none;color:#7b1b2d; background: none;font-size: 12px; width: 70px;height: 25px; margin-left: 5px;"> <span class="plus_bg"><i class="fa fa-plus plus_color"></i></span> Add cities</a>
                        </div>
                    </div>


                    <div class="clearfix">&nbsp;</div>
                    <div class="" >
                        <div class="box_bg" style="padding-bottom: 10px;">
                            <div style="margin: 1px 2px 0px 5px;">
                                <label class="dashboard_labels" style="margin: 0; font-size: 12px; padding-top: 5px;" for="client_type">Choose your customer</label>
                                <span class="pull-right"><img style="height: 20px;" src="<?php echo $this->request->webroot; ?>img/pro.png" alt=""></span>
                            </div>

                            <div class="" style="margin-left: 15px;">

                                <div style="margin: 10px 0px;">
                                    <label class="clientele_style" style="" for="client_type"> Individual Member
                                        <input class="pull-right" type="radio" name="client_type"  <?php
                            if ($details_type == 2) {
                                echo 'checked="checked"';
                            }
                                ?> value="2" id="client_type"/>
                                    </label> 

                                    <label class="clientele_style" style=""> Corporate Member 
                                        <input class="pull-right" type="radio" name="client_type" <?php
                                    if ($details_type == 3) {
                                        echo 'checked="checked"';
                                    }
                                ?>  value="3" id="client_type"/>
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
                <div class="col-md-6 col-lg-6 col-xl-2 border_right_me" style="">
                    <div class="" id="">

                        <div class="" >

                            <div class="box_bg" style=" ">
                                <div style="margin-top: 10px; padding-left: 15px;">
                                    <div style="margin: 1px 2px 0px 5px;">
                                        <label class="dashboard_labels" style="margin: 0; font-size: 12px; padding-top: 5px;" for="client_type">Choose Your Radius</label>
                                        <span class="pull-right"><img style="height: 20px;" src="<?php echo $this->request->webroot; ?>img/pro.png" alt=""></span>
                                    </div>


                                    <table class="choose_radius" style="font-size: 12px; margin-left: 10px;">
                                        <thead>
                                            <tr>
                                                <th style="width:60px;"><?= $this->Paginator->sort('City') ?></th>

                                                <th style="width:60px;"><?= $this->Paginator->sort('Delete') ?></th>
                                        </thead>
                                        <tbody id="city_radius">
                                            <?php foreach ($city_event as $city):
                                                ?>
                                                <tr style="">

                                                    <td style="width:60px;"><?= h($city['city']); ?></td>

                                                    <td style="width:60px;">
                                                        <input type="hidden" class="event_city_id" value="<?php echo $city['id']; ?>">
                                                        <i class="fa fa-times delete_acco_city"></i>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <div style="padding-bottom: 5px;">
                                        <a class="" href=""  data-toggle="modal" data-target="#myModal1" style="border:none;color:#7b1b2d; background: none;font-size: 12px; width: 70px;height: 25px;"> <span class="plus_bg"><i class="fa fa-plus plus_color"></i></span> Add cities</a>
                                    </div>


                                </div>

                            </div>



                        </div>

                    </div>

                </div>
            <?php } ?>

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
                        <span class="test" data-toggle="dropdown"></span>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#block_days">Block availability</a>
                        </div>
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
                <h5 class="modal-title">Add City</h5>
            </div>


            <div class="modal-body">

                <div class="row">
                    <label for="message" class="col-md-3 control-label">Add Acc $</label>
                    <div class="col-md-9">
                        <form action="<?php echo $this->request->webroot ?>EmployeeMembers/addcities" name="add_name" method="post" id="add_name">
                            <table class="" id="dynamic_field" style="background: #F5F5F5;">
                                <tr>
                                    <td style="background-color:white;">
                                        <input type="text" name="name[]"   placeholder="city"  class="custom_field"  required  style="height: 35px;" data-original-title="This Field is required" title="">
                                    </td>
                                    <td style="background-color:white;">
                                        <div class="input-group">
                                            <input type="text" name="amount[]"  placeholder="amount"  class="custom_field" required  style="height: 35px;width: 120px;background-color: #ECECEC !important;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color:#ECECEC !important;height: 35px !important;border-radius: unset !important;color:#6D6D6D !important;">$</span>
                                            </div>
                                        </div>
                                        <!--<span class="fa fa-trash-o btn_remove" id="2"></span>-->
                                    </td>

                                    <td style="background-color:white;">
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

                <button type="button" class="btn btn-default btn-sm"  name="add" id="add">Add More</button>
                <button type="button" class="btn btn-default btn-sm" type="submit"  id="addcities">Save</button>

                <button type="button" class="btn btn-default btn-sm" id='close' data-dismiss="modal">Close</button>
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
<script>
    function btn_remove(btn) {
        $('#row' + btn).remove();
    }
    function btn_remove1(btn) {
        $('#rowRadius' + btn).remove();
    }
    $(document).ready(function () {
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
            $('#dynamic_field').append('<tr id="row' + i + '"><td style="background-color:white;"><input type="text" name="name[]" style="height: 35px;" placeholder="city" class="custom_field" data-original-title="This Field is required" title="" /></td><td style="background-color:white;width:182px;"><div class="input-group" style="width:155px!important;float:left;"><input type="text" name="amount[]"  placeholder="amount"  class="custom_field" required  style="height: 35px;width: 120px;background-color: #ECECEC !important;"><div class="input-group-prepend"><span class="input-group-text" style="background-color:#ECECEC !important;height: 35px !important;border-radius: unset !important;color:#6D6D6D !important;">$</span></div></div><span id="' + i + '" onclick="btn_remove(' + i + ')" class="fa fa-trash-o btn_remove"></span></td><td style="background-color:white;"></td></tr>');
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


            var clienttype = $("input[name=client_type]:checked").val();
            var service = '<?php echo $categoryservice; ?>';
            var subservice = '';
            //            alert();
            var talentid = '<?php echo $talentservice; ?>';

            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/clienttype',
                data: 'clienttype=' + clienttype + '&service=' + service + '&subservice=' + subservice + '&talentid=' + talentid,
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
    });

</script>
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
                            $('#city_radius').html(data[2]);
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

