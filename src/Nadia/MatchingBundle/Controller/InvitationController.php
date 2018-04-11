<?php

namespace Nadia\MatchingBundle\Controller;

use MySoulMate\MainBundle\Entity\Invitation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InvitationController extends Controller
{
    public function FO_InviterAction(Request $request, $id)
    {
        $invit = new Invitation();

        $em = $this->getDoctrine()->getManager();

            $user1 = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());
            $invit->setClient1($user1);


            $user2 = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($id);
            $invit->setClient2($user2);

            $invit->setStatut("en Attente");

            $em2 = $this->getDoctrine()->getManager();
            $em2->persist($invit);// insert into
            $em2->flush(); // query


        //if($user2->hasRole("ROLE_USER")) {
            $marks = $em->getRepository('MySoulMateMainBundle:Utilisateur')->findAll();
            return $this->render('NadiaMatchingBundle:Default:FO_RechercheMatching.html.twig', array(
                'm' => $marks
            ));
        //}
    }


    public function AccepterInvitAction(Request $request, $id)
    {
        $invit = new Invitation();

            $em = $this->getDoctrine()->getManager();
            $invit = $em->getRepository('MySoulMateMainBundle:Invitation')->find($id);

            $invit->setStatut('Accepté');
            var_dump($invit->getStatut());

            $em->persist($invit);// insert into
            $em->flush(); // query



        $em = $this->getDoctrine()->getManager();
        $moi = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());
        $accept="Accepté";

        $query=$this->getDoctrine()->getManager()->createQuery('select i from MySoulMateMainBundle:Invitation i where (i.client1 = :client1) AND (i.statut like :accept) ')
            ->setParameter(':client1',$moi)->setParameter(':accept', $accept);
        $result=$query->getResult();


        $attente="En Attente";
        $query2=$this->getDoctrine()->getManager()->createQuery('select i from MySoulMateMainBundle:Invitation i where (i.client1 = :client1) AND (i.statut like :attent) ')
            ->setParameter(':client1',$moi)->setParameter(':attent', $attente);
        $result2=$query2->getResult();

        return $this->render('NadiaMatchingBundle:Default:FO_MesAmis.html.twig' , array('m' => $result , 'n' => $result2));
    }



    function FO_SuppInvitAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $mark=$em->getRepository('MySoulMateMainBundle:Invitation')->find($id);

        $em->remove($mark);
        $em->flush();
        return $this->redirectToRoute('FO_MesAmis');
    }


}
