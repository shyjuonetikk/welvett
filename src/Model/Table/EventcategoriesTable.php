<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Eventcategories Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\EmployeeMembersTable|\Cake\ORM\Association\HasMany $EmployeeMembers
 * @property \App\Model\Table\EventsubcategoriesTable|\Cake\ORM\Association\HasMany $Eventsubcategories
 * @property \App\Model\Table\TalentEventCitiesTable|\Cake\ORM\Association\HasMany $TalentEventCities
 * @property \App\Model\Table\TalentEventSubcategoriesTable|\Cake\ORM\Association\HasMany $TalentEventSubcategories
 * @property \App\Model\Table\TalentEventsTable|\Cake\ORM\Association\HasMany $TalentEvents
 *
 * @method \App\Model\Entity\Eventcategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Eventcategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Eventcategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Eventcategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Eventcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Eventcategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Eventcategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventcategoriesTable extends Table
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

        $this->setTable('eventcategories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('EmployeeMembers', [
            'foreignKey' => 'eventcategory_id'
        ]);
        $this->hasMany('Eventsubcategories', [
            'foreignKey' => 'eventcategory_id'
        ]);
        $this->hasMany('TalentEventCities', [
            'foreignKey' => 'eventcategory_id'
        ]);
        $this->hasMany('TalentEventSubcategories', [
            'foreignKey' => 'eventcategory_id'
        ]);
        $this->hasMany('TalentEvents', [
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
            ->scalar('title')
            ->allowEmpty('title');

        $validator
            ->scalar('image_icon')
            ->allowEmpty('image_icon');

        $validator
            ->scalar('status')
            ->allowEmpty('status');

        $validator
            ->integer('ordinal')
            ->allowEmpty('ordinal');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    public function validationOnlyCheck(Validator $validator) {
        $validator = $this->validationDefault($validator);
        $validator->remove('status');
        $validator->remove('image_icon');
        $validator->remove('title');
        $validator->remove('user_id');
        $validator->remove('ordinal');
        return $validator;
    }
}
