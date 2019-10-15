<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentReview $talentReview
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Talent Review'), ['action' => 'edit', $talentReview->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Talent Review'), ['action' => 'delete', $talentReview->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentReview->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Talent Reviews'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Review'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="talentReviews view large-9 medium-8 columns content">
    <h3><?= h($talentReview->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Talent Event') ?></th>
            <td><?= $talentReview->has('talent_event') ? $this->Html->link($talentReview->talent_event->id, ['controller' => 'TalentEvents', 'action' => 'view', $talentReview->talent_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($talentReview->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Talent Id') ?></th>
            <td><?= $this->Number->format($talentReview->talent_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Id') ?></th>
            <td><?= $this->Number->format($talentReview->customer_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($talentReview->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($talentReview->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Review') ?></h4>
        <?= $this->Text->autoParagraph(h($talentReview->review)); ?>
    </div>
</div>
