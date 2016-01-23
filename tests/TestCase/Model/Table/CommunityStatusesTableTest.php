<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommunityStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommunityStatusesTable Test Case
 */
class CommunityStatusesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.community_statuses',
        'app.review_communities',
        'app.users',
        'app.user_hometowns',
        'app.user_profiles',
        'app.user_hobbies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CommunityStatuses') ? [] : ['className' => 'App\Model\Table\CommunityStatusesTable'];
        $this->CommunityStatuses = TableRegistry::get('CommunityStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CommunityStatuses);

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
