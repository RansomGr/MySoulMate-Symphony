<?php

namespace Sofiene\ProfilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SofieneProfilBundle:Default:index.html.twig');
    }
}
