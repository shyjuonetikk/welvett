<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CorporateMember $corporateMember
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Corporate Member'), ['action' => 'edit', $corporateMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Corporate Member'), ['action' => 'delete', $corporateMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $corporateMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Corporate Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Corporate Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="corporateMembers view large-9 medium-8 columns content">
    <h3><?= h($corporateMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $corporateMember->has('user') ? $this->Html->link($corporateMember->user->id, ['controller' => 'Users', 'action' => 'view', $corporateMember->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Job Title') ?></th>
            <td><?= h($corporateMember->job_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Name') ?></th>
            <td><?= h($corporateMember->company_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Address') ?></th>
            <td><?= h($corporateMember->company_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Email') ?></th>
            <td><?= h($corporateMember->company_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Phone') ?></th>
            <td><?= h($corporateMember->company_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Authorize') ?></th>
            <td><?= h($corporateMember->is_authorize) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Authorizer First Name') ?></th>
            <td><?= h($corporateMember->authorizer_first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Authorizer Last Name') ?></th>
            <td><?= h($corporateMember->authorizer_last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Authorizer Job Title') ?></th>
            <td><?= h($corporateMember->authorizer_job_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Authorizer Email') ?></th>
            <td><?= h($corporateMember->authorizer_email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Authorizer Phone') ?></th>
            <td><?= h($corporateMember->authorizer_phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($corporateMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($corporateMember->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($corporateMember->modified) ?></td>
        </tr>
    </table>
</div>
