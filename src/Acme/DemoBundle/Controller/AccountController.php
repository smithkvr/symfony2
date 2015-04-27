<?php

// src/Acme/DemoBundle/Controller/AccountController.php
namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bridge\Monolog\Logger;

use Acme\DemoBundle\Form\Type\RegistrationType;
use Acme\DemoBundle\Form\Model\Registration;
use Acme\DemoBundle\Service\AccountService;

class AccountController extends Controller
{
	
	/**
	 * @Route("/register", name="account_register")
	 * 
	 */
    public function registerAction()
    {
        $registration = new Registration();
        $form = $this->createForm(new RegistrationType(), $registration, array(
            'action' => $this->generateUrl('account_create'),
        ));

        return $this->render(
            'AcmeDemoBundle:Account:register.html.twig',
            array('form' => $form->createView())
        );
    }
    
    /**
     * @Route("/register/create", name="account_create")
     *
     */
    public function createAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$form = $this->createForm(new RegistrationType(), new Registration());
    	$form->handleRequest($request);
    
    	$factory = $this->get('security.encoder_factory');
    	$user = new \Acme\DemoBundle\Entity\User();
    	
    	if ($form->isValid()) {
    		$registration = $form->getData();
    		
    		$user->setUsername($registration->getUser()->getUsername());
    		$user->setEmail($registration->getUser()->getEmail());
    		$user->setIsActive($registration->getUser()->getIsActive());
    		$encoder = $factory->getEncoder($user);
    		$password = $encoder->encodePassword($registration->getUser()->getPassword(), $registration->getUser()->getSalt());
    		$user->setPassword($password);
    		
    		$em->persist($user);
    		$em->flush();
    
    		$this->get('session')->getFlashBag()->add('success', 'Regisration Successful!');
    		return $this->redirectToRoute('account_register');
    		
    	}
    
    	
    	return $this->render(
    			'AcmeDemoBundle:Account:register.html.twig',
    			array('form' => $form)
    	);
    }
    
    /**
     * @Route("/reset/password", name="reset_password")
     */
    public function resetPasswordAction(Request $request){
    	
	    $form  = $this->get("form_reset_password");
	    $accountService = $this->get('AccountService');
        if($request->getMethod() === 'POST') {
            $data = $request->request->all();
            $form->setValuesFromArray($data);
            $form->validate();
            if(!$form->hasErrors()) {
                if($user = $accountService->findUserByEmail($request->request->get('email'))) {
                    $accountService->primeUserForPasswordReset($user);
                    return $this->redirect($this->generateUrl('reset_password'));
                } else {
                    $resetPasswordForm1->get('email')->addError('Unable to find requested email address');
                }
            } 
        }
    	 
    
    	return $this->render(
    			'AcmeDemoBundle:Account:reset_password.html.twig',
    			array('form' => $form)
    	);
    }
    
    /**
     * @Route("/reset/password/{token}", name="resetPasswordToken")
     */
    public function changePasswordAction(Request $request){
    	//$resetPasswordHelper = $this->get('ResetPasswordHelperService');
    	$accountService = $this->get('AccountService');
    	$newPasswordForm  = $this->get("form_new_password");
    	if(($request->getMethod() === 'POST') || ($request->get('token'))) {
    		$newPasswordForm->setValuesFromArray($request->request->all());
    		$newPasswordForm->validate();
    		$user = $this->get('doctrine')->getRepository('AcmeDemoBundle:User')->findOneBy(array('verification_token'=> $request->get('token')));
    		if(empty($user)) {
    			$this->get('session')->getFlashBag()->add('error', "Invalid token !");
    			return $this->redirect($this->generateUrl('resetPasswordToken'));
    		}
    		if(!$newPasswordForm->hasErrors()) {
    			$accountService->setNewPassword($user, $request->get('password'));
    			$this->get('session')->getFlashBag()->add('success', "Bingo. Your password reset successfully!");
    			return $this->redirect($this->generateUrl('_ac_login'));
    		}
    	}
    
    	return $this->render('AcmeDemoBundle:Account:newPassword.html.twig', array('form' => $newPasswordForm));
    }
    
}