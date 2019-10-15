<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Eventcategory Entity
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property string $image_icon
 * @property string $status
 * @property int $ordinal
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\EmployeeMember[] $employee_members
 * @property \App\Model\Entity\Eventsubcategory[] $eventsubcategories
 * @property \App\Model\Entity\TalentEventCity[] $talent_event_cities
 * @property \App\Model\Entity\TalentEventSubcategory[] $talent_event_subcategories
 * @property \App\Model\Entity\TalentEvent[] $talent_events
 */
class Eventcategory extends Entity
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
