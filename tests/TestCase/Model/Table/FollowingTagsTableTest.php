<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FollowingTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FollowingTagsTable Test Case
 */
class FollowingTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FollowingTagsTable
     */
    public $FollowingTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.following_tags',
        'app.users',
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
        $config = TableRegistry::getTableLocator()->exists('FollowingTags') ? [] : ['className' => FollowingTagsTable::class];
        $this->FollowingTags = TableRegistry::getTableLocator()->get('FollowingTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FollowingTags);

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
