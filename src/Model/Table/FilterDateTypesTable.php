<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FilterDateTypes Model
 *
 * @method \App\Model\Entity\FilterDateType get($primaryKey, $options = [])
 * @method \App\Model\Entity\FilterDateType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FilterDateType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FilterDateType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FilterDateType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FilterDateType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FilterDateType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FilterDateType findOrCreate($search, callable $callback = null, $options = [])
 */
class FilterDateTypesTable extends Table
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

        $this->setTable('filter_date_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->maxLength('type', 30)
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
