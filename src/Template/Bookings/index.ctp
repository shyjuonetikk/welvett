<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Booking[]|\Cake\Collection\CollectionInterface $bookings
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

                        <th scope="col"><?= $this->Paginator->sort('customer_id','Customer Name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('status','Status') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('is_completed','Is Completed') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('talent_event_id','Talent Event') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('talent_id','Talent Name') ?></th>

                        <th scope="col"><?= $this->Paginator->sort('modified','Modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions','Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
    foreach ($bookings as $booking):  
                    //debug($booking);
                    ?>

                    <tr data-title="Customer Name"> 
                        <td><?= ucfirst(strtolower($booking->customer_user->user_name)) ?></td>
                        <td data-title="status">
                            <?php
    if($booking->status == 1){
        echo "accept";
    } else{
        echo "decline";
    }
                            ?>
                        </td>
                        <td><?php echo  $booking->is_completed;?></td>
                        <td><?php echo $booking['talent_event']['talent_event_subcategories'][0]['eventcategory']['title'] ?></td>

                        <td><?= ucfirst(strtolower($booking->talent_user->user_name)) ?></td>


                        <td data-title="modified"><?= h(date('n/j/y', strtotime($booking->modified))) ?></td>
                        <td class="actions" data-title="Actions">


                            <?php 
    if($permission == 2){
                            ?>

                            <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'bookings', 'action' => 'edit',$booking->id),array('class'=>'btn btn-success','escape'=>false)); ?>

                            <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller'=>'bookings','action' => 'delete', $booking->id], ['escape'=>false,'class'=>'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $booking->id)]); ?>

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
