<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Module $module
 */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">Add Modules</p>
    <a href="<?php echo $this->request->webroot ?>modules" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($module,array('class'=>'form-horizontal','enctype'=>'multipart/form-data','id'=>'')); ?>

        <div class="form-group required">
            <label for="name" class="col-md-2 control-label">Name</label>
            <div class="col-md-4">

                <?php echo $this->Form->control('name',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
            </div>
            <label for="path" class="col-md-2 control-label">Path</label>
            <div class="col-md-4">

                <?php echo $this->Form->control('path',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
            </div>
            <label for="orders" class="col-md-2 control-label">Order ID</label>
            <div class="col-md-4">

                <?php echo $this->Form->control('orders',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
            </div>
            <?php

                $userid = $this->request->session()->read('Auth.User.id');
                echo $this->Form->control('user_id', ['type' => 'hidden','value'=>$userid]);
                ?>
            <label for="status" class="col-md-2 control-label not-requried">Status</label>	
            <div class="col-md-4"> 
                <?php  $args = array(''=>'SELECT STATUS','0'=>'Inactive', '1'=>'Active');
                echo $this->Form->input('status',array('options'=>$args,'default'=>'','div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
            </div>

        </div> 
         
        
            

        </div> 

        

        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php 
                echo $this->Form->control('Add Modules',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg'));
                echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>




