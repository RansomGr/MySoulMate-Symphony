<?php

namespace MySoulMate\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller// to do the real job of the login you need to extend a special controller called SecurityController and override a methode  called loginAction // I'ù hearing you, I was just typing "okay :))"
{
    public function AdminAction()
    {
        return $this->render('MySoulMateMainBundle:MainViews:admin.html.twig');
    }
    public function indexAction()
    {
        return $this->render('MySoulMateMainBundle:MainViews:index.html.twig');
    }
    public function loginClientAction()
    {
        return $this->render('MySoulMateMainBundle:Security:loginFO.html.twig');
    }
}
