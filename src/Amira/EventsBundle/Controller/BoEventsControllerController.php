<?php

namespace Amira\EventsBundle\Controller;

use MySoulMate\MainBundle\Entity\InviteEvenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MySoulMate\MainBundle\Entity\Events;
use MySoulMate\MainBundle\Entity\Plan;
use MySoulMate\MainBundle\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

class BoEventsControllerController extends Controller
{
    public function AjouterAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $plans = $em
            ->getRepository('MySoulMateMainBundle:Plan')
            ->findAll();

        $utilisateurs = $em
            ->getRepository('MySoulMateMainBundle:Utilisateur')
            ->findAll();


           if ($request->isMethod('post')){

              $date= new \DateTime($request->get('date'));

         //   $date = new \DateTime($request->get('date'));

            $even = new Events();
            $even->setNomEvt("0");
            $even->setTypeEvt($request->get('type'));

            $even->setDateEvt($date);
            $even->setDescriptionEvt($request->get('description'));
            $even->setDureeEvt($request->get('duree'));
            $even->setHeure($request->get('heure')."h".$request->get('minute'));

            // $even->setDate($date->format("Y-m-d"));



            $even->setNbMax($request->get('nbMaximale'));
            $even->setOrganisateurEvt($this->get('security.token_storage')->getToken()->getUser());

            $even->setPlanEvt(
                $em
                    ->getRepository('MySoulMateMainBundle:Plan')
                ->findOneBy(['id'=>$request->get('emplecement' )])
                );

            $inviteEvenement =new InviteEvenement();


            foreach ( $request->get('invites') as $user) {

                $inviteEvenement =new InviteEvenement();
                $inviteEvenement->setEvenementGroupe($even);
                $inviteEvenement->setClient(
                    $em
                        ->getRepository('MySoulMateMainBundle:Utilisateur')
                        ->findOneBy(['id'=>$user])
                );
                $inviteEvenement->setParticipe("oui");
                $em->persist($inviteEvenement);
                $em->flush();

            }
         //   $inviteEvenement->setParticipe();
           $em->persist($even);
           $em->flush();
        }
        return $this->render('AmiraEventsBundle:BoEventsController:ajouter.html.twig',
            array('plans'=>$plans
        ,'utilisateurs'=>$utilisateurs ));

    }

    public function ModifierAction(Request $request, $id)
    {
        $even = new Events();

        $em=$this->getDoctrine()->getManager();
        $even=$em
            ->getRepository('MySoulMateMainBundle:Events')
            ->find($id);
        
        $plans = $em
            ->getRepository('MySoulMateMainBundle:Plan')
            ->findAll();

        $utilisateurs = $em
            ->getRepository('MySoulMateMainBundle:Utilisateur')
            ->findAll();

        $ddate = $even->getDateEvt()->format("Y-m-d");
        //  $inviteEvenement->setClient();

        $b = $even->getHeure();
        $a= explode("h",$b);
        $heure=$a[0];
        $minute=$a[1];

        if ($request->isMethod('post')){

            //id	type	nom	adresse	email	tel	date	ouverture	fermeture	User_id

            $date= new \DateTime($request->get('date'));

            //   $date = new \DateTime($request->get('date'));


            $even->setNomEvt("0");
            $even->setTypeEvt($request->get('type'));

            $even->setDateEvt($date);
            $even->setDescriptionEvt($request->get('description'));
            $even->setDureeEvt($request->get('duree'));
            $even->setHeure($request->get('heure')."h".$request->get('minute'));

            // $even->setDate($date->format("Y-m-d"));



            $even->setNbMax($request->get('nbMaximale'));
            $even->setOrganisateurEvt($this->get('security.token_storage')->getToken()->getUser());

            $even->setPlanEvt(
                $em
                    ->getRepository('MySoulMateMainBundle:Plan')
                    ->findOneBy(['id'=>$request->get('emplecement' )])
            );


            $inviteEvenementOriginale = $em
                ->getRepository('MySoulMateMainBundle:InviteEvenement')
                ->findBy(['evenementGroupe'=>$id]);

            foreach ( $request->get('invites') as $user) {
                    $i=0;
                    foreach ($inviteEvenementOriginale as $inviteEvenementOrig ){
                        if($inviteEvenementOrig->getClient()->getId()==$user)$i=1;
                    }
                    if($i==0){
                $inviteEvenement =new InviteEvenement();
                $inviteEvenement->setEvenementGroupe($even);
                $inviteEvenement->setClient(
                    $em
                        ->getRepository('MySoulMateMainBundle:Utilisateur')
                        ->findOneBy(['id'=>$user])
                );
                $inviteEvenement->setParticipe("oui");

                $em->persist($inviteEvenement);
                $em->flush();
                    }
            }
            //   $inviteEvenement->setParticipe();


            //$em->persist($even);
            $em->flush();


        }

      // exit(VarDumper::dump($event->getTypeEvt()));
        return $this->render('AmiraEventsBundle:BoEventsController:modifier.html.twig', array('plans'=>$plans
        ,'utilisateurs'=>$utilisateurs,'event'=>$even,'date'=>$ddate,'heure'=>$heure,'minute'=>$minute
        ));
    }

    public function ListingAction()
    {
        $listingEvent=$this->getDoctrine()->getManager();
        $Events=$listingEvent->getRepository('MySoulMateMainBundle:Events')->findAll();
        // var_dump($Events);
        return $this->render('AmiraEventsBundle:BoEventsController:listing.html.twig', array('m'=>$Events ));

    }

    public function DeleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $even=$em->getRepository('MySoulMateMainBundle:Events')->find($id);
        $em->remove($even);
        $em->flush();
        return $this->redirectToRoute('_listing');

    }

}
