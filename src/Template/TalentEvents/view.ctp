<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\TalentEvent $talentEvent
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Talent Event'), ['action' => 'edit', $talentEvent->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Talent Event'), ['action' => 'delete', $talentEvent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentEvent->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Talent Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Eventcategories'), ['controller' => 'Eventcategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Eventcategory'), ['controller' => 'Eventcategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customer Reviews'), ['controller' => 'CustomerReviews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer Review'), ['controller' => 'CustomerReviews', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Calendars'), ['controller' => 'TalentCalendars', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Calendar'), ['controller' => 'TalentCalendars', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Event Cities'), ['controller' => 'TalentEventCities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Event City'), ['controller' => 'TalentEventCities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Messages'), ['controller' => 'TalentMessages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Message'), ['controller' => 'TalentMessages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talent Reviews'), ['controller' => 'TalentReviews', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent Review'), ['controller' => 'TalentReviews', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="talentEvents view large-9 medium-8 columns content">
    <h3><?= h($talentEvent->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $talentEvent->has('user') ? $this->Html->link($talentEvent->user->id, ['controller' => 'Users', 'action' => 'view', $talentEvent->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Eventcategory') ?></th>
            <td><?= $talentEvent->has('eventcategory') ? $this->Html->link($talentEvent->eventcategory->title, ['controller' => 'Eventcategories', 'action' => 'view', $talentEvent->eventcategory->]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Type') ?></th>
            <td><?= h($talentEvent->payment_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= h($talentEvent->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($talentEvent->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($talentEvent->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($talentEvent->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Bookings') ?></h4>
        <?php if (!empty($talentEvent->bookings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Talent Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Talent Event Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Is Completed') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($talentEvent->bookings as $bookings): ?>
            <tr>
                <td><?= h($bookings->id) ?></td>
                <td><?= h($bookings->talent_id) ?></td>
                <td><?= h($bookings->customer_id) ?></td>
                <td><?= h($bookings->talent_event_id) ?></td>
                <td><?= h($bookings->status) ?></td>
                <td><?= h($bookings->is_completed) ?></td>
                <td><?= h($bookings->created) ?></td>
                <td><?= h($bookings->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Bookings', 'action' => 'view', $bookings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Bookings', 'action' => 'edit', $bookings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bookings', 'action' => 'delete', $bookings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Customer Reviews') ?></h4>
        <?php if (!empty($talentEvent->customer_reviews)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Review') ?></th>
                <th scope="col"><?= __('Talent Event Id') ?></th>
                <th scope="col"><?= __('Talent Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($talentEvent->customer_reviews as $customerReviews): ?>
            <tr>
                <td><?= h($customerReviews->id) ?></td>
                <td><?= h($customerReviews->customer_id) ?></td>
                <td><?= h($customerReviews->review) ?></td>
                <td><?= h($customerReviews->talent_event_id) ?></td>
                <td><?= h($customerReviews->talent_id) ?></td>
                <td><?= h($customerReviews->created) ?></td>
                <td><?= h($customerReviews->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CustomerReviews', 'action' => 'view', $customerReviews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CustomerReviews', 'action' => 'edit', $customerReviews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CustomerReviews', 'action' => 'delete', $customerReviews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerReviews->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Talent Calendars') ?></h4>
        <?php if (!empty($talentEvent->talent_calendars)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Booking Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Is Booked') ?></th>
                <th scope="col"><?= __('Talent Event Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($talentEvent->talent_calendars as $talentCalendars): ?>
            <tr>
                <td><?= h($talentCalendars->id) ?></td>
                <td><?= h($talentCalendars->user_id) ?></td>
                <td><?= h($talentCalendars->booking_id) ?></td>
                <td><?= h($talentCalendars->date) ?></td>
                <td><?= h($talentCalendars->is_booked) ?></td>
                <td><?= h($talentCalendars->talent_event_id) ?></td>
                <td><?= h($talentCalendars->created) ?></td>
                <td><?= h($talentCalendars->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TalentCalendars', 'action' => 'view', $talentCalendars->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TalentCalendars', 'action' => 'edit', $talentCalendars->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TalentCalendars', 'action' => 'delete', $talentCalendars->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentCalendars->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Talent Event Cities') ?></h4>
        <?php if (!empty($talentEvent->talent_event_cities)): ?>
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
            <?php foreach ($talentEvent->talent_event_cities as $talentEventCities): ?>
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
        <h4><?= __('Related Talent Messages') ?></h4>
        <?php if (!empty($talentEvent->talent_messages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Talent Event Id') ?></th>
                <th scope="col"><?= __('Message') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($talentEvent->talent_messages as $talentMessages): ?>
            <tr>
                <td><?= h($talentMessages->id) ?></td>
                <td><?= h($talentMessages->user_id) ?></td>
                <td><?= h($talentMessages->talent_event_id) ?></td>
                <td><?= h($talentMessages->message) ?></td>
                <td><?= h($talentMessages->created) ?></td>
                <td><?= h($talentMessages->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TalentMessages', 'action' => 'view', $talentMessages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TalentMessages', 'action' => 'edit', $talentMessages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TalentMessages', 'action' => 'delete', $talentMessages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentMessages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Talent Reviews') ?></h4>
        <?php if (!empty($talentEvent->talent_reviews)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Talent Id') ?></th>
                <th scope="col"><?= __('Review') ?></th>
                <th scope="col"><?= __('Talent Event Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($talentEvent->talent_reviews as $talentReviews): ?>
            <tr>
                <td><?= h($talentReviews->id) ?></td>
                <td><?= h($talentReviews->talent_id) ?></td>
                <td><?= h($talentReviews->review) ?></td>
                <td><?= h($talentReviews->talent_event_id) ?></td>
                <td><?= h($talentReviews->customer_id) ?></td>
                <td><?= h($talentReviews->created) ?></td>
                <td><?= h($talentReviews->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TalentReviews', 'action' => 'view', $talentReviews->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TalentReviews', 'action' => 'edit', $talentReviews->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TalentReviews', 'action' => 'delete', $talentReviews->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talentReviews->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
