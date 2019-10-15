<style>
    #paymentDiv table td{
        text-align: left !important;
    }
</style>
<table class="table table-bordered">
    <tr>
        <th>Payment Status</th>
        <td><?php
            if ($payment->status == 0) {
                echo 'On hold';
            }
            if ($payment->status == 1) {
                echo 'Released';
            }
            ?>
        </td>
    </tr>
    <?php if ($user) { ?>
        <tr>
            <th>Released by</th>
            <td>
                <?php
                $user_role = ($user->role_id == 1) ? 'Admin' : 'Customer';
                echo ucwords($user->first_name . ' ' . $user->last_name) . ' (' . $user_role . ')';
                ?>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <th>Total Amount</th>
        <td><?php
            echo $payment->total_amount;
            ?>
        </td>

    </tr>
    <tr>
        <th>Deducted Amount</th>
        <td>
            <?php
            echo ($payment->deducted_amount) ? $payment->deducted_amount : 'Payment not realeased yet';
            ?>
        </td>
    </tr>
    <tr>
        <th>Released Amount</th>
        <td>
            <?php
            echo ($payment->released_amount) ? $payment->released_amount : 'Payment not realeased yet';
            ?>
        </td>
    </tr>
    <tr>
        <th>Dispute</th>
        <td>
            <?php
            if ($payment->customer_issues || $payment->talent_issues) {
                echo 'Yes';
            } else {
                echo 'No';
            }
            ?>
        </td>
    </tr>
    <?php if ($payment->dispute_resolved) { ?>
        <tr>
            <th>
                Dispute Status
            </th>
            <td style="color:green;">
                Resolved
            </td>
        </tr>

        <tr>
            <th>
                Dispute decision  
            </th>
            <td>
                <?php if ($payment->status == 2) { ?>
                    Amount Refunded to customer
                <?php } else { ?>
                    Amount Released to Talent
                <?php } ?>
            </td>
        </tr>


    <?php } ?>
    <?php if ($payment->talent_issues) { ?>
        <tr>
            <th>Talent Dispute</th>
            <td>
                <?php
                echo $payment->talent_issues;
                ?>
            </td>
        </tr>
    <?php } ?>
    <?php if ($payment->customer_issues) { ?>
        <tr>
            <th>Customer Dispute</th>
            <td>
                <?php
                echo $payment->customer_issues;
                ?>
            </td>
        </tr>
    <?php } ?>

</table>
<?php
if ($payment->customer_issues || $payment->talent_issues) {
    if (!$payment->dispute_resolved) {
        ?>
        <form action="<?php echo $this->request->webroot; ?>TalentEvents/paymentApprove" method="post" accept-charset="utf-8">
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <input name="payment" type="hidden" value="<?php echo $payment->id; ?>">
                    <label for="admin-decision">Why are you taking this decision?</label>
                    <textarea name="admin_decision" class="form-control" id="admin-decision" rows="5" required></textarea>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-md-1"></div>
                <div class="col-sm-5">
                    <label for="status-role_back">
                        <input name="status" id="status-role_back" type="radio" value="role_back" required> Refund to customer
                    </label>
                </div>
                <div class="col-sm-5">
                    <label for="status-approve">
                        <input name="status" id="status-approve" type="radio" value="approve" required> Release To Talent
                    </label>
                </div>


                <div class="col-md-1"></div>
            </div>
            <div class="row" style="margin-bottom:10pxZZ">
                <div class="col-md-1"></div>

                <div class="col-sm-10" style="text-align:right;">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
                <div class="col-md-1"></div>
            </div>


        </form>

        <?php
    }
}
?>
</div>
