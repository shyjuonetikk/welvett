<!-- Zabuto Calendar -->
<script src="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.css">

<div class="row">
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <input id="from_date" type="text" name="from_date" class="form-control change-placeholder datepicker"  placeholder="Start date" data-original-title="This Field is required" title="" style="background-color:#711A2A;" value="<?= $booking->from_date ?>">
        <div class="input-group-prepend">
            <span class="fa fa-calendar input-group-text"></span>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <input type="text" id="to_date" name="to_date" class="form-control change-placeholder datepicker" placeholder="End date" data-original-title="This Field is required" title="" style="background-color:#711A2A;"  value="<?= $booking->to_date ?>">
        <div class="input-group-prepend">
            <span class="fa fa-calendar input-group-text"></span>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div clockpicker" data-autoclose="true">
        <input type="text" id="hour" name="hour" class="form-control change-placeholder" placeholder="Hour" data-original-title="This Field is required" title="" style="background-color:#711A2A;"  value="<?= $booking->hour ?>">
        <div class="input-group-prepend">
            <span class="fa fa-clock-o input-group-text"></span>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <select id="location" name="talent_event_city_id" class="form-control change-placeholder" style="background-color:#711A2A;height:36px !important;" >
            <?php foreach ($get_talent_cities as $key => $city): ?>
                <option value="<?= $city['id'] ?>" <?= ($key == $booking->talent_event_city_id) ? 'selected' : ''; ?>><?= $city['city'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="input-group-prepend">
            <span class="fa fa-map-marker input-group-text"></span>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-6">
        <div class="input-group modal_event_type">
            <?php
            foreach ($service->event_types as $event_type):
                if ($event_type->event_type == 1) {
                    ?>
                    <div class="col-md-6">
                        <div class="col-md-12" style="padding:0">
                            <input type="radio" name="modal_event_type" id="modal_event_type_hourly" value="1" <?= ($booking->event_type == 1) ? 'checked' : ''; ?> >
                            <label for="modal_event_type_hourly">Hourly<small>(total hours)</small></label>
                        </div>
                        <?php
                        $d = 'none';
//                        debug($booking->total_hours);
                        if ($booking->total_hours) {
                            $d = 'block';
                        }
                        ?>
                        <div id="hour_quantity" class="col-md-12" style="padding:0;display:<?= $d; ?>">
                            <span class="input-group-btn">
                                <button type="button" class="inc_dec btn-number" disabled="disabled" data-type="minus" data-field="total_hours" style="cursor:pointer">
                                    <span class="fa fa-minus"></span>
                                </button>
                            </span>
                            <input type="text" name="total_hours" class="inc_dec_field input-number" value="<?= $booking->total_hours; ?>" min="1" max="100">
                            <span class="input-group-btn">
                                <button type="button" class="inc_dec btn-number" data-type="plus" data-field="total_hours" style="cursor:pointer">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </span> 
                            <p id="hourly_amount" style="margin:0 !important;color:green;margin-top:10px !important;"></p>
                        </div>

                    </div>
                    <?php
                }
                if ($event_type->event_type == 2) {
                    ?>

                    <div class="col-md-6">
                        <div class="col-md-12" style="padding:0">
                            <input type="radio" name="modal_event_type" id="modal_event_type_whole" value="2" <?= ($event_type->event_type == 2) ? 'checked' : ''; ?> >
                            <label for="modal_event_type_whole">Whole Event</label>
                        </div>
                    </div>
                    <?php
                }
            endforeach;
            ?>

        </div>

        <div class="form-group">
            <label class="custom_label" for="state">State</label>
            <select class="custom_field" name="state_id">
                <?php
                foreach ($states as $k => $s):
                    ?>
                    <option value="<?= $k ?>" <?= ($k == $booking->state_id) ? 'selected' : '' ?> ><?= $s ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="custom_label" for="city" >City</label>
            <input class="custom_field" name="city" type="text" value="<?= $booking->city; ?>" data-original-title="This Field is required" title="">
        </div>
        <div class="form-group">
            <label class="custom_label" for="street_address">Street Address</label>
            <input class="custom_field" name="street_address" value="<?= $booking->street_address; ?>" type="text" data-original-title="This Field is required" title="">
        </div>
        <div class="form-group">
            <label class="custom_label" for="zip">zip</label>
            <input class="custom_field" name="zip" type="text" value="<?= $booking->zip ?>" data-original-title="This Field is required" title="">
        </div>

        <div class="form-group">
            <label class="custom_label" for="special_direction">Special Direction</label>
            <textarea class="custom_field" name="special_direction"><?= $booking->special_direction; ?></textarea>
        </div>

    </div>
    <div class="col-md-6 calendar_view" style="padding: 0 25px;">
        <div id="my-calendar"></div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="custom_label" for="describe_event">Describe your event</label>
            <textarea class="custom_field" name="describe_event" data-original-title="This Field is required" title=""><?= $booking->describe_event; ?></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="custom_label" for="booking_purpose">Purpose of booking</label>
            <textarea class="custom_field" name="booking_purpose" data-original-title="This Field is required" title=""><?= $booking->booking_purpose; ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="custom_label" for="personal_message">Personal Message</label>
            <textarea class="custom_field" name="personal_message" data-original-title="This Field is required" title=""><?= $booking->personal_message; ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group" style="text-align:center">

            <button id="requestBooking" class="modal_btn" type="button" style="border:none;">Update the book</button>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('input[name=total_hours]').change(function () {
            var amount =<?php echo $total_amount; ?>;
            var total_hours = amount * $('input[name=total_hours]').val();
            $('#hourly_amount').text('Amount: ' + total_hours + ' $');
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
                    data: 'from_date=' + $('#from_date').val() + '&to_date=' + $('#to_date').val() + '&talent=' +<?= $userInfo->id; ?>,
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
        $("#my-calendar").zabuto_calendar({
            ajax: {
                url: "<?php echo $this->request->webroot . 'EmployeeMembers/calendardates?talent_id=' . $booking->talent_id; ?>"
            }
        });
        
    });
</script>
<script>
    //plugin bootstrap minus and plus
    //http://jsfiddle.net/laelitenetwork/puJ6G/
    
</script>
<script>
    $(function () {
        var dateToday = new Date();
        $(".datepicker").datepicker({
            minDate: 0
        });
    });
</script>
