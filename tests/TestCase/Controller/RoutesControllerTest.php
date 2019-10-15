<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RoutesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\RoutesController Test Case
 */
class RoutesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.routes',
        'app.buses',
        'app.users',
        'app.roles',
        'app.booking_cancellations',
        'app.customers',
        'app.bookings',
        'app.payments',
        'app.sightseeing_payments',
        'app.sightseeings',
        'app.transactions',
        'app.tour_payments',
        'app.tours',
        'app.bus_seat_assigns',
        'app.seats',
        'app.busstatus',
        'app.cities',
        'app.terminals',
        'app.logs',
        'app.departure_cities',
        'app.arrival_cities',
        'app.route_terminals',
        'app.departure_terminals',
        'app.arrival_terminals'
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
