<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $booking_id
 * @property string $w_account
 * @property bool $status
 * @property string $customer_issues
 * @property string $talent_issues
 * @property string $released_by
 * @property string $deducted_amount
 * @property string $released_amount
 * @property int $released_from
 * @property int $released_to
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Booking[] $bookings
 * @property \App\Model\Entity\SightseeingPayment[] $sightseeing_payments
 * @property \App\Model\Entity\TourPayment[] $tour_payments
 */
class Payment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
