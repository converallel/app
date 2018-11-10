<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PersonalityCompatibilityLevels Model
 *
 * @method \App\Model\Entity\PersonalityCompatibilityLevel get($primaryKey, $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLevel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLevel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLevel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLevel|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLevel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLevel findOrCreate($search, callable $callback = null, $options = [])
 */
class PersonalityCompatibilityLevelsTable extends Table
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

        $this->setTable('personality_compatibility_levels');
        $this->setDisplayField('title');
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
            ->scalar('title')
            ->maxLength('title', 30)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 100)
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }
}
