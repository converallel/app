<?php

namespace App\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Activities Model
 *
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Admin
 * @property \App\Model\Table\ActivityItinerariesTable|\Cake\ORM\Association\HasMany $ActivityItineraries
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\HasMany $Applications
 * @property \App\Model\Table\ReviewsTable|\Cake\ORM\Association\HasMany $Reviews
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsToMany $Media
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
    use SoftDeleteTrait;

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
        $this->belongsTo('Admin', [
            'className' => 'Users',
            'foreignKey' => 'admin_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ActivityItineraries', [
            'foreignKey' => 'activity_id'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'activity_id',
            'cascadeCallbacks' => true,
            'dependent' => true
        ]);
        $this->hasMany('Reviews', [
            'foreignKey' => 'activity_id',
            'cascadeCallbacks' => true,
            'dependent' => true
        ]);
        $this->belongsToMany('Media', [
            'foreignKey' => 'activity_id',
            'targetForeignKey' => 'media_id',
            'joinTable' => 'activities_media'
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
        $rules->add($rules->existsIn(['admin_id'], 'Admin'));

        return $rules;
    }

    /**
     * @param Query $query
     * @param array $options
     * @return array|Query
     */
    public function findBasicInfo(Query $query, array $options)
    {
        $viewer_id = Configure::read('user_id');
        $users = TableRegistry::getTableLocator()->get('Users');

        return $query
            ->select([
                'id',
                'title',
                'start_date',
                'end_date',
                'customized_location',
                'is_pair',
                'created_at',
                'modified_at',
                'status',
                'location_visibility',
                'group_size_limit',
                'applied' => 'applications.user_id IS NOT NULL',
                'following' => 'followers.user_id IS NOT NULL',
                'organizing' => 'organizers.user_id IS NOT NULL',
                'participating' => 'participants.user_id IS NOT NULL',
                'organizer_count',
                'participant_count',
            ])
            ->select($this->Locations)
            ->contain([
                'Locations',
                'Tags',
                'Admin' => ['finder' => 'basicInfo'],
            ])
            ->leftJoin('applications',
                ['activities.id = applications.activity_id', "applications.user_id = $viewer_id"])
            ->leftJoin(['followers' => 'activities_users'],
                [
                    'activities.id = followers.activity_id',
                    "followers.user_id = $viewer_id",
                    "followers.type = 'Following'"
                ])
            ->leftJoin(['organizers' => 'activities_users'],
                [
                    'activities.id = organizers.activity_id',
                    "organizers.user_id = $viewer_id",
                    "organizers.type = 'Organizing'"
                ])
            ->leftJoin(['participants' => 'activities_users'],
                [
                    'activities.id = participants.activity_id',
                    "participants.user_id = $viewer_id",
                    "participants.type = 'Participating'"
                ])
            ->formatResults(function (\Cake\Collection\CollectionInterface $results) use ($users) {
                return $results->map(function ($row) use ($users) {
                    $row['users'] = $users->find('relatedToActivity', ['activity_id' => $row['id']]);
                    return $row;
                });
            });
    }

    public function findRelatedToUser(Query $query, array $options)
    {
        $user_id = $options['user_id'] ?? null;
        if (!$user_id) {
            throw new \InvalidArgumentException();
        }

        return $query
            ->find('basicInfo')
            ->leftJoin(['a' => 'activities_users'], [
                'a.activity_id' => 'Activities.id',
                'a.user_id' => $user_id,
                "a.type IN ('Organizing', 'Participating')"
            ])
            ->orderDesc('Activities.id')
            ->limit(10);
    }
}
