<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TourPaymentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TourPaymentsTable Test Case
 */
class TourPaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TourPaymentsTable
     */
    public $TourPayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tour_payments',
        'app.tours',
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
        'app.sightseeing_payments',
        'app.sightseeings',
        'app.payments',
        'app.transactions',
        'app.cities',
        'app.logs',
        'app.terminals'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TourPayments') ? [] : ['className' => TourPaymentsTable::class];
        $this->TourPayments = TableRegistry::get('TourPayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TourPayments);

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
