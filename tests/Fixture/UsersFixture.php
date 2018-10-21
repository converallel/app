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
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'given_name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'family_name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'birthdate' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'gender' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sexual_orientation' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'Straight', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'location_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'profile_image_path' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'personality_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'education_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'bio' => ['type' => 'string', 'length' => 300, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'rating' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '5', 'comment' => 'On a scale of 1 - 10', 'precision' => null],
        'verified' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'education_id' => ['type' => 'index', 'columns' => ['education_id'], 'length' => []],
            'location_id' => ['type' => 'index', 'columns' => ['location_id'], 'length' => []],
            'personality_id' => ['type' => 'index', 'columns' => ['personality_id'], 'length' => []],
            'profile_image_path' => ['type' => 'index', 'columns' => ['profile_image_path'], 'length' => []],
            'birthdate' => ['type' => 'index', 'columns' => ['birthdate', 'gender', 'verified'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'users_ibfk_1' => ['type' => 'foreign', 'columns' => ['education_id'], 'references' => ['education', 'id'], 'update' => 'cascade', 'delete' => 'setNull', 'length' => []],
            'users_ibfk_2' => ['type' => 'foreign', 'columns' => ['id'], 'references' => ['accounts', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'users_ibfk_3' => ['type' => 'foreign', 'columns' => ['location_id'], 'references' => ['locations', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'users_ibfk_4' => ['type' => 'foreign', 'columns' => ['personality_id'], 'references' => ['personalities', 'id'], 'update' => 'cascade', 'delete' => 'setNull', 'length' => []],
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
                'birthdate' => '2018-10-21',
                'gender' => 'Lorem ipsum dolor sit amet',
                'sexual_orientation' => 'Lorem ipsum dolor sit amet',
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
