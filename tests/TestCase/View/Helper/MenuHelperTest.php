<?php

namespace Gourmet\KnpMenu\Test\TestCase\View\Helper;

use ArrayObject;
use Cake\Network\Request;
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
    }

    public function buildMenu()
    {
        $menu = $this->Menu->get('my_menu');
        $menu->addChild('foo', [
            'uri' => ['controller' => 'Pages', 'action' => 'display', 'home'],
            'label' => 'Home'
        ]);
        $menu->addChild('bar', [
            'route' => 'some'
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
            ['li' => ['class' => 'last']],
            ['a' => ['href' => '/some_alias']],
            'bar',
            '/a',
            ['/li' => []],
            '/ul'
        ];
        $this->assertHtml($expected, $result);
    }
}
