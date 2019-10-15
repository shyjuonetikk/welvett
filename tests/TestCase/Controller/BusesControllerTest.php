<?php
namespace App\Test\TestCase\Controller;

use App\Controller\BusesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\BusesController Test Case
 */
class BusesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.buses',
        'app.users',
        'app.roles',
        'app.booking_cancellations',
        'app.bookings',
        'app.bus_seat_assigns',
        'app.busstatus',
        'app.cities',
        'app.logs',
        'app.payments',
        'app.sightseeing_payments',
        'app.tour_payments',
        'app.routes',
        'app.seats',
        'app.sightseeings',
        'app.terminals',
        'app.tours'
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
