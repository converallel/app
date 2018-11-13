<?php

namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activities Model
 *
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Organizer
 * @property \App\Model\Table\ActivityItinerariesTable|\Cake\ORM\Association\HasMany $ActivityItineraries
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\HasMany $Applications
 * @property \App\Model\Table\ReviewsTable|\Cake\ORM\Association\HasMany $Reviews
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsToMany $Followers
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsToMany $Organizers
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsToMany $Participants
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
        $this->belongsTo('Organizer', [
            'className' => 'Users',
            'foreignKey' => 'organizer_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ActivityItineraries', [
            'foreignKey' => 'activity_id'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'activity_id'
        ]);
        $this->hasMany('Reviews', [
            'foreignKey' => 'activity_id'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'activities_tags'
        ]);
        $this->belongsToMany('Followers', [
            'className' => 'Users',
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'activities_users',
            'through' => 'ActivitiesUsers',
            'cascadeCallbacks' => true,
            'conditions' => ['ActivitiesUsers.type' => 'Following']
        ]);
        $this->belongsToMany('Organizers', [
            'className' => 'Users',
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'activities_users',
            'through' => 'ActivitiesUsers',
            'cascadeCallbacks' => true,
            'conditions' => ['ActivitiesUsers.type' => 'Organizing']
        ]);
        $this->belongsToMany('Participants', [
            'className' => 'Users',
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'activities_users',
            'through' => 'ActivitiesUsers',
            'cascadeCallbacks' => true,
            'conditions' => ['ActivitiesUsers.type' => 'Participating']
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
            ->notEmpty('exclusive');

        $validator
            ->scalar('location_visibility')
            ->notEmpty('location_visibility');

        $validator
            ->scalar('details')
            ->maxLength('details', 300)
            ->allowEmpty('details');

        $validator
            ->scalar('status')
            ->notEmpty('status');

        $validator
            ->range('group_size_limit', [3, 100])
            ->allowEmpty('group_size_limit');

        $validator
            ->hasAtMost('tags', 10, 'You can only have 10 tags');

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
        $rules->add($rules->existsIn(['organizer_id'], 'Organizer'));

        return $rules;
    }

    /**
     * @param Query $query
     * @param array $options
     * @return array|Query
     */
    public function findBasicInformation(Query $query, array $options)
    {
        $viewer_id = Configure::read('user_id');
        return
            $query
                ->select([
                    'id', 'title', 'start_date', 'end_date', 'customized_location', 'is_pair', 'created_at',
                    'modified_at', 'status', 'group_size_limit',
                    'applied' => 'applications.user_id IS NOT NULL',
                    'following' => 'followers.user_id IS NOT NULL',
                    'participating' => 'participants.user_id IS NOT NULL',
                    'organizer_count', 'participant_count',
                ])
                ->select($this->Locations)
                ->contain([
                    'Locations', 'Tags',
                    'Organizer' => ['finder' => 'basicInformation'],
                    'Organizers' => function (Query $query) use ($viewer_id) {
                        return $query->find('minimumInformation')->limit(5);
                    },
                    'Participants' => function (Query $query) {
                        return $query->find('minimumInformation')->limit(5);
                    },
                ])
                ->leftJoin(['applications'],
                    ['activities.id = applications.activity_id', "applications.user_id = $viewer_id"])
                ->leftJoin(['followers' => 'activities_users'],
                    ['activities.id = followers.activity_id', "followers.user_id = $viewer_id",
                        "followers.type = 'Following'"])
                ->leftJoin(['participants' => 'activities_users'],
                    ['activities.id = participants.activity_id', "participants.user_id = $viewer_id",
                        "participants.type = 'Participating'"]);
    }

    /**
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findOrganizers(Query $query, array $options)
    {
        $activity_id = $options['activity_id'];
        return $query->innerJoinWith('ActivitiesUsers', function (Query $query) use ($activity_id) {
            return $query->where(['activity_id' => $activity_id, 'type' => 'Organizing']);
        });
    }

    /**
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findParticipants(Query $query, array $options)
    {
        $activity_id = $options['activity_id'];
        return $query->innerJoinWith('ActivitiesUsers', function (Query $query) use ($activity_id) {
            return $query->where(['activity_id' => $activity_id, 'type' => 'Participating']);
        });
    }
}
