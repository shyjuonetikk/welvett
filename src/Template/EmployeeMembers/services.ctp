<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<?php

use Cake\I18n\Time;
?>
<style>
    .add_new_service{
        color: white;
    }
    .add_new_service:hover{
        color: white !important;
    }
    label input{
        margin-right:5px !important;
    }
</style>
<section class="content-wrapper header_bg">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="row" style="padding-top:25px; padding-bottom: 10px;">
                    <?php
                    foreach ($talent_events as $img) {
                        ?>
                        <div class="col-md-2">
                            <img src="<?php echo $this->request->webroot . 'img/event/' . $img->eventcategory->image_icon; ?>" style="width:40px;">
                        </div>
                    <?php } ?>
                </div>            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <?php
                $c_image = 'cyber1550500683.png';
                if ($user->profile_image && file_exists(WWW_ROOT . 'img' . DS . 'users' . DS . $user->profile_image)) {
                    $c_image = $user->profile_image;
                }

                $path = '';
                $loginWithSocial = $user->loginwithsocial;
                $path = $user->profile_image;
                $image = 'cyber1550500683.png';
                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {

                    $path = $user->profile_image;
                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                    if ($user->profile_image == '') {

                        $path = $this->request->webroot . 'img/users/' . $image;
                    } else {
                        $path = $this->request->webroot . 'img/users/' . $path;
                    }
                } else {
                    $path = $this->request->webroot . 'img/users/' . $image;
                }
                ?>
                <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $path; ?>');">

                </div>
                <div>
                    <!--<img class="profile_image" src="" alt="">-->
                    <span class="white_color"><strong><?= ucfirst($user->first_name); ?></strong></span>
                    <br>

                </div>
            </div>
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="pos_absolute review_btn_parent" style="right: 10%;top:0;">
                    <a style="display:block" href="<?php echo $this->request->webroot; ?>EmployeeMembers/employee_events" class="review_link">
                        <button class="review_button">

                            <i class="fa fa-briefcase"></i>
                        </button>
                        <span class="white_color">My Bookings</span>
                    </a>
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
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="active">Home</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
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

                                First Name
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">

                            <input id="first_name" type="text" class="" readonly value="<?= $user->first_name ?>" onchange="update_field()">
                        </div>
                        <div class="col-md-6 col-lg-6 text-right">
                            <span style="position: relative;">

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

                                Email
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input id="email" type="text" class="" readonly value="<?php echo $user->email; ?>">
                        </div>

                        <div class="col-md-6 col-lg-6 text-right">
                            <span style="position: relative;">

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


                    </div>

                </div>
            </div>

            <div class="col-md-8 col-lg-8 col-xl-7">
                <div id="my_events">
                    <div>
                        <div>
                            <h4 class="text-center" style="margin-bottom: 1rem;"><i class="fa fa-calendar"></i> My Services</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12 new_service_div" style="padding:10px;">
                                <a class="event_button add_new_service" style="color:white;padding:8px 10px;" data-toggle="modal" data-target="#myModal">Add new service</a>
                                <br>
                                <br>
                            </div>
                            <?php
                            foreach ($talent_events as $event):
                                ?>
                                <div class="col-md-12">
                                    <div class="row service_list">
                                        <div class="col-lg-2">
                                            <div class="event_image" style="width:80px;background-position: center;background-size:cover;border: 1px solid #511723;;background-image: url('<?php echo $this->request->webroot . 'img/event/' . $event->eventcategory->image_icon; ?>');"></div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="">
                                                <a href="<?php echo $this->request->webroot . 'EmployeeMembers/employeeFreeevents/' . $event->id; ?>">
                                                    <strong style="font-size:20px"><?php echo ucwords($event->eventcategory->title); ?></strong>
                                                </a>
                                            </div>
                                            <div class="sub_service_badge">
                                                <?php foreach ($event->talent_event_subcategories as $sub): ?>
                                                    <span class="badge badge-info" style="font-size:12px;margin-right:5px">
                                                        <?php
                                                        echo $subcategories[$sub->eventsubcategory_id];
                                                        ?>
                                                    </span>
                                                <?php endforeach; ?> 
                                            </div>
                                        </div>
                                        <div class="col-lg-5 ">
                                            <a href="<?php echo $this->request->webroot . 'EmployeeMembers/employeeFreeevents/' . $event->id; ?>" class="event_button add_new_service" style="padding: 8px 10px !important;" data-toggle='tooltip' title="Dashboard" ><i class="fa fa-dashboard" aria-hidden="true"></i></a>
                                            <a onclick="edit_service(<?= $event->id ?>)" class="event_button add_new_service" style="color:white;padding: 8px 10px !important;" data-toggle='tooltip' title="Edit Service" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="<?php echo $this->request->webroot . 'EmployeeMembers/delete_service/' . $event->id; ?>"  data-toggle='tooltip' title="Delete Service" onclick="return confirm('Are you sure you want to delete this service')" class="event_button add_new_service" style="color:white;padding: 8px 10px !important;"><span class="fa fa-trash-o"></span></a>
                                            <?php
                                            if ($event->status == 1) {
                                                ?>
                                                <a href="<?php echo $this->request->webroot . 'EmployeeMembers/serviceVisibility/' . $event->id . '/inactive'; ?>"  data-toggle='tooltip' title="Inactive Service" onclick="return confirm('This Service is active. Are you sure you want to deactivate it.')" class="event_button add_new_service" style="color:white;padding: 8px 10px !important;"><span class="fa fa-eye-slash"></span></a>
                                            <?php } else { ?>
                                                <a href="<?php echo $this->request->webroot . 'EmployeeMembers/serviceVisibility/' . $event->id . '/active'; ?>"  data-toggle='tooltip' title="Active Service" onclick="return confirm('This Service is Inactive. Are you sure you want to activate it.')" class="event_button add_new_service" style="color:white;padding: 8px 10px !important;"><span class="fa fa-eye"></span></a>

                                            <?php } ?>
                                        </div>
                                    </div>
                                    <br>
                                    <p><?php // echo strlen($booking->talent->employee_member->description) > 200 ? substr($booking->talent->employee_member->description, 0, 200) . "..." : $booking->talent->employee_member->description    ?></p>
                                    <!--<button class="event_button pull-right">Release Money</button>-->
                                    <!--<button class="event_button pull-right" style="margin-right: 20px;">Disputes</button>-->
                                    <!--<button class="event_button pull-right" onclick="show_detail(<?= $booking->id; ?>)" style="margin-right: 20px;">view</button>-->
                                    <hr>
                                </div>

                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg" style="width:600px">
                <div class="modal-content">
                    <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                        <h5 class="modal-title">Add New Service</h5>
                    </div>
                    <?php echo $this->Form->create('add', ['id' => 'add_service']); ?>
                    <div class="modal-body">

                        <!--                        <fieldset>-->
                        <div class="row" id="category_div" style="margin-bottom:20px !important;">
                            <label for="eventcategory_id" class="col-md-12 control-label">Category</label>
                            <div class="col-md-12">
                                <?php echo $this->Form->control('eventcategory_id', array('id' => 'category', 'onchange' => 'get_subcats("add")', 'div' => false, 'label' => false, 'class' => 'custom_field', 'options' => $categories, 'required', 'empty' => 'Select Category')); ?>
                            </div>
                        </div> 
                        <div id="eventSubCat" class="edit_eventSubCat">

                        </div>

                        <!--                        </fieldset>-->
                        <!--</div>-->
                    </div>
                    <div class="modal-footer" style="text-align:right">
                        <?php
                        echo $this->Form->button('Add service', array('type' => 'submit', 'div' => false, 'label' => false, 'class' => 'event_button', 'id' => 'register', 'style' => 'margin:unset !important;padding: 0.25rem 0.5rem !important;font-size:0.875rem !important;cursor:pointer'));
                        ?>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit_services" role="dialog">
            <div class="modal-dialog modal-lg" style="width:600px">
                <div class="modal-content">
                    <div class="" style="padding:10px;background-color: #7B1B2D;color: white;">
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                        <h5 class="modal-title">Edit Service</h5>
                    </div>
                    <?php echo $this->Form->create('edit', ['id' => 'edit_service', 'url' => '/TalentEvents/eventEditFrontend']); ?>
                    <div class="modal-body" id="get_form">
                    </div>
                    <div class="modal-footer" style="text-align:right">
                        <?php
                        echo $this->Form->button('Update service', array('type' => 'submit', 'div' => false, 'label' => false, 'class' => 'event_button', 'id' => 'register', 'style' => 'margin:unset !important;padding: 0.25rem 0.5rem !important;font-size:0.875rem !important;cursor:pointer'));
                        ?>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function get_subcats(type) {
        var get_id = 'category';
        if (type == 'edit') {
            get_id = 'edit_category';

        }
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'TalentEvents/get_subcategories'; ?>',
            data: 'cat_id=' + $('#' + get_id).val(),
            contentType: 'json',
            success: function (data)
            {

                if (type == 'edit') {
                    $('.edit_eventSubCat').html(data);

                } else {
                    $('.edit_eventSubCat').html(data);

                }

            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }
    function edit_service(service_id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'TalentEvents/getTelentService'; ?>',
            data: 'service_id=' + service_id,
            contentType: 'json',
            success: function (data)
            {
                $('#get_form').html(data);
                $('#edit_services').modal('show');

            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }
</script>
<script>
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


    });

</script>
