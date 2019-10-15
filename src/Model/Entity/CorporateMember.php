<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CorporateMember Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $job_title
 * @property string $company_name
 * @property string $company_address
 * @property string $company_email
 * @property string $company_phone
 * @property string $is_authorize
 * @property string $authorizer_first_name
 * @property string $authorizer_last_name
 * @property string $authorizer_job_title
 * @property string $authorizer_email
 * @property string $authorizer_phone
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class CorporateMember extends Entity
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
