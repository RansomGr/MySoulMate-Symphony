<?php

namespace Sofiene\ProfilBundle\Controller;

use JMS\Serializer\Expression\ExpressionEvaluator;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Tests\Fixtures\Discriminator\Car;
use MySoulMate\MainBundle\Entity\Actualite;
use MySoulMate\MainBundle\Entity\Caracteristique;
use MySoulMate\MainBundle\Entity\Profil;
use MySoulMate\MainBundle\Entity\Rate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ExpressionLanguage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MobileController extends Controller
{

    public function getProfileAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("MySoulMateMainBundle:Utilisateur")->find($request->get("idUser"));
        $profiles = $em->getRepository("MySoulMateMainBundle:Profil")->findBy(array("user" => $user));
        $array = array();

        foreach ($profiles as $row) {

            if ($row->getCaracteristique() != NULL) {
                $profile = array(
                    "nom" => $row->getUser()->getNom(),
                    "prenom" => $row->getUser()->getPrenom(),
                    "gender" => $row->getUser()->getGender(),
                    "idProfile" => $row->getId(),
                    "email" => $user->getEmail(),
                    "username" => $user->getUsername(),
                    "description" => $row->getDescription(),
                    "photo" => $row->getPhoto(),
                    "idCaracteristique" => $row->getCaracteristique()->getId(),

                );
            } else {
                $profile = array(
                    "nom" => $row->getUser()->getNom(),
                    "prenom" => $row->getUser()->getPrenom(),
                    "gender" => $row->getUser()->getGender(),
                    "idProfile" => $row->getId(),
                    "email" => $user->getEmail(),
                    "username" => $user->getUsername(),
                    "description" => $row->getDescription(),
                    "photo" => $row->getPhoto(),
                    "idCaracteristique" => 0,

                );
            }

            array_push($array, $profile);
        }


        return new JsonResponse($array);
    }


    public function getCaracteristiqueByIdAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $caracteristique = $em->getRepository("MySoulMateMainBundle:Caracteristique")->find($request->get("id"));

        $array = array(
            "id" => $caracteristique->getId(),
            "alcool" => $caracteristique->getAlcool(),
            "cheveux" => $caracteristique->getCheveux(),
            "caractere" => $caracteristique->getCaractere(),
            "corpulence" => $caracteristique->getCorpulence(),
            "cuisine" => $caracteristique->getCuisine(),
            "origine" => $caracteristique->getOrigine(),
            "pilosite" => $caracteristique->getPilosite(),
            "profession" => $caracteristique->getProfession(),
            "status" => $caracteristique->getStatut(),
            "tabac" => $caracteristique->getTabac(),
            "taille" => $caracteristique->getTaille(),
            "yeux" => $caracteristique->getYeux(),


        );

        return new JsonResponse(array($array));
    }


    public function getActualiteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $actualites = $em->getRepository("MySoulMateMainBundle:Actualite")->findAll();
        $array = array();

        foreach ($actualites as $row) {

            $actualite = array(

                "id" => $row->getId(),
                "contenu" => $row->getContenu(),
                "dateAdd" => $row->getAddDate()->format("d-M-y"),
                "username" => $row->getCreateur()->getUsername(),
                "idCreateur" => $row->getCreateur()->getId(),
                "photo" => $row->getPhoto()

            );


            array_push($array, $actualite);

        }
        return new JsonResponse($array);
    }


    public function addActualiteAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $actualite = new Actualite();

        $user = $em->getRepository("MySoulMateMainBundle:Utilisateur")->find($request->get('idUser'));


        $actualite->setAddDate(new \DateTime());
        $actualite->setContenu($request->get("contenu"));
        $actualite->setCreateur($user);
        $actualite->setPhoto($request->get("photo"));


        $em->persist($actualite);
        $em->flush();


        return new JsonResponse("added Actualite with success");
    }

    public function addCaracteristiqueAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $caracteristique = new  Caracteristique();


        $caracteristique->setAlcool($request->get("alcool"));
        $caracteristique->setCaractere($request->get("caractere"));
        $caracteristique->setCheveux($request->get("cheveux"));
        $caracteristique->setCorpulence($request->get("corpulence"));
        $caracteristique->setCuisine($request->get("cuisine"));
        $caracteristique->setOrigine($request->get("origine"));
        $caracteristique->setPilosite($request->get("pilosite"));
        $caracteristique->setProfession($request->get("profession"));
        $caracteristique->setStatut($request->get("status"));
        $caracteristique->setTabac($request->get("tabac"));
        $caracteristique->setTaille($request->get("taille"));
        $caracteristique->setYeux($request->get("yeux"));

        $em->persist($caracteristique);
        $em->flush();

        return new JsonResponse("Caracteristique added with success");
    }


    public function addprofileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $profile = new  Profil();
        $user = $em->getRepository("MySoulMateMainBundle:Utilisateur")->find($request->get('idUser'));


        $profile->setPhoto($request->files->get("photo"));
        $profile->setDescription($request->get("desc"));
        $profile->setUser($user);
        $em->persist($profile);
        $em->flush();

        return new JsonResponse("Profile Created");
    }

    public function deleteActualiteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $actualite = $em->getRepository("MySoulMateMainBundle:Actualite")->find($request->get('id'));
        $em->remove($actualite);
        $em->flush();
        return new JsonResponse("actualite deleted");


    }


    public function getRateAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $actualite = $em->getRepository("MySoulMateMainBundle:Actualite")->find($request->get('id'));
        $rates = $em->getRepository("MySoulMateMainBundle:Rate")->findBy(array("idActualite" => $actualite));

        $array = array();
        foreach ($rates as $row) {
            $rate = array(
                "id" => $row->getId(),
                "Rcontenu" => $row->getRateContenu(),
                "Rimage" => $row->getRateImage(),
                "Reffic" => $row->getRateEfficacite()
            );
            array_push($array, $rate);
        }
        $avgc = 0;
        $avgi = 0;
        $avge = 0;
        for ($i = 0; $i < sizeof($array); $i++) {

            $avgc += $array[$i]["Rcontenu"];
            $avgi += $array[$i]["Rimage"];
            $avge += $array[$i]["Reffic"];
        }
        $AvgF = (($avgc/3) + ($avge/3) + ($avgi/3)) / 3;
        return new JsonResponse(array("avgRating"=>$AvgF));

    }


    public function addRateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rate = new Rate();
        $actualite = $em->getRepository("MySoulMateMainBundle:Actualite")->find($request->get('idActualite'));
        $user = $em->getRepository("MySoulMateMainBundle:Utilisateur")->find($request->get('idUser'));


        $rate->setIdActualite($actualite);
        $rate->setUser($user);
        $rate->setRateContenu($request->get("ratec"));
        $rate->setRateEfficacite($request->get("ratee"));
        $rate->setRateImage($request->get("ratei"));

        $em->persist($rate);
        $em->flush();


        return new JsonResponse("rate added");

    }

}