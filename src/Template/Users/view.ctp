<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User $user
  */

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Booking Cancellations'), ['controller' => 'BookingCancellations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking Cancellation'), ['controller' => 'BookingCancellations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Booking'), ['controller' => 'Bookings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bus Seat Assigns'), ['controller' => 'BusSeatAssigns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bus Seat Assign'), ['controller' => 'BusSeatAssigns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Buses'), ['controller' => 'Buses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Bus'), ['controller' => 'Buses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Busstatus'), ['controller' => 'Busstatus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Busstatus'), ['controller' => 'Busstatus', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Logs'), ['controller' => 'Logs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['controller' => 'Logs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Routes'), ['controller' => 'Routes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Route'), ['controller' => 'Routes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Seats'), ['controller' => 'Seats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Seat'), ['controller' => 'Seats', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sightseeing Payments'), ['controller' => 'SightseeingPayments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sightseeing Payment'), ['controller' => 'SightseeingPayments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sightseeings'), ['controller' => 'Sightseeings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sightseeing'), ['controller' => 'Sightseeings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Terminals'), ['controller' => 'Terminals', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Terminal'), ['controller' => 'Terminals', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tour Payments'), ['controller' => 'TourPayments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tour Payment'), ['controller' => 'TourPayments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tours'), ['controller' => 'Tours', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tour'), ['controller' => 'Tours', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone1') ?></th>
            <td><?= h($user->phone1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($user->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($user->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile Image') ?></th>
            <td><?= h($user->profile_image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone2') ?></th>
            <td><?= h($user->phone2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= h($user->gender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Name') ?></th>
            <td><?= h($user->user_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password Reset Token') ?></th>
            <td><?= h($user->password_reset_token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zip') ?></th>
            <td><?= $this->Number->format($user->zip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($user->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address1') ?></h4>
        <?= $this->Text->autoParagraph(h($user->address1)); ?>
    </div>
    <div class="row">
        <h4><?= __('Address2') ?></h4>
        <?= $this->Text->autoParagraph(h($user->address2)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Booking Cancellations') ?></h4>
        <?php if (!empty($user->booking_cancellations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Customer Id') ?></th>
                <th scope="col"><?= __('Route Id') ?></th>
                <th scope="col"><?= __('Is Refund') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->booking_cancellations as $bookingCancellations): ?>
            <tr>
                <td><?= h($bookingCancellations->id) ?></td>
                <td><?= h($bookingCancellations->user_id) ?></td>
                <td><?= h($bookingCancellations->customer_id) ?></td>
                <td><?= h($bookingCancellations->route_id) ?></td>
                <td><?= h($bookingCancellations->is_refund) ?></td>
                <td><?= h($bookingCancellations->amount) ?></td>
                <td><?= h($bookingCancellations->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'BookingCancellations', 'action' => 'view', $bookingCancellations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'BookingCancellations', 'action' => 'edit', $bookingCancellations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'BookingCancellations', 'action' => 'delete', $bookingCancellations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookingCancellations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Bookings') ?></h4>
        <?php if (!empty($user->bookings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Route Id') ?></th>
                <th scope="col"><?= __('Date Time') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Payment Id') ?></th>
                <th scope="col"><?= __('Transaction Id') ?></th>
                <th scope="col"><?= __('Transaction Status') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Adults') ?></th>
                <th scope="col"><?= __('Children') ?></th>
                <th scope="col"><?= __('Booking Number') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->bookings as $bookings): ?>
            <tr>
                <td><?= h($bookings->id) ?></td>
                <td><?= h($bookings->user_id) ?></td>
                <td><?= h($bookings->route_id) ?></td>
                <td><?= h($bookings->date_time) ?></td>
                <td><?= h($bookings->status) ?></td>
                <td><?= h($bookings->payment_id) ?></td>
                <td><?= h($bookings->transaction_id) ?></td>
                <td><?= h($bookings->transaction_status) ?></td>
                <td><?= h($bookings->amount) ?></td>
                <td><?= h($bookings->adults) ?></td>
                <td><?= h($bookings->children) ?></td>
                <td><?= h($bookings->booking_number) ?></td>
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
        <h4><?= __('Related Bus Seat Assigns') ?></h4>
        <?php if (!empty($user->bus_seat_assigns)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Bus Id') ?></th>
                <th scope="col"><?= __('Seat Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->bus_seat_assigns as $busSeatAssigns): ?>
            <tr>
                <td><?= h($busSeatAssigns->id) ?></td>
                <td><?= h($busSeatAssigns->bus_id) ?></td>
                <td><?= h($busSeatAssigns->seat_id) ?></td>
                <td><?= h($busSeatAssigns->status) ?></td>
                <td><?= h($busSeatAssigns->user_id) ?></td>
                <td><?= h($busSeatAssigns->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'BusSeatAssigns', 'action' => 'view', $busSeatAssigns->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'BusSeatAssigns', 'action' => 'edit', $busSeatAssigns->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'BusSeatAssigns', 'action' => 'delete', $busSeatAssigns->id], ['confirm' => __('Are you sure you want to delete # {0}?', $busSeatAssigns->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Buses') ?></h4>
        <?php if (!empty($user->buses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Limits') ?></th>
                <th scope="col"><?= __('Bus Company') ?></th>
                <th scope="col"><?= __('Bus Number') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->buses as $buses): ?>
            <tr>
                <td><?= h($buses->id) ?></td>
                <td><?= h($buses->limits) ?></td>
                <td><?= h($buses->bus_company) ?></td>
                <td><?= h($buses->bus_number) ?></td>
                <td><?= h($buses->status) ?></td>
                <td><?= h($buses->user_id) ?></td>
                <td><?= h($buses->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Buses', 'action' => 'view', $buses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Buses', 'action' => 'edit', $buses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Buses', 'action' => 'delete', $buses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $buses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Busstatus') ?></h4>
        <?php if (!empty($user->busstatus)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Bus Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Status Arival Delay') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Time Arival Delay') ?></th>
                <th scope="col"><?= __('Reason Of Delay') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->busstatus as $busstatus): ?>
            <tr>
                <td><?= h($busstatus->id) ?></td>
                <td><?= h($busstatus->bus_id) ?></td>
                <td><?= h($busstatus->date) ?></td>
                <td><?= h($busstatus->status_arival_delay) ?></td>
                <td><?= h($busstatus->user_id) ?></td>
                <td><?= h($busstatus->time_arival_delay) ?></td>
                <td><?= h($busstatus->reason_of_delay) ?></td>
                <td><?= h($busstatus->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Busstatus', 'action' => 'view', $busstatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Busstatus', 'action' => 'edit', $busstatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Busstatus', 'action' => 'delete', $busstatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $busstatus->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Cities') ?></h4>
        <?php if (!empty($user->cities)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Names') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->cities as $cities): ?>
            <tr>
                <td><?= h($cities->id) ?></td>
                <td><?= h($cities->names) ?></td>
                <td><?= h($cities->status) ?></td>
                <td><?= h($cities->user_id) ?></td>
                <td><?= h($cities->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Cities', 'action' => 'view', $cities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Cities', 'action' => 'edit', $cities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cities', 'action' => 'delete', $cities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Logs') ?></h4>
        <?php if (!empty($user->logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Activity') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->logs as $logs): ?>
            <tr>
                <td><?= h($logs->id) ?></td>
                <td><?= h($logs->user_id) ?></td>
                <td><?= h($logs->activity) ?></td>
                <td><?= h($logs->note) ?></td>
                <td><?= h($logs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Logs', 'action' => 'view', $logs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Logs', 'action' => 'edit', $logs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Logs', 'action' => 'delete', $logs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Payments') ?></h4>
        <?php if (!empty($user->payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Payment Type') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->payments as $payments): ?>
            <tr>
                <td><?= h($payments->id) ?></td>
                <td><?= h($payments->payment_type) ?></td>
                <td><?= h($payments->status) ?></td>
                <td><?= h($payments->user_id) ?></td>
                <td><?= h($payments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'action' => 'edit', $payments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payments', 'action' => 'delete', $payments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Routes') ?></h4>
        <?php if (!empty($user->routes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Bus Id') ?></th>
                <th scope="col"><?= __('Departure City Id') ?></th>
                <th scope="col"><?= __('Arrival City Id') ?></th>
                <th scope="col"><?= __('Departure Terminal Id') ?></th>
                <th scope="col"><?= __('Arrival Terminal Id') ?></th>
                <th scope="col"><?= __('Departure Time') ?></th>
                <th scope="col"><?= __('Arrival Time') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->routes as $routes): ?>
            <tr>
                <td><?= h($routes->id) ?></td>
                <td><?= h($routes->bus_id) ?></td>
                <td><?= h($routes->departure_city_id) ?></td>
                <td><?= h($routes->arrival_city_id) ?></td>
                <td><?= h($routes->departure_terminal_id) ?></td>
                <td><?= h($routes->arrival_terminal_id) ?></td>
                <td><?= h($routes->departure_time) ?></td>
                <td><?= h($routes->arrival_time) ?></td>
                <td><?= h($routes->price) ?></td>
                <td><?= h($routes->user_id) ?></td>
                <td><?= h($routes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Routes', 'action' => 'view', $routes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Routes', 'action' => 'edit', $routes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Routes', 'action' => 'delete', $routes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $routes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Seats') ?></h4>
        <?php if (!empty($user->seats)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Seat Number') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->seats as $seats): ?>
            <tr>
                <td><?= h($seats->id) ?></td>
                <td><?= h($seats->seat_number) ?></td>
                <td><?= h($seats->status) ?></td>
                <td><?= h($seats->user_id) ?></td>
                <td><?= h($seats->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Seats', 'action' => 'view', $seats->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Seats', 'action' => 'edit', $seats->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Seats', 'action' => 'delete', $seats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $seats->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Sightseeing Payments') ?></h4>
        <?php if (!empty($user->sightseeing_payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Sightseeing Id') ?></th>
                <th scope="col"><?= __('Payment Id') ?></th>
                <th scope="col"><?= __('Transaction Id') ?></th>
                <th scope="col"><?= __('Transaction Status') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Adults') ?></th>
                <th scope="col"><?= __('Childers') ?></th>
                <th scope="col"><?= __('Route Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->sightseeing_payments as $sightseeingPayments): ?>
            <tr>
                <td><?= h($sightseeingPayments->id) ?></td>
                <td><?= h($sightseeingPayments->sightseeing_id) ?></td>
                <td><?= h($sightseeingPayments->payment_id) ?></td>
                <td><?= h($sightseeingPayments->transaction_id) ?></td>
                <td><?= h($sightseeingPayments->transaction_status) ?></td>
                <td><?= h($sightseeingPayments->status) ?></td>
                <td><?= h($sightseeingPayments->adults) ?></td>
                <td><?= h($sightseeingPayments->childers) ?></td>
                <td><?= h($sightseeingPayments->route_id) ?></td>
                <td><?= h($sightseeingPayments->user_id) ?></td>
                <td><?= h($sightseeingPayments->amount) ?></td>
                <td><?= h($sightseeingPayments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SightseeingPayments', 'action' => 'view', $sightseeingPayments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SightseeingPayments', 'action' => 'edit', $sightseeingPayments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SightseeingPayments', 'action' => 'delete', $sightseeingPayments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sightseeingPayments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Sightseeings') ?></h4>
        <?php if (!empty($user->sightseeings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('Duration') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->sightseeings as $sightseeings): ?>
            <tr>
                <td><?= h($sightseeings->id) ?></td>
                <td><?= h($sightseeings->location) ?></td>
                <td><?= h($sightseeings->duration) ?></td>
                <td><?= h($sightseeings->price) ?></td>
                <td><?= h($sightseeings->user_id) ?></td>
                <td><?= h($sightseeings->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Sightseeings', 'action' => 'view', $sightseeings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Sightseeings', 'action' => 'edit', $sightseeings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sightseeings', 'action' => 'delete', $sightseeings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sightseeings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Terminals') ?></h4>
        <?php if (!empty($user->terminals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Mdoified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->terminals as $terminals): ?>
            <tr>
                <td><?= h($terminals->id) ?></td>
                <td><?= h($terminals->name) ?></td>
                <td><?= h($terminals->user_id) ?></td>
                <td><?= h($terminals->status) ?></td>
                <td><?= h($terminals->mdoified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Terminals', 'action' => 'view', $terminals->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Terminals', 'action' => 'edit', $terminals->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Terminals', 'action' => 'delete', $terminals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $terminals->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tour Payments') ?></h4>
        <?php if (!empty($user->tour_payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Tour Id') ?></th>
                <th scope="col"><?= __('Payment Id') ?></th>
                <th scope="col"><?= __('Transaction Id') ?></th>
                <th scope="col"><?= __('Transaction Status') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Adults') ?></th>
                <th scope="col"><?= __('Childers') ?></th>
                <th scope="col"><?= __('Route Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->tour_payments as $tourPayments): ?>
            <tr>
                <td><?= h($tourPayments->id) ?></td>
                <td><?= h($tourPayments->tour_id) ?></td>
                <td><?= h($tourPayments->payment_id) ?></td>
                <td><?= h($tourPayments->transaction_id) ?></td>
                <td><?= h($tourPayments->transaction_status) ?></td>
                <td><?= h($tourPayments->status) ?></td>
                <td><?= h($tourPayments->adults) ?></td>
                <td><?= h($tourPayments->childers) ?></td>
                <td><?= h($tourPayments->route_id) ?></td>
                <td><?= h($tourPayments->user_id) ?></td>
                <td><?= h($tourPayments->amount) ?></td>
                <td><?= h($tourPayments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TourPayments', 'action' => 'view', $tourPayments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TourPayments', 'action' => 'edit', $tourPayments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TourPayments', 'action' => 'delete', $tourPayments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tourPayments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tours') ?></h4>
        <?php if (!empty($user->tours)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Location') ?></th>
                <th scope="col"><?= __('From Date') ?></th>
                <th scope="col"><?= __('To Date') ?></th>
                <th scope="col"><?= __('Number Of Days') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->tours as $tours): ?>
            <tr>
                <td><?= h($tours->id) ?></td>
                <td><?= h($tours->location) ?></td>
                <td><?= h($tours->from_date) ?></td>
                <td><?= h($tours->to_date) ?></td>
                <td><?= h($tours->number_of_days) ?></td>
                <td><?= h($tours->price) ?></td>
                <td><?= h($tours->user_id) ?></td>
                <td><?= h($tours->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tours', 'action' => 'view', $tours->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tours', 'action' => 'edit', $tours->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tours', 'action' => 'delete', $tours->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tours->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
