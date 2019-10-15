<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SightseeingPaymentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SightseeingPaymentsTable Test Case
 */
class SightseeingPaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SightseeingPaymentsTable
     */
    public $SightseeingPayments;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SightseeingPayments') ? [] : ['className' => SightseeingPaymentsTable::class];
        $this->SightseeingPayments = TableRegistry::get('SightseeingPayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SightseeingPayments);

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
