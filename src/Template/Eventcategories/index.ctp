<div class="container-fluid">
    <?php
    if ($permission == 2) {
        ?>
        <a href="<?php echo $this->request->webroot ?>eventcategories/add" class="btn btn-blue-custom btn-sm"><i class="fa fa-plus"></i> Add Service Category </a>
    <?php } ?>
</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <form method="post" id="myForm" action="<?php echo $this->request->webroot; ?>eventcategories/udapteorder">
                <table class="table-bordered table-striped table-condensed cf">
                    <thead>
                        <tr>
                            <th scope="col"><?= $this->Paginator->sort('title', 'Title') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('image_icon', 'Icon') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('ordinal', 'Ordinal') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('status', 'Status') ?></th>

                            <th scope="col"><?= $this->Paginator->sort('user_id', 'Added By') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('modified', 'Modified') ?></th>
                            <th scope="col" style="color:black !important;">Sub Services</th>
                            <th scope="col" class="actions" style="color:black !important;"><?= __('Actions', 'Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eventcategories as $eventcategory): ?>
                            <tr>
                                <td data-title="Title"><?php echo $eventcategory['title'] ?></td>
                                <td data-title="Icon">
                                    <img  width="100" src="<?php echo $this->request->webroot ?>img/event/thumbnail/<?php echo h($eventcategory->image_icon); ?>" alt="N/A" />&nbsp;
                                </td>
                                <td data-title="Ordinal">
                                    <?php echo $this->Form->control('eventcat_order', array('type' => 'number', 'value' => $eventcategory->ordinal, 'name' => 'data[ordinal][]', 'div' => false, 'label' => false, 'class' => 'form-control', 'required' => 'required')); ?>
                                    <?php echo $this->Form->control('eventcat_id', array('type' => 'hidden', 'value' => $eventcategory->id, 'name' => 'data[eventcat_id][]', 'div' => false, 'label' => false, 'class' => 'form-control')); ?>
                                </td>   
                                <td data-title="Status">   
                                    <?php
                                    if ($eventcategory->status == 1) {
                                        echo "Active";
                                    } else {
                                        echo "Inactive";
                                    }
                                    ?>
                                </td>

                                <td data-title="Added By"><?= $eventcategory->has('user') ? $this->Html->link($eventcategory->user->user_name, ['controller' => 'Users', 'action' => 'view-profile', $eventcategory->user->id]) : '' ?></td>
                                <td data-title="Modified"><?php echo date('n/j/y', strtotime($eventcategory->modified)); ?></td>
                                <td data-title="Sub Services">
                                    <a class="btn btn-default" href="<?php echo $this->request->webroot . 'Eventsubcategories/index/' . $eventcategory->id; ?>">
                                        <span class="badge">    
                                            <?php
                                            if ($eventcategory->eventsubcategories):
                                                echo $eventcategory->eventsubcategories[0]->total;
                                            else:
                                                echo 0;
                                            endif;
                                            ?>
                                        </span>
                                        Sub Services
                                    </a>
                                </td>
                                <td data-title="actions" class="actions">


                                    <?php
                                    if ($permission == 2) {
                                        ?>

                                        <?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'eventcategories', 'action' => 'edit', $eventcategory->id), array('class' => 'btn btn-success', 'escape' => false)); ?>

                                        <?= $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'eventcategories', 'action' => 'delete', $eventcategory->id], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $eventcategory->id)]); ?>

                                    <?php } ?>
                                </td>


                            </tr>


                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: center;">
                                <button class="btn btn-blue-custom btn-md col-xs-offset-6 col-md-offset-6" style="border:none !important; margin-left:unset !important" id="orderupdate_btn" >Update Order</button>

                            </td>
                            <td></td>
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
