<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityReviews Model
 *
 * @property \App\Model\Table\ActivitiesTable|\Cake\ORM\Association\BelongsTo $Activities
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ActivityReview get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityReview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivityReview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityReview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityReview|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityReview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityReview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityReview findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivityReviewsTable extends Table
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

        $this->setTable('activity_reviews');
        $this->setDisplayField('activity_id');
        $this->setPrimaryKey(['activity_id', 'reviewer_id']);

        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'reviewer_id',
            'joinType' => 'INNER'
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
            ->requirePresence('rating', 'create')
            ->notEmpty('rating');

        $validator
            ->scalar('review')
            ->allowEmpty('review');

        $validator
            ->dateTime('reviewed_at')
            ->requirePresence('reviewed_at', 'create')
            ->notEmpty('reviewed_at');

        $validator
            ->dateTime('modified_at')
            ->requirePresence('modified_at', 'create')
            ->notEmpty('modified_at');

        $validator
            ->nonNegativeInteger('helpful')
            ->allowEmpty('helpful');

        $validator
            ->nonNegativeInteger('not_helpful')
            ->allowEmpty('not_helpful');

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
        $rules->add($rules->existsIn(['reviewer_id'], 'Users'));

        return $rules;
    }
}
