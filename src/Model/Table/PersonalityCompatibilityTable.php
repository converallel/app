<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PersonalityCompatibility Model
 *
 * @property \App\Model\Table\PersonalitiesTable|\Cake\ORM\Association\BelongsTo $Personalities
 * @property \App\Model\Table\PersonalitiesTable|\Cake\ORM\Association\BelongsTo $Personalities
 * @property \App\Model\Table\PersonalityCompatibilityLevelsTable|\Cake\ORM\Association\BelongsTo $PersonalityCompatibilityLevels
 *
 * @method \App\Model\Entity\PersonalityCompatibility get($primaryKey, $options = [])
 * @method \App\Model\Entity\PersonalityCompatibility newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibility[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibility|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PersonalityCompatibility|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PersonalityCompatibility patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibility[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PersonalityCompatibility findOrCreate($search, callable $callback = null, $options = [])
 */
class PersonalityCompatibilityTable extends Table
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

        $this->setTable('personality_compatibility');
        $this->setDisplayField('personality_id');
        $this->setPrimaryKey(['personality_id', 'matching_id']);

        $this->belongsTo('Personalities', [
            'foreignKey' => 'personality_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Personalities', [
            'foreignKey' => 'matching_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PersonalityCompatibilityLevels', [
            'foreignKey' => 'level_id',
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
        $rules->add($rules->existsIn(['personality_id'], 'Personalities'));
        $rules->add($rules->existsIn(['matching_id'], 'Personalities'));
        $rules->add($rules->existsIn(['level_id'], 'PersonalityCompatibilityLevels'));

        return $rules;
    }
}
