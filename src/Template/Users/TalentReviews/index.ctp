<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentReview[]|\Cake\Collection\CollectionInterface $talentReviews
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Talent Review'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentReviews index large-9 medium-8 columns content">
    <h3><?= __('Talent Reviews') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('talent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('talent_event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($talentReviews as $talentReview): ?>
            <tr>
                <td><?= $this->Number->format($talentReview->id) ?></td>
                <td><?= $this->Number->format($talentReview->talent_id) ?></td>
                <td><?= $talentReview->has('talent_event') ? $this->Html->link($talentReview->talent_event->id, ['controller' => 'TalentEvents', 'action' => 'view', $talentReview->talent_event->id]) : '' ?></td>
                <td><?= $this->Number->format($talentReview->customer_id) ?></td>
                <td><?= h($talentReview->created) ?></td>
                <td><?= h($talentReview->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $talentReview->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $talentReview->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $talentReview->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentReview->id)]) ?>
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
