<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CompaniesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CompaniesController Test Case
 */
class CompaniesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.companies',
        'app.users',
        'app.roles',
        'app.rights',
        'app.modules',
        'app.booking_cancellations',
        'app.customers',
        'app.routes',
        'app.buses',
        'app.bus_seat_assigns',
        'app.seats',
        'app.busstatus',
        'app.departure_cities',
        'app.arrival_cities',
        'app.departure_terminals',
        'app.arrival_terminals',
        'app.bookings',
        'app.payments',
        'app.sightseeing_payments',
        'app.sightseeings',
        'app.transactions',
        'app.tour_payments',
        'app.tours',
        'app.routerminals',
        'app.routeterminalprices',
        'app.routeterminals',
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
