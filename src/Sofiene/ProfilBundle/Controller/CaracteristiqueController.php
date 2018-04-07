<?php

namespace Sofiene\ProfilBundle\Controller;

use MySoulMate\MainBundle\Entity\Caracteristique;
use MySoulMate\MainBundle\Entity\Profil;
use MySoulMate\MainBundle\Form\CaracteristiqueType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CaracteristiqueController extends Controller
{
    public function ajoutAction(Request $request)
    {
        $caracteristique = new Caracteristique();
        $form = $this->createForm(CaracteristiqueType::class, $caracteristique);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();





            $em->persist($caracteristique);
            $em->flush();



            //return $this->redirectToRoute('affichoffrecoloc');


        }



        return $this->render('SofieneProfilBundle:Caracteristique:ajout.html.twig', array('form' => $form->createView(),
            // ...
        ));
    }

    public function affichageAction($q,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $offre=$em->getRepository('MySoulMateMainBundle:Caracteristique')->find($q);
        return $this->render('@SofieneProfil/Caracteristique/afficher.html.twig', array(
            'm'=>$offre));
    }



    public function modifierAction($q,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $mark=$em->getRepository('MySoulMateMainBundle:Caracteristique')->find($q);
        $form=$this->createForm(CaracteristiqueType::class,$mark);
        if($form->handleRequest($request)->isValid())
        {
            $em->persist($mark);
            $em->flush();
            return $this->redirectToRoute('afficher');
        }
        return $this->render('@SofieneProfil/Caracteristique/ajout.html.twig',array(
            'form'=>$form->createView()));
    }

    public function acceuilAction()
    {
        return $this->render(':Layouts:Layout_FO.html.twig',array(
        ));
    }

    public function AfficheProfilAction()
    {
        $user = $this->getUser();
        $colocations = $this->getDoctrine()->getRepository(Profil::class)->findByUtilisateur($user);
        return $this->render('@Colocation/Default/mesoffres.html.twig', ['' => $colocations]);
    }





}
