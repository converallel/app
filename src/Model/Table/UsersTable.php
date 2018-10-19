<?php
namespace App\Model\Table;

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
 * @property \App\Model\Table\ActivityFiltersTable|\Cake\ORM\Association\HasMany $ActivityFilters
 * @property \App\Model\Table\FilterEducationTable|\Cake\ORM\Association\HasMany $FilterEducation
 * @property \App\Model\Table\FollowingTagsTable|\Cake\ORM\Association\HasMany $FollowingTags
 * @property \App\Model\Table\InterestedActivitiesTable|\Cake\ORM\Association\HasMany $InterestedActivities
 * @property \App\Model\Table\LocationSelectionHistoriesTable|\Cake\ORM\Association\HasMany $LocationSelectionHistories
 * @property \App\Model\Table\ParticipationTable|\Cake\ORM\Association\HasMany $Participation
 * @property \App\Model\Table\SearchHistoriesTable|\Cake\ORM\Association\HasMany $SearchHistories
 * @property \App\Model\Table\UserDevicesTable|\Cake\ORM\Association\HasMany $UserDevices
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
        $this->setDisplayField('id');
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
        $this->hasMany('ActivityFilters', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('FilterEducation', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('FollowingTags', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('InterestedActivities', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('LocationSelectionHistories', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Participation', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('SearchHistories', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserDevices', [
            'foreignKey' => 'user_id'
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
            ->boolean('gender')
            ->allowEmpty('gender');

        $validator
            ->boolean('sexual_orientation')
            ->allowEmpty('sexual_orientation');

        $validator
            ->scalar('profile_image_path')
            ->maxLength('profile_image_path', 100)
            ->allowEmpty('profile_image_path');

        $validator
            ->scalar('bio')
            ->maxLength('bio', 300)
            ->allowEmpty('bio');

        $validator
            ->requirePresence('rating', 'create')
            ->notEmpty('rating');

        $validator
            ->boolean('verified')
            ->requirePresence('verified', 'create')
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
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['personality_id'], 'Personalities'));
        $rules->add($rules->existsIn(['education_id'], 'Education'));

        return $rules;
    }
}
