<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TalentEventCities Model
 *
 * @property \App\Model\Table\TalentEventsTable|\Cake\ORM\Association\BelongsTo $TalentEvents
 * @property \App\Model\Table\EventcategoriesTable|\Cake\ORM\Association\BelongsTo $Eventcategories
 *
 * @method \App\Model\Entity\TalentEventCity get($primaryKey, $options = [])
 * @method \App\Model\Entity\TalentEventCity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TalentEventCity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TalentEventCity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TalentEventCity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TalentEventCity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TalentEventCity findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TalentEventCitiesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('talent_event_cities');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TalentEvents', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->belongsTo('Eventcategories', [
            'foreignKey' => 'eventcategory_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('city')
            ->allowEmpty('city');

        $validator
            ->scalar('accommodation_price')
            ->allowEmpty('accommodation_price');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['talent_event_id'], 'TalentEvents'));
        $rules->add($rules->existsIn(['eventcategory_id'], 'Eventcategories'));

        return $rules;
    }
}
