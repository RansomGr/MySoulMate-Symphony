<?php

namespace Nadia\MatchingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class MatchingController extends Controller
{

    public function CalculMatchingTot($id)

    {

        $em = $this->getDoctrine()->getManager();
        $client2 = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($id);
        $client1 = $em->getRepository('MySoulMateMainBundle:Utilisateur')->find($this->getUser());


        $matchingtotal = 0;
        $matchingphysique = 0;
        $matchingpsychologique = 0;
        $matchinglifestyle = 0;

        if ($client1->getProfil()->getPreference()->getCorpulence() == $client2->getProfil()->getCaracteristique()->getCorpulence()) {
            $matchingtotal += 8;
            $matchingphysique += 18;
        }
        if ($client1->getProfil()->getPreference()->getPilosite() == $client2->getProfil()->getCaracteristique()->getPilosite()) {
            $matchingtotal += 8;
            $matchingphysique += 8;

        }
        if ($client1->getProfil()->getPreference()->getOrigine() == $client2->getProfil()->getCaracteristique()->getOrigine()) {
            $matchingtotal += 8;
            $matchingpsychologique += 8;
        }
        if ($client1->getProfil()->getPreference()->getProfession() == $client2->getProfil()->getCaracteristique()->getProfession()) {
            $matchingtotal += 8;
            $matchinglifestyle += 8;
        }
        if ($client1->getProfil()->getPreference()->getAlcool() == $client2->getProfil()->getCaracteristique()->getAlcool()) {
            $matchingtotal += 8;
            $matchinglifestyle += 8;

        }

        if ($client1->getProfil()->getPreference()->getTabac() == $client2->getProfil()->getCaracteristique()->getTabac()) {
            $matchingtotal += 8;
            $matchinglifestyle += 8;

        }

        if ($client1->getGender() == 'H' AND $client1->getProfil()->getPreference()->getTaille() >= $client2->getProfil()->getCaracteristique()->getTaille()) {
            $matchingtotal += 8;
            $matchingphysique += 8;

        }
        if ($client1->getGender() == 'F' AND $client1->getProfil()->getPreference()->getTaille() <= $client2->getProfil()->getCaracteristique()->getTaille()) {
            $matchingtotal += 8;
            $matchingphysique += 8;

        }
        if ($client1->getProfil()->getPreference()->getCheveux() == $client2->getProfil()->getCaracteristique()->getCheveux()) {
            $matchingtotal += 8;
        }
        if ($client1->getProfil()->getPreference()->getYeux() == $client2->getProfil()->getCaracteristique()->getYeux()) {
            $matchingtotal += 8;
            $matchingphysique += 8;

        }
        if ($client1->getProfil()->getPreference()->getCaractere() == $client2->getProfil()->getCaracteristique()->getCaractere()) {
            $matchingtotal += 8;
            $matchingpsychologique += 8;
        }
        if ($client1->getProfil()->getPreference()->getStatut() == $client2->getProfil()->getCaracteristique()->getStatut()) {
            $matchingtotal += 8;
            $matchingpsychologique += 8;
        }
        if ($client1->getProfil()->getPreference()->getCuisine() == $client2->getProfil()->getCaracteristique()->getCuisine()) {
            $matchingtotal += 8;
            $matchinglifestyle += 8;

        }

        $idstat = 1;
        $stat = $em->getRepository('MySoulMateMainBundle:Stat')->find($idstat);
        $stat->setPourcentage($matchingphysique);


        $idstat = 2;
        $stat = $em->getRepository('MySoulMateMainBundle:Stat')->find($idstat);
        $stat->setPourcentage($matchingpsychologique);

        $idstat = 3;
        $stat = $em->getRepository('MySoulMateMainBundle:Stat')->find($idstat);
        $stat->setPourcentage($matchinglifestyle);

        $idstat = 4;
        $stat = $em->getRepository('MySoulMateMainBundle:Stat')->find($idstat);
        $stat->setPourcentage(100 - $matchingtotal);


        $em->persist($stat);// insert into
    }

    public function PieAction($id)
    {
        $this->CalculMatchingTot($id);
        $ids = 1;
        $pieChart = new PieChart();
        $em = $this->getDoctrine();
        $classes = $em->getRepository('MySoulMateMainBundle:Stat')->findAll();

        $totalEtudiant = 0;


        $data = array();
        $stat = ['Nom', 'pourcentage'];
        $nb = 0;
        array_push($data, $stat);
        foreach ($classes as $classe) {
            $stat = array();
            array_push($stat, $classe->getNom(), $classe->getPourcentage());
            $nb = ($classe->getPourcentage());
            $stat = [$classe->getNom(), $nb];
            array_push($data, $stat);
        }

        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#ff99cc');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Georgia');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('NadiaMatchingBundle:Default:FO_Pie.html.twig', array('piechart' => $pieChart));

    }

}
