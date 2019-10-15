<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentMessage[]|\Cake\Collection\CollectionInterface $talentMessages
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Talent Message'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentMessages index large-9 medium-8 columns content">
    <h3><?= __('Talent Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('talent_event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($talentMessages as $talentMessage): ?>
            <tr>
                <td><?= $this->Number->format($talentMessage->id) ?></td>
                <td><?= $talentMessage->has('user') ? $this->Html->link($talentMessage->user->id, ['controller' => 'Users', 'action' => 'view', $talentMessage->user->id]) : '' ?></td>
                <td><?= $talentMessage->has('talent_event') ? $this->Html->link($talentMessage->talent_event->id, ['controller' => 'TalentEvents', 'action' => 'view', $talentMessage->talent_event->id]) : '' ?></td>
                <td><?= h($talentMessage->created) ?></td>
                <td><?= h($talentMessage->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $talentMessage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $talentMessage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $talentMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentMessage->id)]) ?>
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
