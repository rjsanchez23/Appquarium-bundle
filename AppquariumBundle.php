<?php

namespace AppquariumBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppquariumBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
