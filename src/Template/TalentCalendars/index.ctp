<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentCalendar[]|\Cake\Collection\CollectionInterface $talentCalendars
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Talent Calendar'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentCalendars index large-9 medium-8 columns content">
    <h3><?= __('Talent Calendars') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('booking_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_booked') ?></th>
                <th scope="col"><?= $this->Paginator->sort('talent_event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($talentCalendars as $talentCalendar): ?>
            <tr>
                <td><?= $this->Number->format($talentCalendar->id) ?></td>
                <td><?= $talentCalendar->has('user') ? $this->Html->link($talentCalendar->user->id, ['controller' => 'Users', 'action' => 'view', $talentCalendar->user->id]) : '' ?></td>
                <td><?= $talentCalendar->has('booking') ? $this->Html->link($talentCalendar->booking->id, ['controller' => 'Bookings', 'action' => 'view', $talentCalendar->booking->id]) : '' ?></td>
                <td><?= h($talentCalendar->date) ?></td>
                <td><?= $this->Number->format($talentCalendar->is_booked) ?></td>
                <td><?= $talentCalendar->has('talent_event') ? $this->Html->link($talentCalendar->talent_event->id, ['controller' => 'TalentEvents', 'action' => 'view', $talentCalendar->talent_event->id]) : '' ?></td>
                <td><?= h($talentCalendar->created) ?></td>
                <td><?= h($talentCalendar->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $talentCalendar->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $talentCalendar->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $talentCalendar->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentCalendar->id)]) ?>
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
