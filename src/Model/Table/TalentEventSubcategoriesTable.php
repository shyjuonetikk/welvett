<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TalentEventSubcategories Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\EventcategoriesTable|\Cake\ORM\Association\BelongsTo $Eventcategories
 * @property \App\Model\Table\EventsubcategoriesTable|\Cake\ORM\Association\BelongsTo $Eventsubcategories
 *
 * @method \App\Model\Entity\TalentEventSubcategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\TalentEventSubcategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TalentEventSubcategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TalentEventSubcategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TalentEventSubcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TalentEventSubcategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TalentEventSubcategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TalentEventSubcategoriesTable extends Table
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

        $this->setTable('talent_event_subcategories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('TalentEvents', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->belongsTo('Eventcategories', [
            'foreignKey' => 'eventcategory_id'
        ]);
        $this->belongsTo('Eventsubcategories', [
            'foreignKey' => 'eventsubcategory_id'
        ]);
        $this->belongsTo('TalentEvents', [
            'foreignKey' => 'talent_event_id'
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
        $rules->add($rules->existsIn(['eventcategory_id'], 'Eventcategories'));
        $rules->add($rules->existsIn(['eventsubcategory_id'], 'Eventsubcategories'));

        return $rules;
    }
}
