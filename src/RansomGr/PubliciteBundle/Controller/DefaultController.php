<?php

namespace RansomGr\PubliciteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RansomGrPubliciteBundle:Default:index.html.twig');
    }
}
