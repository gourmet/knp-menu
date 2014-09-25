<?php

namespace Gourmet\KnpMenu\Controller\Component;

trait MenuTrait {

	protected $_factory;
	protected $_menus = [];

	public function get($name) {
		if (empty($this->_factory)) {
			$this->_factory = new MenuFactory();
		}

		if (empty($this->_menus[$name])) {
			$this->_menus[$name] = $this->_factory->createItem($name);
		}

		return $this->_menus[$name];
	}

}
