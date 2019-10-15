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
    .disputeClass{
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
    .pendingDisputes span{
        font-size: 12px;
    }
    #paymentDiv table td {
        white-space: unset !important;
        padding: 15px 5px;
    }
</style>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-condensed cf">
                <thead>
                    <tr>
                        <th scope="col">Talents</th>
                        <th scope="col">Customers</th>
                        <th scope="col">Status</th>
                        <!--<th scope="col">Completed</th>-->
                        <th scope="col">Discussion</th>
                        <th scope="col" style="width:100px;">Payment Details</th>
                        <!--<th scope="col" style="color:black !important">Action</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($talentEvents as $key => $talentEvent):
                        $tr_class = '';
                        if ($talentEvent->payment->customer_issues || $talentEvent->payment->talent_issues) {
                            if (!$talentEvent->payment->dispute_resolved) {
                                $tr_class = 'disputeClass';
                            }
                        }
                        ?>
                        <tr class="<?= $tr_class ?>">
                            <td data-title="Talent"><?= ucwords($talentEvent->talent->first_name . ' ' . $talentEvent->talent->last_name); ?></td>
                            <td data-title="Customer"><?= ucwords($talentEvent->customer->first_name . ' ' . $talentEvent->talent->first_name); ?></td>
                            <td data-title="Status">
                                <?php
                                if ($talentEvent->status == 0) {
                                    echo 'Waiting for Acceptance';
                                }
                                if ($talentEvent->status == 1) {
                                    echo 'Declined';
                                }
                                if ($talentEvent->status == 2) {
                                    echo 'Accepted';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
//                                debug($talentEvent);
                                if (!empty($talentEvent->talent_messages)) {
                                    ?>
                                    <a onclick="messages(<?= $talentEvent->id ?>)" class="btn btn-info"><?php echo $talentEvent->talent_messages[0]->total; ?> Messages</a>
                                <?php } else { ?>
                                    <a class="btn btn-info" disabled>0 Messages</a>
                                <?php } ?>
                            </td>
                            <?php
                            $pendingDisputes = '';
                            if ($talentEvent->payment->customer_issues || $talentEvent->payment->talent_issues) {
                                if (!$talentEvent->payment->dispute_resolved) {
                                    $pendingDisputes = 'pendingDisputes';
                                }
                            }
                            ?>
                            <td data-title="Payment Details" class="<?= $pendingDisputes; ?>">
                                <?php if ($talentEvent->payment): ?>
                                    <a onclick="fetchPayments(<?= $talentEvent->payment->id; ?>)" class="btn btn-info">Payment details</a>
                                <?php else: ?>
                                    <a class="btn btn-info" disabled>No Payments</a>

                                <?php endif; ?>
                            </td>
    <!--                            <td data-title="Action">
                            <?php
//                                if ($permission == 2) {
//                                    echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('controller' => 'TalentEvents', 'action' => 'eventedit', $talentEvent->id, $this->request->params['pass'][0]), array('class' => 'btn btn-success', 'escape' => false));
                            ?>
                            <?php // echo $this->Html->link(__('<i class="fa fa-trash"></i> '), ['controller' => 'TalentEvents', 'action' => 'delete_event', $talentEvent->id, $this->request->params['pass'][0]], ['escape' => false, 'class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $talentEvent->id)]);
                            ?>
                            <?php // } ?>

                            </td>-->
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
    <div class="modal fade" id="paymentDetails" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #7B1B2D;color: white;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
                    <h4 class="modal-title">Payment Details</h4>
                </div>
                <div id="paymentDiv"></div>
                <div class="modal-footer" style="text-align:right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function fetchPayments(payment_id) {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'TalentEvents/getPayments' ?>',
            data: 'payment_id=' + payment_id,
            contentType: 'json',
            success: function (data)
            {
                $('#paymentDiv').html(data);
                $('#paymentDetails').modal('show');
            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }

</script>


