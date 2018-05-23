<?php

namespace Nadia\MatchingBundle\Controller;

use MySoulMate\MainBundle\Entity\AchatPackaging;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class AchatPackagingController extends Controller
{
    public function FO_AcheterAction($id)
    {
        $achat = new AchatPackaging();

        $em = $this->getDoctrine()->getManager();

        $user1 = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());
        $achat->setClient($user1);


        $pack = $em->getRepository('MySoulMateMainBundle:Packaging')->find($id);
        $achat->setPackaging($pack);

        //$achat->setDatedebut(new Date("d-m-Y"));

        $em->persist($achat);// insert into
        $em->flush(); // query


        $packagings = $em->getRepository('MySoulMateMainBundle:Packaging')->findAll();
        return $this->render('NadiaMatchingBundle:Default:FO_Packagings.html.twig', array('m' => $packagings));
    }



    public function affichageAction()
    {

        $em = $this->getDoctrine()->getManager();
        $marks = $em->getRepository('MySoulMateMainBundle:AchatPackaging')->findBy(array($this->getUser()));

        return $this->render('NadiaMatchingBundle:Default:Panier.html.twig', array(
            'm' => $marks
        ));
    }


    public function PayPalAction()
    {



    }



    //////////////////////////////////// MOBILE //////////////////////////

    public function FO_AcheterMAction($id)
    {
        $achat = new AchatPackaging();

        $em = $this->getDoctrine()->getManager();

        $user1 = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());
        $achat->setClient($user1);


        $pack = $em->getRepository('MySoulMateMainBundle:Packaging')->find($id);
        $achat->setPackaging($pack);

        //$achat->setDatedebut(new Date("d-m-Y"));

        $em->persist($achat);// insert into
        $em->flush(); // query


        $packagings = $em->getRepository('MySoulMateMainBundle:Packaging')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($packagings);
        return new JsonResponse($formatted);

    }
}
