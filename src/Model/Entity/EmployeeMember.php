<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EmployeeMember Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $eventcategory_id
 * @property string $address
 * @property string $state
 * @property string $city
 * @property string $social_media_link
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Eventcategory $eventcategory
 */
class EmployeeMember extends Entity
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
