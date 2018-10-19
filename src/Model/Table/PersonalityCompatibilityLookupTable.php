<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PersonalityCompatibilityLookup Model
 *
 * @method \App\Model\Entity\PersonalityCompatibilityLookup get($primaryKey, $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLookup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLookup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLookup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLookup|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLookup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLookup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibilityLookup findOrCreate($search, callable $callback = null, $options = [])
 */
class PersonalityCompatibilityLookupTable extends Table
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

        $this->setTable('personality_compatibility_lookup');
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
            ->scalar('compatibility')
            ->maxLength('compatibility', 45)
            ->requirePresence('compatibility', 'create')
            ->notEmpty('compatibility');

        $validator
            ->scalar('details')
            ->maxLength('details', 100)
            ->requirePresence('details', 'create')
            ->notEmpty('details');

        return $validator;
    }
}
