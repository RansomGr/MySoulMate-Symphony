<?php

namespace Jileni\RelationBundle\Controller;

use MySoulMate\MainBundle\Entity\ContenuMoment;
use MySoulMate\MainBundle\Form\ContenuMomentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ContenuMomentController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $moment = new ContenuMoment();
        $form = $this->createForm(ContenuMomentType::class, $moment);
        $form->handleRequest($request);
        /**
         * @var UploadedFile $file
         */
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file = $moment->getPhoto();
            $photo = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'), $photo
            );
            $moment->setPhoto($photo);
            $em->persist($moment);
            $em->flush();
            return $this->redirectToRoute('_afficherM');
        }

        return $this->render('JileniRelationBundle:ContenuMoment:ajoutMo.html.twig', array(
            'moment' => $moment,
            'f' => $form->createView()
        ));
    }

    public function ModifierAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $moment = $em->getRepository('MySoulMateMainBundle:ContenuMoment')->find($id);
        $form = $this->createForm(ContenuMomentType::class, $moment);
        if ($form->handleRequest($request)->isValid()) {
            $em->persist($moment);
            $em->flush();
            return $this->redirectToRoute('_afficherM');
        }
        return $this->render('@JileniRelation/ContenuMoment/ajoutMo.html.twig'
            , array('f' => $form->createView()));
    }

    public function SupprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $moment = $em->getRepository('MySoulMateMainBundle:ContenuMoment')->find($id);

        $em->remove($moment);
        $em->flush();
        return $this->redirectToRoute('_afficherM');

    }

    public function AfficherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $moments = $em->getRepository('MySoulMateMainBundle:ContenuMoment')->findAll();
        return $this->render('@JileniRelation/ContenuMoment/afficherMo.html.twig', array(
            'm' => $moments
        ));
    }

    function RechercheAction(Request $request)
    {
        $moment = new ContenuMoment();
        $form = $this->createForm(RechercheType::class, $moment);
        $em = $this->getDoctrine()->getManager();
        $moments = $em->getRepository('MySoulMateMainBundle:ContenuMoment')->findAll();

        if ($form->handleRequest($request)->isValid()) {
            $moments = $em->getRepository('MyappParcBundle:Marque')->searchMoment($moment->getNom());
        }
        return $this->render('@JileniRelation/ContenuMoment/afficherMo.html.twig', array('fr' => $form->createView(), 'm' => $moment));
    }


    public function allAction()
    {
        $moments = $this->getDoctrine()->getManager()
            ->getRepository('MySoulMateMainBundle:ContenuMoment')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($moments);
        return new JsonResponse($formatted);
    }

    public function findAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('MySoulMateMainBundle:ContenuMoment')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request,$nom,$description)
    {
        $em = $this->getDoctrine()->getManager();

        $moment = new ContenuMoment();
        $moment->setNom($nom);
        $moment->setDescription($description);


        $em->persist($moment);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($moment);
        return new JsonResponse($formatted);
    }
}
