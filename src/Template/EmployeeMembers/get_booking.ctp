<?php
//debug($booking->event_type);
?>
<!-- Zabuto Calendar -->
<script src="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.css">

<div class="row date_time_inputs">
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <input type="hidden" name="booking_id"  value="<?= $booking->id ?>">
        <input type="hidden" name="talent_id"  value="<?= $booking->talent_id ?>">
        <input id="from_date" type="text" name="from_date" onchange="setFromDate()" class="form-control change-placeholder datepicker"  placeholder="Start date" data-original-title="This Field is required" title="" style="background-color:#711A2A;" value="<?= $booking->from_date ?>">
        <div class="input-group-prepend">
            <span class="fa fa-calendar input-group-text"></span>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div">
        <input type="text" id="to_date" name="to_date" onchange="setToDate()" class="form-control change-placeholder datepicker" placeholder="End date" data-original-title="This Field is required" title="" style="background-color:#711A2A;"  value="<?= $booking->to_date ?>">
        <div class="input-group-prepend">
            <span class="fa fa-calendar input-group-text"></span>
        </div>
    </div>
    <div class="mb-3 col-md-6 col-lg-3 modal_btn_div clockpicker" data-autoclose="true">
        <input type="text" id="hour" name="hour" onfocus="clockpicker()" class="form-control change-placeholder" placeholder="Hour" data-original-title="This Field is required" title="" style="background-color:#711A2A;"  value="<?= $booking->hour ?>">
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
    <?php
    $display_calendar = 'display:none;';
    $display_table = 'display:none;';
    if ($booking->event_type == 2) {
        $display_calendar = '';
    }
    if ($booking->event_type == 1) {
        $display_table = '';
    }
    ?>
    <div class="col-md-7">
        <div class="input-group modal_event_type">
            <?php
            foreach ($service->event_types as $event_type):

                if ($event_type->event_type == 1) {
                    ?>
                    <div class="col-md-6">
                        <div class="col-md-12" style="padding:0">
                            <input type="radio" name="modal_event_type" id="modal_event_type_hourly" value="1" <?= ($booking->event_type == 1) ? 'checked' : ''; ?> >
                            <label for="modal_event_type_hourly">Hourly <small>(total hours)</small></label>
                        </div>
                        <?php
                        $d = 'none';
                        if ($booking->total_hours) {
                            $d = 'block';
                        }
                        //if($booking->event_type == 1){
                        ?>
                        <div id="hour_quantity" class="col-md-12" style="padding:0;display:block">
                            <span class="input-group-btn">
                                <button type="button" class="inc_dec btn-number" onclick="btn_number('minus_button')" id="minus_button" disabled="disabled" data-type="minus" data-field="total_hours" style="cursor:pointer">
                                    <span class="fa fa-minus"></span>
                                </button>
                            </span>
                            <input type="text" name="total_hours" class="inc_dec_field input-number" id="input_number" value="<?= ($booking->total_hours) ? $booking->total_hours : 0; ?>" min="1" max="100">
                            <span class="input-group-btn">
                                <button type="button" class="inc_dec btn-number" onclick="btn_number('plus_button')" id="plus_button" data-type="plus" data-field="total_hours" style="cursor:pointer">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </span> 
                            <p id="hourly_amount" style="margin:0 !important;color:green;margin-top:10px !important;"><?php echo ($booking->total_hours) ? 'Amount: ' . $booking->total_hours * $total_amount . ' $' : ''; ?></p>
                        </div>
                        <?php //} ?>
                    </div>
                    <?php
                }
                if ($event_type->event_type == 2) {
                    ?>

                    <div class="col-md-6">
                        <div class="col-md-12" style="padding:0">
                            <input type="radio" name="modal_event_type" id="modal_event_type_whole" value="2" <?= ($booking->event_type == 2) ? 'checked' : ''; ?> >
                            <label for="modal_event_type_whole">Whole Event</label>
                        </div>
                    </div>
                    <?php
                }
            endforeach;
            ?>

        </div>
        <div class="row" id="time_range" style="padding-top:10px;<?= $display_table; ?>">
            <div class="col-lg-6">
                <div class="form-group clockpicker"  data-autoclose="true">
                    <input onfocus="clockpicker()" type="text" id="from_time" name="from_time" class="form-control change-placeholder" placeholder="From Time" data-original-title="This Field is required" title="" style="background-color:#711A2A;" value="<?php echo date('H:i', strtotime($booking->from_time)) ?>">
                    <div class="input-group-prepend">
                        <span class="fa fa-clock-o input-group-text"></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group clockpicker"  data-autoclose="true">
                    <input onfocus="clockpicker()" type="text" id="to_time" name="to_time" class="form-control change-placeholder" placeholder="To Time" data-original-title="This Field is required" title="" style="background-color:#711A2A;" value="<?php echo date('H:i', strtotime($booking->to_time)) ?>">
                    <div class="input-group-prepend">
                        <span class="fa fa-clock-o input-group-text"></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="form-group">
            <label class="custom_label" for="title">Booking title</label>
            <input class="custom_field" name="title" type="text" data-original-title="This Field is required" title="" value="<?= $booking->title ?>">
        </div>
        <div class="form-group">
            <label class="custom_label" for="street_address">Street Address</label>
            <input class="custom_field" name="street_address" value="<?= $booking->street_address; ?>" type="text" data-original-title="This Field is required" title="">
        </div>
        <div class="form-group">
            <label class="custom_label" for="street_address2">Street Address 2</label>
            <input class="custom_field" name="street_address2" value="<?= $booking->street_address2; ?>" type="text" data-original-title="This Field is required" title="">
        </div>
        <div class="row">
            <!--            <div class="col-md-4">
                            <label class="custom_label" for="city" >City</label>
                            <input class="custom_field" name="city" type="text" value="<?= $booking->city; ?>" data-original-title="This Field is required" title="">
                        </div>-->
            <div class="col-lg-4">
                <div class="form-group">
                    <?php
                    $dynamic_val = rand();
                    ?>
                    <label class="custom_label" for="city" >City</label>
                    <input id="city<?= $dynamic_val; ?>" class="custom_field searching" dynamic_val="<?= $dynamic_val; ?>" value="<?= $booking->city; ?>" name="city" type="text" data-original-title="This Field is required" autocomplete="off" title="">
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
                    <select class="custom_field" id="state<?= $dynamic_val ?>" name="state_id" required>
                        <option value="">- States -</option>
                        <?php
                        foreach ($states as $s):
                            ?>
                            <option value="<?= $s['id'] ?>" <?= ($s['id'] == $booking->state_id) ? 'selected' : '' ?> ><?= $s['statename'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <!--            <div class="col-md-4">
                            <label class="custom_label" for="state">State</label>
                            <select class="custom_field" name="state_id">
            <?php
            foreach ($states as $k => $s):
                ?>
                                                                                                                                                    <option value="<?= $k ?>" <?= ($k == $booking->state_id) ? 'selected' : '' ?> ><?= $s ?></option>
            <?php endforeach; ?>
                            </select>
                        </div>-->

            <div class="col-md-4">
                <label class="custom_label" for="zip">zip</label>
                <input class="custom_field" name="zip" type="text" value="<?= $booking->zip ?>" data-original-title="This Field is required" title="">
            </div>
        </div>

        <div class="form-group">
            <label class="custom_label" for="special_direction">Special Direction</label>
            <textarea class="custom_field" name="special_direction"><?= $booking->special_direction; ?></textarea>
        </div>

    </div>


    <div class="col-md-5 calendar_view" style="padding: 0 25px;<?= $display_calendar ?>">
        <div class="col-md-12">
            <span class="fa fa-circle" style="color:#7B1A2D"></span> Booked/unavailable
        </div> 
        <div id="my-calendar"></div>
    </div>

    <div class="col-md-5 table_view" style="padding: 0 25px;<?= $display_table ?>">
        <?php
        if ($booking->event_type == 1) {
            ?>

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
                            <td><?php echo date('M d,Y', strtotime($td->from_time)) ?></td>
                            <td><?php echo date('M d,Y', strtotime($td->to_time)) ?></td>

                        </tr>
                        <?php
                    endforeach;
                }else {
                    ?>
                    <tr>
                        <td colspan="3">Talent is available for all time in given dates</td>
                    </tr>

                <?php } ?>
            </table>

        <?php } ?>
    </div>





</div>
<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label class="custom_label" for="booking_purpose">Purpose of booking</label>
            <textarea class="custom_field" name="booking_purpose" data-original-title="This Field is required" title=""><?= $booking->booking_purpose; ?></textarea>
        </div>
    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label class="custom_label" for="personal_message">Personal Message</label>
            <textarea class="custom_field" name="personal_message" data-original-title="This Field is required" title=""><?= $booking->personal_message; ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="custom_label" for="describe_event">Describe your event</label>
            <textarea class="custom_field" rows="5" name="describe_event" data-original-title="This Field is required" title=""><?= $booking->describe_event; ?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group" style="text-align:center">

            <button id="requestBooking" type="button" class="modal_btn" type="button" style="border:none;cursor: pointer;">Update booking</button>

        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        var isWhole = '<?php echo $booking->event_type ?>';
        if (isWhole == "2") {
            $('#hour_quantity').hide();
        }
        $("input[name=modal_event_type]").change(function () {
            if (typeof $("input[name=modal_event_type]:checked").val() != 'undefined') {
                if ($("input[name=modal_event_type]:checked").val() == 1) {
                    $('#hour_quantity').show();
                } else {
                    $('#hour_quantity').hide();
                }
            }
        });
    });
    $(function () {
        $('#input_number').change(function () {
            var amount = <?php echo $total_amount; ?>;
            var total_hours = amount * $('input[name=total_hours]').val();
            $('#hourly_amount').text('Amount: ' + total_hours + ' $');

            minValue = parseInt($('#input_number').attr('min'));
            maxValue = parseInt($('#input_number').attr('max'));
            valueCurrent = parseInt($('#input_number').val());
            name = $('#input_number').attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $('#input_number').val($('#input_number').data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $('#input_number').val($('#input_number').data('oldValue'));
            }
        });
        $("#my-calendar").zabuto_calendar({
            ajax: {
                url: "<?php echo $this->request->webroot . 'EmployeeMembers/calendardates?talent_id=' . $booking->talent_id; ?>"
            }
        });
        var dateToday = new Date();
        $(".datepicker").datepicker({
            minDate: 0
        });

    });
</script>

