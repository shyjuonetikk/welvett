<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DancesTable Test Case
 */
class DancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DancesTable
     */
    public $Dances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dances',
        'app.schedules'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dances') ? [] : ['className' => DancesTable::class];
        $this->Dances = TableRegistry::get('Dances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dances);

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
}
