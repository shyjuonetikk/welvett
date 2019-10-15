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
                ['action' => 'delete', $talentReview->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $talentReview->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Talent Reviews'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="talentReviews form large-9 medium-8 columns content">
    <?= $this->Form->create($talentReview) ?>
    <fieldset>
        <legend><?= __('Edit Talent Review') ?></legend>
        <?php
            echo $this->Form->control('talent_id');
            echo $this->Form->control('review');
            echo $this->Form->control('talent_event_id', ['options' => $talentEvents, 'empty' => true]);
            echo $this->Form->control('customer_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
