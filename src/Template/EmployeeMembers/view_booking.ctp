<script src="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.css">

<div class="row">
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <p class="form-control change-placeholder"  style="background-color:#711A2A;"><?php echo date('M d, Y', strtotime($booking->from_date)); ?></p>
        <div class="input-group-prepend">
            <span class="fa fa-calendar input-group-text"></span>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <p class="form-control change-placeholder"  style="background-color:#711A2A;"><?php echo date('M d, Y', strtotime($booking->to_date)); ?></p>
        <div class="input-group-prepend">
            <span class="fa fa-calendar input-group-text"></span>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <p class="form-control change-placeholder"  style="background-color:#711A2A;"><?php echo $booking->hour ?></p>
        <div class="input-group-prepend">
            <span class="fa fa-clock-o input-group-text"></span>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <?php
        $e_city = 'N/A';
        if ($booking->talent_event_city) {
            $e_city = $booking->talent_event_city->city;
        }
        ?>
        <p class="form-control change-placeholder" style="background-color:#711A2A;"><?php echo ucfirst($e_city); ?></p>

        <div class="input-group-prepend">
            <span class="fa fa-map-marker input-group-text"></span>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-7">
        <div class="input-group">
            <div class="col-md-12 col-lg-5 display_event_type" style="padding:14px;background-color: #ECECEC;border-radius: 5px;margin-right:20px;box-shadow: 0px 1px 2px;">
                <input type="radio" checked required>
                <label style="font-size:18px">
                    <?php
                    if ($booking->event_type == 1) {
                        echo 'Hourly';
                    }
                    if ($booking->event_type == 2) {
                        echo 'Whole event';
                    }
                    ?>
                </label>
            </div>
            <div class="col-md-12 col-lg-5" style="padding:14px;background-color: #ECECEC;border-radius: 5px;background-color:#711A2A;color:white">
                <span style="font-size:22px">Price &nbsp;
                    <?php
                    $acc_p = 0;
                    if ($booking->talent_event_city) {
                        $acc_p = $booking->talent_event_city->accommodation_price;
                    }
                    if ($booking->event_type == 1) {
                        $calculate = $event_type->amount * $booking->total_hours;
                    }
                    if ($booking->event_type == 2) {
                        $calculate = $event_type->amount;
                    }
                    $total = $calculate + $acc_p;
                    echo '$ ' . $total;
                    ?>

                </span>                
            </div>


        </div>
        <div class="form-group">
            <label class="custom_label" for="title">Booking Title</label>
            <p class="custom_field"><?php echo $booking->title ?> &nbsp;</p>

        </div>
        <div class="form-group">
            <label class="custom_label" for="street_address">Street Address</label>
            <p class="custom_field"><?php echo $booking->street_address ?></p>

        </div>
        <div class="form-group">
            <label class="custom_label" for="street_address">Street Address2</label>
            <p class="custom_field"><?php echo $booking->street_address2 ?> &nbsp;</p>

        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="custom_label" for="city" >City</label>
                <p class="custom_field"><?php echo $booking->city ?></p>

            </div>

            <div class="col-md-4">
                <label class="custom_label" for="state">State</label>
                <p class="custom_field"><?php echo $states[$booking->state_id]; ?></p>

            </div>

            <div class="col-md-4">
                <label class="custom_label" for="zip">zip</label>
                <p class="custom_field"><?php echo $booking->zip ?></p>

            </div>
        </div>
        <div class="form-group">
            <label class="custom_label" for="special_direction">Special Direction</label>
            <p class="custom_field" style="min-height: 60px;"><?php echo $booking->special_direction ?></p>

        </div>

    </div>
    <div class="col-md-5 calendar_view" style="padding: 0 25px;">
        <?php
        if ($booking->event_type == 2) {
            ?>
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12 col-lg-6">
                    <span class="fa fa-circle" style="color:#28A745"></span> Requests
                </div>
                <div class="col-md-12 col-lg-6">
                    <span class="fa fa-circle" style="color:#7B1A2D"></span> Booked/unavailable
                </div>            
            </div>
            <div id="my-calendar"></div>
        <?php } else { ?>
            <h6 style="color:#711A2A;">Talent Schedule on the given dates</h6>
            <table class="table table-bordered">
                <tr>
                    <th>Date</th>
                    <th>From Time</th>
                    <th>To Time</th>
                </tr>
                <?php
                if (count($talent_dates) > 0) {
                    foreach ($talent_dates as $td):
                        ?>
                        <tr>
                            <td><?php echo date('M d,Y', strtotime($td->date)) ?></td>
                            <td><?php echo date('h:i A', strtotime($td->from_time)) ?></td>
                            <td><?php echo date('h:i A', strtotime($td->to_time)) ?></td>

                        </tr>
                        <?php
                    endforeach;
                }else {
                    ?>
                    <tr>
                        <td colspan="3">No busy schedule for the given dates</td>
                    </tr>

                <?php } ?>
            </table>
            <h6 style="color:#28A745;">Requested Timings</h6>
            <table class="table table-bordered">
                <tr>
                    <th>From Time</th>
                    <th>To Time</th>
                </tr>
                <tr>
                    <td><?php echo date('h:i A', strtotime($booking->from_time)) ?></td>
                    <td><?php echo date('h:i A', strtotime($booking->to_time)) ?></td>
                </tr>
            </table>
        <?php } ?>

    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-6">

        <div class="form-group">
            <label class="custom_label" for="booking_purpose">Purpose of booking <small>(Perform the song, photoshoot etc.)</small></label>
            <p class="custom_field" style="min-height: 60px;"><?php echo $booking->booking_purpose ?></p>

        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="form-group">
            <label class="custom_label" for="personal_message">Personal Message</label>
            <p class="custom_field" style="min-height: 60px;"><?php echo $booking->personal_message ?></p>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="custom_label" for="describe_event">Describe your event</label>
            <p class="custom_field" style="min-height: 60px;"><?php echo $booking->describe_event ?></p>

        </div>

    </div>
</div>
<script>
    $(document).ready(function () {

        $("#my-calendar").zabuto_calendar({
            ajax: {
                url: "<?php echo $this->request->webroot . 'EmployeeMembers/calendardates?talent_id=' . $booking->talent_id . '&booking_id=' . $booking->id; ?>"
            }
        });

    });
</script>