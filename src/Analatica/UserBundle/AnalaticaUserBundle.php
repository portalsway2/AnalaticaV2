<?php

namespace Analatica\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AnalaticaUserBundle extends Bundle
{
    public function getParent()
    {

        return 'FOSUserBundle';
    }
}
