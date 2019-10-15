<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentEventSubcategory $talentEventSubcategory
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Talent Event Subcategory'), ['action' => 'edit', $talentEventSubcategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Talent Event Subcategory'), ['action' => 'delete', $talentEventSubcategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentEventSubcategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Talent Event Subcategories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event Subcategory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['controller' => 'Eventcategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['controller' => 'Eventcategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Eventsubcategories'), ['controller' => 'Eventsubcategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Eventsubcategory'), ['controller' => 'Eventsubcategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="talentEventSubcategories view large-9 medium-8 columns content">
    <h3><?= h($talentEventSubcategory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $talentEventSubcategory->has('user') ? $this->Html->link($talentEventSubcategory->user->id, ['controller' => 'Users', 'action' => 'view', $talentEventSubcategory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eventcategory') ?></th>
            <td><?= $talentEventSubcategory->has('eventcategory') ? $this->Html->link($talentEventSubcategory->eventcategory->title, ['controller' => 'Eventcategories', 'action' => 'view', $talentEventSubcategory->eventcategory->]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eventsubcategory') ?></th>
            <td><?= $talentEventSubcategory->has('eventsubcategory') ? $this->Html->link($talentEventSubcategory->eventsubcategory->title, ['controller' => 'Eventsubcategories', 'action' => 'view', $talentEventSubcategory->eventsubcategory->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($talentEventSubcategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($talentEventSubcategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($talentEventSubcategory->modified) ?></td>
        </tr>
    </table>
</div>
