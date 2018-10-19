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
     * Table name
     *
     * @var string
     */
    public $table = 'personality_compatibility';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'personality_id' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'matching_id' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'compatibility_id' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_personality_matching_type_id_idx' => ['type' => 'index', 'columns' => ['matching_id'], 'length' => []],
            'fk_personality_matching_seq_idx' => ['type' => 'index', 'columns' => ['compatibility_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['personality_id', 'matching_id'], 'length' => []],
            'fk_personality_match_personality_id' => ['type' => 'foreign', 'columns' => ['personality_id'], 'references' => ['personalities', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'fk_personality_matching_id' => ['type' => 'foreign', 'columns' => ['matching_id'], 'references' => ['personalities', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'fk_personality_matching_seq' => ['type' => 'foreign', 'columns' => ['compatibility_id'], 'references' => ['personality_compatibility_lookup', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'personality_id' => 1,
                'matching_id' => 1,
                'compatibility_id' => 1
            ],
        ];
        parent::init();
    }
}
