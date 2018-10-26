<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activities Model
 *
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Organizers
 * @property \App\Model\Table\ActivityStatusesTable|\Cake\ORM\Association\BelongsTo $ActivityStatuses
 * @property \App\Model\Table\ActivityApplicationsTable|\Cake\ORM\Association\HasMany $ActivityApplications
 * @property \App\Model\Table\ActivityItinerariesTable|\Cake\ORM\Association\HasMany $ActivityItineraries
 * @property \App\Model\Table\ActivityReviewsTable|\Cake\ORM\Association\HasMany $ActivityReviews
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Activity get($primaryKey, $options = [])
 * @method \App\Model\Entity\Activity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Activity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Activity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activity|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Activity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Activity findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivitiesTable extends Table
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

        $this->setTable('activities');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Organizers', [
            'className' => 'Users',
            'foreignKey' => 'organizer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ActivityStatuses', [
            'foreignKey' => 'status_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ActivityApplications', [
            'foreignKey' => 'activity_id'
        ]);
        $this->hasMany('ActivityItineraries', [
            'foreignKey' => 'activity_id'
        ]);
        $this->hasMany('ActivityReviews', [
            'foreignKey' => 'activity_id'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'activities_tags'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'activities_users'
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
            ->nonNegativeInteger('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->allowEmpty('end_date');

        $validator
            ->scalar('customized_location')
            ->maxLength('customized_location', 100)
            ->allowEmpty('customized_location');

        $validator
            ->boolean('is_pair')
            ->requirePresence('is_pair', 'create')
            ->notEmpty('is_pair');

        $validator
            ->boolean('exclusive')
            ->requirePresence('exclusive', 'create')
            ->notEmpty('exclusive');

        $validator
            ->scalar('location_visibility')
            ->requirePresence('location_visibility', 'create')
            ->notEmpty('location_visibility');

        $validator
            ->scalar('details')
            ->maxLength('details', 300)
            ->allowEmpty('details');

        $validator
            ->allowEmpty('group_size_limit');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');

        $validator
            ->dateTime('modified_at')
            ->requirePresence('modified_at', 'create')
            ->notEmpty('modified_at');

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
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['organizer_id'], 'Users'));
        $rules->add($rules->existsIn(['status_id'], 'ActivityStatuses'));

        return $rules;
    }

    public function findBasicInformation(Query $query, array $options)
    {
        return
            $query
                ->select([
                    'id', 'title', 'start_date', 'end_date', 'customized_location', 'is_pair', 'created_at',
                    'modified_at', 'status' => 'ActivityStatuses.status', 'group_size_limit',
//                'participant_count' => $query->func()->count('users')
                ])
                ->select($this->Locations)
                ->contain([
                    'ActivityStatuses', 'Locations', 'Tags',
                    'Users' => function (Query $query) {
                        return $query->select(['id', 'profile_image_path'])
                            ->where(['type IN' => ['Organizers', 'Participated']])->order('type')->limit(5);
                    },
                    'Organizers' => function (Query $query) {
                        return $query->find('basicInformation');
                    }]);
    }
}
