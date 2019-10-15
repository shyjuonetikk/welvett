<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TalentEvent Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $eventcategory_id
 * @property string $payment_type
 * @property string $amount
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Eventcategory $eventcategory
 * @property \App\Model\Entity\Booking[] $bookings
 * @property \App\Model\Entity\CustomerReview[] $customer_reviews
 * @property \App\Model\Entity\TalentCalendar[] $talent_calendars
 * @property \App\Model\Entity\TalentEventCity[] $talent_event_cities
 * @property \App\Model\Entity\TalentMessage[] $talent_messages
 * @property \App\Model\Entity\TalentReview[] $talent_reviews
 */
class TalentEvent extends Entity
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
