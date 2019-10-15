<?php

/**
  * @var \App\View\AppView $this
  */
use Cake\Datasource\ConnectionManager;
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
    <p class="pull-left info-text">Edit Permission</p>
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
               
                 $conn = ConnectionManager::get('default');
                  

                      $query3 = $conn->execute('SELECT *'
                            . ' FROM rights '
                            
                            
                            . 'where role_id="' . $role['id'] . '" and module_id="'.$module['id'].'"');
                   //debug($query);exit;
                    $chec = $query3->fetchAll('assoc');
                    //debug($chec[0]['module_id']);
            ?>
            <div class="form-group required">
                <div class="col-md-6 unique_colors">
                    <label>

                        <input type="checkbox" id="module<?php echo $module->id;?>" value="<?php echo $module->id;?>" name="controller[]"  <?php if(isset($chec[0]['module_id']))if($chec[0]['module_id'] == $module->id){
								echo 'checked="checked"' ;
							}?>/>
                        <?php echo $module->controller;?>
                    </label>

                </div>
                <div class="col-md-3">
                    <!--radio button 1 value for read access-->
                    <label>
                       
                        <input type="radio" value="1"   id="<?php echo $module->id;?>per1" name="<?php echo $module->id;?>" <?php if(isset($chec[0]['per_type']))if($chec[0]['per_type'] == 1){
								echo 'checked="checked"' ;
							}?>/> &nbsp;&nbsp;Read 
                    </label> 

                </div>
                <div class="col-md-3">
<!--radio button 2 value for write access-->
                    <label> 
                        <?php ?>
                        <input type="radio"  value="2" id='<?php echo $module->id;?>per2' name="<?php echo $module->id;?>" <?php if(isset($chec[0]['per_type']))if($chec[0]['per_type'] == 2){
								echo 'checked="checked"' ;
							}?>/> &nbsp;&nbsp;Write
                    </label> 
                </div>

            </div>
            <script>
                
                
              <?php  if(  !isset($chec[0]['per_type'])) {?>
              
               $("#module<?php echo $module->id;?>").click(function () {
            
         
         if($("#module<?php echo $module->id;?>").attr('checked', 'unchecked')  )
         {  
             
             $("#<?php echo $module->id;?>per1").attr('checked', !$("#<?php echo $module->id;?>per1").attr("checked"));
            
             $("#module<?php echo $module->id;?>").attr('checked', !$("#module<?php echo $module->id;?>").attr("checked"));
             
             
         }
       
         
         
         
         });
            

      
        <?php  } else if(  $chec[0]['per_type']== 1) { 
            
            
            ?>
                
        $("#module<?php echo $module->id;?>").click(function () {
            
         
         if($("#module<?php echo $module->id;?>").attr('checked', 'unchecked')  )
         {  
             
             $("#<?php echo $module->id;?>per1").attr('checked', !$("#<?php echo $module->id;?>per1").attr("checked"));
            
             $("#module<?php echo $module->id;?>").attr('checked', !$("#module<?php echo $module->id;?>").attr("checked"));
             
             
         }
       
         
         
         
         });
         
          <?php } else  if(  $chec[0]['per_type']== 2) { ?>
      
           $("#module<?php echo $module->id;?>").click(function () {
            
         
         if($("#module<?php echo $module->id;?>").attr('checked', 'unchecked')  )
         {  
             
             $("#<?php echo $module->id;?>per2").attr('checked', !$("#<?php echo $module->id;?>per2").attr("checked"));
            
             $("#module<?php echo $module->id;?>").attr('checked', !$("#module<?php echo $module->id;?>").attr("checked"));
             
             
         }
       
         
         
         
         });
          <?php }  ?>
      
        
      

</script>
            <?php 
            
            } 
            ?>
        </fieldset>
        <div class="clearfix">&nbsp;</div>
        <div class="form-group required">
            <div class="col-md-12 text-center">
                <?php 
                echo $this->Form->control('Edit Roles',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-default btn-blue-custom btn-lg','id'=>'role'));
                echo $this->Form->end(); ?>
            </div>

        </div> 
       


    </div>
</div>


