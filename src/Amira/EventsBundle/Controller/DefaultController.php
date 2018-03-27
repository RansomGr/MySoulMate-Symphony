<?php

namespace Amira\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AmiraEventsBundle:Default:index.html.twig');
    }
}
