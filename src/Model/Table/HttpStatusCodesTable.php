<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HttpStatusCodes Model
 *
 * @method \App\Model\Entity\HttpStatusCode get($primaryKey, $options = [])
 * @method \App\Model\Entity\HttpStatusCode newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HttpStatusCode[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HttpStatusCode|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HttpStatusCode|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HttpStatusCode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HttpStatusCode[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HttpStatusCode findOrCreate($search, callable $callback = null, $options = [])
 */
class HttpStatusCodesTable extends Table
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

        $this->setTable('http_status_codes');
        $this->setDisplayField('code');
        $this->setPrimaryKey('code');
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
            ->allowEmpty('code', 'create');

        $validator
            ->scalar('definition')
            ->maxLength('definition', 40)
            ->requirePresence('definition', 'create')
            ->notEmpty('definition');

        return $validator;
    }
}
