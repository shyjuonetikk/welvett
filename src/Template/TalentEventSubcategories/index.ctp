<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentEventSubcategory[]|\Cake\Collection\CollectionInterface $talentEventSubcategories
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Talent Event Subcategory'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['controller' => 'Eventcategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['controller' => 'Eventcategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Eventsubcategories'), ['controller' => 'Eventsubcategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Eventsubcategory'), ['controller' => 'Eventsubcategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentEventSubcategories index large-9 medium-8 columns content">
    <h3><?= __('Talent Event Subcategories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eventcategory_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eventsubcategory_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($talentEventSubcategories as $talentEventSubcategory): ?>
            <tr>
                <td><?= $this->Number->format($talentEventSubcategory->id) ?></td>
                <td><?= $talentEventSubcategory->has('user') ? $this->Html->link($talentEventSubcategory->user->id, ['controller' => 'Users', 'action' => 'view', $talentEventSubcategory->user->id]) : '' ?></td>
                <td><?= $talentEventSubcategory->has('eventcategory') ? $this->Html->link($talentEventSubcategory->eventcategory->title, ['controller' => 'Eventcategories', 'action' => 'view', $talentEventSubcategory->eventcategory->]) : '' ?></td>
                <td><?= $talentEventSubcategory->has('eventsubcategory') ? $this->Html->link($talentEventSubcategory->eventsubcategory->title, ['controller' => 'Eventsubcategories', 'action' => 'view', $talentEventSubcategory->eventsubcategory->id]) : '' ?></td>
                <td><?= h($talentEventSubcategory->created) ?></td>
                <td><?= h($talentEventSubcategory->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $talentEventSubcategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $talentEventSubcategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $talentEventSubcategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentEventSubcategory->id)]) ?>
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
