<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">Edit Membership</p>
    <a href="<?php echo $this->request->webroot ?>Memberships/index/" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($membership,array('class'=>'form-horizontal','id'=>''));?>

        <div class="form-group required">
            <label for="amount" class="col-md-2 control-label">Amount</label>
            <div class="col-md-4">

                <?php echo $this->Form->control('amount',array('div'=>false,'label'=>false,'class'=>'form-control','required')); ?>
              
            </div>
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
        <div class="form-group required">
            <label for="pay_date" class="col-md-2 control-label">Pay Date</label>
           <div class="col-md-4"> 
                 <?php echo $this->Form->control('pay_date',array('div'=>false,'label'=>false,'class'=>'form-control datepicker','required','type'=>'text')); ?>
           </div> 
            <label for="expiry_date" class="col-md-2 control-label">Expiry Date</label>
           <div class="col-md-4"> 
                 <?php echo $this->Form->control('expiry_date',array('div'=>false,'label'=>false,'class'=>'form-control datepicker','required','type'=>'text')); ?>
           </div> 

        </div> 

        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php 
                echo $this->Form->control('Edit Membership',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg'));
                echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
