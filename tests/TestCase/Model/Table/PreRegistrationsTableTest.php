<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreRegistrationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PreRegistrationsTable Test Case
 */
class PreRegistrationsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pre_registrations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PreRegistrations') ? [] : ['className' => 'App\Model\Table\PreRegistrationsTable'];
        $this->PreRegistrations = TableRegistry::get('PreRegistrations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PreRegistrations);

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

    /**
     * Test write method
     *
     * @return void
     */
    public function testWrite()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
