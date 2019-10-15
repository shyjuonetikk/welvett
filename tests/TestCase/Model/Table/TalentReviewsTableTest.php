<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TalentReviewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TalentReviewsTable Test Case
 */
class TalentReviewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TalentReviewsTable
     */
    public $TalentReviews;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.talent_reviews',
        'app.talents',
        'app.talent_events',
        'app.users',
        'app.roles',
        'app.rights',
        'app.modules',
        'app.booking_cancellations',
        'app.customers',
        'app.routes',
        'app.bookings',
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
        'app.talent_messages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TalentReviews') ? [] : ['className' => TalentReviewsTable::class];
        $this->TalentReviews = TableRegistry::get('TalentReviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TalentReviews);

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
