<?php

namespace Gourmet\KnpMenu\View\Helper;

use Cake\Event\Event;
use Cake\View\Helper;
use Gourmet\KnpMenu\Menu\Matcher\Matcher;
use Gourmet\KnpMenu\Menu\MenuTrait;

class MenuHelper extends Helper
{

    use MenuTrait;

    public function beforeRender(Event $event)
    {
        if (!empty($this->_View->viewVars['_knp_menus_'])) {
            $this->_menus = $this->_View->viewVars['_knp_menus_'];
        }

        $this->instantiate();
    }

    public function render($name, $options = [])
    {
        $options += [
            'matcher' => new Matcher($this->request),
            'renderer' => '\Gourmet\KnpMenu\Menu\Renderer\ListRenderer',
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
