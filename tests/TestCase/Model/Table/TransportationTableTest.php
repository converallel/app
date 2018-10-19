<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransportationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransportationTable Test Case
 */
class TransportationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TransportationTable
     */
    public $Transportation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.transportation'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Transportation') ? [] : ['className' => TransportationTable::class];
        $this->Transportation = TableRegistry::getTableLocator()->get('Transportation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Transportation);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
