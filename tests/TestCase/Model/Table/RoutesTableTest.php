<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoutesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoutesTable Test Case
 */
class RoutesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoutesTable
     */
    public $Routes;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Routes') ? [] : ['className' => RoutesTable::class];
        $this->Routes = TableRegistry::get('Routes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Routes);

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
