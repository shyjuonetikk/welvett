<?php

/**
  * @var \App\View\AppView $this
  */
?>
<style>
    .roles_heading {
        background-color: #BE935F;
        color: #fff;
    }
    div.unique_colors{
        background: #fff;
    }
    .roles_settings > div.form-group {
        margin-bottom: 0px !important;
    }
    .roles_settings > div.form-group > div.unique_colors{
        padding: 7px !important;
    }
</style>
<div class="panel-head-info">
    <p class="pull-left info-text">Add Role</p>
    <a href="<?php echo $this->request->webroot ?>Roles/index" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($role,array('class'=>'form-horizontal','id'=>'')); ?>

        <div class="form-group required">
            <label for="name" class="col-md-2 control-label">Role</label>
            <div class="col-md-4">


                <?php echo $this->Form->control('name',array('div'=>false,'label'=>false,'class'=>'form-control text-uppercase','required')); ?>
            </div>

        </div> 
        <fieldset class="roles_settings">

            <div class="row roles_heading" style="">
                <div class="col-md-4">
                    <h3>Pages</h3>
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <h3>Permissions</h3>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <?php
           
            foreach ($modulesList as $module){
               
            ?>
            <div class="form-group required">
                <div class="col-md-6 unique_colors">
                    <label>

                        <input type="checkbox" value="<?php echo $module->id;?>" name="controller[]" />
                        <?php echo $module->controller;?>
                    </label>

                </div>
                <div class="col-md-3">
                    <!-- radio value 1 for read access-->
                    <label>
                        <input type="radio" value="1" name="<?php echo $module->id;?>" /> &nbsp;&nbsp;Read 
                    </label> 

                </div>
                <div class="col-md-3">
                    <!-- radio value 2 for read write-->
                    <label> 
                        <input type="radio" value="2" name="<?php echo $module->id;?>" /> &nbsp;&nbsp;Write
                    </label> 
                </div>

            </div> 
            <?php 
            
            } 
            ?>
        </fieldset>
        <div class="clearfix">&nbsp;</div>
        <div class="form-group required">
            <div class="col-md-12 text-center">
                <?php 
                echo $this->Form->control('Add Roles',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg'));
                echo $this->Form->end(); ?>
            </div>

        </div> 



    </div>
</div>

