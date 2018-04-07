<?php
/**
 * Created by PhpStorm.
 * User: Ransom
 * Date: 4/6/2018
 * Time: 9:49 AM
 */

namespace MySoulMate\MainBundle\Controller;
use FOS\UserBundle\Controller\SecurityController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class CustomSecurityController  extends SecurityController
{
public function loginAction(Request $request)
{
    $authChecker = $this->container->get('security.authorization_checker');
    $router = $this->container->get('router');

    if ($authChecker->isGranted('ROLE_ADMIN')) {
        return new RedirectResponse($router->generate('_Dashpage'), 307);
    }

    if ($authChecker->isGranted('ROLE_USER')) {
        return new RedirectResponse($router->generate('_homepage'), 307);
    }

}
}