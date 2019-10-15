<?php

/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Role $role
  */
//debug($role);
?>

<div class="panel-head-info">
    <p class="pull-left info-text">View Role</p>
    <a href="<?php echo $this->request->webroot ?>roles/index" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="row">
        <h3><?php echo $role->name;?></h3>
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col">Module</th>
                        <th scope="col">Perminssions</th>

                    </tr>

                </thead>
                <tbody>
                    <?php 
                    $controller = "";
                    $permission = "";
                    $type = "";
                    foreach($role->rights as $list){
                        $controller = $list->module->controller;
                        $type = $list->per_type;
                        if($type == 1){
                            $permission = "Read";
                        } else if($type == 2){
                            $permission = "Write";
                        }
                    ?>
                    <tr>
                        <td data-title="Module"><?php echo $controller;?></td> 
                        <td data-title="Perminssions"><?php echo $permission;?></td> 
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
