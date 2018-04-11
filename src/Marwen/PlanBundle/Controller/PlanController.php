<?php

namespace Marwen\PlanBundle\Controller;

use MySoulMate\MainBundle\Entity\Plan;
use MySoulMate\MainBundle\Form\PlanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlanController extends Controller

{

    public function afficherAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $plan=$em->getRepository('MySoulMateMainBundle:Plan')->findAll();
        return $this->render('MarwenPlanBundle:Plan:afficher.html.twig', array(
            'm'=>$plan));
    }






    public function ajoutAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {

            $x = $request->get("type");
            $z = $request->get("email");
            $y = $request->get("siteweb");
            $w = $request->get("telephone");

            $k = $request->get("description");
            $img = $request->get("img");
            $img1 = $request->get("img1");
            $img2 = $request->get("img2");
            $a = $request->get("lat");
            $b = $request->get("lng");



            $plan = new Plan();

            $plan->setType($x);
            $plan->setEmail($z);
            $plan->setSiteweb($y);
            $plan->setTelephone($w);
            $plan->setDescription($k);



            $plan->setPhoto($img);
            $plan->setPhoto1($img1);
            $plan->setPhoto2($img2);
            $plan->setX($a);
            $plan->setY($b);



            $em->persist($plan);
            $em->flush();
            return $this->redirectToRoute('afficherP');
        }


        return $this->render('MarwenPlanBundle:Plan:ajout.html.twig', array(// ...
        ));

    }

    public function supprimerAction($plan)
    {
        $em=$this->getDoctrine()->getManager();
        $plane=$em->getRepository('MySoulMateMainBundle:Plan')->find($plan);
        $em->remove($plane);
        $em->flush();
        return $this->redirectToRoute('afficherP');



    }

    public function modifierAction($plan,Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;
        $plann=$em->getRepository('MySoulMateMainBundle:Plan')->find($plan) ;

        if($request->getMethod()=="POST") {

            $x = $request->get("type");
            $z = $request->get("email");
            $y = $request->get("siteweb");
            $w = $request->get("telephone");

            $k = $request->get("description");
            $img = $request->get("img");
            $img1 = $request->get("img1");
            $img2 = $request->get("img2");
            $a = $request->get("lat");
            $b = $request->get("lng");


            $plan = new Plan();

            $plan->setType($x);
            $plan->setEmail($z);
            $plan->setSiteweb($y);
            $plan->setTelephone($w);
            $plan->setDescription($k);



            $plan->setPhoto($img);
            $plan->setPhoto1($img1);
            $plan->setPhoto2($img2);
            $plan->setX($a);
            $plan->setY($b);



            $em->persist($plan) ;
            $em->flush() ;
            return $this->redirectToRoute('afficherP');
        }
        return $this->render('MarwenPlanBundle:Plan:modifier.html.twig', array('plan'=>$plann
            // ...
        ));
    }





}
