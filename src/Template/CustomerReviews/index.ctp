<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerReview[]|\Cake\Collection\CollectionInterface $customerReviews
 */
$array = explode('/', $_SERVER['REQUEST_URI']);
$userId = end($array);
$userId;
?>
<div class="panel-head-info">
    <div class="clearfix"></div>

</div>
<?php
if ($permission == 1) {
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
                        <th scope="col"><?= $this->Paginator->sort('customer_id', 'Customer Name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('review', 'Review') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('talent_event_id', 'Talent Event') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('talent_id', 'Talent Name') ?></th>

                        <th scope="col"><?= $this->Paginator->sort('modified', 'Modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions', 'Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customerReviews as $customerReview):
                        ?>

                        <tr>  
                            <td><?= ($customerReview->talent_user) ? ucfirst(strtolower($customerReview->talent_user->user_name)) : ''; ?></td>
                            <td><?php echo substr($customerReview->review, 0, 65); ?>...</td>
                            <td><?php echo $customerReview['talent_event']['talent_event_subcategories'][0]['eventcategory']['title'] ?></td>
                            <td><?= ucfirst(strtolower($customerReview->customer_user->user_name)) ?></td>

                            <td data-title="modified"><?= h(date('n/j/y', strtotime($customerReview->modified))) ?></td>
                            <td class="actions" data-title="Actions">


                                <?php
                                if ($permission == 2) {
                                    ?>

                                    <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'customerreviews', 'action' => 'edit', 'id' => $customerReview->id, 'user_id' => $userId), array('class' => 'btn btn-success', 'escape' => false)); ?>

                                    <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'customerreviews', 'action' => 'delete', $customerReview->id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $customerReview->id)]); ?>

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

