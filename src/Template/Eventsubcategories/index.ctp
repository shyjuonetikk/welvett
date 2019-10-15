<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Eventsubcategory[]|\Cake\Collection\CollectionInterface $eventsubcategories
 */
?>
<div class="container-fluid">

    <?php
    if ($permission == 2) {
        ?>

        <a href="<?php echo $this->request->webroot . 'eventsubcategories/add/' . $this->request->params['pass'][0] ?>" class="btn btn-blue-custom btn-sm"><i class="fa fa-plus"></i> Add Service Sub-category </a>
    <?php } ?>
</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <form method="post" id="myForm" action="<?php echo $this->request->webroot; ?>eventsubcategories/udapteorder">
                <table class="table-bordered table-striped table-condensed cf">
                    <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('eventsubcategory_id', 'Service Sub Category') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('title', 'Title') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('ordinal', 'Ordinal') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('status', 'Status') ?></th>

                            <th scope="col"><?= $this->Paginator->sort('user_id', 'Added By') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('modified', 'Modified') ?></th>
                            <th scope="col" class="actions"><?= __('Actions', 'Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eventsubcategories as $eventsubcategory): ?>

                            <tr>
                                <td data-title="Service Sub Category'"><?php echo $eventsubcategory['eventcategory']['title'] ?></td>
                                <td data-title="Title"><?php echo $eventsubcategory['title'] ?></td>
                                <td data-title="Ordinal">
                                    <?php echo $this->Form->control('eventsubcat_order', array('type' => 'number', 'value' => $eventsubcategory->ordinal, 'name' => 'data[ordinal][]', 'div' => false, 'label' => false, 'class' => 'form-control', 'required' => 'required')); ?>
                                    <?php echo $this->Form->control('eventsubcat_id', array('type' => 'hidden', 'value' => $eventsubcategory->id, 'name' => 'data[eventsubcat_id][]', 'div' => false, 'label' => false, 'class' => 'form-control')); ?>
                                </td> 
                                <td data-title="Status">   
                                    <?php
                                    if ($eventsubcategory->status == 1) {
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    }
                                    ?>
                                </td>
                                <td data-title="Added By"><?= $eventsubcategory->has('user') ? $this->Html->link($eventsubcategory->user->user_name, ['controller' => 'Users', 'action' => 'view-profile', $eventsubcategory->user->id]) : '' ?></td>


                                <td data-title="Modified"><?php echo date('n/j/y', strtotime($eventsubcategory->modified)); ?></td>
                                <td data-title="actions" class="actions">


                                    <?php
                                    if ($permission == 2) {
                                        ?>

                                        <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'eventsubcategories', 'action' => 'edit', $eventsubcategory->id, $this->request->params['pass'][0]), array('class' => 'btn btn-success', 'escape' => false)); ?>

                                        <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'eventsubcategories', 'action' => 'delete', $eventsubcategory->id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $eventsubcategory->id)]); ?>

                                    <?php } ?>
                                </td>


                            </tr>


                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: center;">
                                <!--<button class="btn btn-blue-custom btn-lg col-xs-offset-6 col-md-offset-6" style="margin-top:10px;margin-bottom:10px;" id="orderupdate_btn" >Update Order</button>-->
                                <button class="btn btn-blue-custom btn-md col-xs-offset-6 col-md-offset-6" style="border:none !important; margin-left:unset !important" id="orderupdate_btn" >Update Order</button>

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>


                    </tbody>
                </table>
            </form>
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#orderupdate_btn").click(function () {
            $("#myForm").submit();
        });
    });
</script>
