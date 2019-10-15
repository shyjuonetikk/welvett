<div class="row" id="category_div" style="margin-bottom:20px !important;">
    <label for="eventcategory_id" class="col-md-12 control-label">Category</label>
    <div class="col-md-12">
        <?php echo $this->Form->hidden('id', array('value'=>$t_event->id)); ?>
        <?php echo $this->Form->control('TalentEvent.eventcategory_id', array('id' => 'edit_category', 'onchange' => 'get_subcats("edit")', 'div' => false, 'label' => false, 'class' => 'custom_field', 'options' => $categories, 'required','value'=>$t_event->Eventcategories['id'])); ?>
    </div>
</div> 
<div class="edit_eventSubCat">
    <div id="edit_eventSubCat" class="row">
        <?php
        foreach ($sub_cats as $k => $category):
        $checked = '';
        if (in_array($k, $my_cats)) {
            $checked = 'checked';
        }
        ?>
        <div class="col-sm-4">
            <?php echo $this->Form->control('TalentEventSubcategories.eventsubcategory_id[]', ['id' => false, 'type' => 'checkbox', 'value' => $k, 'label' => $category, 'hiddenField' => false, $checked]); ?>
        </div>
        <?php endforeach; ?>

    </div>
    <hr>
    <div class="row">
        <label for="booking_requirement" class="col-md-12 control-label">Booking Requirements</label>
        <div class="col-md-12" id="booking_requirement_div">

            <?php echo $this->Form->control('TalentEvent.booking_requirement', array('id' => 'booking_requirement', 'div' => false, 'type' => 'textarea', 'label' => false, 'class' => '', 'value'=>$t_event->booking_requirement)); ?>
        </div>
    </div>
</div>
