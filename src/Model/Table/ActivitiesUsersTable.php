<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivitiesUsers Model
 *
 * @property \App\Model\Table\ActivitiesTable|\Cake\ORM\Association\BelongsTo $Activities
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ActivitiesUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivitiesUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivitiesUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivitiesUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivitiesUser|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivitiesUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivitiesUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivitiesUser findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivitiesUsersTable extends Table
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

        $this->setTable('activities_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER'
        ]);
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
            ->nonNegativeInteger('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');

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
        $rules->add($rules->existsIn(['activity_id'], 'Activities'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
