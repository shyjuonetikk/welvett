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
    .dt-button{
        font-size: 12px;
    }
</style>
<div class="container content-container">
    <h4>Filters</h4>
    <div class="row">
        <?php echo $this->Form->create('', ['method' => 'get']); ?>

        <div class="col-md-4">
            <?php
            $val = '';
            if (isset($_GET['status'])) {
                $val = $_GET['status'];
            }
            echo $this->Form->control('status', ['options' => array('all_disputes' => 'All Disputes', 'pending_disputes' => 'Pending Disputes'), 'empty' => 'Bookings Satus', 'label' => false, 'value' => $val, 'class' => 'form-control']);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            $val = '';
            if (isset($_GET['categories'])) {
                $val = $_GET['categories'];
            }
            echo $this->Form->control('categories', ['options' => $cats, 'empty' => 'Select category', 'label' => false, 'value' => $val, 'class' => 'form-control']);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            $val = '';
            if (isset($_GET['name'])) {
                $val = $_GET['name'];
            }
            echo $this->Form->control('name', ['label' => false, 'placeholder' => 'Search by name', 'value' => $val, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <?php
            $val = '';
            if (isset($_GET['from_time'])) {
                $val = $_GET['from_time'];
            }
            echo $this->Form->control('from_time', ['label' => false, 'placeholder' => 'From Time', 'value' => $val, 'class' => 'form-control datepicker']);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            $val = '';
            if (isset($_GET['to_time'])) {
                $val = $_GET['to_time'];
            }
            echo $this->Form->control('to_time', ['label' => false, 'placeholder' => 'To Time', 'value' => $val, 'class' => 'form-control datepicker']);
            ?>
        </div>
        <div class="col-md-4">
            <?php
            $val = '';
            if (isset($_GET['event_type'])) {
                $val = $_GET['event_type'];
            }
            echo $this->Form->control('event_type', ['options' => array('1' => 'Hourly', '2' => 'Whole'), 'empty' => 'Select Event type', 'label' => false, 'value' => $val, 'class' => 'form-control']);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo $this->Form->submit('Search', ['name' => 'search', 'class' => 'btn btn-primary', 'style' => 'margin-top:25px;']); ?>
            <br/>
            <br/>
        </div>

        <?php echo $this->Form->end(); ?>
        <div class="" id="no-more-tables">
            <table class="table-bordered table-condensed cf dataTable js-exportable">
                <thead>
                    <tr>
                        <th scope="col">Talents</th>
                        <th scope="col">Clients</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Released By</th>
                        <th scope="col">Deducted amount</th>
                        <th scope="col">Released amount</th>
                        <th scope="col">Status</th>
                        <!--<th scope="col">Completed</th>-->
                        <!--<th scope="col" style="width:100px;" class="noExport">Payment Details</th>-->
                        <!--<th scope="col" style="color:black !important">Action</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($talentEvents as $key => $talentEvent):
                        ?>
                        <tr>
                            <td data-title="Talent"><?= ucwords($talentEvent['talent_name']); ?></td>
                            <td data-title="Customer"><?= ucwords($talentEvent['customer_name']); ?></td>
                            <td data-title="Amount">$<?= $talentEvent['total_amount']; ?></td>
                            <td data-title="Released By"><?= ($talentEvent['released_by']) ? $users_list[$talentEvent['released_by']] : '<span style="color:red">Not released</span>'; ?></td>
                            <td data-title="Deducted amount">$ <?= ($talentEvent['deducted_amount']) ? $talentEvent['deducted_amount'] : '0'; ?></td>
                            <td data-title="Released amount">$ <?= ($talentEvent['released_amount']) ? $talentEvent['released_amount'] : '0'; ?></td>

                            <td data-title="Status">
                                <?php
                                if ($talentEvent['status'] == 0) {
                                    echo 'Waiting for Acceptance';
                                }
                                if ($talentEvent['status'] == 1) {
                                    echo 'Declined';
                                }
                                if ($talentEvent['status'] == 2) {
                                    echo 'Accepted';
                                }
                                ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

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


