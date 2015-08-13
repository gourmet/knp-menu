<?php

namespace Gourmet\KnpMenu\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Request;
use Cake\TestSuite\TestCase;
use Gourmet\KnpMenu\Controller\Component\MenuComponent;
use TestApp\Controller\Admin\PostsController;

class MenuComponentTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        Configure::write('App.namespace', 'TestApp');
        $this->Controller = new PostsController(new Request());
        $this->Controller->loadComponent('Gourmet/KnpMenu.Menu');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Controller, $this->ComponentRegistry, $this->Menu);
    }

    public function testSetMenuArrayObjectViewVar()
    {
        $this->Controller->render('index');
        $this->assertArrayHasKey('_knp_menus_', $this->Controller->getView()->viewVars);
    }
}
