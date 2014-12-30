<?php
// Extend original to fix UL attributes

namespace Gourmet\KnpMenu\Menu\Renderer;

use Knp\Menu\ItemInterface;
use Knp\Menu\Renderer\ListRenderer as KnpListRenderer;

class ListRenderer extends KnpListRenderer
{

    public function render(ItemInterface $item, array $options = array())
    {
        $options = array_merge($this->defaultOptions, $options);

        $html = $this->renderList($item, $item->getAttributes(), $options);

        if ($options['clear_matcher']) {
            $this->matcher->clear();
        }

        return $html;
    }
}
