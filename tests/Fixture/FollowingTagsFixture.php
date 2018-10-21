<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FollowingTagsFixture
 *
 */
class FollowingTagsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tag_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'tag_id' => ['type' => 'index', 'columns' => ['tag_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['user_id', 'tag_id'], 'length' => []],
            'following_tags_ibfk_1' => ['type' => 'foreign', 'columns' => ['tag_id'], 'references' => ['tags', 'tag_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'following_tags_ibfk_2' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'tag_id' => 1
            ],
        ];
        parent::init();
    }
}
