<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityTagsTable Test Case
 */
class ActivityTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityTagsTable
     */
    public $ActivityTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activity_tags',
        'app.activities',
        'app.tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivityTags') ? [] : ['className' => ActivityTagsTable::class];
        $this->ActivityTags = TableRegistry::getTableLocator()->get('ActivityTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityTags);

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
