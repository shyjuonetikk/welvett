<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Payment $payment
  */
?>
<div class="panel-head-info">
    <p class="pull-left info-text">View Payments</p>
    <a href="<?php echo $this->request->webroot ?>payments/index" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>

</div>
<div class="container content-container">
    <div class="row">
        <div class="" id="no-more-tables">
            <table class="table-bordered table-striped table-condensed cf">
                <thead>
                    <tr>
                        <th style="width: 150px;" scope="row"><?= __('Payment Type') ?></th>
                        <th style="width: 150px;" scope="row"><?= __('Added By') ?></th>
                        <th style="width: 150px;" scope="row"><?= __('Status') ?></th>
                        <th style="width: 150px;" scope="row"><?= __('Modified') ?></th>

                    </tr>
                </thead>
                <tbody>
                    <td data-title="Payment Type"><?= h($payment->payment_type) ?></td>
                    <td data-title="Added By"><?= h($payment->user->user_name) ?></td>
                    <td data-title="Status"><?php if($payment->status == 1) { $status = "Active"; } else { $status = "In Active"; } echo $status; ?>&nbsp;</td>
                    <td data-title="Modified"><?= h($payment->modified) ?></td>
                </tbody>

            </table>

        </div>
    </div>
</div>

