<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunitiesTable Test Case
 */
class CommunitiesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.communities',
        'app.community_statuses',
        'app.review_communities',
        'app.users',
        'app.user_hometowns',
        'app.user_profiles',
        'app.user_hobbies',
        'app.countries',
        'app.kens',
        'app.cities',
        'app.hometown_countries',
        'app.hometown_kens',
        'app.hometown_cities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Communities') ? [] : ['className' => 'App\Model\Table\CommunitiesTable'];
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
