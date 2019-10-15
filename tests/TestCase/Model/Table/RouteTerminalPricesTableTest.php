<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RouteterminalpricesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RouteterminalpricesTable Test Case
 */
class RouteterminalpricesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RouteterminalpricesTable
     */
    public $Routeterminalprices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.routeterminalprices',
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
        $config = TableRegistry::exists('Routeterminalprices') ? [] : ['className' => RouteterminalpricesTable::class];
        $this->Routeterminalprices = TableRegistry::get('Routeterminalprices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Routeterminalprices);

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
