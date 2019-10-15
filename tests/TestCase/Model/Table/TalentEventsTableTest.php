<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TalentEventsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TalentEventsTable Test Case
 */
class TalentEventsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TalentEventsTable
     */
    public $TalentEvents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.talent_events',
        'app.users',
        'app.roles',
        'app.rights',
        'app.modules',
        'app.booking_cancellations',
        'app.customers',
        'app.routes',
        'app.bookings',
        'app.talents',
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
        'app.eventcategories',
        'app.customer_reviews',
        'app.talent_calendars',
        'app.talent_event_cities',
        'app.talent_messages',
        'app.talent_reviews'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TalentEvents') ? [] : ['className' => TalentEventsTable::class];
        $this->TalentEvents = TableRegistry::get('TalentEvents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TalentEvents);

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
