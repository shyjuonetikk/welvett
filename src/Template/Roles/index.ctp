
<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Role[]|\Cake\Collection\CollectionInterface $roles
  */
?>
<div class="panel-head-info">
    <div class="clearfix"></div>
    <?php 
    if($permission == 2){
    ?>
    <a href="<?php echo $this->request->webroot ?>roles/add" class="btn btn-default btn-blue-custom btn-lg"><i class="fa fa-plus"></i> Add Roles</a>
    <?php } ?>
</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>

                        <th scope="col"><?= $this->Paginator->sort('Roles') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role): ?>
                    <tr>
                        <td data-title="Roles"><?= h($role->name) ?></td>

                        <td class="actions" data-title="Actions">



                            <?php 
    if($permission == 2){
                            ?>

                            <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'roles', 'action' => 'edit',$role->id),array('class'=>'btn btn-success','escape'=>false)); ?>

                            <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller'=>'roles','action' => 'delete', $role->id], ['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $role->name)]); ?>

                            <?php } else{ ?>
                            <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>'), array('controller' => 'Roles', 'action' => 'view',$role->id),array('class'=>'btn btn-primary','escape'=>false)); ?>
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
