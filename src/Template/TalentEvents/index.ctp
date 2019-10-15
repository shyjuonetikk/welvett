<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentEvent[]|\Cake\Collection\CollectionInterface $talentEvents
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Talent Event'), ['action' => 'add']) ?></li>
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
<div class="talentEvents index large-9 medium-8 columns content">
    <h3><?= __('Talent Events') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eventcategory_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($talentEvents as $talentEvent): ?>
            <tr>
                <td><?= $this->Number->format($talentEvent->id) ?></td>
                <td><?= $talentEvent->has('user') ? $this->Html->link($talentEvent->user->id, ['controller' => 'Users', 'action' => 'view', $talentEvent->user->id]) : '' ?></td>
                <td><?= $talentEvent->has('eventcategory') ? $this->Html->link($talentEvent->eventcategory->title, ['controller' => 'Eventcategories', 'action' => 'view', $talentEvent->eventcategory->]) : '' ?></td>
                <td><?= h($talentEvent->payment_type) ?></td>
                <td><?= h($talentEvent->amount) ?></td>
                <td><?= h($talentEvent->created) ?></td>
                <td><?= h($talentEvent->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $talentEvent->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $talentEvent->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $talentEvent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentEvent->id)]) ?>
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
