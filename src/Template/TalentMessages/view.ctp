<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentMessage $talentMessage
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Talent Message'), ['action' => 'edit', $talentMessage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Talent Message'), ['action' => 'delete', $talentMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentMessage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Talent Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Message'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="talentMessages view large-9 medium-8 columns content">
    <h3><?= h($talentMessage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $talentMessage->has('user') ? $this->Html->link($talentMessage->user->id, ['controller' => 'Users', 'action' => 'view', $talentMessage->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Talent Event') ?></th>
            <td><?= $talentMessage->has('talent_event') ? $this->Html->link($talentMessage->talent_event->id, ['controller' => 'TalentEvents', 'action' => 'view', $talentMessage->talent_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($talentMessage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($talentMessage->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($talentMessage->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($talentMessage->message)); ?>
    </div>
</div>
