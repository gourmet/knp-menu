<?php

namespace Gourmet\KnpMenu\View\Helper;

use Cake\Event\Event;
use Cake\View\Helper;
use Gourmet\KnpMenu\MenuTrait;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Renderer\ListRenderer;

class MenuHelper extends Helper
{

    use MenuTrait;

    public function beforeRender(Event $event)
    {
        if (!empty($this->_View->viewVars['_knp_menus_'])) {
            $this->_menus = $this->_View->viewVars['_knp_menus_'];
        }
    }

    public function render($name, $options = [])
    {
        $options += [
            'matcher' => '\Knp\Menu\Matcher\Matcher',
            'renderer' => '\Gourmet\KnpMenu\Renderer\ListRenderer',
        ];

        if (empty($this->_menus[$name])) {
            throw new \RuntimeException('undefined menu');
        }

        foreach (['matcher', 'renderer'] as $k) {
            $$k = $options[$k];
            unset($options[$k]);
        }

        if (!is_object($matcher)) {
            $matcher = new $matcher;
        }

        if (!is_object($renderer)) {
            $renderer = new $renderer($matcher);
        }

        return $renderer->render($this->_menus[$name], $options);
    }
}
