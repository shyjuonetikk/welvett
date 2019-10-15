<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentCalendar $talentCalendar
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Talent Calendar'), ['action' => 'edit', $talentCalendar->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Talent Calendar'), ['action' => 'delete', $talentCalendar->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentCalendar->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Talent Calendars'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Calendar'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="talentCalendars view large-9 medium-8 columns content">
    <h3><?= h($talentCalendar->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $talentCalendar->has('user') ? $this->Html->link($talentCalendar->user->id, ['controller' => 'Users', 'action' => 'view', $talentCalendar->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Booking') ?></th>
            <td><?= $talentCalendar->has('booking') ? $this->Html->link($talentCalendar->booking->id, ['controller' => 'Bookings', 'action' => 'view', $talentCalendar->booking->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Talent Event') ?></th>
            <td><?= $talentCalendar->has('talent_event') ? $this->Html->link($talentCalendar->talent_event->id, ['controller' => 'TalentEvents', 'action' => 'view', $talentCalendar->talent_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($talentCalendar->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Booked') ?></th>
            <td><?= $this->Number->format($talentCalendar->is_booked) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($talentCalendar->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($talentCalendar->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($talentCalendar->modified) ?></td>
        </tr>
    </table>
</div>
