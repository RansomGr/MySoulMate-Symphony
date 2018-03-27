<?php

namespace Nadia\MatchingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NadiaMatchingBundle:Default:index.html.twig');
    }
}
