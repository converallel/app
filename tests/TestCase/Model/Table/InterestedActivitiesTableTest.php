<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InterestedActivitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InterestedActivitiesTable Test Case
 */
class InterestedActivitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InterestedActivitiesTable
     */
    public $InterestedActivities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.interested_activities',
        'app.users',
        'app.activities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('InterestedActivities') ? [] : ['className' => InterestedActivitiesTable::class];
        $this->InterestedActivities = TableRegistry::getTableLocator()->get('InterestedActivities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InterestedActivities);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
