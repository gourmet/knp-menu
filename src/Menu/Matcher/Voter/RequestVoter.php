<?php

namespace Gourmet\KnpMenu\Menu\Matcher\Voter;

use Cake\Network\Request;
use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Voter\VoterInterface;

class RequestVoter implements VoterInterface
{
    protected $_request;

    public function __construct(Request $request)
    {
        $this->_request = $request;
    }

    public function matchItem(ItemInterface $item)
    {
        return $this->_request->here() == $item->getUri();
    }
}
