<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivitiesUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivitiesUsersTable Test Case
 */
class ActivitiesUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivitiesUsersTable
     */
    public $ActivitiesUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ActivitiesUsers',
        'app.Activities',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivitiesUsers') ? [] : ['className' => ActivitiesUsersTable::class];
        $this->ActivitiesUsers = TableRegistry::getTableLocator()->get('ActivitiesUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivitiesUsers);

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
