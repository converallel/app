<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

/**
 * ActivitiesMedia Model
 *
 * @property \App\Model\Table\ActivitiesTable|\Cake\ORM\Association\BelongsTo $Activities
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 *
 * @method \App\Model\Entity\ActivitiesMedia get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivitiesMedia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivitiesMedia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivitiesMedia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivitiesMedia|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivitiesMedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivitiesMedia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivitiesMedia findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivitiesMediaTable extends Table
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

        $this->setTable('activities_media');
        $this->setDisplayField('activity_id');
        $this->setPrimaryKey(['activity_id', 'media_id']);

        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Media', [
            'foreignKey' => 'media_id',
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
        $rules->add($rules->existsIn(['media_id'], 'Media'));

        return $rules;
    }
}
