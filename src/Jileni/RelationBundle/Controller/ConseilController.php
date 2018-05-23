<?php

namespace Jileni\RelationBundle\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use MySoulMate\MainBundle\Entity\Conseil;
use MySoulMate\MainBundle\Form\ConseilType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\SnappyBundle\KnpSnappyBundle;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ConseilController extends Controller
{

    public function AjoutAction(Request $request)
    {

        $conseil= new Conseil();
        $form=$this->createForm(ConseilType::class,$conseil);
        if($form->handleRequest($request)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($conseil);
            $em->flush();
        }
        return $this->render('JileniRelationBundle:Conseil:ajoutCo.html.twig', array(
            'f'=>$form->createView()
        ));
    }

    public function ModifierAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $conseil=$em->getRepository('MySoulMateMainBundle:Conseil')->find($id);
        $form=$this->createForm(ConseilType::class,$conseil);
        if($form->handleRequest($request)->isValid())
        {
            $em->persist($conseil);
            $em->flush();
            return $this->redirectToRoute('_ajoutC');
        }
        return $this->render('JileniRelationBundle:Conseil:ajoutCo.html.twig'
        ,array('f'=>$form->createView()));
    }

    public function SupprimerAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $conseil=$em->getRepository('MySoulMateMainBundle:Conseil')->find($id);
        $em->remove($conseil);
        $em->flush();
        return $this->redirectToRoute('_ajoutC');
    }

    public function AfficherAction()
    {
        $em=$this->getDoctrine()->getManager();
        $conseils=$em->getRepository('MySoulMateMainBundle:Conseil')->findAll();
        return $this->render('JileniRelationBundle:Conseil:afficherCo.html.twig', array(
            'c'=>$conseils
        ));

    }

    public function pdfconseilAction($cid)
    {   $em=$this->getDoctrine()->getManager();
        $conseil = $em->getRepository('MySoulMateMainBundle:Conseil')->findOneBy(['id' => $cid]);
        $html = $this->renderView('@JileniRelation/Conseil/sauvegardeconseil.html.twig', array(
            'c'=>$conseil
        ));
        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'file.pdf'
        );
    }


    public function listecAction()
    {
        $em=$this->getDoctrine()->getManager();
        $conseils=$em->getRepository('MySoulMateMainBundle:Conseil')->findAll();
        return $this->render('@JileniRelation/ContenuMoment/listeConseil.html.twig', array(
            'c'=>$conseils
        ));
    }


    public function allAction()
    {
        $conseils = $this->getDoctrine()->getManager()
            ->getRepository('MySoulMateMainBundle:Conseil')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($conseils);
        return new JsonResponse($formatted);
    }

    public function findAction($id)
    {
        $conseils = $this->getDoctrine()->getManager()
            ->getRepository('MySoulMateMainBundle:Conseil')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($conseils);
        return new JsonResponse($formatted);
    }

}
