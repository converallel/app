<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BlockedUsers Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Blockers
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $BlockedUsers
 *
 * @method \App\Model\Entity\BlockedUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\BlockedUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BlockedUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BlockedUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BlockedUser|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BlockedUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BlockedUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BlockedUser findOrCreate($search, callable $callback = null, $options = [])
 */
class BlockedUsersTable extends Table
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

        $this->setTable('blocked_users');
        $this->setDisplayField('blocker_id');
        $this->setPrimaryKey(['blocker_id', 'blocked_id']);

        $this->belongsTo('Blockers', [
            'className' => 'Users',
            'foreignKey' => 'blocker_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('BlockedUsers', [
            'className' => 'Users',
            'foreignKey' => 'blocked_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['blocker_id'], 'Users'));
        $rules->add($rules->existsIn(['blocked_id'], 'Users'));

        return $rules;
    }
}
