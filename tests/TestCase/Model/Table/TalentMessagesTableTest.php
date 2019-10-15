<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TalentMessagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TalentMessagesTable Test Case
 */
class TalentMessagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TalentMessagesTable
     */
    public $TalentMessages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.talent_messages',
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
        'app.customer_reviews',
        'app.talent_calendars',
        'app.talent_event_cities',
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
        'app.companies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TalentMessages') ? [] : ['className' => TalentMessagesTable::class];
        $this->TalentMessages = TableRegistry::get('TalentMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TalentMessages);

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
