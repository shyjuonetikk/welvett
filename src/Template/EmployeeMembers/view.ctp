<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\EmployeeMember $employeeMember
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee Member'), ['action' => 'edit', $employeeMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee Member'), ['action' => 'delete', $employeeMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employee Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['controller' => 'Eventcategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['controller' => 'Eventcategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employeeMembers view large-9 medium-8 columns content">
    <h3><?= h($employeeMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $employeeMember->has('user') ? $this->Html->link($employeeMember->user->id, ['controller' => 'Users', 'action' => 'view', $employeeMember->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eventcategory') ?></th>
            <td><?= $employeeMember->has('eventcategory') ? $this->Html->link($employeeMember->eventcategory->title, ['controller' => 'Eventcategories', 'action' => 'view', $employeeMember->eventcategory->]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($employeeMember->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($employeeMember->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($employeeMember->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employeeMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($employeeMember->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($employeeMember->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Social Media Link') ?></h4>
        <?= $this->Text->autoParagraph(h($employeeMember->social_media_link)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($employeeMember->description)); ?>
    </div>
</div>
