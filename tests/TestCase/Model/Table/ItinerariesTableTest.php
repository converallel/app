<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItinerariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItinerariesTable Test Case
 */
class ItinerariesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItinerariesTable
     */
    public $Itineraries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.itineraries',
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
        $config = TableRegistry::getTableLocator()->exists('Itineraries') ? [] : ['className' => ItinerariesTable::class];
        $this->Itineraries = TableRegistry::getTableLocator()->get('Itineraries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Itineraries);

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
