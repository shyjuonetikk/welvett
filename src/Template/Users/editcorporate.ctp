<div class="panel-head-info">
    <p class="pull-left info-text">Step 1. Update User</p>
    <a href="<?php echo $this->request->webroot ?>users/corporate" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>
</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($user, array('type' => 'file', 'class' => 'form-horizontal', 'id' => 'UserAddForm', 'enctype' => 'multipart/form-data')); ?>
        <fieldset>
            <div class="form-group required">
                <label for="job_title" class="col-md-2 control-label">Job Title</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('job_title', array('div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => $user->corporate_member->job_title, 'required')); ?>
                </div>
                <label for="company_name" class="col-md-2 control-label">Company Name</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('company_name', array('div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => $user->corporate_member->company_name, 'required')); ?>
                </div>  
            </div> 

            <div class="form-group required">
                <label for="company_address" class="col-md-2 control-label">Company Address</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('company_address', array('div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => $user->corporate_member->company_address, 'required')); ?>
                </div>
                <label for="company_email" class="col-md-2 control-label">Company Email</label>	
                <div class="col-md-4">    
                    <?php echo $this->Form->control('email', array('type' => 'email', 'div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => $user->corporate_member->company_email, 'required')); ?>
                </div> 
            </div>
            <div class="form-group required">
                <label for="password" class="col-md-2" style="padding-top: 7px; ">Password</label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('password', array('type' => 'password', 'label' => false, 'div' => false, 'labeltextarea' => false, 'class' => 'form-control text-lowercase', 'value' => '')); ?>
                </div>
                <label for="confirm_password" class="col-md-2" style="padding-top: 7px;">Confirm Password</label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('confirm_password', array('type' => 'password', 'div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => '')); ?>
                </div>
            </div>

            <div class="form-group required">
                <label for="company_phone" class="col-md-2 control-label">Company Phone</label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('company_phone', array('div' => false, 'label' => false, 'class' => 'form-control', 'value' => $user->corporate_member->company_phone)); ?>
                </div>
                <label for="is_authorized" class="col-md-2 control-label not-requried">Is Authorize</label>	
                <div class="col-md-4"> 
                    <?php
                    $args = array('yes' => 'Yes', 'no' => 'No');
                    echo $this->Form->input('is_authorized', array('options' => $args, 'default' => '', 'div' => false, 'label' => false, 'class' => 'form-control', 'required', 'value' => $user->corporate_member->is_authorize));
                    ?>
                </div>
            </div> 

            <div class="form-group required">
                <label for="authorizer_first_name" class="col-md-2">Authorizer First name</label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('authorizer_first_name', array('div' => false, 'label' => false, 'class' => 'form-control', 'required', 'value' => $user->corporate_member->authorizer_first_name)); ?>
                </div>
                <label for="authorizer_last_name" class="col-md-2">Authorizer Last Name</label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('authorizer_last_name', array('div' => false, 'label' => false, 'class' => 'form-control', 'required', 'value' => $user->corporate_member->authorizer_last_name)); ?>
                </div>
            </div> 
            <div class="form-group required">
                <label for="authorizer_job_title" class="col-md-2">Authorizer Job Title </label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('authorizer_job_title', array('type' => '', 'label' => false, 'div' => false, 'labeltextarea' => false, 'class' => 'form-control text-lowercase', 'required', 'value' => $user->corporate_member->authorizer_job_title)); ?>
                </div>
                <label for="address2" class="col-md-2">Authorizer Email</label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('authorizer_email', array('div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => $user->corporate_member->authorizer_email)); ?>
                </div>
            </div> 

            <div class="form-group required">
                <label for="authorizer_phone" class="col-md-2">Authorizer Phone</label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('authorizer_phone', array('type' => '', 'label' => false, 'div' => false, 'labeltextarea' => false, 'class' => 'form-control text-lowercase', 'required', 'value' => $user->corporate_member->authorizer_phone)); ?>
                </div>
                <label for="photo" class="col-md-2">Photo</label>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                    <label id="sectionImage" class="btn btn-default btn-file">
                        Browse <input style="display: none;" type="file" name="image" class="section-image" id="sectionImage" onchange="readURL(this)">
                    </label>
                    <br />
                    <?php
                    $image = '#';
                    if (!empty($user->profile_image) && file_exists(WWW_ROOT . 'img' . DS . 'users' . DS . $user->profile_image)) {
                        $image = $this->request->webroot . 'img' . DS . 'users' . DS . $user->profile_image;
                    }
                    ?>
                    <img id="show_section_uploaded_image" width="200" src="<?= $image ?>"  class="section-up-image" alt="upload photo"/>
                </div>
            </div> 
        </fieldset>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php
                echo $this->Form->control('Update', array('type' => 'submit', 'div' => false, 'label' => false, 'class' => 'btn btn-default btn-blue-custom btn-lg', 'id' => 'register'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $('#UserAddForm').submit(function () {
            if ($('#password').val() != '') {
                if ($('#password').val() != $('#confirm-password').val()) {
                    alert("Confirm password must match");
                    $('#confirm-password').focus();
                    return false;
                }
            }

        });
        $("#register").click(function () {

            var email = $("#email").val();
            var phone = $("#phone1").val();
            var phone2 = $("#phone2").val();
            var zip = $("#zip").val().length;

            var email_pat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var phone_pat = /^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/;

            if (email === '' || phone === '') {
                alert('Please fill the form properly, Fields with * are required.');

            } else if (!email_pat.test(email))
            {
                alert('Invalid email format');
                $('#email').focus();
            } else if (!phone_pat.test(phone))
            {
                alert('Invalid phone 1 format');
                $('#phone').focus();
            } else if (phone2 !== "" && !phone_pat.test(phone2))
            {
                alert('Invalid phone 2 format');
                $('#phone2').focus();
            } else if (zip !== 5)
            {
                alert('zip code must be 5 digits.');
                $('#zip').focus();
            } else {
                if ($('input[required="required"], select[required="required"], textarea[required="required"]').val() == "") {
                    $('input[required="required"], select[required="required"], textarea[required="required"]').addClass('red_border');
                    alert('Please fill the form properly, Fields with * are required.');

                } else {

                    $('#UserAddForm').submit();
                }
            }
        });

    });
    function readURL(input, showId = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.files[0]);   
            reader.onload = function (e) {

                if (showId)
                {
                    if (input.id == "sliderImage") {
                        $('#show_uploaded_image' + showId)
                                .attr('src', e.target.result);
                    }
                    if (input.id == "sectionImage") {
                        $('#show_section_uploaded_image' + showId)
                                .attr('src', e.target.result);
                    }
                } else {
                    if (input.id == "sliderImage") {
                        $('#show_uploaded_image')
                                .attr('src', e.target.result);
                    }
                    if (input.id == "sectionImage") {
                        $('#show_section_uploaded_image')
                                .attr('src', e.target.result);
                    }
                }
            };

            reader.readAsDataURL(input.files[0]);
    }
    }
</script>

