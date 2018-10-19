<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimezonesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimezonesTable Test Case
 */
class TimezonesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimezonesTable
     */
    public $Timezones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.timezones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Timezones') ? [] : ['className' => TimezonesTable::class];
        $this->Timezones = TableRegistry::getTableLocator()->get('Timezones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Timezones);

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
