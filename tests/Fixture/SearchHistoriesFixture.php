<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SearchHistoriesFixture
 *
 */
class SearchHistoriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'search_type_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'search_string' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'searched_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'search_type_id' => ['type' => 'index', 'columns' => ['search_type_id'], 'length' => []],
            'searched_at' => ['type' => 'index', 'columns' => ['searched_at'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['user_id', 'search_type_id', 'search_string'], 'length' => []],
            'search_histories_ibfk_1' => ['type' => 'foreign', 'columns' => ['search_type_id'], 'references' => ['search_types', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'search_histories_ibfk_2' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'user_id' => 1,
                'search_type_id' => 1,
                'search_string' => '49f6cdb2-a6b8-44a6-b60a-1307e3f2d641',
                'searched_at' => 1540511521
            ],
        ];
        parent::init();
    }
}
