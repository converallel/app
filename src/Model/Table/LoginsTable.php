<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Logins Model
 *
 * @property \App\Model\Table\DevicesTable|\Cake\ORM\Association\BelongsTo $Devices
 *
 * @method \App\Model\Entity\Login get($primaryKey, $options = [])
 * @method \App\Model\Entity\Login newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Login[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Login|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Login|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Login patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Login[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Login findOrCreate($search, callable $callback = null, $options = [])
 */
class LoginsTable extends Table
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

        $this->setTable('logins');
        $this->setDisplayField('account_id');
        $this->setPrimaryKey('account_id');

        $this->belongsTo('Devices', [
            'foreignKey' => 'device_id',
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
            ->nonNegativeInteger('account_id')
            ->allowEmpty('account_id', 'create');

        $validator
            ->dateTime('logged_in_at')
            ->requirePresence('logged_in_at', 'create')
            ->notEmpty('logged_in_at');

        $validator
            ->numeric('latitude')
            ->allowEmpty('latitude');

        $validator
            ->numeric('longitude')
            ->allowEmpty('longitude');

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
        $rules->add($rules->existsIn(['device_id'], 'Devices'));

        return $rules;
    }
}
