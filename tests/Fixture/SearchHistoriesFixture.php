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
        'user_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'search_type_id' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'search_string' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'searched_at' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_search_hisotry_search_type_id_idx' => ['type' => 'index', 'columns' => ['search_type_id'], 'length' => []],
            'search_on_idx' => ['type' => 'index', 'columns' => ['searched_at'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['user_id', 'search_type_id', 'search_string'], 'length' => []],
            'fk_search_hisotry_search_type_id' => ['type' => 'foreign', 'columns' => ['search_type_id'], 'references' => ['search_types', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'fk_search_history_user_id' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'search_string' => '59ed7d7b-a156-4004-85db-d15f381167ce',
                'searched_at' => 1539918446
            ],
        ];
        parent::init();
    }
}
