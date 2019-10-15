<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bookings Model
 *
 * @property \App\Model\Table\TalentsTable|\Cake\ORM\Association\BelongsTo $Talents
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\TalentEventsTable|\Cake\ORM\Association\BelongsTo $TalentEvents
 * @property \App\Model\Table\TalentCalendarTable|\Cake\ORM\Association\HasMany $TalentCalendar
 *
 * @method \App\Model\Entity\Booking get($primaryKey, $options = [])
 * @method \App\Model\Entity\Booking newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Booking[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Booking|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Booking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Booking[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Booking findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BookingsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('bookings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');


        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            //'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->belongsTo('Talents', [
            'foreignKey' => 'talent_id',
            //'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->belongsTo('TalentEventCities', [
            'foreignKey' => 'talent_event_city_id',
            //'joinType' => 'INNER',
            'className' => 'TalentEventCities'
        ]);
        $this->belongsTo('TalentEvents', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->hasMany('TalentCalendar', [
            'foreignKey' => 'booking_id'
        ]);
        $this->hasMany('TalentMessages', [
            'foreignKey' => 'booking_id'
        ]);
        $this->hasOne('CustomerReviews', [
            'foreignKey' => 'booking_id'
        ]);
        $this->hasOne('TalentReviews', [
            'foreignKey' => 'booking_id'
        ]);
        $this->hasOne('TalentRatings', [
            'foreignKey' => 'booking_id'
        ]);
        $this->hasOne('CustomerRatings', [
            'foreignKey' => 'booking_id'
        ]);
        $this->hasOne('Payments', [
            'foreignKey' => 'booking_id'
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
                ->scalar('is_completed')
                ->allowEmpty('is_completed');

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

        $rules->add($rules->existsIn(['talent_event_id'], 'TalentEvents'));

        return $rules;
    }

}
