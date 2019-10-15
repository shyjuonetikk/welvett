<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomerReviewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomerReviewsTable Test Case
 */
class CustomerReviewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomerReviewsTable
     */
    public $CustomerReviews;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.customer_reviews',
        'app.customers',
        'app.talent_events',
        'app.talents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CustomerReviews') ? [] : ['className' => CustomerReviewsTable::class];
        $this->CustomerReviews = TableRegistry::get('CustomerReviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomerReviews);

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
