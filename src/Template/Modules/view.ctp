<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Module $module
 */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">View Module</p>
    <a href="<?php echo $this->request->webroot ?>modules/index" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        
                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('path') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('orders') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id', 'Added By') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col""><?= $this->Paginator->sort('modified') ?></th>
                        
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        
                        <td><?= h($module->name) ?></td>
                        <td><?= h($module->path) ?></td>
                        <td><?= $this->Number->format($module->orders) ?></td>
                        <td data-title="Added By"><?= h($module->user->user_name) ?></td>

                        <td data-title="Status">
                                    <?php
                                        if($module->status == 1){
                                            echo "Active";
                                        } else{
                                            echo "Inactive";
                                        }
                                    ?>
                                </td>
                        <td data-title="Modified"><?= h($module->modified) ?></td>
                        
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>



