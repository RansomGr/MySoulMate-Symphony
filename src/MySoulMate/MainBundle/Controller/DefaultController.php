<?php

namespace MySoulMate\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MySoulMateMainBundle:Default:index.html.twig');
    }
}
