<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityItinerariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityItinerariesTable Test Case
 */
class ActivityItinerariesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityItinerariesTable
     */
    public $ActivityItineraries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activity_itineraries',
        'app.activities',
        'app.locations',
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
        $config = TableRegistry::getTableLocator()->exists('ActivityItineraries') ? [] : ['className' => ActivityItinerariesTable::class];
        $this->ActivityItineraries = TableRegistry::getTableLocator()->get('ActivityItineraries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityItineraries);

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
