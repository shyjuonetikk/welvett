<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\BookingCancellation[]|\Cake\Collection\CollectionInterface $bookingCancellations
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Booking Cancellation'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Routes'), ['controller' => 'Routes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Route'), ['controller' => 'Routes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="bookingCancellations index large-9 medium-8 columns content">
    <h3><?= __('Booking Cancellations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('route_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_refund') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookingCancellations as $bookingCancellation): ?>
            <tr>
                <td><?= $this->Number->format($bookingCancellation->id) ?></td>
                <td><?= $bookingCancellation->has('user') ? $this->Html->link($bookingCancellation->user->id, ['controller' => 'Users', 'action' => 'view', $bookingCancellation->user->id]) : '' ?></td>
                <td><?= $this->Number->format($bookingCancellation->customer_id) ?></td>
                <td><?= $bookingCancellation->has('route') ? $this->Html->link($bookingCancellation->route->id, ['controller' => 'Routes', 'action' => 'view', $bookingCancellation->route->id]) : '' ?></td>
                <td><?= $this->Number->format($bookingCancellation->is_refund) ?></td>
                <td><?= $this->Number->format($bookingCancellation->amount) ?></td>
                <td><?= h($bookingCancellation->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $bookingCancellation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookingCancellation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookingCancellation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookingCancellation->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
