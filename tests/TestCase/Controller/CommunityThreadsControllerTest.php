<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CommunityThreadsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CommunityThreadsController Test Case
 */
class CommunityThreadsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
