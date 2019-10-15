<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Talent Events'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['controller' => 'Eventcategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['controller' => 'Eventcategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customer Reviews'), ['controller' => 'CustomerReviews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer Review'), ['controller' => 'CustomerReviews', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Talent Calendars'), ['controller' => 'TalentCalendars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent Calendar'), ['controller' => 'TalentCalendars', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Talent Event Cities'), ['controller' => 'TalentEventCities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent Event City'), ['controller' => 'TalentEventCities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Talent Messages'), ['controller' => 'TalentMessages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent Message'), ['controller' => 'TalentMessages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Talent Reviews'), ['controller' => 'TalentReviews', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent Review'), ['controller' => 'TalentReviews', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentEvents form large-9 medium-8 columns content">
    <?= $this->Form->create($talentEvent) ?>
    <fieldset>
        <legend><?= __('Add Talent Event') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('eventcategory_id', ['options' => $eventcategories, 'empty' => true]);
            echo $this->Form->control('payment_type');
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
