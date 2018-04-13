<?php

namespace Sofiene\ProfilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Layouts/Layout_Profil.html.twig');
    }
}
