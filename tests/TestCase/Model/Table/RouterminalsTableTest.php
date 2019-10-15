<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RouterminalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RouterminalsTable Test Case
 */
class RouterminalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RouterminalsTable
     */
    public $Routerminals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.routerminals',
        'app.buses',
        'app.users',
        'app.roles',
        'app.booking_cancellations',
        'app.customers',
        'app.routes',
        'app.departure_cities',
        'app.arrival_cities',
        'app.bookings',
        'app.payments',
        'app.sightseeing_payments',
        'app.sightseeings',
        'app.transactions',
        'app.tour_payments',
        'app.tours',
        'app.routeterminals',
        'app.departure_terminals',
        'app.arrival_terminals',
        'app.bus_seat_assigns',
        'app.seats',
        'app.busstatus',
        'app.cities',
        'app.terminals',
        'app.logs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Routerminals') ? [] : ['className' => RouterminalsTable::class];
        $this->Routerminals = TableRegistry::get('Routerminals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Routerminals);

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
