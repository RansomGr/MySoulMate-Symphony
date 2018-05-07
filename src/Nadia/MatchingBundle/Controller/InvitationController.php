<?php

namespace Nadia\MatchingBundle\Controller;

use MySoulMate\MainBundle\Entity\Invitation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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

        $em = $this->getDoctrine()->getManager();

        $moi = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());
        $role = "ROLE_ADMIN";
//        if ( ($em->getRepository('MySoulMateMainBundle:AchatPackaging')->find($this->getUser())) == true ) {
//            $demande = $this->getDoctrine()->getManager()
//                ->createQueryBuilder()
//                ->select('p.contenu from MySoulMateMainBundle:Packaging p inner join MySoulMateMainBundle:AchatPackaging ap with  p.id = ap.packaging ')
//                ->where('ap.client = :client')
//                ->setParameter(':client', $moi)
//                ->getQuery()
//                ->getResult();
//
//
//            $query = $this->getDoctrine()->getManager()
//                ->createQueryBuilder()
//                ->select('u')
//                ->from('MySoulMateMainBundle:Utilisateur', 'u')
//                ->where('u.id != :client1')
//                ->andwhere('u.roles not like :role')
//                ->andwhere('u.matchtot <', ':demande')
//                ->setParameter(':client1', $moi)
//                ->setParameter(':demande', $demande)
//                ->setParameter(':role', '%' . $role . '%')
//                ->orderBy('u.matchtot', 'ASC');
//        }
//
//        else {
            $query = $this->getDoctrine()->getManager()
                ->createQueryBuilder()
                ->select('u')
                ->from('MySoulMateMainBundle:Utilisateur', 'u')
                ->where('u.id != :client1')
                ->andwhere('u.roles not like :role')
                ->andwhere('u.matchtot < 30')
                ->setParameter(':client1', $moi)
                ->setParameter(':role', '%' . $role . '%')
                ->orderBy('u.matchtot', 'ASC');
 //       }

        $result = $query->getQuery()->getResult();
        return $this->render('NadiaMatchingBundle:Default:FO_RechercheMatching.html.twig', array('m' => $result));

    }


    public function AccepterInvitAction( $id)
    {

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




    //////////////////////////////////////////////////////// MOBILE ////////////////////

    public function FO_InviterMAction(Request $request, $id)
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

        $em = $this->getDoctrine()->getManager();

        $moi = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());
        $role = "ROLE_ADMIN";
        if ( ($em->getRepository('MySoulMateMainBundle:AchatPackaging')->find($this->getUser())) == true ) {
            $demande = $this->getDoctrine()->getManager()
                ->createQueryBuilder()
                ->select('p.contenu from MySoulMateMainBundle:Packaging p inner join MySoulMateMainBundle:AchatPackaging ap with  p.id = ap.packaging ')
                ->where('ap.client = :client')
                ->setParameter(':client', $moi)
                ->getQuery()
                ->getResult();


            $query = $this->getDoctrine()->getManager()
                ->createQueryBuilder()
                ->select('u')
                ->from('MySoulMateMainBundle:Utilisateur', 'u')
                ->where('u.id != :client1')
                ->andwhere('u.roles not like :role')
                ->andwhere('u.matchtot <', '98')
                ->setParameter(':client1', $moi)
                ->setParameter(':role', '%' . $role . '%')
                ->orderBy('u.matchtot', 'ASC');
        }

        else {
        $query = $this->getDoctrine()->getManager()
            ->createQueryBuilder()
            ->select('u')
            ->from('MySoulMateMainBundle:Utilisateur', 'u')
            ->where('u.id != :client1')
            ->andwhere('u.roles not like :role')
            ->andwhere('u.matchtot < 30')
            ->setParameter(':client1', $moi)
            ->setParameter(':role', '%' . $role . '%')
            ->orderBy('u.matchtot', 'ASC');
               }

        $result = $query->getQuery()->getResult();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($result);
        return new JsonResponse($formatted);
    }






    public function AccepterInvitMAction( $id)
    {

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

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($result);
        $formatted2 = $serializer->normalize($result2);
        return new JsonResponse($formatted, $formatted2);    }



    function FO_SuppInvitMAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $mark=$em->getRepository('MySoulMateMainBundle:Invitation')->find($id);

        $em->remove($mark);
        $em->flush();
        return $this->redirectToRoute('FO_MesAmis');
    }

}
