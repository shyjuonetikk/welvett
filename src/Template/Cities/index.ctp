<?php

/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\City[]|\Cake\Collection\CollectionInterface $cities
  */

$array = explode('/', $_SERVER['REQUEST_URI']);
$userId = end($array);
?>
<div class="panel-head-info">
    <div class="clearfix"></div>
    <?php 
    if($permission == 2){
    ?>
    <a href="<?php echo $this->request->webroot ?>cities/add/<?php echo $stateId;?>" class="btn btn-default btn-blue-custom btn-lg"><i class="fa fa-plus"></i> Add Cities</a>
    <?php } ?>
    <a href="<?php echo $this->request->webroot ?>states/index/" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>

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
                        <th scope="col" ><?= $this->Paginator->sort('state_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('names','City Name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('user_id', 'Added By') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th style="width: 150px;" scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cities as $city): ?>

                    <tr>
                        <?php /* $city->has('state') ? $this->Html->link($city->state->statename, ['controller' => 'States', 'action' => 'view', $city->state->id]) : '' */ ?>
                        <td data-title="State"><?= h(ucfirst(strtolower($city->state->statename))) ?></td>

                        <td data-title="City Name"><?= h(ucfirst(strtolower($city->names))) ?></td>
                        <td data-title="status">
                            <?php
        if($city->status == 1){
            echo "Active";
        } else{
            echo "Inactive";
        }
                            ?>
                        </td>
                        <td data-title="Added By"><?= $city->has('user') ? $this->Html->link($city->user->user_name, ['controller' => 'Users', 'action' => 'view-profile', $city->user->id]) : '' ?></td>
                        <td data-title="modified"><?= h(date('n/j/y', strtotime($city->modified))) ?></td>
                        <td class="actions" data-title="Actions">

                            <?php echo $this->Html->link(__('Terminals'), array('controller' => 'Terminals', 'action' => 'index',$city->id),array('class'=>'btn btn-primary','escape'=>false)); ?>

                            <?php 
                         if($permission == 2){
                            ?>

                            <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'cities', 'action' => 'edit',$city->id),array('class'=>'btn btn-success','escape'=>false)); ?>

                            <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller'=>'cities','action' => 'delete', $city->id], ['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $city->names)]); ?>

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


