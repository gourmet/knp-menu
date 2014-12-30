<?php
// TODO PR https://github.com/KnpLabs/KnpMenu/pull/175 - no time for it now, keeping
//    current implementation
//
// --- THIS IS THE USE CASE IT SOLVES ---
//
// an almost exact copy of MenuFactory only to use a custom MenuItem (problem not just
// in privates, should be able to pass the class to use for creating menu items).

namespace Gourmet\KnpMenu\Menu;

use Knp\Menu\MenuFactory as KnpMenuFactory;
use Knp\Menu\Factory\ExtensionInterface;

class MenuFactory extends KnpMenuFactory
{

    private $extensions = [];
    private $sorted;

    public function createItem($name, array $options = array())
    {
        foreach ($this->getExtensions() as $extension) {
            $options = $extension->buildOptions($options);
        }

        $item = new MenuItem($name, $this);

        foreach ($this->getExtensions() as $extension) {
            $extension->buildItem($item, $options);
        }

        return $item;
    }

    public function addExtension(ExtensionInterface $extension, $priority = 0)
    {
        $this->extensions[$priority][] = $extension;
        $this->sorted = null;
    }

    private function getExtensions()
    {
        if (null === $this->sorted) {
            krsort($this->extensions);
            $this->sorted = !empty($this->extensions) ? call_user_func_array('array_merge', $this->extensions) : array();
        }

        return $this->sorted;
    }
}
