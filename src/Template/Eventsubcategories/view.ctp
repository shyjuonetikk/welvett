<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Eventsubcategory $eventsubcategory
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Eventsubcategory'), ['action' => 'edit', $eventsubcategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Eventsubcategory'), ['action' => 'delete', $eventsubcategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventsubcategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Eventsubcategories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Eventsubcategory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['controller' => 'Eventcategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['controller' => 'Eventcategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventsubcategories view large-9 medium-8 columns content">
    <h3><?= h($eventsubcategory->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Eventcategory') ?></th>
            <td><?= $eventsubcategory->has('eventcategory') ? $this->Html->link($eventsubcategory->eventcategory->title, ['controller' => 'Eventcategories', 'action' => 'view', $eventsubcategory->eventcategory->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $eventsubcategory->has('user') ? $this->Html->link($eventsubcategory->user->id, ['controller' => 'Users', 'action' => 'view', $eventsubcategory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($eventsubcategory->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($eventsubcategory->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eventsubcategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordinal') ?></th>
            <td><?= $this->Number->format($eventsubcategory->ordinal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($eventsubcategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($eventsubcategory->modified) ?></td>
        </tr>
    </table>
</div>
