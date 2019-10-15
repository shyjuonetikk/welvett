<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Right[]|\Cake\Collection\CollectionInterface $rights
 */
?>
<div class="panel-head-info">
    <div class="clearfix"></div>
    <a href="<?php echo $this->request->webroot ?>rights/add" class="btn btn-default btn-blue-custom btn-lg"><i class="fa fa-plus"></i> Add Permissions</a>
</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('module_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rights as $right): ?>
       
                    <tr>
                        <td><?= $right->has('role') ? $this->Html->link($right->role->name, ['controller' => 'Roles', 'action' => 'view', $right->role->id]) : '' ?></td>
                        <td><?= $right->has('module') ? $this->Html->link($right->module->name, ['controller' => 'Modules', 'action' => 'view', $right->module->id]) : '' ?></td>
                        <td><?= $right->has('user') ? $this->Html->link($right->user->name, ['controller' => 'Users', 'action' => 'view', $right->user->id]) : '' ?></td>

                        <td data-title="status">
                                                    <?php
                            if($right->status == 1){
                                echo "Active";
                            } else{
                                echo "Inactive";
                            }
                            ?>

                        </td>
                        <td data-title="modified"><?= h($right->modified) ?></td>
                        <td data-title="actions" class="actions">

                            <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> '), array('controller' => 'rights', 'action' => 'view',$right->id),array('class'=>'btn btn-primary','escape'=>false)); ?>

                            <?php 
                            $role = $this->request->session()->read('Auth.User.role_id');
                            if($role == 1 || $role == 2){
                            ?>

                            <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'rights', 'action' => 'edit',$right->id),array('class'=>'btn btn-success','escape'=>false)); ?>

                            <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller'=>'rights','action' => 'delete', $right->id], ['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $right->id)]); ?>

                            <?php } ?>
                        </td>
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
