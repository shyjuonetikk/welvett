<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone1
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property int $zip
 * @property string $profile_image
 * @property string $phone2
 * @property string $gender
 * @property string $user_name
 * @property string $password
 * @property string $email
 * @property int $status
 * @property string $password_reset_token
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\BookingCancellation[] $booking_cancellations
 * @property \App\Model\Entity\Booking[] $bookings
 * @property \App\Model\Entity\BusSeatAssign[] $bus_seat_assigns
 * @property \App\Model\Entity\Bus[] $buses
 * @property \App\Model\Entity\Busstatus[] $busstatus
 * @property \App\Model\Entity\City[] $cities
 * @property \App\Model\Entity\Log[] $logs
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\Route[] $routes
 * @property \App\Model\Entity\Seat[] $seats
 * @property \App\Model\Entity\SightseeingPayment[] $sightseeing_payments
 * @property \App\Model\Entity\Sightseeing[] $sightseeings
 * @property \App\Model\Entity\Terminal[] $terminals
 * @property \App\Model\Entity\TourPayment[] $tour_payments
 * @property \App\Model\Entity\Tour[] $tours
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }


    protected function _getFullName()
    {
        return $this->_properties['first_name'] . '  ' .
            $this->_properties['last_name'];
    }
}
