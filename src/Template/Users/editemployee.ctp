<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
$states = array('' => 'Select State', 'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona',
    'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut',
    'DE' => 'Delaware', 'DC' => 'District of Columbia', 'FL' => 'Florida',
    'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois',
    'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky',
    'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts',
    'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri',
    'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire',
    'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York',
    'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio',
    'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania',
    'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota',
    'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont',
    'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming',
);
?>
<div class="panel-head-info">
    <p class="pull-left info-text">Step 1. Update User</p>
    <a href="<?php echo $this->request->webroot ?>users/individuals" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>
</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($user, array('type' => 'file', 'class' => 'form-horizontal', 'id' => 'UserAddForm', 'enctype' => 'multipart/form-data')); ?>
        <fieldset>
            <div class="form-group required">
                <label for="first_name" class="col-md-2 control-label">First Name</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('Users.first_name', array('div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => $user->first_name, 'required')); ?>
                </div>
                <label for="last_name" class="col-md-2 control-label">Last Name</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('Users.last_name', array('div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => $user->last_name, 'required')); ?>
                </div>  

            </div> 
            <div class="form-group required">
                <label for="category" class="col-md-2 control-label">Choose Category</label>	
                <div class="col-md-4">   
                    <?php echo $this->Form->control('EmployeeMembers.eventcategory_id', array('div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'options' => $eventcategories, 'value' => $user->employee_member->eventcategory_id, 'required')); ?>
                </div> 
                <label for="email" class="col-md-2 control-label">Email</label>	
                <div class="col-md-4">    
                    <?php echo $this->Form->control('Users.email', array('type' => 'email', 'div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => $user->email, 'required')); ?>
                </div>
            </div> 

            <div class="form-group required">
                <label for="address" class="col-md-2 control-label">Address</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('EmployeeMembers.address', array('div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => $user->employee_member->address, 'required')); ?>
                </div>
                <label for="state" class="col-md-2 control-label">State</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('EmployeeMembers.state', array('div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'options' => $states, 'value' => $user->employee_member->state, 'required')); ?>
                </div>
            </div>
            <div class="form-group required">
                <label for="city" class="col-md-2 control-label">City</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('EmployeeMembers.city', array('div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => $user->employee_member->city, 'required')); ?>
                </div>
                <label for="social_media_link" class="col-md-2 control-label">Social Media Link</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('EmployeeMembers.social_media_link', array('div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => $user->employee_member->social_media_link, 'required')); ?>
                </div>

            </div>
            <div class="form-group required">
                <label for="description" class="col-md-2 control-label">Description</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('EmployeeMembers.description', array('div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => $user->employee_member->description, 'required')); ?>
                </div>                
            </div>
            <div class="form-group required">
                <label for="password" class="col-md-2 control-label">Password</label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('Users.password', array('id' => 'password', 'type' => 'password', 'label' => false, 'div' => false, 'labeltextarea' => false, 'class' => 'form-control text-lowercase', 'value' => '')); ?>
                </div>
                <label for="confirm_password" class="col-md-2">Confirm Password</label>	
                <div class="col-md-4">  
                    <?php echo $this->Form->control('Users.confirm_password', array('id' => 'confirm-password', 'type' => 'password', 'div' => false, 'label' => false, 'class' => 'form-control text-lowercase', 'value' => '')); ?>
                </div>
            </div>

            <div class="form-group required">
                <label for="photo" class="col-md-2">Photo</label>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                    <label id="sectionImage" class="btn btn-default btn-file">
                        Browse <input style="display: none;" type="file" name="Users[image]" class="section-image" id="sectionImage" onchange="readURL(this)">
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

