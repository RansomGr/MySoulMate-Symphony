<?php

namespace MySoulMate\MainBundle\Controller;
use DateTime;
use MySoulMate\MainBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MainController extends Controller// to do the real job of the login you need to extend a special controller called SecurityController and override a methode  called loginAction // I'ù hearing you, I was just typing "okay :))"
{
    public function AdminAction()
    {
        return $this->render('MySoulMateMainBundle:MainViews:admin.html.twig');
    }

    public function LoginClientAction()
    {
    }

    public function RecoverAction(Request $request)
    {
        $user_manager = $this->get('fos_user.user_manager');
        $em=$this->getDoctrine()->getManager();
        $user=$em->getRepository('MySoulMateMainBundle:Utilisateur')->findOneBy(array('email'=>$request->get('email')));
        $token = sha1(uniqid(mt_rand(), true)); // Or whatever you prefer to generate a token
        $user->setConfirmationToken($token);
        $user->setPasswordRequestedAt(new DateTime());
        $em->persist($user);
        $em->flush();
        $headers="";

        $headers = "From: \"MySoulMate:Service Utilisateur \"<info@address.com>\n";
        $headers .= "Reply-To: jarrayaaudio18@gmail.com\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
        $subject =$subject="7abcha9leuuuu";
        $reciver=$request->get('email');
        $content=$content=$this->renderView('@MySoulMateMain/mobileEmail/email_recovery.html.twig',array('user'=>$user,'recoverylink'=>'192.168.1.8/MySoulMate-Symphony/web/welcome?token='.$token));
        mail($reciver , $subject , $content ,$headers);
        return new JsonResponse(array('done'=>true));
    }

    public function addnewAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $u = new Utilisateur();
        $u->setNom($request->get('nom'));
        $u->setPrenom($request->get('prenom'));
        $u->setUsername($request->get('username'));
        $u->setEmail($request->get('email'));
        $u->setPassword($request->get('Password'));
        $em->persist($u);
        $em->flush();
        return new JsonResponse(array('marweneeeeeeeeeeeeeeeeeeeeeeeeeeee'=>'maalem'));
    }
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $pubs=$em->getRepository('RansomGrPubliciteBundle:Publicite')->findAllordered();
        $EligiblePubs=array();
        forEach($pubs as $pub)
        {
            if($pub->getDateDebut()<=(new DateTime())&&$pub->getDateFin()>=(new DateTime()))
                $EligiblePubs[]=$pub;
        }
        return $this->render('MySoulMateMainBundle:MainViews:index.html.twig',array('pubs'=>$pubs));
    }
    public function LoginClient2Action(Request $request)
    {
        $user_manager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');

        $user = $user_manager->findUserByUsername($request->get('login'));
        if($user!=null)
        {
        $encoder = $factory->getEncoder($user);
        $salt = $user->getSalt();

        if($encoder->isPasswordValid($user->getPassword(), $request->get('password'), $salt))
        {
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formatted = $serializer->normalize($user);
            return new JsonResponse($formatted);
        }
        }
        return new JsonResponse(array('id'=>'-1'));
    }
}
