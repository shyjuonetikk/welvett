<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Payment[]|\Cake\Collection\CollectionInterface $payments
  */
?>
<div class="panel-head-info">
    <div class="clearfix"></div>
    <a href="<?php echo $this->request->webroot ?>payments/add" class="btn btn-default btn-blue-custom btn-lg"><i class="fa fa-plus"></i> Add Payments</a>
</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col" style="width: 150px;"><?= $this->Paginator->sort('payment_type') ?></th>
                        <th scope="col" style="width: 150px;"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col" style="width: 150px;"><?= $this->Paginator->sort('user_id') ?></th>
                        <th scope="col" style="width: 150px;"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" style="width: 150px;" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $payment):
       // debug($payment->user->user_name);exit;
                    ?>
                    <tr>
                        <td data-title="payment type"><?= h($payment->payment_type) ?></td>
                        <td data-title="status">
                            <?php
    if($payment->status == 1){
        echo "Active";
    } else{
        echo "Inactive";
    }
                            ?>

                        </td>
                        <td data-title="user id"><?= $payment->has('user') ? $this->Html->link($payment->user->user_name, ['controller' => 'Users', 'action' => 'view', $payment->user->id]) : '' ?></td>
                        <td data-title="modified"><?= h($payment->modified) ?></td>
                        <td data-title="actions" class="actions">

                            <?php echo $this->Html->link(__('<i class="fa fa-eye"></i> '), array('controller' => 'payments', 'action' => 'view',$payment->id),array('class'=>'btn btn-primary','escape'=>false)); ?>

                            <?php 
                            $role = $this->request->session()->read('Auth.User.role_id');
                            if($role == 1 || $role == 2){
                            ?>

                            <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'payments', 'action' => 'edit',$payment->id),array('class'=>'btn btn-success','escape'=>false)); ?>

                            <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller'=>'payments','action' => 'delete', $payment->id], ['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $payment->payment_type)]); ?>

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



