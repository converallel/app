<?php

namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\PersonalitiesTable|\Cake\ORM\Association\BelongsTo $Personalities
 * @property \App\Model\Table\EducationTable|\Cake\ORM\Association\BelongsTo $Education
 * @property \App\Model\Table\ActivitiesTable|\Cake\ORM\Association\HasMany $AdministratedActivities
 * @property \App\Model\Table\ActivityFilterEducationTable|\Cake\ORM\Association\HasMany $ActivityFilterEducation
 * @property \App\Model\Table\ActivityFiltersTable|\Cake\ORM\Association\HasMany $ActivityFilters
 * @property \App\Model\Table\ApplicationsTable|\Cake\ORM\Association\HasMany $Applications
 * @property \App\Model\Table\ContactsTable|\Cake\ORM\Association\HasMany $Contacts
 * @property \App\Model\Table\DevicesTable|\Cake\ORM\Association\HasMany $Devices
 * @property \App\Model\Table\FilesTable|\Cake\ORM\Association\HasMany $Files
 * @property \App\Model\Table\LocationSelectionHistoriesTable|\Cake\ORM\Association\HasMany $LocationSelectionHistories
 * @property \App\Model\Table\LogsTable|\Cake\ORM\Association\HasMany $Logs
 * @property \App\Model\Table\ReviewsTable|\Cake\ORM\Association\HasMany $Reviews
 * @property \App\Model\Table\SearchHistoriesTable|\Cake\ORM\Association\HasMany $SearchHistories
 * @property \App\Model\Table\UserLoginsTable|\Cake\ORM\Association\HasMany $UserLogins
 * @property \App\Model\Table\ActivitiesTable|\Cake\ORM\Association\BelongsToMany $Activities
 * @property \App\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Personalities', [
            'foreignKey' => 'personality_id'
        ]);
        $this->belongsTo('Education', [
            'foreignKey' => 'education_id'
        ]);
        $this->hasMany('AdministratedActivities', [
            'className' => 'Activities',
            'foreignKey' => 'admin_id'
        ]);
        $this->hasMany('ActivityFilterEducation', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('ActivityFilters', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'user_id',
            'cascadeCallbacks' => true,
            'dependent' => true
        ]);
        $this->hasMany('Contacts', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Devices', [
            'foreignKey' => 'user_id',
            'cascadeCallbacks' => true,
            'dependent' => true
        ]);
        $this->hasMany('Files', [
            'foreignKey' => 'user_id',
            'cascadeCallbacks' => true,
            'dependent' => true
        ]);
        $this->hasMany('LocationSelectionHistories', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Logs', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Reviews', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('SearchHistories', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserLogins', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsToMany('Activities', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'activity_id',
            'joinTable' => 'activities_users'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'users_tags'
        ]);
    }

    public function beforeMarshal(Event $event, \ArrayObject $data, \ArrayObject $options)
    {
        if (isset($data['password'])) {
            $data['password'] = (string)$data['password'];
        }
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
            ->email('email')
            ->allowEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('phone_number')
            ->lengthBetween('phone_number', [6, 20])
            ->requirePresence('phone_number', function ($context) {
                return $context['newRecord'] && !isset($context['data']['email']);
            }, "Email and phone number can't both be empty")
            ->add('phone_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->minLength('password', 6)
            ->requirePresence('password', 'create');

        $validator
            ->range('failed_login_attempts', [0, 5])
            ->notEmpty('failed_login_attempts');

        $validator
            ->scalar('given_name')
            ->maxLength('given_name', 45)
            ->requirePresence('given_name', 'create')
            ->notEmpty('given_name');

        $validator
            ->scalar('family_name')
            ->maxLength('family_name', 45)
            ->requirePresence('family_name', 'create')
            ->notEmpty('family_name');

        $validator
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmpty('birthdate');

        $validator
            ->scalar('gender')
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->scalar('sexual_orientation')
            ->requirePresence('sexual_orientation', 'create')
            ->notEmpty('sexual_orientation');

        $validator
            ->scalar('profile_image_path')
            ->maxLength('profile_image_path', 100)
            ->allowEmpty('profile_image_path');

        $validator
            ->scalar('bio')
            ->maxLength('bio', 300)
            ->allowEmpty('bio');

        $validator
            ->range('rating', [1, 10], "User's rating should be a number between 1 and 10")
            ->notEmpty('rating');

        $validator
            ->boolean('verified')
            ->notEmpty('verified');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['phone_number']));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['personality_id'], 'Personalities'));
        $rules->add($rules->existsIn(['education_id'], 'Education'));

        return $rules;
    }

    /**
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findMinimumInfo(Query $query, array $options)
    {
        return $query->select(['id', 'profile_image_path']);
    }

    /**
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findBasicInfo(Query $query, array $options)
    {
        return $query->select(['id', 'given_name', 'birthdate', 'gender', 'profile_image_path', 'verified']);
    }
}
