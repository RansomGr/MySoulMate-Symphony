<?php

namespace Amira\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MySoulMate\MainBundle\Entity\Events;
use MySoulMate\MainBundle\Entity\Entite;
use Symfony\Component\HttpFoundation\Request;
use Amira\EventsBundle\Form\EventsType;

class BoEventsControllerController extends Controller
{
    public function AjouterAction(Request $request)
    {
        $even= new Events();
        $form=$this->createForm(EventsType::class,$even);
        if($form->handleRequest($request)->isValid())
        {
        $em=$this->getDoctrine()->getManager();
        $em->persist($even);
        $em->flush();
        }
        return $this->render('AmiraEventsBundle:BoEventsController:ajouter.html.twig', array('fajout'=>$form->createView()));

    }

    public function ModifierAction(Request $request)
    {
        $even= new Events();
        $form=$this->createForm(EventsType::class,$even);
        if($form->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($even);
            $em->flush();
        }
        return $this->render('AmiraEventsBundle:BoEventsController:modifier.html.twig', array('fmodif'=>$form->createView()));
    }

    public function ListingAction()
    {
        $listingEvent=$this->getDoctrine()->getManager();
        $Events=$listingEvent->getRepository('MySoulMateMainBundle:Events')->findAll();
        // var_dump($Events);
        return $this->render('AmiraEventsBundle:BoEventsController:listing.html.twig', array('m'=>$Events ));

    }

    public function DeleteAction($entite)
    {
        $em=$this->getDoctrine()->getManager();
        $even=$em->getRepository('MySoulMateMainBundle:Events')->find($entite);
        $em->remove($even);
        $em->flush();
        return $this->redirectToRoute('_listing');

    }

}
