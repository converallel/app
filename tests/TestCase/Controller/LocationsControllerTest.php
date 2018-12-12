<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LocationsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\LocationsController Test Case
 */
class LocationsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Locations',
        'app.Activities',
        'app.ActivityFilters',
        'app.ActivityItineraries',
        'app.LocationSelectionHistories',
        'app.Users'
    ];

    /**
     * Test lookup method
     *
     * @return void
     */
    public function testLookup()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
