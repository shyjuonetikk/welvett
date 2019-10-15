<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TalentEventCity Entity
 *
 * @property int $id
 * @property int $talent_event_id
 * @property int $eventcategory_id
 * @property string $city
 * @property string $accommodation_price
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\TalentEvent $talent_event
 * @property \App\Model\Entity\Eventcategory $eventcategory
 */
class TalentEventCity extends Entity
{

}
