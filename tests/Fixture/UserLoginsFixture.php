<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserLoginsFixture
 *
 */
class UserLoginsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'account_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'device_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'logged_in_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'latitude' => ['type' => 'float', 'length' => 10, 'precision' => 7, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'longitude' => ['type' => 'float', 'length' => 10, 'precision' => 7, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'device_id' => ['type' => 'index', 'columns' => ['device_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['account_id'], 'length' => []],
            'user_logins_ibfk_1' => ['type' => 'foreign', 'columns' => ['device_id'], 'references' => ['devices', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'account_id' => 1,
                'device_id' => 1,
                'logged_in_at' => 1540094364,
                'latitude' => 1,
                'longitude' => 1
            ],
        ];
        parent::init();
    }
}
