<script src="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.css">

<?php

use Cake\I18n\Time;

$url = $_SERVER['REQUEST_URI'];
$urlArray = explode('/', $url);
$lastIndex = end($urlArray);
if ($lastIndex == 'edit') {
    $isEdit = 1;
} else {
    $isEdit = 0;
}
?>
<style>
    .edit_profile {
        bottom: 56px;
        right: 55px;
    }
</style>
<section class="content-wrapper header_bg">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-5 col-lg-5 pos_relative">
                <h1 class="profile_text_color pos_absolute"><?= $user->employee_member->eventcategory->title ?></h1>
            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <?php
                $c_image = 'cyber1550500683.png';
                if ($user->profile_image && file_exists(WWW_ROOT . 'img' . DS . 'users' . DS . $user->profile_image)) {
                    $c_image = $user->profile_image;
                }
                ?>
                <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>');">
                    <!--<img class="event_image" src="<?php // echo $this->request->webroot . 'img/users/' . $image;                                                                                                                 ?>" alt="">-->
                    <?php if ($isEdit == 1) { ?>

                        <i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>
                    <?php } ?>
                </div>
                <div>
                    <!--<img class="profile_image" src="" alt="">-->
                    <span class="white_color"><strong><?= ucfirst($user->first_name); ?></strong></span>
                    <br>
                    <span class="profile_text_color">London, UK</span>
                </div>
            </div>
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="pos_absolute" style="right: 10%;">
                    <a href="<?php echo $this->request->webroot; ?>employeeMembers/talentReviews" class="review_link">
                        <button class="review_button">

                            <i class="fa fa-star"></i>
                        </button>
                        <span class="white_color">My Reviews</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<section class="content-wrapper content_bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xl-4 border_right" style="padding-bottom: 20px;">
                <div class="text-center" id="basic_info">
                    <div>
                        <h6><i class="fa fa-users"></i> Info</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 text-right">

                            <span style="position: relative;">
                                <?php
                                if ($isEdit == 1) {
                                    echo '<i class="fa fa-pencil edit_info"></i>';
                                }
                                ?>
                                First Name
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">

                            <input id="first_name" type="text" class="" readonly value="<?= $user->first_name ?>" onchange="update_field()">
                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <span style="position: relative;">
                                <?php
                                if ($isEdit == 1) {
                                    echo '<i class="fa fa-pencil edit_info"></i>';
                                }
                                ?>
                                Last Name
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input id="last_name" type="text" class="" readonly value="<?= $user->last_name ?>">
                        </div>
                        <!--                        <div class="col-md-6 col-lg-6 text-right">
<span>Link Your Social Media</span>
</div>
<div class="col-md-6 col-lg-6 text-left">
<a class="icon_box instagram" href=""><i class="fa fa-instagram"></i></a>
<a class="icon_box facebook" href=""><i class="fa fa-facebook"></i></a>
<a class="icon_box twitter" href=""><i class="fa fa-twitter"></i></a>
</div>-->
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div>
                        <h6><i class="fa fa-user"></i> Account Settings</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 text-right">
                            <span style="position: relative;">
                                <?php
                                if ($isEdit == 1) {
                                    echo '<i class="fa fa-pencil edit_info"></i>';
                                }
                                ?>
                                Email
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input id="email" type="text" class="" readonly value="<?php echo $user->email; ?>">
                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <span style="position: relative;">
                                <?php
                                if ($isEdit == 1) {
                                    echo '<i class="fa fa-pencil edit_info"></i>';
                                }
                                ?>
                                Change Your Password
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input id="password" type="password" class="" readonly value="">
                        </div>
                        <div class="col-md-6 col-lg-6 text-right">

                            <span style="position: relative;">
                                <?php
                                if ($isEdit == 1) {
                                    echo '<i class="fa fa-pencil edit_info"></i>';
                                }
                                ?>
                                Confirm Password
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input id="confirm_password" type="password" class="" readonly value="">

                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <span style="position: relative;">
                                <?php
                                if ($isEdit == 1) {
                                    echo '<i class="fa fa-pencil edit_info"></i>';
                                }
                                ?>
                                Phone Number</span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input type="text" class="" readonly value="<?= $user->phone1 ?>">
                        </div>
                        <!--                                                <div class="col-md-6 col-lg-6 text-right">
<span>Change Your Category</span>
</div>
<div class="col-md-6 col-lg-6 text-left">
<input type="text" class="" readonly value="">
</div>-->
                        <!--                        <div class="col-md-6 col-lg-6 text-right">
<span>Description</span>
</div>
<div class="col-md-6 col-lg-6 text-left">
<textarea readonly name="" id="" rows="3" ></textarea>
</div>-->

                        <div class="col-md-6 col-lg-6 text-right">
                            <span style="position: relative;">
                                <?php
                                if ($isEdit == 1) {
                                    echo '<i class="fa fa-pencil edit_info"></i>';
                                }
                                ?>Description</span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <textarea id="description" readonly name="" id="" rows="3" ><?= $user->employee_member->description ?></textarea>
                        </div>
                    </div>
                    <?php
                    if ($user->memberships == null) {
                        ?>
                        <div class="clearfix">&nbsp;</div>
                        <div>
                            <h6><i class="fa fa-cog"></i> Service</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 text-right">

                                <span style="position: relative;">
                                    <?php
                                    if ($isEdit == 1) {
                                        echo '<i class="fa fa-pencil edit_service"></i>';
                                    }
                                    ?>
                                    Service
                                </span>
                            </div>
                            <div class="col-md-6 col-lg-6 text-left">
                                <?php
                                echo $this->Form->input('service', array('options' => $services, 'empty' => 'Select Service', 'div' => false, 'label' => false, 'class' => 'form-control', 'id' => 'service', 'disabled', 'style' => 'height: 30px;'));
                                ?>

                                <input id="selected_service" type="text" readonly value="<?php echo $user->employee_member->eventcategory->title; ?>">

                            </div>

                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row" id="sub_services" style="font-size: 12px;">
                            <?php
                            $checkedArray = array();
                            foreach ($user->talent_event_subcategories as $tService) {
                                $checkedArray[] = $tService->eventsubcategory_id;
                            }

                            foreach ($user->employee_member->eventcategory->eventsubcategories as $subService) {
                                if (in_array($subService->id, $checkedArray)) {
                                    $checked = 'checked';
                                } else {
                                    $checked = '';
                                }

                                echo '<div class="col-md-6 col-lg-6">
                            <label for="sub_serive_' . $subService->id . '">
                                <input disabled type="checkbox" id="sub_serive_' . $subService->id . '" value="' . $subService->id . '" ' . $checked . '>
                                ' . $subService->title . '
                            </label>

                        </div>';
                            }
                            ?>
                        </div>

                    <?php } ?>
                </div>
            </div>
            <div class="col-md-8 col-lg-8 col-xl-7">
                 <form   method="POST" action="<?php echo $this->request->webroot ?>Pages/dasboardtest">
                               <div class="col-md-3">
                                    <label for="service" class="control-label">Service</label>
                                    <?php echo $this->Form->control('service_id', ['label'=>false,'empty'=>'Select Services','options' => $services, 'class'=>'form-control', 'id'=>'services']);
                                    ?>
                                </div>
                                <div class="col-md-3">
                                    <label for="subservice" class="control-label">Sub Services </label>
                                    <select name="subservice" id="subservices" class="form-control"></select>

                                </div>
                                <?php echo $this->Form->control('Add Service',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg'));?>
                <?php
                 echo $this->Form->end();
               ?>
                
                <div id="my_events">
                    <div>
                        <div>
                            <h4 class="text-center" style="margin-bottom: 1rem;"><i class="fa fa-calendar"></i> My Bookings</h4>
                        </div>
                        <?php
                        foreach ($bookings as $booking):
                            $image = 'cyber1550500683.png';
                            if ($booking->customer->profile_image != null && file_exists(WWW_ROOT . 'img' . DS . 'users' . DS . $booking->customer->profile_image)) {
                                $image = $booking->customer->profile_image;
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="event_image" style="width:80px;background-position: center;background-size:cover;border: 1px solid #511723;;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>');">
                                        <!--<img class="event_image" src="<?php // echo $this->request->webroot . 'img/users/' . $image;                                                                                                                 ?>" alt="">-->
                                    </div>
                                    <strong><?php echo ucwords($booking->customer->first_name . ' ' . $booking->customer->last_name); ?></strong>
                                    <span class="pull-right">
                                        <?php
                                        $time = new Time($booking->created);
                                        $result = $time->timeAgoInWords([
                                            'accuracy' => 'hour'
                                        ]);
                                        echo $result;
                                        ?>
                                    </span>
                                    <br>
                                    <p><?php // echo strlen($booking->talent->employee_member->description) > 200 ? substr($booking->talent->employee_member->description, 0, 200) . "..." : $booking->talent->employee_member->description;                                                                  ?></p>
                                    <button class="event_button pull-right">Release Money</button>
                                    <button class="event_button pull-right" style="margin-right: 20px;">Disputes</button>
                                    <button class="event_button pull-right" onclick="show_detail(<?= $booking->id; ?>)" style="margin-right: 20px;">view</button>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    if (empty($booking->customer_review)) {
                                        ?>
                                        <form id="review<?= $booking->id; ?>" onsubmit="return submit_review(<?= $booking->id; ?>)">
                                            <input type="hidden" name="booking_id" value="<?= $booking->id; ?>">
                                            <textarea  rows="2" name="review" placeholder="Additional Comments." style="font-size: 12px;margin-top: 5px"></textarea>
                                            <button type="submit" class="event_button pull-right" style="padding: 2px 10px;">Submit Review</button>
                                        </form>
                                    <?php } else { ?>
                                        <div style="text-align: center;">
                                            <span class="fa fa-check-circle" style="font-size: 34px;display:block;"></span>
                                            <span style="font-size: 15px;display:block;margin-top: 0;">Thank You</span>
                                            <span style="font-size: 13px;display:block;margin-top: 0;">Your submission has been received.  </span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                            
                            
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                        <h5 class="modal-title">Change Image</h5>
                    </div>
                    <?php echo $this->Form->create('message_edit_form', array('id' => 'edit_image', 'type' => 'file')); ?>

                    <div class="modal-body">
                        <div class="row">
                            <label for="message" class="col-md-3 control-label">Select Image</label>
                            <div class="col-md-9">
                                <?php echo $this->Form->control('image', array('id' => 'sectionImage', 'type' => 'file', 'div' => false, 'label' => false, 'required', 'style' => 'border-bottom:unset !important;', 'onchange' => "readURL(this)")); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <img id="show_section_uploaded_image" width="200" src=""  class="section-up-image" alt=""/>
                            </div>
                        </div>
                        <br/>
                    </div>
                    <div class="modal-footer" style="text-align:right">
                        <?php
                        echo $this->Form->button('Update Image', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-default btn-sm', 'id' => 'register'));
                        ?>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <div class="modal fade" id="summary_modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background-color: #F5F5F5 !important;">
                    <div class="modal-header" style="display:block !important;padding: 0 10px;border-bottom: none;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="dynamic_content">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('#services').change(function () {
            var service = $(this).val();
            

            $("#subservices").html("<option value=''>Select Sevice</option>");
         
            if (service !== "") {
                $.ajax({
                    url: '<?php echo $this->request->webroot ?>Pages/Subservice',
                    data: {
                        'eventcategory_id': service
                    },
                    type: 'POST',
                    cache: false,
                    success: function (responce) {

                        if (responce !== "") {
                            $("#subservices").html(responce);
                        } else {
                            $("#subservices").html("<option value=''>Select Sub Service</option>");
                        }

                    }


                });
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
                    $('#show_section_uploaded_image').attr('src', e.target.result);
                }
            };
            reader.readAsDataURL(input.files[0]);
    }
    }
    function show_detail(booking) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot ?>EmployeeMembers/show_booking',
            data: 'booking_id=' + booking,
            success: function (data)
            {
                $('#dynamic_content').html(data);
                $('#summary_modal').modal('show');
            }
        });

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
                        show_custom_message('Profile image changed.');
                    } else {

                    }
                },
                error: function (e)
                {

                }
            });
            return false;
        }));

        $('.edit_info').click(function () {

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

        $('#service').hide();
        $('.edit_service').click(function () {
            var selectedService = '<?php echo $user->employee_member->eventcategory_id; ?>';
            $('#selected_service').hide();
            $('#basic_info input').attr('readonly', true);

            $('#basic_info input').css({
                "background-color": "#EFEFEF",
                "height": "20px",
                "color": "#a7a7a7"

            });

            var reference = $(this).parent().parent().next().children();
            $('#service').show();
            $('#service').val(selectedService);
            $('#service').removeAttr('disabled', 'disabled');
            $('#sub_services input[type="checkbox"]').removeAttr('disabled', 'disabled');

            $('#service').focus();
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
                            url: '<?php echo $this->request->webroot ?>EmployeeMembers/saveUserInfo',
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
                            if (columnName == 'description') {
                                $('#' + columnName).css({
                                    "background-color": "#EFEFEF",
                                    "color": "#a7a7a7"
                                });
                            } else {
                                $('#' + columnName).css({
                                    "background-color": "#EFEFEF",
                                    "height": "20px",
                                    "color": "#a7a7a7"
                                });
                            }
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

        $('#service').change(function () {
            var serviceId = $(this).val();

            if (serviceId !== "") {
                $.ajax({
                    url: '<?php echo $this->request->webroot ?>EmployeeMembers/findServices',
                    data: {
                        'service_id': serviceId
                    },
                    type: 'POST',
                    cache: false,
                    async: false,
                    success: function (responce) {
                        $('#sub_services').show();
                        var data = JSON.parse(responce);
                        $('#sub_services').html(data);

                    },
                    error: function () {
                        alert('error');
                    }

                });

            } else {
                show_custom_message('Please select service');
                $('#service').focus();
                $('#sub_services').hide();
            }

        });

        $(document).on('click', 'input[type="checkbox"]', function () {
            var serviceId = $('#service').val();
            var subServiceIds = "";
            $('input[type="checkbox"]').each(function (index) {

                if ($(this).is(':checked')) {
                    subServiceIds = subServiceIds + $(this).val() + '_';
                }
            });

            if (subServiceIds !== "") {

                $.ajax({
                    url: '<?php echo $this->request->webroot ?>EmployeeMembers/updateServices',
                    data: {
                        'service_id': serviceId,
                        'ids': subServiceIds
                    },
                    type: 'POST',
                    cache: false,
                    async: false,
                    success: function (responce) {
                        var message = parseInt(responce);

                        if (message == 1) {
                            show_custom_message('Services has been saved.');
                        } else if (message == 0) {
                            show_custom_message('Services could not saved. Please try again.');
                        }
                    },
                    error: function () {
                        alert('error');
                    }

                });

            }

        });

    });

</script>
