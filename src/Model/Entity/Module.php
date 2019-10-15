<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Module Entity
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $orders
 * @property int $status
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Modulerite[] $modulerites
 */
class Module extends Entity
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
        'name' => true,
        'path' => true,
        'orders' => true,
        'user_id' => true,
        'status' => true,
        'modified' => true,
        'modulerites' => true
    ];
}
