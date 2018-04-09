<?php

namespace Nadia\MatchingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NadiaMatchingBundle:Default:FO_RechercheMatching.html.twig');
    }

    public function FO_MatchingHomepageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('MySoulMateMainBundle:Utilisateur')->findAll();
        // var_dump($clients);
        return $this->render('NadiaMatchingBundle:Default:FO_RechercheMatching.html.twig', array('m' => $clients));

    }

    public function FO_AjoutPrefAction(Request $request)
    {

        $marque = new Caracteristique();

        if ($request->getMethod() == "POST") //click sur le bouton ajouter
        {
            $x = $request->get('libelle'); //récupérer les valeurs de l'interface
            $y = $request->get('pays');
            $marque->setLibelle($x);
            $marque->setPays($y);
            $em = $this->getDoctrine()->getManager(); //instancier l'orm
            $em->persist($marque); //equivaut à insert into table
            $em->flush();

            return new Response('Ajout avec succès');

        }
        return $this->render('NadiaMatchingBundle:Default:FO_AjouterPreference.html.twig');
    }

    public function FO_PackagingsAction()

    {
        $em = $this->getDoctrine()->getManager();
        $packagings = $em->getRepository('MySoulMateMainBundle:Packaging')->findAll();
        return $this->render('NadiaMatchingBundle:Default:FO_Packagings.html.twig' , array('m' => $packagings));
    }

    public function AffichageMatchingsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('MySoulMateMainBundle:Utilisateur')->findAll();
        var_dump($clients);
        return $this->render('NadiaMatchingBundle:Default:FO_RechercheMatching.html.twig', array('m' => $clients));


    }

    public function AffichageProfilAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $match=$em->getRepository('MySoulMateMainBundle:Utilisateur')->find($id);
        return $this->render('NadiaGrapheBundle:FO_Profil.html.twig', array('m' => $match));

    }

    public function DetailsMatchingAction($id1,$id2)
    {   $matchingtotal=0;
        $matchingphysique=0;
        $matchingpsychologique=0;
        $matchinglifestyle=0;
        $em=$this->getDoctrine()->getManager();
        $client1=$em->getRepository('MySoulMateMainBundle:Utilisateur')->find($id1);
        $client2=$em->getRepository('MySoulMateMainBundle:Utilisateur')->find($id2);

        if($client1->getProfil().getPreference().getCorpulence() == $client2->getProfil().getCaracteristique().getCorpulence())
        {
            $matchingtotal+=8;
            $matchingphysique+=18;
        }
        if($client1->getProfil().getPreference().getPilosite() == $client2->getProfil().getCaracteristique().getPilosite())
        {
            $matchingtotal+=8;
            $matchingphysique+=18;

        }
        if($client1->getProfil().getPreference().getOrigine() == $client2->getProfil().getCaracteristique().getOrigine())
        {
            $matchingtotal+=8;
            $matchingpsychologique+=10;
        }
        if($client1->getProfil().getPreference().getProfession() == $client2->getProfil().getCaracteristique().getProfession())
        {
            $matchingtotal+=8;
            $matchinglifestyle+=25;
        }
        if($client1->getProfil().getPreference().getAlcool() == $client2->getProfil().getCaracteristique().getAlcool())
        {
            $matchingtotal+=8;
            $matchinglifestyle+=25;

        }

        if($client1->getProfil().getPreference().getTabac() == $client2->getProfil().getCaracteristique().getTabac())
        {
            $matchingtotal+=8;
            $matchinglifestyle+=25;

        }

        if( $client1->getGender() == 'H' AND $client1->getProfil().getPreference().getTaille() >= $client2->getProfil().getCaracteristique().getTaille())
        {
            $matchingtotal+=8;
            $matchingphysique+=18;

        }
        if( $client1->getGender() == 'F' AND $client1->getProfil().getPreference().getTaille() <= $client2->getProfil().getCaracteristique().getTaille())
        {
            $matchingtotal+=8;
            $matchingphysique+=18;

        }
        if($client1->getProfil().getPreference().getCheveux() == $client2->getProfil().getCaracteristique().getCheveux())
        {
            $matchingtotal+=8;
        }
        if($client1->getProfil().getPreference().getYeux() == $client2->getProfil().getCaracteristique().getYeux())
        {
            $matchingtotal+=8;
            $matchingphysique+=18;

        }
        if($client1->getProfil().getPreference().getCaractere() == $client2->getProfil().getCaracteristique().getCaractere())
        {
            $matchingtotal+=8;
            $matchingpsychologique+=70;
        }
        if($client1->getProfil().getPreference().getStatut() == $client2->getProfil().getCaracteristique().getStatut())
        {
            $matchingtotal+=8;
            $matchingpsychologique+=10;
        }
        if($client1->getProfil().getPreference().getCuisine() == $client2->getProfil().getCaracteristique().getCuisine())
        {
            $matchingtotal+=8;
            $matchinglifestyle+=25;

        }

        return $this->render('NadiaGrapheBundle:Graphe:FO_Histogramme.html.twig', array('m1' => $client1, 'm2'=>$client2, 'tot'=>$matchingtotal , 'phys'=>$matchingphysique , 'psy'=>$matchingpsychologique , 'lifestyl'=>$matchinglifestyle ));

    }
}
