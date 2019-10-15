<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Right $right
 */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">Edit Permission</p>
    <a href="<?php echo $this->request->webroot ?>rights" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        
        <?php echo $this->Form->create($right,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','id'=>'')); ?>

        <div class="form-group required">
            <label for="role_id" class="col-md-2 control-label">Select Role</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('role_id', ['label'=>false,'empty'=>'SELECT Role','options' => $roles, 'class'=>'form-control']);
                    ?>
                </div>
            <label for="role_id" class="col-md-2 control-label">Select Module</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('module_id', ['label'=>false,'empty'=>'SELECT Module','options' => $modules, 'class'=>'form-control']);
                    ?>
                </div>

        </div> 
         
        <div class="form-group required">
            <label for="role_id" class="col-md-2 control-label">Select User </label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('user_id', ['label'=>false,'empty'=>'SELECT User','options' => $users, 'class'=>'form-control']);
                    ?>
                </div>
            
            <label for="status" class="col-md-2 control-label">Status</label>	
            <div class="col-md-4"> 
                <?php  $args = array(''=>'SELECT STATUS','0'=>'Inactive', '1'=>'Active');
                echo $this->Form->input('status',array('options'=>$args,'default'=>'','div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
            </div>
    
        </div> 
  <div class="form-group">
            <div class="col-md-12 text-center">
                <?php 
                echo $this->Form->control('Edit Permissions',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg'));
                echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>