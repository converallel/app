<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityFilterEducationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityFilterEducationTable Test Case
 */
class ActivityFilterEducationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityFilterEducationTable
     */
    public $ActivityFilterEducation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activity_filter_education',
        'app.users',
        'app.education'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivityFilterEducation') ? [] : ['className' => ActivityFilterEducationTable::class];
        $this->ActivityFilterEducation = TableRegistry::getTableLocator()->get('ActivityFilterEducation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityFilterEducation);

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
