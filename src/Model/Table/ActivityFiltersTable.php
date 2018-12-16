<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityFilters Model
 *
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\HasOne $User
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 *
 * @method \App\Model\Entity\ActivityFilter get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityFilter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivityFilter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityFilter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityFilter|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityFilter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityFilter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityFilter findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivityFiltersTable extends Table
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

        $this->setTable('activity_filters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasOne('User', [
            'className' => 'Users',
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id'
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
            ->boolean('using_current_location')
            ->notEmpty('using_current_location');

        $validator
            ->requirePresence('distance', 'create')
            ->notEmpty('distance');

        $validator
            ->scalar('date_type')
            ->notEmpty('date_type');

        $validator
            ->date('start_date')
            ->allowEmpty('start_date');

        $validator
            ->date('end_date')
            ->allowEmpty('end_date');

        $validator
            ->requirePresence('from_age', 'create')
            ->notEmpty('from_age');

        $validator
            ->requirePresence('to_age', 'create')
            ->notEmpty('to_age');

        $validator
            ->scalar('gender')
            ->allowEmpty('gender');

        $validator
            ->scalar('sexual_orientation')
            ->allowEmpty('sexual_orientation');

        $validator
            ->boolean('matching_personality')
            ->notEmpty('matching_personality');

        $validator
            ->boolean('verified_users')
            ->notEmpty('verified_users');

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
        $rules->add($rules->existsIn(['id'], 'User'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));

        return $rules;
    }
}
