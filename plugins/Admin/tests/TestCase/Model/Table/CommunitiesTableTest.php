<?php
namespace Admin\Test\TestCase\Model\Table;

use Admin\Model\Table\CommunitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Admin\Model\Table\CommunitiesTable Test Case
 */
class CommunitiesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.admin.communities',
        'plugin.admin.community_statuses',
        'plugin.admin.review_communities',
        'plugin.admin.users',
        'plugin.admin.countries',
        'plugin.admin.kens',
        'plugin.admin.cities',
        'plugin.admin.hometown_countries',
        'plugin.admin.hometown_kens',
        'plugin.admin.hometown_cities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Communities') ? [] : ['className' => 'Admin\Model\Table\CommunitiesTable'];
        $this->Communities = TableRegistry::get('Communities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Communities);

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
