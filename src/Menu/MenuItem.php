<?php

namespace Gourmet\KnpMenu\Menu;

use Cake\Routing\Router;
use Knp\Menu\MenuItem as KnpMenuItem;

class MenuItem extends KnpMenuItem
{

    public function setUri($uri)
    {
        if (is_array($uri)) {
            $uri = Router::url($uri);
        }
        return parent::setUri($uri);
    }

    public function addChild($child, array $options = [])
    {
        if (!empty($options['route'])) {
            $options['uri'] = ['_name' => $options['route']];
            unset($options['route']);
        }
        return parent::addChild($child, $options);
    }
}
