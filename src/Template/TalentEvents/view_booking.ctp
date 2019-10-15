<style>
    .change-placeholder{
        color:white;
    }
    .custom_field {
        border: none !important;
        background-color: #ECECEC !important;
        font-size: 14px !important;
        padding: 7px !important;
    }
</style>
<div class="row">
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <p class="form-control change-placeholder"  style="background-color:#711A2A;"><?php echo date('M d, Y', strtotime($booking->from_date)); ?></p>

    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <p class="form-control change-placeholder"  style="background-color:#711A2A;"><?php echo date('M d, Y', strtotime($booking->to_date)); ?></p>

    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <p class="form-control change-placeholder"  style="background-color:#711A2A;"><?php echo $booking->hour ?></p>

    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <?php
        $e_city = 'N/A';
        if ($booking->talent_event_city) {
            $e_city = $booking->talent_event_city->city;
        }
        ?>
        <p class="form-control change-placeholder" style="background-color:#711A2A;"><?php echo ucfirst($e_city); ?></p>


    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-12 col-lg-5 display_event_type" style="padding:14px;background-color: #ECECEC;border-radius: 5px;margin:0 20px;box-shadow: 0px 1px 2px;">
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
            <div class="col-md-12 col-lg-5" style="padding:14px;background-color: #ECECEC;margin:0 20px;border-radius: 5px;background-color:#711A2A;color:white">
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