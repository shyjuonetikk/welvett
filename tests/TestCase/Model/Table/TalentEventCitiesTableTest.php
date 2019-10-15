<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TalentEventCitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TalentEventCitiesTable Test Case
 */
class TalentEventCitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TalentEventCitiesTable
     */
    public $TalentEventCities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.talent_event_cities',
        'app.talent_events',
        'app.eventcategories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TalentEventCities') ? [] : ['className' => TalentEventCitiesTable::class];
        $this->TalentEventCities = TableRegistry::get('TalentEventCities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TalentEventCities);

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
