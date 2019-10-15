<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Module[]|\Cake\Collection\CollectionInterface $modules
 */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">View Modules</p>
    <div class="clearfix"></div>
    <a href="<?php echo $this->request->webroot ?>modules/add" class="btn btn-default btn-blue-custom btn-lg"><i class="fa fa-plus"></i> Add Modules</a>
</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        
                        <th scope="col" style="width: 140px;"><?= $this->Paginator->sort('name') ?></th>
                        <th scope="col" style="width: 140px;"><?= $this->Paginator->sort('path') ?></th>
                        <th scope="col" style="width: 140px;"><?= $this->Paginator->sort('orders') ?></th>
                        <th scope="col" style="width: 100px;"><?= $this->Paginator->sort('user_id', 'Added By') ?></th>
                        <th scope="col" style="width: 140px;"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col" style="width: 140px;"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" style="width: 140px;" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modules as $module): 
                        ?>
                    
                    <tr>
                       
                        <td><?= h($module->name) ?></td>
                        <td><?= h($module->path) ?></td>
                        <td><?= $this->Number->format($module->orders) ?></td>
                        <td data-title="Added By"><?= $module->has('user') ? $this->Html->link($module->user->user_name, ['controller' => 'Users', 'action' => 'view', $module->user->id]) : '' ?></td>

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
                <td data-title="Actions" class="actions">

                            <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> '), array('controller' => 'modules', 'action' => 'view',$module->id),array('class'=>'btn btn-primary','escape'=>false)); ?>

                            <?php 
                            $role = $this->request->session()->read('Auth.User.role_id');
                            if($role == 1 || $role == 2){
                            ?>
                            
                            <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'modules', 'action' => 'edit',$module->id),array('class'=>'btn btn-success','escape'=>false)); ?>

                            <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller'=>'modules','action' => 'delete', $module->id], ['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $module->name)]); ?>

                            <?php } ?>
                        </td>
                    </tr>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
            </div>
        </div>
    </div>
</div>

