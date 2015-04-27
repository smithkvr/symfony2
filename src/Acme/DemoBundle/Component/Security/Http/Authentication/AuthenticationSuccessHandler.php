<?php

namespace Acme\DemoBundle\Component\Security\Http\Authentication;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Cookie;

use Acme\DemoBundle\Entity\User;

/**
 * Custom authentication success handler
 */
class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    private $router;
    private $em;

    private $providerKey;

    /**
     * Constructor
     * @param RouterInterface   $router
     * @param array     $em
     */
    public function __construct(RouterInterface $router, array $em)
    {
        $this->router = $router;
        $this->em = $em;
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from AbstractAuthenticationListener.
     * @param Request        $request
     * @param TokenInterface $token
     * @return Response The response to return
     */
    function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $uri = $this->router->generate('dashboardRedirect');
        if ($targetUrl = $request->get('_target_path', null, true)) {
            $uri = $targetUrl;
        } else if ($targetPath = $request->getSession()->get('_security.target_path')) {
            $request->getSession()->remove('_security.target_path');
            $uri = $targetPath;
        }

        $response = new RedirectResponse($uri);

        /*$rememberMe = $request->request->get('_remember_me');
        if(!empty($rememberMe)){
            $expireTime = new \DateTime();
            $expireTime->add(new \DateInterval("P2Y"));
            $response->headers->setCookie(new Cookie('_remember_me', $request->request->get('email')));
        }*/
        return $response;
    }


    /**
     * Set the provider key.
     *
     * @param string $providerKey
     */
    public function setProviderKey($providerKey)
    {
        $this->providerKey = $providerKey;
    }
}