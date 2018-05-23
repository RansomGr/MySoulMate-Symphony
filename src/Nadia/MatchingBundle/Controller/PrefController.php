<?php

namespace Nadia\MatchingBundle\Controller;

use MySoulMate\MainBundle\Entity\Caracteristique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PrefController extends Controller
{

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $task = new Caracteristique();
        $task->setCorpulence($request->get('corpulence'));
        $task->setPilosite($request->get('pilosite'));
        $task->setOrigine($request->get('origine'));
        $task->setProfession($request->get('profession'));
        $task->setAlcool($request->get('alcool'));
        $task->setTabac($request->get('tabac'));
        $task->setTaille($request->get('taille'));
        $task->setCheveux($request->get('cheveux'));
        $task->setYeux($request->get('yeux'));
        $task->setCaractere($request->get('caractere'));
        $task->setStatut($request->get('status'));
        $task->setCuisine($request->get('cuisine'));

        $em->persist($task);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($task);
        return new JsonResponse($formatted);
    }
}
