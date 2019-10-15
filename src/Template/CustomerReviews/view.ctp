<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CustomerReview $customerReview
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customer Review'), ['action' => 'edit', $customerReview->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer Review'), ['action' => 'delete', $customerReview->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerReview->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customer Reviews'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer Review'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customerReviews view large-9 medium-8 columns content">
    <h3><?= h($customerReview->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Talent Event') ?></th>
            <td><?= $customerReview->has('talent_event') ? $this->Html->link($customerReview->talent_event->id, ['controller' => 'TalentEvents', 'action' => 'view', $customerReview->talent_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($customerReview->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Id') ?></th>
            <td><?= $this->Number->format($customerReview->customer_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Review') ?></th>
            <td><?= $this->Number->format($customerReview->review) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Talent Id') ?></th>
            <td><?= $this->Number->format($customerReview->talent_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= $this->Number->format($customerReview->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= $this->Number->format($customerReview->modified) ?></td>
        </tr>
    </table>
</div>
