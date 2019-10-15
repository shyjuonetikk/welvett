<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\BookingCancellationsTable|\Cake\ORM\Association\HasMany $BookingCancellations
 * @property \App\Model\Table\BookingsTable|\Cake\ORM\Association\HasMany $Bookings
 * @property \App\Model\Table\BusSeatAssignsTable|\Cake\ORM\Association\HasMany $BusSeatAssigns
 * @property \App\Model\Table\BusesTable|\Cake\ORM\Association\HasMany $Buses
 * @property \App\Model\Table\BusstatusTable|\Cake\ORM\Association\HasMany $Busstatus
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\HasMany $Cities
 * @property \App\Model\Table\LogsTable|\Cake\ORM\Association\HasMany $Logs
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 * @property \App\Model\Table\RoutesTable|\Cake\ORM\Association\HasMany $Routes
 * @property \App\Model\Table\SeatsTable|\Cake\ORM\Association\HasMany $Seats
 * @property \App\Model\Table\SightseeingPaymentsTable|\Cake\ORM\Association\HasMany $SightseeingPayments
 * @property \App\Model\Table\SightseeingsTable|\Cake\ORM\Association\HasMany $Sightseeings
 * @property \App\Model\Table\TerminalsTable|\Cake\ORM\Association\HasMany $Terminals
 * @property \App\Model\Table\TourPaymentsTable|\Cake\ORM\Association\HasMany $TourPayments
 * @property \App\Model\Table\ToursTable|\Cake\ORM\Association\HasMany $Tours
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->hasMany('CustomerUsers', [
            'foreignKey' => 'customer_id',
            'className' => 'Customerreviews'
        ]);
        $this->hasMany('TalentUsers', [
            'foreignKey' => 'talent_id',
            'className' => 'Customerreviews'
        ]);
        $this->hasMany('CustomerUsers', [
            'foreignKey' => 'customer_id',
            'className' => 'Bookings'
        ]);
        $this->hasMany('TalentUsers', [
            'foreignKey' => 'talent_id',
            'className' => 'Bookings'
        ]);
        $this->hasMany('Memberships', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('BookingCancellations', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Bookings', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('BusSeatAssigns', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Buses', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Busstatus', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Logs', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Routes', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Talents', [
            'foreignKey' => 'talent_id',
            'className' => 'TalentReviews'
        ]);
        $this->hasMany('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'TalentReviews'
        ]);


        $this->hasMany('Seats', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('SightseeingPayments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Sightseeings', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Terminals', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('TourPayments', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Tours', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Modules', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Usercompanies', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('TalentEvents', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('TalentReviews', [
            'foreignKey' => 'talent_id'
        ]);
        $this->hasMany('TalentCalendars', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('CorporateMembers', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('EmployeeMembers', [
            'foreignKey' => 'user_id'
        ]);


        $this->hasMany('TalentEventSubcategories', [
            'foreignKey' => 'user_id'
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
            ->scalar('first_name')
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->scalar('phone1')
            ->requirePresence('phone1', 'create')
            ->notEmpty('phone1');

        $validator
            ->scalar('address1')
            ->allowEmpty('address1');

        $validator
            ->scalar('address2')
            ->allowEmpty('address2');

        $validator
            ->scalar('city')
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->scalar('state')
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
            ->integer('zip')
            ->requirePresence('zip', 'create')
            ->notEmpty('zip');

        $validator
            ->scalar('profile_image')
            ->allowEmpty('profile_image');

        $validator
            ->scalar('phone2')
            ->allowEmpty('phone2', 'create');

        $validator
            ->scalar('gender')
            ->allowEmpty('gender');

        $validator
            ->scalar('user_name')
            ->requirePresence('user_name', 'create')
            ->notEmpty('user_name');
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->scalar('password_reset_token')
            ->allowEmpty('password_reset_token', 'create');

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
        $rules->add($rules->isUnique(['user_name'], 'Username already used'));
        $rules->add($rules->isUnique(['email'], 'Email already used'));
        $rules->add($rules->isUnique(['loginwithsocial'], 'This social url is already used'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }

    public function validationOnlyCheck(Validator $validator) {
        $validator = $this->validationDefault($validator);
        $validator->remove('password');
        return $validator;
    }

    public function validationIndivisualCheck(Validator $validator) {
        $validator = $this->validationDefault($validator);
        $validator->remove('city');
        $validator->remove('state');
        $validator->remove('zip');
        $validator->remove('profile_image');
        $validator->remove('user_name');
        return $validator;
    }
    public function validationIndivisuallCheck(Validator $validator) {
        $validator = $this->validationDefault($validator);
        $validator->remove('city');
        $validator->remove('state');
        $validator->remove('zip');
        $validator->remove('profile_image');
        $validator->remove('user_name');
        $validator->remove('phone1');
        return $validator;
    }

    public function validationPassword(Validator $validator)
    {
        $validator
            ->add('new_password',[
                'length' => [
                    'rule' => ['minLength',6],
                    'message' => 'Please enter atleast 6 characters in password '
                ]
            ])
            ->add('new_password',[
                'match' => [
                    'rule' => ['compareWith','confirm_password'],
                    'message' => 'Sorry! Password dose not match. Please try again!'
                ]
            ])
            ->notEmpty('new_password');

        $validator
            ->add('confirm_password',[
                'length' => [
                    'rule' => ['minLength',6],
                    'message' => 'Please enter atleast 6 characters in password '
                ]
            ])
            ->add('confirm_password',[
                'match' => [
                    'rule' => ['compareWith','new_password'],
                    'message' => 'Sorry! Password dose not match. Please try again!'
                ]
            ])
            ->notEmpty('confirm_password');

        return $validator;
    }

}
