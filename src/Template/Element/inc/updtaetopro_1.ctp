<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="background-color: #F5F5F5 !important;">
            <div class="modal-header" style="display:block !important;padding: 0 10px;border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="booking_form" action="" method="post">
                <div class="modal-body">
                    <div class="row" style="text-align: left !important;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>Payment Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="text-align: left !important;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="custom_label">Amount</label>
                                <p class="custom_field">200 $</p>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="text-align: left !important;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="custom_label" for="card_number">Card Number</label>
                                <input class="custom_field" id="card_number" name="card_number" type="text" placeholder="0000 0000 0000 0000" required>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="text-align: left !important;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="custom_label" for="exp_date">Expiration Date</label>
                                <input class="custom_field datepicker" id="exp_date" name="exp_date" type="text" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="text-align:center">
                                <button id="requestBooking" class="modal_btn" type="submit" style="border:none;">Request for membership</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        var dateToday = new Date();
        $(".datepicker").datepicker({
           minDate: 0
        });
    });
</script>