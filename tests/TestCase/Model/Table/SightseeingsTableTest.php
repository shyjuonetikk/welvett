<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SightseeingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SightseeingsTable Test Case
 */
class SightseeingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SightseeingsTable
     */
    public $Sightseeings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sightseeings',
        'app.users',
        'app.roles',
        'app.booking_cancellations',
        'app.bookings',
        'app.bus_seat_assigns',
        'app.buses',
        'app.busstatus',
        'app.routes',
        'app.seats',
        'app.cities',
        'app.logs',
        'app.payments',
        'app.sightseeing_payments',
        'app.tour_payments',
        'app.tours',
        'app.transactions',
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
        $config = TableRegistry::exists('Sightseeings') ? [] : ['className' => SightseeingsTable::class];
        $this->Sightseeings = TableRegistry::get('Sightseeings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sightseeings);

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
