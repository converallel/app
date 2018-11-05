<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ActivitiesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ActivitiesController Test Case
 */
class ActivitiesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activities',
        'app.locations',
        'app.organizer',
        'app.activity_statuses',
        'app.activity_itineraries',
        'app.applications',
        'app.reviews',
        'app.tags',
        'app.followers',
        'app.organizers',
        'app.participants'
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

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
