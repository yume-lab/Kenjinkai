<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\SecurityUtilComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\SecurityUtilComponent Test Case
 */
class SecurityUtilComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\SecurityUtilComponent
     */
    public $SecurityUtil;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->SecurityUtil = new SecurityUtilComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SecurityUtil);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
