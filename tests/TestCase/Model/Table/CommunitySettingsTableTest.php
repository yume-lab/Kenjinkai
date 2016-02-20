<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunitySettingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunitySettingsTable Test Case
 */
class CommunitySettingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommunitySettingsTable
     */
    public $CommunitySettings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.community_settings',
        'app.communities',
        'app.review_communities',
        'app.users',
        'app.user_hometowns',
        'app.user_profiles',
        'app.user_hobbies',
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
        $config = TableRegistry::exists('CommunitySettings') ? [] : ['className' => 'App\Model\Table\CommunitySettingsTable'];
        $this->CommunitySettings = TableRegistry::get('CommunitySettings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommunitySettings);

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
