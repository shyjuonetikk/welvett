<?php
namespace App\Test\TestCase\Controller;

use App\Controller\BookingCancellationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\BookingCancellationsController Test Case
 */
class BookingCancellationsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.booking_cancellations',
        'app.users',
        'app.roles',
        'app.bookings',
        'app.routes',
        'app.buses',
        'app.bus_seat_assigns',
        'app.seats',
        'app.busstatus',
        'app.departure_cities',
        'app.arrival_cities',
        'app.departure_terminals',
        'app.arrival_terminals',
        'app.sightseeing_payments',
        'app.sightseeings',
        'app.payments',
        'app.tour_payments',
        'app.tours',
        'app.transactions',
        'app.cities',
        'app.logs',
        'app.terminals',
        'app.customers'
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
