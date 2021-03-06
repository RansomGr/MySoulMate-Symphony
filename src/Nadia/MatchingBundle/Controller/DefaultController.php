<?php

namespace Nadia\MatchingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Request;
use MySoulMate\MainBundle\Entity\Caracteristique;
use Nadia\MatchingBundle\Controller\MatchingController;
use MySoulMate\MainBundle\Entity\Utilisateur;
use MySoulMate\MainBundle\Entity\Invitation;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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

        $moi = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());
        $this->CalculMatchingTot();
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
//        }


        $query = $this->getDoctrine()->getManager()
            ->createQueryBuilder()
            ->select('u')
            ->from('MySoulMateMainBundle:Utilisateur', 'u')
            ->where('u.id != :client1 AND u.roles not like :role')
           // ->andwhere('u.roles not like :role ')
            ->setParameter(':client1', $moi)->setParameter(':role', '%' . $role . '%')
            ->orderBy('u.matchtot', 'ASC');


        $result = $query->getQuery()->getResult();
        return $this->render('NadiaMatchingBundle:Default:FO_RechercheMatching.html.twig', array('m' => $result));

    }


    public function CalculMatchingTot()

    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('MySoulMateMainBundle:Utilisateur')->findAll();
        $client1 = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());

        foreach ($clients as $client2) {
            $matchingtotal = 0;
          //  var_dump($client2);

            if ($client1->getProfil()->getPreference()->getCorpulence() == $client2->getProfil()->getCaracteristique()->getCorpulence()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getPilosite() == $client2->getProfil()->getCaracteristique()->getPilosite()) {
                $matchingtotal += 8;

            }
            if ($client1->getProfil()->getPreference()->getOrigine() == $client2->getProfil()->getCaracteristique()->getOrigine()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getProfession() == $client2->getProfil()->getCaracteristique()->getProfession()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getAlcool() == $client2->getProfil()->getCaracteristique()->getAlcool()) {
                $matchingtotal += 8;
            }

            if ($client1->getProfil()->getPreference()->getTabac() == $client2->getProfil()->getCaracteristique()->getTabac()) {
                $matchingtotal += 8;
            }

            if ($client1->getGender() == 'H' AND $client1->getProfil()->getPreference()->getTaille() >= $client2->getProfil()->getCaracteristique()->getTaille()) {
                $matchingtotal += 8;
            }
            if ($client1->getGender() == 'F' AND $client1->getProfil()->getPreference()->getTaille() <= $client2->getProfil()->getCaracteristique()->getTaille()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getCheveux() == $client2->getProfil()->getCaracteristique()->getCheveux()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getYeux() == $client2->getProfil()->getCaracteristique()->getYeux()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getCaractere() == $client2->getProfil()->getCaracteristique()->getCaractere()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getStatut() == $client2->getProfil()->getCaracteristique()->getStatut()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getCuisine() == $client2->getProfil()->getCaracteristique()->getCuisine()) {
                $matchingtotal += 8;

            }

            $client2->setMatchtot($matchingtotal);
            $em->persist($client2);// insert into

        }

        $em->flush();

    }

    public function FO_MesAmisAction()
    {
        ///
        $em = $this->getDoctrine()->getManager();
        $moi = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());
        $this->CalculMatchingTot();
        $accept = "Accepté";
        $attente = "En Attente";

        $query = $this->getDoctrine()->getManager()
            ->createQueryBuilder()
            ->select('i')
            ->from('MySoulMateMainBundle:Invitation', 'i')
            ->where('i.client1 = :client1')
            ->andwhere('i.statut like :accept')
            ->setParameter(':client1', $moi)
            ->setParameter(':accept', $accept);

        $result = $query->getQuery()->getResult();

        $query2 = $this->getDoctrine()->getManager()
            ->createQueryBuilder()
            ->select('i')
            ->from('MySoulMateMainBundle:Invitation', 'i')
            ->where('i.client1 = :client1')
            ->andwhere('i.statut like :attent')
            ->setParameter(':client1', $moi)
            ->setParameter(':attent', $attente);

        $result2 = $query2->getQuery()->getResult();

        return $this->render('NadiaMatchingBundle:Default:FO_MesAmis.html.twig', array('m' => $result, 'n' => $result2));


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
        return $this->render('NadiaMatchingBundle:Default:FO_Packagings.html.twig', array('m' => $packagings));
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
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($id);
        return $this->render('NadiaGrapheBundle:FO_Profil.html.twig', array('m' => $match));

    }


    ////////////////////////////////////////////////////// MOBILE ////////////////////////////////////////////////

    public function FO_PackagingsMAction()

    {
        $em = $this->getDoctrine()->getManager();
        $packagings = $em->getRepository('MySoulMateMainBundle:Packaging')->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($packagings);
        return new JsonResponse($formatted);

        // return $this->render('NadiaMatchingBundle:Default:FO_Packagings.html.twig', array('m' => $packagings));
    }


    public function FO_MatchingHomepageMAction($id, \Symfony\Component\HttpFoundation\Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $moi =  $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($id);
        $this->CalculMatchingTot2($id);
        $role = "ROLE_ADMIN";

        if ( ($em->getRepository('MySoulMateMainBundle:AchatPackaging')->find($id)) == true ) {
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
                ->andwhere('u.matchtot < 98')
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
        $res[]=$result[0];
        $res[]=$result[1];
        $res[]=$result[2];
        $res[]=$result[3];
        $res[]=$result[4];

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($res);
        return new JsonResponse($formatted);

        //return $this->render('NadiaMatchingBundle:Default:FO_RechercheMatching.html.twig', array('m' => $result));

    }


    public function CalculMatchingTot2($id)

    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('MySoulMateMainBundle:Utilisateur')->findAll();
        $client1 = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($id);

        foreach ($clients as $client2) {
            $matchingtotal = 0;

            if ($client1->getProfil()->getPreference()->getCorpulence() == $client2->getProfil()->getCaracteristique()->getCorpulence()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getPilosite() == $client2->getProfil()->getCaracteristique()->getPilosite()) {
                $matchingtotal += 8;

            }
            if ($client1->getProfil()->getPreference()->getOrigine() == $client2->getProfil()->getCaracteristique()->getOrigine()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getProfession() == $client2->getProfil()->getCaracteristique()->getProfession()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getAlcool() == $client2->getProfil()->getCaracteristique()->getAlcool()) {
                $matchingtotal += 8;
            }

            if ($client1->getProfil()->getPreference()->getTabac() == $client2->getProfil()->getCaracteristique()->getTabac()) {
                $matchingtotal += 8;
            }

            if ($client1->getGender() == 'H' AND $client1->getProfil()->getPreference()->getTaille() >= $client2->getProfil()->getCaracteristique()->getTaille()) {
                $matchingtotal += 8;
            }
            if ($client1->getGender() == 'F' AND $client1->getProfil()->getPreference()->getTaille() <= $client2->getProfil()->getCaracteristique()->getTaille()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getCheveux() == $client2->getProfil()->getCaracteristique()->getCheveux()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getYeux() == $client2->getProfil()->getCaracteristique()->getYeux()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getCaractere() == $client2->getProfil()->getCaracteristique()->getCaractere()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getStatut() == $client2->getProfil()->getCaracteristique()->getStatut()) {
                $matchingtotal += 8;
            }
            if ($client1->getProfil()->getPreference()->getCuisine() == $client2->getProfil()->getCaracteristique()->getCuisine()) {
                $matchingtotal += 8;

            }

            $client2->setMatchtot($matchingtotal);
            $em->persist($client2);// insert into

        }

        $em->flush();

    }


}
