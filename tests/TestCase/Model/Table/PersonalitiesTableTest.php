<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PersonalitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PersonalitiesTable Test Case
 */
class PersonalitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PersonalitiesTable
     */
    public $Personalities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Personalities',
        'app.PersonalityCompatibility',
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
        $config = TableRegistry::getTableLocator()->exists('Personalities') ? [] : ['className' => PersonalitiesTable::class];
        $this->Personalities = TableRegistry::getTableLocator()->get('Personalities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Personalities);

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
