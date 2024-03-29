<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cities Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TerminalsTable|\Cake\ORM\Association\HasMany $Terminals
 *
 * @method \App\Model\Entity\City get($primaryKey, $options = [])
 * @method \App\Model\Entity\City newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\City[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\City|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\City patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\City[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\City findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CitiesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('cities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');


        $this->hasMany('DepartureCities', [
            'foreignKey' => 'departure_city_id',
            'className' => 'Routes'
        ]);
        
        $this->hasMany('DepartureCities', [
            'foreignKey' => 'departure_city_id',
            'className' => 'Tours'
        ]);

        $this->hasMany('ArrivalCities', [
            'foreignKey' => 'arrival_city_id',
            'className' => 'Routes'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Terminals', [
            'foreignKey' => 'city_id', 'dependent' => true
        ]);

        $this->hasMany('DepartureCities', [
            'foreignKey' => 'departure_city_id',
            'joinType' => 'INNER',
            'className' => 'Routeterminals'
        ]);

        $this->hasMany('ArrivalCities', [
            'foreignKey' => 'arrival_city_id',
            'joinType' => 'INNER',
            'className' => 'Routeterminals'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('names')
                ->requirePresence('names', 'create')
                ->notEmpty('names');

        $validator
                ->integer('status')
                ->requirePresence('status', 'create')
                ->notEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

}
