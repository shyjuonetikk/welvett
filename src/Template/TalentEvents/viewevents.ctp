<style>
    .table-bordered > thead > tr > th, .table-bordered > thead > tr > td {
        color: black !important;
    }
    div.submit{
        display:inline !important;
    }
    .subtable{
        border:1px solid #ccc !important;
    }
    tr td:last-child {
        text-align: center;
    }
    .message{
        padding: 10px;
        margin: 10px;
        border: 1px solid #7B1B2D;
        border-radius: 5px;
    }
    .message_right{
        padding: 10px;
        margin: 10px;
        border: 1px solid #7B1B2D;
        border-radius: 5px;

    }
    .role_style{
        color: gray;
    }
    td{
        vertical-align: top !important;
    }
</style>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th style="color:black !important;">S.No</th>
                        <th scope="col"><?= $this->Paginator->sort('eventcategory_id', 'Service Category') ?></th>
                        <th scope="col">Service Sub-Categories</th>
                        <th scope="col"><?= $this->Paginator->sort('payment_type') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                        <th scope="col">Bookings</th>
                        <th scope="col">Service Cities Detail</th>
                        <th scope="col" style="color:black !important">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($talentEvents as $key => $talentEvent): ?>
                        <tr>
                            <td data-title="S.No"><?= $key + 1; ?></td>
                            <td data-title="Event Category"><?= h(ucwords($talentEvent->eventcategory->title)); ?></td>
                            <td>
                                <?php
                                foreach ($talentEvent->talent_event_subcategories as $cat):
                                    ?>
                                    <a onclick="fetch_category(<?= $cat->id ?>)" href="#"><span class="badge"><?php echo $cat->eventsubcategory->title ?></span></a><br/>
                                <?php endforeach; ?>
                            </td>
                            <td data-title="Payment Type"><?= h(ucwords($talentEvent->payment_type)); ?></td>
                            <td data-title="Amount"><?= h(ucwords($talentEvent->amount)); ?></td>
                            <td>
                                <?php if (!empty($talentEvent->bookings)) { ?>
                                    <a href="<?php echo $this->request->webroot . 'TalentEvents/viewbookings/' . $talentEvent->id.'/' . $this->request->params['pass'][0] ?>" class="btn btn-info"><?php echo $talentEvent->bookings[0]->total; ?> Bookings</a>
                                <?php } else { ?>
                                    <a class="btn btn-info" disabled>0 Bookings</a>
                                <?php } ?>
                            </td>
                            <td data-title="Talent Cities Detail">
                                <table class="table-bordered table-striped table-condensed cf">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="subtable">City</th>
                                            <th scope="col" class="subtable">Acc $</th>
                                            <th scope="col" class="subtable" style="color:black !important">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($talentEvent->talent_event_cities as $city): ?>
                                            <tr>
                                                <td class="subtable" id="city_<?= $city->id ?>" data-title="City"><?= $city->city ?></td>
                                                <td class="subtable" id="accommodation_<?= $city->id ?>" data-title="Accommodation"><?= $city->accommodation_price ?></td>
                                                <td class="subtable" data-title="Action">
                                                    <?php
                                                    if ($permission == 2) {
                                                        ?>
                                                        <a id="edit_<?php echo $city->id ?>" onclick="edit_city(<?= $city->id ?>)" href="#" class = 'btn btn-success btn-xs'><i class="fa fa-edit"></i></a>
                                                        <?php echo $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'users', 'action' => 'delete', $talentEvent->id], ['escape' => false, 'class' => 'btn btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # {0}?', $talentEvent->id)]);
                                                        ?>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </td>
                            <td data-title="Action">
                                <?php
                                if ($permission == 2) {
                                    echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'TalentEvents', 'action' => 'eventedit', $talentEvent->id, $this->request->params['pass'][0]), array('class' => 'btn btn-success', 'escape' => false));
                                    ?>
                                    <?php echo $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'TalentEvents', 'action' => 'delete_event', $talentEvent->id, $this->request->params['pass'][0]], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $talentEvent->id)]);
                                    ?>
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
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #7B1B2D;color: white;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                    <h4 class="modal-title">Edit City Detail</h4>
                </div>
                <?php echo $this->Form->create('city_edit_form', array('id' => 'edit_city_form')); ?>

                <div class="modal-body">
                    <div class="row">
                        <label for="city" class="col-md-4 control-label">City</label>
                        <div class="col-md-8">
                            <?php echo $this->Form->hidden('id', array('id' => 'city_id', 'div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => '', 'required')); ?>
                            <?php echo $this->Form->control('city', array('id' => 'city', 'div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => '', 'required')); ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="accommodation_price" class="col-md-4 control-label">Accommodation Price</label>	
                        <div class="col-md-8">
                            <?php echo $this->Form->control('accommodation_price', array('id' => 'accommodation_price', 'div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => '', 'required')); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align:right">
                    <?php
                    echo $this->Form->control('Update', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-default', 'id' => 'register'));
                    ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #7B1B2D;color: white;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                    <h4 class="modal-title">Category Detail</h4>
                </div>
                <div id="empty_modal"></div>
                <div class="modal-footer" style="text-align:right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>


