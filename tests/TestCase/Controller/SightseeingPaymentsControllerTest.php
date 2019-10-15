<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SightseeingPaymentsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SightseeingPaymentsController Test Case
 */
class SightseeingPaymentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sightseeing_payments',
        'app.sightseeings',
        'app.users',
        'app.roles',
        'app.booking_cancellations',
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
        'app.tour_payments',
        'app.tours',
        'app.payments',
        'app.transactions',
        'app.cities',
        'app.logs',
        'app.terminals'
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
