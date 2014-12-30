<?php

namespace Gourmet\KnpMenu\Menu;

use ArrayObject;

trait MenuTrait
{

    protected $_factory;
    protected $_menus;

    public function get($name, array $options = [])
    {
        if (empty($this->_factory)) {
            $this->_factory = new MenuFactory();
        }

        if (empty($this->_menus[$name])) {
            $this->_menus[$name] = $this->_factory->createItem($name, $options);
        }

        return $this->_menus[$name];
    }

    public function instantiate()
    {
        if (empty($this->_menus) && !is_object($this->_menus)) {
            $this->_menus = new ArrayObject();
        }
    }
}
