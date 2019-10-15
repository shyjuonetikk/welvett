<?php

use Cake\I18n\Time;

$loginWithSocial = $this->request->session()->read('Auth.User.loginwithsocial');
?>

<style>
    #basic_info input{
        height: 20px;
    }

</style>
<link rel="stylesheet" href="<?php echo $this->request->webroot; ?>rating/jquery.rateyo.min.css"/>
<link rel="stylesheet" href="<?php echo $this->request->webroot; ?>progress/progresscircle.css">
<!-- Zabuto Calendar -->
<link rel="stylesheet" type="text/css" href="<?= $this->request->webroot; ?>dist/bootstrap-clockpicker.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<section class="content-wrapper header_bg">
    <div class="container">
        <div class="row" id="profile_header">
            <div class="col-md-5 col-lg-5 pos_relative">
                <h1 class="profile_text_color pos_absolute">
                    Talent
                </h1>
            </div>
            <div class="col-md-2 col-lg-2 text-center">
                <?php
                $c_image = 'cyber1550500683.png';
                if ($loginWithSocial != 'undefined' && $loginWithSocial != "") {
                    ?>
                    <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $userInfo['profile_image']; ?>');">

                        <i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>

                    </div>
                    <?php
                } else if ($loginWithSocial == 'undefined' || $loginWithSocial == '') {
                    if ($userInfo['profile_image'] == '') {
                        ?>
                        <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>');">

                            <i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>

                        </div>

                        <?php
                    } else {
                        ?>
                        <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $userInfo['profile_image']; ?>');">
                            <i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div id='profile_image_div' class="profile_image" style="display: inline-block;width:130px;background-position: center;background-size:cover;background-image: url('<?php echo $this->request->webroot . 'img/users/' . $c_image; ?>');">

                        <?php
                        if ($isEdit == 1) {
                            echo '<i class="fa fa-pencil edit_profile" data-toggle="modal" data-target="#myModal"></i>';
                        }
                        ?>

                    </div>
                <?php }
                ?>

                <div>
                    <span class="white_color"><strong><?= ucfirst($userInfo->first_name); ?></strong></span>
                    <br>

                </div>

            </div>
            <div class="col-md-5 col-lg-5 pos_relative">
                <div class="pos_absolute" style="right: 10%;">
                    <div class="btn_in_header">
                        <a href="<?php echo $this->request->webroot; ?>employeeMembers/talentReviews" class="review_link">
                            <button class="review_button">

                                <i class="fa fa-star"></i>
                            </button>
                            <span class="white_color">My Reviews</span>
                        </a>
                    </div>

                    <div class="btn_in_header">
                        <a href="<?php echo $this->request->webroot; ?>employeeMembers/employeeEvents" class="review_link">
                            <button class="review_button">

                                <i class="fa fa-calendar"></i>
                            </button>
                            <span class="white_color">My Events</span>
                        </a>
                    </div>
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
                        <li class=""><a class="black-text" href="<?= $this->request->webroot; ?>EmployeeMembers/services">Home</a><i class="" aria-hidden="true"> > &nbsp;</i></li>
                        <li class="active">My Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <form id="dashboard_service">
            <div class="" id="basic_info">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12" style="padding-bottom: 20px;">
                        <div>
                            <h6 class="text-center"><i class="fa fa-users"></i> Account Settings</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-xl-2 offset-md-1 text-left">
                            <span style="position: relative;">
                                <i class="fa fa-pencil edit_info"></i>
                                First Name
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <input id="first_name" name="first_name" type="text" class="" readonly value="<?php echo $userInfo->first_name; ?>">
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-2 offset-md-1 text-left">
                            <span style="position: relative;">
                                <i class="fa fa-pencil edit_info"></i>

                                Last Name
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <input id="last_name" name="last_name" type="text" class="" readonly value="<?php echo $userInfo->last_name; ?>">
                        </div>

                        <div class="col-md-4 col-lg-4 col-xl-2 offset-md-1 text-left">
                            <span style="position: relative;">
                                <i class="fa fa-pencil edit_info"></i>
                                Email
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <input id="email" name="email" type="text" class="" readonly value="<?php echo $userInfo->email; ?>">

                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-2 offset-md-1 text-left">
                            <span style="position: relative;">
                                <i class="fa fa-pencil edit_info"></i>
                                Phone Number
                            </span>

                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <input id="phone1" name="phone" type="text" class="" readonly value="<?php echo $userInfo->phone1; ?>">
                        </div>

                        <div class="col-md-4 col-lg-4 col-xl-2 offset-md-1 text-left">

                            <span style="position: relative;">
                                <i class="fa fa-pencil edit_info"></i>
                                Street Address
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <input id="address1" name="address1" type="text" class="" readonly value="<?php echo $userInfo->address1; ?>">

                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-2 offset-md-1 text-left">

                            <span style="position: relative;">
                                <i class="fa fa-pencil edit_info"></i>
                                Street Address2
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <input id="appartment" name="appartment" type="text" class="" readonly value="<?php echo $userInfo->appartment; ?>">

                        </div>

                        <div class="col-md-4 col-lg-4 col-xl-2 offset-md-1 text-left">

                            <span style="position: relative;">
                                <i class="fa fa-pencil edit_info"></i>
                                Description
                            </span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <textarea style="padding: 5px;" id="description" name="description" readonly cols="30" rows="5"><?php echo $userInfo->employee_member->description; ?></textarea>

                        </div>


                        <div class="clearfix">&nbsp;</div>
                        <div class="col-md-12 col-lg-12 text-center" style="margin-bottom:8px;">    
                            <button type="button" id="submit_dashboard_service" style="display: none; border:none; color:#fff; background:#802335; border-radius: 3px; font-size: 12px; padding: 2px 15px;cursor: pointer;">Save</button> 
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
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

    $(document).ready(function () {
        /*
         * change image
         */

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

            $('#basic_info input, textarea').attr('readonly', false);
            $('#submit_dashboard_service').show();
            $('#basic_info input').css({
                "background-color": "#fff",
                "height": "25px",
                "color": "#5E5E5E",
                "outline": "1px solid #ccc"
            });
            $('#basic_info textarea').css({
                "background-color": "#fff",
                "color": "#5E5E5E",
                "outline": "1px solid #ccc"
            });

        });
        var phone_pat = /^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/;

        $('#submit_dashboard_service').click(function () {

            var phone = $("#phone1").val();

            if (!phone_pat.test(phone)) {

                show_custom_message('Invalid phone format.');
            } else {
                $.ajax({
                    url: "<?php echo $this->request->webroot . 'employeeMembers/updateServicesDashboard' ?>",
                    type: "GET",
                    data: $('#dashboard_service').serialize(),
                    success: function (data)
                    {

                        data = JSON.parse(data);
                        if (data.flag == 1) {
                            show_custom_message(data.message);

                            $('#submit_dashboard_service').hide();
                            $('#basic_info input').css({
                                'outline': 'unset',
                                "background-color": "#EFEFEF"
                            });
                            $('#basic_info input').attr('readonly', true);
                        } else {
                            show_custom_message(data.message);
                        }
                    }

                });

            }


        });

    });
</script>

<script type="text/javascript" src="<?= $this->request->webroot; ?>dist/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">
    function clockpicker() {
        $('.clockpicker').clockpicker()
                .find('input').change(function () {
            console.log(this.value);
        });
    }

</script>