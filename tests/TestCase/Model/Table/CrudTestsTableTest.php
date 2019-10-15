<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CrudTestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CrudTestsTable Test Case
 */
class CrudTestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CrudTestsTable
     */
    public $CrudTests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.crud_tests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CrudTests') ? [] : ['className' => CrudTestsTable::class];
        $this->CrudTests = TableRegistry::get('CrudTests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CrudTests);

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
