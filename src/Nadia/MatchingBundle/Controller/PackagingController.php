<?php

namespace Nadia\MatchingBundle\Controller;

use Nadia\MatchingBundle\Form\PackagingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MySoulMate\MainBundle\Entity\Packaging;
use Symfony\Component\HttpFoundation\Response;
class PackagingController extends Controller
{


    public function AjoutAction(Request $request)
    {
        $marque = new Packaging();
        if ($request->getMethod() == "POST") {
            $x = $request->get('nom');
            $marque->setNom($x);
            $y = $request->get('contenu');
            $marque->setContenu($y);
            $z = $request->get('duree');
            $marque->setDuree($z);
            $a = $request->get('contenu');
            $marque->setPrix($a);
            $em = $this->getDoctrine()->getManager();
            $em->persist($marque);// insert into
            $em->flush(); // query

        }
        $em = $this->getDoctrine()->getManager();
        $marks = $em->getRepository('MySoulMateMainBundle:Packaging')->findAll();
        return $this->render('NadiaMatchingBundle:Default:BO_AjouterPackaging.html.twig', array(
            'm' => $marks
        ));
    }


    function updateAction($id, Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('MySoulMateMainBundle:Packaging')->find($id);
        $form = $this->createForm(PackagingType::class, $mark);
        if ($form->handleRequest($request)->isValid()) {
            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('BO_afficherpack');
        }
        return $this->render('NadiaMatchingBundle:Default:BO_AfficherPackaging2.html.twig'
            , array('f' => $form->createView()));

    }


    public function affichageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $marks = $em->getRepository('MySoulMateMainBundle:Packaging')->findAll();

        return $this->render('NadiaMatchingBundle:Default:BO_AfficherPackaging.html.twig', array(
            'm' => $marks
        ));
    }

    function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $mark = $em->getRepository('MySoulMateMainBundle:Packaging')->find($id);

        $em->remove($mark);
        $em->flush();
        return $this->redirectToRoute('BO_afficherpack');
    }


}
