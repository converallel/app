<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users',
        'app.locations',
        'app.personalities',
        'app.education',
        'app.activity_filter_education',
        'app.activity_filters',
        'app.applications',
        'app.contacts',
        'app.devices',
        'app.files',
        'app.location_selection_histories',
        'app.logs',
        'app.media',
        'app.reviews',
        'app.search_histories',
        'app.user_logins',
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
        $config = TableRegistry::getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = TableRegistry::getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

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

    /**
     * Test findMinimumInformation method
     *
     * @return void
     */
    public function testFindMinimumInformation()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findBasicInformation method
     *
     * @return void
     */
    public function testFindBasicInformation()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
