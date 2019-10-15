<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Right Entity
 *
 * @property int $id
 * @property int $role_id
 * @property int $module_id
 * @property int $user_id
 * @property int $status
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Module $module
 * @property \App\Model\Entity\User $user
 */
class Right extends Entity
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
        'role_id' => true,
        'module_id' => true,
        'user_id' => true,
        'status' => true,
        'modified' => true,
        'role' => true,
        'module' => true,
        'user' => true,
        'per_type' => true,
    ];
}
