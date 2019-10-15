<?php
foreach ($sub_cats as $k => $category):
    $checked = '';
    if (in_array($k, $my_cats)) {
        $checked = 'checked';
    }
    ?>
    <div class="col-sm-3">
        <?php echo $this->Form->control('TalentEventSubcategories.eventsubcategory_id[]', ['id' => false, 'type' => 'checkbox', 'value' => $k, 'label' => $category, 'hiddenField' => false, $checked]); ?>
    </div>
<?php endforeach; ?>
