<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Talent Event Subcategories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['controller' => 'Eventcategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['controller' => 'Eventcategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Eventsubcategories'), ['controller' => 'Eventsubcategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Eventsubcategory'), ['controller' => 'Eventsubcategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentEventSubcategories form large-9 medium-8 columns content">
    <?= $this->Form->create($talentEventSubcategory) ?>
    <fieldset>
        <legend><?= __('Add Talent Event Subcategory') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('eventcategory_id', ['options' => $eventcategories, 'empty' => true]);
            echo $this->Form->control('eventsubcategory_id', ['options' => $eventsubcategories, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
