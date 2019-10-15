<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MembershipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MembershipsTable Test Case
 */
class MembershipsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MembershipsTable
     */
    public $Memberships;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.memberships',
        'app.users',
        'app.roles',
        'app.rights',
        'app.modules',
        'app.booking_cancellations',
        'app.customers',
        'app.routes',
        'app.bookings',
        'app.talents',
        'app.talent_events',
        'app.eventcategories',
        'app.employee_members',
        'app.eventsubcategories',
        'app.talent_event_subcategories',
        'app.talent_event_cities',
        'app.customer_reviews',
        'app.talent_calendars',
        'app.talent_messages',
        'app.talent_reviews',
        'app.talent_calendar',
        'app.bus_seat_assigns',
        'app.buses',
        'app.busstatus',
        'app.cities',
        'app.departure_cities',
        'app.arrival_cities',
        'app.states',
        'app.terminals',
        'app.logs',
        'app.payments',
        'app.sightseeing_payments',
        'app.tour_payments',
        'app.seats',
        'app.sightseeings',
        'app.tours',
        'app.usercompanies',
        'app.companies',
        'app.corporate_members'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Memberships') ? [] : ['className' => MembershipsTable::class];
        $this->Memberships = TableRegistry::get('Memberships', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Memberships);

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
