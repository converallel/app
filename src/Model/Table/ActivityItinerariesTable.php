<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityItineraries Model
 *
 * @property \App\Model\Table\ActivitiesTable|\Cake\ORM\Association\BelongsTo $Activities
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\TransportationTable|\Cake\ORM\Association\BelongsTo $Transportation
 *
 * @method \App\Model\Entity\ActivityItinerary get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityItinerary newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivityItinerary[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityItinerary|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityItinerary|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityItinerary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityItinerary[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityItinerary findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivityItinerariesTable extends Table
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

        $this->setTable('activity_itineraries');
        $this->setDisplayField('activity_id');
        $this->setPrimaryKey(['activity_id', 'stop']);

        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id'
        ]);
        $this->belongsTo('Transportation', [
            'foreignKey' => 'transportation_mode_id'
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
            ->allowEmpty('stop', 'create');

        $validator
            ->dateTime('arrive_on')
            ->allowEmpty('arrive_on');

        $validator
            ->dateTime('depart_on')
            ->allowEmpty('depart_on');

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
        $rules->add($rules->existsIn(['activity_id'], 'Activities'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['transportation_mode_id'], 'Transportation'));

        return $rules;
    }
}
