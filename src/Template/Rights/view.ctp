<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Right $right
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Right'), ['action' => 'edit', $right->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Right'), ['action' => 'delete', $right->id], ['confirm' => __('Are you sure you want to delete # {0}?', $right->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rights'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Right'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Modules'), ['controller' => 'Modules', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Module'), ['controller' => 'Modules', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rights view large-9 medium-8 columns content">
    <h3><?= h($right->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $right->has('role') ? $this->Html->link($right->role->name, ['controller' => 'Roles', 'action' => 'view', $right->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Module') ?></th>
            <td><?= $right->has('module') ? $this->Html->link($right->module->name, ['controller' => 'Modules', 'action' => 'view', $right->module->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $right->has('user') ? $this->Html->link($right->user->id, ['controller' => 'Users', 'action' => 'view', $right->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($right->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($right->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($right->modified) ?></td>
        </tr>
    </table>
</div>
