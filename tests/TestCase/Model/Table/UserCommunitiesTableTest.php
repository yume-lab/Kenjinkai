<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserCommunitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserCommunitiesTable Test Case
 */
class UserCommunitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserCommunitiesTable
     */
    public $UserCommunities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_communities',
        'app.users',
        'app.user_hometowns',
        'app.user_profiles',
        'app.user_hobbies',
        'app.communities',
        'app.review_communities',
        'app.community_settings',
        'app.community_images',
        'app.community_statuses',
        'app.city_address',
        'app.home_city_address',
        'app.community_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserCommunities') ? [] : ['className' => 'App\Model\Table\UserCommunitiesTable'];
        $this->UserCommunities = TableRegistry::get('UserCommunities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserCommunities);

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
