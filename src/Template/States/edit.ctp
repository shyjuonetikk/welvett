<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">Edit State</p>
    <a href="<?php echo $this->request->webroot ?>States/index" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($state,array('class'=>'form-horizontal','id'=>'')); ?>

        <div class="form-group required">

            <label for="first_name" class="col-md-2 control-label">State Name</label>
            <div class="col-md-6">

                <?php echo $this->Form->control('statename',array('div'=>false,'label'=>false,'class'=>'form-control text-capitalize','required')); ?>
            </div>

        </div> 
        <?php

        $userid = $this->request->session()->read('Auth.User.id');
        echo $this->Form->control('user_id', ['type' => 'hidden','value'=>$userid]);
        ?>
        <div class="form-group required">
            <label for="status" class="col-md-2 control-label not-requried">Status</label>	
            <div class="col-md-6"> 
                <?php  $args = array(''=>'SELECT STATUS','0'=>'Inactive', '1'=>'Active');
                echo $this->Form->input('status',array('options'=>$args,'default'=>'','div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
            </div>

        </div> 
        
        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php 
                echo $this->Form->control('Update States',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg'));
                echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
