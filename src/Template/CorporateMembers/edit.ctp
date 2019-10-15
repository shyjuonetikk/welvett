<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $corporateMember->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $corporateMember->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Corporate Members'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="corporateMembers form large-9 medium-8 columns content">
    <?= $this->Form->create($corporateMember) ?>
    <fieldset>
        <legend><?= __('Edit Corporate Member') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('job_title');
            echo $this->Form->control('company_name');
            echo $this->Form->control('company_address');
            echo $this->Form->control('company_email');
            echo $this->Form->control('company_phone');
            echo $this->Form->control('is_authorize');
            echo $this->Form->control('authorizer_first_name');
            echo $this->Form->control('authorizer_last_name');
            echo $this->Form->control('authorizer_job_title');
            echo $this->Form->control('authorizer_email');
            echo $this->Form->control('authorizer_phone');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
