<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">Edit Customer Review</p>
     <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($customerReview,array('class'=>'form-horizontal','id'=>'')); ?>

        <div class="form-group required">
            <label for="review" class="col-md-2 control-label">Review</label>
            <div class="col-md-6">

                <?php echo $this->Form->control('review',array('div'=>false,'label'=>false,'class'=>'form-control text-capitalize','required','type'=>'textarea')); ?>
                
            </div>

        </div> 
       

        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php 
                echo $this->Form->control('Update Customer Review',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg'));
                echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
