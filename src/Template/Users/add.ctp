<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Booking Cancellations'), ['controller' => 'BookingCancellations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Booking Cancellation'), ['controller' => 'BookingCancellations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bus Seat Assigns'), ['controller' => 'BusSeatAssigns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bus Seat Assign'), ['controller' => 'BusSeatAssigns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Buses'), ['controller' => 'Buses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Bus'), ['controller' => 'Buses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Busstatus'), ['controller' => 'Busstatus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Busstatus'), ['controller' => 'Busstatus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Routes'), ['controller' => 'Routes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Route'), ['controller' => 'Routes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Seats'), ['controller' => 'Seats', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Seat'), ['controller' => 'Seats', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sightseeing Payments'), ['controller' => 'SightseeingPayments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sightseeing Payment'), ['controller' => 'SightseeingPayments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sightseeings'), ['controller' => 'Sightseeings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sightseeing'), ['controller' => 'Sightseeings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Terminals'), ['controller' => 'Terminals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Terminal'), ['controller' => 'Terminals', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tour Payments'), ['controller' => 'TourPayments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tour Payment'), ['controller' => 'TourPayments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tours'), ['controller' => 'Tours', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tour'), ['controller' => 'Tours', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('role_id', ['options' => $roles]);
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('phone1');
            echo $this->Form->control('address1');
            echo $this->Form->control('address2');
            echo $this->Form->control('city');
            echo $this->Form->control('state');
            echo $this->Form->control('zip');
            echo $this->Form->control('profile_image');
            echo $this->Form->control('phone2');
            echo $this->Form->control('gender');
            echo $this->Form->control('user_name');
            echo $this->Form->control('password');
            echo $this->Form->control('email');
            echo $this->Form->control('status');
            echo $this->Form->control('password_reset_token');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
