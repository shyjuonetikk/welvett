<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CorporateMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CorporateMembersTable Test Case
 */
class CorporateMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CorporateMembersTable
     */
    public $CorporateMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.corporate_members',
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
        $config = TableRegistry::exists('CorporateMembers') ? [] : ['className' => CorporateMembersTable::class];
        $this->CorporateMembers = TableRegistry::get('CorporateMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CorporateMembers);

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
