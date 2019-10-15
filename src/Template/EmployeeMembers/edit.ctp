<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employeeMember->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $employeeMember->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Employee Members'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['controller' => 'Eventcategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['controller' => 'Eventcategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employeeMembers form large-9 medium-8 columns content">
    <?= $this->Form->create($employeeMember) ?>
    <fieldset>
        <legend><?= __('Edit Employee Member') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('eventcategory_id', ['options' => $eventcategories, 'empty' => true]);
            echo $this->Form->control('address');
            echo $this->Form->control('state');
            echo $this->Form->control('city');
            echo $this->Form->control('social_media_link');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
