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
    .circle-chart {
        width: 35% !important;
        height: 85px !important;
    }
    .circle-chart__percent{
        display:none !important;
    }
    .circle-chart__subline {
        font-size: 9px !important;
        word-spacing: 9999999px;
    }
    .warning-stroke{
        stroke:#FFC502 !important;
    }
    .success-stroke{
        stroke:#FFC502 !important;

    }
</style>

<link rel="stylesheet" href="<?php echo $this->request->webroot; ?>rating/jquery.rateyo.min.css"/>
<link rel="stylesheet" href="<?php echo $this->request->webroot; ?>progress/progresscircle.css">

<section class="content-wrapper header_bg">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-5 col-lg-5 pos_relative">
                <h1 class="profile_text_color pos_absolute">
                    <?php echo $userInfo->role->name; ?>
                </h1>
            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <?php
                $c_image = 'cyber1550500683.png';
                if ($userInfo->profile_image && file_exists(WWW_ROOT . 'img' . DS . 'users' . DS . $userInfo->profile_image)) {
                    $c_image = $userInfo->profile_image;
                }
                ?>
                <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>');">
                    <?php
                    if ($isEdit == 1) {
                        echo '<i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>';
                    }
                    ?>

                </div>
                <div>
                    <span class="white_color"><strong><?= ucfirst($userInfo->first_name); ?></strong></span>
                    <br>
                    <span class="profile_text_color">
                        <?php
                        if ($userInfo->state != null) {
                            echo $userInfo->city . ', ' . $states[$userInfo->state];
                        } else {
                            ?>
                            &nbsp;&nbsp;&nbsp;
                            <?php
                        }
                        ?>
                    </span>
                </div>

            </div>
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="pos_absolute" style="right: 10%;">
                    <a href="<?php echo $this->request->webroot; ?>users/individualReviews" class="review_link">
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
                            <input id="first_name" type="text" class="" readonly value="<?php echo $userInfo->first_name; ?>">
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
                            <input id="last_name" type="text" class="" readonly value="<?php echo $userInfo->last_name; ?>">
                        </div>

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
                            <input id="email" type="text" class="" readonly value="<?php echo $userInfo->email; ?>">

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
                                Phone Number
                            </span>

                        </div>
                        <div class="col-md-6 col-lg-6 text-left">
                            <input id="phone1" type="text" class="" readonly value="<?php echo $userInfo->phone1; ?>">
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-8 col-lg-8 col-xl-8">
                <div id="my_events">
                    <div>
                        <div>
                            <h6 class="text-center"><i class="fa fa-calendar"></i> My Events</h6>
                        </div>
                        <?php
                        foreach ($bookings as $booking):
                            $rating = 0;
                            if (!empty($booking->talent_rating)) {
                                $rating = (100 * $booking->talent_rating->rate) / 5;
                            }
                            $image = 'cyber1550500683.png';
                            if ($booking->talent->profile_image != null && file_exists(WWW_ROOT . 'img' . DS . 'users' . DS . $booking->talent->profile_image)) {
                                $image = $booking->talent->profile_image;
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="event_image" style="width:80px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $image; ?>');">

                                    </div>
                                    <strong>
                                        <?php echo ucwords($booking->talent->first_name . ' ' . $booking->talent->last_name); ?>
                                    </strong>
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
                                    <p>
                                        <?php echo strlen($booking->talent->employee_member->description) > 200 ? substr($booking->talent->employee_member->description, 0, 200) . "..." : $booking->talent->employee_member->description; ?>
                                    </p>
                                    <?php
                                    if ($booking->status == 2) {
                                        ?>
                                        <button class="event_button pull-right">Release Money</button>
                                        <button class="event_button pull-right" style="margin-right: 20px;">Disputes</button> 
                                        <?php
                                    }
//                                    $booking->status=1;
                                    if ($booking->status == 1) {
                                        $status = 'Declined';
                                        $class = 'badge-danger';
                                    } elseif ($booking->status == 2) {
                                        $status = 'Accepted';
                                        $class = 'badge-success';
                                    } elseif ($booking->status == 0) {
                                        $status = 'Pending';
                                        $class = 'badge-secondary';
                                    } else {
                                        $status = 'Discussion';
                                        $class = 'badge-info';
                                    }
                                    ?>
                                    <span class="badge <?php echo $class; ?>" style="margin-right: 20px;"><?php echo $status; ?></span> 

                                </div>
                                <?php if (!empty($booking->talent_rating)) { ?>
                                    <div class="col-md-3 circlechart" data-percentage="<?php echo $rating; ?>" style="text-align:center;cursor: pointer;">
                                        <div>
                                            <?php echo!empty($booking->talent_rating) ? $booking->talent_rating->rate : 0; ?>
                                        </div>
                                    </div>
                                <?php } else { ?>

                                    <div class="col-md-3" style="text-align:center;" id="rate_button<?= $booking->id; ?>">
                                        <button id="rating_div<?= $booking->id; ?>" onclick="rating_modal(<?php echo $booking->id; ?>)" class="event_button" style="margin-top: 45px;cursor: pointer;">Rate user</button> 
                                    </div>
                                <?php } ?>


                                <div class="col-md-3 col-lg-3 col-xl-3" style="margin-top: 20px;">
                                    <?php
                                    if ($booking->status == 2 || $booking->status == 1) {
                                        ?>
                                        <div style="margin-left: 30px;">
                                            <?php
                                            if (empty($booking->talent_review)) {
                                                ?>
                                                <form id="review<?= $booking->id; ?>" onsubmit="return submit_review(<?= $booking->id; ?>)">
                                                    <input type="hidden" name="booking_id" value="<?= $booking->id; ?>">
                                                    <textarea class="review_textarea" rows="1" name="review" placeholder="Additional Comments." style="font-size: 12px;margin-top: 5px"></textarea>
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
                                    <?php } ?>
                                </div>

                            </div>
                            <hr>

                        <?php endforeach; ?>
                    </div>
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
    <div class="modal fade" id="booking_modal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div  class="" style="padding:0 10px;color: #808080;">
                    <button type="button" class="close" data-dismiss="modal" style="color: #808080;">&times;</button>
                    <h5 class="modal-title">Ratings</h5>
                </div>
                <?php echo $this->Form->create('ratings', ['id' => 'ratings']); ?>
                <div class="modal-body">
                    <input type="hidden" name="booking_id" value="">
                    <input type="hidden" name="review" value="">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="rateYo"></div>
                        </div>
                        <div class="col-md-3" >
                            <p id="show_rating" style="height:20px;margin-bottom: 0.5rem;text-align: center;color:#808080;font-weight: bold;"></p>
                            <button id="submit_rating" type="button" class="event_button" style="padding: 5px 10px !important;cursor: pointer;">Submit rating </button>
                        </div>

                    </div>

                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo $this->request->webroot; ?>rating/jquery.rateyo.js"></script>
<script src="<?php echo $this->request->webroot; ?>progress/progresscircle.js"></script>
<script>
                                                    $('.circlechart').circlechart(); // Initialization
</script>
<script>
    function rating_modal(b_id) {
        var current_rating = $('#rating_div' + b_id).attr('rating');
        $('input[name=booking_id]').val(b_id);
        var $rateYo = $(".rateYo").rateYo({
            rating: current_rating,
            starWidth: "64px"
        });
        /* set the option `onChange` */
        $rateYo.rateYo("option", "onChange", function (rating, rateYoInstance) {
            $('#show_rating').text(rating);
            /* get the rated fill at the current point of time */
            var ratedFill = $rateYo.rateYo("option", "ratedFill");
            console.log("The color of rating is " + ratedFill);
        });
        $rateYo.rateYo("option", "onSet", function (rating, rateYoInstance) {
            $('#ratings input[name=review]').val(rating);

        });
        /* set the option `multiColor` to show Multi Color Rating */
        $rateYo.rateYo("option", "multiColor", true);
        $('#booking_modal').modal('show');
    }

</script>
<script>

    function submit_review(review) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'users/add_review' ?>',
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

    $(document).ready(function () {
        /*
         * change image
         */
        $('#submit_rating').click(function () {
            if (!$('#ratings input[name=review]').val()) {
                show_custom_message('Please select a review');
                return false;
            }

            $.ajax({
                type: 'GET',
                url: '<?php echo $this->request->webroot . 'Users/ratings' ?>',
                data: $('#ratings').serialize(),
                contentType: 'json',
                success: function (data)
                {
                    var rating = $('#ratings input[name=review]').val();
                    var b_id = $('#ratings input[name=booking_id]').val();
                    data = JSON.parse(data);
                    if (data.flag == 1) {
                        var calculate_percentage = (100 * rating) / 5;
                        var change_class = 'success-stroke';
                        if (rating <= 1.5) {
                            var change_class = 'warning-stroke';
                        }
                        var insert_html = '<div class="col-md-3 circlechart" data-percentage="' + calculate_percentage + '" style="text-align:center;cursor: pointer;"><svg class="circle-chart" viewBox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg"><circle class="circle-chart__background" cx="16.9" cy="16.9" r="15.9"></circle><circle class="circle-chart__circle ' + change_class + '" stroke-dasharray="' + calculate_percentage + ',100" cx="16.9" cy="16.9" r="15.9"></circle><g class="circle-chart__info"><text class="circle-chart__percent" x="17.9" y="15.5">' + calculate_percentage + '%</text><text class="circle-chart__subline" x="16.91549431" y="22">' + rating + '</text> </g></svg></div>'
                        $('#rate_button' + b_id).replaceWith(insert_html);
                        $('#booking_modal').modal('hide');
                        show_custom_message(data.message);
                    } else {
                        $('#booking_modal').modal('hide');
                        show_custom_message(data.message);

                    }

                }, error: function (error) {
                    // alert(JSON.stringify(error));
                }
            });


        });
        $("#edit_image").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo $this->request->webroot . 'Users/editImage' ?>",
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


        // edit profile info
        $('.edit_info').click(function () {

            $('#basic_info input').attr('readonly', true);
            $('#basic_info input').css({
                "background-color": "#EFEFEF",
                "height": "20px",
                "color": "#a7a7a7"

            });

            var reference = $(this).parent().parent().next().children();
            $(reference).attr('readonly', false);
            $(reference).focus();
            $(reference).css({
                "background-color": "#fff",
                "height": "20px",
                "color": "#5E5E5E"

            });
        });

        $('input').keyup(function (e) {
            var key = e.keyCode;
            var data = $(this).val();
            var columnName = $(this).attr('id');


            if (key === 13) {
                if (columnName == "password") {
                    if ($('#password').val() !== "") {
                        $('#confirm_password').attr('readonly', false);
                        $('#confirm_password').trigger('focus');
                        $('#confirm_password').css({
                            "background-color": "#fff",
                            "height": "20px",
                            "color": "#5E5E5E"

                        });
                    } else {
                        $('#password').focus();
                        show_custom_message('Please type password.');
                    }
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
                        url: '<?php echo $this->request->webroot ?>users/saveUserInfo',
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