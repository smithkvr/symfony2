<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;
use Acme\Demo\Entity\User;

use Symfony\Component\HttpFoundation\Request;

/**
 * @package PuntClubBundle
 * @subpackage Controller
 */
class LoginController extends Controller
{

    /**
     * @Route("/login/{onlyForm}", name="_ac_login")
     * @Route("/login", name="_ac_login")
     */
    public function loginAction($route = "", $onlyForm = '')
    {
        $loggedInUser = $this->get('security.context')->getToken()->getUser();

        if($loggedInUser instanceof User) {
            return $this->redirect($this->generateUrl('dashboardRedirect'));
        }
        $request = $this->getRequest();
        $session = $request->getSession();

        $returnUrl = $route ? $this->generateUrl($route) : "";
        $loginForm = $this->get("form_login");

        // get the login error if there is one
        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        $session->remove(SecurityContext::AUTHENTICATION_ERROR);

        $templateName = 'AcmeDemoBundle:Login:login.html.twig';
        // display the "Login or Register" page

        $loginUsername = $session->get(SecurityContext::LAST_USERNAME);
        if(empty($loginUsername) and $request->cookies->has('_remember_me')){
            $loginUsername = $request->cookies->get('_remember_me');
        }
        return $this->render($templateName, array(
            "loginUsername" => $loginUsername,
            "loginError" => $error,
            "_targetPath" => $returnUrl,
            "loginForm" => $loginForm,
            "rememb"
        ));

    }


    /**
     * @Route("/login/check", name="login_check")
     */
    public function loginCheckAction()
    {
        // empty - this is handled by Symfony's security system.
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }
}