<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventcategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventcategoriesTable Test Case
 */
class EventcategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventcategoriesTable
     */
    public $Eventcategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.eventcategories',
        'app.users',
        'app.roles',
        'app.rights',
        'app.modules',
        'app.booking_cancellations',
        'app.customers',
        'app.routes',
        'app.bookings',
        'app.routeterminals',
        'app.payments',
        'app.sightseeing_payments',
        'app.tour_payments',
        'app.bus_seat_assigns',
        'app.buses',
        'app.busstatus',
        'app.cities',
        'app.departure_cities',
        'app.arrival_cities',
        'app.states',
        'app.terminals',
        'app.logs',
        'app.seats',
        'app.sightseeings',
        'app.tours',
        'app.usercompanies',
        'app.companies',
        'app.employee_members',
        'app.eventsubcategories',
        'app.talent_event_cities',
        'app.talent_event_subcategories',
        'app.talent_events'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Eventcategories') ? [] : ['className' => EventcategoriesTable::class];
        $this->Eventcategories = TableRegistry::get('Eventcategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Eventcategories);

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
