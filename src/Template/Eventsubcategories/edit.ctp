<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="panel-head-info">
    <a href="<?php echo $this->request->webroot.'eventsubcategories/index/'.$this->request->params['pass'][1]; ?>" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($eventsubcategory,array('class'=>'form-horizontal','id'=>'','type' => 'file')); ?>
         
        <div class="form-group required">
            <label for="eventcategory_id" class="col-md-2 control-label">Event Category</label>
            <div class="col-md-4">
                <?php echo $this->Form->control('eventcategory_id', ['label'=>false,'empty'=>'Select Event Category','options' => $eventcategories, 'class'=>'form-control','id'=> 'bus_id']);?>
               
                

            </div>
             <label for="Title" class="col-md-2 control-label">Title</label>
            <div class="col-md-4">
                <?php echo $this->Form->control('title',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
                

            </div>
             
          
        </div>
        <div class="form-group required">
           <label for="status" class="col-md-2 control-label not-requried">Status</label>	
            <div class="col-md-4"> 
                <?php  $args = array(''=>'SELECT STATUS','0'=>'Inactive', '1'=>'Active');
                echo $this->Form->input('status',array('options'=>$args,'default'=>'','div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
            </div>
            
             
          
        </div>
        
     <?php

        $userid = $this->request->session()->read('Auth.User.id');
        echo $this->Form->control('user_id', ['type' => 'hidden','value'=>$userid]);
        ?>

        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php 
                echo $this->Form->control('Update',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg'));
                echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
