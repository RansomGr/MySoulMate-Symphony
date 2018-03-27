<?php

namespace Marwen\PlanBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MarwenPlanBundle:Default:index.html.twig');
    }
}
