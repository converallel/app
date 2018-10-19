<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'given_name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'family_name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'birthdate' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'gender' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '1 - Male, 0 - Female, NULL - Other', 'precision' => null],
        'sexual_orientation' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '1', 'comment' => '1 - Straight, 0 - Homosexual, NULL - Both ', 'precision' => null],
        'location_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'profile_image_path' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'personality_id' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'education_id' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'bio' => ['type' => 'string', 'length' => 300, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'rating' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => true, 'null' => false, 'default' => '5', 'comment' => 'On a scale of 1 - 10', 'precision' => null],
        'verified' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'profile_image_id_fk_idx' => ['type' => 'index', 'columns' => ['profile_image_path'], 'length' => []],
            'education' => ['type' => 'index', 'columns' => ['education_id'], 'length' => []],
            'personality_type_id_fk' => ['type' => 'index', 'columns' => ['personality_id'], 'length' => []],
            'user_idx' => ['type' => 'index', 'columns' => ['birthdate', 'gender', 'verified'], 'length' => []],
            'fk_user_location_id_idx' => ['type' => 'index', 'columns' => ['location_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_personality_id' => ['type' => 'foreign', 'columns' => ['personality_id'], 'references' => ['personalities', 'id'], 'update' => 'cascade', 'delete' => 'setNull', 'length' => []],
            'fk_user_education_id' => ['type' => 'foreign', 'columns' => ['education_id'], 'references' => ['education', 'id'], 'update' => 'cascade', 'delete' => 'setNull', 'length' => []],
            'fk_user_id' => ['type' => 'foreign', 'columns' => ['id'], 'references' => ['accounts', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'fk_user_location_id' => ['type' => 'foreign', 'columns' => ['location_id'], 'references' => ['locations', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'given_name' => 'Lorem ipsum dolor sit amet',
                'family_name' => 'Lorem ipsum dolor sit amet',
                'birthdate' => '2018-10-19',
                'gender' => 1,
                'sexual_orientation' => 1,
                'location_id' => 1,
                'profile_image_path' => 'Lorem ipsum dolor sit amet',
                'personality_id' => 1,
                'education_id' => 1,
                'bio' => 'Lorem ipsum dolor sit amet',
                'rating' => 1,
                'verified' => 1
            ],
        ];
        parent::init();
    }
}
