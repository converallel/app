<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PersonalityCompatibilityFixture
 *
 */
class PersonalityCompatibilityFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'personality_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'matching_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'level_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'level_id' => ['type' => 'index', 'columns' => ['level_id'], 'length' => []],
            'matching_id' => ['type' => 'index', 'columns' => ['matching_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['personality_id', 'matching_id'], 'length' => []],
            'personality_compatibility_ibfk_1' => ['type' => 'foreign', 'columns' => ['level_id'], 'references' => ['personality_compatibility_levels', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'personality_compatibility_ibfk_2' => ['type' => 'foreign', 'columns' => ['matching_id'], 'references' => ['personalities', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'personality_compatibility_ibfk_3' => ['type' => 'foreign', 'columns' => ['personality_id'], 'references' => ['personalities', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
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
                'personality_id' => 1,
                'matching_id' => 1,
                'level_id' => 1
            ],
        ];
        parent::init();
    }
}
