<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MediaTypes Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\HasMany $Media
 *
 * @method \App\Model\Entity\MediaType get($primaryKey, $options = [])
 * @method \App\Model\Entity\MediaType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MediaType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MediaType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MediaType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MediaType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MediaType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MediaType findOrCreate($search, callable $callback = null, $options = [])
 */
class MediaTypesTable extends Table
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

        $this->setTable('media_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Media', [
            'foreignKey' => 'media_type_id'
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
