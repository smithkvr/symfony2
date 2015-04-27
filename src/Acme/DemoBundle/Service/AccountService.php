<?php
namespace Acme\DemoBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Acme\DemoBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Acme\DemoBundle\Utility\Util;
use Acme\DemoBundle\Service\FactoryService;
use Acme\DemoBundle\Service\DatabaseService;

class AccountService extends DatabaseService {
    protected $doctrine;
    protected $factory;
    protected $container;
    protected $util;
    protected $encoderFactory;

    public function __construct(Registry $doctrine,
            FactoryService $factoryService,
    		ContainerInterface $container,
    		Util $util,
    		$encoderFactory
    ){
        $this->doctrine = $doctrine;
        $this->factory = $factoryService;
        $this->container = $container;
        $this->util = $util;
        $this->encoderFactory = $encoderFactory;
    }

    public function findUserByEmail($email){
        $repo = $this->doctrine->getRepository('AcmeDemoBundle:User');
        return $repo->findOneByEmail($email);
    }
   
    public function primeUserForPasswordReset(User $user) {
    	$userDetails = $this->doctrine->getRepository('AcmeDemoBundle:User')->findOneBy(array('id' => $user->getId()));
    	if (!$userDetails->getToken()) {
    		$token =  $this->container->get('util')->getUniqueToken($this->doctrine->getRepository('AcmeDemoBundle:User'), 15, 'verification_token');
    		$userDetails->setToken($token);
    	}
    	// persist it to the db
    	$em = $this->doctrine->getManager();
    	$em->persist($userDetails);
    	$em->flush();
    	$this->container->get('emailer')->sendEmailVerification($userDetails);
    }
    
    public function setNewPassword(User $user, $password) {
    	$accountService = $this->container->get('AccountService');
    	$user->setPassword($password);
    	$user->setToken(null);
    	$this->encodePassword($user);
    	$user->setToken('');
    	$em = $this->doctrine->getManager();
    	$em->persist($user);
    	$em->flush();
    }
    
    public function encodePassword(User $user){
    	$encoder = $this->encoderFactory->getEncoder($user);
    	//$user->setTemporaryPassword($this->passwordService->encryptPassword($user->getPassword()));
    	$password = $encoder->encodePassword($user->getPassword(), null);
    	$user->setPassword($password);
    }

}