<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Membership[]|\Cake\Collection\CollectionInterface $memberships
  */
?>
<div class="panel-head-info">
    <div class="clearfix"></div>
    
</div>
<?php 
    if($permission == 1){
?>
<div class="clrearfix">&nbsp;</div>
<div class="clrearfix">&nbsp;</div>
<?php } ?>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('amount','Amount') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('pay_date','Pay Date') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('expiry_date','Expiry Date') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status','Status') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id', 'Added By') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified','Modified') ?></th>
                        <th style="width: 150px;" scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($memberships as $membership): ?>

                    <tr>
                        <td data-title="Amount"><?= h($membership->amount) ?></td>
                        <td data-title="Pay Date"><?= h($membership->pay_date) ?></td>
                        <td data-title="Expiry Date"><?= h($membership->expiry_date) ?></td>
                        <td data-title="Status">
                            <?php
        if($membership->status == 1){
            echo "Active";
        } else{
            echo "Inactive";
        }
                            ?>
                        </td>
                        <td data-title="Added By"><?= $membership->has('user') ? $this->Html->link($membership->user->user_name, ['controller' => 'Users', 'action' => 'view-profile', $membership->user->id]) : '' ?></td>
                        <td data-title="Modified"><?= h(date('n/j/y', strtotime($membership->modified))) ?></td>
                        <td class="actions" data-title="Actions">

                           
                            <?php 
                         if($permission == 2){
                            ?>

                            <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'memberships', 'action' => 'edit',$membership->id),array('class'=>'btn btn-success','escape'=>false)); ?>

                            <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller'=>'memberships','action' => 'delete', $membership->id], ['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $membership->id)]); ?>

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

