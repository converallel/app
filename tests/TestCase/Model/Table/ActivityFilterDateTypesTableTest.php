<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityFilterDateTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityFilterDateTypesTable Test Case
 */
class ActivityFilterDateTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityFilterDateTypesTable
     */
    public $ActivityFilterDateTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activity_filter_date_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivityFilterDateTypes') ? [] : ['className' => ActivityFilterDateTypesTable::class];
        $this->ActivityFilterDateTypes = TableRegistry::getTableLocator()->get('ActivityFilterDateTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityFilterDateTypes);

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
