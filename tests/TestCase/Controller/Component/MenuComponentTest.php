<?php

namespace Gourmet\KnpMenu\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Request;
use Cake\TestSuite\TestCase;
use Gourmet\KnpMenu\Controller\Component\MenuComponent;

class MenuComponentTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        Configure::write('App.namespace', 'TestApp');
        $this->Controller = new Controller(new Request());
        $this->ComponentRegistry = new ComponentRegistry($this->Controller);
        $this->Menu = new MenuComponent($this->ComponentRegistry);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Controller, $this->ComponentRegistry, $this->Menu);
    }

    public function testSetMenuArrayObjectViewVar()
    {
        $event = new Event('test', $this->Controller);
        $this->Menu->beforeFilter($event);
        $this->Menu->beforeRender($event);
        $result = $this->Controller->viewVars;
        $this->assertTrue(array_key_exists('_knp_menus_', $result));
        $this->assertInstanceOf('ArrayObject', $result['_knp_menus_']);
    }
}
