<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BookingCancellation Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $customer_id
 * @property int $route_id
 * @property int $is_refund
 * @property float $amount
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Route $route
 */
class BookingCancellation extends Entity
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
