<div id="edit_eventSubCat" class="row">
    <?php
    foreach ($categories as $k => $category):
        ?>
        <div class="col-sm-6 col-lg-4">
            <?php echo $this->Form->control('TalentEventSubcategories.eventsubcategory_id[]', ['id' => false, 'type' => 'checkbox', 'value' => $k, 'label' => $category, 'hiddenField' => false]); ?>
        </div>
    <?php endforeach; ?>
</div>
<hr>
<div class="row">
    <label for="booking_requirement" class="col-md-12 control-label">Booking Requirements</label>
    <div class="col-md-12" id="booking_requirement_div">

        <?php
        if (isset($t_event->booking_requirement)) {
            $reqVal = $t_event->booking_requirement;
        } else {
            $reqVal = '';
        }
        echo $this->Form->control('booking_requirement', array('id' => 'booking_requirement', 'div' => false, 'type' => 'textarea', 'label' => false, 'class' => '', 'value' => $reqVal));
        ?>
    </div>
</div>