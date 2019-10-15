<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TalentEvents Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\EventcategoriesTable|\Cake\ORM\Association\BelongsTo $Eventcategories
 * @property \App\Model\Table\BookingsTable|\Cake\ORM\Association\HasMany $Bookings
 * @property \App\Model\Table\CustomerReviewsTable|\Cake\ORM\Association\HasMany $CustomerReviews
 * @property \App\Model\Table\TalentCalendarsTable|\Cake\ORM\Association\HasMany $TalentCalendars
 * @property \App\Model\Table\TalentEventCitiesTable|\Cake\ORM\Association\HasMany $TalentEventCities
 * @property \App\Model\Table\TalentMessagesTable|\Cake\ORM\Association\HasMany $TalentMessages
 * @property \App\Model\Table\TalentReviewsTable|\Cake\ORM\Association\HasMany $TalentReviews
 *
 * @method \App\Model\Entity\TalentEvent get($primaryKey, $options = [])
 * @method \App\Model\Entity\TalentEvent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TalentEvent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TalentEvent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TalentEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TalentEvent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TalentEvent findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TalentEventsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('talent_events');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('TalentEventSubcategories', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Eventcategories', [
            'foreignKey' => 'eventcategory_id'
        ]);
        $this->hasMany('Bookings', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->hasMany('Bookings', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->hasMany('CustomerReviews', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->hasMany('TalentCalendars', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->hasMany('TalentEventCities', [
            'foreignKey' => 'talent_event_id', 'dependent' => true
        ]);
        $this->hasMany('TalentMessages', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->hasMany('TalentReviews', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->hasMany('TalentRatings', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->hasMany('TalentEventSubcategories', [
            'foreignKey' => 'talent_event_id', 'dependent' => true
        ]);
        $this->hasMany('EventTypes', [
            'foreignKey' => 'talent_event_id', 'dependent' => true
        ]);
        $this->hasMany('RefrenceLinks', [
            'foreignKey' => 'talent_event_id'
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
                ->scalar('payment_type')
                ->allowEmpty('payment_type');

        $validator
                ->scalar('amount')
                ->allowEmpty('amount');

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
        $rules->add($rules->existsIn(['eventcategory_id'], 'Eventcategories'));

        return $rules;
    }

}
