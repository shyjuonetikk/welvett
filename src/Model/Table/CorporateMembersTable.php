<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CorporateMembers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CorporateMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\CorporateMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CorporateMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CorporateMember|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CorporateMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CorporateMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CorporateMember findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CorporateMembersTable extends Table
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

        $this->setTable('corporate_members');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            ->scalar('job_title')
            ->allowEmpty('job_title');

        $validator
            ->scalar('company_name')
            ->allowEmpty('company_name');

        $validator
            ->scalar('company_address')
            ->allowEmpty('company_address');

        $validator
            ->scalar('company_email')
            ->allowEmpty('company_email');

        $validator
            ->scalar('company_phone')
            ->allowEmpty('company_phone');

        $validator
            ->scalar('is_authorize')
            ->allowEmpty('is_authorize');

        $validator
            ->scalar('authorizer_first_name')
            ->allowEmpty('authorizer_first_name');

        $validator
            ->scalar('authorizer_last_name')
            ->allowEmpty('authorizer_last_name');

        $validator
            ->scalar('authorizer_job_title')
            ->allowEmpty('authorizer_job_title');

        $validator
            ->scalar('authorizer_email')
            ->allowEmpty('authorizer_email');

        $validator
            ->scalar('authorizer_phone')
            ->allowEmpty('authorizer_phone');

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
}
