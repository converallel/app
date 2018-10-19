<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SearchTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SearchTypesTable Test Case
 */
class SearchTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SearchTypesTable
     */
    public $SearchTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.search_types',
        'app.search_histories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SearchTypes') ? [] : ['className' => SearchTypesTable::class];
        $this->SearchTypes = TableRegistry::getTableLocator()->get('SearchTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SearchTypes);

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
