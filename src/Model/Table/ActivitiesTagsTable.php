<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

/**
 * ActivitiesTags Model
 *
 * @property \App\Model\Table\ActivitiesTable|\Cake\ORM\Association\BelongsTo $Activities
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsTo $Tags
 *
 * @method \App\Model\Entity\ActivitiesTag get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivitiesTag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivitiesTag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivitiesTag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivitiesTag|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivitiesTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivitiesTag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivitiesTag findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivitiesTagsTable extends Table
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

        $this->setTable('activities_tags');
        $this->setDisplayField('activity_id');
        $this->setPrimaryKey(['activity_id', 'tag_id']);

        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tags', [
            'foreignKey' => 'tag_id',
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
        $rules->add($rules->existsIn(['activity_id'], 'Activities'));
        $rules->add($rules->existsIn(['tag_id'], 'Tags'));

        return $rules;
    }
}
