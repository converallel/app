<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PersonalityCompatibilityLevelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PersonalityCompatibilityLevelsTable Test Case
 */
class PersonalityCompatibilityLevelsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PersonalityCompatibilityLevelsTable
     */
    public $PersonalityCompatibilityLevels;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('PersonalityCompatibilityLevels') ? [] : ['className' => PersonalityCompatibilityLevelsTable::class];
        $this->PersonalityCompatibilityLevels = TableRegistry::getTableLocator()->get('PersonalityCompatibilityLevels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PersonalityCompatibilityLevels);

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
}
