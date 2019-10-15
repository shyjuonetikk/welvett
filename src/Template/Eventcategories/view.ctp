<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Eventcategory $eventcategory
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Eventcategory'), ['action' => 'edit', $eventcategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Eventcategory'), ['action' => 'delete', $eventcategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventcategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employee Members'), ['controller' => 'EmployeeMembers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee Member'), ['controller' => 'EmployeeMembers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Eventsubcategories'), ['controller' => 'Eventsubcategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Eventsubcategory'), ['controller' => 'Eventsubcategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Event Cities'), ['controller' => 'TalentEventCities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event City'), ['controller' => 'TalentEventCities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Event Subcategories'), ['controller' => 'TalentEventSubcategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event Subcategory'), ['controller' => 'TalentEventSubcategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Events'), ['controller' => 'TalentEvents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event'), ['controller' => 'TalentEvents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventcategories view large-9 medium-8 columns content">
    <h3><?= h($eventcategory->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($eventcategory->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $eventcategory->has('user') ? $this->Html->link($eventcategory->user->id, ['controller' => 'Users', 'action' => 'view', $eventcategory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image Icon') ?></th>
            <td><?= h($eventcategory->image_icon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($eventcategory->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($eventcategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ordinal') ?></th>
            <td><?= $this->Number->format($eventcategory->ordinal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($eventcategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($eventcategory->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employee Members') ?></h4>
        <?php if (!empty($eventcategory->employee_members)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Eventcategory Id') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('State') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Social Media Link') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventcategory->employee_members as $employeeMembers): ?>
            <tr>
                <td><?= h($employeeMembers->id) ?></td>
                <td><?= h($employeeMembers->user_id) ?></td>
                <td><?= h($employeeMembers->eventcategory_id) ?></td>
                <td><?= h($employeeMembers->address) ?></td>
                <td><?= h($employeeMembers->state) ?></td>
                <td><?= h($employeeMembers->city) ?></td>
                <td><?= h($employeeMembers->social_media_link) ?></td>
                <td><?= h($employeeMembers->description) ?></td>
                <td><?= h($employeeMembers->created) ?></td>
                <td><?= h($employeeMembers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EmployeeMembers', 'action' => 'view', $employeeMembers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EmployeeMembers', 'action' => 'edit', $employeeMembers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EmployeeMembers', 'action' => 'delete', $employeeMembers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeMembers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Eventsubcategories') ?></h4>
        <?php if (!empty($eventcategory->eventsubcategories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Eventcategory Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Ordinal') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventcategory->eventsubcategories as $eventsubcategories): ?>
            <tr>
                <td><?= h($eventsubcategories->id) ?></td>
                <td><?= h($eventsubcategories->eventcategory_id) ?></td>
                <td><?= h($eventsubcategories->user_id) ?></td>
                <td><?= h($eventsubcategories->title) ?></td>
                <td><?= h($eventsubcategories->ordinal) ?></td>
                <td><?= h($eventsubcategories->status) ?></td>
                <td><?= h($eventsubcategories->created) ?></td>
                <td><?= h($eventsubcategories->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Eventsubcategories', 'action' => 'view', $eventsubcategories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Eventsubcategories', 'action' => 'edit', $eventsubcategories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Eventsubcategories', 'action' => 'delete', $eventsubcategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventsubcategories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Talent Event Cities') ?></h4>
        <?php if (!empty($eventcategory->talent_event_cities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Talent Event Id') ?></th>
                <th scope="col"><?= __('Eventcategory Id') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Accommodation Price') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventcategory->talent_event_cities as $talentEventCities): ?>
            <tr>
                <td><?= h($talentEventCities->id) ?></td>
                <td><?= h($talentEventCities->talent_event_id) ?></td>
                <td><?= h($talentEventCities->eventcategory_id) ?></td>
                <td><?= h($talentEventCities->city) ?></td>
                <td><?= h($talentEventCities->accommodation_price) ?></td>
                <td><?= h($talentEventCities->created) ?></td>
                <td><?= h($talentEventCities->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TalentEventCities', 'action' => 'view', $talentEventCities->]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TalentEventCities', 'action' => 'edit', $talentEventCities->]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TalentEventCities', 'action' => 'delete', $talentEventCities->], ['confirm' => __('Are you sure you want to delete # {0}?', $talentEventCities->)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Talent Event Subcategories') ?></h4>
        <?php if (!empty($eventcategory->talent_event_subcategories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Eventcategory Id') ?></th>
                <th scope="col"><?= __('Eventsubcategory Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventcategory->talent_event_subcategories as $talentEventSubcategories): ?>
            <tr>
                <td><?= h($talentEventSubcategories->id) ?></td>
                <td><?= h($talentEventSubcategories->user_id) ?></td>
                <td><?= h($talentEventSubcategories->eventcategory_id) ?></td>
                <td><?= h($talentEventSubcategories->eventsubcategory_id) ?></td>
                <td><?= h($talentEventSubcategories->created) ?></td>
                <td><?= h($talentEventSubcategories->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TalentEventSubcategories', 'action' => 'view', $talentEventSubcategories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TalentEventSubcategories', 'action' => 'edit', $talentEventSubcategories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TalentEventSubcategories', 'action' => 'delete', $talentEventSubcategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentEventSubcategories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Talent Events') ?></h4>
        <?php if (!empty($eventcategory->talent_events)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Eventcategory Id') ?></th>
                <th scope="col"><?= __('Payment Type') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($eventcategory->talent_events as $talentEvents): ?>
            <tr>
                <td><?= h($talentEvents->id) ?></td>
                <td><?= h($talentEvents->user_id) ?></td>
                <td><?= h($talentEvents->eventcategory_id) ?></td>
                <td><?= h($talentEvents->payment_type) ?></td>
                <td><?= h($talentEvents->amount) ?></td>
                <td><?= h($talentEvents->created) ?></td>
                <td><?= h($talentEvents->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TalentEvents', 'action' => 'view', $talentEvents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TalentEvents', 'action' => 'edit', $talentEvents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TalentEvents', 'action' => 'delete', $talentEvents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentEvents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
