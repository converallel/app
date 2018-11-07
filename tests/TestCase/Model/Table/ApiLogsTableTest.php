<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApiLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApiLogsTable Test Case
 */
class ApiLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApiLogsTable
     */
    public $ApiLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.api_logs',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ApiLogs') ? [] : ['className' => ApiLogsTable::class];
        $this->ApiLogs = TableRegistry::getTableLocator()->get('ApiLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApiLogs);

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
