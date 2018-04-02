<?php

namespace MySoulMate\MainBundle;

use FOS\UserBundle\FOSUserBundle;

class MySoulMateMainBundle extends FOSUserBundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
