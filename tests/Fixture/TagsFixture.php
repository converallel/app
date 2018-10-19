<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TagsFixture
 *
 */
class TagsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'tag_id' => ['type' => 'smallinteger', 'length' => 4, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'parent_id' => ['type' => 'smallinteger', 'length' => 4, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'tag' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'count' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_tag_parent_id_idx' => ['type' => 'index', 'columns' => ['parent_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['tag_id'], 'length' => []],
            'tag_UNIQUE' => ['type' => 'unique', 'columns' => ['tag'], 'length' => []],
            'fk_tag_parent_id' => ['type' => 'foreign', 'columns' => ['parent_id'], 'references' => ['tags', 'tag_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'tag_id' => 1,
                'parent_id' => 1,
                'tag' => 'Lorem ipsum dolor sit amet',
                'count' => 1
            ],
        ];
        parent::init();
    }
}
