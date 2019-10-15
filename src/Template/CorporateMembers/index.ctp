<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CorporateMember[]|\Cake\Collection\CollectionInterface $corporateMembers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Corporate Member'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="corporateMembers index large-9 medium-8 columns content">
    <h3><?= __('Corporate Members') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('job_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_authorize') ?></th>
                <th scope="col"><?= $this->Paginator->sort('authorizer_first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('authorizer_last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('authorizer_job_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('authorizer_email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('authorizer_phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($corporateMembers as $corporateMember): ?>
            <tr>
                <td><?= $this->Number->format($corporateMember->id) ?></td>
                <td><?= $corporateMember->has('user') ? $this->Html->link($corporateMember->user->id, ['controller' => 'Users', 'action' => 'view', $corporateMember->user->id]) : '' ?></td>
                <td><?= h($corporateMember->job_title) ?></td>
                <td><?= h($corporateMember->company_name) ?></td>
                <td><?= h($corporateMember->company_address) ?></td>
                <td><?= h($corporateMember->company_email) ?></td>
                <td><?= h($corporateMember->company_phone) ?></td>
                <td><?= h($corporateMember->is_authorize) ?></td>
                <td><?= h($corporateMember->authorizer_first_name) ?></td>
                <td><?= h($corporateMember->authorizer_last_name) ?></td>
                <td><?= h($corporateMember->authorizer_job_title) ?></td>
                <td><?= h($corporateMember->authorizer_email) ?></td>
                <td><?= h($corporateMember->authorizer_phone) ?></td>
                <td><?= h($corporateMember->created) ?></td>
                <td><?= h($corporateMember->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $corporateMember->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $corporateMember->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $corporateMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $corporateMember->id)]) ?>
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
