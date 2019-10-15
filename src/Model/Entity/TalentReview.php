<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TalentReview Entity
 *
 * @property int $id
 * @property int $talent_id
 * @property string $review
 * @property int $talent_event_id
 * @property int $customer_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Talent $talent
 * @property \App\Model\Entity\TalentEvent $talent_event
 * @property \App\Model\Entity\Customer $customer
 */
class TalentReview extends Entity
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
