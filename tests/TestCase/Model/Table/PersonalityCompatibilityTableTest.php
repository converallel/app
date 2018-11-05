<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PersonalityCompatibilityTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PersonalityCompatibilityTable Test Case
 */
class PersonalityCompatibilityTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PersonalityCompatibilityTable
     */
    public $PersonalityCompatibility;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.personality_compatibility',
        'app.personalities',
        'app.personality_compatibility_levels'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PersonalityCompatibility') ? [] : ['className' => PersonalityCompatibilityTable::class];
        $this->PersonalityCompatibility = TableRegistry::getTableLocator()->get('PersonalityCompatibility', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PersonalityCompatibility);

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
