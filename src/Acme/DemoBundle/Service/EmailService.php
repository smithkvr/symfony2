<?php
namespace Acme\DemoBundle\Service;

use Acme\DemoBundle\Entity\ClubInvitation;

use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Utility\Util;
use Acme\DemoBundle\Service\FactoryService;
use Acme\DemoBundle\Service\WebServices\MailgunService;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EmailService {
    protected $factory;
    protected $util;
    protected $router;
    protected $mailer;
    protected $templating;
    //protected $mailGun;
    protected $container;
    public function __construct(FactoryService $factory, Util $util, Router $router, \Swift_Mailer $mailer, $templating, ContainerInterface $container) {
        $this->factory = $factory;
        $this->util = $util;
        $this->router = $router;
        $this->mailer = $mailer;
        $this->templating = $templating;
        //$this->mailGun  = $mailGun;
        $this->container = $container;
    }


    public function sendEmailVerification(User $user) {
        $email = $user->getEmail();
        $from ='';
        $fromName = '';
        $subject = "Email verification for reset password";
        $template = 'AcmeDemoBundle:Email:resetPassword.html.twig';
        $data = array(
            'name'=>$user->getUsername(),
            'verificationCode'=>$user->getToken(),
            'userId'=> $user->getId()
        );
        $this->sendEmail($subject, $from, $email, $template, $data);
    }

    public function sendEmail($subject, $from, $to, $template,  $fromName) {
    	if(!$this->mailer->getTransport()->isStarted()){
    		$this->mailer->getTransport()->start();
    	}
    
    	$message = \Swift_Message::newInstance()
    	->setSubject($subject)
    	->setContentType($contentType)
    	->setFrom($from, $fromName)
    	->setTo($to)
    	 ->setBody(
            $this->renderView($template),
            'text/html'
        	);
    	$this->mailer->send($message);
    	$this->mailer->getTransport()->stop();
    }
    
}