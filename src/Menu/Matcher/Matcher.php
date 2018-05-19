<?php

namespace Gourmet\KnpMenu\Menu\Matcher;

use Cake\Network\Request;
use Gourmet\KnpMenu\Menu\Matcher\Voter\RequestVoter;
use Knp\Menu\Matcher\Matcher as KnpMenuMatcher;

class Matcher extends KnpMenuMatcher
{
    public function __construct(Request $request)
    {
        parent::__construct(new RequestVoter($request));
    }
}
