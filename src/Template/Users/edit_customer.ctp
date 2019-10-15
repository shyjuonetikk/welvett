
<!--header start-->
<div class="bg" style="background: url('<?php echo $this->request->webroot;?>bus_front/assets/images/header_bg.jpg') center center no-repeat !important;">
    <div>
        <h1 style="margin-top: 100px !important;">Customer Profile</h1>
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
        <?php echo $this->Form->create($user,array('type'=>'file','class'=>'form-horizontal label_margin','id'=>'UserAddForm', 'enctype'=>'multipart/form-data')); ?>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="first_name">First Name</label>
            <?php echo $this->Form->control('first_name',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="last_name">Last Name</label>
            <?php echo $this->Form->control('last_name',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="user_name">User Name</label>
            <?php echo $this->Form->control('user_name',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="email">Email</label>
            <?php
            echo $this->Form->control('email',array('type'=>'email','div'=>false,'label'=>false,'class'=>'form-control input_new_style','required')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="password">Password</label>
            <?php	echo $this->Form->control('pwd',array('type'=>'password','div'=>false,'label'=>false,'class'=>'form-control input_new_style','id'=>'password')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="confirm_pass">Confirm Password</label>
            <?php	echo $this->Form->control('confirm_pass',array('type'=>'password','div'=>false,'label'=>false,'class'=>'form-control input_new_style', 'id'=>'confirm_password')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="gender">Gender</label>
            <?php  $args = array(''=>'SELECT GENDER','FEMALE'=>'Female', 'MALE'=>'Male');
            echo $this->Form->input('gender',array('options'=>$args,'default'=>'','div'=>false,'label'=>false,'class'=>'form-control input_new_style')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="phone1">Phone 1</label>
            <?php	echo $this->Form->control('phone1',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="phone2">Phone 2</label>
            <?php	echo $this->Form->control('phone2',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="state">State</label>
            <?php echo $this->Form->control('state', ['label'=>false,'options' => $states, 'class'=>'form-control input_new_style', 'required']);?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="city">City</label>
            <?php	echo $this->Form->control('city',array('div'=>false,'label'=>false,'class'=>'form-control input_new_style','required')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="zip">Zip</label>
            <?php 
            echo $this->Form->control('zip', ['label'=>false,'type'=>'text', 'class'=>'form-control input_new_style', 'required']);
            ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="address1">Address 1</label>
            <?php	echo $this->Form->control('address1',array('type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control input_new_style','required')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="address2">Address 2</label>
            <?php	echo $this->Form->control('address2',array('type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control input_new_style')); ?>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <label for="photo">Photo</label>
            <br>
            <label id="sectionImage" class="btn btn-default btn-file">
                Browse <input style="display: none;" type="file" name="image" class="section-image" id="sectionImage" onchange="readURL(this)">
            </label>
            <br /><img id="show_section_uploaded_image" width="200" src="<?php echo $this->request->webroot;?>img/users/<?php echo $user->profile_image;?>"  class="section-up-image" alt=""/>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <label for="">&nbsp;</label> <br>
            <button id="register" class="btn btn-search btn-lg input_new_style" type="button" style="position: relative; width: 120px;"> 
                <span style="position: absolute; top: -10px; left: 18%;">&nbsp;&nbsp; Register</span>
            </button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>

    $(document).ready(function(){
        $("#phone2").removeAttr('required', 'required');
        $("#register").click(function () {
            var password = jQuery("#password").val();
            var cPassword = jQuery("#confirm_password").val();
            var email = $("#email").val();
            var phone = $("#phone1").val();
            var phone2 = $("#phone2").val();
            var zip = $("#zip").val().length;

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
            } 
            else {
                if($('input[required="required"], select[required="required"], textarea[required="required"]').val() == ""){
                    $('input[required="required"], select[required="required"], textarea[required="required"]').addClass('red_border');
                    alert('Please fill the form properly, Fields with * are required.');

                } else{

                    $('#UserAddForm').submit();  
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
                        $('#show_uploaded_image'+showId)
                            .attr('src', e.target.result);
                    }
                    if(input.id == "sectionImage") {
                        $('#show_section_uploaded_image'+showId)
                            .attr('src', e.target.result);
                    }
                }
                else {
                    if(input.id == "sliderImage") {
                        $('#show_uploaded_image')
                            .attr('src', e.target.result);
                    }
                    if(input.id == "sectionImage") {
                        $('#show_section_uploaded_image')
                            .attr('src', e.target.result);
                    }
                }
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

