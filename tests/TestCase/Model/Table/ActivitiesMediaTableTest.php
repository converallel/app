<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivitiesMediaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivitiesMediaTable Test Case
 */
class ActivitiesMediaTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivitiesMediaTable
     */
    public $ActivitiesMedia;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activities_media',
        'app.activities',
        'app.media'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivitiesMedia') ? [] : ['className' => ActivitiesMediaTable::class];
        $this->ActivitiesMedia = TableRegistry::getTableLocator()->get('ActivitiesMedia', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivitiesMedia);

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
