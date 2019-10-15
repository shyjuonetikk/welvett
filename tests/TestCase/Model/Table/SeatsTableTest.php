<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeatsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeatsTable Test Case
 */
class SeatsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SeatsTable
     */
    public $Seats;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.seats',
        'app.users',
        'app.roles',
        'app.booking_cancellations',
        'app.bookings',
        'app.bus_seat_assigns',
        'app.buses',
        'app.busstatus',
        'app.cities',
        'app.logs',
        'app.payments',
        'app.sightseeing_payments',
        'app.tour_payments',
        'app.routes',
        'app.sightseeings',
        'app.terminals',
        'app.tours'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Seats') ? [] : ['className' => SeatsTable::class];
        $this->Seats = TableRegistry::get('Seats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Seats);

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
