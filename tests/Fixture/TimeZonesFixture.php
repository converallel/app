<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TimeZonesFixture
 *
 */
class TimeZonesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'latitude' => ['type' => 'float', 'length' => 10, 'precision' => 7, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'longitude' => ['type' => 'float', 'length' => 10, 'precision' => 7, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'timezone' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['latitude', 'longitude'], 'length' => []],
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
                'latitude' => 1,
                'longitude' => 1,
                'timezone' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
