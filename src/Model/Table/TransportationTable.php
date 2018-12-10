<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transportation Model
 *
 * @property \App\Model\Table\ActivityItinerariesTable|\Cake\ORM\Association\HasMany $ActivityItineraries
 *
 * @method \App\Model\Entity\Transportation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Transportation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Transportation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transportation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transportation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transportation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Transportation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transportation findOrCreate($search, callable $callback = null, $options = [])
 */
class TransportationTable extends Table
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

        $this->setTable('transportation');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('ActivityItineraries', [
            'foreignKey' => 'transportation_id'
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
            ->scalar('mode')
            ->maxLength('mode', 45)
            ->requirePresence('mode', 'create')
            ->notEmpty('mode')
            ->add('mode', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['mode']));

        return $rules;
    }
}
