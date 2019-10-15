
<!--header start-->
<div class="bg" style="background: url('<?php echo $this->request->webroot;?>bus_front/assets/images/header_bg.jpg') center center no-repeat !important;">
    <div>
        <h1 style="margin-top: 100px !important;">Customer Sign Up</h1>
        <p><a href="">Home</a> / Lorem .</p>
    </div>
</div>

<?php $states = array(''=>'Select State', 'AL'=>'Alabama', 'AK'=>'Alaska', 'AZ'=>'Arizona',
                      'AR'=>'Arkansas','CA'=>'California', 'CO'=>'Colorado', 'CT'=>'Connecticut', 
                      'DE'=>'Delaware', 'DC'=>'District of Columbia',  'FL'=>'Florida', 
                      'GA'=>'Georgia', 'HI'=>'Hawaii', 'ID'=>'Idaho', 'IL'=>'Illinois', 
                      'IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky',
                      'LA'=>'Louisiana','ME'=>'Maine', 'MD'=>'Maryland', 'MA'=>'Massachusetts', 
                      'MI'=>'Michigan', 'MN'=>'Minnesota', 'MS'=>'Mississippi', 'MO'=>'Missouri', 
                      'MT'=>'Montana','NE'=>'Nebraska', 'NV'=>'Nevada','NH'=>'New Hampshire', 
                      'NJ'=>'New Jersey', 'NM'=>'New Mexico','NY'=>'New York',
                      'NC'=>'North Carolina', 'ND'=>'North Dakota', 'OH'=>'Ohio', 
                      'OK'=>'Oklahoma','OR'=>'Oregon', 'PA'=>'Pennsylvania', 
                      'RI'=>'Rhode Island', 'SC'=>'South Carolina', 'SD'=>'South Dakota', 
                      'TN'=>'Tennessee', 'TX'=>'Texas', 'UT'=>'Utah','VT'=>'Vermont', 
                      'VA'=>'Virginia', 'WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming',
                     ); ?>

<!--customer form start-->
<div class="container pd_30">
    <div class="row black_color">

        <form method="post" enctype="multipart/form-data" class="label_margin" id="UserAddForm">

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="first_name" class="control-label">First Name</label>
                <?php echo $this->Form->control('first_name',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required', 'id'=>'first_name')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="last_name" class="control-label">Last Name</label>
                <?php echo $this->Form->control('last_name',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required', 'id'=>'last_name')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="user_name" class="control-label">User Name</label>
                <?php echo $this->Form->control('user_name',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required', 'id'=>'user_name')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="email" class="control-label">Email</label>
                <?php
                echo $this->Form->control('email',array('type'=>'email','div'=>false,'label'=>false,'class'=>'form-control input_new_style','required', 'id'=>'email')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="password" class="control-label">Password</label>
                <?php	echo $this->Form->control('password',array('type'=>'password','div'=>false,'label'=>false,'class'=>'form-control input_new_style','required', 'id'=>'password')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="confirm_pass" class="control-label">Confirm Password</label>
                <?php	echo $this->Form->control('confirm_pass',array('type'=>'password','div'=>false,'label'=>false,'class'=>'form-control input_new_style','required', 'id'=>'confirm_password')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="gender">Gender</label>
                <?php  $args = array(''=>'SELECT GENDER','FEMALE'=>'Female', 'MALE'=>'Male');
                echo $this->Form->input('gender',array('options'=>$args,'default'=>'','div'=>false,'label'=>false,'class'=>'form-control input_new_style', 'id'=>'gender')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="phone1" class="control-label">Phone 1</label>
                <?php	echo $this->Form->control('phone1',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required', 'id'=>'phone1')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="phone2">Phone 2</label>
                <?php	echo $this->Form->control('phone2',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style', 'id'=>'phone2')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="state" class="control-label">State</label>
                <?php echo $this->Form->control('state', ['label'=>false,'options' => $states, 'class'=>'form-control input_new_style', 'required', 'id'=>'state']);?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="city" class="control-label">City</label>
                <?php	echo $this->Form->control('city',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required', 'id'=>'city')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="zip" class="control-label">Zip</label>
                <?php 
                echo $this->Form->control('zip', ['label'=>false,'type'=>'text', 'class'=>'form-control input_new_style integeronly', 'max'=> '5', 'id'=>'zip', 'maxlength'=> '5', 'id'=>'zip']);
                ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="address1" class="control-label">Address 1</label>
                <?php	echo $this->Form->control('address1',array('type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control input_new_style','required', 'id'=>'address1')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="address2">Address 2</label>
                <?php	echo $this->Form->control('address2',array('type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control input_new_style', 'id'=>'address2')); ?>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <label for="photo">Photo</label>
                <br>
                <label id="sectionImage" class="btn btn-default btn-file">
                    Browse <input style="display: none;" type="file" name="photo" class="section-image" id="sectionImage" onchange="readURL(this)">
                </label>
                <br /><img id="show_section_uploaded_image" width="200" src="#"  class="section-up-image" alt="upload photo"/>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <label for="">&nbsp;</label> <br>
                <button id="register" class="btn btn-search btn-lg input_new_style" type="button" style="position: relative; width: 120px;"> 
                    <span style="position: absolute; top: -10px; left: 18%;">&nbsp;&nbsp; Register</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>

    jQuery(document).ready(function(){

        jQuery("#register").click(function () {

            var password = jQuery("#password").val();
            var cPassword = jQuery("#confirm_password").val();
            var email = jQuery("#email").val();
            var phone = jQuery("#phone1").val();
            var phone2 = jQuery("#phone2").val();
            var zip = jQuery("#zip").val().length;

            var email_pat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var phone_pat = /^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/;

            if (email === '' || phone === '') {
                alert('Please fill the form properly, Fields with * are required.');

            } else if (password !== cPassword)
            {
                alert('Password does not matched. Please type agian');
                jQuery("#password").val("");
                jQuery("#confirm_password").val("");
                jQuery("#password").focus();
            } else if (!email_pat.test(email))
            {
                alert('Invalid email format');
                jQuery('#email').focus();
            } else if (!phone_pat.test(phone))
            {
                alert('Invalid phone 1 format');
                jQuery('#phone').focus();
            } else if (phone2 !== "" && !phone_pat.test(phone2))
            {
                alert('Invalid phone 2 format');
                jQuery('#phone2').focus();
            } else if (zip !== 5)
            {
                alert('zip code must be 5 digits.');
                jQuery('#zip').focus();
            } 
            else {
                if(jQuery('input[required="required"], select[required="required"], textarea[required="required"]').val() == ""){
                    jQuery('input[required="required"], select[required="required"], textarea[required="required"]').addClass('red_border');
                    alert('Please fill the form properly, Fields with * are required.');

                } else{

                    jQuery('#UserAddForm').submit();  
                }
            }
        });

    });

    function readURL(input , showId = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //alert(input.files[0]);   
            reader.onload = function (e) {

                if(showId)
                {
                    if(input.id == "sliderImage") {
                        jQuery('#show_uploaded_image'+showId)
                            .attr('src', e.target.result);
                    }
                    if(input.id == "sectionImage") {
                        jQuery('#show_section_uploaded_image'+showId)
                            .attr('src', e.target.result);
                    }
                }
                else {
                    if(input.id == "sliderImage") {
                        jQuery('#show_uploaded_image')
                            .attr('src', e.target.result);
                    }
                    if(input.id == "sectionImage") {
                        jQuery('#show_section_uploaded_image')
                            .attr('src', e.target.result);
                    }
                }
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

