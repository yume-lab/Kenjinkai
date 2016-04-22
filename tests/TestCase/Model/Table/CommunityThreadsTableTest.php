<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunityThreadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunityThreadsTable Test Case
 */
class CommunityThreadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommunityThreadsTable
     */
    public $CommunityThreads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.community_threads',
        'app.communities',
        'app.community_settings',
        'app.community_images',
        'app.review_communities',
        'app.users',
        'app.user_hometowns',
        'app.user_profiles',
        'app.user_hobbies',
        'app.user_images',
        'app.community_statuses',
        'app.city_address',
        'app.home_city_address'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CommunityThreads') ? [] : ['className' => 'App\Model\Table\CommunityThreadsTable'];
        $this->CommunityThreads = TableRegistry::get('CommunityThreads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommunityThreads);

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
