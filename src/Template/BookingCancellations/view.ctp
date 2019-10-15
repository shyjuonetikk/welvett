<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\BookingCancellation $bookingCancellation
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Booking Cancellation'), ['action' => 'edit', $bookingCancellation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Booking Cancellation'), ['action' => 'delete', $bookingCancellation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookingCancellation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Booking Cancellations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking Cancellation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Routes'), ['controller' => 'Routes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Route'), ['controller' => 'Routes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="bookingCancellations view large-9 medium-8 columns content">
    <h3><?= h($bookingCancellation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $bookingCancellation->has('user') ? $this->Html->link($bookingCancellation->user->id, ['controller' => 'Users', 'action' => 'view', $bookingCancellation->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Route') ?></th>
            <td><?= $bookingCancellation->has('route') ? $this->Html->link($bookingCancellation->route->id, ['controller' => 'Routes', 'action' => 'view', $bookingCancellation->route->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($bookingCancellation->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Id') ?></th>
            <td><?= $this->Number->format($bookingCancellation->customer_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Refund') ?></th>
            <td><?= $this->Number->format($bookingCancellation->is_refund) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($bookingCancellation->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($bookingCancellation->modified) ?></td>
        </tr>
    </table>
</div>
