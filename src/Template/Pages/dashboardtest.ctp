<?php

use Cake\I18n\Time;
use Cake\Datasource\ConnectionManager;

$url = $_SERVER['REQUEST_URI'];
$urlArray = explode('/', $url);
$lastIndex = end($urlArray);
if ($lastIndex == 'edit') {
    $isEdit = 1;
} else {
    $isEdit = 0;
}

$conn = ConnectionManager::get('default');
$query = $conn->execute('SELECT city,accommodation_price '
                        . ' FROM talent_events  '
                        . 'left  join talent_event_cities ON talent_events.id=talent_event_cities.talent_event_id '
                        . 'where talent_events.id=1');
$city_event = $query->fetchAll('assoc');
?>

<style>
    .edit_profile {
        bottom: 56px;
        right: 55px;
    }
</style>
<!-- Zabuto Calendar -->
<script src="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.css">

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
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<section class="content-wrapper content_bg" style="padding-top: 35px;">
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-lg-3 col-xl-3 border_right_me text-center " >
                <div class="text-center credit_card_bank" id="basic_info" style="background: #F5F5F5 !important;">
                    <div class="row" >
                        <div class="col-md-12 col-lg-12">
                            <div style="border-bottom: 2px solid #acacac; padding-bottom: 30px; margin: 0 20px;">
                                <label class="dashboard_labels" style="padding-bottom: 10px;">
                                    Link my Bank Account
                                </label>
                                <div class="credit_earning_box">
                                    <p style="padding-left: 10px; padding-top: 8px;" class="text-uppercase text-left">Credit Card</p>
                                </div>

                            </div>
                            <div>
                                <div>
                                    <label style="color: #8f8f8f; font-size: 12px;">
                                        <span style="border: none !important; font-size: 12px;">
                                            Account :
                                        </span> 
                                        John Smith
                                    </label>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-md-9 col-lg-9 col-xl-9" style="">
                <div class="credit_card_bank" id="">

                    <div class="row" >
                        <div class="col-md-6 col-lg-3 col-xl-3 text-center" >
                            <div class="">
                                <label class="dashboard_labels">My Earnings</label>
                                <div class="clearfix">&nbsp;</div>
                                <div class="credit_earning_box" style="">
                                    Earning in month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xl-3 text-center" >
                            <div style="">
                                <label class="text-center dashboard_labels">Booking Price</label>
                                <div>
                                    <span class="talent_city"><i class="fa fa-map-marker"></i> Miami</span>
                                    &nbsp;&nbsp;&nbsp;
                                    <span style="color: #72424e;">Hourly</span>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="booking_price" style="">
                                    <div class="" style="padding: 10px;">
                                        <span class="input-group-btn">
                                            <button style="padding: 3px 8px;" type="button" class="inc_dec btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                <span class="fa fa-minus"></span>
                                            </button>
                                        </span>
                                        <input style="background: transparent;" type="text" name="quant[1]" class="inc_dec_field input-number" id="bookingamount" value="1" min="1" max="10000">$


                                        <span class="input-group-btn" style="margin-left: 10px;">
                                            <button style="padding: 3px 8px;" type="button" class="inc_dec btn-number" data-type="plus" data-field="quant[1]">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </span> 
                                    </div>
                                </div>

                                <div class="text-center" id="event_payment_type">

                                    <label for="event_type" >
                                        <input type="radio" name="event_type"  checked value="Hourly" id="event_type">
                                        Hourly
                                    </label>
                                    &nbsp;&nbsp;&nbsp;
                                    <label for="event_type">
                                        <input type="radio" value="Whole Event" name="event_type" id="event_type"> 
                                        Whole Event 
                                    </label>

                                    <button type="button" class="modal_btn" type="submit"  id="bookingtype" style="border:none;color:white; background:#7b1b2d;border-radius: 3px; font-size: 12px;">Save</button>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6 text-center" >
                            <div style="">
                                <label class="dashboard_labels">Statistics</label>

                                <div class="dashbord_text_color" style=" font-size: 20px; color: #F5F5F5;"> <img style="max-width: 100%;" src="<?php echo $this->request->webroot ?>img/stats.jpg"/></div>

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
            <div class="col-md-4 col-lg-4 col-xl-4 border_right_me  text-center" style="height: 250px;width: 150px;padding-bottom: 20px; background: #F5F5F5;   border-radius: 3px ;box-shadow: 2px 2px 2px 2px #dddd;">
                <div class="text-center" id="basic_info">

                    <div class="row" >

                        <div class="col-md-12 col-lg-12" style=" ">
                            <div style="margin-top: 10px;  ">
                                <label style=" color:white; background:#7b1b2d;border-radius: 3px;  ">Compare License Types</label>
                                <table class="text-center">
                                    <tr>
                                        <th></th>
                                        <th>Basic </th>
                                        <th>Pro</th>
                                    </tr>
                                    <tr style="border-bottom:1px solid black;">
                                        <td >Lorem Ipsum is simply dummy text ..</td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/tick.jpg" width="20"/></td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/xros.jpg" width="20"/></td>
                                    </tr>
                                    <tr>
                                    <tr style="border-bottom:1px solid black;">
                                        <td>Lorem Ipsum is simply dummy text ..</td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/tick.jpg" width="20"/></td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/xros.jpg" width="20"/></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid black;">
                                        <td>Lorem Ipsum is simply dummy text ..</td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/tick.jpg" width="20"/></td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/xros.jpg" width="20"/></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid black;">
                                        <td>Lorem Ipsum is simply dummy text ..</td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/tick.jpg" width="20"/></td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/xros.jpg" width="20"/></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid black;">
                                        <td>Lorem Ipsum is simply dummy text ..</td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/tick.jpg" width="20"/></td>
                                        <td><img src="<?php echo $this->request->webroot ?>img/xros.jpg" width="20"/></td>
                                    </tr>




                                </table>
                                <a href="#" data-toggle="modal" data-target="#myModal" style="color:white; background:#7b1b2d;border-radius: 3px">Upgrade to Pro</a>

                            </div>

                        </div>


                        <?php echo $this->element('inc/updtaetopro'); ?>   

                    </div>

                </div>

            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 border_right_me  text-center" style="margin-left: 20px;">
                <div class="text-center" id="basic_info">

                    <div class="row" >

                        <div class="col-md-12 col-lg-12" style="width: 150px;  padding-bottom: 20px; background: #F5F5F5;   border-radius: 3px ;box-shadow: 2px 2px 2px 2px #dddd; ">
                            <div style="  ">
                                <label style="  color:#7b1b2d;  font-size: 12px; font-weight: bold; ">Add Accomodation fee</label>


                                <table class="text-center" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;"><?= $this->Paginator->sort('City') ?></th>
                                            <th style="width:60px;"><?= $this->Paginator->sort('Price') ?></th>
                                            <th style="width:60px;"><?= $this->Paginator->sort('Delete') ?></th>
                                    </thead>
                                    <?php foreach ($city_event as $city_events):
                                    ?>
                                    <tr style="">

                                        <td style="width:60px;"><?= h($city_events['city']) ?></td>
                                        <td style="width:60px;"><?= h($city_events['accommodation_price']) ?></td>
                                        <td style="width:60px;"><img src="<?php echo $this->request->webroot ?>img/xros.jpg" width="10"/></td>
                                    </tr>
                                    <?php endforeach; ?>

                                </table>
                                </br>
                            <a href=""  data-toggle="modal" data-target="#myModal" style="border:none;color:#7b1b2d; background: none;font-size: 12px; width: 70px;height: 25px;">Add  cities</a>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-12" style="height: 120px;width: 150px;  margin-top:20px;  padding-bottom: 20px; background: #F5F5F5;   border-radius: 3px ;box-shadow: 2px 2px 2px 2px #dddd; ">
                        <div style="  ">

                            <label style="  color:#7b1b2d;  font-size: 12px; font-weight: bold; " for="client_type">Chose your customer</label>
                            <label style="  color:#7b1b2d;  font-size: 12px; font-weight: bold; " for="client_type">Indivisual Member</label><input type="radio" name="client_type"  checked value="2" id="client_type"/></br>
                        <label style="  color:#7b1b2d;  font-size: 12px; font-weight: bold; ">Corporate Member</label><input type="radio" name="client_type"  value="3" id="client_type"/></br>
                    <button type="button" class="modal_btn" type="submit"  id="clienttype" style="border:none;color:white; background:#7b1b2d;border-radius: 3px; font-size: 12px; width: 70px;height: 25px;">Save</button>

                </div>

            </div>



        </div>

    </div>

    </div>
<div class="col-md-2 col-lg-2 col-xl-2 border_right_me  text-center" style="width: 150px;padding-bottom: 20px;margin-left: 20px; background: #F5F5F5;   border-radius: 3px ;box-shadow: 2px 2px 2px 2px #dddd;">
    <div class="text-center" id="basic_info">

        <div class="row" >

            <div class="col-md-12 col-lg-12" style=" ">
                <div style="margin-top: 10px;  ">
                    <label style="  color:#7b1b2d;  font-size: 12px; font-weight: bold;  ">Chose Your Radius</label>

                    <table class="text-center" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="width:60px;"><?= $this->Paginator->sort('City') ?></th>

                                <th style="width:60px;"><?= $this->Paginator->sort('Delete') ?></th>
                        </thead>
                        <?php foreach ($city_event as $city):
                        ?>
                        <tr style="">

                            <td style="width:60px;"><?= h($city['city']) ?></td>

                            <td style="width:60px;"><img src="<?php echo $this->request->webroot ?>img/xros.jpg" width="10"/></td>
                        </tr>
                        <?php endforeach; ?>

                    </table>
                    <a href=""  data-toggle="modal" data-target="#myModal1" style="border:none;color:#7b1b2d; background: none;font-size: 12px; width: 70px;height: 25px;">Add  cities</a>



                </div>

            </div>



        </div>

    </div>

</div>
<div class="col-md-3 col-lg-3 col-xl-3 border_right_me  text-center" style="height: 350px;width: 150px;padding-bottom: 20px; margin-left: 20px;background: #F5F5F5;   border-radius: 3px ;box-shadow: 2px 2px 2px 2px #dddd;">
    <div class="text-center" id="basic_info">

        <div class="row" >

            <div class="col-md-12 col-lg-12" style=" ">
                <div style="margin-top: 10px;  ">
                    <div id="my-calendar"></div>
                </div>

            </div>



        </div>

    </div>

</div>

</div>
</div>
</section>
<div class="clearfix"></div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                <h5 class="modal-title">Add City</h5>
            </div>


            <div class="modal-body">

                <div class="row">
                    <label for="message" class="col-md-3 control-label">Add Accommodation</label>
                    <div class="col-md-9">
                        <form name="add_name" id="add_name">
                            <table class="" id="dynamic_field" style="background: #F5F5F5;">
                                <tr>
                                    <td><input type="text" name="name[]"   placeholder="city"  class=""  required  style=" "/></td>
                                    <td><input type="text" name="amount[]"  placeholder="amount"  class="" required  style=" "/></td>

                                    <td></td>
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

                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="myModal1" role="dialog">
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
                        <form name="add_radius" id="add_radius">
                            <table class="" id="dynamic_field2" style="background: #F5F5F5;">
                                <tr>
                                    <td><input type="text" name="name[]"   placeholder="city"  class=""  required  style=" "/></td>

                                    <td></td>
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

                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<script>

    $(document).ready(function () {

        var i = 1;
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="name[]" style="" placeholder="city" class="" /></td><td><input type="text" name="amount[]"  placeholder="amount"  class="" required  style=""/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove" style="border:none;color:white;  font-size: 12px; width: 20px;height: 20px;">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $('#addcities').click(function () {

            $.ajax({
                url: "<?php echo $this->request->webroot ?>EmployeeMembers/addcities",
                method: "GET",
                data: $('#add_name').serialize(),
                success: function (data)
                {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });

        var j = 1;
        $('#addmore').click(function () {
            j++;
            $('#dynamic_field2').append('<tr id="row' + j + '"><td><input type="text" name="name[]" style="" placeholder="city" class="" /></td></td><td><button type="button" name="remove" id="' + j + '" class="btn btn-danger btn_remove1" style="border:none;color:white;  font-size: 12px; width: 20px;height: 20px;">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove1', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $('#addradius').click(function () {

            $.ajax({
                url: "<?php echo $this->request->webroot ?>EmployeeMembers/addradius",
                method: "GET",
                data: $('#add_radius').serialize(),
                success: function (data)
                {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });


        $('#bookingtype').click(function () {

            var bookingamount = $('#bookingamount').val();
            var eventtype = $("input[name=event_type]:checked").val();
            var service = '1';
            var subservice = '2';




            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/booktype',
                data: 'bookingamount=' + bookingamount + '&eventtype=' + eventtype + '&service=' + service + '&subservice=' + subservice,
                contentType: 'json',
                success: function (data)
                {


                    var data = JSON.parse(data);




                }
            });


        });
        $('#clienttype').click(function () {


            var clienttype = $("input[name=client_type]:checked").val();
            var service = '1';
            var subservice = '2';




            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot ?>EmployeeMembers/clienttype',
                data: 'clienttype=' + clienttype + '&service=' + service + '&subservice=' + subservice,
                contentType: 'json',
                success: function (data)
                {


                    var data = JSON.parse(data);




                }
            });


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
    });

    $("#my-calendar").zabuto_calendar({
        ajax: {
            url: "<?php echo $this->request->webroot . 'EmployeeMembers/calendardates?talent_id=' . $userids; ?>"

        }
    });
    function submit_review(review) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'EmployeeMembers/add_review' ?>',
            data: $('#review' + review).serialize() + '&event_id=' + review,
            contentType: 'json',
            success: function (data)
            {
                $('#review' + review).parent().html(data);
                //                data = JSON.parse(data);
                console.log(data);

            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
        return false;
    }
</script>
<script>
    function readURL(input, showId = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.files[0]);   
            reader.onload = function (e) {
                if (input.id == "sectionImage") {
                    $('#show_section_uploaded_image')
                        .attr('src', e.target.result);
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function (e) {
        $("#edit_image").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo $this->request->webroot . 'CorporateMembers/editImage' ?>",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    data = JSON.parse(data);
                    if (data[0] == 'success') {
                        $('#profile_image_div').css('background-image', "url('" + data[1] + "')");
                        $('#myModal').modal('hide');
                    } else {

                    }
                },
                error: function (e)
                {

                }
            });
            return false;
        });
                            });

        $(document).ready(function (e) {
            $("#edit_image").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo $this->request->webroot . 'CorporateMembers/editImage' ?>",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data)
                    {
                        data = JSON.parse(data);
                        if (data[0] == 'success') {
                            $('#profile_image_div').css('background-image', "url('" + data[1] + "')");
                            $('#myModal').modal('hide');
                        } else {

                        }
                    },
                    error: function (e)
                    {

                    }
                });
                return false;
            }));

            $('.bookinghrs').click(function () {

                $('#basic_info input').attr('readonly', true);

                $('#basic_info input').css({
                    "background-color": "#EFEFEF",
                    "height": "20px",
                    "color": "#a7a7a7"

                });

                var reference = $(this).parent().parent().next().children();
                $(reference).attr('readonly', false);
                var field = $(reference).attr('id');
                $(reference).focus();

                if (field != 'description') {
                    $(reference).css({
                        "background-color": "#fff",
                        "height": "20px",
                        "color": "#5E5E5E"

                    });
                } else {
                    $(reference).css({
                        "background-color": "#fff",
                        "color": "#5E5E5E"

                    });
                }
            });

            $('input, textarea').keyup(function (e) {
                var key = e.keyCode;
                var data = $(this).val();
                var columnName = $(this).attr('id');




                if (key === 13) {
                    if (columnName == "password") {
                        $('#confirm_password').attr('readonly', false);
                        $('#confirm_password').trigger('focus');
                        $('#confirm_password').css({
                            "background-color": "#fff",
                            "height": "20px",
                            "color": "#5E5E5E"

                        });
                        return;
                    }

                    if (columnName == "confirm_password") {
                        var confirmPassword = $('#confirm_password').val();
                        var password = $('#password').val();
                        var columnName = $('#password').attr('id');

                        if (password === confirmPassword) {

                            $.ajax({
                                url: '<?php echo $this->request->webroot ?>users/saveUserInfo',
                                data: {
                                    'data': confirmPassword,
                                    'column_name': columnName
                                },
                                type: 'POST',
                                cache: false,
                                async: false,
                                success: function (responce) {
                                    var responseArray = responce.split(',');
                                    var columnName = responseArray[0];
                                    var data = responseArray[1];

                                    $('#' + columnName).val(data);
                                    $('input').blur();
                                    $('#confirm_password').val('');
                                    $('#password').val('');
                                    $('input').css({
                                        "background-color": "#EFEFEF",
                                        "height": "20px",
                                        "color": "#a7a7a7"

                                    });
                                    show_custom_message('Profile info updated.');
                                },
                                error: function () {
                                    alert('error');
                                }

                            });


                        } else {
                            show_custom_message('Password does not matched. Please try again.');
                            $('#confirm_password').val('');
                            $('#password').val('');
                        }
                    } else if (data !== "") {
                        $.ajax({
                            url: '<?php echo $this->request->webroot ?>EmployeeMembers/saveUserInfo',
                            data: {
                                'data': data,
                                'column_name': columnName
                            },
                            type: 'POST',
                            cache: false,
                            async: false,
                            success: function (responce) {
                                var responseArray = responce.split(',');
                                var columnName = responseArray[0];
                                var data = responseArray[1];

                                $('#' + columnName).val(data);
                                $('#' + columnName).blur();
                                $('#' + columnName).css({
                                    "background-color": "#EFEFEF",
                                    "height": "20px",
                                    "color": "#a7a7a7"

                                });
                                show_custom_message('Profile info updated.');
                            },
                            error: function () {
                                alert('error');
                            }

                        });

                    } else {
                        show_custom_message('Please first fill the field.');
                        $(this).focus();
                    }
                }
            });
        });

</script>
