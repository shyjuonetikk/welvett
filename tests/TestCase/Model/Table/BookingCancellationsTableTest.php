<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookingCancellationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookingCancellationsTable Test Case
 */
class BookingCancellationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BookingCancellationsTable
     */
    public $BookingCancellations;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BookingCancellations') ? [] : ['className' => BookingCancellationsTable::class];
        $this->BookingCancellations = TableRegistry::get('BookingCancellations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BookingCancellations);

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
