<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilterEducationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilterEducationTable Test Case
 */
class FilterEducationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FilterEducationTable
     */
    public $FilterEducation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.filter_education',
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
        $config = TableRegistry::getTableLocator()->exists('FilterEducation') ? [] : ['className' => FilterEducationTable::class];
        $this->FilterEducation = TableRegistry::getTableLocator()->get('FilterEducation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FilterEducation);

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
