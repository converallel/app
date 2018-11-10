<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SearchTypes Model
 *
 * @property \App\Model\Table\SearchHistoriesTable|\Cake\ORM\Association\HasMany $SearchHistories
 *
 * @method \App\Model\Entity\SearchType get($primaryKey, $options = [])
 * @method \App\Model\Entity\SearchType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SearchType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SearchType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SearchType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SearchType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SearchType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SearchType findOrCreate($search, callable $callback = null, $options = [])
 */
class SearchTypesTable extends Table
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

        $this->setTable('search_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('SearchHistories', [
            'foreignKey' => 'search_type_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 45)
            ->requirePresence('type', 'create')
            ->notEmpty('type')
            ->add('type', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['type']));

        return $rules;
    }
}
