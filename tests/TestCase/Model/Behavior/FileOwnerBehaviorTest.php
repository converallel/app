<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\FileOwnerBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\FileOwnerBehavior Test Case
 */
class FileOwnerBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\FileOwnerBehavior
     */
    public $FileOwner;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->FileOwner = new FileOwnerBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FileOwner);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
