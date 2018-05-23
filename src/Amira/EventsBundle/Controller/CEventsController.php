<?php
/**
 * Created by PhpStorm.
 * User: Ransom
 * Date: 5/7/2018
 * Time: 7:58 AM
 */

namespace Amira\EventsBundle\Controller;


use MySoulMate\MainBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CEventsController extends Controller
{
    public function ListingAction()
    {
        $listingEvent=$this->getDoctrine()->getManager();
        $Events=$listingEvent->getRepository(Events::class)->findAll();
        $result = array();
        foreach($Events as $Event){
            $result[]=array(
                'id'=>$Event->getId(),
                'nomEvt'=> $Event->getNomEvt(),
                'dateEvt'=> $Event->getDateEvt(),
                'heure'=> $Event->getHeure(),
                'dureeEvt'=> $Event->getDureeEvt(),
                'typeEvt'=> $Event->getTypeEvt(),
                'decriptionEvt'=> $Event->getDescriptionEvt(),
                'nbMax'=> $Event->getNbMax(),
                'planEvt'=> $Event->getPlanEvt()->getId(),
                'organisateurEvt'=> $Event->getOrganisateurEvt()->getId()
            );
        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($result);
        return new JsonResponse($formatted);

    }
}