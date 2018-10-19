<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FilterEducation Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\EducationTable|\Cake\ORM\Association\BelongsTo $Education
 *
 * @method \App\Model\Entity\FilterEducation get($primaryKey, $options = [])
 * @method \App\Model\Entity\FilterEducation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FilterEducation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FilterEducation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FilterEducation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FilterEducation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FilterEducation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FilterEducation findOrCreate($search, callable $callback = null, $options = [])
 */
class FilterEducationTable extends Table
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

        $this->setTable('filter_education');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey(['user_id', 'education_id']);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Education', [
            'foreignKey' => 'education_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['education_id'], 'Education'));

        return $rules;
    }
}
