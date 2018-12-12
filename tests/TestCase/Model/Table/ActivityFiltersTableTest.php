<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityFiltersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityFiltersTable Test Case
 */
class ActivityFiltersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityFiltersTable
     */
    public $ActivityFilters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ActivityFilters',
        'app.Locations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivityFilters') ? [] : ['className' => ActivityFiltersTable::class];
        $this->ActivityFilters = TableRegistry::getTableLocator()->get('ActivityFilters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityFilters);

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
