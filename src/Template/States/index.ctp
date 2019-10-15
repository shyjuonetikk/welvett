<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\State[]|\Cake\Collection\CollectionInterface $states
  */
?>
<div class="panel-head-info">
    <div class="clearfix"></div>
     <?php 
                            if($permission == 2){
                            ?>
    <a href="<?php echo $this->request->webroot ?>states/add" class="btn btn-default btn-blue-custom btn-lg"><i class="fa fa-plus"></i> Add States</a>
                            <?php }?>
</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('statename') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id','Added By') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($states as $state): ?>

                    <tr>
                        <td data-title="statename"><?= h(ucfirst(strtolower($state->statename))) ?></td>
                        <td data-title="status">  <?php
                            if($state->status == 1){
                                echo "Active";
                            } else{
                                echo "Inactive";
                            }
                            ?></td>
                        <td data-title="Added By"><?= $state->has('user') ? $this->Html->link($state->user->user_name, ['controller' => 'Users', 'action' => 'view-profile', $state->user->id]) : '' ?></td>
                       <td data-title="modified"><?= h(date('n/j/y', strtotime($state->modified))) ?></td>
                        <td class="actions" data-title="Actions">

                            <?php echo $this->Html->link(__('Cities'), array('controller' => 'Cities', 'action' => 'index',$state->id),array('class'=>'btn btn-primary','escape'=>false)); ?>

                            <?php 
                            if($permission == 2){
                            ?>

                            <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'states', 'action' => 'edit',$state->id),array('class'=>'btn btn-success','escape'=>false)); ?>

                            <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller'=>'states','action' => 'delete', $state->id], ['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $state->statename)]); ?>

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


