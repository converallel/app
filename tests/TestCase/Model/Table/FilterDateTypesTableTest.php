<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilterDateTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilterDateTypesTable Test Case
 */
class FilterDateTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FilterDateTypesTable
     */
    public $FilterDateTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.filter_date_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FilterDateTypes') ? [] : ['className' => FilterDateTypesTable::class];
        $this->FilterDateTypes = TableRegistry::getTableLocator()->get('FilterDateTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FilterDateTypes);

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
