<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Customer Reviews'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customerReviews form large-9 medium-8 columns content">
    <?= $this->Form->create($customerReview) ?>
    <fieldset>
        <legend><?= __('Add Customer Review') ?></legend>
        <?php
            echo $this->Form->control('customer_id');
            echo $this->Form->control('review');
            echo $this->Form->control('talent_event_id', ['options' => $talentEvents, 'empty' => true]);
            echo $this->Form->control('talent_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
