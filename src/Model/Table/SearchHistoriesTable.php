<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SearchHistories Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\SearchTypesTable|\Cake\ORM\Association\BelongsTo $SearchTypes
 *
 * @method \App\Model\Entity\SearchHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\SearchHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SearchHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SearchHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SearchHistory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SearchHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SearchHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SearchHistory findOrCreate($search, callable $callback = null, $options = [])
 */
class SearchHistoriesTable extends Table
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

        $this->setTable('search_histories');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey(['user_id', 'search_type_id', 'search_string']);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SearchTypes', [
            'foreignKey' => 'search_type_id',
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
            ->scalar('search_string')
            ->maxLength('search_string', 100)
            ->allowEmpty('search_string', 'create');

        $validator
            ->dateTime('searched_at')
            ->requirePresence('searched_at', 'create')
            ->notEmpty('searched_at');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['search_type_id'], 'SearchTypes'));

        return $rules;
    }
}
