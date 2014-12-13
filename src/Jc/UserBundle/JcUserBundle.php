<?php

namespace Jc\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class JcUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
