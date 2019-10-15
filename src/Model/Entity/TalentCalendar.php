<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TalentCalendar Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $booking_id
 * @property \Cake\I18n\FrozenDate $date
 * @property int $is_booked
 * @property int $talent_event_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Booking $booking
 * @property \App\Model\Entity\TalentEvent $talent_event
 */
class TalentCalendar extends Entity
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