<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ImagesComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ImagesComponent Test Case
 */
class ImagesComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ImagesComponent
     */
    public $Images;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Images = new ImagesComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Images);

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
