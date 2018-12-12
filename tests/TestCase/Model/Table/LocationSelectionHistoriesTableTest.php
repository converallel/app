<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LocationSelectionHistoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LocationSelectionHistoriesTable Test Case
 */
class LocationSelectionHistoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LocationSelectionHistoriesTable
     */
    public $LocationSelectionHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LocationSelectionHistories',
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('LocationSelectionHistories') ? [] : ['className' => LocationSelectionHistoriesTable::class];
        $this->LocationSelectionHistories = TableRegistry::getTableLocator()->get('LocationSelectionHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LocationSelectionHistories);

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
