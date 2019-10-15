<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Eventsubcategories Model
 *
 * @property \App\Model\Table\EventcategoriesTable|\Cake\ORM\Association\BelongsTo $Eventcategories
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property |\Cake\ORM\Association\HasMany $TalentEventSubcategories
 *
 * @method \App\Model\Entity\Eventsubcategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Eventsubcategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Eventsubcategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Eventsubcategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Eventsubcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Eventsubcategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Eventsubcategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventsubcategoriesTable extends Table
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

        $this->setTable('eventsubcategories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Eventcategories', [
            'foreignKey' => 'eventcategory_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('TalentEventSubcategories', [
            'foreignKey' => 'eventsubcategory_id'
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
            ->integer('ordinal')
            ->allowEmpty('ordinal');

        $validator
            ->scalar('status')
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['eventcategory_id'], 'Eventcategories'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    public function validationOnlyCheck(Validator $validator) {
        $validator = $this->validationDefault($validator);
        $validator->remove('status');
        $validator->remove('eventcategory_id');
        $validator->remove('title');
        $validator->remove('user_id');
        $validator->remove('ordinal');
        return $validator;
    }
}
