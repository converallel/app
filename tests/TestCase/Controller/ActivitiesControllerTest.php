<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ActivitiesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ActivitiesController Test Case
 */
class ActivitiesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Activities',
        'app.Locations',
        'app.Admin',
        'app.ActivityItineraries',
        'app.Applications',
        'app.Reviews',
        'app.Media',
        'app.Tags',
        'app.Followers',
        'app.Organizers',
        'app.Participants',
        'app.Users'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
