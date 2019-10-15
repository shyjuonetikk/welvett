<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectsPaymentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectsPaymentsTable Test Case
 */
class ProjectsPaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectsPaymentsTable
     */
    public $ProjectsPayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projects_payments',
        'app.projects',
        'app.users',
        'app.developer_projects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProjectsPayments') ? [] : ['className' => ProjectsPaymentsTable::class];
        $this->ProjectsPayments = TableRegistry::get('ProjectsPayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectsPayments);

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
