<?php

namespace MySoulMate\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function AdminAction()
    {
        return $this->render('MySoulMateMainBundle:MainViews:admin.html.twig');
    }
    public function indexAction()
    {
        return $this->render('MySoulMateMainBundle:MainViews:index.html.twig');
    }
}
