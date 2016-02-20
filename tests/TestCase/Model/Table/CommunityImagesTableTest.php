<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunityImagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunityImagesTable Test Case
 */
class CommunityImagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommunityImagesTable
     */
    public $CommunityImages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.community_images',
        'app.communities',
        'app.review_communities',
        'app.users',
        'app.user_hometowns',
        'app.user_profiles',
        'app.user_hobbies',
        'app.community_settings',
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
        $config = TableRegistry::exists('CommunityImages') ? [] : ['className' => 'App\Model\Table\CommunityImagesTable'];
        $this->CommunityImages = TableRegistry::get('CommunityImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommunityImages);

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
