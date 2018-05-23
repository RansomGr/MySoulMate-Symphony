<?php

namespace Jileni\RelationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RelationController extends Controller
{
    public function AfficherAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $relations=$em->getRepository('MySoulMateMainBundle:Relation')->findAll();
        return $this->render('JileniRelationBundle:Relation:afficherRe.html.twig', array(
            'r'=>$relations
        ));

    }
    public function AfficherPageAction()
    {

        return $this->render('JileniRelationBundle:Relation:RelationHome.html.twig', array(
        ));
    }

    public function AfficherStatAction()
    {
        return $this->render('@JileniRelation/Relation/statRE.html.twig', array(
            // ...
        ));
    }

}
