<?php

namespace Nadia\MatchingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Request;
use MySoulMate\MainBundle\Entity\Caracteristique;
use Nadia\MatchingBundle\Controller\MatchingController;
use MySoulMate\MainBundle\Entity\Utilisateur;
use MySoulMate\MainBundle\Entity\Invitation;
use Doctrine\ORM\EntityManager;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NadiaMatchingBundle:Default:FO_RechercheMatching.html.twig');
    }

    public function FO_ConnexionAction()
    {
        return $this->render('NadiaMatchingBundle:Default:FO_Connexion.html.twig');
    }

    public function Login_Homepage_FOAction()
{
    return $this->render('NadiaMatchingBundle:Default:Login_Homepage_FO.html.twig');

}


    public function FO_MatchingHomepageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('MySoulMateMainBundle:Utilisateur')->findAll();
        // var_dump($clients);
        return $this->render('NadiaMatchingBundle:Default:FO_RechercheMatching.html.twig', array('m' => $clients));

    }






    /////////////////
    ///
    ///
    public function CalculMatchingTot($id2)

    {    $matchingtotal=0;
        $matchingphysique=0;
        $matchingpsychologique=0;
        $matchinglifestyle=0;


        $em=$this->getDoctrine()->getManager();
        $client1 = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());
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

        return $matchingtotal;
    }
    public function FO_MesAmisAction()
    {
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
//
//        $qb = $em->createQueryBuilder();
//        $qb->select('i')
//            ->from('MySoulMateMainBundle:Invitation', 'i')
//            ->where('i.client1 = :client1')
//            ->setParameter('client1', $moi)
//            ->where('i.getStatut() = "Accepté"')
//            ->orderBy(CalculMatchingTot('i.client2'), 'ASC');
//
//
//        $qb2 = $em->getRepository('MySoulMateMainBundle:Invitation')->createQueryBuilder('ii')->from('MySoulMateMainBundle:Invitation', 'ii');
//
//        $qb2->select('ii')
//            ->from('Invitation', 'ii')
//            ->where('i.client1 = :client1')
//            ->setParameter('client1', $moi)
//            ->where('i.getStatut()', '=' , "en Attente")
//            ->orderBy(CalculMatchingTot(i.getClient2()), 'ASC');
//
//        $query = $qb->getQuery()->execute()->fetchAll();
//        $query2 = $qb2->getQuery()->execute()->fetchAll();
        return $this->render('NadiaMatchingBundle:Default:FO_MesAmis.html.twig', array('m' => $result , 'n' => $result2) );


    }


    public function FO_AjoutPrefAction(\Symfony\Component\HttpFoundation\Request $request)
    {

        $carac = new Caracteristique();

        if ($request->getMethod() == "POST") //click sur le bouton ajouter
        {
            $a = $request->get('caractere'); //récupérer les valeurs de l'interface
            $b = $request->get('tabac');
            $c = $request->get('alcool');
            $d = $request->get('ville');
            $e = $request->get('regime');
            $f = $request->get('pilosite');
            $g = $request->get('origine');
            $h = $request->get('cheveux');
            $i = $request->get('yeux');
            $j = $request->get('profession');

            $carac->setCaractere($a);
            $carac->setTabac($b);
            $carac->setAlcool($c);
            $carac->setVille($d);
            $carac->setCuisine($e);

            $em = $this->getDoctrine()->getManager(); //instancier l'orm
            $em->persist($carac); //equivaut à insert into table
            $em->flush();


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


}
