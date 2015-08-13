<?php

namespace Gourmet\KnpMenu\Test\TestCase\View\Helper;

use ArrayObject;
use Cake\Network\Request;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\View\View;
use Gourmet\KnpMenu\View\Helper\MenuHelper;

class MenuHelperTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->View = new View();
        $this->View->set('_knp_menus_', new ArrayObject());
        $this->View->request = new Request(['url' => '/']);
        $this->Menu = new MenuHelper($this->View);

        Router::scope('/knp_menu/', function ($routes) {
           $routes->connect('/', ['controller' => 'tests_apps', 'action' => 'some_other_method'], ['_name' => 'some_alias']);
        });
//        Router::connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
//        Router::connect('/some_alias', ['controller' => 'tests_apps', 'action' => 'some_method'], ['_name' => 'bar']);
    }

    public function buildMenu()
    {
        $menu = $this->Menu->get('my_menu');
        $menu->addChild('foo', [
            'uri' => ['controller' => 'pages', 'action' => 'display', 'home'],
            'label' => 'Home'
        ]);
        $menu->addChild('some_alias', [
            'uri' => ['controller' => 'tests_apps', 'action' => 'some_method'],
        ]);
        $menu->addChild('named_some_alias', [
            'route' => 'some_alias',
        ]);
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->View, $this->Menu);
    }

    public function testRender()
    {
        $this->buildMenu();

        $result = $this->Menu->render('my_menu');
        $expected = [
            'ul' => [],
            ['li' => ['class' => 'current first']],
            ['a' => ['href' => '/']],
            'Home',
            '/a',
            ['/li' => []],
            ['li' => []],
            ['a' => ['href' => '/some_alias']],
            'some_alias',
            '/a',
            ['/li' => []],
            ['li' => ['class' => 'last']],
            ['a' => ['href' => '/knp_menu']],
            'named_some_alias',
            '/a',
            ['/li' => []],
            '/ul'
        ];
        $this->assertHtml($expected, $result);
    }
}
