<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimeZonesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimeZonesTable Test Case
 */
class TimeZonesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimeZonesTable
     */
    public $TimeZones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TimeZones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TimeZones') ? [] : ['className' => TimeZonesTable::class];
        $this->TimeZones = TableRegistry::getTableLocator()->get('TimeZones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TimeZones);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
