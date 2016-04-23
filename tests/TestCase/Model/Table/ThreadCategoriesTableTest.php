<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ThreadCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ThreadCategoriesTable Test Case
 */
class ThreadCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ThreadCategoriesTable
     */
    public $ThreadCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.thread_categories',
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
        $config = TableRegistry::exists('ThreadCategories') ? [] : ['className' => 'App\Model\Table\ThreadCategoriesTable'];
        $this->ThreadCategories = TableRegistry::get('ThreadCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ThreadCategories);

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
