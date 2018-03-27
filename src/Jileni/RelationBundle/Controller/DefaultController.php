<?php

namespace Jileni\RelationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JileniRelationBundle:Default:index.html.twig');
    }
}
