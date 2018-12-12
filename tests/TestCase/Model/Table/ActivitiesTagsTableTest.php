<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivitiesTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivitiesTagsTable Test Case
 */
class ActivitiesTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivitiesTagsTable
     */
    public $ActivitiesTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ActivitiesTags',
        'app.Activities',
        'app.Tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivitiesTags') ? [] : ['className' => ActivitiesTagsTable::class];
        $this->ActivitiesTags = TableRegistry::getTableLocator()->get('ActivitiesTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivitiesTags);

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
