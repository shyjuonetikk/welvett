<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">Step 1. Update User</p>
    <a href="<?php echo $this->request->webroot ?>users/users_list" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($user,array('type'=>'file','class'=>'form-horizontal','id'=>'UserAddForm', 'enctype'=>'multipart/form-data')); ?>
        <fieldset>
            <div class="form-group required">
                <label for="role_id" class="col-md-2 control-label">Select Role</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('role_id', ['label'=>false,'empty'=>'SELECT ROLE','options' => $roleList, 'class'=>'form-control']);
                    ?>
                </div>

            </div>
            <div class="form-group required">
                <label for="first_name" class="col-md-2 control-label">First Name</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('first_name',array('div'=>false,'label'=>false,'class'=>'form-control text-capitalize','required')); ?>
                </div>
                <label for="last_name" class="col-md-2 control-label">Last Name</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('last_name',array('div'=>false,'label'=>false,'class'=>'form-control text-capitalize','required')); ?>
                </div>  
            </div>   


            <div class="form-group required">
                <label for="user_name" class="col-md-2 control-label">User Name</label>	
                <div class="col-md-4">
                    <?php echo $this->Form->control('user_name',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                </div>
                <label for="email" class="col-md-2 control-label">Email</label>	
                <div class="col-md-4">    
                    <?php
                    echo $this->Form->control('email',array('type'=>'email','div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                </div> 
            </div>

            <div class="form-group required">
                <label for="pwd" class="col-md-2 control-label">Password</label>	
                <div class="col-md-4">  
                    <?php	echo $this->Form->control('pwd',array('type'=>'password','div'=>false,'label'=>false,'class'=>'form-control')); ?>
                </div>
                <label for="gender" class="col-md-2 control-label not-requried">Gender</label>	
                <div class="col-md-4"> 
                    <?php  $args = array(''=>'SELECT GENDER','FEMALE'=>'Female', 'MALE'=>'Male');
                    echo $this->Form->input('gender',array('options'=>$args,'default'=>'','div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                </div>
            </div> 

            <div class="form-group required">
                <label for="phone1" class="col-md-2 control-label">Phone 1</label>	
                <div class="col-md-4">  
                    <?php	echo $this->Form->control('phone1',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                </div>
                <label for="phone2" class="col-md-2 control-label">Phone 2</label>	
                <div class="col-md-4">  
                    <?php	echo $this->Form->control('phone2',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                </div>

            </div> 


            <div class="form-group required">
                <label for="address1" class="col-md-2 control-label">Address 1</label>	
                <div class="col-md-4">  
                    <?php	echo $this->Form->control('address1',array('type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                </div>
                <label for="address2" class="col-md-2">Address 2</label>	
                <div class="col-md-4">  
                    <?php	echo $this->Form->control('address2',array('type'=>'textarea','div'=>false,'label'=>false,'class'=>'form-control')); ?>
                </div>
            </div> 

            <div class="form-group required">
                <label for="city" class="col-md-2 control-label">City</label>	
                <div class="col-md-4">  
                    <?php	echo $this->Form->control('city',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                </div>
                <label for="state" class="col-md-2 control-label">State</label>	
                <div class="col-md-4">  
                    <?php	echo $this->Form->control('state',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                </div>

            </div>  


            <div class="form-group required">
                <label for="zip" class="col-md-2 control-label not-requried">Zip</label>	
                <div class="col-md-4">
                    <?php 
                    echo $this->Form->control('zip', ['label'=>false,'type'=>'text', 'class'=>'form-control']);
                    ?>
                </div> 
                <label for="status" class="col-md-2 control-label not-requried">Status</label>	
                <div class="col-md-4"> 
                    <?php  $args = array(''=>'SELECT STATUS','0'=>'Inactive', '1'=>'Active');
                    echo $this->Form->input('status',array('options'=>$args,'default'=>'','div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                </div>
            </div>  
            <div class="form-group required">

                <label for="image" class="col-md-3 control-label">Photo <br /><small class="text-danger">[Best size: 200px * 200px]</small></label>
                <span class="btn btn-default btn-file">
                    Browse <input type="file" name="image" class="section-image" id="sectionImage" onchange="readURL(this)">
                </span>
                <br /><img id="show_section_uploaded_image"  src="<?php echo $this->request->webroot ?>img/users/<?php echo $user->profile_image; ?>"  class="section-up-image" alt=""/>
            </div>  


        </fieldset>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php 
    echo $this->Form->control('Update User',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg'));
                           echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#UserAddForm').submit(function (e) {
            var $container = $("html,body");
            var $scrollTo = $('.mymsg');
            var pwd_len = $("#pwd").val().length;
            var checkbox_permission = 0;

            if (pwd_len < 8) {
                $('.mymsg').html('');
                $('.mymsg').append("<div class='error'>Password too short, provide at least 8 characters</div>");
                $container.animate({scrollTop: $scrollTo.offset().top - $container.offset().top, scrollLeft: 0}, 300);
                return false;
            }
            if ($(".section-image").val() != "") {
                var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                if ($.inArray($(this).find(".section-image").val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    $(this).find(".btn-file").css("border","1px solid red");
                    alert("Invalid user image format,Only formats are allowed : "+fileExtension.join(', '));
                    e.preventDefault();
                    return false;
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

