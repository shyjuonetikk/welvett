<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerReviews Model
 *
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\TalentEventsTable|\Cake\ORM\Association\BelongsTo $TalentEvents
 * @property \App\Model\Table\TalentsTable|\Cake\ORM\Association\BelongsTo $Talents
 *
 * @method \App\Model\Entity\CustomerReview get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustomerReview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CustomerReview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustomerReview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustomerReview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerReview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustomerReview findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerReviewsTable extends Table
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

        $this->setTable('customer_reviews');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CustomerUsers', [
            'foreignKey' => 'customer_id',
            //'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->belongsTo('TalentUsers', [
            'foreignKey' => 'talent_id',
            //'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->belongsTo('TalentEvents', [
            'foreignKey' => 'talent_event_id'
        ]);
        $this->belongsTo('Talents', [
            'foreignKey' => 'talent_id'
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
            ->scalar('review')
            ->allowEmpty('review');

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
//        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['talent_event_id'], 'TalentEvents'));
//        $rules->add($rules->existsIn(['talent_id'], 'Talents'));

        return $rules;
    }
}
