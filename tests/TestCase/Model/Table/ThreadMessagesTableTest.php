<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ThreadMessagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ThreadMessagesTable Test Case
 */
class ThreadMessagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ThreadMessagesTable
     */
    public $ThreadMessages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.thread_messages',
        'app.threads',
        'app.users',
        'app.user_hometowns',
        'app.user_profiles',
        'app.user_hobbies',
        'app.user_images'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ThreadMessages') ? [] : ['className' => 'App\Model\Table\ThreadMessagesTable'];
        $this->ThreadMessages = TableRegistry::get('ThreadMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ThreadMessages);

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
