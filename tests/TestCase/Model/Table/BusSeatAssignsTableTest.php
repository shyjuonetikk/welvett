<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BusseatassignsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BusseatassignsTable Test Case
 */
class BusseatassignsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BusseatassignsTable
     */
    public $Busseatassigns;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.busseatassigns',
        'app.buses',
        'app.users',
        'app.roles',
        'app.booking_cancellations',
        'app.customers',
        'app.routes',
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
        'app.bus_seat_assigns',
        'app.seats',
        'app.busstatus',
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
        $config = TableRegistry::exists('Busseatassigns') ? [] : ['className' => BusseatassignsTable::class];
        $this->Busseatassigns = TableRegistry::get('Busseatassigns', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Busseatassigns);

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
