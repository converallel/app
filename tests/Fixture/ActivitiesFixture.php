<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActivitiesFixture
 *
 */
class ActivitiesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'title' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'start_date' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'end_date' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'location_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'customized_location' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'organizer_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'is_pair' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'exclusive' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'location_visibility' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'NULL - Sub-locality, 1 - Full address, 0 - Hidden', 'precision' => null],
        'details' => ['type' => 'string', 'length' => 300, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'group_size_limit' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'modified_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_activity_location_id_idx' => ['type' => 'index', 'columns' => ['location_id'], 'length' => []],
            'activity_idx' => ['type' => 'index', 'columns' => ['start_date', 'is_pair', 'status_id'], 'length' => []],
            'fk_actifity_status_id_idx' => ['type' => 'index', 'columns' => ['status_id'], 'length' => []],
            'fk_activity_organizer_fk_idx' => ['type' => 'index', 'columns' => ['organizer_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_actifity_status_id' => ['type' => 'foreign', 'columns' => ['status_id'], 'references' => ['activity_statuses', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'fk_activity_location_id' => ['type' => 'foreign', 'columns' => ['location_id'], 'references' => ['locations', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'fk_activity_organizer_id' => ['type' => 'foreign', 'columns' => ['organizer_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'title' => 'Lorem ipsum dolor sit amet',
                'start_date' => '2018-10-19 03:07:26',
                'end_date' => '2018-10-19 03:07:26',
                'location_id' => 1,
                'customized_location' => 'Lorem ipsum dolor sit amet',
                'organizer_id' => 1,
                'is_pair' => 1,
                'exclusive' => 1,
                'location_visibility' => 1,
                'details' => 'Lorem ipsum dolor sit amet',
                'status_id' => 1,
                'group_size_limit' => 1,
                'created_at' => 1539918446,
                'modified_at' => 1539918446
            ],
        ];
        parent::init();
    }
}
