<!--
<div class="panel-head-info">
    <a href="<?php //echo $this->request->webroot ?>users/individuals" style="font-size:14px;" class="btn btn-primary btn-blue-custom pull-right text-info"><i class="fa fa-angle-left"></i> Go Back</a>
    <div class="clearfix"></div>
</div>-->
<div class="container content-container">
    <div class="users form">
        <?php echo $this->Form->create($talentEvent, array('type' => 'file', 'class' => 'form-horizontal', 'id' => 'UserAddForm', 'enctype' => 'multipart/form-data')); ?>
        <fieldset>
            <div class="form-group required">
                <label for="user_id" class="col-md-2 control-label">User</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('username', array('div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => $talentEvent->user->first_name . ' ' . $talentEvent->user->last_name, 'required', 'disabled')); ?>
                </div>
            </div> 
            <div class="form-group required">
                <label for="user_id" class="col-md-2 control-label">Payment Type</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('TalentEvent.payment_type', array('div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'options' => array('hourly' => 'Hourly', 'whole event' => 'Whole Event'), 'value' => $talentEvent->payment_type, 'required')); ?>
                </div>
                <label for="amount" class="col-md-2 control-label">Amount</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input name="TalentEvent[amount]" class="form-control text-capitalize" required="required" maxlength="10" id="talentevent-amount" value="<?= $talentEvent->amount ?>" type="text">
                        <span class="input-group-addon">USD</span>

                    </div>
                    <?php // echo $this->Form->control('TalentEvent.amount', array('div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'value' => $talentEvent->amount, 'required')); ?>
                </div>

            </div> 
            <hr>
            <div class="form-group required" id="category_div">
                <label for="eventcategory_id" class="col-md-2 control-label">Category</label>
                <div class="col-md-4">
                    <?php echo $this->Form->control('TalentEvent.eventcategory_id', array('id' => 'category', 'onchange' => 'get_subcats()', 'div' => false, 'label' => false, 'class' => 'form-control text-capitalize', 'options' => $eventcategories, 'value' => $talentEvent->eventcategory_id, 'required')); ?>
                </div>
            </div> 
            <div id="eventSubCat" class="form-group">
                <?php
                foreach ($eventsubcategories as $k => $category):
                    $checked = '';
                    if (in_array($k, $talenteventsubcategories)) {
                        $checked = 'checked';
                    }
                    ?>
                    <div class="col-sm-3">
                        <?php echo $this->Form->control('TalentEventSubcategories.eventsubcategory_id[]', ['id' => false, 'hiddenField' => false, 'type' => 'checkbox', 'value' => $k, 'label' => $category, $checked]); ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </fieldset>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <?php
                echo $this->Form->control('Update', array('type' => 'submit', 'div' => false, 'label' => false, 'class' => 'btn btn-default btn-blue-custom btn-lg', 'id' => 'register'));
                echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    function get_subcats() {
        $.ajax({
            type: 'GET',
            url: '<?php echo $this->request->webroot . 'TalentEvents/get_subcategories'; ?>',
            data: 'cat_id=' + $('#category').val(),
            contentType: 'json',
            success: function (data)
            {
                $('#eventSubCat').html(data);

            }, error: function (error) {
                // alert(JSON.stringify(error));
            }
        });
    }
</script>

