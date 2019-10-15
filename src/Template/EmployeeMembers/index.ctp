<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\EmployeeMember[]|\Cake\Collection\CollectionInterface $employeeMembers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Employee Member'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['controller' => 'Eventcategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['controller' => 'Eventcategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employeeMembers index large-9 medium-8 columns content">
    <h3><?= __('Employee Members') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('eventcategory_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employeeMembers as $employeeMember): ?>
            <tr>
                <td><?= $this->Number->format($employeeMember->id) ?></td>
                <td><?= $employeeMember->has('user') ? $this->Html->link($employeeMember->user->id, ['controller' => 'Users', 'action' => 'view', $employeeMember->user->id]) : '' ?></td>
                <td><?= $employeeMember->has('eventcategory') ? $this->Html->link($employeeMember->eventcategory->title, ['controller' => 'Eventcategories', 'action' => 'view', $employeeMember->eventcategory->]) : '' ?></td>
                <td><?= h($employeeMember->address) ?></td>
                <td><?= h($employeeMember->state) ?></td>
                <td><?= h($employeeMember->city) ?></td>
                <td><?= h($employeeMember->created) ?></td>
                <td><?= h($employeeMember->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $employeeMember->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employeeMember->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employeeMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeMember->id)]) ?>
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
